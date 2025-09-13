
<!-- Main content START -->
     <!-- Story START -->
    <div class="d-flex gap-2 mb-4" style="margin-left:-.5rem;">
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
    <div class="card card-body mb-4">
        <div class="d-flex">
            <!-- Avatar -->
            <div class="avatar avatar-xs me-2">
                <a href="{{ route('user.profile.data', ['id' => Crypt::encrypt($user->id)]) }}"> <img class="avatar-img rounded-circle" src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}"
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
        </ul>
        <!-- Share feed toolbar END -->
    </div>
    <!-- Share feed END -->

    <!-- Card feed item START -->
    @foreach($posts as $post)
    <div class="card mb-4">
        <!-- Card header START -->
        <div class="card-header border-0 pb-0">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <!-- Avatar -->
                  @php
                        $profileImage = '';
                        $displayName = '';
                        $designation = '';
                        $Service = '';
                        $profileLink = '#';

                        if ($post->type === 'group_post') {

                            // Group post ke liye
                            $profileImage = $post->group_image
                                ? asset('storage/uploads/images/grp_img/' . $post->group_image)
                                : asset('feed_assets/images/avatar/07.jpg'); // fallback image

                            $displayName = $post->group_name ?? 'Unknown Group';
                            $designation = 'Group Post';
                            $created_by = $post->member->name;

                            // Optional: if you have a group detail page
                            $profileLink =  route('user.profile.data', ['id' => Crypt::encrypt($post->member->id)]);

        $groupLink = route('user.group-post',['id' => encrypt($post->group_id)]);
    } else {
        // Member/user post
        $member = $post->member ?? null;

                            $profileImage = $member && $member->profile_pic
                                ? asset('storage/' . $member->profile_pic)
                                : asset('feed_assets/images/avatar/07.jpg');

                            $displayName = $member->name ?? 'N/A';
                            $designation = $member->Service ?? 'N/A';
                            $profileLink = route('user.profile.data', ['id' => Crypt::encrypt($member->id)]);

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
            {{ $member->Service ?? 'N/A' }} | {{ $member->current_designation ?? 'N/A' }}
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
        <a class="dropdown-item" onclick="editGrp_post({{ $post->id }})" href="#">
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
    {{-- Single Image --}}
    <div class="post-img mt-2">
        <a href="{{ asset('storage/' . $imageMedia[0]->file_path) }}" class="glightbox"
            data-gallery="post-gallery-{{ $post->id }}">
            <img src="{{ asset('storage/' . $imageMedia[0]->file_path) }}"
                 class="w-100 rounded"
                 alt="Post Image"
                 style="width: 100%; height: 400px; object-fit: cover;"
                 loading="lazy" decoding="async">
        </a>
    </div>

@elseif($totalImages === 2)
    {{-- Two Side by Side --}}
    <div class="post-img d-flex gap-2 mt-2">
        @foreach($imageMedia as $media)
            <a href="{{ asset('storage/' . $media->file_path) }}" class="glightbox flex-fill"
                data-gallery="post-gallery-{{ $post->id }}">
                <img src="{{ asset('storage/' . $media->file_path) }}"
                     class="w-100 rounded"
                     alt="Post Image"
                     style="height: 250px; object-fit: cover;"
                     loading="lazy" decoding="async">
            </a>
        @endforeach
    </div>

@elseif($totalImages === 3)
    {{-- One Large Left, Two Stacked Right --}}
    <div class="post-img d-flex gap-2 mt-2">
        <a href="{{ asset('storage/' . $imageMedia[0]->file_path) }}" class="glightbox flex-fill"
            data-gallery="post-gallery-{{ $post->id }}">
            <img src="{{ asset('storage/' . $imageMedia[0]->file_path) }}"
                 class="w-100 rounded"
                 alt="Post Image"
                 style="height: 400px; object-fit: cover;"
                 loading="lazy" decoding="async">
        </a>
        <div class="d-flex flex-column gap-2" style="width: 50%;">
            @foreach($imageMedia->slice(1, 2) as $media)
                <a href="{{ asset('storage/' . $media->file_path) }}" class="glightbox flex-fill"
                    data-gallery="post-gallery-{{ $post->id }}">
                    <img src="{{ asset('storage/' . $media->file_path) }}"
                         class="w-100 rounded"
                         alt="Post Image"
                         style="height: 195px; object-fit: cover;"
                         loading="lazy" decoding="async">
                </a>
            @endforeach
        </div>
    </div>

@else
    {{-- Four or More Images --}}
    <div class="post-img d-grid gap-2 mt-2" style="grid-template-columns: repeat(2, 1fr); grid-auto-rows: 200px;">
        @foreach($imageMedia->take(4) as $index => $media)
            <div class="position-relative">
                <a href="{{ asset('storage/' . $media->file_path) }}" class="glightbox"
                    data-gallery="post-gallery-{{ $post->id }}">
                    <img src="{{ asset('storage/' . $media->file_path) }}"
                         alt="Post Image"
                         loading="lazy"
                         class="w-100 h-100 rounded"
                         style="object-fit: cover;">
                </a>

                {{-- Overlay for extra images --}}
                @if($index === 3 && $totalImages > 4)
                    @foreach($imageMedia->slice(4) as $extra)
                        <a href="{{ asset('storage/' . $extra->file_path) }}" class="glightbox d-none"
                            data-gallery="post-gallery-{{ $post->id }}"></a>
                    @endforeach

                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex
                                align-items-center justify-content-center text-white"
                         style="background: rgba(0,0,0,0.6); font-size: 2rem; border-radius: 0.5rem;">
                        +{{ $totalImages - 4 }}
                    </div>
                @endif
            </div>
        @endforeach
    </div>
@endif
  @if($post->type != 'group_post')
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
                {{--<li class="nav-item dropdown ms-sm-auto">
                    <a class="nav-link mb-0" href="#" id="cardShareAction" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-reply-fill flip-horizontal ps-1"></i> Share
                        {{ $post->shares ? '('.$post->shares->count().')' : '' }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardShareAction">
                        <li>
                            <a class="dropdown-item copy-url-btn" href="javascript:void(0)"
                                data-url="">
                                <i class="bi bi-link fa-fw pe-2"></i>Copy link to post
                            </a>
                            </li>
                    </ul>
                </li> --}}
                <!-- Card share action END -->
            </ul>


            <div class="d-flex mb-3">
                <!-- Avatar -->
               <div class="avatar avatar-xs me-2">
                    <a href="{{ route('user.profile.data', ['id' => Crypt::encrypt(auth()->guard('user')->id())]) }}">
                        <img class="avatar-img rounded-circle"
                            src="{{ auth()->guard('user')->user()->profile_pic
                                    ? asset('storage/' . auth()->guard('user')->user()->profile_pic)
                                    : asset('feed_assets/images/avatar/07.jpg') }}"
                            alt="{{ auth()->guard('user')->user()->name ?? 'User' }}"
                            loading="lazy" decoding="async">
                    </a>
                </div>

                <!-- Comment box  -->

                <form class="nav nav-item w-100 position-relative commentForm" id="commentForm-{{ $post->id }}"
      action="{{ route('user.comments.store') }}" method="POST" data-post-id="{{ $post->id }}">
    @csrf
    <textarea name="comment" class="form-control pe-5 bg-light user_feed_comment commentInput" rows="1"
        placeholder="Add a comment..." id="comments-{{ $post->id }}"></textarea>
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <button class="nav-link bg-transparent px-3 position-absolute top-50 end-0 translate-middle-y border-0"
        type="submit">
        <i class="bi bi-send-fill"></i>
    </button>
    <div class="comment-error text-danger small mt-1"></div>
</form>

            </div>
             @endif
            @php
                $currentUser = auth()->guard('user')->user();
                $isPostOwner = $currentUser && optional($post->member)->id === $currentUser->id;
                $filteredComments = $isPostOwner
                    ? $post->comments
                    : $post->comments->filter(function($comment) use ($currentUser) {
                        if (!$currentUser) { return false; }
                        if ($comment->member_id === $currentUser->id) { return true; }
                        preg_match_all('/@([A-Za-z0-9_.]+)/', $comment->comment, $matches);
                        $handles = array_map('strtolower', $matches[1] ?? []);
                        return in_array(strtolower($currentUser->username ?? ''), $handles, true);
                    });
            @endphp

            <ul class="comment-wrap list-unstyled">
                @foreach ($filteredComments as $comment)
                    @php
                        $rawComment = $comment->comment;
                        preg_match_all('/@([A-Za-z0-9_.]+)/', $rawComment, $matches);
                        $handles = array_unique($matches[1]);
                        $users = \App\Models\Member::whereIn('username', $handles)->get()->keyBy('username');
                        $commentText = preg_replace_callback(
                            '/@([A-Za-z0-9_.]+)/',
                            function ($m) use ($users) {
                                $username = $m[1];
                                $user = $users->get($username);
                                if ($user) {
                                    $url = route('user.profile.data', ['id' => Crypt::encrypt($user->id)]);
                                    return '<a href="'.$url.'" class="mention-badge">@'.e($user->name).'</a>';
                                }
                                return '@'.e($username);
                            },
                            e($rawComment)
                        );
                        $isCommentOwner = $currentUser && $currentUser->id === $comment->member_id;
                    @endphp
                    <li class="comment-item mb-3 {{ $loop->index >= 2 ? 'd-none' : '' }}" id="comment-{{ $comment->id }}">
                        <div class="d-flex position-relative">
                            <div class="avatar avatar-xs">
                                <a href="{{ $comment->member ? route('user.profile.data', ['id' => Crypt::encrypt($comment->member->id)]) : '#' }}">
                                    <img class="avatar-img rounded-circle"
                                         src="{{ $comment->member && $comment->member->profile_pic ? asset('storage/' . $comment->member->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}"
                                         alt="" loading="lazy" decoding="async">
                                </a>
                            </div>
                            <div class="ms-2 w-100">
                                <div class="bg-light rounded-start-top-0 p-3 rounded">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">
                                            <a href="{{ $comment->member ? route('user.profile.data', ['id' => Crypt::encrypt($comment->member->id)]) : '#' }}">
                                                {{ $comment->member->name ?? 'Anonymous' }}
                                            </a>
                                        </h6>
                                        <small class="ms-2">{{ $comment->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="small mb-0" id="comment-text-{{ $comment->id }}">{!! $commentText !!}</p>
                                </div>
                                <div class="row">
                                    <div class="col-6"></div>
                                    <div class="col-6 text-end">
                                        @if($isCommentOwner)
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
            <!-- Card body END -->

            @if ($filteredComments->count() > 2)
                <div class="card-footer border-0 pt-0">
                    <a href="#" class="btn btn-link btn-sm text-secondary load-more-comments" data-step="5">Load more comments</a>
                </div>
            @endif

            <!-- Card footer END -->
        </div>
        <!-- Card feed item END -->

    </div>
    @endforeach
@include('partials.user_feed_modals')

@section('scripts')
<script>
window.deleteStoryRouteTemplate = "{{ route('user.stories.destroy', ['id' => '__ID__']) }}";
(function(){
    let currentTime = Math.floor(Date.now() / 1000);
    @php
        $myUserId = Auth::guard('user')->id();
    @endphp
    window.storiesData = [
        @if(isset($storiesByMember[$myUserId]))
            @php
                $myFirst = $storiesByMember[$myUserId]->first();
                $myUser = $myFirst->user;
                $profileImage = '';
                $user = App\Models\Member::find($myUserId);
                if ($user && !empty($user->profile_pic) &&
                    Storage::disk('public')->exists($user->profile_pic)) {
                    $profileImage = asset('storage/' . $user->profile_pic);
                } else {
                    $profileImage = asset('feed_assets/images/avatar/07.jpg');
                }
            @endphp
            {
                id: "member-{{ $myUserId }}",
                photo: "{{ $profileImage }}",
                name: "{{ addslashes($myUser->name) }}",
                items: [
                    @foreach($storiesByMember[$myUserId] as $story)
                        @php
                            $isVideo = in_array(pathinfo($story->story_image, PATHINFO_EXTENSION), ['mp4', 'webm']);
                            $previewImage = $isVideo
                                ? 'storage/thumbnails/' . pathinfo($story->story_image, PATHINFO_FILENAME) . '.jpg'
                                : 'storage/' . $story->story_image;
                        @endphp
                        {
                            id: "story-{{ $story->id }}",
                            type: "{{ $isVideo ? 'video' : 'photo' }}",
                            length: {{ $isVideo ? 15 : 5 }},
                            src: "{{ asset('storage/' . $story->story_image) }}",
                            preview: "{{ asset($previewImage) }}",
                            time: {{ \Carbon\Carbon::parse($story->created_at)->timestamp }}
                        }@if(!$loop->last),@endif
                    @endforeach
                ]
            },
        @endif
        @foreach($storiesByMember as $memberId => $memberStories)
            @continue($memberId == $myUserId)
            @php
                $first = $memberStories->first();
                $user = $first->user;
                $profileImage = '';
                $member = App\Models\Member::find($memberId);
                if ($member && !empty($member->profile_pic) &&
                    Storage::disk('public')->exists($member->profile_pic)) {
                    $profileImage = asset('storage/' . $member->profile_pic);
                } else {
                    $profileImage = asset('feed_assets/images/avatar/07.jpg');
                }
            @endphp
            {
                id: "member-{{ $memberId }}",
                photo: "{{ $profileImage }}",
                name: "{{ addslashes($user->name) }}",
                items: [
                    @foreach($memberStories as $story)
                        @php
                            $isVideo = in_array(pathinfo($story->story_image, PATHINFO_EXTENSION), ['mp4', 'webm']);
                            $previewImage = $isVideo
                                ? 'storage/thumbnails/' . pathinfo($story->story_image, PATHINFO_FILENAME) . '.jpg'
                                : 'storage/' . $story->story_image;
                        @endphp
                        {
                            id: "story-{{ $story->id }}",
                            type: "{{ $isVideo ? 'video' : 'photo' }}",
                            length: {{ $isVideo ? 15 : 5 }},
                            src: "{{ asset('storage/' . $story->story_image) }}",
                            preview: "{{ asset($previewImage) }}",
                            time: {{ \Carbon\Carbon::parse($story->created_at)->timestamp }}
                        }@if(!$loop->last),@endif
                    @endforeach
                ]
            }@if(!$loop->last),@endif
        @endforeach
    ];
})();
</script>
<script src="{{ asset('js/user_feed.js') }}"></script>
@endsection
