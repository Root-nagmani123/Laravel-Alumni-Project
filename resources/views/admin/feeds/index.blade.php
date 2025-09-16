@extends('admin.layouts.master')

@section('title', 'Feeds - Alumni | Lal Bahadur')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">User Feeds</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    User Feeds
                                </span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger" style="color:white;">
        {{ session('error') }}
    </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h3 class="m-0">User Feed — Moderation</h3>
                <div>
                    <div class="btn-group me-2 me-md-3 d-flex gap-2">
                        <button id="bulk-approve" class="btn btn-success btn-sm">Approve selected</button>
                        <button id="bulk-decline" class="btn btn-danger btn-sm">Decline selected</button>
                    </div>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-nowrap table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width:40px;"><input id="select-all" type="checkbox" aria-label="Select all"></th>
                            <th>Post</th>
                            <th>Author</th>
                            <th>Posted</th>
                            <th style="width:140px">Status</th>
                            <th style="width:220px">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="posts-tbody">
                        <!-- Example row template (server should render rows server-side in production) -->
                        <tr data-id="101">
                            <td><input class="row-select" type="checkbox" value="101"></td>
                            <td>
                                <div class="fw-semibold">New training batch announced</div>
                                <div class="text-muted small">We will start registration on Oct 1st — details inside.
                                </div>
                            </td>
                            <td>R. Sharma</td>
                            <td class="text-nowrap">2025-09-12 09:15</td>
                            <td>
                                <span class="badge bg-secondary">Pending</span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-outline-success btn-approve">Approve</button>
                                    <button class="btn btn-sm btn-outline-danger btn-decline">Decline</button>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                            data-bs-toggle="dropdown">More</button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item btn-view" href="#">View Post</a></li>
                                            <li><a class="dropdown-item btn-edit" href="#">Edit</a></li>
                                            <li><a class="dropdown-item btn-ban-author" href="#">Ban author</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr data-id="102">
                            <td><input class="row-select" type="checkbox" value="102"></td>
                            <td>
                                <div class="fw-semibold">Suggestion: canteen timings</div>
                                <div class="text-muted small">Please consider extending the evening hours.</div>
                            </td>
                            <td>S. Kaur</td>
                            <td class="text-nowrap">2025-09-13 14:40</td>
                            <td>
                                <span class="badge bg-secondary">Pending</span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-outline-success btn-approve">Approve</button>
                                    <button class="btn btn-sm btn-outline-danger btn-decline">Decline</button>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                            data-bs-toggle="dropdown">More</button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item btn-view" href="#">View Post</a></li>
                                            <li><a class="dropdown-item btn-edit" href="#">Edit</a></li>
                                            <li><a class="dropdown-item btn-ban-author" href="#">Ban author</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Confirm Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmTitle">Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="confirmBody">Are you sure?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="confirmYes" type="button" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080">
        <div id="liveToast" class="toast" role="status" aria-live="polite" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Moderator</strong>
                <small class="text-muted">now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastBody">Action performed</div>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Minimal JS to handle approve/decline actions and bulk operations.
(function() {
    const tbody = document.getElementById('posts-tbody');
    const confirmModalEl = document.getElementById('confirmModal');
    const confirmModal = new bootstrap.Modal(confirmModalEl);
    const confirmTitle = document.getElementById('confirmTitle');
    const confirmBody = document.getElementById('confirmBody');
    const confirmYes = document.getElementById('confirmYes');
    const toastEl = document.getElementById('liveToast');
    const toast = new bootstrap.Toast(toastEl);

    let pendingAction = null; // {type:'approve'|'decline', rows: [trElements]}

    // helper to update row status UI
    function setRowStatus(tr, status) {
        const badge = tr.querySelector('td:nth-child(5) > span.badge');
        badge.className = 'badge';
        if (status === 'approved') badge.classList.add('bg-success');
        else if (status === 'declined') badge.classList.add('bg-danger');
        else badge.classList.add('bg-secondary');
        badge.textContent = status.charAt(0).toUpperCase() + status.slice(1);

        // disable buttons once final
        if (status === 'approved' || status === 'declined') {
            tr.querySelectorAll('.btn-approve, .btn-decline').forEach(b => b.disabled = true);
        }
    }

    // single row actions
    tbody.addEventListener('click', (e) => {
        const approveBtn = e.target.closest('.btn-approve');
        const declineBtn = e.target.closest('.btn-decline');
        if (!approveBtn && !declineBtn) return;
        const tr = e.target.closest('tr');
        const id = tr.dataset.id;
        const type = approveBtn ? 'approve' : 'decline';

        pendingAction = {
            type,
            rows: [tr]
        };
        confirmTitle.textContent = (type === 'approve' ? 'Approve post' : 'Decline post');
        confirmBody.textContent = `Are you sure you want to ${type} post #${id}?`;
        confirmYes.textContent = type === 'approve' ? 'Approve' : 'Decline';
        confirmYes.className = type === 'approve' ? 'btn btn-success' : 'btn btn-danger';
        confirmModal.show();
    });

    // bulk actions
    document.getElementById('bulk-approve').addEventListener('click', () => handleBulk('approve'));
    document.getElementById('bulk-decline').addEventListener('click', () => handleBulk('decline'));

    function handleBulk(type) {
        const checked = Array.from(document.querySelectorAll('.row-select:checked')).map(cb => cb.closest('tr'));
        if (checked.length === 0) {
            showToast('No posts selected');
            return;
        }
        pendingAction = {
            type,
            rows: checked
        };
        confirmTitle.textContent = `${type === 'approve' ? 'Approve' : 'Decline'} ${checked.length} post(s)`;
        confirmBody.textContent = `Are you sure you want to ${type} ${checked.length} selected post(s)?`;
        confirmYes.textContent = type === 'approve' ? 'Approve all' : 'Decline all';
        confirmYes.className = type === 'approve' ? 'btn btn-success' : 'btn btn-danger';
        confirmModal.show();
    }

    // confirm yes clicked
    confirmYes.addEventListener('click', async () => {
        confirmModal.hide();
        if (!pendingAction) return;
        // In production: send fetch/ajax request to backend to persist moderation decision.
        // Here we simulate success and update UI.
        for (const tr of pendingAction.rows) {
            setRowStatus(tr, pendingAction.type === 'approve' ? 'approved' : 'declined');
            // uncheck if selected
            const cb = tr.querySelector('.row-select');
            if (cb) cb.checked = false;
        }
        showToast(`${pendingAction.rows.length} post(s) ${pendingAction.type}d`);
        pendingAction = null;
    });

    // select-all
    document.getElementById('select-all').addEventListener('change', function() {
        document.querySelectorAll('.row-select').forEach(cb => cb.checked = this.checked);
    });

    function showToast(msg) {
        document.getElementById('toastBody').textContent = msg;
        toast.show();
    }

})();
</script>


</div>
@endsection