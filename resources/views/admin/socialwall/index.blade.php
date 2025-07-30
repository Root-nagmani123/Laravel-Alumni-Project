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
                : asset('feed_assets/images/avatar-7.png');
                @endphp

                <img src="{{ $profilePic }}" alt="prd1" width="48" class="rounded">
                <div>
                    <h6 class="mb-0">By
                        {{ $post['member_name'] }}</h6>
                    <span>{{ \Carbon\Carbon::parse($post['created_at'])->format('d-M-Y') }}</span>
                </div>
                <div class="d-flex ms-auto text-end">

                    <a href="#" data-feed-id="{{ $post['post_id'] }}"
                        onclick="delete_feed_model({{ $post['post_id'] }})" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Delete this Feed"
                        onclick="delete_feed_model({{ $post['post_id'] }})" class=" ms-2 btn btn-sm btn-danger">
                        Delete
                    </a>
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
    {!! $wordCount > 100 ? '<span class="short-content" id="short-'.$post['post_id'].'">' . $contentPreview . '...</span>
    <span class="full-content d-none" id="full-'.$post['post_id'].'">' . $post['content'] . '</span>
    <a href="javascript:void(0);" class="text-primary read-toggle" data-post-id="'.$post['post_id'].'">Read more</a>' : $post['content'] !!}
</p>

            @endif

            @if($post['media']->isNotEmpty())
            <div class="row">
                @foreach($post['media'] as $media)
                <div class="col-md-2 mb-3">
                    @if(Str::startsWith($media['file_type'], 'image'))
                    <img src="{{ asset('storage/' . $media['file_path']) }}" class="img-fluid rounded"  style="width: 200px; object-fit: cover;height: 200px;"/>
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
            <div class="d-flex gap-2">
                <h6>Likes (2)</h6>
            <h6 class="mb-3">Comments (2)</h6>
            </div>
            <div class="d-flex mb-3">
                <img src="https://i.pinimg.com/originals/00/28/c7/0028c71f6fe9fce5f87d117f5c5aeeee.jpg" alt="commenter" width="36" height="36" class="rounded me-2">
                <div class="bg-light rounded p-2 w-100">
                    <strong>Nibhash Mishra</strong>
                    <span
                        class="text-muted float-end" style="font-size:12px;">19th July, 2025</span>
                    <p class="mb-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis accusantium accusamus facilis dolorum dolore dolorem eaque, ea exercitationem praesentium mollitia. Necessitatibus, dignissimos reiciendis quasi temporibus ad autem repudiandae adipisci amet?</p>

                    {{-- Replies --}}
                    
                    <div class="ms-4 border-start ps-3">
                       
                        <div class="d-flex mt-2">
                            <img src="https://i.pinimg.com/originals/00/28/c7/0028c71f6fe9fce5f87d117f5c5aeeee.jpg" alt="replier" width="32"  height="32" class="rounded me-2">
                            <div class="bg-white rounded p-2 w-100 border">
                                <strong>Mayank Mishra</strong>
                                <span
                                    class="text-muted float-end" style="font-size:12px;">19th July, 2025</span>
                                <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis accusantium accusamus facilis dolorum dolore dolorem eaque, ea exercitationem praesentium mollitia. Necessitatibus, dignissimos reiciendis quasi temporibus ad autem repudiandae adipisci amet?</p>
                            </div>
                        </div>
                    </div>
                    <div class="ms-4 border-start ps-3">
                       
                        <div class="d-flex mt-2">
                            <img src="https://i.pinimg.com/originals/00/28/c7/0028c71f6fe9fce5f87d117f5c5aeeee.jpg" alt="replier" width="32"  height="32" class="rounded me-2">
                            <div class="bg-white rounded p-2 w-100 border">
                                <strong>Mayank Mishra</strong>
                                <span
                                    class="text-muted float-end" style="font-size:12px;">19th July, 2025</span>
                                <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis accusantium accusamus facilis dolorum dolore dolorem eaque, ea exercitationem praesentium mollitia. Necessitatibus, dignissimos reiciendis quasi temporibus ad autem repudiandae adipisci amet?</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.read-toggle').forEach(function (btn) {
            btn.addEventListener('click', function () {
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