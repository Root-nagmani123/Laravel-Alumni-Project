@extends('admin.layouts.master')

@section('title', 'Group - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
@php
$pageName
@endphp
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Add Topic</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Add Topic
                                </span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- ----------------------------------------- -->
            <!-- 2. Disabled Form -->
            <!-- ----------------------------------------- -->
            <!-- start Disabled Form -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Add Topic</h4>
                    <hr>

                        <form method="POST" action="{{ route('group.save_topic', ['id' => $id]) }}" enctype="multipart/form-data" id="AddMemberForm">

                            @csrf
                        <!-- Group Name -->
                        <div class="row mb-3">
                            <label for="groupname" class="col-sm-3 col-form-label">Group Name</label>
                            <div class="col-sm-9">
                               {{$group->name}}
                            </div>
                        </div>

                     
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Description<span
                                    class="required">*</span></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description"
                                    style="height: 100px">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <!-- Photo -->
                        <div class="row mb-3">
                            <label for="topicImage" class="col-sm-3 col-form-label">Photo</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="topic_image" type="file" id="topicImage">
                            </div>
                        </div>

                       
                        <!-- Photo Caption -->
                        <div class="row mb-3 d-none" id="photoCaptionRow">
                            <label for="inputText" class="col-sm-3 col-form-label">Photo Caption</label>
                            <div class="col-sm-9">
                                <input type="text" name="image_caption" class="form-control">
                            </div>
                        </div>

                        <!-- Video Link -->
                        <div class="row mb-3">
                            <label for="videoLink" class="col-sm-3 col-form-label">Video Link</label>
                            <div class="col-sm-9">
                               <input type="text" name="video_link" class="form-control" id="videoLink">

                            </div>
                        </div>

                      

                        <!-- Status -->
                        <div class="row mb-3">
                            <label for="inputEmail" class="col-sm-3 col-form-label">Status<span
                                    class="required">*</span></label>
                            <div class="col-sm-9">
                                <select name="status" class="form-select">
                                    <option value="" disabled {{ old('status') === null ? 'selected' : '' }}>Select
                                        Status</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>

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
            <!-- end Disabled Form -->
        </div>
    </div>
</div>
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- / Validation Errors -->
@if ($errors->any())
<script>
toastr.error({
    !!json_encode($errors - > first()) !!
});
</script>
@endif
<script>
$(document).ready(function() {
    // Show/hide Photo Caption
    $('#topicImage').on('change', function() {
        if (this.files && this.files.length > 0) {
            $('#photoCaptionRow').removeClass('d-none');
        } else {
            $('#photoCaptionRow').addClass('d-none');
        }
    });

    // Show/hide Video Caption
    $('#videoLink').on('input', function() {
        if ($(this).val().trim() !== '') {
            $('#videoCaptionRow').removeClass('d-none');
        } else {
            $('#videoCaptionRow').addClass('d-none');
        }
    });

    // Trigger on page load (for edit form or if data is pre-filled)
    if ($('#topicImage').val()) {
        $('#photoCaptionRow').removeClass('d-none');
    }

    if ($('#videoLink').val().trim() !== '') {
        $('#videoCaptionRow').removeClass('d-none');
    }
});
</script>
@endpush



@endsection
