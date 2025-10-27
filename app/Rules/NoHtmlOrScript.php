<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NoHtmlOrScript implements ValidationRule
{
    /**
     * Run the validation rule with enhanced XSS protection.
     * This rule implements strict rejection mode - any HTML or JavaScript content is completely blocked.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_string($value)) {
            return;
        }

        // Trim whitespace for validation
        $trimmedValue = trim($value);
        
        // Check if first character is a special character
        if (!empty($trimmedValue) && (preg_match('/^[@#%&*!?<>|\\\\\/$()\\[\\]{}`~=+:;\"]/', $trimmedValue) || preg_match('/^-/', $trimmedValue))) {
            $fail('The :attribute field cannot start with special characters like -, @, #, %, &, *, etc.');
            return;
        }

        // STRICT HTML TAG DETECTION - Any HTML tag is rejected
        if (strip_tags($value) !== $value) {
            $fail('❌ Validation failed — HTML tags or JavaScript are not allowed.');
            return;
        }

        // Enhanced script pattern detection (case insensitive, multiline)
        if (preg_match('/<script\b[^>]*>[\s\S]*?<\/script>/i', $value)) {
            $fail('❌ Validation failed — HTML tags or JavaScript are not allowed.');
            return;
        }

        // Enhanced style block detection
        if (preg_match('/<style\b[^>]*>[\s\S]*?<\/style>/i', $value)) {
            $fail('❌ Validation failed — HTML tags or JavaScript are not allowed.');
            return;
        }

        // Enhanced embedded content detection
        if (preg_match('/<(iframe|object|embed|applet|form|input|textarea|select|button)\b[^>]*>/i', $value)) {
            $fail('❌ Validation failed — HTML tags or JavaScript are not allowed.');
            return;
        }

        // Enhanced JavaScript protocol detection
        if (preg_match('/\bjavascript\s*:/i', $value)) {
            $fail('❌ Validation failed — HTML tags or JavaScript are not allowed.');
            return;
        }

        // Enhanced VBScript protocol detection
        if (preg_match('/\bvbscript\s*:/i', $value)) {
            $fail('❌ Validation failed — HTML tags or JavaScript are not allowed.');
            return;
        }

        // Enhanced data URL detection
        if (preg_match('/\bdata\s*:[^,]*,?/i', $value)) {
            $fail('❌ Validation failed — HTML tags or JavaScript are not allowed.');
            return;
        }

        // Enhanced inline event handler detection
        if (preg_match('/on[a-zA-Z]+\s*=\s*(\"[^\"]*\"|\'[^\']*\'|[^\s>]+)/i', $value)) {
            $fail('❌ Validation failed — HTML tags or JavaScript are not allowed.');
            return;
        }

        // Enhanced CSS expression detection
        if (preg_match('/expression\s*\(/i', $value)) {
            $fail('❌ Validation failed — HTML tags or JavaScript are not allowed.');
            return;
        }

        // Enhanced dangerous character detection (only at start)
        if (!empty($trimmedValue) && preg_match('/^[;&|`$(){}[\]]/', $trimmedValue)) {
            $fail('The :attribute field cannot start with potentially dangerous characters.');
            return;
        }

        // Enhanced SQL injection pattern detection
        if (preg_match('/(\bunion\b|\bselect\b|\binsert\b|\bupdate\b|\bdelete\b|\bdrop\b|\bcreate\b|\balter\b)\s+/i', $value)) {
            $fail('The :attribute field contains potentially dangerous SQL patterns.');
            return;
        }

        // Enhanced null byte and control character detection
        if (preg_match('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', $value)) {
            $fail('The :attribute field contains invalid characters.');
            return;
        }

        // Additional XSS pattern detection
        if (preg_match('/<[^>]*>/', $value)) {
            $fail('❌ Validation failed — HTML tags or JavaScript are not allowed.');
            return;
        }

        // Check for HTML entities that could be used for XSS
        if (preg_match('/&[a-zA-Z0-9#]+;/', $value)) {
            $fail('❌ Validation failed — HTML tags or JavaScript are not allowed.');
            return;
        }

        // Check for encoded script patterns
        if (preg_match('/(%3C|%3c).*script.*(%3E|%3e)/i', $value)) {
            $fail('❌ Validation failed — HTML tags or JavaScript are not allowed.');
            return;
        }

        // Check for Unicode script patterns (using hex representation)
        if (preg_match('/\x3c.*script.*\x3e/i', $value)) {
            $fail('❌ Validation failed — HTML tags or JavaScript are not allowed.');
            return;
        }
    }
}
