@extends('layouts.app')

@section('title', 'User — Feed Moderation - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
    <div class="container">
        <div class="row g-4" style="margin-top:4rem;">

            <!-- Sidenav START -->
            @include('partials.left_sidebar')
            <!-- Sidenav END -->

            <!-- Main content START -->
            <div class="col-md-9 col-lg-7 vstack gap-4">

                <!-- Posts Card -->
                <div class="card">
                    {{-- <div class="card-header border d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-semibold">User Submitted Posts</h5>
                    </div> --}}
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 text-nowrap table-bordered table-striped">
                                <thead>
                                    <tr>
                                        {{-- <th style="width:40px;"><input id="select-all" type="checkbox"
                                                aria-label="Select all">
                                        </th> --}}
                                        <th>Post</th>
                                        <th>Author</th>
                                        <th>Posted</th>
                                        <th style="width:140px">Status</th>
                                        <th style="width:220px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="posts-tbody">
                                    @if(!empty(($posts)) && $posts->count())
                                        @foreach($posts as $post)
                                            <tr data-id="{{ $post->id }}">
                                                {{-- <td><input class="row-select" type="checkbox" value="{{ $post->id }}"></td>
                                                --}}
                                                <td>
                                                    <div class="fw-semibold">{{ $post->title }}</div>
                                                    <div class="text-muted small">{{ Str::limit($post->content, 100) }}</div>
                                                </td>
                                                <td>{{ $post->member->name ?? 'Unknown' }}</td>
                                                <td class="text-nowrap">{{ $post->created_at->format('Y-m-d H:i') }}</td>
                                                <td>
                                                    @if($post->approved_by_moderator == 1)
                                                        <span class="badge bg-success">Approved</span>
                                                    @elseif($post->approved_by_moderator == 2)
                                                        <span class="badge bg-danger">Declined</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <form action="{{ route('admin.feeds.approve') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="_post_id" value="{{ $post->id }}">
                                                            <button class="btn btn-sm btn-outline-success "
                                                                type="submit">Approve</button>
                                                        </form>
                                                        <form action="{{ route('admin.feeds.decline') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="_post_id" value="{{ $post->id }}">
                                                            <button class="btn btn-sm btn-outline-danger btn-decline"
                                                                type="submit">Decline</button>
                                                        </form>
                                                        <button class="btn btn-sm btn-outline-info btn-view" data-bs-toggle="modal"
                                                            data-bs-target="#postModal" data-title="Post Details"
                                                            data-id="{{ $post->id }}">View</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Bootstrap Modal -->
                                            <div class="modal fade" id="postModal" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="postTitle">Post Title</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p id="postContent">Post details will be shown here...</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">No posts found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $posts->links() }}
                    </div>
                </div>

                <!-- Confirm Modal -->
                <div class="modal fade" id="userConfirmModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-sm">
                            <div class="modal-header bg-light">
                                <h5 class="modal-title" id="userConfirmTitle">Confirm Action</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body" id="userConfirmBody">Are you sure you want to proceed?</div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button id="userConfirmYes" type="button" class="btn btn-primary">
                                    <i class="bi bi-check2-circle me-1"></i> Yes, Confirm
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- View Post Modal -->
                <div class="modal fade" id="viewPostModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content border-0 shadow-sm">
                            <div class="modal-header bg-light">
                                <h5 class="modal-title">Post Preview</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body" id="viewPostBody">
                                <!-- Post content injected dynamically -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Toast Container -->
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080">
                    <div id="userToast" class="toast align-items-center border-0 shadow-sm" role="status" aria-live="polite"
                        aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body" id="userToastBody">
                                ✅ Action performed successfully
                            </div>
                            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>
                        </div>
                    </div>
                </div>

            </div>



        </div>

    </div>
    @section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const postModal = document.getElementById("postModal");

            postModal.addEventListener("show.bs.modal", function (event) {
                const button = event.relatedTarget; // Button that triggered the modal

                const title = button.getAttribute("data-title");
                const content = button.getAttribute("data-content");

                // Update modal content
                postModal.querySelector("#postTitle").textContent = title;
                postModal.querySelector("#postContent").textContent = content;
            });
        });
    </script>

    <script>

        $(document).ready(function() {
            $('.btn-view').on('click', function() {
                const postId = $(this).data('id');

                if (!postId) {
                    $('#postContent').text('Post ID not found.');
                    return;
                }
                $.ajax({
                    url: '{{ route("admin.feeds.view") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        post_id: postId
                    },
                    success: function(response) {
                        $('#postContent').html(response.html || 'No content available.');
                    },
                    error: function() {
                        $('#postContent').text('Failed to load post details.');
                    }
                });
            });
        });
    </script>
    @endsection
@endsection