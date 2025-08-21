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
                </div>
            </div>
        </div>
        <!-- end Zero Configuration -->
    </div>


    <div class="row g-4">
        @foreach($forums as $forum)
        <div class="col-md-12 ">
            <div class="card rounded shadow-sm h-100">

                <!-- Card Header -->
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="mb-0">{{ $forum->name }}</h5>
                        <small class="text-muted">
                            Created By: {{ $forum->creator->name ?? 'Unknown' }} |
                            {{ $forum->created_at ? \Carbon\Carbon::parse($forum->created_at)->format('d-m-Y') : '' }}
                        </small>
                    </div>
                    <div class="form-check form-switch ms-3">
                        <input class="form-check-input status-toggle" type="checkbox" role="switch" data-table="forums"
                            data-column="active_inactive" data-id="{{ $forum->id }}"
                            {{ $forum->status == 1 ? 'checked' : '' }}>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <p class="mb-3">{{ $forum->description }}</p>
                    <div class="d-flex justify-content-between small text-muted">
                        <img src="{{ $forum->image_url }}" alt="">
                    </div>

                    <div class="d-flex justify-content-between small text-muted">
                        <span>
                            <strong>End Date:</strong>
                            @if($forum->end_date != null)
                            {{ \Carbon\Carbon::parse($forum->end_date)->format('d-m-Y') }}
                            @else
                            N/A
                            @endif
                        </span>
                        <span><strong>S.No:</strong> {{ $loop->iteration }}</span>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="card-footer border-top">
                    <div class="d-flex gap-4 mb-3">
                        <h6 class="mb-0">Likes ({{ $forum->likes_count ?? 0 }})</h6>
                        <h6 class="mb-0">Comments ({{ $forum->comments_count ?? 0 }})</h6>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('forums.forum.edit', $forum->id) }}" class="btn btn-sm btn-success">Edit</a>
                        <form action="{{ route('forums.forum.destroy', $forum->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to delete?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
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
    let confirmMessage = status ? "Are you sure you want to activate?" :
        "Are you sure you want to deactivate?";

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