@extends('admin.layouts.master')

@section('title', 'Broadcasts - Alumni | Lal Bahadur')

@section('content')

<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Broadcasts</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                               Broadcasts
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
            <h4 class="card-title mb-3">Broadcasts</h4>
            <hr>
            <form method="POST" action="{{ route('broadcasts.broadcast.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="title">Title<span class="text-danger">*</span>:</label>
                           <div class="mb-3">
                            <input type="text" name="title" id="title" class="form-control" required>
                           </div>
                        </div>
                    </div>
					 <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="content">Content<span class="text-danger">*</span>:</label>
                           <div class="mb-3">
                            <textarea class="form-control" id="content" name="content" required=""></textarea>
                           </div>
                        </div>
                    </div>
					 <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="content">Image<span class="text-danger">*</span>:</label>
                            <div class="mb-3">
                                <input id="file-upload" type="file" name="images" accept=".jpg,.jpeg,.png" class="form-control" required>
                                Accepted file types: jpg, jpeg, png. Max file size: 50MB.
                            </div>
                        </div>
                    </div>
					 <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="content">Video  URL :</label>
                           <div class="mb-3">
                           <input class="form-control" type="text" name="video_url" placeholder="Video Link ..">
                           </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="mb-3">
                    <button class="btn btn-primary hstack gap-6 float-end" type="submit">
                    <i class="material-icons menu-icon">send</i>
                        Save
                    </button>
                    <a href="{{ route('broadcasts.index') }}" class="btn btn-secondary hstack gap-6 float-end me-2">
                        <i class="material-icons menu-icon">arrow_back</i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
    <!-- end Vertical Steps Example -->
</div>


@endsection
@section('scripts')
<script nonce="{{ $cspNonce }}">     @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>
@endsection
