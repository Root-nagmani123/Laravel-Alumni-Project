    <!-- Navbar START-->
    <div class="mb-4 left-sidebar-container">
<style>
/* Left Sidebar Responsive Styles */
.left-sidebar-container {
    margin-top: 7rem;
}

.profile-card-body {
    height: 167px;
}

/* Responsive breakpoints */
@media (max-width: 1199.98px) {
    .left-sidebar-container {
        margin-top: 6rem;
    }
    
    .profile-card-body {
        height: auto;
        min-height: 150px;
    }
}

@media (max-width: 991.98px) {
    .left-sidebar-container {
        margin-top: 5rem;
    }
    
    .sidebar-user-name {
        font-size: 1rem;
    }
    
    .sidebar-user-info {
        font-size: 0.8rem;
    }
    
    .profile-card-body {
        min-height: 140px;
    }
}

@media (max-width: 767.98px) {
    .left-sidebar-container {
        margin-top: 4rem;
    }
    
    .h-100px {
        height: 80px !important;
    }
    
    .sidebar-avatar {
        width: 70px !important;
        height: 70px !important;
    }
    
    .sidebar-avatar img {
        width: 70px !important;
        height: 70px !important;
    }
    
    .sidebar-user-name {
        font-size: 0.95rem;
    }
    
    .sidebar-user-info {
        font-size: 0.75rem;
        display: block;
        word-break: break-word;
    }
    
    .sidebar-stats {
        font-size: 0.85rem;
        gap: 0.5rem !important;
    }
    
    .sidebar-divider {
        margin: 0 0.25rem;
    }
    
    .profile-card-body {
        padding: 0.75rem;
        min-height: 130px;
    }
    
    .card-footer .btn {
        font-size: 0.85rem;
        padding: 0.375rem 0.75rem;
    }
}

@media (max-width: 575.98px) {
    .left-sidebar-container {
        margin-top: 3.5rem;
        margin-bottom: 1rem;
    }
    
    .h-100px {
        height: 60px !important;
    }
    
    .sidebar-avatar {
        width: 60px !important;
        height: 60px !important;
        margin-top: -2rem !important;
    }
    
    .sidebar-avatar img {
        width: 60px !important;
        height: 60px !important;
    }
    
    .sidebar-user-name {
        font-size: 0.9rem;
        margin-bottom: 0.25rem !important;
    }
    
    .sidebar-user-info {
        font-size: 0.7rem;
        line-height: 1.3;
    }
    
    .sidebar-stats {
        font-size: 0.75rem;
        margin-top: 0.5rem !important;
    }
    
    .sidebar-stat-item {
        font-size: 0.75rem;
    }
    
    .sidebar-stat-item i {
        font-size: 0.7rem;
    }
    
    .profile-card-body {
        padding: 0.5rem;
        min-height: 120px;
    }
    
    .card-footer {
        padding: 0.5rem;
    }
    
    .card-footer .btn {
        font-size: 0.8rem;
        padding: 0.25rem 0.5rem;
    }
    
    .card-header h5 {
        font-size: 0.95rem;
    }
    
    .card-body {
        padding: 0.75rem;
    }
    
    .hstack.gap-2 {
        gap: 0.5rem !important;
    }
    
    .avatar {
        width: 35px;
        height: 35px;
    }
    
    .avatar img {
        width: 35px;
        height: 35px;
    }
    
    .overflow-hidden .h6 {
        font-size: 0.85rem;
    }
    
    .overflow-hidden small,
    .overflow-hidden p {
        font-size: 0.7rem;
    }
    
    .btn-sm {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
    }
}

@media (max-width: 374.98px) {
    .left-sidebar-container {
        margin-top: 3rem;
    }
    
    .h-100px {
        height: 50px !important;
    }
    
    .sidebar-avatar {
        width: 50px !important;
        height: 50px !important;
    }
    
    .sidebar-avatar img {
        width: 50px !important;
        height: 50px !important;
    }
    
    .sidebar-user-name {
        font-size: 0.85rem;
    }
    
    .sidebar-user-info {
        font-size: 0.65rem;
    }
    
    .sidebar-stats {
        font-size: 0.7rem;
        flex-wrap: wrap;
    }
    
    .sidebar-divider {
        display: none;
    }
    
    .profile-card-body {
        min-height: 110px;
    }
}

/* Event and Forum Cards */
.card-header {
    padding: 0.75rem 1rem;
}

@media (max-width: 575.98px) {
    .card-header {
        padding: 0.5rem 0.75rem;
    }
    
    .dropdown-menu {
        font-size: 0.8rem;
    }
    
    .dropdown-item {
        padding: 0.35rem 0.75rem;
    }
}

/* Ensure cards stack properly on mobile */
@media (max-width: 991.98px) {
    .left-sidebar-container .card {
        margin-bottom: 1rem;
    }
}
</style>
<!-- Card START -->
                    <div class="card">
                        <!-- Cover image -->
                        <div class="h-100px rounded-top"
                            style="background-image:url({{asset('user_assets/images/login/login-bg.webp')}}); background-position: center; background-size: cover; background-repeat: no-repeat;">
                        </div>
                        <!-- Card body START -->
                        <div class="card-body pt-0 profile-card-body">
                            <div class="text-center">
                                <!-- Avatar -->
                                <div class="avatar avatar-lg mt-n5 mb-3 sidebar-avatar">
                                    @php
                                    $profilePic = $user->profile_pic ?? null;
                                    @endphp
                                    <img id="existingImage"
                                        src="{{ $profilePic ? route('secure.file', ['type'=>'profile','path'=>$profilePic]) : asset('feed_assets/images/avatar/07.jpg') }}"
                                        class="rounded-circle avatar-img" alt="User"
                                        loading="lazy" decoding="async">
                                </div>




                                <!-- Info -->
                                @if(Auth::guard('user')->check())
                                <h5 class="mb-0 sidebar-user-name"> <a href="#!"> {{ Auth::guard('user')->user()->name }} </a> </h5>
                                @endif
                                <small class="sidebar-user-info">{{ $user->Service }} | {{ $user->current_designation }}</small>
                                <div class="hstack gap-2 gap-xl-3 justify-content-center mt-3 sidebar-stats">
											<!-- User stat item -->
											<div>
												<li class="list-inline-item"><i class="bi bi-briefcase me-1"></i>
                                        {{ $user->cader }}
											</div>
											<!-- Divider -->
											<div class="vr"></div>
											<!-- User stat item -->
											<div>
												<i class="bi bi-backpack me-1"></i>
                                        {{ $user->batch }}
											</div>
										</div>
                            </div>
                            <!-- Side Nav END -->
                        </div>
                        <!-- Card body END -->
                        <!-- Card footer -->
                        <div class="card-footer text-center py-2">
                           <a class="btn btn-link btn-sm" href="{{ route('user.profile.data', ['id' => Crypt::encrypt($user->id)]) }}">View
                                Profile </a>
                        </div>
                    </div>
                    <!-- Card END -->
    </div>
    <!-- Navbar END-->
    <!-- Card follow START -->
    <div class="mb-4">
        <div class="card">
            <!-- Card header START -->
            <div class="card-header pb-0 border-0">
                <h5 class="card-title mb-0">Current Events</h5>
            </div>
            <!-- Card header END -->
            <!-- Card body START -->
            <div class="card-body">
                <!-- Connection item START -->

                @if(!empty($events) && count($events) > 0)
                @foreach($events->take(4) as $event)
                <div class="hstack gap-2 mb-3" id="event-{{ $event->id }}">
                    <!-- Avatar -->
                    <div class="avatar">
                        <a href="{{ route('user.allevents') }}"><img class="avatar-img rounded-circle"
                                src="{{ isset($event->image) && $event->image ? route('secure.file', ['type'=>'event','path'=>$event->image]) : asset('feed_assets/images/avatar/07.jpg') }}"
                                alt="" loading="lazy" decoding="async"></a>
                    </div>

                    <!-- Title -->
                    <div class="overflow-hidden">
                        <a class="h6 mb-0" href="{{ route('user.allevents') }}">
                            {{ \Illuminate\Support\Str::limit($event->title, 20) }}</a>
                        <p class="mb-0 small text-truncate">
                            <!-- {{ \Carbon\Carbon::parse($event->start_datetime)->format('D, M d, Y \a\t h:i A') }}</p> -->
                                  {{ \Carbon\Carbon::parse($event->start_datetime)->format('d M Y') }}
                        </p>
                    </div>

                    <!-- RSVP Dropdown -->
                    <div class="dropdown ms-auto">
                        <a href="#" class="text-secondary btn btn-secondary-soft-hover py-1 px-2" id="cardFeedAction"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardFeedAction">
                            <li><a class="dropdown-item rsvp-option" href="#" data-event-id="{{ $event->id }}"
                                    data-status="1">
                                    <i class="bi bi-check2-circle fa-fw pe-2"></i>Interested</a></li>
                            <li><a class="dropdown-item rsvp-option" href="#" data-event-id="{{ $event->id }}"
                                    data-status="2">
                                    <i class="bi bi-x-circle fa-fw pe-2"></i>Not interested</a></li>
                            <li><a class="dropdown-item rsvp-option" href="#" data-event-id="{{ $event->id }}"
                                    data-status="3">
                                    <i class="bi bi-dash-circle fa-fw pe-2"></i>Maybe</a></li>
                        </ul>
                    </div>
                </div>
                @endforeach

                <div class="d-grid mt-3">
                    <a class="btn btn-sm btn-primary-soft" href="{{ route('user.allevents') }}">View more</a>
                </div>
                @else
                <p>No events found</p>
                @endif

                <!-- Connection item END -->

                <!-- View more button -->

            </div>
            <!-- Card body END -->
        </div>
    </div>
    <!-- Card follow START -->
    <div class="mb-4">
        <div class="card">
            <!-- Card header START -->
            <div class="card-header d-sm-flex justify-content-between border-0">
                <h5 class="card-title">Forums</h5>
                <a class="btn btn-primary-soft btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#forumModal">
                    Create Forum
                </a>
            </div>
            <!-- Card header END -->
            <!-- Card body START -->
            <div class="card-body">
                <!-- Connection item START -->
                @if(isset($forums) && count($forums) > 0)
                @foreach($forums as $forum)
                <div class="hstack gap-2 mb-3">
                    <!-- Avatar -->
                    <div class="avatar">
                        <a href="{{ route('user.forum.show', ['id' => $forum->enc_id]) }}"><img
                                class="avatar-img rounded-circle"
                               src="{{ isset($forum->images) && $forum->images 
        ? route('secure.file', ['type'=>'forum','path'=>$forum->images]) 
        : asset('feed_assets/images/avatar/01.webp') }}"
                               
                                alt="" loading="lazy" decoding="async"></a>
                    </div>
                    <!-- Title -->
                    <div class="overflow-hidden">
                        <a class="h6 mb-0"
                            href="{{ route('user.forum.show', ['id' => $forum->enc_id]) }}">{{ $forum->name }} </a> <br>

                        <!-- <small class="text-muted"><b>Start Date:</b> {{ \Carbon\Carbon::parse($forum->created_date ?? now())->format('d-m-Y') }}</small><br> -->
                        <small class="text-muted"><b>End Date:</b>
                            {{ \Carbon\Carbon::parse($forum->end_date ?? now())->format('d-m-Y') }}</small>
                    </div>

                </div>

                @endforeach
                <!-- View more button -->
                <div class="d-grid mt-3">
                    <a class="btn btn-sm btn-primary-soft" href="{{ route('user.forum') }}">View more</a>
                </div>
                @else
                <p>No forums to display.</p>
                @endif
                <!-- Connection item END -->


            </div>
            <!-- Card body END -->
        </div>
    </div>
   


    <!-- jQuery and SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script nonce="{{ $cspNonce }}">$(document).ready(function() {
    // Attach click handler using event delegation
    $(document).on('click', '.rsvp-option', function(e) {
        e.preventDefault();

        let eventId = $(this).data('event-id');
        let status = $(this).data('status');

        $.ajax({
            url: "{{ route('user.event.rsvp') }}", // Laravel route
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                event_id: eventId,
                rsvp_status: status
            },
            success: function(response) {
                Swal.fire('Success', response.message, 'success');
                window.location.reload(); // Reload the page to reflect changes
            },
            error: function(xhr) {
                Swal.fire('Error', 'Something went wrong!', 'error');
            }
        });
    });
});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Card News END -->