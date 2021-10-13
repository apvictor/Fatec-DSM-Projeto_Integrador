<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:8100');
        $response->header('Access-Control-Allow-Methods', "PUT, POST, DELETE, GET, OPTIONS");
        $response->header('Access-Control-Allow-Headers', "Accept, Authorization, Content-Type");
        return $response;
    }
}
