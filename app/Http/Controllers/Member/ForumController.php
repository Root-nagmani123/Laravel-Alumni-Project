<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ForumService;
use App\Models\Forum;
use App\Models\Member;
use App\Models\ForumTopic;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ForumController extends Controller
{
    protected $forumService;
    protected $notificationService;

    public function __construct(ForumService $forumService, NotificationService $notificationService)
    {
        $this->forumService = $forumService;
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        $forums = $this->forumService->getUserForums();
            // print_r($forums);die;
        return view('user.forum', compact('forums'));
    }
    
    public function show($id)
    {
        // $user = $this->forumService->getCurrentUser();
        
        // Get forum details
        $forum = $this->forumService->getForumById($id);
        // print_r($forum);die;
       
        // Get topics for this forum
        $topics = $this->forumService->getForumTopics($id);
            //  print_r($topics);die;
        // Get forums data for left sidebar
        $forums = $this->forumService->getForumsForSidebar();
       
            
        return view('user.forum-detail', compact('forum', 'topics', 'forums'));
    }

    public function like($id)
    {
        $userId = $this->forumService->getCurrentUserId();
        $this->forumService->likeTopic($id, $userId);

        return back();
    }

    public function unlike($id)
    {
        $userId = $this->forumService->getCurrentUserId();
        $this->forumService->unlikeTopic($id, $userId);
        
        return back();
    }

    public function comment(Request $request, $id)
    {
        $this->forumService->validateComment($request);
        
        $userId = $this->forumService->getCurrentUserId();
        $this->forumService->addComment($id, $userId, $request->comment);

        return back();
    }
    public function member_search(Request $request)
    {

        $query = $request->input('q');
        $userId = auth()->guard('user')->id();
      
    $results = Member::where('status', 1)
                 ->where('name', 'LIKE', '%' . $query . '%')
                 ->orderby('name', 'asc')
                 ->get();
                  $results->transform(function ($item) use ($userId) {
        // Check if this member is in favorites
        $isFav = DB::table('favorite_users')
            ->where('user_id', $userId)
            ->where('favorite_user_id', $item->id)
            ->exists();

        $item->encrypted_id = Crypt::encrypt($item->id);
        $item->is_favourite = $isFav ? true : false;
        
        unset($item->id); // optional
        return $item;
    });


    return response()->json($results);
    }
    function member_store_topic(Request $request, $forumId){
       
        $validated = $request->validate([
            'description' => 'required|string',
        ]);

        $userId = Auth::guard('user')->id();
        $topic = ForumTopic::create([
            'forum_id' => $forumId,
            'created_by' => $userId,
            'description' => $validated['description'],
            'created_date' => now(),
            'status' => 1, // Assuming status 1 means active
        ]);

        if ( $topic) {
            $forum = Forum::find($forumId);
            $message = $forum->name . ' - New topic added: ' . $request->input('description');
            $notification = $this->notificationService->notifyAllMembers(
                'forum_topic',
                $message,
                $forumId,
                'forum'
            );
    
            if ($notification) {
                // Update notified_at
                DB::table('forum_topics')->where('id', $topic->id)->update(['notified_at' => 1]);
                Member::query()->update(['is_notification' => 0]);
            }
        }

        return redirect()->back()->with('success', 'Topic saved successfully!');

    }
    function activateForum(Request $request){
        // Validate the request
        $request->validate([
            'forum_id' => 'required|exists:forums,id',
            'end_date' => 'required|date|after_or_equal:today',
        ]);
        $forum = Forum::find($request->input('forum_id'));
        if (!$forum) {
            return redirect()->back()->with('error', 'Forum not found.');
        }
        // Activate the forum
        $forum->end_date = $request->input('end_date');
        $forum->updated_at = now();
        $forum->save();

        return redirect()->back()->with('success', 'Forum activated successfully!');
    }

public function deleteforum(Request $request)
{
    $request->validate([
        'forum_id' => 'required|exists:forums,id',
    ]);

    DB::beginTransaction();

    try {
        $forum = Forum::with('topics')->findOrFail($request->input('forum_id'));

        $forumName = $forum->name;
        $forumId = $forum->id;

        // Delete related topics
        $forum->topics()->delete();

        // Delete forum
         $forum->delete();

        // Notify all members that the forum has been deleted
        $message = $forumName . ' forum has been deleted.';
        $notification = $this->notificationService->notifyAllMembers(
            'forum_deleted',
            $message,
            $forumId,
            'forum'
        );

        if ($notification) {
            Member::query()->update(['is_notification' => 0]);
        }
    

        DB::commit();

        return redirect()->route('user.forum')->with('success', 'Forum deleted successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Failed to delete forum. Please try again.');
    }
}

}
