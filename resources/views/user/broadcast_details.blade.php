@extends('layouts.app')

@section('title', 'Broadcast - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container">
    <div class="row g-4" style="margin-top: 4rem;">
        @include('partials.left_sidebar')
        <div class="col-9 vstack gap-4">
            <div class="card card-body">
                <div class="mb-4">
                    <h1 class="mb-2 h2">{{ $broadcast->title }}</h1>
                    @php
                    $description = $broadcast->description;
                    $wordCount = str_word_count(strip_tags($description));
                    @endphp

                    @if ($wordCount > 50)
                    <div x-data="{ expanded: false }" class="mt-4">
                        <p x-show="!expanded">
                            {{ \Illuminate\Support\Str::words($description, 50, '...') }}
                            <a href="#" @click.prevent="expanded = true" class="text-danger">Read more</a>
                        </p>
                        <p x-show="expanded" x-cloak>
                            {!! nl2br(e($description)) !!}
                            <a href="#" @click.prevent="expanded = false" class="text-danger">Show less</a>
                        </p>
                    </div>
                    @else
                    <p class="mt-4">{!! nl2br(e($description)) !!}</p>
                    @endif


                </div>
                @if ($broadcast->image_url)
                <img class="rounded w-100 mb-3" src="{{ route('secure.file', ['type'=>'broadcast','path'=>$broadcast->image_url]) }}"
                    alt="Broadcast Image" style="height: 400px; object-fit: cover;" loading="lazy" decoding="async">
                @endif

                @if ($broadcast->video_url)
                <div class="mb-3 rounded overflow-hidden" style="height: 400px;">
                    <iframe width="100%" height="100%"
                        src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::after($broadcast->video_url, 'v=') }}"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
                @endif


            </div>
        </div>
    </div>
</div>
@endsection