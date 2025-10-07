<?php
/**
 * Debug script for audit logging
 * Run this from the command line: php debug_audit.php
 */

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\AuditLog;
use App\Services\AuditService;
use Illuminate\Http\Request;

echo "=== Audit Logging Debug Script ===\n\n";

// Test 1: Check if audit_logs table exists
try {
    $count = AuditLog::count();
    echo "✅ Audit logs table exists. Current count: {$count}\n";
} catch (Exception $e) {
    echo "❌ Audit logs table does not exist or has issues: " . $e->getMessage() . "\n";
    echo "Please run: php artisan migrate\n";
    exit(1);
}

// Test 2: Create a test audit log entry
try {
    // Create a mock request
    $request = Request::create('/test-audit', 'GET', [], [], [], [
        'HTTP_USER_AGENT' => 'Mozilla/5.0 (Test Browser)',
        'HTTP_REFERER' => 'https://example.com/test-page',
        'REMOTE_ADDR' => '127.0.0.1',
    ]);
    
    // Test audit logging
    AuditService::log('page_access', $request, 'debug_user', [
        'debug_test' => true,
        'timestamp' => now()->toISOString(),
    ]);
    
    echo "✅ Test audit log entry created successfully\n";
} catch (Exception $e) {
    echo "❌ Failed to create test audit log: " . $e->getMessage() . "\n";
}

// Test 3: Check recent audit logs
try {
    $recentLogs = AuditLog::orderBy('id', 'desc')->limit(5)->get();
    echo "\n📊 Recent audit logs:\n";
    foreach ($recentLogs as $log) {
        echo "- ID: {$log->id} | Action: {$log->action_type} | User: " . ($log->username ?: 'Guest') . " | IP: {$log->ip_address} | Referrer: " . ($log->referrer_url ?: 'None') . "\n";
    }
} catch (Exception $e) {
    echo "❌ Failed to retrieve audit logs: " . $e->getMessage() . "\n";
}

// Test 4: Check IP detection
try {
    $request = Request::create('/test', 'GET', [], [], [], [
        'HTTP_X_FORWARDED_FOR' => '203.0.113.1',
        'REMOTE_ADDR' => '127.0.0.1',
    ]);
    
    $reflection = new ReflectionClass('App\Services\AuditService');
    $method = $reflection->getMethod('getClientIpAddress');
    $method->setAccessible(true);
    $ip = $method->invoke(null, $request);
    
    echo "\n🌐 IP Detection Test:\n";
    echo "- Detected IP: {$ip}\n";
    echo "- Expected: 203.0.113.1 (from X-Forwarded-For)\n";
} catch (Exception $e) {
    echo "❌ IP detection test failed: " . $e->getMessage() . "\n";
}

echo "\n=== Debug Complete ===\n";
echo "To test via web browser, visit: /test-audit\n";
echo "To view audit logs in admin: /admin/audit-logs\n";
