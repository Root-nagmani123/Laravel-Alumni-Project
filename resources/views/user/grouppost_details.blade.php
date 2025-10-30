@extends('layouts.app')

@section('title', 'Group Post - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')

<div class="container">
    <div class="row g-4" style="margin-top: 4rem;">
        @include('partials.left_sidebar')
        <div class="col-9">
            <div class="post-list p-3 rounded mb-4" style="background-color: #af2910; color: #fff;">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <h1 class="h5 mb-0 text-white flex-grow-1">
                            Group Posts: {{ $group->name ?? '' }}
                        </h1>

                        @if($group->member_type == 2 && $group->created_by == auth()->guard('user')->user()->id)
                        <!-- Edit Button -->
                        <button type="button" class="btn btn-sm btn-light text-primary" data-bs-toggle="modal"
                            data-bs-target="#editGroupModal" title="Edit Group">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        @endif

                        <!-- Delete Button -->
                        {{-- <button type="button" class="btn btn-sm btn-light text-danger" 
            onclick="confirm('Are you sure you want to delete this group?') && $wire.deleteGroup({{ $group->id }})"
                        title="Delete Group">
                        <i class="fa-solid fa-trash"></i>
                        </button> --}}
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editGroupModal" tabindex="-1" aria-labelledby="editGroupModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('group_name_update', $group->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="group_id" value="{{ $group->id }}">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editGroupModalLabel">Edit Group Name</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" class="form-control" value="{{ $group->name }}" name="name"
                                            placeholder="Enter group name">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="dropdown">
                        <a href="#" class="text-white btn btn-sm btn-transparent py-0 px-2" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if($isMentee)
                            <li>
                                <form action="{{ route('user.group.destroy', $group->id ?? '') }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this group?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="group_id" value="{{ $group->id ?? '' }}">
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-trash fa-fw pe-2"></i>Delete Group
                                    </button>
                                </form>
                            </li>
                            @if($group->member_type == 2 && auth()->guard('user')->user()->id == $group->created_by)
                            <li>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                    data-bs-target="#addMembersModal">
                                    <i class="bi bi-plus fa-fw pe-2"></i>Add Members
                                </a>
                            </li>

                            @elseif ($group->member_type == 1 && auth()->guard('user')->user()->id ==
                            $group->created_by)
                            <li>
                                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                    data-bs-target="#addMembersModal">
                                    <i class="bi bi-plus fa-fw pe-2"></i>Add Members
                                </a>
                            </li>
                            @else
                            @endif
                            @else
                            <li>
                                <form action="{{ route('user.groups.leave') }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to leave this group?');">
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
                <!-- Member Count Trigger -->
                <div class="mt-2">
                    <a href="javascript:void(0);" class="text-white small popup-modal-open" data-bs-toggle="modal"
                        data-bs-target="#membersModal-{{ $group->id }}">
                        {{ count($grp_members) }} Members
                    </a>
                </div>





            </div>
            <!-- group member details -->



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
                // Old code
                // $defaultImage = asset('feed_assets/images/avatar/07.jpg');
                // $profileImage = $defaultImage;

                // if ($post->member && $post->member->profile_pic) {
                // $profilePicPath = public_path('storage/private/' . $post->member->profile_pic);
                // if (file_exists($profilePicPath)) {
                // // $profileImage = asset('storage/' . $post->member->profile_pic);
                // $profileImage = route('profile.pic', $post->member->profile_pic);
                // }
                // }

                // New code
                $defaultImage = asset('feed_assets/images/avatar/07.jpg');
                $profileImage = $defaultImage;

                if (!empty($post->member?->profile_pic)) {
                    $profilePicPath = storage_path('app/private/' . $post->member->profile_pic);

                    // Use storage_path for private files
                    if (file_exists($profilePicPath)) {
                        // Secure route to access private image
                        $profileImage = route('profile.pic', $post->member->profile_pic);
                    }
                }
                @endphp

                <div class="card-header border-0 pb-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <!-- Avatar -->
                            <div class="avatar me-2">
                                <a
                                    href="{{ $post->member ? url('/user/profile/' . Crypt::encrypt($post->member->id)) : '#' }}">
                                    <img class="avatar-img rounded-circle" src="{{ $profileImage }}"
                                        alt="Profile Picture" loading="lazy" decoding="async">
                                </a>
                            </div>

                            <!-- Name + Time + Designation -->
                            <div>
                                <div class="nav nav-divider">
                                    <h6 class="nav-item card-title mb-0">
                                        <a
                                            href="{{ $post->member ? url('/user/profile/' . Crypt::encrypt($post->member->id)) : '#' }}">
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
                                    <form action="{{ route('user.group.post.destroy', $post->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-decoration-none ms-2 border-0 bg-transparent d-flex align-items-center gap-2 text-danger">
                                            <i class="bi bi-trash"></i> Delete Post
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <a href="#"
                                        class="text-decoration-none ms-2 border-0 bg-transparent d-flex align-items-center gap-2"
                                        data-bs-toggle="modal" onclick="editGrp_post({{ $post->id }})">
                                        <i class="bi bi-pencil"></i> Edit Post
                                    </a>
                                </li>



                            </ul>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <p>{{ \Illuminate\Support\Str::words(strip_tags($post->content), 50, '...') }}</p>
                    @if($totalImages === 1)
                    <!-- Single Image -->
                    <a href="{{ asset('storage/' . $imageMedia[0]->file_path) }}" class="glightbox"
                        data-gallery="post-gallery-{{ $post->id }}">
                        <img class="w-100 rounded" src="{{ asset('storage/' . $imageMedia[0]->file_path) }}" alt="Post"
                            style="max-height: 500px; object-fit: cover;">
                    </a>

                    @elseif($totalImages === 2)
                    <!-- Two Images Side by Side -->
                    <div class="d-flex gap-2">
                        @foreach($imageMedia->take(2) as $media)
                        <a href="{{ asset('storage/' . $media->file_path) }}" class="glightbox flex-fill"
                            data-gallery="post-gallery-{{ $post->id }}">
                            <img class="w-100 rounded" src="{{ asset('storage/' . $media->file_path) }}" alt="Post"
                                style="height: 300px; object-fit: cover;">
                        </a>
                        @endforeach
                    </div>

                    @elseif($totalImages === 3)
                    <!-- Three Images: 1 big left + 2 stacked right -->
                    <div class="d-flex gap-2">
                        <div class="flex-fill">
                            <a href="{{ asset('storage/' . $imageMedia[0]->file_path) }}" class="glightbox"
                                data-gallery="post-gallery-{{ $post->id }}">
                                <img class="w-100 rounded" src="{{ asset('storage/' . $imageMedia[0]->file_path) }}"
                                    alt="Post" style="height: 400px; object-fit: cover;">
                            </a>
                        </div>
                        <div class="d-flex flex-column gap-2" style="width: 35%;">
                            @foreach($imageMedia->slice(1, 2) as $media)
                            <a href="{{ asset('storage/' . $media->file_path) }}" class="glightbox flex-fill"
                                data-gallery="post-gallery-{{ $post->id }}">
                                <img class="w-100 rounded" src="{{ asset('storage/' . $media->file_path) }}" alt="Post"
                                    style="height: 195px; object-fit: cover;">
                            </a>
                            @endforeach
                        </div>
                    </div>

                    @elseif($totalImages === 4)
                    <!-- Four Images: 2x2 Grid -->
                    <div class="row g-2">
                        @foreach($imageMedia->take(4) as $media)
                        <div class="col-6">
                            <a href="{{ asset('storage/' . $media->file_path) }}" class="glightbox"
                                data-gallery="post-gallery-{{ $post->id }}">
                                <img class="w-100 rounded" src="{{ asset('storage/' . $media->file_path) }}" alt="Post"
                                    style="height: 250px; object-fit: cover;">
                            </a>
                        </div>
                        @endforeach
                    </div>

                    @elseif($totalImages > 4)
                    <!-- More than 4: 2x2 grid + overlay on last -->
                    <div class="row g-2">
                        @foreach($imageMedia->take(4) as $index => $media)
                        <div class="col-6 position-relative">
                            <a href="{{ asset('storage/' . $media->file_path) }}" class="glightbox d-block"
                                data-gallery="post-gallery-{{ $post->id }}">
                                <img class="w-100 rounded" src="{{ asset('storage/' . $media->file_path) }}" alt="Post"
                                    style="height: 250px; object-fit: cover;">
                            </a>

                            @if($index === 3)
                            @foreach($imageMedia->slice(4) as $extra)
                            <a href="{{ asset('storage/' . $extra->file_path) }}" class="glightbox d-none"
                                data-gallery="post-gallery-{{ $post->id }}"></a>
                            @endforeach
                            <div
                                class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50 rounded">
                                <span class="text-white fs-3 fw-bold">+{{ $totalImages - 4 }}</span>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif


                    @if($post->video_link != null)
                    <div class="mt-3">
                        <iframe width="100%" height="200" src="{{ $post->video_link }}" frameborder="0"
                            allowfullscreen></iframe>
                    </div>
                    @endif

                    <!-- Reaction Section -->
                    {{--<ul class="nav nav-stack py-3 small">
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
                    </ul>--}}

                    <!-- Comment box -->
                    {{--<div class="d-flex mb-3">
                        <div class="avatar avatar-xs me-2">
                            <a href="{{ route('user.profile', ['id' => Crypt::encrypt(Auth::guard('user')->id())]) }}">
                    <img class="avatar-img rounded-circle" src="{{ Auth::guard('user')->user()->profile_pic
                                    ? asset('storage/' . Auth::guard('user')->user()->profile_pic)
                                    : asset('feed_assets/images/avatar/07.jpg') }}" alt="User" loading="lazy"
                        decoding="async">
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
                            <a
                                href="{{ $comment->member ? url('/user/profile/' . Crypt::encrypt($comment->member->id)) : '#' }}">
                                <img class="avatar-img rounded-circle"
                                    src="{{ $comment->member && $comment->member->profile_pic ? asset('storage/' . $comment->member->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}"
                                    alt="" loading="lazy" decoding="async">
                            </a>
                        </div>
                        <div class="ms-2 w-100">
                            <div class="bg-light rounded-start-top-0 p-3 rounded">
                                <div class="d-flex justify-content-between">
                                    <h6 class="mb-1">
                                        <a
                                            href="{{ $comment->member ? url('/user/profile/data/' .  Crypt::encrypt($comment->member->id)) : '#' }}">
                                            {{ $comment->member->name ?? 'Anonymous' }}
                                        </a>
                                    </h6>
                                    @php
                                    $createdAt =
                                    \Carbon\Carbon::parse($comment->created_at)->setTimezone('Asia/Kolkata');
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
                                    <button class="btn btn-sm btn-link p-0 text-primary edit-comment-btn"
                                        data-comment-id="{{ $comment->id }}" data-comment="{{ $comment->comment }}"
                                        type="button"><i class="bi bi-pencil-fill"></i></button>
                                    <button class="btn btn-sm btn-link p-0 text-danger delete-comment-btn"
                                        data-comment-id="{{ $comment->id }}" type="button"><i
                                            class="bi bi-trash-fill"></i></button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>--}}

        </div>

    </div>
    @empty
    <p>No posts found for this group.</p>
    @endforelse
</div>
</div>
</div>
<!-- Members Modal -->

<div class="modal fade" id="membersModal-{{ $group->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Group Members ({{ count($grp_members) }})</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- Search Box -->
                <div class="mb-3">
                    <input type="text" class="form-control member-search" placeholder="Search members..."
                        data-target="member-list-{{ $group->id }}">
                </div>

                <!-- Members List -->
                <div id="member-list-{{ $group->id }}">
                    @php
                    $sortedMembers = collect($grp_members)->sort(function ($a, $b) use ($group) {
                    // ✅ Creator always comes first
                    if ($a->id == $group->created_by) return -1;
                    if ($b->id == $group->created_by) return 1;

                    // ✅ Otherwise sort by name (case-insensitive)
                    return strcasecmp($a->name, $b->name);
                    });
                    @endphp


                    @foreach($sortedMembers as $member)

                    <div class="d-md-flex align-items-center mb-3 member-item">
                        <!-- Avatar -->
                        <div class="avatar me-3 mb-3 mb-md-0">
                            @php
                            $defaultImage = asset('feed_assets/images/avatar/07.jpg');
                            $profileImage = $defaultImage;
                            if ($member->profile_pic && file_exists(public_path('storage/' . $member->profile_pic))) {
                            $profileImage = asset('storage/' . $member->profile_pic);
                            }
                            @endphp
                            <a
                                href="{{ $member->id ? route('user.profile.data', ['id' => Crypt::encrypt($member->id)]) : '#' }}">
                                <img class="avatar-img rounded-circle" src="{{ $profileImage }}" alt="">
                            </a>
                        </div>
                        <!-- Info -->
                        <div class="w-100">
                            <h6 class="mb-0">
                                <a
                                    href="{{ $member->id ? route('user.profile.data', ['id' => Crypt::encrypt($member->id)]) : '#' }}">
                                    {{ $member->name }}
                                </a>
                                @if( $group->created_by == $member->id)
                                <span class="badge bg-danger ms-2" title="Group Admin">
                                    <i class="bi bi-shield-lock"></i> Admin
                                </span>
                                @endif
                            </h6>
                            <p class="small text-muted mb-0">
                                {{ $member->Service ?? 'N/A' }} | {{ $member->current_designation ?? 'N/A' }}
                            </p>
                        </div>
                    </div> <!-- ✅ yeh foreach item ka close -->
                    @endforeach
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Members Modal -->

<!-- Edit Post Modal -->
<div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('user.update_topic_details')  }} " method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="post_id" id="editPostId" value="">   
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPostModalLabel">Edit Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Post Content -->
                    <div class="mb-3">
                        <label for="postContent" class="form-label">Content</label>
                        <textarea id="postContent" name="content" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="videoLink" class="form-label">Video Link (YouTube, Vimeo, etc.)</label>
                        <input type="url" id="videoLink" name="video_link" class="form-control"
                            value="" placeholder="Enter video URL">
                    </div>

                    <!-- Optional: Image/Media upload -->
                    <!-- Multiple Image Upload -->
                    <div class="mb-3">
                        <label for="postMedia" class="form-label">Attach Media</label>
                        <input type="file" id="postMedia" name="postMedia[]" class="form-control" multiple>
                      <div id="currentMediaPreview" class="d-flex flex-wrap gap-3 mt-3"></div>

                        <!-- Static Preview Gallery -->
                        
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Post</button>
                </div>
            </div>
        </form>
    </div>
</div>
@section('scripts')
<script nonce="{{ $cspNonce }}">   
     function editGrp_post(postId) {
        // Fetch post data using AJAX
        $.ajax({
       url: "/user/group/edit_data_get/" + postId + "/edit",

        type: "GET",
        success: function (response) {
            // Fill content
            $("#postContent").val(response.post.content);
            $("#videoLink").val(response.post.video_link);

            // Empty old previews
            $("#currentMediaPreview").html("");

            // Load current images
            if (response.post.media.length > 0) {
                response.post.media.forEach(function (media) {
                    let imgHtml = `
        <div class="position-relative d-inline-block m-2" id="media-${media.id}">
            <img src="/storage/${media.file_path}" class="img-thumbnail rounded shadow-sm"
                 style="max-height: 150px; max-width: 150px; object-fit: cover;">
            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 rounded-circle"
                    onclick="removeMedia(${media.id})">
                <i class="fa fa-times"></i>
            </button>
        </div>
    `;
                    $("#currentMediaPreview").append(imgHtml);
                });
            }

            // Set hidden post id
            $("#editPostId").val(postId);

            // Open Modal
            $("#editPostModal").modal("show");
        }
    });
    }
    function removeMedia(mediaId) {
      
                 $.ajax({
        url: "/user/post/media_remove/" + mediaId,
        type: "DELETE",
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            if(response.success) {
                $("#media-" + mediaId).remove();
            }
        }
    });
           
    }
$(document).ready(function() {
   
$("#postMedia").on("change", function() {
    $("#currentMediaPreview").append(""); 
    let files = this.files;

    Array.from(files).forEach((file, index) => {
        let reader = new FileReader();
        reader.onload = function(e) {
            let tempId = "new-" + index;
            let imgHtml = `
                <div class="position-relative d-inline-block m-2" id="${tempId}">
                    <img src="${e.target.result}" class="img-thumbnail rounded shadow-sm"
                         style="max-height: 150px; max-width: 150px; object-fit: cover;">
                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 rounded-circle"
                            onclick="$('#${tempId}').remove()">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            `;
            $("#currentMediaPreview").append(imgHtml);
        };
        reader.readAsDataURL(file);
    });
});
    // Move to selected
    $('#addMemberBtn').click(function() {
        $('#availableMembers option:selected').each(function() {
            $(this).remove().appendTo('#selectedMembers');
        });
    });

    // Move back to available
    $('#removeMemberBtn').click(function() {
        $('#selectedMembers option:selected').each(function() {
            $(this).remove().appendTo('#availableMembers');
        });
    });

    // On form submit, select all in "selectedMembers"
    $('#addMembersOffcanvas form').submit(function() {
        $('#selectedMembers option').prop('selected', true);
    });
});


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

$(document).on('click', '.copy-url-btn', function() {
    const url = $(this).data('url');
    navigator.clipboard.writeText(url).then(() => {
        alert('Link copied to clipboard!');
    }).catch(err => {
        console.error('Failed to copy: ', err);
    });
});

$(document).on('click', '.edit-comment-btn', function() {
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
                $(`#comment-text-${id}`).text(data.comment || newComment);
            } else {
                alert(data.message || 'Failed to update comment');
            }
        },
        error: function() {
            alert('An error occurred while editing the comment.');
        }
    });
}

$(document).ready(function() {
    $('.commentForm').on('submit', function(e) {
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
            success: function(response) {
                if (response.status === 'success') {
                    textarea.val('');
                    errorDiv.removeClass('text-danger').addClass('text-success').text(
                        'Comment added successfully!');
                    // Optionally append to comment list
                }
            },
            error: function(xhr) {
                if (xhr.responseJSON?.errors?.comment) {
                    errorDiv.text(xhr.responseJSON.errors.comment[0]);
                } else {
                    errorDiv.text('An error occurred.');
                }
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    GLightbox({
        selector: '.glightbox'
    });
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

document.addEventListener("input", function(e) {
    if (e.target.classList.contains("member-search")) {
        let searchValue = e.target.value.toLowerCase();
        let targetId = e.target.getAttribute("data-target");
        let memberList = document.getElementById(targetId);

        memberList.querySelectorAll(".member-item").forEach(item => {
            let name = item.querySelector("h6")?.innerText.toLowerCase() || "";
            let matches = name.includes(searchValue);
            if (matches) {
                item.classList.remove("d-none");
                item.classList.add("d-md-flex");
            } else {
                item.classList.remove("d-md-flex");
                item.classList.add("d-none");
            }
        });
    }
});

console.clear();
</script>


@endsection