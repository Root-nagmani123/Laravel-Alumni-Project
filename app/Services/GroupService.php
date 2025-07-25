<?php


namespace App\Services;

use App\Models\Group;
use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GroupService

{
    public function index()
    {
        $members = Member::select('*')->get();
        return $members;
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Create Group
            $group = Group::create([
                'name' => $data['name'],
                'status' => $data['status'] ?? 1,
                'created_by' => Auth::guard('member')->id(),
                'member_type' => 'member',
            ]);

            // Create GroupMember entry with mentiee array
            Member::create([
                'group_id' => $group->id,
                'member_id' => Auth::guard('member')->id(),
                'mentiee' => json_encode($data['user_id']),
                'status' => $data['status'] ?? 1,
            ]);

            return $group;
        });
    }

    public function update(Group $group, array $data)
    {
        return $group->update([
            'name' => $data['name'],
            'status' => $data['status'] ?? $group->status,
            'mentiee' => json_encode($data['user_id']),
            
        ]);
    }

    public function delete(Group $group)
    {
        if ($group->status == 1) {
            throw new \Exception("Cannot delete active group.");
        }

        // Optionally delete associated GroupMember entry
        Member::where('group_id', $group->id)->delete();

        return $group->delete();
    }
}