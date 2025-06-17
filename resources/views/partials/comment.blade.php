<div class="single-comment-area {{ $comment->parent_id ? 'comment-item-nested ms-13 ms-sm-15 mt-4 mt-sm-7' : 'ms-1 ms-xxl-15' }}">
    <div class="d-flex gap-2 gap-sm-4 align-items-baseline">
        <div class="avatar-item">
            <img class="avatar-img max-un" src="{{ asset($comment->user->avatar ?? 'feed_assets/images/avatar-default.png') }}" alt="avatar">
        </div>
        <div class="info-item w-100">
            <div class="top-area px-4 py-3 d-flex gap-3 align-items-start justify-content-between">
                <div class="title-area">
                    <h6 class="m-0 mb-3"><a href="{{ route('public.profile', $comment->user->id) }}">{{ $comment->user->name }}</a></h6>
                    <p class="mdtxt">{{ $comment->body }}</p>
                </div>
                <div class="btn-group dropend cus-dropdown">
                    <button type="button" class="dropdown-btn" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="material-symbols-outlined fs-xxl m-0">more_horiz</i>
                    </button>
                    <ul class="dropdown-menu p-4 pt-2">
                        <li><a class="droplist d-flex align-items-center gap-2" href="#"><i class="material-symbols-outlined mat-icon">hide_source</i><span>Hide Comment</span></a></li>
                        <li><a class="droplist d-flex align-items-center gap-2" href="#"><i class="material-symbols-outlined mat-icon">flag</i><span>Report</span></a></li>
                    </ul>
                </div>
            </div>
            <ul class="like-share d-flex gap-6 mt-2">
                <li><button class="mdtxt">Like</button></li>
                <li><button class="mdtxt reply-btn">Reply</button></li>
                <li><button class="mdtxt">Share</button></li>
            </ul>

            {{-- Reply Form --}}
            <form action="{{ route('comment.reply', $comment->id) }}" method="POST" class="comment-form">
                @csrf
                <div class="d-flex gap-3 mt-3">
                    <input type="text" name="reply" placeholder="Write a reply..." class="py-3 w-100" required>
                    <button class="cmn-btn px-2 px-sm-5 px-lg-6">
                        <i class="material-symbols-outlined mat-icon m-0 fs-xxl">near_me</i>
                    </button>
                </div>
            </form>

            {{-- Recursive replies --}}
            @foreach($comment->replies as $reply)
                @include('partials.comment', ['comment' => $reply])
            @endforeach
        </div>
    </div>
</div>
