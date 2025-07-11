<!-- Right sidebar START -->
<div class="col-lg-3 right-sidebar">
    <div class="row g-4">
        <!-- Card follow START -->
        <div class="col-sm-6 col-lg-12">
            <div class="card">
                <!-- Card header START -->
                <div class="card-header pb-0 border-0">
                    <h5 class="card-title mb-0">Our Member</h5>
                </div>
                <!-- Card header END -->
                <!-- Card body START -->
                <div class="card-body">
                    @if(isset($members) && $members->count() > 0)
                    @foreach($members as $index => $row)
                    <!-- Connection item START -->
                    <div class="hstack gap-2 mb-3">
                        <!-- Avatar -->
                        <div class="avatar">
                            <a href="#!"><img class="avatar-img rounded-circle"
                                    src="{{asset('feed_assets/images/avatar/04.jpg')}}" alt=""></a>
                        </div>
                        <!-- Title -->
                        <div class="overflow-hidden">
                            <a class="h6 mb-0" href="#!">{{ $row->name }}</a>
                            <p class="mb-0 small text-truncate">News anchor <span>(Mah, 1995)</span></p>
                        </div>
                    </div>
                    @endforeach
                    <!-- View more button -->
                    <div class="d-grid mt-3">
                        <a class="btn btn-sm btn-primary-soft" href="{{route('user.directory')}}">View more</a>
                    </div>
                    <!-- Connection item END -->
                    @else
                    <p class="text-muted">No members available</p>
                    @endif


                </div>
                <!-- Card body END -->
            </div>
        </div>
        <!-- Card follow START -->

        <!-- Card News START -->
        <div class="col-sm-6 col-lg-12">
            <div class="card">
                <!-- Card header START -->
                <div class="card-header pb-0 border-0">
                    <h5 class="card-title mb-0">Broadcasts</h5>
                </div>
                <!-- Card header END -->
                <!-- Card body START -->
                <div class="card-body">
                    <!-- News item -->
                    @if((isset($broadcast)) && ($broadcast->count() > 0))
                    @foreach($broadcast as $index => $broadcast)
                    <div class="mb-3">
                        <h6 class="mb-0"><a href="blog-details.html">{{ $broadcast->title }}</a></h6>
                        <small>{{ $broadcast->description }}</small>
                    </div>
                    @endforeach
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
                <div class="card-header pb-0 border-0">
                    <h5 class="card-title mb-0">Recents</h5>
                </div>
                <!-- Card header END -->
                <!-- Card body START -->
                <div class="card-body">
                    <!-- Connection item START -->
                    @if(isset($groupNames) && $groupNames->count() > 0)
                    @foreach($groupNames as $index => $recent)
                    <div class="hstack gap-2 mb-3">
                        <!-- Title -->
                        <div class="overflow-hidden">
                            <a class="mb-0" href="#!">{{ $recent->name}}</a>
                        </div>
                        <!-- Button -->
                        <a class="btn btn-primary-soft rounded-circle icon-md ms-auto open-group-post-modal" href="#"
                            data-bs-toggle="modal" data-bs-target="#groupActionpost"
                            data-group-name="{{ $recent->name }}"  data-group-id="{{ $recent->id }}">
                            <i class="fa-solid fa-plus"></i>
                        </a>

                    </div>
                    @endforeach
                    @else
                    <p class="text-muted">No recent groups available</p>
                    @endif

                </div>
                <!-- Card body END -->
            </div>
        </div>
        <!-- Card follow START -->
    </div>
</div>
<script>
	 document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('groupActionpost');
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const groupName = button.getAttribute('data-group-name');
           const groupId = button.getAttribute('data-group-id');


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