@extends('admin.layouts.master')

@section('title', 'Group - Alumni | Lal Bahadur')

@section('content')
<style>
.select2-container--default .select2-results>.select2-results__options {
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
        <h4 class="card-title mb-3">Edit Group</h4>
        <hr>
        <form action="{{ route('group.update', $group->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Group Name -->
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ $group->name }}" required>
                    </div>
                </div>

                <!-- Mentor -->
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label">Mentor Name <span class="text-danger">*</span></label>
                        <select name="mentor_id" class="form-control" required>
                            <option value="">Select Mentor</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ $group->groupMember && $group->groupMember->mentor == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Service</label>
                            <select name="service" id="service" class="form-control">
                                <option value="">Select Service</option>
                            </select>
                        </div>
                    </div>
                    <!-- Batch/Year -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Batch/Year</label>
                            <select name="batch_year" id="batch_year" class="form-control">
                                <option value="">Select Batch/Year</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Cadre</label>
                            <select name="cadre" id="cadre" class="form-control">
                                <option value="">Select Cadre</option>
                            </select>
                        </div>
                    </div>
                    <!-- Group End Date -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Group End Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="end_date" id="end_date"
                               value="{{ $group->end_date }}" required>
                    </div>
                </div>

                 <!-- Members Dual List -->
                    <div class="col-12 gap-3">
                        <div class="mb-3">
                            <label class="form-label">Add Members <span class="text-danger">*</span></label>
                            <div class="row">
                                <!-- All Members -->
                                <div class="col-md-6 border p-2 rounded">
                                    <h6>All Members</h6>
                                    <input type="text" id="searchAll" class="form-control mb-2"
                                        placeholder="Search members...">
                                    <div id="allMembers" class="member-list" style="max-height:300px; overflow-y:auto;">
                                        @foreach($users as $user)
                                        <div class="form-check">
                                            <input class="form-check-input member-checkbox" type="checkbox"
                                                value="{{ $user->id }}" id="user-{{ $user->id }}">
                                            <label class="form-check-label" for="user-{{ $user->id }}">
                                                {{ $user->name }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Selected Members -->
                                <div class="col-md-6 border p-2 rounded">
                                    <h6>Selected Members</h6>
                                    <input type="text" id="searchSelected" class="form-control mb-2"
                                        placeholder="Search selected...">
                                    <div id="selectedMembers" class="member-list"
                                        style="max-height:300px; overflow-y:auto;">
                                        <!-- Checked members auto-move here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                

                <!-- Group Image -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Group Image</label>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*">

                        <!-- Preview -->
                        <div class="mt-2">
                            <img id="preview-image"
                                src="{{ isset($group->image) ? asset('storage/uploads/images/grp_img/' . $group->image) : '#' }}"
                                alt="Image Preview"
                                class="img-fluid rounded {{ isset($group->image) ? '' : 'd-none' }}"
                                style="max-height: 200px;" />
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status" required>
                            <option value="1" {{ $group->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $group->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <hr>

            <div class="mb-3 gap-2 float-end">
                <button class="btn btn-primary" type="submit">Update</button>
                <a href="{{ route('group.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

    <!-- end Vertical Steps Example -->
</div>

<script>
document.getElementById('image').addEventListener('change', function(e) {
    const preview = document.getElementById('preview-image');
    const file = e.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            preview.src = event.target.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    } else {
        preview.src = '#';
        preview.classList.add('d-none');
    }
});
</script>

<script>
$(document).ready(function() {
    $('.form-select').select2();
    $('.js-example-basic-multiple').select2();

    function filterMentees() {
        var selectedMentor = $('#mentor-select').val();
        var menteesSelect = $('#mentee-select');

        // Enable and show all options
        menteesSelect.find('option').prop('disabled', false).show();

        if (selectedMentor) {
            // Unselect mentor if it's already selected as mentee
            menteesSelect.find('option[value="' + selectedMentor + '"]').prop('selected', false);

            // Disable and hide that mentor option from mentee list
            menteesSelect.find('option[value="' + selectedMentor + '"]').prop('disabled', true).hide();
        }

        // Refresh select2
        menteesSelect.trigger('change.select2');
    }

    $('#mentor-select').on('change', filterMentees);

    // Call on page load in case mentor is already selected
    filterMentees();
});
</script>


@endsection