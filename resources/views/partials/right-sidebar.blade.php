 <div class="col-xxl-3 col-xl-4 col-lg-4 col-6 mt-5 mt-xl-0">
                   <div class="cus-overflow cus-scrollbar sidebar-head">
                       <div class="d-flex justify-content-end">
                           <div class="d-block d-xl-none me-4">
                               <button class="button toggler-btn mb-4 mb-lg-0 d-flex align-items-center gap-2">
                                   <span>My List</span>
                                   <i class="material-symbols-outlined mat-icon"> tune </i>
                               </button>
                           </div>
                       </div>
                       <div class="cus-scrollbar side-wrapper">
                           <div class="sidebar-wrapper d-flex flex-column gap-6">
                               
                               <div class="sidebar-area p-5">
                                   <div class="mb-4">
                                       <h6 class="d-inline-flex">
                                           Forums
                                       </h6>
                                   </div>
                                   @foreach($forums as $forum)
                                    <div class="d-flex flex-column gap-6 mb-4">
                                        <div class="profile-area d-center position-relative align-items-center justify-content-between">
                                            <div class="avatar-item d-flex gap-3 align-items-center">
                                                <div class="avatar-item">
                                                    <img class="avatar-img max-un" 
                                                        src="{{ asset('storage/uploads/images/' . $forum->images) }}" 
                                                        alt="Forum Image" 
                                                        style="width: 80px; height: 80px; object-fit: cover;">
                                                </div>
                                                <div class="info-area">
                                                    <h6 class="m-0">
                                                        <a href="#" class="mdtxt">{{ $forum->name }}</a>
                                                    </h6>
                                                    <small class="text-muted">Topic: {{ $forum->topic_name }}</small>
                                                        <small class="text-muted d-block">{{ \Carbon\Carbon::parse($forum->created_date)->format('d M, Y') }}</small>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="description-area ps-5">
                                            <p>{{ $forum->description }}</p>
                                        </div>
                                    </div>
                                    @endforeach

                               </div>
                              <div class="sidebar-area p-5">
                                    <div class="mb-4">
                                        <h6 class="d-inline-flex">
                                            Latest Events
                                        </h6>
                                    </div>
                                    <div class="d-flex flex-column gap-6">

                                        @foreach($events as $event)
                                            <div class="profile-area d-center position-relative align-items-center justify-content-between">
                                                <div class="avatar-item d-flex gap-3 align-items-center">
                                                    <div class="avatar-item">
                                                        <img class="avatar-img max-un"
                                                            src="{{ $event->image ? asset('storage/events/' . $event->image) : asset('feed_assets/images/avatar-7.png') }}"
                                                            alt="Event">
                                                    </div>
                                                    <div class="info-area">
                                                        <h6 class="m-0">
                                                            <a href="{{ $event->url ?? '#' }}" class="mdtxt" >
                                                                {{ \Illuminate\Support\Str::limit($event->title, 20) }}
                                                            </a>
                                                        </h6>
                                                        <small class="text-muted d-block">{{ \Carbon\Carbon::parse($event->end_datetime)->format('d M, Y') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                  
                                </div>

                           </div>
                       </div>
                   </div>
               </div>
