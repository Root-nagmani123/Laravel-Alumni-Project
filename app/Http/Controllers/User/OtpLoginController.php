<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\SendOtpMail;
use App\Models\Member;
use App\Models\UserOtp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class OtpLoginController extends Controller
{
public function sendOtp(Request $request)
    {
        // print_r($request->all()); // Debugging line, can be removed later
        // die;
        $request->validate([
            'otp_email' => 'required|email'
        ]);

        // Check if email exists in members table
        $user = Member::where('email', $request->otp_email)->where('status', 1)->first();

        if (!$user) {
            return response()->json(['error' => 'Email not found in our records'], 422);
        }

        // Generate OTP
        $otp = rand(100000, 999999);
        
        // Create or update OTP record
        UserOtp::updateOrCreate(
            ['email' => $request->otp_email],
            ['otp' => $otp, 'expires_at' => now()->addMinutes(10)]
        );

        // Send OTP email
        try {
            //Mail::to($user->email)->send(new SendOtpMail($otp));
            return response()->json(['message' => 'OTP sent successfully ',
                'otp' => $otp // Add this line to return the OTP
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send OTP email: ' . $e->getMessage());
            
            return response()->json([
                'error' => app()->environment('local') 
                    ? $e->getMessage() 
                    : 'Failed to send OTP. Please try again.'
            ], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp_email' => 'required|email',
            'otp_code' => 'required|digits:6',
        ]);

        // Find user
        $user = Member::where('email', $request->otp_email)->first();
        if (!$user) {
            return response()->json(['error' => 'Email not found'], 422);
        }

        // Verify OTP
        $otpRecord = UserOtp::where('email', $request->otp_email)
                           ->where('otp', $request->otp_code)
                           ->where('expires_at', '>=', now())
                           ->first();

        

        if (!$otpRecord) {
            return response()->json(['error' => 'Invalid or expired OTP'], 422);
        }

        // Log in the user
        Auth::guard('user')->login($user);
        $request->session()->regenerate();
        $user->is_online = 1;
        $user->last_seen = now();
        $user->save();
        $otpRecord->delete();
        // return redirect()->intended('/user/feed');

        return response()->json([
            'message' => 'Login successful', 
            'redirect' => route('user.feed')
        ]);
    }
}

