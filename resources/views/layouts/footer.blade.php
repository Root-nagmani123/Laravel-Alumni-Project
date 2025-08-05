<!-- forum modal -->
 <div class="modal fade" id="forumModal" tabindex="-1" aria-labelledby="forumModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('user.forum.store') }}" enctype="multipart/form-data" class="modal-content">
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

    <!-- Toast for favorite actions -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1100;">
  <div id="favoriteToast" class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body"></div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<style>
.favorite-user i {
    transition: transform 0.2s, color 0.2s;
    cursor: pointer;
}

.favorite-user:hover i {
    transform: scale(1.3);
    color: #ffc107 !important; /* highlight yellow on hover */
}
</style>

<script>
    function showFavoriteToast(message, type = 'primary') {
        const toastEl = document.getElementById('favoriteToast');
        const bsToast = bootstrap.Toast.getOrCreateInstance(toastEl);

        toastEl.classList.remove('text-bg-primary', 'text-bg-success', 'text-bg-danger');
        toastEl.classList.add(`text-bg-${type}`);
        toastEl.querySelector('.toast-body').textContent = message;

        bsToast.show();
    }

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
                                const favIcon = item.is_favourite ? 'bi-star-fill text-warning' : 'bi-star text-muted';
                                html += `
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="/user/profile/id/${item.encrypted_id}" class="text-decoration-none text-dark flex-grow-1">${item.name}</a>
                                        <button class="btn btn-sm p-0 border-0 bg-transparent favorite-user" data-id="${item.encrypted_id}" type="button">
                                            <i class="bi ${favIcon}" style="font-size: 1.2rem;"></i>
                                        </button>
                                    </li>`;
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

        // Default option on focus
        $('#searchMemberInput').on('focus', function () {
            let resultsHtml = `<a href="/user/profile/Alumni" class="list-group-item list-group-item-action">Alumni</a>`;
            $('#searchResults').html(resultsHtml).show();
        });

        // Toggle favorite
        $(document).on('click', '.favorite-user', function (e) {
            e.preventDefault();
            e.stopPropagation();

            const button = $(this);
            const userId = button.data('id');

            $.ajax({
                url: '{{ route('user.favorite.user.toggle') }}',
                type: 'POST',
                data: {
                    id: userId,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    const icon = button.find('i');
                    if (response.status === 'added') {
                        icon.removeClass('bi-star text-muted text-danger')
                            .addClass('bi-star-fill text-warning');
                        showFavoriteToast('Added to favorites', 'success');
                    } else if (response.status === 'removed') {
                        icon.removeClass('bi-star-fill text-warning')
                            .addClass('bi-star text-muted');
                        showFavoriteToast('Removed from favorites', 'danger');
                    }
                }
            });
        });
    });
</script>

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
        <i class="bi bi-star-fill ${favClass}"></i>
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
            success: function (response) {
    const icon = button.find('i');
    if (response.status === 'added') {
        icon.removeClass('bi-star text-muted text-danger').addClass('bi-star-fill text-warning');
        showFavoriteToast('Added to favorites', 'success');
    } else if (response.status === 'removed') {
        icon.removeClass('bi-star-fill text-warning').addClass('bi-star text-muted');
        showFavoriteToast('Removed from favorites', 'danger');
    }
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
    function showFavoriteToast(message, type = 'primary') {
    const toastEl = document.getElementById('favoriteToast');
    const bsToast = bootstrap.Toast.getOrCreateInstance(toastEl);

    toastEl.classList.remove('text-bg-primary', 'text-bg-success', 'text-bg-danger');
    toastEl.classList.add(`text-bg-${type}`);
    toastEl.querySelector('.toast-body').textContent = message;

    bsToast.show();
}

</script>
<link rel="stylesheet"
    href="https://img1.digitallocker.gov.in/ux4g/UX4G-CDN-accessibility/css/accesibility-style-v2.1.css">
