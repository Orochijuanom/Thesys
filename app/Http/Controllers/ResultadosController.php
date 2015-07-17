<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use View;

use App\Classes\Rest;
use App\Classes\Buscador;

use App\Tesi;
use App\Area;

class ResultadosController extends Controller
{
	public function index(){

		$titulo=$_GET['titulo'];
		$facultad=$_GET['facultad'];
		$programa=$_GET['programa'];
		$area=$_GET['area'];
		$linea=$_GET['linea'];
		$tipo=$_GET['tipo'];
		$estado=$_GET['estado'];
		$anio=$_GET['anio'];
		$semestre=$_GET['semestre'];		
		
		if (isset($_GET['filtrar'])) {
			return View::make('resultados');
		}
		else{			

			$tesis = Tesi::where('titulo', 'like', '%'.$titulo.'%')->paginate(20);

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

		$tesis = Tesi::with('estudiantes', 'lineas', 'tipos', 'estados')->where('id', '=', $id)->first();

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

		$areas = Area::all();

		return View::make('proyectos')->with(['tesis' => $tesis, 'facultades' => $facultades, 'programas' => $programas, 'profesores' => $profesores, 'areas' => $areas]);
	}
}