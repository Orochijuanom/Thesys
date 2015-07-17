<?php

namespace App\Http\Controllers\Decano;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Linea;
use App\Area;

use View;
use Redirect;

class ReportesController extends Controller
{    

    public function index()
    {
        
        return View::make('decano.reportes.index');

    }
    
}