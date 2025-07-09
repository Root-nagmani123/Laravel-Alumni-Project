<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    protected $fillable = [
    'title',
    'description',
    'location',
    'start_datetime',
    'end_datetime',
    'created_by',
    'online',
    'url',
    'venue',
    'image',

];

}
