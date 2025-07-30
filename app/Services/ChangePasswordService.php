<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;

class ChangePasswordService
{
    /**
     * Change the password for a given user.
     *
     * @param Authenticatable $user
     * @param string $oldPassword
     * @param string $newPassword
     * @return bool|string Returns true on success, or error message string on failure.
     */
    public function changePassword(Authenticatable $user, string $oldPassword, string $newPassword)
    {
        if (!Hash::check($oldPassword, $user->password)) {
            return 'The old password is incorrect.';
        }
        if ($oldPassword === $newPassword) {
            return 'The new password must be different from the old password.';
        }
        $user->password = Hash::make($newPassword);
        $user->save();
        return true;
    }
}
