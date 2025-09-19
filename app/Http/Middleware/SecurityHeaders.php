<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Add security headers
        $response->headers->set('X-Frame-Options', 'DENY'); // Prevent clickjacking
        $response->headers->set('X-Content-Type-Options', 'nosniff'); // Prevent MIME sniffing
        $response->headers->set('X-XSS-Protection', '1; mode=block'); // Older XSS filter
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=()');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload'); // HSTS

       
      $csp = [
            "default-src 'self'",

            // Scripts
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://code.jquery.com https://www.googletagmanager.com https://www.google.com https://www.gstatic.com https://www.recaptcha.net",

            // Styles
            "style-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://fonts.googleapis.com https://cdn.datatables.net https://img1.digitallocker.gov.in",

            // Fonts (added digitallocker fonts)
            "font-src 'self' data: https://fonts.gstatic.com https://img1.digitallocker.gov.in",

            // Images
            "img-src 'self' data: https://www.googletagmanager.com https://img1.digitallocker.gov.in https://www.google.com https://www.gstatic.com",

            // Frames (Google captcha, analytics, others)
            "frame-src 'self' https://www.google.com https://www.gstatic.com https://www.recaptcha.net https://www.youtube.com https://www.youtube-nocookie.com",


            // Connections (Google Analytics, APIs, etc.)
            "connect-src 'self' https://www.google-analytics.com https://www.googletagmanager.com https://www.google.com https://www.gstatic.com"
        ];

        $response->headers->set('Content-Security-Policy', implode('; ', $csp));

        return $response;
    }
}
