<?php

namespace App\Http\Controllers\Decano;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use View;
use App\Area;
use Redirect;

use App\Classes\Rest;
use App\Classes\Buscador;

class AreasController extends Controller
{   

    public function __construct()
    {

        $this->middleware('authdecano');

    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
       
        $areas = Area::all();

        $rest = new Rest();

        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/programas');

        $programas = json_decode($response,true);

        $buscador = new Buscador();       

        $facultades = $buscador->buscadorfacultades($programas);
            
        $buscador->__destruct();

        return View::make('decano.areas.index')->with(['areas' => $areas , 'facultades' => $facultades]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        
        $rest = new Rest();

        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/programas');

        $programas = json_decode($response,true);

        $buscador = new Buscador();

        $facultades = $buscador->buscadorFacultades($programas);

        return View::make('decano.areas.create')->with('facultades', $facultades);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[

            'facultad' => 'required',
            'area' => 'required'

            ]);

        try {

            $area = Area::create([

                'cod_facu_ryca' => $request['facultad'],
                'area' => $request['area']

                ]);
            
        } catch (\PDOException $exception) {
           
            return Redirect::back() -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getMessage()]);

        }

        return Redirect::back() -> with('mensagge', 'Area institucional creada');
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
