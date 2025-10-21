<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SanitizeInput
{
    /**
     * Handle an incoming request by stripping HTML/JS from all scalar inputs.
     */
    public function handle(Request $request, Closure $next)
    {
        $cleanInput = $this->sanitizeValue($request->all());

        // Merge sanitized values back into the request
        $request->merge($cleanInput);

        return $next($request);
    }

    /**
     * Recursively sanitize a value or array of values.
     *
     * - Keeps UploadedFile instances intact
     * - Leaves non-string scalars as-is
     * - For strings, removes tags and common script/vector patterns
     */
    private function sanitizeValue(mixed $value): mixed
    {
        if (is_array($value)) {
            $sanitized = [];
            foreach ($value as $key => $item) {
                $sanitized[$key] = $this->sanitizeValue($item);
            }
            return $sanitized;
        }

        if ($value instanceof UploadedFile) {
            return $value; // do not alter file uploads
        }

        if (is_string($value)) {
            $sanitizedString = $this->cleanString($value);
            return $sanitizedString;
        }

        // integers, floats, booleans, null
        return $value;
    }

    /**
     * Remove HTML tags, script/style blocks, event handlers, and js-like protocols.
     * Enhanced with stricter validation and comprehensive XSS protection.
     */
    private function cleanString(string $input): string
    {
        $value = $input;

        // Remove script and style blocks entirely (case insensitive)
        $value = preg_replace('/<script\b[^>]*>[\s\S]*?<\/script>/i', '', $value) ?? $value;
        $value = preg_replace('/<style\b[^>]*>[\s\S]*?<\/style>/i', '', $value) ?? $value;
        $value = preg_replace('/<iframe\b[^>]*>[\s\S]*?<\/iframe>/i', '', $value) ?? $value;
        $value = preg_replace('/<object\b[^>]*>[\s\S]*?<\/object>/i', '', $value) ?? $value;
        $value = preg_replace('/<embed\b[^>]*>/i', '', $value) ?? $value;
        $value = preg_replace('/<applet\b[^>]*>[\s\S]*?<\/applet>/i', '', $value) ?? $value;

        // Remove all HTML tags completely
        $value = strip_tags($value);

        // Neutralize common protocol-based vectors
        $value = preg_replace('/\bjavascript\s*:/i', '', $value) ?? $value;
        $value = preg_replace('/\bvbscript\s*:/i', '', $value) ?? $value;
        $value = preg_replace('/\bdata\s*:[^,]*,?/i', '', $value) ?? $value;
        $value = preg_replace('/\babout\s*:/i', '', $value) ?? $value;
        $value = preg_replace('/\bfile\s*:/i', '', $value) ?? $value;

        // Remove inline event handler patterns
        $value = preg_replace('/on[a-zA-Z]+\s*=\s*(\"[^\"]*\"|\'[^\']*\'|[^\s>]+)/i', '', $value) ?? $value;
        
        // Remove dangerous CSS expressions
        $value = preg_replace('/expression\s*\(/i', '', $value) ?? $value;
        $value = preg_replace('/url\s*\(\s*[\'"]?javascript:/i', '', $value) ?? $value;
        
        // Remove SQL injection patterns
        $value = preg_replace('/(\bunion\b|\bselect\b|\binsert\b|\bupdate\b|\bdelete\b|\bdrop\b|\bcreate\b|\balter\b)\s+/i', '', $value) ?? $value;
        
        // Remove potential command injection patterns
        $value = preg_replace('/[;&|`$(){}[\]]/', '', $value) ?? $value;
        
        // Remove potential XSS patterns
        $value = preg_replace('/<[^>]*>/', '', $value) ?? $value;
        $value = preg_replace('/&[a-zA-Z0-9#]+;/', '', $value) ?? $value;
        
        // Remove null bytes and control characters
        $value = str_replace(["\0", "\x00", "\x1a"], '', $value);
        $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $value) ?? $value;

        // Normalize whitespace
        $value = trim(preg_replace('/\s+/', ' ', $value) ?? $value);

        return $value;
    }
}


