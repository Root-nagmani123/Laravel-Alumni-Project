        <div class="col-3">
              <div class="card">
                        <!-- Cover image -->
                        <div class="h-100px rounded-top"
                            style="background-image:url({{asset('user_assets/images/login/login-bg.jpg')}}); background-position: center; background-size: cover; background-repeat: no-repeat;">
                        </div>
                        <!-- Card body START -->
                        <div class="card-body pt-0" style="height:167px;">
                            <div class="text-center">
                                <!-- Avatar -->
                                <div class="avatar avatar-lg mt-n5 mb-3">
                                    @php
                                    $user = Auth::guard('user')->user();
                                    $profilePic = $user->profile_pic ?? null;
                                    @endphp
                                    <img id="existingImage"
                                        src="{{ $profilePic ? asset('storage/' . $profilePic) : asset('feed_assets/images/avatar/07.jpg') }}"
                                        class="rounded-circle avatar-img" height="30" width="30" alt="User"
                                        loading="lazy" decoding="async">
                                </div>
                                <!-- Info -->

                                
                                @if(Auth::guard('user')->check())
                                <h5 class="mb-0"> <a href="#!"> {{ Auth::guard('user')->user()->name }} </a> </h5>
                                @endif
                                <small>{{ Auth::guard('user')->user()->Service }} |{{ Auth::guard('user')->user()->current_designation }}</small>
                                <div class="hstack gap-2 gap-xl-3 justify-content-center mt-3">
											<!-- User stat item -->
											<div>
												<li class="list-inline-item"><i class="bi bi-briefcase me-1"></i>
                                        {{ $user->cader }}
											</div>
											<!-- Divider -->
											<div class="vr"></div>
											<!-- User stat item -->
											<div>
												<i class="bi bi-backpack me-1"></i>
                                        {{ $user->batch }}
											</div>
										</div>
                            </div>
                            <!-- Side Nav END -->
                        </div>
                        <!-- Card body END -->
                        <!-- Card footer -->
                        <div class="card-footer text-center py-2">
                           <a class="btn btn-link btn-sm" href="{{ route('user.profile.data', ['id' => Crypt::encrypt($user->id)]) }}">View
                                Profile </a>
                        </div>
                    </div>
        </div>