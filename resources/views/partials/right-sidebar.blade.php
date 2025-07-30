<!-- Right sidebar START -->
<div class="col-lg-3 right-sidebar">
    <div class="row g-4">
        <!-- Card follow START -->
        <!-- Card News START -->
        <div class="col-sm-6 col-lg-12">
            <div class="card">
                <!-- Card header START -->
                <div class="card-header pb-0 border-0">
                    <h5 class="card-title mb-0">Mentorship Program</h5>
                </div>
                <!-- Card header END -->
                <!-- Card body START -->
                <div class="card-body  overflow-auto" style="max-height: 500px;">

                    <!-- News item -->
                    <!-- Links -->
                    <a href="{{ route('user.mentor_mentee') }}" class="text-decoration-none" style="color:#af2910;">Wants to become Mentor / Mentee</a>
                </div>
                <!-- Card body END -->
            </div>
        </div>

        <!-- Card News END -->
        <!-- Card News START -->
        <div class="col-sm-6 col-lg-12">
            <div class="card">
                <!-- Card header START -->
                <div class="card-header pb-0 border-0">
                    <h5 class="card-title mb-0">Broadcasts</h5>
                </div>
                <!-- Card header END -->
                <!-- Card body START -->
                <div class="card-body  overflow-auto" style="max-height: 500px;">
                    <!-- News item -->
                    @if((isset($broadcast)) && ($broadcast->count() > 0))
                    @foreach($broadcast as $index => $broadcast)
                    <div class="mb-3">

                        <div class="d-flex align-items-center gap-2 mb-2">
                            @if($broadcast->image_url)
                            <img class="avatar-img rounded" src="{{ asset('storage/' . $broadcast->image_url) }}" alt=""
                                height="45" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="{{ $broadcast->title }}" style="height: 85px; object-fit: cover;">
                            @else
                            <img src="{{ asset('assets/images/no-image.png') }}" width="45" class="rounded-circle"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="No image available"
                                alt="No image">
                            @endif

                        </div>

                        <h6 class="mb-0"><a
                                href="{{ route('user.broadcastDetails', $broadcast->id) }}">{{ $broadcast->title }}</a>
                        </h6>
                        <small>{{ \Illuminate\Support\Str::limit($broadcast->description, 50) }} <span><a
                                    href="{{ route('user.broadcastDetails', $broadcast->id) }}" class="text-danger">View
                                    more</a></span></small>
                    </div>
                    <hr>
                    @endforeach
                    <span class="divider"></span>
                    @else
                    <div class="mb-3">
                        <p class="mb-0 text-muted">No broadcasts available</p>
                    </div>
                    @endif
                </div>
                <!-- Card body END -->
            </div>
        </div>
        <!-- Card News END -->
        <!-- Card follow START -->
        <div class="col-sm-6 col-lg-12">
            <div class="card">
                <!-- Card header START -->
                <div class="card-header d-sm-flex justify-content-between border-0">
                    <h5 class="card-title">Groups</h5>
                    <a class="btn btn-primary-soft btn-sm" href="" data-bs-toggle="modal" data-bs-target="#groupModal">
                        Create groups</a>

                </div>
                <!-- Card header END -->
                <!-- Card body START -->
                <div class="card-body">
                    <!-- Connection item START -->
                    @if(isset($groupNames) && $groupNames->count() > 0)
                    @foreach($groupNames as $index => $recent)
                    <div class="hstack gap-2 mb-3">
                        <!-- Title -->
                        <div class="overflow-hidden">
                            <a class="mb-0" href="{{ route('user.group-post', $recent->id) }}">{{ $recent->name}}</a>
                        </div>
                        <!-- Button -->
                        <a class="btn btn-primary-soft rounded-circle icon-md ms-auto open-group-post-modal" href="#"
                            data-bs-toggle="modal" data-bs-target="#groupActionpost"
                            data-group-name="{{ $recent->name }}" data-group-id="{{ $recent->id }}">
                            <i class="fa-solid fa-plus"></i>
                        </a>

                    </div>
                    @endforeach
                    <div class="d-grid mt-3">
                        <a class="btn btn-sm btn-primary-soft" href="{{ route('user.groups') }}">View more</a>
                    </div>
                    @else
                    <p class="text-muted">No recent groups available</p>
                    @endif

                </div>
                <!-- Card body END -->
            </div>
        </div>
        <!-- Card follow START -->
        <!-- <div class="footer-widget footer-contact">
  <h5 class="footer-title">Newsletter</h5>
  <div class="subscribe-input">
	<form action="javascript:void(0);">
	  <div class="input-group">
		<input type="email" class="form-control" placeholder="Enter your Email Address">
		<button type="submit" class="btn btn-primary btn-sm">
		  <i class="isax isax-send-2 me-1"></i>Subscribe
		</button>
	  </div>
	</form>
  </div>
</div> -->
    </div>
</div>
<div class="d-none d-lg-block">
    <!-- Button -->
    <a class="icon-md btn btn-primary position-fixed end-0 bottom-0" data-bs-toggle="offcanvas" href="#offcanvasChat"
        role="button" aria-controls="offcanvasChat"
        style="margin-right: 2rem !important; margin-bottom: 7rem !important;">
        <i class="bi bi-chat-left-text-fill"></i>
    </a>
    <!-- Chat sidebar START -->
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
        id="offcanvasChat">
        <!-- Offcanvas header -->
        <div class="offcanvas-header d-flex justify-content-between">
            <h5 class="offcanvas-title">Messaging</h5>
            <div class="d-flex">
                <!-- New chat box open button -->
                <a href="#" class="btn btn-secondary-soft-hover py-1 px-2">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <!-- Chat action START -->
                <div class="dropdown">
                    <a href="#" class="btn btn-secondary-soft-hover py-1 px-2" id="chatAction" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-three-dots"></i>
                    </a>
                    <!-- Chat action menu -->
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="chatAction">
                        <li><a class="dropdown-item" href="#"> <i class="bi bi-check-square fa-fw pe-2"></i>Mark all as
                                read</a></li>
                        <li><a class="dropdown-item" href="#"> <i class="bi bi-gear fa-fw pe-2"></i>Chat setting </a>
                        </li>
                        <li><a class="dropdown-item" href="#"> <i class="bi bi-bell fa-fw pe-2"></i>Disable
                                notifications</a></li>
                        <li><a class="dropdown-item" href="#"> <i class="bi bi-volume-up-fill fa-fw pe-2"></i>Message
                                sounds</a></li>
                        <li><a class="dropdown-item" href="#"> <i class="bi bi-slash-circle fa-fw pe-2"></i>Block
                                setting</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#"> <i class="bi bi-people fa-fw pe-2"></i>Create a group
                                chat</a></li>
                    </ul>
                </div>
                <!-- Chat action END -->

                <!-- Close  -->
                <a href="#" class="btn btn-secondary-soft-hover py-1 px-2" data-bs-dismiss="offcanvas"
                    aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </a>

            </div>
        </div>
        <!-- Offcanvas body START -->
        <div
            class="offcanvas-body pt-0 custom-scrollbar os-host os-theme-dark os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
            <div class="os-resize-observer-host observed">
                <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
            </div>
            <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
                <div class="os-resize-observer"></div>
            </div>
            <div class="os-content-glue" style="margin: 0px -24px -16px; width: 398px; height: 459px;"></div>
            <div class="os-padding">
                <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
                    <div class="os-content" style="padding: 0px 24px 16px; height: 100%; width: 100%;">
                        <!-- Search contact START -->
                        <form class="rounded position-relative">
                            <input class="form-control ps-5 bg-light" type="search" placeholder="Search..."
                                aria-label="Search">
                            <button
                                class="btn bg-transparent px-3 py-0 position-absolute top-50 start-0 translate-middle-y"
                                type="submit"><i class="bi bi-search fs-5"> </i></button>
                        </form>
                        <!-- Search contact END -->
                        <ul class="list-unstyled">

                            <!-- Contact item -->
                            <li class="mt-3 hstack gap-3 align-items-center position-relative toast-btn"
                                data-target="chatToast">
                                <!-- Avatar -->
                                <div class="avatar status-online">
                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/01.jpg" alt="">
                                </div>
                                <!-- Info -->
                                <div class="overflow-hidden">
                                    <a class="h6 mb-0 stretched-link" href="#!">Frances Guerrero </a>
                                    <div class="small text-secondary text-truncate">Frances sent a photo.</div>
                                </div>
                                <!-- Chat time -->
                                <div class="small ms-auto text-nowrap"> Just now </div>
                            </li>

                            <!-- Contact item -->
                            <li class="mt-3 hstack gap-3 align-items-center position-relative toast-btn"
                                data-target="chatToast2">
                                <!-- Avatar -->
                                <div class="avatar status-online">
                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/02.jpg" alt="">
                                </div>
                                <!-- Info -->
                                <div class="overflow-hidden">
                                    <a class="h6 mb-0 stretched-link" href="#!">Lori Ferguson </a>
                                    <div class="small text-secondary text-truncate">You missed a call form Carolyn🤙
                                    </div>
                                </div>
                                <!-- Chat time -->
                                <div class="small ms-auto text-nowrap"> 1min </div>
                            </li>

                            <!-- Contact item -->
                            <li class="mt-3 hstack gap-3 align-items-center position-relative">
                                <!-- Avatar -->
                                <div class="avatar status-offline">
                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/placeholder.jpg"
                                        alt="">
                                </div>
                                <!-- Info -->
                                <div class="overflow-hidden">
                                    <a class="h6 mb-0 stretched-link" href="#!">Samuel Bishop </a>
                                    <div class="small text-secondary text-truncate">Day sweetness why cordially 😊</div>
                                </div>
                                <!-- Chat time -->
                                <div class="small ms-auto text-nowrap"> 2min </div>
                            </li>

                            <!-- Contact item -->
                            <li class="mt-3 hstack gap-3 align-items-center position-relative">
                                <!-- Avatar -->
                                <div class="avatar">
                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/04.jpg" alt="">
                                </div>
                                <!-- Info -->
                                <div class="overflow-hidden">
                                    <a class="h6 mb-0 stretched-link" href="#!">Dennis Barrett </a>
                                    <div class="small text-secondary text-truncate">Happy birthday🎂</div>
                                </div>
                                <!-- Chat time -->
                                <div class="small ms-auto text-nowrap"> 10min </div>
                            </li>

                            <!-- Contact item -->
                            <li class="mt-3 hstack gap-3 align-items-center position-relative">
                                <!-- Avatar -->
                                <div class="avatar avatar-story status-online">
                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/05.jpg" alt="">
                                </div>
                                <!-- Info -->
                                <div class="overflow-hidden">
                                    <a class="h6 mb-0 stretched-link" href="#!">Judy Nguyen </a>
                                    <div class="small text-secondary text-truncate">Thank you!</div>
                                </div>
                                <!-- Chat time -->
                                <div class="small ms-auto text-nowrap"> 2hrs </div>
                            </li>

                            <!-- Contact item -->
                            <li class="mt-3 hstack gap-3 align-items-center position-relative">
                                <!-- Avatar -->
                                <div class="avatar status-online">
                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/06.jpg" alt="">
                                </div>
                                <!-- Info -->
                                <div class="overflow-hidden">
                                    <a class="h6 mb-0 stretched-link" href="#!">Carolyn Ortiz </a>
                                    <div class="small text-secondary text-truncate">Greetings from Webestica.</div>
                                </div>
                                <!-- Chat time -->
                                <div class="small ms-auto text-nowrap"> 1 day </div>
                            </li>

                            <!-- Contact item -->
                            <li class="mt-3 hstack gap-3 align-items-center position-relative">
                                <!-- Avatar -->
                                <div class="flex-shrink-0 avatar">
                                    <ul class="avatar-group avatar-group-four">
                                        <li class="avatar avatar-xxs">
                                            <img class="avatar-img rounded-circle" src="assets/images/avatar/06.jpg"
                                                alt="avatar">
                                        </li>
                                        <li class="avatar avatar-xxs">
                                            <img class="avatar-img rounded-circle" src="assets/images/avatar/07.jpg"
                                                alt="avatar">
                                        </li>
                                        <li class="avatar avatar-xxs">
                                            <img class="avatar-img rounded-circle" src="assets/images/avatar/08.jpg"
                                                alt="avatar">
                                        </li>
                                        <li class="avatar avatar-xxs">
                                            <img class="avatar-img rounded-circle" src="assets/images/avatar/09.jpg"
                                                alt="avatar">
                                        </li>
                                    </ul>
                                </div>
                                <!-- Info -->
                                <div class="overflow-hidden">
                                    <a class="h6 mb-0 stretched-link text-truncate d-inline-block" href="#!">Frances,
                                        Lori, Amanda, Lawson </a>
                                    <div class="small text-secondary text-truncate">Btw are you looking for job change?
                                    </div>
                                </div>
                                <!-- Chat time -->
                                <div class="small ms-auto text-nowrap"> 4 day </div>
                            </li>

                            <!-- Contact item -->
                            <li class="mt-3 hstack gap-3 align-items-center position-relative">
                                <!-- Avatar -->
                                <div class="avatar status-offline">
                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/08.jpg" alt="">
                                </div>
                                <!-- Info -->
                                <div class="overflow-hidden">
                                    <a class="h6 mb-0 stretched-link" href="#!">Bryan Knight </a>
                                    <div class="small text-secondary text-truncate">if you are available to discuss🙄
                                    </div>
                                </div>
                                <!-- Chat time -->
                                <div class="small ms-auto text-nowrap"> 6 day </div>
                            </li>

                            <!-- Contact item -->
                            <li class="mt-3 hstack gap-3 align-items-center position-relative">
                                <!-- Avatar -->
                                <div class="avatar">
                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/09.jpg" alt="">
                                </div>
                                <!-- Info -->
                                <div class="overflow-hidden">
                                    <a class="h6 mb-0 stretched-link" href="#!">Louis Crawford </a>
                                    <div class="small text-secondary text-truncate">🙌Congrats on your work anniversary!
                                    </div>
                                </div>
                                <!-- Chat time -->
                                <div class="small ms-auto text-nowrap"> 1 day </div>
                            </li>

                            <!-- Contact item -->
                            <li class="mt-3 hstack gap-3 align-items-center position-relative">
                                <!-- Avatar -->
                                <div class="avatar status-online">
                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/10.jpg" alt="">
                                </div>
                                <!-- Info -->
                                <div class="overflow-hidden">
                                    <a class="h6 mb-0 stretched-link" href="#!">Jacqueline Miller </a>
                                    <div class="small text-secondary text-truncate">No sorry, Thanks.</div>
                                </div>
                                <!-- Chat time -->
                                <div class="small ms-auto text-nowrap"> 15, dec </div>
                            </li>

                            <!-- Contact item -->
                            <li class="mt-3 hstack gap-3 align-items-center position-relative">
                                <!-- Avatar -->
                                <div class="avatar">
                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/11.jpg" alt="">
                                </div>
                                <!-- Info -->
                                <div class="overflow-hidden">
                                    <a class="h6 mb-0 stretched-link" href="#!">Amanda Reed </a>
                                    <div class="small text-secondary text-truncate">Interested can share CV at.</div>
                                </div>
                                <!-- Chat time -->
                                <div class="small ms-auto text-nowrap"> 18, dec </div>
                            </li>

                            <!-- Contact item -->
                            <li class="mt-3 hstack gap-3 align-items-center position-relative">
                                <!-- Avatar -->
                                <div class="avatar status-online">
                                    <img class="avatar-img rounded-circle" src="assets/images/avatar/12.jpg" alt="">
                                </div>
                                <!-- Info -->
                                <div class="overflow-hidden">
                                    <a class="h6 mb-0 stretched-link" href="#!">Larry Lawson </a>
                                    <div class="small text-secondary text-truncate">Hope you're doing well and Safe.
                                    </div>
                                </div>
                                <!-- Chat time -->
                                <div class="small ms-auto text-nowrap"> 20, dec </div>
                            </li>
                            <!-- Button -->
                            <li class="mt-3 d-grid">
                                <a class="btn btn-primary-soft" href="messaging.html"> See all in messaging </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
                <div class="os-scrollbar-track os-scrollbar-track-off">
                    <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
                </div>
            </div>
            <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
                <div class="os-scrollbar-track os-scrollbar-track-off">
                    <div class="os-scrollbar-handle" style="height: 53.1792%; transform: translate(0px, 0px);"></div>
                </div>
            </div>
            <div class="os-scrollbar-corner"></div>
        </div>
        <!-- Offcanvas body END -->
    </div>
    <!-- Chat sidebar END -->

    <!-- Chat END -->

    <!-- Chat START -->
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container toast-chat d-flex gap-3 align-items-end">

            <!-- Chat toast START -->
            <div id="chatToast" class="toast mb-0 bg-mode" role="alert" aria-live="assertive" aria-atomic="true"
                data-bs-autohide="false">
                <div class="toast-header bg-mode">
                    <!-- Top avatar and status START -->
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar me-2">
                                <img class="avatar-img rounded-circle" src="assets/images/avatar/01.jpg" alt="">
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 mt-1">Frances Guerrero</h6>
                                <div class="small text-secondary"><i
                                        class="fa-solid fa-circle text-success me-1"></i>Online</div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <!-- Call button -->
                            <div class="dropdown">
                                <a class="btn btn-secondary-soft-hover py-1 px-2" href="#" id="chatcoversationDropdown"
                                    data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"><i
                                        class="bi bi-three-dots-vertical"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="chatcoversationDropdown">
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-camera-video me-2 fw-icon"></i>Video call</a></li>
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-telephone me-2 fw-icon"></i>Audio call</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-trash me-2 fw-icon"></i>Delete
                                        </a></li>
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-chat-square-text me-2 fw-icon"></i>Mark as unread</a></li>
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-volume-up me-2 fw-icon"></i>Muted</a></li>
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-archive me-2 fw-icon"></i>Archive</a></li>
                                    <li class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-flag me-2 fw-icon"></i>Report</a></li>
                                </ul>
                            </div>
                            <!-- Card action END -->
                            <a class="btn btn-secondary-soft-hover py-1 px-2" data-bs-toggle="collapse"
                                href="#collapseChat" aria-expanded="false" aria-controls="collapseChat"><i
                                    class="bi bi-dash-lg"></i></a>
                            <button class="btn btn-secondary-soft-hover py-1 px-2" data-bs-dismiss="toast"
                                aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    </div>
                    <!-- Top avatar and status END -->

                </div>
                <div class="toast-body collapse show" id="collapseChat">
                    <!-- Chat conversation START -->
                    <div
                        class="chat-conversation-content custom-scrollbar h-200px os-host os-theme-dark os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-scrollbar-vertical-hidden os-host-transition">
                        <div class="os-resize-observer-host observed">
                            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
                        </div>
                        <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
                            <div class="os-resize-observer"></div>
                        </div>
                        <div class="os-content-glue" style="margin: 0px;"></div>
                        <div class="os-padding">
                            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow: visible;">
                                <div class="os-content" style="padding: 0px; height: 100%; width: 100%;">
                                    <!-- Chat time -->
                                    <div class="text-center small my-2">Jul 16, 2022, 06:15 am</div>
                                    <!-- Chat message left -->
                                    <div class="d-flex mb-1">
                                        <div class="flex-shrink-0 avatar avatar-xs me-2">
                                            <img class="avatar-img rounded-circle" src="assets/images/avatar/01.jpg"
                                                alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="w-100">
                                                <div class="d-flex flex-column align-items-start">
                                                    <div class="bg-light text-secondary p-2 px-3 rounded-2">Applauded no
                                                        discovery😊</div>
                                                    <div class="small my-2">6:15 AM</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Chat message right -->
                                    <div class="d-flex justify-content-end text-end mb-1">
                                        <div class="w-100">
                                            <div class="d-flex flex-column align-items-end">
                                                <div class="bg-primary text-white p-2 px-3 rounded-2">With pleasure
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Chat message left -->
                                    <div class="d-flex mb-1">
                                        <div class="flex-shrink-0 avatar avatar-xs me-2">
                                            <img class="avatar-img rounded-circle" src="assets/images/avatar/01.jpg"
                                                alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="w-100">
                                                <div class="d-flex flex-column align-items-start">
                                                    <div class="bg-light text-secondary p-2 px-3 rounded-2">Please find
                                                        the attached</div>
                                                    <!-- Files START -->
                                                    <!-- Files END -->
                                                    <div class="small my-2">12:16 PM</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Chat message left -->
                                    <div class="d-flex mb-1">
                                        <div class="flex-shrink-0 avatar avatar-xs me-2">
                                            <img class="avatar-img rounded-circle" src="assets/images/avatar/01.jpg"
                                                alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="w-100">
                                                <div class="d-flex flex-column align-items-start">
                                                    <div class="bg-light text-secondary p-2 px-3 rounded-2">How
                                                        promotion excellent curiosity😮</div>
                                                    <div class="small my-2">3:22 PM</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Chat message right -->
                                    <div class="d-flex justify-content-end text-end mb-1">
                                        <div class="w-100">
                                            <div class="d-flex flex-column align-items-end">
                                                <div class="bg-primary text-white p-2 px-3 rounded-2">And sir dare view.
                                                </div>
                                                <!-- Images -->
                                                <div class="d-flex my-2">
                                                    <div class="small text-secondary">5:35 PM</div>
                                                    <div class="small ms-2"><i class="fa-solid fa-check"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Chat time -->
                                    <div class="text-center small my-2">2 New Messages</div>
                                    <!-- Chat Typing -->
                                    <div class="d-flex mb-1">
                                        <div class="flex-shrink-0 avatar avatar-xs me-2">
                                            <img class="avatar-img rounded-circle" src="assets/images/avatar/01.jpg"
                                                alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="w-100">
                                                <div class="d-flex flex-column align-items-start">
                                                    <div class="bg-light text-secondary p-3 rounded-2">
                                                        <div class="typing d-flex align-items-center">
                                                            <div class="dot"></div>
                                                            <div class="dot"></div>
                                                            <div class="dot"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
                            <div class="os-scrollbar-track os-scrollbar-track-off">
                                <div class="os-scrollbar-handle" style="transform: translate(0px, 0px);"></div>
                            </div>
                        </div>
                        <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-unusable os-scrollbar-auto-hidden">
                            <div class="os-scrollbar-track os-scrollbar-track-off">
                                <div class="os-scrollbar-handle" style="transform: translate(0px, 0px);"></div>
                            </div>
                        </div>
                        <div class="os-scrollbar-corner"></div>
                    </div>
                    <!-- Chat conversation END -->
                    <!-- Chat bottom START -->
                    <div class="mt-2">
                        <!-- Chat textarea -->
                        <textarea class="form-control mb-sm-0 mb-3" placeholder="Type a message" rows="1"></textarea>
                        <!-- Button -->
                        <div class="d-sm-flex align-items-end mt-2">
                            <button class="btn btn-sm btn-danger-soft me-2"><i
                                    class="fa-solid fa-face-smile fs-6"></i></button>
                            <button class="btn btn-sm btn-secondary-soft me-2"><i
                                    class="fa-solid fa-paperclip fs-6"></i></button>
                            <button class="btn btn-sm btn-success-soft me-2"> Gif </button>
                            <button class="btn btn-sm btn-primary ms-auto"> Send </button>
                        </div>
                    </div>
                    <!-- Chat bottom START -->
                </div>
            </div>
            <!-- Chat toast END -->

            <!-- Chat toast 2 START -->
            <div id="chatToast2" class="toast mb-0 bg-mode" role="alert" aria-live="assertive" aria-atomic="true"
                data-bs-autohide="false">
                <div class="toast-header bg-mode">
                    <!-- Top avatar and status START -->
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar me-2">
                                <img class="avatar-img rounded-circle" src="assets/images/avatar/02.jpg" alt="">
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 mt-1">Lori Ferguson</h6>
                                <div class="small text-secondary"><i
                                        class="fa-solid fa-circle text-success me-1"></i>Online</div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <!-- Call button -->
                            <div class="dropdown">
                                <a class="btn btn-secondary-soft-hover py-1 px-2" href="#" id="chatcoversationDropdown2"
                                    role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                    aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="chatcoversationDropdown2">
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-camera-video me-2 fw-icon"></i>Video call</a></li>
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-telephone me-2 fw-icon"></i>Audio call</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-trash me-2 fw-icon"></i>Delete
                                        </a></li>
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-chat-square-text me-2 fw-icon"></i>Mark as unread</a></li>
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-volume-up me-2 fw-icon"></i>Muted</a></li>
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-archive me-2 fw-icon"></i>Archive</a></li>
                                    <li class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-flag me-2 fw-icon"></i>Report</a></li>
                                </ul>
                            </div>
                            <!-- Card action END -->
                            <a class="btn btn-secondary-soft-hover py-1 px-2" data-bs-toggle="collapse"
                                href="#collapseChat2" role="button" aria-expanded="false"
                                aria-controls="collapseChat2"><i class="bi bi-dash-lg"></i></a>
                            <button class="btn btn-secondary-soft-hover py-1 px-2" data-bs-dismiss="toast"
                                aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    </div>
                    <!-- Top avatar and status END -->

                </div>
                <div class="toast-body collapse show" id="collapseChat2">
                    <!-- Chat conversation START -->
                    <div
                        class="chat-conversation-content custom-scrollbar h-200px os-host os-theme-dark os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-scrollbar-vertical-hidden os-host-transition">
                        <div class="os-resize-observer-host observed">
                            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
                        </div>
                        <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
                            <div class="os-resize-observer"></div>
                        </div>
                        <div class="os-content-glue" style="margin: 0px;"></div>
                        <div class="os-padding">
                            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow: visible;">
                                <div class="os-content" style="padding: 0px; height: 100%; width: 100%;">
                                    <!-- Chat time -->
                                    <div class="text-center small my-2">Jul 16, 2022, 06:15 am</div>
                                    <!-- Chat message left -->
                                    <div class="d-flex mb-1">
                                        <div class="flex-shrink-0 avatar avatar-xs me-2">
                                            <img class="avatar-img rounded-circle" src="assets/images/avatar/02.jpg"
                                                alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="w-100">
                                                <div class="d-flex flex-column align-items-start">
                                                    <div class="bg-light text-secondary p-2 px-3 rounded-2">Applauded no
                                                        discovery😊</div>
                                                    <div class="small my-2">6:15 AM</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Chat message right -->
                                    <div class="d-flex justify-content-end text-end mb-1">
                                        <div class="w-100">
                                            <div class="d-flex flex-column align-items-end">
                                                <div class="bg-primary text-white p-2 px-3 rounded-2">With pleasure
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Chat message left -->
                                    <div class="d-flex mb-1">
                                        <div class="flex-shrink-0 avatar avatar-xs me-2">
                                            <img class="avatar-img rounded-circle" src="assets/images/avatar/02.jpg"
                                                alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="w-100">
                                                <div class="d-flex flex-column align-items-start">
                                                    <div class="bg-light text-secondary p-2 px-3 rounded-2">Please find
                                                        the attached</div>
                                                    <!-- Files START -->
                                                    <!-- Files END -->
                                                    <div class="small my-2">12:16 PM</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Chat message left -->
                                    <div class="d-flex mb-1">
                                        <div class="flex-shrink-0 avatar avatar-xs me-2">
                                            <img class="avatar-img rounded-circle" src="assets/images/avatar/02.jpg"
                                                alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="w-100">
                                                <div class="d-flex flex-column align-items-start">
                                                    <div class="bg-light text-secondary p-2 px-3 rounded-2">How
                                                        promotion excellent curiosity😮</div>
                                                    <div class="small my-2">3:22 PM</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Chat message right -->
                                    <div class="d-flex justify-content-end text-end mb-1">
                                        <div class="w-100">
                                            <div class="d-flex flex-column align-items-end">
                                                <div class="bg-primary text-white p-2 px-3 rounded-2">And sir dare view.
                                                </div>
                                                <!-- Images -->
                                                <div class="d-flex my-2">
                                                    <div class="small text-secondary">5:35 PM</div>
                                                    <div class="small ms-2"><i class="fa-solid fa-check"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Chat time -->
                                    <div class="text-center small my-2">2 New Messages</div>
                                    <!-- Chat Typing -->
                                    <div class="d-flex mb-1">
                                        <div class="flex-shrink-0 avatar avatar-xs me-2">
                                            <img class="avatar-img rounded-circle" src="assets/images/avatar/02.jpg"
                                                alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="w-100">
                                                <div class="d-flex flex-column align-items-start">
                                                    <div class="bg-light text-secondary p-3 rounded-2">
                                                        <div class="typing d-flex align-items-center">
                                                            <div class="dot"></div>
                                                            <div class="dot"></div>
                                                            <div class="dot"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
                            <div class="os-scrollbar-track os-scrollbar-track-off">
                                <div class="os-scrollbar-handle" style="transform: translate(0px, 0px);"></div>
                            </div>
                        </div>
                        <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-unusable os-scrollbar-auto-hidden">
                            <div class="os-scrollbar-track os-scrollbar-track-off">
                                <div class="os-scrollbar-handle" style="transform: translate(0px, 0px);"></div>
                            </div>
                        </div>
                        <div class="os-scrollbar-corner"></div>
                    </div>
                    <!-- Chat conversation END -->
                    <!-- Chat bottom START -->
                    <div class="mt-2">
                        <!-- Chat textarea -->
                        <textarea class="form-control mb-sm-0 mb-3" placeholder="Type a message" rows="1"></textarea>
                        <!-- Button -->
                        <div class="d-sm-flex align-items-end mt-2">
                            <button class="btn btn-sm btn-danger-soft me-2"><i
                                    class="fa-solid fa-face-smile fs-6"></i></button>
                            <button class="btn btn-sm btn-secondary-soft me-2"><i
                                    class="fa-solid fa-paperclip fs-6"></i></button>
                            <button class="btn btn-sm btn-success-soft me-2"> Gif </button>
                            <button class="btn btn-sm btn-primary ms-auto"> Send </button>
                        </div>
                    </div>
                    <!-- Chat bottom START -->
                </div>
            </div>
            <!-- Chat toast 2 END -->

        </div>
    </div>
    <!-- Chat END -->

</div>

<!-- Group Modal -->
<div class="modal fade" id="groupModal" tabindex="-1" aria-labelledby="groupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="groupForm" action="{{ route('group.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title text-white" id="groupModalLabel">Create Group</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="groupName" class="form-label">Group Name</label>
                        <input type="text" class="form-control" id="groupName" name="group_name"
                            placeholder="Enter group name" required>
                    </div>

                    <!-- Alpine.js (Make sure it's included in your layout or this page) -->
                    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

                    <div x-data="memberSelector()" class="mb-3">
                        <label class="form-label">Member Names</label>

                        <!-- Input field for typing and selecting -->
                        <input type="text" class="form-control" placeholder="Type name and press Enter"
                            x-model="newMember" list="membersList" @keydown.enter.prevent="addMember">

                        <!-- Autocomplete list -->
                        <datalist id="membersList">
                            <template x-for="member in allMembers" :key="member.id">
                                <option :value="member.name"></option>
                            </template>
                        </datalist>

                        <!-- Selected tags -->
                        <div class="mt-2">
                            <template x-for="(member, index) in selectedMembers" :key="member.id">
                                <span class="badge bg-primary me-1 mb-1">
                                    <span x-text="member.name"></span>
                                    <button type="button" class="btn-close btn-close-white btn-sm ms-1"
                                        @click="removeMember(index)">
                                    </button>
                                    <input type="hidden" name="member_ids[]" :value="member.id">
                                </span>
                            </template>
                        </div>
                    </div>

                    <script>
                    function memberSelector() {
                        return {
                            newMember: '',
                            selectedMembers: [],
                            allMembers: @json($members), // assuming each member has {id, name}

                            addMember() {
                                if (!this.newMember.trim()) return;

                                const match = this.allMembers.find(m =>
                                    m.name.toLowerCase() === this.newMember.trim().toLowerCase()
                                );

                                if (match && !this.selectedMembers.some(m => m.id === match.id)) {
                                    this.selectedMembers.push(match);
                                }

                                this.newMember = '';
                            },

                            removeMember(index) {
                                this.selectedMembers.splice(index, 1);
                            }
                        }
                    }
                    </script>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Group</button>
                    </div>
                </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('groupActionpost');
    modal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const groupName = button.getAttribute('data-group-name');
        const groupId = button.getAttribute('data-group-id');


        // Set hidden input value
        modal.querySelector('.group_id').value = groupId;
        //console.log(groupName); // Debugging line to check group name
        const modalTitleSpan = modal.querySelector('.group_name');

        if (modalTitleSpan) {
            modalTitleSpan.textContent = groupName;
        }
    });
});
</script>
<!-- Right sidebar END -->