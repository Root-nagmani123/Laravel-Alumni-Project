@extends('layouts.app')

@section('title', 'Groups - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container">
    <div class="row g-4" style="margin-top: 5rem;">
        @include('partials.left_sidebar')
        <div class="col-lg-9">
            @php use Carbon\Carbon; @endphp

            <ul class="nav nav-tabs mb-3" id="groupTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active-groups"
                        type="button" role="tab" aria-controls="active-groups" aria-selected="true">
                        Active Groups
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="inactive-tab" data-bs-toggle="tab" data-bs-target="#inactive-groups"
                        type="button" role="tab" aria-controls="inactive-groups" aria-selected="false">
                        Inactive Groups
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="groupTabsContent">
                <!-- Active Groups -->
                <div class="tab-pane fade show active" id="active-groups" role="tabpanel" aria-labelledby="active-tab">
                    <div class="row g-4">
                        @php $activeGroups = $groupNames->filter(fn($g) =>
                        \Carbon\Carbon::parse($g->end_date)->gte(\Carbon\Carbon::today())); @endphp

                        @if($activeGroups->count())
                        @foreach($activeGroups as $recent)
                        <div class="col-sm-6 col-lg-4">
                            <div class="card border h-100 d-flex flex-column">
                                <div class="h-100px rounded-top"
                                    style="height: 100px; background-image:url({{ asset('storage/uploads/images/grp_img/' . ($recent->image ?? 'default-group.png')) }}); background-position: center; background-size: cover;">
                                </div>

                                <div
                                    class="card-body text-center pt-0 flex-grow-1 d-flex flex-column justify-content-between">
                                    <h5 class="mb-0 mt-3">
                                        <a
                                            href="{{ route('user.group-post', encrypt($recent->enc_id)) }}">{{ $recent->name }}</a>
                                    </h5>
                                    <p class="small text-muted mb-1">End Date:
                                        {{ \Carbon\Carbon::parse($recent->end_date)->format('d-m-Y') }}</p>
                                    <p class="small text-muted mb-1">Created By : {{ $recent->created_by }}</p>
                                    <div class="hstack gap-2 gap-xl-3 justify-content-center mt-3">
                                        <div>
                                            <h6 class="mb-0">{{ $recent->member_count ?? 0 }}</h6>
                                            <small>Members</small>
                                        </div>
                                        <div class="vr"></div>
                                        <div>
                                            <h6 class="mb-0">{{ $recent->total_posts ?? 0 }}</h6>
                                            <small>Total Post</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-center mt-auto">
                                    <span class="badge bg-success-soft text-success mb-2 d-block">Group Active</span>
                                    <a href="{{ route('user.group-post',encrypt($recent->enc_id)) }}"
                                        class="btn btn-primary btn-sm">View Group</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="col-12">
                            <div class="alert alert-info">No active groups available.</div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Inactive Groups -->
                <div class="tab-pane fade" id="inactive-groups" role="tabpanel" aria-labelledby="inactive-tab">
                    <div class="row g-4">
                        @php $inactiveGroups = $groupNames->filter(fn($g) =>
                        \Carbon\Carbon::parse($g->end_date)->lt(\Carbon\Carbon::today())); @endphp

                        @if($inactiveGroups->count())
                        @foreach($inactiveGroups as $recent)
                        <div class="col-sm-6 col-lg-4">
                            <div class="card border h-100 d-flex flex-column">
                                <div class="h-100px rounded-top"
                                    style="height: 100px; background-image:url({{ asset('storage/uploads/images/grp_img/' . ($recent->image ?? 'default-group.png')) }}); background-position: center; background-size: cover;">
                                </div>

                                <div
                                    class="card-body text-center pt-0 flex-grow-1 d-flex flex-column justify-content-between">
                                    <h5 class="mb-0 mt-3">
                                        <a
                                            href="{{ route('user.group-post',encrypt($recent->enc_id)) }}">{{ $recent->name }}</a>
                                    </h5>
                                    <p class="small text-muted mb-1">End Date:
                                        {{ \Carbon\Carbon::parse($recent->end_date)->format('d-m-Y') }}</p>
                                    <p class="small text-muted mb-1">Created By : {{ $recent->created_by }}</p>
                                    <div class="hstack gap-2 gap-xl-3 justify-content-center mt-3">
                                        <div>
                                            <h6 class="mb-0">{{ $recent->member_count ?? 0 }}</h6>
                                            <small>Members</small>
                                        </div>
                                        <div class="vr"></div>
                                        <div>
                                            <h6 class="mb-0">{{ $recent->total_posts ?? 0 }}</h6>
                                            <small>Total Post</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-center mt-auto">
                                    <span class="badge bg-danger-soft text-danger mb-2 d-block">Group Expired</span>
                                    @if($recent->member_type == '2' && $recent->created_by ==
                                    Auth::guard('user')->user()->id)
                                    <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#activateGroupModal" data-group-id="{{ $recent->id }}"
                                        data-group-name="{{ $recent->name }}">
                                        Activate Group
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="col-12">
                            <div class="alert alert-info">No inactive groups available.</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <!-- Activate Group Modal -->
        <div class="modal fade" id="activateGroupModal" tabindex="-1" aria-labelledby="activateGroupModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('user.group.activate-group') }}">
                    @csrf
                    <input type="hidden" name="group_id" id="modal-group-id">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Activate Group</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>You are about to activate the group: <strong id="modal-group-name"></strong></p>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">Select New Expiry Date</label>
                                <input type="date" name="end_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Activate</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const activateGroupModal = document.getElementById('activateGroupModal');
            activateGroupModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const groupId = button.getAttribute('data-group-id');
                const groupName = button.getAttribute('data-group-name');

                document.getElementById('modal-group-id').value = groupId;
                document.getElementById('modal-group-name').textContent = groupName;
            });
        });
        </script>

        @endsection