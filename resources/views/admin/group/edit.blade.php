@extends('admin.layouts.master')

@section('title', 'Group - Alumni | Lal Bahadur')

@section('content')

<div class="container-fluid">
    <x-breadcrum title="Group" />
    <x-session_message />
    <!-- start Vertical Steps Example -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Edit Group</h4>
            <hr>
            <form action="{{ route('group.update', $group->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $group->name }}" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Mentor Name</label>
                            <select name="mentor_id" class="form-control" required>
                                <option value="">Select Mentor</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $group->groupMember && $group->groupMember->mentor == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Member Name (Multiple Mentees)<span class="text-danger">*</span></label>
                            <select name="user_id[]" class="form-control js-example-basic-multiple"  multiple="multiple" required>
                                @php
                                    $selectedMentees = [];
                                    $currentMentor = null;
                                    if ($group->groupMember && $group->groupMember->mentiee) {
                                        $selectedMentees = json_decode($group->groupMember->mentiee, true);
                                    }
                                    if ($group->groupMember && $group->groupMember->mentor) {
                                        $currentMentor = $group->groupMember->mentor;
                                    }
                                @endphp
                                @foreach($users as $user)
                                    @if($user->id != $currentMentor)
                                    <option value="{{ $user->id }}" {{ in_array($user->id, $selectedMentees) ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                    @endif
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" aria-label="Default select" name="status" id="status" required>
                                <option value="1" {{ $group->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $group->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>

                <!--<div class="mb-3">
                    <label class="form-label">State ID</label>
                    <input type="number" name="state_id" class="form-control" value="{{ $group->state_id }}">
                </div>-->
                <div class="mb-3 gap-2 float-end">
                    <button class="btn btn-primary" type="submit">
                        Update
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


@endsection

<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2(); // Initialize Select2 for multiple select
    $('.form-select').select2(); // Initialize Select2 for single select
    
    // Filter out mentor from mentees dropdown
    $('select[name="mentor_id"]').on('change', function() {
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
