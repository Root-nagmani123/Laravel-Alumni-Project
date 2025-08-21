@extends('admin.layouts.master')

@section('title', 'Mentorship Programme - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<style>
body .select2-container {
    display: block !important;
}
</style>
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
    <div class="card shadow-sm border-0">
        <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: #af2910;">
            <h5 class="mb-0 text-white"><i class="bi bi-people-fill me-2"></i> Mentorship Programme</h5>
            <span class="badge bg-light text-dark">Admin Panel</span>
        </div>

        <div class="card-body">
            <form id="mentorshipForm">
                <div class="row g-4">
                    <!-- Select Member -->
                    <div class="col-md-4">
                        <label for="memberSelect" class="form-label fw-semibold">Select Member</label>
                        <select class="form-select shadow-sm" id="memberSelect" style="width: 100%">
                            <option value="">Choose...</option>
                        </select>
                    </div>

                    <!-- Role -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Role</label>
                        <div class="d-flex gap-3 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="mentor" value="mentor"
                                    checked>
                                <label class="form-check-label" for="mentor">
                                    <i class="bi bi-mortarboard me-1"></i> Mentor
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="mentee" value="mentee">
                                <label class="form-check-label" for="mentee">
                                    <i class="bi bi-person-lines-fill me-1"></i> Mentee
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="button" class="btn btn-primary w-100 shadow-sm" id="searchBtn">
                            <i class="bi bi-search me-1"></i> Search
                        </button>
                    </div>
                </div>
            </form>

            <!-- Divider -->
            <hr class="my-4">

            <!-- Result Area -->
            <div id="resultSection" class="p-3 bg-light rounded border text-muted small text-center">
                <i class="bi bi-info-circle me-1"></i> Results will be displayed here
            </div>
        </div>
    </div>

</div>
@endsection
@section('scripts')
<script>
$('#searchBtn').on('click', function() {
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
        success: function(response) {
            $('#resultSection').html(response.html);
        },
        error: function() {
            alert('Something went wrong');
        }
    });
});
$(document).ready(function() {
    $('#memberSelect').select2({
        placeholder: "-- Select Member --",
        minimumInputLength: 2, // start search after typing 2 chars
        ajax: {
            url: '{{ route("admin.members.search") }}',
            type: 'POST',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term,
                    _token: '{{ csrf_token() }}'
                };
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
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