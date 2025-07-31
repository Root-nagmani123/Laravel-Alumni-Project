@extends('layouts.app')

@section('title', 'Forum - Alumni | Lal Bahadur Shastri National Academy of Administration')

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
                                <a class="btn btn-link btn-sm"
                                    href="{{ route('user.profile', ['id' => $user->id]) }}">View Profile </a>
                            </div>
                        </div>
                        <!-- Card END -->
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <!-- Card header START -->
                <div class="card-header border-0 pb-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <!-- Avatar -->
                            <div class="avatar me-2">
                                <a href="#!"> <img class="avatar-img rounded-circle" src="assets/images/avatar/04.jpg"
                                        alt=""> </a>
                            </div>
                            <!-- Info -->
                            <div>
                                <div class="nav nav-divider">
                                    <h6 class="nav-item card-title mb-0"> <a href="#!"> Lori Ferguson </a></h6>
                                    <span class="nav-item small"> 2hr</span>
                                </div>
                                <p class="mb-0 small">Web Developer at Webestica</p>
                            </div>
                        </div>
                        <!-- Card feed action dropdown START -->
                        <div class="dropdown">
                            <a href="#" class="text-secondary btn btn-secondary-soft-hover py-1 px-2"
                                id="cardFeedAction" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </a>
                            <!-- Card feed action dropdown menu -->
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardFeedAction">
                                <li><a class="dropdown-item" href="#"> <i class="bi bi-bookmark fa-fw pe-2"></i>Save
                                        post</a></li>
                                <li><a class="dropdown-item" href="#"> <i class="bi bi-person-x fa-fw pe-2"></i>Unfollow
                                        lori ferguson </a></li>
                                <li><a class="dropdown-item" href="#"> <i class="bi bi-x-circle fa-fw pe-2"></i>Hide
                                        post</a></li>
                                <li><a class="dropdown-item" href="#"> <i
                                            class="bi bi-slash-circle fa-fw pe-2"></i>Block</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#"> <i class="bi bi-flag fa-fw pe-2"></i>Report
                                        post</a></li>
                            </ul>
                        </div>
                        <!-- Card feed action dropdown END -->
                    </div>
                </div>
                <!-- Card header END -->
                <!-- Card body START -->
                <div class="card-body">
                    <p>I'm thrilled to share that I've completed a graduate certificate course in project management
                        with the president's honor roll.</p>
                    <!-- Card img -->
                    <img class="card-img" src="assets/images/post/3by2/01.jpg" alt="Post">
                    <!-- Feed react START -->
                    <ul class="nav nav-stack py-3 small">
                        <li class="nav-item">
                            <a class="nav-link active" href="#!" data-bs-container="body" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true" data-bs-custom-class="tooltip-text-start"
                                data-bs-title="Frances Guerrero&lt;br&gt; Lori Stevens&lt;br&gt; Billy Vasquez&lt;br&gt; Judy Nguyen&lt;br&gt; Larry Lawson&lt;br&gt; Amanda Reed&lt;br&gt; Louis Crawford">
                                <i class="bi bi-hand-thumbs-up-fill pe-1"></i>Liked (56)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#!"> <i class="bi bi-chat-fill pe-1"></i>Comments (12)</a>
                        </li>
                        <!-- Card share action START -->
                        <li class="nav-item dropdown ms-sm-auto">
                            <a class="nav-link mb-0" href="#" id="cardShareAction" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-reply-fill flip-horizontal ps-1"></i>Share (3)
                            </a>
                            <!-- Card share action dropdown menu -->
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardShareAction">
                                <li><a class="dropdown-item" href="#"> <i class="bi bi-envelope fa-fw pe-2"></i>Send via
                                        Direct Message</a></li>
                                <li><a class="dropdown-item" href="#"> <i
                                            class="bi bi-bookmark-check fa-fw pe-2"></i>Bookmark </a></li>
                                <li><a class="dropdown-item" href="#"> <i class="bi bi-link fa-fw pe-2"></i>Copy link to
                                        post</a></li>
                                <li><a class="dropdown-item" href="#"> <i class="bi bi-share fa-fw pe-2"></i>Share post
                                        via …</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#"> <i
                                            class="bi bi-pencil-square fa-fw pe-2"></i>Share to News Feed</a></li>
                            </ul>
                        </li>
                        <!-- Card share action END -->
                    </ul>
                    <!-- Feed react END -->

                    <!-- Add comment -->
                    <div class="d-flex mb-3">
                        <!-- Avatar -->
                        <div class="avatar avatar-xs me-2">
                            <a href="#!"> <img class="avatar-img rounded-circle" src="assets/images/avatar/12.jpg"
                                    alt=""> </a>
                        </div>
                        <!-- Comment box  -->
                        <form class="nav nav-item w-100 position-relative">
                            <textarea data-autoresize="" class="form-control pe-5 bg-light" rows="1"
                                placeholder="Add a comment..."></textarea>
                            <button
                                class="nav-link bg-transparent px-3 position-absolute top-50 end-0 translate-middle-y border-0"
                                type="submit">
                                <i class="bi bi-send-fill"> </i>
                            </button>
                        </form>
                    </div>
                    <!-- Comment wrap START -->
                    <ul class="comment-wrap list-unstyled">
                        <!-- Comment item START -->
                        <li class="comment-item">
                            <div class="d-flex position-relative">
                                <!-- Avatar -->
                                <div class="avatar avatar-xs">
                                    <a href="#!"><img class="avatar-img rounded-circle"
                                            src="assets/images/avatar/05.jpg" alt=""></a>
                                </div>
                                <div class="ms-2">
                                    <!-- Comment by -->
                                    <div class="bg-light rounded-start-top-0 p-3 rounded">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-1"> <a href="#!"> Frances Guerrero </a></h6>
                                            <small class="ms-2">5hr</small>
                                        </div>
                                        <p class="small mb-0">Removed demands expense account in outward tedious do.
                                            Particular way thoroughly unaffected projection.</p>
                                    </div>
                                    <!-- Comment react -->
                                    <ul class="nav nav-divider py-2 small">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#!"> Like (3)</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#!"> Reply</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#!"> View 5 replies</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Comment item nested START -->
                            <ul class="comment-item-nested list-unstyled">
                                <!-- Comment item START -->
                                <li class="comment-item">
                                    <div class="d-flex">
                                        <!-- Avatar -->
                                        <div class="avatar avatar-xs">
                                            <a href="#!"><img class="avatar-img rounded-circle"
                                                    src="assets/images/avatar/06.jpg" alt=""></a>
                                        </div>
                                        <!-- Comment by -->
                                        <div class="ms-2">
                                            <div class="bg-light p-3 rounded">
                                                <div class="d-flex justify-content-between">
                                                    <h6 class="mb-1"> <a href="#!"> Lori Stevens </a> </h6>
                                                    <small class="ms-2">2hr</small>
                                                </div>
                                                <p class="small mb-0">See resolved goodness felicity shy civility
                                                    domestic had but Drawings offended yet answered Jennings perceive.
                                                </p>
                                            </div>
                                            <!-- Comment react -->
                                            <ul class="nav nav-divider py-2 small">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#!"> Like (5)</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#!"> Reply</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- Comment item END -->
                                <!-- Comment item START -->
                                <li class="comment-item">
                                    <div class="d-flex">
                                        <!-- Avatar -->
                                        <div class="avatar avatar-story avatar-xs">
                                            <a href="#!"><img class="avatar-img rounded-circle"
                                                    src="assets/images/avatar/07.jpg" alt=""></a>
                                        </div>
                                        <!-- Comment by -->
                                        <div class="ms-2">
                                            <div class="bg-light p-3 rounded">
                                                <div class="d-flex justify-content-between">
                                                    <h6 class="mb-1"> <a href="#!"> Billy Vasquez </a> </h6>
                                                    <small class="ms-2">15min</small>
                                                </div>
                                                <p class="small mb-0">Wishing calling is warrant settled was lucky.</p>
                                            </div>
                                            <!-- Comment react -->
                                            <ul class="nav nav-divider py-2 small">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#!"> Like</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#!"> Reply</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- Comment item END -->
                            </ul>
                            <!-- Load more replies -->
                            <a href="#!" role="button"
                                class="btn btn-link btn-link-loader btn-sm text-secondary d-flex align-items-center mb-3 ms-5"
                                data-bs-toggle="button" aria-pressed="true">
                                <div class="spinner-dots me-2">
                                    <span class="spinner-dot"></span>
                                    <span class="spinner-dot"></span>
                                    <span class="spinner-dot"></span>
                                </div>
                                Load more replies
                            </a>
                            <!-- Comment item nested END -->
                        </li>
                        <!-- Comment item END -->
                        <!-- Comment item START -->
                        <li class="comment-item">
                            <div class="d-flex">
                                <!-- Avatar -->
                                <div class="avatar avatar-xs">
                                    <a href="#!"><img class="avatar-img rounded-circle"
                                            src="assets/images/avatar/05.jpg" alt=""></a>
                                </div>
                                <!-- Comment by -->
                                <div class="ms-2">
                                    <div class="bg-light p-3 rounded">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-1"> <a href="#!"> Frances Guerrero </a> </h6>
                                            <small class="ms-2">4min</small>
                                        </div>
                                        <p class="small mb-0">Removed demands expense account in outward tedious do.
                                            Particular way thoroughly unaffected projection.</p>
                                    </div>
                                    <!-- Comment react -->
                                    <ul class="nav nav-divider pt-2 small">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#!"> Like (1)</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#!"> Reply</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#!"> View 6 replies</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!-- Comment item END -->
                    </ul>
                    <!-- Comment wrap END -->
                </div>
                <!-- Card body END -->
                <!-- Card footer START -->
                <div class="card-footer border-0 pt-0">
                    <!-- Load more comments -->
                    <a href="#!" role="button"
                        class="btn btn-link btn-link-loader btn-sm text-secondary d-flex align-items-center"
                        data-bs-toggle="button" aria-pressed="true">
                        <div class="spinner-dots me-2">
                            <span class="spinner-dot"></span>
                            <span class="spinner-dot"></span>
                            <span class="spinner-dot"></span>
                        </div>
                        Load more comments
                    </a>
                </div>
                <!-- Card footer END -->
            </div>
        </div>
    </div>
</div>
@endsection