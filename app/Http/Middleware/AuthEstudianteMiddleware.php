<?php

namespace App\Http\Middleware;

use Closure;

class AuthEstudianteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session()->has('user')) {

            if (session('user.tipo')=='estudiante') {
                
                return $next($request);
                
            }else{
                //no es estudiante

                return response::view('errors/401',array() ,401);

            }
            
        }else{
            //no hay ningun usuario

            return redirect('/admin/login');

        }
    }
}
