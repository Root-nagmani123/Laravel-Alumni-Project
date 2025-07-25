<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GroupRequest;
use App\Services\GroupService;
use Illuminate\Http\RedirectResponse;


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

    public function store(GroupRequest $request)
    {
        $group = $this->groupService->create($request->validated());
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Group created successfully.',
                'group' => $group
            ]);
        }
        return redirect()->route('member.groups.index')->with('success', 'Group created successfully.');
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
