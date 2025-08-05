
<!-- =======================
JS libraries, plugins and custom scripts -->

<!-- Bootstrap JS -->
<script src="{{asset('feed_assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Vendors -->
<script src="{{asset('feed_assets/vendor/tiny-slider/dist/tiny-slider.js')}}"></script>
<script src="{{asset('feed_assets/vendor/OverlayScrollbars-master/js/OverlayScrollbars.min.js')}}"></script>
<script src="{{asset('feed_assets/vendor/choices.js/public/assets/scripts/choices.min.js')}}"></script>
<script src="{{asset('feed_assets/vendor/glightbox-master/dist/js/glightbox.min.js')}}"></script>
<script src="{{asset('feed_assets/vendor/flatpickr/dist/flatpickr.min.js')}}"></script>
<script src="{{asset('feed_assets/vendor/plyr/plyr.js')}}"></script>
<script src="{{asset('feed_assets/vendor/dropzone/dist/min/dropzone.min.js')}}"></script>
<script src="{{asset('feed_assets/vendor/zuck.js/dist/zuck.min.js')}}"></script>
<script src="{{asset('feed_assets/js/zuck-stories.js')}}"></script>
<!-- Vendors -->
<script src="{{asset('feed_assets/vendor/dropzone/dist/dropzone.js')}}"></script>

<!-- Theme Functions -->
<script src="{{asset('assets/js/functions.js')}}"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


<!-- Accessibility JS -->
<script src="https://img1.digitallocker.gov.in/ux4g/UX4G-CDN-accessibility/js/weights-v1.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
       

        $('#searchMemberInput').on('input', function () {
            let query = $(this).val();

            if (query.length >= 3) {
                $.ajax({
                    url: '{{ route('user.member.search') }}',
                    type: 'GET',
                    data: { q: query },
                    success: function (response) {
                        let html = '';
                        if (response.length > 0) {
                            response.forEach(item => {
                                const favClass = item.is_favourite ? 'text-danger' : 'text-muted';
                                html += `<a href="/user/profile/id/${item.encrypted_id}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
    <span>${item.name}</span></a>
    <button class="btn btn-sm p-0 border-0 bg-transparent favorite-user" data-id="${item.encrypted_id}" type="button">
        <i class="bi bi-star ${favClass}"></i>
    </button>

`;
                            });
                        } else {
                            html = '<li class="list-group-item">No results found</li>';
                        }
                        $('#searchResults').html(html);
                    }
                });
            } else {
                $('#searchResults').html('');
            }
        });
        $('#searchMemberInput').on('focus', function () {
    let resultsHtml = ''; // ✅ Define before using it
    resultsHtml += `<a href="/user/profile/Alumni" class="list-group-item list-group-item-action">Alumni</a>`;
    $('#searchResults').html(resultsHtml).show();
    });
    
    });
       $(document).on('click', '.favorite-user', function (e) {
    e.preventDefault();
    e.stopPropagation(); // prevent triggering parent link
    const userId = $(this).data('id');
let button = $(this);
    $.ajax({
         url: '{{ route('user.favorite.user.toggle') }}',
        type: 'POST',
        data: {
            id: userId,
            _token: '{{ csrf_token() }}'
        },
         success: function(response) {
            if (response.status === 'added') {
                button.find('i').addClass('text-warning').removeClass('text-danger');
            } else if (response.status === 'removed') {
                button.find('i').addClass('text-danger').removeClass('text-warning');
            }
        }
    });
});
    
    document.getElementById('uw-widget-custom-trigger2').addEventListener('click', function() {
    // openMain();
    });
   

 

</script>
<script>
    

</script>
<link rel="stylesheet"
    href="https://img1.digitallocker.gov.in/ux4g/UX4G-CDN-accessibility/css/accesibility-style-v2.1.css">
