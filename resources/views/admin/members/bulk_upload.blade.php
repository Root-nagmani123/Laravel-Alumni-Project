@extends('admin.layouts.master')

@section('title', 'Member Bulk upload - Alumni | Lal Bahadur Shastri National Academy of Administration')
@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Bulk Upload Members</h4>
                   {{-- @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif--}}
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
{{--@if ($errors->has('import_failures'))
    <div class="alert alert-danger">
        <h4>Import Errors:</h4>
        <ul>
            @foreach ($errors->get('import_failures') as $failures)
                @foreach ($failures as $failure)
                    <li>Row {{ $failure['row'] }}: {{ implode(', ', $failure['errors']) }}</li>
                @endforeach
            @endforeach
        </ul>
    </div>
@endif --}}
@if(session('failures'))
    <div class="alert alert-danger">
        <h4>Upload failed with the following errors:</h4>
        @foreach(session('failures') as $failure)
            <div class="mb-2">
                <strong>Row {{ $failure['row'] }}:</strong>
                <ul>
                    @foreach($failure['errors'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
@endif


    <div class="row">
        <div class="col-12">
            <!-- start Person Info -->
            <div class="card">
                <form action="{{ route('members.bulk_upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">Bulk Upload Members</h4>
                        <hr>
                        <div class="mb-2">
                    <a href="{{ asset('sample-members.csv') }}" class="btn btn-sm btn-link">
                        <i class="bi bi-download"></i> Download Sample CSV
                    </a>
                </div>
                       <div class="mb-3">
                    <label class="form-label">Choose Excel or CSV file</label>
                            <input type="file" name="file" class="form-control" required>
                            <small class="form-text text-muted">
                                Supported file types: .csv, .xls, .xlsx | Max file size: 3MB
                            </small>
                            @error('file')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <hr>
                        <div class="mb-3 gap-2 float-end">
                            <button class="btn btn-primary" type="submit">
                                Upload
                            </button>
                            <a href="{{ route('members.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end Person Info -->
        </div>
    </div>
</div>

@endsection
