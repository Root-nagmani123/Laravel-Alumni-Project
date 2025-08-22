@extends('admin.layouts.master')

@section('title', 'Registration - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Registration</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Registration
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
                            <h4>Registration List</h4>
                        </div>
                        <div class="col-6">
                            <!-- Incoming Requests Button -->
                            <div class="float-end gap-2">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#incomingRequestsModal">
                                    Incoming Requests
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="dataTables_wrapper">
                    <div class="table-responsive-sm table-responsive-md table-responsive-lg">
                        <table
                            class="table table-striped table-bordered align-middle dataTable w-100 text-nowwrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">S.No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Service</th>
                                    <th scope="col">Batch</th>
                                    <th scope="col">Cadre</th>
                                    <th class="col">Course Attended in LBSNAA</th>
                                    <th class="col">Profile Picture</th>
                                    <th class="col">Government ID</th>
                                    <th scope="col">Requested Date</th>
                                    <th scope="col">Approved Date</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td></td>
                                    <td class="text-break"></td>
                                    <td class="text-break"></td>
                                    <td class="text-break"></td>
                                    <td class="text-break"></td>
                                    <td class="text-break"></td>
                                    <td class="text-break"></td>
                                    <td class="text-break"></td>
                                    <td class="text-break"></td>
                                    <td class="text-break"></td>
                                    <td class="text-break"></td>
                                    <td class="text-break"></td>
                                    <td class="text-break"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Zero Configuration -->
    </div>
</div>
<!-- Incoming Requests Modal -->
<div class="modal fade" id="incomingRequestsModal" tabindex="-1" aria-labelledby="incomingRequestsLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="incomingRequestsLabel">Incoming Requests</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-nowrap">
                        <thead class="table-light">
                            <tr class="text-break">
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Service</th>
                                <th>Batch</th>
                                <th>Cadre</th>
                                <th>Course Attended in LBSNAA</th>
                                <th>Profile Picture</th>
                                <th>Government ID</th>
                                <th>Requested Date</th>
                                <th>Approved Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><img src="" class="img-thumbnail" width="50"></td>
                                <td><a href="" target="_blank" class="btn btn-sm btn-outline-info">View</a></td>
                                <td></td>
                                <td class="approved-date">-</td>
                                <td class="status">
                                    <span class="badge bg-warning">Pending</span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-success btn-sm action-btn" data-id=""
                                            data-action="approve">Approve</button>
                                        <button class="btn btn-danger btn-sm action-btn" data-id=""
                                            data-action="reject">Reject</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection