<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use LdapRecord\Container;
use Illuminate\Support\Facades\Crypt;
use App\Models\Member;

use LdapRecord\Models\ActiveDirectory\User as LdapUser;

class AuthController extends Controller
{
    
    public function showLoginForm()
    {

        if (Auth::guard('user')->check()) {
            return redirect()->route('user.feed');
        }
    $services = Member::selectRaw('DISTINCT(TRIM(UPPER(Service))) as Service')
    ->whereNotNull('Service')
    ->orderBy('Service', 'asc')
    ->pluck('Service');


       /*  return redirect()->route('user.feed1'); */
		 return view('user.auth.login', compact('services'));
    }
    function showLoginForm_ldap(){
        return view('user.auth.login_ldap');
    }



 public function login_bkp(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    $username = $request->input('username');
    $password = $request->input('password');
    $serverHost = $request->getHost(); // e.g., localhost or production domain

    try {
        if (in_array($serverHost, ['localhost', '127.0.0.1', 'dev.local'])) {
            // 👨‍💻 Localhost: Normal DB-based login
            $user = \App\Models\Member::where('username', $username)
                        ->where('status', 1) // only active users
                        ->first();

            if ($user) {
                Auth::guard('user')->login($user);
                $request->session()->regenerate();
                // Update online status
                $user->is_online = 1;
                $user->last_seen = now();
                $user->save();
                return redirect()->intended('/user/feed');
            }
        } else {
            $connection = Container::getDefaultConnection();
if ($connection->auth()->attempt($username, $password)) {
            // 🌐 Production: LDAP authentication
                $user = \App\Models\Member::where('username', $username)
                            ->where('status', 1)
                            ->first();

                if ($user) {
                    Auth::guard('user')->login($user);
                    $request->session()->regenerate();
                    // Update online status
                    $user->is_online = 1;
                    $user->last_seen = now();
                    $user->save();
                    return redirect()->intended('/user/feed');
                }
            }
        }
    } catch (\Exception $e) {
        logger('Login failed: ' . $e->getMessage());
    }

    return back()->withErrors([
        'username' => 'Invalid username or password.',
    ]);
}

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Add 'status' => 1 to only allow active users
    $credentials['status'] = 1;

    if (Auth::guard('user')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/user/feed');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records or your account is inactive.',
    ]);
}
public function login_ldap(Request $request)
{
   
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
        'g-recaptcha-response' => 'required', // reCAPTCHA validation
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

     $enc = $request->input('password_salt');

        try {
            // Decrypt timestamp
            $timestamp = (int) Crypt::decryptString($enc);

            // Verify: should not be expired (30 sec ahead)
            if (now()->timestamp > $timestamp) {
                return back()->withErrors([ 'email' => 'Invalid login credentials or unauthorized access.']);
            }

    $username = trim($request->input('username'));
    $password = $request->input('password');
     $encodedKey = config('app.key'); // Get APP_KEY
   if (strpos($encodedKey, 'base64:') === 0) {
       $encodedKey = substr($encodedKey, 7); // Remove "base64:" prefix
   }
   $secretKey = base64_decode($encodedKey); // Decode Key
   if (strlen($secretKey) !== 32) {
       return response()->json(["error" => "Invalid key length!"], 400);
   }
   $iv = "1234567890123456"; // Must be exactly 16 bytes
   $encryptedPassword = base64_decode($request->password); // Decode from Base64
   $password = openssl_decrypt(
       $encryptedPassword,
       'AES-256-CBC',
       $secretKey,
       OPENSSL_RAW_DATA,
       $iv
   );
   
   // Re-encrypt the password using Laravel's Hash facade for consistent storage
   $hashedPassword = Hash::make($password);
   
 $serverHost = $request->getHost();

     try {
        if (in_array($serverHost, ['localhost', '127.0.0.1', 'dev.local','52.140.75.46'])) {
          
            // 👨‍💻 Localhost: Normal DB-based login
            $user = \App\Models\Member::where('username', $username)
                        ->where('status', 1) // only active users
                        ->first();

            if ($user) {
                // Update the user's password with the consistent hash if it's different
                if (!Hash::check($password, $user->password) || $user->password !== $hashedPassword) {
                    $user->password = $hashedPassword;
                    $user->save();
                }
                
                Auth::guard('user')->login($user);
                $request->session()->regenerate();
                // Update online status
                $user->is_online = 1;
                $user->last_seen = now();
                $user->save();
                return redirect()->intended('/user/feed');
            }else{
                return back()->with('error', 'Invalid username or password.');

            }
        } else {
        
        // Get the default LDAP connection from config
        $connection = Container::getDefaultConnection();
        $connection->connect();

        // 1️⃣ Search for the user in LDAP (try both samaccountname & userPrincipalName)
        $ldapUser = LdapUser::findBy('samaccountname', strtolower($username));

        if (! $ldapUser) {
            $ldapUser = LdapUser::findBy('userprincipalname', $username);
        }

        if (! $ldapUser) {
            logger("LDAP: User '{$username}' not found.");
            return back()->with('error', 'User not found in LDAP directory.');
        }

        // 2️⃣ Prepare possible bind usernames
        $bindAttempts = [];

        if (str_contains($username, '@')) {
            $bindAttempts[] = $username; // already UPN
        } else {
            $bindAttempts[] = $username . '@lbsnaa.gov.in'; // UPN format
            $bindAttempts[] = 'LBSNAA\\' . $username;       // DOMAIN\username format
        }

        // 3️⃣ Try each bind format
        $bindSuccess = false;
        foreach ($bindAttempts as $bindUser) {
            if ($connection->auth()->attempt($bindUser, $password)) {
                $bindSuccess = true;
                break;
            }
        }

        if (! $bindSuccess) {
            logger("LDAP: Invalid credentials for '{$username}'. Tried formats: " . implode(', ', $bindAttempts));
            return back()->with('error', 'Invalid username or password.');
        }

        // 4️⃣ If LDAP auth succeeded, log into local app
        $localUser = \App\Models\Member::where('username', $username)
            ->where('status', 1)
            ->first();

        if (! $localUser) {
            logger("LDAP auth passed but no local Member found for '{$username}'.");
            return back()->with('error', 'LDAP auth passed, but user not registered locally.');
        }

        // Update the user's password with the consistent hash for future logins
        if ($localUser->password !== $hashedPassword) {
            $localUser->password = $hashedPassword;
            $localUser->save();
        }

        Auth::guard('user')->login($localUser);
        $request->session()->regenerate();

        logger("LDAP: Login successful for '{$username}'.");
        return redirect()->intended('/user/feed');
    }
    } catch (\Exception $e) {
        logger('LDAP login error: ' . $e->getMessage());
        return back()->with('error', 'LDAP connection or authentication failed.');
    }

    } catch (\Exception $e) {
            return back()->withErrors([ 'email' => 'Invalid login credentials or unauthorized access.']);
    }
}

	public function logout(Request $request)
	{
        $user = Auth::guard('user')->user();
        if ($user) {
            $user->is_online = 0;
            $user->last_seen = now();
            $user->save();
        }
        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('user/login')->with('success', 'Logged Out Successfully');
	}
}

