@extends('admin.layouts.master')

@section('title', 'Batch - Sargam | Lal Bahadur')

@section('content')

<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Edit Forum</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    {{ $forum->name }}
                                </span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- start Vertical Steps Example -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Edit Forum</h4>
            <hr>


            <form method="POST" action="{{ route('forums.forum.update', $forum->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div id="batch_fields" class="my-2"></div>
                    <div class="row" id="batch_fields">
                        <div class="col-6">
                            <label for="Schoolname" class="form-label">Forum Name :<span
                                            class="required text-danger ">*</span></label>

                            <div class="mb-3">
                                <input type="text" class="form-control" id="Forumname" name="forumname"
                                    value="{{ old('forumname', $forum->name) }}">

                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Forum End Date<span
                                            class="required text-danger ">*</span></label>
                                <input type="date" class="form-control" name="end_date" id="end_date"
                                    value="{{ old('end_date', $forum->end_date) }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Forum Description<span
                                        class="required text-danger ">*</span></label>
                                <textarea class="form-control" name="forumdescription" id="forumdescription" rows="4"
                                    placeholder="Enter forum description" required>{{ old('description', $forum->description) }}</textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Forum Image<span
                                            class="required text-danger ">*</span></label>
                                <input type="file" class="form-control" name="forum_image" id="forum_image"
                                    accept="image/*">
                            </div>
                            <div class="mt-2">
                            @php
                                $imagePath = null;
                                if (isset($forum->images) && $forum->images) {
                                    // If it's already a full path, use it; otherwise prepend the folder
                                    if (str_contains($forum->images, 'uploads/images/forums_img/')) {
                                        $imagePath = $forum->images;
                                    } else {
                                        $imagePath = 'uploads/images/forums_img/' . $forum->images;
                                    }
                                }
                            @endphp
                            <img
                                id="preview-image"
                                src="{{ $imagePath ? route('secure.file', ['type' => 'forum', 'path' => $imagePath]) : '#' }}"
                                alt="Image Preview"
                                class="img-fluid rounded {{ $imagePath ? '' : 'd-none' }}"
                                style="max-height: 200px;"
                            />
                        </div>
                        </div>
                        <div class="col-6">
                            <label for="status" class="form-label">Status<span
                                            class="required text-danger ">*</span></label>
                            <div class="mb-3">
                                <select name="forumstatus" id="forumstatus" class="form-select">
                                    <option value="1" {{ old('forumstatus', $forum->status) == 1 ? 'selected' : '' }}>
                                        Active</option>

                                    <option value="0" {{ old('forumstatus', $forum->status) == 0 ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                            </div>
                        </div>


                    </div>
                </div>
                <hr>
                <div class="mb-3">
                    <button class="btn btn-primary hstack gap-6 float-end" type="submit">
                        <i class="material-icons menu-icon">send</i>
                        Update
                    </button>
                    <a href="{{ route('forums.index') }}" class="btn btn-secondary hstack gap-6 float-end me-2">
                        <i class="material-icons menu-icon">arrow_back</i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
    <!-- end Vertical Steps Example -->
</div>
<script nonce="{{ $cspNonce }}">document.addEventListener('DOMContentLoaded', function () {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById("end_date").setAttribute('min', today);
    });
</script>
@endsection