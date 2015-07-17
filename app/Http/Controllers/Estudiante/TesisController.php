<?php

namespace App\Http\Controllers\Estudiante;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Linea;
use App\Tipo;
use App\Estado;
use App\Tesi;
use App\Estudiante;

use App\Classes\Rest;
use App\Classes\Buscador;

use View;
use Storage;
use Redirect;

class TesisController extends Controller
{   
    public function __construct()
    {
        $this->middleware('authestudiante');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $estudiante = Estudiante::with('tesis')->where('username', '=', session()->get('user.user'))->first();
        
        $estados = Estado::all();
           
        $rest = new Rest();
        
        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/profesor/activo', 
          [

            'token' => session('user.token')

          ]);

         $profesores = json_decode($response,true);

         $buscador = new Buscador();

        //compara los profesores de ryca con los datos del sistema
        $profesores = $buscador->buscadorProfesores($profesores);

        $buscador->__destruct();

        

        return View::make('estudiante.tesis.index')->with(['estudiante' => $estudiante, 'estados' => $estados, 'profesores' => $profesores]);

        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $lineas = Linea::All();

        $tipos = Tipo::All();

        $rest = new Rest();
        
        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/profesor/activo', 
          [

            'token' => session('user.token')

          ]);

        $profesores = json_decode($response,true);

        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/programas');

        $programas = json_decode($response,true);

        $buscador = new Buscador();

        //formatea los profesores
        $profesores = $buscador->buscadorProfesores($profesores);

        $buscador->__destruct();

        $programas = $buscador->buscadorProgramas($programas);

        $buscador->__destruct();

        return View::make('estudiante.tesis.create')->with(['lineas' => $lineas, 'tipos' => $tipos, 'profesores' => $profesores, 'programas' => $programas]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {   
        
        $this->validate($request,[

            'titulo' => 'required',
            'linea' => 'required',
            'programa' => 'required',
            'semestre' => 'required',
            'profesor' => 'required',
            'tipo' => 'required',
            'files.archivo' => 'mimes:application/pdf'

            ]);

        $ruta = session()->get('user.user').'/'.session()->get('user.programa').'/trabajo.'.$request->file('archivo')->getClientOriginalExtension();
        
       try {
              Storage::put($ruta, file_get_contents($request->file('archivo')->getRealPath()));
     
            } catch (Exception $e) {

                return Redirect::back()->withInput()->withErrors(['mesagge' => 'No se ha podido cargar el archivo.']);

            }

        try {

            $tesis = Tesi::create([

                'titulo' => $request['titulo'],
                'linea_id' => $request['linea'],
                'cod_prog_ryca' => $request['programa'],
                'semestre' => $request['semestre'],
                'director_cod_user_ryca' => $request['profesor'],
                'tipo_id' => $request['tipo'],
                'estado_id' => 1,
                'source' => 'storage/'.$ruta

                ]);

            $estudiante = Estudiante::where('username', '=', session()->get('user.user'))->first();

            $tesis->estudiantes()->attach($estudiante->id); 
            
        } catch (\PDOException $exception) {
           
            return Redirect::back() -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getMessage()]);

        }

        return Redirect::back() -> with('mensagge', 'Trabajo de grado cargado al sistema');        
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $tesis = Tesi::with('estudiantes', 'lineas', 'tipos', 'estados')->where('id', '=', $id)->first();

         $rest = new Rest();
        
        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/profesor/activo', 
          [

            'token' => session('user.token')

          ]);

        $profesores = json_decode($response,true);

        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/programas');

        $programas = json_decode($response,true);

        $buscador = new Buscador();

        $programas = $buscador->buscadorProgramas($programas);

        $buscador->__destruct();

        $profesores = $buscador->buscadorProfesores($profesores);

        $buscador->__destruct();

        return View::make('estudiante.tesis.show')->with(['tesis' => $tesis, 'programas' => $programas, 'profesores' => $profesores]);
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

         $tesis = Tesi::with('estudiantes', 'lineas', 'tipos', 'estados', 'revisiones')->where('id', '=', $id)->first();

        
        $rest = new Rest();
        
        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/profesor/activo', 
          [

            'token' => session('user.token')

          ]);

        $profesores = json_decode($response,true);

        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/programas');

        $programas = json_decode($response,true);

        $buscador = new Buscador();

        $programas = $buscador->buscadorProgramas($programas);

        $buscador->__destruct();

        $profesores = $buscador->buscadorProfesores($profesores);

        $buscador->__destruct();

        return View::make('estudiante.tesis.edit')->with(['tesis' => $tesis, 'programas' => $programas, 'profesores' => $profesores, ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {

         $this->validate($request,[

            'titulo' => 'required',
            'files.archivo' => 'mimes:application/pdf'

            ]);

        $ruta = session()->get('user.user').'/'.session()->get('user.programa').'/trabajo.'.$request->file('archivo')->getClientOriginalExtension();
        
       try {
                
                $test = Storage::put($ruta, file_get_contents($request->file('archivo')->getRealPath()));
                
     
            } catch (Exception $e) {

                return Redirect::back()->withInput()->withErrors(['mesagge' => 'No se ha podido cargar el archivo.']);

            }

        try {

            $tesis = Tesi::find($id);

            $tesis->titulo = $request['titulo'];
            
            $tesis->save();
            
        } catch (\PDOException $exception) {
           
            return Redirect::back() -> withErrors(['mesagge' => 'Ha ocurrido un error en la consulta '.$exception->getMessage()]);

        }

        return Redirect::back() -> with('mensagge', 'Trabajo de grado editado');        

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