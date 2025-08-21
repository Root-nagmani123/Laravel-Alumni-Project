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
                    <span>{{ \Carbon\Carbon::parse($post['created_at'])->format('d-M-Y') }}</span>
                </div>
                <div class="d-flex ms-auto text-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input feed-status-toggle" type="checkbox" role="switch"
                            id="feedStatusSwitch-{{ $post['post_id'] }}" data-id="{{ $post['post_id'] }}"
                            >
                        <label class="form-check-label small" for="feedStatusSwitch-{{ $post['post_id'] }}">
                            
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
    @endphp

    <div class="d-flex mb-3 align-items-start">
        <img src="{{ $commentProfilePic }}" alt="commenter" width="36" height="36" class="rounded me-2">

        <div class="bg-light rounded p-2 w-100 position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <strong>{{ $comment->member_name }}</strong>
                <span class="text-muted" style="font-size:12px;">
                    {{ \Carbon\Carbon::parse($comment->created_at)->format('d M Y') }}
                </span>
            </div>
            <p class="mb-1">{{ $comment->comment }}</p>

            <!-- Toggle switch -->
            <div class="form-check form-switch position-absolute top-0 end-0 me-2 mt-1">
                <input class="form-check-input comment-status-toggle" 
                       type="checkbox" 
                       role="switch"
                       id="commentStatusSwitch-{{ $comment->id }}"
                       data-id="{{ $comment->id }}">
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
    //Toastr message
    $(document).ready(function() {
        @if(session('success'))
        toastr.success("{{ session('success') }}");
        @endif

    });

    function delete_feed_model(postId) {
        if (confirm('Are you sure you want to delete this post?')) {
            $.ajax({
                url: '/admin/delete-socialwall/' + postId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    toastr.success(response.message);
                    $('#feed-' + postId).remove(); // UI se post remove karo
                },
                error: function(xhr) {
                    toastr.error('Failed to delete post.');
                }
            });
        }
    }
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