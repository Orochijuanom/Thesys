<?php

namespace App\Http\Controllers\Decano;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use View;
use App\Classes\Rest;
use Redirect;

use App\Decano;

class LoginController extends Controller
{
    public function __construct()
    {
    
      $this->middleware('guest');
    
    }

    public function getIndex(){

        return View::make('decano.auth.login');

    }

    public function postIndex(Request $request){

        $this->validate($request, [
            
            'username' => 'required|min:4',
            'password' => 'required|min:4',

            ]);

        

        $rest = new Rest();
        $response = $rest->CallAPI('POST', 'http://ryca.itfip.edu.co:8888/administrativo/login', 
          [

            'usuario' => $request['username'],
            'clave' => $request['password'],
            
          ]);

        $usuario = json_decode($response);

        if($usuario->error == true){

            return Redirect::back()->withInput()->withErrors(['mesagge' => 'Los datos no coinciden con nuestros registros.']);

        }

        try {
            
           $user = Decano::where('cod_user_ryca', $usuario->user->id)->firstOrFail();

        } 
        catch (ModelNotFoundException $e) {
            
          return Redirect::back()->withInput()->withErrors(['mesagge' => 'El usuario no se encuentra como asignado como decano en el sistema']);
        }

          //valida si se devulve error de la consulta, en cuyo caso no hubo loggin
         
          
          session()->put(['user.name' => $usuario->user->nombres.' '.$usuario->user->apellidos, 'user.token' => $usuario->token, 'user.tipo' => 'decano', 'user.facultad' => $user['cod_facu_ryca'], 'user.foto' => $usuario->user->foto]);

          return Redirect::to('/decano/home');  

        }
}
