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
            <div class="card shadow border-0 mb-4 rounded-3">
                {{-- <div class="card-header border d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-semibold">User Submitted Posts</h5>
                    </div> --}}
                @push('styles')
                {{-- Add Font Awesome for icons. You can use any icon library. --}}
                <link rel="stylesheet"
                    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
                @endpush

                <div class="card-body">

                    {{-- FILTERS --}}
                    <form action="{{ route('user.moderation') }}" method="get" class="mb-4">
                        <div class="row align-items-end">
                            {{-- Status Filter --}}
                            <div class="col-md-3">
                                <label for="status_filter" class="form-label fw-semibold">Status</label>
                                <select name="status_filter" id="status_filter" class="form-select">
                                    <option value="">All Statuses</option>
                                    <option value="pending"
                                        {{ request('status_filter') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved"
                                        {{ request('status_filter') == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="declined"
                                        {{ request('status_filter') == 'declined' ? 'selected' : '' }}>Declined</option>
                                </select>
                            </div>

                            {{-- Post Type Filter --}}
                            <div class="col-md-3">
                                <label for="post_type" class="form-label fw-semibold">Post Type</label>
                                <select name="post_type" id="post_type" class="form-select">
                                    <option value="">All Types</option>
                                    <option value="normal" {{ request('post_type') == 'normal' ? 'selected' : '' }}>
                                        Normal Post</option>
                                    <option value="group" {{ request('post_type') == 'group' ? 'selected' : '' }}>Group
                                        Post</option>
                                </select>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="col-md-6 d-flex justify-content-start align-items-end gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-filter me-1"></i> Apply Filters
                                </button>
                                <a href="{{ route('user.moderation') }}" class="btn btn-secondary">
                                    <i class="fa-solid fa-arrows-rotate me-1"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    {{-- POSTS TABLE --}}
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Post</th>
                                    <th>Post Type</th>
                                    <th>Author</th>
                                    <th>Posted On</th>
                                    <th style="width:120px;">Status</th>
                                    <th style="width:120px;" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($posts as $post)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $post->title }}</div>
                                        <small class="text-muted">{{ Str::limit($post->content, 100) }}</small>
                                    </td>
                                    <td>
                                        @if($post->group_id)
                                        <span
                                            class="badge bg-info-subtle border border-info-subtle text-info-emphasis rounded-pill">Group
                                            Post</span>
                                        @else
                                        <span
                                            class="badge bg-secondary-subtle border border-secondary-subtle text-secondary-emphasis rounded-pill">Normal
                                            Post</span>
                                        @endif
                                    </td>
                                    <td>{{ $post->member->name ?? 'Unknown' }}</td>
                                    <td>{{ $post->created_at->format('d M Y, H:i') }}</td>
                                    <td>
                                        @if($post->approved_by_moderator == 1)
                                        <span
                                            class="badge bg-success-subtle border border-success-subtle text-success-emphasis rounded-pill">Approved</span>
                                        @elseif($post->approved_by_moderator == 2)
                                        <span
                                            class="badge bg-danger-subtle border border-danger-subtle text-danger-emphasis rounded-pill">Declined</span>
                                        @else
                                        <span
                                            class="badge bg-warning-subtle border border-warning-subtle text-warning-emphasis rounded-pill">Pending</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu">
                                                {{-- View Button --}}
                                                <li>
                                                    <button class="dropdown-item btn-view" data-bs-toggle="modal"
                                                        data-bs-target="#viewPostModal" data-title="{{ $post->title }}"
                                                        data-content="{{ $post->content }}"
                                                        data-author="{{ $post->member->name ?? 'Unknown' }}"
                                                        data-post-type="{{ $post->group_id ? 'Group Post' : 'Normal Post' }}"
                                                        data-date="{{ $post->created_at->format('d M Y, H:i A') }}">
                                                        <i class="fa-solid fa-eye me-2"></i>View
                                                    </button>
                                                </li>

                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>

                                                {{-- Approve Form --}}
                                                <li>
                                                    <form action="{{ route('admin.feeds.approve') }}" method="post"
                                                        class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="_post_id" value="{{ $post->id }}">
                                                        <button type="submit" class="dropdown-item text-success" id="userConfirmModal{{ $post->id }}"
                                                            {{ $post->approved_by_moderator != 0 ? 'disabled' : '' }}>
                                                            <i class="fa-solid fa-check me-2"></i>Approve
                                                        </button>
                                                    </form>
                                                </li>

                                                {{-- Decline Form --}}
                                                <li>
                                                    <form action="{{ route('admin.feeds.decline') }}" method="post"
                                                        class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="_post_id" value="{{ $post->id }}">
                                                        <button type="submit" class="dropdown-item text-danger" id="userDeclineModal{{ $post->id }}"
                                                            {{ $post->approved_by_moderator != 0 ? 'disabled' : '' }}>
                                                            <i class="fa-solid fa-times me-2"></i>Decline
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">No posts found matching your criteria.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- PAGINATION --}}
                    @if ($posts->hasPages())
                    <div class="mt-4 d-flex justify-content-end">
                        {{ $posts->withQueryString()->links() }}
                    </div>
                    @endif
                </div>


                <div class="modal fade" id="viewPostModal" tabindex="-1" aria-labelledby="viewPostModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewPostModalLabel">Post Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h4 id="modalPostTitle" class="mb-3"></h4>
                                <div class="d-flex text-muted mb-3 gap-4">
                                    <span><i class="fa-solid fa-user me-1"></i> <strong
                                            id="modalPostAuthor"></strong></span>
                                    <span><i class="fa-solid fa-tag me-1"></i> <span id="modalPostType"></span></span>
                                    <span><i class="fa-solid fa-calendar-alt me-1"></i> <span
                                            id="modalPostDate"></span></span>
                                </div>
                                <hr>
                                <p id="modalPostContent" style="white-space: pre-wrap;"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
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
document.addEventListener("DOMContentLoaded", function() {
    const postModal = document.getElementById("postModal");

    postModal.addEventListener("show.bs.modal", function(event) {
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
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const viewPostModal = document.getElementById('viewPostModal');
    if (viewPostModal) {
        viewPostModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            const button = event.relatedTarget;

            // Extract info from data-* attributes
            const title = button.getAttribute('data-title');
            const content = button.getAttribute('data-content');
            const author = button.getAttribute('data-author');
            const postType = button.getAttribute('data-post-type');
            const date = button.getAttribute('data-date');

            // Update the modal's content.
            const modalTitle = viewPostModal.querySelector('#modalPostTitle');
            const modalContent = viewPostModal.querySelector('#modalPostContent');
            const modalAuthor = viewPostModal.querySelector('#modalPostAuthor');
            const modalPostType = viewPostModal.querySelector('#modalPostType');
            const modalDate = viewPostModal.querySelector('#modalPostDate');

            modalTitle.textContent = title;
            modalContent.textContent = content;
            modalAuthor.textContent = author;
            modalPostType.textContent = postType;
            modalDate.textContent = date;
        });
    }
});
</script>
@endpush
@endsection
@endsection