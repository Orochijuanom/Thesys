<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use View;

use App\Classes\Rest;
use App\Classes\Buscador;

use App\Tesi;

class ResultadosController extends Controller
{
	public function index(Request $request){

		//dd($request);
		if ($request->filtrar==1) {
			$filtro="Si utilizo el filtro";
			return View::make('resultados')->with(['filtro' => $filtro]);
		}
		else{			

			$tesis = Tesi::where('titulo', 'like', '%'.$request->titulo.'%')->get();

			$rest = new Rest();

			$response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/programas');

			$buscador = new Buscador();

			$programas = json_decode($response,true);
	        //$programas[$tesis->cod_prog_ryca]
			$programas = $buscador->buscadorProgramas($programas);

			$buscador->__destruct();			

			return View::make('resultados')->with(['tesis' => $tesis, 'programas' => $programas]);
		}
	}

	public function show($id){


	}
}