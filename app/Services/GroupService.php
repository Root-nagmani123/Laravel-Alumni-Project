<?php


namespace App\Services;

use App\Models\Group;
use App\Models\Member;
use App\Models\GroupMember;
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
                'name' => $data['group_name'],
                'status' => $data['status'] ?? 1,
                'created_by' => Auth::guard('user')->id(),
                'member_type' => 2, // 2 = member (as per migration comment)
            ]);

            // Create GroupMember entries for each selected member
            GroupMember::create([
                'group_id' => $group->id,
                'member_id' => Auth::guard('user')->id(),
                'status' => $data['status'] ?? 1,
                'mentiee' => json_encode($data['member_ids']),
            ]);

            return $group;
        });
    }

    public function update(Group $group, array $data)
    {
        return $group->update([
            'name' => $data['group_name'],
            'status' => $data['status'] ?? $group->status,
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