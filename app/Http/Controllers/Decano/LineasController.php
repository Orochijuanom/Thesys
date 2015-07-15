<?php

namespace App\Http\Controllers\Decano;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Linea;
use App\Area;

use View;
use Redirect;

class LineasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $lineas = Linea::with('areas')->get();

        return View::make('decano.lineas.index')->with('lineas', $lineas);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        
        $areas = Area::where('cod_facu_ryca', '=', session()->get('user.facultad'))->get();

        return View::make('decano.lineas.create')->with('areas', $areas);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[

            'area' => 'required',
            'linea' => 'required'

            ]);

        try {

            $linea = Linea::create([

                'area_id' => $request['area'],
                'linea' => $request['linea']

                ]);
            
        } catch (\PDOException $exception) {
           
            return Redirect::back() -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getMessage()]);

        }

        return Redirect::back() -> with('mensagge', 'Linea de investigación creada');
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
