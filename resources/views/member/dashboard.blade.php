@extends('layouts.member') {{-- Make sure this layout exists --}}

@section('content')
<div class="main__body">
    <div class="sidebar left-sidebar">
        <!-- @include('member.partials.sidebar') {{-- Move sidebar HTML here --}} -->
    </div>

    <div class="feed main-content">
        {{-- Story reel --}}
        <div class="storyReel">
            @foreach($stories as $story)
                <div class="story" style="background-image: url('{{ asset("storage/{$story->cover}") }}')">
                    <img class="story__avatar" src="{{ asset("storage/{$story->avatar}") }}">
                    <h4>{{ $story->username }}</h4>
                </div>
            @endforeach
        </div>

        {{-- Message Sender --}}
        @include('member.partials.message_sender')

        {{-- Posts --}}
        <div id="loadmore">
            @foreach($posts as $post)
                @include('member.partials.post', ['post' => $post])
            @endforeach
        </div>
    </div>

    <div class="sidebar right-sidebar">
        @include('member.partials.trending') {{-- trending videos or similar --}}
    </div>
</div>
@endsection

@section('scripts')
<script>
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
    });

    function like(id) {
        var currentLikes = parseInt($('#clike' + id).val()) || 0;
        $.post("{{ route('member.post.like') }}", {id}, function() {
            $('#likea' + id).html('<i class="bi bi-hand-thumbs-up-fill" style="color:blue"></i> ' + (currentLikes + 1));
        });
    }

    function comment(id) {
        var commentText = $('#comm_text' + id).val();
        if (!commentText) return alert('Please enter comment text');
        $.post("{{ route('member.post.comment') }}", {id, comm_text: commentText}, function() {
            window.location.href = '/member/post/' + id;
        });
    }

    function revp_click(element) {
        var icon = $(element).find('i');
        var status = icon.data('status');
        var event_id = icon.data('event-id');

        $.post("{{ route('member.rsvp.update') }}", {event_id, status}, function() {
            $(element).closest('.approve').find('.rsvp-icon i').css('color', 'grey');
            if (status === 'yes') icon.css('color', 'green');
            else if (status === 'maybe') icon.css('color', 'yellow');
            else if (status === 'no') icon.css('color', 'red');
            alert('RSVP updated successfully!');
        }).fail(function() {
            alert('Error updating RSVP. Please try again.');
        });
    }
</script>
@endsection

@section('styles')
<style>
    /* Paste the combined styles from Part 4, 5, 6 here */
</style>
@endsection
