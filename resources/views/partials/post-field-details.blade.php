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
                        $profileLink = route('user.profile.data', ['id' => Crypt::encrypt($post->member->id)]);

                        $groupLink = route('user.group-post', ['id' => encrypt($post->group_id)]);
                    } else {
                        // Member/user post
                        $member = $post->member ?? null;
                        $profileImage = asset('feed_assets/images/avatar/07.jpg');

                        $displayName = $member->name ?? 'N/A';
                        $designation = $member->Service ?? 'N/A';
                        $profileLink = route('user.profile.data', ['id' => Crypt::encrypt($member->id)]);

                    }
                @endphp

    <!-- Info -->
                <div class="d-flex align-items-center">
                    <!-- Avatar -->
                    {{-- <div class="me-4 flex-shrink-0 avatar">

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
                    </div> --}}

                    <!-- Text content -->
                    <div>
                        <!-- Name -->
                        @if($post->type === 'group_post')
                            <h6 class="mb-1">
                                <i class="fa-solid fa-users fa-fw pe-2"></i> <a
                                    href="{{ $groupLink }}">{{ $displayName }}</a>
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
                                Group Post | <i class="bi bi-person-fill"></i><a class="text-dark"
                                    href="{{ $profileLink }}">{{ $created_by }}</a>
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
                <a href="#" class="text-secondary py-1 px-2" id="cardFeedAction" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    {{ $timeDiff }} <i class="bi bi-caret-down fa-fw pe-2"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardFeedAction">
                    <li>
                        <a class="dropdown-item" onclick="editGrp_post({{ $post->id }})" href="#">
                            <i class="bi bi-pen fa-fw pe-2"></i>Edit post
                        </a>
                    </li>
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
            $validMedia = $post->media->filter(function ($media) {
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
                <iframe height="315" src="{{ $post->video_link }}" title="YouTube video player" frameborder="0"
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
            {{-- Single Image --}}
            <div class="post-img mt-2">
                <a href="{{ asset('storage/' . $imageMedia[0]->file_path) }}" class="glightbox"
                    data-gallery="post-gallery-{{ $post->id }}">
                    <img src="{{ asset('storage/' . $imageMedia[0]->file_path) }}" class="w-100 rounded" alt="Post Image"
                        style="width: 100%; height: 400px; object-fit: cover;" loading="lazy" decoding="async">
                </a>
            </div>

        @elseif($totalImages === 2)
            {{-- Two Side by Side --}}
            <div class="post-img d-flex gap-2 mt-2">
                @foreach($imageMedia as $media)
                    <a href="{{ asset('storage/' . $media->file_path) }}" class="glightbox flex-fill"
                        data-gallery="post-gallery-{{ $post->id }}">
                        <img src="{{ asset('storage/' . $media->file_path) }}" class="w-100 rounded" alt="Post Image"
                            style="height: 250px; object-fit: cover;" loading="lazy" decoding="async">
                    </a>
                @endforeach
            </div>

        @elseif($totalImages === 3)
            {{-- One Large Left, Two Stacked Right --}}
            <div class="post-img d-flex gap-2 mt-2">
                <a href="{{ asset('storage/' . $imageMedia[0]->file_path) }}" class="glightbox flex-fill"
                    data-gallery="post-gallery-{{ $post->id }}">
                    <img src="{{ asset('storage/' . $imageMedia[0]->file_path) }}" class="w-100 rounded" alt="Post Image"
                        style="height: 400px; object-fit: cover;" loading="lazy" decoding="async">
                </a>
                <div class="d-flex flex-column gap-2" style="width: 50%;">
                    @foreach($imageMedia->slice(1, 2) as $media)
                        <a href="{{ asset('storage/' . $media->file_path) }}" class="glightbox flex-fill"
                            data-gallery="post-gallery-{{ $post->id }}">
                            <img src="{{ asset('storage/' . $media->file_path) }}" class="w-100 rounded" alt="Post Image"
                                style="height: 195px; object-fit: cover;" loading="lazy" decoding="async">
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
                            <img src="{{ asset('storage/' . $media->file_path) }}" alt="Post Image" loading="lazy"
                                class="w-100 h-100 rounded" style="object-fit: cover;">
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
        {{-- @if($post->type != 'group_post')
            <ul class="nav nav-stack py-3 small">
                @php
                    $likeUserList = $post->likes->pluck('member.name')->filter();
                    $likeUsersTooltip = $likeUserList->implode('<br>');
                    $hasLiked = $post->likes->contains('member_id', auth('user')->id());
                @endphp

                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link like-button {{ $hasLiked ? 'active text-primary' : '' }}"
                        data-url="{{ route('user.post.like', $post->id) }}" data-post-id="{{ $post->id }}"
                        data-bs-toggle="tooltip" data-bs-html="true"
                        data-bs-title="{{ $likeUsersTooltip ?: 'No likes yet' }}">
                        <i class="bi bi-hand-thumbs-up-fill pe-1"></i>
                        <span class="like-label">Like</span>
                        <span class="like-count">{{ $post->likes->count() ? '(' . $post->likes->count() . ')' : '' }}</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="#!">
                        <i class="bi bi-chat-fill pe-1"></i>Comments
                        <span
                            class="comment-count">{{ $post->comments->count() ? '(' . $post->comments->count() . ')' : '' }}</span>
                    </a>
                </li>
            </ul>
        @endif --}}
        
        <!-- Card body END -->
    </div>
    <!-- Card feed item END -->

</div>