<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classes\Rest;
use App\Classes\Buscador;
use App\Comite;

use View;
use Redirect;

class ComitesController extends Controller
{   

    public function __construct()
    {

        $this->middleware('authadmin');

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $rest = new Rest();
        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/profesor/activo', 
          [

            'token' => session('user.token')

          ]);

        $profesores = json_decode($response,true); 
        dd($profesores);
        $comites = Comite::all();
        
        //$buscador = new Buscador();

        //$administrativos=$buscador->buscadorComite($profesores, $comites);
            

        return View::make('comites.index')->with(['profesores' => $profesores, 'comites' => $comites]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $rest = new Rest();
        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/profesor/activo', 
          [

            'token' => session('user.token')

          ]);

        $profesores = json_decode($response,true);

        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/programas');

        $programas = json_decode($response,true);
    
        return View::make('admin.comites.create')->with(['profesores' => $profesores, 'programas' => $programas]);


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
        //
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
