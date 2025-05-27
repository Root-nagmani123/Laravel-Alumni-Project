@extends('admin.layouts.master')

@section('title', 'Member - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5">
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
                                            <span class="opacity-75">Total Member</span>
                                            <h4 class="mb-0 text-white mt-1 text-nowrap fs-13 fw-bolder">
                                                99</h4>
                                        </div>
                                        <div class="col-6 border-start border-light" style="--bs-border-opacity: .15;">
                                            <span class="opacity-75">Forums</span>
                                            <h4 class="mb-0 text-white mt-1 text-nowrap fs-13 fw-bolder">
                                                440</h4>
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
            <div class="row">
                <!-- -------------------------------------------- -->
                <!-- Customers -->
                <!-- -------------------------------------------- -->
                <div class="col-md-6">
                    <div class="card bg-secondary-subtle overflow-hidden shadow-none">
                        <div class="card-body p-4">
                            <span class="text-dark-light">Topics</span>
                            <div class="hstack gap-6">
                                <h5 class="mb-0 fs-7">36,358</h5>
                                <span class="fs-11 text-dark-light fw-semibold">-12%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- -------------------------------------------- -->
                <!-- Projects -->
                <!-- -------------------------------------------- -->
                <div class="col-md-6">
                    <div class="card bg-danger-subtle overflow-hidden shadow-none">
                        <div class="card-body p-4">
                            <span class="text-dark-light">Replies</span>
                            <div class="hstack gap-6">
                                <h5 class="mb-0 fs-7">78,298</h5>
                                <span class="fs-11 text-dark-light fw-semibold">+31.8%</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card mb-lg-0">
                <div class="card-body">
                    <h5 class="card-title mb-4">Recent Topics</h5>
                    <ul class="timeline-widget mb-0 position-relative mb-n5" data-simplebar="init"
                        style="height: 397px;">
                        <div class="simplebar-wrapper" style="margin: 0px;">
                            <div class="simplebar-height-auto-observer-wrapper">
                                <div class="simplebar-height-auto-observer"></div>
                            </div>
                            <div class="simplebar-mask">
                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                    <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                        aria-label="scrollable content" style="height: 100%; overflow: hidden;">
                                        <div class="simplebar-content" style="padding: 0px;">
                                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                                <div class="timeline-time mt-n1 text-muted flex-shrink-0 text-end">
                                                    09:46
                                                </div>
                                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                                    <span class="timeline-badge bg-primary flex-shrink-0 mt-2"></span>
                                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                                </div>
                                                <div class="timeline-desc fs-12 text-muted mt-n1">Payment received
                                                    from John
                                                    Doe of $385.90</div>
                                            </li>
                                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                                <div class="timeline-time mt-n8 text-muted flex-shrink-0 text-end">
                                                    09:46
                                                </div>
                                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                                    <span class="timeline-badge bg-warning flex-shrink-0"></span>
                                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                                </div>
                                                <div class="timeline-desc fs-12 text-dark-light mt-n8 fw-medium d-flex">
                                                    <span class="flex-shrink-0">New sale recorded</span>
                                                    <a href="javascript:void(0)"
                                                        class="text-primary flex-shrink-0">#ML-3467</a>
                                                </div>
                                            </li>
                                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                                <div class="timeline-time mt-n8 text-muted flex-shrink-0 text-end">
                                                    09:46
                                                </div>
                                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                                    <span class="timeline-badge bg-warning flex-shrink-0"></span>
                                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                                </div>
                                                <div class="timeline-desc fs-12 text-dark-light mt-n8">Payment was
                                                    made of $64.95
                                                    to Michael</div>
                                            </li>
                                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                                <div class="timeline-time mt-n8 text-muted flex-shrink-0 text-end">
                                                    09:46
                                                </div>
                                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                                    <span class="timeline-badge bg-secondary flex-shrink-0"></span>
                                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                                </div>
                                                <div class="timeline-desc fs-12 text-dark-light mt-n8 fw-medium d-flex">
                                                    <span class="flex-shrink-0">New sale recorded</span>
                                                    <a href="javascript:void(0)"
                                                        class="text-primary flex-shrink-0">#ML-3467</a>
                                                </div>
                                            </li>
                                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                                <div class="timeline-time mt-n8 text-muted flex-shrink-0 text-end">
                                                    09:46
                                                </div>
                                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                                    <span class="timeline-badge bg-danger flex-shrink-0"></span>
                                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                                </div>
                                                <div class="timeline-desc fs-12 text-dark-light mt-n8 fw-medium">
                                                    Project meeting
                                                </div>
                                            </li>
                                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                                <div class="timeline-time mt-n8 text-muted flex-shrink-0 text-end">
                                                    09:46
                                                </div>
                                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                                    <span class="timeline-badge bg-primary flex-shrink-0"></span>
                                                </div>
                                                <div class="timeline-desc fs-12 text-dark-light mt-n8">Payment
                                                    received from John
                                                    Doe of $385.90</div>
                                            </li>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="simplebar-placeholder" style="width: 300px; height: 360px;"></div>
                        </div>
                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                        </div>
                        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                            <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection