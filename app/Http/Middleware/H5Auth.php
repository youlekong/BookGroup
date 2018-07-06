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
//        if( !session()->get('login_h5') ) {
        if ( !cookie('laravel_bg_h5') ) {
            throw new AuthenticationException('Unauthenticated.');
        }

        return $next($request);
    }
}
