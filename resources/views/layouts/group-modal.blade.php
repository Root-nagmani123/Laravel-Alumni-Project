@php
    $years = [];
    $cadres = [];
    $years = App\Models\Member::where('service', 'IAS')
        ->whereNotNull('batch')
        ->where('batch', '!=', 'NA')
        ->distinct()
        ->pluck('batch');
    $cadres = App\Models\Member::query();
    $cadres = $cadres->whereNotNull('cader')
                ->where('cader', '!=', 'NA')
                ->distinct()
                ->orderBy('cader')
                ->pluck('cader');
@endphp


@if(!empty($group))
<div class="modal fade" id="addMembersModal" tabindex="-1" aria-labelledby="groupModalLabel" aria-hidden="true">
    @else
    <div class="modal fade" id="groupModal" tabindex="-1" aria-labelledby="groupModalLabel" aria-hidden="true">
        @endif
        <div class="modal-dialog modal-lg">
            <form id="groupForm">


                @csrf
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header bg-danger text-white">
                        @if(!empty($group))
                        <h5 class="modal-title text-white" id="groupModalLabel">Add Members to Group</h5>
                        @else
                        <h5 class="modal-title text-white" id="groupModalLabel">Create Group</h5>
                        @endif
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body">
                        <div class="row g-3">
                            @if(!empty($group))
                            <input type="hidden" name="group_id" value="{{ $group->id }}">
                            @else
                            <!-- Group Name -->
                            <div class="col-md-6">
                                <label for="groupName" class="form-label">Group Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="groupName" name="group_name"
                                    placeholder="Enter group name" required>
                            </div>
                            @endif

                            <!-- Service -->
                            <div class="col-md-6">
                                <label class="form-label">Service</label>
                                <select class="form-select service" name="service" id="service"
                                    data-id="new_group_create">
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
                                <label class="form-label">Year / Batch</label>
                                <select class="form-select year-select" name="year[]" multiple="multiple"
                                    data-id="new_group_create">
                                    <!-- Options populated dynamically via AJAX -->
                                    @foreach($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Cadre -->
                            <div class="col-md-6">
                                <label class="form-label">Cadre</label>
                                <select class="form-select cadre select2" name="cadre[]" multiple="multiple"
                                    data-id="new_group_create">
                                    <!-- Options populated dynamically via AJAX -->
                                    @foreach($cadres as $cadre)
                                    <option value="{{ $cadre }}">{{ $cadre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Select Group Members <span
                                        class="text-danger">*</span></label>
                                <div class="row">
                                    <!-- Available Members -->
                                    <div class="col-md-6">
                                        <input type="text" id="searchAll" class="form-control mb-2"
                                            placeholder="Search members...">
                                        <div id="availableMembers" class="border rounded p-2"
                                            style="min-height:220px; max-height:300px; overflow-y:auto;">
                                            <!-- Available members (checkbox list) will load dynamically -->
                                        </div>
                                    </div>
                                    <!-- Selected Members -->
                                    <div class="col-md-6">
                                        <input type="text" id="searchSelected" class="form-control mb-2"
                                            placeholder="Search selected...">
                                        <div id="selectedMembers" class="border rounded p-2"
                                            style="min-height:220px; max-height:300px; overflow-y:auto;">
                                            <!-- Selected members (checkbox list) will load dynamically -->
                                        </div>
                                    </div>
                                </div>
                            </div>



                            @if(empty($group))
                            <!-- Group Image -->
                            <div class="col-md-6">
                                <label for="grp_image" class="form-label">Upload Group Image <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="grp_image" id="grp_image" accept="image/*"
                                    required>

                                <div class="mt-2">
                                    <img id="preview-image" src="#" alt="Image Preview" class="img-fluid rounded d-none"
                                        style="max-height: 200px;" />
                                </div>
                            </div>

                            <!-- Expiry Date -->
                            <div class="col-md-6">
                                <label for="end_date" class="form-label">Expiry Date <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="end_date" id="end_date" required>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        @if(!empty($group))
                        <button type="submit" class="btn btn-primary">Update Group</button>
                        @else
                        <button type="submit" class="btn btn-primary">Create Group</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Target both modal IDs
        const modals = ['#groupModal', '#addMembersModal'];

        modals.forEach(modalId => {
            const modalEl = document.querySelector(modalId);
            if (modalEl) {
                modalEl.addEventListener('hidden.bs.modal', function() {
                    // Reset the form inside modal
                    const form = modalEl.querySelector('form');
                    if (form) {
                        form.reset();
                    }

                    // Clear select2 or multiple selects if used
                    $(modalEl).find('select').val(null).trigger('change');

                    // Clear dual list boxes
                    const available = modalEl.querySelector("#availableMembers");
                    const selected = modalEl.querySelector("#selectedMembers");
                    if (selected) selected.innerHTML = "";

                    // Reset preview image
                    const previewImg = modalEl.querySelector("#preview-image");
                    if (previewImg) {
                        previewImg.src = "#";
                        previewImg.classList.add("d-none");
                    }
                });
            }
        });
    });
    </script>