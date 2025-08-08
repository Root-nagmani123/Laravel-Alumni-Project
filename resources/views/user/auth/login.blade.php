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

    <!--Google font-->
    <link href="../../css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="../../css2-1?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Theme css -->
    <link id="change-link" rel="stylesheet" type="text/css" href="{{secure_asset('user_assets/css/style.css')}}">
    <style>
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
    0%   { transform: translateX(100%); }
    100% { transform: translateX(-100%); }
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


    <!-- login section start -->
    <section class="login-section" style="background-image: url({{asset('user_assets/images/login/login-bg.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-12 mx-auto">
                    <div class="login-form" style="background-color:transparent !important;">
                        <div>
                            <div class="d-flex justify-content-center align-items-center min-vh-100">
                                <div class="flip-card" id="loginCard">
                                    <div class="flip-card-inner">
                                        <!-- Front Side - LDAP Login -->
                                        <div class="flip-card-front p-4">
                                            <div class="logo-sec text-center">
                                                <a href="#!"
                                                    class="d-flex align-items-center gap-3 text-decoration-none justify-content-center flex-wrap">
                                                    <!-- Logo Image -->
                                                    <img src="{{ asset('admin_assets/images/logos/lbsnaa_logo.jpg') }}"
                                                        alt="LBSNAA Logo" style="height: 60px; object-fit: contain;">

                                                    <!-- Text Block -->
                                                    <div class="d-flex flex-column text-start">
                                                        <span class="mb-0"
                                                            style="color: #000000;font-weight: bold;font-size: 24px;">Alumni</span>
                                                        <span style="font-size: 16px; font-weight: 500;color: #af2910;">
                                                            Lal Bahadur Shastri National Academy of Administration
                                                        </span>
                                                    </div>
                                                </a>
                                                          
                                            </div>
                                            <hr>
                                            <div class="login-title">
                                                <h2>Login with LDAP</h2>
                                            </div>
                                            <div class="login-discription mb-4">
                                                <h4>Welcome to LBSNAA Alumni, please login using LDAP credentials.</h4>
                                            </div>
                                            <form method="POST" action="{{ route('user.login.submit') }}">
                                                @csrf
                                                <div class="form-group mb-3">
                                                    <label class="form-label fw-bold">Email Address</label>
                                                    <input type="email" name="email" class="form-control"
                                                        placeholder="Enter your email">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label fw-bold">Password</label>
                                                    <input type="password" name="password" class="form-control"
                                                        placeholder="Enter your password">
                                                </div>
                                                <button type="submit" class="btn btn-primary w-100">Login</button>
                                            </form>
                                            <div class="text-center mt-3">
                                                <a href="#" onclick="flipCard(event)">Login with Email OTP</a>
                                            </div>
                                           <div class="position-relative w-100 bg-light d-flex align-items-center px-3"
     style="height: 40px; overflow: hidden; z-index: 1040;">
    <div class="position-relative d-flex align-items-center">
        <button class="btn btn-sm btn-danger position-relative z-1" style="min-width: 120px;">
            What's New
        </button>
    </div>

    <div class="marquee-container flex-grow-1 d-flex align-items-center ms-2"
         style="overflow: hidden; height: 100%;">
        <div class="marquee-text">
            🎉 Welcome to the LBSNAA Alumni Portal! New features are being
            added regularly — check out the stories, mentorship, and more! 🚀
        </div>
    </div>
</div>


                                        </div>
                                        <!-- Back Side - OTP Login -->
                                        <div class="flip-card-back p-4">
                                            <div class="logo-sec text-center">
                                                <a href="#!"
                                                    class="d-flex align-items-center gap-3 text-decoration-none justify-content-center flex-wrap">
                                                    <!-- Logo Image -->
                                                    <img src="{{ asset('admin_assets/images/logos/lbsnaa_logo.jpg') }}"
                                                        alt="LBSNAA Logo" style="height: 60px; object-fit: contain;">

                                                    <!-- Text Block -->
                                                    <div class="d-flex flex-column text-start">
                                                        <span class="mb-0"
                                                            style="color: #000000;font-weight: bold;font-size: 24px;">Alumni</span>
                                                        <span style="font-size: 16px; font-weight: 500;color: #af2910;">
                                                            Lal Bahadur Shastri National Academy of Administration
                                                        </span>
                                                    </div>
                                                </a>
                                                          
                                            </div>
                                            <hr>
                                            <div class="login-title">
                                                <h2>Login with Email OTP</h2>
                                            </div>
                                            <div class="login-discription mb-4">
                                                <h4>Enter your email to receive a one-time password.</h4>
                                            </div>
                                            <form id="otpForm" method="POST" action="">
                                                @csrf
                                                <div class="form-group mb-3">
                                                    <label class="form-label fw-bold">Email Address</label>
                                                    <input type="email" name="otp_email" class="form-control"
                                                        placeholder="Enter your email" required>
                                                </div>
                                                <div id="otpInputContainer"></div>
                                                <button type="button" id="sendOtpBtn" class="btn btn-success w-100">Send
                                                    OTP</button>
                                                <button type="submit" id="submitOtpBtn"
                                                    class="btn btn-primary w-100 mt-2" style="display:none;">Login with
                                                    OTP</button>
                                            </form>
                                            <div class="text-center mt-3">
                                                <a href="#" onclick="flipCard(event)">Login with LDAP</a>
                                            </div>
                                            <div class="position-relative w-100 bg-light d-flex align-items-center px-3"
     style="height: 40px; overflow: hidden; z-index: 1040;">
    <div class="position-relative d-flex align-items-center">
        <button class="btn btn-sm btn-danger position-relative z-1" style="min-width: 120px;">
            What's New
        </button>
    </div>

    <div class="marquee-container flex-grow-1 d-flex align-items-center ms-2"
         style="overflow: hidden; height: 100%;">
        <div class="marquee-text">
            🎉 Welcome to the LBSNAA Alumni Portal! New features are being
            added regularly — check out the stories, mentorship, and more! 🚀
        </div>
    </div>
</div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login section end -->

    <script>
    $(document).ready(function() {
        $('#sendOtpBtn').on('click', function() {
            // Check if OTP input already exists
            if ($('#otpInputContainer input[name="otp"]').length === 0) {
                // Append OTP input field
                $('#otpInputContainer').html(`
                    <div class="form-group mb-3">
                        <label class="form-label">Enter OTP</label>
                        <input type="text" name="otp" class="form-control" placeholder="Enter OTP" required>
                    </div>
                `);
            }

            // Show the Submit OTP button
            $('#submitOtpBtn').show();

            // Optionally disable send button or show a success message
            $('#sendOtpBtn').text('OTP Sent').prop('disabled', true);
        });
    });
    </script>


    <script>
    function flipCard(e) {
        if (e) e.preventDefault();
        const card = document.querySelector('.flip-card');
        card.classList.toggle('flipped');
    }

    // OTP logic
    document.addEventListener('DOMContentLoaded', function() {
        const sendOtpBtn = document.getElementById('sendOtpBtn');
        const otpInputContainer = document.getElementById('otpInputContainer');
        const submitOtpBtn = document.getElementById('submitOtpBtn');
        const otpForm = document.getElementById('otpForm');

        if (sendOtpBtn) {
            sendOtpBtn.addEventListener('click', function(e) {
                e.preventDefault();
                // Show OTP input
                otpInputContainer.innerHTML = `
                    <div class="form-group mb-3">
                        <label>Enter OTP</label>
                        <input type="text" name="otp_code" class="form-control" placeholder="Enter OTP" required>
                    </div>
                `;
                sendOtpBtn.style.display = 'none';
                submitOtpBtn.style.display = 'block';
            });
        }
    });
    </script>

    <!-- latest jquery-->
    <script src="{{secure_asset('user_assets/js/jquery-3.6.0.min.js')}}"></script>

    <!-- popper js-->
    <script src="{{secure_asset('user_assets/js/popper.min.js')}}"></script>

    <!-- slick slider js -->
    <script src="{{asset('user_assets/js/slick.js')}}"></script>
    <script src="{{asset('user_assets/js/custom-slick.js')}}"></script>

    <!-- feather icon js-->
    <script src="{{asset('user_assets/js/feather.min.js')}}"></script>

    <!-- emoji picker js-->
    <script src="{{asset('user_assets/js/emojionearea.min.js')}}"></script>

    <!-- Bootstrap js-->
    <script src="{{asset('user_assets/js/bootstrap.js')}}"></script>

    <!-- chatbox js -->
    <script src="{{asset('user_assets/js/chatbox.js')}}"></script>

    <!-- lazyload js-->
    <script src="{{asset('user_assets/js/lazysizes.min.js')}}"></script>

    <!-- theme setting js-->
    <script src="{{asset('user_assets/js/theme-setting.js')}}"></script>

    <!-- Theme js-->
    <script src="{{asset('user_assets/js/script.js')}}"></script>

    <script>
    feather.replace();
    $(".emojiPicker ").emojioneArea({
        inline: true,
        placement: 'absleft',
        pickerPosition: "top left ",
    });
    // JS to make password visible

    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('.toggle-password');
        const passwordField = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Optionally toggle icon appearance
            this.textContent = type === 'password' ? '👁️' : '🙈';
        });
    });
    </script>
    <script>
    window.addEventListener("load", () => {
        const loader = document.getElementById("pageLoader");
        if (loader) {
            loader.style.opacity = "0";
            loader.style.transition = "opacity 0.4s ease";
            setTimeout(() => loader.remove(), 400);
        }
    });
    </script>


</body>

</html>