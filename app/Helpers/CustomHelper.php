<?php

use Illuminate\Support\Facades\DB;


if (!function_exists('MentorList')) {
    function MentorList()
    {
        $user_id = auth()->guard('user')->user()->id;

    $mentor_connections = DB::table('mentor_requests')
        ->join('members', 'mentor_requests.Mentor_ids', '=', 'members.id')
        ->where('mentor_requests.mentees', $user_id)
        ->select('mentor_requests.id as request_id', 'members.name', 'members.cader as cadre', 'members.batch', 'members.sector','mentor_requests.status')
        ->get();

    return $mentor_connections;
    }
}
if (!function_exists('menteeList')) {
    function menteeList()
    {
       $user_id = auth()->guard('user')->user()->id;    

         $mentee_connections = DB::table('mentee_requests')
        ->join('members', 'mentee_requests.mentees_ids', '=', 'members.id')
        ->where('mentee_requests.mentor', $user_id)
        ->select('mentee_requests.id as request_id', 'members.name', 'members.cader as cadre', 'members.batch', 'members.sector','mentee_requests.status')
        ->get();

    return $mentee_connections;
    }

    

}

/**
 * Get the actual MIME type by reading file content (not headers)
 * This prevents Content-Type header spoofing attacks
 * 
 * @param \Illuminate\Http\UploadedFile $file
 * @return string|null The detected MIME type or null if unable to detect
 */
// if (!function_exists('getSecureMimeType')) {
//     function getSecureMimeType($file)
//     {
//         $path = $file->getRealPath();
        
//         if (!$path || !file_exists($path)) {
//             return null;
//         }

//         // Read first 100 bytes
//         $handle = fopen($path, 'rb');
//         if (!$handle) {
//             return null;
//         }
        
//         // Read first bytes to check magic signature
//         $bytes = fread($handle, 100);
        
//         // IMPORTANT FIX: Reset file pointer so Laravel can read the full file later
//         rewind($handle);
        
//         fclose($handle);
        

//         if (!$bytes || strlen($bytes) < 4) {
//             return null;
//         }

//         // --- MAGIC BYTE VALIDATION (strongest check) ---
//         if (substr($bytes, 0, 3) === "\xFF\xD8\xFF") {   // JPEG
//             return 'image/jpeg';
//         }

//         if (substr($bytes, 0, 8) === "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A") { // PNG
//             return 'image/png';
//         }

//         if (substr($bytes, 0, 4) === "\x47\x49\x46\x38" || 
//             substr($bytes, 0, 4) === "\x47\x49\x46\x39") { // GIF
//             return 'image/gif';
//         }

//         // --- QUICK HTML DETECTION IN FIRST BYTES ---
//         $textContent = strtolower($bytes);

//         $htmlPatterns = [
//             '<html','<!doctype','<script','<?xml','<body','<head',
//             '<div','<span','<p>','<a ','<img','<input','<form',
//             '<style','<meta','<title','<link','<base'
//         ];

//         foreach ($htmlPatterns as $pattern) {
//             if (strpos($textContent, $pattern) !== false) {
//                 return 'text/html';
//             }
//         }

//         if (preg_match('/^\s*<[a-z!?]/i', $bytes)) {
//             return 'text/html';
//         }

//         // --- FILEINFO (secondary check) ---
//         if (function_exists('finfo_open')) {
//             $finfo = finfo_open(FILEINFO_MIME_TYPE);
//             $mimeType = finfo_file($finfo, $path);
//             finfo_close($finfo);

//             if ($mimeType && (
//                 str_contains($mimeType, 'text/html') ||
//                 str_contains($mimeType, 'text/plain') ||
//                 str_contains($mimeType, 'application/xhtml')
//             )) {
//                 return 'text/html';
//             }

//             // Block SVG completely
//             if ($mimeType === 'image/svg+xml') {
//                 return 'text/html';
//             }

//             if ($mimeType && $mimeType !== 'application/octet-stream') {
//                 return $mimeType;
//             }
//         }

//         // --- mime_content_type fallback ---
//         if (function_exists('mime_content_type')) {
//             $mimeType = mime_content_type($path);

//             if ($mimeType && (
//                 str_contains($mimeType, 'text/html') ||
//                 str_contains($mimeType, 'text/plain') ||
//                 str_contains($mimeType, 'application/xhtml')
//             )) {
//                 return 'text/html';
//             }

//             if ($mimeType && $mimeType !== 'application/octet-stream') {
//                 return $mimeType;
//             }
//         }

//         // --- FULL FILE XSS SCAN (VERY IMPORTANT) ---
//         $content = strtolower(file_get_contents($path));

//         if (preg_match('/<script|<html|<!doctype|<body|<head|<svg|javascript:/i', $content)) {
//             return 'text/html';
//         }

//         // If nothing matches, reject
//         return null;
//     }
// }


if (!function_exists('getSecureMimeType')) {
    function getSecureMimeType($file)
    {
        $path = $file->getRealPath();
        if (!$path || !file_exists($path)) {
            return null; // invalid file
        }

        // Read first bytes (magic bytes)
        $handle = fopen($path, 'rb');
        if (!$handle) return null;

        $bytes = fread($handle, 200);

        // IMPORTANT: Reset pointer so image is not corrupted
        rewind($handle);
        fclose($handle);

        if (!$bytes) return null;

        /* ------------------------------------
         | MAGIC BYTE SIGNATURE CHECK (REAL)
         ------------------------------------ */

        // JPEG
        if (substr($bytes, 0, 3) === "\xFF\xD8\xFF") {
            $type = 'image/jpeg';
        }
        // PNG
        elseif (substr($bytes, 0, 8) === "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A") {
            $type = 'image/png';
        }
        // GIF
        elseif (substr($bytes, 0, 4) === "GIF8") {
            $type = 'image/gif';
        }
        else {
            return null; // ❌ Not a real image
        }

        /* ------------------------------------
         | FULL FILE XSS PAYLOAD SCAN
         ------------------------------------ */
        $content = strtolower(file_get_contents($path));

        // Detect malicious tags inside file (Burp injections)
        if (preg_match('/<script|<html|<!doctype|<body|<head|javascript:/i', $content)) {
            return null; // ❌ Reject file
        }

        /* ------------------------------------
         | IMAGE VALIDATION (Integrity Check)
         ------------------------------------ */
        if (!@imagecreatefromstring(file_get_contents($path))) {
            return null; // ❌ corrupted or tampered image
        }

        return $type; // ✔ Safe image
    }
}


