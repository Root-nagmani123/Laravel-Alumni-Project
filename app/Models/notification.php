<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Notificatio extends Model
{

    use HasFactory;
    protected $fillable = [
        'group_id',
        'status',
        'type',
       // 'created_at',
        'message',
       
    ];
}
