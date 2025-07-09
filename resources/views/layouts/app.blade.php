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
document.getElementById('story_file').addEventListener('change', function () {
    const file = this.files[0];
    //const allowedTypes = ['image/jpeg', 'image/png', 'application/pdf', 'video/mp4', 'video/quicktime'];
     const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp', 'image/gif', 'image/svg+xml'];
    const maxSize = 10 * 1024 * 1024; // 10 MB
    const errorEl = document.getElementById('fileError');

    errorEl.innerText = '';

    if (!file) return;

    if (!allowedTypes.includes(file.type)) {
        //errorEl.innerText = 'Invalid file type. Only JPG, PNG, MP4, MOV, and PDF are allowed.';
        fileInfoEl.innerText = 'Max 10MB. Allowed types: JPG, PNG, WebP, GIF, SVG.';
        this.value = ''; // Clear file input
        return;
    }

    if (file.size > maxSize) {
        errorEl.innerText = 'File is too large. Maximum size is 10MB.';
        this.value = ''; // Clear file input
        return;
    }

    // Optional: Show file size/type
    const info = `Selected file: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB, ${file.type})`;
    document.getElementById('fileInfo').innerText = info;
});
</script>
</body>
</html>


