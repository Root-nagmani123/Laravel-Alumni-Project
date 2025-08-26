$(document).ready(function () {
    $('#groupForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: window.location.origin + "/store_ajax",
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
                
                if (response.success) {
                    alert(response.message);
                    $('#groupForm')[0].reset();
                    $('#groupModal').modal('hide');
                    // reload table/list if needed
                    location.reload();
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
        url: window.location.origin + "/admin/members/list",
        type: "GET",
        data: { search: query, service: service, year: year, cadre: cadre },
        success: function (data) {
            let $select = $('#availableMembers');
            $select.empty();

            $.each(data, function (index, member) {
                // agar pehle se selected me hai to skip karo
                if ($("#selectedMembers option[value='" + member.id + "']").length === 0) {
                    $select.append(`<option value="${member.id}">${member.name}</option>`);
                }
            });
        },
        error: function () {
            alert('Failed to load members.');
        }
    });
}

function selectedMembers() {
    // let $select = $('#selectedMembers');
    // $select.empty();

    // $.ajax({
    //     url: window.location.origin + "/admin/members/list",
    //     type: "GET",
    //     data: { selected: true },
    //     success: function (data) {
    //         $.each(data, function (index, member) {
    //             $select.append(`<option value="${member.id}">${member.name}</option>`);
    //         });
    //     },
    //     error: function () {
    //         alert('Failed to load members.');
    //     }
    // });
}

$(document).ready(function () {
    loadMembers();
    $('#searchAll').on('keyup', function () {
        let query = $(this).val();
        loadMembers(query);
    });

    $('#searchSelected').on('keyup', function () {
        let value = $(this).val().toLowerCase();
        $("#selectedMembers option").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $('#addMemberBtn').click(function () {
        $('#availableMembers option:selected').appendTo('#selectedMembers');
    });

    $('#removeMemberBtn').click(function () {
        $('#selectedMembers option:selected').appendTo('#availableMembers');
    });
});

// Admin side changes
$(document).ready(function () {
    $(document).on('click', '.add_member_', function () {
    // $('.add_member_').click(function () {
        let groupId = $(this).data('id');
        if (!groupId) {
            return;
        }

        $.ajax({
            url: window.location.origin + "/admin/group/members",
            type: "GET",
            data: { group_id: groupId },
            success: function (data) {
                // Populate the modal with member data
                $('#addMemberModal .modal-body').html(data);
                // $('.mentees, .cadre,.sector').select2({
                //     placeholder: "Select",
                //     allowClear: true,
                //     width: '100%'
                // });
                $('#addMemberModal').modal('show');
                loadMembers();
                selectedMembers();
            },
            error: function () {
                alert('Failed to load members.');
            }
        });
    });

    // Service change hone par Year load karo
    $(document).on('change', '.service', function () {
        let $form = $(this).closest('form');
        let service = $(this).val();
        let $year = $form.find('.year-select');

        // Pehle saaf karo
        $year.empty().append('<option></option>');

        $.ajax({
            url: window.location.origin + '/admin/get-year',
            type: 'POST',
            data: {
                service: service,
                _token: $form.find('input[name="_token"]').val()
            },
            success: function (response) {
                console.log("Response:", response);

                if (response.length === 0) {
                    $year.append('<option disabled>No Years Available</option>');
                } else {
                    $.each(response, function (key, value) {
                        $year.append('<option value="' + value + '">' + value + '</option>');
                    });
                }

                // ✅ Select2 properly re-init karna (pehle destroy karke)
                if ($year.data('select2')) {
                    $year.select2('destroy');
                }

                $year.select2({
                    placeholder: "Select Year",
                    allowClear: true,
                    dropdownParent: $form.closest('.modal'), // 🟢 ye jaroori hai modal ke liye
                    width: '100%'
                });
                loadMembers();
            },
            error: function (xhr) {
                console.error("Error loading years:", xhr.responseText);
            }
        });

        loadMembers();
    });

    // Pehle hi cadre etc. ke liye select2 init kar lo
    $(document).on('shown.bs.modal', '#addMemberModal', function () {
        $(this).find('.cadre, .select2, .year-select').each(function () {
            if (!$(this).data('select2')) {
                $(this).select2({
                    placeholder: "Select",
                    allowClear: true,
                    dropdownParent: $('#addMemberModal'), // 🟢 yahi trick sab select2 ke liye
                    width: '100%'
                });
            }
        });
    });

    $(document).on('change', '.year-select', function () {
        // alert('year changed');
        let dataId = $(this).data('id');
        let $form = $(this).closest('form');
        let service = $form.find('.service').val();
        let years = $(this).val();

        let $cadre = $form.find('.cadre');
        let $sector = $form.find('.sector');
        let $mentees = $form.find('.mentees');

        // Purane saaf karo
        $cadre.empty().append('<option></option>');
        $sector.empty().append('<option></option>');
        $mentees.empty().append('<option></option>');

        $.ajax({
            url: window.location.origin + '/admin/get-cadres',
            type: 'POST',
            data: {
                service: service,
                year: years,
                _token: $form.find('input[name="_token"]').val()
            },
            success: function (response) {
                // console.log("Cadres Response:", response);
                if (response.length === 0) {
                    $cadre.append('<option disabled>No Cadres Available</option>');
                } else {
                    console.log("Populating cadres:", response);
                    $.each(response, function (key, value) {
                        $cadre.append('<option value="' + value + '">' + value + '</option>');
                    });
                }
                console.log("Cadres Response:", $cadre);
                // ✅ Agar pehle select2 laga hua hai to destroy karo
                if ($cadre.data('select2')) {
                    $cadre.select2('destroy');
                }

                // ✅ Modal ke andar properly re-init
                $cadre.select2({
                    placeholder: "Select cadres",
                    allowClear: true,
                    closeOnSelect: false,
                    dropdownParent: $form.closest('.modal'),
                    width: '100%',
                });

                loadMembers();
            },
            error: function (xhr) {
                console.error("Error loading cadres:", xhr.responseText);
            }
        });

        loadMembers();
    });

    $(document).on('change', '.cadre', function () {
        loadMembers();
    });

    $(document).on('click', '#addMemberBtn', function () {
        $('#availableMembers option:selected').each(function () {
            $(this).remove().appendTo('#selectedMembers');
        });
    });

    // Move back to available
    $(document).on('click', '#removeMemberBtn', function () {
        $('#selectedMembers option:selected').each(function () {
            $(this).remove().appendTo('#availableMembers');
        });
    });

    $(document).on('submit', '#groupForm1', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: window.location.origin + "/admin/group/store_ajax_admin_side",
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
                    location.reload();
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


