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
    <link id="change-link" rel="stylesheet" type="text/css" href="{{asset('user_assets/css/style.css')}}">

</head>

<body>

    <!-- loader start -->
    <div class="loading-text">
        <div>
            <h1 class="animate">LBSNAA Alumni</h1>
        </div>
    </div>
    <!-- loader end -->


    <!-- login section start -->
    <section class="login-section" style="background-image: url({{asset('user_assets/images/login/login-bg.jpg')}});">
        <div class="header-section">
            <div class="logo-sec">
                <a href="#!">

                </a>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-12 mx-auto">
                    <div class="login-form">
                        <div>
                            <div class="logo-sec text-center">
                                <a href="#!"
                                    class="d-flex align-items-center gap-3 text-decoration-none justify-content-center flex-wrap">
                                    <!-- Logo Image -->
                                    <img src="{{ asset('admin_assets/images/logos/lbsnaa_logo.jpg') }}"
                                        alt="LBSNAA Logo" style="height: 60px; object-fit: contain;">

                                    <!-- Text Block -->
                                    <div class="d-flex flex-column text-start">
                                        <span class="mb-0"
                                            style="color: #af2910;font-weight: bold;font-size: 24px;">Alumni</span>
                                        <span style="font-size: 16px; font-weight: 500;color: #000;">
                                            Lal Bahadur Shastri National Academy of Administration
                                        </span>
                                    </div>
                                </a>
                            </div>

                            <hr>
                            <div class="login-title">
                                <h2>Login</h2>
                            </div>
                            <div class="login-discription">
                                <h3>Hello Everyone :)</h3>
                                <h4>Welcome to LBSNAA Alumni, please login to your account.
                                </h4>
                            </div>
                            <div class="form-sec">
                                <div>
                                    <form class="theme-form" method="POST" action="{{ route('user.login.submit') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>

                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                id="exampleInputEmail1" placeholder="Enter your email" name="email"
                                                value="{{ old('email') }}">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror

                                            <i class="input-icon iw-20 ih-20" data-feather="user"></i>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <div class="position-relative">
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" placeholder="Enter your password" name="password">
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

                                            <!-- <i class="input-icon" data-feather="eye-off" width="20" height="20"></i> -->
                                        </div>
                                        <div class="btn-section text-center">
                                            <button type="submit" class="btn btn-primary btn-lg w-100" style="background-color: #af2910; color: #fff; border-color: #af2910;">Login</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login section end -->

    


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

</body>

</html>