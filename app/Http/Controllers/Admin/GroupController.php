<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use App\Models\Topic;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::all();
        return view('admin.group.index', compact('groups'));
    }
    public function create()
    {
        $users = Member::all();

        return view('admin.group.create', compact('users'));
    }
    public function store(Request $request)
    {
        //Array ( [name] => Dhananjay [mentor_id] => 1 [user_id] => Array ( [0] => 4 [1] => 5 ) [status] => 1 )
         $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'nullable|integer',
            'status' => 'nullable|integer',
            'created_by' => 'nullable|integer',
            'member_type' => 'nullable|integer',
        ]);

       Group::create($request->all());
        return redirect()->route('group.index')->with('success', 'Group created successfully.');
    }
    public function edit(Group $group)
    {
        return view('admin.group.edit', compact('group'));
    }
    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'nullable|integer',
            'status' => 'nullable|integer',
            'created_by' => 'nullable|integer',
            'created_at' => 'nullable|date',
            'member_type' => 'nullable|integer',
        ]);
        $group->update($request->all());
        return redirect()->route('group.index')->with('success', 'Group updated successfully.');
    }
    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->route('group.index')->with('success', 'Group deleted successfully.');
    }

     public function toggleStatus(Request $request)
    {

        $group = Group::findOrFail($request->id);
        $group->status = $request->status;
        $group->save();

        return response()->json(['message' => 'Status updated successfully.']);
    }

     /*  public function add_topic($id)
    {
        $pageName = 'Topic add';
        $group = Group::findOrFail($id);
        //dd($group);
        return view('admin.group.add_topic', compact('group','pageName'));
    }
    */

   public function add_topic($id)
    {
        $group = Group::find($id);
        if (!$group) {
            abort(404, 'Group not found');
        }

        return view('admin.group.add_topic', compact('group', 'id'));
    }

    public function save_topic(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'video_link' => 'nullable|url',
        'video_caption' => 'nullable|string',
        'status' => 'required|integer',
        'doc' => 'nullable|file|mimes:pdf,jpg,png,gif',
        'topic_image' => 'nullable|file|mimes:jpg,png,gif',
    ]);

    $docFile = $request->hasFile('doc') ? $request->file('doc')->store('uploads', 'public') : null;
    $imageFile = $request->hasFile('topic_image') ? $request->file('topic_image')->store('uploads', 'public') : null;

    $embedLink = '';
    if ($request->video_link) {
        parse_str(parse_url($request->video_link, PHP_URL_QUERY), $query);
        $embedLink = isset($query['v']) ? "https://www.youtube.com/embed/" . $query['v'] : '';
    }

    Topic::create([
        'title' => $request->title,
        'description' => $request->description,
        'images' => $imageFile,
        'files' => $docFile,
        'video_link' => $embedLink,
        'video_caption' => $request->video_caption,
        'status' => $request->status,
        'group_id' => $id,
        'created_by' => Auth::id(),
        'created_date' => now(),
    ]);

    return redirect()->route('admin.group.topics_list', ['id' => $id])
        ->with('success', 'Topic added successfully.');
}



    public function view_topic($id)
    {
        $pageName = 'Group';
        $group = Group::findOrFail($id);
        //$topics = Topic::where('group_id', $id)->with('created_by')->get();
        $topics = Topic::where('group_id', $id)->with('created_by')->get();

        return view('admin.group.topics_list', compact('group', 'topics','pageName'));
    }

    /*public function updateTopic(Request $request, $id) {
    $topic = Topic::findOrFail($id);
    $topic->update($request->all());
    return back()->with('success', 'Topic updated.');
    }*/

    public function updateTopic(Request $request, $id) {
    $topic = Topic::findOrFail($id);

    $topic->title = $request->title;
    $topic->description = $request->description;
    $topic->status = $request->status;
     $topic->save();

    return redirect()->back()->with('success', 'Topic updated successfully!');
    }

    public function deleteTopic($id) {
    Topic::destroy($id);
    return back()->with('success', 'Topic deleted.');
}
}
