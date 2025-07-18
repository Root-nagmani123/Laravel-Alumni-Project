
@extends('layouts.app')

@section('title', 'Broadcast - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
 <div class="container">
   <div class="row g-4">
       <div class="vstack gap-4">
           <div class="card card-body">
               @if ($broadcast->image_url)
                   <img class="rounded w-100 mb-3" src="{{ asset('storage/' . $broadcast->image_url) }}" alt="">
               @endif

               @if ($broadcast->video_url)
                   <video src="{{ $broadcast->video_url }}" controls class="w-100 mb-3 rounded"></video>
               @endif

               <div class="mt-4">
                   <h1 class="mb-2 h2">{{ $broadcast->title }}</h1>
                   <p class="mt-4">{{ $broadcast->description }}</p>
               </div>
           </div>
       </div>
   </div>
</div>
   @endsection