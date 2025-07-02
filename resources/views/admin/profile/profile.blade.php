@extends('admin.layouts.master')

@section('title', 'Admin Profile - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<style>
    .profile-container {
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
    }
    .profile-pic {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        margin-bottom: 20px;
    }
    .profile-details {
        margin-top: 20px;
        text-align: left;
    }
    .profile-details div {
        margin-bottom: 10px;
    }
    .profile-details label {
        font-weight: bold;
        display: inline-block;
        width: 80px;
    }
    .profile-img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 50%;
}
.label-bold-black {
    font-weight: bold;
    color: #000;
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mb-lg-0">
                <div class="card-body">
                    <h5 class="card-title mb-4 text-center">Admin Profile</h5>

                    <div class="profile-container">
                        <!--<img src="https://via.placeholder.com/150" alt="Profile Picture" class="profile-pic">-->
                        <!-- <img class="profile-img me-2"
                 src="{{ session('admin_profile_pic')  && session('admin_profile_pic')
                        ? asset('storage/' . session('admin_profile_pic') )
                        : asset('admin_assets/images/profile/user-1.jpg') }}"
                 alt="Profile Picture">-->

                         <div class="profile-details">
                        <div><label class="label-bold-black">Name:</label> {{ session('LoginName') }}</div>
                        <div><label class="label-bold-black">Email:</label> {{ session('LoginEmail') }}</div>
                        <div><label class="label-bold-black">Phone:</label> {{ session('LoginPhone') }}</div>
                         <div><label class="label-bold-black">Role:</label> {{ session('isAdmin') ? 'Admin' : '' }}</div>
                        <div>
                        <label class="label-bold-black">Last Login:</label>
                        {{ session('last_login') ? \Carbon\Carbon::parse(session('last_login') )->diffForHumans() : 'Never' }}
                    </div>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
