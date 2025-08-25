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
                        <label for="forum_name" class="form-label">Forum Name<span
                                            class="required text-danger ">*</span></label>
                        <input type="text" class="form-control" id="forum_name" name="forum_name" required>
                    </div>

                    <!-- Forum Image -->
                    <div class="mb-3">
                        <label for="forum_image" class="form-label">Forum Image<span
                                            class="required text-danger ">*</span></label>
                        <input type="file" class="form-control" id="forum_image" name="forum_image" accept="image/*" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="forum_description" class="form-label">Description<span
                                class="required text-danger ">*</span></label>
                        <textarea class="form-control" id="forum_description" name="forum_description" rows="3"
                            required></textarea>
                    </div>

                    <!-- End Date -->
                    <div class="mb-3">
                        <label for="forum_end_date" class="form-label">End Date<span
                                            class="required text-danger ">*</span></label>
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
<style>
.select2-results__option {
    padding-left: 10px !important;

}
.select2-container {
    /* width: 100% !important; */
    z-index: 1060 !important;


}
</style>
    <!-- Group Modal -->
<div class="modal fade" id="groupModal" tabindex="-1" aria-labelledby="groupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        {{-- <form action="{{ route('user.group.store') }}" method="POST" enctype="multipart/form-data"> --}}
        <form id="groupForm">
            @csrf
            <div class="modal-content">
                
                <!-- Header -->
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title text-white" id="groupModalLabel">Create Group</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <div class="row g-3">

                        <!-- Group Name -->
                        <div class="col-md-6">
                            <label for="groupName" class="form-label">Group Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="groupName" name="group_name" placeholder="Enter group name" required>
                        </div>

                        <!-- Service -->
                        <div class="col-md-6">
                            <label class="form-label">Service <span class="text-danger">*</span></label>
                            <select class="form-select service" name="service" id="service" data-id="new_group_create" required>
                                <option selected disabled>Select Service</option>
                                @if(isset($members) && !$members->isEmpty())
                                    @foreach($members as $member)
                                        @if(!empty($member->Service))
                                            <option value="{{ $member->Service }}">{{ $member->Service }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    <option disabled>No Services Available</option>
                                @endif
                            </select>
                        </div>

                        <!-- Year / Batch -->
                        <div class="col-md-6">
                            <label class="form-label">Year / Batch <span class="text-danger">*</span></label>
                            <select class="form-select year-select" name="year[]" multiple="multiple" data-id="new_group_create" required>
                                <!-- Options populated dynamically via AJAX -->
                            </select>
                        </div>

                        <!-- Cadre -->
                        <div class="col-md-6">
                            <label class="form-label">Cadre <span class="text-danger">*</span></label>
                            <select class="form-select cadre select2" name="cadre[]" multiple="multiple" data-id="new_group_create" required>
                                <!-- Options populated dynamically via AJAX -->
                            </select>
                        </div>

                        <!-- Dual List Members -->
                        <div class="col-12">
                            <label class="form-label">Select Group Members <span class="text-danger">*</span></label>
                            <div class="row">
                                
                                <!-- Available -->
                                <div class="col-md-5">
                                    <input type="text" id="searchAll" class="form-control mb-2"
                                        placeholder="Search members...">
                                    <select id="availableMembers" class="form-select" size="10" multiple>
                                        <!-- Members loaded dynamically by AJAX -->
                                    </select>
                                </div>

                                <!-- Controls -->
                                <div class="col-md-2 d-flex flex-column justify-content-center align-items-center">
                                    <button type="button" class="btn btn-outline-primary mb-2" id="addMemberBtn">&gt;&gt;</button>
                                    <button type="button" class="btn btn-outline-danger" id="removeMemberBtn">&lt;&lt;</button>
                                </div>

                                <!-- Selected -->
                                <div class="col-md-5">
                                    <input type="text" id="searchSelected" class="form-control mb-2"
                                        placeholder="Search selected...">
                                    <select id="selectedMembers" class="form-select" size="10" multiple name="mentees[]" required>
                                        <!-- Selected members will appear here -->
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-12">
    <label class="form-label">Select Group Members <span class="text-danger">*</span></label>
    <select id="mentees" name="mentees[]" multiple="multiple" required>
        <!-- Members AJAX se load honge -->
    </select>
</div> --}}



                        <!-- Group Image -->
                        <div class="col-md-6">
                            <label for="grp_image" class="form-label">Upload Group Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="grp_image" id="grp_image" accept="image/*" required>
                        </div>

                        <!-- Expiry Date -->
                        <div class="col-md-6">
                            <label for="end_date" class="form-label">Expiry Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="end_date" id="end_date" required>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
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


<!-- =======================
JS libraries, plugins and custom scripts -->
<!-- Bootstrap Dual Listbox CSS & JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-duallistbox/4.0.2/bootstrap-duallistbox.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-duallistbox/4.0.2/jquery.bootstrap-duallistbox.min.js"></script>

<!-- Bootstrap JS -->
<script src="{{asset('feed_assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

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


<!-- Accessibility JS -->
<script src="{{asset('feed_assets/js/weights-v1.js')}}"></script>

<script src="{{asset('feed_assets/js/jquery-3.6.0.min.js')}}"></script>

<!-- Select2 CSS -->
<link rel="stylesheet" href="{{asset('feed_assets/css/select2.min.css')}}">

<!-- Select2 JS -->
<script src="{{asset('feed_assets/js/select2.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/tributejs@5.1.3/dist/tribute.min.js"></script>
<script>
    $(document).ready(function () {
    // Move to selected
    $('#addMemberBtn').click(function () {
        $('#availableMembers option:selected').each(function () {
            $(this).remove().appendTo('#selectedMembers');
        });
    });

    // Move back to available
    $('#removeMemberBtn').click(function () {
        $('#selectedMembers option:selected').each(function () {
            $(this).remove().appendTo('#availableMembers');
        });
    });

    // On form submit: select all from "selectedMembers"
    $('#groupModal form').submit(function () {
        $('#selectedMembers option').prop('selected', true);
    });
});

    $(document).ready(function () {
        // Fetch members via AJAX
        $.ajax({
            url: "",
            type: "GET",
            success: function (data) {
                // Populate select options
                let $select = $('#mentees');
                $select.empty(); // clear old

                $.each(data, function (index, member) {
                    $select.append(`<option value="${member.id}">${member.name}</option>`);
                });

                // Initialize Dual Listbox
                $select.bootstrapDualListbox({
                    nonSelectedListLabel: 'Available Members',
                    selectedListLabel: 'Selected Members',
                    preserveSelectionOnMove: 'moved',
                    moveOnSelect: false,
                    filterPlaceHolder: 'Search',
                    infoText: 'Showing {0}',
                    infoTextEmpty: 'No members available',
                    infoTextFiltered: '<span class="badge bg-warning">Filtered</span> {0} from {1}'
                });
            },
            error: function () {
                alert('Failed to load members.');
            }
        });
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
            let query = $(this).val();
            $.ajax({
                url: '{{ route('user.search.fav.members') }}', // Laravel route
                method: 'GET',
                data: { search: query },
                success: function (response) {
                    let resultsHtml = '';
                            resultsHtml += '<li class="list-group-item d-flex justify-content-between align-items-center"><a href="/user/profile/Alumni" class="text-decoration-none text-dark flex-grow-1">Alumni</a><button class="btn btn-sm p-0 border-0 bg-transparent favorite-user" data-id="Alumni" type="button"><i class="bi bi-star-fill text-warning" style="font-size: 1.2rem;"></i></button></li>';

                   

            if (response.length > 0) {
                response.forEach(function (member) {
                    resultsHtml += `
                        <a href="/user/profile/${member.username}" 
                           class="list-group-item list-group-item-action">
                            ${member.name}
                        </a>
                    `;
                });
            } else {
                resultsHtml = `<div class="list-group-item">No results found</div>`;
            }

            $('#searchResults').html(resultsHtml).show();
        }
    });
            // let resultsHtml = `<a href="/user/profile/Alumni" class="list-group-item list-group-item-action">Alumni</a>`;
            // $('#searchResults').html(resultsHtml).show();
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
    // Service change (for both forms)
    // After service selection, populate year
$('.service').on('change', function () {
    let dataId = $(this).data('id');
    let $form = $(this).closest('form');
    let service = $(this).val();
    let $year = $form.find('.year-select[data-id="' + dataId + '"]');
    
    $year.empty().append('');
    console.log(dataId);
    console.log($form);
    console.log(service);
    console.log($year);

    $.ajax({
        url: '{{ route("user.get.years") }}',
        type: 'POST',
        data: {
            service: service,
            _token: '{{ csrf_token() }}'
        },
        success: function (response) {
            $.each(response, function (key, value) {
                $year.append('<option value="' + value + '">' + value + '</option>');
            });
            console.log($year);
            $year.prop('disabled', false);
            $year.select2({ 
                placeholder: "Select Years",
                closeOnSelect: false,
                // templateResult: formatCheckbox,
                templateSelection: formatSelection
            });
        }
    });
    loadMembers();
});


    // Year change
   $('.year-select').on('change', function () {
        let dataId = $(this).data('id');
        let $form = $(this).closest('form');
        let service = $form.find('.service[data-id="' + dataId + '"]').val();
        let years = $(this).val();
        
        let $cadre = $form.find('.cadre[data-id="' + dataId + '"]');
        $cadre.empty().append('');
        $form.find('.sector[data-id="' + dataId + '"]').empty().append('');
        $form.find('.mentees[data-id="' + dataId + '"]').empty().append('');
        $.ajax({
            url: '{{ route("user.get.cadres") }}',
            type: 'POST',
            data: {
                service: service,
                year: years,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                $.each(response, function (key, value) {
                    $cadre.append('<option value="' + value + '">' + value + '</option>');
                });
                $cadre.prop('disabled', false);
            $cadre.select2({ 
                placeholder: "Select cadres",
                closeOnSelect: false,
                // templateResult: formatCheckbox,
                templateSelection: formatSelection
            });
            }
        });
        loadMembers();
    });

    // Cadre change
    $('.cadre').on('change', function () {
        let dataId = $(this).data('id');
        let $form = $(this).closest('form');
        let service = $form.find('.service[data-id="' + dataId + '"]').val();
        let year = $form.find('.year[data-id="' + dataId + '"]').val();
       let cadre = $(this).val();
        let $sector = $form.find('.sector[data-id="' + dataId + '"]');
        $sector.empty().append('');
        $form.find('.mentees[data-id="' + dataId + '"]').empty().append('');
        $.ajax({
            url: '{{ route("user.get.sectors") }}',
            type: 'POST',
            data: {
                service: service,
                year: year,
                cadre: cadre,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                $.each(response, function (key, value) {
                    $sector.append('<option value="' + value + '">' + value + '</option>');
                });
                $sector.prop('disabled', false);
                $sector.select2({ 
                    placeholder: "Select sectors",
                    closeOnSelect: false,
                    // templateResult: formatCheckbox,
                    templateSelection: formatSelection
                });
            }
        });
        loadMembers();
    });

    // Sector change
    $('.sector').on('change', function () {
        let dataId = $(this).data('id');
        let $form = $(this).closest('form');
        let service = $form.find('.service[data-id="' + dataId + '"]').val();
        let year = $form.find('.year-select[data-id="' + dataId + '"]').val();
        let cadre = $form.find('.cadre[data-id="' + dataId + '"]').val();
        let sector = $(this).val();
        let $mentees = $form.find('.mentees[data-id="' + dataId + '"]');
        $mentees.empty().append('');
        $.ajax({
            url: '{{ route("user.get.mentees") }}',
            type: 'POST',
            data: {
                dataId: dataId,
                service: service,
                year: year,
                cadre: cadre,
                sector: sector,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                $.each(response, function (key, user) {
                    $mentees.append('<option value="' + user.id + '">' + user.name + '</option>');
                });
                $mentees.prop('disabled', false);
                $mentees.select2({ 
                    placeholder: "Select Mentees",
                    closeOnSelect: false,
                    // templateResult: formatCheckbox,
                    templateSelection: formatSelection
                });
            }
        });
    });

    // Initialize Select2 for both mentee selects
    $('.year-select,.mentees, .cadre,.sector').select2({
        placeholder: "Select",
    allowClear: true,
    width: '100%'
    });
});
function formatCheckbox(option) {
    if (!option.id) return option.text;

    const selected = $(option.element).is(':selected');
    const $checkbox = $(`
        <span>
            <input type="checkbox" class="select2-checkbox me-2" ${selected ? 'checked' : ''} />
            ${option.text}
        </span>
    `);
    return $checkbox;
}

function formatSelection(option) {
    return option.text;
}
$(document).on('click', '.select2-results__option', function (e) {
    const $option = $(this);
    const $checkbox = $option.find('.select2-checkbox');

    // Delay execution to ensure Select2 processes click
    setTimeout(() => {
        const select = $option.closest('.select2-container').prev('select');
        const value = $option.attr('id')?.replace('select2-', '')?.split('-result-')[1];

        if (!value) return;

        // Manually toggle the selected option
        const currentValue = select.val() || [];
        const index = currentValue.indexOf(value);

        if (index > -1) {
            currentValue.splice(index, 1); // remove
        } else {
            currentValue.push(value); // add
        }

        select.val(currentValue).trigger('change');
    }, 0);
});

document.addEventListener('DOMContentLoaded', function () {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById("forum_end_date").setAttribute('min', today);
        document.getElementById("end_date").setAttribute('min', today);
    });


$(document).ready(function () {
    $('#groupForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        
        $.ajax({
            url: "{{ route('group.store_ajax') }}", // store route
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                // Disable submit button & show loading
                $('#groupForm button[type="submit"]').prop('disabled', true).text('Saving...');
            },
            success: function (response) {
                $('#groupForm button[type="submit"]').prop('disabled', false).text('Create Group');
                console.log(response);
                if (response.success) {
                    alert(response.message);
                    $('#groupForm')[0].reset();
                    $('#groupModal').modal('hide');
                    // reload table/list if needed
                    if (typeof groupTable !== "undefined") groupTable.ajax.reload();
                } else {
                    alert('Something went wrong.');
                }
            },
            error: function (xhr) {
                $('#groupForm button[type="submit"]').prop('disabled', false).text('Create Group');
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error('Server error. Please try again.');
                }
            }
        });
    });
});
function loadMembers(query = '') {
    let service = $('#service').val();
    let year = $('.year-select').val();
    let cadre = $('.cadre').val();
    $.ajax({
        url: "{{ route('admin.members.list') }}",
        type: "GET",
        data: { search: query, service: service, year: year, cadre: cadre },
        success: function (data) {
            let $select = $('#availableMembers');
            $select.empty();

            $.each(data, function (index, member) {
                // agar pehle se selected me hai to skip karo
                if ($("#selectedMembers option[value='"+member.id+"']").length === 0) {
                    $select.append(`<option value="${member.id}">${member.name}</option>`);
                }
            });
        },
        error: function () {
            alert('Failed to load members.');
        }
    });
}
$(document).ready(function () {
    // Initial load of available members
    loadMembers();
    // Search in available members (server-side)
    $('#searchAll').on('keyup', function () {
        let query = $(this).val();
        loadMembers(query);
    });

    // Local search in selected members
    $('#searchSelected').on('keyup', function () {
        let value = $(this).val().toLowerCase();
        $("#selectedMembers option").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Add members
    $('#addMemberBtn').click(function () {
        $('#availableMembers option:selected').appendTo('#selectedMembers');
    });

    // Remove members
    $('#removeMemberBtn').click(function () {
        $('#selectedMembers option:selected').appendTo('#availableMembers');
    });
});


</script>
<link rel="stylesheet"
    href="https://img1.digitallocker.gov.in/ux4g/UX4G-CDN-accessibility/css/accesibility-style-v2.1.css">
