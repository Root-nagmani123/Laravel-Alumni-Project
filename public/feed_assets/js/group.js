$(document).ready(function () {
    $('#groupForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        
        $.ajax({
            url: window.location.origin + "/admin/group/store_ajax",
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
        url: window.location.origin + "/admin/members/list",
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