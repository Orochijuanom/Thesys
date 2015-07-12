<?php

namespace App\Http\Controllers\Estudiante;

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

        $rest = new Rest();

        $response = $rest->CallAPI('GET', 'http://ryca.itfip.edu.co:8888/programas');

        $programas = json_decode($response,true); 

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

            'usuario' => $request['username'],
            'clave' => $request['password'],
            'programa' => $request['programa'], 

          ]);

          $usuario = json_decode($response);

          //valida si se devulve error de la consulta, en cuyo caso no hubo loggin
          if($usuario->error == true){

            return Redirect::back()->withInput()->withErrors(['mesagge' => 'Los datos no coinciden con nuestros registros.']);

          }

          dd($usuario);

        try {
            
           $user = User::where('username', $request['username'])->firstOrFail();

        } 
        catch (ModelNotFoundException $e) {
            
          return Redirect::back()->withInput()->withErrors(['mesagge' => 'El usuario no se encuentra como administrador en el sistema']);
        }


        session()->put(['user.name' => $usuario->user->nombres.' '.$usuario->user->apellidos, 'user.token' => $usuario->token, 'user.tipo' => 'admin']);

        return Redirect::to('/admin/home');  

        }

      }
