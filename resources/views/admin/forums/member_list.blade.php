@extends('admin.layouts.master')

@section('title', 'forums - Alumni | Lal Bahadur')

@section('content')

<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Member</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Member List
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
                            <h4>Member List</h4>
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
                                    <th scope="col">#</th>
                                    <th scope="col">Member Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>
                                @if(count($users) > 0)
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name ?? 'N/A' }}</td>
                                    <td>
                                        <div class="form-check form-switch d-inline-block">
                                            <input name="status-toggle" class="form-check-input status-toggle"
                                                type="checkbox" role="switch" data-table="forums_member"
                                                data-column="status" data-id="{{ $user->id }}"
                                                {{ $user->status == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{ route('forums.member.delete') }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <input type="hidden" name="forum_id" value="{{ $user->forums_id }}">
                                            <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                                            <button type="submit" class="btn btn-danger btn-sm delete-forum-btn"
                                                onclick="return confirm('Are you sure?')" @if($user->status == 1) disabled @endif>Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @else

                                @endif
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
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@if(session('success'))
<script nonce="{{ $cspNonce }}">toastr.success("{{ session('success') }}");
</script>
@endif

<script nonce="{{ $cspNonce }}">$(document).on('change', '.status-toggle', function() {
    let checkbox = $(this);
    let status = checkbox.prop('checked') ? 1 : 0;
    let memberId = checkbox.data('id');
 let row = $(this).closest('tr');
    $.ajax({
        url: '{{ route("forums.membertoggleStatus") }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            id: memberId,
            status: status
        },
        success: function(response) {
             if (status === 1) {
                    row.find('.delete-btn').attr('disabled', true);
                } else {
                    row.find('.delete-btn').removeAttr('disabled');
                }
            toastr.success(response.message); // ✅ show success message
            setTimeout(function() {
                 window.location.reload(); // ✅ reload the page to reflect changes
            }, 1000);
        },
        error: function(xhr) {
            toastr.error('Failed to update status.');
        }
    });
});
</script>
@endsection
