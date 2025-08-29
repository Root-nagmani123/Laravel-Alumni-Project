<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LBSNAA Alumni">
    <meta name="keywords" content="LBSNAA Alumni">
    <meta name="author" content="LBSNAA Alumni">
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('admin_assets/images/logos/favicon.ico') }}">
    <title>User Login - Alumni | Lal Bahadur Shastri National Academy of Administration</title>

    <!-- Theme css -->
    <!-- Add CSRF token meta -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link id="change-link" rel="stylesheet" type="text/css" href="{{asset('user_assets/css/style.css')}}">
    <style>
    body {
        background-color: #fff;
        color: #af2910;
        font-family: 'Segoe UI', sans-serif;
    }

    .login-card {
        background: #af2910;
        border-radius: 0.75rem;
        padding: 2rem;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.15);
        transition: transform 0.2s;
        color: #fff;
    }

    .login-card:hover {
        transform: translateY(-3px);
    }

    .login-card button {
        min-width: 180px;
    }

    .or-divider {
        font-weight: 500;
        margin: 1.5rem 0;
        color: #ccc;
    }

    .img-section img {
        max-width: 100%;
        border-radius: 0.75rem;
    }

    .marquee-container {
        height: 100%;
    }

    .marquee-text {
        white-space: nowrap;
        animation: scrollMarquee 20s linear infinite;
    }

    .marquee-container:hover .marquee-text {
        animation-play-state: paused;
    }

    @keyframes scrollMarquee {
        0% {
            left: 100%;
        }

        100% {
            left: -100%;
        }
    }

    .marquee-text {
        white-space: nowrap;
        display: inline-block;
        animation: marquee 15s linear infinite;
        color: #af2910;
    }

    .marquee-container:hover .marquee-text {
        animation-play-state: paused;
    }

    @keyframes marquee {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    .flip-card {
        position: relative;
        width: 100%;
        min-height: 500px;
        transition: transform 0.8s;
        transform-style: preserve-3d;
    }

    .flip-card-inner {
        position: relative;
        width: 100%;
        transition: transform 0.6s;
        transform-style: preserve-3d;
    }

    .flip-card.flipped .flip-card-inner {
        transform: rotateY(180deg);
    }

    .flip-card-front,
    .flip-card-back {
        position: absolute;
        width: 100%;
        backface-visibility: hidden;
        background: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
    }

    .flip-card-front {
        z-index: 2;
    }

    .flip-card-back {
        transform: rotateY(180deg);
        z-index: 1;
    }

    .marquee-container {
        height: 100%;
    }

    .marquee-text {
        white-space: nowrap;
        animation: scrollMarquee 20s linear infinite;
    }

    .marquee-container:hover .marquee-text {
        animation-play-state: paused;
    }

    @keyframes scrollMarquee {
        0% {
            left: 100%;
        }

        100% {
            left: -100%;
        }
    }

    .marquee-text {
        white-space: nowrap;
        display: inline-block;
        animation: marquee 15s linear infinite;
    }

    .marquee-container:hover .marquee-text {
        animation-play-state: paused;
    }

    @keyframes marquee {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    .error-message {
        color: #dc3545;
        font-size: 0.9rem;
        margin-top: 0.5rem;
    }

    .success-message {
        color: #28a745;
        font-size: 0.9rem;
        margin-top: 0.5rem;
    }

    #otpInputContainer {
        display: none;
    }

    #resendOtp {
        cursor: pointer;
        color: #007bff;
        text-decoration: underline;
        font-size: 0.8rem;
        margin-top: 5px;
        display: none;
    }

    .otp-input {
        width: 50px;
        height: 50px;
        font-size: 20px;
        border: 1px solid #0049ac;
        border-radius: 5px;
        text-align: center;
    }

    /* Card style to match screenshot */
    .card.login-card {
        position: relative;
        background: transparent;
        border: 1px solid #af2910;
        border-radius: 10px;
        padding-top: 2.5rem !important;
        text-align: center;
        color: #af2910;
        transition: all 0.3s ease-in-out;
    }

    .card.login-card:hover {
        border-color: #af2910;
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
    }

    /* Floating label pill */
    .card.login-card .card-label {
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%);
        background: #004a93;
        color: #fff;
        padding: 3px 14px;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    /* Inside content link */
    .card.login-card .login-form2 p {
        color: #af2910;
        text-decoration: none;
        font-weight: 600;
        font-size: 1rem;
    }

    .card.login-card .login-form2 p:hover {
        color: #004a93;
    }
    </style>
    <style>
    body {
        background: url('your-bg-image.jpg') no-repeat center center;
        background-size: cover;
    }

    .login-card {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        transition: 0.3s;
    }

    .login-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .card-label {
        font-weight: 500;
        margin-bottom: 5px;
    }

    .btn-custom {
        background-color: #a6261f;
        color: #fff;
        font-weight: bold;
    }

    .btn-custom:hover {
        background-color: #8b201a;
        color: #fff;
    }

    .bg-top-bottom {
        position: relative;
        background: url('{{ asset('feed_assets/images/bg/Group.svg') }}') top center no-repeat;
        background-size: contain;
        background-color: linear-gradient(to bottom, #af2910 40%, #fff 60%);
    }

    .bg-top-bottom::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 250px;
        /* adjust to match image height */
        background: url('{{ asset('feed_assets/images/bg/Group.svg') }}') center no-repeat;
        background-size: contain;
        transform: rotate(180deg);
    }

    /* Error toast ka background red karne ke liye */
    #toast-container>.toast-error {
        background-color: red !important;
        color: #fff !important;
        /* text white */
    }
    </style>
</head>

<body>

    <!-- Simple Bootstrap Loader -->
    <div class="d-flex justify-content-center align-items-center vh-100 bg-white" id="pageLoader">
        <div class="spinner-border text-danger" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="container-fluid d-none d-lg-block">
        <div class="row">
            <!-- Left Section -->
            <div class="col-lg-4 p-5 d-flex flex-column justify-content-center bg-top-bottom">
                <!-- Your left column content here -->
                <!-- Logo -->
                <div class="logo-sec text-center mb-4">
                    <a href="#!"
                        class="d-flex align-items-center gap-3 text-decoration-none justify-content-center flex-wrap">
                        <img src="{{ asset('admin_assets/images/logos/lbsnaa_logo.jpg') }}" alt="LBSNAA Logo"
                            style="height: 60px; object-fit: contain;">
                        <div class="d-flex flex-column text-start">
                            <span style="color: #000;font-weight: bold;font-size: 24px;">Alumni</span>
                            <span style="font-size: 16px; font-weight: 500;color: #af2910;">
                                Lal Bahadur Shastri National Academy of Administration
                            </span>
                        </div>
                    </a>
                </div>

                <div class="mt-4">
                    <h1 class="fw-bold mb-3">Welcome to Alumni Portal!</h1>
                    <p>The LBSNAA Alumni Portal connects officer trainees across batches, fostering lifelong bonds, knowledge sharing, and collaboration. It preserves the Academy’s heritage while offering alumni a platform to stay engaged, contribute, and celebrate their shared journey.</p>
                </div>


                <!-- Login Buttons -->
                <div class="row mt-5">
                    <div class="col-sm-5 col-8 mb-2 p-0">
                        <a href="#" class="text-decoration-none open-panel" data-panel="ldap">
                            <div class="card login-card p-3 d-flex flex-column justify-content-center align-items-center">
                                <span class="card-label">Login with</span>
                                <p class="m-0 fw-bold">LDAP</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-2 col-8 align-self-center p-0">
                        <p class="text-center">or</p>
                    </div>

                    <div class="col-sm-5 col-8 mb-2 p-0">
                        <a href="#" class="text-decoration-none open-panel" data-panel="otp">
                            <div class="card login-card p-3 d-flex flex-column justify-content-center align-items-center">
                                <span class="card-label">Login with</span>
                                <p class="m-0 fw-bold">Email OTP</p>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="mt-3 text-center">
                    <a href="#" class="btn btn-outline-danger open-panel" data-panel="register"
                        style="background-color:#af2910; border: #af2910 1px solid;color:#fff;">
                        For Registration Click Here
                    </a>
                </div>
                <div class="position-relative w-100 bg-light d-flex align-items-center px-3 mt-4"
                    style="height: 40px; overflow: hidden; z-index: 1040;">
                    <div class="position-relative d-flex align-items-center">
                        <button class="btn btn-sm btn-danger position-relative z-1"
                            style="background-color:#af2910; border: #af2910 1px solid;color:#fff;min-width: 120px;">
                            Helpdesk
                        </button>
                    </div>

                    <div class="marquee-container flex-grow-1 d-flex align-items-center ms-2"
                        style="overflow: hidden; height: 100%;">
                        <div class="marquee-text">
                            Inquiry regarding user credentials: Phone: 135-2222346 (Mon–Fri,
                            9:00 AM–5:30 PM) Email:
                            ithelpdesk.lbsnaa@nic.in
                        </div>
                    </div>
                </div>
                <div class="card mt-5 w-100" style="background:transparent !important; border:none !important;">
                    <div class="card-body">
                        <p class="text-center mb-0">
                            © {{ date("Y") }}
                            <a href="https://www.lbsnaa.gov.in/">
                                Lal Bahadur Shastri National Academy of Administration Mussoorie
                            </a>,<br>
                            Govt of India. All Rights Reserved
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Section (Background + Overlay Forms) -->
            <div class="col-8 p-0 position-relative" style="height: 100vh;">
                <!-- Background image -->
                <img src="{{ asset('user_assets/images/login/login-bg.jpg') }}" alt="Employee Services Graphic"
                    class="w-100 h-100" style="object-fit: cover;">

                <!-- Overlay Container -->
                <div class="position-absolute top-50 start-50 translate-middle w-50" style="z-index: 2;">
                    <!-- LDAP Login -->
                    <div id="ldap-panel" class="card shadow-lg p-4 d-none">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3 close-panel"></button>
                        <h4 class="mb-3 fw-bold text-center">LDAP Login</h4>
                        <hr class="my-2">
                        <form method="POST" action="{{ route('user.login.submit_ldap') }}" id="loginForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">User Name</label>
                                <input type="text" name="username" class="form-control"
                                    placeholder="Enter your username" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Enter your password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>

                    <!-- OTP Login -->
                    <div id="otp-panel" class="card shadow-lg p-4 d-none">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3 close-panel"></button>
                        <h4 class="mb-3 fw-bold text-center">Email OTP Login</h4>
                        <hr class="my-2">
                        <form id="otpForm">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Email Address</label>
                                <input type="email" name="otp_email" id="otp_email" class="form-control"
                                    placeholder="Enter your email" required>
                                <div id="emailError" class="error-message"></div>
                                <div id="emailSuccess" class="success-message"></div>
                            </div>
                            <div id="otpInputContainer">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">Enter OTP</label>
                                    <div class="d-flex gap-2">
                                        <input type="text" class="form-control text-center otp-input" maxlength="1"
                                            pattern="[0-9]*" inputmode="numeric">
                                        <input type="text" class="form-control text-center otp-input" maxlength="1"
                                            pattern="[0-9]*" inputmode="numeric">
                                        <input type="text" class="form-control text-center otp-input" maxlength="1"
                                            pattern="[0-9]*" inputmode="numeric">
                                        <input type="text" class="form-control text-center otp-input" maxlength="1"
                                            pattern="[0-9]*" inputmode="numeric">
                                        <input type="text" class="form-control text-center otp-input" maxlength="1"
                                            pattern="[0-9]*" inputmode="numeric">
                                        <input type="text" class="form-control text-center otp-input" maxlength="1"
                                            pattern="[0-9]*" inputmode="numeric">
                                    </div>

                                    <!-- Hidden field to store the final OTP -->
                                    <input type="hidden" name="otp_code" id="otp_code">

                                    <div id="otpError" class="error-message"></div>
                                    <div id="otpSuccess" class="success-message"></div>
                                    <div id="resendOtp">Didn't receive OTP? Resend</div>
                                </div>
                            </div>
                            <button type="button" id="sendOtpBtn" class="btn btn-primary w-100">Send
                                OTP</button>
                            <button type="button" id="verifyOtpBtn" class="btn btn-primary w-100 mt-2">Verify
                                OTP</button>
                        </form>
                    </div>

                    <!-- Registration -->
                    <div id="register-panel" class="card shadow-lg p-4 d-none">
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3 close-panel"></button>
                        <h4 class="mb-3 fw-bold text-center">Registration</h4>
                        <hr class="my-2">
                        <form action="{{ route('admin.registration-requests.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Email <span class="text-muted"
                                            style="font-size:12px;">(.gov or .nic only)</span></label>
                                    <input type="email" name="email" class="form-control"
                                        pattern="^[^@\s]+@(?:[^@\s]+\.)?(gov|nic)\.in$" required>
                                    <div class="form-text text-danger" id="emailMsg" style="display:none;">Only .gov.in
                                        or
                                        .nic.in email IDs are allowed.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Mobile Number</label>
                                    <input type="text" name="mobile" class="form-control" pattern="^[6-9]\d{9}$"
                                        maxlength="10" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Service</label>
                                    <input type="text" name="service" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Batch</label>
                                    <input type="text" name="batch" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Cadre <span
                                            class="text-muted">(Optional)</span></label>
                                    <input type="text" name="cadre" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Course Attended in LBSNAA</label>
                                    <input type="text" name="course_attended" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Upload Photo <span>(type: jpg,jpeg,png)</span></label>
                                    <input type="file" name="photo" class="form-control" accept="image/*" required>
                                </div>
                                <div class="col-md-6 ">
                                    <label class="form-label fw-bold">Upload Govt. ID <span>(type: jpg,jpeg,png,pdf)</span></label>
                                    <input type="file" name="govt_id" class="form-control" accept="image/*,.pdf"
                                        required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-3">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="container-fluid mx-auto d-block d-lg-none">
        <div class="row">
            <!-- Left Section -->
            <div class="col-lg-4 p-5 d-flex flex-column justify-content-center bg-top-bottom">
                <!-- Your left column content here -->
                <!-- Logo -->
                <div class="logo-sec text-center mb-4">
                    <a href="#!"
                        class="d-flex align-items-center gap-3 text-decoration-none justify-content-center flex-wrap">
                        <img src="{{ asset('admin_assets/images/logos/lbsnaa_logo.jpg') }}" alt="LBSNAA Logo"
                            style="height: 60px; object-fit: contain;">
                    </a>
                </div>

                <div class="text-center">
                    <h1 class="fw-bold mb-3 ">Welcome to Alumni Portal!</h1>
                    <p>The LBSNAA Alumni Portal connects officer trainees across batches, fostering lifelong bonds, knowledge sharing, and collaboration. It preserves the Academy’s heritage while offering alumni a platform to stay engaged, contribute, and celebrate their shared journey.</p>
                </div>


                <!-- Login Buttons -->
                <div class="row mt-5">
                    <div class="col-10 mx-auto mb-2 p-0">
                        <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#ldapModal">
                            <div class="card login-card p-3 d-flex flex-column justify-content-center align-items-center">
                                <span class="card-label">Login with</span>
                                <p class="m-0 fw-bold">LDAP</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-8 align-self-center p-0 mb-4 mx-auto">
                        <p class="text-center">or</p>
                    </div>

                    <div class="col-10 mx-auto mb-2 p-0">
                       <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#otpModal">
                            <div class="card login-card p-3 d-flex flex-column justify-content-center align-items-center">
                                <span class="card-label">Login with</span>
                                <p class="m-0 fw-bold">Email OTP</p>
                            </div>
                        </a>

                    </div>
                </div>


                <div class="mt-3 text-center">
                    <a href="#" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#registerModal">
                        For Registration Click Here
                    </a>
                </div>
                <div class="position-relative w-100 bg-light d-flex align-items-center px-3 mt-4"
                    style="height: 40px; overflow: hidden; z-index: 1040;">
                    <div class="position-relative d-flex align-items-center">
                        <button class="btn btn-sm btn-danger position-relative z-1"
                            style="background-color:#af2910; border: #af2910 1px solid;color:#fff;min-width: 120px;">
                            Helpdesk
                        </button>
                    </div>

                    <div class="marquee-container flex-grow-1 d-flex align-items-center ms-2"
                        style="overflow: hidden; height: 100%;">
                        <div class="marquee-text">
                            Inquiry regarding user credentials: Phone: 135-2222346 (Mon–Fri,
                            9:00 AM–5:30 PM) Email:
                            ithelpdesk.lbsnaa@nic.in
                        </div>
                    </div>
                </div>
                <div class="card mt-5 w-100" style="background:transparent !important; border:none !important;">
                    <div class="card-body">
                        <p class="text-center mb-0">
                            © {{ date("Y") }}
                            <a href="https://www.lbsnaa.gov.in/">
                                Lal Bahadur Shastri National Academy of Administration Mussoorie
                            </a>,<br>
                            Govt of India. All Rights Reserved
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- ================= LDAP Login Modal ================= -->
<div class="modal fade" id="ldapModal" tabindex="-1" aria-labelledby="ldapModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg p-4">
      <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
      <h4 class="mb-3 fw-bold text-center">LDAP Login</h4>
      <hr class="my-2">
      <form method="POST" action="{{ route('user.login.submit_ldap') }}" id="loginForm">
        @csrf
        <div class="mb-3">
          <label class="form-label fw-bold">User Name</label>
          <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
        </div>
        <div class="mb-3">
          <label class="form-label fw-bold">Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
      </form>
    </div>
  </div>
</div>


<!-- ================= Email OTP Login Modal ================= -->
<div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg p-4">
      <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
      <h4 class="mb-3 fw-bold text-center">Email OTP Login</h4>
      <hr class="my-2">
      <form id="otpForm">
        @csrf
        <div class="form-group mb-3">
          <label class="form-label fw-bold">Email Address</label>
          <input type="email" name="otp_email" id="otp_email" class="form-control" placeholder="Enter your email" required>
          <div id="emailError" class="error-message"></div>
          <div id="emailSuccess" class="success-message"></div>
        </div>

        <div id="otpInputContainer">
          <div class="form-group mb-3">
            <label class="form-label fw-bold">Enter OTP</label>
            <div class="d-flex gap-2">
              <input type="text" class="form-control text-center otp-input" maxlength="1" pattern="[0-9]*" inputmode="numeric">
              <input type="text" class="form-control text-center otp-input" maxlength="1" pattern="[0-9]*" inputmode="numeric">
              <input type="text" class="form-control text-center otp-input" maxlength="1" pattern="[0-9]*" inputmode="numeric">
              <input type="text" class="form-control text-center otp-input" maxlength="1" pattern="[0-9]*" inputmode="numeric">
              <input type="text" class="form-control text-center otp-input" maxlength="1" pattern="[0-9]*" inputmode="numeric">
              <input type="text" class="form-control text-center otp-input" maxlength="1" pattern="[0-9]*" inputmode="numeric">
            </div>
            <input type="hidden" name="otp_code" id="otp_code">
            <div id="otpError" class="error-message"></div>
            <div id="otpSuccess" class="success-message"></div>
            <div id="resendOtp">Didn't receive OTP? Resend</div>
          </div>
        </div>
        <button type="button" id="sendOtpBtn" class="btn btn-primary w-100">Send OTP</button>
        <button type="button" id="verifyOtpBtn" class="btn btn-primary w-100 mt-2">Verify OTP</button>
      </form>
    </div>
  </div>
</div>


<!-- ================= Registration Modal ================= -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content shadow-lg p-4">
      <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
      <h4 class="mb-3 fw-bold text-center">Registration</h4>
      <hr class="my-2">
      <form>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label fw-bold">Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">Email <span class="text-muted" style="font-size:12px;">(.gov or .nic only)</span></label>
            <input type="email" name="email" class="form-control"
              pattern="^[^@\s]+@(?:[^@\s]+\.)?(gov|nic)\.in$" required>
            <div class="form-text text-danger" id="emailMsg" style="display:none;">
              Only .gov.in or .nic.in email IDs are allowed.
            </div>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">Mobile Number</label>
            <input type="text" name="mobile" class="form-control" pattern="^[6-9]\d{9}$" maxlength="10" required>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">Service</label>
            <input type="text" name="service" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">Batch</label>
            <input type="text" name="batch" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">Cadre <span class="text-muted">(Optional)</span></label>
            <input type="text" name="cadre" class="form-control">
          </div>
          <div class="col-md-12">
            <label class="form-label fw-bold">Course Attended in LBSNAA</label>
            <input type="text" name="course_attended" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">Upload Photo</label>
            <input type="file" name="photo" class="form-control" accept="image/*" required>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">Upload Govt. ID</label>
            <input type="file" name="govt_id" class="form-control" accept="image/*,.pdf" required>
          </div>
        </div>
        <button type="submit" class="btn btn-primary w-100 mt-3">Register</button>
      </form>
    </div>
  </div>
</div>


    <script src="{{ asset('user_assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('user_assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('user_assets/js/slick.js') }}"></script>
    <script src="{{ asset('user_assets/js/custom-slick.js') }}"></script>
    <script src="{{ asset('user_assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('user_assets/js/emojionearea.min.js') }}"></script>
    <script src="{{ asset('user_assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('user_assets/js/chatbox.js') }}"></script>
    <script src="{{ asset('user_assets/js/lazysizes.min.js') }}"></script>
    <script src="{{ asset('user_assets/js/theme-setting.js') }}"></script>
    <script src="{{ asset('user_assets/js/script.js') }}"></script>
    <script>
        $(document).on('click', '.close-panel', function () {
    $(this).closest('.card').addClass('d-none'); // hide the panel
});
    document.querySelectorAll('.open-panel').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            let target = btn.getAttribute('data-panel');

            // Hide all
            document.querySelectorAll('#ldap-panel, #otp-panel, #register-panel')
                .forEach(p => p.classList.add('d-none'));

            // Show selected
            document.getElementById(target + '-panel').classList.remove('d-none');
        });
    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const inputs = document.querySelectorAll(".otp-input");
        const hiddenOtp = document.getElementById("otp_code");

        inputs.forEach((input, index) => {
            input.addEventListener("input", () => {
                // Allow only digits
                input.value = input.value.replace(/[^0-9]/g, '');

                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
                updateHiddenOtp();
            });

            input.addEventListener("keydown", (e) => {
                if (e.key === "Backspace" && !input.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });

        function updateHiddenOtp() {
            hiddenOtp.value = Array.from(inputs).map(i => i.value).join("");
        }
    });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const inputs = document.querySelectorAll(".otp-input");
        const hiddenOtp = document.getElementById("otp_code");

        inputs.forEach((input, index) => {
            input.addEventListener("input", () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
                updateHiddenOtp();
            });

            input.addEventListener("keydown", (e) => {
                if (e.key === "Backspace" && !input.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });

        function updateHiddenOtp() {
            hiddenOtp.value = Array.from(inputs).map(i => i.value).join("");
        }
    });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @if(session('success'))
    <script>
    toastr.success("{{ session('success') }}");
    </script>
    @endif
    @if(session('error'))
    <script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-center", // 👈 Center top
        "timeOut": "5000"
    };
    toastr.error("{{ session('error') }}");
    </script>
    @endif


    <script>
    feather.replace();
    $(".emojiPicker").emojioneArea({
        inline: true,
        placement: 'absleft',
        pickerPosition: "top left",
    });

    window.addEventListener("load", () => {
        const loader = document.getElementById("pageLoader");
        if (loader) {
            loader.style.opacity = "0";
            loader.style.transition = "opacity 0.4s ease";
            setTimeout(() => loader.remove(), 400);
        }
    });

    function flipCard(e) {
        if (e) e.preventDefault();
        const card = document.querySelector('.flip-card');
        card.classList.toggle('flipped');

        // Reset OTP form when flipping
        $('#otpForm')[0].reset();
        $('#emailError, #otpError, #emailSuccess, #otpSuccess').hide().text('');
        $('#otpInputContainer').hide();
        $('#sendOtpBtn').show().text('Send OTP').prop('disabled', false);
        $('#verifyOtpBtn').hide();
        $('#resendOtp').hide();
    }

    $(document).ready(function() {
        // Initially hide OTP fields
        $('#otpInputContainer').hide();
        $('#verifyOtpBtn').hide();
        $('#resendOtp').hide();

        // Email validation
        function isValidEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        // Send OTP
        $('#sendOtpBtn').on('click', function() {
            const email = $('#otp_email').val();
            const token = $('input[name="_token"]').val();

            // Validate email
            if (!isValidEmail(email)) {
                $('#emailError').text('Please enter a valid email address').show();
                return;
            }

            $('#emailError').hide();
            $(this).prop('disabled', true).text('Sending...');

            $.ajax({
                url: '{{ route("otp.send") }}',
                method: 'POST',
                data: {
                    otp_email: email,
                    _token: token
                },
                success: function(response) {
                    $('#emailSuccess').text('OTP sent successfully! -' + response.otp)
                        .show();
                    $('#otpInputContainer').show();
                    $('#verifyOtpBtn').show();
                    $('#sendOtpBtn').hide();
                    $('#resendOtp').show().text('Resend OTP in 30 seconds');
                    startResendTimer();
                },
                error: function(xhr) {
                    const errorMsg = xhr.responseJSON?.error ||
                        'Failed to send OTP. Please try again.';
                    $('#emailError').text(errorMsg).show();
                    $('#sendOtpBtn').prop('disabled', false).text('Send OTP');
                }
            });
        });

        // Verify OTP
        $('#verifyOtpBtn').on('click', function() {
            const email = $('#otp_email').val();
            const otp = $('#otp_code').val();
            const token = $('input[name="_token"]').val();

            if (!otp || otp.length !== 6) {
                $('#otpError').text('Please enter a valid 6-digit OTP').show();
                return;
            }

            $('#otpError').hide();
            $(this).prop('disabled', true).text('Verifying...');

            $.ajax({
                url: '{{ route("otp.verify") }}',
                method: 'POST',
                data: {
                    otp_email: email,
                    otp_code: otp,
                    _token: token
                },
                success: function(response) {
                    $('#otpSuccess').text('OTP verified successfully!').show();
                    window.location.href = response.redirect;
                },
                error: function(xhr) {
                    const errorMsg = xhr.responseJSON?.error ||
                        'Invalid or expired OTP';
                    $('#otpError').text(errorMsg).show();
                    $('#verifyOtpBtn').prop('disabled', false).text('Verify OTP');
                }
            });
        });

        // Resend OTP
        $('#resendOtp').on('click', function() {
            if ($(this).hasClass('disabled')) return;

            const email = $('#otp_email').val();
            const token = $('input[name="_token"]').val();

            $(this).text('Sending...').addClass('disabled');
            $('#otpError, #otpSuccess').hide();

            $.ajax({
                url: '{{ route("otp.send") }}',
                method: 'POST',
                data: {
                    otp_email: email,
                    _token: token
                },
                success: function(response) {
                    $('#emailSuccess').text('New OTP sent successfully!').show();
                    $('#resendOtp').text('Resend OTP in 30 seconds');
                    startResendTimer();
                },
                error: function(xhr) {
                    const errorMsg = xhr.responseJSON?.error ||
                        'Failed to resend OTP. Please try again.';
                    $('#emailError').text(errorMsg).show();
                    $('#resendOtp').text('Resend OTP').removeClass('disabled');
                }
            });
        });

        // Timer for resend OTP
        function startResendTimer() {
            let seconds = 30;
            const resendButton = $('#resendOtp');
            resendButton.addClass('disabled');

            const timer = setInterval(function() {
                seconds--;
                resendButton.text(`Resend OTP in ${seconds} seconds`);

                if (seconds <= 0) {
                    clearInterval(timer);
                    resendButton.text('Resend OTP').removeClass('disabled');
                }
            }, 1000);
        }
    });

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

    document.getElementById("loginForm").addEventListener("submit", async function(e) {
        e.preventDefault();
        let passwordField = document.getElementById("password");
        let encryptedPassword = await encryptPassword(passwordField.value);
        passwordField.value = encryptedPassword; // Send encrypted password
        this.submit(); // Now submit the form
    });
    </script>
    
</body>

</html>