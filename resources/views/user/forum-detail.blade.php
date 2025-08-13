@extends('layouts.app')

@section('title', $forum->name . ' - Forum | Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container">
    <div class="row g-4" style="margin-top: 100px;">
        <!-- Left Sidebar -->
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
                                    $profileLink = route('user.profile.data', ['id' => $member->id ?? 0]);
                                    }
                                    else {
                                    // Default user profile
                                    $user = Auth::guard('user')->user();
                                    $profileImage = $user->profile_pic
                                    ? asset('storage/' . $user->profile_pic)
                                    : asset('feed_assets/images/07.png');

                                    $displayName = $user->name ?? 'Guest User';
                                    $designation = $user->designation ?? 'Guest';
                                    $profileLink = route('user.profile.data', ['id' => $user->id ?? 0]);
                                    }
                                    $user = Auth::guard('user')->user();
                                    $profileImage = $user->profile_pic ? asset('storage/' . $user->profile_pic) :
                                    asset('feed_assets/images/avatar-1.png');
                                    $displayName = $user->name ?? 'Guest User';
                                    $designation = $user->designation ?? 'Guest';
                                    $profileLink = route('user.profile.data', ['id' => $user->id ?? 0]);
                                    @endphp
                                    <div class="avatar avatar-lg mt-n5 mb-3">
                                        <a href="{{route('user.profile.data', ['id' => $user->id ?? 0])}}"><img
                                                class="avatar-img rounded-circle qwetyu"
                                                src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}"
                                                alt=""></a>
                                    </div>
                                    <!-- Info -->
                                    @if(Auth::guard('user')->check())
                                    <h5 class="mb-0"> <a
                                            href="{{route('user.profile.data', ['id' => Auth::guard('user')->user()->id])}}">{{ Auth::guard('user')->user()->name }}
                                        </a> </h5>
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
                                <a class="btn btn-link btn-sm"
                                    href="{{ route('user.profile.data', ['id' => $user->id]) }}">View Profile </a>
                            </div>
                        </div>
                        <!-- Card END -->
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">

            <div class="card card-body">

                <!-- Main Question -->
                <div class="d-flex align-items-center mb-3">
    <img src="{{ asset('feed_assets/images/avatar/07.jpg') }}" 
         class="rounded-circle me-3" 
         alt="User" 
         style="width:60px;">
    <div class="d-flex flex-column justify-content-center">
        <h6 class="mb-0 fw-bold">Mrchtopherrr</h6>
        <small class="text-muted">Aug 13, 2025</small>
    </div>
</div>



                <h4 class="fw-bold mb-3">How to free up space in C drive in Windows 10 or Windows 11?</h4>
                <p>
                    I have two budget PCs at my home and both of them only have 128 SSD. Now, the C drive is almost full
                    and the devices are running very slow.
                    I already deleted the large files from the computer and still need help to <strong>free up space in
                        C drive</strong> in Windows 10 and Windows 11.
                    Please share the steps on how to do this efficiently and quickly.
                </p>

                <!-- Actions -->
                <div class="d-flex justify-content-end gap-3 text-muted small mt-3">
                    <a href="#" class="text-decoration-none text-dark"><i class="bi bi-hand-thumbs-up me-1"></i>Like</a>
                    <a href="#" class="text-decoration-none text-dark"><i class="bi bi-reply me-1"></i>Reply</a>
                </div>

                <hr class="my-4">

                <!-- Replies Header -->
                <!-- <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="fw-semibold">2 Replies</span>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                            data-bs-toggle="dropdown">
                            Newest
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Newest</a></li>
                            <li><a class="dropdown-item" href="#">Oldest</a></li>
                        </ul>
                    </div>
                </div> -->

                <!-- Reply 1 -->
                <div class="accordion" id="repliesAccordion">

                    <div class="accordion-item border-0">
                        <h2 class="accordion-header" id="headingReply1">
                            <button class="accordion-button collapsed bg-white px-0" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseReply1" aria-expanded="false"
                                aria-controls="collapseReply1">
                                <div class="d-flex align-items-center w-100">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 fw-bold">Stella-kei</h6>
                                        <small class="text-muted">Aug 13, 2025</small>
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseReply1" class="accordion-collapse collapse" aria-labelledby="headingReply1"
                            data-bs-parent="#repliesAccordion">
                            <div class="accordion-body ps-5">
                                Clearing your browser cache can help free up some space in C drive on Windows 11/10,
                                especially if you browse a lot and store many temporary files.
                                Here's how to clear cache in the most common browsers:
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleComments(topicId) {
    // This function can be used to show/hide comments if needed
    console.log('Toggle comments for topic: ' + topicId);
}
</script>
@endpush