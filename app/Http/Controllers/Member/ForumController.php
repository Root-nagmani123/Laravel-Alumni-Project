<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\ForumTopic;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ForumController extends Controller
{
    public function index()
    {
        // Get all forums that thecurrent user has access to
        $user = Auth::guard('user')->user();
        
        $forums = DB::table('forums as f')
            ->join('forum_topics as ft', 'ft.forum_id', '=', 'f.id')
            ->join('forums_member as fm', 'fm.forums_id', '=', 'f.id')
            ->select('f.id', 'f.name','ft.id as topic_id', 'ft.title as topic_name', 'ft.description','ft.images','ft.created_date')
            ->where('fm.user_id', $user->id)
            ->where('f.status', 1)
            ->orderBy('f.id', 'desc')
            ->get();
            
        return view('user.forum', compact('forums'));
    }
    
    public function show($id)
    {
        $user = Auth::guard('user')->user();
        
        // Get forum details
        $forum = Forum::findOrFail($id);
        
        // Check if user has access to this forum
        $hasAccess = DB::table('forums_member')
            ->where('forums_id', $id)
            ->where('user_id', $user->id)
            ->where('status', 1)
            ->exists();
            
        if (!$hasAccess) {
            return redirect()->route('user.forum')->with('error', 'You do not have access to this forum.');
        }
        
        // Get topics for this forum (only active topics)
        $topics = ForumTopic::where('forum_id', $id)
            ->where('status', 1)
            ->orderBy('created_date', 'desc')
            ->with('creator')
            ->get();
            
        // Get forums data for left sidebar
        $forums = DB::table('forums as f')
            ->join('forum_topics as ft', 'ft.forum_id', '=', 'f.id')
            ->join('forums_member as fm', 'fm.forums_id', '=', 'f.id')
            ->select('f.id', 'f.name','ft.id as topic_id', 'ft.title as topic_name', 'ft.description','ft.images','ft.created_date')
            ->where('fm.user_id', $user->id)
            ->where('f.status', 1)
            ->orderBy('f.id', 'desc')
            ->get();
            
        return view('user.forum-detail', compact('forum', 'topics', 'user', 'forums'));
    }
}
