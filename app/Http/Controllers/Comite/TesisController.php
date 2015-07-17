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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
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
