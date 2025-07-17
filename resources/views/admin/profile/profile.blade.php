@extends('admin.layouts.master')

@section('title', 'Admin Profile - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Profile</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="{{ route('dashboard') }}">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Profile
                                </span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="card overflow-hidden">
        <div class="card-body p-0">
            <img src="{{asset('admin_assets/images/backgrounds/profilebg.jpg')}}" alt="matdash-img" class="img-fluid">
            <div class="row align-items-center">
                <div class="col-lg-4 order-lg-1 order-2">
                    <div class="d-flex align-items-center justify-content-around m-4">
                        <div class="text-center">
                            <i class="ti ti-file-description fs-6 d-block mb-2"></i>
                            <p class="mb-0 ">{{ session('LoginEmail') }}</p>
                        </div>
                        <div class="text-center">
                            <i class="ti ti-user-circle fs-6 d-block mb-2"></i>
                            <p class="mb-0 ">{{ session('LoginPhone') }}</p>
                        </div>
                        <div class="text-center">
                            <i class="ti ti-user-check fs-6 d-block mb-2"></i>
                            <p class="mb-0 ">{{ session('last_login') ? \Carbon\Carbon::parse(session('last_login') )->diffForHumans() : 'Never' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-n3 order-lg-2 order-1">
                    <div class="mt-n5">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <div class="d-flex align-items-center justify-content-center round-110">
                                <div
                                    class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden round-100">
                                    <img src="{{ session('admin_profile_pic') && session('admin_profile_pic')
                                       ? asset('storage/' . session('admin_profile_pic') )
                                       : asset('admin_assets/images/profile/user-1.jpg') }}" alt="matdash-img"
                                        class="w-100 h-100">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h5 class="mb-0">{{ session('LoginName') }}</h5>
                            <p class="mb-0">{{ session('isAdmin') ? 'Admin' : '' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 order-last">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection