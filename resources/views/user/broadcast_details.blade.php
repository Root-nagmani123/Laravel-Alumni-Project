
@extends('layouts.app')

@section('title', 'Broadcast - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
 <div class="container">
   <div class="row g-4 mt-2">
    <div class="col-3">
        <!-- Advanced filter responsive toggler START -->
                <div class="d-flex align-items-center d-lg-none">
                    <button class="border-0 bg-transparent" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasSideNavbar" aria-controls="offcanvasSideNavbar">
                        <span class="btn btn-primary"><i class="fa-solid fa-sliders-h"></i></span>
                        <span class="h6 mb-0 fw-bold d-lg-none ms-2">My profile</span>
                    </button>
                </div>
                <!-- Advanced filter responsive toggler END -->

                <!-- Navbar START-->
                <nav class="navbar navbar-expand-lg mx-0">
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSideNavbar">
                        <!-- Offcanvas header -->
                        <div class="offcanvas-header">
                            <button type="button" class="btn-close text-reset ms-auto" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                        </div>

                        <!-- Offcanvas body -->
                        <div class="offcanvas-body d-block px-2 px-lg-0">
                            <!-- Card START -->
                            <div class="card overflow-hidden">
                                <!-- Cover image -->
                                <div class="h-50px"
                                     style="background-image:url({{asset('feed_assets/images/bg/01.jpg')}}); background-position: center; background-size: cover; background-repeat: no-repeat;">
                                </div>
                                <!-- Card body START -->
                                <div class="card-body pt-0">
                                    <div class="text-center">
                                        <!-- Avatar -->
                                           @php
    $profileImage = '';
    $displayName = '';
    $designation = '';
    $profileLink = '#';

    if  (Auth::guard('user')->check()) {
        // Member/user post
        $member = $post->member ?? null;

        $profileImage = $member && $member->profile_image
            ? asset('storage/' . $member->profile_image)
            : asset('feed_assets/images/avatar/07.jpg');

        $displayName = $member->name ?? 'Unknown';
        $designation = $member->designation ?? 'Unknown';
        $profileLink = url('/user/profile/' . ($member->id ?? 0));
    }
    else {
        // Default user profile
        $user = Auth::guard('user')->user();
        $profileImage = $user->profile_pic
            ? asset('storage/' . $user->profile_pic)
            : asset('feed_assets/images/avatar-1.png');

        $displayName = $user->name ?? 'Guest User';
        $designation = $user->designation ?? 'Guest';
        $profileLink = url('/user/profile/' . ($user->id ?? 0));
    }
    $user = Auth::guard('user')->user();
    $profileImage = $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('feed_assets/images/avatar-1.png');
    $displayName = $user->name ?? 'Guest User';
    $designation = $user->designation ?? 'Guest';
    $profileLink = url('/user/profile/' . ($user->id ?? 0));
@endphp
                                        <div class="avatar avatar-lg mt-n5 mb-3">
                                            <a href="#!"><img class="avatar-img rounded-circle"
                                                                src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('feed_assets/images/avatar-1.png') }}" alt="" loading="lazy" decoding="async"></a>
                                        </div>
                                        <!-- Info -->
                                        @if(Auth::guard('user')->check())
                                            <h5 class="mb-0"> <a href="#!">{{ Auth::guard('user')->user()->name }} </a> </h5>
                                        @endif
                                        <small>{{ Auth::guard('user')->user()->designation }}</small>
                                        <ul class="list-inline mb-0 text-center text-sm-start mt-3 mt-sm-0">
                        <li class="list-inline-item"><i class="bi bi-briefcase me-1"></i> {{ $user->current_designation }}
                        </li>
                        <li class="list-inline-item"><i class="bi bi-backpack me-1"></i> {{ $user->batch }}</li>
                    </ul>
                                    </div>
                                </div>
                                <!-- Card body END -->
                                <!-- Card footer -->
                                <div class="card-footer text-center py-2">
                                    <a class="btn btn-link btn-sm" href="{{ route('user.profile', ['id' => $user->id]) }}">View Profile </a>
                                </div>
                            </div>
                            <!-- Card END -->
                        </div>
                    </div>
                </nav>
    </div>
       <div class="col-9 vstack gap-4">
           <div class="card card-body">
            <div class="mb-4">
                   <h1 class="mb-2 h2">{{ $broadcast->title }}</h1>
                   @php
    $description = $broadcast->description;
    $wordCount = str_word_count(strip_tags($description));
@endphp

@if ($wordCount > 50)
    <div x-data="{ expanded: false }" class="mt-4">
        <p x-show="!expanded">
            {{ \Illuminate\Support\Str::words($description, 50, '...') }}
            <a href="#" @click.prevent="expanded = true" class="text-danger">Read more</a>
        </p>
        <p x-show="expanded" x-cloak>
            {!! nl2br(e($description)) !!}
            <a href="#" @click.prevent="expanded = false" class="text-danger">Show less</a>
        </p>
    </div>
@else
    <p class="mt-4">{!! nl2br(e($description)) !!}</p>
@endif


               </div>
          @if ($broadcast->image_url)
    <img class="rounded w-100 mb-3" src="{{ asset('storage/' . $broadcast->image_url) }}" alt="Broadcast Image" style="height: 400px; object-fit: cover;" loading="lazy" decoding="async">
@endif

                        @if ($broadcast->video_url)
    <div class="mb-3 rounded overflow-hidden" style="height: 400px;">
        <iframe
            width="100%"
            height="100%"
            src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::after($broadcast->video_url, 'v=') }}"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>
    </div>
@endif


           </div>
       </div>
   </div>
</div>
   @endsection
