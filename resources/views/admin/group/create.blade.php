@extends('admin.layouts.master')

@section('title', 'Group - Alumni | Lal Bahadur')

@section('content')

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
                            <label class="form-label">Group Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Mentor Name</label>
                            <!--<select id="" class="form-control" name="mentor_id" required="" tabindex="-1"
                                aria-hidden="true">-->
                            <select id="searchable-select" class="form-control " name="mentor_id"  required>
                                <option value="" data-select2-id="select2-data-4-1ybl">Select Mentor</option>
                                @foreach($mentors as $mentors)
                                <option value="{{ $mentors->id }}">{{ $mentors->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Member Name (Multiple Mentees) <span class="text-danger">*</span></label>
                            <select name="user_id[]" class="form-control js-example-basic-multiple"  multiple="multiple" required>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                      <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Group End Date</label>
                                        <input type="date" class="form-control" name="end_date" id="end_date">
                                    </div>
                                </div>
                               <div class="col-md-6">
    <div class="mb-3">
        <label class="form-label">Group Image</label>
        <input type="file" class="form-control" name="image" id="image" accept="image/*">
        <!-- Preview -->
        <div class="mt-2">
            <img id="preview-image" src="#" alt="Image Preview" class="img-fluid rounded d-none" style="max-height: 200px;" />
        </div>
    </div>
</div>

                    
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
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
</script>

<script>
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
</script>
@endsection
