@extends('layouts.app')

@section('title', 'Mentor Mentee - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<style>
.select2-results__option {
    padding-left: 10px !important;
}
</style>

<div class="container">
    <div class="row g-4" style="margin-top:5rem !important;">
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
            <div class="bg-mode p-4">
                <h1 class="h4 mb-4">Mentor / Mentee</h1>

                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs mb-3" id="mentorMenteeTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="mentor-tab" data-bs-toggle="tab" data-bs-target="#mentor"
                            type="button" role="tab">Wants to become Mentor</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="mentee-tab" data-bs-toggle="tab" data-bs-target="#mentee"
                            type="button" role="tab">Wants to become Mentee</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="requests-tab" data-bs-toggle="tab" data-bs-target="#requests"
                            type="button" role="tab">Requests</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="connections-tab" data-bs-toggle="tab" data-bs-target="#connections"
                            type="button" role="tab">My Connections</button>
                    </li>
                </ul>

                <!-- Tabs Content -->
                <div class="tab-content" id="mentorMenteeTabsContent">

                    <!-- Tab 1: Mentor Form -->
                    <div class="tab-pane fade show active" id="mentor" role="tabpanel">
                        <form action="{{ route('user.mentor.want_become_mentor') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Service</label>
                               <select class="form-select service" name="service" id="service" data-id="want_become_mentor">
                                    <option selected disabled>Select Service</option>
                                    @if($members->isEmpty())
                                        <option disabled>No Services Available</option>
                                    @else
                                        @foreach($members as $member)
                                            <option value="{{ $member->Service }}">{{ $member->Service }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                           <div class="mb-3">
                                <label class="form-label">Year</label>
                                
                                <select class="form-select year-select" name="year[]" multiple="multiple" data-id="want_become_mentor">
                                    <!-- Options will be added dynamically -->
                                </select>
                            </div>


                                <div class="mb-3">
                                    <label class="form-label">Cadre</label>
                                    <select class="form-select select2 cadre"  name="cadre[]" multiple="multiple" data-id="want_become_mentor">
                                     
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Sector</label>
                                    <select class="form-select select2 sector" name="sector[]" multiple="multiple" data-id="want_become_mentor">
                                        <option selected disabled>Select Sector</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Select Mentee</label>
                                    <select class="form-select select2 mentees" multiple="multiple" id="mentees" name="mentees[]" data-id="want_become_mentor">
                                        <option value="" disabled>Select Mentees</option>
                                    </select>
                                </div>
                            <button type="submit" class="btn btn-primary">Submit Mentor Request</button>
                        </form>
                    </div>

                    <!-- Tab 2: Mentee Form -->
                    <div class="tab-pane fade" id="mentee" role="tabpanel">
                        <form action="{{ route('user.mentor.want_become_mentee') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Service</label>
                               <select class="form-select service" name="service" id="service" data-id="want_become_mentee">
                                    <option selected disabled>Select Service</option>
                                    @if($members->isEmpty())
                                        <option disabled>No Services Available</option>
                                    @else
                                        @foreach($members as $member)
                                            <option value="{{ $member->Service }}">{{ $member->Service }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                    <label class="form-label">Year</label>
                                    <select class="form-select year" id="year" name="year" data-id="want_become_mentee">
                                        <option selected disabled>Select Year</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Cadre</label>
                                    <select class="form-select cadre" id="cadre" name="cadre" data-id="want_become_mentee">
                                        <option selected disabled>Select Cadre</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Sector</label>
                                    <select class="form-select sector" id="sector" name="sector" data-id="want_become_mentee">
                                        <option selected disabled>Select Sector</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Select Mentee</label>
                                    <select class="form-select select2 mentees" multiple id="mentees" name="mentees[]" data-id="want_become_mentee">
                                        <option value="" disabled>Select Mentees</option>
                                    </select>
                                </div>
                            <button type="submit" class="btn btn-success">Submit Mentee Request</button>
                        </form>
                    </div>

                    <!-- Tab 3: Requests -->
                    <div class="tab-pane fade" id="requests" role="tabpanel">
                        <h5>Mentor Requests</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Cadre</th>
                                        <th>Year</th>
                                        <th>Sector</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($mentor_requests as $request)
                                    @if($request->status == 2)
                                        <tr>
                                            <td>{{ $request->name }}</td>
                                            <td>{{ $request->cadre }}</td>
                                            <td>{{ $request->batch }}</td>
                                            <td>{{ $request->sector }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('user.request.update') }}" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $request->request_id }}">
                                                    <input type="hidden" name="type" value="mentor"> 
                                                    <input type="hidden" name="status" value="1">
                                                    <button type="submit" class="btn btn-sm btn-success">Accept</button>
                                                </form>
                                                <form method="POST" action="{{ route('user.request.update') }}" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $request->request_id }}">
                                                    <input type="hidden" name="type" value="mentor"> 
                                                    <input type="hidden" name="status" value="3">
                                                    <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No mentor requests</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <h5 class="mt-4">Mentee Requests</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Cadre</th>
                                        <th>Year</th>
                                        <th>Sector</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($mentee_requests as $request)
                                    @if($request->status == 2)

                                        <tr>
                                            <td>{{ $request->name }}</td>
                                            <td>{{ $request->cadre }}</td>
                                            <td>{{ $request->batch }}</td>
                                            <td>{{ $request->sector }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('user.request.update') }}" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $request->request_id }}">
                                                    <input type="hidden" name="type" value="mentee"> 
                                                    <input type="hidden" name="status" value="1">
                                                    <button type="submit" class="btn btn-sm btn-success">Accept</button>
                                                </form>
                                                <form method="POST" action="{{ route('user.request.update') }}" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $request->request_id }}">
                                                    <input type="hidden" name="type" value="mentee"> 
                                                    <input type="hidden" name="status" value="3">
                                                    <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No mentee requests</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                    </div>

                    <!-- Tab 4: Connections -->
                   <div class="tab-pane fade" id="connections" role="tabpanel">
                        <h5>Mentors</h5>
                            <ul class="list-group mb-3">
                                @php
                                    $hasMentor = false;
                                @endphp

                                @foreach (array_merge($mentor_requests->toArray(), $mentor_connections->toArray()) as $mentor)
                                    @if ($mentor->status == 1)
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>{{ $mentor->name }}</span>
                                            <small>{{ $mentor->cadre }} | {{ $mentor->batch }}</small>
                                        </li>
                                        @php $hasMentor = true; @endphp
                                    @endif
                                @endforeach

                                @unless($hasMentor)
                                    <li class="list-group-item text-center">No mentors added</li>
                                @endunless
                            </ul>


                        <h5>Mentees</h5>
                            <ul class="list-group">
                                @php
                                    $hasMentee = false;
                                @endphp

                                @foreach (array_merge($mentee_requests->toArray(), $mentee_connections->toArray()) as $mentee)
                                    @if ($mentee->status == 1)
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>{{ $mentee->name }}</span>
                                            <small>{{ $mentee->cadre }} | {{ $mentee->batch }}</small>
                                        </li>
                                        @php $hasMentee = true; @endphp
                                    @endif
                                @endforeach

                                @unless($hasMentee)
                                    <li class="list-group-item text-center">No mentees added</li>
                                @endunless
                            </ul>

                    </div>

                </div>
            </div>
        </div>



    </div>
</div>
<!-- Select2 -->
 @endsection
 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



@section('scripts')
<script>
$(document).ready(function () {
    // Service change (for both forms)
    // After service selection, populate year
$('.service').on('change', function () {
    let dataId = $(this).data('id');
    let $form = $(this).closest('form');
    let service = $(this).val();
    let $year = $form.find('.year-select[data-id="' + dataId + '"]');
    
    $year.empty().append('<option disabled>Select Year</option>');
    

    $.ajax({
        url: '{{ route("user.get.years") }}',
        type: 'POST',
        data: {
            service: service,
            _token: '{{ csrf_token() }}'
        },
        success: function (response) {
            $.each(response, function (key, value) {
                $year.append('<option value="' + value + '">' + value + '</option>');
            });
            $year.prop('disabled', false);
            $year.select2({ 
                placeholder: "Select Years",
                closeOnSelect: false,
                templateResult: formatCheckbox,
                templateSelection: formatSelection
            });
        }
    });
});


    // Year change
   $('.year-select').on('change', function () {
        let dataId = $(this).data('id');
        let $form = $(this).closest('form');
        let service = $form.find('.service[data-id="' + dataId + '"]').val();
        let years = $(this).val();
        
        let $cadre = $form.find('.cadre[data-id="' + dataId + '"]');
        $cadre.empty().append('');
        $form.find('.sector[data-id="' + dataId + '"]').empty().append('');
        $form.find('.mentees[data-id="' + dataId + '"]').empty().append('');
        $.ajax({
            url: '{{ route("user.get.cadres") }}',
            type: 'POST',
            data: {
                service: service,
                year: years,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                $.each(response, function (key, value) {
                    $cadre.append('<option value="' + value + '">' + value + '</option>');
                });
                $cadre.prop('disabled', false);
            $cadre.select2({ 
                placeholder: "Select cadres",
                closeOnSelect: false,
                templateResult: formatCheckbox,
                templateSelection: formatSelection
            });
            }
        });
    });

    // Cadre change
    $('.cadre').on('change', function () {
        let dataId = $(this).data('id');
        let $form = $(this).closest('form');
        let service = $form.find('.service[data-id="' + dataId + '"]').val();
        let year = $form.find('.year[data-id="' + dataId + '"]').val();
       let cadre = $(this).val();
        let $sector = $form.find('.sector[data-id="' + dataId + '"]');
        $sector.empty().append('');
        $form.find('.mentees[data-id="' + dataId + '"]').empty().append('');
        $.ajax({
            url: '{{ route("user.get.sectors") }}',
            type: 'POST',
            data: {
                service: service,
                year: year,
                cadre: cadre,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                $.each(response, function (key, value) {
                    $sector.append('<option value="' + value + '">' + value + '</option>');
                });
                $sector.prop('disabled', false);
                $sector.select2({ 
                    placeholder: "Select sectors",
                    closeOnSelect: false,
                    templateResult: formatCheckbox,
                    templateSelection: formatSelection
                });
            }
        });
    });

    // Sector change
    $('.sector').on('change', function () {
        let dataId = $(this).data('id');
        let $form = $(this).closest('form');
        let service = $form.find('.service[data-id="' + dataId + '"]').val();
        let year = $form.find('.year[data-id="' + dataId + '"]').val();
        let cadre = $form.find('.cadre[data-id="' + dataId + '"]').val();
        let sector = $(this).val();
        let $mentees = $form.find('.mentees[data-id="' + dataId + '"]');
        $mentees.empty().append('');
        $.ajax({
            url: '{{ route("user.get.mentees") }}',
            type: 'POST',
            data: {
                service: service,
                year: year,
                cadre: cadre,
                sector: sector,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                $.each(response, function (key, user) {
                    $mentees.append('<option value="' + user.id + '">' + user.name + '</option>');
                });
                $mentees.prop('disabled', false);
                $mentees.select2({ 
                    placeholder: "Select Mentees",
                    closeOnSelect: false,
                    templateResult: formatCheckbox,
                    templateSelection: formatSelection
                });
            }
        });
    });

    // Initialize Select2 for both mentee selects
    $('.mentees, .cadre,.sector').select2({
        placeholder: "Select",
    allowClear: true,
    width: '100%'
    });
});
function formatCheckbox(option) {
    if (!option.id) return option.text;

    return $(
        '<span><input type="checkbox" class="me-2"/>' + option.text + '</span>'
    );
}

function formatSelection(option) {
    return option.text;
}

</script>
@endsection