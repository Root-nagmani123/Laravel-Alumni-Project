@extends('layouts.app')

@section('title', 'Groups - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container">
    <div class="row g-4" style="margin-top: 5rem;">
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
                                    href="{{ route('user.profile', ['id' => $user->id]) }}">View Profile </a>
                            </div>
                        </div>
                        <!-- Card END -->
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            @php use Carbon\Carbon; @endphp

<div class="row g-4">
   
 @if(isset($groupNames) && $groupNames->count() > 0)
                @foreach($groupNames as $index => $recent)
        <div class="col-sm-6 col-lg-4">
    <div class="card border h-100 d-flex flex-column">
        <div class="h-100px rounded-top"
             style="height: 100px; background-image:url({{ asset('storage/uploads/images/grp_img/' . ($recent->image ?? 'default-group.png')) }}); background-position: center; background-size: cover;">
        </div>

        <div class="card-body text-center pt-0 flex-grow-1 d-flex flex-column justify-content-between">
            <div>
                <!-- <div class="avatar avatar-lg mt-n5 mb-3">
                    <a href="#"><img
                        class="avatar-img rounded-circle border border-white border-3 bg-white"
                        src="{{ asset('storage/uploads/images/grp_img/' . ($recent->image ?? 'default-group.png')) }}"
                        alt="" loading="lazy"></a>
                </div> -->

                <h5 class="mb-0 mt-3">
                    <a href="{{ route('user.group-post', $recent->id) }}">{{ $recent->name }}</a>
                </h5>

                <p class="small text-muted mb-1">End Date: {{ \Carbon\Carbon::parse($recent->end_date ?? now())->format('d-m-Y') }}</p>
                <p class="small text-muted mb-1">Created By : {{ $recent->created_by }}</p>
                <div class="hstack gap-2 gap-xl-3 justify-content-center mt-3">
                              <!-- Group stat item -->
                              <div>
                                <h6 class="mb-0">250</h6>
                                <small>Members</small>
                              </div>
                              <!-- Divider -->
                              <div class="vr"></div>
                              <!-- Group stat item -->
                              <div>
                                <h6 class="mb-0">2</h6>
                                <small>Post per day</small>
                              </div>
                            </div>
            </div>
        </div>

        <div class="card-footer text-center mt-auto">
            @if($recent->end_date && Carbon::parse($recent->end_date)->isFuture())
                <span class="badge bg-success-soft text-success mb-2 d-block">Group Active</span>
                <a href="{{ route('user.group-post', $recent->id) }}" class="btn btn-primary btn-sm">View Group</a>
            @else
                <span class="badge bg-danger-soft text-danger mb-2 d-block">Group Expired</span>
                @if($recent->member_type == '2' && $recent->created_by == Auth::guard('user')->user()->id)
                    <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#activateGroupModal"
                            data-group-id="{{ $recent->id }}"
                            data-group-name="{{ $recent->name }}">
                        Activate Group
                    </button>
                @endif
            @endif
        </div>
    </div>
</div>

        @endforeach
        @else
        <div class="col-12">
            <div class="alert alert-info" role="alert">
                No groups available. Please create a group to get started.
            </div>

        </div>
        @endif
    </div>
</div>
<!-- Activate Group Modal -->
<div class="modal fade" id="activateGroupModal" tabindex="-1" aria-labelledby="activateGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('user.group.activate-group') }}">
            @csrf
            <input type="hidden" name="group_id" id="modal-group-id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Activate Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>You are about to activate the group: <strong id="modal-group-name"></strong></p>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Select New Expiry Date</label>
                        <input type="date" name="end_date" class="form-control" required>
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
    document.addEventListener('DOMContentLoaded', function () {
        const activateGroupModal = document.getElementById('activateGroupModal');
        activateGroupModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const groupId = button.getAttribute('data-group-id');
            const groupName = button.getAttribute('data-group-name');

            document.getElementById('modal-group-id').value = groupId;
            document.getElementById('modal-group-name').textContent = groupName;
        });
    });
</script>

@endsection