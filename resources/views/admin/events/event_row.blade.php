<tr>
    <td>{{ $event->title }}</td>
    <td>{{ \Illuminate\Support\Str::words(strip_tags($event->description), 20, '...') }}</td>
    <td>{{ $event->start_datetime ? \Carbon\Carbon::parse($event->start_datetime)->format('d-m-Y') : '' }}</td>
    <td>{{ $event->end_datetime ? \Carbon\Carbon::parse($event->end_datetime)->format('d-m-Y') : '' }}</td>
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
            <input class="form-check-input status-toggle" type="checkbox" role="switch"
                data-table="events" data-column="active_inactive"
                data-id="{{ $event->id }}" {{ $event->status == 1 ? 'checked' : '' }}>
        </div>
    </td>
    <td>
        <div class="d-flex gap-2">
            @if (\Carbon\Carbon::parse($event->end_datetime) >= \Carbon\Carbon::now())
                {{-- Show Edit & Delete for Active --}}
                <a href="{{ route('events.edit', encrypt($event->id)) }}" class="btn btn-success btn-sm">Edit</a>
                <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            @endif

            {{-- RSVP always available --}}
            <a href="{{ route('events.rsvp', $event->id) }}" class="btn btn-outline-primary btn-sm">RSVP</a>
        </div>
    </td>
</tr>
