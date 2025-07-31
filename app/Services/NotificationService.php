<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Member;

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
           


    public function createNotification(array $data): Notification
    {
        return Notification::create([
            'from_user_id' => $data['from_user_id'] ?? null,
            'type'         => $data['type'],
            'message'      => $data['message'],
            'source_id'    => $data['source_id'],
            'source_type'  => $data['source_type'] ,
            'user_id'     => isset($data['user_id']) ? json_encode($data['user_id']) : null,
            'is_read'      => false,
        ]);
    }



    public function notifyGroupOrForumMembers(array $memberIds, string $type, string $message, $sourceId, string $sourceType, $fromUserId = null)
    {
        return $this->createNotification([
            'from_user_id' => $fromUserId,
            'type'         => $type, // e.g., 'group_add', 'forum_topic'
            'message'      => $message,
            'source_id'    => $sourceId,
            'source_type'  => $sourceType,
            'user_id'     => $memberIds,
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
            'user_id'     => [$postOwnerId],
        ]);
    }

}