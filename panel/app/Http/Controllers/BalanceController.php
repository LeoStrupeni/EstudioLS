<?php

namespace App\Http\Controllers;

use App\Models\Balance_Opening;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $val = $this->getloginrol();
        if ($val == false){
            return redirect()->route('logout');     
        }
        $fechaRango='';
        return view("settings.balances", compact("fechaRango"));
    }

    public function getDataTable(Request $request)
    {        
        $roluser = Session::get('user')['roles'][0];
        $permissions = Session::get('user')['permissions']['balances'];

        $order = $request->order;
        $page = $request->page ?? 1;
        $limit = $request->limit ?? 10;
        $search = $request->search;

        $totales = Balance_Opening::count();

        $query = "SELECT C.*, DATE_FORMAT(C.fecha, '%d/%m/%Y') as creado
            FROM balance_opening C
            WHERE ISNULL(C.deleted_at) ";

        if ($search != '' && isset($search)) {
            $query .= " AND (C.type_money LIKE '%$search%' 
                OR C.type LIKE '%$search%'
                OR C.status LIKE '%$search%'
                OR C.price LIKE '%$search%' 
                OR DATE_FORMAT(C.created_at, '%d/%m/%Y') LIKE '%$search%' ) ";
        }

        $filtrados = DB::select($query);

        $querylist = '';
        if ($order) {
            $querylist .= " ORDER BY $order ";
        } else {
            $querylist .= " ORDER BY C.created_at DESC ";
        }
        if ($limit) {
            $querylist .= " LIMIT " . $limit;
        }
        if ($page) {
            $querylist .= " OFFSET " . ($limit * $page - $limit);
        }

        $lista = DB::select($query . $querylist);

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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
                'type' => ['required'],
                'type_money' => ['required'],
                'fecha' => ['required'],
                'price' => ['required'],
            ],  
            [
                'required' => 'El campo es requerido.',
            ]
        );

        Balance_Opening::where([
            ['type_money',$request->type_money],
            ['type',$request->type],
            ['status','activo'],
        ])->update(['status' => 'inactivo', 'updated_at' => Carbon::now()]);

        Balance_Opening::create([
            'type_money' => $request->type_money,
            'type' => $request->type,
            'status' => 'activo',
            'price' => $request->price,
            'fecha' => date('Y-m-d', strtotime($request->fecha)),
            'created_at' => Carbon::now(),
            'updated_at' => null
        ]);
        if($request->type == 'saldo'){
            $request2 = new Request();
            $request2->setMethod('POST');
            $request2->query->add(array(
                'type' => 'caja',
                'type_money' => $request->type_money,
                'detail' => 'inicial',
                'balance' => $request->price
            ));
            $this->registerMovBalance($request2);
        }

        return redirect()->route('balances.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $original = Balance_Opening::find($id);
        return $original;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $original = Balance_Opening::find($id);

        $datos = array();
        if(isset($request->price) && $request->price != $original->price){
            $request->validate(['price' => ['required']],
                [ 'required' => 'El campo es requerido.']
            );
            $datos['price'] = $request->price;
            $datos['updated_at'] = Carbon::now();
        }
        
        if(count($datos) > 0){
            Balance_Opening::where('id',$id)->update($datos);
        }
        if($request->type == 'saldo'){
            $request2 = new Request();
            $request2->setMethod('POST');
            $request2->query->add(array(
                'type' => 'caja',
                'type_money' => $request->type_money,
                'detail' => 'inicial',
                'balance' => $request->price
            ));
            $this->registerMovBalance($request2);
        }

        return redirect()->route('balances.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Balance_Opening::find($id)->update([
            'deleted_at' => Carbon::now()
        ]);

        return redirect()->route('balances.index');
    }
}
