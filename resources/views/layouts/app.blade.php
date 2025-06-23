<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Circlehub">
    <meta name="description" content="Circlehub HTML5 Template">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') {{ env('APP_TITLE_SUFFIX') }}</title>
    <link rel="shortcut icon" href="{{asset('admin_assets/images/logos/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('feed_assets/css/style.css')}}">
    <link rel="stylesheet" href="https://img1.digitallocker.gov.in/ux4g/UX4G-CDN-accessibility/css/accesibility-style-v2.1.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>

<body>

    <!-- start preloader -->
    <div class="preloader align-items-center justify-content-center">
        <span class="loader"></span>
    </div>
    <!-- end preloader -->

    <!-- Scroll To Top Start-->
    <button class="scrollToTop d-none d-lg-block"><i class="mat-icon fas fa-angle-double-up"></i></button>
    <!-- Scroll To Top End -->

@include('layouts.header')

    @yield('content')

    @include('layouts.footer')
@yield('scripts')
</body>
</html>
