<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        // create nonce once per request
        $nonce = base64_encode(random_bytes(16));

        // store on request attributes so view composers can read it
        $request->attributes->set('cspNonce', $nonce);

        // do not call view()->share here — we'll use a composer to read request attribute
        $response = $next($request);

        // security headers
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=()');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');

        // build CSP using the same nonce
        $csp = [
            "default-src 'self'",
            "script-src 'self' 'nonce-{$nonce}' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://code.jquery.com https://www.googletagmanager.com https://www.google.com https://www.gstatic.com https://www.recaptcha.net",
            "style-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://fonts.googleapis.com https://cdn.datatables.net https://img1.digitallocker.gov.in",
            "font-src 'self' data: https://fonts.gstatic.com https://img1.digitallocker.gov.in",
            "img-src 'self' data: https://www.googletagmanager.com https://img1.digitallocker.gov.in https://www.google.com https://www.gstatic.com",
            "frame-src 'self' https://www.google.com https://www.gstatic.com https://www.recaptcha.net https://www.youtube.com https://www.youtube-nocookie.com",
            "connect-src 'self' https://www.google-analytics.com https://www.googletagmanager.com https://www.google.com https://www.gstatic.com https://cdnjs.cloudflare.com"
        ];

        $policy = implode('; ', $csp);
        $response->headers->set('Content-Security-Policy', $policy);

        return $response;
    }
}
