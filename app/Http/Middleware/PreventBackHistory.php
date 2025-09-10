<?php

namespace App\Http\Middleware;

    
use Closure;

class PreventBackHistory
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // return $response->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
        //                 ->header('Pragma','no-cache')
        //                 ->header('Expires','Sat, 01 Jan 1990 00:00:00 GMT');
        $response->headers->set('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');

        return $response;

    }
}

