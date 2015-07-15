<?php

namespace App\Http\Middleware;

use Closure;

class AuthDecanoMiddleware
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

            if (session('user.tipo')=='decano') {
                
                return $next($request);
                
            }else{
                //no es decano

                return response::view('errors/401',array() ,401);

            }
            
        }else{
            //no hay ningun usuario

            return redirect('/decano/login');

        }
    }
}
