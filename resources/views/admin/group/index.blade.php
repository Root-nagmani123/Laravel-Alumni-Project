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
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
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
                                <a href="{{ route('group.create') }}" class="btn btn-primary btn-sm">+ Add Group</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="zero_config_wrapper" class="dataTables_wrapper">

                        <table id="zero_config"
                            class="table table-striped table-bordered text-nowrap align-middle dataTable"
                            aria-describedby="zero_config_info">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Topics</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>
                                @foreach($groups as $index => $group)
                                <!-- Added index for S.No. -->
                                <tr class="{{ $loop->odd ? 'odd' : 'even' }}">
                                    <td>{{ $index + 1 }}</td> <!-- Display S.No. -->
                                    <td>{{ $group->name }}</td>
                                    <!--<td class="text-center"><a class="btn btn-sm btn-primary" href="{{-- route('group.add_topic', ['id' => $group->id]) --}}"><i class="bi bi-plus"></i></a>&nbsp;<a class="btn btn-sm btn-success" href="{{ route('group.topic.view' , ['id' => $group->id] )}}"><i class="bi bi-eye"></i></a></td>-->

                                     <td><a class="btn btn-sm btn-primary"
                                            href="{{route('group.add_topic', ['id' => $group->id]) }}"> <iconify-icon icon="solar:add-circle-bold"></iconify-icon></a>&nbsp;<a class="btn btn-sm btn-success"
                                            href="{{ route('group.topic.view' , ['id' => $group->id] )}}"> <iconify-icon icon="solar:eye-bold"></iconify-icon></a></td>
                                   <td>{{ \Carbon\Carbon::parse($group->created_at)->timezone('Asia/Kolkata')->format('l, d M Y, h:i A') }}</td>
                                    <td>
                                        <div class="form-check form-switch d-inline-block">
                                            <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                                data-table="group" data-column="active_inactive" data-id="{{ $group->id }}"
                                                {{ $group->status == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>

                                    <td>
                                        <a href="{{ route('group.edit', $group->id) }}"
                                            class="btn btn-success btn-sm">Edit</a>
                                       <form action="{{ route('group.destroy', $group->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function () {

        // Toastr message on page load
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        // AJAX: Toggle group status
        $('.status-toggle').change(function () {
            let status = $(this).prop('checked') ? 1 : 0;
            let groupId = $(this).data('id');

            $.ajax({
                url: '{{ route("group.toggleStatus") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: groupId,
                    status: status
                },
                success: function (response) {
                    // Optional: add a check for response.message
                    if(response.message){
                        toastr.success(response.message);
                    } else {
                        toastr.success('Status updated.');
                    }
                },
                error: function () {
                    toastr.error('Failed to update status.');
                }
            });
        });

    });
</script>



@endsection
