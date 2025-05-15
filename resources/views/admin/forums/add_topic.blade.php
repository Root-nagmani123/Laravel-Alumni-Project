@extends('admin.layouts.master')

@section('title', 'Member - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
@php
    $pageName = 'Add Forum Topic'; // Set the page name here
@endphp

    <div class="pagetitle">
    <h1>{{ $pageName ?? 'Default Page Name' }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item">{{ $pageName ?? 'Default Page Name' }}</li>
        </ol>
    </nav>
   </div>

   <section class="section">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10 col-sm-12 mt-5"> <!-- Adjusting the column width -->

      <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add Forum Topic</h5>

            <!-- General Form Elements -->
            <form method="POST" action="{{ route('forums.save_topic') }}" enctype="multipart/form-data" id="AddMemberForm">
                @csrf
                <div class="col-sm-12">
                  <input type="hidden" name="forum_id" value="{{$forumId}}">
                </div>

                <!-- Forum Name -->
                <div class="row mb-3">
                    <label for="forumName" class="col-sm-3 col-form-label">Forum Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="forum_name" class="form-control" value="{{$forumName}}" readonly>
                    </div>
                </div>

                <!-- Title -->
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">Title<span class="required">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" >
                  </div>
                </div>

                <!-- Description -->
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-3 col-form-label">Description<span class="required">*</span></label>
                  <div class="col-sm-9">
                    <textarea class="form-control" name="description" style="height: 100px" >{{ old('description') }}</textarea>
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

                <!-- Video Caption -->
                <div class="row mb-3 d-none" id="videoCaptionRow">
                  <label for="inputText" class="col-sm-3 col-form-label">Video Caption</label>
                  <div class="col-sm-9">
                    <input type="text" name="video_caption" class="form-control">
                  </div>
                </div>

                <!-- Document (PDF) -->
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-3 col-form-label">Document <small>(PDF Only)</small></label>
                  <div class="col-sm-9">
                    <input class="form-control" type="file" id="formFile" name="doc">
                  </div>
                </div>

                <!-- Status -->
                <div class="row mb-3">
                      <label for="inputEmail" class="col-sm-3 col-form-label">Status<span                       class="required">*</span></label>
                  <div class="col-sm-9">
                      <select name="status" class="form-select">
                        <option value="" disabled {{ old('status') === null ? 'selected' : '' }}>Select Status</option>
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                      </select>
                     
                  </div>
                </div>

                <!-- Submit Button -->
                <div class="row mb-3">
                  <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
            </form><!-- End General Form Elements -->

        </div>
      </div>

    </div>
  </div>
</section>
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- / Validation Errors -->
@if ($errors->any())
  <script>
      
          toastr.error({!! json_encode($errors->first()) !!});
      
  </script>
@endif
<script>
  
  $(document).ready(function () {
    // Show/hide Photo Caption
    $('#topicImage').on('change', function () {
      if (this.files && this.files.length > 0) {
        $('#photoCaptionRow').removeClass('d-none');
      } else {
        $('#photoCaptionRow').addClass('d-none');
      }
    });

    // Show/hide Video Caption
    $('#videoLink').on('input', function () {
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