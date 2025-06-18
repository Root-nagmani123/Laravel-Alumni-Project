   @extends('layouts.app')

   @section('title', 'User Feed - Alumni | Lal Bahadur Shastri National Academy of Administration')

   @section('content')
   <style>
   .label {
  font-weight: 600;
}
   </style>
   
  
   <!-- Main Content start -->
   <i class="fa-light fa-face-awesome"></i>
   <main class="main-content">
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
                               <img class="avatar-img max-un" src="http://4.247.151.249/feed_assets/images/avatar-1.png"
                                   alt="avatar">
                           </div>
                           <div class="text-area">
						@if(Auth::guard('user')->check())
						 <h6 class="m-0 mb-1">{{ Auth::guard('user')->user()->name }}!</h6>
						@endif
					<p class="mdtxt">{{ Auth::guard('user')->user()->designation }} ({{ Auth::guard('user')->user()->batch }})</p>
						

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
      
      <!--<h5 class="card-title">Bio</h5>
      <p class="small fst-italic">Passionate about handling .</p>-->
	  
	

      <h5 class="card-title">Profile Details</h5>

      <div class="row mb-2">
        <div class="col-lg-3 col-md-4 label">Full Name</div>
        <div class="col-lg-9 col-md-8">{{ $user->name }} </div>
      </div>

      <div class="row mb-2">
        <div class="col-lg-3 col-md-4 label">Email</div>
        <div class="col-lg-9 col-md-8">{{ $user->email }} </div>
      </div>

      <div class="row mb-2">
        <div class="col-lg-3 col-md-4 label">Mobile</div>
        <div class="col-lg-9 col-md-8">{{ $user->designation }} </div>
      </div>

      <div class="row mb-2">
        <div class="col-lg-3 col-md-4 label">Location</div>
        <div class="col-lg-9 col-md-8">{{ $user->batch }} </div>
      </div>

    </div>
  </div>
</div>


  <!-- Media Form -->
  <div class="tab-pane fade" id="media" role="tabpanel">
    <form>
      <div class="mb-3">
        <label for="mediaUpload" class="form-label">Upload Image</label>
        <input type="file" class="form-control" id="mediaUpload">
      </div>
    </form>
  </div>

  <!-- Edit Profile Form -->
  <div class="tab-pane fade" id="edit" role="tabpanel">
    <form>
      <div class="mb-3">
        <label for="editEmail" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="editEmail" placeholder="Enter your email">
      </div>
      <div class="mb-3">
        <label for="editPassword" class="form-label">Password</label>
        <input type="password" class="form-control" id="editPassword" placeholder="Enter new password">
      </div>
    </form>
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
 
		   
@endsection
