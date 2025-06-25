   @extends('layouts.app')

   @section('title', 'User Feed - Alumni | Lal Bahadur Shastri National Academy of Administration')

   @section('content')
   <style>

/*--------------------------------------------------------------
# Profie Page
--------------------------------------------------------------*/
.profile .profile-card img {
  max-width: 120px;
}
.profile .profile-card h2 {
  font-size: 24px;
  font-weight: 700;
  color: #2c384e;
  margin: 10px 0 0 0;
}
.profile .profile-card h3 {
  font-size: 18px;
}
.profile .profile-card .social-links a {
  font-size: 20px;
  display: inline-block;
  color: rgba(1, 41, 112, 0.5);
  line-height: 0;
  margin-right: 10px;
  transition: 0.3s;
}
.profile .profile-card .social-links a:hover {
  color: #012970;
}
.profile .profile-overview .row {
  margin-bottom: 20px;
  font-size: 15px;
}
.profile .profile-overview .card-title {
  color: #012970;
}
.profile .profile-overview .label {
  font-weight: 600;
  color: rgba(1, 41, 112, 0.6);
}
.profile .profile-edit label {
  font-weight: 600;
  color: rgba(1, 41, 112, 0.6);
}
.profile .profile-edit img {
  max-width: 120px;
}





   .label {
  font-weight: 600;
}
   </style>


   <!-- Main Content start -->
   <i class="fa-light fa-face-awesome"></i>
   <main class="main-content profile">
       <div class="container sidebar-toggler">
           <div class="row">
<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                   <div class="d-inline-block d-lg-none">
                       <button class="button profile-active mb-4 mb-lg-0 d-flex align-items-center gap-2">
                           <i class="material-symbols-outlined mat-icon"> tune </i>
                           <span>My profile</span>
                       </button>
                   </div>
                   <div class="profile-sidebar cus-scrollbar p-5">
                       <div class="d-block d-lg-none position-absolute end-0 top-0">
                           <button class="button profile-close">
                               <i class="material-symbols-outlined mat-icon fs-xl"> close </i>
                           </button>
                       </div>
                       <div class="profile-pic d-flex gap-2 align-items-center">
                           <div class="avatar position-relative">
     <img id="existingImage" src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('feed_assets/images/avatar-1.png') }}" alt="Profile Image" style="width: 200px; height: 200px; object-fit: cover;"  class="rounded-circle">
					</div>
                           <div class="text-area">

						 <h6 class="m-0 mb-1">{{-- Auth::guard('user')->user()->name --}}
                          {{ $user->name }}

					<p class="mdtxt"> {{ $user->designation }} ({{ $user->batch }})</p>


                           </div>
                       </div>


                   </div>
               </div>


              <div class="col-12 col-md-8 col-lg-8 col-xl-8 col-xxl-8 mt-0 mt-lg-10 mt-xl-0 d-flex flex-column gap-7 cus-z">



                   <div class="post-item d-flex flex-column gap-5 gap-md-7" id="news-feed">
				   <div class="post-single-box p-3 p-sm-5">
				<div class="top-area pb-5">
				<div class="profile-area d-center justify-content-between">
            <div class="avatar-item d-flex gap-3 align-items-center">


            <div class="info-area">
                 <ul class="nav nav-tabs mb-4" id="profileTab" role="tablist">
		  <li class="nav-item" role="presentation">
			<button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">
			  Overview
			</button>
		  </li>
		  <li class="nav-item" role="presentation">
			<button class="nav-link" id="media-tab" data-bs-toggle="tab" data-bs-target="#media" type="button" role="tab">
			  Media
			</button>
		  </li>
		  <li class="nav-item" role="presentation">
			<button class="nav-link" id="edit-tab" data-bs-toggle="tab" data-bs-target="#edit" type="button" role="tab">
			  Edit Profile
			</button>
		  </li>
		</ul>

<!-- Tab Content -->
<div class="tab-content" id="profileTabContent">
  <!-- Overview Form -->

  <div class="tab-pane fade show active" id="overview" role="tabpanel">
  <div class="tab-content pt-2">
    <div class="tab-pane fade profile-overview active show" id="profile-overview">
  <!-- Success Message -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Error Messages -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <h5 class="card-title mb-4">Profile Details</h5>

 	<div class="row">
		<div class="col-lg-3 col-md-4"><strong>Full Name:</strong></div>
		<div class="col-lg-9 col-md-8">{{ $user->name }}</div>
		</div>

		<div class="row">
		<div class="col-lg-3 col-md-4"><strong>Email:</strong></div>
		<div class="col-lg-9 col-md-8">{{ $user->email }}</div>
		</div>
		<div class="row">
		<div class="col-lg-3 col-md-4"><strong>Phone:</strong></div>
		<div class="col-lg-9 col-md-8">{{ $user->mobile }}</div>
		</div>

		<div class="row">
		<div class="col-lg-3 col-md-4"><strong>Cader:</strong></div>
		<div class="col-lg-9 col-md-8">{{ $user->cader }}</div>
		</div>

		<div class="row">
		<div class="col-lg-3 col-md-4"><strong>Designation:</strong></div>
		<div class="col-lg-9 col-md-8">&nbsp;&nbsp;{{ $user->designation }}</div>
		</div>
		<div class="row">
		<div class="col-lg-3 col-md-4"><strong>Batch:</strong></div>
		<div class="col-lg-9 col-md-8">{{ $user->batch }}</div>
		</div>

		<div class="row">
		<div class="col-lg-3 col-md-4"><strong>Address:</strong></div>
		<div class="col-lg-9 col-md-8">{{ $user->address }}</div>
		</div>



</div>
  </div>
</div>

  <!-- Media Form -->
  <div class="tab-pane fade" id="media" role="tabpanel">

	 <!-- Tab Navigation -->
<ul class="nav nav-tabs nav-tabs-bordered" id="mediaTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active"
                id="photos-tab"
                data-bs-toggle="tab"
                data-bs-target="#photos"
                type="button"
                role="tab"
                aria-controls="photos"
                aria-selected="true">Photos</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link"
                id="video-tab"
                data-bs-toggle="tab"
                data-bs-target="#video"
                type="button"
                role="tab"
                aria-controls="video"
                aria-selected="false">Videos</button>
    </li>
</ul>

<!-- Tab Content -->
<div class="tab-content pt-2" id="mediaTabsContent">
    <!-- Photos -->
    <div class="tab-pane fade show active profile-overview"
         id="photos"
         role="tabpanel"
         aria-labelledby="photos-tab">


            <div class="row">
               @foreach($profile_topic as $post)
			@foreach($post->media as $media)
				@if($media->file_type === 'image')
					@php
						$max_length = 50;
						 $relativePath = 'storage/' . str_replace(['app/public/', 'public/'], '', $media->file_path);

                // Check existence of file in public path
						$file_path = public_path($relativePath);
						$image_url = file_exists($file_path) ? asset($relativePath) : asset('feed_assets/images/avatar-1.png');
					@endphp

					<div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
						<img src="{{ $image_url }}"
							 class="w-100 shadow-1-strong rounded mb-4"
							 alt="Uploaded Image"
							 style="border-radius:15px;" />

						<span>Uploaded on: {{ \Carbon\Carbon::parse($media->created_at)->format('Y-m-d') }}</span><br>

						@php
							$content = $post->content ?? '';
							if (strlen($content) > $max_length) {
								$content = substr($content, 0, $max_length) . '...';
							}
						@endphp
						<span>Topic: {{ $content }}</span>
					</div>
				@endif
			@endforeach
		@endforeach


            </div>

    </div>

    <!-- Videos -->
    <div class="tab-pane fade profile-overview"
         id="video"
         role="tabpanel"
         aria-labelledby="video-tab">

                    <div class="row">
               @foreach($profile_topic as $post)
			@foreach($post->media as $media)
				@if($media->file_type === 'video')
					@php
						$max_length = 50;
						 $relativePath = 'storage/' . str_replace(['app/public/', 'public/'], '', $media->file_path);

                // Check existence of file in public path
						$file_path = public_path($relativePath);
						$image_url = file_exists($file_path) ? asset($relativePath) : asset('feed_assets/images/avatar-1.png');
					@endphp

					<div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
						<img src="{{ $image_url }}"
							 class="w-100 shadow-1-strong rounded mb-4"
							 alt="Uploaded Image"
							 style="border-radius:15px;" />

						<span>Uploaded on: {{ \Carbon\Carbon::parse($media->created_at)->format('Y-m-d') }}</span><br>

						@php
							$content = $post->content ?? '';
							if (strlen($content) > $max_length) {
								$content = substr($content, 0, $max_length) . '...';
							}
						@endphp
						<span>Topic: {{ $content }}</span>
					</div>
				@endif
			@endforeach
		@endforeach


            </div>

    </div>
</div>


  </div>

  <!-- Edit Profile Form -->

 <div class="tab-pane fade" id="edit" role="tabpanel">
  <div class="accordion" id="editAccordion">

    <!-- Personal Information -->
   <div class="container-fluid p-0">
  <div class="accordion w-100" id="editAccordion">

    <!-- Personal Information -->
    <div class="accordion-item w-100 ">
      <h2 class="accordion-header" id="personalHeading">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#personalCollapse" aria-expanded="true" aria-controls="personalCollapse">
          Personal Information
        </button>
      </h2>
      <div id="personalCollapse" class="accordion-collapse collapse {{ session('active_tab') == 'personal' ? 'show' : '' }}" aria-labelledby="personalHeading" data-bs-parent="#editAccordion" >
        <div class="accordion-body w-100">

	<form action="{{ route('user.profile.update', ['id' => $user->id]) }}" method="post" id="myForm" enctype="multipart/form-data">
				@csrf
				@method('PUT')

					<div class="form-group">
	<!-- Full Name -->
	<div class="row mb-3">
		<div class="col-3">
			<label for="name">Full Name:</label>
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
			<label for="date_of_birth">Date of Birth:<span style="color: red">*</span></label>
		</div>
		<div class="col-9">
			<input type="date" id="date_of_birth" name="date_of_birth"
				value="{{ old('date_of_birth', \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d')) }}"
				class="form-control"
				placeholder="DD/MM/YYYY">
		</div>
	</div>

	<!-- Place of Birth -->
	<div class="row mb-3">
		<div class="col-3">
			<label for="place_of_birth">Place of Birth:<span style="color: red">*</span></label>
		</div>
		<div class="col-9">
			<input type="text" id="place_of_birth" name="place_of_birth"
				value="{{ old('place_of_birth', $user->place_of_birth) }}"
				class="form-control"
				placeholder="Enter place of birth">
		</div>
	</div>

	<!-- Gender -->
	<div class="row mb-3">
		<div class="col-3">
			<label for="gender">Gender:<span style="color: red">*</span></label>
		</div>
		<div class="col-9">
			<select id="gender" name="gender" class="form-control">
				<option value="" {{ old('gender', $user->gender) == '' ? 'selected' : '' }}>Select gender</option>
				<option value="male" {{ strtolower(old('gender', $user->gender)) == 'male' ? 'selected' : '' }}>Male</option>
				<option value="female" {{ strtolower(old('gender', $user->gender)) == 'female' ? 'selected' : '' }}>Female</option>
				<option value="other" {{ strtolower(old('gender', $user->gender)) == 'other' ? 'selected' : '' }}>Other</option>
			</select>
		</div>
	</div>

	<!-- Phone Number -->
	<div class="row mb-3">
		<div class="col-3">
			<label for="mobile">Phone Number:</label>
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
			<label for="address">Residential Address:<span style="color: red">*</span></label>
		</div>
		<div class="col-9">
			<textarea id="address" name="address" class="form-control" placeholder="Enter full address">{{ old('address', $user->address) }}</textarea>
		</div>
	</div>

	<!-- Marital Status -->
	<div class="row mb-3">
		<div class="col-3">
			<label for="marital_status">Marital Status:<span style="color: red">*</span></label>
		</div>
		<div class="col-9">
			<select id="marital_status" name="marital_status" class="form-control">
				<option value="" {{ old('marital_status', $user->marital_status) == '' ? 'selected' : '' }}>Select status</option>
				<option value="single" {{ old('marital_status', $user->marital_status) == 'single' ? 'selected' : '' }}>Single</option>
				<option value="married" {{ old('marital_status', $user->marital_status) == 'married' ? 'selected' : '' }}>Married</option>
				<option value="divorced" {{ old('marital_status', $user->marital_status) == 'divorced' ? 'selected' : '' }}>Divorced</option>
			</select>
		</div>
	</div>

	<!-- Bio -->
	<div class="row mb-3">
		<div class="col-3">
			<label for="bio">Bio:<span style="color: red">*</span></label>
		</div>
		<div class="col-9">
			<textarea id="bio" name="bio" class="form-control" placeholder="Write a short bio">{{ old('bio', $user->bio) }}</textarea>
		</div>
	</div>

	<!-- Profile Picture -->
	<div class="row mb-3">
		<div class="col-3">
			<label for="profile_pic">Profile Picture:</label>
		</div>
		<div class="col-9">
			<input type="file" id="ImageEdit" name="profile_pic" accept="image/*" class="form-control">
			{{--@if ($user->profile_pic)
				<img src="{{ asset('assets/uploads/profile_pic/' . $user->profile_pic) }}" alt="Profile Picture" width="50">
			@endif--}}
		</div>
	</div>
</div>


				<button type="submit" class="btn btn-primary">Update</button>
			</form>




        </div>
      </div>
    </div>

    <!-- Educational Background -->
    <div class="accordion-item w-100">
      <h2 class="accordion-header" id="educationHeading">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#educationCollapse" aria-expanded="false" aria-controls="educationCollapse">
          Educational Background
        </button>
      </h2>
      <div id="educationCollapse" class="accordion-collapse collapse" aria-labelledby="educationHeading" data-bs-parent="#editAccordion">



			<div class="accordion-body">

			<form action="{{ route('user.profile.eduinfo', ['id' => $user->id]) }}" method="post" id="myForm" enctype="multipart/form-data">
	@csrf
	@method('PUT')

	<!-- Educational Background -->
	<div class="form-group py-3">
		<div class="row mb-3">
			<div class="col-3">
				<label for="school_name">Name of the School:<span style="color: red">*</span></label>
			</div>
			<div class="col-9">
				<input type="text" id="school_name" name="school_name"
					value="{{ old('school_name', $user->school_name) }}"
					placeholder="Enter your school name"
					class="form-control">
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-3">
				<label for="school_year">Year of Passing:<span style="color: red">*</span></label>
			</div>
			<div class="col-9">
				<input type="text" id="school_year" name="school_year"
					value="{{ old('school_year', $user->school_year) }}"
					placeholder="e.g., 2010"
					class="form-control">
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-3">
				<label for="undergrad_college">Undergraduate College/University Name:<span style="color: red">*</span></label>
			</div>
			<div class="col-9">
				<input type="text" id="undergrad_college" name="undergrad_college"
					value="{{ old('undergrad_college', $user->undergrad_college) }}"
					placeholder="Enter college/university name"
					class="form-control">
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-3">
				<label for="undergrad_degree">Undergraduate Degree Obtained:<span style="color: red">*</span></label>
			</div>
			<div class="col-9">
				<input type="text" id="undergrad_degree" name="undergrad_degree"
					value="{{ old('undergrad_degree', $user->undergrad_degree) }}"
					placeholder="e.g., B.Sc, B.Tech, B.A"
					class="form-control">
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-3">
				<label for="undergrad_year">Year of Graduation:<span style="color: red">*</span></label>
			</div>
			<div class="col-9">
				<input type="text" id="undergrad_year" name="undergrad_year"
					value="{{ old('undergrad_year', $user->undergrad_year) }}"
					placeholder="e.g., 2014"
					class="form-control">
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-3">
				<label for="postgrad_college">Postgraduate College/University Name:<span style="color: red">*</span></label>
			</div>
			<div class="col-9">
				<input type="text" id="postgrad_college" name="postgrad_college"
					value="{{ old('postgrad_college', $user->postgrad_college) }}"
					placeholder="Enter college/university name"
					class="form-control">
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-3">
				<label for="postgrad_degree">Postgraduate Degree Obtained:<span style="color: red">*</span></label>
			</div>
			<div class="col-9">
				<input type="text" id="postgrad_degree" name="postgrad_degree"
					value="{{ old('postgrad_degree', $user->postgrad_degree) }}"
					placeholder="e.g., M.Sc, M.Tech, MBA"
					class="form-control">
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-3">
				<label for="postgrad_year">Year of Graduation:<span style="color: red">*</span></label>
			</div>
			<div class="col-9">
				<input type="text" id="postgrad_year" name="postgrad_year"
					value="{{ old('postgrad_year', $user->postgrad_year) }}"
					placeholder="e.g., 2016"
					class="form-control">
			</div>
		</div>
	</div>

	<button type="submit" class="btn btn-primary">Update</button>
</form>
			</div>



      </div>
    </div>

    <!-- Professional Information -->
    <div class="accordion-item w-100">
      <h2 class="accordion-header" id="professionalHeading">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#professionalCollapse" aria-expanded="false" aria-controls="professionalCollapse">
          Professional Information
        </button>
      </h2>
      <div id="professionalCollapse" class="accordion-collapse collapse" aria-labelledby="professionalHeading" data-bs-parent="#editAccordion">
        <div class="accordion-body w-100">

	   <form action="{{ route('user.profile.proinfo', ['id' => $user->id]) }}" method="post" id="myForm" enctype="multipart/form-data">
	@csrf
	@method('PUT')

	<div class="form-group">
		<div class="row mb-3">
			<div class="col-3">
				<label for="current_designation">Current Designation:<span style="color: red">*</span></label>
			</div>
			<div class="col-9">
				<input type="text" id="current_designation" name="current_designation"
					value="{{ old('current_designation', $user->current_designation) }}"
					class="form-control"
					placeholder="Enter your current designation">
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-3">
				<label for="current_department">Current Department:<span style="color: red">*</span></label>
			</div>
			<div class="col-9">
				<input type="text" id="current_department" name="current_department"
					value="{{ old('current_department', $user->current_department) }}"
					class="form-control"
					placeholder="Enter your current department">
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-3">
				<label for="current_location">Current Location:<span style="color: red">*</span></label>
			</div>
			<div class="col-9">
				<input type="text" id="current_location" name="current_location"
					value="{{ old('current_location', $user->current_location) }}"
					class="form-control"
					placeholder="Enter your current work location">
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-3">
				<label for="previous_postings">Previous Postings:<span style="color: red">*</span></label>
			</div>
			<div class="col-9">
				<input type="text" id="previous_postings" name="previous_postings"
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
    </div>

  </div>
</div>

  </div>
</div>

</div>
                </div>
            </div>
        </div>

       </div>
</div>



                 <!-- multiple images section -->



                       <!-- multiple images section -->

                   </div>
               </div>

       </div>
   </main>

   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>





 <script>
// for Edit functionality
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#existingImage').attr('src', e.target.result).show();
        };

        reader.readAsDataURL(input.files[0]); // Convert image to base64
    }
}

$(document).ready(function() {
    // Handle image preview on file select
    $("#ImageEdit").change(function() {
        readURL(this);
    });
});


</script>


	<script>
	 /* document.addEventListener('DOMContentLoaded', function () {
        $('#myForm').on('submit', function (e) {
            e.preventDefault();

            var form = document.getElementById("myForm");
            var formData = new FormData(form);
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var userId = "{{ $user->id }}";

            $.ajax({
                url: "/user/update/" + userId,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    alert("Updated successfully!");
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert("Error occurred.");
                }
            });
        });
    });
  */

function goPrev()
	{
	window.history.back();
	}
</script>

@endsection
