@extends('admin.layouts.master')

@section('title', 'Group - Alumni | Lal Bahadur')

@section('content')
<style>
    .select2-container--default .select2-results>.select2-results__options{
        max-height: 400px !important;
        overflow-y: auto;
    }
</style>

<div class="container-fluid">
    <x-breadcrum title="Group" />
    <x-session_message />
    <!-- start Vertical Steps Example -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Create Group</h4>
            <hr>
            <form action="{{ route('group.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Group Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Mentor Name <span class="text-danger">*</span></label>
                            <!--<select id="" class="form-control" name="mentor_id" required="" tabindex="-1"
                                aria-hidden="true">-->
                            @php
    $sortedMentors = $mentors->sortBy('name');
@endphp

<select id="mentor_id" class="form-control" name="mentor_id" required>
   
  
</select>


                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Member Name (Multiple Mentees) <span class="text-danger">*</span></label>
                           @php
    $sortedUsers = $users->sortBy('name');
@endphp

<select name="user_id[]" class="form-control js-example-basic-multiple" multiple="multiple" required>
    @foreach($sortedUsers as $user)
        <option value="{{ $user->id }}">{{ $user->name }}</option>
    @endforeach
</select>


                        </div>
                    </div>
                      <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Group End Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="end_date" id="end_date" required>
                                    </div>
                                </div>
                               <div class="col-md-6">
    <div class="mb-3">
        <label class="form-label">Group Image <span class="text-danger">*</span></label>
        <input type="file" class="form-control" name="image" id="image" accept="image/*" required>
        <!-- Preview -->
        <div class="mt-2">
            <img id="preview-image" src="#" alt="Image Preview" class="img-fluid rounded d-none" style="max-height: 200px;" />
        </div>
    </div>
</div>

                    
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" aria-label="Default select" name="status" required="">
                                <option selected="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="mb-3 gap-2 float-end">
                    <button class="btn btn-primary" type="submit">
                        Save
                    </button>
                    <a href="{{ route('group.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
    <!-- end Vertical Steps Example -->
</div>
<!-- image preview js -->
@section('scripts')
<script>
document.getElementById('image').addEventListener('change', function (event) {
    const preview = document.getElementById('preview-image');
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        }
        reader.readAsDataURL(file);
    } else {
        preview.src = '#';
        preview.classList.add('d-none');
    }
});
$(document).ready(function() {
    $('.form-select').select2(); // Initialize Select2
    $('.js-example-basic-multiple').select2(); // Initialize Select2 for multiple select
    
    // Filter out mentor from mentees dropdown
    $('#searchable-select').on('change', function() {
        var selectedMentor = $(this).val();
        var menteesSelect = $('.js-example-basic-multiple');
        
        // Reset mentees selection
        menteesSelect.val(null).trigger('change');
        
        // Hide the mentor option from mentees dropdown
        menteesSelect.find('option').show();
        if (selectedMentor) {
            menteesSelect.find('option[value="' + selectedMentor + '"]').hide();
        }
    });
});
$(document).ready(function () {
    $('#mentor_id').select2({
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
@endsection