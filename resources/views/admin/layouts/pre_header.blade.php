<!-- Required meta tags -->
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- CSRF Token for AJAX -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Favicon icon-->
<link rel="shortcut icon" type="image/ico" href="{{asset('admin_assets/images/logos/favicon.ico')}}">
<!-- Core Css -->
<link rel="stylesheet" href="{{asset('admin_assets/css/styles.css')}}">

<!-- themify icon Css -->
<link rel="stylesheet" href="{{asset('admin_assets/css/themify-icons.css')}}">

<!-- Toastr CSS for notifications -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<link rel="stylesheet" href="{{asset('admin_assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css"
    integrity="sha512-XcIsjKMcuVe0Ucj/xgIXQnytNwBttJbNjltBV18IOnru2lDPe9KRRyvCXw6Y5H415vbBLRm8+q6fmLUU7DfO6Q=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css"
    integrity="sha512-kJlvECunwXftkPwyvHbclArO8wszgBGisiLeuDFwNM8ws+wKIw0sv1os3ClWZOcrEB2eRXULYUsm8OVRGJKwGA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- HTML Validation Error Styling -->
    <style>
        /* Error message styling for HTML validation */
        .html-validation-error {
            display: block;
            width: 100%;
            clear: both;
            word-wrap: break-word;
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Ensure error messages don't overlap with input groups */
        .input-group ~ .html-validation-error {
            display: block;
            margin-top: 0.25rem;
        }

        /* Bootstrap validation styling compatibility */
        .is-invalid {
            border-color: #dc3545;
        }

        /* Form validation state styling */
        .html-validation-invalid {
            opacity: 0.8;
        }

        .html-validation-invalid .btn[type="submit"] {
            opacity: 0.6;
            cursor: not-allowed;
        }
    </style>

    