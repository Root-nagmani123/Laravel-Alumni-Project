<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomRolePermissionMapping extends Model
{
    protected $table = 'custom_role_permission_mapping';
    protected $guarded = [];
    public $timestamps = false;

    function Member()
    {
        return $this->belongsTo(Member::class, 'user_id', 'id');
    }

    function customRole()
    {
        return $this->belongsTo(CustomRoles::class, 'role_id', 'id');
    }

    function customPermission()
    {
        return $this->belongsTo(CustomPermissions::class, 'permission_id', 'id');
    }
}
