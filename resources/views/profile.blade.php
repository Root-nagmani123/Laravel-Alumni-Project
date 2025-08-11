@extends('layouts.app')

@section('title', 'User Profile - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container">

    <div class="row g-4 py-4" style="margin-top:4rem !important;">
        <!-- Error Messages -->

        <!-- Main content START -->
        <div class="col-lg-8 vstack gap-4">
            <!-- My profile START -->
            <div class="card">
                <!-- Cover image -->
                <div class="h-300px rounded-top"
                    style="background-image:url({{asset('user_assets/images/login/login-bg.jpg')}}); background-position: center; background-size: cover; background-repeat: no-repeat;">
                </div>
                <!-- Card body START -->
                <div class="card-body py-0">
                    <div class="d-sm-flex align-items-start text-center text-sm-start">
                        <div>
                            <!-- Avatar -->
                            <div class="avatar avatar-xxl mt-n5 mb-3">
                                <img class="avatar-img rounded-circle border border-white border-3"
                                    src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}"
                                    alt="" loading="lazy" decoding="async">
                            </div>
                        </div>
                        <div class="ms-sm-4 mt-sm-3">
                            <!-- Info -->
                            @if(Auth::guard('user')->check())
                            <h1 class="mb-0 h5">{{-- Auth::guard('user')->user()->name --}}
                                {{ $user->name }}</h1>
                            @endif
                            <ul class="list-inline mb-0 text-center text-sm-start mt-3 mt-sm-0">
                                <li class="list-inline-item"><i class="bi bi-file-person me-1"></i>
                                </li>
                                <li class="list-inline-item"><i class="bi bi-collection me-1"></i></li>
                            </ul>
                        </div>
                        <!-- Button -->
                        <div class="d-flex mt-3 justify-content-center ms-sm-auto">
                            <!--<button class="btn btn-danger-soft me-2" type="button" data-bs-toggle="modal"
                                   data-bs-target="#editProfileModal">
                                   <i class="bi bi-pencil-fill pe-1"></i> Edit profile
                               </button>-->
                            @if(Auth::guard('user')->check() && Auth::guard('user')->id() == $user->id)
                            <button type="button" class="btn btn-danger-soft me-2" data-bs-toggle="modal"
                                data-bs-target="#editProfileModal">
                                <i class="bi bi-pencil-fill pe-1"></i> Edit profile
                            </button>
                            @endif
                        </div>
                        <!-- modal for edit profile -->

                        <div class="modal fade modal-xl" id="editProfileModal" tabindex="-1"
                            aria-labelledby="editProfileModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Success Message -->

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs mb-3" id="profileTabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="personal-tab" data-bs-toggle="tab"
                                                    data-bs-target="#personal" type="button" role="tab">Personal
                                                    Information</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="education-tab" data-bs-toggle="tab"
                                                    data-bs-target="#education" type="button" role="tab">Educational
                                                    Background</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="professional-tab" data-bs-toggle="tab"
                                                    data-bs-target="#professional" type="button" role="tab">Professional
                                                    Information</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="social_media-tab" data-bs-toggle="tab"
                                                    data-bs-target="#social_media" type="button" role="tab">Social
                                                    Media</button>
                                            </li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content" id="profileTabsContent">
                                            <!-- Personal -->
                                            <div class="tab-pane fade show active" id="personal" role="tabpanel">
                                                <div class="p-3 border rounded bg-light">
                                                    <!-- Personal Information form goes here -->
                                                    <form
                                                        action="{{ route('user.profile.update', ['id' => $user->id]) }}"
                                                        method="post" id="myForm" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="form-group">
                                                            <!-- Full Name -->
                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="name">Full
                                                                        Name:</label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" id="name" name="name"
                                                                        value="{{ old('name', $user->name) }}"
                                                                        class="form-control"
                                                                        placeholder="Enter your full name">
                                                                </div>
                                                            </div>

                                                            <!-- Date of Birth -->
                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="date_of_birth">Date
                                                                        of
                                                                        Birth:<span style="color: red">*</span></label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="date" id="date_of_birth"
                                                                        name="date_of_birth"
                                                                        value="{{ old('date_of_birth', \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d')) }}"
                                                                        class="form-control" placeholder="DD/MM/YYYY">
                                                                </div>
                                                            </div>

                                                            <!-- Place of Birth -->
                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="place_of_birth">Place
                                                                        of
                                                                        Birth:<span style="color: red">*</span></label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" id="place_of_birth"
                                                                        name="place_of_birth"
                                                                        value="{{ old('place_of_birth', $user->place_of_birth) }}"
                                                                        class="form-control"
                                                                        placeholder="Enter place of birth">
                                                                </div>
                                                            </div>

                                                            <!-- Gender -->
                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="gender">Gender:<span
                                                                            style="color: red">*</span></label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <select id="gender" name="gender"
                                                                        class="form-control">
                                                                        <option value=""
                                                                            {{ old('gender', $user->gender) == '' ? 'selected' : '' }}>
                                                                            Select
                                                                            gender
                                                                        </option>
                                                                        <option value="male"
                                                                            {{ strtolower(old('gender', $user->gender)) == 'male' ? 'selected' : '' }}>
                                                                            Male
                                                                        </option>
                                                                        <option value="female"
                                                                            {{ strtolower(old('gender', $user->gender)) == 'female' ? 'selected' : '' }}>
                                                                            Female
                                                                        </option>
                                                                        <option value="other"
                                                                            {{ strtolower(old('gender', $user->gender)) == 'other' ? 'selected' : '' }}>
                                                                            Other
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <!-- Phone Number -->
                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="mobile">Phone
                                                                        Number:</label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="tel" id="mobile" name="mobile"
                                                                        value="{{ old('mobile', $user->mobile) }}"
                                                                        required class="form-control"
                                                                        placeholder="Enter 10-digit mobile number">
                                                                </div>
                                                            </div>

                                                            <!-- Address -->
                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="address">Residential
                                                                        Address:<span
                                                                            style="color: red">*</span></label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <textarea id="address" name="address"
                                                                        class="form-control"
                                                                        placeholder="Enter full address">{{ old('address', $user->address) }}</textarea>
                                                                </div>
                                                            </div>

                                                            <!-- Marital Status -->
                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="marital_status">Marital
                                                                        Status:<span style="color: red">*</span></label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <select id="marital_status" name="marital_status"
                                                                        class="form-control">
                                                                        <option value=""
                                                                            {{ old('marital_status', $user->marital_status) == '' ? 'selected' : '' }}>
                                                                            Select
                                                                            status
                                                                        </option>
                                                                        <option value="single"
                                                                            {{ old('marital_status', $user->marital_status) == 'single' ? 'selected' : '' }}>
                                                                            Single
                                                                        </option>
                                                                        <option value="married"
                                                                            {{ old('marital_status', $user->marital_status) == 'married' ? 'selected' : '' }}>
                                                                            Married
                                                                        </option>
                                                                        <option value="divorced"
                                                                            {{ old('marital_status', $user->marital_status) == 'divorced' ? 'selected' : '' }}>
                                                                            Divorced
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <!-- Bio -->
                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="bio">Bio:<span
                                                                            style="color: red">*</span></label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <textarea id="bio" name="bio" class="form-control"
                                                                        placeholder="Write a short bio">{{ old('bio', $user->bio) }}</textarea>
                                                                </div>
                                                            </div>

                                                            <!-- Profile Picture -->
                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="profile_pic">Profile
                                                                        Picture:</label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="file" id="ImageEdit" name="profile_pic"
                                                                        accept="image/*" class="form-control">

                                                                </div>
                                                            </div>
                                                        </div>


                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- Educational -->
                                            <div class="tab-pane fade" id="education" role="tabpanel">
                                                <div class="p-3 border rounded bg-light">
                                                    <!-- Educational Background form goes here -->
                                                    <form
                                                        action="{{ route('user.profile.eduinfo', ['id' => $user->id]) }}"
                                                        method="post" id="myForm" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <!-- Educational Background -->
                                                        <div class="form-group py-3">
                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="school_name">Name
                                                                        of the
                                                                        School:<span style="color: red">*</span></label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" id="school_name"
                                                                        name="school_name"
                                                                        value="{{ old('school_name', $user->school_name) }}"
                                                                        placeholder="Enter your school name"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="school_year">Year
                                                                        of
                                                                        Passing:<span
                                                                            style="color: red">*</span></label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" id="school_year"
                                                                        name="school_year"
                                                                        value="{{ old('school_year', $user->school_year) }}"
                                                                        placeholder="e.g., 2010" class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="undergrad_college">Undergraduate
                                                                        College/University
                                                                        Name:<span style="color: red">*</span></label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" id="undergrad_college"
                                                                        name="undergrad_college"
                                                                        value="{{ old('undergrad_college', $user->undergrad_college) }}"
                                                                        placeholder="Enter college/university name"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="undergrad_degree">Undergraduate
                                                                        Degree
                                                                        Obtained:<span
                                                                            style="color: red">*</span></label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" id="undergrad_degree"
                                                                        name="undergrad_degree"
                                                                        value="{{ old('undergrad_degree', $user->undergrad_degree) }}"
                                                                        placeholder="e.g., B.Sc, B.Tech, B.A"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="undergrad_year">Year
                                                                        of
                                                                        Graduation:<span
                                                                            style="color: red">*</span></label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" id="undergrad_year"
                                                                        name="undergrad_year"
                                                                        value="{{ old('undergrad_year', $user->undergrad_year) }}"
                                                                        placeholder="e.g., 2014" class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="postgrad_college">Postgraduate
                                                                        College/University
                                                                        Name:</label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" id="postgrad_college"
                                                                        name="postgrad_college"
                                                                        value="{{ old('postgrad_college', $user->postgrad_college) }}"
                                                                        placeholder="Enter college/university name"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="postgrad_degree">Postgraduate
                                                                        Degree
                                                                        Obtained:</label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" id="postgrad_degree"
                                                                        name="postgrad_degree"
                                                                        value="{{ old('postgrad_degree', $user->postgrad_degree) }}"
                                                                        placeholder="e.g., M.Sc, M.Tech, MBA"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="postgrad_year">Year
                                                                        of
                                                                        Post Graduation:</label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" id="postgrad_year"
                                                                        name="postgrad_year"
                                                                        value="{{ old('postgrad_year', $user->postgrad_year) }}"
                                                                        placeholder="e.g., 2016" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- Professional -->
                                            <div class="tab-pane fade" id="professional" role="tabpanel">
                                                <div class="p-3 border rounded bg-light">
                                                    <!-- Professional Information form goes here -->
                                                    <form
                                                        action="{{ route('user.profile.proinfo', ['id' => $user->id]) }}"
                                                        method="post" id="myForm" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="form-group">
                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="current_designation">Current
                                                                        Designation:<span
                                                                            style="color: red">*</span></label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" id="current_designation"
                                                                        name="current_designation"
                                                                        value="{{ old('current_designation', $user->current_designation) }}"
                                                                        class="form-control"
                                                                        placeholder="Enter your current designation">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="current_department">Current
                                                                        Department:<span
                                                                            style="color: red">*</span></label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" id="current_department"
                                                                        name="current_department"
                                                                        value="{{ old('current_department', $user->current_department) }}"
                                                                        class="form-control"
                                                                        placeholder="Enter your current department">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="current_location">Current
                                                                        Location:<span
                                                                            style="color: red">*</span></label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" id="current_location"
                                                                        name="current_location"
                                                                        value="{{ old('current_location', $user->current_location) }}"
                                                                        class="form-control"
                                                                        placeholder="Enter your current work location">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="previous_postings">Previous
                                                                        Postings:<span
                                                                            style="color: red">*</span></label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" id="previous_postings"
                                                                        name="previous_postings"
                                                                        value="{{ old('previous_postings', $user->previous_postings) }}"
                                                                        class="form-control"
                                                                        placeholder="List previous postings (comma-separated)">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- social media -->
                                            <div class="tab-pane fade" id="social_media" role="tabpanel">
                                                <div class="p-3 border rounded bg-light">
                                                    <!-- Professional Information form goes here -->
                                                    <form
                                                        action="{{ route('user.profile.social.update', ['id' => $user->id]) }}"
                                                        method="post" id="myForm" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="form-group">
                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="facebook">Facebook:</label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" id="facebook" name="facebook"
                                                                        value="{{ old('facebook', $user->facebook) }}"
                                                                        class="form-control"
                                                                        placeholder="Enter your Facebook profile link">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="instagram">Instagram:</label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" id="instagram" name="instagram"
                                                                        value="{{ old('instagram', $user->instagram) }}"
                                                                        class="form-control"
                                                                        placeholder="Enter your Instagram profile link">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="linkedin">LinkedIn:</label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" id="linkedin" name="linkedin"
                                                                        value="{{ old('linkedin', $user->linkedin) }}"
                                                                        class="form-control"
                                                                        placeholder="Enter your LinkedIn profile link">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="twitter">X(Twitter):</label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" id="twitter" name="twitter"
                                                                        value="{{ old('twitter', $user->twitter) }}"
                                                                        class="form-control"
                                                                        placeholder="Enter your Twitter profile link">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="twitter">e-HRMS URL:</label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" id="e-HREMS" name="e-HREMS"
                                                                        value="" class="form-control"
                                                                        placeholder="Enter your e-HREMS link">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- List profile -->
                    <ul class="list-inline mb-0 text-center text-sm-start mt-3 mt-sm-0">
                        <li class="list-inline-item"><i class="bi bi-briefcase me-1"></i>
                            {{ $user->current_designation }}
                        </li>
                        <li class="list-inline-item"><i class="bi bi-backpack me-1"></i> {{ $user->batch }}</li>
                        <li class="list-inline-item"><i class="bi bi-calendar2-plus me-1"></i>
                            {{ $user->created_at->format('F j, Y') }}</li>
                        </li>
                    </ul>
                </div>
                <!-- Card body END -->
                <div class="card-footer mt-3 pt-2 pb-0">
                    <!-- Nav profile pages -->
                    <ul class="nav nav-tabs justify-content-center justify-content-md-start" id="profileTab"
                        role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="about-tab" data-bs-toggle="tab" href="#about" role="tab"
                                aria-controls="about" aria-selected="false">
                                About
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="groups-tab" data-bs-toggle="tab" href="#media" role="tab"
                                aria-controls="media" aria-selected="false">
                                Media
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="groups-tab" data-bs-toggle="tab" href="#videos" role="tab"
                                aria-controls="videos" aria-selected="false">
                                Videos
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="groups-tab" data-bs-toggle="tab" href="#social" role="tab"
                                aria-controls="social" aria-selected="false">
                                Social Media
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
            <!-- My profile END -->
            <div class="tab-content" id="profileTabContent" role="tabpanel" aria-labelledby="profileTab">
                <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
                    <div class="card">
                        <!-- Card header START -->
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title"> Profile Info</h5>
                        </div>
                        <!-- Card header END -->
                        <!-- Card body START -->
                        <div class="card-body">
                            <div class="rounded border px-3 py-2 mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6>Overview</h6>
                                </div>
                                <p>{{$user->bio}}</p>
                            </div>
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <!-- Birthday START -->
                                    <div class="d-flex align-items-center rounded border px-3 py-2">
                                        <!-- Date -->
                                        <p class="mb-0">
                                            <i class="bi bi-calendar-date fa-fw me-2"></i> Born: <strong>
                                               @if($user->date_of_birth)
            {{ \Carbon\Carbon::parse($user->date_of_birth)->format('d/m/Y') }}
            ({{ \Carbon\Carbon::parse($user->date_of_birth)->age }} years old)
        @else
            Not set
        @endif </strong>
                                        </p>
                                    </div>
                                    <!-- Birthday END -->
                                </div>
                                <div class="col-sm-6">
                                    <!-- Status START -->
                                    <div class="d-flex align-items-center rounded border px-3 py-2">
                                        <!-- Date -->
                                        <p class="mb-0">
                                            <i class="bi bi-heart fa-fw me-2"></i> Status: <strong>
                                                {{ \Illuminate\Support\Str::title(str_replace('_', ' ', $user->marital_status)) }}
</strong>
                                        </p>
                                    </div>
                                    <!-- Status END -->
                                </div>
                                <div class="col-sm-6">
                                    <!-- Designation START -->
                                    <div class="d-flex align-items-center rounded border px-3 py-2">
                                        <!-- Date -->
                                        <p class="mb-0">
                                            <i class="bi bi-briefcase fa-fw me-2"></i> Current Designation:<strong>
                                                {{ $user->current_designation }}
                                            </strong>
                                        </p>
                                    </div>
                                    <!-- Designation END -->
                                </div>
                                <div class="col-sm-6">
                                    <!-- Lives START -->
                                    <div class="d-flex align-items-center rounded border px-3 py-2">
                                        <!-- Date -->
                                        <p class="mb-0">
                                            <i class="bi bi-geo-alt fa-fw me-2"></i> Current Location: <strong>
                                                {{ $user->current_location }}
                                            </strong>
                                        </p>
                                    </div>
                                    <!-- Lives END -->
                                </div>
                                <div class="col-sm-6">
                                    <!-- Joined on START -->
                                    <div class="d-flex align-items-center rounded border px-3 py-2">
                                        <!-- Date -->
                                        <p class="mb-0">
                                            <i class="bi bi-geo-alt fa-fw me-2"></i> Joined on: <strong>
                                                {{$user->created_at->format('F j, Y')}}
                                            </strong>
                                        </p>
                                    </div>
                                    <!-- Joined on END -->
                                </div>
                                <div class="col-sm-6">
                                    <!-- Joined on START -->
                                    <div class="d-flex align-items-center rounded border px-3 py-2">
                                        <!-- Date -->
                                        <p class="mb-0">
                                            <i class="bi bi-envelope fa-fw me-2"></i> Email: <strong>
                                                {{ $user->email }} </strong>
                                        </p>
                                    </div>
                                    <!-- Joined on END -->
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center rounded border px-3 py-2">
                                        <!-- Date -->
                                        <p class="mb-0">
                                            <i class="bi bi-envelope fa-fw me-2"></i> Year of Graduation: <strong>
                                                {{ $user->undergrad_year }} </strong>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center rounded border px-3 py-2">
                                        <!-- Date -->
                                        <p class="mb-0">
                                            <i class="bi bi-envelope fa-fw me-2"></i> Year of Post Graduation: <strong>
                                                {{ $user->postgrad_year }} </strong>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center rounded border px-3 py-2">
                                        <!-- Date -->
                                        <p class="mb-0">
                                            <i class="bi bi-envelope fa-fw me-2"></i> Current Department: <strong>
                                                {{ $user->current_department }} </strong>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center rounded border px-3 py-2">
                                        <!-- Date -->
                                        <p class="mb-0">
                                            <i class="bi bi-envelope fa-fw me-2"></i> Previous Posting: <strong>
                                                {{ $user->previous_postings }} </strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card body END -->
                    </div>
                </div>
                <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
                    <div class="card">
                        <!-- Card header START -->
                        <div class="card-header d-sm-flex align-items-center justify-content-between border-0 pb-0">
                            <h5 class="card-title">Photos</h5>
                        </div>
                        <!-- Card header END -->
                        <!-- Card body START -->
                        <div class="card-body">
                            <!-- Photos of you tab START -->
                            <div class="row g-3">

                                <!-- Photo item START -->
                                @if(!empty($posts) && $posts->count())
                                @foreach($posts as $post)
                                @if(!empty($post->media))
                                @foreach($post->media as $media)
                                @if($media->file_type === 'image')
                                @php
                                $max_length = 50;
                                $relativePath = 'storage/' . str_replace(['app/public/', 'public/'], '',
                                $media->file_path);

                                // Check existence of file in public path
                                $file_path = public_path($relativePath);
                                $image_url = file_exists($file_path) ? asset($relativePath) :
                                asset('feed_assets/images/avatar-1.png');
                                @endphp
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <!-- Photo -->
                                    <a href="{{ $image_url }}" data-gallery="image-popup"
                                        data-glightbox="description: .custom-desc2; descPosition: left;">
                                        <img class="rounded img-fluid" src="{{ $image_url }}" alt=""
                                            style="width: 100%; height: 200px; object-fit: cover;" loading="lazy" decoding="async">
                                    </a>
                                    <div class="mt-2 text-center small text-muted">
                                        <!-- <span>{{ $post->member->name ?? $user->name }}</span><br> -->
                                        <span>{{ $post->created_at ? $post->created_at->format('F j, Y') : '' }}</span>
                                    </div>
                                    <!-- likes -->
                                    <!-- <ul class="nav nav-stack py-2 small">
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="#!"> <i
                                                                    class="bi bi-heart-fill text-danger pe-1"></i>22k </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="#!"> <i class="bi bi-chat-left-text-fill pe-1"></i>3k
                                                            </a>
                                                        </li>
                                                    </ul> -->
                                </div>
                                @endif
                                @endforeach
                                @endif
                                @endforeach
                                @endif
                                <!-- Photo item END -->
                            </div>
                            <!-- Photos of you tab END -->
                        </div>
                        <!-- Card body END -->
                    </div>
                </div>
                <div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="videos-tab">
                    <div class="card">
                        <!-- Card header START -->
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title">Videos</h5>
                            <!-- Button modal -->
                        </div>
                        <!-- Card header END -->
                        <!-- Card body START -->
                        <div class="card-body">

                            <!-- Video old code START -->

                            <!-- <div class="row g-3">
                            @if(!empty($post) && !empty($post->media))
                            @foreach($post->media as $media)
                            @if($media->file_type === 'video')
                            @php
                            $max_length = 50;
                            $relativePath = 'storage/' . str_replace(['app/public/', 'public/'], '',
                            $media->file_path);

                            // Check existence of file in public path
                            $file_path = public_path($relativePath);
                            $image_url = file_exists($file_path) ? asset($relativePath) :
                            asset('feed_assets/images/avatar-1.png');
                            @endphp
                            <div class="col-sm-6 col-md-4">
                                <div class="card p-0 shadow-none border-0 position-relative">
                                    <div class="position-relative">
                                        <img class="rounded" src="assets/images/albums/01.jpg" alt="">
                                        <div class="position-absolute top-0 end-0 p-3">
                                            <a class="icon-md bg-danger text-white rounded-circle" data-glightbox=""
                                                href="assets/images/videos/video-call.mp4"> <i
                                                    class="bi bi-play-fill fs-5"> </i>
                                            </a>
                                        </div>
                                        <div class="position-absolute bottom-0 start-0 p-3 d-flex w-100">
                                            <span
                                                class="bg-dark bg-opacity-50 px-2 rounded text-white small">02:20</span>
                                        </div>
                                    </div>
                                    <div class="card-body px-0 pb-0 pt-2">
                                        <ul class="nav nav-stack small">
                                            <li class="nav-item">
                                                <a class="nav-link" href="#!"> <i
                                                        class="bi bi-heart-fill text-danger pe-1"></i>22k
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#!"> <i
                                                        class="bi bi-chat-left-text-fill pe-1"></i>3k </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            @endif
                        </div> -->
                            <!-- Video old code END -->

                            <!-- Video new code START -->
                            <div class="row g-3">
                                @if($posts->count())
                                @foreach($posts as $post)
                                {{-- Show YouTube Video if video_link exists --}}
                                @if(!empty($post->video_link))
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="ratio ratio-16x9 rounded overflow-hidden">
                                        <iframe class="w-100 h-100"
                                            src="{{ str_contains($post->video_link, 'embed') ? $post->video_link : str_replace('watch?v=', 'embed/', $post->video_link) }}"
                                            title="YouTube video" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                    <div class="mt-2 text-center small text-muted">
                                        <!-- <span>{{ $post->member->name ?? $user->name }}</span><br> -->
                                        <span>{{ $post->created_at ? $post->created_at->format('F j, Y') : '' }}</span>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @endif
                            </div>

                            <!-- Video of you tab END -->
                        </div>
                        <!-- Card body END -->
                        <!-- Card footer START -->
                        <div class="card-footer border-0 pt-0">
                        </div>
                        <!-- Card footer END -->
                    </div>
                </div>
                <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                    <div class="card">
                        <!-- Card header START -->
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title">Social Media</h5>
                        </div>
                        <!-- Card header END -->
                        <!-- Card body START -->
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <!-- Birthday START -->
                                    <div class="d-flex align-items-center rounded border px-3 py-2">
                                        <!-- Date -->
                                        <p class="mb-0">
                                            <i class="bi bi-facebook fa-fw me-2"></i>
                                            @if (!empty($user->facebook))
                                            <a href="{{ $user->facebook }}" target="_blank">{{ $user->facebook }}</a>
                                            @else
                                            N/A
                                            @endif
                                        </p>
                                    </div>
                                    <!-- Birthday END -->
                                </div>
                                <div class="col-sm-6">
                                    <!-- Status START -->
                                    <div class="d-flex align-items-center rounded border px-3 py-2">
                                        <!-- Date -->
                                        <p class="mb-0">
                                            <i class="bi bi-instagram fa-fw me-2"></i>
                                            @if (!empty($user->instagram))
                                            <a href="{{ $user->instagram }}" target="_blank">{{ $user->instagram }}</a>
                                            @else
                                            N/A
                                            @endif
                                        </p>
                                    </div>
                                    <!-- Status END -->
                                </div>
                                <div class="col-sm-6">
                                    <!-- Designation START -->
                                    <div class="d-flex align-items-center rounded border px-3 py-2">
                                        <!-- Date -->
                                        <p class="mb-0">
                                            <i class="bi bi-linkedin fa-fw me-2"></i>
                                            @if (!empty($user->linkedin))
                                            <a href="{{ $user->linkedin }}" target="_blank">{{ $user->linkedin }}</a>
                                            @else
                                            N/A
                                            @endif
                                        </p>
                                    </div>
                                    <!-- Designation END -->
                                </div>
                                <div class="col-sm-6">
                                    <!-- Lives START -->
                                    <div class="d-flex align-items-center rounded border px-3 py-2">
                                        <!-- Date -->
                                        <p class="mb-0">
                                            <i class="bi bi-twitter fa-fw me-2"></i>
                                            @if (!empty($user->twitter))
                                            <a href="{{ $user->twitter }}" target="_blank">{{ $user->twitter }}</a>
                                            @else
                                            N/A
                                            @endif
                                        </p>
                                    </div>
                                    <!-- Lives END -->
                                </div>
                                <div class="col-sm-6">
                                    <!-- Lives START -->
                                    <div class="d-flex align-items-center rounded border px-3 py-2">
                                        <!-- Date -->
                                        <p class="mb-0">
                                            <i class="bi bi-back fa-fw me-2"></i>
                                            {!! $user->ehrms ? '<a href="'.$user->ehrms.'"
                                                target="_blank">'.$user->ehrms.'</a>' : 'N/A' !!}
                                        </p>

                                    </div>
                                    <!-- Lives END -->
                                </div>
                            </div>
                        </div>
                        <!-- Card body END -->
                    </div>
                </div>
                <!-- Edit Comment Modal -->
                <div class="modal fade" id="editCommentModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="{{-- route('user.comments.update') --}}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="comment_id" id="editCommentId">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Comment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <textarea name="comment" id="editCommentText" class="form-control"
                                        rows="3"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right sidebar START -->
        <div class="col-lg-4" style=" position: sticky; top: 80px; max-height: 100vh; overflow-y: auto;">

            <div class="row g-4">

                <!-- Card START -->
                <div class="col-md-6 col-lg-12">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title">About</h5>
                            <!-- Button modal -->
                        </div>
                        <!-- Card body START -->
                        <div class="card-body position-relative pt-0">
                            <p>{{ $user->bio }}</p>
                            <!-- Date time -->
                            <ul class="list-unstyled mt-3 mb-0">
                               <li class="mb-2">
    <i class="bi bi-calendar-date fa-fw pe-1"></i>
    Born:
    <strong>
        @if($user->date_of_birth)
            {{ \Carbon\Carbon::parse($user->date_of_birth)->format('d/m/Y') }}
            ({{ \Carbon\Carbon::parse($user->date_of_birth)->age }} years old)
        @else
            Not set
        @endif
    </strong>
</li>

                                <li class="mb-2"> <i class="bi bi-heart fa-fw pe-1"></i> Status: <strong>
                                        {{ $user->marital_status }}
                                    </strong> </li>
                                <li> <i class="bi bi-envelope fa-fw pe-1"></i> Email: <strong> {{ $user->email }}
                                    </strong> </li>
                            </ul>
                        </div>
                        <!-- Card body END -->
                    </div>
                </div>
                <!-- Card END -->
            </div>

        </div>
        <!-- Right sidebar END -->

    </div> <!-- Row END -->
</div>
<!-- Edit Profile Modal -->

<div class="modal fade" id="feedActionPhoto" tabindex="-1" aria-labelledby="feedActionPhotoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Modal header -->
            <div class="modal-header">
                <h5 class="modal-title" id="feedActionPhotoLabel">Add post photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="d-flex mb-3">
                    <!-- User avatar -->
                    <div class="avatar avatar-xs me-2">
                        @php
                        $profilePic = $user->profile_pic ?? null;
                        @endphp
                        <img class="avatar-img rounded-circle"
                            src="{{ $profilePic ? asset('storage/' . $profilePic) : asset('feed_assets/images/avatar/03.jpg') }}"
                            alt="User Avatar" loading="lazy" decoding="async">
                    </div>
                    <!-- Post textarea -->
                    <textarea class="form-control pe-4 fs-3 lh-1 border-0" name="modalContent" rows="2"
                        placeholder="Share your thoughts..."></textarea>
                </div>

                <!-- File upload -->
                <div class="mb-3">
                    <label class="form-label">Upload attachment</label>
                    <div id="drop-area" class="drop-area p-4 text-center border border-secondary rounded">
                        <i class="bi bi-images fs-1 mb-2 d-block"></i>
                        <span class="d-block">Drag & Drop image here or click to browse.</span>
                        <input type="file" id="media" name="media[]" multiple class="d-none" accept="image/*">
                        <div id="preview" class="mt-3 d-flex flex-wrap gap-3"></div>
                    </div>
                </div>

                <!-- Optional video link -->
                <input class="form-control mt-2" type="text" name="video_link" placeholder="Video Link (optional)" />
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger-soft" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success-soft">Post</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="groupActionpost" tabindex="-1" aria-labelledby="groupActionpostLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" action="{{ route('user.group.post')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Modal header -->
            <div class="modal-header">
                <h5 class="modal-title" id="groupActionpostLabel">Add Group post in <span class="group_name"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="d-flex mb-3">
                    <!-- User avatar -->
                    <div class="avatar avatar-xs me-2">
                        @php
                        $profilePic = $user->profile_pic ?? null;
                        @endphp
                        <img class="avatar-img rounded-circle"
                            src="{{ $profilePic ? asset('storage/' . $profilePic) : asset('feed_assets/images/avatar/03.jpg') }}"
                            alt="User Avatar" loading="lazy" decoding="async">
                    </div>
                    <!-- Post textarea -->
                    <input type="hidden" name="group_id" class="group_id">
                    <textarea class="form-control pe-4 fs-3 lh-1 border-0" name="modalContent" rows="2"
                        placeholder="Share your thoughts..."></textarea>
                </div>

                <!-- File upload -->
                <div class="mb-3">
                    <label class="form-label">Upload attachment</label>
                    <div id="drop-area" class="drop-area p-4 text-center border border-secondary rounded">

                        <i class="bi bi-images fs-1 mb-2 d-block"></i>
                        <span class="d-block">Drag & Drop image here or click to browse.</span>
                        <input type="file" id="media" name="media[]" multiple class="d-none" accept="image/*">
                        <div id="preview" class="mt-3 d-flex flex-wrap gap-3"></div>
                    </div>
                </div>
                <!-- Optional video link -->
                <input class="form-control mt-2" type="text" name="video_link" placeholder="Video Link (optional)" />
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger-soft" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success-soft">Post</button>
            </div>
        </form>
    </div>
</div>
<!-- Modal create Feed photo END -->

@endsection