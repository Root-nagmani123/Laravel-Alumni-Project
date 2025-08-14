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
                            <h4>Forums</h4>
                        </div>
                        <div class="col-6">
                            <div class="float-end gap-2">
                                <a href="{{ route('forums.create') }}" class="btn btn-primary">+ Add Forums</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="zero_config_wrapper" class="dataTables_wrapper">


                        <table id="zero_config" class="table table-striped table-bordered align-middle dataTable"
                            aria-describedby="zero_config_info">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <!-- <th>Members</th> -->
                                    <th>Topics</th>
                                    <th>Created At</th>
                                    <th>Forum End Date</th>
                                    <th>Action</th>
                                    <th>Status</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>
                                @foreach($forums as $forum)
                                <tr class="odd">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $forum->name }}</td>
                                    <!-- <td>
                                        <div class="d-flex gap-2">
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('forums.add_member', ['id' => $forum->id]) }}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Add Members">
                                                <i class="bi bi-plus"></i>
                                            </a>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('forums.view_member', ['id' => $forum->id]) }}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="View Members">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </div>
                                    </td> -->

                                    <td>
                                        <div class="d-flex gap-2">
                                            @if($forum->status == 1)
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('forums.add_topic', ['id' => $forum->id]) }}"
                                                title="Add Topic" data-bs-toggle="tooltip" data-bs-placement="top">
                                                <i class="bi bi-plus"></i>
                                            </a>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('forums.view_topic', ['id' => $forum->id]) }}"
                                                title="View Topic" data-bs-toggle="tooltip" data-bs-placement="top">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @else
                                            <button class="btn btn-sm btn-primary" disabled
                                                title="Add Topic (Inactive)">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                            <button class="btn btn-sm btn-success" disabled
                                                title="View Topic (Inactive)">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- <td>{{ \Carbon\Carbon::parse($forum->created_at)->timezone('Asia/Kolkata')->format('l, d M Y, h:i A') }} -->
                                    <td>
                                        {{ $forum->created_at ? \Carbon\Carbon::parse($forum->created_at)->format('d-m-Y') : '' }}
                                    </td>
                                    <td>
                                        @if($forum->end_date != null)
                                            <!-- {{ \Carbon\Carbon::parse($forum->end_date)->timezone('Asia/Kolkata')->format('l, d M Y') }} -->
                                              {{ \Carbon\Carbon::parse($forum->end_date)->format('d-m-Y') }}
                                        @endif
                                    </td>


                                    <!-- <td>
                                        <input class="form-check-input status-toggle" type="checkbox" role="switch" data-table="forum" data-column="active_inactive" data-id="1" checked="">
                                    </td> -->
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{route('forums.forum.edit', $forum->id) }}"
                                                class="btn btn-success btn-sm">Edit</a>
                                            <form action="{{ route('forums.forum.destroy', $forum->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger text-white btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>

                                        <div class="form-check form-switch d-inline-block">
                                            <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                                data-table="forums" data-column="active_inactive"
                                                data-id="{{ $forum->id }}" {{ $forum->status == 1 ? 'checked' : '' }}>
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



@endsection
@section('scripts')

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
// AJAX to Update the status
$(document).on('change', '.status-toggle', function() {
    let checkbox = $(this);
    let status = checkbox.prop('checked') ? 1 : 0;
    let forumId = checkbox.data('id');

    // Confirmation prompt
    let confirmMessage = status ? "Are you sure you want to activate?" : "Are you sure you want to deactivate?";

    if (!confirm(confirmMessage)) {
        // Revert the checkbox if cancelled
        checkbox.prop('checked', !status);
        return;
    }

    $.ajax({
        url: '{{ route("forums.toggleStatus") }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            id: forumId,
            status: status
        },
        success: function(response) {
            const deleteBtn = $(`.delete-forum-btn[data-id="${forumId}"]`);
            deleteBtn.attr('data-status', status);
            toastr.success(response.message);
            location.reload();

        },
        error: function(xhr) {
            toastr.error('Failed to update status.');
            checkbox.prop('checked', !status);
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
// Sweet Alerts ho handle deleting

/*document.addEventListener("DOMContentLoaded", function() {
    $('.delete-forum-btn').on('click', function() {
        const forumId = $(this).data('id');
        const status = $(this).attr('data-status');

        if (status != 1) {
            Swal.fire({
                icon: 'warning',
                title: 'Cannot Delete',
                text: 'Forum must be active to delete it!',
                confirmButtonColor: '#d33'
            });
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'Delete this forum and all its members, topics, and files?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${forumId}`).submit();
            }
        });
    });
});
*/
</script>
@endsection