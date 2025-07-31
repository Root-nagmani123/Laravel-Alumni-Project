<!-- =======================
Header START -->
<header class="navbar-light fixed-top header-static bg-mode">

    <!-- Logo Nav START -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo START -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="https://www.lbsnaa.gov.in/" target="_blank">
                <img src="{{ asset('admin_assets/images/logos/lbsnaa_logo.jpg') }}" alt="LBSNAA Logo"
                    class="navbar-brand-item" style="height: 60px; object-fit: contain;">

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
                    <!-- Nav item 2 Mega menu -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('user/library') }}">Library</a>
                    </li>
                    <!-- Nav item 3 Mega menu -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('user/events') }}">Events</a>
                    </li>
                </ul>
                <!-- Search Input Group with Dropdown -->
                <div class="position-relative">
                    <form onsubmit="return showSearchResults(event)">
                        <input type="search" id="searchInput" class="form-control ps-5" placeholder="Search..."
                            autocomplete="off" aria-label="Search" />
                        <button type="submit"
                            class="btn bg-transparent px-2 py-0 position-absolute top-50 start-0 translate-middle-y">
                            <i class="bi bi-search fs-5"></i>
                        </button>
                    </form>

                    <!-- Dropdown Menu -->
                    <div id="searchDropdown" class="dropdown-menu w-100 shadow mt-1"
                        style="max-height: 300px; overflow-y: auto;">
                        <!-- Filled by JavaScript -->
                    </div>
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
                            alt="">
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
                                        alt="avatar">
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
<!-- =======================
Header END -->

<script>
  const members = [
    { id: 1, name: 'John Doe' },
    { id: 2, name: 'Priya Sharma' },
    { id: 3, name: 'Amit Verma' },
    // Add more as needed
  ];

  function showSearchResults(event) {
    event.preventDefault();
    const input = document.getElementById('searchInput');
    const query = input.value.toLowerCase().trim();
    const dropdown = document.getElementById('searchDropdown');

    // Clear previous results
    dropdown.innerHTML = '';

    // Always add the "Alumni Already Added" option at the top
    const alumniItem = document.createElement('button');
    alumniItem.type = 'button';
    alumniItem.className = 'dropdown-item fw-bold text-primary';
    alumniItem.textContent = 'Alumni';
    dropdown.appendChild(alumniItem);

    // Filter and add matching members
    const filtered = members.filter(m => m.name.toLowerCase().includes(query));

    if (filtered.length === 0) {
      const noResult = document.createElement('button');
      noResult.type = 'button';
      noResult.className = 'dropdown-item text-muted';
      noResult.textContent = 'No matching members';
      dropdown.appendChild(noResult);
    } else {
      filtered.forEach(member => {
        const item = document.createElement('button');
        item.type = 'button';
        item.className = 'dropdown-item d-flex justify-content-between align-items-center';
        item.innerHTML = `
          <span>${member.name}</span>
          <i class="bi bi-star text-warning" title="Mark as Favourite"></i>
        `;
        dropdown.appendChild(item);
      });
    }

    // Show dropdown
    dropdown.classList.add('show');
  }

  // Optional: Hide dropdown when clicked outside
  document.addEventListener('click', function (e) {
    const dropdown = document.getElementById('searchDropdown');
    const input = document.getElementById('searchInput');
    if (!input.contains(e.target) && !dropdown.contains(e.target)) {
      dropdown.classList.remove('show');
    }
  });
</script>
<style>
  #searchInput:focus + #searchDropdown {
    display: block;
  }
</style>

