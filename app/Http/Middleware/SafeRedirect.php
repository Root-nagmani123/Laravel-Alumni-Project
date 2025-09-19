<?php

namespace App\Http\Middleware;

use Closure;

class SafeRedirect
{
    public function handle($request, Closure $next)
    {
        $url = $request->input('redirect');

        if ($url) {
            // Allow only internal URLs
            $allowed = ['alumni.lbsnaa.gov.in', '52.140.75.46', '127.0.0.1', 'localhost'];

            $host = parse_url($url, PHP_URL_HOST);
            if ($host && !in_array($host, $allowed)) {
                abort(403, 'Unauthorized redirect target');
            }
        }

        return $next($request);
    }
}

