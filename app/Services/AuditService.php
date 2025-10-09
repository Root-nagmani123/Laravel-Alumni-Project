<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class AuditService
{
    /**
     * Log an audit event
     */
    public static function log($actionType, Request $request, $username = null, $additionalData = [])
    {
        try {
            $ipAddress = self::getClientIpAddress($request);
            $country = self::getCountryFromIp($ipAddress);
            
            // Get referrer URL with multiple fallbacks
            $referrerUrl = $request->headers->get('referer') 
                ?: $request->header('referer') 
                ?: $request->server('HTTP_REFERER')
                ?: $request->server('HTTP_REFERER')
                ?: null;
            
            $auditData = [
                'ip_address' => $ipAddress,
                'timestamp' => now(),
                'username' => $username,
                'session_id' => $request->session()->getId(),
                'referrer_url' => $referrerUrl,
                'process_id' => getmypid(),
                'url_accessed' => $request->fullUrl(),
                'user_agent' => $request->userAgent(),
                'country' => $country,
                'action_type' => $actionType,
                'request_data' => self::sanitizeRequestData($request, $additionalData),
                'http_method' => $request->method(),
                'response_code' => $additionalData['response_code'] ?? null,
                'error_message' => $additionalData['error_message'] ?? null,
            ];

            // Debug logging (can be enabled via .env)
            if (config('app.debug_audit', false)) {
                Log::info('Audit Log Debug', [
                    'action_type' => $actionType,
                    'username' => $username,
                    'ip_address' => $ipAddress,
                    'referrer_url' => $referrerUrl,
                    'url_accessed' => $request->fullUrl(),
                    'user_agent' => $request->userAgent(),
                    'session_id' => $request->session()->getId(),
                ]);
            }

            AuditLog::create($auditData);
        } catch (\Exception $e) {
            // Log the error but don't break the application
            Log::error('Audit logging failed: ' . $e->getMessage(), [
                'action_type' => $actionType,
                'ip_address' => $request->ip(),
                'url' => $request->fullUrl(),
                'username' => $username,
                'referrer' => $request->headers->get('referer'),
            ]);
        }
    }

    /**
     * Log successful login
     */
    public static function logSuccessfulLogin(Request $request, $username, $loginMethod = 'admin_panel')
    {
        self::log('login_success', $request, $username, [
            'login_method' => $loginMethod,
            'timestamp' => now()->toISOString(),
        ]);
    }

    /**
     * Log failed login attempt
     */
    public static function logFailedLogin(Request $request, $username = null, $errorMessage = null, $loginMethod = 'admin_panel')
    {
        self::log('login_failed', $request, $username, [
            'error_message' => $errorMessage,
            'login_method' => $loginMethod,
            'timestamp' => now()->toISOString(),
        ]);
    }

    /**
     * Log logout
     */
    public static function logLogout(Request $request, $username)
    {
        self::log('logout', $request, $username, [
            'logout_method' => 'admin_panel',
            'timestamp' => now()->toISOString(),
        ]);
    }

    /**
     * Log page access
     */
    public static function logPageAccess(Request $request, $username = null)
    {
        // Skip logging for certain routes to avoid noise
        $skipRoutes = [
            'admin.audit-logs',
            'admin.audit-reports',
            'admin.audit-export',
        ];

        $currentRoute = $request->route()?->getName();
        if (in_array($currentRoute, $skipRoutes)) {
            return;
        }

        self::log('page_access', $request, $username);
    }

    /**
     * Get client IP address
     */
    private static function getClientIpAddress(Request $request)
    {
        $ipKeys = [
            'HTTP_CF_CONNECTING_IP',     // Cloudflare
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        ];

        foreach ($ipKeys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                $ip = $_SERVER[$key];
                if (strpos($ip, ',') !== false) {
                    $ip = explode(',', $ip)[0];
                }
                $ip = trim($ip);
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                    return $ip;
                }
            }
        }

        return $request->ip();
    }

    /**
     * Get country from IP address using a free service
     */
    private static function getCountryFromIp($ipAddress)
    {
        try {
            // Skip private IPs
            if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
                return 'Private/Local';
            }

            // Use ip-api.com (free, no API key required)
            $response = Http::timeout(5)->get("http://ip-api.com/json/{$ipAddress}?fields=country");
            
            if ($response->successful()) {
                $data = $response->json();
                return $data['country'] ?? 'Unknown';
            }
        } catch (\Exception $e) {
            Log::warning('Failed to get country for IP: ' . $ipAddress . ' - ' . $e->getMessage());
        }

        return 'Unknown';
    }

    /**
     * Sanitize request data to remove sensitive information
     */
    private static function sanitizeRequestData(Request $request, $additionalData = [])
    {
        $data = $request->except([
            'password',
            'password_confirmation',
            'password_salt',
            'g-recaptcha-response',
            '_token',
        ]);

        // Add additional data
        $data = array_merge($data, $additionalData);

        return $data;
    }

    /**
     * Generate weekly report data
     */
    public static function generateWeeklyReport($startDate = null, $endDate = null)
    {
        $startDate = $startDate ?: now()->startOfWeek();
        $endDate = $endDate ?: now()->endOfWeek();

        return [
            'period' => [
                'start' => $startDate->format('Y-m-d'),
                'end' => $endDate->format('Y-m-d'),
            ],
            'summary' => AuditLog::getLoginAttemptsSummary($startDate, $endDate),
            'daily_activity' => AuditLog::getWeeklyReport($startDate, $endDate),
            'top_ips' => AuditLog::getTopIpAddresses(10, $startDate, $endDate),
            'failed_logins' => AuditLog::getFailedLoginAttemptsByIp(10, $startDate, $endDate),
            'total_requests' => AuditLog::dateRange($startDate, $endDate)->count(),
            'unique_ips' => AuditLog::dateRange($startDate, $endDate)->distinct('ip_address')->count(),
            'unique_users' => AuditLog::dateRange($startDate, $endDate)->whereNotNull('username')->distinct('username')->count(),
        ];
    }
}
