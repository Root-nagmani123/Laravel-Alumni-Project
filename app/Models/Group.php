<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Group extends Model
{

    use HasFactory;
   /*  protected $fillable = [
        'name',
        'state_id',
        'status',
        'created_by',
        'created_at',
        'createdFrom',
    ]; */
	protected $fillable = [
         'name', 'state_id', 'status', 'created_by', 'member_type','end_date', 'image'
    ];
	
	public function groupMember()
    {
        return $this->hasOne(GroupMember::class);
    }
}
