<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\BalanceLogs;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function getloginrol()
    {
        if (Session::get('user') != null) {
            return true;
        } else {
            return false;
        }
    }

    public function translateText($text)
    {
        $tr = new GoogleTranslate(); 
        $tr->setSource('en'); 
        $tr->setSource();
        $tr->setTarget('es');

        return $tr->translate(strtolower(str_replace("_", " ", $text)));
    }

    public function registerMovBalance(Request $request)
    {
        if($request->detail == 'inicial'){
            Balance::where([['type_money',$request->type_money],['type',$request->type]])
            ->update([
                'balance' => $request->balance,
                'updated_at' => Carbon::now(),
                'last_detail' => 'Initial balance'
            ]);
        } else {
            $actual =  Balance::where([['type_money',$request->type_money],['type',$request->type]])->first();
            if($request->detail=='egreso'){
                $new_balance = $actual->balance - $request->balance;
            } else {
                $new_balance = $actual->balance + $request->balance;
            }

            Balance::where([['type_money',$request->type_money],['type',$request->type]])
                ->update([
                    'balance' => $new_balance,
                    'updated_at' => Carbon::now(),
                    'last_detail' => $request->detail
                ]);
        }
        $balance = Balance::where([['type_money',$request->type_money],['type',$request->type]])->first();
        BalanceLogs::create([
            'balance_id' => $balance->id,
            'type' => $request->type,
            'type_money' => $request->type_money,
            'money' => $request->balance,
            'detail' => $request->detail,
            'client_id' => $request->client_id,
            'budget_id' => $request->budget_id,
            'provider_id' => $request->provider_id,
            'user_id' => $request->user_id,
            'json' => json_encode($request->all()),
            'created_at' => Carbon::now(),
            'created_by' => Auth::user()->id,
        ]);
        return true;
    }
}
