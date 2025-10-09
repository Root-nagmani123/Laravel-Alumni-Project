<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\AuditService;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;

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
            
            // Special handling for OTP routes - extract email from request data
            if (!$username && in_array($request->route()?->getName(), ['otp.send', 'otp.verify'])) {
                $otpEmail = $request->input('otp_email');
                if ($otpEmail) {
                    // Try to find the user by email to get their username
                    $user = Member::where('email', $otpEmail)->first();
                    if ($user) {
                        $username = $user->username ?: $user->name ?: $user->email;
                    } else {
                        // If user not found, use the email as identifier
                        $username = $otpEmail;
                    }
                }
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
                    'route_name' => $request->route()?->getName(),
                    'otp_email' => $request->input('otp_email'),
                    'is_otp_route' => in_array($request->route()?->getName(), ['otp.send', 'otp.verify']),
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
