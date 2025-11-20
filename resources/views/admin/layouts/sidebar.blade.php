<!-- Sidebar Start -->
<aside class="side-mini-panel with-vertical">
    <div class="iconbar">
        <div>
            <!-- Mini Navigation -->
            <div class="mini-nav">
                <div class="brand-logo d-flex align-items-center justify-content-center">
                    <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
</svg>
                    </a>
                </div>
                <ul class="mini-nav-ul simplebar-scrollable-y" data-simplebar>
                    <li class="mini-nav-item" id="mini-1">
                        <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="right" title="General">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
  <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
</svg>
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
                            <a class="sidebar-link" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i>
                                <span class="icon-small"></span> Dashboard
                            </a>
                        </li>
                         <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.user_management.index') }}">
                                <iconify-icon icon="solar:user-id-bold-duotone"></iconify-icon>
                                <span class="icon-small"></span> Moderator List
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.registration.index') }}">
                                <iconify-icon icon="solar:document-bold-duotone"></iconify-icon>
                                <span class="icon-small"></span> Registration
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('members.index') }}">
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
                                <iconify-icon icon="solar:feed-bold-duotone"></iconify-icon>
                                <span class="icon-small"></span> Grievance/Feedback
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.feeds.index') }}">
                                <iconify-icon icon="solar:move-to-folder-bold-duotone"></iconify-icon>
                                <span class="icon-small"></span> Moderation
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
                            <a class="sidebar-link" href="{{ route('recent.topics.index') }}">
                                <iconify-icon icon="solar:document-bold-duotone"></iconify-icon>
                                <span class="icon-small"></span> Recent Activity
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('audit-logs.index') }}">
                                <iconify-icon icon="solar:shield-check-bold-duotone"></iconify-icon>
                                <span class="icon-small"></span> Audit Logs
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</aside>
<!-- Sidebar End -->