@extends('admin.layouts.master')

@section('title', 'Mentorship Programme - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Mentorship Programme</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Mentorship Programme
                                </span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <div class="datatables">
        <!-- start Zero Configuration -->
        <div class="card">
            <div class="card-body">


                <div class="table-responsive">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Mentorship Programme</h4>

                            <div class="container">
    <!-- Top Filter Form -->
    <div class="card p-3 mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="memberSelect">Select Member</label>
                <select class="form-select" id="memberSelect" style="width: 100%"></select>
                    <!-- <option value="">-- Select Member --</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                    @endforeach -->
                </select>
            </div>
            <div class="col-md-4">
                <label>Role</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="mentor" value="mentor" checked>
                    <label class="form-check-label" for="mentor">Mentor</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="mentee" value="mentee">
                    <label class="form-check-label" for="mentee">Mentee</label>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary w-100" id="searchBtn">Search</button>
            </div>
        </div>
    </div>

    <!-- Result Area -->
    <div id="resultSection"></div>
</div>


                        </div>
                    </div>
                    <hr>
                    <div>


                    </div>
                </div>
            </div>
        </div>
        <!-- end Zero Configuration -->
    </div>
</div>
@endsection
@section('scripts')
<script>
    $('#searchBtn').on('click', function () {
        let memberId = $('#memberSelect').val();
        let role = $('input[name="role"]:checked').val();

        if (!memberId) {
            alert('Please select a member');
            return;
        }

        $.ajax({
            url: '{{ route("admin.mentorship.search") }}',
            type: 'POST',
            data: {
                id: memberId,
                role: role,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                $('#resultSection').html(response.html);
            },
            error: function () {
                alert('Something went wrong');
            }
        });
    });
$(document).ready(function () {
    $('#memberSelect').select2({
        placeholder: "-- Select Member --",
        minimumInputLength: 2, // start search after typing 2 chars
        ajax: {
            url: '{{ route("admin.members.search") }}',
            type: 'POST',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    _token: '{{ csrf_token() }}'
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.id,
                            text: item.name
                        };
                    })
                };
            },
            cache: true
        }
    });
});
</script>
@endsection
