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
                                <a href="#" class="btn btn-primary">Add Role & Permission</a>
                            </div>
                        </div>
                    </div>

                <hr>
                <div class="table-responsive overflow-auto">
                        <table class="table table-striped table-bordered align-middle text-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
        <!-- end Zero Configuration -->
    </div>
</div>
@endsection