@extends('layouts.app')

@section('title', $forum->name . ' - Forum | Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container">
    <div class="row g-4" style="margin-top: 100px;">
        <!-- Left Sidebar -->
        <div class="col-md-3 left-sidebar">
            @include('partials.left-sidebar', ['forums' => $forums])
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <!-- Forum Header -->
            <div class="card mb-4">
                <div class="card-header border-0 pb-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <!-- Forum Avatar -->
                            <div class="avatar me-3">
                                <img class="avatar-img rounded-circle" 
                                     src="{{ asset('storage/uploads/images/' . ($forum->images ?? 'default-forum.jpg')) }}" 
                                     alt="{{ $forum->name }}">
                            </div>
                            <!-- Forum Info -->
                            <div>
                                <h5 class="card-title mb-0">{{ $forum->name }}</h5>
                                <p class="mb-0 small text-muted">Forum • {{ $topics->count() }} topics</p>
                            </div>
                        </div>
                        <!-- Back Button -->
                        <div>
                            <a href="{{ route('user.forum') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-arrow-left me-1"></i>Back to Forums
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
                                             src="{{ $topic->creator && $topic->creator->profile_pic ? asset('storage/' . $topic->creator->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}" 
                                             alt="">
                                    </a>
                                </div>
                                <!-- Info -->
                                <div>
                                    <div class="nav nav-divider">
                                        <h6 class="nav-item card-title mb-0">
                                            <a href="#!">{{ $topic->creator ? $topic->creator->name : 'Unknown User' }}</a>
                                        </h6>
                                        <span class="nav-item small">{{ \Carbon\Carbon::parse($topic->created_date)->diffForHumans() }}</span>
                                    </div>
                                    <p class="mb-0 small">{{ $topic->creator ? $topic->creator->designation : 'Member' }}</p>
                                </div>
                            </div>
                            <!-- Card feed action dropdown START -->
                            <div class="dropdown">
                                <a href="#" class="text-secondary btn btn-secondary-soft-hover py-1 px-2" 
                                   id="cardFeedAction{{ $topic->id }}" 
                                   data-bs-toggle="dropdown" 
                                   aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </a>
                                <!-- Card feed action dropdown menu -->
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardFeedAction{{ $topic->id }}">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-bookmark fa-fw pe-2"></i>Save post</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-share fa-fw pe-2"></i>Share</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-flag fa-fw pe-2"></i>Report post</a></li>
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
                            <img class="card-img rounded" 
                                 src="{{ asset('storage/' . $topic->images) }}" 
                                 alt="Topic Image">
                            @if($topic->image_caption)
                            <p class="small text-muted mt-2">{{ $topic->image_caption }}</p>
                            @endif
                        </div>
                        @endif

                        <!-- Topic Video -->
                        @if($topic->video_link)
                        <div class="mb-3">
                            <div class="ratio ratio-16x9">
                                <iframe src="{{ $topic->video_link }}" 
                                        title="Video" 
                                        frameborder="0" 
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
                            <a href="{{ asset('storage/' . $topic->files) }}" 
                               class="btn btn-outline-primary btn-sm" 
                               target="_blank">
                                <i class="bi bi-file-earmark-text me-1"></i>View Document
                            </a>
                        </div>
                        @endif

                        <!-- Feed react START -->
                        <ul class="nav nav-stack py-3 small">
                            <li class="nav-item">
                                <a class="nav-link active" href="#!" data-bs-container="body" 
                                   data-bs-toggle="tooltip" data-bs-placement="top" 
                                   data-bs-html="true" data-bs-custom-class="tooltip-text-start" 
                                   data-bs-title="Like this topic">
                                    <i class="bi bi-hand-thumbs-up-fill pe-1"></i>Like</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#!">
                                    <i class="bi bi-chat-fill pe-1"></i>Comments (0)</a>
                            </li>
                            <!-- Card share action START -->
                            <li class="nav-item dropdown ms-sm-auto">
                                <a class="nav-link mb-0" href="#" 
                                   id="cardShareAction{{ $topic->id }}" 
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-reply-fill flip-horizontal ps-1"></i>Share
                                </a>
                                <!-- Card share action dropdown menu -->
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardShareAction{{ $topic->id }}">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-envelope fa-fw pe-2"></i>Send via Direct Message</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-bookmark-check fa-fw pe-2"></i>Bookmark</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-link fa-fw pe-2"></i>Copy link to post</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-share fa-fw pe-2"></i>Share post via …</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-pencil-square fa-fw pe-2"></i>Share to News Feed</a></li>
                                </ul>
                            </li>
                            <!-- Card share action END -->
                        </ul>
                        <!-- Feed react END -->

                        <!-- Add comment -->
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
                            <form class="nav nav-item w-100 position-relative">
                                <textarea data-autoresize="" class="form-control pe-5 bg-light" rows="1" 
                                          placeholder="Add a comment..."></textarea>
                                <button class="nav-link bg-transparent px-3 position-absolute top-50 end-0 translate-middle-y border-0" 
                                        type="submit">
                                    <i class="bi bi-send-fill"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Comment wrap START -->
                        <ul class="comment-wrap list-unstyled">
                            <!-- No comments yet -->
                            <li class="text-center text-muted small py-3">
                                No comments yet. Be the first to comment!
                            </li>
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
                        <p class="text-muted mb-0">This forum doesn't have any topics yet. Topics will appear here once they are created by forum administrators.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 