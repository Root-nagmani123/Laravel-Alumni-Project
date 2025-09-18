@extends('layouts.app')

@section('title', 'User — Feed Moderation - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container">
    <div class="row g-4" style="margin-top:4rem;">

        <!-- Sidenav START -->
        @include('partials.left_sidebar')
        <!-- Sidenav END -->

        <!-- Main content START -->
        <div class="col-md-9 col-lg-7 vstack gap-4">

            <!-- Posts Card -->
            <div class="card">
                <div class="card-header border d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold">User Submitted Posts</h5>
                    <span class="badge bg-primary rounded-pill">2 Pending</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 text-nowrap table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Post</th>
                                    <th>Submitted By</th>
                                    <th>Submitted On</th>

                                    <th>Status</th>
                                    <th class="text-center" style="width:240px">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="user-posts-tbody">

                                <!-- Example user-owned row -->
                                <tr data-id="201">
                                    <td>
                                        <div class="fw-semibold">Upcoming Alumni Meetup</div>
                                        <small class="text-muted">Details of venue and date inside.</small>
                                    </td>
                                   <td class="text-nowrap">
                                        <div>John Smith</div>
                                        <small class="text-muted">Joint Director</small>
                                    </td>
                                    <td class="text-nowrap">14 Sep 2025, 11:00 AM</td>
                                    <td>
                                        <span class="badge rounded-pill bg-warning-subtle text-warning">Pending</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-success btn-user-approve">
                                                <i class="bi bi-check-circle me-1"></i> 
                                            </button>
                                            <button class="btn btn-sm btn-danger btn-user-decline">
                                                <i class="bi bi-x-circle me-1"></i> 
                                            </button>
                                            <button class="btn btn-sm btn-outline-primary btn-view">
                                                <i class="bi bi-eye me-1"></i> 
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr data-id="202">
                                    <td>
                                        <div class="fw-semibold">Photo gallery request</div>
                                        <small class="text-muted">I’d like to share images from last year’s
                                            trek.</small>
                                    </td>
                                    <td class="text-nowrap">
                                        <div>John Doe</div>
                                        <small class="text-muted">Director</small>
                                    </td>
                                    <td class="text-nowrap">15 Sep 2025, 9:25 AM</td>
                                    <td>
                                        <span class="badge rounded-pill bg-warning-subtle text-warning">Pending</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-success btn-user-approve">
                                                <i class="bi bi-check-circle me-1"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger btn-user-decline">
                                                <i class="bi bi-x-circle me-1"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-primary btn-view">
                                                <i class="bi bi-eye me-1"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Confirm Modal -->
            <div class="modal fade" id="userConfirmModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-sm">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title" id="userConfirmTitle">Confirm Action</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="userConfirmBody">Are you sure you want to proceed?</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Cancel</button>
                            <button id="userConfirmYes" type="button" class="btn btn-primary">
                                <i class="bi bi-check2-circle me-1"></i> Yes, Confirm
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View Post Modal -->
            <div class="modal fade" id="viewPostModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content border-0 shadow-sm">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title">Post Preview</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="viewPostBody">
                            <!-- Post content injected dynamically -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Toast Container -->
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080">
                <div id="userToast" class="toast align-items-center border-0 shadow-sm" role="status" aria-live="polite"
                    aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body" id="userToastBody">
                            ✅ Action performed successfully
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            </div>

        </div>



    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function() {
    const tbody = document.getElementById('user-posts-tbody');
    const confirmModalEl = document.getElementById('userConfirmModal');
    const confirmModal = new bootstrap.Modal(confirmModalEl);
    const confirmTitle = document.getElementById('userConfirmTitle');
    const confirmBody = document.getElementById('userConfirmBody');
    const confirmYes = document.getElementById('userConfirmYes');
    const toastEl = document.getElementById('userToast');
    const toast = new bootstrap.Toast(toastEl);
    const viewPostModal = new bootstrap.Modal(document.getElementById('viewPostModal'));
    const viewPostBody = document.getElementById('viewPostBody');

    let pendingAction = null;

    function setRowStatus(tr, status) {
        const badge = tr.querySelector('td:nth-child(3) > span.badge');
        badge.className = 'badge';
        if (status === 'approved') badge.classList.add('bg-success');
        else if (status === 'declined') badge.classList.add('bg-danger');
        else badge.classList.add('bg-secondary');
        badge.textContent = status.charAt(0).toUpperCase() + status.slice(1);
        tr.querySelectorAll('.btn-user-approve, .btn-user-decline').forEach(b => b.disabled = true);
    }

    tbody.addEventListener('click', (e) => {
        const approveBtn = e.target.closest('.btn-user-approve');
        const declineBtn = e.target.closest('.btn-user-decline');
        const viewBtn = e.target.closest('.btn-view');
        const tr = e.target.closest('tr');
        if (!tr) return;

        if (approveBtn || declineBtn) {
            const id = tr.dataset.id;
            const type = approveBtn ? 'approve' : 'decline';
            pendingAction = {
                type,
                row: tr
            };
            confirmTitle.textContent = type === 'approve' ? 'Approve post' : 'Decline post';
            confirmBody.textContent = `Are you sure you want to ${type} your post #${id}?`;
            confirmYes.textContent = type === 'approve' ? 'Approve' : 'Decline';
            confirmYes.className = type === 'approve' ? 'btn btn-success' : 'btn btn-danger';
            confirmModal.show();
        }

        if (viewBtn) {
            const postContent = tr.querySelector('td > div.text-muted')?.textContent ||
                'No content available';
            const postTitle = tr.querySelector('td > div.fw-semibold')?.textContent || '';
            viewPostBody.innerHTML = `<h5>${postTitle}</h5><p>${postContent}</p>`;
            viewPostModal.show();
        }
    });

    confirmYes.addEventListener('click', () => {
        confirmModal.hide();
        if (!pendingAction) return;
        setRowStatus(pendingAction.row, pendingAction.type === 'approve' ? 'approved' : 'declined');
        showToast(`Post ${pendingAction.type}d`);
        pendingAction = null;
    });

    function showToast(msg) {
        document.getElementById('userToastBody').textContent = msg;
        toast.show();
    }

})();
</script>
@endsection