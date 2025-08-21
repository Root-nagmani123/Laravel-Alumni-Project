@extends('admin.layouts.master')

@section('title', 'Recents Topics - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Recent Topics</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Recent Topics
                                </span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="datatables">
        <!-- start Zero Configuration -->
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center g-3 mb-4">
                    <!-- Title -->
                    <div class="col-lg-3 col-md-6">
                        <h4 class="card-title mb-0">Recent Topics</h4>
                    </div>
                </div>

                <hr>
                <div class="dataTables_wrapper">
                    <div class="table-responsive-sm table-responsive-md table-responsive-lg">
                        <table class="table table-striped table-bordered align-middle dataTable w-100 text-nowwrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">S.No.</th>
                                    <th scope="col">Date - Time</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Activity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($userData))
    @foreach ($userData as $topic)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-break">{{ \Carbon\Carbon::parse($topic->created_at)->format('H:i') }}</td>
                                    <td class="text-break"><?= htmlentities($topic->member->name ?? 'Unknown') ?></td>
                                    <td class="text-break"> {{ $topic->title }}</td>
                                </tr>
                                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">No topics found.</td>
                </tr>
            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Zero Configuration -->
    </div>
</div>
@endsection