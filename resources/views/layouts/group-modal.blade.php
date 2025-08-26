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



                        <!-- Group Image -->
                        <div class="col-md-6">
                            <label for="grp_image" class="form-label">Upload Group Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="grp_image" id="grp_image" accept="image/*" required>

                            <div class="mt-2">
                                <img id="preview-image" src="#" alt="Image Preview" class="img-fluid rounded d-none" style="max-height: 200px;" />
                            </div>
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