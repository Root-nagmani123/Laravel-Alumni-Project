@extends('admin.layouts.master')

@section('title', 'Country - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Edit Country</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Edit Country
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('admin.location.country.update', $country->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <h4 class="card-title">Edit Country</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Country Name</label><span class="required text-danger">*</span>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $country->name) }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Sort Name</label><span class="required text-danger">*</span>
                                    <input type="text" name="sortname" class="form-control"
                                        value="{{ old('sortname', $country->sortname) }}">
                                    @error('sortname')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3 gap-2 float-end">
                            <button class="btn btn-primary" type="submit">
                                Update
                            </button>
                            <a href="{{ route('admin.location.country') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection