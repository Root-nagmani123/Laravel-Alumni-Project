<!doctype html>
<html lang="en">
<head>
   @include('layouts.pre_header')
</head>

<body>
    @include('layouts.header')
<main>
    @yield('content')
</main>
@include('layouts.footer')
@yield('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
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

    fileInput.addEventListener('change', function () {
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

        const info = `✅ Selected: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB, ${file.type})`;
        fileInfo.innerText = info;
    });

    // Prevent form submit if file is invalid
    form.addEventListener('submit', function (e) {
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
    });
});
</script>
</body>
</html>


