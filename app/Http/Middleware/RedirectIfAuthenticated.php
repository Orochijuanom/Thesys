<?php

namespace App\Http\Middleware;

use Closure;


class RedirectIfAuthenticated
{
    
    public function handle($request, Closure $next)
    {
        if (session()->has('user')) {
            return redirect(''.session('user.tipo').'/home');
        }

        return $next($request);
    }
}
