<!-- =======================
Header START -->
<header class="navbar-light fixed-top header-static bg-mode">

	<!-- Logo Nav START -->
	<nav class="navbar navbar-expand-lg">
		<div class="container">
			<!-- Logo START -->
			<a class="navbar-brand" href="{{ url('user/feed') }}" style="display: flex; gap: 0.2rem;">
				<img class="light-mode-item navbar-brand-item" src="{{ asset('admin_assets/images/logos/lbsnaa.svg') }}" alt="logo">
			</a>
			<!-- Logo END -->

			<!-- Responsive navbar toggler -->
			<button class="navbar-toggler ms-auto icon-md btn btn-light p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-animation">
					<span></span>
					<span></span>
					<span></span>
				</span>
			</button>

			<!-- Main navbar START -->
			<div class="collapse navbar-collapse" id="navbarCollapse">

				<!-- Nav Search START -->
				<div class="nav mt-3 mt-lg-0 flex-nowrap align-items-center px-4 px-lg-0">
					<div class="nav-item w-100">
						<form class="rounded position-relative" style="margin-top:6px;">
							<input class="form-control ps-5 bg-light" type="search" placeholder="Search..." aria-label="Search">
							<button class="btn bg-transparent px-2 py-0 position-absolute top-50 start-0 translate-middle-y" type="submit"><i class="bi bi-search fs-5"> </i></button>
						</form>
					</div>
				</div>
				<!-- Nav Search END -->

				<ul class="navbar-nav navbar-nav-scroll justify-content-center flex-grow-1 pe-3 flex-nowrap gap-4">

					<li class="nav-item d-flex gap-2 align-items-center active">
						<a class="nav-link bg-light icon-md btn btn-light p-0 active" href="{{ url('user/feed') }}">
						<i class="bi bi-house-door-fill"></i>
					</a>
					Feed
					</li>
                    <li class="nav-item d-flex gap-2 align-items-center">
						<a class="nav-link bg-light icon-md btn btn-light p-0" href="#">
						<i class="bi bi-file-earmark-text-fill"></i>
					</a>Library
					</li>
                    <li class="nav-item d-flex gap-2 align-items-center">
						<a class="nav-link bg-light icon-md btn btn-light p-0" href="#">
						<i class="bi bi-person-lines-fill"></i>
					</a>Groups
					</li>

				</ul>
			</div>
			<!-- Main navbar END -->

			<!-- Nav right START -->
			<ul class="nav flex-nowrap align-items-center ms-sm-3 list-unstyled">
				<!-- <li class="nav-item ms-2">
					<a class="nav-link bg-light icon-md btn btn-light p-0" href="#">
						<i class="bi bi-chat-left-text-fill fs-6"> </i>
					</a>
				</li>
				<li class="nav-item ms-2">
					<a class="nav-link bg-light icon-md btn btn-light p-0" href="settings.html">
						<i class="bi bi-gear-fill fs-6"> </i>
					</a>
				</li> -->
				<li class="nav-item dropdown ms-2">
					<a class="nav-link bg-light icon-md btn btn-light p-0" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
						<span class="badge-notif animation-blink"></span>
						<i class="bi bi-bell-fill fs-6"> </i>
					</a>
					<div class="dropdown-menu dropdown-animation dropdown-menu-end dropdown-menu-size-md p-0 shadow-lg border-0" aria-labelledby="notifDropdown">
						<div class="card">
							<div class="card-header d-flex justify-content-between align-items-center">
								<h6 class="m-0">Notifications <span class="badge bg-danger bg-opacity-10 text-danger ms-2">4 new</span></h6>
								<a class="small" href="#">Clear all</a>
							</div>
							<div class="card-body p-0">
								<ul class="list-group list-group-flush list-unstyled p-2">
									<!-- Notif item -->
									<li>
										<a href="#" class="list-group-item list-group-item-action rounded d-flex border-0 mb-1 p-3">
											<div class="avatar text-center d-none d-sm-inline-block">
												<div class="avatar-img rounded-circle bg-success"><span class="text-white position-absolute top-50 start-50 translate-middle fw-bold">WB</span></div>
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
					<a class="nav-link btn icon-md p-0" href="#" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
						<img class="avatar-img rounded-2" src="{{asset('feed_assets/images/avatar/07.jpg')}}" alt="">
					</a>
					<ul class="dropdown-menu dropdown-animation dropdown-menu-end pt-3 small me-md-n3" aria-labelledby="profileDropdown">
						<!-- Profile info -->
						<li class="px-3">
							<div class="d-flex align-items-center position-relative">
								<!-- Avatar -->
								<div class="avatar me-3">
									<img class="avatar-img rounded-circle" src="{{asset('feed_assets/images/avatar/07.jpg')}}" alt="avatar">
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
                                    <a href="{{ route('user.profile', ['id' => $user->id]) }}" class="dropdown-item btn btn-primary-soft btn-sm my-2 text-center">View profile</a>
                                @endif
						</li>
						<!-- Links -->
						<li><a class="dropdown-item" href="{{ route('user.directory') }}"><i class="bi bi-gear fa-fw me-2"></i>Directory</a></li>
						<!-- <li>
							<a class="dropdown-item" href="https://support.webestica.com/" target="_blank">
								<i class="fa-fw bi bi-life-preserver me-2"></i>Support
							</a>
						</li>
						<li>
							<a class="dropdown-item" href="docs/index.html" target="_blank">
								<i class="fa-fw bi bi-card-text me-2"></i>Documentation
							</a>
						</li> -->
						<li class="dropdown-divider"></li>
						<li>
                         <form action="{{ route('user.logout') }}" method="POST" style="display: inline;" >
										@csrf
										<button type="submit" class="bg-danger-soft-hover btn-sm btn d-flex align-items-center text-danger w-100">
											<i class="bi bi-power fa-fw me-2"></i>
											Sign Out
										</button>
									</form>
						<li> <hr class="dropdown-divider"></li>
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
