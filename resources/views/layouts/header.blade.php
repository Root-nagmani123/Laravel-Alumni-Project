<!-- =======================
Header START -->
<style>
    .notification-item:hover {
    background-color: #f8f9fa; /* Light gray on hover */
    cursor: pointer;
}
/* This goes in your CSS file */
.dropdown-menu {
    z-index: 1100 !important;
}


</style>
<header class="navbar-light fixed-top header-static bg-mode">

    <!-- Logo Nav START -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo START -->
<a class="navbar-brand d-flex align-items-center gap-2" href="https://www.lbsnaa.gov.in/" target="_blank">
    <img src="{{ asset('admin_assets/images/logos/lbsnaa_logo.jpg') }}" alt="LBSNAA Logo"
        class="navbar-brand-item" style="height: 60px; object-fit: contain;" loading="lazy" decoding="async">

    <!-- Text: visible only on medium and up -->
    <div class="d-none d-md-flex flex-column lh-sm">
        <span class="h5 mb-0 fw-bold">Alumni</span>
        <span style="font-size: 12px; font-weight: 500; color: #af2910;">
            Lal Bahadur Shastri <br> National Academy of Administration
        </span>
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
                        <a class="nav-link" href="{{ url('user/all-events') }}">Events</a>
                    </li>
                </ul>
                <!-- Search Input Group with Dropdown -->
                <!-- SEARCH BOX -->
                <div class="position-relative">
                    <form id="searchForm">
                        <input type="search" id="searchMemberInput" class="form-control ps-5" placeholder="Search..."
                            autocomplete="off" aria-label="Search" />
                        <button type="button"
                            class="btn bg-transparent px-2 py-0 position-absolute top-50 start-0 translate-middle-y">
                            <i class="bi bi-search fs-5"></i>
                        </button>
                    </form>
                    <ul id="searchResults" class="list-group position-absolute w-100 z-3 mt-1" style="max-height: 200px; overflow-y: auto;background-color: #ffffffb8;"></ul>
                </div>
            </div>
            <!-- Main navbar END -->

            <!-- Nav right START -->
            <ul class="nav flex-nowrap align-items-center ms-sm-3 list-unstyled">
                <li class="nav-item dropdown ms-2">
                    <a class="nav-link bg-light icon-md btn btn-light p-0" href="#" id="notifDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        @php
                        $showNotifBadge = false;
                        if (Auth::guard('user')->check()) {
                        $member = \App\Models\Member::find(Auth::guard('user')->id());
                        if ($member && $member->is_notification == 0 && isset($notifications) && $notifications->count()
                        > 0) {
                        $showNotifBadge = true;
                        }
                        }
                        @endphp
                        @php
                        $latestNotifications = $notifications->sortByDesc('created_at');
                        @endphp
                        @if($showNotifBadge)
                        <span class="badge-notif animation-blink"></span>
                        @endif
                        <i class="bi bi-bell-fill fs-6"> </i>
                    </a>
                    <div class="dropdown-menu dropdown-animation dropdown-menu-end dropdown-menu-size-md p-0 shadow-lg border-0"
                        aria-labelledby="notifDropdown">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="m-0">Notifications <span
                                        class="badge bg-danger bg-opacity-10 text-danger ms-2">{{ isset($notifications) ? $notifications->count() : 0 }}</span>
                                </h6>
                                <a class="small"
                                    href="{{ route('user.notifications.status', ['id' => Auth::guard('user')->user()->id]) }}">Clear
                                    all</a>
                            </div>
                            <div class="card-body p-0" style="max-height: 300px; overflow-y: auto;">
                                <ul class="list-group list-group-flush list-unstyled p-2">
                                        @if(isset($notifications) && $notifications->count() > 0)
                                        @php
                                        $latestNotifications = $notifications->sortByDesc('created_at');
                                        @endphp
                                        @foreach($latestNotifications as $notification)
                                        <!-- Notif item -->
                                        <li>
                                            @php
                    
                                                $notificationUrl = '#';
                                                // Debug: Log notification data
                                                if (isset($notification->source_id) && isset($notification->source_type)) {
                                                    switch ($notification->source_type) {
                                                        case 'event':
                                                            $notificationUrl = route('user.allevents');
                                                            break;
                                                        case 'broadcast':
                                                            $notificationUrl = route('user.broadcastDetails', ['id' => $notification->source_id]);
                                                            break;
                                                        case 'forum':
                                                                $notificationUrl = route('user.forum.show', ['id' => $notification->source_id]);
                                                                break;
                                                        case 'profile':
                                                            $notificationUrl = url('/profile/' . $notification->source_id);
                                                            break;
                                                        case 'post':
                                                            $notificationUrl = url('user/group-post/' . $notification->source_id);
                                                            break;
                                                        case 'group':
                                                            $notificationUrl = route('user.group-post', ['id' => $notification->source_id]);
                                                            break;
                                                        case 'birthday':
                                                            $notificationUrl = url('/profile/' . $notification->source_id);
                                                            break;
                                                        default:
                                                            $notificationUrl = '#';
                                                    }
                                                }
                                                // Debug: Log the generated URL
                                                if (app()->environment('local')) {
                                                    \Log::info('Notification URL generated:', [
                                                        'source_id' => $notification->source_id ?? 'null',
                                                        'source_type' => $notification->source_type ?? 'null',
                                                        'url' => $notificationUrl
                                                    ]);
                                                }
                                            @endphp
                                            <div class="list-group-item rounded d-flex border-0 mb-1 p-3">
                                                <div class="ms-sm-3">
                                                    <div class="d-flex">
                                                        <a href="{{ $notificationUrl }}" class="text-decoration-none notification-link" 
                                            <div class="notification-card bg-white border rounded shadow-sm p-3 mb-3"
             style="min-width: 300px; max-width: 340px; scroll-snap-align: start;">
            
            <!-- Avatar + Content -->
            <div class="d-flex align-items-start">
                <!-- Avatar -->
                <div class="flex-shrink-0">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                         style="width: 40px; height: 40px;">
                        <strong>{{ strtoupper(substr($notification->title ?? 'B', 0, 1)) }}</strong>
                    </div>
                </div>

                <!-- Message -->
                <div class="flex-grow-1 ms-3 notification-item mb-2"
                     style="max-width: calc(100% - 60px);">
                    <div class="d-flex justify-content-between">
                                                        <a href="{{ $notificationUrl }}" class="text-decoration-none notification-link" 
                                                           data-url="{{ $notificationUrl }}" 
                                                           data-source-type="{{ $notification->source_type ?? '' }}" 
                                                           data-source-id="{{ $notification->source_id ?? '' }}"
                                                           onclick="handleNotificationClick(event, '{{ $notificationUrl }}', '{{ $notification->source_type ?? '' }}', '{{ $notification->source_id ?? '' }}')">
                                                            <p class="small mb-2 text-primary">
                                                                {{ $notification->message }}
                                                            </p>
                                                        </a>
                                                        <p class="small ms-3 mb-0 text-muted text-nowrap">
                                                             {{ \Carbon\Carbon::parse($notification->created_at)->setTimezone('Asia/Kolkata')->diffForHumans(null, null, true) }}
                                                        </p>
                                                    </div>
                </div>
            </div>
        </div>
                                        </li>
                                        @endforeach
                                        @else
                                        <!-- No notifications -->
                                        <li>
                                            <div class="list-group-item rounded d-flex border-0 mb-1 p-3">
                                                <div class="ms-sm-3">
                                                    <p class="small mb-0 text-muted">No notifications</p>
                                                </div>
                                            </div>
                                        </li>
                                        @endif
                                    </ul>

                            </div>
                        </div>
                    </div>
                </li>
                <!-- Notification dropdown END -->

                <li class="nav-item ms-2 dropdown" style="z-index:1060 !important;">
                    <a class="nav-link btn icon-md p-0" href="#" id="profileDropdown" role="button"
                        data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        @php
                        $user = Auth::guard('user')->user();
                        @endphp
                        <img class="avatar-img rounded-2"
                            src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}"
                            alt="" loading="lazy" decoding="async">
                    </a>
                    <ul class="dropdown-menu dropdown-animation dropdown-menu-end pt-3 small me-md-n3"
    aria-labelledby="profileDropdown"
    style="z-index: 1100;">

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
                                        src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}"
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
                           <a href="{{ route('user.profile.data', ['id' => $user->id]) }}"
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
                        <!-- <li>
                            <a class="dropdown-item" href="https://www.lbsnaa.gov.in/lbsnaa-newsletter" target="_blank">
                                <i class="bi bi-newspaper fa-fw me-2"></i>Newsletter
                            </a>
                        </li> -->
                        <li>
                            <a class="dropdown-item" href="https://www.lbsnaa.gov.in/footer_menu/contact-us" target="_blank">
                                <i class="bi bi-person-lines-fill fa-fw me-2"></i>Contact Us
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
                        <input type="text" class="form-control" id="userName" name="userName"
                            placeholder="Enter your name" value="{{ auth()->guard('user')->user()->name }}" required
                            readonly>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="userEmail" name="userEmail"
                            placeholder="Enter your email" value="{{ auth()->guard('user')->user()->email }}" required
                            readonly>
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

<script>
function handleNotificationClick(event, url, sourceType, sourceId) {
    event.preventDefault();
    event.stopPropagation();
    
    console.log('Notification clicked:', {
        url: url,
        sourceType: sourceType,
        sourceId: sourceId
    });
    
    // Only redirect if we have a valid URL (not '#')
    if (url && url !== '#') {
        window.location.href = url;
    } else {
        console.log('No valid URL for notification type:', sourceType);
    }
}

// Add event listeners for notification links
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, looking for notification links...');
    const notificationLinks = document.querySelectorAll('.notification-link');
    console.log('Found notification links:', notificationLinks.length);
    
    notificationLinks.forEach((link, index) => {
        console.log(`Link ${index}:`, {
            url: link.getAttribute('data-url'),
            sourceType: link.getAttribute('data-source-type'),
            sourceId: link.getAttribute('data-source-id')
        });
        
        link.addEventListener('click', function(e) {
            console.log('Notification link clicked!');
            const url = this.getAttribute('data-url');
            const sourceType = this.getAttribute('data-source-type');
            const sourceId = this.getAttribute('data-source-id');
            
            handleNotificationClick(e, url, sourceType, sourceId);
        });
    });
});
</script>

<style>
/* Adjust logo text font for better mobile experience */
@media (max-width: 767.98px) {
    .navbar-brand .h5 {
        font-size: 1rem;
    }
}

/* Make sure dropdown menus don't overflow on mobile */
.dropdown-menu {
    max-width: 90vw;
    word-wrap: break-word;
}

/* Fix search box for smaller screens */
@media (max-width: 767.98px) {
    #searchForm {
        width: 100%;
        margin-top: 0.5rem;
    }

    .navbar-collapse {
        margin-top: 1rem;
    }

    #searchResults {
        max-height: 150px;
        font-size: 14px;
    }
}

/* Toast positioning for small screens */
@media (max-width: 576px) {
    .toast {
        width: 90vw;
    }
}
</style>