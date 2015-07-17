<?php

namespace App\Http\Controllers\Decano;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Classes\Rest;
use App\Classes\Buscador;
use App\Tesi;

use View;

class ReportesController extends Controller
{    

    public function index()  {

    	$rest = new Rest();

    	$response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/programas');

    	$programas = json_decode($response,true);

    	$buscador = new Buscador();

    	$programas = $buscador->buscadorProgramaFacultad($programas);

    	$progforquest = [];

    	foreach ($programas as $key => $programa) {
    		
    		if ($programa['facultad'] == session()->get('user.facultad')) {
    			array_push($progforquest, $key);
    		}
    	}

    	$tesis = Tesi::whereIn('cod_prog_ryca', $progforquest)->get();

    	
  return View::make('decano.reportes.index')->with('tesis', $tesis);

}

}