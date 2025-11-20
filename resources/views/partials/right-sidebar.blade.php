<!-- Right sidebar START -->
<style>
/* Right Sidebar Responsive Styles */
.right-sidebar-container {
    margin-top: 0;
}

/* Mentorship Card */
.mentorship-card {
    height: 152px;
}

/* Newsletter Card */
.newsletter-cover {
    height: 55px;
}

/* Broadcast Card Scrolling */
.broadcast-scroll {
    max-height: 500px;
    scrollbar-width: thin;
    scrollbar-color: #af2910 transparent;
}

.broadcast-scroll::-webkit-scrollbar {
    width: 6px;
}

.broadcast-scroll::-webkit-scrollbar-track {
    background: transparent;
}

.broadcast-scroll::-webkit-scrollbar-thumb {
    background-color: #af2910;
    border-radius: 3px;
}

/* Group List */
.group-list {
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: #af2910 transparent;
}

.group-list::-webkit-scrollbar {
    width: 6px;
}

.group-list::-webkit-scrollbar-track {
    background: transparent;
}

.group-list::-webkit-scrollbar-thumb {
    background-color: #af2910;
    border-radius: 3px;
}

/* Avatar sizes */
.avatar-md {
    width: 48px;
    height: 48px;
}

.avatar-md img {
    width: 48px;
    height: 48px;
}

/* Responsive breakpoints */
@media (max-width: 1199.98px) {
    .mentorship-card {
        height: auto;
        min-height: 140px;
    }
    
    .broadcast-scroll {
        max-height: 400px;
    }
}

@media (max-width: 991.98px) {
    .right-sidebar-container {
        margin-top: 2rem;
    }
    
    .mentorship-card {
        min-height: 130px;
    }
    
    .newsletter-cover {
        height: 50px;
    }
    
    .broadcast-scroll {
        max-height: 350px;
    }
    
    .card-header h5 {
        font-size: 1rem;
    }
    
    .card-body {
        font-size: 0.9rem;
    }
}

@media (max-width: 767.98px) {
    .right-sidebar-container {
        margin-top: 1.5rem;
    }
    
    .right-sidebar-container .col-sm-6 {
        margin-bottom: 1rem;
    }
    
    .mentorship-card {
        min-height: 120px;
    }
    
    .card-header h5 {
        font-size: 0.95rem;
    }
    
    .card-header .btn-sm {
        font-size: 0.8rem;
        padding: 0.35rem 0.7rem;
    }
    
    .newsletter-cover {
        height: 45px;
    }
    
    .card-footer .btn {
        font-size: 0.85rem;
        padding: 0.4rem 0.8rem;
    }
    
    .broadcast-scroll {
        max-height: 300px;
    }
    
    .broadcast-scroll img {
        height: 70px !important;
    }
    
    .broadcast-scroll h6 {
        font-size: 0.9rem;
    }
    
    .broadcast-scroll small {
        font-size: 0.75rem;
    }
    
    .avatar-md {
        width: 42px;
        height: 42px;
    }
    
    .avatar-md img {
        width: 42px !important;
        height: 42px !important;
    }
    
    .group-item .overflow-hidden a {
        font-size: 0.9rem;
    }
    
    .group-item .overflow-hidden small {
        font-size: 0.75rem;
    }
    
    .icon-md {
        width: 35px !important;
        height: 35px !important;
        font-size: 0.85rem;
    }
}

@media (max-width: 575.98px) {
    .right-sidebar-container {
        margin-top: 1rem;
    }
    
    .right-sidebar-container .g-4 {
        gap: 1rem !important;
    }
    
    .mentorship-card {
        min-height: 110px;
        padding: 0.75rem;
    }
    
    .card-header {
        padding: 0.75rem;
    }
    
    .card-header h5 {
        font-size: 0.9rem;
    }
    
    .card-header .btn-sm {
        font-size: 0.75rem;
        padding: 0.3rem 0.6rem;
    }
    
    .card-body {
        padding: 0.75rem;
        font-size: 0.85rem;
    }
    
    .card-footer {
        padding: 0.75rem;
    }
    
    .card-footer .btn {
        font-size: 0.8rem;
        padding: 0.35rem 0.7rem;
    }
    
    .newsletter-cover {
        height: 40px;
    }
    
    .broadcast-scroll {
        max-height: 250px;
    }
    
    .broadcast-scroll img {
        height: 60px !important;
        width: 100%;
        object-fit: cover;
    }
    
    .broadcast-scroll h6 {
        font-size: 0.85rem;
        line-height: 1.3;
    }
    
    .broadcast-scroll small {
        font-size: 0.7rem;
        line-height: 1.3;
    }
    
    .broadcast-scroll .mb-3 {
        margin-bottom: 0.75rem !important;
    }
    
    .avatar-md {
        width: 38px;
        height: 38px;
    }
    
    .avatar-md img {
        width: 38px !important;
        height: 38px !important;
    }
    
    .group-item {
        gap: 0.75rem !important;
    }
    
    .group-item .overflow-hidden a {
        font-size: 0.85rem;
    }
    
    .group-item .overflow-hidden small {
        font-size: 0.7rem;
    }
    
    .icon-md {
        width: 32px !important;
        height: 32px !important;
        font-size: 0.8rem;
    }
    
    .icon-md i {
        font-size: 0.8rem;
    }
    
    .btn-sm {
        font-size: 0.75rem;
        padding: 0.3rem 0.6rem;
    }
}

@media (max-width: 374.98px) {
    .right-sidebar-container {
        margin-top: 0.75rem;
    }
    
    .mentorship-card {
        min-height: 100px;
    }
    
    .card-header h5 {
        font-size: 0.85rem;
    }
    
    .card-header .btn-sm {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
    }
    
    .card-body {
        padding: 0.5rem;
        font-size: 0.8rem;
    }
    
    .card-footer {
        padding: 0.5rem;
    }
    
    .card-footer .btn {
        font-size: 0.75rem;
        padding: 0.3rem 0.6rem;
    }
    
    .newsletter-cover {
        height: 35px;
    }
    
    .broadcast-scroll {
        max-height: 200px;
    }
    
    .broadcast-scroll img {
        height: 50px !important;
    }
    
    .broadcast-scroll h6 {
        font-size: 0.8rem;
    }
    
    .broadcast-scroll small {
        font-size: 0.65rem;
    }
    
    .avatar-md {
        width: 35px;
        height: 35px;
    }
    
    .avatar-md img {
        width: 35px !important;
        height: 35px !important;
    }
    
    .group-item {
        gap: 0.5rem !important;
    }
    
    .group-item .overflow-hidden a {
        font-size: 0.8rem;
    }
    
    .group-item .overflow-hidden small {
        font-size: 0.65rem;
    }
    
    .icon-md {
        width: 30px !important;
        height: 30px !important;
        font-size: 0.75rem;
    }
    
    .btn-sm {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
    }
}

/* Ensure proper spacing between cards */
.right-sidebar-container .card {
    margin-bottom: 1rem;
}

@media (max-width: 575.98px) {
    .right-sidebar-container .card {
        margin-bottom: 0.75rem;
    }
}

/* Grid adjustments for mobile */
@media (max-width: 767.98px) {
    .right-sidebar-container .row.g-4 {
        row-gap: 1rem;
    }
}

@media (max-width: 575.98px) {
    .right-sidebar-container .row.g-4 {
        row-gap: 0.75rem;
    }
}
</style>
<div class="row g-4 right-sidebar-container">
    <!-- Card follow START -->
    <!-- Card News START -->
     @if( $userId = auth()->guard('user')->user()->Service == 'IAS')
    <div class="col-sm-6 col-lg-12">
        <div class="card mentorship-card">
            <!-- Card header START -->
            <div class="card-header pb-0 border-0">
                <h5 class="card-title mb-0">Mentorship Program</h5>
            </div>
            <!-- Card header END -->
            <!-- Card body START -->
            <div class="card-body">

                <!-- News item -->
                <!-- Links -->
                <a href="{{ route('user.mentor_mentee') }}" class="text-decoration-none" style="color:#af2910;">Wants to
                    become Mentor / Mentee</a>
            </div>
            <!-- Card body END -->
        </div>
    </div>
    @endif

    <div class="col-sm-6 col-lg-12">
        <div class="card">
            <div class="rounded-top newsletter-cover"
                style="background-image:url({{asset('user_assets/images/login/login-bg.webp')}}); background-position: center; background-size: cover; background-repeat: no-repeat;">
            </div>
            <div class="card-footer text-center">
                <a class="btn btn-success-soft btn-sm" href="https://www.lbsnaa.gov.in/lbsnaa-newsletter">LBSNAA Newsletter</a>
            </div>
            <!-- Card Footer END -->
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
            <div class="card-body broadcast-scroll overflow-auto">
                <!-- News item -->
                @if((isset($broadcast)) && ($broadcast->count() > 0))
                @foreach($broadcast as $index => $broadcast)

                <div class="mb-3">

                    <div class="mb-2">
                        <a class="testing" href="{{ route('user.broadcastDetails', $broadcast->enc_id) }}">
                            @if($broadcast->image_url)
                            <img class="avatar-img rounded" src="{{ route('secure.file', ['type'=>'broadcast','path'=>$broadcast->image_url]) }}" alt=""
                                height="45" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="{{ $broadcast->title }}" style="height: 85px; object-fit: cover;" loading="lazy"
                                decoding="async">
                            @else
                            <img src="{{ asset('assets/images/no-image.png') }}" width="45" class="rounded-circle"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="No image available"
                                alt="No image" loading="lazy">
                            @endif
                        </a>

                    </div>

                    <h6 class="mb-0"><a
                            href="{{ route('user.broadcastDetails', $broadcast->enc_id) }}">{{ $broadcast->title }}</a>
                    </h6>
                    <small>{{ \Illuminate\Support\Str::limit($broadcast->description, 50) }} <span><a
                                href="{{ route('user.broadcastDetails', $broadcast->enc_id) }}" class="text-danger">View
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
    <div class="card-body group-list">
        @if(isset($groupNames) && $groupNames->count() > 0)
            @foreach($groupNames as $index => $recent)
                <div class="hstack gap-3 mb-3 align-items-center group-item">
                    <!-- Group Image -->
                    <div class="avatar avatar-md">
                        <a href="{{ route('user.group-post',($recent->enc_id)) }}">
                            <img src="{{ $recent->image ? route('secure.file', ['type'=>'group','path'=>$recent->image]) : asset('feed_assets/images/avatar/07.jpg') }}"
                                alt="Group Image" class="rounded-circle img-fluid"
                                style="width: 48px; height: 48px; object-fit: cover;">
                        </a>
                    </div>

                    <!-- Title + End Date -->
                    <div class="overflow-hidden">
                        <a class="mb-0 fw-semibold d-block text-truncate"
                            href="{{ route('user.group-post',encrypt($recent->enc_id)) }}">
                            {{ ($recent->name) }}
                        </a>
                        <small class="text-muted d-block">End Date:
                            {{ \Carbon\Carbon::parse($recent->end_date ?? now())->format('d-m-Y') }}</small>
                    </div>

                    <!-- Post Button -->
                    <a class="btn btn-primary-soft rounded-circle icon-md ms-auto open-group-post-modal"
                        href="#" data-bs-toggle="modal" data-bs-target="#groupActionpost"
                        data-group-name="{{ $recent->name }}" data-group-id="{{ $recent->id }}">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                </div>
            @endforeach

            <div class="d-grid mt-3">
                <a class="btn btn-sm btn-primary-soft" href="{{ route('user.group.index') }}">View more</a>
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




<script nonce="{{ $cspNonce }}">document.addEventListener('DOMContentLoaded', function() {
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
document.addEventListener("DOMContentLoaded", function () {
    let list = document.querySelector(".group-list");
    let firstItem = list.querySelector(".group-item");

    if (firstItem) {
        let itemHeight = firstItem.offsetHeight + parseInt(getComputedStyle(firstItem).marginBottom);
        list.style.maxHeight = (itemHeight * 5) + "px";
    }
});

</script>



<!-- Right sidebar END -->