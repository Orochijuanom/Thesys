<?php

namespace App\Http\Controllers\Comite;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Linea;
use App\Tipo;
use App\Estado;
use App\Tesi;
use App\Estudiante;
use App\Revisione;

use App\Classes\Rest;
use App\Classes\Buscador;

use View;
use Storage;
use Redirect;


class TesisController extends Controller
{   
    public function __construct()
    {
        $this->middleware('authcomite');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $tesis = Tesi::with('estudiantes')->orderBy('created_at')->where('cod_prog_ryca', '=', session()->get('user.programa'))->get();

        $estados = Estado::all();

        return View::make('comite.tesis.index')->with(['tesis' => $tesis, 'estados' => $estados]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $tesis = Tesi::with('estudiantes', 'lineas', 'tipos', 'estados')->where('id', '=', $id)->first();

         $rest = new Rest();
        
        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/profesor/activo', 
          [

            'token' => session('user.token')

          ]);

        $profesores = json_decode($response,true);

        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/programas');

        $programas = json_decode($response,true);

        $buscador = new Buscador();

        $programas = $buscador->buscadorProgramas($programas);

        $buscador->__destruct();

        $profesores = $buscador->buscadorProfesores($profesores);

        $buscador->__destruct();

        return View::make('comite.tesis.show')->with(['tesis' => $tesis, 'programas' => $programas, 'profesores' => $profesores]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $tesis = Tesi::with('estudiantes', 'lineas', 'tipos', 'estados')->where('id', '=', $id)->first();

        $estados = Estado::all();

        $rest = new Rest();
        
        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/profesor/activo', 
          [

            'token' => session('user.token')

          ]);

        $profesores = json_decode($response,true);

        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/programas');

        $programas = json_decode($response,true);

        $buscador = new Buscador();

        $programas = $buscador->buscadorProgramas($programas);

        $buscador->__destruct();

        $profesores = $buscador->buscadorProfesores($profesores);

        $buscador->__destruct();

        return View::make('comite.tesis.edit')->with(['tesis' => $tesis, 'programas' => $programas, 'profesores' => $profesores, 'estados' => $estados]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request,[

            
            'profesor' => 'required',
            'estado' => 'required',
            

            ]);
            
        try{

            $tesis = Tesi::find($id);

            $tesis->director_cod_user_ryca = $request['profesor'];
            $tesis->estado_id = $request ['estado'];

            $tesis->save();

            if ($request['revision']!="") {
                
                $revision = new Revisione;

                $revision->revision = $request['revision'];
                $revision->cod_user_ryca = session()->get('user.id');
                $revision->tesi_id = $id;
                $revision->fecha = date('Y-m-d H:i:s');

                $revision->save();

            }


        } catch (\PDOException $exception) {
            
            return Redirect::back() -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getMessage()]);
        
        }


        return Redirect::back() ->with('mensagge', 'Tesis Revisada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
