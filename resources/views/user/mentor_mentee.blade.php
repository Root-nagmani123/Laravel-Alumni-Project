@extends('layouts.app')

@section('title', 'Mentor Mentee - Alumni | Lal Bahadur Shastri National Academy of Administration')

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
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Service</label>
                                <select class="form-select">
                                    <option selected disabled>Select Service</option>
                                    <option value="IAS">Indian Administrative Services - IAS</option>
                                    <option value="IPS">Indian Police Service - IPS</option>
                                    <option value="IFS">Indian Foreign Service - IFS</option>
                                    <option value="IRS">Indian Revenue Service - IRS</option>
                                    <option value="Other">Other</option>

                                </select>
                            </div>
                           <div class="mb-3">
                                <label class="form-label">Year</label>
                                <select class="form-select">
                                    <option selected disabled>Select Year</option>
                                    
                                </select>
                            </div>
                             <div class="mb-3">
                                <label class="form-label">Cadre</label>
                                <select class="form-select">
                                    <option selected disabled>Select Cadre</option>
                                    <option value="IAS">IAS</option>
                                    <option value="IPS">IPS</option>
                                </select>
                            </div>
                             <div class="mb-3">
                                <label class="form-label">Sector</label>
                                <select class="form-select">
                                    <option selected disabled>Select Sector</option>
                                    <option value="Rural and Agriculture">Rural and Agriculture</option>
                                    <option value="Infrastructure">Infrastructure</option>
                                    <option value="Resources">Resources</option>
                                    <option value="Social">Social</option>
                                    <option value="Welfare">Welfare</option>
                                    <option value="Finance and Economy">Finance and Economy</option>
                                    <option value="Commerce and Industry">Commerce and Industry</option>
                                    <option value="Technology">Technology</option>
                                    <option value="Governance">Governance</option>
                                    <option value="Security and Foreign Affairs">Security and Foreign Affairs</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Select Mentee</label>
                                <select class="form-select select2" multiple>
                                    
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Mentor Request</button>
                        </form>
                    </div>

                    <!-- Tab 2: Mentee Form -->
                    <div class="tab-pane fade" id="mentee" role="tabpanel">
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Service</label>
                                <select class="form-select">
                                    <option selected disabled>Select Service</option>
                                    <option value="IAS">Indian Administrative Services - IAS</option>
                                    <option value="IPS">Indian Police Service - IPS</option>
                                    <option value="IFS">Indian Foreign Service - IFS</option>
                                    <option value="IRS">Indian Revenue Service - IRS</option>
                                    <option value="Other">Other</option>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Year</label>
                                <select class="form-select">
                                    <option selected disabled>Select Year</option>
                                    
                                </select>
                            </div>
                             <div class="mb-3">
                                <label class="form-label">Cadre</label>
                                <select class="form-select">
                                    <option selected disabled>Select Cadre</option>
                                    <option value="IAS">IAS</option>
                                    <option value="IPS">IPS</option>
                                </select>
                            </div>
                             <div class="mb-3">
                                <label class="form-label">Sector</label>
                                <select class="form-select">
                                    <option selected disabled>Select Sector</option>
                                    <option value="Rural and Agriculture">Rural and Agriculture</option>
                                    <option value="Infrastructure">Infrastructure</option>
                                    <option value="Resources">Resources</option>
                                    <option value="Social">Social</option>
                                    <option value="Welfare">Welfare</option>
                                    <option value="Finance and Economy">Finance and Economy</option>
                                    <option value="Commerce and Industry">Commerce and Industry</option>
                                    <option value="Technology">Technology</option>
                                    <option value="Governance">Governance</option>
                                    <option value="Security and Foreign Affairs">Security and Foreign Affairs</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Select Mentor</label>
                                <select class="form-select select2" multiple>
                                   
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
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button class="btn btn-sm btn-success">Accept</button>
                                        <button class="btn btn-sm btn-danger">Reject</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-center">No mentor requests</td>
                                </tr>
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
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button class="btn btn-sm btn-success">Accept</button>
                                        <button class="btn btn-sm btn-danger">Reject</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-center">No mentee requests</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Tab 4: Connections -->
                    <div class="tab-pane fade" id="connections" role="tabpanel">
                        <h5>Mentors</h5>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <span></span>
                                <small></small>
                            </li>
                
                            <li class="list-group-item text-center">No mentors added</li>

                        <h5>Mentees</h5>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between">
                                <span></span>
                                <small></small>
                            </li>
                            <li class="list-group-item text-center">No mentees added</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Select members",
        width: '100%'
    });
});
</script>

@endsection