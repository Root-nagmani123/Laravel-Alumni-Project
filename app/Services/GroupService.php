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

            $userIds = $data['member_ids'];
            if (!empty($userIds) && $data['status'] == 1) {
                $memberMessage = $data['group_name'] . ' group has been added as mentiee';
               $notification= $this->notificationService->notifyMemberAdded(
                    $userIds,
                    'group',
                    $memberMessage,
                    $group->id,
                    'group_member'
                );
            }

            if($notification){
                Member::query()->whereIn('id', $userIds)->update(['is_notification' => 0]);
            }

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
        GroupMember::where('group_id', $group->id)->delete();

    // Delete the group itself
    return $group->delete();

    }
}