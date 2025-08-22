<!-- Sidebar Start -->
<aside class="side-mini-panel with-vertical">
    <div class="iconbar">
        <div>
            <!-- Mini Navigation -->
            <div class="mini-nav">
                <div class="brand-logo d-flex align-items-center justify-content-center">
                    <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                        <iconify-icon icon="solar:hamburger-menu-line-duotone" class="fs-7"></iconify-icon>
                    </a>
                </div>
                <ul class="mini-nav-ul simplebar-scrollable-y" data-simplebar>
                    <li class="mini-nav-item" id="mini-1">
                        <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="right" title="General">
                            <iconify-icon icon="solar:layers-line-duotone" class="fs-7"></iconify-icon>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Full Sidebar -->
            <div class="sidebarmenu">
                <div class="brand-logo d-flex align-items-center nav-logo">
                    <a href="#" class="text-nowrap logo-img">
                        <img src="{{ asset('admin_assets/images/logos/logo.png') }}" alt="Logo" class="logo img-fluid">
                    </a>
                </div>

                <nav class="sidebar-nav d-block simplebar-scrollable-y" id="menu-right-mini-1" data-simplebar>
                    <ul class="sidebar-menu" id="sidebarnav">
                        <li class="nav-small-cap">
                            <span class="hide-menu">General</span>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('dashboard') }}">
                                <iconify-icon icon="solar:database-bold-duotone"></iconify-icon>
                                <span class="icon-small"></span> Dashboard
                            </a>
                        </li>
<li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.registration.index') }}">
                                <iconify-icon icon="solar:document-bold-duotone"></iconify-icon>
                                <span class="icon-small"></span> Registration
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('members.index') }}" >
                                <iconify-icon icon="solar:user-bold-duotone"></iconify-icon>
                                <span class="icon-small"></span> Members
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('group.index') }}">
                                <iconify-icon icon="solar:users-group-rounded-bold-duotone"></iconify-icon>
                                <span class="icon-small"></span> Group
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('forums.index') }}">
                                <iconify-icon icon="solar:cloud-file-line-duotone"></iconify-icon>
                                <span class="icon-small"></span> Forums
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('socialwall.index') }}">
                                <iconify-icon icon="solar:wallpaper-bold-duotone"></iconify-icon>
                                <span class="icon-small"></span> Social Wall
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('broadcasts.index') }}">
                                <iconify-icon icon="solar:smart-speaker-bold-duotone"></iconify-icon>
                                <span class="icon-small"></span> Broadcasts
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('events.index') }}">
                                <iconify-icon icon="solar:revote-bold-duotone"></iconify-icon>
                                <span class="icon-small"></span> Events
                            </a>
                        </li>
                         <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.mentorship.index') }}">
                                <iconify-icon icon="solar:document-bold-duotone"></iconify-icon>
                                <span class="icon-small"></span> Mentorship Programme
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('grievance.list') }}">
                                <iconify-icon icon="solar:document-bold-duotone"></iconify-icon>
                                <span class="icon-small"></span> Grievance/Feedback
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <iconify-icon icon="solar:map-point-wave-bold-duotone"></iconify-icon>
                                <span class="hide-menu">Location</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="{{ route('admin.location.country') }}">
                                        <span class="icon-small"></span>Country
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="{{ route('admin.location.state') }}">
                                        <span class="icon-small"></span>State
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="{{ route('admin.location.city') }}">
                                        <span class="icon-small"></span>Cities
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.topics.index') }}">
                                <iconify-icon icon="solar:document-bold-duotone"></iconify-icon>
                                <span class="icon-small"></span> Recents Topics
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</aside>
<!-- Sidebar End -->