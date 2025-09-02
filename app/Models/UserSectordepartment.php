<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSectordepartment extends Model
{
    use HasFactory;

   protected $table = 'user_sectors_departments';
   public $timestamps = false;

    protected $fillable = [
        'user_id',
        'sector_departments',
    ];

    protected $casts = [
        'sector_departments' => 'array', // JSON auto decode/encode
    ];
}