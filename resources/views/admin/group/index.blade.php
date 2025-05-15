@extends('admin.layouts.master')

@section('title', 'Group - Alumni | Lal Bahadur')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Group</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                Group
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
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-6">
                            <h4>Group</h4>
                        </div>
                        <div class="col-6">
                            <div class="float-end gap-2">
                                <a href="{{ route('group.create') }}" class="btn btn-primary">+ Add Group</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="zero_config_wrapper" class="dataTables_wrapper">
                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    blade
                    <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle dataTable" aria-describedby="zero_config_info">
                        <thead>
                            <!-- start row -->
                            <tr>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S.No.: activate to sort column descending" style="width: 224.625px;">
                                    S.No.
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 225.875px;">
                                    Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Topics: activate to sort column ascending" style="width: 106.453px;">
                                    Topics
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Created By: activate to sort column ascending" style="width: 106.453px;">
                                    Created By
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 85.8906px;">
                                    Status
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 85.8906px;">
                                    Action
                                </th>
                            </tr>
                            <!-- end row -->
                        </thead>
                        <tbody>
                            @foreach($groups as $index => $group) <!-- Added index for S.No. -->
                            <tr class="{{ $loop->odd ? 'odd' : 'even' }}">
                                <td>{{ $index + 1 }}</td> <!-- Display S.No. -->
                                <td>{{ $group->name }}</td>
                                <td>{{ $group->topics }}</td> <!-- Assuming you want to show topics -->
                                <td>{{ $group->created_by }}</td> <!-- Assuming you want to show created by -->
                                <td>{{ $group->status }}</td>
                                <td>
                                    <a href="{{ route('group.edit', $group->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('group.destroy', $group->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
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
