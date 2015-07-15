<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use View;
use App\User;
use Response;
use Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Classes\Rest;



class LoginController extends Controller
{
    
    public function __construct()
    {
    
      $this->middleware('guest');
    
    }

    public function getIndex(){

        return View::make('admin.auth.login');

    }

    public function postIndex(Request $request){

        $this->validate($request, [
            
            'username' => 'required|min:4',
            'password' => 'required|min:4',

            ]);

        $request['username'] = strtoupper($request['username']);

        try {
            
           $user = User::where('username', $request['username'])->firstOrFail();

        } 
        catch (ModelNotFoundException $e) {
            
          return Redirect::back()->withInput()->withErrors(['mesagge' => 'El usuario no se encuentra como administrador en el sistema']);
        }

        $rest = new Rest();
        
        $response = $rest->CallAPI('POST', 'http://ryca.itfip.edu.co:8888/administrativo/login', 
          [

            'usuario' => $user['username'],
            'clave' => $request['password'],
            
          ]);

          $usuario = json_decode($response);

          //valida si se devulve error de la consulta, en cuyo caso no hubo loggin
          if($usuario->error == true){

            return Redirect::back()->withInput()->withErrors(['mesagge' => 'Los datos no coinciden con nuestros registros.']);

          }
          
          session()->put(['user.name' => $usuario->user->nombres.' '.$usuario->user->apellidos, 'user.token' => $usuario->token, 'user.tipo' => 'admin', 'user.foto' => $usuario->user->foto]);

          return Redirect::to('/admin/home');  

        }

      }
