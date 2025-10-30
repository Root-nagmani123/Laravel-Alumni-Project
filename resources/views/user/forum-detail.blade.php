@extends('layouts.app')

@section('title', $forum->name . ' - Forum | Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container">
    <div class="row g-4" style="margin-top: 4rem;">
        <!-- Left Sidebar -->
        @include('partials.left_sidebar')

        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="card card-body">
                <!-- Main Question -->
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset($forum->member_profile_image ? (\Illuminate\Support\Str::startsWith($forum->member_profile_image, 'storage/') ? $forum->member_profile_image : 'storage/' . ltrim($forum->member_profile_image, '/')) : 'feed_assets/images/avatar/07.jpg') }}"
                        class="avatar rounded-circle me-3" alt="User">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 fw-bold">{{ $forum->member_name }}</h6>
                        <small class="text-muted">{{ \Carbon\Carbon::parse($forum->created_at)->format('d-m-y') }}
                        </small>
                    </div>
                </div>

                @php $isOwner = (int) (Auth::guard('user')->id()) === (int) ($forum->created_by ?? 0); @endphp
                <h4 id="forumTitle" class="fw-bold mb-2">{{ $forum->name }}</h4>
                <p id="forumDescription">{{ $forum->description }}</p>
                @php
                $likeUserList = $forum->likes->pluck('member.name')->filter();
                $likeUsersTooltip = $likeUserList->implode('<br>');
                $hasLiked = $forum->likes->contains('member_id', auth('user')->id());
                @endphp
                <!-- Actions -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="d-flex gap-3 small align-items-center">
                        <span class="d-inline-flex align-items-center gap-1">
                            <i id="likeThumb" class="bi bi-hand-thumbs-up "
                                style="cursor:pointer;{{ !empty($forum->has_liked) ? 'color:#004a93;' : '' }}; ">Like</i>
                            <span
                                id="likeCount">{{ $forum->likes->count() ? '('.$forum->likes->count().')' : '' }}</span>

                        </span>
                        <span class="d-inline-flex align-items-center gap-1">
                            <i class="bi bi-reply me-1">Reply</i>
                            <span
                                id="commentCount">{{ $forum->comments->count() ? '('.$forum->comments->count().')' : '' }}</span>
                        </span>
                    </div>
                    @if($isOwner)
                    <div class="d-flex align-items-center gap-2">
                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#editForumModal"><i class="bi bi-pencil-square me-1"></i>Edit</button>
                        <form id="deleteForumForm" action="{{ route('user.forum.delete') }}" method="POST"
                            class="m-0 p-0">
                            @csrf
                            <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                            <button type="button" class="btn btn-sm btn-outline-danger" id="deleteForumBtn"><i
                                    class="bi bi-trash me-1"></i>Delete</button>
                        </form>
                    </div>
                    @endif
                </div>

                <hr class="my-4">

                <!-- Comments (simple list, no dropdown) -->
                @php $currentUserId = Auth::guard('user')->id(); @endphp
                <div id="commentsList"
                    data-update-url-template="{{ route('user.forum.comment.update', ['commentId' => 'COMMENT_ID']) }}"
                    data-delete-url-template="{{ route('user.forum.comment.delete', ['commentId' => 'COMMENT_ID']) }}">
                    @foreach($forum->comments as $index => $comment)
                    @php
                    $commentPicPath = $comment->profile_pic
                        ? (Str::startsWith($comment->profile_pic, 'profile_pic')
                            ? route('profile.pic', $comment->profile_pic)
                            : asset('storage/' . ltrim($comment->profile_pic, '/')))

                        : asset('feed_assets/images/avatar/07.jpg');


                    @endphp
                    <div class="d-flex align-items-start gap-3 mb-3 comment-item" data-comment-id="{{ $comment->id }}">
                        <a href="{{ route('user.profile.data', ['id' => Crypt::encrypt($comment->user_id)]) }}">
                            <img src="{{ $commentPicPath }}" class="rounded-circle" alt="User"
                                style="width:40px; height:40px; object-fit:cover;">
                        </a>
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <div class="d-flex align-items-center gap-2">
                                    <a
                                        href="{{ route('user.profile.data', ['id' => Crypt::encrypt($comment->user_id)]) }}">
                                        <h6 class="mb-0 fw-bold">{{ $comment->member_name }}</h6>
                                    </a>
                                    <small
                                        class="text-muted">{{ \Carbon\Carbon::parse($comment->created_at)->format('d-m-y') }}</small>
                                </div>
                                @if((int)$currentUserId === (int)$comment->user_id)
                                <div class="d-flex align-items-center gap-2">
                                    <button class="btn btn-sm btn-link text-secondary p-0 comment-edit"
                                        data-id="{{ $comment->id }}" title="Edit"><i
                                            class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-sm btn-link text-danger p-0 comment-delete"
                                        data-id="{{ $comment->id }}" title="Delete"><i class="bi bi-trash"></i></button>
                                </div>
                                @endif
                            </div>

                            @php

                            $commentText = preg_replace_callback(
                            '/@([a-zA-Z0-9_.]+)/',
                            function ($matches) {
                            $username = $matches[1];
                            $user = \App\Models\Member::where('username', $username)->first(); // 👈 username se search
                            if ($user) {
                            $url = route('user.profile.data', ['id' => Crypt::encrypt($user->id)]);
                            return "<a href='{$url}' class='mention-badge text-primary fw-bold' data-bs-toggle='tooltip'
                                data-bs-placement='top' title='{$user->name} | {$user->designation}'>
                                @{$username}
                            </a>";
                            }
                            return "@{$username}";
                            },
                            e($comment->comment)
                            );
                            @endphp
                            <div class="comment-text">{!! $commentText !!}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Add Comment -->
                <div class="mb-4">
                    <form id="commentForm">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="input-group">
                            <input id="commentInput" type="text" name="comment" class="form-control"
                                placeholder="Write a comment..." required>
                            <button type="submit" class="btn btn-primary" title="Post"><i
                                    class="bi bi-send"></i></button>
                        </div>
                    </form>
                </div>

                <script nonce="{{ $cspNonce }}">                (function() {
                    // Delete forum
                    const delBtn = document.getElementById('deleteForumBtn');
                    delBtn?.addEventListener('click', function() {
                        if (confirm('Delete this forum? This action cannot be undone.')) {
                            document.getElementById('deleteForumForm').submit();
                        }
                    });

                    const likeThumb = document.getElementById('likeThumb');
                    const likeCountEl = document.getElementById('likeCount');
                    const commentCountEl = document.getElementById('commentCount');
                    const forumId = {{ $forum->id }};
                    const csrf = '{{ csrf_token() }}';
                    let liked = {{ !empty($forum->has_liked) ? 'true' : 'false' }};

                    function toggleThumbColor(isLiked) {
                        likeThumb.style.color = isLiked ? '#dc3545' : '';
                    }

                    likeThumb?.addEventListener('click', async function() {
                        const url = liked ? '{{ route('user.forum.unlike', $forum->id) }}' : '{{ route('user.forum.like', $forum->id) }}';
                        try {
                            const res = await fetch(url, {
                                method: 'POST',
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': csrf,
                                    'Accept': 'application/json'
                                },
                                body: new URLSearchParams({})
                            });
                            if (!res.ok) throw new Error('Request failed');
                            const data = await res.json();
                            if (data && data.success) {
                                liked = data.status === 'liked';
                                toggleThumbColor(liked);
                                if (typeof data.like_count !== 'undefined') {
                                    likeCountEl.textContent = data.like_count;
                                }
                            }
                        } catch (e) {
                            console.error(e);
                        }
                    });

                    const form = document.getElementById('commentForm');
                    const input = document.getElementById('commentInput');
                    const commentsListEl = document.getElementById('commentsList');
                    const updateTpl = commentsListEl?.getAttribute('data-update-url-template') || '';
                    const deleteTpl = commentsListEl?.getAttribute('data-delete-url-template') || '';
                    const profilePicRoute = "{{ route('profile.pic', ':filename') }}";
                    form?.addEventListener('submit', async function(ev) {
                        ev.preventDefault();
                        const comment = input.value.trim();
                        if (!comment) return;
                        try {
                            const res = await fetch('{{ route('user.forum.comment', $forum->id) }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'X-CSRF-TOKEN': csrf,
                                        'Accept': 'application/json',
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                    },
                                    body: new URLSearchParams({
                                        comment
                                    })
                                });
                            if (!res.ok) throw new Error('Request failed');
                            const data = await res.json();
                            if (data && data.success) {
                                // Prepend simple comment item
                                const list = commentsListEl;
                                const profile = data.comment?.profile_pic ? data.comment.profile_pic :
                                    'feed_assets/images/avatar/07.jpg';
                                const date = new Date(data.comment.created_at);
                                const day = String(date.getDate()).padStart(2, '0');
                                const month = String(date.getMonth() + 1).padStart(2, '0');
                                const year = String(date.getFullYear()).slice(-2); // last 2 digits
                                const created = `${day}-${month}-${year}`;
                                const item = document.createElement('div');
                                item.className = 'd-flex align-items-start gap-3 mb-3 comment-item';
                                item.dataset.commentId = data.comment.id;
                                let imgSrc;
                                if (/^https?:\/\//i.test(profile)) {
                                    imgSrc = profile;
                                } else {
                                    // const cleanFile = encodeURIComponent(profile);
                                    imgSrc = profilePicRoute.replace(':filename', profile);
                                }
                                item.innerHTML = `
                                <img src="${imgSrc}" class="rounded-circle" alt="User" style="width:40px; height:40px; object-fit:cover;">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div class="d-flex align-items-center gap-2">
                                            <h6 class="mb-0 fw-bold">${data.comment.member_name ?? 'You'}</h6>
                                            <small class="text-muted">${created}</small>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <button class="btn btn-sm btn-link text-secondary p-0 comment-edit" data-id="${data.comment.id}" title="Edit"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-sm btn-link text-danger p-0 comment-delete" data-id="${data.comment.id}" title="Delete"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </div>
                                    <div class="comment-text">${data.comment.comment}</div>
                                </div>`;
                                list?.prepend(item);
                                if (typeof data.comment_count !== 'undefined') {
                                    commentCountEl.textContent = data.comment_count;
                                }
                                input.value = '';
                            }
                        } catch (e) {
                            console.error(e);
                        }
                    });

                    // Edit/Delete handlers via event delegation
                    commentsListEl?.addEventListener('click', async function(ev) {
                        const editBtn = ev.target.closest('.comment-edit');
                        const delBtn = ev.target.closest('.comment-delete');
                        if (editBtn) {
                            const commentId = editBtn.dataset.id;
                            const item = editBtn.closest('.comment-item');
                            const textEl = item.querySelector('.comment-text');
                            if (item.querySelector('.comment-editing')) return;
                            const original = textEl.textContent.trim();
                            const editor = document.createElement('div');
                            editor.className = 'comment-editing mt-2';
                            editor.innerHTML = `
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" value="${original.replace(/"/g,'&quot;')}">
                                <button class="btn btn-success btn-save" type="button" title="Save"><i class="bi bi-check2"></i></button>
                                <button class="btn btn-outline-secondary btn-cancel" type="button" title="Cancel"><i class="bi bi-x"></i></button>
                            </div>`;
                            textEl.style.display = 'none';
                            textEl.after(editor);
                            const saveBtn = editor.querySelector('.btn-save');
                            const cancelBtn = editor.querySelector('.btn-cancel');
                            const inputEl = editor.querySelector('input');
                            saveBtn.addEventListener('click', async function() {
                                const newText = inputEl.value.trim();
                                if (!newText) return;
                                try {
                                    const url = updateTpl.replace('COMMENT_ID', commentId);
                                    const res = await fetch(url, {
                                        method: 'PUT',
                                        headers: {
                                            'X-Requested-With': 'XMLHttpRequest',
                                            'X-CSRF-TOKEN': csrf,
                                            'Accept': 'application/json',
                                            'Content-Type': 'application/x-www-form-urlencoded'
                                        },
                                        body: new URLSearchParams({
                                            comment: newText
                                        })
                                    });
                                    if (!res.ok) throw new Error('Update failed');
                                    const data = await res.json();
                                    if (data && data.success) {
                                        textEl.textContent = data.comment || newText;
                                    }
                                } catch (e) {
                                    console.error(e);
                                }
                                textEl.style.display = '';
                                editor.remove();
                            });
                            cancelBtn.addEventListener('click', function() {
                                textEl.style.display = '';
                                editor.remove();
                            });
                        }
                        if (delBtn) {
                            const commentId = delBtn.dataset.id;
                            const item = delBtn.closest('.comment-item');
                            if (!confirm('Delete this comment?')) return;
                            try {
                                const url = deleteTpl.replace('COMMENT_ID', commentId);
                                const res = await fetch(url, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'X-CSRF-TOKEN': csrf,
                                        'Accept': 'application/json'
                                    }
                                });
                                if (!res.ok) throw new Error('Delete failed');
                                const data = await res.json();
                                if (data && data.success) {
                                    item.remove();
                                    if (typeof data.comment_count !== 'undefined') {
                                        commentCountEl.textContent = data.comment_count;
                                    }
                                }
                            } catch (e) {
                                console.error(e);
                            }
                        }
                    });

                    // Edit Forum: standard form submission handles update
                })();
                </script>

                @if($isOwner)
                <!-- Edit Forum Modal -->
                <div class="modal fade" id="editForumModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Forum</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="editForumForm" method="POST"
                                action="{{ route('user.forum.update', $forum->id) }}">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="modal-body">
                                    <div id="editForumAlert" class="alert alert-danger d-none" role="alert"></div>
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="name" class="form-control" value="{{ $forum->name }}"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="4"
                                            required>{{ $forum->description }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">End date</label>
                                        <input type="date" name="end_date" class="form-control"
                                            value="{{ $forum->end_date ? \Carbon\Carbon::parse($forum->end_date)->format('Y-m-d') : '' }}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>

    </div>
</div>
@endsection

@push('scripts')
<script nonce="{{ $cspNonce }}">function toggleComments(topicId) {
    // This function can be used to show/hide comments if needed
    console.log('Toggle comments for topic: ' + topicId);
}
</script>
@endpush