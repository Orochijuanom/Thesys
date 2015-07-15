<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classes\Rest;
use App\Classes\Buscador;
use App\Comite;

use View;
use Redirect;

class ComitesController extends Controller
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
        
        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/profesor/activo', 
          [

            'token' => session('user.token')

          ]);

        $profesores = json_decode($response,true);

        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/programas', 
          [

            'token' => session('user.token')

          ]);

        $programas = json_decode($response,true);  
        
        $comites = Comite::all();

        $buscador = new Buscador();

        //compara los profesores de ryca con los datos del sistema
        $profesores = $buscador->buscadorProfesor($profesores, $comites);

        $buscador->__destruct();

        $programas = $buscador->buscadorPrograma($programas, $comites);
        
        $buscador->__destruct();
        
        return View::make('admin.comites.index')->with(['profesores' => $profesores, 'programas' => $programas, 'comites' => $comites]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $rest = new Rest();
        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/profesor/activo', 
          [

            'token' => session('user.token')

          ]);

        $profesores = json_decode($response,true);

        $buscador = new Buscador();

        //formatea los profesores
        $profesores = $buscador->buscadorProfesores($profesores);

        $buscador->__destruct();

        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/programas');

        $programas = json_decode($response,true);

        $programas = $buscador->buscadorProgramas($programas); 
        
        return View::make('admin.comites.create')->with(['profesores' => $profesores, 'programas' => $programas]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[

            'profesor' => 'required',
            'programa' => 'required'

            ]);

        try {

            $comite = Comite::create([

                'cod_user_ryca' => $request['profesor'],
                'cod_prog_ryca' => $request['programa']

                ]);
            
        } catch (\PDOException $exception) {
           
            return Redirect::back() -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getMessage()]);

        }

        return Redirect::back() -> with('mensagge', 'Docente asignado como representante del comite curricular');

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

                $comite = Comite::findOrFail($id);
                
            } catch (Exception $e) {

                return Response::view('errors/404', array(), 404);
                
            }

            try {

                $comite -> delete();
                
            } catch (\PDOException $exception) {
                
                return Redirect::back() -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getMesagge()]);

            }
            
        return Redirect::back() -> with('mensagge_delete', 'Miembro del comite curricular eliminado');

    }
}
