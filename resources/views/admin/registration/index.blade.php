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
                    </div>
                </div>

                <hr>
                <div class="table-responsive overflow-auto">
                        <table class="table table-striped table-bordered align-middle text-nowrap mb-0">
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
                                    <th scope="col">Action Taken Date</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requests as $request)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $request->name }}</td>
                                    <td>{{ $request->email }}</td>
                                    <td>{{ $request->mobile }}</td>
                                    <td>{{ $request->service }}</td>
                                    <td>{{ $request->batch }}</td>
                                    <td>{{ $request->cadre }}</td>
                                    <td>{{ $request->course_attended }}</td>
                                    <td>
                                        @if($request->photo)
                                        <a href="{{ route('secure.file', ['type'=>'register','path'=>$request->photo]) }}" target="_blank">View</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($request->govt_id)
                                        <a href="{{ route('secure.file', ['type'=>'register','path'=>$request->govt_id]) }}" target="_blank">View</a>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($request->created_at)->format('d-m-Y') }}</td>
                                    <td>{{ $request->approved_at ? \Carbon\Carbon::parse($request->approved_at)->format('d-m-Y') : 'N/A' }}</td>

                                 <td>
                                    @if($request->status == \App\Models\RegistrationRequest::STATUS_PENDING)
                                        <form action="{{ route('admin.registration_requests.update', $request->id) }}" method="POST" style="display:inline;" 
                                            onsubmit="return confirm('Are you sure you want to approve this request?');">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="{{ \App\Models\RegistrationRequest::STATUS_APPROVED }}">
                                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                        </form>

                                        <form action="{{ route('admin.registration_requests.update', $request->id) }}" method="POST" style="display:inline;" 
                                            onsubmit="return confirm('Are you sure you want to reject this request?');">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="{{ \App\Models\RegistrationRequest::STATUS_REJECTED }}">
                                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                        </form>
                                    @elseif($request->status == \App\Models\RegistrationRequest::STATUS_APPROVED)
                                        <button class="btn btn-success btn-sm" disabled>Approved</button>
                                    @elseif($request->status == \App\Models\RegistrationRequest::STATUS_REJECTED)
                                        <button class="btn btn-danger btn-sm" disabled>Rejected</button>
                                    @endif
                                </td>


                                    <td>
                                        @if($request->status == \App\Models\RegistrationRequest::STATUS_PENDING)
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($request->status == \App\Models\RegistrationRequest::STATUS_APPROVED)
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($request->status == \App\Models\RegistrationRequest::STATUS_REJECTED)
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
        <!-- end Zero Configuration -->
    </div>
</div>
</div>

@endsection