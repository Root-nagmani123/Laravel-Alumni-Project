<header class="bg-dark text-white py-2 px-4 d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" height="40" class="me-3">
        <input type="text" class="form-control" placeholder="Search..." style="width: 300px;">
    </div>
    <div class="d-flex align-items-center gap-4">
        <span class="material-icons">notifications</span>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('storage/profile_pictures/' . auth()->user()->profile_picture ?? 'default.png') }}" class="rounded-circle" height="35" width="35" alt="User">
                <span class="ms-2">{{ auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</header>
