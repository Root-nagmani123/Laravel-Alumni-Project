@extends('layouts.app')

@section('title', 'User Feed - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container">
    <div class="row g-4">
        <div class="col-lg-3 vstack col-12 left-sidebar">
            @include('partials.left-sidebar')
        </div>

        <div class="col-lg-6 vstack gap-4 mx-auto col-12 middle-sidebar">
            <div class="row">
                @include('partials.user_feed')
            </div>
        </div>
        <div class="col-lg-3 vstack col-12 right-sidebar">
            @include('partials.right-sidebar')
        </div>
    </div>
</div>
<!-- Modal create Feed photo START -->
<div class="modal fade" id="feedActionPhoto" tabindex="-1" aria-labelledby="feedActionPhotoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Modal header -->
            <div class="modal-header">
                <h5 class="modal-title" id="feedActionPhotoLabel">Add post photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="d-flex mb-3">
                    <!-- User avatar -->
                    <div class="avatar avatar-xs me-2">
                        @php
                        $profilePic = $user->profile_pic ?? null;
                        @endphp
                        <img class="avatar-img rounded-circle"
                            src="{{ $profilePic ? asset('storage/' . $profilePic) : asset('feed_assets/images/avatar/07.jpg') }}"
                            alt="User Avatar" loading="lazy" decoding="async">
                    </div>
                    <!-- Post textarea -->
                    <div class="flex-grow-1">

                        <textarea class="form-control pe-4 fs-3 lh-1 border-0 @error('modalContent') is-invalid @enderror"

                                  name="modalContent"

                                  rows="5"

                                  placeholder="Share your thoughts..."

                                  required>{{ old('modalContent') }}</textarea>

                        @error('modalContent')

                            <div class="invalid-feedback d-block">{{ $message }}</div>

                        @enderror

                    </div>
                </div>

                <!-- File upload -->
                <div class="mb-3">
                    <label class="form-label">Upload attachment</label>
                    <div id="drop-area" class="drop-area p-4 text-center border border-secondary rounded">
                        <i class="bi bi-images fs-1 mb-2 d-block"></i>
                        <span class="d-block">Drag & Drop image here or click to browse.</span>
                        <input type="file" id="media" name="media[]" multiple class="d-none" accept="image/*">
                        <div id="preview-feed" class="mt-3 d-flex flex-wrap gap-3"></div>
                    </div>
                </div>

                <!-- Optional video link -->
                <input class="form-control mt-2" type="text" name="video_link" placeholder="Video Link (optional)" />
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger-soft" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success-soft">Post</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="groupActionpost" tabindex="-1" aria-labelledby="groupActionpostLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" action="{{ route('user.group.post') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Modal header -->
            <div class="modal-header">
                <h5 class="modal-title" id="groupActionpostLabel">
                    Add Group Post in <span class="group_name"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="d-flex mb-3">
                    <!-- User avatar -->
                    <div class="avatar avatar-xs me-2">
                        @php
                        $profilePic = $user->profile_pic ?? null;
                        @endphp
                        <img class="avatar-img rounded-circle"
                            src="{{ $profilePic ? asset('storage/' . $profilePic) : asset('feed_assets/images/avatar/07.jpg') }}"
                            alt="User Avatar" loading="lazy" decoding="async">
                    </div>

                    <!-- Post textarea -->
                    <div class="flex-grow-1">
                        <input type="hidden" name="group_id" class="group_id">
                        <textarea class="form-control pe-4 fs-3 lh-1 border-0 @error('modalContent') is-invalid @enderror" 
                                  name="modalContent" 
                                  rows="5"
                                  placeholder="Share your thoughts..." 
                                  required>{{ old('modalContent') }}</textarea>
                        
                        @error('modalContent')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- File upload -->
                <div class="mb-3">
                    <label class="form-label">Upload attachment</label>
                    <div id="drop-area-group" class="drop-area p-4 text-center border border-secondary rounded">
                        <i class="bi bi-images fs-1 mb-2 d-block"></i>
                        <span class="d-block">Drag & Drop image here or click to browse.</span>
                        <input type="file" id="media-group" name="media[]" multiple class="d-none" accept="image/*">
                        <div id="preview-group" class="mt-3 d-flex flex-wrap gap-3"></div>
                    </div>
                </div>

                <!-- Optional video link -->
                <input class="form-control mt-2" type="text" name="video_link" placeholder="Video Link (optional)" />
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger-soft" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success-soft">Post</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal create Feed photo END -->
@endsection