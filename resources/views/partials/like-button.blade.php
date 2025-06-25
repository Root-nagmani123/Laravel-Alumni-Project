@php
    $likeUsers = $post->likes->pluck('member.name')->filter()->join(', ');
@endphp

<form 
    action="{{ route('user.post.like', $post->id) }}" 
    method="POST" 
    class="like-form d-inline" 
    data-post-id="{{ $post->id }}"
>
    @csrf
    <button type="submit"
        class="btn btn-sm {{ $post->likes->contains('member_id', auth('user')->id()) ? 'btn-primary' : 'btn-primary' }}"
        title="{{ $likeUsers ?: 'No likes yet' }}">
        {{ $post->likes->contains('member_id', auth('user')->id()) ? 'Unlike' : 'Like' }}
    </button>
    <span class="ms-2 text-muted">
        {{ $post->likes->count() }} {{ Str::plural('Like', $post->likes->count()) }}
    </span>
</form>