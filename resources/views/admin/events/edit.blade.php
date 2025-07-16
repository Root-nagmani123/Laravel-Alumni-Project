@extends('admin.layouts.master')

@section('title', 'Edit Event - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Edit Event</h4>
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
            <div class="card">
                <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card-body">
        <h4 class="card-title">Edit Event</h4>
        <small class="form-control-feedback">Update the event details below.</small>
        <hr>

        <div class="row">
            <!-- Title -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Title <span class="required">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $event->title) }}">
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ old('description', $event->description) }}</textarea>
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
                        <option value="online" {{ old('venue', $event->venue) == 'online' ? 'selected' : '' }}>Online</option>
                        <option value="physical" {{ old('venue', $event->venue) == 'physical' ? 'selected' : '' }}>Physical</option>
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
                    <input type="text" name="location" class="form-control" value="{{ old('location', $event->location) }}">
                    @error('location')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- URL -->
            <div class="col-md-6" id="urlField" style="display: none;">
                <div class="mb-3">
                    <label class="form-label">Event URL</label>
                    <input type="url" name="url" class="form-control" value="{{ old('url', $event->url) }}">
                    @error('url')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Start DateTime -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Start Date & Time <span class="required">*</span></label>
                    <input type="datetime-local" name="start_datetime" class="form-control"
                        value="{{ old('start_datetime', \Carbon\Carbon::parse($event->start_datetime)->format('Y-m-d\TH:i')) }}">
                    @error('start_datetime')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- End DateTime -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">End Date & Time <span class="required">*</span></label>
                    <input type="datetime-local" name="end_datetime" class="form-control"
                        value="{{ old('end_datetime', \Carbon\Carbon::parse($event->end_datetime)->format('Y-m-d\TH:i')) }}">
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
                    <input type="file" name="image" id="imageInput" class="form-control" accept="image/*">
                    <div class="mt-2">
                        <img id="imagePreview"
                             src="{{ $event->image ? asset('storage/' . $event->image) : '#' }}"
                             alt="Preview"
                             style="{{ $event->image ? '' : 'display:none;' }} max-height:150px; border:1px solid #ccc; padding:5px;">
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
            <button class="btn btn-primary" type="submit">Update</button>
            <a href="{{ route('events.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</form>

<!-- JS to Toggle Fields -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const venueSelect = document.getElementById('venue');
        const locationField = document.getElementById('locationField');
        const urlField = document.getElementById('urlField');

        function toggleFields() {
            const selected = venueSelect.value;
            if (selected === 'physical') {
                locationField.style.display = 'block';
                urlField.style.display = 'none';
            } else if (selected === 'online') {
                locationField.style.display = 'none';
                urlField.style.display = 'block';
            } else {
                locationField.style.display = 'none';
                urlField.style.display = 'none';
            }
        }

        venueSelect.addEventListener('change', toggleFields);
        toggleFields(); // Initial load

        // Image Preview
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        imageInput.addEventListener('change', function () {
            const file = imageInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
            </div>
        </div>
    </div>
</div>
@endsection
