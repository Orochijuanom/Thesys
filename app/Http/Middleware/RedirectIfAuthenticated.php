<?php

namespace App\Http\Middleware;

use Closure;


class RedirectIfAuthenticated
{
    
    public function handle($request, Closure $next)
    {
        if (session()->has('user')) {
            return back();
        }

        return $next($request);
    }
}
