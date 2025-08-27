<?php

namespace App\Observers;
use App\Models\Group;
use Illuminate\Database\Eloquent\Model;
use App\Models\RecentActivity;
class RecentActivityObserver
{
    function relatedActivity(Model $model): string
    {
        return match (get_class($model)) {
            Group::class => 'Group',
            default => '',
        };
    }
    public function created(Model $model): void
    {        
        $relatedActivity = $this->relatedActivity($model);
        RecentActivity::create([
            'title' => $relatedActivity,
            'created_by' => $model->created_by,
            'activity' => 'created',
            'member_type' => $model->member_type,
            'model_id' => $model->id
        ]);
    }
}
