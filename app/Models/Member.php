<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'members';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'cader','designation','batch',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function topics()
        {
            return $this->hasMany(Topic::class);
        }

}

//
