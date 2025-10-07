<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'timestamp',
        'username',
        'session_id',
        'referrer_url',
        'process_id',
        'url_accessed',
        'user_agent',
        'country',
        'action_type',
        'request_data',
        'http_method',
        'response_code',
        'error_message',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
        'request_data' => 'array',
    ];

    /**
     * Scope for filtering by action type
     */
    public function scopeActionType($query, $actionType)
    {
        return $query->where('action_type', $actionType);
    }

    /**
     * Scope for filtering by date range
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('timestamp', [$startDate, $endDate]);
    }

    /**
     * Scope for filtering by IP address
     */
    public function scopeIpAddress($query, $ipAddress)
    {
        return $query->where('ip_address', $ipAddress);
    }

    /**
     * Scope for filtering by username
     */
    public function scopeUsername($query, $username)
    {
        return $query->where('username', $username);
    }

    /**
     * Get weekly report data
     */
    public static function getWeeklyReport($startDate = null, $endDate = null)
    {
        $startDate = $startDate ?: Carbon::now()->startOfWeek();
        $endDate = $endDate ?: Carbon::now()->endOfWeek();

        return self::dateRange($startDate, $endDate)
            ->selectRaw('
                DATE(timestamp) as date,
                action_type,
                COUNT(*) as count,
                COUNT(DISTINCT ip_address) as unique_ips,
                COUNT(DISTINCT username) as unique_users
            ')
            ->groupBy('date', 'action_type')
            ->orderBy('date', 'desc')
            ->orderBy('action_type')
            ->get();
    }

    /**
     * Get login attempts summary
     */
    public static function getLoginAttemptsSummary($startDate = null, $endDate = null)
    {
        $startDate = $startDate ?: Carbon::now()->startOfWeek();
        $endDate = $endDate ?: Carbon::now()->endOfWeek();

        return self::dateRange($startDate, $endDate)
            ->whereIn('action_type', ['login_success', 'login_failed'])
            ->selectRaw('
                action_type,
                COUNT(*) as total_attempts,
                COUNT(DISTINCT ip_address) as unique_ips,
                COUNT(DISTINCT username) as unique_users
            ')
            ->groupBy('action_type')
            ->get();
    }

    /**
     * Get top IP addresses by activity
     */
    public static function getTopIpAddresses($limit = 10, $startDate = null, $endDate = null)
    {
        $startDate = $startDate ?: Carbon::now()->startOfWeek();
        $endDate = $endDate ?: Carbon::now()->endOfWeek();

        return self::dateRange($startDate, $endDate)
            ->selectRaw('
                ip_address,
                country,
                COUNT(*) as total_requests,
                COUNT(DISTINCT username) as unique_users,
                MAX(timestamp) as last_activity
            ')
            ->groupBy('ip_address', 'country')
            ->orderBy('total_requests', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get failed login attempts by IP
     */
    public static function getFailedLoginAttemptsByIp($limit = 10, $startDate = null, $endDate = null)
    {
        $startDate = $startDate ?: Carbon::now()->startOfWeek();
        $endDate = $endDate ?: Carbon::now()->endOfWeek();

        return self::dateRange($startDate, $endDate)
            ->actionType('login_failed')
            ->selectRaw('
                ip_address,
                country,
                COUNT(*) as failed_attempts,
                COUNT(DISTINCT username) as unique_usernames,
                MAX(timestamp) as last_attempt
            ')
            ->groupBy('ip_address', 'country')
            ->orderBy('failed_attempts', 'desc')
            ->limit($limit)
            ->get();
    }
}
