   @extends('layouts.app')

   @section('title', 'User Profile - Alumni | Lal Bahadur Shastri National Academy of Administration')

   @section('content')
   <div class="container">
       <div class="row g-4">

           <!-- Main content START -->
           <div class="col-lg-8 vstack gap-4">
               <!-- My profile START -->
               <div class="card">
                   <!-- Cover image -->
                   <div class="h-200px rounded-top"
                       style="background-image:url({{asset('feed_assets/images/bg/05.jpg')}}); background-position: center; background-size: cover; background-repeat: no-repeat;">
                   </div>
                   <!-- Card body START -->
                   <div class="card-body py-0">
                       <div class="d-sm-flex align-items-start text-center text-sm-start">
                           <div>
                               <!-- Avatar -->
                               <div class="avatar avatar-xxl mt-n5 mb-3">
                                   <img class="avatar-img rounded-circle border border-white border-3"
                                       src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('feed_assets/images/avatar-1.png') }}"
                                       alt="">
                               </div>
                           </div>
                           <div class="ms-sm-4 mt-sm-3">
                               <!-- Info -->
                               @if(Auth::guard('user')->check())
                               <h1 class="mb-0 h5">{{-- Auth::guard('user')->user()->name --}}
                                   {{ $user->name }} <i class="bi bi-patch-check-fill text-success small"></i></h1>
                               @endif
                               <p>250 Connections</p>
                           </div>
                           <!-- Button -->
                           <div class="d-flex mt-3 justify-content-center ms-sm-auto">
                               <button class="btn btn-danger-soft me-2" type="button" data-bs-toggle="modal"
                                   data-bs-target="#editProfileModal">
                                   <i class="bi bi-pencil-fill pe-1"></i> Edit profile
                               </button>
                           </div>
                           <div class="modal fade" id="editProfileModal" tabindex="-1"
                               aria-labelledby="editProfileModalLabel" aria-hidden="true">
                               <div class="modal-dialog modal-dialog-centered">
                                   @if(auth()->check())
                                   <form method="POST" action="{{ route('user.profile.update', auth()->user()->id) }}">
                                       @csrf
                                       @method('PUT')
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                                               <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                   aria-label="Close"></button>
                                           </div>
                                           <div class="modal-body">
                                               <!-- Example Profile Fields -->
                                               <div class="mb-3">
                                                   <label for="name" class="form-label">Full Name</label>
                                                   <input type="text" name="name" class="form-control"
                                                       value="{{ auth()->user()->name }}" required>
                                               </div>
                                               <div class="mb-3">
                                                   <label for="email" class="form-label">Email address</label>
                                                   <input type="email" name="email" class="form-control"
                                                       value="{{ auth()->user()->email }}" required>
                                               </div>
                                               <!-- Add more fields as needed -->
                                           </div>
                                           <div class="modal-footer">
                                               <button type="submit" class="btn btn-primary">Save changes</button>
                                           </div>
                                       </div>
                                   </form>
                                   @endif
                               </div>
                           </div>

                       </div>
                       <!-- List profile -->
                       <ul class="list-inline mb-0 text-center text-sm-start mt-3 mt-sm-0">
                           <li class="list-inline-item"><i class="bi bi-briefcase me-1"></i> {{ $user->designation }}
                           </li>
                           <li class="list-inline-item"><i class="bi bi-backpack me-1"></i> {{ $user->batch }}</li>
                           <li class="list-inline-item"><i class="bi bi-calendar2-plus me-1"></i>
                               {{ $user->created_at->format('F j, Y') }}</li>
                           </li>
                       </ul>
                   </div>
                   <!-- Card body END -->
                   <div class="card-footer mt-3 pt-2 pb-0">
                       <!-- Nav profile pages -->
                       <ul class="nav nav-tabs justify-content-center justify-content-md-start" id="profileTab"
                           role="tablist">
                           <li class="nav-item" role="presentation">
                               <a class="nav-link active" id="posts-tab" data-bs-toggle="tab" href="#posts" role="tab"
                                   aria-controls="posts" aria-selected="true">
                                   Posts
                               </a>
                           </li>
                           <li class="nav-item" role="presentation">
                               <a class="nav-link" id="about-tab" data-bs-toggle="tab" href="#about" role="tab"
                                   aria-controls="about" aria-selected="false">
                                   About
                               </a>
                           </li>
                           <li class="nav-item" role="presentation">
                               <a class="nav-link" id="groups-tab" data-bs-toggle="tab" href="#groups" role="tab"
                                   aria-controls="groups" aria-selected="false">
                                   Groups
                               </a>
                           </li>
                           <li class="nav-item" role="presentation">
                               <a class="nav-link" id="groups-tab" data-bs-toggle="tab" href="#media" role="tab"
                                   aria-controls="media" aria-selected="false">
                                   Media
                               </a>
                           </li>
                           <li class="nav-item" role="presentation">
                               <a class="nav-link" id="groups-tab" data-bs-toggle="tab" href="#videos" role="tab"
                                   aria-controls="videos" aria-selected="false">
                                   Videos
                               </a>
                           </li>
                       </ul>

                   </div>
               </div>
               <!-- My profile END -->
               <div class="tab-content" id="profileTabContent" style="padding: 0px !important;">
                   <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                       <p>
                           <!-- Share feed START -->
                       <div class="card card-body">
                           <div class="d-flex mb-3">
                               <!-- Avatar -->
                               <div class="avatar avatar-xs me-2">
                                   <a href="#"> <img class="avatar-img rounded-circle"
                                           src="{{asset('feed_assets/images/avatar/07.jpg')}}" alt="">
                                   </a>
                               </div>
                               <!-- Post input -->
                               <form class="w-100">
                                   <input class="form-control pe-4 border-0" placeholder="Share your thoughts..."
                                       data-bs-toggle="modal" data-bs-target="#modalCreateFeed">
                               </form>
                           </div>
                           <!-- Share feed toolbar START -->
                           <ul class="nav nav-pills nav-stack small fw-normal">
                               <li class="nav-item">
                                   <a class="nav-link bg-light py-1 px-2 mb-0" href="#!" data-bs-toggle="modal"
                                       data-bs-target="#feedActionPhoto"> <i
                                           class="bi bi-image-fill text-success pe-2"></i>Photo</a>
                               </li>
                               <li class="nav-item">
                                   <a class="nav-link bg-light py-1 px-2 mb-0" href="#!" data-bs-toggle="modal"
                                       data-bs-target="#feedActionVideo"> <i
                                           class="bi bi-camera-reels-fill text-info pe-2"></i>Video</a>
                               </li>
                               <li class="nav-item">
                                   <a href="#" class="nav-link bg-light py-1 px-2 mb-0" data-bs-toggle="modal"
                                       data-bs-target="#modalCreateEvents"> <i
                                           class="bi bi-calendar2-event-fill text-danger pe-2"></i>Event </a>
                               </li>
                           </ul>
                           <!-- Share feed toolbar END -->
                       </div>
                       <!-- Share feed END -->

                       <!-- Card feed item START -->
                       @foreach($posts as $post)
                       <div class="card">
                           <!-- Card header START -->
                           <div class="card-header border-0 pb-0">
                               <div class="d-flex align-items-center justify-content-between">
                                   <div class="d-flex align-items-center">
                                       <!-- Avatar -->
                                       @php
                                       $member = $post->member;
                                       $profileImage = $member && $member->profile_image
                                       ? asset('storage/' . $member->profile_image)
                                       : asset('feed_assets/images/avatar/07.jpg');
                                       @endphp
                                       <div class="avatar avatar-story me-2">
                                           <a href="#!"> <img class="avatar-img rounded-circle"
                                                   src="{{ $profileImage }}" alt=""> </a>
                                       </div>
                                       <!-- Info -->
                                       <div>
                                           <div class="nav nav-divider">
                                               <h6 class="nav-item card-title mb-0"> <a
                                                       href="{{ url('/user/profile/' . $member->id) }}">
                                                       {{ $member->name ?? 'Unknown' }} </a></h6>
                                               <span class="nav-item small">
                                                   {{ $post->created_at->diffForHumans() }}</span>
                                           </div>
                                           <p class="mb-0 small">{{ $member->designation ?? 'Unknown' }}</p>
                                       </div>
                                   </div>

                               </div>
                           </div>
                           <!-- Card header END -->
                           <!-- Card body START -->
                           <div class="card-body">
                               <p>{{ $post->content }}</p>
                               <!-- Card img -->
                               @php
                               $validMedia = $post->media->filter(function($media) {
                               return file_exists(storage_path('app/public/' . $media->file_path));
                               });

                               $imageMedia = $validMedia->where('file_type', 'image')->values();
                               $totalImages = $imageMedia->count();
                               @endphp

                               @if($totalImages === 1)
                               <div class="post-img mt-2">
                                   <a href="{{ asset('storage/' . $imageMedia[0]->file_path) }}" class="glightbox"
                                       data-gallery="post-gallery-{{ $post->id }}">
                                       <img src="{{ asset('storage/' . $imageMedia[0]->file_path) }}" loading="lazy"
                                           class="w-100" alt="Post Image">
                                   </a>
                               </div>
                               @elseif($totalImages > 1)
                               <div class="post-img d-flex justify-content-between flex-wrap gap-2 gap-lg-3 mt-2">
                                   @foreach($imageMedia->take(4) as $index => $media)
                                   <div class="position-relative" style="width: 48%;">
                                       <a href="{{ asset('storage/' . $media->file_path) }}" class="glightbox"
                                           data-gallery="post-gallery-{{ $post->id }}">
                                           <img src="{{ asset('storage/' . $media->file_path) }}" alt="Post Image"
                                               loading="lazy" class="w-100">
                                       </a>
                                       @if($index === 3 && $totalImages > 4)
                                       {{-- Hidden extra images --}}
                                       @foreach($imageMedia->slice(4) as $extra)
                                       <a href="{{ asset('storage/' . $extra->file_path) }}" class="glightbox d-none"
                                           data-gallery="post-gallery-{{ $post->id }}"></a>
                                       @endforeach

                                       {{-- Overlay link to trigger the rest of the images --}}
                                       <a href="{{ asset('storage/' . $imageMedia[4]->file_path) }}"
                                           class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white glightbox"
                                           style="background-color: rgba(0,0,0,0.6); font-size: 2rem; cursor: pointer;"
                                           data-gallery="post-gallery-{{ $post->id }}">
                                           +{{ $totalImages - 4 }}
                                       </a>
                                       @endif
                                   </div>

                                   @endforeach
                               </div>
                               @endif
                               <ul class="nav nav-stack py-3 small">
                                   @php
                                   $likeUserList = $post->likes->pluck('member.name')->filter();
                                   $likeUsersTooltip = $likeUserList->implode('<br>');
                                   $hasLiked = $post->likes->contains('member_id', auth('user')->id());
                                   @endphp

                                   <li class="nav-item">
                                       <a href="javascript:void(0);"
                                           class="nav-link like-button {{ $hasLiked ? 'active text-primary' : '' }}"
                                           data-post-id="{{ $post->id }}" data-bs-toggle="tooltip" data-bs-html="true"
                                           data-bs-placement="top" data-bs-custom-class="tooltip-text-start"
                                           data-bs-title="{{ $likeUsersTooltip ?: 'No likes yet' }}"
                                           data-bs-container="body">

                                           <i class="bi bi-hand-thumbs-up-fill pe-1"></i>
                                           <span class="like-label">Liked</span>
                                           (<span class="like-count">{{ $post->likes->count() }}</span>)
                                       </a>
                                   </li>



                                   <li class="nav-item">
                                       <a class="nav-link" href="#!"> <i class="bi bi-chat-fill pe-1"></i>Comments
                                           ({{ $post->comments?->count() ?? 0 }})</a>
                                   </li>
                                   <!-- Card share action START -->
                                   <li class="nav-item dropdown ms-sm-auto">
                                       <a class="nav-link mb-0" href="#" id="cardShareAction" data-bs-toggle="dropdown"
                                           aria-expanded="false">
                                           <i class="bi bi-reply-fill flip-horizontal ps-1"></i> Share
                                           ({{ $post->shares ?? 0 }})
                                       </a>
                                       <!-- Card share action dropdown menu -->
                                       <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardShareAction">
                                           <li><a class="dropdown-item" href="#"> <i
                                                       class="bi bi-envelope fa-fw pe-2"></i>Send
                                                   via Direct
                                                   Message</a></li>
                                           <li><a class="dropdown-item" href="#"> <i
                                                       class="bi bi-bookmark-check fa-fw pe-2"></i>Bookmark
                                               </a></li>
                                           <li><a class="dropdown-item" href="#"> <i
                                                       class="bi bi-link fa-fw pe-2"></i>Copy link
                                                   to
                                                   post</a></li>
                                           <li><a class="dropdown-item" href="#"> <i
                                                       class="bi bi-share fa-fw pe-2"></i>Share
                                                   post via
                                                   …</a></li>
                                           <li>
                                               <hr class="dropdown-divider">
                                           </li>
                                           <li><a class="dropdown-item" href="#"> <i
                                                       class="bi bi-pencil-square fa-fw pe-2"></i>Share to
                                                   News Feed</a></li>
                                       </ul>
                                   </li>
                                   <!-- Card share action END -->
                               </ul>
                               <div class="d-flex mb-3">
                                   <!-- Avatar -->
                                   <div class="avatar avatar-xs me-2">
                                       <a href="#!"> <img class="avatar-img rounded-circle"
                                               src="{{asset('feed_assets/images/avatar/12.jpg')}}" alt=""> </a>
                                   </div>
                                   <!-- Comment box  -->
                                   <form class="nav nav-item w-100 position-relative" id="commentForm-{{ $post->id }}"
                                       action="{{ route('user.comments.store') }}" method="POST"
                                       data-post-id="{{ $post->id }}">
                                       @csrf
                                       <textarea name="comment" data-autoresize class="form-control pe-5 bg-light"
                                           rows="1" placeholder="Add a comment..."
                                           id="comments-{{ $post->id }}"></textarea>
                                       <input type="hidden" name="post_id" value="{{ $post->id }}">
                                       <button
                                           class="nav-link bg-transparent px-3 position-absolute top-50 end-0 translate-middle-y border-0"
                                           type="submit">
                                           <i class="bi bi-send-fill"></i>
                                       </button>
                                   </form>

                               </div>
                               <ul class="comment-wrap list-unstyled">
                                   <!-- Comment item START -->
                                   @foreach ($post->comments as $comment)
                                   <li class="comment-item mb-3">
                                       <div class="d-flex position-relative">
                                           <!-- Avatar -->
                                           <div class="avatar avatar-xs">
                                               <a href="#!"><img class="avatar-img rounded-circle"
                                                       src="{{ $comment->member && $comment->member->profile_pic ? asset('storage/' . $comment->member->profile_pic) : asset('feed_assets/images/avatar/12.jpg') }}"
                                                       alt=""></a>
                                           </div>
                                           <div class="ms-2 w-100">
                                               <!-- Comment by -->
                                               <div class="bg-light rounded-start-top-0 p-3 rounded">
                                                   <div class="d-flex justify-content-between">
                                                       <h6 class="mb-1"> <a href="#!">
                                                               {{ $comment->member->name ?? 'Anonymous' }} </a>
                                                       </h6>
                                                       <small
                                                           class="ms-2">{{ $comment->created_at->diffForHumans() }}</small>
                                                   </div>
                                                   <p class="small mb-0" id="comment-text-{{ $comment->id }}">
                                                       {{ $comment->comment }}</p>
                                               </div>
                                               @if(auth()->guard('user')->id() === $comment->member_id)
                                               <button class="btn btn-sm btn-link p-0 text-primary edit-comment-btn"
                                                   data-comment-id="{{ $comment->id }}"
                                                   data-comment="{{ $comment->comment }}" type="button">Edit</button>
                                               @endif
                                               @if(auth()->guard('user')->id() === $comment->member_id)
                                               <button class="btn btn-sm btn-link p-0 text-danger delete-comment-btn"
                                                   data-comment-id="{{ $comment->id }}" type="button">Delete</button>
                                               @endif
                                           </div>
                                       </div>
                                       <!-- Comment item nested END -->
                                   </li>
                                   @endforeach
                                   <!-- Comment item END -->
                               </ul>
                               <!-- Card body END -->
                               <!-- Card footer START -->
                               <div class="card-footer border-0 pt-0">
                                   <!-- Load more comments -->
                                   <a href="#!" role="button"
                                       class="btn btn-link btn-link-loader btn-sm text-secondary d-flex align-items-center"
                                       data-bs-toggle="button" aria-pressed="true">
                                       <div class="spinner-dots me-2">
                                           <span class="spinner-dot"></span>
                                           <span class="spinner-dot"></span>
                                           <span class="spinner-dot"></span>
                                       </div>
                                       Load more comments
                                   </a>
                               </div>
                               <!-- Card footer END -->
                           </div>
                           <!-- Card feed item END -->

                       </div>
                       @endforeach</p>
                   </div>
                   <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                       <div class="card">
                           <!-- Card header START -->
                           <div class="card-header border-0 pb-0">
                               <h5 class="card-title"> Profile Info</h5>
                           </div>
                           <!-- Card header END -->
                           <!-- Card body START -->
                           <div class="card-body">
                               <div class="rounded border px-3 py-2 mb-3">
                                   <div class="d-flex align-items-center justify-content-between">
                                       <h6>Overview</h6>
                                       <div class="dropdown ms-auto">
                                           <!-- Card share action menu -->
                                           <a class="nav nav-link text-secondary mb-0" href="#" id="aboutAction"
                                               data-bs-toggle="dropdown" aria-expanded="false">
                                               <i class="bi bi-three-dots"></i>
                                           </a>
                                           <!-- Card share action dropdown menu -->
                                           <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="aboutAction">
                                               <li><a class="dropdown-item" href="#"> <i
                                                           class="bi bi-pencil-square fa-fw pe-2"></i>Edit</a></li>
                                               <li><a class="dropdown-item" href="#"> <i
                                                           class="bi bi-trash fa-fw pe-2"></i>Delete</a></li>
                                           </ul>
                                       </div>
                                   </div>
                                   <p>{{$user->bio}}</p>
                               </div>
                               <div class="row g-4">
                                   <div class="col-sm-6">
                                       <!-- Birthday START -->
                                       <div class="d-flex align-items-center rounded border px-3 py-2">
                                           <!-- Date -->
                                           <p class="mb-0">
                                               <i class="bi bi-calendar-date fa-fw me-2"></i> Born: <strong>
                                                   {{ $user->date_of_birth }} </strong>
                                           </p>
                                           <div class="dropdown ms-auto">
                                               <!-- Card share action menu -->
                                               <a class="nav nav-link text-secondary mb-0" href="#" id="aboutAction2"
                                                   data-bs-toggle="dropdown" aria-expanded="false">
                                                   <i class="bi bi-three-dots"></i>
                                               </a>
                                               <!-- Card share action dropdown menu -->
                                               <ul class="dropdown-menu dropdown-menu-end"
                                                   aria-labelledby="aboutAction2">
                                                   <li><a class="dropdown-item" href="#"> <i
                                                               class="bi bi-pencil-square fa-fw pe-2"></i>Edit</a></li>
                                                   <li><a class="dropdown-item" href="#"> <i
                                                               class="bi bi-trash fa-fw pe-2"></i>Delete</a></li>
                                               </ul>
                                           </div>
                                       </div>
                                       <!-- Birthday END -->
                                   </div>
                                   <div class="col-sm-6">
                                       <!-- Status START -->
                                       <div class="d-flex align-items-center rounded border px-3 py-2">
                                           <!-- Date -->
                                           <p class="mb-0">
                                               <i class="bi bi-heart fa-fw me-2"></i> Status: <strong>
                                                   {{ $user->marital_status }} </strong>
                                           </p>
                                           <div class="dropdown ms-auto">
                                               <!-- Card share action menu -->
                                               <a class="nav nav-link text-secondary mb-0" href="#" id="aboutAction3"
                                                   data-bs-toggle="dropdown" aria-expanded="false">
                                                   <i class="bi bi-three-dots"></i>
                                               </a>
                                               <!-- Card share action dropdown menu -->
                                               <ul class="dropdown-menu dropdown-menu-end"
                                                   aria-labelledby="aboutAction3">
                                                   <li><a class="dropdown-item" href="#"> <i
                                                               class="bi bi-pencil-square fa-fw pe-2"></i>Edit</a></li>
                                                   <li><a class="dropdown-item" href="#"> <i
                                                               class="bi bi-trash fa-fw pe-2"></i>Delete</a></li>
                                               </ul>
                                           </div>
                                       </div>
                                       <!-- Status END -->
                                   </div>
                                   <div class="col-sm-6">
                                       <!-- Designation START -->
                                       <div class="d-flex align-items-center rounded border px-3 py-2">
                                           <!-- Date -->
                                           <p class="mb-0">
                                               <i class="bi bi-briefcase fa-fw me-2"></i> <strong>
                                                   {{ $user->designation }}
                                               </strong>
                                           </p>
                                           <div class="dropdown ms-auto">
                                               <!-- Card share action menu -->
                                               <a class="nav nav-link text-secondary mb-0" href="#" id="aboutAction4"
                                                   data-bs-toggle="dropdown" aria-expanded="false">
                                                   <i class="bi bi-three-dots"></i>
                                               </a>
                                               <!-- Card share action dropdown menu -->
                                               <ul class="dropdown-menu dropdown-menu-end"
                                                   aria-labelledby="aboutAction4">
                                                   <li><a class="dropdown-item" href="#"> <i
                                                               class="bi bi-pencil-square fa-fw pe-2"></i>Edit</a></li>
                                                   <li><a class="dropdown-item" href="#"> <i
                                                               class="bi bi-trash fa-fw pe-2"></i>Delete</a></li>
                                               </ul>
                                           </div>
                                       </div>
                                       <!-- Designation END -->
                                   </div>
                                   <div class="col-sm-6">
                                       <!-- Lives START -->
                                       <div class="d-flex align-items-center rounded border px-3 py-2">
                                           <!-- Date -->
                                           <p class="mb-0">
                                               <i class="bi bi-geo-alt fa-fw me-2"></i> Lives in: <strong>
                                                   {{ $user->current_location }}
                                               </strong>
                                           </p>
                                           <div class="dropdown ms-auto">
                                               <!-- Card share action menu -->
                                               <a class="nav nav-link text-secondary mb-0" href="#" id="aboutAction5"
                                                   data-bs-toggle="dropdown" aria-expanded="false">
                                                   <i class="bi bi-three-dots"></i>
                                               </a>
                                               <!-- Card share action dropdown menu -->
                                               <ul class="dropdown-menu dropdown-menu-end"
                                                   aria-labelledby="aboutAction5">
                                                   <li><a class="dropdown-item" href="#"> <i
                                                               class="bi bi-pencil-square fa-fw pe-2"></i>Edit</a></li>
                                                   <li><a class="dropdown-item" href="#"> <i
                                                               class="bi bi-trash fa-fw pe-2"></i>Delete</a></li>
                                               </ul>
                                           </div>
                                       </div>
                                       <!-- Lives END -->
                                   </div>
                                   <div class="col-sm-6">
                                       <!-- Joined on START -->
                                       <div class="d-flex align-items-center rounded border px-3 py-2">
                                           <!-- Date -->
                                           <p class="mb-0">
                                               <i class="bi bi-geo-alt fa-fw me-2"></i> Joined on: <strong>
                                                   {{$user->created_at->format('F j, Y')}}
                                               </strong>
                                           </p>
                                           <div class="dropdown ms-auto">
                                               <!-- Card share action menu -->
                                               <a class="nav nav-link text-secondary mb-0" href="#" id="aboutAction6"
                                                   data-bs-toggle="dropdown" aria-expanded="false">
                                                   <i class="bi bi-three-dots"></i>
                                               </a>
                                               <!-- Card share action dropdown menu -->
                                               <ul class="dropdown-menu dropdown-menu-end"
                                                   aria-labelledby="aboutAction6">
                                                   <li><a class="dropdown-item" href="#"> <i
                                                               class="bi bi-pencil-square fa-fw pe-2"></i>Edit</a></li>
                                                   <li><a class="dropdown-item" href="#"> <i
                                                               class="bi bi-trash fa-fw pe-2"></i>Delete</a></li>
                                               </ul>
                                           </div>
                                       </div>
                                       <!-- Joined on END -->
                                   </div>
                                   <div class="col-sm-6">
                                       <!-- Joined on START -->
                                       <div class="d-flex align-items-center rounded border px-3 py-2">
                                           <!-- Date -->
                                           <p class="mb-0">
                                               <i class="bi bi-envelope fa-fw me-2"></i> Email: <strong>
                                                   {{ $user->email }} </strong>
                                           </p>
                                           <div class="dropdown ms-auto">
                                               <!-- Card share action menu -->
                                               <a class="nav nav-link text-secondary mb-0" href="#" id="aboutAction7"
                                                   data-bs-toggle="dropdown" aria-expanded="false">
                                                   <i class="bi bi-three-dots"></i>
                                               </a>
                                               <!-- Card share action dropdown menu -->
                                               <ul class="dropdown-menu dropdown-menu-end"
                                                   aria-labelledby="aboutAction7">
                                                   <li><a class="dropdown-item" href="#"> <i
                                                               class="bi bi-pencil-square fa-fw pe-2"></i>Edit</a></li>
                                                   <li><a class="dropdown-item" href="#"> <i
                                                               class="bi bi-trash fa-fw pe-2"></i>Delete</a></li>
                                               </ul>
                                           </div>
                                       </div>
                                       <!-- Joined on END -->
                                   </div>
                                   <div class="col-sm-6 position-relative">
                                       <!-- Workplace on START -->
                                       <a class="btn btn-dashed rounded w-100" href="#!"> <i
                                               class="bi bi-plus-circle-dotted me-1"></i>Add a workplace</a>
                                       <!-- Workplace on END -->
                                   </div>
                                   <div class="col-sm-6 position-relative">
                                       <!-- Education on START -->
                                       <a class="btn btn-dashed rounded w-100" href="#!"> <i
                                               class="bi bi-plus-circle-dotted me-1"></i>Add a education</a>
                                       <!-- Education on END -->
                                   </div>
                               </div>
                           </div>
                           <!-- Card body END -->
                       </div>
                   </div>
                   <div class="tab-pane fade" id="groups" role="tabpanel" aria-labelledby="groups-tab">
                       <p>Your Groups content here.</p>
                   </div>
                   <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
                       <div class="card">
                           <!-- Card header START -->
                           <div class="card-header d-sm-flex align-items-center justify-content-between border-0 pb-0">
                               <h5 class="card-title">Photos</h5>
                               <!-- Button modal -->
                               <a class="btn btn-sm btn-primary-soft" href="#" data-bs-toggle="modal"
                                   data-bs-target="#modalCreateAlbum"> <i class="fa-solid fa-plus pe-1"></i> Create
                                   album</a>
                           </div>
                           <!-- Card header END -->
                           <!-- Card body START -->
                           <div class="card-body">
                               <!-- Photos of you tab START -->
                               <div class="row g-3">

                                   <!-- Add photo START -->
                                   <div class="col-sm-6 col-md-4 col-lg-3">
                                       <div
                                           class="border border-2 py-5 border-dashed h-100 rounded text-center d-flex align-items-center justify-content-center position-relative">
                                           <a class="stretched-link" href="#!">
                                               <i class="fa-solid fa-camera-retro fs-1"></i>
                                               <h6 class="mt-2">Add photo</h6>
                                           </a>
                                       </div>
                                   </div>
                                   <!-- Add photo END -->

                                   <!-- Photo item START -->
                                   @if(!empty($post) && !empty($post->media))
                                   @foreach($post->media as $media)
                                   @if($media->file_type === 'image')
                                   @php
                                   $max_length = 50;
                                   $relativePath = 'storage/' . str_replace(['app/public/', 'public/'], '',
                                   $media->file_path);

                                   // Check existence of file in public path
                                   $file_path = public_path($relativePath);
                                   $image_url = file_exists($file_path) ? asset($relativePath) :
                                   asset('feed_assets/images/avatar-1.png');
                                   @endphp
                                   <div class="col-sm-6 col-md-4 col-lg-3">
                                       <!-- Photo -->
                                       <a href="{{ $image_url }}" data-gallery="image-popup"
                                           data-glightbox="description: .custom-desc2; descPosition: left;">
                                           <img class="rounded img-fluid" src="{{ $image_url }}" alt="">
                                       </a>
                                       <!-- likes -->
                                       <ul class="nav nav-stack py-2 small">
                                           <li class="nav-item">
                                               <a class="nav-link" href="#!"> <i
                                                       class="bi bi-heart-fill text-danger pe-1"></i>22k </a>
                                           </li>
                                           <li class="nav-item">
                                               <a class="nav-link" href="#!"> <i
                                                       class="bi bi-chat-left-text-fill pe-1"></i>3k </a>
                                           </li>
                                       </ul>
                                       <!-- glightbox Albums left bar START -->
                                       <div class="glightbox-desc custom-desc2">
                                           <div class="d-flex align-items-center justify-content-between">
                                               <div class="d-flex align-items-center">
                                                   <!-- Avatar -->
                                                   <div class="avatar me-2">
                                                       <img class="avatar-img rounded-circle"
                                                           src="assets/images/avatar/04.jpg" alt="">
                                                   </div>
                                                   <!-- Info -->
                                                   <div>
                                                       <div class="nav nav-divider">
                                                           <h6 class="nav-item card-title mb-0">Lori Ferguson</h6>
                                                           <span class="nav-item small"> 2hr</span>
                                                       </div>
                                                       <p class="mb-0 small">Web Developer at Webestica</p>
                                                   </div>
                                               </div>
                                               <!-- Card feed action dropdown START -->
                                               <div class="dropdown">
                                                   <a href="#"
                                                       class="text-secondary btn btn-secondary-soft-hover py-1 px-2"
                                                       id="cardFeedAction" data-bs-toggle="dropdown"
                                                       aria-expanded="false">
                                                       <i class="bi bi-three-dots"></i>
                                                   </a>
                                                   <!-- Card feed action dropdown menu -->
                                                   <ul class="dropdown-menu dropdown-menu-end"
                                                       aria-labelledby="cardFeedAction">
                                                       <li><a class="dropdown-item" href="#"> <i
                                                                   class="bi bi-bookmark fa-fw pe-2"></i>Save post</a>
                                                       </li>
                                                       <li><a class="dropdown-item" href="#"> <i
                                                                   class="bi bi-person-x fa-fw pe-2"></i>Unfollow lori
                                                               ferguson </a></li>
                                                       <li><a class="dropdown-item" href="#"> <i
                                                                   class="bi bi-x-circle fa-fw pe-2"></i>Hide post</a>
                                                       </li>
                                                       <li><a class="dropdown-item" href="#"> <i
                                                                   class="bi bi-slash-circle fa-fw pe-2"></i>Block</a>
                                                       </li>
                                                       <li>
                                                           <hr class="dropdown-divider">
                                                       </li>
                                                       <li><a class="dropdown-item" href="#"> <i
                                                                   class="bi bi-flag fa-fw pe-2"></i>Report post</a>
                                                       </li>
                                                   </ul>
                                               </div>
                                               <!-- Card feed action dropdown END -->
                                           </div>
                                           <p class="mt-3 mb-0">I'm so privileged to be involved in the @bootstrap
                                               hiring process! <a href="#">#internship #inclusivebusiness</a> <a
                                                   href="#">#internship</a> <a href="#"> #hiring</a> <a
                                                   href="#">#apply</a> </p>
                                           <ul class="nav nav-stack py-3 small">
                                               <li class="nav-item">
                                                   <a class="nav-link active" href="#!"> <i
                                                           class="bi bi-hand-thumbs-up-fill pe-1"></i>Liked (56)</a>
                                               </li>
                                               <li class="nav-item">
                                                   <a class="nav-link" href="#!"> <i
                                                           class="bi bi-chat-fill pe-1"></i>Comments (12)</a>
                                               </li>
                                               <!-- Card share action START -->
                                               <li class="nav-item dropdown ms-auto">
                                                   <a class="nav-link mb-0" href="#" id="cardShareAction"
                                                       data-bs-toggle="dropdown" aria-expanded="false">
                                                       <i class="bi bi-reply-fill fa-flip-horizontal pe-1"></i>Share (3)
                                                   </a>
                                                   <!-- Card share action dropdown menu -->
                                                   <ul class="dropdown-menu dropdown-menu-end"
                                                       aria-labelledby="cardShareAction">
                                                       <li><a class="dropdown-item" href="#"> <i
                                                                   class="bi bi-envelope fa-fw pe-2"></i>Send via Direct
                                                               Message</a></li>
                                                       <li><a class="dropdown-item" href="#"> <i
                                                                   class="bi bi-bookmark-check fa-fw pe-2"></i>Bookmark
                                                           </a></li>
                                                       <li><a class="dropdown-item" href="#"> <i
                                                                   class="bi bi-link fa-fw pe-2"></i>Copy link to
                                                               post</a></li>
                                                       <li><a class="dropdown-item" href="#"> <i
                                                                   class="bi bi-share fa-fw pe-2"></i>Share post via
                                                               …</a></li>
                                                       <li>
                                                           <hr class="dropdown-divider">
                                                       </li>
                                                       <li><a class="dropdown-item" href="#"> <i
                                                                   class="bi bi-pencil-square fa-fw pe-2"></i>Share to
                                                               News Feed</a></li>
                                                   </ul>
                                               </li>
                                               <!-- Card share action END -->
                                           </ul>
                                           <!-- Add comment -->
                                           <div class="d-flex mb-3">
                                               <!-- Avatar -->
                                               <div class="avatar avatar-xs me-2">
                                                   <img class="avatar-img rounded-circle"
                                                       src="assets/images/avatar/04.jpg" alt="">
                                               </div>
                                               <!-- Comment box  -->
                                               <form class="position-relative w-100">
                                                   <textarea class="one form-control pe-4 bg-light" data-autoresize=""
                                                       rows="1" placeholder="Add a comment..."></textarea>
                                                   <!-- Emoji button -->
                                                   <div class="position-absolute top-0 end-0">
                                                       <button class="btn" type="button">🙂</button>
                                                   </div>
                                               </form>
                                           </div>
                                           <!-- Comment wrap START -->
                                           <ul class="comment-wrap list-unstyled ">
                                               <!-- Comment item START -->
                                               <li class="comment-item">
                                                   <div class="d-flex">
                                                       <!-- Avatar -->
                                                       <div class="avatar avatar-xs">
                                                           <img class="avatar-img rounded-circle"
                                                               src="assets/images/avatar/05.jpg" alt="">
                                                       </div>
                                                       <div class="ms-2">
                                                           <!-- Comment by -->
                                                           <div class="bg-light rounded-start-top-0 p-3 rounded">
                                                               <div class="d-flex justify-content-center">
                                                                   <div class="me-2">
                                                                       <h6 class="mb-1"> <a href="#!"> Frances Guerrero
                                                                           </a></h6>
                                                                       <p class="small mb-0">Removed demands expense
                                                                           account in outward tedious do.</p>
                                                                   </div>
                                                                   <small>5hr</small>
                                                               </div>
                                                           </div>
                                                           <!-- Comment react -->
                                                           <ul class="nav nav-divider py-2 small">
                                                               <li class="nav-item">
                                                                   <a class="nav-link" href="#!"> Like (3)</a>
                                                               </li>
                                                               <li class="nav-item">
                                                                   <a class="nav-link" href="#!"> Reply</a>
                                                               </li>
                                                               <li class="nav-item">
                                                                   <a class="nav-link" href="#!"> View 5 replies</a>
                                                               </li>
                                                           </ul>
                                                       </div>
                                                   </div>
                                               </li>
                                           </ul>
                                           <!-- Comment wrap END -->
                                       </div>
                                       <!-- glightbox Albums left bar END  -->
                                   </div>
                                   @endif
                                   @endforeach
                                   @endif
                                   <!-- Photo item END -->
                               </div>
                               <!-- Photos of you tab END -->
                           </div>
                           <!-- Card body END -->
                       </div>
                   </div>
                   <div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="videos-tab">
                       <div class="card">
                           <!-- Card header START -->
                           <div class="card-header border-0 pb-0">
                               <h5 class="card-title">Videos</h5>
                               <!-- Button modal -->
                           </div>
                           <!-- Card header END -->
                           <!-- Card body START -->
                           <div class="card-body">
                               <!-- Video of you tab START -->
                               <div class="row g-3">

                                   <!-- Add Video START -->
                                   <div class="col-sm-6 col-md-4">
                                       <div
                                           class="border border-2 py-5 border-dashed h-100 rounded text-center d-flex align-items-center justify-content-center position-relative">
                                           <a class="stretched-link" href="#!">
                                               <i class="fa-solid fa-camera-retro fs-1"></i>
                                               <h6 class="mt-2">Add Video</h6>
                                           </a>
                                       </div>
                                   </div>
                                   <!-- Add Video END -->
                                   @if(!empty($post) && !empty($post->media))
                                   @foreach($post->media as $media)
                                   @if($media->file_type === 'video')
                                   @php
                                   $max_length = 50;
                                   $relativePath = 'storage/' . str_replace(['app/public/', 'public/'], '',
                                   $media->file_path);

                                   // Check existence of file in public path
                                   $file_path = public_path($relativePath);
                                   $image_url = file_exists($file_path) ? asset($relativePath) :
                                   asset('feed_assets/images/avatar-1.png');
                                   @endphp
                                   <div class="col-sm-6 col-md-4">
                                       <!-- Video START -->
                                       <div class="card p-0 shadow-none border-0 position-relative">
                                           <!-- Video image -->
                                           <div class="position-relative">
                                               <img class="rounded" src="assets/images/albums/01.jpg" alt="">
                                               <!-- Play icon -->
                                               <div class="position-absolute top-0 end-0 p-3">
                                                   <a class="icon-md bg-danger text-white rounded-circle"
                                                       data-glightbox="" href="assets/images/videos/video-call.mp4"> <i
                                                           class="bi bi-play-fill fs-5"> </i> </a>
                                               </div>
                                               <!-- Duration -->
                                               <div class="position-absolute bottom-0 start-0 p-3 d-flex w-100">
                                                   <span
                                                       class="bg-dark bg-opacity-50 px-2 rounded text-white small">02:20</span>
                                               </div>
                                           </div>
                                           <!-- Video info -->
                                           <div class="card-body px-0 pb-0 pt-2">
                                               <ul class="nav nav-stack small">
                                                   <li class="nav-item">
                                                       <a class="nav-link" href="#!"> <i
                                                               class="bi bi-heart-fill text-danger pe-1"></i>22k </a>
                                                   </li>
                                                   <li class="nav-item">
                                                       <a class="nav-link" href="#!"> <i
                                                               class="bi bi-chat-left-text-fill pe-1"></i>3k </a>
                                                   </li>
                                               </ul>
                                           </div>
                                       </div>
                                       <!-- Video END -->
                                   </div>
                                   @endif
                                   @endforeach
                                   @endif
                               </div>
                               <!-- Video of you tab END -->
                           </div>
                           <!-- Card body END -->
                           <!-- Card footer START -->
                           <div class="card-footer border-0 pt-0">
                           </div>
                           <!-- Card footer END -->
                       </div>
                   </div>
               </div>


               <!-- Card feed item END -->
           </div>
           <!-- Main content END -->

           <!-- Right sidebar START -->
           <div class="col-lg-4">

               <div class="row g-4">

                   <!-- Card START -->
                   <div class="col-md-6 col-lg-12">
                       <div class="card">
                           <div class="card-header border-0 pb-0">
                               <h5 class="card-title">About</h5>
                               <!-- Button modal -->
                           </div>
                           <!-- Card body START -->
                           <div class="card-body position-relative pt-0">
                               <p>{{ $user->bio }}</p>
                               <!-- Date time -->
                               <ul class="list-unstyled mt-3 mb-0">
                                   <li class="mb-2"> <i class="bi bi-calendar-date fa-fw pe-1"></i> Born: <strong>
                                           {{ $user->date_of_birth }} </strong> </li>
                                   <li class="mb-2"> <i class="bi bi-heart fa-fw pe-1"></i> Status: <strong>
                                           {{ $user->marital_status }}
                                       </strong> </li>
                                   <li> <i class="bi bi-envelope fa-fw pe-1"></i> Email: <strong> {{ $user->email }}
                                       </strong> </li>
                               </ul>
                           </div>
                           <!-- Card body END -->
                       </div>
                   </div>
                   <!-- Card END -->

                   <!-- Card START -->
                   <div class="col-md-6 col-lg-12">
                       <div class="card">
                           <!-- Card header START -->
                           <div class="card-header d-sm-flex justify-content-between border-0">
                               <h5 class="card-title">Photos</h5>
                               <a class="btn btn-primary-soft btn-sm" href="#!"> See all photo</a>
                           </div>
                           <!-- Card header END -->
                           <!-- Card body START -->
                           <div class="card-body position-relative pt-0">
                               <div class="row g-2">
                                   <!-- Photos item -->
                                   @if(!empty($post) && !empty($post->media))
                                   @foreach($post->media as $media)
                                   @if($media->file_type === 'image')
                                   @php
                                   $max_length = 50;
                                   $relativePath = 'storage/' . str_replace(['app/public/', 'public/'], '',
                                   $media->file_path);

                                   // Check existence of file in public path
                                   $file_path = public_path($relativePath);
                                   $image_url = file_exists($file_path) ? asset($relativePath) :
                                   asset('feed_assets/images/avatar-1.png');
                                   @endphp
                                   <div class="col-6">
                                       <a href="{{ $image_url }}" data-gallery="image-popup" data-glightbox="">
                                           <img class="rounded img-fluid" src="{{ $image_url }}" alt="">
                                       </a>
                                   </div>
                                   @endif
                                   @endforeach
                                   @endif
                               </div>
                           </div>
                           <!-- Card body END -->
                       </div>
                   </div>
                   <!-- Card END -->
               </div>

           </div>
           <!-- Right sidebar END -->

       </div> <!-- Row END -->
   </div>
   <!-- Edit Profile Modal -->



   @endsection
   <script>
// for Edit functionality
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#existingImage').attr('src', e.target.result).show();
        };

        reader.readAsDataURL(input.files[0]); // Convert image to base64
    }
}

$(document).ready(function() {
    // Handle image preview on file select
    $("#ImageEdit").change(function() {
        readURL(this);
    });
});
   </script>


   <script>
/* document.addEventListener('DOMContentLoaded', function () {
        $('#myForm').on('submit', function (e) {
            e.preventDefault();

            var form = document.getElementById("myForm");
            var formData = new FormData(form);
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var userId = "{{ $user->id }}";

            $.ajax({
                url: "/user/update/" + userId,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    alert("Updated successfully!");
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert("Error occurred.");
                }
            });
        });
    });
  */

function goPrev() {
    window.history.back();
}
   </script>