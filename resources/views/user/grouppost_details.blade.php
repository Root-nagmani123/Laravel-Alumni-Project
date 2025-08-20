
@extends('layouts.app')

@section('title', 'Group Post - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')

<div class="container">
    <div class="row g-4" style="margin-top: 100px;">
        @include('partials.left_sidebar')
        <div class="col-9">
            <div class="post-list p-3 rounded mb-4" style="background-color: #af2910; color: #fff;">
                <div class="d-flex justify-content-between align-items-center">
  <h1 class="h5 mb-0 text-white">Group Posts : {{ $group->name }}</h1>

  <div class="dropdown">
    <a href="#" class="text-white btn btn-sm btn-transparent py-0 px-2" data-bs-toggle="dropdown">
      <i class="bi bi-three-dots-vertical"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
      @if($isMentee)
      <li>
        <form action="{{ route('user.group.destroy', $group->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this group?');">
          @csrf
          @method('DELETE')
          <input type="hidden" name="group_id" value="{{ $group->id }}">
          <button type="submit" class="dropdown-item text-danger">
            <i class="bi bi-trash fa-fw pe-2"></i>Delete Group
          </button>
        </form>
      </li>
      @else
      <li>
        <form action="{{ route('user.groups.leave') }}" method="POST" onsubmit="return confirm('Are you sure you want to leave this group?');">
          @csrf
          <input type="hidden" name="group_id" value="{{ $group->id }}">
          <button type="submit" class="dropdown-item text-danger">
            <i class="bi bi-arrow-bar-right fa-fw pe-2"></i>Leave Group
          </button>
        </form>
      </li>
      @endif
    </ul>
  </div>
</div>

<!-- Member Count Trigger -->
<div class="mt-2">
  <a href="#membersCard-{{ $group->id }}" class="text-white small" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="membersCard-{{ $group->id }}">
    {{ count($grp_members) }} Members
  </a>
</div>




            </div>
            <!-- group member details -->

<div class="collapse mt-3 mb-3" id="membersCard-{{ $group->id }}">
  <div class="card">
    <div class="card-header border-0 pb-0">
      <h5 class="card-title">Group Members</h5>
    </div>
    <div class="card-body" style="max-height: 400px; overflow-y: auto;">

      @foreach($grp_members as $member)
      <!-- Member Item -->
      <div class="d-md-flex align-items-center mb-4">
        <!-- Avatar -->
        <div class="avatar me-3 mb-3 mb-md-0">
             @php
    $defaultImage = asset('feed_assets/images/avatar/07.jpg');
    $profileImage = $defaultImage;

    if ($member->profile_pic && file_exists(public_path('storage/' . $member->profile_pic))) {
        $profilePicPath = public_path('storage/' . $member->profile_pic);
        if (file_exists($profilePicPath)) {
            $profileImage = asset('storage/' . $member->profile_pic);
        }
    }
@endphp
          <a href="#!">
            <img class="avatar-img rounded-circle" src="{{ $profileImage }}" alt="">
          </a>
        </div>
        <!-- Info -->
        <div class="w-100">
  <h6 class="mb-0">
    <a href="{{ $member->id ? route('user.profile.data', ['id' => $member->id]) : '#' }}">{{ $member->name }}</a>
  </h6>
  <p class="small text-muted mb-0">
    {{ $member->designation ?? 'N/A' }}
  </p>
</div>

      </div>
      @endforeach
    </div>
  </div>
</div>


            @forelse($posts as $post)
            @php
                $validMedia = $post->media->filter(function($media) {
                    return file_exists(storage_path('app/public/' . $media->file_path));
                });
                $imageMedia = $validMedia->where('file_type', 'image')->values();
                $totalImages = $imageMedia->count();
            @endphp

            <div class="card mb-4">
               @php
    $defaultImage = asset('feed_assets/images/avatar/07.jpg');
    $profileImage = $defaultImage;

    if ($post->member && $post->member->profile_pic) {
        $profilePicPath = public_path('storage/' . $post->member->profile_pic);
        if (file_exists($profilePicPath)) {
            $profileImage = asset('storage/' . $post->member->profile_pic);
        }
    }
@endphp

<div class="card-header border-0 pb-0">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <!-- Avatar -->
            <div class="avatar me-2">
                <a href="{{ $post->member ? url('/user/profile/' . $post->member->id) : '#' }}">
                    <img class="avatar-img rounded-circle" src="{{ $profileImage }}" alt="Profile Picture" loading="lazy" decoding="async">
                </a>
            </div>

            <!-- Name + Time + Designation -->
            <div>
                <div class="nav nav-divider">
                    <h6 class="nav-item card-title mb-0">
                        <a href="{{ $post->member ? url('/user/profile/' . $post->member->id) : '#' }}">
                            {{ $post->member->name ?? 'Anonymous' }}
                        </a>
                    </h6>
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
        $timeDiff = $diff->h . 'h';
    } elseif ($diff->i > 0) {
        $timeDiff = $diff->i . 'min';
    } else {
        $timeDiff = 'Just now';
    }
@endphp

<span class="nav-item small">{{ $timeDiff }}</span>

                    
                </div>
                <p class="mb-0 small">{{ $post->member->designation ?? 'Member' }}</p>
            </div>
        </div>

        <!-- Delete Button (if owner) -->
        @if($post->member && $post->member->id === auth('user')->id())
        <div class="dropdown">
                        <a href="#" class="btn btn-sm btn-transparent py-0 px-2" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form action="{{ route('user.group.post.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-decoration-none ms-2 border-0 bg-transparent d-flex align-items-center gap-2 text-danger">
                        <i class="bi bi-trash"></i> Delete Post
                    </button>
                </form>
                            </li>
                        </ul>
                    </div>
        @endif
    </div>
</div>

                <div class="card-body">
                    <p>{{ \Illuminate\Support\Str::words(strip_tags($post->content), 50, '...') }}</p>
                    @if($totalImages === 1)
                        <a href="{{ asset('storage/' . $imageMedia[0]->file_path) }}" class="glightbox" data-gallery="post-gallery-{{ $post->id }}">
                            <img class="card-img" src="{{ asset('storage/' . $imageMedia[0]->file_path) }}" alt="Post" style="max-height: 400px; object-fit: cover;" loading="lazy" decoding="async">
                        </a>
                    @elseif($totalImages > 1)
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($imageMedia->take(4) as $index => $media)
                            <div class="position-relative" style="width: 48%;">
                                <a href="{{ asset('storage/' . $media->file_path) }}" class="glightbox" data-gallery="post-gallery-{{ $post->id }}">
                                    <img src="{{ asset('storage/' . $media->file_path) }}" class="img-fluid rounded" alt="Post Image" style="max-height: 400px; object-fit: cover;" loading="lazy" decoding="async">
                                </a>
                                @if($index === 3 && $totalImages > 4)
                                    @foreach($imageMedia->slice(4) as $extra)
                                        <a href="{{ asset('storage/' . $extra->file_path) }}" class="glightbox d-none" data-gallery="post-gallery-{{ $post->id }}"></a>
                                    @endforeach
                                    <a href="{{ asset('storage/' . $imageMedia[4]->file_path) }}" class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white glightbox" style="background-color: rgba(0,0,0,0.6); font-size: 2rem;">
                                        +{{ $totalImages - 4 }}
                                    </a>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    @endif

                    @if($post->media_type == 'video' && $post->video_link)
                    <div class="mt-3">
                        <iframe width="100%" height="200" src="{{ $post->video_link }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                    @endif

                    <!-- Reaction Section -->
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
                                <span class="comment-count">{{ $post->comments->count() ? '(' . $post->comments->count() . ')' : '' }}</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown ms-sm-auto">
                            <a class="nav-link mb-0" href="#" id="cardShareAction" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-reply-fill flip-horizontal ps-1"></i> Share
                                {{ $post->shares ? '('.$post->shares->count().')' : '' }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardShareAction">
                                <li>
                                    <a class="dropdown-item copy-url-btn" href="javascript:void(0)"
                                        data-url="{{ url()->current() . '#post-' . $post->id }}">
                                        <i class="bi bi-link fa-fw pe-2"></i>Copy link to post
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Comment box -->
                    <div class="d-flex mb-3">
                        <div class="avatar avatar-xs me-2">
                            <a href="{{ route('user.profile', ['id' => Auth::guard('user')->id()]) }}">
    <img class="avatar-img rounded-circle"
         src="{{ Auth::guard('user')->user()->profile_pic 
                ? asset('storage/' . Auth::guard('user')->user()->profile_pic) 
                : asset('feed_assets/images/avatar/07.jpg') }}"
         alt="User" loading="lazy" decoding="async">
</a>

                        </div>
                        <form class="nav nav-item w-100 position-relative commentForm" id="commentForm-{{ $post->id }}"
                            action="{{ route('user.comments.store') }}" method="POST" data-post-id="{{ $post->id }}">
                            @csrf
                            <textarea name="comment" class="form-control pe-5 bg-light commentInput" rows="1"
                                placeholder="Add a comment..." id="comments-{{ $post->id }}"></textarea>
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <button
                                class="nav-link bg-transparent px-3 position-absolute top-50 end-0 translate-middle-y border-0"
                                type="submit">
                                <i class="bi bi-send-fill"></i>
                            </button>
                            <div class="comment-error text-danger"></div>
                        </form>
                    </div>
                    <ul class="comment-wrap list-unstyled">
    @foreach ($post->comments as $comment)
        <li class="comment-item mb-3" id="comment-{{ $comment->id }}">
            <div class="d-flex position-relative">
                <div class="avatar avatar-xs">
                    <a href="{{ $comment->member ? url('/user/profile/' . $comment->member->id) : '#' }}">
                        <img class="avatar-img rounded-circle"
                            src="{{ $comment->member && $comment->member->profile_pic ? asset('storage/' . $comment->member->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}"
                            alt="" loading="lazy" decoding="async">
                    </a>
                </div>
                <div class="ms-2 w-100">
                    <div class="bg-light rounded-start-top-0 p-3 rounded">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-1">
                                <a href="{{ $comment->member ? url('/user/profile/' . $comment->member->id) : '#' }}">
                                    {{ $comment->member->name ?? 'Anonymous' }}
                                </a>
                            </h6>
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

                            <span class="nav-item small">{{ $timeDiff }}</span>
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
                                <button class="btn btn-sm btn-link p-0 text-danger delete-comment-btn"
                                    data-comment-id="{{ $comment->id }}" type="button"><i class="bi bi-trash-fill"></i></button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>

                </div>
            </div>
            @empty
            <p>No posts found for this group.</p>
            @endforelse
        </div>
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

$(document).on('click', '.copy-url-btn', function () {
    const url = $(this).data('url');
    navigator.clipboard.writeText(url).then(() => {
        alert('Link copied to clipboard!');
    }).catch(err => {
        console.error('Failed to copy: ', err);
    });
});

$(document).on('click', '.edit-comment-btn', function () {
    const commentId = $(this).data('comment-id');
    const commentText = $(this).data('comment');
    const commentDiv = $(`#comment-text-${commentId}`);
    commentDiv.html(`
        <input type="text" id="edit-input-${commentId}" class="form-control form-control-sm mb-1" value="${commentText}">
        <button class="btn btn-sm btn-success" onclick="saveEditedComment(${commentId})">Update</button>
        <button class="btn btn-sm btn-danger" onclick="cancelEdit(${commentId}, '${commentText.replace(/'/g, "\\'")}')">Cancel</button>
    `);
});

function cancelEdit(id, originalText) {
    $(`#comment-text-${id}`).text(originalText);
}

function saveEditedComment(id) {
    const newComment = $(`#edit-input-${id}`).val();
    $.ajax({
        url: `/user/comments/${id}`,
        type: 'PUT',
        data: {
            _token: '{{ csrf_token() }}',
            comment: newComment
        },
        success: function(data) {
            if (data.success) {
                $(`#comment-text-${id}`).text(newComment);
            } else {
                alert(data.message || 'Failed to update comment');
            }
        },
        error: function() {
            alert('An error occurred while editing the comment.');
        }
    });
}

$(document).ready(function () {
    $('.commentForm').on('submit', function (e) {
        e.preventDefault();
        let form = $(this);
        let postId = form.data('post-id');
        let textarea = form.find('.commentInput');
        let errorDiv = form.find('.comment-error');
        errorDiv.text('');
        if ($.trim(textarea.val()) === '') {
            errorDiv.text('Comment is required.');
            textarea.focus();
            return false;
        }
        let formData = form.serialize();
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: formData,
            success: function (response) {
                if (response.status === 'success') {
                    textarea.val('');
                    errorDiv.removeClass('text-danger').addClass('text-success').text('Comment added successfully!');
                    // Optionally append to comment list
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

document.addEventListener("DOMContentLoaded", function () {
    GLightbox({ selector: '.glightbox' });
});
$(document).on('submit', '.comment-form', function(e) {
    e.preventDefault();

    let form = $(this);
    let postId = form.data('post-id');
    let input = form.find('input[name="comment"]');
    let commentText = input.val();

    $.ajax({
        url: '/post/' + postId + '/comment',
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            comment: commentText
        },
        success: function(response) {
            if (response.success) {
                // Build comment HTML
                let newComment = `
                <li class="comment-item mb-3" id="comment-${response.comment.id}">
                    <div class="d-flex position-relative">
                        <div class="avatar avatar-xs">
                            <a href="/user/profile/${response.comment.member.id}">
                                <img class="avatar-img rounded-circle"
                                    src="${response.comment.member.profile_pic ? '/storage/' + response.comment.member.profile_pic : '/feed_assets/images/avatar/07.jpg'}"
                                    alt="">
                            </a>
                        </div>
                        <div class="ms-2 w-100">
                            <div class="bg-light rounded-start-top-0 p-3 rounded">
                                <div class="d-flex justify-content-between">
                                    <h6 class="mb-1">
                                        <a href="/user/profile/${response.comment.member.id}">
                                            ${response.comment.member.name}
                                        </a>
                                    </h6>
                                    <span class="nav-item small">${response.timeDiff}</span>
                                </div>
                                <p class="small mb-0">${response.comment.comment}</p>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <a href="#!" class="text-secondary small me-2">Like</a>
                                    <a href="#!" class="text-secondary small">Reply</a>
                                </div>
                                <div class="col-6 text-end">
                                    <button class="btn btn-sm btn-link p-0 text-primary edit-comment-btn"
                                        data-comment-id="${response.comment.id}" 
                                        data-comment="${response.comment.comment}"
                                        type="button"><i class="bi bi-pencil-fill"></i></button>
                                    <button class="btn btn-sm btn-link p-0 text-danger delete-comment-btn"
                                        data-comment-id="${response.comment.id}" type="button"><i class="bi bi-trash-fill"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>`;

                // Append new comment right below post comments
                form.closest('.post').find('.comment-wrap').append(newComment);

                // Clear input
                input.val('');
            }
        }
    });
});

</script>


@endsection