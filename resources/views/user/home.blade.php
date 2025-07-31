@extends('layouts.app')

   @section('title', 'User Feed - Alumni | Lal Bahadur Shastri National Academy of Administration')

   @section('content')
   <style>
    .loading-text {
        position: fixed;
        left: 0;
        top: 0;
        width: 100vw;
        height: 100vh;
        z-index: 9999;
        background-color: #af2910; /* LBSNAA maroon */
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .animate {
        font-size: 2.5rem;
        font-weight: bold;
        color: #fff;
        text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        animation: pulseText 1.2s ease-in-out infinite alternate;
    }

    @keyframes pulseText {
        from {
            transform: scale(1);
            opacity: 0.7;
        }
        to {
            transform: scale(1.1);
            opacity: 1;
        }
    }
</style>
<!-- Loader -->
<div class="loading-text" id="pageLoader">
    <h1 class="animate">LBSNAA Alumni</h1>
</div>

   <div class="container">
       <div class="row g-4">
           
       </div>
   </div>

   @endsection