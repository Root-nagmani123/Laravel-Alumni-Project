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
    <!-- Add CSRF token meta -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link id="change-link" rel="stylesheet" type="text/css" href="{{asset('user_assets/css/style.css')}}">
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
    <section class="login-section" style="background-image: url({{asset('user_assets/images/login/login-bg.webp')}});">
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
                                                <h4>Welcome to LBSNAA Alumni, please login using LDAP credentials..</h4>
                                            </div>
                                            <form method="POST" action="{{ route('user.login.submit_ldap') }}">
                                                @csrf
                                                <div class="form-group mb-3">
                                                    <label class="form-label fw-bold">User Name</label>
                                                    <input type="username" name="username" class="form-control"
                                                        placeholder="Enter your username">
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
                                                    <button class="btn btn-sm btn-danger position-relative z-1"
                                                        style="min-width: 120px;">
                                                        Alert
                                                    </button>
                                                </div>

                                                <div class="marquee-container flex-grow-1 d-flex align-items-center ms-2"
                                                    style="overflow: hidden; height: 100%;">
                                                    <div class="marquee-text">
                                                        Helpdesk : Phone: 135-2222346 (Mon–Fri, 9:00 AM–5:30 PM) Email:
                                                        ithelpdesk.lbsnaa@nic.in
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
                                            <form id="otpForm">
                                                @csrf
                                                <div class="form-group mb-3">
                                                    <label class="form-label fw-bold">Email Address</label>
                                                    <input type="email" name="otp_email" id="otp_email"
                                                        class="form-control" placeholder="Enter your email" required>
                                                    <div id="emailError" class="error-message"></div>
                                                    <div id="emailSuccess" class="success-message"></div>
                                                </div>
                                                <div id="otpInputContainer">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label fw-bold">Enter OTP</label>
                                                        <div class="d-flex gap-2">
                                                            <input type="text"
                                                                class="form-control text-center otp-input" maxlength="1"
                                                                pattern="[0-9]*" inputmode="numeric">
                                                            <input type="text"
                                                                class="form-control text-center otp-input" maxlength="1"
                                                                pattern="[0-9]*" inputmode="numeric">
                                                            <input type="text"
                                                                class="form-control text-center otp-input" maxlength="1"
                                                                pattern="[0-9]*" inputmode="numeric">
                                                            <input type="text"
                                                                class="form-control text-center otp-input" maxlength="1"
                                                                pattern="[0-9]*" inputmode="numeric">
                                                            <input type="text"
                                                                class="form-control text-center otp-input" maxlength="1"
                                                                pattern="[0-9]*" inputmode="numeric">
                                                            <input type="text"
                                                                class="form-control text-center otp-input" maxlength="1"
                                                                pattern="[0-9]*" inputmode="numeric">
                                                        </div>

                                                        <!-- Hidden field to store the final OTP -->
                                                        <input type="hidden" name="otp_code" id="otp_code">

                                                        <div id="otpError" class="error-message"></div>
                                                        <div id="otpSuccess" class="success-message"></div>
                                                        <div id="resendOtp">Didn't receive OTP? Resend</div>
                                                    </div>
                                                </div>
                                                <button type="button" id="sendOtpBtn" class="btn btn-success w-100">Send
                                                    OTP</button>
                                                <button type="button" id="verifyOtpBtn"
                                                    class="btn btn-primary w-100 mt-2">Verify OTP</button>
                                            </form>
                                            <div class="text-center mt-3">
                                                <a href="#" onclick="flipCard(event)">Login with LDAP</a>
                                            </div>
                                            <div class="position-relative w-100 bg-light d-flex align-items-center px-3"
                                                style="height: 40px; overflow: hidden; z-index: 1040;">
                                                <div class="position-relative d-flex align-items-center">
                                                    <button class="btn btn-sm btn-danger position-relative z-1"
                                                        style="min-width: 120px;">
                                                        What's New
                                                    </button>
                                                </div>

                                                <div class="marquee-container flex-grow-1 d-flex align-items-center ms-2"
                                                    style="overflow: hidden; height: 100%;">
                                                    <div class="marquee-text">
                                                        Helpdesk : Phone: 135-2222346 (Mon–Fri, 9:00 AM–5:30 PM) Email:
                                                        ithelpdesk.lbsnaa@nic.in
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
document.addEventListener("DOMContentLoaded", function () {
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

    <!-- latest jquery-->
    <script src="{{asset('user_assets/js/jquery-3.6.0.min.js')}}"></script>

    <!-- popper js-->
    <script src="{{asset('user_assets/js/popper.min.js')}}"></script>

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
                    $('#emailSuccess').text('OTP sent successfully!').show();
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
                    const errorMsg = xhr.responseJSON?.error || 'Invalid or expired OTP';
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
    </script>
</body>

</html>