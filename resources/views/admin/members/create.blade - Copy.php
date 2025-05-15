@extends('admin.layouts.master')

@section('title', 'Member - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Add Members</h4>
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
                                </span> | 
								<span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Bulk Add
                                </span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- start Person Info -->
            <div class="card">
                <form action="#">
                    <div>
                        <div class="card-body">
                            <!--/row-->
                            <h4 class="card-title">Add Members </h4>
                            <small class="form-control-feedback">Please add Member detail.</small>
                            <hr>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                     <input type="text" name="name" id="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Mobile</label>
                                   <input type="text" name="mobile" id="mobile" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="text" name="email" id="email" class="form-control">
                                </div>
                            </div>
													
							 <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="text" name="password" id="password" class="form-control">
                                </div>
                            </div>
							 <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password:</label>
                                    <input type="text" name="confirm_password" id="confirm_password" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Cadre</label>
                                      <input type="text" name="cadre" id="cadre" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Designation</label>
                                    <input type="text" name="designation" id="designation" class="form-control" placeholder="Designation">
                                </div>
                            </div>
							 <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Batch</label>
                                    <input type="text" name="batch" id="batch" class="form-control" placeholder="Designation">
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="card-body border-top">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                <button type="button" class="btn bg-danger-subtle text-danger ms-6">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end Person Info -->
        </div>
    </div>
</div>


@endsection