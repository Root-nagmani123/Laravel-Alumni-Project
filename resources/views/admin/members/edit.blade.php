@extends('admin.layouts.master')

@section('title', 'Member - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Edit Members</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Edit Members
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
            <!-- start Person Info -->
            <div class="card">
                <form action="{{ route('members.update', $member->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <h4 class="card-title">Edit Member</h4>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Name<span class="required text-danger text-danger" >*</span></label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $member->name) }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Mobile<span class="required text-danger text-danger" >*</span></label>
                                    <input type="text" name="mobile" class="form-control"
                                        value="{{ old('mobile', $member->mobile) }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Email<span class="required text-danger text-danger" >*</span></label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $member->email) }}">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Password (leave blank to keep current password)</label>
                                    <input type="password" name="password" class="form-control">
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                     @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Cadre<span class="required text-danger text-danger" >*</span></label>
                                    <input type="text" name="cader" class="form-control"
                                        value="{{ old('cadre', $member->cader) }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Designation<span class="required text-danger text-danger" >*</span></label>
                                    <input type="text" name="designation" class="form-control"
                                        value="{{ old('designation', $member->designation) }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Batch<span class="required text-danger text-danger" >*</span></label>
                                    <input type="number" name="batch" class="form-control"
                                        value="{{ old('batch', $member->batch) }}">
                                </div>
                            </div>
                        </div>
                        <hr>
                    <div class="mb-3 gap-2 float-end">
                        <button class="btn btn-primary" type="submit">
                            Update
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
