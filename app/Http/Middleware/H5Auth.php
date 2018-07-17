<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Log;

class H5Auth
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
        $uid = $request->cookie('laravel_bg_h5');
        if ( !$uid ) {
            throw new AuthenticationException('Unauthenticated.');
        }

        return $next($request);
    }
}
