<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Services\AuditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuditLogController extends Controller
{
    public function __construct()
    {
        // Middleware is applied in routes
    }

    /**
     * Display audit logs with filtering
     */
    public function index(Request $request)
    {
        $query = AuditLog::query();

        // Apply filters
        if ($request->filled('action_type')) {
            $query->where('action_type', $request->action_type);
        }

        if ($request->filled('username')) {
            if (strtolower($request->username) === 'guest') {
                // Filter for guest users (NULL username)
                $query->whereNull('username');
            } elseif (strtolower($request->username) === 'otp') {
                // Filter for OTP users
                $query->where('username', 'like', 'OTP:%');
            } else {
                // Filter for regular users
                $query->where('username', 'like', '%' . $request->username . '%');
            }
        }

        if ($request->filled('ip_address')) {
            $query->where('ip_address', 'like', '%' . $request->ip_address . '%');
        }

        if ($request->filled('date_from')) {
            $query->whereDate('timestamp', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('timestamp', '<=', $request->date_to);
        }

        if ($request->filled('country')) {
            $query->where('country', 'like', '%' . $request->country . '%');
        }

        // Order by timestamp desc
        $query->orderBy('timestamp', 'desc');

        // Paginate results
        $auditLogs = $query->paginate(50);

        // Get filter options
        $actionTypes = AuditLog::distinct('action_type')->pluck('action_type');
        $countries = AuditLog::distinct('country')->whereNotNull('country')->pluck('country');
        $ipAddresses = AuditLog::distinct('ip_address')->whereNotNull('ip_address')->orderBy('ip_address')->pluck('ip_address');

        return view('admin.audit-logs.index', compact('auditLogs', 'actionTypes', 'countries', 'ipAddresses'));
    }

    /**
     * Show detailed view of a specific audit log
     */
    public function show($id)
    {
        $auditLog = AuditLog::findOrFail($id);
        return view('admin.audit-logs.show', compact('auditLog'));
    }

    /**
     * Display weekly reports
     */
    public function weeklyReport(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfWeek());
        $endDate = $request->get('end_date', Carbon::now()->endOfWeek());

        if (is_string($startDate)) {
            $startDate = Carbon::parse($startDate);
        }
        if (is_string($endDate)) {
            $endDate = Carbon::parse($endDate);
        }

        $reportData = AuditService::generateWeeklyReport($startDate, $endDate);

        return view('admin.audit-logs.weekly-report', compact('reportData', 'startDate', 'endDate'));
    }

    /**
     * Export audit logs to CSV
     */
    public function export(Request $request)
    {
        $query = AuditLog::query();

        // Apply same filters as index
        if ($request->filled('action_type')) {
            $query->where('action_type', $request->action_type);
        }

        if ($request->filled('username')) {
            if (strtolower($request->username) === 'guest') {
                // Filter for guest users (NULL username)
                $query->whereNull('username');
            } elseif (strtolower($request->username) === 'otp') {
                // Filter for OTP users
                $query->where('username', 'like', 'OTP:%');
            } else {
                // Filter for regular users
                $query->where('username', 'like', '%' . $request->username . '%');
            }
        }

        if ($request->filled('ip_address')) {
            $query->where('ip_address', 'like', '%' . $request->ip_address . '%');
        }

        if ($request->filled('date_from')) {
            $query->whereDate('timestamp', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('timestamp', '<=', $request->date_to);
        }

        if ($request->filled('country')) {
            $query->where('country', 'like', '%' . $request->country . '%');
        }

        $auditLogs = $query->orderBy('timestamp', 'desc')->get();

        $filename = 'audit_logs_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($auditLogs) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'ID',
                'Timestamp',
                'IP Address',
                'Username',
                'Action Type',
                'URL Accessed',
                'User Agent',
                'Country',
                'Session ID',
                'Referrer URL',
                'Process ID',
                'HTTP Method',
                'Error Message'
            ]);

            // CSV data
            foreach ($auditLogs as $log) {
                fputcsv($file, [
                    $log->id,
                    $log->timestamp->format('Y-m-d H:i:s'),
                    $log->ip_address,
                    $log->username,
                    $log->action_type,
                    $log->url_accessed,
                    $log->user_agent,
                    $log->country,
                    $log->session_id,
                    $log->referrer_url,
                    $log->process_id,
                    $log->http_method,
                    $log->error_message
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get statistics for dashboard
     */
    public function getStatistics(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfWeek());
        $endDate = $request->get('end_date', Carbon::now()->endOfWeek());

        if (is_string($startDate)) {
            $startDate = Carbon::parse($startDate);
        }
        if (is_string($endDate)) {
            $endDate = Carbon::parse($endDate);
        }

        $stats = [
            'total_requests' => AuditLog::dateRange($startDate, $endDate)->count(),
            'unique_ips' => AuditLog::dateRange($startDate, $endDate)->distinct('ip_address')->count(),
            'unique_users' => AuditLog::dateRange($startDate, $endDate)->whereNotNull('username')->distinct('username')->count(),
            'successful_logins' => AuditLog::dateRange($startDate, $endDate)->where('action_type', 'login_success')->count(),
            'failed_logins' => AuditLog::dateRange($startDate, $endDate)->where('action_type', 'login_failed')->count(),
            'logouts' => AuditLog::dateRange($startDate, $endDate)->where('action_type', 'logout')->count(),
            'otp_sends' => AuditLog::dateRange($startDate, $endDate)->where('action_type', 'otp_send')->count(),
            'otp_verifies' => AuditLog::dateRange($startDate, $endDate)->where('action_type', 'otp_verify')->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Get failed login attempts for security monitoring
     */
    public function getFailedLogins(Request $request)
    {
        $limit = $request->get('limit', 20);
        $startDate = $request->get('start_date', Carbon::now()->subDays(7));
        $endDate = $request->get('end_date', Carbon::now());

        if (is_string($startDate)) {
            $startDate = Carbon::parse($startDate);
        }
        if (is_string($endDate)) {
            $endDate = Carbon::parse($endDate);
        }

        $failedLogins = AuditLog::getFailedLoginAttemptsByIp($limit, $startDate, $endDate);

        return response()->json($failedLogins);
    }
}
