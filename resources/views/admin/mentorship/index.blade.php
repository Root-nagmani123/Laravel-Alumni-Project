@extends('admin.layouts.master')

@section('title', 'Mentorship Programme - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Mentorship Programme</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Mentorship Programme
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


                <div class="table-responsive">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Mentorship Programme</h4>
                        </div>
                    </div>
                    <hr>
                    <div>

                        <h5>Mentors</h5>
                        <ul class="list-group mb-3">

                            <li class="list-group-item d-flex justify-content-between">
                                <span></span>
                                <small></small>
                            </li>

                        </ul>


                        <h5>Mentees</h5>
                        <ul class="list-group">

                            <li class="list-group-item d-flex justify-content-between">
                                <span></span>
                                <small></small>
                            </li>

                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <!-- end Zero Configuration -->
    </div>
</div>
@endsection