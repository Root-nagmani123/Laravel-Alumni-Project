<?php

namespace App\Http\Controllers\user;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage; // Make sure this is included at the top
use Illuminate\View\View;
//use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\DB; // For database operations

use App\Models\member;
use App\Models\UserSectordepartment;
use Illuminate\Support\Facades\Crypt; // For encrypting and decrypting IDs


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function showByName($name): View
    {
        $Service_data  = Member::select('Service')->groupBy('Service')->get();
        $departments = config('departments');
        $user = Member::where('name', $name)->first();
        $userId = $user->id;

        $posts = Post::with(['member', 'media', 'likes', 'comments.member'])
       ->orderBy('created_at', 'desc')
       ->where('member_id', $userId)
       ->get();
 $userSectors = UserSectordepartment::where('user_id', $userId)->first();
    $selectedSectors = $userSectors ? $userSectors->sector_departments : [];
   return view('profile', compact('user','posts' ,'departments', 'selectedSectors', 'Service_data'));
    }

   public function showById(Request $request, $encryptedId): View
{
    //$user = auth()->guard('user')->user();
    $id = Crypt::decrypt($encryptedId); 
    $user = Member::findOrFail($id);
$Service_data  = Member::select('Service')->groupBy('Service')->get();
    $userId = $user->id;
 $departments = config('departments');
         $posts = Post::with(['member', 'media', 'likes', 'comments.member'])
        ->orderBy('created_at', 'desc')
        ->where('member_id', $userId)
        ->get();
 $userSectors = UserSectordepartment::where('user_id', $userId)->first();
    $selectedSectors = $userSectors ? $userSectors->sector_departments : [];
    return view('profile', compact('user','posts', 'departments', 'selectedSectors', 'Service_data'));
}

public function showById_data(Request $request, $id): View
{

    //$user = auth()->guard('user')->user();
 $Service_data  = Member::select('Service')->groupBy('Service')->get();

    $id = Crypt::decrypt($id);
    $user = Member::findOrFail($id);

    $userId = $user->id;

         $posts = Post::with(['member', 'media', 'likes', 'comments.member'])
        ->orderBy('created_at', 'desc')
        ->where('member_id', $userId)
        ->where('approved_by_moderator', 1)
        ->where('status', 1)
        ->get();
      $departments = config('departments');

 $userSectors = UserSectordepartment::where('user_id', $userId)->first();
    //$selectedSectors = $userSectors ? json_decode($userSectors->sector_departments, true) : [];
     $selectedSectors = [];
    if ($userSectors && !empty($userSectors->sector_departments)) {
        $selectedSectors = json_decode($userSectors->sector_departments, true);
    }
    return view('profile', compact('user','posts' , 'departments', 'selectedSectors', 'Service_data'));
}
  public function edit($id)
        {
            $member = Member::findOrFail($id);
            return view('profile', compact('member'));
        }


    public function update(Request $request, $id): RedirectResponse
{
    $request->validate([
        'name' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'place_of_birth' => 'required|string',
        'gender' => 'required|in:male,female,other',
        'mobile' => 'required|digits:10',
        'address' => 'required|string',
        'bio' => 'required|string',
        'marital_status' => 'required|in:single,married,divorced',
    ]);

    $user = member::findOrFail($id);

    $user->fill($request->except(['profile_pic']));

    // Handle profile picture upload
    if ($request->hasFile('profile_pic')) {
        $file = $request->file('profile_pic');

        // Store file in storage/app/private/profile_pic and get the path
        $path = $file->store('profile_pic', 'private'); // saved as storage/app/private/profile_pic/xxxx.jpg

        $user->profile_pic = $path;
    }

    $user->save();

    session(['theme' => 'dark']); // or 'light'

    return redirect()->back()->with([
        'success' => 'Profile updated successfully.',
        'active_tab' => 'personal'
    ]);
}

    public function updateEduinfo(Request $request, $id): RedirectResponse
    {
        $currentYear = date('Y');

         $validatedData = $request->validate([
        'school_name'        => 'required|string|max:255',
        'school_year'        => "required|integer|min:1900|max:$currentYear",
        'undergrad_college'  => 'required|string|max:255',
        'undergrad_degree'   => 'required|string|max:255',
        'undergrad_year'     => "required|integer|min:1900|max:$currentYear",
        'postgrad_college'   => 'nullable|string|max:255',
        'postgrad_degree'    => 'nullable|string|max:255',
        'postgrad_year'      => "nullable|integer|min:1900|max:$currentYear",
    ]);

        $user = Member::findOrFail($id);

        // Update user fields
        $user->fill($validatedData);
        $user->save();

        return redirect()->back()->with('success', 'Educational info updated successfully.');
    }

    public function updateProinfo(Request $request, $id): RedirectResponse
    {
        $currentYear = date('Y');

         $validatedData = $request->validate([
        'current_designation'        => 'required|string|max:255',
        'current_department'  => 'required|string|max:255',
        'current_location'   => 'required|string|max:255',
        'previous_postings'     => 'required|string|max:255',
        'service' => 'required|string|max:255',

    ]);

        $user = Member::findOrFail($id);

        // Update user fields
        $user->fill($validatedData);
        // Ensure service and sector are explicitly set even if not fillable
        // Handle potential fillable/case mismatch for `service`
        $user->Service = $validatedData['service'];
        $user->save();

        return redirect()->back()->with('success', 'Professional info updated successfully.');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function updateSocial(Request $request, $id)
    {
        // print_r($request->all());
        // dd($request->all());
        $request->validate([
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'ehrms' => 'nullable|url|max:255',
        ]);

        $user = Member::findOrFail($id);
        $user->facebook = $request->facebook;
        $user->instagram = $request->instagram;
        $user->linkedin = $request->linkedin;
        $user->twitter = $request->twitter;
        $user->ehrms = $request->ehrms;
        $user->save();

        return redirect()->back()->with('success', 'Social media links updated successfully.');
    }

    public function toggleFavorite(Request $request)
{
    $encryptedId = $request->input('id');
    $userId = Crypt::decrypt($encryptedId);

    $currentUserId = auth()->guard('user')->id();

    // Check if already favorite
    $exists = DB::table('favorite_users')
        ->where('user_id', $currentUserId)
        ->where('favorite_user_id', $userId)
        ->exists();

    if ($exists) {
        DB::table('favorite_users')
            ->where('user_id', $currentUserId)
            ->where('favorite_user_id', $userId)
            ->delete();
        
        return response()->json(['status' => 'removed']);
    } else {
        DB::table('favorite_users')->insert([
            'user_id' => $currentUserId,
            'favorite_user_id' => $userId,
            'created_at' => now()
        ]);
        
        return response()->json(['status' => 'added']);
    }
}

function searchFavMembers(Request $request) {
     $currentUserId = auth()->guard('user')->id();
    $favorites = DB::table('favorite_users')
        ->join('members', 'favorite_users.favorite_user_id', '=', 'members.id')
        ->where('favorite_users.user_id', $currentUserId)
        ->select('members.id', 'members.name', 'members.username')
        ->get();

    return response()->json($favorites);
}
function updateSectorDepartments(Request $request, $id){
    $request->validate([
        'sectors' => 'nullable|array',
       
    ]);
    $sectors = $request->input('sectors', []);
    // $sectors should be an array of ['name' => ..., 'departments' => [...]]
    UserSectordepartment::updateOrCreate(
        ['user_id' => $id],
        ['sector_departments' => json_encode($sectors)]
    );

    return redirect()->back()->with('success', 'Sectors and Departments updated successfully.');

}

}
