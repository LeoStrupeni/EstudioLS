<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServicePackage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $val = $this->getloginrol();
            if ($val == false){
                return redirect()->route('logout');     
            }
            return view("services");
        }

        return redirect()->route('login');
    }

    public function getDataTable(Request $request)
    {        
        $roluser = Session::get('user')['roles'][0];
        $permissions = Session::get('user')['permissions']['services'];

        $order = $request->order;
        $page = $request->page ?? 1;
        $limit = $request->limit ?? 10;
        $search = $request->search;

        $totales = Service::count();

        $query = "SELECT *
            FROM services P
            WHERE ISNULL(P.deleted_at) ";

        if ($search != '' && isset($search)) {
            $query .= " AND  (P.name LIKE '%$search%'
                OR P.observations LIKE '%$search%' 
                OR P.price LIKE '%$search%' ) ";
        }

        $querylist = ' ';

        $filtrados = DB::select($query . $querylist);

        
        if ($order) {
            $querylist .= " ORDER BY $order ";
        } else {
            $querylist .= " ORDER BY P.id DESC ";
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
                'name' => ['required','string'],
                'type_money' => ['required'],
                'price' => ['required','numeric'],
            ],
            [
                'required' => 'El campo es requerido.',
                'string' => 'El campo debe ser de tipo alfanumérico.',
            ]
        );
    
        Service::create([
            'name' => $request->name,
            'observations' => $request->observations,
            'type_money' => $request->type_money,
            'price' => $request->price,
        ]);
            

        return redirect()->route('service.index');
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
        $service = Service::find($id);
        return $service;
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
        $service = Service::find($id);

        $datos = array();
        if(isset($request->name) && $request->name != $service->name){
            $request->validate(['name' => ['required','string']],
                [ 'required' => 'El campo es requerido.','string' => 'El campo debe ser de tipo alfanumérico.']
            );
            $datos['name'] = $request->name;
        }
        if(isset($request->observations) && $request->observations != $service->observations){
            $request->validate(['observations' => ['required','string']],
                [ 'required' => 'El campo es requerido.','string' => 'El campo debe ser de tipo alfanumérico.']
            );
            $datos['observations'] = $request->observations;
        }
        if(isset($request->type_money) && $request->type_money != $service->type_money){
            $request->validate(['type_money' => ['required']],
                [ 'required' => 'El campo es requerido.']
            );
            $datos['type_money'] = $request->type_money;
        }
        if(isset($request->price) && $request->price != $service->price){
            $request->validate(['price' => ['required']],
                [ 'required' => 'El campo es requerido.']
            );
            $datos['price'] = $request->price;
        }
        
        if(count($datos) > 0){
            Service::where('id',$id)->update($datos);
        }

        return redirect()->route('service.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::find($id)->update([
            'deleted_at' => Carbon::now()
        ]);

        return redirect()->route('service.index');
    }

    public function getDetailsServices(Request $request)
    {
        if(!$request->has('valor')) {
            return response()->json(['error' => 'el servicio es requerido'], 400);
        }
        if(!$request->has('type')) {
            return response()->json(['error' => 'el tipo es requerido'], 400);
        }
        $type = $request->input('type');
        $value = $request->input('valor');

        if($type == 'services') {
            $service = Service::find($value);
            if (!$service) {
                return response()->json(['error' => 'Servicio no encontrado'], 404);
            }
            return response()->json($service);
        } else if($type == 'paquetes') {
            $package = ServicePackage::find($value);
            if (!$package) {
                return response()->json(['error' => 'Paquete no encontrado'], 404);
            }
            return response()->json($package);
        }
        // Aquí puedes agregar la lógica para obtener los detalles del servicio
    }
}
