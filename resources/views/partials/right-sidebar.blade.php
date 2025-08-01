<!-- Right sidebar START -->
<div class="row g-4">
    <!-- Card follow START -->
    <!-- Card News START -->
    <div class="col-sm-6 col-lg-12">
        <div class="card">
            <!-- Card header START -->
            <div class="card-header pb-0 border-0">
                <h5 class="card-title mb-0">Mentorship Program</h5>
            </div>
            <!-- Card header END -->
            <!-- Card body START -->
            <div class="card-body  overflow-auto" style="max-height: 500px;">

                <!-- News item -->
                <!-- Links -->
                <a href="{{ route('user.mentor_mentee') }}" class="text-decoration-none" style="color:#af2910;">Wants to
                    become Mentor / Mentee</a>
            </div>
            <!-- Card body END -->
        </div>
    </div>

    <!-- Card News END -->
    <!-- Card News START -->
    <div class="col-sm-6 col-lg-12">
        <div class="card">
            <!-- Card header START -->
            <div class="card-header pb-0 border-0">
                <h5 class="card-title mb-0">Broadcasts</h5>
            </div>
            <!-- Card header END -->
            <!-- Card body START -->
            <div class="card-body  overflow-auto" style="max-height: 500px;">
                <!-- News item -->
                @if((isset($broadcast)) && ($broadcast->count() > 0))
                @foreach($broadcast as $index => $broadcast)
                <div class="mb-3">

                    <div class="d-flex align-items-center gap-2 mb-2">
                        @if($broadcast->image_url)
                        <img class="avatar-img rounded" src="{{ asset('storage/' . $broadcast->image_url) }}" alt=""
                            height="45" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $broadcast->title }}"
                            style="height: 85px; object-fit: cover;" loading="lazy" decoding="async">
                        @else
                        <img src="{{ asset('assets/images/no-image.png') }}" width="45" class="rounded-circle"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="No image available" alt="No image"
                            loading="lazy">
                        @endif

                    </div>

                    <h6 class="mb-0"><a
                            href="{{ route('user.broadcastDetails', $broadcast->id) }}">{{ $broadcast->title }}</a>
                    </h6>
                    <small>{{ \Illuminate\Support\Str::limit($broadcast->description, 50) }} <span><a
                                href="{{ route('user.broadcastDetails', $broadcast->id) }}" class="text-danger">View
                                more</a></span></small>
                </div>
                <hr>
                @endforeach
                <span class="divider"></span>
                @else
                <div class="mb-3">
                    <p class="mb-0 text-muted">No broadcasts available</p>
                </div>
                @endif
            </div>
            <!-- Card body END -->
        </div>
    </div>
    <!-- Card News END -->
    <!-- Card follow START -->
    <div class="col-sm-6 col-lg-12">
        <div class="card">
            <!-- Card header START -->
            <div class="card-header d-sm-flex justify-content-between border-0">
                <h5 class="card-title">Groups</h5>
                <a class="btn btn-primary-soft btn-sm" href="" data-bs-toggle="modal" data-bs-target="#groupModal">
                    Create groups</a>

            </div>
            <!-- Card header END -->
            <!-- Card body START -->
            <div class="card-body">
                <!-- Connection item START -->
                @if(isset($groupNames) && $groupNames->count() > 0)
                @foreach($groupNames as $index => $recent)
                <div class="hstack gap-3 mb-3 align-items-center">
                    <!-- Group Image -->
                    <div class="avatar avatar-md">
                        <img src="{{asset('storage/uploads/images/grp_img/' . ($recent->image ?? 'default-group.png')) }}"
                            alt="Group Image" class="rounded-circle img-fluid"
                            style="width: 48px; height: 48px; object-fit: cover;">
                    </div>

                    <!-- Title + End Date -->
                    <div class="overflow-hidden">
                        <a class="mb-0 fw-semibold d-block text-truncate"
                            href="{{ route('user.group-post', $recent->id) }}">
                            
                            {{ ($recent->name) }}
                        </a>
                        <small class="text-muted d-block">End Date: {{ \Carbon\Carbon::parse($forum->end_date ?? now())->format('d-m-Y') }}</small>
                    </div>

                    <!-- Post Button -->
                    <a class="btn btn-primary-soft rounded-circle icon-md ms-auto open-group-post-modal" href="#"
                        data-bs-toggle="modal" data-bs-target="#groupActionpost" data-group-name="{{ $recent->name }}"
                        data-group-id="{{ $recent->id }}">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                </div>

                @endforeach
                <div class="d-grid mt-3">
                    <a class="btn btn-sm btn-primary-soft" href="{{ route('user.groups') }}">View more</a>
                </div>
                @else
                <p class="text-muted">No recent groups available</p>
                @endif

            </div>
            <!-- Card body END -->
        </div>
    </div>
    <!-- Card follow START -->
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
                            @foreach($members as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                            @endforeach
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('groupActionpost');
    modal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const groupName = button.getAttribute('data-group-name');
        console.log(groupName);
        const groupId = button.getAttribute('data-group-id');
        console.log(groupId);


        // Set hidden input value
        modal.querySelector('.group_id').value = groupId;
        //console.log(groupName); // Debugging line to check group name
        const modalTitleSpan = modal.querySelector('.group_name');

        if (modalTitleSpan) {
            modalTitleSpan.textContent = groupName;
        }
    });
});
</script>



<!-- Right sidebar END -->