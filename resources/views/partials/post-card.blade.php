<div class="card rounded mb-4" id="feed-{{ $post['post_id'] }}">
    <div class="card-header position-relative">
        <div class="d-flex align-items-center gap-3">
            @php
                $profilePath = public_path('storage/' . $post['member_profile_pic']);
                $profilePic = !empty($post['member_profile_pic']) && file_exists($profilePath)
                    ? asset('storage/' . $post['member_profile_pic'])
                    : asset('admin_assets/images/profile/user-1.webp');
            @endphp

            <img src="{{ $profilePic }}" alt="profile" width="48" class="rounded">
            <div>
                <h6 class="mb-0">
                    {{ $post['member_name'] }}
                    @if(!empty($post['group_id']))
                        <span title="Group Post">
                            <i class="bi bi-people-fill text-primary"></i>
                        </span>
                    @else
                        <span title="Single Post">
                            <i class="bi bi-person-fill text-secondary"></i>
                        </span>
                    @endif
                </h6>
                <span>{{ \Carbon\Carbon::parse($post['created_at'])->format('d-M-Y h:i A') }}</span>
            </div>
        </div>

        <!-- Post Toggle -->
        <div class="form-check form-switch position-absolute top-0 end-0 me-3 mt-2">
            <input class="form-check-input feed-status-toggle"
                   type="checkbox"
                   role="switch"
                   id="feedStatusSwitch-{{ $post['post_id'] }}"
                   data-id="{{ $post['post_id'] }}"
                   {{ $post['status'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label small" for="feedStatusSwitch-{{ $post['post_id'] }}">
                {{ $post['status'] == 1 ? 'Active' : 'Inactive' }}
            </label>
        </div>
    </div>

    <div class="card-body">
        {{-- Post Content --}}
        @if(!empty($post['content']))
            @php
                $words = str_word_count(strip_tags($post['content']), 1);
                $wordCount = count($words);
                $contentPreview = implode(' ', array_slice($words, 0, 100));
            @endphp

            <p class="mb-3 tx-14">
                {!! $wordCount > 100
                    ? '<span class="short-content" id="short-'.$post['post_id'].'">'.$contentPreview.'...</span>
                       <span class="full-content d-none" id="full-'.$post['post_id'].'">'.$post['content'].'</span>
                       <a href="javascript:void(0);" class="text-primary read-toggle" data-post-id="'.$post['post_id'].'">Read more</a>'
                    : $post['content'] !!}
            </p>
        @endif

        {{-- Media --}}
        @if($post['media']->isNotEmpty())
            <div class="row">
                @foreach($post['media'] as $media)
                    <div class="col-md-2 mb-3">
                        @if(Str::startsWith($media['file_type'], 'image'))
                            <img src="{{ asset('storage/' . $media['file_path']) }}" class="img-fluid rounded"
                                style="width:200px; height:200px; object-fit:cover;">
                        @else
                            <a href="{{ asset('storage/' . $media['file_path']) }}" target="_blank">View File</a>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Video --}}
        @if(!empty($post['video_link']))
            <div class="mb-3">
                @if(Str::contains($post['video_link'], 'youtube.com') || Str::contains($post['video_link'], 'youtu.be'))
                    @php
                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|shorts)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $post['video_link'], $matches);
                        $youtubeId = $matches[1] ?? null;
                    @endphp
                    @if($youtubeId)
                        <iframe width="320" height="240" src="https://www.youtube.com/embed/{{ $youtubeId }}" frameborder="0" allowfullscreen></iframe>
                    @else
                        <a href="{{ $post['video_link'] }}" target="_blank">View Video</a>
                    @endif
                @else
                    <video width="320" height="240" controls>
                        <source src="{{ $post['video_link'] }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
            </div>
        @endif
    </div>

    <!-- Comments Section -->
    <div class="card-footer border-top">
        <div class="d-flex gap-4 mb-3">
            <h6>Likes ({{ $post['likes_count'] }})</h6>
            <h6>Comments ({{ count($post['comments']) }})</h6>
        </div>

        <!-- Comments Accordion -->
        <div class="accordion mt-3" id="postCommentsAccordion-{{ $post['post_id'] }}">
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading-comments-{{ $post['post_id'] }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse-comments-{{ $post['post_id'] }}" aria-expanded="false"
                        aria-controls="collapse-comments-{{ $post['post_id'] }}">
                        💬 View Comments ({{ count($post['comments']) }})
                    </button>
                </h2>

                <div id="collapse-comments-{{ $post['post_id'] }}" class="accordion-collapse collapse"
                    aria-labelledby="heading-comments-{{ $post['post_id'] }}"
                    data-bs-parent="#postCommentsAccordion-{{ $post['post_id'] }}">
                    <div class="accordion-body">
                        @foreach($post['comments'] as $comment)
                            @php
                                $commentProfilePath = public_path('storage/' . $comment->member_profile_pic);
                                $commentProfilePic = !empty($comment->member_profile_pic) && file_exists($commentProfilePath)
                                    ? asset('storage/' . $comment->member_profile_pic)
                                    : asset('admin_assets/images/profile/user-1.webp');

                                $commentText = preg_replace_callback(
                                    '/@([a-zA-Z0-9_.]+)/',
                                    function ($matches) {
                                        $name = $matches[1];
                                        $user = \App\Models\Member::where('name', $name)->first();
                                        return $user
                                            ? "<a href='javascript:void(0);' class='mention-badge'>@{$user->name}</a>"
                                            : "@{$name}";
                                    },
                                    e($comment->comment)
                                );
                            @endphp

                            <!-- Comment Card -->
                            <div class="d-flex mb-3 align-items-start">
                                <img src="{{ $commentProfilePic }}" alt="commenter" width="36" height="36" class="rounded me-2">
                                <div class="bg-light rounded p-2 w-100 position-relative">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong>{{ $comment->member_name }}</strong>
                                        <span class="text-muted" style="font-size:12px;">
                                            {{ \Carbon\Carbon::parse($comment->created_at)->format('d-M-Y h:i A') }}
                                        </span>
                                    </div>
                                    <p class="mb-1">{!! $commentText !!}</p>

                                    <!-- Comment Toggle -->
                                    <div class="form-check form-switch position-absolute top-0 end-0 me-3 mt-2">
                                        <input class="form-check-input comment-status-toggle"
                                            type="checkbox"
                                            role="switch"
                                            id="commentStatusSwitch-{{ $comment->id }}"
                                            data-id="{{ $comment->id }}"
                                            {{ $comment->status == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label small" for="commentStatusSwitch-{{ $comment->id }}">
                                            {{ $comment->status == 1 ? 'Active' : 'Inactive' }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
