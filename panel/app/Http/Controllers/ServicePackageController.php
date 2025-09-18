<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServicePackage;
use App\Models\ServicePackageItems;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ServicePackageController extends Controller
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
            $services = Service::all();
            return view("servicepackages", compact("services"));
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

        $totales = ServicePackage::count();

        $query = "SELECT p.*, S.count as items_count
            FROM service_package P
            JOIN (SELECT service_package_id, COUNT(service_package_id) as count
                FROM service_package_items 
                WHERE ISNULL(deleted_at) 
                GROUP BY service_package_id) S ON P.id = S.service_package_id
            WHERE ISNULL(P.deleted_at) ";

        if ($search != '' && isset($search)) {
            $query .= " AND  (P.name LIKE '%$search%'
                OR P.observations LIKE '%$search%' ) ";
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
                'name' => ['required','string'],
            ],
            [
                'required' => 'El campo es requerido.',
                'string' => 'El campo debe ser de tipo alfanumérico.',
            ]
        );
        $servicios = json_decode($request->servicios, true);

        $id = ServicePackage::insertGetId([
            'name' => $request->name,
            'observations' => $request->observations,
            'created_at' => Carbon::now()
        ]);

        foreach ($servicios as $servicio) {
            ServicePackageItems::create([
                'service_package_id' => $id,
                'services_id' => $servicio['id'],
            ]);
        }

        return redirect()->route('service_package.index');


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
        $service = ServicePackage::find($id);
        $items = ServicePackageItems::join('services', 'service_package_items.services_id', '=', 'services.id')
            ->where('service_package_id', $id)
            ->select('service_package_items.id', 'service_package_items.services_id', 'services.name as service_name', 'services.observations', 'services.type_money', 'services.price')
            ->get();

        return response()->json([
            'service' => $service,
            'items' => $items
        ]);
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
            $datos['observations'] = $request->observations;
        }
        
        if(count($datos) > 0){
            ServicePackage::where('id',$id)->update($datos);
        }

        DB::delete('delete from service_package_items where service_package_id = ?', [$id]);

        $servicios = json_decode($request->servicios, true);

        foreach ($servicios as $servicio) {
            ServicePackageItems::create([
                'service_package_id' => $id,
                'services_id' => $servicio['id'],
            ]);
        }

        return redirect()->route('service_package.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ServicePackage::find($id)->update([
            'deleted_at' => Carbon::now()
        ]);

        return redirect()->route('service_package.index');
    }

}
