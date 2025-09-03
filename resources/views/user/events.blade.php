
@extends('layouts.app')

@section('title', 'Events - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
    <div class="container">
        <div class="row g-4" style="margin-top:4rem;">

            <!-- Sidenav START -->
            @include('partials.left_sidebar')
            <!-- Sidenav END -->

            <!-- Main content START -->
            <div class="col-md-9 col-lg-6 vstack gap-4">

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
                        <ul class="nav nav-tabs nav-bottom-line justify-content-center justify-content-md-start mb-4" role="tablist">
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
                                                         src="{{ isset($event->image) && $event->image ? asset('storage/' . $event->image) : asset('feed_assets/images/avatar/07.jpg') }}" alt="" style="height: 200px; object-fit: cover;width: 100%;" loading="lazy" decoding="async">
                                                  
                                                </div>
                                                <div class="card-body position-relative pt-0">
                                                    <h6 class="mt-3">
                                                        <a href="">{{ $event->title }}</a>
                                                    </h6>
                                                    <p class="mb-0 small">
                                                        <i class="bi bi-calendar-check pe-1"></i>
                                                        {{ \Carbon\Carbon::parse($event->start_datetime)->format('d M Y') }}
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
                                                @php
    $fullText = strip_tags($event->description);
    $shortText = \Illuminate\Support\Str::words($fullText, 10, '');
@endphp

<p class="event-description" data-full="{{ $fullText }}">
    {{ $shortText }}<span class="dots">...</span>
    <a href="javascript:void(0);" class="read-more">Read More</a>
</p>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".event-description").forEach(function (desc) {
        let fullText = desc.getAttribute("data-full");
        let shortText = desc.innerText.trim().replace("Read More", "").trim();

        let dots = desc.querySelector(".dots");
        let link = desc.querySelector(".read-more");
        let isExpanded = false;

        link.addEventListener("click", function () {
            if (!isExpanded) {
                desc.innerHTML = fullText + ' <a href="javascript:void(0);" class="read-more">View Less</a>';
                isExpanded = true;
                desc.querySelector(".read-more").addEventListener("click", arguments.callee);
            } else {
                desc.innerHTML = shortText + '<span class="dots">...</span> <a href="javascript:void(0);" class="read-more">Read More</a>';
                isExpanded = false;
                desc.querySelector(".read-more").addEventListener("click", arguments.callee);
            }
        });
    });
});
</script>


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
                                                         src="{{ isset($event->image) && $event->image ? asset('storage/' . $event->image) : asset('feed_assets/images/avatar/07.jpg') }}" alt="" loading="lazy" decoding="async">
                                                </div>
                                                <div class="card-body position-relative pt-0">
                                                    <h6 class="mt-3">
                                                        <a href="">{{ $event->title }}</a>
                                                    </h6>
                                                    <p class="mb-0 small">
                                                        <i class="bi bi-calendar-check pe-1"></i>
                                                        {{ \Carbon\Carbon::parse($event->start_datetime)->format('d M Y') }}
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
                                                         src="{{ isset($event->image) && $event->image ? asset('storage/' . $event->image) : asset('feed_assets/images/events/default.jpg') }}" alt="" loading="lazy" decoding="async">
                                                </div>
                                                <div class="card-body position-relative pt-0">
                                                    <h6 class="mt-3">
                                                        <a href="">{{ $event->title }}</a>
                                                    </h6>
                                                    <p class="mb-0 small">
                                                        <i class="bi bi-calendar-check pe-1"></i>
                                                        {{ \Carbon\Carbon::parse($event->start_datetime)->format('d M Y') }}
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
                                                         src="{{ isset($event->image) && $event->image ? asset('storage/' . $event->image) : asset('feed_assets/images/events/default.jpg') }}" alt="" loading="lazy" decoding="async">
                                                </div>
                                                <div class="card-body position-relative pt-0">
                                                    <h6 class="mt-3">
                                                        <a href="">{{ $event->title }}</a>
                                                    </h6>
                                                    <p class="mb-0 small">
                                                        <i class="bi bi-calendar-check pe-1"></i>
                                                        {{ \Carbon\Carbon::parse($event->start_datetime)->format('d M Y') }}
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
<script>
$(document).ready(function() {
    // Attach click handler using event delegation
    $(document).on('change', '.rsvp-select', function(e) {
        e.preventDefault();
        
        let eventId = $(this).data('event-id');
        let status = $(this).val();

        if (!eventId || !status) {
            Swal.fire('Warning', 'Please select a valid RSVP option.', 'warning');
            return;
        }


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
                setTimeout(() => location.reload(), 800);
                //window.location.reload(); // Reload the page to reflect changes
            },
            error: function(xhr) {
                Swal.fire('Error', 'Something went wrong!', 'error');
            }
        });
    });
});
</script>

@endsection