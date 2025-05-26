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
                                <a href="#!">
                                    <img src="{{ asset('admin_assets/images/logos/logo.png') }}" alt="logo"
                                        class="img-fluid blur-up lazyload">
                                </a>
                            </div>
                            <hr>
                            <div class="login-title">
                                <h2>Login</h2>
                            </div>
                            <div class="login-discription">
                                <h3>Hello Everyone, Welcome Back</h3>
                                <h4>Welcome to LBSNAA Alumni, please login to your account.
                                </h4>
                            </div>
                            <div class="form-sec">
                                <div>
                                    <form class="theme-form">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                placeholder="Enter email">
                                            <i class="input-icon iw-20 ih-20" data-feather="user"></i>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1"
                                                placeholder="Password">
                                            <i class="input-icon iw-20 ih-20" data-feather="eye"></i>
                                            <!-- <i class="input-icon" data-feather="eye-off" width="20" height="20"></i> -->
                                        </div>
                                        <div class="bottom-sec">
                                            <div class="form-check checkbox_animated">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">remember me</label>
                                            </div>
                                            <a href="#" class="ms-auto forget-password">forget
                                                password?</a>
                                        </div>
                                        <div class="btn-section text-center">
                                            <a href="#" class="btn btn-primary btn-lg">login</a>
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
    </script>

</body>

</html>