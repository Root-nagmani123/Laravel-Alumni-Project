<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ForumService;
use App\Models\Forum;
use App\Models\Member;
use App\Models\ForumTopic;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ForumController extends Controller
{
    protected $forumService;

    public function __construct(ForumService $forumService)
    {
        $this->forumService = $forumService;
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
    function deleteforum(Request $request)
    {
        // Validate the request
        $request->validate([
            'forum_id' => 'required|exists:forums,id',
        ]);

        $forumId = $request->input('forum_id');
        $forum = Forum::find($forumId);

        if (!$forum) {
            return redirect()->back()->with('error', 'Forum not found.');
        }

        $forum->topics()->delete(); // Delete all topics associated with the forum
        $forum->delete(); // Delete the forum itself

        return redirect()->route('user.forum')->with('success', 'Forum deleted successfully!');

    }
}
