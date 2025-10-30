@extends('layouts.app')

@section('title', 'Mentor Mentee - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<style>
.select2-results__option {
    padding-left: 10px !important;
}

.select2-container {
    z-index: 1020 !important;
    display: block !important;
    display: block !important;
}

.backdrop-blur {
    backdrop-filter: blur(4px);
}
</style>

<div class="container">
    <div class="row g-4" style="margin-top:4rem !important;">
        <div class="bg-mode p-4 rounded shadow-sm">
            <h1 class="h4 mb-4">Mentor / Mentee</h1>

            <!-- Tabs Navigation -->
            <div class="overflow-auto">
                <ul class="nav nav-tabs mb-3 flex-nowrap" id="mentorMenteeTabs" role="tablist"
                    style="white-space: nowrap;">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="mentor-tab" data-bs-toggle="tab" data-bs-target="#mentor"
                            type="button" role="tab">Become a Mentor</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="mentee-tab" data-bs-toggle="tab" data-bs-target="#mentee"
                            type="button" role="tab">Find a Mentor</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Incoming-requests-tab" data-bs-toggle="tab"
                            data-bs-target="#requests_incoming" type="button" role="tab">Received Requests</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Outgoging-requests-tab" data-bs-toggle="tab"
                            data-bs-target="#requests_outgoing" type="button" role="tab">Sent Requests</button>
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
                    <div class="row align-items-end g-3 mb-4">
                        <div class="col-md-10">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Service</label>
                                    <select name="service[]" id="service-mentor" class="form-select Service" multiple
                                        data-id="mentor">
                                        @if($members->isEmpty())
                                        <option disabled>No Services Available</option>
                                        @else
                                        @foreach($members as $member)
                                        @if($member->Service != '')
                                        <option value="{{ $member->Service }}" selected>{{ $member->Service }}</option>
                                        @endif
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Batch/Year</label>
                                    <select name="year[]" id="year-mentor" class="form-select year" multiple
                                        data-id="mentor">
                                        @if($members->isEmpty())
                                        <option disabled>No Batches Available</option>
                                        @else
                                        @foreach($members as $member)
                                        @if(!empty($member->batches))
                                        @php $batches = explode(',', $member->batches); @endphp
                                        @foreach($batches as $batch)
                                        <option value="{{ trim($batch) }}">{{ trim($batch) }}</option>
                                        @endforeach
                                        @endif
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Cadre</label>
                                    <select name="cadre[]" id="cadre-mentor" class="form-select cadre" multiple
                                        data-id="mentor">
                                        @if($members->isEmpty())
                                        <option disabled>No Cadres Available</option>
                                        @else
                                        @foreach($members as $member)
                                        @if(!empty($member->cader_list))
                                        @php $cader_list = explode(',', $member->cader_list); @endphp
                                        @foreach($cader_list as $cadre)
                                        <option value="{{ trim($cadre) }}">{{ trim($cadre) }}</option>
                                        @endforeach
                                        @endif
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Sector/Area of Expertise</label>
                                    <select name="sector[]" id="sector-mentor" class="form-select sector" multiple
                                        data-id="mentor">
                                        @if($members->isEmpty())
                                        <option disabled>No Sector Available</option>
                                        @else
                                        @foreach($members as $member)
                                        @if(!empty($member->sector_list))
                                        @php $sector_list = explode(',', $member->sector_list); @endphp
                                        @foreach($sector_list as $sector)
                                        <option value="{{ trim($sector) }}">{{ trim($sector) }}</option>
                                        @endforeach
                                        @endif
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 d-flex flex-column gap-2">
                            <button class="btn btn-primary w-100" id="filterbecomeMentor">Search</button>
                            <a href="{{ url()->current() }}" class="btn btn-secondary w-100">Reset</a>
                        </div>
                    </div>

                    <hr class="my-4">

                    <form action="{{ route('user.mentor.want_become_mentor') }}" method="POST">
                        @csrf
                        <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                            <table class="bg-light table mb-0">
                                <thead class="table-light" style="position: sticky; top: 0; z-index: 2;">
                                    <tr>
                                        <th style="background: #f8f9fa;">Select</th>
                                        <th style="background: #f8f9fa;">S.No.</th>
                                        <th style="background: #f8f9fa;">Name</th>
                                        <th style="background: #f8f9fa;">Service</th>
                                        <th style="background: #f8f9fa;">Batch/Year</th>
                                        <th style="background: #f8f9fa;">Cadre</th>
                                        <th style="background: #f8f9fa;">Sector/Area of Expertise</th>
                                    </tr>
                                </thead>
                                <tbody id="mentorTableBody">
                                    <!-- Rows will be injected here -->
                                </tbody>
                            </table>
                        </div>


                        <div class="text-end mt-2">
                            <button type="submit" class="btn btn-primary">Send Connection Request</button>
                        </div>
                    </form>
                </div>

                <!-- Tab 2: Mentee Form -->
                <div class="tab-pane fade" id="mentee" role="tabpanel">
                    <div class="row g-3 align-items-end mb-4">
                        <div class="col-md-10">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Service</label>
                                    <select name="service[]" id="service-mentee" class="form-control Service" multiple
                                        data-id="mentee">
                                        @if($members->isEmpty())
                                        <option disabled>No Services Available</option>
                                        @else
                                        @foreach($members as $member)
                                        @if($member->Service != '')
                                        <option value="{{ $member->Service }}" selected>{{ $member->Service }}</option>
                                        @endif
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Batch/Year</label>
                                    <select name="year[]" id="year-mentee" class="form-control year" multiple
                                        data-id="mentee">
                                        @if($members->isEmpty())
                                        <option disabled>No Batches Available</option>
                                        @else
                                        @foreach($members as $member)
                                        @if(!empty($member->batches))
                                        @php $batches = explode(',', $member->batches); @endphp
                                        @foreach($batches as $batch)
                                        <option value="{{ trim($batch) }}">{{ trim($batch) }}</option>
                                        @endforeach
                                        @endif
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Cadre</label>
                                    <select name="cadre[]" id="cadre-mentee" class="form-control cadre" multiple
                                        data-id="mentee">
                                        @if($members->isEmpty())
                                        <option disabled>No Cadres Available</option>
                                        @else
                                        @foreach($members as $member)
                                        @if(!empty($member->cader_list))
                                        @php $cader_list = explode(',', $member->cader_list); @endphp
                                        @foreach($cader_list as $cadre)
                                        <option value="{{ trim($cadre) }}">{{ trim($cadre) }}</option>
                                        @endforeach
                                        @endif
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Sector/Area of Expertise</label>
                                    <select name="sector[]" id="sector-mentee" class="form-control sector" multiple
                                        data-id="mentee">
                                        @if($members->isEmpty())
                                        <option disabled>No Sector Available</option>
                                        @else
                                        @foreach($members as $member)
                                        @if(!empty($member->sector_list))
                                        @php $sector_list = explode(',', $member->sector_list); @endphp
                                        @foreach($sector_list as $sector)
                                        <option value="{{ trim($sector) }}">{{ trim($sector) }}</option>
                                        @endforeach
                                        @endif
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 d-flex flex-column gap-2">
                            <button class="btn btn-primary w-100" id="filterbecomeMentee">Search</button>
                            <a href="{{ url()->current() }}" class="btn btn-secondary w-100">Reset</a>
                        </div>
                    </div>


                    <form action="{{ route('user.mentor.want_become_mentee') }}" method="POST">
                        @csrf
                        <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                            <table class="bg-light table mb-0">
                                <thead class="table-light" style="position: sticky; top: 0; z-index: 2;">
                                   <tr>
                                        <th style="background: #f8f9fa;">Select</th>
                                        <th style="background: #f8f9fa;">S.No.</th>
                                        <th style="background: #f8f9fa;">Name</th>
                                        <th style="background: #f8f9fa;">Service</th>
                                        <th style="background: #f8f9fa;">Batch/Year</th>
                                        <th style="background: #f8f9fa;">Cadre</th>
                                        <th style="background: #f8f9fa;">Sector/Area of Expertise</th>
                                    </tr>
                                </thead>
                                <tbody id="menteeTableBody">
                                    <!-- Rows will be injected here -->
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end mt-2">
                            <button type="submit" class="btn btn-primary">Send Connection Request</button>
                        </div>
                    </form>
                </div>

                <!-- Tab 3: Incoming Requests -->
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

                <!-- Tab 4 : Outgoing Requests -->

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

                <!-- Tab 5: Connections -->
                <div class="tab-pane fade" id="connections" role="tabpanel">
                    <h5>Mentors</h5>
                    <ul class="list-group mb-3">
                        @php
                        $hasMentor = false;
                        @endphp

                        @foreach ($mentee_connections->toArray() as $mentor)
                       @if($mentor->Service == 'IAS')
                       <li class="list-group-item d-flex align-items-center justify-content-between">
    <!-- Mentor Name + Status Badge -->
    <div class="d-flex flex-column">
        <span class="fw-semibold">{{ $mentor->name }}</span>
        <small class="text-muted">{{ $mentor->cadre }} | {{ $mentor->batch }}</small>
    </div>

    <!-- Actions -->
    <div class="d-flex align-items-center gap-3">
@if ($mentor->status == 1)
            <span class="badge bg-success">Active</span>
        @else
            <span class="badge bg-secondary">Inactive</span>
        @endif
        <!-- Status Toggle -->
@php
    $canToggle = ($mentor->status != 0 && $mentor->status_updated_by != auth()->guard('user')->id())
        || ($mentor->status == 0 && $mentor->status_updated_by == auth()->guard('user')->id());
@endphp

@if($canToggle)
    <form action="{{ route('user.mentee.toggle', $mentor->connection_id) }}" method="POST" class="m-0">
        @csrf
        <div class="form-check form-switch">
            <input class="form-check-input"
                   type="checkbox"
                   role="switch"
                   name="status"
                   onchange="this.form.submit()"
                   {{ $mentor->status == 1 ? 'checked' : '' }}>
        </div>
    </form>
@endif


        <!-- Chat Button -->
        @if ($mentor->status == 1)
            <a data-bs-toggle="offcanvas"
               href="#offcanvasChat"
               role="button"
               class="btn btn-sm btn-primary d-flex align-items-center open-chat"
               data-userid="{{ $mentor->id }}">
                <i class="bi bi-chat-left-text me-1"></i> Chat
            </a>
        @endif
    </div>
</li>
@endif
                        @php $hasMentor = true; @endphp
                       
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

                        @foreach ($mentor_connections->toArray() as $mentee)
                       @if($mentee->Service == 'IAS')

                        <li class="list-group-item d-flex align-items-center justify-content-between">
    <!-- Left: Mentee Info -->
    <div class="d-flex flex-column">
        <span class="fw-semibold">{{ $mentee->name }}</span>
        <small class="text-muted">{{ $mentee->cadre }} | {{ $mentee->batch }}</small>
    </div>

    <!-- Right: Actions -->
    <div class="d-flex align-items-center gap-3">

        <!-- Status Badge -->
        @if ($mentee->status == 1)
            <span class="badge bg-success">Active</span>
        @else
            <span class="badge bg-secondary">Inactive</span>
        @endif
@php
    $canToggle = ($mentee->status != 0 && $mentee->status_updated_by != auth()->guard('user')->id())
        || ($mentee->status == 0 && $mentee->status_updated_by == auth()->guard('user')->id());
@endphp

@if($canToggle)
    <form action="{{ route('user.mentee.toggle', $mentee->connection_id) }}" method="POST" class="m-0">
        @csrf
        <div class="form-check form-switch">
            <input class="form-check-input"
                   type="checkbox"
                   role="switch"
                   name="status"
                   onchange="this.form.submit()"
                   {{ $mentee->status == 1 ? 'checked' : '' }}>
        </div>
    </form>
@endif

        <!-- Chat Button -->
        <a data-bs-toggle="offcanvas"
           href="#offcanvasChat"
           role="button"
           class="btn btn-sm {{ $mentee->status == 1 ? 'btn-primary' : 'btn-secondary disabled' }} d-flex align-items-center open-chat"
           data-userid="{{ $mentee->id }}">
            <i class="bi bi-chat-left-text me-1"></i> Chat
        </a>
    </div>
</li>
@endif

                        @php $hasMentee = true; @endphp
                       
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
@endsection
<!-- Select2 -->
@section('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<!-- Filter Logic -->
<script nonce="{{ $cspNonce }}">$(document).ready(function() {
    // Mentor Filter
    $(document).on('click', '#filterbecomeMentor', function(e) {
        e.preventDefault();
        let tabId = 'mentor';

        $.ajax({
            url: "{{ route('user.filter.mentors_mentee_data') }}",
            method: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                service: $('.Service[data-id="' + tabId + '"]').val(),
                year: $('.year[data-id="' + tabId + '"]').val(),
                cadre: $('.cadre[data-id="' + tabId + '"]').val(),
                sector: $('.sector[data-id="' + tabId + '"]').val(),
                Type: tabId
            },
            beforeSend: function() {
                $('#mentorTableBody').html(`
                <tr>
                    <td colspan="8" class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </td>
                </tr>
            `);
            },
            success: function(response) {
                $('#mentorTableBody').html(response);
            },
            error: function() {
                $('#mentorTableBody').html(`
                <tr>
                    <td colspan="8" class="text-center text-danger">
                        Error loading data.
                    </td>
                </tr>
            `);
            }
        });
    });

    // Mentee Filter
    $(document).on('click', '#filterbecomeMentee', function(e) {
        e.preventDefault();
        let tabId = 'mentee';

        $.ajax({
            url: "{{ route('user.filter.mentors_mentee_data') }}",
            method: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                service: $('.Service[data-id="' + tabId + '"]').val(),
                year: $('.year[data-id="' + tabId + '"]').val(),
                cadre: $('.cadre[data-id="' + tabId + '"]').val(),
                sector: $('.sector[data-id="' + tabId + '"]').val(),
                Type: tabId
            },
            beforeSend: function() {
                // Table body में loader डालना
                $('#menteeTableBody').html(`
                <tr>
                    <td colspan="8" class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </td>
                </tr>
            `);
            },
            success: function(response) {
                $('#menteeTableBody').html(response);
            },
            error: function() {
                $('#menteeTableBody').html(`
                <tr>
                    <td colspan="8" class="text-center text-danger">
                        Error loading data.
                    </td>
                </tr>
            `);
            }
        });
    });

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
<script nonce="{{ $cspNonce }}">document.addEventListener("DOMContentLoaded", function() {
    const selectAll = document.getElementById("selectAll");
    selectAll.addEventListener("change", function() {
        document.querySelectorAll('.row-checkbox').forEach(cb => {
            cb.checked = selectAll.checked;
        });
    });
});
// document.addEventListener("DOMContentLoaded", function() {
//     const selectAll = document.getElementById("selectAll_mentee");
//     selectAll.addEventListener("change", function() {
//         document.querySelectorAll('.row-checkbox').forEach(cb => {
//             cb.checked = selectAll.checked;
//         });
//     });
// });
$(document).ready(function() {
    $('.Service, .year, .cadre, .sector').select2({
        placeholder: "Select options",
        allowClear: true
    });
    $('.Service-mentee, .year-mentee, .cadre-mentee, .sector-mentee').select2({
        placeholder: "Select options",
        allowClear: true
    });
});
</script>
<script nonce="{{ $cspNonce }}">$(document).ready(function() {

    // ===== TAB MAPPING DEFINITION ===== //
    const tabMap = {
        'incoming': { contentId: 'requests_incoming', buttonId: 'Incoming-requests-tab' },
        'outgoing': { contentId: 'requests_outgoing', buttonId: 'Outgoing-requests-tab' },
        'mentor': { contentId: 'mentor', buttonId: 'mentor-tab' },
        'mentee': { contentId: 'mentee', buttonId: 'mentee-tab' },
        'connections': { contentId: 'connections', buttonId: 'connections-tab' }
    };

    // ===== TAB SWITCHING BASED ON URL PARAMETER ===== //
    const urlParams = new URLSearchParams(window.location.search);
    
    const activeTab = urlParams.get('tab');
   

    if (activeTab && tabMap[activeTab]) {
        const { contentId, buttonId } = tabMap[activeTab];
        
        // Remove active classes from all tabs and buttons
        $('.tab-pane').removeClass('show active');
        $('.nav-link').removeClass('active');
        
        // Add active classes to the target tab and button
        $(`#${contentId}`).addClass('show active');
        $(`#${buttonId}`).addClass('active');
        
        // Initialize Bootstrap tab component
        const tabElement = document.querySelector(`#${buttonId}`);
        if (tabElement) {
            const bsTab = new bootstrap.Tab(tabElement);
            bsTab.show();
        }
    }

    // ===== EXISTING FILTER LOGIC ===== //
    // Mentor Filter
    $(document).on('click', '#filterbecomeMentor', function(e) {
        // ... your existing filter code ...
    });

    // Mentee Filter
    $(document).on('click', '#filterbecomeMentee', function(e) {
        // ... your existing filter code ...
    });

    // ===== EXISTING SELECT2 AND CHECKBOX LOGIC ===== //
    $('.Service, .year, .cadre, .sector').select2({
        placeholder: "Select options",
        allowClear: true
    });

    // Select All Checkbox for Mentor Table
    $('#selectAll').on('change', function() {
        $('.row-checkbox').prop('checked', this.checked);
    });
});
</script>

<script nonce="{{ $cspNonce }}">function openDirectChat(userId) {
    setTimeout(() => {
        const el = $('.user-' + userId);
        console.log('Element found:', el.length > 0);
        if (el.length) el.trigger('click');
    }, 300);
}
</script>
@endsection