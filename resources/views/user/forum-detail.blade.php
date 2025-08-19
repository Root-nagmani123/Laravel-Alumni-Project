@extends('layouts.app')

@section('title', $forum->name . ' - Forum | Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container">
    <div class="row g-4" style="margin-top: 100px;">
        <!-- Left Sidebar -->
        <div class="col-3">
            <!-- Advanced filter responsive toggler START -->
            <div class="d-flex align-items-center d-lg-none">
                <button class="border-0 bg-transparent" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasSideNavbar" aria-controls="offcanvasSideNavbar">
                    <span class="btn btn-primary"><i class="fa-solid fa-sliders-h"></i></span>
                    <span class="h6 mb-0 fw-bold d-lg-none ms-2">My profile</span>
                </button>
            </div>
            <!-- Advanced filter responsive toggler END -->

            <!-- Navbar START-->
            <nav class="navbar navbar-expand-lg mx-0">
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSideNavbar">
                    <!-- Offcanvas header -->
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close text-reset ms-auto" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>

                    <!-- Offcanvas body -->
                    <div class="offcanvas-body d-block px-2 px-lg-0">
                        <!-- Card START -->
                        <div class="card overflow-hidden">
                            <!-- Cover image -->
                            <div class="h-50px"
                                style="background-image:url({{asset('feed_assets/images/bg/01.jpg')}}); background-position: center; background-size: cover; background-repeat: no-repeat;">
                            </div>
                            <!-- Card body START -->
                            <div class="card-body pt-0">
                                <div class="text-center">
                                    <!-- Avatar -->
                                    @php
                                    $profileImage = '';
                                    $displayName = '';
                                    $designation = '';
                                    $profileLink = '#';

                                    if (Auth::guard('user')->check()) {
                                    // Member/user post
                                    $member = $post->member ?? null;

                                    $profileImage = $member && $member->profile_image
                                    ? asset('storage/' . $member->profile_image)
                                    : asset('feed_assets/images/avatar/07.jpg');

                                    $displayName = $member->name ?? 'Unknown';
                                    $designation = $member->designation ?? 'Unknown';
                                    $profileLink = route('user.profile.data', ['id' => $member->id ?? 0]);
                                    }
                                    else {
                                    // Default user profile
                                    $user = Auth::guard('user')->user();
                                    $profileImage = $user->profile_pic
                                    ? asset('storage/' . $user->profile_pic)
                                    : asset('feed_assets/images/07.png');

                                    $displayName = $user->name ?? 'Guest User';
                                    $designation = $user->designation ?? 'Guest';
                                    $profileLink = route('user.profile.data', ['id' => $user->id ?? 0]);
                                    }
                                    $user = Auth::guard('user')->user();
                                    $profileImage = $user->profile_pic ? asset('storage/' . $user->profile_pic) :
                                    asset('feed_assets/images/avatar-1.png');
                                    $displayName = $user->name ?? 'Guest User';
                                    $designation = $user->designation ?? 'Guest';
                                    $profileLink = route('user.profile.data', ['id' => $user->id ?? 0]);
                                    @endphp
                                    <div class="avatar avatar-lg mt-n5 mb-3">
                                        <a href="{{route('user.profile.data', ['id' => $user->id ?? 0])}}"><img
                                                class="avatar-img rounded-circle qwetyu"
                                                src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}"
                                                alt=""></a>
                                    </div>
                                    <!-- Info -->
                                    @if(Auth::guard('user')->check())
                                    <h5 class="mb-0"> <a
                                            href="{{route('user.profile.data', ['id' => Auth::guard('user')->user()->id])}}">{{ Auth::guard('user')->user()->name }}
                                        </a> </h5>
                                    @endif
                                    <small>{{ Auth::guard('user')->user()->designation }}</small>
                                    <ul class="list-inline mb-0 text-center text-sm-start mt-3 mt-sm-0">
                                        <li class="list-inline-item"><i class="bi bi-briefcase me-1"></i>
                                            {{ $user->current_designation }}
                                        </li>
                                        <li class="list-inline-item"><i class="bi bi-backpack me-1"></i>
                                            {{ $user->batch }}</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Card body END -->
                            <!-- Card footer -->
                            <div class="card-footer text-center py-2">
                                <a class="btn btn-link btn-sm"
                                    href="{{ route('user.profile.data', ['id' => $user->id]) }}">View Profile </a>
                            </div>
                        </div>
                        <!-- Card END -->
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">

            <div class="card card-body">

                <!-- Main Question -->
                <div class="d-flex align-items-center mb-3">
  <img src="{{ asset($forum->member_profile_image ? (\Illuminate\Support\Str::startsWith($forum->member_profile_image, 'storage/') ? $forum->member_profile_image : 'storage/' . ltrim($forum->member_profile_image, '/')) : 'feed_assets/images/avatar/07.jpg') }}" 
                 class="avatar rounded-circle me-3" 
                 alt="User">
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
                    <i id="likeThumb" class="bi bi-hand-thumbs-up " style="cursor:pointer;{{ !empty($forum->has_liked) ? 'color:#004a93;' : '' }}; ">Like</i>
                    <span id="likeCount">{{ $forum->likes->count() ? '('.$forum->likes->count().')' : '' }}</span>
                    
                </span>
                <span class="d-inline-flex align-items-center gap-1">
                    <i class="bi bi-reply me-1">Reply</i>
                    <span id="commentCount">{{ $forum->comments->count() ? '('.$forum->comments->count().')' : '' }}</span>
                </span>
            </div>
            @if($isOwner)
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editForumModal"><i class="bi bi-pencil-square me-1"></i>Edit</button>
                <form id="deleteForumForm" action="{{ route('user.forum.delete') }}" method="POST" class="m-0 p-0">
                    @csrf
                    <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                    <button type="button" class="btn btn-sm btn-outline-danger" id="deleteForumBtn"><i class="bi bi-trash me-1"></i>Delete</button>
                </form>
            </div>
            @endif
        </div>

                <hr class="my-4">

                 <!-- Comments (simple list, no dropdown) -->
                 @php $currentUserId = Auth::guard('user')->id(); @endphp
                 <div id="commentsList" data-update-url-template="{{ route('user.forum.comment.update', ['commentId' => 'COMMENT_ID']) }}" data-delete-url-template="{{ route('user.forum.comment.delete', ['commentId' => 'COMMENT_ID']) }}">
            @foreach($forum->comments as $index => $comment)
                @php
                       $commentPicPath = $comment->profile_pic
    ? asset($comment->profile_pic)
    : asset('feed_assets/images/avatar/07.jpg');


                @endphp
                <div class="d-flex align-items-start gap-3 mb-3 comment-item" data-comment-id="{{ $comment->id }}">
                    <img src="{{ asset($commentPicPath) }}" class="rounded-circle" alt="User" style="width:40px; height:40px; object-fit:cover;">
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <div class="d-flex align-items-center gap-2">
                                <h6 class="mb-0 fw-bold">{{ $comment->member_name }}</h6>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($comment->created_at)->format('d-m-y') }}</small>
                            </div>
                            @if((int)$currentUserId === (int)$comment->user_id)
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-sm btn-link text-secondary p-0 comment-edit" data-id="{{ $comment->id }}" title="Edit"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-sm btn-link text-danger p-0 comment-delete" data-id="{{ $comment->id }}" title="Delete"><i class="bi bi-trash"></i></button>
                            </div>
                            @endif
                        </div>
                        <div class="comment-text">{{ $comment->comment }}</div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Add Comment -->
        <div class="mb-4">
            <form id="commentForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="input-group">
                    <input id="commentInput" type="text" name="comment" class="form-control" placeholder="Write a comment..." required>
                    <button type="submit" class="btn btn-primary" title="Post"><i class="bi bi-send"></i></button>
                </div>
            </form>
        </div>

        <script>
            (function(){
                // Delete forum
                const delBtn = document.getElementById('deleteForumBtn');
                delBtn?.addEventListener('click', function(){
                    if(confirm('Delete this forum? This action cannot be undone.')){
                        document.getElementById('deleteForumForm').submit();
                    }
                });

                const likeThumb = document.getElementById('likeThumb');
                const likeCountEl = document.getElementById('likeCount');
                const commentCountEl = document.getElementById('commentCount');
                const forumId = {{ $forum->id }};
                const csrf = '{{ csrf_token() }}';
                let liked = {{ !empty($forum->has_liked) ? 'true' : 'false' }};

                function toggleThumbColor(isLiked){
                    likeThumb.style.color = isLiked ? '#dc3545' : '';
                }

                likeThumb?.addEventListener('click', async function(){
                    const url = liked ? '{{ route('user.forum.unlike', $forum->id) }}' : '{{ route('user.forum.like', $forum->id) }}';
                    try{
                        const res = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': csrf,
                                'Accept': 'application/json'
                            },
                            body: new URLSearchParams({})
                        });
                        if(!res.ok) throw new Error('Request failed');
                        const data = await res.json();
                        if(data && data.success){
                            liked = data.status === 'liked';
                            toggleThumbColor(liked);
                            if(typeof data.like_count !== 'undefined'){
                                likeCountEl.textContent = data.like_count;
                            }
                        }
                    }catch(e){ console.error(e); }
                });

                const form = document.getElementById('commentForm');
                const input = document.getElementById('commentInput');
                const commentsListEl = document.getElementById('commentsList');
                const updateTpl = commentsListEl?.getAttribute('data-update-url-template') || '';
                const deleteTpl = commentsListEl?.getAttribute('data-delete-url-template') || '';
                form?.addEventListener('submit', async function(ev){
                    ev.preventDefault();
                    const comment = input.value.trim();
                    if(!comment) return;
                    try{
                        const res = await fetch('{{ route('user.forum.comment', $forum->id) }}', {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': csrf,
                                'Accept': 'application/json',
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({ comment })
                        });
                        if(!res.ok) throw new Error('Request failed');
                        const data = await res.json();
                        if(data && data.success){
                            // Prepend simple comment item
                            const list = commentsListEl;
                            const profile = data.comment?.profile_pic ? data.comment.profile_pic : 'feed_assets/images/avatar/07.jpg';
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
                                   imgSrc = `{{ asset('') }}` + profile.replace(/^\/+/, ''); 
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
                            if(typeof data.comment_count !== 'undefined'){
                                commentCountEl.textContent = data.comment_count;
                            }
                            input.value = '';
                        }
                    }catch(e){ console.error(e); }
                });

                // Edit/Delete handlers via event delegation
                commentsListEl?.addEventListener('click', async function(ev){
                    const editBtn = ev.target.closest('.comment-edit');
                    const delBtn = ev.target.closest('.comment-delete');
                    if(editBtn){
                        const commentId = editBtn.dataset.id;
                        const item = editBtn.closest('.comment-item');
                        const textEl = item.querySelector('.comment-text');
                        if(item.querySelector('.comment-editing')) return;
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
                        saveBtn.addEventListener('click', async function(){
                            const newText = inputEl.value.trim();
                            if(!newText) return;
                            try{
                                const url = updateTpl.replace('COMMENT_ID', commentId);
                                const res = await fetch(url, {
                                    method: 'PUT',
                                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json', 'Content-Type': 'application/x-www-form-urlencoded' },
                                    body: new URLSearchParams({ comment: newText })
                                });
                                if(!res.ok) throw new Error('Update failed');
                                const data = await res.json();
                                if(data && data.success){
                                    textEl.textContent = newText;
                                }
                            }catch(e){ console.error(e); }
                            textEl.style.display = '';
                            editor.remove();
                        });
                        cancelBtn.addEventListener('click', function(){
                            textEl.style.display = '';
                            editor.remove();
                        });
                    }
                    if(delBtn){
                        const commentId = delBtn.dataset.id;
                        const item = delBtn.closest('.comment-item');
                        if(!confirm('Delete this comment?')) return;
                        try{
                            const url = deleteTpl.replace('COMMENT_ID', commentId);
                            const res = await fetch(url, {
                                method: 'DELETE',
                                headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }
                            });
                            if(!res.ok) throw new Error('Delete failed');
                            const data = await res.json();
                            if(data && data.success){
                                item.remove();
                                if(typeof data.comment_count !== 'undefined'){
                                    commentCountEl.textContent = data.comment_count;
                                }
                            }
                        }catch(e){ console.error(e); }
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
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <form id="editForumForm" method="POST" action="{{ route('user.forum.update', $forum->id) }}">
                   @csrf
                   <input type="hidden" name="_method" value="PUT">
                   <div class="modal-body">
                       <div id="editForumAlert" class="alert alert-danger d-none" role="alert"></div>
                       <div class="mb-3">
                           <label class="form-label">Title</label>
                           <input type="text" name="name" class="form-control" value="{{ $forum->name }}" required>
                       </div>
                       <div class="mb-3">
                           <label class="form-label">Description</label>
                           <textarea name="description" class="form-control" rows="4" required>{{ $forum->description }}</textarea>
                       </div>
                       <div class="mb-3">
                           <label class="form-label">End date</label>
                           <input type="date" name="end_date" class="form-control" value="{{ $forum->end_date ? \Carbon\Carbon::parse($forum->end_date)->format('Y-m-d') : '' }}">
                       </div>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
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
<script>
function toggleComments(topicId) {
    // This function can be used to show/hide comments if needed
    console.log('Toggle comments for topic: ' + topicId);
}
</script>
@endpush