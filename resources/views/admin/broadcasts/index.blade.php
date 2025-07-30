@extends('admin.layouts.master')

@section('title', 'Broadcasts - Alumni | Lal Bahadur')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Broadcasts</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Broadcasts
                                </span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
      @if(session('success'))
     <div class="alert alert-success">{{ session('success') }}</div>
    @endif
   @if (session('error'))
       <div class="alert alert-danger" style="color:white;">
         {{ session('error') }}
       </div>
    @endif
    <div class="datatables">
        <!-- start Zero Configuration -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-6">
                            <h4>Broadcasts</h4>
                        </div>
                        <div class="col-6">
                            <div class="float-end gap-2">
                                <a href="{{route('broadcasts.create')}}" class="btn btn-primary">+ Add Broadcasts</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="zero_config_wrapper" class="dataTables_wrapper">


                        <table id="zero_config"
                            class="table table-striped table-bordered align-middle dataTable"
                            aria-describedby="zero_config_info">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th class="col">S.No.</th>
                                    <th class="col">Title</th>
                                    <th class="col">Description</th>
                                    <th class="col">Image</th>
                                    <th class="col">Status</th>
                                    <th class="col">Action</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>
                                @foreach($broadcasts as $index => $broadcast)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><b>{{ $broadcast->title }}</b></td>
                                    <td>{{ \Illuminate\Support\Str::limit($broadcast->description, 50) }}</td>

                                    <td class="sorting_1">


                                        <div class="d-flex align-items-center gap-6">
                                        @if($broadcast->image_url)
                                        <img src="{{ asset('storage/' . $broadcast->image_url) }}" alt="Broadcast Image"  height="100" width="150">
                                        @else
                                        <img src="{{ asset('assets/images/no-image.png') }}" width="45"
                                        class="rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="No image available" alt="No image">
                                        @endif
                                           <!-- <h6 class="mb-0">{{ $broadcast->title }}</h6>-->
                                        </div>
                                    </td>
                                    <td>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                                data-table="news" data-column="status" checked=""
                                                data-id="{{ $broadcast->id }}"
                                                {{ $broadcast->status == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-start gap-2">
                                            <a href="javascript:void(0)" class="btn btn-success text-white btn-sm edit-broadcast-btn"
                                                data-id="{{ $broadcast->id }}" data-title="{{ $broadcast->title }}"
                                                data-description="{{ $broadcast->description }}"
                                                data-image="{{ asset('storage/' . $broadcast->image_url) }}"
                                                data-video="{{$broadcast->video_url}}"
                                                data-status="{{ $broadcast->status }}">
                                                Edit
                                            </a>
                                            <!-- <button class="btn btn-sm btn-primary edit-broadcast-btn"
                                                data-id="{{ $broadcast->id }}"
                                                data-title="{{ $broadcast->title }}"
                                                data-description="{{ $broadcast->description }}"
                                                data-image="{{ $broadcast->image_url }}"
                                                data-video="{{ $broadcast->video_url }}">
                                                Edit
                                            </button>-->
                                            <form action="{{ route('broadcasts.broadcast.destroy', $broadcast->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger text-white btn-sm"
                                            onclick="return confirm('Are you sure you want to delete?')">
                                        Delete
                                    </button>
                                    </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>


                    </div>
                </div>
            </div>
        </div>
        <!-- end Zero Configuration -->
    </div>
</div>
<!-- Edit Broadcast Modal -->
<div class="modal fade" id="editBroadcastModal" tabindex="-1" aria-labelledby="editBroadcastModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="editBroadcastForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBroadcastModalLabel">Edit Broadcast</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="broadcast_id" name="broadcast_id">

                    <div class="mb-3">
                        <label for="edit_title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="edit_title" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="edit_description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="ImageEdit" name="image" accept="image/*" >
                    </div>
{{-- asset('storage/' . $broadcast->image_url) --}}
			    <div class="mb-3">
                <label class="form-label">Current Image</label>
                <img id="current_image"
                src="{{ asset('assets/images/no-image.png') }}"
                alt="Current Image"
                width="120"
                class="mb-2 rounded"
                onerror="this.onerror=null; this.src='{{ asset('assets/images/no-image.png') }}';">
               </div>


                    <!--<div class="mb-3">
                        <label for="edit_image" class="form-label">Update Image</label>
                        <input type="file" class="form-control" name="image" id="edit_image" accept="image/*">
                    </div>-->

                    <div class="mb-3">
                        <label for="edit_video_url" class="form-label">Video URL</label>
                        <input type="url" class="form-control" name="video_url" id="edit_video_url">
                    </div>
                    <!-- View Video Section -->
                    <div class="mb-3" id="videoViewSection" style="display: none;">
                        <label class="form-label">Video Preview</label>
                        <div id="videoPreview" class="ratio ratio-16x9"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Broadcast</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Edit Broadcast Modal Ends-->


@endsection
@section('scripts')

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>

    $(document).ready(function () {
    // AJAX: Toggle member status with confirmation
    $(document).on('change', '.status-toggle', function (e) {
        let checkbox = $(this);
        let status = checkbox.prop('checked') ? 1 : 0;
        let broadcastId = checkbox.data('id');

        let confirmChange = confirm("Are you sure you want to " + (status ? "activate" : "deactivate") + "?");

        if (!confirmChange) {
            // Revert the checkbox state if cancelled
            checkbox.prop('checked', !status);
            return;
        }

        $.ajax({
            url: '{{ route("broadcasts.toggleStatus") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: broadcastId,
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

// Delete button handling
document.addEventListener("DOMContentLoaded", function() {
    $('.delete-broadcast-btn').on('click', function() {
        const broadcastId = $(this).data('id');
        const status = $(this).attr('data-status');


        if (status != 1) {
            Swal.fire({
                icon: 'warning',
                title: 'Cannot Delete',
                text: 'Broadcast must be active to delete it!',
                confirmButtonColor: '#d33'
            });
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'Delete this Broadcast?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${broadcastId}`).submit();
            }
        });
    });
});
// POpulate update modal
$(document).ready(function() {
    $('.edit-broadcast-btn').click(function() {
        const id = $(this).data('id');
        const title = $(this).data('title');
        const description = $(this).data('description');
        const image = $(this).data('image');
        const video = $(this).data('video');
        // Fill modal fields
        $('#broadcast_id').val(id);
        $('#edit_title').val(title);
        $('#edit_description').val(description);
        $('#edit_video_url').val(video);

        // Set current image
      /*  if (image) {
            $('#current_image').attr('src', image).show();
        } else {
            $('#current_image').hide();
        }*/

        const noImage = "{{ asset('assets/images/no-image.png') }}";
        if (image && image.trim() !== '') {
            $('#current_image').attr('src', image).show();
        } else {
            $('#current_image').attr('src', noImage).show();
        }

        let videoHtml = '';

        if (video) {
            if (video.includes('youtube.com/watch')) {
                const embedUrl = video.replace("watch?v=", "embed/");
                videoHtml = `<iframe src="${embedUrl}" frameborder="0" allowfullscreen></iframe>`;
            } else {
                videoHtml = `<video controls width="100%">
                                      <source src="${video}" type="video/mp4">
                                      Your browser does not support the video tag.
                                   </video>`;
            }

            $('#videoPreview').html(videoHtml);
            $('#videoViewSection').show();
        } else {
            $('#videoPreview').html('');
            $('#videoViewSection').hide();
        }

        // Set form action
        $('#editBroadcastForm').attr('action', `/admin/broadcasts/broadcast/${id}`);

        // Show modal
        $('#editBroadcastModal').modal('show');
    });
});

// Populate Update Modal Ends
</script>

<script>
// for Edit functionality
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#existingImage').attr('src', e.target.result).show();
        };

        reader.readAsDataURL(input.files[0]); // Convert image to base64
    }
}

$(document).ready(function() {
    // Handle image preview on file select
    $("#ImageEdit").change(function() {
        readURL(this);
    });
});


</script>

@endsection
