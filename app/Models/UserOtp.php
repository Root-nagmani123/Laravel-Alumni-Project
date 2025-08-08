<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // ✅ Added this


class UserOtp extends Model
{
     protected $fillable = ['email', 'otp', 'expires_at'];

    protected $dates = ['expires_at'];

   

    public function scopeValid($query)
    {
        return $query->where('expires_at', '>', now());
    }
}
