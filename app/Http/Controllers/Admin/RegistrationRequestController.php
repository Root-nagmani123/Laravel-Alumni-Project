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
use App\Rules\NoHtmlOrScript;


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
            'name'   => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email'  => 'required|email',
            'mobile' => 'required|digits:10',
            'service'=> 'required',
            'batch'  => 'required',
            'course_attended'  => 'required',
            'photo'  => 'required|file|mimes:jpg,jpeg,png,gif|max:2048',
            'govt_id'=> 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
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
         $photoFile = $request->file('photo');
        
        // Server-side MIME validation (reads actual file content, not headers)
        $photoMimeType = getSecureMimeType($photoFile);
        $allowedMimes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!$photoMimeType || !in_array($photoMimeType, $allowedMimes)) {
            return back()->withErrors([
                'photo' => 'Invalid file type. Only JPEG, PNG, and GIF images are allowed.'
            ])->withInput();
        }
        
        // Map MIME type to extension (security: don't trust filename extension)
        $extensionMap = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif'
        ];
        $photoExtension = $extensionMap[$photoMimeType];
        $photoFilename = uniqid() . '.' . time() . '.' . $photoExtension;
        $photo = $photoFile->storeAs('profile_pic', $photoFilename, 'public');
        
        $govtIdFile = $request->file('govt_id');
        // Server-side MIME validation for govt_id (reads actual file content, not headers)
        $govtIdMimeType = getSecureMimeType($govtIdFile);
        // Note: PDF detection needs additional checks, but for now use file extension as fallback
        if (!$govtIdMimeType) {
            // If secure detection fails, check if it's a PDF by extension (less secure but better than nothing)
            $govtIdMimeType = $govtIdFile->getMimeType();
        }
        $allowedGovtIdMimes = ['image/jpeg', 'image/png', 'application/pdf'];
        if (!$govtIdMimeType || !in_array($govtIdMimeType, $allowedGovtIdMimes)) {
            return back()->withErrors([
                'govt_id' => 'Invalid file type. Only JPEG, PNG, and PDF files are allowed.'
            ])->withInput();
        }
        
        // Map MIME type to extension (security: don't trust filename extension)
        $govtIdExtensionMap = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'application/pdf' => 'pdf'
        ];
        $govtIdMime = $govtIdExtensionMap[$govtIdMimeType];
        $govtIdFilename = uniqid() . '.' . time() . '.' . $govtIdMime;
        $govt_id = $govtIdFile->storeAs('uploads/govt_ids', $govtIdFilename, 'public');

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