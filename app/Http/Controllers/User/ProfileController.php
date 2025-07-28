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
use App\Models\member;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

   public function showById(Request $request, $id): View
{
    //$user = auth()->guard('user')->user();
    $user = Member::findOrFail($id);

    $userId = $user->id;

         $posts = Post::with(['member', 'media', 'likes', 'comments.member'])
        ->orderBy('created_at', 'desc')
        ->where('member_id', $userId)
        ->get();

    return view('profile', compact('user','posts'));
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

        // Store file in storage/app/public/profile_pic and get the path
        $path = $file->store('profile_pic', 'public'); // saved as storage/app/public/profile_pic/xxxx.jpg

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
        'postgrad_college'   => 'required|string|max:255',
        'postgrad_degree'    => 'required|string|max:255',
        'postgrad_year'      => "required|integer|min:1900|max:$currentYear",
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

    ]);

        $user = Member::findOrFail($id);

        // Update user fields
        $user->fill($validatedData);
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
}
