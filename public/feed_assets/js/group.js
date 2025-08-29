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
    $.ajax({
        url: window.location.origin + "/admin/members/list",
        type: "GET",
        data: { search: query },
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

// ✅ Load selected members (existing)
function loadSelectedMembers(groupId) {
    $.ajax({
        url: window.location.origin + "/admin/members/selected",
        type: "GET",
        data: { group_id: groupId },
        success: function (data) {
            let $selected = $('#selectedMembers');
            $selected.empty();

            // 🔑 Sort alphabetically
            let sortedData = sortByName(data);

            $.each(sortedData, function (i, member) {
                $selected.append(renderMember(member, true));
            });

            loadMembers();
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
        loadSelectedMembers(groupId);
    });

    $(document).on('shown.bs.modal', '#addMembersModal', function () {
        let group_id = $("input[name='group_id']").val();
        loadExistingMembers(group_id);
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
                loadSelectedMembers();
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


