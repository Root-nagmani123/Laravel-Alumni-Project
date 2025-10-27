<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        // Generate nonce for inline scripts
        $nonce = base64_encode(random_bytes(16));

        // Share nonce with Blade templates
        view()->share('cspNonce', $nonce);

        $response = $next($request);

        // Basic Security Headers
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=()');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');

        // ✅ Updated and safer CSP
        $csp = [
            "default-src 'self'",

            // Scripts — allow nonce for inline safe scripts (remove unsafe-inline/eval)
            "script-src 'self' 'nonce-{$nonce}' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://code.jquery.com https://www.googletagmanager.com https://www.google.com https://www.gstatic.com https://www.recaptcha.net",

            // Styles — temporarily keep 'unsafe-inline' if inline CSS exists (you can later remove)
            "style-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://fonts.googleapis.com https://cdn.datatables.net https://img1.digitallocker.gov.in",

            // Fonts
            "font-src 'self' data: https://fonts.gstatic.com https://img1.digitallocker.gov.in",

            // Images
            "img-src 'self' data: https://www.googletagmanager.com https://img1.digitallocker.gov.in https://www.google.com https://www.gstatic.com",

            // Frames
            "frame-src 'self' https://www.google.com https://www.gstatic.com https://www.recaptcha.net https://www.youtube.com https://www.youtube-nocookie.com",

            // Connections
            "connect-src 'self' https://www.google-analytics.com https://www.googletagmanager.com https://www.google.com https://www.gstatic.com",
        ];

        $policy = implode('; ', $csp);
        $response->headers->set('Content-Security-Policy', $policy);

        return $response;
    }
}
