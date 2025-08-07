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
                                                alt="" loading="lazy" decoding="async"></a>
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
                                    href="{{ route('user.profile.data', ['id' => $user->id]) }}">View Profile </a>
                            </div>
                        </div>
                        <!-- Card END -->
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            @php
            use Carbon\Carbon; 
            $now = Carbon::now();
            @endphp

            <div class="row g-4">
                @if(isset($forums) && count($forums) > 0)
                @foreach($forums as $forum)
                @php
                $isExpired = Carbon::parse($forum->end_date)->lt($now);
                @endphp

                <div class="col-sm-6 col-lg-4">
                    <div class="card border {{ $isExpired ? 'border-danger' : '' }}">
                        <div class="h-80px rounded-top"
                            style="background-image:url({{ asset('storage/uploads/images/forums_img/' . ($forum->images ?? 'default-forum.jpg')) }}); background-position: center; background-size: cover;">
                        </div>

                        <div class="card-body text-center pt-2">
                            <h5 class="mb-0">
                                <a href="{{ route('user.forum.show', $forum->id) }}">{{ $forum->name }}</a>
                            </h5>
                        </div>

                        <div class="card-body">
                            <p class="mb-0 small text-muted">Start Date:
                                {{ \Carbon\Carbon::parse($forum->created_at)->format('d M Y') }}</p>
                            <p class="mb-0 small text-muted">End Date:
                                {{ \Carbon\Carbon::parse($forum->end_date)->format('d M Y') }}</p>
                        </div>

                        <div class="card-footer text-center">
                            @if($isExpired)
                            <span class="badge bg-danger-soft text-danger mb-2 d-block">Forum Expired</span>
                            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#activateForumModal" data-forum-id="{{ $forum->id }}"
                                data-forum-name="{{ $forum->name }}">
                                Activate Forum
                            </button>
                            @else
                            <a class="btn btn-success-soft btn-sm"
                                href="{{ route('user.forum.show', $forum->id) }}">View Topics</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="text-muted">No forums available</h5>
                            <p class="text-muted mb-0">You don't have access to any forums yet.</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>
<!-- Activate Forum Modal -->
<div class="modal fade" id="activateForumModal" tabindex="-1" aria-labelledby="activateForumModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('user.forum.activate') }}">
            @csrf
            <input type="hidden" name="forum_id" id="modal-forum-id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="activateForumModalLabel">Activate Forum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p>You're about to activate the forum: <strong id="modal-forum-name"></strong></p>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Select New Expiry Date</label>
                        <input type="date" class="form-control" name="end_date" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Activate</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    const activateModal = document.getElementById('activateForumModal');
    activateModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const forumId = button.getAttribute('data-forum-id');
        const forumName = button.getAttribute('data-forum-name');

        document.getElementById('modal-forum-id').value = forumId;
        document.getElementById('modal-forum-name').textContent = forumName;
    });
</script>

@endsection