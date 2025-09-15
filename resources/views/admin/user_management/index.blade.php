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
                                        Add Role & Permission
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
                                        <th>Role</th>
                                        <th>Permissions</th>
                                        {{-- <th style="width:150px;">Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customRolePermissionMappings as $val)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $val->Member->name }}</td>
                                            <td>{{ $val->Member->email }}</td>
                                            <td>{{ $val->customRole->name }}</td>
                                            <td>
                                                @php
                                                    $jsonPermission = json_decode($val->permission_id, true);
                                                @endphp

                                                @foreach($jsonPermission as $val)
                                                    @if(App\Models\CustomPermissions::find($val))
                                                        <span class="badge text-bg-primary">{{ App\Models\CustomPermissions::find($val)->name }}</span>
                                                    @endif
                                                @endforeach
                                            </td>
                                            {{-- <td>
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editRoleModal">
                                                    Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteRoleModal">
                                                    Delete
                                                </button>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Edit Role Modal -->
                        <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form>
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Role & Permissions</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Role Dropdown -->
                                            <div class="mb-3">
                                                <label for="roleSelect" class="form-label">Role</label>
                                                <select id="roleSelect" class="form-select">
                                                    <option>Admin</option>
                                                    <option>Editor</option>
                                                    <option>User</option>
                                                </select>
                                            </div>

                                            <!-- Permissions Checkboxes -->
                                            <div class="mb-3">
                                                <label class="form-label">Permissions</label>
                                                
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

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
                            <h5 class="modal-title" id="addRoleModalLabel">Assign Role & Permissions</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">

                            <!-- Select User -->
                            <div class="mb-3">
                                <label for="userSelect" class="form-label d-block">User</label>
                                <select class="form-select select2-user-role" name="user_id"></select>
                            </div>

                            <!-- Select or Create Role -->
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select id="roleSelect" class="form-select" name="role" onchange="toggleNewRole(this)">
                                    {{-- <option value="">-- Select Role --</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Editor">Editor</option>
                                    <option value="User">User</option>
                                    <option value="__new">+ Create New Role</option> --}}
                                    <option value="">-- Select Role --</option>
                                    @foreach ($customRoles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>

                                <!-- Hidden New Role Field -->
                                <input type="text" id="newRoleInput" class="form-control mt-2 d-none"
                                    placeholder="Enter new role name">
                            </div>

                            <!-- Permissions -->
                            <div class="mb-3">
                                <label class="form-label">Permissions</label>
                                @foreach ($customPermissions as $permission)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $permission->id }}"
                                            id="perm{{ ucfirst($permission->name) }}" name="permissions[]">
                                        <label class="form-check-label"
                                            for="perm{{ ucfirst($permission->name) }}">{{ ucfirst($permission->name) }}</label>
                                    </div>
                                @endforeach
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

            });
        </script>
    @endpush