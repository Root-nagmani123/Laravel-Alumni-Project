@extends('layouts.app')

@section('title', 'Group Post - Alumni | Lal Bahadur Shastri National Academy of Administration')

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

                                    if (Auth::guard('user')->check()) {
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
                                    $profileImage = $user->profile_pic ? asset('storage/' . $user->profile_pic) :
                                    asset('feed_assets/images/avatar-1.png');
                                    $displayName = $user->name ?? 'Guest User';
                                    $designation = $user->designation ?? 'Guest';
                                    $profileLink = url('/user/profile/' . ($user->id ?? 0));
                                    @endphp
                                    <div class="avatar avatar-lg mt-n5 mb-3">
                                        <a href="#!"><img class="avatar-img rounded-circle"
                                                src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('feed_assets/images/avatar-1.png') }}"
                                                alt=""></a>
                                    </div>
                                    <!-- Info -->
                                    @if(Auth::guard('user')->check())
                                    <h5 class="mb-0"> <a href="#!">{{ Auth::guard('user')->user()->name }} </a> </h5>
                                    @endif
                                    <small>{{ Auth::guard('user')->user()->designation }}</small>
                                    <ul class="list-inline mb-0 text-center text-sm-start mt-3 mt-sm-0">
                                        <li class="list-inline-item"><i class="bi bi-briefcase me-1"></i>
                                            {{ $user->current_designation }}
                                        </li>
                                        <li class="list-inline-item"><i class="bi bi-backpack me-1"></i>
                                            {{ $user->batch }}</li>
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
        <div class="col-lg-9">
            <div class="bg-mode p-4">
                <h1 class="h4 mb-4">{{ $group->name }} : Group Posts</h1>

                @forelse($posts as $post)
        @php
            $validMedia = $post->media->filter(function($media) {
            return file_exists(storage_path('app/public/' . $media->file_path));
            });

            $imageMedia = $validMedia->where('file_type', 'image')->values();
             $totalImages = $imageMedia->count();
            @endphp
               <!-- <?php  //print_r($imageMedia); ?> -->
                <div class="card bg-transparent border-0 rounded mb-4">
                    <div class="row g-3">
                        <div class="col-4">

                             @if($totalImages === 1)
            <div class="post-img mt-2">
                <a href="{{ asset('storage/' . $imageMedia[0]->file_path) }}" class="glightbox"
                    data-gallery="post-gallery-{{ $post->id }}">
                    <img src="{{ asset('storage/' . $imageMedia[0]->file_path) }}" loading="lazy" class="w-100 rounded"
                        alt="Post Image" style="width: 100%; height: 200px;object-fit: cover;">
                </a>
            </div>
            @elseif($totalImages > 1)
            <div class="post-img d-flex justify-content-between flex-wrap gap-2 gap-lg-3 mt-2">
                @foreach($imageMedia->take(4) as $index => $media)
                <div class="position-relative" style="width: 48%;">
                    <a href="{{ asset('storage/' . $media->file_path) }}" class="glightbox"
                        data-gallery="post-gallery-{{ $post->id }}">
                        <img src="{{ asset('storage/' . $media->file_path) }}" alt="Post Image" loading="lazy"
                            class="w-100">
                    </a>
                    @if($index === 3 && $totalImages > 4)
                    {{-- Hidden extra images --}}
                    @foreach($imageMedia->slice(4) as $extra)
                    <a href="{{ asset('storage/' . $extra->file_path) }}" class="glightbox d-none"
                        data-gallery="post-gallery-{{ $post->id }}"></a>
                    @endforeach

                    {{-- Overlay link to trigger the rest of the images --}}
                    <a href="{{ asset('storage/' . $imageMedia[4]->file_path) }}"
                        class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white glightbox"
                        style="background-color: rgba(0,0,0,0.6); font-size: 2rem; cursor: pointer;"
                        data-gallery="post-gallery-{{ $post->id }}">
                        +{{ $totalImages - 4 }}
                    </a>
                    @endif
                </div>

                @endforeach
            </div>
            @endif
                            <!-- <img class="rounded w-100" src="{{ asset('feed_assets/images/post/4by3/03.jpg') }}"
                                alt="Default Image"> -->

                        </div>
                        <div class="col-8">

                            <h5 class="fw-bold">Created by: {{ $post->member->name ?? 'Anonymous' }}</h5>
                            <div class="d-none d-sm-inline-block">
                               <p class="mb-2">{{ \Illuminate\Support\Str::words(strip_tags($post->content), 50, '...') }}</p>



                                @if($post->media_type == 'video' && $post->video_link)
                                <div class="mb-2">
                                    <iframe width="100%" height="200" src="{{ $post->video_link }}" frameborder="0"
                                        allowfullscreen></iframe>
                                </div>
                                @endif


                                <a class="small text-secondary" href="#!">
                                    <i class="bi bi-calendar-date pe-1"></i> {{ $post->created_at->format('M d, Y') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @empty
                <p>No posts found for this group.</p>
                @endforelse


                {{-- {{ $posts->links() }} --}}
            </div>
        </div>


    </div>
</div>
@endsection
