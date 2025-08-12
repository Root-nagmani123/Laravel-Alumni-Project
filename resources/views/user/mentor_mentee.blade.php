@extends('layouts.app')

@section('title', 'Mentor Mentee - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<style>
.select2-results__option {
    padding-left: 10px !important;
}

.select2-container {
    z-index: 1050 !important;
}
</style>

<div class="container">
    <div class="row g-4" style="margin-top:5rem !important;">
        <div class="bg-mode p-4 rounded shadow-sm">
            <h1 class="h4 mb-4">Mentor / Mentee</h1>

            <!-- Tabs Navigation -->
            <div class="overflow-auto">
                <ul class="nav nav-tabs mb-3 flex-nowrap" id="mentorMenteeTabs" role="tablist"
                    style="white-space: nowrap;">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="mentor-tab" data-bs-toggle="tab" data-bs-target="#mentor"
                            type="button" role="tab">Wants to become Mentor</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="mentee-tab" data-bs-toggle="tab" data-bs-target="#mentee"
                            type="button" role="tab">Wants to become Mentee</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Incoming-requests-tab" data-bs-toggle="tab"
                            data-bs-target="#requests_incoming" type="button" role="tab">Incoming Requests</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Outgoging-requests-tab" data-bs-toggle="tab"
                            data-bs-target="#requests_outgoing" type="button" role="tab">Outgoing Requests</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="connections-tab" data-bs-toggle="tab" data-bs-target="#connections"
                            type="button" role="tab">My Connections</button>
                    </li>
                </ul>
            </div>


            <!-- Tabs Content -->
            <div class="tab-content" id="mentorMenteeTabsContent">

                <!-- Tab 1: Mentor Form -->
                <div class="tab-pane fade show active" id="mentor" role="tabpanel">
                    <form action="{{ route('user.mentor.want_become_mentor') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Service</label>
                            <select class="form-select service" name="service" id="service" data-id="want_become_mentor"
                                required>
                                <option value=''>Select Service</option>
                                @if($members->isEmpty())
                                <option disabled>No Services Available</option>
                                @else
                                @foreach($members as $member)
                                @if($member->Service != '')
                                <option value="{{ $member->Service }}">{{ $member->Service }}</option>
                                @endif
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Year</label>

                            <select class="form-select year-select" name="year[]" multiple="multiple"
                                data-id="want_become_mentor" required>
                                <!-- Options will be added dynamically -->
                            </select>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Cadre</label>
                            <select class="form-select select2 cadre" name="cadre[]" multiple="multiple"
                                data-id="want_become_mentor" required>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sector</label>
                            <select class="form-select select2 sector" name="sector[]" multiple="multiple"
                                data-id="want_become_mentor" required>
                                <option value="" disabled>Select Sector</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Select Mentee</label>
                            <select class="form-select select2 mentees" multiple="multiple" id="mentees"
                                name="mentees[]" data-id="want_become_mentor" required>
                                <option value="" disabled>Select Mentees</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Mentor Request</button>
                    </form>
                </div>

                <!-- Tab 2: Mentee Form -->
                <div class="tab-pane fade" id="mentee" role="tabpanel">
                    <form action="{{ route('user.mentor.want_become_mentee') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Service</label>
                            <select class="form-select service" name="service" id="service" data-id="want_become_mentee"
                                required>
                                <option value=''>Select Service</option>
                                @if($members->isEmpty())
                                <option disabled>No Services Available</option>
                                @else
                                @foreach($members as $member)
                                @if($member->Service != '')
                                <option value="{{ $member->Service }}">{{ $member->Service }}</option>
                                @endif
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Year</label>
                            <select class="form-select year-select" name="year[]" multiple="multiple"
                                data-id="want_become_mentee" required>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cadre</label>
                            <select class="form-select select2 cadre" name="cadre[]" multiple="multiple"
                                data-id="want_become_mentee" required>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sector</label>
                            <select class="form-select select2 sector" name="sector[]" multiple="multiple"
                                data-id="want_become_mentee" required>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Select Mentor</label>
                            <select class="form-select select2 mentees" multiple="multiple" id="mentees"
                                name="mentees[]" data-id="want_become_mentee" required>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Submit Mentee Request</button>
                    </form>
                </div>

                <!-- Tab 3: Requests -->
                <div class="tab-pane fade" id="requests_incoming" role="tabpanel">
                    <h5>Mentor Requests</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Cadre</th>
                                <th>Year</th>
                                <th>Sector</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                            $filteredmentorRequests = $mentor_requests->filter(function($request) {
                            return $request->status == 2;
                            });
                            @endphp

                            @forelse ($filteredmentorRequests as $request)
                            <tr>
                                <td>{{ $request->name }}</td>
                                <td>{{ $request->cadre }}</td>
                                <td>{{ $request->batch }}</td>
                                <td>{{ $request->sector }}</td>
                                <td>
                                    <form method="POST" action="{{ route('user.request.update') }}" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $request->request_id }}">
                                        <input type="hidden" name="type" value="mentor">
                                        <input type="hidden" name="status" value="1">
                                        <button type="submit" class="btn btn-sm btn-success">Accept</button>
                                    </form>
                                    <form method="POST" action="{{ route('user.request.update') }}" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $request->request_id }}">
                                        <input type="hidden" name="type" value="mentor">
                                        <input type="hidden" name="status" value="3">
                                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No mentee requests</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>

                    <h5 class="mt-4">Mentee Requests</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Cadre</th>
                                <th>Year</th>
                                <th>Sector</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $filteredMenteeRequests = $mentee_requests->filter(function($request) {
                            return $request->status == 2;
                            });
                            @endphp

                            @forelse ($filteredMenteeRequests as $request)
                            <tr>
                                <td>{{ $request->name }}</td>
                                <td>{{ $request->cadre }}</td>
                                <td>{{ $request->batch }}</td>
                                <td>{{ $request->sector }}</td>
                                <td>
                                    <form method="POST" action="{{ route('user.request.update') }}" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $request->request_id }}">
                                        <input type="hidden" name="type" value="mentee">
                                        <input type="hidden" name="status" value="1">
                                        <button type="submit" class="btn btn-sm btn-success">Accept</button>
                                    </form>
                                    <form method="POST" action="{{ route('user.request.update') }}" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $request->request_id }}">
                                        <input type="hidden" name="type" value="mentee">
                                        <input type="hidden" name="status" value="3">
                                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No mentee requests</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>

                </div>
                <div class="tab-pane fade" id="requests_outgoing" role="tabpanel">
                    <h5>Outgoing Requests</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Cadre</th>
                                <th>Year</th>
                                <th>Sector</th>
                                <th>Type</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        @php
                        $filteredMentorRequests = $mentor_connections_outgoing->filter(function($request) {
                        $request->type = 'mentor';
                        return $request->status == 2 || $request->status == 3;
                        });
                        $filteredMenteeRequests = $mentee_connections_outgoing->filter(function($request) {
                        $request->type = 'mentee';
                        return $request->status == 2 || $request->status == 3;

                        });
                        $mergedRequests = array_merge($filteredMentorRequests->toArray(),
                        $filteredMenteeRequests->toArray());
                        @endphp

                        @forelse ($mergedRequests as $request)
                        <tr>
                            <td>{{ $request->name }}</td>
                            <td>{{ $request->cadre }}</td>
                            <td>{{ $request->batch }}</td>
                            <td>{{ $request->sector }}</td>
                            <td>{{ $request->type }}</td>
                            <td>
                                @if ($request->status == 2)
                                Pending
                                @elseif ($request->status == 3)
                                Rejected
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No outgoing requests</td>
                        </tr>
                        @endforelse
                    </table>

                </div>

                <!-- Tab 4: Connections -->
                <div class="tab-pane fade" id="connections" role="tabpanel">
                    <h5>Mentors</h5>
                    <div class="row mb-3">
                        <div class="col-3">
                            <label for="serviceFilter" class="form-label">Filter by Service:</label>
                            <select id="serviceFilter" class="form-select">
                                <option value="">All</option>
                                @php
                                $services = $members->pluck('Service')->unique()->filter();
                                @endphp
                                @foreach ($services as $Service)
                                <option value="{{ $Service }}">{{ $Service }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="batchFilter" class="form-label">Filter by Batch:</label>
                            <select id="batchFilter" name="batch" class="form-select">
                                <option value="">All</option>
                                @php
                                $batches = $members->pluck('batch')
                                ->filter(function($value) {
                                return !is_null($value) && $value !== '' && $value != 0;
                                })
                                ->unique()
                                ->sort(); // Sort numerically (ascending)
                                @endphp
                                @foreach ($batches as $batch)
                                <option value="{{ $batch }}">{{ $batch }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-3">
                            <label for="cadreFilter" class="form-label">Filter by Cadre:</label>
                            <select id="cadreFilter" class="form-select">
                                <option value="">All</option>
                                @php
                                $cadres = $members->pluck('cader')
                                ->filter(fn($value) => !is_null($value) && trim($value) !== '')
                                ->unique()
                                ->sort();
                                @endphp
                                @foreach ($cadres as $cadre)
                                <option value="{{ $cadre }}">{{ $cadre }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-3">
                            <label for="sectorFilter" class="form-label">Filter by Sector:</label>
                            <select id="sectorFilter" name="sector" class="form-select">
                                <option value="">All</option>
                                @php
                                use Illuminate\Support\Str;

                                $sectors = $members->pluck('sector')
                                ->map(function($value) {
                                return Str::of($value)->trim(); // remove leading/trailing spaces
                                })
                                ->filter(function($value) {
                                return !is_null($value) && $value !== '' && $value != '0';
                                })
                                ->unique()
                                ->sort(); // Sort alphabetically
                                @endphp

                                @foreach ($sectors as $sector)
                                <option value="{{ $sector }}">{{ $sector }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <table class="table" id="mentorTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Service</th>
                                <th>Sector</th>
                                <th>Cadre</th>
                                <th>Batch</th>
                                <th>Type</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mentor_connections as $mentor)
                            <tr>
                                <td>{{ $mentor->name }}</td>
                                <td></td>
                                <td></td>
                                <td>{{ $mentor->sector }}</td>
                                <td>{{ $mentor->cadre }}</td>
                                <td>{{ $mentor->batch }}</td>
                                <td>Mentor</td>
                                <td>
                                    @if ($mentor->status == 1)
                                    Active
                                    @elseif ($mentor->status == 2)
                                    Pending
                                    @elseif ($mentor->status == 3)
                                    Rejected
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @php
                    $hasMentee = false;
                    @endphp

                    @foreach ($mentee_connections as $mentee)
                    @if ($mentee->status == 1)
                    <tr>
                        <td>{{ $mentee->name }}</td>
                        <td>{{ $mentee->cadre }}</td>
                        <td>{{ $mentee->batch }}</td>
                        <td>{{ $mentee->sector }}</td>
                        <td>Mentee</td>
                        <td>
                            @if ($mentee->status == 1)
                            Active
                            @elseif ($mentee->status == 2)
                            Pending
                            @elseif ($mentee->status == 3)
                            Rejected
                            @endif
                        </td>
                    </tr>
                    @php $hasMentee = true; @endphp
                    @endif
                    @endforeach

                    @unless($hasMentee)
                    <li class="list-group-item text-center">No mentees added</li>
                    @endunless
                    </ul>


                    <h5>Mentees</h5>
                    <ul class="list-group">
                        @php
                        $hasMentor = false;
                        @endphp

                        @foreach ($mentor_connections as $mentor)
                        @if ($mentor->status == 1)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $mentor->name }}</span>
                            <small>{{ $mentor->cadre }} | {{ $mentor->batch }}</small>
                        </li>
                        @php $hasMentor = true; @endphp
                        @endif
                        @endforeach

                        @unless($hasMentor)
                        <li class="list-group-item text-center">No mentors added</li>
                        @endunless
                    </ul>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- Select2 -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Bootstrap Bundle (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous">
</script>

<!-- Filter Logic -->
<script>
$(document).ready(function() {
    var table = $('#mentorTable').DataTable();

    // Filter by Service
    $('#serviceFilter').on('change', function() {
        table.column(3).search(this.value).draw(); // 3 = Service column index
    });
    $('#sectorFilter').on('change', function() {
        table.column(6).search(this.value).draw(); // 4 = Sector column index
    });

    // Filter by Cadre
    $('#cadreFilter').on('change', function() {
        table.column(5).search(this.value).draw(); // 5 = Cadre column index
    });

    // Filter by Batch
    $('#batchFilter').on('change', function() {
        table.column(4).search(this.value).draw(); // 6 = Batch column index
    });
});
</script>
@endsection