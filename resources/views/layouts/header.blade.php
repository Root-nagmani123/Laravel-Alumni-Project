<!-- =======================
Header START -->
<header class="navbar-light fixed-top header-static bg-mode">

    <!-- Logo Nav START -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo START -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="https://www.lbsnaa.gov.in/" target="_blank">
                <img src="{{ asset('admin_assets/images/logos/lbsnaa_logo.jpg') }}" alt="LBSNAA Logo"
                    class="navbar-brand-item" style="height: 60px; object-fit: contain;" loading="lazy"
                    decoding="async">

                <div class="d-flex flex-column lh-sm">
                    <span class="h5 mb-0 fw-bold">Alumni</span>
                    <span style="font-size: 12px; font-weight: 500;color: #af2910;">Lal Bahadur Shastri <br>National
                        Academy of Administration</span>
                </div>
            </a>

            <!-- Logo END -->

            <!-- Responsive navbar toggler -->
            <button class="navbar-toggler ms-auto icon-md btn btn-light p-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-animation">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>

            <!-- Main navbar START -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav navbar-nav-scroll mx-auto">
                    <li class="nav-item">

                        <a class="nav-link" href="{{ route('user.profile.name', ['name' => 'Alumni']) }}">Home</a>
                    </li>
                    <!-- Nav item 1 Demos -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('user/feed') }}">Feed</a>
                    </li>
                    <!-- Nav item: Dropdown for Library -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="libraryDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Library
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="libraryDropdown">
                            <li>
                                <a class="dropdown-item" href="https://gsl.lbsnaa.gov.in/" target="_blank">
                                    Gandhi Smriti Library Online Catalogue (OPAC)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="https://idpbridge.myloft.xyz/simplesaml/module.php/core/loginuserpass?AuthState=_13df360546d97777e748e8ded7bf639c5c8c45d3d7%3Ahttps%3A%2F%2Fidpbridge.myloft.xyz%2Fsimplesaml%2Fmodule.php%2Fsaml%2Fidp%2FsingleSignOnService%3Fspentityid%3Dhttps%253A%252F%252Felibrarylbsnaa.myloft.xyz%26cookieTime%3D1688360911"
                                    target="_blank">
                                    e-Library (MyLOFT)
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Nav item 3 Mega menu -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('user/events') }}">Events</a>
                    </li>
                </ul>
                <!-- Search Input Group with Dropdown -->
                <div class="position-relative">
                    <form id="searchForm">
                        <input type="search" id="searchMemberInput" class="form-control ps-5" placeholder="Search..."
                            autocomplete="off" aria-label="Search" />
                        <button type="button"
                            class="btn bg-transparent px-2 py-0 position-absolute top-50 start-0 translate-middle-y">
                            <i class="bi bi-search fs-5"></i>
                        </button>
                    </form>
                    <ul id="searchResults" class="list-group position-absolute w-100 z-3 mt-1" style="max-height: 200px; overflow-y: auto;background-color: #ffffff;"></ul>
                </div>


            </div>
            <!-- Main navbar END -->

            <!-- Nav right START -->
            <ul class="nav flex-nowrap align-items-center ms-sm-3 list-unstyled">
                <li class="nav-item dropdown ms-2">
                    <a class="nav-link bg-light icon-md btn btn-light p-0" href="#" id="notifDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        <span class="badge-notif animation-blink"></span>
                        <i class="bi bi-bell-fill fs-6"> </i>
                    </a>
                    <div class="dropdown-menu dropdown-animation dropdown-menu-end dropdown-menu-size-md p-0 shadow-lg border-0"
                        aria-labelledby="notifDropdown">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="m-0">Notifications <span
                                        class="badge bg-danger bg-opacity-10 text-danger ms-2">4 new</span></h6>
                                <a class="small" href="#">Clear all</a>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush list-unstyled p-2">
                                    <!-- Notif item -->
                                    <li>
                                        <a href="#"
                                            class="list-group-item list-group-item-action rounded d-flex border-0 mb-1 p-3">
                                            <div class="avatar text-center d-none d-sm-inline-block">
                                                <div class="avatar-img rounded-circle bg-success"><span
                                                        class="text-white position-absolute top-50 start-50 translate-middle fw-bold">WB</span>
                                                </div>
                                            </div>
                                            <div class="ms-sm-3">
                                                <div class="d-flex">
                                                    <p class="small mb-2">Webestica has 15 like and 1 new activity</p>
                                                    <p class="small ms-3">1hr</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer text-center">
                                <a href="#" class="btn btn-sm btn-primary-soft">See all incoming activity</a>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- Notification dropdown END -->

                <li class="nav-item ms-2 dropdown">
                    <a class="nav-link btn icon-md p-0" href="#" id="profileDropdown" role="button"
                        data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        @php
                        $user = Auth::guard('user')->user();
                        @endphp
                        <img class="avatar-img rounded-2"
                            src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('feed_assets/images/avatar-1.png') }}"
                            alt="" loading="lazy" decoding="async">
                    </a>
                    <ul class="dropdown-menu dropdown-animation dropdown-menu-end pt-3 small me-md-n3"
                        aria-labelledby="profileDropdown">
                        <!-- Profile info -->
                        @php
                        $profileImage = '';
                        $displayName = '';
                        $designation = '';
                        $profileLink = '#';

                        if (Auth::guard('user')->check()) {
                        // Member/user post
                        $member = $post->member ?? null;

                        $profileImage = $member && $member->profile_image
                        ? asset('storage/' . $member->profile_image)
                        : asset('feed_assets/images/avatar/07.jpg');

                        $displayName = $member->name ?? 'Unknown';
                        $designation = $member->designation ?? 'Unknown';
                        $profileLink = url('/user/profile/' . ($member->id ?? 0));
                        }
                        else {
                        // Default user profile
                        $user = Auth::guard('user')->user();
                        $profileImage = $user->profile_pic
                        ? asset('storage/' . $user->profile_pic)
                        : asset('feed_assets/images/avatar-1.png');

                        $displayName = $user->name ?? 'Guest User';
                        $designation = $user->designation ?? 'Guest';
                        $profileLink = url('/user/profile/' . ($user->id ?? 0));
                        }
                        $user = Auth::guard('user')->user();
                        $profileImage = $user->profile_pic ? asset('storage/' . $user->profile_pic) :
                        asset('feed_assets/images/avatar-1.png');
                        $displayName = $user->name ?? 'Guest User';
                        $designation = $user->designation ?? 'Guest';
                        $profileLink = url('/user/profile/' . ($user->id ?? 0));
                        @endphp
                        <li class="px-3">
                            <div class="d-flex align-items-center position-relative">
                                <!-- Avatar -->
                                <div class="avatar me-3">
                                    <img class="avatar-img rounded-circle"
                                        src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('feed_assets/images/avatar-1.png') }}"
                                        alt="avatar" loading="lazy" decoding="async">
                                </div>
                                <div>
                                    @if(Auth::guard('user')->check())
                                    <a class="h6 stretched-link" href="#">{{ Auth::guard('user')->user()->name }}</a>
                                    @endif
                                    <p class="small m-0">{{ Auth::guard('user')->user()->designation }}</p>
                                </div>
                            </div>
                            @if(Auth::guard('user')->check())
                            @php
                            $user = Auth::guard('user')->user();
                            @endphp
                            <a href="{{ route('user.profile', ['id' => $user->id]) }}"
                                class="dropdown-item btn btn-primary-soft btn-sm my-2 text-center">View profile</a>
                            @endif
                        </li>
                        <!-- Links -->
                        <li><a class="dropdown-item" href="{{ route('user.directory') }}"><i
                                    class="bi bi-gear-fill fa-fw me-2"></i>Directory</a></li>
                        <!-- Dropdown with collapsible Social Media list -->
                        <li><a class="dropdown-item" href="{{ route('user.change-password.form') }}"><i
                                    class="bi bi-file-earmark-bar-graph-fill fa-fw me-2"></i>Change Password</a></li>
                        <li>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#grievanceModal">
                                <i class="bi bi-chat-dots-fill fa-fw me-2"></i>Grievance / Feedback
                            </a>
                        </li>

                        <li>
                            <form action="{{ route('user.logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex align-items-center">
                                    <i class="bi bi-x-circle-fill fa-fw me-2"></i>
                                    Sign Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                <!-- Profile START -->

            </ul>
            <!-- Nav right END -->
        </div>
    </nav>
    <!-- Logo Nav END -->
</header>
<!-- ======================= Grievance/Feedback Modal -->
<div class="modal fade" id="grievanceModal" tabindex="-1" aria-labelledby="grievanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('user.grievance.submit') }}" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="grievanceModalLabel">Submit Grievance / Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                          @csrf
                    <!-- Type Dropdown -->
                    <div class="mb-3">
                        <label for="typeSelect" class="form-label">Type<span class="text-danger">*</span></label>

                        <select class="form-select" id="typeSelect" name="typeSelect" required>
                            <option value="">Select</option>
                            <option value="grievance">Grievance</option>
                            <option value="feedback">Feedback</option>
                        </select>
                    </div>

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="userName" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="userName" name="userName" placeholder="Enter your name" value="{{ auth()->guard('user')->user()->name }}" required readonly>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="userEmail" name="userEmail" placeholder="Enter your email" value="{{ auth()->guard('user')->user()->email }}" required readonly>
                    </div>

                    <!-- Message -->
                    <div class="mb-3">
                        <label for="userMessage" class="form-label">Message <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="userMessage" name="userMessage" rows="4" maxlength="1000"
                            placeholder="Write your message (max 1000 characters)" required></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
#searchMemberInput:focus+#searchDropdown {
    display: block;
}
</style>
