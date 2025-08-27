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
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Subject</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Attachment</th>
                            <th>Status</th>
                            <th>Username</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($grievances as $index => $grievance)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><span class="badge bg-info">{{ ucfirst($grievance->type) }}</span></td>
                            <td>{{ $grievance->subject }}</td>
                            <td>{{ $grievance->name }}</td>
                            <td>{{ $grievance->email }}</td>
                            <td>{{ Str::limit($grievance->message, 100) }}</td>
                            <td>
                                @if($grievance->attachment)
                                    <a href="{{ asset('storage/' . $grievance->attachment) }}" target="_blank">View Attachment</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                 <!-- Current status badge -->
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

    <span class="badge {{ $statusClasses[$grievance->status] }}">
        {{ $statusTexts[$grievance->status] }}
    </span>

                            <form action="{{ route('grievances.updateStatus', $grievance->id) }}" method="POST">
                                @csrf
                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="1" {{ $grievance->status == 1 ? 'selected' : '' }}>Pending</option>
                                    <option value="2" {{ $grievance->status == 2 ? 'selected' : '' }}>In Progress</option>
                                    <option value="3" {{ $grievance->status == 3 ? 'selected' : '' }}>Resolved</option>
                                </select>
                            </form>
                            </td>
                            <td>{{ $grievance->member->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($grievance->created_at)->format('d-m-Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No grievance records found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
