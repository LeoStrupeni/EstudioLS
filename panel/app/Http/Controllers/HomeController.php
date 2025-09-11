<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Balance_Opening;
use App\Models\Bank_Account;
use App\Models\Money_Movement;
use App\Models\Types_doc_movement;
use App\Models\User;
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

            $fecha1 = date('d/m/Y', strtotime('-2 month'));
            $fecha2 = date('d/m/Y');
            $fechaRango = $fecha1 . ' - ' . $fecha2;
            
            // $movs = Money_Movement::all();
            $bank_accounts = Bank_Account::all();
            $types_doc_movement = Types_doc_movement::all();
            $balance_usd = 0;
            $balance_s = 0;
            $price_jus = 0;
            $price_usd = 0;

            $balances = Balance::all();

            $balances_openings = Balance_Opening::where('status','activo')->orderBy('created_at', 'desc')->get();
            foreach ($balances_openings as $balance) {
                if($price_jus == 0   && $balance->type_money == 'jus'   && $balance->type == 'cotizacion'){$price_jus = $balance->price;}
                if($price_usd == 0   && $balance->type_money == 'dolar' && $balance->type == 'cotizacion'){$price_usd = $balance->price;}
            }
            $origin_usd_b = "https://dolarapi.com/v1/dolares/blue";
            $origin_usd_o = "https://dolarapi.com/v1/dolares/oficial";
            $price_usd_b= json_decode(file_get_contents($origin_usd_b), true)['venta'];
            $price_usd_o= json_decode(file_get_contents($origin_usd_o), true)['venta'];

            $clients = Money_Movement::join('clients','clients.id','=','money_movement.client_id')
                ->selectRaw("clients.id, CONCAT(clients.first_name, ' ', clients.last_names) AS name")
                ->groupBy("clients.id")->groupBy("name")->limit(10)->get();

            $budgets = Money_Movement::join('budgets','budgets.id','=','money_movement.budget_id')
                ->selectRaw("budgets.id, CONCAT('Presupuesto Nro. ', budgets.id, ' - Fecha: ', DATE_FORMAT(budgets.fecha, '%d/%m/%Y')) AS name")
                ->groupBy("budgets.id")->groupBy("name")->limit(10)->get();

            $providers = Money_Movement::join('providers','providers.id','=','money_movement.provider_id')
                ->selectRaw("providers.id, CONCAT(providers.first_name, ' ', providers.last_names) AS name")
                ->groupBy("providers.id")->groupBy("name")->limit(10)->get();

            $users = User::select('id','name')->where('id','>',1)->get();

            return view("home", compact("fechaRango","bank_accounts","types_doc_movement","balances","price_jus","price_usd","price_usd_b","price_usd_o","origin_usd_b","origin_usd_o","clients","budgets","providers","users"));
        }
        return redirect()->route('login');

        // return view("home");
    }
}
