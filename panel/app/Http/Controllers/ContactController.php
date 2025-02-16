<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $clave = $_ENV['RECAPTCHA_APP_KEY']; 
        $token = $request->token;
        $action = $request->action;

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array('secret' => $clave, 'response' => $token )));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);

        curl_close($curl);

        $validador = json_decode($response, true);
        if($validador['success'] == 1 && $validador['score'] >= 0.5){
            if($validador['action'] == $action){
                $request->validate([
                        'nombre' => ['required','string'],
                        'telefono' => ['required'],
                        'email' => ['required','email','string'],
                        'consulta' => ['required']
                    ],
                    [
                        'required' => 'El campo es requerido',
                        'string' => 'El campo debe ser de tipo alfanumérico',
                        'email' => 'El campo no es un email',
                    ]
                );
    
                Contact::insert([
                    'name' => $request->nombre,
                    'email' => $request->email,
                    'telephone' => $request->telefono,
                    'motivo' => $request->motivo,
                    'consultation' => $request->consulta,
                    'status' => 'pendiente'
                ]);

                return back()->with('status', 'Su consulta fue generada, nos pondremos en contacto con usted.');
            }
        }

        throw ValidationException::withMessages([
            'motivo' => ('Error de captcha, envie nuevamente el formulario.')
        ]);

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
