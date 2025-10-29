<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SafeRedirect
{
     public function handle(Request $request, Closure $next)
    {
        $referer = $request->headers->get('referer');

        if ($referer) {
            $host = strtolower(parse_url($referer, PHP_URL_HOST));

            // ✅ Only allow these trusted hosts
            $allowedHosts = ['alumni.lbsnaa.gov.in', '127.0.0.1', 'localhost'];

            // ❌ If host exists and is not in allowed list, block it
            if ($host && !in_array($host, $allowedHosts, true)) {
                    \Log::warning("Blocked external referer: {$referer}");
                    abort(404, 'Access blocked due to external referer.');
                }
        }

        // If no referer header, allow the request (direct access or same-domain POST)
        $response = $next($request);

        // Add standard security headers
        $response->headers->set('Referrer-Policy', 'no-referrer');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        return $response;
    }
}
