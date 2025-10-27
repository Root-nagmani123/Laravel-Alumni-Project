<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('admin_assets/images/logos/favicon.ico') }}">
    <!-- Core Css -->
    <!-- Toaster CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/styles.css') }}">
    <title>Admin Login - Alumni | Lal Bahadur Shastri National Academy of Administration</title>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">

        <img src="{{ asset('admin_assets/images/logos/favicon.ico') }}" alt="loader" class="lds-ripple img-fluid">
    </div>
    <div id="main-wrapper" style="background-image: url({{asset('admin_assets/images/backgrounds/login-bg.webp')}});">
        <div class="position-relative overflow-hidden auth-bg min-vh-100 w-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100 my-5 my-xl-0">
                    <div class="col-12 d-flex flex-column align-items-center justify-content-center px-0">
                        <div class="card mb-0 bg-body border-0 rounded">
                            <div class="row gx-0">
                                <!-- ------------------------------------------------- -->
                                <!-- Part 1 -->
                                <!-- ------------------------------------------------- -->
                                <div class="col-xl-12">
                                    <div class="row justify-content-center py-4">
                                        <div class="col-lg-11">

                                            <div class="card-body">
                                                <div>
                                                    <a href="{{ url('/') }}"
                                                        class="text-nowrap logo-img d-block mb-4 w-100">
                                                        <img src="{{ asset('admin_assets/images/logos/logo.png') }}"
                                                            class="logo mx-auto d-block img-fluid" alt="Logo-Dark">
                                                    </a>
                                                    <h6 class="lh-base mb-4">Login to Your Admin Account</h6>
                                                </div>


                                                <form action="{{ url('admin/authlogin') }}" method="post" id="loginForm">
                                                    {{-- CSRF Token --}}
                                                    @csrf
                                                <input type="hidden" id="check_data" name="check_data" value="{{ $passwordSaltToken }}">
                                                    {{-- Email Field --}}
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Email
                                                            Address</label>
                                                        <input type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            id="exampleInputEmail1" placeholder="Enter your email"
                                                            name="email" value="{{ old('email') }}" required autocomplete="off">
                                                        @error('email')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    {{-- Password Field --}}
                                                    <div class="mb-4">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <label for="exampleInputPassword1"
                                                                class="form-label">Password</label>
                                                            
                                                        </div>
                                                        <div class="position-relative">
                                                            <input type="password"
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                id="password" placeholder="Enter your password"
                                                                name="password" required autocomplete="off">
                                                            <span toggle="#password"
                                                                class="toggle-password position-absolute end-0 top-50 translate-middle-y me-3"
                                                                style="cursor: pointer;">
                                                                👁️
                                                            </span>
                                                             
                                                         </div>
                                                        @error('password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="g-recaptcha" data-sitekey="6LcxQc0rAAAAAOpY8yaHMqLtQB8NW9J2eVjjGMWA"></div>
                                                        @error('captcha')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input primary" type="checkbox"
                                                            id="flexCheckChecked" name="remember"
                                                            {{ old('remember') ? 'checked' : '' }}>
                                                        <label class="form-check-label text-dark"
                                                            for="flexCheckChecked">Keep me logged in</label>
                                                    </div>

                                                    <button type="submit"
                                                        class="btn btn-dark w-100 py-2 rounded-1">Sign In</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- You can add the second half of the layout here if needed -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Import Js Files -->

    <script src="{{ asset('admin_assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/theme/app.init.js') }}"></script>
    <script src="{{ asset('admin_assets/js/theme/theme.js') }}"></script>
    <script src="{{ asset('admin_assets/js/theme/app.min.js') }}"></script>
    <!-- solar icons -->
    <script src="	{{ asset('admin_assets/css/iconify-icon.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
    @if(session('success'))
    toastr.success("{{ session('success') }}");
    @endif
    // JS to make password visible
async function encryptPassword(password) {
    
    let key = CryptoJS.enc.Base64.parse("{{ substr(config('app.key'), 7) }}");
    const iv = CryptoJS.enc.Utf8.parse("1234567890123456"); 
    const encrypted = CryptoJS.AES.encrypt(password, key, {
        iv: iv,
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7
    });
    return encrypted.toString(); 
}

document.getElementById("loginForm").addEventListener("submit", async function (e) {
    e.preventDefault();
    let passwordField = document.getElementById("password");
    let encryptedPassword = await encryptPassword(passwordField.value);
    passwordField.value = encryptedPassword; // Send encrypted password
    this.submit(); // Now submit the form
});

    </script>
</body>

</html>