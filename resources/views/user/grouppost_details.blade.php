@extends('layouts.app')

@section('title', 'Group Post - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container">
    <div class="row g-4" style="margin-top: 100px;">
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
        <div class="col-9">
            <div class="post-list p-3 rounded mb-4" style="background-color: #af2910; color: #fff;">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h5 mb-0 text-white">{{ $group->name }} : Group Posts</h1>
        
        <!-- Dropdown -->
        <div class="dropdown">
            <a href="#" class="text-white btn btn-sm btn-transparent py-0 px-2" data-bs-toggle="dropdown">
                <i class="bi bi-three-dots-vertical"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#"><i class="bi bi-arrow-bar-right fa-fw pe-2"></i>Leave Group</a></li>
            </ul>
        </div>
    </div>
</div>


                @forelse($posts as $post)
@php
    $validMedia = $post->media->filter(function($media) {
        return file_exists(storage_path('app/public/' . $media->file_path));
    });

    $imageMedia = $validMedia->where('file_type', 'image')->values();
    $totalImages = $imageMedia->count();
@endphp

<div class="card mb-4">
    <!-- Card header START -->
    <div class="card-header border-0 pb-0">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <!-- Avatar -->
                <div class="avatar avatar-story me-2">
                    <a href="#!">
                        <img class="avatar-img rounded-circle" src="{{ asset('storage/' . ($post->member->avatar ?? 'default.jpg')) }}" alt="">
                    </a>
                </div>
                <!-- Info -->
                <div>
                    <div class="nav nav-divider">
                        <h6 class="nav-item card-title mb-0">
                            <a href="#!">{{ $post->member->name ?? 'Anonymous' }}</a>
                        </h6>
                        <span class="nav-item small">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="mb-0 small">{{ $post->member->designation ?? 'Member' }}</p>
                </div>
            </div>
           
        </div>
    </div>
    <!-- Card header END -->

    <!-- Card body START -->
    <div class="card-body">
        <p>{{ \Illuminate\Support\Str::words(strip_tags($post->content), 50, '...') }}</p>

        @if($totalImages === 1)
        <a href="{{ asset('storage/' . $imageMedia[0]->file_path) }}" class="glightbox" data-gallery="post-gallery-{{ $post->id }}">
            <img class="card-img" src="{{ asset('storage/' . $imageMedia[0]->file_path) }}" alt="Post" style="max-height: 400px; object-fit: cover;">
        </a>
        @elseif($totalImages > 1)
        <div class="d-flex flex-wrap gap-2">
            @foreach($imageMedia->take(4) as $index => $media)
            <div class="position-relative" style="width: 48%;">
                <a href="{{ asset('storage/' . $media->file_path) }}" class="glightbox" data-gallery="post-gallery-{{ $post->id }}">
                    <img src="{{ asset('storage/' . $media->file_path) }}" class="img-fluid rounded" alt="Post Image" style="max-height: 400px; object-fit: cover;">>
                </a>
                @if($index === 3 && $totalImages > 4)
                    @foreach($imageMedia->slice(4) as $extra)
                        <a href="{{ asset('storage/' . $extra->file_path) }}" class="glightbox d-none" data-gallery="post-gallery-{{ $post->id }}"></a>
                    @endforeach
                    <a href="{{ asset('storage/' . $imageMedia[4]->file_path) }}" class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white glightbox" style="background-color: rgba(0,0,0,0.6); font-size: 2rem;">
                        +{{ $totalImages - 4 }}
                    </a>
                @endif
            </div>
            @endforeach
        </div>
        @endif

        @if($post->media_type == 'video' && $post->video_link)
        <div class="mt-3">
            <iframe width="100%" height="200" src="{{ $post->video_link }}" frameborder="0" allowfullscreen></iframe>
        </div>
        @endif

        <!-- Reaction Section -->
        <ul class="nav nav-stack py-3 small">
            <li class="nav-item">
                <a class="nav-link active" href="#"><i class="bi bi-hand-thumbs-up-fill pe-1"></i>Liked ({{ $post->likes_count ?? 0 }})</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-chat-fill pe-1"></i>Comments ({{ $post->comments_count ?? 0 }})</a>
            </li>
        </ul>

        <!-- Comment box -->
        <div class="d-flex mb-3">
            <div class="avatar avatar-xs me-2">
                <img class="avatar-img rounded-circle" src="{{ asset('assets/images/avatar/12.jpg') }}" alt="">
            </div>
            <form class="w-100 position-relative">
                <textarea class="form-control pe-5 bg-light" rows="1" placeholder="Add a comment..."></textarea>
                <button class="position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent px-3" type="submit">
                    <i class="bi bi-send-fill"></i>
                </button>
            </form>
        </div>
    </div>
    <!-- Card body END -->
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
