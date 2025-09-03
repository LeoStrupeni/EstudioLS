<?php

namespace App\Http\Controllers;

use App\Models\Balance_Opening;
use App\Models\Bank_Account;
use App\Models\Money_Movement;
use App\Models\Types_doc_movement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $val = $this->getloginrol();
            if ($val == false){
                return redirect()->route('logout');     
            }

            if (date("d") == 1) { $fecha1 = date('01/m/Y', strtotime('-1 month')); } 
            else { $fecha1 = date('01/m/Y'); }
            $fecha2 = date('d/m/Y');
            $fechaRango = $fecha1 . ' - ' . $fecha2;
            
            // $movs = Money_Movement::all();
            $bank_accounts = Bank_Account::all();
            $types_doc_movement = Types_doc_movement::all();
            $balance_usd = 0;
            $balance_s = 0;
            $price_jus = 0;
            $price_usd = 0;

            $balances = Balance_Opening::where('status','activo')->orderBy('created_at', 'desc')->get();
            foreach ($balances as $balance) {
                if($balance_usd == 0 && $balance->type_money == 'dolar' && $balance->type == 'saldo'){$balance_usd = $balance->price;}
                if($balance_s == 0   && $balance->type_money == 'peso'  && $balance->type == 'saldo'){$balance_s = $balance->price;}
                if($price_jus == 0   && $balance->type_money == 'jus'   && $balance->type == 'cotizacion'){$price_jus = $balance->price;}
                if($price_usd == 0   && $balance->type_money == 'dolar' && $balance->type == 'cotizacion'){$price_usd = $balance->price;}
            }
            $origin_usd = '';
            if($price_usd == 0){
                $price_usd= json_decode(file_get_contents("https://dolarapi.com/v1/dolares/blue"), true)['venta'];
                $origin_usd = "https://dolarapi.com/v1/dolares/blue";
            }

            return view("home", compact("fechaRango","bank_accounts","types_doc_movement","balance_usd","balance_s","price_jus","price_usd","origin_usd"));
        }
        return redirect()->route('login');

        // return view("home");
    }
}
