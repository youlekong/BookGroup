<?php

namespace App\Http\Middleware;

use Closure;

class CrossHttp
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
        $response = $next($request);

        $last_host = $_SERVER['HTTP_REFERER'];
        preg_match("/^(http:\/\/)?([^\/]+)/i", $last_host, $matches);
        $response->header('Access-Control-Allow-Origin', "http://{$matches[2]}"); // 允许任意域名发起的跨域请求
//        $response->header('Access-Control-Allow-Origin', $_SERVER['HTTP_ORIGIN']);
        // $response->header('Access-Control-Allow-Origin', 'http://localhost:8080');
        $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept');
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
        $response->header('Access-Control-Allow-Credentials', 'true');

        return $response;

//        return $next($request);
    }
}
