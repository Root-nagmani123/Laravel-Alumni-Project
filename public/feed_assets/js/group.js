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

function renderMember(member, checked = false) {
    return `
        <div class="form-check">
            <input class="form-check-input member-checkbox" type="checkbox" 
                   value="${member.id}" id="member_${member.id}" 
                   name="mentees[]" ${checked ? 'checked' : ''}>
            <label class="form-check-label" for="member_${member.id}">${member.name}</label>
        </div>
    `;
}

// ✅ Helper: sort by name (case-insensitive)
function sortByName(list) {
    return list.sort((a, b) => a.name.localeCompare(b.name, 'en', { sensitivity: 'base' }));
}

// ✅ Load available members
function loadMembers(query = '') {
    let year = $('.year-select').val() || [];
    let service = $('.service').val();
    let cadre = $('.cadre').val();
    $.ajax({
        url: window.location.origin + "/admin/members/list",
        type: "GET",
        data: { search: query, year: year, service: service, cadre: cadre },
        success: function (data) {
            let $available = $('#availableMembers');
            $available.empty();

            // 🔑 Sort alphabetically
            let sortedData = sortByName(data);

            $.each(sortedData, function (i, member) {
                // skip if already selected
                if ($("#selectedMembers input[value='" + member.id + "']").length === 0) {
                    $available.append(renderMember(member, false));
                }
            });
        }
    });
}

// ✅ Load existing members (from group)
function loadExistingMembers(group_id) {
    if (!group_id) return;

    $.ajax({
        type: "GET",
        url: window.location.origin + "/admin/group/existing_member",
        data: { group_id: group_id },
        success: function (data) {
            let $selected = $('#selectedMembers');
            $selected.empty();

            // 🔑 Sort alphabetically
            let sortedData = sortByName(data);

            $.each(sortedData, function (index, member) {
                $selected.append(renderMember(member, true));
            });

            loadMembers();
        },
        error: function (xhr) {
            console.error("Error loading existing members:", xhr.responseText);
        }
    });
}

// ✅ Checkbox toggle handler (move between lists)
$(document).on('change', '.member-checkbox', function () {
    let $checkbox = $(this);
    let id = $checkbox.val();
    let name = $checkbox.next('label').text();
    let isChecked = $checkbox.is(':checked');

    $checkbox.closest('.form-check').remove();

    if (isChecked) {
        $('#selectedMembers').append(renderMember({ id: id, name: name }, true));
        sortList('#selectedMembers'); // keep sorted
    } else {
        $('#availableMembers').append(renderMember({ id: id, name: name }, false));
        sortList('#availableMembers'); // keep sorted
    }
});

// ✅ Helper: sort DOM list after adding/removing
function sortList(container) {
    let $container = $(container);
    let items = $container.children('.form-check').get();

    items.sort(function (a, b) {
        let nameA = $(a).find('label').text().toLowerCase();
        let nameB = $(b).find('label').text().toLowerCase();
        return nameA.localeCompare(nameB);
    });

    $.each(items, function (i, itm) {
        $container.append(itm);
    });
}

$(document).ready(function () {
    loadMembers();

    // modal events
    $(document).on('shown.bs.modal', '#addMemberModal', function () {
        let groupId = $("input[name='group_id']").val();
        loadExistingMembers(groupId);
    });

    $(document).on('shown.bs.modal', '#addMembersModal', function () {
        let group_id = $("input[name='group_id']").val();
        loadExistingMembers(group_id);
    });
});
$('.year-select, .cadre, .service').on('change', function () {
    loadMembers();
});

$(document).on('keyup', '#searchAll', function () {
    let query = $(this).val();
    loadMembers(query);
});


// // Admin side changes
$(document).ready(function () {
    $(document).on('click', '.add_member_', function () {
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
                $('#addMemberModal').modal('show');
                loadMembers();
                loadExistingMembers(groupId);
            },
            error: function () {
                alert('Failed to load members.');
            }
        });
    });

    $(document).on('change', '.cadre, .select2, .year-select', function () {
        loadMembers();
    });

//     // Pehle hi cadre etc. ke liye select2 init kar lo
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
                    // $('#groupForm')[0].reset();
                    // $('#groupModal').modal('hide');
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


