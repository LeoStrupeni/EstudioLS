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

        $totales = Money_Movement::count();

        $query = "SELECT M.*, 
                TRIM(IF(ISNULL(C.first_name),'',CONCAT(C.first_name,' ',IFNULL(C.last_names,'')))) AS cliente,
                TRIM(IF(ISNULL(P.first_name),'',CONCAT(P.first_name,' ',IFNULL(P.last_names,'')))) AS proveedor,
                IFNULL(U.name,'') as usuario
            FROM money_movement M 
            LEFT JOIN clients C ON M.client_id = C.id
            LEFT JOIN providers P ON M.provider_id = P.id
            LEFT JOIN users U ON M.user_id = U.id
            WHERE ISNULL(M.deleted_at) ";

        if ($search != '' && isset($search)) {
            $query .= " AND (M.type LIKE '%$search%' 
                OR M.type_money LIKE '%$search%'
                OR M.type_document LIKE '%$search%'
                OR M.type_payment LIKE '%$search%'
                OR M.payment_detail LIKE '%$search%'
                OR M.fecha LIKE '%$search%'
                OR M.concepto LIKE '%$search%'
                OR M.description LIKE '%$search%'
                OR M.deposit LIKE '%$search%'
                OR M.expense LIKE '%$search%'
                OR CONCAT(C.first_name,' ',C.last_names) LIKE '%$search%'
                OR CONCAT(P.first_name,' ',P.last_names) LIKE '%$search%'
                OR U.name LIKE '%$search%'
                
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
        //
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
