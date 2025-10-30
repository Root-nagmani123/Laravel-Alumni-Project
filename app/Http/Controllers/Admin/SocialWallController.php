<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Member; // defining Member model
use App\Models\User;
use App\Models\Post;
use App\Models\Comment; // <-- Add this line
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Rules\NoHtmlOrScript;

use App\Imports\MembersImport;
use Maatwebsite\Excel\Facades\Excel;

class SocialWallController extends Controller
{
   public function index()
        {
            $posts = Post::with('member')
                    ->whereNull('deleted_at')
                    ->orderBy('id', 'DESC')
                    ->get();

        return view('admin.socialwall.index', compact('posts'));
        }

       public function edit(Post $post)
        {
            $post->load('member');
            return view('admin.socialwall.edit', compact('post'));
        }

      public function update(Request $request, Post $post)
{
    $validator = Validator::make($request->all(), [
        'content' => ['required', 'string', 'max:5000', new NoHtmlOrScript()],
        'name' => ['nullable', 'string', 'max:255', new NoHtmlOrScript()],
        'email' => 'nullable|email|max:255',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Update post
    $post->update([
        'content' => $request->input('content'),
    ]);

    // Update related member if exists
    if ($post->member) {
        $post->member->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
    }

    return redirect()->route('socialwall.index')->with('success', 'Post updated successfully.');
}

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('socialwall.index')->with('success', 'Post deleted successfully.');
    }

     public function toggleStatus(Request $request)
    {

        $user = User::findOrFail($request->id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['message' => 'Status updated successfully.']);
    }

    public function togglePostStatus(Request $request)
{
    $post = Post::findOrFail($request->id);
    $post->status = $request->status;
    $post->save();

    return response()->json(['message' => 'Post status updated successfully.']);
}

   public function toggleCommentStatus(Request $request)
{
    $comment = Comment::find($request->id);
    if ($comment) {
        $comment->status = $request->status;
        $comment->save();
        return response()->json(['message' => 'Comment status updated!']);
    }
    return response()->json(['message' => 'Comment not found!'], 404);
}


}