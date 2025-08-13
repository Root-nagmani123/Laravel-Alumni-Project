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
                    <div class="row">
                        <div class="col-3">
                            <label for="" class="form-label">Service</label>
                            <div class="mb-3">
                                <select name="service" id="service" class="form-select">
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
                        </div>
                        <div class="col-3">
                            <label for="" class="form-label">Batch</label>
                            <div class="mb-3">
                                <select name="batch" id="batch" class="form-select">
                                    <option value=''>Select Batch</option>
                                    @if($members->isEmpty())
                                    <option disabled>No Batches Available</option>
                                    @else
                                    @foreach($members as $member)
                                    @if($member->Year != '')
                                    <option value="{{ $member->Year }}">{{ $member->Year }}</option>
                                    @endif
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="" class="form-label">Cadre</label>
                            <div class="mb-3">
                                <select name="cadre" id="cadre" class="form-select">
                                    <option value=''>Select Cadre</option>
                                    @if($members->isEmpty())
                                    <option disabled>No Cadres Available</option>
                                    @else
                                    @foreach($members as $member)
                                    @if($member->Cadre != '')
                                    <option value="{{ $member->Cadre }}">{{ $member->Cadre }}</option>
                                    @endif
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="" class="form-label">Sector</label>
                            <div class="mb-3">
                                <select name="sector" id="sector" class="form-select">
                                    <option value=''>Select Sector</option>
                                    @if($members->isEmpty())
                                    <option disabled>No Sectors Available</option>
                                    @else
                                    @foreach($members as $member)
                                    @if($member->Sector != '')
                                    <option value="{{ $member->Sector }}">{{ $member->Sector }}</option>
                                    @endif
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <form action="" method="POST">
                        <div class="table-responsive">
                            <table class="bg-light table">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAll"></th>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Service</th>
                                        <th>Batch</th>
                                        <th>Cadre</th>
                                        <th>Sector</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($members->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center">No Members Found</td>
                                    </tr>
                                    @else
                                    @foreach($members as $member)
                                    <tr>
                                        <td> <input type="checkbox" class="row-checkbox"></td>
                                        <td>{{ $member->Name }}</td>
                                        <td>{{ $member->Email }}</td>
                                        <td>{{ $member->Service }}</td>
                                        <td>{{ $member->Batch }}</td>
                                        <td>{{ $member->Cadre }}</td>
                                        <td>{{ $member->Sector }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Mentor Request</button>
                    </form>
                </div>

                <!-- Tab 2: Mentee Form -->
                <div class="tab-pane fade" id="mentee" role="tabpanel">
                    <div class="row">
                        <div class="col-3">
                            <label for="" class="form-label">Service</label>
                            <div class="mb-3">
                                <select name="service" id="service" class="form-select">
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
                        </div>
                        <div class="col-3">
                            <label for="" class="form-label">Year</label>
                            <div class="mb-3">
                                <select name="year" id="year" class="form-select">
                                    <option value=''>Select Year</option>
                                    @if($members->isEmpty())
                                    <option disabled>No Years Available</option>
                                    @else
                                    @foreach($members as $member)
                                    @if($member->Year != '')
                                    <option value="{{ $member->Year }}">{{ $member->Year }}</option>
                                    @endif
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="" class="form-label">Cadre</label>
                            <div class="mb-3">
                                <select name="cadre" id="cadre" class="form-select">
                                    <option value=''>Select Cadre</option>
                                    @if($members->isEmpty())
                                    <option disabled>No Cadres Available</option>
                                    @else
                                    @foreach($members as $member)
                                    @if($member->Cadre != '')
                                    <option value="{{ $member->Cadre }}">{{ $member->Cadre }}</option>
                                    @endif
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="" class="form-label">Sector</label>
                            <div class="mb-3">
                                <select name="sector" id="sector" class="form-select">
                                    <option value=''>Select Sector</option>
                                    @if($members->isEmpty())
                                    <option disabled>No Sectors Available</option>
                                    @else
                                    @foreach($members as $member)
                                    @if($member->Sector != '')
                                    <option value="{{ $member->Sector }}">{{ $member->Sector }}</option>
                                    @endif
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <form action="" method="POST">
                        <div class="table-responsive">
                            <table class="bg-light table">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAll"></th>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Service</th>
                                        <th>Batch</th>
                                        <th>Cadre</th>
                                        <th>Sector</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($members->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center">No Members Found</td>
                                    </tr>
                                    @else
                                    @foreach($members as $member)
                                    <tr>
                                        <td> <input type="checkbox" class="row-checkbox"></td>
                                        <td>{{ $member->Name }}</td>
                                        <td>{{ $member->Email }}</td>
                                        <td>{{ $member->Service }}</td>
                                        <td>{{ $member->Batch }}</td>
                                        <td>{{ $member->Cadre }}</td>
                                        <td>{{ $member->Sector }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Mentee Request</button>
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
                    <ul class="list-group mb-3">
                        @php
                        $hasMentor = false;
                        @endphp

                        @foreach (array_merge($mentor_requests->toArray(), $mentor_connections->toArray()) as $mentor)
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

                    <h5>Mentees</h5>
                    <ul class="list-group">
                        @php
                        $hasMentee = false;
                        @endphp

                        @foreach (array_merge($mentee_requests->toArray(), $mentee_connections->toArray()) as $mentee)
                        @if ($mentee->status == 1)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $mentee->name }}</span>
                            <small>{{ $mentee->cadre }} | {{ $mentee->batch }}</small>
                        </li>
                        @php $hasMentee = true; @endphp
                        @endif
                        @endforeach

                        @unless($hasMentee)
                        <li class="list-group-item text-center">No mentees added</li>
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const selectAll = document.getElementById("selectAll");
    selectAll.addEventListener("change", function () {
        document.querySelectorAll('.row-checkbox').forEach(cb => {
            cb.checked = selectAll.checked;
        });
    });
});
</script>
@endsection