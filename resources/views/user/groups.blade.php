@extends('layouts.app')

@section('title', 'Groups - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container">
    <div class="row g-4" style="margin-top: 5rem;">
       @include('partials.left_sidebar')
        <div class="col-lg-9">
            @php use Carbon\Carbon; @endphp

<div class="row g-4">
   
 @if(isset($groupNames) && $groupNames->count() > 0)
                @foreach($groupNames as $index => $recent)
        <div class="col-sm-6 col-lg-4">
    <div class="card border h-100 d-flex flex-column">
        <div class="h-100px rounded-top"
             style="height: 100px; background-image:url({{ asset('storage/uploads/images/grp_img/' . ($recent->image ?? 'default-group.png')) }}); background-position: center; background-size: cover;">
        </div>

        <div class="card-body text-center pt-0 flex-grow-1 d-flex flex-column justify-content-between">
            <div>
                <!-- <div class="avatar avatar-lg mt-n5 mb-3">
                    <a href="#"><img
                        class="avatar-img rounded-circle border border-white border-3 bg-white"
                        src="{{ asset('storage/uploads/images/grp_img/' . ($recent->image ?? 'default-group.png')) }}"
                        alt="" loading="lazy"></a>
                </div> -->

                <h5 class="mb-0 mt-3">
                    <a href="{{ route('user.group-post', $recent->enc_id) }}">{{ $recent->name }}</a>
                </h5>

                <p class="small text-muted mb-1">End Date: {{ \Carbon\Carbon::parse($recent->end_date ?? now())->format('d-m-Y') }}</p>
                <p class="small text-muted mb-1">Created By : {{ $recent->created_by }}</p>
                <div class="hstack gap-2 gap-xl-3 justify-content-center mt-3">
                              <!-- Group stat item -->
                              <div>
                                <h6 class="mb-0">{{ $recent->member_count ? $recent->member_count : 0 }}</h6>
                                <small>Members</small>
                              </div>
                              <!-- Divider -->
                              <div class="vr"></div>
                              <!-- Group stat item -->
                              <div>
                                <h6 class="mb-0">{{ $recent->total_posts ? $recent->total_posts : 0 }}</h6>
                                <small>Total Post</small>
                              </div>
                            </div>
            </div>
        </div>
@php
$isExpired = false;
    $isExpired = \Carbon\Carbon::parse($recent->end_date)->lt(\Carbon\Carbon::today());

@endphp
        <div class="card-footer text-center mt-auto">
            @if($isExpired == false)
                <span class="badge bg-success-soft text-success mb-2 d-block">Group Active</span>
                <a href="{{ route('user.group-post', $recent->enc_id) }}" class="btn btn-primary btn-sm">View Group</a>
            @else
                <span class="badge bg-danger-soft text-danger mb-2 d-block">Group Expired</span>
                @if($recent->member_type == '2' && $recent->created_by == Auth::guard('user')->user()->id)
                    <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#activateGroupModal"
                            data-group-id="{{ $recent->id }}"
                            data-group-name="{{ $recent->name }}">
                        Activate Group
                    </button>
                @endif
            @endif
        </div>
    </div>
</div>

        @endforeach
        @else
        <div class="col-12">
            <div class="alert alert-info" role="alert">
                No groups available. Please create a group to get started.
            </div>

        </div>
        @endif
    </div>
</div>
<!-- Activate Group Modal -->
<div class="modal fade" id="activateGroupModal" tabindex="-1" aria-labelledby="activateGroupModalLabel" aria-hidden="true">
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
    document.addEventListener('DOMContentLoaded', function () {
        const activateGroupModal = document.getElementById('activateGroupModal');
        activateGroupModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const groupId = button.getAttribute('data-group-id');
            const groupName = button.getAttribute('data-group-name');

            document.getElementById('modal-group-id').value = groupId;
            document.getElementById('modal-group-name').textContent = groupName;
        });
    });
</script>

@endsection