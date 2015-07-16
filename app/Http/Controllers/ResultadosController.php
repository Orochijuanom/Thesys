<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use View;

class ResultadosController extends Controller
{
	public function index(Request $request){

		//dd($request);

		return View::make('resultados');

	}


}