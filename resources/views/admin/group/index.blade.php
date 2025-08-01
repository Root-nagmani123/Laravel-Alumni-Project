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

                        <table id="zero_config"
                            class="table table-striped table-bordered align-middle dataTable"
                            aria-describedby="zero_config_info">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Topics</th>
                                    <th>Created By</th>
                                    <th>Group End Date</th>
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

                                     <td>
                                     <div class="d-flex gap-2">
                                        <a href="{{route('group.add_topic', ['id' => $group->id]) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Group Topics"><i class="bi bi-plus"></i></a>
                                        <a href="{{ route('group.topic.view' , ['id' => $group->id] )}}" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="View Group Topics"><i class="bi bi-eye"></i></a>
                                     </div>
                                     </td>
                                   <td>{{ \Carbon\Carbon::parse($group->created_at)->timezone('Asia/Kolkata')->format('l, d M Y, h:i A') }}</td>
                                   <td>
                                        @if($group->end_date != null)
                                            {{ \Carbon\Carbon::parse($group->end_date)->timezone('Asia/Kolkata')->format('l, d M Y') }}
                                        @endif
                                    </td>
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
                                <!--<form action="{{-- route('group.destroy', $group->id) --}}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                  </form>-->
                                       <form action="{{ route('group.destroy', $group->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger text-white btn-sm"
                                            onclick="return confirm('Are you sure you want to delete?')">
                                        Delete
                                    </button>
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
    //Toastr message
    /*$(document).ready(function() {
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

    }); */

    $(document).ready(function () {
    // AJAX: Toggle member status with confirmation
    $(document).on('change', '.status-toggle', function (e) {
        let checkbox = $(this);
        let status = checkbox.prop('checked') ? 1 : 0;
        let groupId = checkbox.data('id');

        let confirmChange = confirm("Are you sure you want to " + (status ? "activate" : "deactivate") + "?");

        if (!confirmChange) {
            // Revert the checkbox state if cancelled
            checkbox.prop('checked', !status);
            return;
        }

        $.ajax({
            url: '{{ route("group.toggleStatus") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: groupId,
                status: status
            },
            success: function (response) {
                toastr.success(response.message);
            },
            error: function () {
                toastr.error('Failed to update status.');
                // Optionally revert on failure
                checkbox.prop('checked', !status);
            }
        });
    });
});

</script>



@endsection
