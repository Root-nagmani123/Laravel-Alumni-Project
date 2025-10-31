<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function show($path)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized access');
        }

        $fullPath = storage_path('app/private/' . $path);

        if (!file_exists($fullPath)) {
            abort(404, 'File not found');
        }

        return response()->file($fullPath, [
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
        ]);
    }

    public function secureShow($type, $path)
    {
        // Authorization logic by type
        if ($type === 'profile' && !Auth::guard('user')->check()) {
            abort(403, 'Unauthorized for profile');
        }
        // Events and broadcasts should be viewable by both admin and users
        if (in_array($type, ['event', 'broadcast']) && !Auth::guard('admin')->check() && !Auth::guard('user')->check()) {
            abort(403, 'Unauthorized for ' . $type);
        }
        if (in_array($type, ['post', 'story', 'group', 'forum']) && !Auth::guard('user')->check()) { // FIX: use user guard
            abort(403, 'Unauthorized for ' . $type);
        }

        // Try private first (new files), then public (old files) for backward compatibility
        $fullPath = storage_path('app/private/' . $path);
        if (!file_exists($fullPath)) {
            // Fallback to public for old posts/files
            $fullPath = storage_path('app/public/' . $path);
            if (!file_exists($fullPath)) {                // Handle old forum/group images that might be stored as basename only
                if (($type === 'forum' && !str_contains($path, 'uploads/images/forums_img/')) ||
                    ($type === 'group' && !str_contains($path, 'uploads/images/grp_img/'))) {
                    $folderPath = $type === 'forum' ? 'uploads/images/forums_img/' : 'uploads/images/grp_img/';
                    $fullPath = storage_path('app/private/' . $folderPath . $path);
                    if (!file_exists($fullPath)) {
                        $fullPath = storage_path('app/public/' . $folderPath . $path);
                        if (!file_exists($fullPath)) {
                            abort(404, 'File not found');
                        }
                    }
                } else {
                    abort(404, 'File not found');
                }
            }
        }
        return response()->file($fullPath, [
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
        ]);
    }
}
