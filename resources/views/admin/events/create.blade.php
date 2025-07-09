@extends('admin.layouts.master')

@section('title', 'Events - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Add Events</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Events List
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
            <!-- start Person Info -->
            <div class="card">
                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card-body">
                        <h4 class="card-title">Add Event</h4>
                        <small class="form-control-feedback">Please add Event detail.</small>
                        <hr>

                        <div class="row">
                            <!-- Title -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Title <span class="required">*</span></label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                    @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description (optional) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description"
                                        class="form-control">{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <!-- Venue -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Venue <span class="required">*</span></label>
                                    <select name="venue" id="venue" class="form-control">
                                        <option value="">Select Venue</option>
                                        <option value="online" {{ old('venue') == 'online' ? 'selected' : '' }}>Online
                                        </option>
                                        <option value="physical" {{ old('venue') == 'physical' ? 'selected' : '' }}>
                                            Physical</option>
                                    </select>
                                    @error('venue')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="col-md-6" id="locationField" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label">Location</label>
                                    <input type="text" name="location" class="form-control"
                                        value="{{ old('location') }}">
                                    @error('location')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Event URL -->
                            <div class="col-md-6" id="urlField" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label">Event URL</label>
                                    <input type="url" name="url" class="form-control" value="{{ old('url') }}">
                                    @error('url')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <!-- Start DateTime -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date & Time <span class="required">*</span></label>
                                    <input type="datetime-local" name="start_datetime" id="start_datetime"
                                        class="form-control" value="{{ old('start_datetime') }}">
                                    @error('start_datetime')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Date & Time <span class="required">*</span></label>
                                    <input type="datetime-local" name="end_datetime" id="end_datetime"
                                        class="form-control" value="{{ old('end_datetime') }}">
                                    @error('end_datetime')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Image Upload -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Event Image</label>
                                    <span>image type: jpg, jpeg, png</span>
                                    <input type="file" name="image" id="imageInput" class="form-control"
                                        accept="image/jpg, image/jpeg, image/png">
                                    <div class="mt-2">
                                        <img id="imagePreview" src="#" alt="Preview"
                                            style="display:none; max-height:150px; border:1px solid #ccc; padding:5px;">
                                    </div>
                                    @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>








                        <hr>
                        <!-- Submit and Back -->
                        <div class="mb-3 gap-2 float-end">
                            <button class="btn btn-primary" type="submit">Save</button>
                            <a href="{{ route('events.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </form>

            </div>
            <!-- end Person Info -->
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const venueSelect = document.getElementById('venue');
    const locationField = document.getElementById('locationField');
    const urlField = document.getElementById('urlField');

    // Show/hide based on initial value
    function toggleVenueFields(value) {
        if (value === 'physical') {
            locationField.style.display = 'block';
            urlField.style.display = 'none';
        } else if (value === 'online') {
            locationField.style.display = 'none';
            urlField.style.display = 'block';
        } else {
            locationField.style.display = 'none';
            urlField.style.display = 'none';
        }
    }

    // Initial check
    toggleVenueFields(venueSelect.value);

    // On change
    venueSelect.addEventListener('change', function() {
        toggleVenueFields(this.value);
    });

    // Image Preview
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '';
            imagePreview.style.display = 'none';
        }
    });
});
    document.addEventListener('DOMContentLoaded', function () {
        const now = new Date();
        const pad = (n) => n.toString().padStart(2, '0');

        const formattedNow = `${now.getFullYear()}-${pad(now.getMonth() + 1)}-${pad(now.getDate())}T${pad(now.getHours())}:${pad(now.getMinutes())}`;

        document.getElementById('start_datetime').setAttribute('min', formattedNow);
        document.getElementById('end_datetime').setAttribute('min', formattedNow);
    });
</script>
@endsection