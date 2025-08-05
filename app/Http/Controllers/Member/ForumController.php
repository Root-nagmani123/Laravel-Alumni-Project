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
        
        // Check if user has access to this forum
        // if (!$this->forumService->userHasAccessToForum($id, $user->id)) {
        //     return redirect()->route('user.forum')->with('error', 'You do not have access to this forum.');
        // }
        
        // Get topics for this forum
        $topics = $this->forumService->getForumTopics($id);
            
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
}
