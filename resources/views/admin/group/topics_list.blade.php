@extends('admin.layouts.master')

@section('title', 'Group - Alumni | Lal Bahadur')

@section('content')
<div class="container-fluid px-3">
    <h2>Topics in: {{ $pageName }}</h2>

    <div class="col-xl-12">
    @php $i = 0; @endphp

    @forelse ($topics as $topic)
        @php
            $i++;
            $creator = $topic->member_type == 1 ? 'Admin' : ($topic->member_type == 2 ? 'Member' : 'Unknown');
            $createdDate = \Carbon\Carbon::parse($topic->created_at)->timezone('Asia/Kolkata');
            $timeDiff = $createdDate->diffForHumans();
        @endphp

        <!-- Middle wrapper start -->

            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card rounded">
                        <div class="card-header">
                 <div class="d-flex align-items-center justify-content-between">
               <div class="d-flex align-items-center">
                <div class="col-md-2 me-1">

                <img class="img-xs img-fluid rounded-circle me-2"
                 src="{{ $topic->member && $topic->member->profile_pic
                        ? asset('storage/' . $topic->member->profile_pic)
                        : asset('feed_assets/images/avatar/07.jpg') }}"
                 alt="User">

                                </div>
    <div class="col-md-9">
    <div class="ms-2">
        <!-- <h6 class="mb-1 fw-semibold text-primary">{{ $topic->content }}</h6> -->
        <p class="mb-1 text-muted small">
            <i class="bi bi-person-circle me-1"></i> By {{ $topic->member->name ?? 'Unknown' }}
        </p>
        <p class="mb-0 text-muted text-sm">
            <i class="bi bi-clock me-1"></i>
            {{ \Carbon\Carbon::parse($topic->created_at)->diffForHumans() }}
        </p>
    </div>
</div>

                                    <div class="col-md-1 text-end">

                                        <!-- Edit button trigger modal -->
                                        <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#viewTopicModal{{ $topic->id }}" class="btn btn-sm btn-outline-primary me-2" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a> -->


                                        <!-- Delete form -->
                                        <form id="delete-form-{{ $topic->id }}"
                              action="{{ route('group.topics.delete', $topic->id) }}"
                              method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                    class="btn btn-sm btn-danger delete-topic-btn"
                                    data-id="{{ $topic->id }}"
                                    data-status="{{ $topic->status }}">
                                Delete
                            </button>

                        </form>

                                                                </div>
                                                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <p class="mb-3 tx-14">{{ $topic->content }}</p>
                             @php
            $validMedia = $topic->media->filter(function($media) {
            return file_exists(storage_path('app/public/' . $media->file_path));
            });

            $imageMedia = $validMedia->where('file_type', 'image')->values();
            $videoMedia = $validMedia->where('file_type', 'video')->values();

            $totalImages = $imageMedia->count();
            $totalVideos = $videoMedia->count();
            @endphp
                             @if($topic->video_link)
            {{-- Embedded YouTube Video --}}
            <div class="ratio ratio-16x9 mt-2">
                <iframe width="560" height="315" src="{{ $topic->video_link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            @elseif($totalVideos > 0)
            {{-- Uploaded Video Files --}}
            <div class="post-video mt-2">
                @foreach($videoMedia as $video)
                <video controls class="w-100 rounded mb-2" preload="metadata">
                    <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                @endforeach
            </div>
            @endif
            @if($totalImages === 1)
            <div class="post-img mt-2">
                <a href="{{ asset('storage/' . $imageMedia[0]->file_path) }}" class="glightbox"
                    data-gallery="post-gallery-{{ $topic->id }}">
                    <img src="{{ asset('storage/' . $imageMedia[0]->file_path) }}" loading="lazy" class="w-100"
                        alt="Post Image">
                </a>
            </div>
            @elseif($totalImages > 1)
            <div class="post-img d-flex justify-content-between flex-wrap gap-2 gap-lg-3 mt-2">
                @foreach($imageMedia->take(4) as $index => $media)
                <div class="position-relative" style="width: 48%;">
                    <a href="{{ asset('storage/' . $media->file_path) }}" class="glightbox"
                        data-gallery="post-gallery-{{ $post->id }}">
                        <img src="{{ asset('storage/' . $media->file_path) }}" alt="Post Image" loading="lazy"
                            class="w-100">
                    </a>
                    @if($index === 3 && $totalImages > 4)
                    {{-- Hidden extra images --}}
                    @foreach($imageMedia->slice(4) as $extra)
                    <a href="{{ asset('storage/' . $extra->file_path) }}" class="glightbox d-none"
                        data-gallery="post-gallery-{{ $post->id }}"></a>
                    @endforeach

                    {{-- Overlay link to trigger the rest of the images --}}
                    <a href="{{ asset('storage/' . $imageMedia[4]->file_path) }}"
                        class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white glightbox"
                        style="background-color: rgba(0,0,0,0.6); font-size: 2rem; cursor: pointer;"
                        data-gallery="post-gallery-{{ $post->id }}">
                        +{{ $totalImages - 4 }}
                    </a>
                    @endif
                </div>

                @endforeach
            </div>
            @endif
                        </div>

                        <!-- <div class="card-footer">
                            <div class="d-flex post-actions">
                                <a href="{{ url('group/topic_view/' . $topic->id) }}"
                                   class="d-flex align-items-center text-muted mr-4">
                                    <i class="bi bi-arrow-right"></i>
                                    <p class="d-none d-md-block ms-2 mb-1">Read more...</p>
                                </a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>

        <!-- repeater div -->
        @empty

        <div class="text-center">
            <p>No topics found.</p>
        </div>
    @endforelse
</div>


@endsection


@foreach ($topics as $topic)
<div class="modal fade" id="viewTopicModal{{ $topic->id }}" tabindex="-1" aria-labelledby="editTopicLabel{{ $topic->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
       <form method="POST" action="{{ route('group.topics_update', ['id' => $topic->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Use PUT for updating -->

                <div class="modal-header">
                    <h5 class="modal-title" id="editTopicModalLabel{{ $topic->id }}">Edit Topic</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- REPLICATE YOUR ENTIRE FORM FIELDS HERE, JUST LIKE YOU SHARED -->

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Group Name</label>
                        <div class="col-sm-9">
                            {{ $group->name }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Title</label>
                        <div class="col-sm-9">
                            <input type="text" name="title" class="form-control" value="{{ old('title', $topic->title) }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <textarea name="description" class="form-control" style="height: 100px">{{ old('description', $topic->description) }}</textarea>
                        </div>
                    </div>

                   <div class="row mb-3">
    <label class="col-sm-3 col-form-label">Image</label>
    <div class="col-sm-9">
        <!-- Existing image preview (if any) -->
        @if ($topic->images)
            <img id="imagePreview{{ $topic->id }}" src="{{ asset('storage/' . $topic->images) }}" alt="Topic Image" style="max-height: 100px; margin-bottom: 10px;">
        @else
            <img id="imagePreview{{ $topic->id }}" src="#" alt="Image Preview" style="display:none; max-height: 100px; margin-bottom: 10px;">
        @endif

                    <!-- Image input -->
                    <input type="file" name="images" class="form-control" onchange="previewImage(event, {{ $topic->id }})">
                </div>
            </div>

                   <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Status<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select name="status" class="form-select" required>
                                <option value="" disabled {{ old('status', $topic->status) === null ? 'selected' : '' }}>Select Status</option>
                                <option value="1" {{ old('status', $topic->status) == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $topic->status) == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
    </div>
  </div>
</div>
@endforeach
@section('scripts')
<script>
    document.querySelectorAll('.delete-topic-btn').forEach(button => {
        button.addEventListener('click', function () {
            const topicId = this.getAttribute('data-id');
            if (confirm('Are you sure you want to delete?')) {
                document.getElementById('delete-form-' + topicId).submit();
            }
        });
    });
</script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>

    $(document).ready(function () {
    // AJAX: Toggle member status with confirmation
    $('.status-toggle').change(function (e) {
        let checkbox = $(this);
        let status = checkbox.prop('checked') ? 1 : 0;
        let topicId = checkbox.data('id');

        let confirmChange = confirm("Are you sure you want to " + (status ? "activate" : "deactivate") + "?");

        if (!confirmChange) {
            // Revert the checkbox state if cancelled
            checkbox.prop('checked', !status);
            return;
        }

        $.ajax({
            url: '{{ route("group.topicToggleStatus") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: topicId,
                status: status
            },
            success: function (response) {
                toastr.success(response.message);
            },
            error: function () {
                toastr.error('Failed to update status.');
                // Optionally revert on failure
                checkbox.prop('checked', !status);
            }
        });
    });
});

function previewImage(event, topicId) {
        const input = event.target;
        const reader = new FileReader();

        reader.onload = function () {
            const imgElement = document.getElementById('imagePreview' + topicId);
            if (imgElement) {
                imgElement.src = reader.result;
                imgElement.style.display = 'block';
            }
        };

        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }

    </script>

@endsection
