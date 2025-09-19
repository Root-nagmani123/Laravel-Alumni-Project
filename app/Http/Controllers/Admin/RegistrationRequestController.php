<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http;


use App\Models\Member;
use App\Models\RegistrationRequest;

class RegistrationRequestController extends Controller
{
    public function index()
    {
        $requests = RegistrationRequest::all();
        return view('admin.registration.index', compact('requests'));
    }
    public function registrationRequestsStore(Request $request)
    {
       $request->validate([
            'name'   => 'required',
            'email'  => 'required|email',
            'mobile' => 'required|digits:10',
            'service'=> 'required',
            'batch'  => 'required',
            'course_attended'  => 'required',
            'photo'  => 'required|file|mimes:jpg,jpeg,png',
            'govt_id'=> 'required|file|mimes:jpg,jpeg,png,pdf',
           'g-recaptcha-response' => 'required',
        ]);
         $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        'secret' => '6LcxQc0rAAAAAN5Wl6h1kH78PHIszwHdLitSdPi8', // apna secret key
        'response' => $request->input('g-recaptcha-response'),
        'remoteip' => $request->ip(),
    ]);

    $result = $response->json();

    if (empty($result['success']) || $result['success'] !== true) {
        return back()->withErrors([
            'captcha' => 'Captcha verification failed. Please try again.'
        ])->withInput();
    }
         $photo = $request->file('photo')->store('profile_pic', 'public');
        $govt_id = $request->file('govt_id')->store('uploads/govt_ids', 'public');

        RegistrationRequest::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'mobile'  => $request->mobile,
            'service' => $request->service,
            'batch'   => $request->batch,
            'cadre'   => $request->cadre,
            'course_attended'  => $request->course_attended,
            'photo'   => $photo,
            'govt_id' => $govt_id,
            'status'  => RegistrationRequest::STATUS_PENDING
        ]);

        return back()->with('success', 'Registration request submitted. Wait for admin approval.');
   
    }

    public function requests_update_status(Request $request, $id)
    {
         $req = RegistrationRequest::findOrFail($id);

        // Update status
        $req->status = $request->status;
        $req->approved_at = now();
        $req->save();

        // If approved → insert into members
        if ($request->status == RegistrationRequest::STATUS_APPROVED) {
            // पहले check कर लें कि यह user पहले से member तो नहीं है
            $exists = Member::where('email', $req->email)->exists();

            if (!$exists) {
                Member::create([
                    'name'    => $req->name,
                    'email'   => $req->email,
                    'mobile'  => $req->mobile,
                    'Service' => $req->service,
                    'batch'   => $req->batch,
                    'cader'   => $req->cadre,
                    'profile_pic'   => $req->photo,
                    'status'  => 1,
                ]);
            }
        }

        return back()->with('success', 'Request status updated successfully.');
     }
  

}