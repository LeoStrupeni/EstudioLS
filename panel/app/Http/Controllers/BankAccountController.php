<?php

namespace App\Http\Controllers;

use App\Models\Bank_Account;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BankAccountController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return view("accounts");
        }
        return redirect()->route('login');
    }

    public function getDataTable(Request $request)
    {        
        $roluser = Session::get('user')['roles'][0];
        $permissions = Session::get('user')['permissions']['bank_Accounts'];

        $order = $request->order;
        $page = $request->page ?? 1;
        $limit = $request->limit ?? 10;
        $search = $request->search;

        $totales = Bank_Account::count();

        $query = "SELECT C.*
            FROM bank_accounts C
            WHERE ISNULL(C.deleted_at) ";

        if ($search != '' && isset($search)) {
            $query .= " AND (C.account_holder LIKE '%$search%' 
                OR C.name LIKE '%$search%'
                OR C.bank LIKE '%$search%'
                OR C.type LIKE '%$search%'
                OR C.type_money LIKE '%$search%'
                OR C.number LIKE '%$search%'
                OR C.cbu LIKE '%$search%'
                OR C.alias LIKE '%$search%'
                OR (CASE WHEN C.type = 'CA' THEN 'Caja de ahorro' WHEN C.type = 'CC' THEN 'Cuenta corriente' END ) LIKE '%$search%' ) ";
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
                'account_holder' => ['required'],
                'name' => ['required'],
                'bank' => ['required'],
                'type' => ['required'],
                'type_money' => ['required'],
                'number' => ['required'],
                'alias' => ['required'],
                'cbu' => ['required','unique:bank_accounts,cbu'],
            ],  
            [
                'required' => 'El campo es requerido.',
                'unique' => 'El mail ya se encuentra registrado.',
            ]
        );
    
        Bank_Account::create([
            'account_holder' => $request->account_holder,
            'name' => $request->name,
            'bank' => $request->bank,
            'type' => $request->type,
            'type_money' => $request->type_money,
            'number' => $request->number,
            'alias' => $request->alias,
            'cbu' => $request->cbu,
        ]);

        return redirect()->route('account.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $original = Bank_Account::find($id);
        return $original;
    }

    public function update(Request $request, $id)
    {
        $original = Bank_Account::find($id);

        $datos = array();
        if(isset($request->account_holder) && $request->account_holder != $original->account_holder){
            $request->validate(['account_holder' => ['required']],
                [ 'required' => 'El campo es requerido.']
            );
            $datos['account_holder'] = $request->account_holder;
        }
        if(isset($request->name) && $request->name != $original->name){
            $request->validate(['name' => ['required']],
                [ 'required' => 'El campo es requerido.']
            );
            $datos['name'] = $request->name;
        }
        if(isset($request->bank) && $request->bank != $original->bank){
            $request->validate(['bank' => ['required']],
                [ 'required' => 'El campo es requerido.']
            );
            $datos['bank'] = $request->bank;
        }
        if(isset($request->type) && $request->type != $original->type){
            $request->validate(['type' => ['required']],
                [ 'required' => 'El campo es requerido.']
            );
            $datos['type'] = $request->type;
        }
        if(isset($request->type_money) && $request->type_money != $original->type_money){
            $request->validate(['type_money' => ['required']],
                [ 'required' => 'El campo es requerido.']
            );
            $datos['type_money'] = $request->type_money;
        }
        if(isset($request->number) && $request->type != $original->number){
            $request->validate(['number' => ['required']],
                [ 'required' => 'El campo es requerido.']
            );
            $datos['number'] = $request->number;
        }
        if(isset($request->alias) && $request->alias != $original->alias){
            $request->validate(['alias' => ['required']],
                [ 'required' => 'El campo es requerido.']
            );
            $datos['alias'] = $request->alias;
        }
        if(isset($request->cbu) && $request->cbu != $original->cbu){
            $request->validate(['type' => ['required']],
                [ 'required' => 'El campo es requerido.']
            );
            $datos['cbu'] = $request->cbu;
        }

        
        if(count($datos) > 0){
            Bank_Account::where('id',$id)->update($datos);
        }
        
        return redirect()->route('account.index');
    }

    public function destroy($id)
    {
        Bank_Account::find($id)->update([
            'deleted_at' => Carbon::now()
        ]);

        return redirect()->route('account.index');
    }
}
