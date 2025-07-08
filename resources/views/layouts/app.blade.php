<!doctype html>
<html lang="en">
<head>
   @include('layouts.pre_header')
</head>

<body>
    @include('layouts.header')
<main>
    @yield('content')
</main>
@include('layouts.footer')
@yield('scripts')

</body>
</html>


