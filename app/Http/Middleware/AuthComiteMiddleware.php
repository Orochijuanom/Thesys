<?php

namespace App\Http\Middleware;

use Closure;
use Response;

class AuthComiteMiddleware
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

            if (session('user.tipo')=='comite') {
                
                return $next($request);
                
            }else{
                //no es decano

                return response::view('errors/401',array() ,401);

            }
            
        }else{
            //no hay ningun usuario

            return redirect('/comite/login');

        }
    }
}
