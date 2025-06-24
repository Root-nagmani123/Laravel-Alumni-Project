<!-- Footer Partial -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>




<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap Fileinput -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.5.4/js/fileinput.min.js"></script>

<!-- Theme: FA5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.5.4/themes/fa5/theme.min.js"></script>

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<!-- Other plugins -->
<script src="{{ asset('feed_assets/js/plugins/slick.js') }}"></script>
<script src="{{ asset('feed_assets/js/plugins/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('feed_assets/js/plugins/plyr.js') }}"></script>
<script src="{{ asset('feed_assets/js/plugins/apexcharts.js') }}"></script>
<script src="{{ asset('feed_assets/js/plugins/wow.min.js') }}"></script>
<script src="{{ asset('feed_assets/js/plugins/plugin.js') }}"></script>
<script src="{{ asset('feed_assets/js/main.js') }}"></script>

<!-- Glightbox CSS + JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>


<script>
   /*document.addEventListener('DOMContentLoaded', function () {
        const lightbox = GLightbox({
            selector: '.glightbox'
        });
    });*/

    document.addEventListener('DOMContentLoaded', function () {
    const lightbox = GLightbox({
        selector: '.glightbox',
        openEffect: 'zoom',
        onSlideAfterLoad: function({ slide }) {
            const img = slide.slideNode.querySelector('img');
            if (img) {
                img.style.maxWidth = '600px';
                img.style.maxHeight = '400px';
                img.style.objectFit = 'contain';
            }
        }
    });
});
</script>

