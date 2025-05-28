@extends('admin.layouts.master')

@section('title', 'forums - Alumni | Lal Bahadur')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Forums</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Forums
                                </span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="datatables">
        <!-- start Zero Configuration -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-6">
                            <h4>Topics in Forum: {{ $forum->name }}</h4>
                        </div>
                    </div>
                    <hr>
                    <div id="zero_config_wrapper" class="dataTables_wrapper">


                        <table id="zero_config"
                            class="table table-striped table-bordered text-nowrap align-middle dataTable"
                            aria-describedby="zero_config_info">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th>S.No.</th>
                                    <th>Title</th>
                                    <th>Created By</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                    <th>Status</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>
                                @forelse ($topics as $topic)
                                <tr>
                                    <td>{{$loop -> iteration}}</td>
                                    <td>{{ $topic->title }}</td>

                                    <td>{{ $topic->creator->name ?? 'Unknown' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($topic->created_date)->timezone('Asia/Kolkata')->format('l, d M Y, h:i A') }}
                                    </td>

                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#viewTopicModal{{ $topic->id }}">
                                            View/Edit
                                        </button>

                                        <form id="delete-form-{{ $topic->id }}"
                                            action="{{-- route('forums.topics.delete', $topic->id) --}}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger delete-topic-btn"
                                                data-id="{{ $topic->id }}" data-status="{{ $topic->status }}">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                     <td>
                                        <div class="form-check form-switch d-inline-block">
                                            <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                                data-table="group" data-column="active_inactive"
                                                {{ $topic->status == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal for Viewing/Editing Topic -->
                                <div class="modal fade" id="viewTopicModal{{ $topic->id }}" tabindex="-1"
                                    aria-labelledby="viewTopicModalLabel{{ $topic->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('forums.topics.update', $topic->id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Topic:<b> {{ $topic->title }}</b></h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <!-- Title -->
                                                    <div class="mb-3">
                                                        <label>Title</label><span class="required">*</span>
                                                        <input type="text" name="title" class="form-control"
                                                            value="{{ $topic->title }}">
                                                    </div>

                                                    <!-- Description -->
                                                    <div class="mb-3">
                                                        <label>Description</label><span class="required">*</span>
                                                        <textarea name="description" class="form-control"
                                                            rows="3">{{ $topic->description }}</textarea>
                                                    </div>

                                                    <!-- Image -->
                                                    <div class="mb-3">
                                                        <label>Current Image</label><br>
                                                        @if ($topic->images)
                                                        <img src="{{ asset('storage/uploads/images/' . $topic->images) }}"
                                                            class="img-fluid mb-2" style="max-height: 200px;">
                                                        @endif
                                                        <input type="file" name="images" accept="image/*"
                                                            class="form-control">
                                                    </div>

                                                    <!-- Photo Caption -->
                                                    <div class="mb-3">
                                                        <label>Photo Caption</label>
                                                        <input type="text" name="photo_caption" class="form-control"
                                                            value="{{ $topic->photo_caption ?? '' }}">
                                                    </div>

                                                    <!-- PDF File -->
                                                    <div class="mb-3">
                                                        <label>Current PDF</label><br>
                                                        @if ($topic->files)
                                                        <a href="{{ asset('storage/uploads/docs/' . $topic->files) }}"
                                                            target="_blank" rel="noopener noreferrer">View PDF</a><br>
                                                        @endif
                                                        <input type="file" name="doc" accept="application/pdf"
                                                            class="form-control">
                                                    </div>

                                                    <!-- Video -->
                                                    <div class="mb-3">
                                                        <label>Current Video</label><br>
                                                        @if ($topic->video)
                                                        <video width="100%" controls class="mb-2">
                                                            <source
                                                                src="{{ asset('storage/uploads/videos/' . $topic->video) }}"
                                                                type="video/mp4">
                                                        </video>
                                                        @endif
                                                        <input type="file" name="video" accept="video/mp4"
                                                            class="form-control">
                                                    </div>

                                                    <!-- Video Link -->
                                                    <div class="mb-3">
                                                        <label>Video Link (YouTube/Vimeo)</label>
                                                        @if (!empty($topic->video_link))
                                                        <a href="{{ $topic->video_link }}" target="_blank">View uploaded
                                                            video</a>
                                                        @else
                                                        <span>No video uploaded</span>
                                                        @endif
                                                        <input type="url" name="video_link" class="form-control"
                                                            value="{{ $topic->video_link }}">
                                                    </div>

                                                    <!-- Video Caption -->
                                                    <div class="mb-3">
                                                        <label>Video Caption</label>
                                                        <input type="text" name="video_caption" class="form-control"
                                                            value="{{ $topic->video_caption }}">
                                                    </div>

                                                    <!-- Status -->
                                                    <div class="mb-3">
                                                        <label>Status</label><span class="required">*</span>
                                                        <select name="status" class="form-select">
                                                            <option value="1"
                                                                {{ $topic->status == 1 ? 'selected' : '' }}>Active
                                                            </option>
                                                            <option value="0"
                                                                {{ $topic->status == 0 ? 'selected' : '' }}>Inactive
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Save
                                                            Changes</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No topics found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
        <!-- end Zero Configuration -->
    </div>
</div>

@endsection
@section('scripts')
@if(session('success'))
<script>
toastr.success("{{ session('success') }}");
</script>
@endif
<script>
$('.status-toggle').change(function() {
    let status = $(this).prop('checked') ? 1 : 0;
    let topicId = $(this).data('id');

    $.ajax({
        url: '{{ route("forums.TopictoggleStatus") }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            id: topicId,
            status: status
        },
        success: function(response) {
            $(`.delete-topic-btn[data-id="${topicId}"]`).data('status', status);
            toastr.success(response.message);
        },
        error: function(xhr) {
            toastr.error('Failed to update status.');
        }
    });
});
// AJAX to handle deleting topics
document.addEventListener("DOMContentLoaded", function() {
    $('.delete-topic-btn').on('click', function() {
        const topicId = $(this).data('id');
        const status = $(this).data('status');

        if (status != 1) {
            Swal.fire({
                icon: 'warning',
                title: 'Cannot Delete',
                text: 'Topic must be active to delete it!',
                confirmButtonColor: '#d33'
            });
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'Delete this Topic and all associated files?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${topicId}`).submit();
            }
        });
    });
});
</script>
@endsection
