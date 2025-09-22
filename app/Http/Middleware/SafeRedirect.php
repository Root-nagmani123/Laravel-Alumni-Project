<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request; 


class SafeRedirect
{
    // public function handle($request, Closure $next)
    // {
    //    $url = $request->input('url');

    //     if ($url) {
    //         // Allow only internal URLs
    //         $allowed = ['alumni.lbsnaa.gov.in', '52.140.75.46', '127.0.0.1', 'localhost'];

    //         $host = parse_url($url, PHP_URL_HOST);
    //         if ($host && !in_array($host, $allowed)) {
    //             abort(403, 'Unauthorized redirect target');
    //         }
    //     }

    //     return $next($request);
    // }


     public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('Referrer-Policy', 'no-referrer'); // or 'same-origin'
        // other header suggestions
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        return $response;
    }
}

