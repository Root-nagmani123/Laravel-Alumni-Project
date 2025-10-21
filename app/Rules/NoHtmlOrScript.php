<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NoHtmlOrScript implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_string($value)) {
            return;
        }

        // Check for HTML tags
        if (strip_tags($value) !== $value) {
            $fail('The :attribute field cannot contain HTML tags.');
            return;
        }

        // Check for script patterns
        if (preg_match('/<script\b[^>]*>[\s\S]*?<\/script>/i', $value)) {
            $fail('The :attribute field cannot contain JavaScript code.');
            return;
        }

        // Check for style blocks
        if (preg_match('/<style\b[^>]*>[\s\S]*?<\/style>/i', $value)) {
            $fail('The :attribute field cannot contain CSS code.');
            return;
        }

        // Check for iframe, object, embed tags
        if (preg_match('/<(iframe|object|embed|applet)\b[^>]*>/i', $value)) {
            $fail('The :attribute field cannot contain embedded content tags.');
            return;
        }

        // Check for JavaScript protocols
        if (preg_match('/\bjavascript\s*:/i', $value)) {
            $fail('The :attribute field cannot contain JavaScript protocols.');
            return;
        }

        // Check for VBScript protocols
        if (preg_match('/\bvbscript\s*:/i', $value)) {
            $fail('The :attribute field cannot contain VBScript protocols.');
            return;
        }

        // Check for data URLs
        if (preg_match('/\bdata\s*:[^,]*,?/i', $value)) {
            $fail('The :attribute field cannot contain data URLs.');
            return;
        }

        // Check for inline event handlers
        if (preg_match('/on[a-zA-Z]+\s*=\s*(\"[^\"]*\"|\'[^\']*\'|[^\s>]+)/i', $value)) {
            $fail('The :attribute field cannot contain event handlers.');
            return;
        }

        // Check for CSS expressions
        if (preg_match('/expression\s*\(/i', $value)) {
            $fail('The :attribute field cannot contain CSS expressions.');
            return;
        }

        // Check for dangerous characters that could be used for injection
        if (preg_match('/[;&|`$(){}[\]]/', $value)) {
            $fail('The :attribute field contains potentially dangerous characters.');
            return;
        }

        // Check for SQL injection patterns
        if (preg_match('/(\bunion\b|\bselect\b|\binsert\b|\bupdate\b|\bdelete\b|\bdrop\b|\bcreate\b|\balter\b)\s+/i', $value)) {
            $fail('The :attribute field contains potentially dangerous SQL patterns.');
            return;
        }

        // Check for null bytes and control characters
        if (preg_match('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', $value)) {
            $fail('The :attribute field contains invalid characters.');
            return;
        }
    }
}
