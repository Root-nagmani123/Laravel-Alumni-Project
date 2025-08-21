<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $code ?? 'Error' }} - LBSNAA</title>

  {{-- Bootstrap 5 --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  {{-- Fonts & Theme --}}
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
  <link href="{{ asset('css/lbsnaa-theme.css') }}" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #FF9933, #FFFFFF, #138808); /* tricolor effect */
      background-attachment: fixed;
      background-size: cover;
      color: #000;
      font-family: 'Raleway', sans-serif;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      flex-direction: column;
      overflow: hidden;
    }

    .logo {
      position: absolute;
      top: 20px;
      left: 20px;
      height: 80px;
    }

    .error-code {
      font-size: 10rem;
      font-weight: 700;
      position: relative;
      z-index: 1;
      color: #000;
    }

    .astronaut {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 180px;
      transform: translate(-50%, -50%);
      z-index: 3;
      animation: float 6s ease-in-out infinite, rotate 20s linear infinite;
    }

    @keyframes float {
      0%   { transform: translate(-50%, -50%) translateY(0); }
      50%  { transform: translate(-50%, -50%) translateY(-15px); }
      100% { transform: translate(-50%, -50%) translateY(0); }
    }

    @keyframes rotate {
      0%   { transform: translate(-50%, -50%) rotate(0deg); }
      100% { transform: translate(-50%, -50%) rotate(360deg); }
    }

    .quote {
      font-style: italic;
      font-size: 1.1rem;
      margin-bottom: 20px;
      color: #333;
    }

    .countdown {
      font-weight: 600;
      color: #000;
    }

    .btn-home {
      margin-top: 20px;
      font-weight: 600;
      border-radius: 30px;
      padding: 10px 25px;
    }
  </style>
</head>
<body>

  {{-- LBSNAA Logo --}}
  <img src="{{ asset('admin_assets/images/logos/logo.png') }}" alt="LBSNAA Logo" class="logo">

  {{-- Error Code --}}
  <div class="error-code position-relative">
    <span>{{ $code }}</span>
    <img src="{{ asset('admin_assets/images/astronaut.png') }}" alt="Astronaut" class="astronaut">
  </div>

  {{-- Error Message --}}
  <h2 class="fw-bold mt-3">{{ $title ?? 'Something went wrong' }}</h2>
  
  {{-- Educational Quote --}}
  <p class="quote">
    @if($code == 404)
      "Education is the manifestation of the perfection already in man." – Swami Vivekananda
    @elseif($code == 500)
      "A setback is a setup for a comeback. Learn and rise again."
    @elseif($code == 403)
      "Freedom is not given, it is taken." – Netaji Subhas Chandra Bose
    @elseif($code == 401)
      "Strength does not come from physical capacity. It comes from an indomitable will." – Mahatma Gandhi
    @elseif($code == 419)
      "Time is the best teacher, but unfortunately it kills all its students." – Louis Hector Berlioz
    @elseif($code == 503)
      "Patience is bitter, but its fruit is sweet." – Aristotle
    @else
      "Knowledge is power. Keep learning, keep growing."
    @endif
  </p>

  @php
    $previousUrl = url()->previous();
    $currentUrl = url()->current();
    // if previous page is same as current (direct visit / refresh), fallback to home
    $goBackUrl = ($previousUrl && $previousUrl !== $currentUrl) ? $previousUrl : url('/');
    $isHome = $goBackUrl === url('/');
    $redirectText = $isHome ? 'Home' : 'Previous Page';
    $buttonText = $isHome ? 'Back to Home' : 'Back to Previous Page';
@endphp

{{-- Countdown --}}
<p class="countdown">
  Redirecting to <strong>{{ $redirectText }}</strong> in <span id="timer">00:00:10</span>
</p>

{{-- Back Button --}}
<a href="{{ $goBackUrl }}" class="btn btn-dark btn-home shadow">
  {{ $buttonText }}
</a>

{{-- Script --}}
<script>
  let seconds = 10;
  const timer = document.getElementById("timer");

  const countdown = setInterval(() => {
    seconds--;
    timer.textContent = `00:00:${seconds.toString().padStart(2, '0')}`;
    if (seconds <= 0) {
      clearInterval(countdown);
      window.location.href = "{{ $goBackUrl }}"; 
    }
  }, 1000);
</script>


</body>
</html>
