<?php

namespace App\Http\Controllers\Decano;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tesi;

use View;

class ReportesController extends Controller
{    

    public function index()
    {
        //$tesis = Tesi::where()->get();
        return View::make('decano.reportes.index');

    }
    
}