<?php

namespace App\Http\Controllers\Comite;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use View;
use App\Classes\Rest;
use Redirect;

use App\Comite;

class LoginController extends Controller
{
    public function __construct()
    {
    
      $this->middleware('guest');
    
    }

    public function getIndex(){

        return View::make('comite.auth.login');

    }

    public function postIndex(Request $request){

        $this->validate($request, [
            
            'username' => 'required|min:4',
            'password' => 'required|min:4',

            ]);

        

        $rest = new Rest();
        $response = $rest->CallAPI('POST', 'http://ryca.itfip.edu.co:8888/profesor/login', 
          [

            'usuario' => strtoupper($request['username']),
            'clave' => $request['password'],
            
          ]);

        $usuario = json_decode($response);

        if($usuario->error == true){

            return Redirect::back()->withInput()->withErrors(['mesagge' => 'Los datos no coinciden con nuestros registros.']);

        }

        try {
            
           $user = Comite::where('cod_user_ryca', $usuario->user->id)->firstOrFail();

        } 
        catch (ModelNotFoundException $e) {
            
          return Redirect::back()->withInput()->withErrors(['mesagge' => 'El usuario no se encuentra como asignado como miembro del comite curricular en el sistema']);
        }

          //valida si se devulve error de la consulta, en cuyo caso no hubo loggin
         
          
          session()->put(['user.name' => $usuario->user->nombres.' '.$usuario->user->apellidos, 'user.token' => $usuario->token, 'user.tipo' => 'comite', 'user.programa' => $user['cod_prog_ryca'], 'user.foto' => $usuario->user->foto]);

          return Redirect::to('/comite/home');  

        }
}
