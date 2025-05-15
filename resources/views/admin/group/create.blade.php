@extends('admin.layouts.master')

@section('title', 'Group - Alumni | Lal Bahadur')

@section('content')

<div class="container-fluid">
    <x-breadcrum title="group" />
    <x-session_message />
    <!-- start Vertical Steps Example -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Create Group</h4>
            <hr>
            <form action="{{ route('group.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Group Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
				  <div class="mb-3">
                    <label class="form-label">Mentor Name</label>
                   <select id="" class="" name="mentor_id" required="" data-select2-id="" tabindex="-1" aria-hidden="true">
                        <option value="" data-select2-id="select2-data-4-1ybl">Select Mentor</option>

                        @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="mb-3">
                    <label class="form-label">Member Name (Multiple Mentees)*</label>
                    <select name="member_name[]" class="form-select" multiple>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" aria-label="Default select" name="status" required="">
                        <option selected="">Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <!-- end Vertical Steps Example -->
</div>

<script>
$(document).ready(function() {
    $('.form-select').select2(); // Initialize Select2
});
</script>
@endsection
