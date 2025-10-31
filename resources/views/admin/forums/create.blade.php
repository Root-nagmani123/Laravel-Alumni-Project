@extends('admin.layouts.master')

@section('title', 'Member - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Add Forum</h4>
                    <!--<buttton style="float:right;" class="btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal1"><i class="bi bi-info"></i>Bulk Add</buttton>-->

                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Forum
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
                <form action="{{ route('forums.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div>
                        <div class="card-body">
                            <h4 class="card-title">Add forum</h4>
                            <small class="form-control-feedback">Please add forum detail.</small>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label><span
                                            class="required text-danger ">*</span>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('name') }}" placeholder="Enter forum name" required>
                                        <!-- @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror -->
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Forum End Date<span
                                                class="required text-danger ">*</span></label>

                                        <input type="date" class="form-control" name="end_date" id="end_date" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Forum Description<span
                                                class="required text-danger ">*</span></label>
                                        <textarea class="form-control" name="forumdescription" id="forumdescription" rows="4"
                                            placeholder="Enter forum description" required>{{ old('forumdescription') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Forum Image<span
                                                class="required text-danger ">*</span></label>
                                        <input type="file" class="form-control" name="image" id="forum-image"
                                            accept="image/*" required>

                                        <!-- Preview -->
                                        <div class="mt-2">
                                            <img id="forum-preview"
                                                src="{{ isset($forum->image) ? route('secure.file', ['type'=>'forum','path'=>$forum->image]) : '#' }}"
                                                alt="Image Preview"
                                                class="img-fluid rounded {{ isset($forum->image) ? '' : 'd-none' }}"
                                                style="max-height: 200px;" />
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <form class="needs-validation" novalidate>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status<span
                                                        class="required text-danger ">*</span></label>
                                                <select class="form-select" name="status" id="status" required>
                                                    <option value="" disabled selected>Select Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a status.
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="mb-3 gap-2 float-end">
                                <button class="btn btn-primary" type="submit">
                                    Save
                                </button>
                                <a href="{{ route('forums.index') }}" class="btn btn-secondary">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end Person Info -->
        </div>
    </div>
</div>

<script nonce="{{ $cspNonce }}">document.getElementById('forum-image').addEventListener('change', function(event) {
    const input = event.target;
    const preview = document.getElementById('forum-preview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        }

        reader.readAsDataURL(input.files[0]);
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById("end_date").setAttribute('min', today);
});
</script>

@endsection