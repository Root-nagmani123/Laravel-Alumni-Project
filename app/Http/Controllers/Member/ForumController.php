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

class ForumController extends Controller
{
    protected $forumService;

    public function __construct(ForumService $forumService)
    {
        $this->forumService = $forumService;
    }

    public function index()
    {
        $user = $this->forumService->getCurrentUser();
        $forums = $this->forumService->getUserForums($user->id);
            
        return view('user.forum', compact('forums'));
    }
    
    public function show($id)
    {
        $user = $this->forumService->getCurrentUser();
        
        // Get forum details
        $forum = $this->forumService->getForumById($id);
        
        // Check if user has access to this forum
        if (!$this->forumService->userHasAccessToForum($id, $user->id)) {
            return redirect()->route('user.forum')->with('error', 'You do not have access to this forum.');
        }
        
        // Get topics for this forum
        $topics = $this->forumService->getForumTopics($id);
            
        // Get forums data for left sidebar
        $forums = $this->forumService->getForumsForSidebar($user->id);
            
        return view('user.forum-detail', compact('forum', 'topics', 'user', 'forums'));
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
      
    $results = Member::where('status', 1)
                 ->where('name', 'LIKE', '%' . $query . '%')
                 ->get();

    return response()->json($results);
    }
}
