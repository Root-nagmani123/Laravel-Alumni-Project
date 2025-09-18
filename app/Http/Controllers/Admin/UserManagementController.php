<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Member, CustomPermissions, CustomRoles, CustomRolePermissionMapping};

class UserManagementController extends Controller
{
    function index()
    {
        // $customPermissions = CustomPermissions::all();
        // $customRoles = CustomRoles::all();
        // $customRolePermissionMappings = CustomRolePermissionMapping::all();
        $moderators = Member::where('is_moderator', true)->paginate(10);
        // 'customPermissions', 'customRoles', 'customRolePermissionMappings', 
        return view('admin.user_management.index', compact('moderators'));
    }

    function searchUser(Request $request)
    {
        $searchTerm = $request->input('search');
        $members = Member::where('name', 'LIKE', '%' . $searchTerm . '%')
            ->where('status', 1)
            ->where('is_moderator', false)
            ->select('name', 'id')
            ->whereRaw('LOWER(service) = ?', ['ias'])
            ->get();
        return response()->json($members);
    }

    function assignRolePermissions(Request $request)
    {
        try {

            $request->validate([
                'user_id' => 'required|exists:members,id',
                // 'role' => 'required|string',
                // 'permissions' => 'nullable|array',
            ]);
            $member = Member::find($request->input('user_id'));
            $member->is_moderator = true;
            $member->moderator_active_inactive = true;
            $member->save();
            // Check already roles & permission exists then delete and add new one
            // if (CustomRolePermissionMapping::where('user_id', $request->input('user_id'))->exists()) {
            //     CustomRolePermissionMapping::where('user_id', $request->input('user_id'))->delete();
            // }

            // // Assign new role and permissions
            // CustomRolePermissionMapping::create([
            //     'user_id' => $request->input('user_id'),
            //     'role_id' => $request->input('role'),
            //     'permission_id' => json_encode($request->input('permissions', [])),
            // ]);

            return redirect()->route('admin.user_management.index')->with('success', 'User marked as moderator successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('admin.user_management.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    function toggleStatus(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:members,id',
            'status' => 'required|boolean',
        ]);

        $member = Member::find($request->input('user_id'));
        if ($member) {
            $member->moderator_active_inactive = $request->input('status');
            $member->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Member not found.'], 404);
        }
    }
}
