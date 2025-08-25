<?php

namespace App\Http\Controllers;

use App\Models\Types_doc_movement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TypesDocMovementsController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $val = $this->getloginrol();
            if ($val == false){
                return redirect()->route('logout');     
            }
            return view("typesdocmovs");
        }
        return redirect()->route('login');
    }

    public function getDataTable(Request $request)
    {        
        $movesuser = Session::get('user')['roles'][0];
        $permissions = Session::get('user')['permissions']['moves'];

        $order = $request->order;
        $page = $request->page ?? 1;
        $limit = $request->limit ?? 10;
        $search = $request->search;

        $totales = Types_doc_movement::count();

        $query = "SELECT R.*
            FROM types_doc_movement R
            WHERE ISNULL(R.deleted_at) ";

        if ($search != '' && isset($search)) {
            $query .= " AND (R.name LIKE '%$search%' 
                OR R.description LIKE '%$search%'
                OR R.type LIKE '%$search%' ) ";
        }

        $filtrados = DB::select($query);

        $querylist = '';
        if ($order) {
            $querylist .= " ORDER BY $order ";
        } else {
            $querylist .= " ORDER BY R.id DESC ";
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
        $respuesta['movesuser'] = $movesuser;
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
                'name' => ['required','string','unique:types_doc_movement,name'],
                'type' => ['required'],
            ],
            [
                'required' => 'El campo es requerido.',
                'string' => 'El campo debe ser de tipo alfanumérico.',
                'unique' => 'El Tipo ya existe, ya se encuentra registrado.',
            ]
        );

        Types_doc_movement::create([
            'name' => $request->name,
            'description' => $request->description ?? null,
            'type' => $request->type
        ]);

        return redirect()->route('typesdocmov.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $type = Types_doc_movement::find($id);
        return $type;
    }

    public function update(Request $request, $id)
    {
        $type = Types_doc_movement::find($id);
     
        $datos = array();
        if(isset($request->name) && $request->name != $type->name){
            $request->validate([
                    'name' => ['required','string','unique:types_doc_movement,name'],
                ],
                [
                    'required' => 'El campo es requerido.',
                    'string' => 'El campo debe ser de tipo alfanumérico.',
                    'unique' => 'El Tipo ya existe, ya se encuentra registrado.',
                ]
            );
            $datos['name'] = $request->name;
        }

        if(isset($request->description)){
            $datos['description'] = $request->description;
        }

        if(isset($request->type) && $request->type != $type->name){
            $request->validate([
                    'type' => ['required'],
                ],
                [
                    'required' => 'El campo es requerido.',
                ]
            );
            $datos['type'] = $request->type;
        }

        if(count($datos) > 0){
            Types_doc_movement::find($id)->update($datos);
        }
        
        return redirect()->route('typesdocmov.index');
    }

    public function destroy($id)
    {
        Types_doc_movement::find($id)->update([
            'deleted_at' => Carbon::now()
        ]);

        return redirect()->route('typesdocmov.index');
    }
}
