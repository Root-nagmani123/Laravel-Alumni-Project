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
        'name',
        'state_id',
        'status',
        'created_by',
        'member_type',
        'end_date',
        'image',
        'notified_at',
    ];

    public function groupMember()
    {
        return $this->hasOne(GroupMember::class);
    }
    public function members()
    {
        return $this->hasMany(GroupMember::class);
    }

    public function creator()
    {
        return $this->belongsTo(Member::class, 'created_by');
    }

    public function getAllMembersAttribute()
    {
        $memberIds = [];

        if ($this->groupMember) {
            if (!empty($this->groupMember->mentor)) {
                $memberIds[] = $this->groupMember->mentor;
            }

            if (!empty($this->groupMember->mentiee)) {
                $mentieeIds = json_decode($this->groupMember->mentiee, true);
                if (is_array($mentieeIds)) {
                    $memberIds = array_merge($memberIds, $mentieeIds);
                }
            }
        }

        return $memberIds;
    }

}
