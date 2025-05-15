<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens; //commented on 2-5-2025 by Dk

class Admin extends Authenticatable
{
    //use HasApiTokens, HasFactory, Notifiable;//commented on 2-5-2025  Dk
	use HasFactory, Notifiable;

    protected $guard = 'admin';
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'isAdmin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'isAdmin' => 'boolean',
    ];
}
