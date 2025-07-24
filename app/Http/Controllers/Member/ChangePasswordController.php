<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ChangePasswordRequest;
use App\Services\ChangePasswordService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ChangePasswordController extends Controller
{
    protected $changePasswordService;

    public function __construct(ChangePasswordService $changePasswordService)
    {
        $this->changePasswordService = $changePasswordService;
    }

    /**
     * Show the change password form.
     */
    public function showForm(): View
    {
        return view('user.change_password');
    }

    /**
     * Handle the password change request.
     */
    public function changePassword(ChangePasswordRequest $request): RedirectResponse
    {
        $user = Auth::guard('user')->user();
        $result = $this->changePasswordService->changePassword($user, $request->old_password, $request->new_password);

        if ($result === true) {
            return redirect()->back()->with('success', 'Password changed successfully.');
        } else {
            return redirect()->back()->withErrors(['old_password' => $result]);
        }
    }
}
