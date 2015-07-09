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
use App\Classes\StringManager;


class LoginController extends Controller
{
    
    public function getIndex(){

        return View::make('admin.auth.login');

    }

    public function postIndex(Request $request){

        $this->validate($request, [
            
            'username' => 'required|min:4',
            'password' => 'required|min:4',

            ]);

        try {
            
           $user = User::where('username', $request['username'])->firstOrFail();

        } 
        catch (ModelNotFoundException $e) {
            
          return Redirect::back()->withInput()->withErrors(['mesagge' => 'El usuario no se encuentra como administrador en el sistema']);
        }

        $rest = new Rest();
        $response = $rest->CallAPI('POST', 'http://ryca.itfip.edu.co:8888/estudiante/login', 
          [

            'usuario' => $user['username'],
            'clave' => $request['password'],
            'programa' => 37 

          ]);

          $strign = new StringManager();

          $resultado = $strign->arreglar($response);

          
          //valida si se devulve error de la consulta, en cuyo caso no hubo loggin
          if($resultado['error'] == 'true'){

            return Redirect::back()->withInput()->withErrors(['mesagge' => 'Los datos no coinciden con nuestros registros.']);

          }

          session()->put(['user.name' => $resultado['nombres'].' '.$resultado['apellidos'], 'user.token' => $resultado['token'], 'user.tipo' => 'admin']);


          //ya fue creada la session, queda crear el middleware adecuado y hacer la redireccion al home del admin.
          dd(session());


          dd($resultado);
          return $response;  

        }

      }
