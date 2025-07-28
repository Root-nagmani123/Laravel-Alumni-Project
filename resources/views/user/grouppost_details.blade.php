
@extends('layouts.app')

@section('title', 'Library - Alumni | Lal Bahadur Shastri National Academy of Administration')

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
                                                                src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('feed_assets/images/avatar-1.png') }}" alt=""></a>
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
                                    <a class="btn btn-link btn-sm" href="my-profile.html">View Profile </a>
                                </div>
                            </div>
                            <!-- Card END -->
                        </div>
                    </div>
                </nav>
    </div>
       <div class="col-lg-9">
  <div class="bg-mode p-4">
    <h1 class="h4 mb-4">Group Posts</h1>

    @forelse($posts as $post)
     
      <div class="card bg-transparent border-0 rounded mb-4">
        <div class="row g-3">
          <div class="col-4">
          
            @if($post->media_path)
              <img class="rounded w-100" src="{{ asset('storage/' . $post->media_path) }}" alt="Post Media">
            @else
              <img class="rounded w-100" src="{{ asset('feed_assets/images/post/4by3/03.jpg') }}" alt="Default Image">
            @endif
          </div>
          <div class="col-8">
           
            <h5 class="fw-bold text-reset">{{ $post->member->name ?? 'Anonymous' }}</h5>
            <div class="d-none d-sm-inline-block">
              <p class="mb-2">{{ $post->content }}</p>

              @if($post->media_type == 'video' && $post->video_link)
                <div class="mb-2">
                  <iframe width="100%" height="200" src="{{ $post->video_link }}" frameborder="0" allowfullscreen></iframe>
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