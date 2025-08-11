<!-- Main content START -->
     <!-- Story START -->
    <div class="d-flex gap-2 mb-3">
        
      <div class="position-relative" id="openAddStoryModal">
  <div class="card border border-2 border-dashed h-150px px-4 px-sm-5 shadow-none d-flex align-items-center justify-content-center text-center">
    <div>
      <a class="stretched-link btn btn-light rounded-circle icon-md" href="javascript:void(0);">
        <i class="fa-solid fa-plus"></i>
      </a>
      <h6 class="mt-2 mb-0 small">Post a Story</h6>
    </div>
  </div>
</div>

        <!-- Stories -->
        <div id="stories" class="storiesWrapper stories-square stories user-icon carousel scroll-enable"></div>
    </div>
    <!-- Story END -->
        <!-- Share feed START -->
    <div class="card card-body mb-3">
        <div class="d-flex mb-3">
            <!-- Avatar -->
            <div class="avatar avatar-xs me-2">
                <a href="{{ route('user.profile.data', ['id' => $user->id]) }}"> <img class="avatar-img rounded-circle" src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}"
                        alt="" loading="lazy" decoding="async"> </a>
            </div>
            <!-- Post input -->
            <form class="w-100">
                <textarea class="form-control pe-4 border-0" rows="2" data-autoresize=""
                    placeholder="Share your thoughts..." data-bs-toggle="modal"
                    data-bs-target="#feedActionPhoto"></textarea>
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
    <div class="card mb-3">
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
        $created_by = $post->member->name;

        // Optional: if you have a group detail page
        $profileLink =  route('user.profile.data', ['id' => $post->member->id]);

        $groupLink = route('user.group-post',['id' =>$post->group_id]);
    } else {
        // Member/user post
        $member = $post->member ?? null;

        $profileImage = $member && $member->profile_pic
            ? asset('storage/' . $member->profile_pic)
            : asset('feed_assets/images/avatar/07.jpg');

        $displayName = $member->name ?? 'Unknown';
        $designation = $member->designation ?? 'Unknown';
        $profileLink = route('user.profile.data', ['id' => $member->id]);

    }
@endphp

<!-- Info -->
 <div class="d-flex align-items-center">
    <!-- Avatar -->
    <div class="me-4 flex-shrink-0 avatar">

    @if($post->type === 'group_post')
        <a href="{{ $groupLink }}">
            <img src="{{ $profileImage }}" alt="Group Picture"
                 class="img-fluid avatar-img rounded-circle" loading="lazy" decoding="async">
        </a>
    @else
        <a href="{{ $profileLink }}">
            <img src="{{ $profileImage }}" alt="Profile Picture"
                 class="img-fluid avatar-img rounded-circle" loading="lazy" decoding="async">
        </a>
    @endif
    </div>

    <!-- Text content -->
    <div>
        <!-- Name -->
         @if($post->type === 'group_post')
        <h6 class="mb-1">
           <i class="fa-solid fa-users fa-fw pe-2"></i> <a href="{{ $groupLink }}">{{ $displayName }}</a>
        </h6>
        @else
        <h6 class="mb-1">
            <a href="{{ $profileLink }}" class="text-dark">{{ $displayName }}</a>
        </h6>
        @endif
        

        <!-- Group post info + Time -->
        @php
            $createdAt = \Carbon\Carbon::parse($post->created_at)->setTimezone('Asia/Kolkata');
            $now = \Carbon\Carbon::now('Asia/Kolkata');
            $diff = $createdAt->diff($now);
            if ($diff->y > 0) {
                $timeDiff = $diff->y . 'y';
            } elseif ($diff->m > 0) {
                $timeDiff = $diff->m . 'mo';
            } elseif ($diff->d > 0) {
                $timeDiff = $diff->d . 'd';
            } elseif ($diff->h > 0) {
                $timeDiff = $diff->h . 'hr';
            } elseif ($diff->i > 0) {
                $timeDiff = $diff->i . 'min';
            } else {
                $timeDiff = 'Just now';
            }
        @endphp

        @if($post->type === 'group_post')
            <p class="mb-1">
                Group Post | <i class="bi bi-person-fill"></i><a  class="text-dark" href="{{ $profileLink }}">{{ $created_by }}</a>
            </p>
        @else
        <!-- Designation -->
        <p class="mb-0">
            {{ $designation }}
        </p>
        @endif
    </div>
</div>

                </div>
                <div class="dropdown">
                                <a href="#" class="text-secondary py-1 px-2" id="cardFeedAction" data-bs-toggle="dropdown" aria-expanded="false">
                                   {{ $timeDiff }} <i class="bi bi-caret-down fa-fw pe-2"></i>
                                </a>
<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardFeedAction">
    <li>
        <a class="dropdown-item" href="#">
            <i class="bi bi-pen fa-fw pe-2"></i>Edit post
        </a>
    </li>
    <li>
        <a class="dropdown-item " href="#">
            <i class="bi bi-trash fa-fw pe-2"></i>Delete post
        </a>
    </li>
</ul>


                            </div>

            </div>
        </div>
        <!-- Card header END -->
        <!-- Card body START -->
        <div class="card-body">
@php
    $fullContent = strip_tags($post->content);
    $wordCount = str_word_count($fullContent);
@endphp

@if ($wordCount > 50)
    <div x-data="{ expanded: false }">
        <p x-show="!expanded">
            {{ \Illuminate\Support\Str::words($fullContent, 50, '...') }}
            <a href="#" @click.prevent="expanded = true" class="text-danger">Read more</a>
        </p>
        <p x-show="expanded" x-cloak>
            {!! nl2br(e($post->content)) !!}
            <a href="#" @click.prevent="expanded = false" class="text-danger">Show less</a>
        </p>
    </div>
@else
    <p>{!! nl2br(e($post->content)) !!}</p>
@endif

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
                <iframe height="315" src="{{ $post->video_link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
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
                    <img src="{{ asset('storage/' . $imageMedia[0]->file_path) }}" class="w-100 rounded"
                        alt="Post Image" style="width: 100%; height: 400px;object-fit: cover;" loading="lazy" decoding="async">
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

                        <li>
<a class="dropdown-item copy-url-btn" href="javascript:void(0)"
                                data-url="{{-- url('/user/profile/' . $member->id) --}}">
                                <i class="bi bi-link fa-fw pe-2"></i>Copy link to post
                            </a>
                            </li>
                    </ul>
                </li>
                <!-- Card share action END -->
            </ul>
            <div class="d-flex mb-3">
                <!-- Avatar -->
                <div class="avatar avatar-xs me-2">
                    <a href="{{ route('user.profile.data', ['id' => $user->id]) }}"> <img class="avatar-img rounded-circle"
                            src="{{asset('storage/'.$user->profile_pic)}}" alt="" loading="lazy" decoding="async"> </a>
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
                {{--@foreach ($post->comments as $comment)--}}
                @foreach ($post->comments->take(2) as $comment)
                <li class="comment-item mb-3" id="comment-{{ $comment->id }}">
                    <div class="d-flex position-relative">
                        <!-- Avatar -->
                        <div class="avatar avatar-xs">
                            <!-- <a href="#!"><img class="avatar-img rounded-circle"
                                   src="${comment.member && comment.member.profile_pic ? '/storage/' + comment.member.profile_pic : '/feed_assets/images/avatar/07.jpg'}"
                                    alt="" loading="lazy" decoding="async"></a> -->

                                    <a href="{{ $comment->member ? route('user.profile.data', ['id' => $comment->member->id]) : '#' }}">
                                        <img class="avatar-img rounded-circle"
                                             src="{{ $comment->member && $comment->member->profile_pic ? asset('storage/' . $comment->member->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}"
                                             alt="" loading="lazy" decoding="async">
                                    </a>
                        </div>
                        <div class="ms-2 w-100">
                            <!-- Comment by -->
                            <div class="bg-light rounded-start-top-0 p-3 rounded">
                                <div class="d-flex justify-content-between">
                                    <h6 class="mb-1"> <a href="#!"> {{ $comment->member->name ?? 'Anonymous' }} </a>
                                    </h6>
                                    <small class="ms-2">{{$comment->created_at->diffForHumans()}}</small>
                                </div>
                                <p class="small mb-0" id="comment-text-{{ $comment->id }}">{{ $comment->comment }}</p>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <a href="#!" class="text-secondary small me-2">Like</a>
                                    <a href="#!" class="text-secondary small">Reply</a>
                                </div>
                                <div class="col-6 text-end">
                                    @if(auth()->guard('user')->id() === $comment->member_id)
                            <button class="btn btn-sm btn-link p-0 text-primary edit-comment-btn"
                                data-comment-id="{{ $comment->id }}" data-comment="{{ $comment->comment }}"
                                type="button"><i class="bi bi-pencil-fill"></i></button>
                            @endif
                            @if(auth()->guard('user')->id() === $comment->member_id)
                            <button class="btn btn-sm btn-link p-0 text-danger delete-comment-btn"
                                data-comment-id="{{ $comment->id }}" type="button"><i class="bi bi-trash-fill"></i></button>
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
          <textarea name="comment" id="editCommentText" class="form-control" rows="3"></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Add Story Modal -->
<div class="modal fade" id="addStoryModal" tabindex="-1" aria-labelledby="addStoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
      <form action="{{ route('user.stories.store') }}" method="POST" enctype="multipart/form-data" id="storyForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="addStoryModalLabel">Add New Story</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          @error('story_file')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
          <!--<div class="mb-3">
            <label for="story_file" class="form-label">Select Story (Image, Video or PDF)</label>
            <input type="file" class="form-control" name="story_file" id="story_file" accept=".jpg,.jpeg,.png,.mp4,.mov,.pdf" required>
            <small class="text-muted d-block mt-2" id="fileInfo">Max 10MB. Allowed types: JPG, PNG, MP4, MOV, PDF.</small>
            <div class="text-danger mt-2" id="fileError"></div>
          </div>-->
      <div class="mb-3">
            <label for="story_file" class="form-label">Select Story (Image or Video)</label>
            <input type="file" class="form-control" name="story_file" id="story_file"
                accept=".jpg,.jpeg,.png,.webp,.gif,.svg,.mp4,.mov,.avi" required>
            <small class="text-muted d-block mt-2" id="fileInfo">Max 10MB. Allowed types: JPG, PNG, WebP, GIF, SVG, MP4, MOV, AVI.</small>
            <div class="text-danger mt-2" id="fileError"></div>
        </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Upload Story</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Add Story Modal -->


<!-- Direct Message Modal -->
<div class="modal fade" id="directMessageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{-- route('messages.send') --}}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Send Direct Message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="user_id" id="messageUserId">
          <textarea name="message" class="form-control" rows="3" placeholder="Write your message..." required></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Send</button>
        </div>
      </div>
    </form>
  </div>
 </div>
<!-- Direct Message Modal end -->

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
/*document.getElementById('openAddStoryModal').addEventListener('click', function () {
    var myModal = new bootstrap.Modal(document.getElementById('addStoryModal'));
    myModal.show();
});
*/

document.getElementById('openAddStoryModal').addEventListener('click', function () {
    const fileInput = document.getElementById('story_file');
    const fileError = document.getElementById('fileError');
    const fileInfo = document.getElementById('fileInfo');
    const form = document.getElementById('storyForm');

    fileInput.value = '';
    fileError.innerText = '';
    fileInfo.innerText = '';
    form.reset(); // optional if there are other fields

    var myModal = new bootstrap.Modal(document.getElementById('addStoryModal'));
    myModal.show();
});
// end storie modal




 document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.copy-url-btn').forEach(function (el) {
        el.addEventListener('click', function (e) {
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
     document.querySelectorAll('.send-direct-message-btn').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const userId = this.getAttribute('data-user-id');
            document.getElementById('messageUserId').value = userId;

            // Show modal
            let modal = new bootstrap.Modal(document.getElementById('directMessageModal'));
            modal.show();
        });
    });

    // Share to News Feed
    document.querySelectorAll('.share-to-feed-btn').forEach(function (el) {
        el.addEventListener('click', function (e) {
            e.preventDefault();
            const postId = el.getAttribute('data-post-id');
            // Trigger share modal or prefill content logic here
            alert('Open share-to-feed modal for post ID: ' + postId);
        });
    });






document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.edit-comment-btn').forEach(button => {
        button.addEventListener('click', function () {
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
        body: JSON.stringify({ comment: newComment })
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


document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.load-more-comments').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
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
                                            alt="" loading="lazy" decoding="async"></a>
                                    </div>
                                    <div class="ms-2 w-100">
                                        <div class="bg-light rounded-start-top-0 p-3 rounded">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="mb-1"><a href="#!">${comment.member?.name || 'Anonymous'}</a></h6>
                                                <small class="ms-2">${comment.created_at_human || comment.created_at || ''}</small>
                                            </div>
                                            <p class="small mb-0">${comment.comment}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>`;
                    });

                    btn.closest('.card-footer').insertAdjacentHTML('beforebegin', commentHtml);
                    btn.dataset.offset = offset + data.comments.length;
                })
                .catch(err => {
                    spinner.classList.add('d-none');
                    console.error('Failed to load comments:', err);
                });
        });
    });
});

/*

     document.addEventListener("DOMContentLoaded", function () {
    let currentTime = Math.floor(Date.now() / 1000); // current time in seconds

    let storiesData = [
        @foreach($storiesByMember as $memberId => $memberStories)
            @php
                $first = $memberStories->first();
                $user = $first->user;
                 $storyImage = $first->story_image ?? null;
                $lastTimestamp = \Carbon\Carbon::parse($memberStories->max('created_at'))->timestamp;

            @endphp
        {
            id: "member-{{ $memberId }}",
            //photo: "{{ asset($user->profile_pic ? 'storage/' . $user->profile_pic : 'feed_assets/images/avatar/08.jpg') }}",
           photo: "{{ asset($storyImage ? 'storage/' . $storyImage : 'feed_assets/images/avatar/08.jpg') }}",
            name: "{{ addslashes($user->name) }}",
            link: "#",
            lastUpdated: {{ $lastTimestamp }},
            items: [
                @foreach($memberStories as $story)
                {
                    id: "story-{{ $story->id }}",
                    type: "photo",
                    length: 5,
                    src: "{{ asset('storage/' . $story->story_image) }}",
                    preview: "{{ asset('storage/' . $story->story_image) }}",
                    link: "#",
                    linkText: "View",
                    time: {{ \Carbon\Carbon::parse($story->created_at)->timestamp }}
                }@if(!$loop->last),@endif
                @endforeach
            ]
        }@if(!$loop->last),@endif
        @endforeach
    ];

    // Filter stories created within the last 24 hours
   let filteredStories = storiesData.filter(story => {
        return currentTime - story.lastUpdated <= 86400;
    });




    initZuckStories(filteredStories);
});
*/

document.addEventListener("DOMContentLoaded", function () {
    let currentTime = Math.floor(Date.now() / 1000); // current time in seconds

        @php
            $myUserId = Auth::guard('user')->id();
        @endphp

    let storiesData = [
    //First: MY stories
    @if(isset($storiesByMember[$myUserId]))
        @php
            $myFirst = $storiesByMember[$myUserId]->first();
            $myUser = $myFirst->user;
            $myStoryImage = $myFirst->story_image ?? null;
        @endphp

        @php
    $isVideo = in_array(pathinfo($story->story_image, PATHINFO_EXTENSION), ['mp4', 'webm']);
    $previewImage = $isVideo
        ? 'storage/thumbnails/' . pathinfo($story->story_image, PATHINFO_FILENAME) . '.jpg'
        : 'storage/' . $story->story_image;
@endphp
        {
            id: "member-{{ $myUserId }}",
            photo: "{{ asset($myStoryImage ? 'storage/' . $myStoryImage : 'feed_assets/images/avatar/08.jpg') }}",
            name: "{{ addslashes($myUser->name) }}",
            // link: "#", // REMOVE
            items: [
                @foreach($storiesByMember[$myUserId] as $story)
                {
                    id: "story-{{ $story->id }}",
                    //type: "photo",
                    type: "{{ in_array(pathinfo($story->story_image, PATHINFO_EXTENSION), ['mp4', 'webm']) ? 'video' : 'photo' }}",
                   // length: 5,
                   length: {{ in_array(pathinfo($story->story_image, PATHINFO_EXTENSION), ['mp4', 'webm']) ? 15 : 5 }},
                    src: "{{ asset('storage/' . $story->story_image) }}",
                   // preview: "{{ asset('storage/' . $story->story_image) }}",
                   preview: "{{ asset($previewImage) }}",
                    // link: "#", // REMOVE
                    // linkText: "View", // REMOVE
                    time: {{ \Carbon\Carbon::parse($story->created_at)->timestamp }}
                }@if(!$loop->last),@endif
                @endforeach
            ]
        },
    @endif

         //Second: Other stories
    @foreach($storiesByMember as $memberId => $memberStories)
        @continue($memberId == $myUserId)
        @php
            $first = $memberStories->first();
            $user = $first->user;
            $storyImage = $first->story_image ?? null;
        @endphp

@php
    $isVideo = in_array(pathinfo($story->story_image, PATHINFO_EXTENSION), ['mp4', 'webm']);
    $previewImage = $isVideo
        ? 'storage/thumbnails/' . pathinfo($story->story_image, PATHINFO_FILENAME) . '.jpg'
        : 'storage/' . $story->story_image;
@endphp
        {
            id: "member-{{ $memberId }}",
            photo: "{{ asset($storyImage ? 'storage/' . $storyImage : 'feed_assets/images/avatar/08.jpg') }}",
            name: "{{ addslashes($user->name) }}",
            // link: "#", // REMOVE
            items: [
                @foreach($memberStories as $story)
                {
                    id: "story-{{ $story->id }}",
                  //  type: "photo",
                  //type: "{{ in_array(pathinfo($story->story_image, PATHINFO_EXTENSION), ['mp4', 'webm']) ? 'video' : 'photo' }}",
                    //length: 5,
                    length: {{ in_array(pathinfo($story->story_image, PATHINFO_EXTENSION), ['mp4', 'webm']) ? 15 : 5 }},
                    src: "{{ asset('storage/' . $story->story_image) }}",
                    //preview: "{{ asset('storage/' . $story->story_image) }}",
                    preview: "{{ asset($previewImage) }}",
                    // link: "#", // REMOVE
                    // linkText: "View", // REMOVE
                    time: {{ \Carbon\Carbon::parse($story->created_at)->timestamp }}
                }@if(!$loop->last),@endif
                @endforeach
            ]
        }@if(!$loop->last),@endif
    @endforeach
];

    // ✅g Filter stories and items that are still valid (not expired after 2 hours)
    let filteredStories = storiesData
        .map(story => {
            story.items = story.items.filter(item => currentTime - item.time <= 7200);
            return story;
        })
        .filter(story => story.items.length > 0); // remove users with all expired stories

    initZuckStories(filteredStories);
});

// delete stories
function deleteStory(storyId) {
        fetch(`{{ route('user.stories.destroy', ['id' => '__ID__']) }}`.replace('__ID__', storyId), {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert("Story deleted");
                location.reload(); // Or re-render without reload
            } else {
                alert("Failed to delete story");
            }
        })
        .catch(err => console.error("Error deleting story:", err));
    }





 document.addEventListener("DOMContentLoaded", function () {
        GLightbox({
            selector: '.glightbox'
        });
    });

</script>

<!-- edit and delete post -->
<!-- Edit Post Modal -->
<div class="modal fade" id="editPostModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editPostForm">
      @csrf
      @method('PUT')
      <input type="hidden" id="editPostId" name="post_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <textarea name="content" id="editPostContent" class="form-control" rows="4"></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update Post</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- edit and delete post end -->

<script>
$(document).ready(function() {

    // Edit Post
    $('.edit-post').on('click', function(e) {
        e.preventDefault();
        const postId = $(this).data('id');

        // Fetch post data via AJAX
        $.ajax({
            url: `/posts/${postId}/edit`,
            type: 'GET',
            success: function(response) {
                // Populate modal fields
                $('#editPostModal #editPostContent').val(response.content);
                $('#editPostModal #editPostId').val(postId);
                $('#editPostModal').modal('show');
            },
            error: function() {
                alert('Error fetching post details.');
            }
        });
    });

    // Delete Post
    $('.delete-post').on('click', function(e) {
        e.preventDefault();
        const postId = $(this).data('id');

        if (confirm('Are you sure you want to delete this post?')) {
            $.ajax({
                url: `/posts/${postId}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    alert('Post deleted successfully.');
                    location.reload(); // or remove the post from DOM
                },
                error: function() {
                    alert('Failed to delete the post.');
                }
            });
        }
    });

});
</script>

<script>
$('#editPostForm').on('submit', function(e) {
    e.preventDefault();

    const postId = $('#editPostId').val();
    const content = $('#editPostContent').val();

    $.ajax({
        url: `/posts/${postId}`,
        type: 'PUT',
        data: {
            _token: '{{ csrf_token() }}',
            content: content
        },
        success: function() {
            $('#editPostModal').modal('hide');
            alert('Post updated successfully.');
            location.reload(); // or update content in DOM
        },
        error: function() {
            alert('Failed to update post.');
        }
    });
});


$(document).ready(function () {
    $('.commentForm').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let postId = form.data('post-id');
        let textarea = form.find('.commentInput');
        let errorDiv = form.find('.comment-error');
        errorDiv.text(''); // clear previous errors

        if ($.trim(textarea.val()) === '') {
            errorDiv.text('Comment is required.');
            textarea.focus();
            return false;
        }

        let formData = form.serialize(); // serialize form data

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: formData,
            success: function (response) {
                if (response.status === 'success') {
                    textarea.val(''); // clear comment box
                    errorDiv.removeClass('text-danger').addClass('text-success').text('Comment added successfully!');

                    // Optionally append to comment list
                    // $('#comment-list-' + postId).append(`<div><strong>You:</strong> ${response.comment.comment}</div>`);
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON?.errors?.comment) {
                    errorDiv.text(xhr.responseJSON.errors.comment[0]);
                } else {
                    errorDiv.text('An error occurred.');
                }
            }
        });
    });
});

</script>




@endsection
