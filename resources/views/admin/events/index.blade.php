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
                   @php
                        use Carbon\Carbon;

                        $current_datetime = Carbon::now();

                        // All events that haven't expired yet (active or inactive)
                        $ongoingEvents = $events->filter(function($event) use ($current_datetime) {
                            return Carbon::parse($event->end_datetime) >= $current_datetime;
                        });

                        // All expired events
                        $expiredEvents = $events->filter(function($event) use ($current_datetime) {
                            return Carbon::parse($event->end_datetime) < $current_datetime;
                        });
                    @endphp

                    <!-- Tabs -->
        <ul class="nav nav-tabs" id="eventTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="ongoing-tab" data-bs-toggle="tab"
                        data-bs-target="#ongoing" type="button" role="tab">
                    Ongoing Events
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="expired-tab" data-bs-toggle="tab"
                        data-bs-target="#expired" type="button" role="tab">
                    Expired Events
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-3" id="eventTabsContent">

            <!-- Ongoing Events -->
            <div class="tab-pane fade show active" id="ongoing" role="tabpanel" aria-labelledby="ongoing-tab">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Start DateTime</th>
                                <th>End DateTime</th>
                                <th>Mode</th>
                                <th>Event Image</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($ongoingEvents as $event)
<tr class="{{ $event->status == 0 ? 'table-secondary' : '' }}">
    <td>
        {{ $event->title }}
    </td>
    <td>{{ \Illuminate\Support\Str::words(strip_tags($event->description), 20, '...') }}</td>
    <td>{{ $event->start_datetime ? Carbon::parse($event->start_datetime)->format('d-m-Y') : '' }}</td>
    <td>{{ $event->end_datetime ? Carbon::parse($event->end_datetime)->format('d-m-Y') : '' }}</td>
    <td>
        @if($event->venue === 'online')
            Online: <a href="{{ $event->url }}" target="_blank">{{ $event->url }}</a>
        @elseif($event->venue === 'physical')
            Offline: {{ $event->location }}
        @else
            N/A
        @endif
    </td>
    <td>
        <img class="avatar-img rounded-circle"
             src="{{ $event->image ? route('secure.file', ['type' => 'event', 'path' => $event->image]) : asset('feed_assets/images/avatar/12.jpg') }}"
             alt="" height="70" width="70">
    </td>
    <td>
        <div class="form-check form-switch d-inline-block">
            <input class="form-check-input status-toggle" type="checkbox"
                   data-table="events" data-column="active_inactive"
                   data-id="{{ $event->id }}" {{ $event->status == 1 ? 'checked' : '' }}>
        </div>
    </td>
    <td>
        <div class="d-flex gap-2">
            <a href="{{ route('events.edit', encrypt($event->id)) }}"
               class="btn btn-success btn-sm">Edit</a>
            <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
            <a href="{{ route('events.rsvp', $event->id) }}"
               class="btn btn-outline-primary btn-sm">RSVP</a>
        </div>
    </td>
</tr>
@endforeach
                            @if($ongoingEvents->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center">No Ongoing Events</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Expired Events -->
            <div class="tab-pane fade" id="expired" role="tabpanel" aria-labelledby="expired-tab">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Start DateTime</th>
                                <th>End DateTime</th>
                                <th>Mode</th>
                                <th>Event Image</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($expiredEvents as $event)
<tr class="{{ $event->status == 0 ? 'table-secondary' : '' }}">
    <td>
        {{ $event->title }}
    </td>
    <td>{{ \Illuminate\Support\Str::words(strip_tags($event->description), 20, '...') }}</td>
    <td>{{ $event->start_datetime ? Carbon::parse($event->start_datetime)->format('d-m-Y') : '' }}</td>
    <td>{{ $event->end_datetime ? Carbon::parse($event->end_datetime)->format('d-m-Y') : '' }}</td>
    <td>
        @if($event->venue === 'online')
            Online: <a href="{{ $event->url }}" target="_blank">{{ $event->url }}</a>
        @elseif($event->venue === 'physical')
            Offline: {{ $event->location }}
        @else
            N/A
        @endif
    </td>
    <td>
        <img class="avatar-img rounded-circle"
             src="{{ $event->image ? route('secure.file', ['type' => 'event', 'path' => $event->image]) : asset('feed_assets/images/avatar/12.jpg') }}"
             alt="" height="70" width="70">
    </td>
    <td>
        <span class="badge text-bg-primary">Expired</span>
    </td>
    <td>
        <a href="{{ route('events.rsvp', $event->id) }}"
           class="btn btn-outline-primary btn-sm">RSVP</a>
    </td>
</tr>
@endforeach
                            @if($expiredEvents->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center">No Expired Events</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

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

<script nonce="{{ $cspNonce }}">//Toastr message
/*$(document).ready(function() {
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif

}); */

$(document).ready(function() {
    // AJAX: Toggle member status with confirmation
    $(document).on('change', '.status-toggle', function(e) {
        let checkbox = $(this);
        let status = checkbox.prop('checked') ? 1 : 0;
        let eventId = checkbox.data('id');

        let confirmChange = confirm("Are you sure you want to " + (status ? "activate" : "deactivate") +
            "?");

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
            success: function(response) {
                toastr.success(response.message);
            },
            error: function() {
                toastr.error('Failed to update status.');
                // Optionally revert on failure
                checkbox.prop('checked', !status);
            }
        });
    });
});
</script>


@endsection