@extends('admin.layouts.master')

@section('title', 'Social Wall - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Social Wall</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Social Wall
                                </span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @php use Illuminate\Support\Str; @endphp
<div class="row align-items-center mb-3">
    <div class="col-md-6">
        <form method="GET" action="{{ route('socialwall.index') }}" id="filterForm">
            <div class="input-group">
                <select name="year" class="form-select" onchange="this.form.submit()">
                    <option value="">All Years</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
                <select name="month" class="form-select" onchange="this.form.submit()">
                    <option value="">All Months</option>
                    @foreach(range(1, 12) as $month)
                        <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                        </option>
                    @endforeach
                </select>
                <select name="day" class="form-select" onchange="this.form.submit()">
                    <option value="">All Days</option>
                    @foreach($days as $day)
                        <option value="{{ $day }}" {{ request('day') == $day ? 'selected' : '' }}>
                            {{ $day }}
                        </option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-primary" id="clearFilterBtn">Clear Filter</button>
            </div>
        </form>
    </div>
</div>

    @if($groupedPosts->isEmpty())
    <div class="alert alert-warning text-center my-4">
        No post found against applied filter
    </div>
    @endif

    @foreach($groupedPosts as $post)
    <div class="card rounded" id="feed-{{ $post['post_id'] }}">
        <div class="card-header">
            <div class="d-flex align-items-center gap-6">
                @php

                $profilePath = public_path('storage/' .
                $post['member_profile_pic']);
                $profilePic = !empty( $post['member_profile_pic']) &&
                file_exists($profilePath)
                ? asset('storage/' . $post['member_profile_pic'])
                : asset('feed_assets/images/avatar-default.png');
                @endphp

                <img src="{{ $profilePic }}" alt="prd1" width="48" class="rounded">
                <div>
                    <h6 class="mb-0">By
                        {{ $post['member_name'] }}</h6>
                    <span>{{ \Carbon\Carbon::parse($post['created_at'])->format('d-M-Y h:i A') }}</span>
                </div>
                <div class="d-flex ms-auto text-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input feed-status-toggle" type="checkbox" role="switch"
                            id="feedStatusSwitch-{{ $post['post_id'] }}" data-id="{{ $post['post_id'] }}"
                            {{ $post['status'] == 1 ? 'checked' : '' }}>

                            <span class="form-check-label small" for="feedStatusSwitch-{{ $post['post_id'] }}">
                                {{ $post['status'] == 1 ? 'Active' : 'Inactive' }}
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if(!empty($post['content']))
            @php
            $words = str_word_count(strip_tags($post['content']), 1);
            $wordCount = count($words);
            $contentPreview = implode(' ', array_slice($words, 0, 100));
            @endphp

            <p class="mb-3 tx-14">
                {!! $wordCount > 100 ? '<span class="short-content" id="short-'.$post['post_id'].'">' . $contentPreview
                    . '...</span>
                <span class="full-content d-none" id="full-'.$post['post_id'].'">' . $post['content'] . '</span>
                <a href="javascript:void(0);" class="text-primary read-toggle" data-post-id="'.$post['post_id'].'">Read
                    more</a>' : $post['content'] !!}
            </p>

            @endif

            @if($post['media']->isNotEmpty())
            <div class="row">
                @foreach($post['media'] as $media)
                <div class="col-md-2 mb-3">
                    @if(Str::startsWith($media['file_type'], 'image'))
                    <img src="{{ asset('storage/' . $media['file_path']) }}" class="img-fluid rounded"
                        style="width: 200px; object-fit: cover;height: 200px;" />
                    @else
                    <a href="{{ asset('storage/' . $media['file_path']) }}" target="_blank">View
                        File</a>
                    @endif
                </div>
                @endforeach
            </div>
            @endif

            @if(!empty($post['video_link']))
    <div class="mb-3">
        @if(Str::contains($post['video_link'], 'youtube.com') || Str::contains($post['video_link'], 'youtu.be'))
            @php
                // Extract YouTube video ID from URL
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

           @foreach($post['comments'] as $comment)
    @php
        $commentProfilePath = public_path('storage/' . $comment->member_profile_pic);
        $commentProfilePic = !empty($comment->member_profile_pic) && file_exists($commentProfilePath)
            ? asset('storage/' . $comment->member_profile_pic)
            : asset('feed_assets/images/avatar-default.png');

            $commentText = preg_replace_callback(
                '/@([a-zA-Z0-9_.]+)/',
                function ($matches) {
                    $name = $matches[1];
                    $user = \App\Models\Member::where('name', $name)->first();
                    if ($user) {
                      
                        return "<a href='javascript:void(0);' class='mention-badge'>@{$user->name}</a>";
                    }
                    return "@{$name}";
                },
                e($comment->comment)
            );
    @endphp

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

            <!-- Toggle switch -->
            <div class="form-check form-switch position-absolute top-0 end-0 me-2 mt-1">
                <input class="form-check-input comment-status-toggle" 
                       type="checkbox" 
                       role="switch"
                       id="commentStatusSwitch-{{ $comment->id }}"
                       data-id="{{ $comment->id }}"
                       {{ $comment->status == 1 ? 'checked' : '' }}>
                <label class="form-check-label small" for="commentStatusSwitch-{{ $comment->id }}">
                </label>
            </div>
        </div>
    </div>
@endforeach

        </div>


    </div>
    @endforeach



    @endsection
    @section('scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
$(document).ready(function() {
    @if(session('success'))
    toastr.success("{{ session('success') }}");
    @endif

    // Clear filter button
    $('#clearFilterBtn').on('click', function() {
        window.location.href = "{{ route('socialwall.index') }}";
    });

    // Post status toggle
    $(document).on('change', '.feed-status-toggle', function() {
        let checkbox = $(this);
        let postId = checkbox.data('id');
        let status = checkbox.prop('checked') ? 1 : 0;
        let confirmChange = confirm("Are you sure you want to " + (status ? "activate" : "deactivate") + " this post?");
        if (!confirmChange) {
            checkbox.prop('checked', !status);
            return;
        }
        $.ajax({
            url: '/admin/socialwall/toggle-status',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: postId,
                status: status
            },
            success: function(response) {
                toastr.success(response.message);
            },
            error: function() {
                toastr.error('Failed to update status.');
                checkbox.prop('checked', !status);
            }
        });
    });

    // Comment status toggle
    $(document).on('change', '.comment-status-toggle', function() {
        let checkbox = $(this);
        let commentId = checkbox.data('id');
        let status = checkbox.prop('checked') ? 1 : 0;
        let confirmChange = confirm("Are you sure you want to " + (status ? "activate" : "deactivate") + " this comment?");
        if (!confirmChange) {
            checkbox.prop('checked', !status);
            return;
        }
        $.ajax({
            url: '/admin/socialwall/toggle-comment-status',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: commentId,
                status: status
            },
            success: function(response) {
                toastr.success(response.message);
            },
            error: function() {
                toastr.error('Failed to update comment status.');
                checkbox.prop('checked', !status);
            }
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.read-toggle').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const postId = this.getAttribute('data-post-id');
            const shortContent = document.getElementById('short-' + postId);
            const fullContent = document.getElementById('full-' + postId);

            if (fullContent.classList.contains('d-none')) {
                shortContent.classList.add('d-none');
                fullContent.classList.remove('d-none');
                this.textContent = 'Read less';
            } else {
                shortContent.classList.remove('d-none');
                fullContent.classList.add('d-none');
                this.textContent = 'Read more';
            }
        });
    });
});
</script>
@endsection