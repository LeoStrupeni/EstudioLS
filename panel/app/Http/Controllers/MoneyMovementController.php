<?php

namespace App\Http\Controllers;

use App\Models\Money_Movement;
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
            CONCAT('Pres. Nro.', B.id) AS budget_id
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
    {
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

        Money_Movement::create([
            'type' => $request->type,
            'type_money' => $request->type_money,
            'type_document' => $request->type_document,
            'type_payment' => $request->type_payment,
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

        return redirect('/home');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
