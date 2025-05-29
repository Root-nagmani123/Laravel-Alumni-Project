@extends('admin.layouts.master')

@section('title', 'Events - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Events</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Events
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
                            <h4 class="card-title">Events list</h4>
                        </div>
                        <div class="col-6">
                            <div class="float-end gap-2">
                                <a href="{{ route('events.create') }}" class="btn btn-primary">+ Add Events</a>
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
                                    <th class="col">Title</th>
                                    <th class="col">Description</th>
                                    <th class="col">Start DateTime</th>
                                    <th class="col">End DateTime</th>
                                    <th class="col">Location</th>
                                    <th class="col">Status</th>
                                    <th class="col">Actions</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                <tr class="odd">
                                    <td>{{ $event->title }}</td>
                                    <td>{{ $event->description }}</td>
                                    <td>{{ $event->start_datetime }}</td>
                                    <td>{{ $event->end_datetime }}</td>
                                    <td>{{ $event->location }}</td>
                                    <td>
                                        <div class="form-check form-switch d-inline-block">
                                            <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                                data-table="events" data-column="active_inactive"
                                                data-id="{{ $event->id }}" {{ $event->status == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>

                                    @php
                                    $event_datetime = \Carbon\Carbon::parse($event->start_datetime);
                                    $current_datetime = \Carbon\Carbon::now();
                                    @endphp

                                    <td>
                                        @if ($event_datetime > $current_datetime)
                                        <a href="{{ route('events.edit', $event->id) }}"
                                            class="btn btn-success text-white btn-sm">Edit</a>

                                        <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger text-white btn-sm"
                                                onclick="return confirm('Are you sure you want to delete?')">
                                                Delete
                                            </button>
                                        </form>
                                        @else
                                        <a
                                            class="btn d-flex bg-primary-subtle w-100 d-block text-primary " href="{{ route('events.rsvp', $event->id) }}">
                                            RSVP
                                            <span class="badge ms-auto text-bg-primary">Expired</span>
                                        </a>
                                        @endif


                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $events->links() }}

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
    $('.status-toggle').change(function (e) {
        let checkbox = $(this);
        let status = checkbox.prop('checked') ? 1 : 0;
        let eventId = checkbox.data('id');

        let confirmChange = confirm("Are you sure you want to " + (status ? "activate" : "deactivate") + "?");

        if (!confirmChange) {
            // Revert the checkbox state if cancelled
            checkbox.prop('checked', !status);
            return;
        }

        $.ajax({
            url: '{{ route("event.toggleStatus") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: eventId,
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
