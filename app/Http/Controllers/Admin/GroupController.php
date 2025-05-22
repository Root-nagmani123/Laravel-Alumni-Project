<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::all();
        return view('admin.group.index', compact('groups'));
    }
    public function create()
    {
        $users = User::all();

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
}
