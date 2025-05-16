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
                            class="table table-striped table-bordered text-nowrap align-middle dataTable"
                            aria-describedby="zero_config_info">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Name: activate to sort column descending" style="width: 224.625px;">
                                        S.No.</th>
                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1"
                                        aria-label="Position: activate to sort column ascending"
                                        style="width: 225.875px;">Title</th>
                                    <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1"
                                        aria-label="Office: activate to sort column ascending"
                                        style="width: 106.453px;">Description</th>
                                        <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1"
                                        aria-label="Position: activate to sort column ascending"
                                        style="width: 225.875px;">Image</th>
									<th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1"
                                        aria-label="Salary: activate to sort column ascending"
                                        style="width: 85.8906px;">Status</th>
										
										  <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1"
                                        aria-label="Salary: activate to sort column ascending"
                                        style="width: 85.8906px;">Action</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>
                            @foreach($broadcasts as $index => $broadcast)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><b>{{ $broadcast->title }}</b></td>
                                <td>{{$broadcast->description}}</td>
                                <td class="sorting_1">
                                    <div class="d-flex align-items-center gap-6">
                                        @if($broadcast->image_url)
                                            <img src="{{ $broadcast->image_url }}" width="45" class="rounded-circle">
                                        @else
                                            <img src="{{ asset('assets/images/default-avatar.png') }}" width="45"                              class="rounded-circle">
                                        @endif
                                        <h6 class="mb-0">{{ $broadcast->title }}</h6>
                                    </div>
                                </td>
                                <td>
                                            <input type="checkbox"
                                                   class="status-toggle"
                                                   data-id="{{ $broadcast->id }}"
                                                   data-toggle="toggle"
                                                   data-on="Active"
                                                   data-off="Inactive"
                                                   data-onstyle="success"
                                                   data-offstyle="danger"
                                                   {{ $broadcast->status == 1 ? 'checked' : '' }}>
                                        </td>
                                <td>
                                    <div class="d-flex justify-content-start align-items-start gap-2">
                                        <a href="#"
                                            class="btn btn-success text-white btn-sm edit-broadcast-btn"
                                            data-id="{{ $broadcast->id }}"
                                            data-title="{{ $broadcast->title }}"
                                            data-description="{{ $broadcast->description }}"
                                            data-image="{{$broadcast->image_url}}"
                                            data-video="{{$broadcast->video_url}}"
                                            data-status="{{ $broadcast->status }}">
                                            Edit
                                        </a>
                                        <form id="delete-form-{{ $broadcast->id }}"
                                                action="{{ route('broadcasts.broadcast.destroy', $broadcast->id) }}"
                                                method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                        class="btn btn-danger btn-sm delete-broadcast-btn"
                                                        data-id="{{ $broadcast->id }}"
                                                        data-status="{{ $broadcast->status }}">
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
<div class="modal fade" id="editBroadcastModal" tabindex="-1" aria-labelledby="editBroadcastModalLabel" aria-hidden="true">
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
            <label class="form-label">Current Image</label><br>
            <img id="current_image" src="" alt="No image" width="120" class="mb-2 rounded">
          </div>

          <div class="mb-3">
            <label for="edit_image" class="form-label">Update Image</label>
            <input type="file" class="form-control" name="image" id="edit_image" accept="image/*">
          </div>

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
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Edit Broadcast Modal Ends-->


@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        
    });
    // JS to update status via toggle
    $('.status-toggle').change(function () {
            let status = $(this).prop('checked') ? 1 : 0;
            let broadcastId = $(this).data('id');
            $.ajax({
                url: '{{ route("broadcasts.toggleStatus") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: broadcastId,
                    status: status
                },
                success: function (response) {
                     const deleteBtn = $(`.delete-broadcast-btn[data-id="${broadcastId}"]`);
                    deleteBtn.attr('data-status', status);
                    toastr.success(response.message);
                },
                error: function (xhr) {
                    toastr.error('Failed to update status.');
                }
            });
        });
        // Delete button handling
        document.addEventListener("DOMContentLoaded", function () {
        $('.delete-broadcast-btn').on('click', function () {
            const forumId = $(this).data('id');
    const status = $(this).attr('data-status');
    

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
                text: 'Delete this Broadcast?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${broadcast}`).submit();
                }
            });
        });
    });
    // POpulate update modal
    $(document).ready(function () {
        $('.edit-broadcast-btn').click(function () {
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
            if (image) {
                $('#current_image').attr('src', image).show();
            } else {
                $('#current_image').hide();
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
@endsection