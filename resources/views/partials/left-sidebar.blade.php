<div class="col-lg-3 left-sidebar">

    <!-- Advanced filter responsive toggler START -->
    <div class="d-flex align-items-center d-lg-none">
        <button class="border-0 bg-transparent" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasSideNavbar" aria-controls="offcanvasSideNavbar">
            <span class="btn btn-primary"><i class="fa-solid fa-sliders-h"></i></span>
            <span class="h6 mb-0 fw-bold d-lg-none ms-2">My profile</span>
        </button>
    </div>
    <!-- Advanced filter responsive toggler END -->

    <!-- Navbar START-->
    <nav class="navbar navbar-expand-lg mx-0">
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSideNavbar">
            <!-- Offcanvas header -->
            <div class="offcanvas-header">
                <button type="button" class="btn-close text-reset ms-auto" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>

            <!-- Offcanvas body -->
            <div class="offcanvas-body d-block px-2 px-lg-0">
                <!-- Card START -->
                <div class="card overflow-hidden">
                    <!-- Cover image -->
                    <div class="h-50px"
                        style="background-image:url({{asset('feed_assets/images/bg/01.jpg')}}); background-position: center; background-size: cover; background-repeat: no-repeat;">
                    </div>
                    <!-- Card body START -->
                    <div class="card-body pt-0">
                        <div class="text-center">
                            <!-- Avatar -->
                            <div class="avatar avatar-lg mt-n5 mb-3">
                                <img class="avatar-img rounded border border-white border-3"
                                    src="{{Auth::guard('user')->user()->profile_pic}}" alt="">
                            </div>
                            <!-- Info -->
                            @if(Auth::guard('user')->check())
                            <h5 class="mb-0"> <a href="#!"> {{ Auth::guard('user')->user()->name }} </a> </h5>
                            @endif
                            <small>{{ Auth::guard('user')->user()->designation }}</small>
                            <p class="mt-3">{{Auth::guard('user')->user()->bio}}</p>

                            <!-- User stat START -->
                            <div class="hstack gap-2 gap-xl-3 justify-content-center">
                                <!-- User stat item -->
                                <div>
                                    <h6 class="mb-0">256</h6>
                                    <small>Post</small>
                                </div>
                                <!-- Divider -->
                                <div class="vr"></div>
                                <!-- User stat item -->
                                <div>
                                    <h6 class="mb-0">2.5K</h6>
                                    <small>Followers</small>
                                </div>
                                <!-- Divider -->
                                <div class="vr"></div>
                                <!-- User stat item -->
                                <div>
                                    <h6 class="mb-0">365</h6>
                                    <small>Following</small>
                                </div>
                            </div>
                            <!-- User stat END -->
                        </div>
                        <!-- Side Nav END -->
                    </div>
                    <!-- Card body END -->
                    <!-- Card footer -->
                    <div class="card-footer text-center py-2">
                        <a class="btn btn-link btn-sm" href="{{ route('user.profile', ['id' => $user->id]) }}">View
                            Profile </a>
                    </div>
                </div>
                <!-- Card END -->
            </div>
        </div>
    </nav>
    <!-- Navbar END-->
    <!-- Card follow START -->
    <div class="col-sm-6 col-lg-12">
        <div class="card mt-4">
            <!-- Card header START -->
            <div class="card-header pb-0 border-0">
                <h5 class="card-title mb-0">Latest Events</h5>
            </div>
            <!-- Card header END -->
            <!-- Card body START -->
            <div class="card-body">
                <!-- Connection item START -->

                @if(!empty($events))
                @foreach($events as $event)
                <div class="hstack gap-2 mb-3">
                    <!-- Avatar -->
                    <div class="avatar">
                        <a href="#!"><img class="avatar-img rounded-circle"
                                src="{{ $event->image ? asset('storage/events/' . $event->image) : asset('feed_assets/images/avatar-7.png') }}"
                                alt=""></a>
                    </div>
                    <!-- Title -->
                    <div class="overflow-hidden">
                        <a class="h6 mb-0" href="{{ $event->url ?? '#' }}">
                            {{ \Illuminate\Support\Str::limit($event->title, 20) }}</a>
                        <p class="mb-0 small text-truncate">
                            {{ \Carbon\Carbon::parse($event->end_datetime)->format('d M, Y') }}</p>
                    </div>
                    <!-- Button -->
                    <a class="btn btn-primary-soft rounded-circle icon-md ms-auto" href="#"><i class="fa-solid fa-plus">
                        </i></a>
                </div>

                @endforeach
                <div class="d-grid mt-3">
                    <a class="btn btn-sm btn-primary-soft" href="#!">View more</a>
                </div>
                @else
                <p>No events found</p>
                @endif
                <!-- Connection item END -->

                <!-- View more button -->

            </div>
            <!-- Card body END -->
        </div>
    </div>
    <!-- Card follow START -->
    <div class="col-sm-6 col-lg-12">
        <div class="card mt-4">
            <!-- Card header START -->
            <div class="card-header pb-0 border-0">
                <h5 class="card-title mb-0">Latest Events</h5>
            </div>
            <!-- Card header END -->
            <!-- Card body START -->
            <div class="card-body">
                <!-- Connection item START -->
                <div class="hstack gap-2 mb-3">
                    <!-- Avatar -->
                    <div class="avatar">
                        <a href="#!"><img class="avatar-img rounded-circle" src="assets/images/avatar/04.jpg"
                                alt=""></a>
                    </div>
                    <!-- Title -->
                    <div class="overflow-hidden">
                        <a class="h6 mb-0" href="#!">Judy Nguyen </a>
                        <p class="mb-0 small text-truncate">News anchor</p>
                    </div>
                    <!-- Button -->
                    <a class="btn btn-primary-soft rounded-circle icon-md ms-auto" href="#"><i class="fa-solid fa-plus">
                        </i></a>
                </div>
                <!-- Connection item END -->
                <!-- Connection item START -->
                <div class="hstack gap-2 mb-3">
                    <!-- Avatar -->
                    <div class="avatar avatar-story">
                        <a href="#!"> <img class="avatar-img rounded-circle" src="assets/images/avatar/05.jpg" alt="">
                        </a>
                    </div>
                    <!-- Title -->
                    <div class="overflow-hidden">
                        <a class="h6 mb-0" href="#!">Amanda Reed </a>
                        <p class="mb-0 small text-truncate">Web Developer</p>
                    </div>
                    <!-- Button -->
                    <a class="btn btn-primary-soft rounded-circle icon-md ms-auto" href="#"><i class="fa-solid fa-plus">
                        </i></a>
                </div>
                <!-- Connection item END -->

                <!-- Connection item START -->
                <div class="hstack gap-2 mb-3">
                    <!-- Avatar -->
                    <div class="avatar">
                        <a href="#"> <img class="avatar-img rounded-circle" src="assets/images/avatar/11.jpg" alt="">
                        </a>
                    </div>
                    <!-- Title -->
                    <div class="overflow-hidden">
                        <a class="h6 mb-0" href="#!">Billy Vasquez </a>
                        <p class="mb-0 small text-truncate">News anchor</p>
                    </div>
                    <!-- Button -->
                    <a class="btn btn-primary rounded-circle icon-md ms-auto" href="#"><i
                            class="bi bi-person-check-fill"> </i></a>
                </div>
                <!-- Connection item END -->

                <!-- Connection item START -->
                <div class="hstack gap-2 mb-3">
                    <!-- Avatar -->
                    <div class="avatar">
                        <a href="#"> <img class="avatar-img rounded-circle" src="assets/images/avatar/01.jpg" alt="">
                        </a>
                    </div>
                    <!-- Title -->
                    <div class="overflow-hidden">
                        <a class="h6 mb-0" href="#!">Lori Ferguson </a>
                        <p class="mb-0 small text-truncate">Web Developer at Webestica</p>
                    </div>
                    <!-- Button -->
                    <a class="btn btn-primary-soft rounded-circle icon-md ms-auto" href="#"><i class="fa-solid fa-plus">
                        </i></a>
                </div>
                <!-- Connection item END -->

                <!-- Connection item START -->
                <div class="hstack gap-2 mb-3">
                    <!-- Avatar -->
                    <div class="avatar">
                        <a href="#"> <img class="avatar-img rounded-circle" src="assets/images/avatar/placeholder.jpg"
                                alt=""> </a>
                    </div>
                    <!-- Title -->
                    <div class="overflow-hidden">
                        <a class="h6 mb-0" href="#!">Carolyn Ortiz </a>
                        <p class="mb-0 small text-truncate">News anchor</p>
                    </div>
                    <!-- Button -->
                    <a class="btn btn-primary-soft rounded-circle icon-md ms-auto" href="#"><i class="fa-solid fa-plus">
                        </i></a>
                </div>
                <!-- Connection item END -->

                <!-- View more button -->
                <div class="d-grid mt-3">
                    <a class="btn btn-sm btn-primary-soft" href="#!">View more</a>
                </div>
            </div>
            <!-- Card body END -->
        </div>
    </div>
</div>
