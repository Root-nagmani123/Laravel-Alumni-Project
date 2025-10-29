@extends('admin.layouts.master')

@section('title', 'Group - Alumni | Lal Bahadur')

@section('content')
<div class="container-fluid px-3">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Topics in: {{ $group->name ?? '' }}</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Topics in: {{ $pageName }}
                                </span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

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
                    <div class="d-flex align-items-center gap-6">
                        <img src="{{ $topic->member && $topic->member->profile_pic
                                        ? asset('storage/' . $topic->member->profile_pic)
                                        : asset('feed_assets/images/avatar/07.jpg') }}" alt="prd1" width="48"
                            class="rounded">
                        <div>
                            <h6 class="mb-0">By
                                {{ $topic->member->name ?? 'Unknown' }}</h6>
                            <span>{{ \Carbon\Carbon::parse($topic->created_at)->diffForHumans() }}</span>
                        </div>
                        <div class="d-flex ms-auto text-end">

                            <div class="form-check form-switch d-inline-block me-2">
							<input class="form-check-input status-toggle"
								   type="checkbox"
								   role="switch"
								   data-id="{{ $topic->id }}"
								   {{ $topic->status == 1 ? 'checked' : '' }}>
						</div>
                            <form id="delete-form-{{ $topic->id }}" action="{{ route('group.topics.delete', $topic->id) }}"
                            method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger delete-topic-btn"
                                data-id="{{ $topic->id }}" data-status="{{ $topic->status }}">
                                Delete
                            </button>

                        </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <p class="mb-3">{{ $topic->content }}</p>
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
                        <iframe src="{{ $topic->video_link }}" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
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
                            <img src="{{ asset('storage/' . $imageMedia[0]->file_path) }}" loading="lazy" class="img-fluid rounded" style="max-height: 400px; object-fit: cover;"
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

     @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
	@endif

	@if (session('error'))
		<div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
			{{ session('error') }}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	@endif

    <!-- repeater div -->
    @empty

    <div class="text-center">
        <p>No topics found.</p>
    </div>
    @endforelse


    @endsection


    @foreach ($topics as $topic)
    <div class="modal fade" id="viewTopicModal{{ $topic->id }}" tabindex="-1"
        aria-labelledby="editTopicLabel{{ $topic->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('group.topics_update', ['id' => $topic->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Use PUT for updating -->

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
                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $topic->title) }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea name="description" class="form-control"
                                    style="height: 100px">{{ old('description', $topic->description) }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <!-- Existing image preview (if any) -->
                                @if ($topic->images)
                                <img id="imagePreview{{ $topic->id }}" src="{{ asset('storage/' . $topic->images) }}"
                                    alt="Topic Image" style="max-height: 100px; margin-bottom: 10px;">
                                @else
                                <img id="imagePreview{{ $topic->id }}" src="#" alt="Image Preview"
                                    style="display:none; max-height: 100px; margin-bottom: 10px;">
                                @endif

                                <!-- Image input -->
                                <input type="file" name="images" class="form-control"
                                    onchange="previewImage(event, {{ $topic->id }})">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Status<span class="required">*</span></label>
                            <div class="col-sm-9">
                                <select name="status" class="form-select" required>
                                    <option value="" disabled
                                        {{ old('status', $topic->status) === null ? 'selected' : '' }}>Select Status
                                    </option>
                                    <option value="1" {{ old('status', $topic->status) == '1' ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="0" {{ old('status', $topic->status) == '0' ? 'selected' : '' }}>
                                        Inactive</option>
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
    <script nonce="{{ $cspNonce }}">    document.querySelectorAll('.delete-topic-btn').forEach(button => {
        button.addEventListener('click', function() {
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

    <script nonce="{{ $cspNonce }}">    $(document).ready(function() {
        // AJAX: Toggle member status with confirmation
        $(document).on('change', '.status-toggle', function(e) {
            let checkbox = $(this);
            let status = checkbox.prop('checked') ? 1 : 0;
            let topicId = checkbox.data('id');

            let confirmChange = confirm("Are you sure you want to " + (status ? "activate" :
                "deactivate") + "?");

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
                success: function(response) {
                    toastr.success(response.message);
                },
                error: function() {
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

        reader.onload = function() {
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

<script nonce="{{ $cspNonce }}">    document.addEventListener("DOMContentLoaded", function () {
        const lightbox = GLightbox({
            selector: '.glightbox',
            touchNavigation: true,
            loop: true,
            zoomable: true,
        });
    });
</script>

<script nonce="{{ $cspNonce }}">document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete-media-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            let url = this.dataset.url; // <-- use the correct route
            if (!confirm("Are you sure you want to delete this image?")) return;

            fetch(url, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.closest('div.position-relative').remove();
                } else {
                    alert("Failed to delete image: " + (data.message || 'Unknown error'));
                }
            })
            .catch(err => {
                console.error(err);
                alert("An error occurred while deleting the image.");
            });
        });
    });
});

</script>


    @endsection
