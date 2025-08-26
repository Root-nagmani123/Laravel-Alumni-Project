  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="{{asset('admin_assets/js/vendor.min.js')}}"></script>
  <!-- Import Js Files -->
  <script src="{{asset('admin_assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('admin_assets/libs/simplebar/dist/simplebar.min.js')}}"></script>
  <script src="{{asset('admin_assets/js/theme/app.init.js')}}"></script>
  <script src="{{asset('admin_assets/js/theme/theme.js')}}"></script>
  <script src="{{asset('admin_assets/js/theme/app.min.js')}}"></script>
  <script src="{{asset('admin_assets/js/theme/sidebarmenu.js')}}"></script>

  <!-- solar icons -->
  <script src="{{asset('admin_assets/css/iconify-icon.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

  <!-- highlight.js (code view) -->
  <script src="{{asset('admin_assets/js/highlights/highlight.min.js')}}"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">



  <script>
  hljs.initHighlightingOnLoad();


  document.querySelectorAll("pre.code-view > code").forEach((codeBlock) => {
    codeBlock.textContent = codeBlock.innerHTML;
  });
</script>
  <script src="{{asset('admin_assets/libs/jquery-steps/build/jquery.steps.min.js')}}"></script>
  <script src="{{asset('admin_assets/libs/jquery-validation/dist/jquery.validate.min.js')}}"></script>
  <script src="{{asset('admin_assets/js/forms/form-wizard.js')}}"></script>
  <script src="{{asset('admin_assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin_assets/js/datatable/datatable-basic.init.js')}}"></script>
  <script src="{{asset('admin_assets/js/forms/repeater-init.js')}}"></script>
  <script src="{{asset('admin_assets/libs/fullcalendar/index.global.min.js')}}"></script>
  <script src="{{asset('admin_assets/js/pages/calendar.init.js')}}"></script>
  <script src="{{asset('admin_assets/libs/fullcalendar/index.global.min.js')}}"></script>
  <script src="{{asset('admin_assets/js/apps/contact.js')}}"></script>
  <script src="{{asset('admin_assets/js/custom.js')}}"></script>
  <!-- Toastr JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- Toggle button JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<!-- Sweet Aert JS -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script src="{{ asset('feed_assets/js/group.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
  @yield('scripts')
  @stack('scripts')
