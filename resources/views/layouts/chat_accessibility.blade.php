<div class="d-none d-lg-block">
    <!-- Button -->
    <a class="icon-md btn btn-primary position-fixed end-0 bottom-0" data-bs-toggle="offcanvas" href="#offcanvasChat"
        role="button" aria-controls="offcanvasChat"
        style="margin-right: 2rem !important; margin-bottom: 7rem !important;background-color: #792421; color: #fff; border-radius: 50%; box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);">
        <i class="bi bi-chat-left-text-fill" style="color: #fff;"></i>
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

<!-- accessibility panel -->
       <div class="uwaw uw-light-theme gradient-head uwaw-initial paid_widget" id="uw-main">
           <div class="relative second-panel" style="background-color: #792421;">
               <h3>Accessibility options by LBSNAA</h3>
               <div class="uwaw-close" onclick="closeMain()"></div>
           </div>
           <div class="uwaw-body">
               <div class="h-scroll" style="height: calc(100vh - 200px) !important;">
                   <div class="uwaw-features">
                       <div class="uwaw-features__item reset-feature" id="featureItem_sp"> <button id="speak"
                               class="uwaw-features__item__i" data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__icon"> <span class="ux4g-icon icon-speaker"> </span>
                               </span>
                               <span class="uwaw-features__item__name">Text To Speech</span> <span
                                   class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon_sp"
                                   style="display: none"> </span> </button> </div>
                       <div class="uwaw-features__item reset-feature" id="featureItem"> <button id="btn-s9"
                               class="uwaw-features__item__i" data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__icon"> <span class="ux4g-icon icon-bigger-text"> </span>
                               </span><span class="uwaw-features__item__name">Bigger Text</span>
                               <div class="uwaw-features__item__steps reset-steps" id="featureSteps">
                                   <!-- Steps span tags will be dynamically added here -->
                               </div> <span class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon"
                                   style="display: none"> </span>
                           </button> </div>
                       <div class="uwaw-features__item reset-feature" id="featureItem-st"> <button id="btn-small-text"
                               class="uwaw-features__item__i" data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__icon"> <span class="ux4g-icon icon-small-text"> </span>
                               </span><span class="uwaw-features__item__name">Small Text</span>
                               <div class="uwaw-features__item__steps reset-steps" id="featureSteps-st">
                                   <!-- Steps span tags will be dynamically added here -->
                               </div> <span class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-st"
                                   style="display: none"> </span>
                           </button> </div>
                       <div class="uwaw-features__item reset-feature" id="featureItem-lh"> <button id="btn-s12"
                               class="uwaw-features__item__i" data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__icon"> <span class="ux4g-icon icon-line-hight"> </span>
                               </span> <span class="uwaw-features__item__name">Line Height</span>
                               <div class="uwaw-features__item__steps reset-steps" id="featureSteps-lh">
                                   <!-- Steps span tags will be dynamically added here -->
                               </div> <span class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-lh"
                                   style="display: none"> </span>
                           </button> </div>
                       <div class="uwaw-features__item reset-feature" id="featureItem-ht"> <button id="btn-s10"
                               onclick="highlightLinks()" class="uwaw-features__item__i"
                               data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__icon"> <span class="ux4g-icon icon-highlight-links">
                                   </span>
                               </span> <span class="uwaw-features__item__name">Highlight Links</span> <span
                                   class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-ht"
                                   style="display: none"> </span> </button> </div>
                       <div class="uwaw-features__item reset-feature" id="featureItem-ts"> <button id="btn-s13"
                               onclick="increaseAndReset()" class="uwaw-features__item__i"
                               data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__icon"> <span class="ux4g-icon icon-text-spacing"> </span>
                               </span> <span class="uwaw-features__item__name">Text Spacing</span>
                               <div class="uwaw-features__item__steps reset-steps" id="featureSteps-ts">
                                   <!-- Steps span tags will be dynamically added here -->
                               </div> <span class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-ts"
                                   style="display: none"> </span>
                           </button> </div>
                       <div class="uwaw-features__item reset-feature" id="featureItem-df"> <button id="btn-df"
                               onclick="toggleFontFeature()" class="uwaw-features__item__i"
                               data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__icon"> <span class="ux4g-icon icon-dyslexia-font">
                                   </span>
                               </span> <span class="uwaw-features__item__name">Dyslexia Friendly</span> <span
                                   class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-df"
                                   style="display: none"> </span> </button> </div>
                       <div class="uwaw-features__item reset-feature" id="featureItem-hi"> <button id="btn-s11"
                               onclick="toggleImages()" class="uwaw-features__item__i"
                               data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__icon"> <span class="ux4g-icon icon-hide-images"> </span>
                               </span> <span class="uwaw-features__item__name">Hide Images</span> <span
                                   class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-hi"
                                   style="display: none"> </span> </button> </div>
                       <div class="uwaw-features__item reset-feature" id="featureItem-Cursor"> <button id="btn-cursor"
                               onclick="toggleCursorFeature()" class="uwaw-features__item__i"
                               data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__icon"> <span class="ux4g-icon icon-cursor"> </span>
                               </span>
                               <span class="uwaw-features__item__name">Cursor</span> <span
                                   class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-cursor"
                                   style="display: none"> </span> </button> </div>
                       <div class="uwaw-features__item reset-feature" id="featureItem-ht-dark"> <button id="dark-btn"
                               class="uwaw-features__item__i" data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__name"> <span class="light_dark_icon"> <input
                                           type="checkbox" class="light_mode uwaw-featugres__item__i" id="checkbox" />
                                       <label for="checkbox" class="checkbox-label">
                                           <!-- <i class="fas fa-moon-stars"></i> --> <i class="fas fa-moon-stars">
                                               <span class="ux4g-icon icon-moon"></span> </i> <i class="fas fa-sun">
                                               <span class="ux4g-icon icon-sun"></span> </i> <span class="ball"></span>
                                       </label> </span> <span class="uwaw-features__item__name">Light-Dark</span>
                               </span>
                               <span class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-ht-dark"
                                   style="display: none; pointer-events: none"> </span> </button> </div>
                       <!-- Invert Colors Widget -->
                       <div class="uwaw-features__item reset-feature" id="featureItem-ic"> <button id="btn-invert"
                               class="uwaw-features__item__i" data-uw-reader-content="Enable the UserWay screen reader"
                               aria-label="Enable the UserWay screen reader" aria-pressed="false"> <span
                                   class="uwaw-features__item__icon"> <span class="ux4g-icon icon-invert"> </span>
                               </span>
                               <span class="uwaw-features__item__name">Invert Colors</span> <span
                                   class="tick-active uwaw-features__item__enabled reset-tick" id="tickIcon-ic"
                                   style="display: none"> </span> </button> </div>
                   </div>
               </div> <!-- Reset Button -->
           </div>
           <div class="reset-panel">
               <!-- copyright accessibility bar -->
               <div class="copyrights-accessibility"> <button class="btn-reset-all" id="reset-all" onclick="resetAll()">
                       <span class="reset-icon"> </span> <span class="reset-btn-text">Reset All Settings</span>
                   </button>
               </div>
           </div>
       </div>
       <button id="uw-widget-custom-trigger" class="uw-widget-custom-trigger" aria-label="Accessibility Widget"
           data-uw-trigger="true" aria-haspopup="dialog" style="background-color: #792421;"><img
               src="data:image/svg+xml,%0A%3Csvg width='32' height='32' viewBox='0 0 32 32' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cg clip-path='url(%23clip0_1_1506)'%3E%3Cpath d='M16 7C15.3078 7 14.6311 6.79473 14.0555 6.41015C13.4799 6.02556 13.0313 5.47894 12.7664 4.83939C12.5015 4.19985 12.4322 3.49612 12.5673 2.81719C12.7023 2.13825 13.0356 1.51461 13.5251 1.02513C14.0146 0.535644 14.6383 0.202301 15.3172 0.0672531C15.9961 -0.0677952 16.6999 0.00151652 17.3394 0.266423C17.9789 0.53133 18.5256 0.979934 18.9101 1.55551C19.2947 2.13108 19.5 2.80777 19.5 3.5C19.499 4.42796 19.1299 5.31762 18.4738 5.97378C17.8176 6.62994 16.928 6.99901 16 7Z' fill='white'/%3E%3Cpath d='M27 7.05L26.9719 7.0575L26.9456 7.06563C26.8831 7.08313 26.8206 7.10188 26.7581 7.12125C25.595 7.4625 19.95 9.05375 15.9731 9.05375C12.2775 9.05375 7.14313 7.67875 5.50063 7.21188C5.33716 7.14867 5.17022 7.09483 5.00063 7.05063C3.81313 6.73813 3.00063 7.94438 3.00063 9.04688C3.00063 10.1388 3.98188 10.6588 4.9725 11.0319V11.0494L10.9238 12.9081C11.5319 13.1413 11.6944 13.3794 11.7738 13.5856C12.0319 14.2475 11.8256 15.5581 11.7525 16.0156L11.39 18.8281L9.37813 29.84C9.37188 29.87 9.36625 29.9006 9.36125 29.9319L9.34688 30.0112C9.20188 31.0206 9.94313 32 11.3469 32C12.5719 32 13.1125 31.1544 13.3469 30.0037C13.5813 28.8531 15.0969 20.1556 15.9719 20.1556C16.8469 20.1556 18.6494 30.0037 18.6494 30.0037C18.8838 31.1544 19.4244 32 20.6494 32C22.0569 32 22.7981 31.0162 22.6494 30.0037C22.6363 29.9175 22.6206 29.8325 22.6019 29.75L20.5625 18.8294L20.2006 16.0169C19.9387 14.3788 20.1494 13.8375 20.2206 13.7106C20.2225 13.7076 20.2242 13.7045 20.2256 13.7013C20.2931 13.5763 20.6006 13.2963 21.3181 13.0269L26.8981 11.0763C26.9324 11.0671 26.9662 11.0563 26.9994 11.0438C27.9994 10.6688 28.9994 10.15 28.9994 9.04813C28.9994 7.94625 28.1875 6.73813 27 7.05Z' fill='white'/%3E%3C/g%3E%3Cdefs%3E%3CclipPath id='clip0_1_1506'%3E%3Crect width='32' height='32' fill='white'/%3E%3C/clipPath%3E%3C/defs%3E%3C/svg%3E%0A"><span
               class="text-white">Accessibility
               Options</span></button><!-- accessibility panel end-->