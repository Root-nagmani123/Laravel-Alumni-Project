@extends('admin.layouts.master')

@section('title', 'Group - Alumni | Lal Bahadur')

@section('content')

<div class="container-fluid">
    <x-breadcrum title="Group" />
    <x-session_message />
    <!-- start Vertical Steps Example -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Create Group</h4>
            <hr>
            <form action="{{ route('group.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Group Name -->
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Group Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>

                    <!-- Group End Date -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Group End Date</label>
                            <input type="date" class="form-control" name="end_date">
                        </div>
                    </div>

                    <!-- Group Image -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Group Image</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                            <!-- Preview -->
                            <div class="mt-2">
                                <img id="preview-image" src="#" alt="Image Preview" class="img-fluid rounded d-none"
                                    style="max-height: 200px;" />
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="mb-3 gap-2 float-end">
                    <button class="btn btn-primary" type="submit">Create Group</button>
                    <a href="{{ route('group.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end Vertical Steps Example -->

<!-- Script -->
<script>
const allMembers = document.getElementById('allMembers');
const selectedMembers = document.getElementById('selectedMembers');

// Move instantly on check/uncheck
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('member-checkbox')) {
        const wrapper = e.target.closest('.form-check');
        if (e.target.checked) {
            e.target.name = 'user_id[]';
            selectedMembers.appendChild(wrapper);
            sortList(selectedMembers);
        } else {
            e.target.removeAttribute('name');
            allMembers.appendChild(wrapper);
            sortList(allMembers);
        }
    }
});

// Sort alphabetically by label text
function sortList(container) {
    const items = Array.from(container.querySelectorAll('.form-check'));
    items.sort((a, b) => {
        const nameA = a.querySelector('label').textContent.trim().toLowerCase();
        const nameB = b.querySelector('label').textContent.trim().toLowerCase();
        return nameA.localeCompare(nameB);
    });
    items.forEach(item => container.appendChild(item));
}

// Search filtering
function setupSearch(inputId, containerId) {
    document.getElementById(inputId).addEventListener('keyup', function() {
        const query = this.value.toLowerCase();
        document.querySelectorAll(`#${containerId} .form-check`).forEach(item => {
            const name = item.querySelector('label').textContent.toLowerCase();
            item.style.display = name.includes(query) ? '' : 'none';
        });
    });
}

setupSearch('searchAll', 'allMembers');
setupSearch('searchSelected', 'selectedMembers');
</script>

</div>
<!-- image preview js -->
@section('scripts')
<script>
document.getElementById('image').addEventListener('change', function(event) {
    const preview = document.getElementById('preview-image');
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        }
        reader.readAsDataURL(file);
    } else {
        preview.src = '#';
        preview.classList.add('d-none');
    }
});
$(document).ready(function() {
    $('.form-select').select2(); // Initialize Select2
    $('.js-example-basic-multiple').select2(); // Initialize Select2 for multiple select

    // Filter out mentor from mentees dropdown
    $('#searchable-select').on('change', function() {
        var selectedMentor = $(this).val();
        var menteesSelect = $('.js-example-basic-multiple');

        // Reset mentees selection
        menteesSelect.val(null).trigger('change');

        // Hide the mentor option from mentees dropdown
        menteesSelect.find('option').show();
        if (selectedMentor) {
            menteesSelect.find('option[value="' + selectedMentor + '"]').hide();
        }
    });
});
$(document).ready(function() {
    $('#mentor_id').select2({
        placeholder: "-- Select Member --",
        minimumInputLength: 2, // start search after typing 2 chars
        ajax: {
            url: '{{ route("admin.members.search") }}',
            type: 'POST',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term,
                    _token: '{{ csrf_token() }}'
                };
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            id: item.id,
                            text: item.name
                        };
                    })
                };
            },
            cache: true
        }
    });
});
</script>
@endsection
@endsection