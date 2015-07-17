<?php

namespace App\Http\Controllers\Decano;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tesi;

use View;

class ReportesController extends Controller
{    

    public function index()  {
        
        /* $tesis = Tesi::$where ="";
        foreach($programas as $programa ){
         if($programa['facultad'] == session()->get('user.facultad')){
         $where .= 'orWhere('cod_prog_ryca', '=', $programa["programa"])';
      }

  }->get(); */
  return View::make('decano.reportes.index');

}

}