<header class="header-section header-menu">
        <nav class="navbar navbar-expand-lg p-0">
            <div class="container">
                <nav class="navbar w-100 navbar-expand-lg justify-content-between">
                    <a href="{{ url('user/feed') }}" class="navbar-brand">
                        <img src="{{ asset('admin_assets/images/logos/lbsnaa_logo.jpg') }}" class="logo" alt="logo" style="width:50px;">
                    </a>
               <div>
                    <span class="logo-text">Alumni</span><br>
                    <small class="logo-text">Lal Bahadur Shastri National Academy of Administration</small>
                </div>
                    <ul class="navbar-nav feed flex-row gap-xl-20 gap-lg-10 gap-sm-7 gap-1 py-4 py-lg-0 m-lg-auto ms-auto ms-aut align-self-center">
                        <li>
                            <a href="{{ url('user/feed') }}" class="nav-icon home active" title="Home"><i class="mat-icon fs-xxl material-symbols-outlined mat-icon">home</i></a>
                        </li>
                        <li>
                            <a href="#news-feed" class="nav-icon feed" title="Resource Library"><i class="mat-icon fs-xxl material-symbols-outlined mat-icon">feed</i></a>
                        </li>
                        <li>
                            <a href="group.html" class="nav-icon" title="Group"><i class="mat-icon fs-xxl material-symbols-outlined mat-icon">group</i></a>
                        </li>

                    </ul>


					<div class="right-area position-relative d-flex gap-3 gap-xxl-6 align-items-center">
                        <div class="single-item d-none d-lg-block messages-area">
                            <div class="messages-btn cmn-head">
                                <div class="icon-area d-center position-relative">
                                    <i class="material-symbols-outlined mat-icon">mail</i>
                                    <span class="abs-area position-absolute d-center mdtxt">4</span>
                                </div>
                            </div>
                            <div class="main-area p-5 messages-content">
                                <h5 class="mb-8">Messages</h5>
                                <div class="single-box p-0 mb-7">
                                    <a href="profile-chat.html" class="d-flex gap-2 align-items-center">
                                        <div class="avatar">
                                            <img class="avatar-img max-un" src="{{asset('feed_assets/images/avatar-7.png')}}" alt="avatar">
                                        </div>
                                        <div class="text-area">
                                            <div class="title-area position-relative d-inline-flex align-items-center">
                                                <h6 class="m-0 d-inline-flex">Piter Maio</h6>
                                                <span class="abs-area position-absolute d-center mdtxt">3</span>
                                            </div>
                                            <p class="mdtxt sms">Amet minim mollit non....</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="btn-area">
                                    <a href="profile-chat.html">See all inbox</a>
                                </div>
                            </div>
                        </div>
                        <div class="single-item d-none d-lg-block messages-area notification-area">
                            <div class="notification-btn cmn-head position-relative">
                                <div class="icon-area d-center position-relative">
                                    <i class="material-symbols-outlined mat-icon">notifications</i>
                                    <span class="abs-area position-absolute d-center mdtxt">3</span>
                                </div>
                            </div>
                            <div class="main-area p-5 notification-content">
                                <h5 class="mb-8">Notification</h5>
                                <div class="single-box p-0 mb-7">
                                    <a href="profile-notification.html" class="d-flex justify-content-between align-items-center">
                                        <div class="left-item position-relative d-inline-flex gap-3">
                                            <div class="avatar position-relative d-inline-flex">
                                                <img class="avatar-img max-un" src="{{asset('feed_assets/images/avatar-1.png')}}" alt="avatar">
                                                <img class="abs-item position-absolute max-un" src="{{asset('feed_assets/images/icon/speech-bubble.png')}}" alt="icon">
                                            </div>
                                            <div class="text-area">
                                                <h6 class="m-0 mb-1">Piter Maio</h6>
                                                <p class="mdtxt">Comment on your post</p>
                                            </div>
                                        </div>
                                        <div class="time-remaining">
                                            <p class="mdtxt">Just now</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="single-box p-0 mb-7">
                                    <a href="profile-notification.html" class="d-flex justify-content-between align-items-center">
                                        <div class="left-item position-relative d-inline-flex gap-3">
                                            <div class="avatar position-relative d-inline-flex">
                                                <img class="avatar-img max-un" src="{{asset('feed_assets/images/avatar-2.png')}}" alt="avatar">
                                                <img class="abs-item position-absolute max-un" src="{{asset('feed_assets/images/icon/emoji-love.png')}}" alt="icon">
                                            </div>
                                            <div class="text-area">
                                                <h6 class="m-0 mb-1">Kathryn Murphy</h6>
                                                <p class="mdtxt">Like your photo</p>
                                            </div>
                                        </div>
                                        <div class="time-remaining">
                                            <p class="mdtxt">2min</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="btn-area">
                                    <a href="profile-notification.html">See all notification</a>
                                </div>
                            </div>
                        </div>
                        <div class="single-item d-none d-lg-block profile-area position-relative">
                            <div class="profile-pic d-flex align-items-center">
                                <span class="avatar cmn-head active-status">
                                    <img class="avatar-img max-un" src="{{asset('feed_assets/images/avatar-1.png')}}" alt="avatar">
                                </span>
                            </div>
                            <div class="main-area p-5 profile-content">
                                <div class="head-area">
                                    <div class="d-flex gap-3 align-items-center">
                                        <div class="avatar-item">
                                            <img class="avatar-img max-un" src="{{asset('feed_assets/images/avatar-1.png')}}" alt="avatar">
                                        </div>
                                        <div class="text-area">
												@if(Auth::guard('user')->check())
												 <h6 class="m-0 mb-1">Welcome, {{ Auth::guard('user')->user()->name }}!</h6>
												@endif
                                            <p class="mdtxt">{{ Auth::guard('user')->user()->designation }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="view-profile my-2">
                                  @if(Auth::guard('user')->check())
                                    @php
                                        $user = Auth::guard('user')->user();
                                    @endphp
                                    <a href="{{ route('user.profile', ['id' => $user->id]) }}" class="mdtxt w-100 text-center py-2">View profile</a>
                                @endif

                                </div>
                                <ul>
                                    <li>
                                        <a href="{{ route('user.directory') }}" class="mdtxt">
                                            <i class="material-symbols-outlined mat-icon"> settings </i>
                                           Directory
                                        </a>
                                    </li>
                                    <li>
                                      <form action="{{ route('user.logout') }}" method="POST" style="display: inline;" >
										@csrf
										<button type="submit" class="mdtxt" style="background: none; border: none; cursor: pointer;" >
											<i class="material-symbols-outlined mat-icon">power_settings_new</i>
											Sign Out
										</button>
									</form>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </nav>
                <div class="switch-wrapper ms-4 mt-4 d-flex gap-1 align-items-center">
                                    <i class="mat-icon material-symbols-outlined sun icon"> light_mode </i>
                                    <label class="switch">
                                        <input type="checkbox" class="checkbox">
                                        <span class="slider"></span>
                                    </label>
                                    <i class="mat-icon material-symbols-outlined moon icon"> dark_mode </i>
                                    <span class="mdtxt ms-2" style="display:none;">Dark mode</span>
                   </div>
            </div>
        </nav>
    </header>
    <!-- header-section end -->
       <!-- Bottom Menu start -->
    <div class="header-menu py-3 header-menu d-block d-lg-none position-fixed bottom-0 w-100 cus-z">
        <div class="right-area position-relative d-flex justify-content-around gap-3 gap-xxl-6 align-items-center">
            <div class="single-item messages-area">
                <div class="messages-btn cmn-head">
                    <div class="icon-area d-center position-relative">
                        <i class="material-symbols-outlined mat-icon">mail</i>
                        <span class="abs-area position-absolute d-center mdtxt">4</span>
                    </div>
                </div>
                <div class="main-area p-5 messages-content">
                    <h5 class="mb-8">Messages</h5>
                    <div class="single-box p-0 mb-7">
                        <a href="profile-chat.html" class="d-flex gap-2 align-items-center">
                            <div class="avatar">
                                <img class="avatar-img max-un" src="{{asset('feed_assets/images/avatar-7.png')}}" alt="avatar">
                            </div>
                            <div class="text-area">
                                <div class="title-area position-relative d-inline-flex align-items-center">
                                    <h6 class="m-0 d-inline-flex">Piter Maio</h6>
                                    <span class="abs-area position-absolute d-center mdtxt">3</span>
                                </div>
                                <p class="mdtxt sms">Amet minim mollit non....</p>
                            </div>
                        </a>
                    </div>
                    <div  class="single-box p-0 mb-7">
                        <a href="profile-chat.html" class="d-flex gap-2 align-items-center">
                            <div class="avatar">
                                <img class="avatar-img max-un" src="{{asset('feed_assets/images/avatar-1.png')}}" alt="avatar">
                            </div>
                            <div class="text-area">
                                <h6 class="m-0 mb-1">Annette Black</h6>
                                <p class="mdtxt">You: consequat sunt</p>
                            </div>
                        </a>
                    </div>
                    <div  class="single-box p-0 mb-7">
                        <a href="profile-chat.html" class="d-flex gap-2 align-items-center">
                            <div class="avatar">
                                <img class="avatar-img max-un" src="{{asset('feed_assets/images/avatar-2.png')}}" alt="avatar">
                            </div>
                            <div class="text-area">
                                <h6 class="m-0 mb-1">Ralph Edwards</h6>
                                <p class="mdtxt sms">Amet minim mollit non....</p>
                            </div>
                        </a>
                    </div>
                    <div  class="single-box p-0 mb-7">
                        <a href="profile-chat.html" class="d-flex gap-2 align-items-center">
                            <div class="avatar">
                                <img class="avatar-img max-un" src="{{asset('feed_assets/images/avatar-3.png')}}" alt="avatar">
                            </div>
                            <div class="text-area">
                                <h6 class="m-0 mb-1">Darrell Steward</h6>
                                <p class="mdtxt">You: consequat sunt</p>
                            </div>
                        </a>
                    </div>
                    <div  class="single-box p-0 mb-7">
                        <a href="profile-chat.html" class="d-flex gap-2 align-items-center">
                            <div class="avatar">
                                <img class="avatar-img max-un" src="{{asset('feed_assets/images/avatar-4.png')}}" alt="avatar">
                            </div>
                            <div class="text-area">
                                <h6 class="m-0 mb-1">Wade Warren</h6>
                                <p class="mdtxt">You: consequat sunt</p>
                            </div>
                        </a>
                    </div>
                    <div  class="single-box p-0 mb-7">
                        <a href="profile-chat.html" class="d-flex gap-2 align-items-center">
                            <div class="avatar">
                                <img class="avatar-img max-un" src="{{asset('feed_assets/images/avatar-5.png')}}" alt="avatar">
                            </div>
                            <div class="text-area">
                                <h6 class="m-0 mb-1">Kathryn Murphy</h6>
                                <p class="mdtxt">You: consequat sunt</p>
                            </div>
                        </a>
                    </div>
                    <div class="single-box p-0 mb-7">
                        <a href="profile-chat.html" class="d-flex gap-2 align-items-center">
                            <div class="avatar">
                                <img class="avatar-img max-un" src="{{asset('feed_assets/images/avatar-6.png')}}" alt="avatar">
                            </div>
                            <div class="text-area">
                                <h6 class="m-0 mb-1">Jacob Jones</h6>
                                <p class="mdtxt">You: consequat sunt</p>
                            </div>
                        </a>
                    </div>
                    <div class="btn-area">
                        <a href="profile-chat.html">See all inbox</a>
                    </div>
                </div>
            </div>
            <div class="single-item messages-area notification-area">
                <div class="notification-btn cmn-head position-relative">
                    <div class="icon-area d-center position-relative">
                        <i class="material-symbols-outlined mat-icon">notifications</i>
                        <span class="abs-area position-absolute d-center mdtxt">3</span>
                    </div>
                </div>
                <div class="main-area p-5 notification-content">
                    <h5 class="mb-8">Notification</h5>
                    <div class="single-box p-0 mb-7">
                        <a href="profile-notification.html" class="d-flex justify-content-between align-items-center">
                            <div class="left-item position-relative d-inline-flex gap-3">
                                <div class="avatar position-relative d-inline-flex">
                                    <img class="avatar-img max-un" src="{{asset('feed_assets/images/avatar-1.png')}}" alt="avatar">
                                    <img class="abs-item position-absolute max-un" src="{{asset('feed_assets/images/icon/speech-bubble.png')}}" alt="icon">
                                </div>
                                <div class="text-area">
                                    <h6 class="m-0 mb-1">Piter Maio</h6>
                                    <p class="mdtxt">Comment on your post</p>
                                </div>
                            </div>
                            <div class="time-remaining">
                                <p class="mdtxt">Just now</p>
                            </div>
                        </a>
                    </div>
                    <div class="single-box p-0 mb-7">
                        <a href="profile-notification.html" class="d-flex justify-content-between align-items-center">
                            <div class="left-item position-relative d-inline-flex gap-3">
                                <div class="avatar position-relative d-inline-flex">
                                    <img class="avatar-img max-un" src="{{asset('feed_assets/images/avatar-2.png')}}" alt="avatar">
                                    <img class="abs-item position-absolute max-un" src="{{asset('feed_assets/images/icon/emoji-love.png')}}" alt="icon">
                                </div>
                                <div class="text-area">
                                    <h6 class="m-0 mb-1">Kathryn Murphy</h6>
                                    <p class="mdtxt">Like your photo</p>
                                </div>
                            </div>
                            <div class="time-remaining">
                                <p class="mdtxt">2min</p>
                            </div>
                        </a>
                    </div>
                    <div class="single-box p-0 mb-7">
                        <a href="profile-notification.html" class="d-flex justify-content-between align-items-center">
                            <div class="left-item position-relative d-inline-flex gap-3">
                                <div class="avatar position-relative d-inline-flex">
                                    <img class="avatar-img max-un" src="{{asset('feed_assets/images/avatar-3.png')}}" alt="avatar">
                                    <img class="abs-item position-absolute max-un" src="{{asset('feed_assets/images/icon/emoji-love.png')}}" alt="icon">
                                </div>
                                <div class="text-area">
                                    <h6 class="m-0 mb-1">Jacob Jones</h6>
                                    <p class="mdtxt">Sent you a request</p>
                                </div>
                            </div>
                            <div class="time-remaining">
                                <p class="mdtxt">1hr</p>
                            </div>
                        </a>
                        <div class="d-flex gap-3 mt-4">
                            <button class="cmn-btn">Accept</button>
                            <button class="cmn-btn alt">Delete</button>
                        </div>
                    </div>
                    <div class="btn-area">
                        <a href="profile-notification.html">See all notification</a>
                    </div>
                </div>
            </div>
            <div class="single-item profile-area position-relative">
                <div class="profile-pic d-flex align-items-center">
                    <span class="avatar cmn-head active-status">
                        <img class="avatar-img max-un" src="{{asset('feed_assets/images/avatar-1.png')}}" alt="avatar">
                    </span>
                </div>
                <div class="main-area p-5 profile-content">
                    <div class="head-area">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="avatar-item">
                                <img class="avatar-img max-un" src="{{asset('feed_assets/images/avatar-1.png')}}" alt="avatar">
                            </div>
                            <div class="text-area">
                                <h6 class="m-0 mb-1">Lori Ferguson</h6>
                                <p class="mdtxt">Web Developer</p>
                            </div>
                        </div>
                    </div>
                    <div class="view-profile my-2">
                        <a href="profile-post.html" class="mdtxt w-100 text-center py-2">View profile</a>
                    </div>
                    <ul>
                        <li>
                            <a href="profile-edit.html" class="mdtxt">
                                <i class="material-symbols-outlined mat-icon"> settings </i>
                                Settings & Privacy
                            </a>
                        </li>
                        <li>
                            <a href="#" class="mdtxt">
                                <i class="material-symbols-outlined mat-icon"> power_settings_new </i>
                                Sign Out
                            </a>
                        </li>
                    </ul>
                    <div class="switch-wrapper">
				  <i class="mat-icon material-symbols-outlined sun icon">light_mode</i>
				  <label class="switch">
					<input type="checkbox" class="checkbox">
					<span class="slider"></span>
				  </label>
				  <i class="mat-icon material-symbols-outlined moon icon">dark_mode</i>
				  <span class="mdtxt ms-2">Dark mode</span>
				</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bottom Menu end -->

<style>
.switch-wrapper {
  display: inline-flex;         /* horizontal layout */
  align-items: center;          /* vertical centering */
  gap: 0.5rem;                  /* space between items */
  font-size: 1rem;              /* base font size */
  user-select: none;            /* prevents text selection when toggling */
}

/* Make the sun & moon icons a consistent size */
.switch-wrapper .icon {
  font-size: 1.5rem;            /* adjust as needed */
  line-height: 1;
}

/* Tweak the switch dimensions */
.switch {
  position: relative;
  width: 2.5rem;                /* ~40px */
  height: 1.25rem;              /* ~20px */
  display: inline-block;
}
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}
.switch .slider {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: #ccc;
  border-radius: 1.25rem;
  transition: background-color .2s;
}
.switch .slider::before {
  content: "";
  position: absolute;
  height: 1rem;                /* ~16px */
  width: 1rem;
  left: 0.125rem;              /* ~2px */
  bottom: 0.125rem;
  background-color: white;
  border-radius: 50%;
  transition: transform .2s;
}
.switch input:checked + .slider {
  background-color: #666;
}
.switch input:checked + .slider::before {
  transform: translateX(1.25rem); /* width - knob size = 1.25rem */
}

/* Optional: spacing for the label text */
.switch-wrapper .mdtxt {
  font-size: 0.875rem;
  color: inherit;
}
</style>
