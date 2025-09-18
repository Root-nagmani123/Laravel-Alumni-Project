@extends('admin.layouts.master')

@section('title', 'User Management - Alumni | Lal Bahadur Shastri National Academy of Administration')
<style>
    .select2-container {
        width: 100% !important;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title">User Management</h4>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                        <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                        User Management
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
                        <div class="row">
                            <div class="col-6">
                                <h4>User Management List</h4>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addRoleModal">
                                        Mark Moderator
                                    </a>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="table-responsive overflow-auto">
                            <table class="table table-striped table-bordered align-middle text-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width:50px;">#</th>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($moderators as $val)
                                        <tr>
                                            <td>{{ $moderators->firstItem() + $loop->index }}</td>
                                            <td>{{ $val->name }}</td>
                                            <td>{{ $val->email }}</td>
                                            <td>
                                                <div class="form-check form-switch d-inline-block">
                                                    <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                                        data-table="members" data-column="moderator_active_inactive"
                                                        data-id="{{ $val->id }}" {{ $val->moderator_active_inactive == 1 ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $moderators->links() }}



                    </div>
                </div>
                <!-- end Zero Configuration -->
            </div>
        </div>

        <!-- Add Role & Permission Modal -->
        <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="post" action="{{ route('admin.user_management.assign_role_permissions') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addRoleModalLabel">Mark Moderator</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">

                            <!-- Select User -->
                            <div class="mb-3">
                                <label for="userSelect" class="form-label d-block">User</label>
                                <select class="form-select select2-user-role" name="user_id"></select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script>

        </script>
@endsection

    @push('scripts')
        <script>
            function toggleNewRole(select) {
                const newRoleInput = document.getElementById('newRoleInput');
                if (select.value === '__new') {
                    newRoleInput.classList.remove('d-none');
                } else {
                    newRoleInput.classList.add('d-none');
                    newRoleInput.value = '';
                }
            }
            $(document).ready(function () {
                $('.select2-user-role').select2({
                    placeholder: '-- Select User --',
                    dropdownParent: $('#addRoleModal'),
                    ajax: {
                        url: "{{ route('admin.user_management.search') }}",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return { search: params.term };
                        },
                        processResults: function (data) {
                            return {
                                results: data.map(function (user) {
                                    return {
                                        id: user.id,
                                        text: user.name
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                });
                $(document).on('change', '.status-toggle', function(e) {
                    let checkbox = $(this);
                    let status = checkbox.prop('checked') ? 1 : 0;
                    let memberId = checkbox.data('id');

                    let confirmChange = confirm("Are you sure you want to " + (status ? "activate" :
                            "deactivate") +
                        "?");

                    if (!confirmChange) {
                        // Revert the checkbox state if cancelled
                        checkbox.prop('checked', !status);
                        return;
                    }

                    $.ajax({
                        url: '{{ route("admin.user_management.toggleStatus") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            user_id: memberId,
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
    @endpush