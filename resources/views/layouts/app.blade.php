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
    @livewireStyles
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

    window.addEventListener('open-chat-toast', event => {
        const { id, name, avatar } = event.detail;

        const toast = document.getElementById('chatToast');

        // You could dynamically inject the data here
        toast.querySelector('.toast-header h6').textContent = name;
        toast.querySelector('.toast-header img').src = avatar;
        
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();
    });

</script>
<!-- Toast Container -->

@livewireScripts

</body>

</html>