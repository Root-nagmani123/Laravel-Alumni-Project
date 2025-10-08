<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\AuditService;
use Illuminate\Support\Facades\Auth;

class AuditLoggingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Get username if user is authenticated
        $username = null;
        try {
            if (Auth::guard('admin')->check()) {
                $admin = Auth::guard('admin')->user();
                $username = $admin->name ?: $admin->email; // Use name or email for admin
            } elseif (Auth::guard('member')->check()) {
                $member = Auth::guard('member')->user();
                $username = $member->username ?: $member->name ?: $member->email;
            } elseif (Auth::guard('web')->check()) {
                $user = Auth::guard('web')->user();
                $username = $user->username ?: $user->name ?: $user->email;
            } elseif (Auth::guard('user')->check()) {
                $user = Auth::guard('user')->user();
                $username = $user->username ?: $user->name ?: $user->email;
            }
            
            // Debug logging for username detection
            if (config('app.debug_audit', false)) {
                \Log::info('Audit Middleware Debug', [
                    'url' => $request->fullUrl(),
                    'username' => $username,
                    'admin_check' => Auth::guard('admin')->check(),
                    'member_check' => Auth::guard('member')->check(),
                    'web_check' => Auth::guard('web')->check(),
                    'user_check' => Auth::guard('user')->check(),
                    'session_id' => $request->session()->getId(),
                ]);
            }
        } catch (\Exception $e) {
            // If there's an error getting user info, continue without username
            $username = null;
            if (config('app.debug_audit', false)) {
                \Log::error('Audit Middleware Error', [
                    'error' => $e->getMessage(),
                    'url' => $request->fullUrl(),
                ]);
            }
        }

        // Log the request
        AuditService::logPageAccess($request, $username);

        $response = $next($request);

        // Log response details if needed
        if ($response->getStatusCode() >= 400) {
            AuditService::log('page_access', $request, $username, [
                'response_code' => $response->getStatusCode(),
                'error_message' => 'HTTP Error: ' . $response->getStatusCode(),
            ]);
        }

        return $response;
    }
}
