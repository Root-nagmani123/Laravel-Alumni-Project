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
    <x-session_message />
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

                            <div class="float-end gap-2" style="margin-left:20px;">

							<a href="{{ route('events.rsvp') }}" class="btn btn-primary">All RSVP</a>
                            </div>

                            <div class="float-end">
                                <a href="{{ route('events.create') }}" class="btn btn-primary">+ Add Events</a>
                            </div>

                        </div>

                    </div>
                    <hr>
                    <div id="zero_config_wrapper" class="dataTables_wrapper table-responsive"style="overflow-x: auto;">


                        <table id="zero_config"
                            class="table table-striped table-bordered align-middle dataTable"
                            aria-describedby="zero_config_info" >
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th class="col">Title</th>
                                    <th class="col">Description</th>
                                    <th class="col">Start DateTime</th>
                                    <th class="col">End DateTime</th>
                                    <th class="col">Venue</th>
                                    <th class="col">Event Image</th>
                                    <th class="col">Status</th>
                                    <th class="col">Actions</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                <tr class="odd">
                                    <td>{{ $event->title }}</td>
                                    <td>{{ \Illuminate\Support\Str::words(strip_tags($event->description), 20, '...') }}</td>
                                    <td>{{ $event->start_datetime ? \Carbon\Carbon::parse($event->start_datetime)->format('d M Y') : '' }}</td>
                                    <td>{{ $event->end_datetime ? \Carbon\Carbon::parse($event->end_datetime)->format('d M Y') : '' }}</td>
                                    <td>
                                        @if($event->venue === 'online')
                                            Online : <a href="{{ $event->url }}" target="_blank">{{ $event->url }}</a>
                                        @elseif($event->venue === 'physical')
                                          Physical:  {{ $event->location }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>

                                    <img class="avatar-img rounded-circle"
                                    src="{{ $event->image && $event->image ? asset('storage/' . $event->image) : asset('feed_assets/images/avatar/12.jpg') }}"
                                    alt="" height="70" width="70"></td>
                                     <td>
                                        <div class="form-check form-switch d-inline-block">
                                            <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                                data-table="events" data-column="active_inactive"
                                                data-id="{{ $event->id }}" {{ $event->status == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>

                                    @php
                                    $event_datetime = \Carbon\Carbon::parse($event->end_datetime);
                                    $current_datetime = \Carbon\Carbon::now();
                                    @endphp

                                    <td>
    <div class="d-flex gap-2">
        @if ($event_datetime > $current_datetime)
            {{-- Edit Button --}}
            <a href="{{ route('events.edit', encrypt($event->id)) }}" class="btn btn-success btn-sm">
                Edit
            </a>

            {{-- Delete Button --}}
            <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                    Delete
                </button>
            </form>
        @else
            {{-- Expired Badge --}}
            <span class="badge text-bg-primary align-self-center">Expired</span>
        @endif

        {{-- RSVP Button --}}
        <a href="{{ route('events.rsvp', $event->id) }}" class="btn btn-outline-primary btn-sm">
            RSVP
        </a>
    </div>
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
    $(document).on('change', '.status-toggle', function (e) {
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
            url: '{{ route("events.toggleStatus") }}',
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
