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
     */
    private function cleanString(string $input): string
    {
        $value = $input;

        // Remove script and style blocks entirely
        $value = preg_replace('/<script\b[^>]*>[\s\S]*?<\/script>/i', '', $value) ?? $value;
        $value = preg_replace('/<style\b[^>]*>[\s\S]*?<\/style>/i', '', $value) ?? $value;

        // Strip all remaining tags
        $value = strip_tags($value);

        // Neutralize common protocol-based vectors
        $value = preg_replace('/\bjavascript\s*:/i', '', $value) ?? $value;
        $value = preg_replace('/\bvbscript\s*:/i', '', $value) ?? $value;
        $value = preg_replace('/\bdata\s*:[^,]*,?/i', '', $value) ?? $value;

        // Remove inline event handler style patterns that may remain inside strings
        $value = preg_replace('/on[a-zA-Z]+\s*=\s*(\"[^\"]*\"|\'[^\']*\'|[^\s>]+)/i', '', $value) ?? $value;

        // Normalize whitespace
        $value = trim(preg_replace('/\s+/', ' ', $value) ?? $value);

        return $value;
    }
}


