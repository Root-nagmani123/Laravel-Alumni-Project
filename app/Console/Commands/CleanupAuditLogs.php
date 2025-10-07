<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AuditLog;
use Carbon\Carbon;

class CleanupAuditLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'audit:cleanup {--days=90 : Number of days to keep audit logs}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up old audit logs to prevent database from growing too large';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = $this->option('days');
        $cutoffDate = Carbon::now()->subDays($days);
        
        $this->info("Cleaning up audit logs older than {$days} days (before {$cutoffDate->format('Y-m-d H:i:s')})");
        
        $count = AuditLog::where('timestamp', '<', $cutoffDate)->count();
        
        if ($count === 0) {
            $this->info('No old audit logs found to clean up.');
            return;
        }
        
        if ($this->confirm("Are you sure you want to delete {$count} audit log entries?")) {
            $deleted = AuditLog::where('timestamp', '<', $cutoffDate)->delete();
            $this->info("Successfully deleted {$deleted} audit log entries.");
        } else {
            $this->info('Cleanup cancelled.');
        }
    }
}
