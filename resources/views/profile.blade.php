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
                       <div class="card card-body mb-3">
                           <div class="d-flex mb-3">
                               <!-- Avatar -->
                               <div class="avatar avatar-xs me-2">
                                   <a href="#"> <img class="avatar-img rounded-circle"
                                           src="{{asset('feed_assets/images/avatar/03.jpg')}}" alt=""> </a>
                               </div>
                               <!-- Post input -->
                               <form class="w-100">
                                   <textarea class="form-control pe-4 border-0" rows="2" data-autoresize=""
                                       placeholder="Share your thoughts..."></textarea>
                               </form>
                           </div>
                           <!-- Share feed toolbar START -->
                           <ul class="nav nav-pills nav-stack small fw-normal">
                               <li class="nav-item">
                                   <a class="nav-link bg-light py-1 px-2 mb-0" href="#!" data-bs-toggle="modal"
                                       data-bs-target="#feedActionPhoto"> <i
                                           class="bi bi-image-fill text-success pe-2"></i>Photos/Videos</a>
                               </li>
                           </ul>
                           <!-- Share feed toolbar END -->
                       </div>
                       <!-- Share feed END -->

                       <!-- Card feed item START -->
                       @foreach($posts as $post)
                       <div class="card mb-3" id="post-{{ $post->id }}">
                           <!-- Card header START -->
                           <div class="card-header border-0 pb-0">
                               <div class="d-flex align-items-center justify-content-between">
                                   <div class="d-flex align-items-center">
                                       <!-- Avatar -->
                                       @php
                                       $profileImage = '';
                                       $displayName = '';
                                       $designation = '';
                                       $profileLink = '#';

                                       if ($post->type === 'group_post') {
                                       // Group post ke liye
                                       $profileImage = $post->group_image
                                       ? asset('storage/' . $post->group_image)
                                       : asset('feed_assets/images/avatar/07.jpg'); // fallback image

                                       $displayName = $post->group_name ?? 'Unknown Group';
                                       $designation = 'Group Post';

                                       // Optional: if you have a group detail page
                                       $profileLink = url('/group/' . ($post->group_id ?? 0));
                                       } else {
                                       // Member/user post
                                       $member = $post->member ?? null;

                                       $profileImage = $member && $member->profile_image
                                       ? asset('storage/' . $member->profile_image)
                                       : asset('feed_assets/images/avatar/07.jpg');

                                       $displayName = $member->name ?? 'Unknown';
                                       $designation = $member->designation ?? 'Unknown';
                                       $profileLink = url('/user/profile/' . ($member->id ?? 0));
                                       }
                                       @endphp

                                       <div class="avatar avatar-story me-2">
                                           <a href="{{ $profileLink }}">
                                               <img class="avatar-img rounded-circle" src="{{ $profileImage }}" alt="">
                                           </a>
                                       </div>

                                       <!-- Info -->
                                       <div>
                                           <div class="nav nav-divider">
                                               <h6 class="nav-item card-title mb-0">
                                                   <a href="{{ $profileLink }}">{{ $displayName }}</a>
                                               </h6>
                                               <span class="nav-item small">
                                                   {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                                               </span>
                                           </div>
                                           <p class="mb-0 small">{{ $designation }}</p>
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
                               $videoMedia = $validMedia->where('file_type', 'video')->values();

                               $totalImages = $imageMedia->count();
                               $totalVideos = $videoMedia->count();
                               @endphp
                               @if($post->video_link)
                               {{-- Embedded YouTube Video --}}
                               <div class="ratio ratio-16x9 mt-2">
                                   <iframe width="560" height="315" src="{{ $post->video_link }}"
                                       title="YouTube video player" frameborder="0"
                                       allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                       referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                               </div>
                               @elseif($totalVideos > 0)
                               {{-- Uploaded Video Files --}}
                               <div class="post-video mt-2">
                                   @foreach($videoMedia as $video)
                                   <video controls class="w-100 rounded mb-2" preload="metadata">
                                       <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                                       Your browser does not support the video tag.
                                   </video>
                                   @endforeach
                               </div>
                               @endif

                               {{-- Image Display (your current logic) --}}

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
                                           data-url="{{ route('user.post.like', $post->id) }}"
                                           data-post-id="{{ $post->id }}" data-bs-toggle="tooltip" data-bs-html="true"
                                           data-bs-title="{{ $likeUsersTooltip ?: 'No likes yet' }}">
                                           <i class="bi bi-hand-thumbs-up-fill pe-1"></i>
                                           <span class="like-label">Like</span>
                                           <span
                                               class="like-count">{{ $post->likes->count() ? '('.$post->likes->count().')' : '' }}</span>
                                       </a>
                                   </li>



                                   <li class="nav-item">
                                       <a class="nav-link" href="#!">
                                           <i class="bi bi-chat-fill pe-1"></i>Comments
                                           <span
                                               class="comment-count">{{ $post->comments->count() ? '(' . $post->comments->count() . ')' : '' }}</span>
                                       </a>

                                   </li>
                                   <!-- Card share action START -->
                                   <li class="nav-item dropdown ms-sm-auto">
                                       <a class="nav-link mb-0" href="#" id="cardShareAction" data-bs-toggle="dropdown"
                                           aria-expanded="false">
                                           <i class="bi bi-reply-fill flip-horizontal ps-1"></i> Share
                                           {{ $post->shares ? '('.$post->shares->count().')' : '' }}
                                       </a>
                                       <!-- Card share action dropdown menu -->
                                       <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardShareAction">
                                           <li>
                                               <a href="#" class="dropdown-item send-direct-message-btn"
                                                   data-user-id="{{-- $member->id --}}">
                                                   <i class="bi bi-envelope fa-fw pe-2"></i>Send via Direct Message
                                               </a>
                                           </li>

                                           <li>
                                               <a class="dropdown-item copy-url-btn" href="javascript:void(0)"
                                                   data-url="{{-- url('/user/profile/' . $member->id) --}}">
                                                   <i class="bi bi-link fa-fw pe-2"></i>Copy link to post
                                               </a>
                                           </li>

                                           <li>
                                               <hr class="dropdown-divider">
                                           </li>
                                           <li>
                                               <a class="dropdown-item share-to-feed-btn" href="#"
                                                   data-post-id="{{ $post->id ?? '' }}">
                                                   <i class="bi bi-pencil-square fa-fw pe-2"></i>Share to News Feed
                                               </a>
                                           </li>
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
                                   {{--@foreach ($post->comments as $comment)--}}
                                   @foreach ($post->comments->take(2) as $comment)
                                   <li class="comment-item mb-3" id="comment-{{ $comment->id }}">
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
                                               <div class="row">
                                                   <div class="col-6">
                                                       <a href="#!" class="text-secondary small me-2">Like</a>
                                                       <a href="#!" class="text-secondary small">Reply</a>
                                                   </div>
                                                   <div class="col-6 text-end">
                                                       @if(auth()->guard('user')->id() === $comment->member_id)
                                                       <button
                                                           class="btn btn-sm btn-link p-0 text-primary edit-comment-btn"
                                                           data-comment-id="{{ $comment->id }}"
                                                           data-comment="{{ $comment->comment }}" type="button"><i
                                                               class="bi bi-pencil-fill"></i></button>
                                                       @endif
                                                       @if(auth()->guard('user')->id() === $comment->member_id)
                                                       <button
                                                           class="btn btn-sm btn-link p-0 text-danger delete-comment-btn"
                                                           data-comment-id="{{ $comment->id }}" type="button"><i
                                                               class="bi bi-trash-fill"></i></button>
                                                       @endif
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <!-- Comment item nested END -->
                                   </li>
                                   @endforeach
                                   <!-- Comment item END -->
                               </ul>
                               <!-- Card body END -->
                               <!-- Card footer START -->
                               <!--<div class="card-footer border-0 pt-0">

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
                            </div>-->
                               @if ($post->comments->count() > 2)
                               <div class="card-footer border-0 pt-0">
                                   <a href="#!" class="btn btn-link btn-sm text-secondary load-more-comments"
                                       data-post-id="{{ $post->id }}" data-offset="2">
                                       <div class="spinner-dots me-2 d-none" id="spinner-{{ $post->id }}">
                                           <span class="spinner-dot"></span>
                                           <span class="spinner-dot"></span>
                                           <span class="spinner-dot"></span>
                                       </div>
                                       Load more comments
                                   </a>
                               </div>
                               @endif
                               <!-- Card footer END -->
                           </div>
                           <!-- Card feed item END -->

                       </div>
                       @endforeach
                       <!-- Load more button START -->
                       <a href="#!" role="button" class="btn btn-loader btn-primary-soft w-100" data-bs-toggle="button"
                           aria-pressed="true">
                           <span class="load-text"> Load more </span>
                           <div class="load-icon">
                               <div class="spinner-grow spinner-grow-sm" role="status">
                                   <span class="visually-hidden">Loading...</span>
                               </div>
                           </div>
                       </a>
                       <!-- Load more button END -->
                       <!-- Card feed END -->
                   </div>
                   <!-- Edit Comment Modal -->
                   <div class="modal fade" id="editCommentModal" tabindex="-1" aria-hidden="true">
                       <div class="modal-dialog">
                           <form method="POST" action="{{-- route('user.comments.update') --}}">
                               @csrf
                               @method('PUT')
                               <input type="hidden" name="comment_id" id="editCommentId">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <h5 class="modal-title">Edit Comment</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                   </div>
                                   <div class="modal-body">
                                       <textarea name="comment" id="editCommentText" class="form-control"
                                           rows="3"></textarea>
                                   </div>
                                   <div class="modal-footer">
                                       <button type="submit" class="btn btn-primary">Update</button>
                                   </div>
                               </div>
                           </form>
                       </div>
                   </div>
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
                                           <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="aboutAction2">
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
                                           <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="aboutAction3">
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
                                           <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="aboutAction4">
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
                                           <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="aboutAction5">
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
                                           <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="aboutAction6">
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
                                           <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="aboutAction7">
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
                                               <a class="icon-md bg-danger text-white rounded-circle" data-glightbox=""
                                                   href="assets/images/videos/video-call.mp4"> <i
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

           <!-- Right sidebar START -->
           <div class="col-lg-4" style=" position: sticky; top: 80px; max-height: 100vh; overflow-y: auto;">

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

   <div class="modal fade" id="feedActionPhoto" tabindex="-1" aria-labelledby="feedActionPhotoLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
           <form class="modal-content" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
               @csrf

               <!-- Modal header -->
               <div class="modal-header">
                   <h5 class="modal-title" id="feedActionPhotoLabel">Add post photo</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>

               <!-- Modal body -->
               <div class="modal-body">
                   <div class="d-flex mb-3">
                       <!-- User avatar -->
                       <div class="avatar avatar-xs me-2">
                           @php
                           $profilePic = $user->profile_pic ?? null;
                           @endphp
                           <img class="avatar-img rounded-circle"
                               src="{{ $profilePic ? asset('storage/' . $profilePic) : asset('feed_assets/images/avatar/03.jpg') }}"
                               alt="User Avatar">
                       </div>
                       <!-- Post textarea -->
                       <textarea class="form-control pe-4 fs-3 lh-1 border-0" name="modalContent" rows="2"
                           placeholder="Share your thoughts..."></textarea>
                   </div>

                   <!-- File upload -->
                   <div class="mb-3">
                       <label class="form-label">Upload attachment</label>
                       <div id="drop-area" class="drop-area p-4 text-center border border-secondary rounded">
                           <i class="bi bi-images fs-1 mb-2 d-block"></i>
                           <span class="d-block">Drag & Drop image here or click to browse.</span>
                           <input type="file" id="media" name="media[]" multiple class="d-none" accept="image/*">
                           <div id="preview" class="mt-3 d-flex flex-wrap gap-3"></div>
                       </div>
                   </div>

                   <!-- Optional video link -->
                   <input class="form-control mt-2" type="text" name="video_link" placeholder="Video Link (optional)" />
               </div>

               <!-- Modal footer -->
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger-soft" data-bs-dismiss="modal">Cancel</button>
                   <button type="submit" class="btn btn-success-soft">Post</button>
               </div>
           </form>
       </div>
   </div>

   <div class="modal fade" id="groupActionpost" tabindex="-1" aria-labelledby="groupActionpostLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
           <form class="modal-content" action="{{ route('user.group.post')}}" method="POST"
               enctype="multipart/form-data">
               @csrf

               <!-- Modal header -->
               <div class="modal-header">
                   <h5 class="modal-title" id="groupActionpostLabel">Add Group post in <span class="group_name"></span>
                   </h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>

               <!-- Modal body -->
               <div class="modal-body">
                   <div class="d-flex mb-3">
                       <!-- User avatar -->
                       <div class="avatar avatar-xs me-2">
                           @php
                           $profilePic = $user->profile_pic ?? null;
                           @endphp
                           <img class="avatar-img rounded-circle"
                               src="{{ $profilePic ? asset('storage/' . $profilePic) : asset('feed_assets/images/avatar/03.jpg') }}"
                               alt="User Avatar">
                       </div>
                       <!-- Post textarea -->
                       <input type="hidden" name="group_id" class="group_id">
                       <textarea class="form-control pe-4 fs-3 lh-1 border-0" name="modalContent" rows="2"
                           placeholder="Share your thoughts..."></textarea>
                   </div>

                   <!-- File upload -->
                   <div class="mb-3">
                       <label class="form-label">Upload attachment</label>
                       <div id="drop-area" class="drop-area p-4 text-center border border-secondary rounded">

                           <i class="bi bi-images fs-1 mb-2 d-block"></i>
                           <span class="d-block">Drag & Drop image here or click to browse.</span>
                           <input type="file" id="media" name="media[]" multiple class="d-none" accept="image/*">
                           <div id="preview" class="mt-3 d-flex flex-wrap gap-3"></div>
                       </div>
                   </div>
                   <!-- Optional video link -->
                   <input class="form-control mt-2" type="text" name="video_link" placeholder="Video Link (optional)" />
               </div>

               <!-- Modal footer -->
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger-soft" data-bs-dismiss="modal">Cancel</button>
                   <button type="submit" class="btn btn-success-soft">Post</button>
               </div>
           </form>
       </div>
   </div>
   <!-- Modal create Feed photo END -->

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
   <script>
$(document).on('click', '.like-button', function() {

    const $btn = $(this);
    const url = $btn.data('url');


    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.table(response);
            // Toggle class
            $btn.toggleClass('active text-primary');
            if (response.like_count != 0) {
                $btn.find('.like-count').html('(' + response.like_count + ')');
            } else {
                $btn.find('.like-count').html('');
            }
            $btn.attr('data-bs-title', response.tooltip_html).tooltip('dispose').tooltip();
        },
        error: function(xhr) {
            console.error(xhr.responseText);
        }
    });

});


$(document).on('click', '.delete-comment-btn', function() {
    const commentId = $(this).data('comment-id');

    if (confirm('Are you sure you want to delete this comment?')) {
        $.ajax({
            url: `/user/comments/${commentId}`,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function() {
                $(`#comment-${commentId}`).fadeOut(300, function() {
                    $(this).remove();

                    // Update comment count
                    const $postCard = $(this).closest('.card');
                    const $countSpan = $postCard.find('.comment-count');
                    let countText = $countSpan.text().replace(/[()]/g, '');
                    let count = parseInt(countText) || 0;

                    count = count - 1;
                    if (count > 0) {
                        $countSpan.text('(' + count + ')');
                    } else {
                        $countSpan.text('');
                    }
                });
            },
            error: function() {
                alert('Failed to delete comment.');
            }
        });
    }
});


//add storis modal
document.getElementById('openAddStoryModal').addEventListener('click', function() {
    var myModal = new bootstrap.Modal(document.getElementById('addStoryModal'));
    myModal.show();
});
// end storie modal




document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.copy-url-btn').forEach(function(el) {
        el.addEventListener('click', function(e) {
            e.preventDefault();
            const url = el.getAttribute('data-url');

            // Copy to clipboard
            navigator.clipboard.writeText(url).then(() => {
                alert('Link copied to clipboard!');
            }).catch(err => {
                console.error('Failed to copy: ', err);
            });
        });
    });
});



// Send via Direct Message
document.querySelectorAll('.send-direct-message-btn').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const userId = this.getAttribute('data-user-id');
        document.getElementById('messageUserId').value = userId;

        // Show modal
        let modal = new bootstrap.Modal(document.getElementById('directMessageModal'));
        modal.show();
    });
});

// Share to News Feed
document.querySelectorAll('.share-to-feed-btn').forEach(function(el) {
    el.addEventListener('click', function(e) {
        e.preventDefault();
        const postId = el.getAttribute('data-post-id');
        // Trigger share modal or prefill content logic here
        alert('Open share-to-feed modal for post ID: ' + postId);
    });
});






document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.edit-comment-btn').forEach(button => {
        button.addEventListener('click', function() {
            const commentId = this.dataset.commentId;
            const commentText = this.dataset.comment;
            const commentDiv = document.getElementById(`comment-text-${commentId}`);

            // Replace text with input
            commentDiv.innerHTML = `
                <input type="text" id="edit-input-${commentId}" class="form-control form-control-sm mb-1" value="${commentText}">
                <button class="btn btn-sm btn-success" onclick="saveEditedComment(${commentId})">Update</button>
               <button class="btn btn-sm btn-danger" onclick="deleteComment(${commentId})">Delete</button>
            `;
        });
    });
});

function cancelEdit(id, originalText) {
    document.getElementById(`comment-text-${id}`).innerHTML = originalText;
}

function saveEditedComment(id) {
    const newComment = document.getElementById(`edit-input-${id}`).value;

    fetch(`/user/comments/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                comment: newComment
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById(`comment-text-${id}`).innerHTML = newComment;
            } else {
                alert(data.message || 'Failed to update comment');
            }
        })
        .catch(err => {
            console.error('Edit failed', err);
            alert('An error occurred while editing the comment.');
        });
}

function deleteComment(commentId) {
    if (!confirm('Are you sure you want to delete this comment?')) return;

    fetch(`/user/comments/${commentId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById(`comment-wrapper-${commentId}`).remove();
            } else {
                alert(data.error || 'Failed to delete comment.');
            }
        })
        .catch(error => {
            console.error('Error deleting comment:', error);
            alert('An error occurred while deleting the comment.');
        });
}


document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.load-more-comments').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const postId = btn.dataset.postId;
            let offset = parseInt(btn.dataset.offset);
            const spinner = document.getElementById('spinner-' + postId);
            spinner.classList.remove('d-none');

            fetch(`load-comments/${postId}?offset=${offset}`)
                .then(res => res.json())
                .then(data => {
                    spinner.classList.add('d-none');

                    if (data.comments.length === 0) {
                        btn.remove(); // No more comments
                        return;
                    }

                    let commentHtml = '';
                    data.comments.forEach(comment => {
                        commentHtml += `
                            <li class="comment-item mb-3" id="comment-${comment.id}">
                                <div class="d-flex position-relative">
                                    <div class="avatar avatar-xs">
                                        <a href="#!"><img class="avatar-img rounded-circle"
                                            src="${comment.member && comment.member.profile_pic ? '/storage/' + comment.member.profile_pic : '/feed_assets/images/avatar/12.jpg'}"
                                            alt=""></a>
                                    </div>
                                    <div class="ms-2 w-100">
                                        <div class="bg-light rounded-start-top-0 p-3 rounded">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="mb-1"><a href="#!">${comment.member?.name || 'Anonymous'}</a></h6>
                                                <small class="ms-2">Just now</small>
                                            </div>
                                            <p class="small mb-0">${comment.comment}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>`;
                    });

                    btn.closest('.card-footer').insertAdjacentHTML('beforebegin',
                        commentHtml);
                    btn.dataset.offset = offset + data.comments.length;
                })
                .catch(err => {
                    spinner.classList.add('d-none');
                    console.error('Failed to load comments:', err);
                });
        });
    });
});
   </script>