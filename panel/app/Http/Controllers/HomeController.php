<?php

namespace App\Http\Controllers;

use App\Models\Bank_Account;
use App\Models\Money_Movement;
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

            return view("home", compact("fechaRango","bank_accounts"));
        }
        return redirect()->route('login');

        // return view("home");
    }
}
