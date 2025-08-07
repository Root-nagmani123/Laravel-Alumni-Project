<?php
// app/Models/UserOtp.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserOtp extends Model
{
    protected $fillable = ['user_id', 'otp', 'expires_at'];

    public function isExpired()
    {
        return $this->expires_at < Carbon::now();
    }
}
