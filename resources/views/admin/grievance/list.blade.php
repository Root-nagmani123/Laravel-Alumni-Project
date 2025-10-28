@extends('admin.layouts.master')

@section('title', 'Grievances - Admin Panel')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Grievances / Feedback</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                               
                            </li>
                            <li class="breadcrumb-item active">Grievances</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title mb-3">Grievance List</h4>
            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0 text-nowrap" id="grievanceTable">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col">Type</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Message</th>
                        <th scope="col">Attachment</th>
                        <th scope="col">Status</th>
                        <th scope="col">Submitted By</th>
                        <th scope="col">Date</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($grievances as $index => $grievance)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td><span class="badge bg-info-subtle text-info fw-semibold">{{ ucfirst($grievance->type) }}</span></td>
                        <td class="fw-semibold">{{ $grievance->subject }}</td>
                        <td>{{ $grievance->name }}</td>
                        <td>
                            <a href="mailto:{{ $grievance->email }}" class="text-decoration-none text-primary">{{ $grievance->email }}</a>
                        </td>
                        <td>
                            <span title="{{ $grievance->message }}">{{ Str::limit($grievance->message, 80) }}</span>
                        </td>
                        <td>
                            @if($grievance->attachment)
                                <a href="{{ asset('storage/' . $grievance->attachment) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-paperclip me-1"></i> View
                                </a>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $statusClasses = [
                                    1 => 'bg-warning text-dark',
                                    2 => 'bg-primary text-white',
                                    3 => 'bg-success text-white',
                                ];
                                $statusTexts = [
                                    1 => 'Pending',
                                    2 => 'In Progress',
                                    3 => 'Resolved',
                                ];
                            @endphp
                            <span class="badge rounded-pill px-3 py-2 {{ $statusClasses[$grievance->status] }}">
                                {{ $statusTexts[$grievance->status] }}
                            </span>
                        </td>
                        <td>{{ optional($grievance->member)->name ?? '—' }}</td>
                        <td>{{ \Carbon\Carbon::parse($grievance->created_at)->format('d M Y') }}</td>
                        <td class="text-center">
                            <form action="{{ route('grievances.updateStatus', $grievance->id) }}" method="POST" class="d-inline">
                                @csrf
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <select name="status" class="form-select form-select-sm w-auto" aria-label="Select status" onchange="this.form.submit()">
                                        <option value="1" {{ $grievance->status == 1 ? 'selected' : '' }}>Pending</option>
                                        <option value="2" {{ $grievance->status == 2 ? 'selected' : '' }}>In Progress</option>
                                        <option value="3" {{ $grievance->status == 3 ? 'selected' : '' }}>Resolved</option>
                                    </select>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                            No grievance records found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection
