<?php

namespace App\Http\Controllers\Estudiante;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use View;
use App\Estudiante;
use Response;
use Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Classes\Rest;
use App\Classes\Buscador;



class LoginController extends Controller
{
    
    public function __construct()
    {
    
      $this->middleware('guest');
    
    }

    public function getIndex(){

        $rest = new Rest();

        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/programas');

        $programas = json_decode($response,true); 

        $buscador = new Buscador();

        $programas = $buscador->buscadorProgramas($programas);
         
        return View::make('estudiante.auth.login')->with('programas', $programas);

    }

    public function postIndex(Request $request){

      $this->validate($request, [
          
          'username' => 'required|min:4',
          'password' => 'required|min:4',
          'programa' => 'required',

          ]);

      $rest = new Rest();
      
      $response = $rest->CallAPI('POST', 'http://ryca.itfip.edu.co:8888/estudiante/login', 
        [

          'usuario' => strtoupper($request['username']),
          'clave' => $request['password'],
          'programa' => $request['programa'], 

        ]);

      $usuario = json_decode($response);

      //valida si se devulve error de la consulta, en cuyo caso no hubo loggin
      if($usuario->error == true){

        return Redirect::back()->withInput()->withErrors(['mesagge' => 'Los datos no coinciden con nuestros registros.']);

      }

      $usuario = json_decode($response);

      $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/estudiante/'.$usuario->user->codigo.'/prematricula', 
        [

          'token' => $usuario->token,
          
        ]);

        
      $prematricula = json_decode($response,true);
        
      $buscador = new Buscador();

      $prematricula = $buscador->buscadorPrematricula($prematricula);  
        
      if ($prematricula==false) {
          
        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/estudiante/'.$usuario->user->codigo.'/cursadas', 
        [

          'token' => $usuario->token,
          
        ]);

        $cursadas = json_decode($response,true);

        $cursadas = $buscador->buscadorCursadas($cursadas);

        if ($cursadas==false) {
          
          return Redirect::back()->withInput()->withErrors(['mesagge' => 'El usuario no cumple con los requisitos para presetar opción de grado.']);

        }else{

          $estudiante = Estudiante::where('username', '=', $request['username'])->first();
          
          if (!$estudiante) {
            
            Estudiante::create(['username' => $request['username']]);

          }

          session()->put(['user.name' => $usuario->user->nombres.' '.$usuario->user->apellidos, 'user.token' => $usuario->token, 'user.tipo' => 'estudiante', 'user.dni' => $usuario->user->dni, 'user.foto' => $usuario->user->foto, 'user.programa' => $request['programa'], 'user.user' => $request['username']]);

          return Redirect::to('/estudiante/home'); 

        }

      }else{
        
        $estudiante = Estudiante::where('username', '=', $request['username'])->first();
        
        if (!$estudiante) {
            
          Estudiante::create(['username' => $request['username']]);

        }

        session()->put(['user.name' => $usuario->user->nombres.' '.$usuario->user->apellidos, 'user.token' => $usuario->token, 'user.tipo' => 'estudiante', 'user.dni' => $usuario->user->dni, 'user.foto' => $usuario->user->foto, 'user.programa' => $request['programa'], 'user.user' => $request['username']]);
        
        return Redirect::to('/estudiante/home'); 

      }
 
    }
}
