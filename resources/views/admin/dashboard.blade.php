@extends('admin.layouts.master')

@section('title', 'Dashboard - Alumni | Lal Bahadur Shastri National Academy of Administration')

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
                <!-- Topics -->
                <!-- -------------------------------------------- -->
                <!-- <div class="col-md-3">
                    <div class="card bg-secondary-subtle overflow-hidden shadow-none">
                        <div class="card-body p-4">
                            <span class="text-dark-light"><a href="#" class="text-white">Topics</a></span>
                            <div class="hstack gap-6">
                                <h5 class="mb-0 fs-7">{{ $total_topics }}</h5>
                              @if (is_null($topicChangePercent))
                        @else
                            <span class="fs-11 fw-semibold {{ $topicChangePercent < 0 ? 'text-danger' : 'text-success' }}">
                                {{ $topicChangePercent }}%
                            </span>
                        @endif
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- -------------------------------------------- -->
                <!-- Events -->
                <!-- -------------------------------------------- -->
                <div class="col-md-3">
                    <div class="card bg-success-subtle overflow-hidden shadow-none">
                        <div class="card-body p-4">
                            <span class="text-dark-light"><a href="{{ route('events.index') }}" class="text-white">Events</a></span>
                            <div class="hstack gap-6">
                                <h5 class="mb-0 fs-7">{{ $total_events }}</h5>
                                <span class="fs-11 fw-semibold text-muted"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info-subtle overflow-hidden shadow-none">
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
                <div class="col-md-3">
                    <div class="card bg-danger-subtle overflow-hidden shadow-none">
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
                                            @if (!empty($userData))
    @foreach ($userData as $topic)
        <li class="timeline-item d-flex position-relative overflow-hidden">
            <div class="timeline-time mt-n1 text-muted flex-shrink-0 text-end">
                {{ \Carbon\Carbon::parse($topic->created_at)->format('H:i') }}

            </div>
            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                <span class="timeline-badge bg-primary flex-shrink-0 mt-2"></span>
                <span class="timeline-badge-border d-block flex-shrink-0"></span>
            </div>
            <div class="timeline-desc fs-12 text-muted mt-n1">
                {{ $topic->title }} &nbsp;<small>Created by: <?= htmlentities($topic->member->name ?? 'Unknown') ?></small>
            </div>
        </li>
                @endforeach
            @else
                <p>No topics found.</p>
            @endif
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
