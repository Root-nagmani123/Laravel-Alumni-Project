<?php

namespace App\Services;

use App\Models\RecentActivity;

class RecentActivityService
{
    public function logActivity(string $title, string $module, int $createdBy, string $activity, int $memberType, $modelId): void
    {
        RecentActivity::create([
            'title' => $title,
            'module' => $module,
            'created_by' => $createdBy,
            'activity' => $activity,
            'member_type' => $memberType,
            'model_id' => $modelId,
            'ip_address' => request()->ip(),
        ]);
    }
}
