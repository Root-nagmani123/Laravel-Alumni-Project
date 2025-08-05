<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GroupRequest;
use App\Services\GroupService;
use Illuminate\Http\RedirectResponse;
use App\Models\Group;
use Illuminate\Support\Facades\DB;
use App\Models\GroupMember;



class GroupController extends Controller
{
    protected $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    public function index()
    {
        $members = $this->groupService->index();
        return view('partials.right-sidebar', compact('members'));
    }

    public function create()
    {
        $members = $this->groupService->index();
        return view('partials.right-sidebar', compact('members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'group_name' => 'required|string|max:255',
            
            'mentees' => 'required|array',
            'end_date' => 'required|date',
            'grp_image' => 'required|image|mimes:jpeg,png,jpg|max:1048', // Validate image file
        ]);
        if ($request->hasFile('grp_image')) {
            $imagePath = $request->file('grp_image')->store('uploads/images/grp_img', 'public');
            $data['images'] = basename($imagePath);
        }
        $data_id = DB::table('groups')->insertGetId([
            'name' => $validated['group_name'],
            'image' => $data['images'] ?? null, // Use the image path if it exists
            'end_date' => $validated['end_date'],
            'created_by' => auth('user')->id(),
            'status' => 1, // Assuming status is always 1 for active groups
            'member_type' => 2, // Assuming member_type is always 'member'
            'created_at' => now(),
            'updated_at' => now(),
        ]);

         GroupMember::create([
        'group_id' => $data_id,
        'member_id' => auth('user')->id(),
        'mentor' => auth('user')->id(),
        'mentiee' => json_encode($request->input('mentees')),
        'status' => 1
    ]);

  

        return redirect()->back()->with('success', 'Group created successfully.');
    }

    public function edit(Group $group)
    {
        return view('member.group.edit', compact('group'));
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $this->groupService->update($group, $request->validated());
        return redirect()->route('member.groups.index')->with('success', 'Group updated successfully.');
    }

    public function destroy(Group $group)
    {
        try {
            $this->groupService->delete($group);
            return redirect()->route('member.groups.index')->with('success', 'Group deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('member.groups.index')->with('error', $e->getMessage());
        }
    }
    
}
