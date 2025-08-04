@extends('admin.layouts.master')

@section('title', 'Mentorship Programme - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Create Mentorship Programme</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Create Mentorship Programme
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
    <div class="card">
        <form action="" method="POST">

            @csrf
            <div>
                <div class="card-body">
                    <h4 class="card-title">Add Mentorship / Mentee Programme</h4>
                    <small class="form-control-feedback">Please add Mentorship Programme detail.</small>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Name<span
                                        class="required text-danger text-danger">*</span></label>
                                <select name="name" id="" class="form-select">
                                    <option value="">Select Name</option>
                                    <option value="Mentor 1">Mentor</option>
                                    <option value="Mentor 2">Mentee</option>
                                </select>
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Service<span
                                        class="required text-danger text-danger">*</span></label>
                                <select name="service" id="" class="form-select">
                                    <option value="">Select Service</option>
                                    <option value="ias">IAS</option>
                                    <option value="ips">IPS</option>
                                    <option value="ifs">IFS</option>
                                    <option value="irs">IRS</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('service')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Year<span
                                        class="required text-danger text-danger">*</span></label>
                                <select name="year" id="" class="form-select">
                                    <option value="">Select Year</option>

                                </select>
                                @error('year')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Cadre<span
                                        class="required text-danger text-danger">*</span></label>
                                <select name="cadre" id="" class="form-control">
                                    <option value="">Select Cadre</option>
                                    <option value="AGMUT">AGMUT</option>
                                    <option value="ANDAMAN & NICOBAR ISLANDS">ANDAMAN & NICOBAR ISLANDS</option>
                                </select>
                                @error('cadre')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Sector<span
                                        class="required text-danger text-danger">*</span></label>
                                <select name="sector" id="sector" class="form-select">
                                    <option value="">Select Sector</option>
                                </select>
                                @error('sector')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Status</label>
                                <select name="status" id="" class="form-select">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                @error('status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-3 gap-2 float-end">
                        <button class="btn btn-primary" type="submit">
                            Save
                        </button>
                        <a href="{{ route('admin.mentorship.index') }}" class="btn btn-secondary">
                            Back
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection