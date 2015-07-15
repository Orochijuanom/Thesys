<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Estado;
use App\Tipo;
use App\Area;
use App\Linea;

use View;

use App\Classes\Rest;
use App\Classes\Buscador;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {   

        $rest = new Rest();

        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/programas');

        $programas = json_decode($response,true);

        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/profesor/activo', 
          [

            'token' => session('user.token')

          ]);

        $profesores = json_decode($response,true);

        $buscador = new Buscador();

        $facultades = $buscador->buscadorFacultades($programas);

        $buscador->__destruct();

        $profesores = $buscador->buscadorProfesores($profesores);
        
        $buscador->__destruct();

        $programas = $buscador->buscadorProgramaFacultad($programas);

        $buscador->__destruct();

        $tipos = Tipo::all();

        $estados = Estado::all();

        $areas = Area::all();

        $lineas = Linea::with('areas')->get();

        return View::make('welcome')->with(['programas' => $programas, 'facultades' => $facultades, 'estados' => $estados, 'tipos' => $tipos, 'profesores' => $profesores, 'areas' => $areas, 'lineas' => $lineas]);
    }

   
}
