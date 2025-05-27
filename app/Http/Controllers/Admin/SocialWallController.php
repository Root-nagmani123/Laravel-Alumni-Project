<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Member; // defining Member model
use App\Models\User;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Imports\MembersImport;
use Maatwebsite\Excel\Facades\Excel;

class SocialWallController extends Controller
{
    public function index()
    {
       // $users = User::where('is_deleted', 0)->get();
        $users = Topic::all();
        return view('admin.socialwall.index', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('socialwall.index')->with('success', 'User deleted successfully.');
    }


     public function toggleStatus(Request $request)
    {

        $user = User::findOrFail($request->id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['message' => 'Status updated successfully.']);
    }


}
