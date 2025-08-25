@extends('admin.layouts.master')

@section('title', 'Members - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Members</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Members
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
                <div class="row align-items-center g-3 mb-4">
                    <!-- Title -->
                    <div class="col-lg-3 col-md-6">
                        <h4 class="card-title mb-0">Member List</h4>
                    </div>

                    <!-- Search Form -->
                    <div class="col-lg-6 col-md-12">
                        <form method="GET" action="{{ route('members.index') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Search by name, username, email or mobile"
                                    value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">Search</button>
                                @if(request('search'))
                                <a href="{{ route('members.index') }}" class="btn btn-outline-secondary">Reset</a>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Action Buttons -->
                    <div
                        class="col-lg-3 col-md-6 text-lg-end text-md-start d-flex gap-2 justify-content-lg-end justify-content-md-start">
                        <a href="{{ route('members.create') }}" class="btn btn-success btn-md">
                            <i class="bi bi-person-plus"></i> Add Member
                        </a>
                        <a href="{{ route('members.bulk_upload') }}" class="btn btn-outline-primary btn-md">
                            <i class="bi bi-upload"></i> Bulk Upload
                        </a>
                    </div>
                </div>

                <hr>
                <div class="dataTables_wrapper">
                    <div class="table-responsive-sm table-responsive-md table-responsive-lg">
                        <table class="table table-striped table-bordered align-middle dataTable w-100 text-nowwrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">S.No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">UserName (LDAP)</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Service</th>
                                    <th scope="col">Sector</th>
                                    <th scope="col">Cadre, Batch</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($members as $member)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-break">{{ $member->name }}</td>
                                    <td class="text-break">{{ $member->username }}</td>
                                    <td class="text-break">{{ $member->email }}</td>
                                    <td class="text-break">{{ $member->mobile }}</td>
                                    <td class="text-break">{{ $member->Service }}</td>
                                    <td class="text-break">{{ $member->sector }}</td>
                                    <td class="text-break">{{ $member->cader }}, {{ $member->batch }}</td>
                                    <td>
                                        <a href="{{ route('members.edit', $member->id) }}" class="btn btn-success text-white btn-sm mb-1">Edit</a>
                                        <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger text-white btn-sm mb-1" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch d-inline-block">
                                            <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                                data-table="members" data-column="active_inactive"
                                                data-id="{{ $member->id }}" {{ $member->status == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3 d-flex justify-content-end">
                            {{ $members->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Zero Configuration -->
    </div>
</div>

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

$(document).ready(function() {
    // AJAX: Toggle member status with confirmation using event delegation
    $(document).on('change', '.status-toggle', function(e) {
        let checkbox = $(this);
        let status = checkbox.prop('checked') ? 1 : 0;
        let memberId = checkbox.data('id');

        let confirmChange = confirm("Are you sure you want to " + (status ? "activate" : "deactivate") +
            "?");

        if (!confirmChange) {
            // Revert the checkbox state if cancelled
            checkbox.prop('checked', !status);
            return;
        }

        $.ajax({
            url: '{{ route("members.toggleStatus") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: memberId,
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
</script>


@endsection