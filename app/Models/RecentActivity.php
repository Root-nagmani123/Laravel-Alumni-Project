<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Admin;
class RecentActivity extends Model
{
    protected $table = 'recent_activities';
    protected $guarded = [];

    function member()
    {
        return $this->belongsTo(Member::class, 'created_by', 'id');
    }

    function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by', 'id');
    }
}
