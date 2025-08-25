<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Member;
use App\Models\GroupMember; // Added this import
use Carbon\Carbon; // Added this import

class NotificationService
{
public function notifyAllMembers(string $type, string $message, $sourceId, $sourceType, $fromUserId)
{
    $activeMembers = Member::where('status', 1)->pluck('id');

    $notifications = [];

    foreach ($activeMembers as $userId) {
        $notifications[] = [
            'from_user_id' => $fromUserId,
            'type'         => $type,
            'message'      => $message,
            'source_id'    => $sourceId,
            'source_type'  => $sourceType,
            'user_id'      => $userId,
            'is_read'      => false,
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
    }

    // insert in chunks of 500
    foreach (array_chunk($notifications, 500) as $chunk) {
        Notification::insert($chunk);
    }

    return true;
}



        //old member add to group or forum
        // public function notifyMemberAdded(array $memberIds, string $type, string $message, $sourceId, string $sourceType, $fromUserId)
        // {

        //     return $this->createNotification([
        //         'from_user_id' => $fromUserId,
        //         'type'         => $type,
        //         'message'      => $message,
        //         'source_id'    => $sourceId,
        //         'source_type'  => $sourceType,
        //         'user_id'      =>  $memberIds, // int values
        //     ]);
        // }

        public function notifyMemberAdded($memberIds, string $type, string $message, $sourceId, string $sourceType, $fromUserId)
{
    // Convert single ID → array
    if (!is_array($memberIds)) {
        $memberIds = [$memberIds];
    }

    $createdNotifications = [];

    foreach ($memberIds as $memberId) {
        $createdNotifications[] = $this->createNotification([
            'from_user_id' => $fromUserId,
            'type'         => $type,
            'message'      => $message,
            'source_id'    => $sourceId,
            'source_type'  => $sourceType,
            'user_id'      => (int) $memberId,
        ]);
    }

    return $createdNotifications;
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
            'user_id'     => $postOwnerId,
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

public function notifyGroupPost(int $groupId, int $fromUserId, string $message, int $postId, string $sourceType)
{
    $group = GroupMember::where('group_id', $groupId)->where('status', 1)->first();

    if (!$group) {
        return;
    }

    // Mentor (single int)
    $mentorId = $group->mentor;

    // Mentees (stored JSON/array in DB)
    $mentees = is_string($group->mentiee) 
        ? json_decode($group->mentiee, true) 
        : (array) $group->mentiee;

    // Combine mentor + mentees
    $allMembers = array_merge([$mentorId], $mentees);

    // Remove post creator
    $notifyMembers = array_diff($allMembers, [$fromUserId]);

    // Create notification per user
    foreach ($notifyMembers as $memberId) {
        $this->createNotification([
            'from_user_id' => $fromUserId,
            'type'         => 'group_post',
            'message'      => $message,
            'source_id'    => $postId,
            'source_type'  => $sourceType,
            'user_id'      => (int) $memberId, // ✅ single user per row
        ]);
    }
}


    public function notifyMentorRequest(int $mentorId, int $fromUserId, string $message, int $requestId)
    {
        return $this->createNotification([
            'from_user_id' => $fromUserId,
            'type'         => 'mentor_request',
            'message'      => $message,
            'source_id'    => $requestId,
            'source_type'  => 'request',
            'user_id'      => $mentorId,
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
            'user_id'      => $menteeId,
        ]);
    }

    public function notifyMentorRequestAccepted(int $mentorId, int $fromUserId, string $message, int $requestId)
    {
        return $this->createNotification([
            'from_user_id' => $fromUserId,
            'type'         => 'mentor_request_accepted',
            'message'      => $message,
            'source_id'    => $requestId,
            'source_type'  => 'request_accept',
            'user_id'      => $mentorId,
        ]);
    }

    public function notifyMenteeRequestAccepted(int $menteeId, int $fromUserId, string $message, int $requestId)
    {
        return $this->createNotification([
            'from_user_id' => $fromUserId,
            'type'         => 'mentee_request_accepted',
            'message'      => $message,
            'source_id'    => $requestId,
            'source_type'  => 'request_accept',
            'user_id'      => $menteeId,
        ]);
    }

    public function notifyMentorRequestRejected(int $mentorId, int $fromUserId, string $message, int $requestId)
    {
        return $this->createNotification([
            'from_user_id' => $fromUserId,
            'type'         => 'mentor_request_rejected',
            'message'      => $message,
            'source_id'    => $requestId,
            'source_type'  => 'request_reject',
            'user_id'      => $mentorId,
        ]);
    }

    public function notifyMenteeRequestRejected(int $menteeId, int $fromUserId, string $message, int $requestId)
    {
        return $this->createNotification([
            'from_user_id' => $fromUserId,
            'type'         => 'mentee_request_rejected',
            'message'      => $message,
            'source_id'    => $requestId,
            'source_type'  => 'request_reject',
            'user_id'      => $menteeId,
        ]);
    }


   
    
    public function notifyChatMessage(int $receiverId, int $fromUserId, string $message, int $messageId)
  {
    return $this->createNotification([
        'from_user_id' => $fromUserId,
        'type'         => 'chat_message', // chat-specific type
        'message'      => $message,
        'source_id'    => $messageId,
        'source_type'  => 'chat',
        'user_id'      => $receiverId,
     ]);
  }

}   