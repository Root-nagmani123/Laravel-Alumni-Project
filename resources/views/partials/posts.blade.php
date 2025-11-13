{{-- resources/views/user/partials/posts.blade.php --}}
@foreach($posts as $post)
    @include('partials.single_post', ['post' => $post])
@endforeach
