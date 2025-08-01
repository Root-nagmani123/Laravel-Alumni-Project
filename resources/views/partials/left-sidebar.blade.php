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
    <div class="mb-4">
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
                            style="background-image:url({{asset('user_assets/images/login/login-bg.jpg')}}); background-position: center; background-size: cover; background-repeat: no-repeat;">
                        </div>
                        <!-- Card body START -->
                        <div class="card-body pt-0">
                            <div class="text-center">
                                <!-- Avatar -->
                                <div class="avatar avatar-lg mt-n5 mb-3">
                                    @php
                                    $profilePic = $user->profile_pic ?? null;
                                    @endphp
                                    <img id="existingImage"
                                        src="{{ $profilePic ? asset('storage/' . $profilePic) : asset('feed_assets/images/default.png') }}"
                                        class="rounded-circle avatar-img" height="50" width="50" alt="User" loading="lazy" decoding="async">
                                </div>




                                <!-- Info -->
                                @if(Auth::guard('user')->check())
                                <h5 class="mb-0"> <a href="#!"> {{ Auth::guard('user')->user()->name }} </a> </h5>
                                @endif
                                <small>{{ Auth::guard('user')->user()->designation }}</small>
                                <ul class="list-inline mb-0 text-center text-sm-start mt-3 mt-sm-0">
                                    <li class="list-inline-item"><i class="bi bi-briefcase me-1"></i>
                                        {{ $user->cader }}
                                    </li>
                                    <li class="list-inline-item"><i class="bi bi-backpack me-1"></i>
                                        {{ $user->batch }}
                                    </li>
                                </ul>
                            </div>
                            <!-- Side Nav END -->
                        </div>
                        <!-- Card body END -->
                        <!-- Card footer -->
                        <div class="card-footer text-center py-2">
                            <a class="btn btn-link btn-sm" href="{{ route('user.profile', ['id' => $user->id]) }}">View
                                Profile </a>
                        </div>
                    </div>
                    <!-- Card END -->
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar END-->
    <!-- Card follow START -->
    <div class="mb-4">
        <div class="card mt-4">
            <!-- Card header START -->
            <div class="card-header pb-0 border-0">
                <h5 class="card-title mb-0">Latest Events</h5>
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
                        <a href="#!"><img class="avatar-img rounded-circle"
                                src="{{ isset($event->image) && $event->image ? asset('storage/' . $event->image) : asset('feed_assets/images/avatar/07.jpg') }}"
                                alt="" loading="lazy" decoding="async"></a>
                    </div>

                    <!-- Title -->
                    <div class="overflow-hidden">
                        <a class="h6 mb-0" href="{{ $event->url ?? '#' }}">
                            {{ \Illuminate\Support\Str::limit($event->title, 20) }}</a>
                        <p class="mb-0 small text-truncate">
                            {{ \Carbon\Carbon::parse($event->start_datetime)->format('D, M d, Y \a\t h:i A') }}</p>
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
        <div class="card mt-4">
            <!-- Card header START -->
            <div class="card-header pb-0 border-0">
                <h5 class="card-title mb-0">Forums</h5>
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
                        <a href="{{ route('user.forum.show', ['id' => $forum->id]) }}"><img
                                class="avatar-img rounded-circle"
                                src="{{ asset('storage/uploads/images/forums_img/' . ($forum->images ?? 'default-forum.jpg')) }}"
                                alt="" loading="lazy" decoding="async"></a>
                    </div>
                    <!-- Title -->
                    <div class="overflow-hidden">
                        <a class="h6 mb-0" href="{{ route('user.forum.show', ['id' => $forum->id]) }}">{{ $forum->name }} </a> <br>
                       
                        <!-- <small class="text-muted"><b>Start Date:</b> {{ \Carbon\Carbon::parse($forum->created_date ?? now())->format('d-m-Y') }}</small><br> -->
                        <small class="text-muted"><b>End Date:</b> {{ \Carbon\Carbon::parse($forum->end_date ?? now())->format('d-m-Y') }}</small>
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
    <script>
$(document).ready(function() {
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