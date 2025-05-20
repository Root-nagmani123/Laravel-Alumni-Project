<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use Notifiable;

    protected $table = 'members';

    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'cader','designation','batch',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}

// 
