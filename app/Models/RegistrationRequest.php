<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class RegistrationRequest extends Model
{
    protected $fillable = [
        'name','email','mobile','service','batch','cadre',
        'course_attended','photo','govt_id','status','approved_at'
    ];

    const STATUS_PENDING  = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = 2;
}
