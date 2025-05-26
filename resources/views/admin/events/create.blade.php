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
                <form action="{{ route('events.store') }}" method="POST">
    @csrf
    <div class="card-body">
        <h4 class="card-title">Add Event</h4>
        <small class="form-control-feedback">Please add Event detail.</small>
        <hr>

        <div class="row">
            <!-- Title -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Title <span class="required">*</span></label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ old('title', $event->title ?? '') }}">
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Description <span class="required">*</span></label>
                    <textarea name="description" class="form-control">{{ old('description', $event->description ?? '') }}</textarea>
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Location -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" id="location" class="form-control"
                        value="{{ old('location', $event->location ?? '') }}">
                    @error('location')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Venue -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Venue <span class="required">*</span></label>
                    <select name="venue" class="form-control" required>
                        <option value="">Select Venue</option>
                        <option value="online" {{ old('venue', $event->venue ?? '') == 'online' ? 'selected' : '' }}>Online</option>
                        <option value="physical" {{ old('venue', $event->venue ?? '') == 'physical' ? 'selected' : '' }}>Physical</option>
                    </select>
                    @error('venue')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- URL -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Event URL</label>
                    <input type="url" name="url" class="form-control"
                        value="{{ old('url', $event->url ?? '') }}">
                    @error('url')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Start DateTime -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Start Date & Time <span class="required">*</span></label>
                    <input type="datetime-local" name="start_datetime" id="start_datetime" class="form-control"
                        value="{{ old('start_datetime', isset($event) ? \Carbon\Carbon::parse($event->start_datetime)->format('Y-m-d\TH:i') : '') }}" required>
                    @error('start_datetime')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- End DateTime -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">End Date & Time <span class="required">*</span></label>
                    <input type="datetime-local" name="end_datetime" id="end_datetime" class="form-control"
                        value="{{ old('end_datetime', isset($event) ? \Carbon\Carbon::parse($event->end_datetime)->format('Y-m-d\TH:i') : '') }}" required>
                    @error('end_datetime')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Submit and Back -->
        <div class="mb-3 gap-2 float-end">
            <button class="btn btn-primary" type="submit">Submit</button>
            <a href="{{ route('events.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</form>

            </div>
            <!-- end Person Info -->
        </div>
    </div>
</div>


@endsection

<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Bulk Add Members</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" method="post"
                    action="{{-- route('members.bulk_upload_members') --}}" id="bulk-upload-form" class="uploader">
                    <div class="boxmodal footimpt">


                        <div class="form-group mt-2">
                            <label for="file-upload" class="form-label">Upload Excel/CSV File:*</label>
                            <input id="file-upload" type="file" name="file" accept=".xls,.xlsx,.csv" required />
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <button type="button" class="btn btn-secondary col-md-6" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary col-md-6">Upload</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
