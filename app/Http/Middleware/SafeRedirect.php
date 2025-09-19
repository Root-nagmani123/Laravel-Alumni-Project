<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SafeRedirect
{
    public function handle(Request $request, Closure $next)
    {
        // Check for URL parameter in request (form input)
        $url = $request->input('url');
        
        // Check for intended URL in session (Laravel's redirect()->intended())
        $intendedUrl = $request->session()->get('url.intended');
        
        // Check for redirect parameter in query string
        $redirectUrl = $request->query('redirect');
        
        // List of allowed domains
        $allowedHosts = ['alumni.lbsnaa.gov.in', '52.140.75.46', '127.0.0.1', 'localhost'];
        
        // Validate URL parameter from form
        if ($url) {
            if (!$this->isUrlAllowed($url, $allowedHosts)) {
                abort(403, 'Unauthorized redirect target');
            }
        }
        
        // Validate intended URL from session
        if ($intendedUrl) {
            if (!$this->isUrlAllowed($intendedUrl, $allowedHosts)) {
                // Clear the intended URL to prevent redirect to unauthorized domain
                $request->session()->forget('url.intended');
                abort(403, 'Unauthorized redirect target');
            }
        }
        
        // Validate redirect parameter from query string
        if ($redirectUrl) {
            if (!$this->isUrlAllowed($redirectUrl, $allowedHosts)) {
                abort(403, 'Unauthorized redirect target');
            }
        }

        return $next($request);
    }
    
    /**
     * Check if the given URL is allowed
     */
    private function isUrlAllowed($url, $allowedHosts)
    {
        // Parse the URL to get the host
        $parsedUrl = parse_url($url);
        
        // If no host is found, it might be a relative URL which is allowed
        if (!isset($parsedUrl['host'])) {
            return true;
        }
        
        $host = $parsedUrl['host'];
        
        // Check if host is in allowed list
        return in_array($host, $allowedHosts);
    }
}

