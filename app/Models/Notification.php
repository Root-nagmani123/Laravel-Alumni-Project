<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';

    use HasFactory;
    protected $fillable = [
        'user_id',
        'from_user_id',
        'type',
        'source_id',
        'source_type',
        'message',
        'is_read',
    ];
}
