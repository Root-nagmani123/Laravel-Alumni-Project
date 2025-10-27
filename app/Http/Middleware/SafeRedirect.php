<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SafeRedirect
{
    public function handle(Request $request, Closure $next)
    {
        // Check for redirect or URL parameters that could be abused
        $redirectUrl = $request->input('url') ?? $request->input('redirect_to');

        if ($redirectUrl) {
            // Allow only your own trusted domains
            $allowedHosts = [
                'alumni.lbsnaa.gov.in',
                '52.140.75.46',
                '127.0.0.1',
                'localhost',
            ];

            $host = parse_url($redirectUrl, PHP_URL_HOST);

            // If external host is not allowed, block the redirect
            if ($host && !in_array($host, $allowedHosts)) {
                abort(403, 'Unauthorized redirect target');
            }

            // Optional: if no host (relative URL like /dashboard), allow it
            if (!$host && str_starts_with($redirectUrl, '/')) {
                // safe, continue
            }
        }

        $response = $next($request);

        // Security headers
        $response->headers->set('Referrer-Policy', 'no-referrer');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        return $response;
    }
}
