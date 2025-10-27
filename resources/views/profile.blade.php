@extends('layouts.app')

@section('title', 'User Profile - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container">

    <div class="row g-4" style="margin-top:4rem !important;">
        <!-- Error Messages -->

        <!-- Main content START -->
        <div class="col-lg-12 vstack gap-4">
            <!-- My profile START -->
            <div class="card">
                <!-- Cover image -->
                <div class="h-300px rounded-top"
                    style="background-image:url({{asset('user_assets/images/login/login-bg.webp')}}); background-position: center; background-size: cover; background-repeat: no-repeat;">
                </div>
                <!-- Card body START -->
                <div class="card-body py-0">
                    <div class="d-sm-flex align-items-start text-center text-sm-start">
                        <div>
                            <!-- Avatar -->
                            <div class="avatar avatar-xxl mt-n5 mb-3">
                                
                                <img class="avatar-img rounded-circle border border-white border-3"
                                    src="{{ $user->profile_pic ? route('profile.pic', $user->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}"
                                    alt="" loading="lazy" decoding="async">
                            </div>
                        </div>
                        @if(session('error'))

                        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
                            <div class="toast align-items-center text-bg-danger border-0 show" role="alert"
                                aria-live="assertive" aria-atomic="true">
                                <div class="d-flex" style="display: flex !important;">
                                    <div class="toast-body">
                                        {{ session('error') }}
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                        data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="ms-sm-4 mt-sm-3">
                            <!-- Info -->
                            @if(Auth::guard('user')->check())
                            <h1 class="mb-0 h5">{{-- Auth::guard('user')->user()->name --}}
                                {{ $user->name }}</h1>
                            @endif
                            <ul class="list-inline mb-0 text-center text-sm-start mt-3 mt-sm-0">
                                <li class="list-inline-item">{{ $user->Service }}</li>
                            </ul>
                        </div>
                        <!-- Button -->
                        <div class="d-flex mt-3 justify-content-center ms-sm-auto">
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
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="sector-ministries-tab" data-bs-toggle="tab"
                                                    data-bs-target="#sector-ministries" type="button" role="tab">Sector
                                                    & Ministries</button>
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
                                                                        Picture: <span
                                                                            style="color: red">*</span></label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="file" id="ImageEdit" name="profile_pic"
                                                                        accept="image/*" class="form-control">
                                                                    <div class="mt-2">
                                                                        @if($user->profile_pic)
                                                                        <img id="previewImageEdit"
                                                                            src="{{ asset('storage/' . $user->profile_pic) }}"
                                                                            alt="Profile Picture"
                                                                            style="max-width: 150px;">
                                                                        @endif
                                                                    </div>

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
                                                                        School:</label>
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
                                                                        Passing:</label>
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
                                                                        Name:</label>
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
                                                                        Obtained:</label>
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
                                                                        Graduation:</label>
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
                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <label for="service">Service:<span
                                                                            style="color: red">*</span></label>
                                                                </div>
                                                                <div class="col-9">
                                                                    <!-- <input type="text" id="service" name="service"
                                                                        value="{{ old('service', $user->Service) }}"
                                                                        class="form-control"
                                                                        placeholder="Enter your Service"> -->
                                                                        <select name="service" id="service" class="form-control">
                                                                            <option value="">Select Service</option>
                                                                            @if($Service_data->isEmpty())
                                                                                <option value="" disabled>No services available</option>
                                                                            @else
                                                                                @foreach($Service_data as $Service)
                                                                                    <option value="{{ $Service->Service }}" {{ old('service', $user->Service) == $Service->Service ? 'selected' : '' }}>{{ $Service->Service }}</option>
                                                                                @endforeach
                                                                            @endif
                                                                        </select>
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
                                                        action="{{ route('user.profile.social.update') }}"
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
                                                                    <input type="text" id="ehrms" name="ehrms"
                                                                        value="{{ old('ehrms', $user->ehrms) }}"
                                                                        class="form-control"
                                                                        placeholder="Enter your e-HRMS link">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- sector & ministries -->

                                            <div class="tab-pane fade" id="sector-ministries" role="tabpanel">
                                                <form
                                                    action="{{ route('user.profile.sector_departments.update', ['id' => $user->id]) }}"
                                                    method="post" id="myForm">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row g-4">

                                                        @foreach($departments as $sector => $deptList)
                                                        @php
                                                        // Is sector ke liye user ka stored data nikal lo
                                                        $sectorData = collect($selectedSectors)->firstWhere('name',
                                                        $sector);
                                                        $selectedDepts = $sectorData['departments'] ?? [];
                                                        @endphp

                                                        <div class="col-md-6">
                                                            <div class="card p-3 h-100">
                                                                <label>
                                                                    {{-- Sector checkbox --}}
                                                                    <input type="checkbox"
                                                                        name="sectors[{{ $loop->index }}][name]"
                                                                        value="{{ $sector }}" class="toggle-sector"
                                                                        data-target="#sector-{{ \Illuminate\Support\Str::slug($sector) }}"
                                                                        {{ $sectorData ? 'checked' : '' }}>
                                                                    <strong>{{ $sector }}</strong>
                                                                </label>

                                                                <div id="sector-{{ \Illuminate\Support\Str::slug($sector) }}"
                                                                    class="row mt-3"
                                                                    style="{{ $sectorData ? '' : 'display:none;' }}">

                                                                    @foreach($deptList as $dept)
                                                                    <div class="col-md-6 mb-2">
                                                                        <label>
                                                                            <input type="checkbox"
                                                                                name="sectors[{{ $loop->parent->index }}][departments][]"
                                                                                value="{{ $dept }}"
                                                                                {{ in_array($dept, $selectedDepts) ? 'checked' : '' }}>
                                                                            {{ $dept }}
                                                                        </label>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach


                                                    </div>
                                                    <div class="mt-3">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>

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
                            {{ $user->cader }}</li>
                        </li>
                    </ul>
                </div>
                <!-- Card body END -->
                <div class="card-footer mt-3 pt-2 pb-0">
                    <!-- Nav profile pages -->
                    <ul class="nav nav-tabs justify-content-center justify-content-md-start" id="profileTab"
                        role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="post-tab" data-bs-toggle="tab" href="#post" role="tab"
                                aria-controls="post" aria-selected="false">
                                Post
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="about-tab" data-bs-toggle="tab" href="#about" role="tab"
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
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="groups-tab" data-bs-toggle="tab" href="#sector_ministries" role="tab"
                                aria-controls="sector_ministries" aria-selected="false">
                                Sector & Ministries
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="row">
                <!-- Right sidebar START -->
                <div class="col-lg-4 col-md-12 col-sm-12 left-sidebar">

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
                                        <li> <i class="bi bi-envelope fa-fw pe-1"></i> Email: <strong>
                                                {{ $user->email }}
                                            </strong> </li>
                                    </ul>
                                </div>
                                <!-- Card body END -->
                            </div>
                        </div>
                        <!-- Card END -->
                        <div class="col-md-6 col-lg-12">
                            <div class="card">
                                <!-- Card header START -->
                                <div class="card-header d-sm-flex justify-content-between border-0">
                                    <h5 class="card-title">Photos</h5>
                                    <a class="btn btn-primary-soft btn-sm" href="#!"> See all photo</a>
                                </div>
                                <!-- Card header END -->
                                <!-- Card body START -->
                                <div class="card-body position-relative pt-0">
                                    <div class="row g-3">
                                        @if(!empty($posts) && $posts->count())
                                        @php
                                        // Collect all media images from all posts
                                        $allPhotos = collect();
                                        foreach ($posts as $post) {
                                        if (!empty($post->media) && $post->media->count()) {
                                        foreach ($post->media as $media) {
                                        if ($media->file_type === 'image') {
                                        $allPhotos->push($media);
                                        }
                                        }
                                        }
                                        }
                                        // Limit to 6 images total
                                        $photos = $allPhotos->take(6);
                                        @endphp

                                        @foreach($photos as $media)
                                        @php
                                        $relativePath = 'storage/' . str_replace(['app/public/', 'public/'], '',
                                        $media->file_path);
                                        $file_path = public_path($relativePath);
                                        $image_url = file_exists($file_path)
                                        ? asset($relativePath)
                                        : asset('feed_assets/images/avatar-1.png');
                                        @endphp
                                        <div class="col-6">
                                            <a href="{{ $image_url }}" data-gallery="image-popup" data-glightbox="">
                                                <img class="rounded img-fluid" src="{{ $image_url }}" alt="">
                                            </a>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>

                                </div>
                                <!-- Card body END -->
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Right sidebar END -->
                <div class="col-lg-8 col-sm-12">
                    <!-- My profile END -->
                    <div class="tab-content" id="profileTabContent" role="tabpanel" aria-labelledby="profileTab">
                        <!-- Post tab -->
                        <div class="tab-pane fade show active" id="post" role="tabpanel" aria-labelledby="post-tab">
                            @php
                            $authId = Auth::guard('user')->id();
                            @endphp

                            @if($authId === $user->id)
                            <div class="card card-body mb-4">
                                <div class="d-flex">
                                    <!-- Avatar -->
                                    <div class="avatar avatar-xs me-2">
                                        <a href="{{ route('user.profile.data', ['id' => Crypt::encrypt($user->id)]) }}">
                                            <img class="avatar-img rounded-circle"
                                                src="{{ $user->profile_pic ? route('profile.pic', $user->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}"
                                                alt="" loading="lazy" decoding="async">
                                        </a>
                                    </div>
                                    <!-- Post input -->
                                    <form class="w-100">
                                        <textarea class="form-control pe-4 border-0" rows="2" data-autoresize=""
                                            placeholder="Share your thoughts..." data-bs-toggle="modal"
                                            data-bs-target="#feedActionPhoto"></textarea>
                                    </form>
                                </div>
                                <!-- Share feed toolbar START -->
                                <ul class="nav nav-pills nav-stack small fw-normal">
                                    <li class="nav-item">
                                        <a class="nav-link bg-light py-1 px-2 mb-0" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#feedActionPhoto">
                                            <i class="bi bi-image-fill text-success pe-2"></i>Photos/Videos
                                        </a>
                                    </li>
                                </ul>
                                <!-- Share feed toolbar END -->
                            </div>
                            @endif




                            <!-- Card feed item START -->
                            @foreach($posts as $post)
                            <div class="card mb-4 mx-auto">
                                <!-- Card header START -->
                                <div class="card-header border-0 pb-0">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <!-- Avatar -->
                                            @php
                                            $profileImage = '';
                                            $displayName = '';
                                            $designation = '';
                                            $profileLink = '#';

                                            if ($post->type === 'group_post') {

                                            // Group post ke liye
                                            $profileImage = $post->group_image
                                            ? asset('storage/uploads/images/grp_img/' . $post->group_image)
                                            : asset('feed_assets/images/avatar/07.jpg'); // fallback image

                                            $displayName = $post->group_name ?? 'Unknown Group';
                                            $designation = 'Group Post';
                                            $created_by = $post->member->name;

                                            // Optional: if you have a group detail page
                                            $profileLink = route('user.profile.data', ['id' =>
                                            Crypt::encrypt($post->member->id)]);

                                            $groupLink = route('user.group-post',['id' => ($post->group_id)]);
                                            } else {
                                            // Member/user post
                                            $member = $post->member ?? null;

                                            $profileImage = $member && $member->profile_pic
                                            ? route('profile.pic', $member->profile_pic)
                                            : asset('feed_assets/images/avatar/07.jpg');

                                            $displayName = $member->name ?? 'N/A';
                                            $designation = $member->Service ?? 'N/A';
                                            $profileLink = route('user.profile.data', ['id' =>
                                            Crypt::encrypt($member->id)]);

                                            }
                                            @endphp

                                            <!-- Info -->
                                            <div class="d-flex align-items-center">
                                                <!-- Avatar -->
                                                <div class="me-4 flex-shrink-0 avatar">

                                                    @if($post->type === 'group_post')
                                                    <a href="{{ $groupLink }}">
                                                        <img src="{{ $profileImage }}" alt="Group Picture"
                                                            class="img-fluid avatar-img rounded-circle" loading="lazy"
                                                            decoding="async">
                                                    </a>
                                                    @else
                                                    <a href="{{ $profileLink }}">
                                                        <img src="{{ $profileImage }}" alt="Profile Picture"
                                                            class="img-fluid avatar-img rounded-circle" loading="lazy"
                                                            decoding="async">
                                                    </a>
                                                    @endif
                                                </div>

                                                <!-- Text content -->
                                                <div>
                                                    <!-- Name -->
                                                    @if($post->type === 'group_post')
                                                    <h6 class="mb-1">
                                                        <i class="fa-solid fa-users fa-fw pe-2"></i> <a
                                                            href="{{ $groupLink }}">{{ $displayName }}</a>
                                                    </h6>
                                                    @else
                                                    <h6 class="mb-1">
                                                        <a href="{{ $profileLink }}"
                                                            class="text-dark">{{ $displayName }}</a>
                                                    </h6>
                                                    @endif


                                                    <!-- Group post info + Time -->
                                                    @php
                                                    $createdAt =
                                                    \Carbon\Carbon::parse($post->created_at)->setTimezone('Asia/Kolkata');
                                                    $now = \Carbon\Carbon::now('Asia/Kolkata');
                                                    $diff = $createdAt->diff($now);
                                                    if ($diff->y > 0) {
                                                    $timeDiff = $diff->y . 'y';
                                                    } elseif ($diff->m > 0) {
                                                    $timeDiff = $diff->m . 'mo';
                                                    } elseif ($diff->d > 0) {
                                                    $timeDiff = $diff->d . 'd';
                                                    } elseif ($diff->h > 0) {
                                                    $timeDiff = $diff->h . 'hr';
                                                    } elseif ($diff->i > 0) {
                                                    $timeDiff = $diff->i . 'min';
                                                    } else {
                                                    $timeDiff = 'Just now';
                                                    }
                                                    @endphp

                                                    @if($post->type === 'group_post')
                                                    <p class="mb-1">
                                                        Group Post | <i class="bi bi-person-fill"></i><a
                                                            class="text-dark"
                                                            href="{{ $profileLink }}">{{ $created_by }}</a>
                                                    </p>
                                                    @else
                                                    <!-- Designation -->
                                                    <p class="mb-0">
                                                        {{ $designation }}
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                        <div class="dropdown">
                                            <a href="#" class="text-secondary py-1 px-2" id="cardFeedAction"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $timeDiff }} <i class="bi bi-caret-down fa-fw pe-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="cardFeedAction">
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="bi bi-pen fa-fw pe-2"></i>Edit post
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item " href="#">
                                                        <i class="bi bi-trash fa-fw pe-2"></i>Delete post
                                                    </a>
                                                </li>
                                            </ul>


                                        </div>

                                    </div>
                                </div>
                                <!-- Card header END -->
                                <!-- Card body START -->
                                <div class="card-body">
                                    @php
                                    $fullContent = strip_tags($post->content);
                                    $wordCount = str_word_count($fullContent);
                                    @endphp

                                    @if ($wordCount > 50)
                                    <div x-data="{ expanded: false }">
                                        <p x-show="!expanded">
                                            {{ \Illuminate\Support\Str::words($fullContent, 50, '...') }}
                                            <a href="#" @click.prevent="expanded = true" class="text-danger">Read
                                                more</a>
                                        </p>
                                        <p x-show="expanded" x-cloak>
                                            {!! nl2br(e($post->content)) !!}
                                            <a href="#" @click.prevent="expanded = false" class="text-danger">Show
                                                less</a>
                                        </p>
                                    </div>
                                    @else
                                    <p>{!! nl2br(e($post->content)) !!}</p>
                                    @endif

                                    <!-- Card img -->
                                    @php
                                    $validMedia = $post->media->filter(function($media) {
                                    return file_exists(storage_path('app/public/' . $media->file_path));
                                    });

                                    $imageMedia = $validMedia->where('file_type', 'image')->values();
                                    $videoMedia = $validMedia->where('file_type', 'video')->values();

                                    $totalImages = $imageMedia->count();
                                    $totalVideos = $videoMedia->count();
                                    @endphp
                                    @if($post->video_link)
                                    {{-- Embedded YouTube Video --}}
                                    <div class="ratio ratio-16x9 mt-2">
                                        <iframe height="315" src="{{ $post->video_link }}" title="YouTube video player"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    </div>
                                    @elseif($totalVideos > 0)
                                    {{-- Uploaded Video Files --}}
                                    <div class="post-video mt-2">
                                        @foreach($videoMedia as $video)
                                        <video controls class="w-100 rounded mb-2" preload="metadata">
                                            <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        @endforeach
                                    </div>
                                    @endif

                                    {{-- Image Display (your current logic) --}}

                                    @if($totalImages === 1)
                                    {{-- Single Image --}}
                                    <div class="post-img mt-2">
                                        <a href="{{ asset('storage/' . $imageMedia[0]->file_path) }}" class="glightbox"
                                            data-gallery="post-gallery-{{ $post->id }}">
                                            <img src="{{ asset('storage/' . $imageMedia[0]->file_path) }}"
                                                class="w-100 rounded" alt="Post Image"
                                                style="width: 100%; height: 400px; object-fit: cover;" loading="lazy"
                                                decoding="async">
                                        </a>
                                    </div>

                                    @elseif($totalImages === 2)
                                    {{-- Two Side by Side --}}
                                    <div class="post-img d-flex gap-2 mt-2">
                                        @foreach($imageMedia as $media)
                                        <a href="{{ asset('storage/' . $media->file_path) }}"
                                            class="glightbox flex-fill" data-gallery="post-gallery-{{ $post->id }}">
                                            <img src="{{ asset('storage/' . $media->file_path) }}" class="w-100 rounded"
                                                alt="Post Image" style="height: 250px; object-fit: cover;"
                                                loading="lazy" decoding="async">
                                        </a>
                                        @endforeach
                                    </div>

                                    @elseif($totalImages === 3)
                                    {{-- One Large Left, Two Stacked Right --}}
                                    <div class="post-img d-flex gap-2 mt-2">
                                        <a href="{{ asset('storage/' . $imageMedia[0]->file_path) }}"
                                            class="glightbox flex-fill" data-gallery="post-gallery-{{ $post->id }}">
                                            <img src="{{ asset('storage/' . $imageMedia[0]->file_path) }}"
                                                class="w-100 rounded" alt="Post Image"
                                                style="height: 400px; object-fit: cover;" loading="lazy"
                                                decoding="async">
                                        </a>
                                        <div class="d-flex flex-column gap-2" style="width: 50%;">
                                            @foreach($imageMedia->slice(1, 2) as $media)
                                            <a href="{{ asset('storage/' . $media->file_path) }}"
                                                class="glightbox flex-fill" data-gallery="post-gallery-{{ $post->id }}">
                                                <img src="{{ asset('storage/' . $media->file_path) }}"
                                                    class="w-100 rounded" alt="Post Image"
                                                    style="height: 195px; object-fit: cover;" loading="lazy"
                                                    decoding="async">
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>

                                    @else
                                    {{-- Four or More Images --}}
                                    <div class="post-img d-grid gap-2 mt-2"
                                        style="grid-template-columns: repeat(2, 1fr); grid-auto-rows: 200px;">
                                        @foreach($imageMedia->take(4) as $index => $media)
                                        <div class="position-relative">
                                            <a href="{{ asset('storage/' . $media->file_path) }}" class="glightbox"
                                                data-gallery="post-gallery-{{ $post->id }}">
                                                <img src="{{ asset('storage/' . $media->file_path) }}" alt="Post Image"
                                                    loading="lazy" class="w-100 h-100 rounded"
                                                    style="object-fit: cover;">
                                            </a>

                                            {{-- Overlay for extra images --}}
                                            @if($index === 3 && $totalImages > 4)
                                            @foreach($imageMedia->slice(4) as $extra)
                                            <a href="{{ asset('storage/' . $extra->file_path) }}"
                                                class="glightbox d-none"
                                                data-gallery="post-gallery-{{ $post->id }}"></a>
                                            @endforeach

                                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex 
                                align-items-center justify-content-center text-white"
                                                style="background: rgba(0,0,0,0.6); font-size: 2rem; border-radius: 0.5rem;">
                                                +{{ $totalImages - 4 }}
                                            </div>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif

                                    <ul class="nav nav-stack py-3 small">
                                        @php
                                        $likeUserList = $post->likes->pluck('member.name')->filter();
                                        $likeUsersTooltip = $likeUserList->implode('<br>');
                                        $hasLiked = $post->likes->contains('member_id', auth('user')->id());
                                        @endphp

                                        <li class="nav-item">
                                            <a href="javascript:void(0);"
                                                class="nav-link like-button {{ $hasLiked ? 'active text-primary' : '' }}"
                                                data-url="{{ route('user.post.like', $post->id) }}"
                                                data-post-id="{{ $post->id }}" data-bs-toggle="tooltip"
                                                data-bs-html="true"
                                                data-bs-title="{{ $likeUsersTooltip ?: 'No likes yet' }}">
                                                <i class="bi bi-hand-thumbs-up-fill pe-1"></i>
                                                <span class="like-label">Like</span>
                                                <span
                                                    class="like-count">{{ $post->likes->count() ? '('.$post->likes->count().')' : '' }}</span>
                                            </a>
                                        </li>


                                        <li class="nav-item">
                                            <a class="nav-link" href="#!">
                                                <i class="bi bi-chat-fill pe-1"></i>Comments
                                                <span
                                                    class="comment-count">{{ $post->comments->count() ? '(' . $post->comments->count() . ')' : '' }}</span>
                                            </a>

                                        </li>
                                        <!-- Card share action START -->
                                        {{-- <li class="nav-item dropdown ms-sm-auto">
                                            <a class="nav-link mb-0" href="#" id="cardShareAction"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-reply-fill flip-horizontal ps-1"></i> Share
                                                {{ $post->shares ? '('.$post->shares->count().')' : '' }}
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardShareAction">

                                            <li>
                                                <a class="dropdown-item copy-url-btn" href="javascript:void(0)"
                                                    data-url="">
                                                    <i class="bi bi-link fa-fw pe-2"></i>Copy link to post
                                                </a>
                                            </li>
                                        </ul>
                                        </li>--}}
                                        <!-- Card share action END -->
                                    </ul>
                                    <div class="d-flex mb-3">
                                        <!-- Avatar -->
                                        <div class="avatar avatar-xs me-2">
                                            <a
                                                href="{{ route('user.profile.data', ['id' => Crypt::encrypt(auth()->guard('user')->id())]) }}">
                                                <img class="avatar-img rounded-circle" src="{{ auth()->guard('user')->user()->profile_pic
                                ? asset('storage/' . auth()->guard('user')->user()->profile_pic)
                                : asset('feed_assets/images/avatar/07.jpg') }}"
                                                    alt="{{ auth()->guard('user')->user()->name ?? 'User' }}"
                                                    loading="lazy" decoding="async">
                                            </a>
                                        </div>

                                        <!-- Comment box  -->
                                        <form class="nav nav-item w-100 position-relative"
                                            id="commentForm-{{ $post->id }}" action="{{ route('user.comments.store') }}"
                                            method="POST" data-post-id="{{ $post->id }}">
                                            @csrf
                                            <textarea name="comment" data-autoresize class="form-control pe-5 bg-light"
                                                rows="1" placeholder="Add a comment..."
                                                id="comments-{{ $post->id }}"></textarea>
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            <button
                                                class="nav-link bg-transparent px-3 position-absolute top-50 end-0 translate-middle-y border-0"
                                                type="submit">
                                                <i class="bi bi-send-fill"></i>
                                            </button>
                                        </form>

                                    </div>
                                    <ul class="comment-wrap list-unstyled">
                                        <!-- Comment item START -->
                                        {{--@foreach ($post->comments as $comment)--}}
                                        @foreach ($post->comments->take(2) as $comment)
                                        @if(isset($member->id) && $member->id === auth()->guard('user')->id())
                                        <li class="comment-item mb-3" id="comment-{{ $comment->id }}">
                                            <div class="d-flex position-relative">
                                                <!-- Avatar -->
                                                <div class="avatar avatar-xs">
                                                    <!-- <a href="#!"><img class="avatar-img rounded-circle"
                                   src="${comment.member && comment.member.profile_pic ? '/storage/' + comment.member.profile_pic : '/feed_assets/images/avatar/07.jpg'}"
                                    alt="" loading="lazy" decoding="async"></a> -->

                                                    <a
                                                        href="{{ $comment->member ? route('user.profile.data', ['id' => Crypt::encrypt($comment->member->id)]) : '#' }}">
                                                        <img class="avatar-img rounded-circle"
                                                            src="{{ $comment->member && $comment->member->profile_pic ? asset('storage/' . $comment->member->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}"
                                                            alt="" loading="lazy" decoding="async">
                                                    </a>
                                                </div>
                                                <div class="ms-2 w-100">
                                                    <!-- Comment by -->
                                                    <div class="bg-light rounded-start-top-0 p-3 rounded">
                                                        <div class="d-flex justify-content-between">
                                                            <h6 class="mb-1"> <a href="#!">
                                                                    {{ $comment->member->name ?? 'Anonymous' }} </a>
                                                            </h6>
                                                            <small
                                                                class="ms-2">{{$comment->created_at->diffForHumans()}}</small>
                                                        </div>
                                                        <p class="small mb-0" id="comment-text-{{ $comment->id }}">
                                                            {{ $comment->comment }}</p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <a href="#!" class="text-secondary small me-2">Like</a>
                                                            <a href="#!" class="text-secondary small">Reply</a>
                                                        </div>
                                                        <div class="col-6 text-end">
                                                            @if(auth()->guard('user')->id() === $comment->member_id)
                                                            <button
                                                                class="btn btn-sm btn-link p-0 text-primary edit-comment-btn"
                                                                data-comment-id="{{ $comment->id }}"
                                                                data-comment="{{ $comment->comment }}" type="button"><i
                                                                    class="bi bi-pencil-fill"></i></button>
                                                            @endif
                                                            @if(auth()->guard('user')->id() === $comment->member_id)
                                                            <button
                                                                class="btn btn-sm btn-link p-0 text-danger delete-comment-btn"
                                                                data-comment-id="{{ $comment->id }}" type="button"><i
                                                                    class="bi bi-trash-fill"></i></button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Comment item nested END -->
                                        </li>
                                        @elseif(auth()->guard('user')->id() === $comment->member_id)
                                        <li class="comment-item mb-3" id="comment-{{ $comment->id }}">
                                            <div class="d-flex position-relative">
                                                <!-- Avatar -->
                                                <div class="avatar avatar-xs">
                                                    <!-- <a href="#!"><img class="avatar-img rounded-circle"
                                   src="${comment.member && comment.member.profile_pic ? '/storage/' + comment.member.profile_pic : '/feed_assets/images/avatar/07.jpg'}"
                                    alt="" loading="lazy" decoding="async"></a> -->

                                                    <a
                                                        href="{{ $comment->member ? route('user.profile.data', ['id' => Crypt::encrypt($comment->member->id)]) : '#' }}">
                                                        <img class="avatar-img rounded-circle"
                                                            src="{{ $comment->member && $comment->member->profile_pic ? asset('storage/' . $comment->member->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}"
                                                            alt="" loading="lazy" decoding="async">
                                                    </a>
                                                </div>
                                                <div class="ms-2 w-100">
                                                    <!-- Comment by -->
                                                    <div class="bg-light rounded-start-top-0 p-3 rounded">
                                                        <div class="d-flex justify-content-between">
                                                            <h6 class="mb-1"> <a href="#!">
                                                                    {{ $comment->member->name ?? 'Anonymous' }} </a>
                                                            </h6>
                                                            <small
                                                                class="ms-2">{{$comment->created_at->diffForHumans()}}</small>
                                                        </div>
                                                        <p class="small mb-0" id="comment-text-{{ $comment->id }}">
                                                            {{ $comment->comment }}</p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <a href="#!" class="text-secondary small me-2">Like</a>
                                                            <a href="#!" class="text-secondary small">Reply</a>
                                                        </div>
                                                        <div class="col-6 text-end">
                                                            @if(auth()->guard('user')->id() === $comment->member_id)
                                                            <button
                                                                class="btn btn-sm btn-link p-0 text-primary edit-comment-btn"
                                                                data-comment-id="{{ $comment->id }}"
                                                                data-comment="{{ $comment->comment }}" type="button"><i
                                                                    class="bi bi-pencil-fill"></i></button>
                                                            @endif
                                                            @if(auth()->guard('user')->id() === $comment->member_id)
                                                            <button
                                                                class="btn btn-sm btn-link p-0 text-danger delete-comment-btn"
                                                                data-comment-id="{{ $comment->id }}" type="button"><i
                                                                    class="bi bi-trash-fill"></i></button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Comment item nested END -->
                                        </li>
                                        @endif
                                        @endforeach
                                        <!-- Comment item END -->
                                    </ul>
                                    <!-- Card body END -->
                                    @if(isset($member->id) && $member->id === auth()->guard('user')->id())

                                    @if ($post->comments->count() > 2)
                                    <div class="card-footer border-0 pt-0">
                                        <a href="#!" class="btn btn-link btn-sm text-secondary load-more-comments"
                                            data-post-id="{{ $post->id }}" data-offset="2">
                                            <div class="spinner-dots me-2 d-none" id="spinner-{{ $post->id }}">
                                                <span class="spinner-dot"></span>
                                                <span class="spinner-dot"></span>
                                                <span class="spinner-dot"></span>
                                            </div>
                                            Load more comments
                                        </a>
                                    </div>
                                    @endif
                                    @endif
                                    <!-- Card footer END -->
                                </div>
                                <!-- Card feed item END -->

                            </div>
                            @endforeach


                        </div>
                        <div class="tab-pane fade show" id="about" role="tabpanel" aria-labelledby="about-tab">
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
                                            <!-- Service START -->
                                            <div class="d-flex align-items-center rounded border px-3 py-2">

                                                <p class="mb-0">
                                                    <i class="fas fa-landmark fa-fw me-2"></i> Service Area: <strong>
                                                        @if($user->Service != '') {{ $user->Service }} @else N/A @endif
                                                    </strong>
                                                </p>
                                            </div>
                                            <!-- Service END -->
                                        </div>
                                        <div class="col-sm-6">
                                            <!-- sector START -->
                                            <div class="d-flex align-items-center rounded border px-3 py-2">

                                                <p class="mb-0">
                                                    <i class="fas fa-draw-polygon fa-fw me-2"></i> Sector: <strong>
                                                        @if($user->sector != '') {{ $user->sector }} @else N/A @endif
                                                    </strong>
                                                </p>
                                            </div>
                                            <!-- sector END -->
                                        </div>




                                        <div class="col-sm-6">
                                            <!-- Birthday START -->
                                            <div class="d-flex align-items-center rounded border px-3 py-2">
                                                <!-- Date -->
                                                <p class="mb-0">
                                                    <i class="bi bi-calendar-date fa-fw me-2"></i> Born: <strong>
                                                        @if($user->date_of_birth)
                                                        {{ \Carbon\Carbon::parse($user->date_of_birth)->format('d/m/Y') }}
                                                        ({{ \Carbon\Carbon::parse($user->date_of_birth)->age }} years
                                                        old)
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
                                                    <i class="bi bi-briefcase fa-fw me-2"></i> Current
                                                    Designation:<strong>
                                                        @if($user->current_designation != '')
                                                        {{ $user->current_designation }}
                                                        @else N/A @endif
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
                                                        @if($user->current_location != '') {{ $user->current_location }}
                                                        @else
                                                        N/A @endif
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
                                                    <i class="bi bi-envelope fa-fw me-2"></i> Year of Graduation:
                                                    <strong>
                                                        @if($user->undergrad_year != '') {{ $user->undergrad_year }}
                                                        @else N/A
                                                        @endif </strong>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center rounded border px-3 py-2">
                                                <!-- Date -->
                                                <p class="mb-0">
                                                    <i class="bi bi-envelope fa-fw me-2"></i> Year of Post Graduation:
                                                    <strong>
                                                        @if($user->postgrad_year != '') {{ $user->postgrad_year }} @else
                                                        N/A
                                                        @endif </strong>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center rounded border px-3 py-2">
                                                <!-- Date -->
                                                <p class="mb-0">
                                                    <i class="bi bi-envelope fa-fw me-2"></i> Current Department:
                                                    <strong>
                                                        @if($user->current_department != '')
                                                        {{ $user->current_department }}
                                                        @else N/A @endif </strong>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center rounded border px-3 py-2">
                                                <!-- Date -->
                                                <p class="mb-0">
                                                    <i class="bi bi-envelope fa-fw me-2"></i> Previous Posting: <strong>
                                                        @if($user->previous_postings != '')
                                                        {{ $user->previous_postings }} @else
                                                        N/A @endif </strong>
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
                                <div
                                    class="card-header d-sm-flex align-items-center justify-content-between border-0 pb-0">
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
                                                    style="width: 100%; height: 200px; object-fit: cover;"
                                                    loading="lazy" decoding="async">
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
                                                    <a href="{{ $user->facebook }}"
                                                        target="_blank">{{ $user->facebook }}</a>
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
                                                    <a href="{{ $user->instagram }}"
                                                        target="_blank">{{ $user->instagram }}</a>
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
                                                    <a href="{{ $user->linkedin }}"
                                                        target="_blank">{{ $user->linkedin }}</a>
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
                                                    <a href="{{ $user->twitter }}"
                                                        target="_blank">{{ $user->twitter }}</a>
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
                        <div class="tab-pane fade" id="sector_ministries" role="tabpanel" aria-labelledby="sector_ministries-tab">
                            <div class="card">
                                <!-- Card header START -->
                                <div class="card-header border-0 pb-0">
                                    <h5 class="card-title">Sector & Ministries</h5>
                                </div>
                                <!-- Card header END -->
                                <!-- Card body START -->
                                <div class="card-body">
    @if(!empty($selectedSectors))
        <!-- Search Box with Inline Clear Button -->
        <div class="mb-3 position-relative">
            <input type="text" class="form-control pe-5" id="sectorSearch" placeholder="🔍 Search sector or department...">
            <button class="btn btn-sm btn-light position-absolute top-50 end-0 translate-middle-y me-2 d-none" 
                    type="button" id="clearSearch" style="border:none; background:transparent;">
                <i class="bi bi-x-circle text-muted"></i>
            </button>
        </div>

        <div class="accordion" id="sectorsAccordion">
            @foreach($selectedSectors as $index => $sector)
                <div class="accordion-item sector-item">
                    <!-- Sector Header -->
                    <h2 class="accordion-header" id="heading-{{ $index }}">
                        <button class="accordion-button d-flex justify-content-between align-items-center {{ $index !== 0 ? 'collapsed' : '' }}"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapse-{{ $index }}"
                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-controls="collapse-{{ $index }}">
                            <span class="sector-name">
                                <i class="fas fa-draw-polygon me-2 text-primary"></i>
                                {{ $sector['name'] }}
                            </span>
                            <span class="badge bg-light text-dark ms-2">
                                {{ !empty($sector['departments']) ? count($sector['departments']) . ' Depts' : '0 Depts' }}
                            </span>
                        </button>
                    </h2>

                    <!-- Sector Body -->
                    <div id="collapse-{{ $index }}" 
                         class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                         aria-labelledby="heading-{{ $index }}"
                         data-bs-parent="#sectorsAccordion">
                        <div class="accordion-body">
                            @if(!empty($sector['departments']))
                                <ul class="list-group list-group-flush small department-list">
                                    @foreach($sector['departments'] as $dept)
                                        <li class="list-group-item px-2 py-1 department-name">
                                            <i class="bi bi-building me-2 text-secondary"></i>{{ $dept }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-muted small fst-italic">
                                    <i class="bi bi-info-circle me-1"></i>No departments selected
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info mb-0">
            <i class="bi bi-exclamation-circle me-2"></i>No sector or ministry data available.
        </div>
    @endif
</div>

<!-- Highlight Style -->
<style>
    .highlight {
        background-color: #ffe066; /* soft yellow */
        font-weight: bold;
        padding: 0 2px;
        border-radius: 3px;
    }
</style>

<!-- Filter + Highlight + Clear Script -->
<script>
    const searchInput = document.getElementById('sectorSearch');
    const clearBtn = document.getElementById('clearSearch');

    function highlightMatch(text, filter) {
        if (!filter) return text;
        let regex = new RegExp(`(${filter})`, 'gi');
        return text.replace(regex, '<span class="highlight">$1</span>');
    }

    function filterSectors() {
        let filter = searchInput.value.toLowerCase();
        let foundMatch = false;

        document.querySelectorAll('.sector-item').forEach(function(item) {
            let sectorNameEl = item.querySelector('.sector-name');
            let sectorName = sectorNameEl.textContent.trim();

            let departmentEls = item.querySelectorAll('.department-name');
            let departmentNames = Array.from(departmentEls).map(el => el.textContent.trim());

            let matchSector = sectorName.toLowerCase().includes(filter);
            let matchDept = departmentNames.some(d => d.toLowerCase().includes(filter));
            let match = matchSector || matchDept;

            // Show/hide
            item.style.display = match ? '' : 'none';

            // Reset highlights
            sectorNameEl.innerHTML = `<i class="fas fa-draw-polygon me-2 text-primary"></i> ${sectorName}`;
            departmentEls.forEach((el, i) => {
                el.innerHTML = `<i class="bi bi-building me-2 text-secondary"></i> ${departmentNames[i]}`;
            });

            // Apply highlighting
            if (filter) {
                if (matchSector) {
                    sectorNameEl.innerHTML = `<i class="fas fa-draw-polygon me-2 text-primary"></i> ${highlightMatch(sectorName, filter)}`;
                }
                departmentEls.forEach((el, i) => {
                    if (departmentNames[i].toLowerCase().includes(filter)) {
                        el.innerHTML = `<i class="bi bi-building me-2 text-secondary"></i> ${highlightMatch(departmentNames[i], filter)}`;
                    }
                });
            }

            // Auto-expand if department matches
            let collapse = item.querySelector('.accordion-collapse');
            let button = item.querySelector('.accordion-button');
            if (matchDept && collapse && !collapse.classList.contains('show')) {
                new bootstrap.Collapse(collapse, { show: true, toggle: true });
                button.classList.remove('collapsed');
                button.setAttribute('aria-expanded', 'true');
            }

            if (match) foundMatch = true;
        });

        // Toggle clear button
        clearBtn.classList.toggle('d-none', !filter);

        // Show/hide no results message
        if (!foundMatch && filter) {
            if (!document.getElementById('noResults')) {
                let noResults = document.createElement('div');
                noResults.id = 'noResults';
                noResults.className = 'alert alert-warning mt-2';
                noResults.innerHTML = '<i class="bi bi-search"></i> No matching sector or department found.';
                document.querySelector('#sectorsAccordion').insertAdjacentElement('beforebegin', noResults);
            }
        } else {
            let noResults = document.getElementById('noResults');
            if (noResults) noResults.remove();
        }
    }

    searchInput.addEventListener('keyup', filterSectors);

    clearBtn.addEventListener('click', function() {
        searchInput.value = '';
        clearBtn.classList.add('d-none');
        filterSectors();
        searchInput.focus();
    });
</script>

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
            </div>

        </div>
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
                            src="{{ $profilePic ? asset('storage/' . $profilePic) : asset('feed_assets/images/avatar/07.jpg') }}"
                            alt="User Avatar" loading="lazy" decoding="async">
                    </div>
                    <!-- Post textarea -->
                    <textarea class="form-control pe-4 fs-3 lh-1 border-0" name="modalContent" rows="5"
                        placeholder="Share your thoughts..."></textarea>
                </div>

                <!-- File upload -->
                <div class="mb-3">
                    <label class="form-label">Upload attachment</label>
                    <div id="drop-area" class="drop-area p-4 text-center border border-secondary rounded">
                        <i class="bi bi-images fs-1 mb-2 d-block"></i>
                        <span class="d-block">Drag & Drop image here or click to
                            browse.</span>
                        <input type="file" id="media" name="media[]" multiple class="d-none" accept="image/*">
                        <div id="preview-feed" class="mt-3 d-flex flex-wrap gap-3"></div>
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
<script>
document.querySelectorAll('.toggle-sector').forEach(cb => {
    cb.addEventListener('change', function() {
        const target = document.querySelector(this.dataset.target);
        target.style.display = this.checked ? 'flex' : 'none';
    });
});
/*  */

document.addEventListener("DOMContentLoaded", function() {
    function showFiles(files, previewContainer) {
        previewContainer.innerHTML = ''; // Clear old previews
        [...files].forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                let mediaElement;
                if (file.type.startsWith('image/')) {
                    mediaElement = document.createElement('img');
                    mediaElement.src = e.target.result;
                    mediaElement.style.width = "100px";
                    mediaElement.style.height = "100px";
                    mediaElement.style.objectFit = "cover";
                } else if (file.type.startsWith('video/')) {
                    mediaElement = document.createElement('video');
                    mediaElement.src = e.target.result;
                    mediaElement.controls = true;
                    mediaElement.style.width = "100px";
                    mediaElement.style.height = "100px";
                }
                previewContainer.appendChild(mediaElement);
            };
            reader.readAsDataURL(file);
        });
    }

    document.querySelectorAll(".drop-area").forEach(dropArea => {
        const input = dropArea.querySelector('input[type="file"]');
        const preview = dropArea.querySelector(
            'div[id^="preview-"]'); // matches preview-feed, preview-group, etc.

        // Click to open file dialog
        dropArea.addEventListener("click", () => input.click());

        // File selection from dialog
        input.addEventListener("change", () => showFiles(input.files, preview));

        // Drag & drop highlight
        ['dragenter', 'dragover'].forEach(evt =>
            dropArea.addEventListener(evt, e => {
                e.preventDefault();
                dropArea.classList.add('border-primary');
            })
        );

        ['dragleave', 'drop'].forEach(evt =>
            dropArea.addEventListener(evt, e => {
                e.preventDefault();
                dropArea.classList.remove('border-primary');
            })
        );

        // Handle dropped files
        dropArea.addEventListener("drop", e => {
            const files = e.dataTransfer.files;
            input.files = files;
            showFiles(files, preview);
        });
    });
});

// Like post
function bindLikeForms() {
    document.querySelectorAll('.like-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const postId = form.dataset.postId;
            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': formData.get('_token')
                    },
                    body: formData
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('like-section-' + postId).innerHTML = html;
                    // 👇 re-bind like button inside the new HTML
                    bindLikeForms();
                });
        });
    });
}

// Initial bind when DOM is ready
document.addEventListener('DOMContentLoaded', bindLikeForms);


function toggleComments(postId) {
    const box = document.getElementById('comments-' + postId);
    box.style.display = box.style.display === 'none' ? 'block' : 'none';
}


document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.copy-url-btn');

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const urlToCopy = this.getAttribute('data-url');

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(urlToCopy)
                    .then(() => {
                        alert('Profile link copied to clipboard!');
                    })
                    .catch(err => {
                        console.error('Clipboard API failed:', err);
                    });
            } else {
                // Fallback method
                const tempInput = document.createElement('input');
                document.body.appendChild(tempInput);
                tempInput.value = urlToCopy;
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);
                alert('Profile link copied (fallback method).');
            }
        });
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.copy-url-btn').forEach(function(el) {
        el.addEventListener('click', function(e) {
            e.preventDefault();
            const url = el.getAttribute('data-url');

            // Copy to clipboard
            navigator.clipboard.writeText(url).then(() => {
                alert('Link copied to clipboard!');
            }).catch(err => {
                console.error('Failed to copy: ', err);
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.edit-comment-btn').forEach(button => {
        button.addEventListener('click', function() {
            const commentId = this.dataset.commentId;
            const commentText = this.dataset.comment;
            const commentDiv = document.getElementById(`comment-text-${commentId}`);

            // Replace text with input
            commentDiv.innerHTML = `
                <input type="text" id="edit-input-${commentId}" class="form-control form-control-sm mb-1" value="${commentText}">
                <button class="btn btn-sm btn-success" onclick="saveEditedComment(${commentId})">Update</button>
               <button class="btn btn-sm btn-danger" onclick="deleteComment(${commentId})">Delete</button>
            `;
        });
    });
});

function cancelEdit(id, originalText) {
    document.getElementById(`comment-text-${id}`).innerHTML = originalText;
}

function saveEditedComment(id) {
    const newComment = document.getElementById(`edit-input-${id}`).value;

    fetch(`/user/comments/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                comment: newComment
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById(`comment-text-${id}`).innerHTML = newComment;
            } else {
                alert(data.message || 'Failed to update comment');
            }
        })
        .catch(err => {
            console.error('Edit failed', err);
            alert('An error occurred while editing the comment.');
        });
}

function deleteComment(commentId) {
    if (!confirm('Are you sure you want to delete this comment?')) return;

    fetch(`/user/comments/${commentId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById(`comment-wrapper-${commentId}`).remove();
            } else {
                alert(data.error || 'Failed to delete comment.');
            }
        })
        .catch(error => {
            console.error('Error deleting comment:', error);
            alert('An error occurred while deleting the comment.');
        });
}


document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.load-more-comments').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const postId = btn.dataset.postId;
            let offset = parseInt(btn.dataset.offset);
            const spinner = document.getElementById('spinner-' + postId);
            spinner.classList.remove('d-none');

            fetch(`load-comments/${postId}?offset=${offset}`)
                .then(res => res.json())
                .then(data => {
                    spinner.classList.add('d-none');

                    if (data.comments.length === 0) {
                        btn.remove(); // No more comments
                        return;
                    }

                    let commentHtml = '';
                    data.comments.forEach(comment => {
                        commentHtml += `
                            <li class="comment-item mb-3" id="comment-${comment.id}">
                                <div class="d-flex position-relative">
                                    <div class="avatar avatar-xs">
                                        <a href="#!"><img class="avatar-img rounded-circle"
                                            src="${comment.member && comment.member.profile_pic ? '/storage/' + comment.member.profile_pic : '/feed_assets/images/avatar/07.jpg'}"
                                            alt="" loading="lazy" decoding="async"></a>
                                    </div>
                                    <div class="ms-2 w-100">
                                        <div class="bg-light rounded-start-top-0 p-3 rounded">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="mb-1"><a href="#!">${comment.member?.name || 'Anonymous'}</a></h6>
                                                <small class="ms-2">${comment.created_at_human || comment.created_at || ''}</small>
                                            </div>
                                            <p class="small mb-0">${comment.comment}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>`;
                    });

                    btn.closest('.card-footer').insertAdjacentHTML('beforebegin',
                        commentHtml);
                    btn.dataset.offset = offset + data.comments.length;
                })
                .catch(err => {
                    spinner.classList.add('d-none');
                    console.error('Failed to load comments:', err);
                });
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    GLightbox({
        selector: '.glightbox'
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("editProfileModal"); // replace with your modal ID

    if (modal) {
        modal.addEventListener("hidden.bs.modal", function () {
            // Reset only sector & ministries tab
            document.querySelectorAll('#sector-ministries input[type="checkbox"]').forEach(cb => {
                // Restore to server-rendered state (Laravel already printed `checked` if saved)
                cb.checked = cb.defaultChecked;

                // Handle show/hide for sector groups
                if (cb.classList.contains("toggle-sector")) {
                    const target = document.querySelector(cb.dataset.target);
                    if (target) {
                        target.style.display = cb.defaultChecked ? "" : "none";
                    }
                }
            });
        });
    }
});
</script>
@endsection