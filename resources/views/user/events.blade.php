
@extends('layouts.app')

@section('title', 'Events - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
    <div class="container">
        <div class="row g-4">

            <!-- Sidenav START -->
            <div class="col-lg-3">

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
                                        <div class="avatar avatar-lg mt-n5 mb-3">
                                            <a href="#!"><img class="avatar-img rounded border border-white border-3"
                                                                src="{{Auth::guard('user')->user()->profile_pic}}" alt=""></a>
                                        </div>
                                        <!-- Info -->
                                        @if(Auth::guard('user')->check())
                                            <h5 class="mb-0"> <a href="#!">{{ Auth::guard('user')->user()->name }} </a> </h5>
                                        @endif
                                        <small>{{ Auth::guard('user')->user()->designation }}</small>
                                        <p class="mt-3">{{Auth::guard('user')->user()->bio}}</p>

                                        <!-- User stat START -->
                                        <div class="hstack gap-2 gap-xl-3 justify-content-center">
                                            <!-- User stat item -->
                                            <div>
                                                <h6 class="mb-0">256</h6>
                                                <small>Post</small>
                                            </div>
                                            <!-- Divider -->
                                            <div class="vr"></div>
                                            <!-- User stat item -->
                                            <div>
                                                <h6 class="mb-0">2.5K</h6>
                                                <small>Followers</small>
                                            </div>
                                            <!-- Divider -->
                                            <div class="vr"></div>
                                            <!-- User stat item -->
                                            <div>
                                                <h6 class="mb-0">365</h6>
                                                <small>Following</small>
                                            </div>
                                        </div>
                                        <!-- User stat END -->
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
                <!-- Navbar END-->
            </div>
            <!-- Sidenav END -->

            <!-- Main content START -->
            <div class="col-md-8 col-lg-6 vstack gap-4">

                <!-- Event alert START -->

                <!-- Event alert END -->

                <!-- Card START -->
                <div class="card h-100">
                    <!-- Card header START -->
                    <div class="card-header d-sm-flex align-items-center text-center justify-content-sm-between border-0 pb-0">
                        <h1 class="h4 card-title">Discover Events</h1>
                    </div>
                    <!-- Card header END -->
                    <!-- Card body START -->
                    <div class="card-body">

                        <!-- Tab nav line -->
                        <ul class="nav nav-tabs nav-bottom-line justify-content-center justify-content-md-start" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#tab-1" aria-selected="true" role="tab"> All </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab-2" aria-selected="false" tabindex="-1" role="tab"> Interested </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab-3" aria-selected="false" tabindex="-1" role="tab"> Not Interested </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab-4" aria-selected="false" tabindex="-1" role="tab"> Maybe </a>
                            </li>
                        </ul>
                        <!-- Tab content START -->
                        <div class="tab-content mb-0 pb-0">

                            <!-- All Events Tab -->
                            <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
                                <div class="row g-4">
                                    @forelse($events as $event)
                                        <div class="col-sm-6 col-xl-4">
                                            <div class="card h-100">
                                                <div class="position-relative">
                                                    <img class="img-fluid rounded-top"
                                                         src="{{ isset($event->image) && $event->image ? asset('storage/' . $event->image) : asset('feed_assets/images/avatar/07.jpg') }}" alt="" style="height: 200px; object-fit: cover;width: 100%;">
                                                  
                                                </div>
                                                <div class="card-body position-relative pt-0">
                                                    <h6 class="mt-3">
                                                        <a href="">{{ $event->title }}</a>
                                                    </h6>
                                                    <p class="mb-0 small">
                                                        <i class="bi bi-calendar-check pe-1"></i>
                                                        {{ \Carbon\Carbon::parse($event->start_datetime)->format('D, M d, Y \a\t h:i A') }}
                                                    </p>
                                                   <p class="small">
                                                    <i class="bi bi-geo-alt pe-1"></i>
                                                    @if(!empty($event->url))
                                                        <a href="{{ $event->url }}" target="_blank">{{ $event->url }}</a>
                                                    @elseif(!empty($event->location))
                                                        {{ $event->location }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </p>
                                                <p>{{ \Illuminate\Support\Str::words($event->description, 20, '...') }}</p>

                                                </div>
                                                <div class="card-footer" style="border-top: 0;">
                                                    <div class="d-flex mt-3 justify-content-between">
                                                        <div class="w-100">
                                                            <select class="form-select rsvp-select" data-event-id="{{ $event->id }}">
                                                                <option value="" {{ $event->rsvp_status == '' ? 'selected' : '' }}>RSVP</option>
                                                                <option value="1" {{ $event->rsvp_status == 1 ? 'selected' : '' }}>Interested</option>
                                                                <option value="2" {{ $event->rsvp_status == 2 ? 'selected' : '' }}>Not Interested</option>
                                                                <option value="3" {{ $event->rsvp_status == 3 ? 'selected' : '' }}>Maybe</option>
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 text-center">
                                            <p>No events found.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Interested Tab -->
                            <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                <div class="row g-4">
                                    @forelse($accept_events as $event)
                                        <div class="col-sm-6 col-xl-4">
                                            <div class="card h-100">
                                                <div class="position-relative">
                                                    <img class="img-fluid rounded-top"
                                                         src="{{ asset($event->image ?? 'feed_assets/images/events/default.jpg') }}" alt="">
                                                </div>
                                                <div class="card-body position-relative pt-0">
                                                    <h6 class="mt-3">
                                                        <a href="">{{ $event->title }}</a>
                                                    </h6>
                                                    <p class="mb-0 small">
                                                        <i class="bi bi-calendar-check pe-1"></i>
                                                        {{ \Carbon\Carbon::parse($event->start_datetime)->format('D, M d, Y \a\t h:i A') }}
                                                    </p>
                                                    <p class="small">
                                                        <i class="bi bi-geo-alt pe-1"></i>
                                                        {{ $event->location }}
                                                    </p>
                                                    <div class="d-flex mt-3 justify-content-between">
                                                        <div class="w-100">
                                                            <button class="btn btn-sm btn-outline-success d-block">
                                                                <i class="bi bi-check2-circle me-1"></i>
                                                                Interested
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 text-center">
                                            <p>No interested events found.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Not Interested Tab -->
                            

                            <!-- Maybe Tab -->
                            <div class="tab-pane fade" id="tab-4" role="tabpanel">
                                <div class="row g-4">
                                    @forelse($maybe_events as $event)
                                        <div class="col-sm-6 col-xl-4">
                                            <div class="card h-100">
                                                <div class="position-relative">
                                                    <img class="img-fluid rounded-top"
                                                         src="{{ asset($event->image ?? 'feed_assets/images/events/default.jpg') }}" alt="">
                                                </div>
                                                <div class="card-body position-relative pt-0">
                                                    <h6 class="mt-3">
                                                        <a href="">{{ $event->title }}</a>
                                                    </h6>
                                                    <p class="mb-0 small">
                                                        <i class="bi bi-calendar-check pe-1"></i>
                                                        {{ \Carbon\Carbon::parse($event->start_datetime)->format('D, M d, Y \a\t h:i A') }}
                                                    </p>
                                                    <p class="small">
                                                        <i class="bi bi-geo-alt pe-1"></i>
                                                        {{ $event->location }}
                                                    </p>
                                                    <div class="d-flex mt-3 justify-content-between">
                                                        <div class="w-100">
                                                            <button  class="btn btn-sm btn-outline-warning d-block">
                                                                <i class="bi bi-dash-circle me-1"></i>
                                                                Maybe
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 text-center">
                                            <p>No maybe events found.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                <div class="row g-4">
                                    @forelse($decline_events as $event)
                                        <div class="col-sm-6 col-xl-4">
                                            <div class="card h-100">
                                                <div class="position-relative">
                                                    <img class="img-fluid rounded-top"
                                                         src="{{ asset($event->image ?? 'feed_assets/images/events/default.jpg') }}" alt="">
                                                </div>
                                                <div class="card-body position-relative pt-0">
                                                    <h6 class="mt-3">
                                                        <a href="">{{ $event->title }}</a>
                                                    </h6>
                                                    <p class="mb-0 small">
                                                        <i class="bi bi-calendar-check pe-1"></i>
                                                        {{ \Carbon\Carbon::parse($event->start_datetime)->format('D, M d, Y \a\t h:i A') }}
                                                    </p>
                                                    <p class="small">
                                                        <i class="bi bi-geo-alt pe-1"></i>
                                                        {{ $event->location }}
                                                    </p>
                                                    <div class="d-flex mt-3 justify-content-between">
                                                        <div class="w-100">
                                                            <button class="btn btn-sm btn-outline-danger d-block">
                                                                <i class="bi bi-x-circle me-1"></i>
                                                                Not Interested
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 text-center">
                                            <p>No not interested events found.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <!-- Tab content END -->
                    </div>
                    <!-- Card body END -->
                </div>   <!-- Card END -->
            </div>

        </div> <!-- Row END -->
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Attach click handler using event delegation
    $(document).on('change', '.rsvp-select', function(e) {
        e.preventDefault();
        
        let eventId = $(this).data('event-id');
        // Get the selected RSVP status

        let status = $(this).val();

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
@endsection