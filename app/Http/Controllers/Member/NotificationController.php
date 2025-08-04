<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Member;

class NotificationController extends Controller
{

    //get notification for user all related if type event and broad cast then not check user_ids and otherwise check userId not chcek any type 
    public function getNotifications()
    {
        $userId = auth()->id();
    
        $notifications = Notification::where(function ($query) use ($userId) {
            $query->whereIn('type', ['event', 'broadcast']) // show to all users
                  ->orWhere(function ($q) use ($userId) {
                      $q->whereNotIn('type', ['event', 'broadcast'])
                        ->whereJsonContains('user_id', $userId); // user-specific notifications
                  });
        })
        ->orderBy('created_at', 'desc')
        ->get(['id', 'message', 'created_at']);
    
        return response()->json($notifications);
    }

    // user click notification modal then status update memeber table user is_notication 1

    public function markAsSeen($notificationId)
    {
        $userIdsJson = Notification::where('id', $notificationId)->value('user_id'); // fixed key name
        $userIds = json_decode($userIdsJson, true);
    
        if (is_array($userIds)) {
            Member::whereIn('id', $userIds)->update(['is_notification' => 1]);
        }
    
        return redirect()->back(); // or redirect to a meaningful route
    }

    // check page check have notification have or not 
    public function notificationstatus($id)
    {
        $member = Member::find($id);
        
        if ($member && $member->is_notification == 1) {
            // Notification seen
            return response()->json(['status' => 'seen']);
        }

        // No notification
        return response()->json(['status' => 'not_seen']);
    }

}
