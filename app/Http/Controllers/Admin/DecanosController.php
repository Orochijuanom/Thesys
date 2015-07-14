<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classes\Rest;
use App\Classes\Buscador;
use App\Decano;

use View;
use Redirect;

class DecanosController extends Controller
{

    public function __construct()
    {

        $this->middleware('authadmin');

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $rest = new Rest();
        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/administrativo/', 
          [

            'token' => session('user.token')

          ]);
        
        $administrativos = json_decode($response,true); 
        
        $decanos = Decano::all();
        
        $buscador = new Buscador();

        $administrativos = $buscador->buscadorAdministrativo($administrativos, $decanos);
            
        $buscador->__destruct();
        
        return View::make('admin.decanos.index')->with(['administrativos' => $administrativos, 'decanos' => $decanos]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $rest = new Rest();
        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/administrativo/', 
          [

            'token' => session('user.token')

          ]);

        $administrativos = json_decode($response,true);

        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/programas');

        $programas = json_decode($response,true);

        $buscador = new Buscador();

        $facultades = $buscador->buscadorFacultades($programas);
        
        return View::make('admin.decanos.create')->with(['administrativos' => $administrativos, 'facultades' => $facultades]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[

            'administrativo' => 'required',
            'facultad' => 'required'

            ]);

        try {

            $decano = Decano::create([

                'cod_user_ryca' => $request['administrativo'],
                'cod_facu_ryca' => $request['facultad']

                ]);
            
        } catch (\PDOException $exception) {
           
            return Redirect::back() -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getMessage()]);

        }

        return Redirect::back() -> with('mensagge', 'Decano asignado');

    }

       /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        
        try {

                $decano = Decano::findOrFail($id);
                
            } catch (Exception $e) {

                return Response::view('errors/404', array(), 404);
                
            }

            try {

                $decano -> delete();
                
            } catch (\PDOException $exception) {
                
                return Redirect::back() -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getMesagge()]);

            }
            
        return Redirect::back() -> with('mensagge_delete', 'Decano eliminado');
            
    }
}
