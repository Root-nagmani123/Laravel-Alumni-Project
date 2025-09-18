@extends('admin.layouts.master')

@section('title', 'Feeds - Alumni | Lal Bahadur')

@section('content')
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title">User Feeds</h4>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                        <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                        User Feeds
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
        @if (session('error'))
            <div class="alert alert-danger" style="color:white;">
                {{ session('error') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h3 class="m-0">User Feed — Moderation</h3>
                    {{-- <div>
                        <div class="btn-group me-2 me-md-3 d-flex gap-2">
                            <button id="bulk-approve" class="btn btn-success btn-sm">Approve selected</button>
                            <button id="bulk-decline" class="btn btn-danger btn-sm">Decline selected</button>
                        </div>
                    </div> --}}
                </div>


                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-nowrap table-bordered table-striped">
                        <thead>
                            <tr>
                                {{-- <th style="width:40px;"><input id="select-all" type="checkbox" aria-label="Select all">
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
                                        {{-- <td><input class="row-select" type="checkbox" value="{{ $post->id }}"></td> --}}
                                        <td>
                                            <div class="fw-semibold">{{ $post->title }}</div>
                                            <div class="text-muted small">{{ Str::limit($post->content, 100) }}</div>
                                        </td>
                                        <td>{{ $post->member->name ?? 'Unknown' }}</td>
                                        <td class="text-nowrap">{{ $post->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $post->approved_by_moderator ? 'Approved' : 'Pending' }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <form action="{{ route('admin.feeds.approve') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="_post_id" value="{{ $post->id }}">
                                                    <button class="btn btn-sm btn-outline-success " type="submit">Approve</button>
                                                </form>
                                                <form action="{{ route('admin.feeds.decline') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="_post_id" value="{{ $post->id }}">
                                                    <button class="btn btn-sm btn-outline-danger btn-decline" type="submit">Decline</button>
                                                </form>
                                                <button class="btn btn-sm btn-outline-info btn-view" data-bs-toggle="modal"
                                                    data-bs-target="#postModal" data-title="Post Details" data-id="{{ $post->id }}">View</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Bootstrap Modal -->
                                    <div class="modal fade" id="postModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="postTitle">Post Title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
        <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmTitle">Confirm</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="confirmBody">Are you sure?</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button id="confirmYes" type="button" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast Container -->
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080">
            <div id="liveToast" class="toast" role="status" aria-live="polite" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Moderator</strong>
                    <small class="text-muted">now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" id="toastBody">Action performed</div>
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

    </div>
@endsection