<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Member;
use App\Models\GroupMember; // Added this import
use Carbon\Carbon; // Added this import

class NotificationService
{
    
    //notify all members for event, broadcast
    public function notifyAllMembers(string $type, string $message, $sourceId, $sourceType, $fromUserId = null)
    {
            return $this->createNotification([
                'from_user_id' => $fromUserId ,
                'type'         => $type, // e.g., 'event', 'broadcast'
                'message'      => $message,
                'source_id'    => $sourceId,
                'source_type'  => $sourceType,
                'user_id'     => null, // Means: all users
            ]);
        }

        //member add to group or forum
        public function notifyMemberAdded(array $memberIds, string $type, string $message, $sourceId, string $sourceType, $fromUserId = null)
        {

            return $this->createNotification([
                'from_user_id' => $fromUserId,
                'type'         => $type,
                'message'      => $message,
                'source_id'    => $sourceId,
                'source_type'  => $sourceType,
                'user_id'      => json_encode(array_map('intval', $memberIds)), // int values
            ]);
        }


        //topic added to group or forum
        public function notifyGroupOrForumMembers( $memberIds, $type, $message, $sourceId,  $sourceType, $fromUserId = null)
        {
            
            return Notification::create([
                'from_user_id' => $fromUserId,
                'type'         => $type, // e.g., 'group_add', 'forum_topic'
                'message'      => $message,
                'source_id'    => $sourceId,
                'source_type'  => $sourceType,
                'user_id'     => json_encode($memberIds), // int values
            ]);
        }
        
        
        public function createNotification(array $data): Notification
        {
        return Notification::create([
            'from_user_id' => $data['from_user_id'] ?? null,
            'type'         => $data['type'],
            'message'      => $data['message'],
            'source_id'    => $data['source_id'],
            'source_type'  => $data['source_type'] ,
            'user_id'     => $data['user_id'],
            'is_read'      => false,
        ]);
    }

//like or comment on post
    public function notifyPostOwner(int $postOwnerId, int $fromUserId, string $type, string $message, $sourceId, string $sourceType)
    {

        return $this->createNotification([
            'from_user_id' => $fromUserId,
            'type'         => $type, // 'like' or 'comment'
            'message'      => $message,
            'source_id'    => $sourceId,
            'source_type'  => $sourceType,
            'user_id'     => json_encode([$postOwnerId]),
        ]);
    }

    public function sendBirthdayNotifications()
    {
        $today = Carbon::today()->format('m-d');

        $members = Member::whereNotNull('date_of_birth') // dob = date of birth
            ->whereRaw("DATE_FORMAT(`date_of_birth`, '%m-%d') = ?", [$today])
            ->get();

        foreach ($members as $member) {
            Notification::create([
                'from_user_id' => null,
                'type'         => 'birthday',
                'user_id'      => json_encode([$member->id]),
                'message'      => "🎉 Wishing {$member->name} a very Happy Birthday! May the year ahead be filled with success, good health, and happiness.",
                'source_id'    => $member->id,
                'source_type'  => 'birthday',
                'is_read'      => false,
            ]);
        }

        Member::query()->update(['is_notification' => 0]);
    }

    // Simple notification for group posts
    public function notifyGroupPost(int $groupId, int $fromUserId, string $message, int $postId)
    {
        // Get group members
        $groupMembers = GroupMember::where('group_id', $groupId)
            ->where('status', 1) // Assuming status 1 means active
            ->pluck('member_id')
            ->toArray();

        // Remove the post creator from notification list
        $groupMembers = array_diff($groupMembers, [$fromUserId]);

        if (!empty($groupMembers)) {
            return $this->createNotification([
                'from_user_id' => $fromUserId,
                'type'         => 'group_post',
                'message'      => $message,
                'source_id'    => $postId,
                'source_type'  => 'post',
                'user_id'      => json_encode($groupMembers),
            ]);
        }

        return null;
    }

    public function notifyMentorRequest(int $mentorId, int $fromUserId, string $message, int $requestId)
    {
        return $this->createNotification([
            'from_user_id' => $fromUserId,
            'type'         => 'mentor_request',
            'message'      => $message,
            'source_id'    => $requestId,
            'source_type'  => 'request',
            'user_id'      => json_encode([$mentorId]),
        ]);
    }

    public function notifyMenteeRequest(int $menteeId, int $fromUserId, string $message, int $requestId)
    {
        return $this->createNotification([
            'from_user_id' => $fromUserId,
            'type'         => 'mentee_request',
            'message'      => $message,
            'source_id'    => $requestId,
            'source_type'  => 'request',
            'user_id'      => json_encode([$menteeId]),
        ]);
    }

    public function notifyMentorRequestAccepted(int $mentorId, int $fromUserId, string $message, int $requestId)
    {
        return $this->createNotification([
            'from_user_id' => $fromUserId,
            'type'         => 'mentor_request_accepted',
            'message'      => $message,
            'source_id'    => $requestId,
            'source_type'  => 'request',
            'user_id'      => json_encode([$mentorId]),
        ]);
    }

    public function notifyMenteeRequestAccepted(int $menteeId, int $fromUserId, string $message, int $requestId)
    {
        return $this->createNotification([
            'from_user_id' => $fromUserId,
            'type'         => 'mentee_request_accepted',
            'message'      => $message,
            'source_id'    => $requestId,
            'source_type'  => 'request',
            'user_id'      => json_encode([$menteeId]),
        ]);
    }

    public function notifyMentorRequestRejected(int $mentorId, int $fromUserId, string $message, int $requestId)
    {
        return $this->createNotification([
            'from_user_id' => $fromUserId,
            'type'         => 'mentor_request_rejected',
            'message'      => $message,
            'source_id'    => $requestId,
            'source_type'  => 'request',
            'user_id'      => json_encode([$mentorId]),
        ]);
    }

    public function notifyMenteeRequestRejected(int $menteeId, int $fromUserId, string $message, int $requestId)
    {
        return $this->createNotification([
            'from_user_id' => $fromUserId,
            'type'         => 'mentee_request_rejected',
            'message'      => $message,
            'source_id'    => $requestId,
            'source_type'  => 'request',
            'user_id'      => json_encode([$menteeId]),
        ]);
    }

}