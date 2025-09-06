<?php

namespace App\Http\Controllers;

use App\Models\Money_Movement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MoneyMovementController extends Controller
{
    public function index()
    {
        //
    }

    public function getDataTable(Request $request)
    {        
        $roluser = Session::get('user')['roles'][0];
        $permissions = Session::get('user')['permissions']['moves'];

        $order = $request->order;
        $page = $request->page ?? 1;
        $limit = $request->limit ?? 10;
        $search = $request->search;

        $addWhere='';
        if (isset($request->fecha)) {
            $fechas = explode(' - ', $request->fecha);
            $_fechamin = explode('/', $fechas[0]);
            $_fechamax = explode('/', $fechas[1]);
            $fechamin = date($_fechamin[2] . "-" . $_fechamin[1] . "-" . $_fechamin[0]);
            $fechamax = date($_fechamax[2] . "-" . $_fechamax[1] . "-" . $_fechamax[0]);
            $addWhere .= " AND M.fecha BETWEEN '$fechamin' AND '$fechamax' "; 
        }

        if(isset($request->type)){ $type = implode("','",$request->type); $addWhere .= " AND M.type IN ('$type') "; }
        if(isset($request->type_money)){ $type_money = implode("','",$request->type_money); $addWhere .= " AND M.type_money IN ('$type_money') "; }
        if(isset($request->type_document)){ $type_document = implode("','",$request->type_document); $addWhere .= " AND M.type_document IN ('$type_document') "; }
        if(isset($request->type_payment)){ $type_payment = implode("','",$request->type_payment); $addWhere .= " AND M.type_payment IN ('$type_payment') "; }

        $totales = Money_Movement::count();

        $dolar = 'U$'.'S';
        $query = "SELECT M.*,
            M.id,
            IF(M.type = 'ingreso', 'I', 'E') as `type`,
            DATE_FORMAT(M.fecha, '%d/%m/%Y') AS fecha,
            CASE WHEN M.client_id IS NOT NULL   THEN TRIM(IF(ISNULL(C.first_name),'',CONCAT(C.first_name,' ',IFNULL(C.last_names,'')))) 
                 WHEN M.provider_id IS NOT NULL THEN TRIM(IF(ISNULL(P.first_name),'',CONCAT(P.first_name,' ',IFNULL(P.last_names,''))))
                 WHEN M.user_id IS NOT NULL     THEN IFNULL(U.name,'') 
            END AS cliente,
            CONCAT(UPPER(LEFT(T.name, 1)), LOWER(SUBSTRING(T.name, 2))) AS type_document,
            CONCAT(UPPER(LEFT(M.type_payment, 1)), LOWER(SUBSTRING(M.type_payment, 2))) AS type_payment,
            M.payment_detail,
            M.concepto,
            M.description,
            M.deposit,
            M.expense,
            IF(M.type_money = 'dolar', '$dolar', '$') AS type_money,
            IFNULL(CONCAT('Nro.', B.id), '') AS budget_name,
            B.id AS budget_id
            FROM money_movement M 
            LEFT JOIN clients C ON M.client_id = C.id
            LEFT JOIN providers P ON M.provider_id = P.id
            LEFT JOIN users U ON M.user_id = U.id
            LEFT JOIN budgets B ON M.budget_id = B.id
            LEFT JOIN types_doc_movement T ON M.type_document = T.id
            WHERE ISNULL(M.deleted_at) $addWhere ";

        if ($search != '' && isset($search)) {
            $query .= " AND ( IF(M.type = 'ingreso', 'I', 'E') LIKE '%$search%' 
                OR DATE_FORMAT(M.fecha, '%d/%m/%Y') LIKE '%$search%'
                OR CONCAT(C.first_name,' ',C.last_names) LIKE '%$search%'
                OR CONCAT(P.first_name,' ',P.last_names) LIKE '%$search%'
                OR U.name LIKE '%$search%'
                OR M.type_document LIKE '%$search%'
                OR M.type_payment LIKE '%$search%'
                OR M.payment_detail LIKE '%$search%'
                OR M.concepto LIKE '%$search%'
                OR M.description LIKE '%$search%'
                OR M.deposit LIKE '%$search%'
                OR M.expense LIKE '%$search%'
                OR IF(M.type_money = 'dolar', '$dolar', '$') LIKE '%$search%'  
                OR CONCAT('Pres. Nro.', B.id) LIKE '%$search%'
            ) ";
        }

        $filtrados = DB::select($query);

        $querylist = '';
        if ($order) {
            $querylist .= " ORDER BY $order ";
        } else {
            $querylist .= " ORDER BY C.id DESC ";
        }
        if ($limit) {
            $querylist .= " LIMIT " . $limit;
        }
        if ($page) {
            $querylist .= " OFFSET " . ($limit * $page - $limit);
        }

        $lista = DB::select(DB::raw($query . $querylist));

        $respuesta['totales'] = $totales;
        $respuesta['filtrados'] = count($filtrados);
        $respuesta['paginastotal'] = ceil(count($filtrados) / $limit);
        $respuesta['datos'] = $lista;

        if ($limit * $page > count($filtrados)) {
            $respuesta['infototal'] = 'Mostrando registros del ' . ($limit * $page - $limit + 1) . ' al ' . count($filtrados) . ' de un total de ' . count($filtrados);
        } else {
            $respuesta['infototal'] = 'Mostrando registros del ' . ($limit * $page - $limit + 1) . ' al ' . ($limit * $page) . ' de un total de ' . count($filtrados);
        }

        $respuesta['query'] = $query.$querylist;
        $respuesta['roluser'] = $roluser;
        $respuesta['permissions'] = $permissions;

        return $respuesta;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {   // dd($request->all());
        $request->validate([
                'type' => ['required','string'],
                'type_document' => ['required','string'],
                'type_payment' => ['required','string'],
                'type_money' => ['required','string'],
                'fecha' => ['required','string'],
                'type_origin' => ['required','string'],
                'concepto' => ['required','string'],
                'money' => ['required','numeric'],
                'bank_account' => ['required'],
            ],
            [
                'required' => 'El campo es requerido.',
                'string' => 'El campo debe ser de tipo alfanumérico.',
                'numeric' => 'El campo debe ser un número.',
            ]
        );

        if($request->type_origin == 'client'){ $request->validate(['client_id' => ['required'],], [ 'required' => 'El campo es requerido.',]); }
        if($request->type_origin == 'provider'){ $request->validate(['provider_id' => ['required'],], [ 'required' => 'El campo es requerido.',] );}
        if($request->type_origin == 'user'){ $request->validate(['user_id' => ['required'],], [ 'required' => 'El campo es requerido.',] );}

        if($request->type == 'cambio'){
            $request->validate(['priceusd' => ['required','numeric'],], [ 'required' => 'El campo es requerido.', 'numeric' => 'El campo debe ser un número.'] );
            if($request->type_money != 'dolar'){
                return back()->withErrors(['type_money' => 'Para un movimiento de tipo cambio, la moneda debe ser Dolar.'])->withInput();
            }
            if($request->type_payment != 'efectivo'){
                return back()->withErrors(['type_payment' => 'Para un movimiento de tipo cambio, el tipo de pago debe ser Efectivo.'])->withInput();
            }

            $concepto = $request->concepto . ' - Cotizacion: $' . number_format($request->priceusd,2,'.','');
            // Registro del egreso en dolares
            Money_Movement::create([
                'type' => 'egreso',
                'type_document' => $request->type_document,
                'type_payment' => $request->type_payment,
                'type_money' => $request->type_money,
                'payment_detail' => $request->payment_detail,
                'fecha' => date('Y-m-d', strtotime($request->fecha)),
                'client_id' => $request->client_id,
                'budget_id' => $request->budget_id,
                'provider_id' => $request->provider_id,
                'user_id' => $request->user_id,
                'concepto' => $concepto,
                'description' => $request->description,
                'bank_accounts_id' => $request->bank_account,
                'deposit' => 0,
                'expense' => $request->money,
            ]);

            $request2 = new Request();
            $request2->setMethod('POST');
            $request2->query->add(array(
                'type' => 'client',
                'type_money' => $request->type_money,
                'detail' => 'egreso',
                'balance' => $request->money,
                'client_id' => $request->client_id,
                'budget_id' => $request->budget_id,
                'provider_id' => $request->provider_id,
                'user_id' => $request->user_id,
                'type_document' => $request->type_document,
                'type_payment' => $request->type_payment,
                'payment_detail' => $request->payment_detail,
                'fecha' => date('Y-m-d', strtotime($request->fecha)),
                'concepto' => $concepto,
                'description' => $request->description,
                'bank_accounts_id' => $request->bank_account,
                'money' => $request->money,
                'priceusd' => $request->priceusd,
            ));
            $this->registerMovBalance($request2);

            // Registro del ingreso en pesos
            Money_Movement::create([
                'type' => 'ingreso',
                'type_document' => $request->type_document,
                'type_payment' => $request->type_payment,
                'type_money' => 'peso',
                'payment_detail' => $request->payment_detail,
                'fecha' => date('Y-m-d', strtotime($request->fecha)),
                'client_id' => $request->client_id,
                'budget_id' => $request->budget_id,
                'provider_id' => $request->provider_id,
                'user_id' => $request->user_id,
                'concepto' => $concepto,
                'description' => $request->description,
                'bank_accounts_id' => $request->bank_account_dest,
                'deposit' => $request->money * $request->priceusd,
                'expense' => 0,
            ]);

            $request2 = new Request();
            $request2->setMethod('POST');
            $request2->query->add(array(
                'type' => 'client',
                'type_money' => 'peso',
                'detail' => 'ingreso',
                'balance' => $request->money * $request->priceusd,
                'client_id' => $request->client_id,
                'budget_id' => $request->budget_id,
                'provider_id' => $request->provider_id,
                'user_id' => $request->user_id,
                'type_document' => $request->type_document,
                'type_payment' => $request->type_payment,
                'payment_detail' => $request->payment_detail,
                'fecha' => date('Y-m-d', strtotime($request->fecha)),
                'concepto' => $concepto,
                'description' => $request->description,
                'bank_accounts_id' => $request->bank_account,
                'money' => $request->money,
                'priceusd' => $request->priceusd,
            ));
            $this->registerMovBalance($request2);

        } elseif($request->type == 'caja'){
            Money_Movement::create([
                'type' => 'egreso',
                'type_document' => $request->type_document,
                'type_payment' => $request->type_payment,
                'type_money' => $request->type_money,
                'payment_detail' => $request->payment_detail,
                'fecha' => date('Y-m-d', strtotime($request->fecha)),
                'client_id' => $request->client_id,
                'budget_id' => $request->budget_id,
                'provider_id' => $request->provider_id,
                'user_id' => $request->user_id,
                'concepto' => $request->concepto,
                'description' => $request->description,
                'bank_accounts_id' => $request->bank_account,
                'deposit' => 0,
                'expense' => $request->money,
            ]);

            $request2 = new Request();
            $request2->setMethod('POST');
            $request2->query->add(array(
                'type' => $request->type_origin == 'client' ? 'client' : 'caja',
                'type_money' => $request->type_money,
                'detail' => 'egreso',
                'balance' => $request->money,
                'client_id' => $request->client_id,
                'budget_id' => $request->budget_id,
                'provider_id' => $request->provider_id,
                'user_id' => $request->user_id,
                'type_document' => $request->type_document,
                'type_payment' => $request->type_payment,
                'payment_detail' => $request->payment_detail,
                'fecha' => date('Y-m-d', strtotime($request->fecha)),
                'concepto' => $request->concepto,
                'description' => $request->description,
                'bank_accounts_id' => $request->bank_account
            ));
            $this->registerMovBalance($request2);

            if($request->type_origin == 'client'){
                // Registro del ingreso en pesos
                Money_Movement::create([
                    'type' => 'ingreso',
                    'type_document' => $request->type_document,
                    'type_payment' => $request->type_payment,
                    'type_money' => 'peso',
                    'payment_detail' => $request->payment_detail,
                    'fecha' => date('Y-m-d', strtotime($request->fecha)),
                    'client_id' => $request->client_id,
                    'budget_id' => $request->budget_id,
                    'provider_id' => $request->provider_id,
                    'user_id' => $request->user_id,
                    'concepto' => $request->concepto,
                    'description' => $request->description,
                    'bank_accounts_id' => $request->bank_account,
                    'deposit' => $request->money,
                    'expense' => 0,
                ]);

                $request2 = new Request();
                $request2->setMethod('POST');
                $request2->query->add(array(
                    'type' => 'caja',
                    'type_money' => $request->type_money,
                    'detail' => 'ingreso',
                    'balance' => $request->money,
                    'client_id' => $request->client_id,
                    'budget_id' => $request->budget_id,
                    'provider_id' => $request->provider_id,
                    'user_id' => $request->user_id,
                    'type_document' => $request->type_document,
                    'type_payment' => $request->type_payment,
                    'payment_detail' => $request->payment_detail,
                    'fecha' => date('Y-m-d', strtotime($request->fecha)),
                    'concepto' => $request->concepto,
                    'description' => $request->description,
                    'bank_accounts_id' => $request->bank_account
                ));
                $this->registerMovBalance($request2);
            }
        } else {
            Money_Movement::create([
                'type' => $request->type,
                'type_document' => $request->type_document,
                'type_payment' => $request->type_payment,
                'type_money' => $request->type_money,
                'payment_detail' => $request->payment_detail,
                'fecha' => date('Y-m-d', strtotime($request->fecha)),
                'client_id' => $request->client_id,
                'budget_id' => $request->budget_id,
                'provider_id' => $request->provider_id,
                'user_id' => $request->user_id,
                'concepto' => $request->concepto,
                'description' => $request->description,
                'bank_accounts_id' => $request->bank_account,
                'deposit' => $request->type == 'ingreso' ? $request->money : 0,
                'expense' => $request->type == 'egreso' ? $request->money : 0,
            ]);
            $request2 = new Request();
            $request2->setMethod('POST');
            $request2->query->add(array(
                'type' => $request->type_origin == 'client' ? 'client' : 'caja',
                'type_money' => $request->type_money,
                'detail' => $request->type,
                'balance' => $request->money,
                'client_id' => $request->client_id,
                'budget_id' => $request->budget_id,
                'provider_id' => $request->provider_id,
                'user_id' => $request->user_id,
                'type_document' => $request->type_document,
                'type_payment' => $request->type_payment,
                'payment_detail' => $request->payment_detail,
                'fecha' => date('Y-m-d', strtotime($request->fecha)),
                'concepto' => $request->concepto,
                'description' => $request->description,
                'bank_accounts_id' => $request->bank_account
            ));
            $this->registerMovBalance($request2);
        }
        return redirect('/home');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return Money_Movement::find($id);
    }

    public function update(Request $request, $id)
    {
        $original = Money_Movement::find($id);

        $datos = array();
        if(isset($request->type) && $request->type != $original->type){
            $request->validate(['type' => ['required']],
                [ 'required' => 'El campo es requerido.']
            );
            $datos['type'] = $request->type;
        }
        if(isset($request->type_document) && $request->type_document != $original->type_document){
            $request->validate(['type_document' => ['required']],
                [ 'required' => 'El campo es requerido.']
            );
            $datos['type_document'] = $request->type_document;
        }
        if(isset($request->type_payment) && $request->type_payment != $original->type_payment){
            $request->validate(['type_payment' => ['required']],
                [ 'required' => 'El campo es requerido.']
            );
            $datos['type_payment'] = $request->type_payment;
        }
        if(isset($request->type_money) && $request->type_money != $original->type_money){
            $request->validate(['type_money' => ['required']],
                [ 'required' => 'El campo es requerido.']
            );
            $datos['type_money'] = $request->type_money;
        }
        if(isset($request->fecha) && $request->fecha != $original->fecha){
            $request->validate(['fecha' => ['required']],
                [ 'required' => 'El campo es requerido.']
            );
            $datos['fecha'] = date('Y-m-d', strtotime($request->fecha));
        }
        if(isset($request->concepto) && $request->concepto != $original->concepto){
            $request->validate(['concepto' => ['required']],
                [ 'required' => 'El campo es requerido.']
            );
            $datos['concepto'] = $request->concepto;
        }
        if(isset($request->money)){
            $request->validate(['money' => ['required','numeric']],
                [ 'required' => 'El campo es requerido.',
                    'numeric' => 'El campo debe ser un número.',]
            );

            if ($request->type == 'ingreso' && $request->money != $original->deposit){
                $datos['deposit'] = $request->money;
                $datos['expense'] = 0;
            } elseif ($request->type == 'egreso' && $request->money != $original->expense){
                $datos['expense'] = $request->money;
                $datos['deposit'] = 0;
            }
        }
        if(isset($request->bank_account) && $request->bank_account != $original->bank_accounts_id){
            $request->validate(['bank_account' => ['required']],
                [ 'required' => 'El campo es requerido.']
            );
            $datos['bank_accounts_id'] = $request->bank_account;
        }
        if(isset($request->type_origin)){
            if($request->type_origin == 'client' && $request->client_id != $original->client_id){
                $request->validate(['client_id' => ['required'],], [ 'required' => 'El campo es requerido.',]);
                $datos['client_id'] = $request->client_id;
                $datos['provider_id'] = null;
                $datos['user_id'] = null;
            }
            if($request->type_origin == 'provider' && $request->provider_id != $original->provider_id){
                $request->validate(['provider_id' => ['required'],], [ 'required' => 'El campo es requerido.',] );
                $datos['provider_id'] = $request->provider_id;
                $datos['client_id'] = null;
                $datos['user_id'] = null;
            }
            if($request->type_origin == 'user' && $request->user_id != $original->user_id){
                $request->validate(['user_id' => ['required'],], [ 'required' => 'El campo es requerido.',] );
                $datos['user_id'] = $request->user_id;
                $datos['client_id'] = null;
                $datos['provider_id'] = null;
            }
        }
        if(isset($request->budget_id) && $request->budget_id != $original->budget_id){
            $datos['budget_id'] = $request->budget_id;
        }
        if(isset($request->payment_detail) && $request->payment_detail != $original->payment_detail){
            $datos['payment_detail'] = $request->payment_detail;
        }
        if(isset($request->description) && $request->description != $original->description){
            $datos['description'] = $request->description;
        }

        if(count($datos) > 0){
            Money_Movement::where('id',$id)->update($datos);
        }
        if(isset($request->money) && $request->money != ($original->deposit > 0 ? $original->deposit : $original->expense) ){
            if($original->type == 'ingreso'){
                $this->registerMovBalance($original->type_money, $request->money - $original->deposit, 'ingreso' );
            } else {
                $this->registerMovBalance($original->type_money, $request->money - $original->expense, 'egreso' );
            }
        }

        return redirect('/home');

    }

    public function destroy($id)
    {
        Money_Movement::find($id)->update([
            'deleted_at' => Carbon::now()
        ]);

        return redirect('/home');
    }
}
