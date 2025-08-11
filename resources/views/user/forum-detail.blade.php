@extends('layouts.app')

@section('title', $forum->name . ' - Forum | Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container">
    <div class="row g-4" style="margin-top: 100px;">
        <!-- Left Sidebar -->
        <div class="col-3">
            <!-- Advanced filter responsive toggler START -->
            <div class="d-flex align-items-center d-lg-none">
                <button class="border-0 bg-transparent" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasSideNavbar" aria-controls="offcanvasSideNavbar">
                    <span class="btn btn-primary"><i class="fa-solid fa-sliders-h"></i></span>
                    <span class="h6 mb-0 fw-bold d-lg-none ms-2">My profile</span>
                </button>
            </div>
            <!-- Advanced filter responsive toggler END -->

            <!-- Navbar START-->
            <nav class="navbar navbar-expand-lg mx-0">
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSideNavbar">
                    <!-- Offcanvas header -->
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close text-reset ms-auto" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>

                    <!-- Offcanvas body -->
                    <div class="offcanvas-body d-block px-2 px-lg-0">
                        <!-- Card START -->
                        <div class="card overflow-hidden">
                            <!-- Cover image -->
                            <div class="h-50px"
                                style="background-image:url({{asset('feed_assets/images/bg/01.jpg')}}); background-position: center; background-size: cover; background-repeat: no-repeat;">
                            </div>
                            <!-- Card body START -->
                            <div class="card-body pt-0">
                                <div class="text-center">
                                    <!-- Avatar -->
                                    @php
                                    $profileImage = '';
                                    $displayName = '';
                                    $designation = '';
                                    $profileLink = '#';

                                    if (Auth::guard('user')->check()) {
                                    // Member/user post
                                    $member = $post->member ?? null;

                                    $profileImage = $member && $member->profile_image
                                    ? asset('storage/' . $member->profile_image)
                                    : asset('feed_assets/images/avatar/07.jpg');

                                    $displayName = $member->name ?? 'Unknown';
                                    $designation = $member->designation ?? 'Unknown';
                                    $profileLink = url('/user/profile/' . ($member->id ?? 0));
                                    }
                                    else {
                                    // Default user profile
                                    $user = Auth::guard('user')->user();
                                    $profileImage = $user->profile_pic
                                    ? asset('storage/' . $user->profile_pic)
                                    : asset('feed_assets/images/avatar-1.png');

                                    $displayName = $user->name ?? 'Guest User';
                                    $designation = $user->designation ?? 'Guest';
                                    $profileLink = url('/user/profile/' . ($user->id ?? 0));
                                    }
                                    $user = Auth::guard('user')->user();
                                    $profileImage = $user->profile_pic ? asset('storage/' . $user->profile_pic) :
                                    asset('feed_assets/images/avatar-1.png');
                                    $displayName = $user->name ?? 'Guest User';
                                    $designation = $user->designation ?? 'Guest';
                                    $profileLink = url('/user/profile/' . ($user->id ?? 0));
                                    @endphp
                                    <div class="avatar avatar-lg mt-n5 mb-3">
                                        <a href="#!"><img class="avatar-img rounded-circle qwetyu"
                                                src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}"
                                                alt=""></a>
                                    </div>
                                    <!-- Info -->
                                    @if(Auth::guard('user')->check())
                                    <h5 class="mb-0"> <a href="#!">{{ Auth::guard('user')->user()->name }} </a> </h5>
                                    @endif
                                    <small>{{ Auth::guard('user')->user()->designation }}</small>
                                    <ul class="list-inline mb-0 text-center text-sm-start mt-3 mt-sm-0">
                                        <li class="list-inline-item"><i class="bi bi-briefcase me-1"></i>
                                            {{ $user->current_designation }}
                                        </li>
                                        <li class="list-inline-item"><i class="bi bi-backpack me-1"></i>
                                            {{ $user->batch }}</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Card body END -->
                            <!-- Card footer -->
                            <div class="card-footer text-center py-2">
                                <a class="btn btn-link btn-sm"
                                    href="{{ route('user.profile.data', ['id' => $user->id]) }}">View Profile </a>
                            </div>
                        </div>
                        <!-- Card END -->
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <!-- Forum Header -->
            <div class="card mb-4">
                <div class="card-body border-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <!-- Forum Info -->
                            <div>
                                <h5 class="card-title mb-0">{{ $forum->name }}</h5>
                                <p class="mb-0 small text-muted mb-2">{{ $topics->count() }} topics</p>
                                @if($forum->end_date)
                                <p class="mb-0 small text-muted">End Date:
                                    {{ \Carbon\Carbon::parse($forum->end_date)->format('d M Y') }} </p>
                                @endif
                            </div>
                        </div>
                        <!-- Back Button -->

                        <div class="d-flex align-items-center gap-2">
                            @if($forum->created_by == Auth::guard('user')->user()->id)
                            <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addTopicModal" title="Add Topic" data-bs-placement="top" data-bs-html="true"
                                data-bs-custom-class="tooltip-text-start">
                                <i class="bi bi-plus me-1"></i>
                            </button>
                            @endif
                            @if($forum->created_by == Auth::guard('user')->user()->id )
                            <form method="POST" action="{{ route('user.forum.delete') }}">
                                @csrf
                                <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                                <input type="hidden" name="action" value="delete">
                                <button type="button" class="btn btn-outline-primary btn-sm"
                                    onclick="if(confirm('Are you sure you want to delete this forum?')) { this.form.submit(); }" title="Delete Forum" data-bs-placement="top" data-bs-html="true"
                                data-bs-custom-class="tooltip-text-start">
                                    <i class="bi bi-trash me-1"></i>
                                </button>
                            </form>
                            @endif
                            <a href="{{ route('user.forum') }}" class="btn btn-outline-secondary btn-sm" title="Back to Forum" data-bs-placement="top" data-bs-html="true"
                                data-bs-custom-class="tooltip-text-start">
                                <i class="bi bi-arrow-left me-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Topics/Posts -->
            @if($topics->count() > 0)
            @foreach($topics as $topic)
            <div class="card mb-4">
                <!-- Card header START -->
                <div class="card-header border-0 pb-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <!-- Avatar -->
                            <div class="avatar me-2">
                                <a href="#!">
                                    <img class="avatar-img rounded-circle"
                                        src="{{ $user->profile_pic && $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}"
                                        alt="">
                                </a>
                            </div>
                            <!-- Info -->
                            <div>
                                <div class="nav nav-divider">
                                    <h6 class="nav-item card-title mb-0">
                                        <a
                                            href="#!">{{ $topic->creator_name ? $topic->creator_name : $topic->member->name }}</a>
                                    </h6>
                                        @php
    $createdAt = \Carbon\Carbon::parse($topic->created_date)->setTimezone('Asia/Kolkata');
    $now = \Carbon\Carbon::now('Asia/Kolkata');
    $diff = $createdAt->diff($now);

    if ($diff->y > 0) {
        $timeDiff = $diff->y . 'y';
    } elseif ($diff->m > 0) {
        $timeDiff = $diff->m . 'mo';
    } elseif ($diff->d > 0) {
        $timeDiff = $diff->d . 'd';
    } elseif ($diff->h > 0) {
        $timeDiff = $diff->h . 'h';
    } elseif ($diff->i > 0) {
        $timeDiff = $diff->i . 'min';
    } else {
        $timeDiff = 'Just now';
    }
@endphp

<small class="ms-2">{{ $timeDiff }}</small>

                                </div>
                                <p class="mb-0 small">{{ $topic->creator ? $topic->creator->designation : 'Member' }}
                                </p>
                            </div>
                        </div>
                        <!-- Card feed action dropdown START -->
                        <div class="dropdown">
                            <a href="#" class="text-secondary btn btn-secondary-soft-hover py-1 px-2"
                                id="cardFeedAction{{ $topic->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </a>
                            <!-- Card feed action dropdown menu -->
                            <ul class="dropdown-menu dropdown-menu-end"
                                aria-labelledby="cardFeedAction{{ $topic->id }}">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-bookmark fa-fw pe-2"></i>Save
                                        post</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-share fa-fw pe-2"></i>Share</a>
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-flag fa-fw pe-2"></i>Report
                                        post</a></li>
                            </ul>
                        </div>
                        <!-- Card feed action dropdown END -->
                    </div>
                </div>
                <!-- Card header END -->

                <!-- Card body START -->
                <div class="card-body">
                    <!-- Topic Title -->
                    <h5 class="mb-3">{{ $topic->title }}</h5>

                    <!-- Topic Description -->
                    <p class="mb-3">{{ $topic->description }}</p>

                    <!-- Topic Image -->
                    @if($topic->images)
                    <div class="mb-3">
                        <img class="card-img rounded" src="{{ asset('storage/' . $topic->images) }}" alt="Topic Image">
                        @if($topic->image_caption)
                        <p class="small text-muted mt-2">{{ $topic->image_caption }}</p>
                        @endif
                    </div>
                    @endif

                    <!-- Topic Video -->
                    @if($topic->video_link)
                    <div class="mb-3">
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $topic->video_link }}" title="Video" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                        @if($topic->video_caption)
                        <p class="small text-muted mt-2">{{ $topic->video_caption }}</p>
                        @endif
                    </div>
                    @endif

                    <!-- Topic File -->
                    @if($topic->files)
                    <div class="mb-3">
                        <a href="{{ asset('storage/' . $topic->files) }}" class="btn btn-outline-primary btn-sm"
                            target="_blank">
                            <i class="bi bi-file-earmark-text me-1"></i>View Document
                        </a>
                    </div>
                    @endif

                        <!-- Feed react START -->
                        <ul class="nav nav-stack py-3 small">
                        <li class="nav-item">
                            @if($user && $topic->isLikedBy($user->id))
                                <form action="{{ route('user.forum.topic.unlike', $topic->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="nav-link active border-0 bg-transparent" 
                                           data-bs-container="body" data-bs-toggle="tooltip"
                                           data-bs-placement="top" data-bs-html="true" data-bs-custom-class="tooltip-text-start"
                                           data-bs-title="Unlike this topic">
                                        <i class="bi bi-hand-thumbs-up-fill pe-1"></i>Liked ({{ $topic->likes->count() }})
                                    </button>
                                </form>
                            @else
                                @if($user)
                                    <form action="{{ route('user.forum.topic.like', $topic->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="nav-link border-0 bg-transparent" 
                                               data-bs-container="body" data-bs-toggle="tooltip"
                                               data-bs-placement="top" data-bs-html="true" data-bs-custom-class="tooltip-text-start"
                                               data-bs-title="Like this topic">
                                            <i class="bi bi-hand-thumbs-up pe-1"></i>Like ({{ $topic->likes->count() }})
                                        </button>
                                    </form>
                                @else
                                    <a class="nav-link" href="{{ route('user.login') }}" 
                                       data-bs-container="body" data-bs-toggle="tooltip"
                                       data-bs-placement="top" data-bs-html="true" data-bs-custom-class="tooltip-text-start"
                                       data-bs-title="Login to like this topic">
                                        <i class="bi bi-hand-thumbs-up pe-1"></i>Like ({{ $topic->likes->count() }})
                                    </a>
                                @endif
                            @endif
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#!" onclick="toggleComments({{ $topic->id }})">
                                <i class="bi bi-chat-fill pe-1"></i>Comments ({{ $topic->comments->count() }})</a>
                        </li>
                    </ul>
                        <!-- Feed react END -->

                        <!-- Add comment -->
                        @if($user)
                    <div class="d-flex mb-3">
                        <!-- Avatar -->
                        <div class="avatar avatar-xs me-2">
                            <a href="#!">
                                
                                <img class="avatar-img rounded-circle"
                                    src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}"
                                    

                                    alt="">
                            </a>
                        </div>
                        <!-- Comment box -->
                        <form action="{{ route('user.forum.topic.comment', $topic->id) }}" method="POST" class="nav nav-item w-100 position-relative">
                            @csrf
                            <textarea name="comment" data-autoresize="" class="form-control pe-5 bg-light" rows="1"
                                placeholder="Add a comment..." required></textarea>
                            <button
                                class="nav-link bg-transparent px-3 position-absolute top-50 end-0 translate-middle-y border-0"
                                type="submit">
                                <i class="bi bi-send-fill"></i>
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="d-flex mb-3">
                        <div class="w-100 text-center">
                            <a href="{{ route('user.login') }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-person-plus me-1"></i>Login to comment
                            </a>
                        </div>
                    </div>
                    @endif

                        <!-- Comment wrap START -->
                        <ul class="comment-wrap list-unstyled">
                        @if($topic->comments->count() > 0)
                            @foreach($topic->comments as $comment)
                               <!-- Comment item START -->
							<li class="comment-item mb-3">
								<div class="d-flex position-relative">
									<!-- Avatar -->
									<div class="avatar avatar-xs">
										<a href="#!"><img class="avatar-img rounded-circle" src="{{ $comment->user && $comment->user->profile_pic ? asset('storage/' . $comment->user->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}" alt=""></a>
									</div>
									<div class="ms-2">
										<!-- Comment by -->
										<div class="bg-light rounded-start-top-0 p-3 rounded">
											<div class="d-flex justify-content-between">
												<h6 class="mb-1"> <a href="#!">{{ $comment->user ? $comment->user->name : 'Unknown User' }}</a></h6>
												@php
    $createdAt = \Carbon\Carbon::parse($comment->created_at)->setTimezone('Asia/Kolkata');
    $now = \Carbon\Carbon::now('Asia/Kolkata');
    $diff = $createdAt->diff($now);

    if ($diff->y > 0) {
        $timeDiff = $diff->y . 'y';
    } elseif ($diff->m > 0) {
        $timeDiff = $diff->m . 'mo';
    } elseif ($diff->d > 0) {
        $timeDiff = $diff->d . 'd';
    } elseif ($diff->h > 0) {
        $timeDiff = $diff->h . 'h';
    } elseif ($diff->i > 0) {
        $timeDiff = $diff->i . 'min';
    } else {
        $timeDiff = 'Just now';
    }
@endphp

<small class="ms-2">{{ $timeDiff }}</small>

											</div>
											<p class="small mb-0">{{ $comment->comment }}</p>
										</div>
									</div>
								</div>
                                </li>
                            @endforeach
                        @else
                            <!-- No comments yet -->
                            <li class="text-center text-muted small py-3">
                                No comments yet. Be the first to comment!
                            </li>
                            @endif
                    </ul>
                    <!-- Comment wrap END -->
                    </div>
                    <!-- Card body END -->
                </div>
                @endforeach
            @else
            <!-- No Topics -->
            <div class="card">
                <div class="card-body text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-chat-dots display-4 text-muted"></i>
                    </div>
                    <h5 class="mb-2">No topics yet</h5>
                    <p class="text-muted mb-0">This forum doesn't have any topics yet. Topics will appear here once they
                        are created by forum administrators.</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- Add Topic Modal -->
<div class="modal fade" id="addTopicModal" tabindex="-1" aria-labelledby="addTopicModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTopicModalLabel">Add a Topic</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('user.forum.topic.store', $forum->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="topicDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="topicDescription" name="description" rows="4"
                            placeholder="Enter topic description" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Topic</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleComments(topicId) {
    // This function can be used to show/hide comments if needed
    console.log('Toggle comments for topic: ' + topicId);
}
</script>
@endpush