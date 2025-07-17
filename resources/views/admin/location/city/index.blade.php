@extends('admin.layouts.master')

@section('title', 'Cities - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Cities</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Cities
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
                            <h4 class="card-title">City list</h4>
                        </div>
                        <div class="col-6">
                            <div class="float-end gap-2">
                                <a href="{{ route('admin.location.city.create') }}" class="btn btn-primary">+ Add City</a>
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
                                    <th>State</th>
                                    <th>Country</th>
                                    <th>Action</th>
                                    <th>Status</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>
                                @foreach($cities as $city)
                                <tr class="odd">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $city->name }}</td>
                                    <td>{{ $city->state->name ?? 'N/A' }}</td>
                                    <td>{{ $city->state->country->name ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('admin.location.city.edit', $city->id) }}"
                                            class="btn btn-success text-white btn-sm">Edit</a>
                                        <form action="{{ route('admin.location.city.destroy', $city->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger text-white btn-sm delete-btn"
                                                    onclick="return confirm('Are you sure you want to delete?')"
                                                    {{ $city->status == 1 ? 'disabled' : '' }}
                                                    data-city-id="{{ $city->id }}">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch d-inline-block">
                                            <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                                data-table="cities" data-column="active_inactive" data-id="{{ $city->id }}"
                                                {{ $city->status == 1 ? 'checked' : '' }}>
                                        </div>
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
        // AJAX: Toggle city status with confirmation
        $('.status-toggle').change(function (e) {
            let checkbox = $(this);
            let currentState = checkbox.prop('checked');
            let cityId = checkbox.data('id');

            let confirmChange = confirm("Are you sure you want to " + (currentState ? "activate" : "deactivate") + "?");

            if (!confirmChange) {
                // Revert the checkbox state if cancelled
                checkbox.prop('checked', !currentState);
                return;
            }

            $.ajax({
                url: "{{ route('admin.location.city.toggle-status', ':id') }}".replace(':id', cityId),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    toastr.success(response.message);
                    // Toggle delete button state
                    const deleteBtn = $(`.delete-btn[data-city-id="${cityId}"]`);
                    if (currentState) {
                        deleteBtn.prop('disabled', true);
                    } else {
                        deleteBtn.prop('disabled', false);
                    }
                },
                error: function () {
                    toastr.error('Failed to update status.');
                    // Revert on failure
                    checkbox.prop('checked', !currentState);
                }
            });
        });
    });
</script>

@endsection
