<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SanitizeInput
{
    /**
     * Handle an incoming request by implementing strict XSS protection.
     * This middleware now works in conjunction with NoHtmlOrScript validation rule
     * to provide comprehensive protection without modifying user input.
     */
    public function handle(Request $request, Closure $next)
    {
        // In strict mode, we don't sanitize input - we let the validation rules handle rejection
        // This ensures that malicious content is completely blocked rather than modified
        
        // We only perform basic normalization for security headers and logging
        $this->logSuspiciousInput($request);

        return $next($request);
    }

    /**
     * Log potentially suspicious input for security monitoring.
     * This helps with security auditing without modifying the input.
     */
    private function logSuspiciousInput(Request $request): void
    {
        $input = $request->all();
        $suspiciousPatterns = [];
        
        foreach ($input as $key => $value) {
            if (is_string($value)) {
                $suspiciousPatterns = array_merge($suspiciousPatterns, $this->detectSuspiciousPatterns($value, $key));
            }
        }
        
        if (!empty($suspiciousPatterns)) {
            \Log::warning('Suspicious input detected', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'patterns' => $suspiciousPatterns,
                'url' => $request->fullUrl(),
                'method' => $request->method(),
            ]);
        }
    }

    /**
     * Detect suspicious patterns in input for logging purposes.
     */
    private function detectSuspiciousPatterns(string $value, string $field): array
    {
        $patterns = [];
        
        // Check for HTML tags
        if (strip_tags($value) !== $value) {
            $patterns[] = "HTML tags detected in field: {$field}";
        }
        
        // Check for script patterns
        if (preg_match('/<script\b[^>]*>[\s\S]*?<\/script>/i', $value)) {
            $patterns[] = "Script tags detected in field: {$field}";
        }
        
        // Check for JavaScript protocols
        if (preg_match('/\bjavascript\s*:/i', $value)) {
            $patterns[] = "JavaScript protocol detected in field: {$field}";
        }
        
        // Check for SQL injection patterns
        if (preg_match('/(\bunion\b|\bselect\b|\binsert\b|\bupdate\b|\bdelete\b|\bdrop\b|\bcreate\b|\balter\b)\s+/i', $value)) {
            $patterns[] = "SQL injection pattern detected in field: {$field}";
        }
        
        return $patterns;
    }
}


