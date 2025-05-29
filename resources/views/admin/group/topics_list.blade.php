@extends('admin.layouts.master')

@section('title', 'Group - Alumni | Lal Bahadur')

@section('content')
<div class="container">
    <h2>Topics in: {{ $pageName }}</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Created Date</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($topics as $topic)
                <tr>
                    <td>{{ $topic->title }}</td>

                    <td>{{ \Carbon\Carbon::parse($topic->created_date)->timezone('Asia/Kolkata')->format('l, d M Y, h:i A') }}</td>
                     <td>
                       <!-- <input type="checkbox"
                               class="status-toggle"
                               data-id="{{ $topic->id }}"
                               data-toggle="toggle"
                               data-on="Active"
                               data-off="Inactive"
                               data-onstyle="success"
                               data-offstyle="danger"
                               {{ $topic->status == 1 ? 'checked' : '' }}>-->
                                  <div class="form-check form-switch d-inline-block">
                                            <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                                data-table="group" data-column="active_inactive"  data-id="{{ $topic->id }}"
                                                {{ $topic->status == 1 ? 'checked' : '' }}>
                                        </div>
                    </td>

                    <td class="text-center">
                        <!-- Edit Button -->
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewTopicModal{{ $topic->id }}">
                            View/Edit
                        </button>

                        <!-- Delete Form -->
                        <form id="delete-form-{{ $topic->id }}"
                              action="{{ route('forums.topics.delete', $topic->id) }}"
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
                    </td>
                </tr>

                <!-- Include Modal Here (as you've written above) -->

            @empty
                <tr>
                    <td colspan="5" class="text-center">No topics found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection




{{--
@section('scripts')
@if(session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
@endif
@endsection--}}


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
//Toastr message
    /*$(document).ready(function() {
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

    }); */

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

    </script>

@endsection
