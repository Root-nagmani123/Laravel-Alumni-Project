@extends('admin.layouts.master')

@section('title', 'User Management - Alumni | Lal Bahadur Shastri National Academy of Administration')

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
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">
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
                <th style="width:150px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example Row -->
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>john@example.com</td>
                <td>
                    <span class="badge bg-primary">Admin</span>
                </td>
                <td>
                    <span class="badge bg-success">Create</span>
                    <span class="badge bg-info">Edit</span>
                    <span class="badge bg-warning text-dark">Delete</span>
                </td>
                <td>
                    <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editRoleModal">
                        <i class="bi bi-pencil"></i> Edit
                    </button>
                    <button class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-trash"></i> Remove
                    </button>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>Jane Smith</td>
                <td>jane@example.com</td>
                <td>
                    <span class="badge bg-secondary">Editor</span>
                </td>
                <td>
                    <span class="badge bg-success">Create</span>
                    <span class="badge bg-info">Edit</span>
                </td>
                <td>
                    <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editRoleModal">
                        <i class="bi bi-pencil"></i> Edit
                    </button>
                    <button class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-trash"></i> Remove
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Edit Role Modal -->
<div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
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
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="create" id="permCreate">
                            <label class="form-check-label" for="permCreate">Create</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="edit" id="permEdit">
                            <label class="form-check-label" for="permEdit">Edit</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="delete" id="permDelete">
                            <label class="form-check-label" for="permDelete">Delete</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
        <form>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoleModalLabel">Assign Role & Permissions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <!-- Select User -->
                    <div class="mb-3">
                        <label for="userSelect" class="form-label">User</label>
                        <select id="userSelect" class="form-select">
                            <option value="">-- Select User --</option>
                            <option value="1">John Doe (john@example.com)</option>
                            <option value="2">Jane Smith (jane@example.com)</option>
                            <option value="3">Mark Wilson (mark@example.com)</option>
                        </select>
                    </div>

                    <!-- Select or Create Role -->
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select id="roleSelect" class="form-select" onchange="toggleNewRole(this)">
                            <option value="">-- Select Role --</option>
                            <option value="Admin">Admin</option>
                            <option value="Editor">Editor</option>
                            <option value="User">User</option>
                            <option value="__new">+ Create New Role</option>
                        </select>

                        <!-- Hidden New Role Field -->
                        <input type="text" id="newRoleInput" class="form-control mt-2 d-none" placeholder="Enter new role name">
                    </div>

                    <!-- Permissions -->
                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <div class="d-flex flex-wrap gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="permCreate">
                                <label class="form-check-label" for="permCreate">Create</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="permEdit">
                                <label class="form-check-label" for="permEdit">Edit</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="permDelete">
                                <label class="form-check-label" for="permDelete">Delete</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="permView">
                                <label class="form-check-label" for="permView">View</label>
                            </div>
                        </div>
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
function toggleNewRole(select) {
    const newRoleInput = document.getElementById('newRoleInput');
    if (select.value === '__new') {
        newRoleInput.classList.remove('d-none');
    } else {
        newRoleInput.classList.add('d-none');
        newRoleInput.value = '';
    }
}
</script>
@endsection