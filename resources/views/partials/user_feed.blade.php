<!-- Main content START -->
<div class="col-md-8 col-lg-6 vstack gap-4">

    <!-- Story START -->
    <div class="d-flex gap-2 mb-n3">
        <div class="position-relative">
            <div
                class="card border border-2 border-dashed h-150px px-4 px-sm-5 shadow-none d-flex align-items-center justify-content-center text-center">
                <div>
                    <a class="stretched-link btn btn-light rounded-circle icon-md" href="#!"><i
                            class="fa-solid fa-plus"></i></a>
                    <h6 class="mt-2 mb-0 small">Post a Story</h6>
                </div>
            </div>
        </div>

        <!-- Stories -->
        <div id="stories" class="storiesWrapper stories-square stories user-icon carousel scroll-enable"></div>
    </div>
    <!-- Story END -->

    <!-- Share feed START -->
    <div class="card card-body">
        <div class="d-flex mb-3">
            <!-- Avatar -->
            <div class="avatar avatar-xs me-2">
                <a href="#"> <img class="avatar-img rounded-circle" src="{{asset('feed_assets/images/avatar/03.jpg')}}"
                        alt=""> </a>
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
            <!-- <li class="nav-item">
                <a class="nav-link bg-light py-1 px-2 mb-0" href="#!" data-bs-toggle="modal"
                    data-bs-target="#feedActionVideo"> <i class="bi bi-camera-reels-fill text-info pe-2"></i>Video</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link bg-light py-1 px-2 mb-0" data-bs-toggle="modal"
                    data-bs-target="#modalCreateEvents"> <i
                        class="bi bi-calendar2-event-fill text-danger pe-2"></i>Event </a>
            </li> -->
            <!-- <li class="nav-item">
							<a class="nav-link bg-light py-1 px-2 mb-0" href="#!" data-bs-toggle="modal" data-bs-target="#modalCreateFeed"> <i class="bi bi-emoji-smile-fill text-warning pe-2"></i>Feeling /Activity</a>
						</li> -->
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
                <iframe width="560" height="315" src="{{ $post->video_link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
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
                    <img src="{{ asset('storage/' . $imageMedia[0]->file_path) }}" loading="lazy" class="w-100"
                        alt="Post Image">
                </a>
            </div>
            @elseif($totalImages > 1)
            <div class="post-img d-flex justify-content-between flex-wrap gap-2 gap-lg-3 mt-2">
                @foreach($imageMedia->take(4) as $index => $media)
                <div class="position-relative" style="width: 48%;">
                    <a href="{{ asset('storage/' . $media->file_path) }}" class="glightbox"
                        data-gallery="post-gallery-{{ $post->id }}">
                        <img src="{{ asset('storage/' . $media->file_path) }}" alt="Post Image" loading="lazy"
                            class="w-100">
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
                        data-url="{{ route('user.post.like', $post->id) }}" data-post-id="{{ $post->id }}"
                        data-bs-toggle="tooltip" data-bs-html="true"
                        data-bs-title="{{ $likeUsersTooltip ?: 'No likes yet' }}">
                        <i class="bi bi-hand-thumbs-up-fill pe-1"></i>
                        <span class="like-label">Like</span>
                        <span class="like-count">{{ $post->likes->count() ? '('.$post->likes->count().')' : '' }}</span>
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
                        <li><a class="dropdown-item" href="#"> <i class="bi bi-envelope fa-fw pe-2"></i>Send via Direct
                                Message</a></li>
                        
                        <li><a class="dropdown-item" href="#"> <i class="bi bi-link fa-fw pe-2"></i>Copy link to
                                post</a></li>
                        
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#"> <i class="bi bi-pencil-square fa-fw pe-2"></i>Share to
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
                    action="{{ route('user.comments.store') }}" method="POST" data-post-id="{{ $post->id }}">
                    @csrf
                    <textarea name="comment" data-autoresize class="form-control pe-5 bg-light" rows="1"
                        placeholder="Add a comment..." id="comments-{{ $post->id }}"></textarea>
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
                                    <h6 class="mb-1"> <a href="#!"> {{ $comment->member->name ?? 'Anonymous' }} </a>
                                    </h6>
                                    <small class="ms-2">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="small mb-0" id="comment-text-{{ $comment->id }}">{{ $comment->comment }}</p>
                            </div>
                            @if(auth()->guard('user')->id() === $comment->member_id)
                            <button class="btn btn-sm btn-link p-0 text-primary edit-comment-btn"
                                data-comment-id="{{ $comment->id }}" data-comment="{{ $comment->comment }}"
                                type="button">Edit</button>
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
    @endforeach
    <!-- Load more button START -->
    <a href="#!" role="button" class="btn btn-loader btn-primary-soft" data-bs-toggle="button" aria-pressed="true">
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
        <form method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <textarea name="comment" class="form-control" rows="3"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>


@section('scripts')
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
$(document).on('click', '.edit-comment-btn', function() {
    const commentId = $(this).data('comment-id');
    const commentText = $(this).data('comment');

    $('#editCommentModal textarea[name="comment"]').val(commentText);
    $('#editCommentModal form').attr('action', `/user/comments/${commentId}`);
    $('#editCommentModal').modal('show');
});
$('#editCommentModal form').on('submit', function(e) {
    e.preventDefault();
    const url = $(this).attr('action');
    const comment = $(this).find('textarea[name="comment"]').val();

    $.ajax({
        url: url,
        type: 'PUT',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            comment: comment
        },
        success: function(response) {
            $('#editCommentModal').modal('hide');
            // optionally reload comment list or update DOM
        },
        error: function() {
            alert('Error updating comment.');
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
</script>

@endsection
