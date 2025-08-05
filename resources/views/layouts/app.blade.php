<!doctype html>
<html lang="en">

<head>
    @include('layouts.pre_header')
    <style>
    #pageLoader {
        transition: opacity 0.3s ease;
    }

    #pageLoader.hide {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }
</style>

<script>
    window.addEventListener('load', function () {
        const loader = document.getElementById('pageLoader');
        if (loader) {
            loader.classList.add('hide');
            setTimeout(() => loader.remove(), 500); // optional: remove from DOM after fade
        }
    });
</script>

</head>

<body>
    <!-- Page Loader -->
<div id="pageLoader" class="position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-white" style="z-index: 9999;">
    <div class="spinner-border text-danger" role="status" style="width: 3rem; height: 3rem;">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

    @include('layouts.header')
    @if(session('success'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
    <div id="successToast" class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
        <div class="toast-body">
            {{ session('success') }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    </div>
    @endif
    <main>
   
        @yield('content')
        <div class="chat-container">
            @include('layouts.chat_accessibility')
        </div>
    </main>
    @include('layouts.footer')
    @yield('scripts')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('story_file');
        const fileError = document.getElementById('fileError');
        const fileInfo = document.getElementById('fileInfo');
        const form = document.getElementById('storyForm');

        //const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp', 'image/gif', 'image/svg+xml'];
        const allowedTypes = [
            'image/jpeg', 'image/png', 'image/jpg', 'image/webp', 'image/gif', 'image/svg+xml',
            'video/mp4', 'video/quicktime', 'video/x-msvideo' // mp4, mov, avi
        ];

        const maxSize = 10 * 1024 * 1024; // 10MB

        fileInput.addEventListener('change', function() {
            fileError.innerText = '';
            fileInfo.innerText = 'Max 10MB. Allowed types: JPG, PNG, WebP, GIF, SVG, MP4, MOV.';

            const file = this.files[0];
            if (!file) return;

            if (!allowedTypes.includes(file.type)) {
                fileError.innerText = 'Invalid file type. Allowed: JPG, PNG, WebP, GIF, SVG.';
                this.value = ''; // Reset file input
                return;
            }

            if (file.size > maxSize) {
                fileError.innerText = 'File too large. Maximum size is 10MB.';
                this.value = '';
                return;
            }

            const info =
                `✅ Selected: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB, ${file.type})`;
            fileInfo.innerText = info;
        });

        // Prevent form submit if file is invalid
        /*form.addEventListener('submit', function (e) {
            const file = fileInput.files[0];
            fileError.innerText = '';

            if (!file) {
                fileError.innerText = 'Please select a file.';
                e.preventDefault();
                return;
            }

            if (!allowedTypes.includes(file.type)) {
                fileError.innerText = 'Invalid file type.';
                e.preventDefault();
                return;
            }

            if (file.size > maxSize) {
                fileError.innerText = ' File too large.';
                e.preventDefault();
                return;
            }
        }); */
    });
    </script>
    <script>
    window.addEventListener('load', function () {
        const loader = document.getElementById('pageLoader');
        if (loader) {
            loader.style.display = 'none';
        }
    });
</script>
<!-- Toast Container -->
 <div class="modal fade" id="forumModal" tabindex="-1" aria-labelledby="forumModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="forumModalLabel">Create New Forum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Forum Name -->
                    <div class="mb-3">
                        <label for="forum_name" class="form-label">Forum Name</label>
                        <input type="text" class="form-control" id="forum_name" name="forum_name" required>
                    </div>

                    <!-- Forum Image -->
                    <div class="mb-3">
                        <label for="forum_image" class="form-label">Forum Image</label>
                        <input type="file" class="form-control" id="forum_image" name="forum_image" accept="image/*">
                    </div>

                    <!-- End Date -->
                    <div class="mb-3">
                        <label for="forum_end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="forum_end_date" name="forum_end_date" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Create Forum</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Group Modal -->
<div class="modal fade" id="groupModal" tabindex="-1" aria-labelledby="groupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="groupForm" action="{{ route('user.group.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title text-white" id="groupModalLabel">Create Group</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="groupName" class="form-label">Group Name</label>
                        <input type="text" class="form-control" id="groupName" name="group_name"
                            placeholder="Enter group name" required>
                    </div>
                    <div class="mb-3">
                        <label for="groupName" class="form-label">Services</label>
                        <select name="sector" id="" class="form-control">
                            <option value="">Select Services</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="groupName" class="form-label">Cadre</label>
                        <select name="cadre" id="" class="form-control">
                            <option value="">Select Cadre</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="groupName" class="form-label">Year</label>
                        <select name="year" id="" class="form-control">
                            <option value="">Select Year</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="groupName" class="form-label">Sector</label>
                        <select name="sector" id="" class="form-control">
                            <option value="">Select Sector</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="groupName" class="form-label">Expiry Date</label>
                        <input type="date" class="form-control" name="end_date" id="end_date">
                    </div>


                    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
                    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js">
                    </script>
                    <div class="mb-3">
                        <label for="groupName" class="form-label">Choose Members</label>
                        <select id="memberSelect" name="member_ids[]" multiple>
                          <option value="">Select Members</option>
                        </select>
                    </div>



                    <script>
                    new TomSelect('#memberSelect', {
                        plugins: ['remove_button'],
                        placeholder: 'Select members...',
                    });
                    </script>




                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Group</button>
                    </div>
                </div>
        </form>
    </div>
</div>

</body>

</html>