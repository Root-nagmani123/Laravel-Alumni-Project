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
                                            <span class="opacity-75"><a href="{{ route('members.index') }}" class="text-white">Total Member</a></span>
                                            <h4 class="mb-0 text-white mt-1 text-nowrap fs-13 fw-bolder">
                                               {{ $total_user }}</h4>
                                        </div>
                                        <div class="col-6 border-start border-light" style="--bs-border-opacity: .15;">
                                            <span class="opacity-75"><a href="{{ route('forums.index') }}" class="text-white">Forums</a></span>
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
            <div class="row">
                <!-- -------------------------------------------- -->
                <!-- Events -->
                <!-- -------------------------------------------- -->
                <div class="col-md-4">
                    <div class="card bg-success overflow-hidden shadow-none">
                        <div class="card-body p-4">
                            <span class="text-dark-light"><a href="{{ route('events.index') }}" class="text-white">Events</a></span>
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
                            <span class="text-dark-light"><a href="{{ route('group.index') }}" class="text-white">Groups</a></span>
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
                            <span class="text-dark-light"><a href="{{ route('broadcasts.index') }}" class="text-white">Broadcasts</a></span>
                            <div class="hstack gap-6">
                                <h5 class="mb-0 fs-7">{{ $total_broadcasts }}</h5>
                                <span class="fs-11 fw-semibold text-muted"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
              <!-- -------------------------------------------- -->
              <!-- Your Performance -->
              <!-- -------------------------------------------- -->
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title fw-semibold">Servicewise Member</h5>

                  <div class="row mt-4">
                    <div class="col-md-6">
                      <div class="vstack gap-9 mt-2">
                        <div class="hstack align-items-center gap-3">
                          <div class="d-flex align-items-center justify-content-center round-48 rounded bg-primary-subtle flex-shrink-0">
                            <span class="fs-7 text-primary">IAS</span>
                          </div>
                          <div>
                            <h6 class="mb-0 text-nowrap">03</h6>
                            <span>Indian Administrative Services</span>
                          </div>

                        </div>
                        <div class="hstack align-items-center gap-3">
                          <div class="d-flex align-items-center justify-content-center round-48 rounded bg-danger-subtle">
                            <span class="fs-7 text-danger">IPS</span>
                          </div>
                          <div>
                            <h6 class="mb-0">04</h6>
                            <span>Indian Police Services</span>
                          </div>

                        </div>
                        <div class="hstack align-items-center gap-3">
                          <div class="d-flex align-items-center justify-content-center round-48 rounded bg-secondary-subtle">
                            <span class="fs-7 text-secondary">IFS</span>
                          </div>
                          <div>
                            <h6 class="mb-0">12</h6>
                            <span>Indian Foreign Services </span>
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="vstack gap-9 mt-2">
                        <div class="hstack align-items-center gap-3">
                          <div class="d-flex align-items-center justify-content-center round-48 rounded bg-primary-subtle flex-shrink-0">
                            <span class="fs-7 text-primary">IRS</span>
                          </div>
                          <div>
                            <h6 class="mb-0 text-nowrap">03</h6>
                            <span>Indian Revenue Services</span>
                          </div>

                        </div>
                        <div class="hstack align-items-center gap-3">
                          <div class="d-flex align-items-center justify-content-center round-48 rounded bg-danger-subtle">
                            <span class="fs-7 text-danger">IAAS</span>
                          </div>
                          <div>
                            <h6 class="mb-0">04</h6>
                            <span>Indian Audit and Accounts Services</span>
                          </div>

                        </div>
                        <div class="hstack align-items-center gap-3">
                          <div class="d-flex align-items-center justify-content-center round-48 rounded bg-secondary-subtle">
                            <span class="fs-7 text-secondary">IRTS</span>
                          </div>
                          <div>
                            <h6 class="mb-0">12</h6>
                            <span>Indian Railways Traffic Services</span>
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
@endsection
