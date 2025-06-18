<div class="col-xxl-3 col-xl-3 col-lg-4 col-6 cus-z2">
                   <div class="d-inline-block d-lg-none">
                       <button class="button profile-active mb-4 mb-lg-0 d-flex align-items-center gap-2">
                           <i class="material-symbols-outlined mat-icon"> tune </i>
                           <span>My profile</span>
                       </button>
                   </div>
                   <div class="profile-sidebar cus-scrollbar p-5">
                       <div class="d-block d-lg-none position-absolute end-0 top-0">
                           <button class="button profile-close">
                               <i class="material-symbols-outlined mat-icon fs-xl"> close </i>
                           </button>
                       </div>
                       <div class="profile-pic d-flex gap-2 align-items-center">
                           <div class="avatar position-relative">
                               <img class="avatar-img max-un" src="{{asset('feed_assets/images/avatar-1.png')}}"
                                   alt="avatar">
                           </div>
                           <div class="text-area">
                                	@if(Auth::guard('user')->check())
								 <h6 class="m-0 mb-1"><a href="profile-post.html">{{ Auth::guard('user')->user()->name }}!</a></h6>
								@endif


						<p class="mdtxt">@ {{ trim(Auth::guard('user')->user()->name) }}</p>  {{-- @ is escaped --}}

                           </div>
                       </div>
                       <ul class="profile-link mt-7 mb-7 pb-7">
                           <li>
                               <a href="#" class="d-flex gap-4 active">
                                   <i class="material-symbols-outlined mat-icon"> home </i>
                                   <span>Home</span>
                               </a>
                           </li>
                           <li>
                               <a href="#" class="d-flex gap-4">
                                   <i class="material-symbols-outlined mat-icon"> person </i>
                                   <span>Profile</span>
                               </a>
                           </li>
                           <li>
                               <a href="#" class="d-flex gap-4">
                                   <i class="material-symbols-outlined mat-icon"> workspace_premium </i>
                                   <span>Event</span>
                               </a>
                           </li>
                           <li>
                               <a href="#" class="d-flex gap-4">
                                   <i class="material-symbols-outlined mat-icon"> workspaces </i>
                                   <span>Group</span>
                               </a>
                           </li>
                           <li>
                               <a href="#" class="d-flex gap-4">
                                   <i class="material-symbols-outlined mat-icon"> store </i>
                                   <span>Broadcasts</span>
                               </a>
                           </li>
                           <li>
                               <a href="saved-post.html" class="d-flex gap-4">
                                   <i class="material-symbols-outlined mat-icon"> sync_saved_locally </i>
                                   <span>Resources Library</span>
                               </a>
                           </li>
                       </ul>
                       <div class="your-shortcuts">
                           <h6>Broadcasts</h6>
                           <ul>
                               <li class="d-flex align-items-center gap-3">
                                   <a href="public-profile-post.html">
                                       <img src="{{asset('feed_assets/images/shortcuts-1.png')}}" alt="icon">

                                   </a>
                                   <div>
                                       <span>Circlehub (Admin)</span><br>
                                       <small>Game Community</small>
                                   </div>
                               </li>
                           </ul>
                       </div>
                   </div>
               </div>
