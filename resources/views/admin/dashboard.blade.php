@extends('admin.layouts.master')

@section('title', 'Dashboard - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <!-- -------------------------------------------- -->
            <!-- Welcome Card -->
            <!-- -------------------------------------------- -->
            <div class="card text-bg-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="d-flex flex-column h-100">
                                <div class="hstack gap-3">
                                    <span
                                        class="d-flex align-items-center justify-content-center round-48 bg-white rounded flex-shrink-0">
                                        <iconify-icon icon="solar:course-up-outline" class="fs-7 text-muted">
                                        </iconify-icon>
                                    </span>
                                    <h5 class="text-white fs-6 mb-0 text-nowrap">Welcome Back
                                        <br>Admin
                                    </h5>
                                </div>
                                <div class="mt-4 mt-sm-auto">
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="opacity-75"><a href="{{ route('members.index') }}"
                                                    class="text-white">Total Member</a></span>
                                            <h4 class="mb-0 text-white mt-1 text-nowrap fs-13 fw-bolder">
                                                {{ $total_user }}</h4>
                                        </div>
                                        <div class="col-6 border-start border-light" style="--bs-border-opacity: .15;">
                                            <span class="opacity-75"><a href="{{ route('forums.index') }}"
                                                    class="text-white">Forums</a></span>
                                            <h4 class="mb-0 text-white mt-1 text-nowrap fs-13 fw-bolder">
                                                {{ $total_forums }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-md-end">
                            <img src="{{asset('admin_assets/images/backgrounds/welcome-bg.png')}}" alt="welcome"
                                class="img-fluid mb-n7 mt-2" width="180">
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <!-- -------------------------------------------- -->
                <!-- Events -->
                <!-- -------------------------------------------- -->
                <div class="col-md-4">
                    <div class="card bg-success overflow-hidden shadow-none">
                        <div class="card-body p-4">
                            <span class="text-dark-light"><a href="{{ route('events.index') }}"
                                    class="text-white">Events</a></span>
                            <div class="hstack gap-6">
                                <h5 class="mb-0 fs-7">{{ $total_events }}</h5>
                                <span class="fs-11 fw-semibold text-muted"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-info overflow-hidden shadow-none">
                        <div class="card-body p-4">
                            <span class="text-dark-light"><a href="{{ route('group.index') }}"
                                    class="text-white">Groups</a></span>
                            <div class="hstack gap-6">
                                <h5 class="mb-0 fs-7">{{ $total_groups }}</h5>
                                <span class="fs-11 fw-semibold text-muted"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- -------------------------------------------- -->
                <!-- Broadcasts -->
                <!-- -------------------------------------------- -->
                <div class="col-md-4">
                    <div class="card bg-danger overflow-hidden shadow-none">
                        <div class="card-body p-4">
                            <span class="text-dark-light"><a href="{{ route('broadcasts.index') }}"
                                    class="text-white">Broadcasts</a></span>
                            <div class="hstack gap-6">
                                <h5 class="mb-0 fs-7">{{ $total_broadcasts }}</h5>
                                <span class="fs-11 fw-semibold text-muted"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-danger overflow-hidden shadow-none">
                        <div class="card-body p-4">
                            <span class="text-dark-light"><a href="{{ route('broadcasts.index') }}"
                                    class="text-white">Broadcasts</a></span>
                            <div class="hstack gap-6">
                                <h5 class="mb-0 fs-7">{{ $total_broadcasts }}</h5>
                                <span class="fs-11 fw-semibold text-muted"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-danger overflow-hidden shadow-none">
                        <div class="card-body p-4">
                            <span class="text-dark-light"><a href="{{ route('broadcasts.index') }}"
                                    class="text-white">Broadcasts</a></span>
                            <div class="hstack gap-6">
                                <h5 class="mb-0 fs-7">{{ $total_broadcasts }}</h5>
                                <span class="fs-11 fw-semibold text-muted"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-danger overflow-hidden shadow-none">
                        <div class="card-body p-4">
                            <span class="text-dark-light"><a href="{{ route('broadcasts.index') }}"
                                    class="text-white">Broadcasts</a></span>
                            <div class="hstack gap-6">
                                <h5 class="mb-0 fs-7">{{ $total_broadcasts }}</h5>
                                <span class="fs-11 fw-semibold text-muted"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body p-4 pb-0 overflow-auto gap-3" data-simplebar="init">
                    <div class="row">
                        <div class="col-2">
                            <div class="card primary-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian Audit And Accounts Service (IAAS)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        16</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card warning-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian P And T Accounts And Finance Service (IPTAFS)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        148</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card secondary-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian Revenue Service Customs And Central Excise (IRS(CCE))</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        156</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card danger-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian Defence Accounts Service (IDAS)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        64</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card success-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian Ordinance Factory Service (IOFS)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        36,715</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card success-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian Postal Service (IPOS)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        36,715</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div class="card primary-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian Administrative Service (IAS)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        16,689</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card warning-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian Police Service (IPS)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        148</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card secondary-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian Foreign Service (IFS)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        156K</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card danger-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian Civil Accounts Service (ICAS)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        64</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card success-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian Revenue Service (IT) (IRS(IT))</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        $36,715</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card success-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian Railway Accounts Service (IRAS)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        $36,715</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div class="card primary-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian Railway Personnel Service (IRPS)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        16,689</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card warning-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian Statistical Service (ISS)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        148</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card secondary-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian Railway Traffic Service (IRTS)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        $156K</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card danger-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian Defence Estate Service (IDES)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        64</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card success-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian Information Service (IIS)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        $36,715</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card success-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian Forest Services (IFS(AIS))</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        $36,715</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div class="card primary-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Royal Bhutan Civil Services (RBCS)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        16,689</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card warning-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian Economic Services (IES)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        148</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card secondary-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian Trade Service (ITS)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        $156K</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card danger-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Royal Bhutan Forest Service (RBFoS)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        64</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card success-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Royal Bhutan Police Services (RBPS)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        $36,715</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card success-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <h6 class="fw-normal fs-3 mb-1">Indian Railway Management Service (IRMS)</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        $36,715</h4>
                                    <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection