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

            @php
            $activeForums = $forums->filter(fn($f) => \Carbon\Carbon::parse($f->end_date)->gte($now));
            $inactiveForums = $forums->filter(fn($f) => \Carbon\Carbon::parse($f->end_date)->lt($now));
            @endphp

            <ul class="nav nav-tabs mb-3" id="forumTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="active-forum-tab" data-bs-toggle="tab"
                        data-bs-target="#active-forums" type="button" role="tab" aria-controls="active-forums"
                        aria-selected="true">
                        Active Forums ({{ $activeForums->count() }})
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="inactive-forum-tab" data-bs-toggle="tab"
                        data-bs-target="#inactive-forums" type="button" role="tab" aria-controls="inactive-forums"
                        aria-selected="false">
                        Inactive Forums ({{ $inactiveForums->count() }})
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="forumTabsContent">
                <!-- Active Forums -->
                <div class="tab-pane fade show active" id="active-forums" role="tabpanel"
                    aria-labelledby="active-forum-tab">
                    <div class="row g-3">
                        @forelse($activeForums as $forum)
                        <div class="col-12">
                            <div class="card p-3 border-0 shadow-sm">
                                <div class="d-flex">
                                    <!-- Thumbnail -->
                                    <div class="flex-shrink-0 me-3">
                                        <a href="{{ route('user.forum.show', $forum->enc_id) }}">
                                            <img src="{{ asset('storage/uploads/images/forums_img/' . ($forum->images ?? 'default-forum.jpg')) }}"
                                                alt="Forum Image" class="rounded"
                                                style="width:60px; height:60px; object-fit:cover;">
                                        </a>
                                    </div>

                                    <!-- Content -->
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 fw-semibold">
                                            <a href="{{ route('user.forum.show', $forum->enc_id) }}"
                                                class="text-decoration-none">
                                                {{ $forum->name }}
                                            </a>
                                        </h6>
                                        <p class="mb-2 text-muted small">
                                            {{ Str::limit($forum->description ?? 'No description available.', 120) }}
                                        </p>
                                        <div class="small text-muted mb-2">
                                            {{ \Carbon\Carbon::parse($forum->created_at)->format('d M, Y') }}
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                                            <div class="d-flex align-items-center gap-3 small text-muted">
                                                <span><i class="bi bi-hand-thumbs-up"></i>
                                                    {{ $forum->like_count ?? 0 }}</span>
                                                <span><i class="bi bi-chat"></i> {{ $forum->comment_count ?? 0 }}</span>
                                            </div>
                                            <span class="badge bg-success-soft text-success">Active</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="alert alert-info">No active forums available.</div>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Inactive Forums -->
                <div class="tab-pane fade" id="inactive-forums" role="tabpanel" aria-labelledby="inactive-forum-tab">
                    <div class="row g-3">
                        @forelse($inactiveForums as $forum)
                        <div class="col-12">
                            <div class="card p-3 border-0 shadow-sm">
                                <div class="d-flex">
                                    <!-- Thumbnail -->
                                    <div class="flex-shrink-0 me-3">
                                        <a href="{{ route('user.forum.show', $forum->enc_id) }}">
                                            <img src="{{ asset('storage/uploads/images/forums_img/' . ($forum->images ?? 'default-forum.jpg')) }}"
                                                alt="Forum Image" class="rounded"
                                                style="width:60px; height:60px; object-fit:cover;">
                                        </a>
                                    </div>

                                    <!-- Content -->
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 fw-semibold">
                                            <a href="{{ route('user.forum.show', $forum->enc_id) }}"
                                                class="text-decoration-none">
                                                {{ $forum->name }}
                                            </a>
                                        </h6>
                                        <p class="mb-2 text-muted small">
                                            {{ Str::limit($forum->description ?? 'No description available.', 120) }}
                                        </p>
                                        <div class="small text-muted mb-2">
                                            {{ \Carbon\Carbon::parse($forum->created_at)->format('d M, Y') }}
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                                            <div class="d-flex align-items-center gap-3 small text-muted">
                                                <span><i class="bi bi-hand-thumbs-up"></i>
                                                    {{ $forum->like_count ?? 0 }}</span>
                                                <span><i class="bi bi-chat"></i> {{ $forum->comment_count ?? 0 }}</span>
                                            </div>
                                            <span class="badge bg-danger-soft text-danger">Expired</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="alert alert-info">No inactive forums available.</div>
                        </div>
                        @endforelse
                    </div>
                </div>
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
activateModal.addEventListener('show.bs.modal', function(event) {
    const button = event.relatedTarget;
    const forumId = button.getAttribute('data-forum-id');
    const forumName = button.getAttribute('data-forum-name');

    document.getElementById('modal-forum-id').value = forumId;
    document.getElementById('modal-forum-name').textContent = forumName;
});
</script>

@endsection