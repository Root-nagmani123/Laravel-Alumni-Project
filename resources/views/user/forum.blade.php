@extends('layouts.app')

@section('title', 'Forum - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container">
    <div class="row g-4" style="margin-top: 100px;">
@include('partials.left_sidebar')
        <div class="col-lg-9">
    @php
        use Carbon\Carbon;
        $now = Carbon::now();
    @endphp

    <div class="row g-3">
        @if(isset($forums) && count($forums) > 0)
            @foreach($forums as $forum)
                @php
                    $isExpired = Carbon::parse($forum->end_date)->lt($now);
                @endphp

                <div class="col-12">
                    <div class="card p-3 border-0 shadow-sm">
                        <div class="d-flex">
                            <!-- Thumbnail -->
                            <div class="flex-shrink-0 me-3">
                                <a href="{{ route('user.forum.show', $forum->enc_id) }}">
                                    <img src="{{ asset('storage/uploads/images/forums_img/' . ($forum->images ?? 'default-forum.jpg')) }}"
                                         alt="Forum Image"
                                         class="rounded"
                                         style="width:60px; height:60px; object-fit:cover;">
                                </a>
                            </div>

                            <!-- Content -->
                            <div class="flex-grow-1">
                                <!-- Title -->
                                <h6 class="mb-1 fw-semibold">
                                    <a href="{{ route('user.forum.show', $forum->enc_id) }}" class="text-decoration-none">
                                        {{ $forum->name }}
                                    </a>
                                </h6>
                                <!-- Snippet -->
                                <p class="mb-2 text-muted small">
                                    {{ Str::limit($forum->description ?? 'No description available.', 120) }}
                                </p>

                                <!-- Author & Date -->
                                <div class="small text-muted mb-2">
                                    {{ \Carbon\Carbon::parse($forum->created_at)->format('d M, Y') }}
                                </div>

                                <!-- Tags & Stats -->
                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <!-- Stats -->
                                    <div class="d-flex align-items-center gap-3 small text-muted">
                                        <span><i class="bi bi-hand-thumbs-up"></i> {{ $forum->like_count ?? 0 }}</span>
                                        <span><i class="bi bi-chat"></i> {{ $forum->comment_count ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="text-muted">No forums available</h5>
                        <p class="text-muted mb-0">You don't have access to any forums yet.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

    </div>
</div>
<!-- Activate Forum Modal -->
<div class="modal fade" id="activateForumModal" tabindex="-1" aria-labelledby="activateForumModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('user.forum.activate') }}">
            @csrf
            <input type="hidden" name="forum_id" id="modal-forum-id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="activateForumModalLabel">Activate Forum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p>You're about to activate the forum: <strong id="modal-forum-name"></strong></p>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Select New Expiry Date</label>
                        <input type="date" class="form-control" name="end_date" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Activate</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    const activateModal = document.getElementById('activateForumModal');
    activateModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const forumId = button.getAttribute('data-forum-id');
        const forumName = button.getAttribute('data-forum-name');

        document.getElementById('modal-forum-id').value = forumId;
        document.getElementById('modal-forum-name').textContent = forumName;
    });
</script>

@endsection