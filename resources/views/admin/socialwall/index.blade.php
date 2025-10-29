@extends('admin.layouts.master')

@section('title', 'Social Wall - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3 bg-light border-0 shadow-sm mb-4">
    <div class="row align-items-center">
        <div class="col-12">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-4 mb-sm-0 fw-semibold text-primary">📢 Social Wall</h4>
                <nav aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">
                                <i class="bi bi-house-door-fill me-1"></i> Home
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <span class="badge bg-primary-subtle text-primary fw-medium">Social Wall</span>
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
    @php use Illuminate\Support\Str; @endphp
        <div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('socialwall.index') }}" id="filterForm">
            <div class="row g-2">
                <div class="col-md-3">
                    <select name="year" class="form-select" onchange="this.form.submit()">
                        <option value="">All Years</option>
                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="month" class="form-select" onchange="this.form.submit()">
                        <option value="">All Months</option>
                        @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="day" class="form-select" onchange="this.form.submit()">
                        <option value="">All Days</option>
                        @foreach($days as $day)
                            <option value="{{ $day }}" {{ request('day') == $day ? 'selected' : '' }}>
                                {{ $day }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <button type="button" class="btn btn-outline-secondary w-100" id="clearFilterBtn">
                        <i class="bi bi-x-circle me-1"></i> Clear Filters
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


   @if($groupedPosts->isEmpty())
    <div class="alert alert-warning text-center my-4 rounded-3 shadow-sm">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        No posts found against the applied filter
    </div>
@else
    <!-- Tabs -->
    <ul class="nav nav-pills justify-content-center gap-3 mb-4" id="postsTab" role="tablist">
    <li class="nav-item">
        <button class="nav-link active d-flex align-items-center px-4 py-2 rounded-pill shadow-sm fw-medium"
            id="active-tab" data-bs-toggle="tab" data-bs-target="#active-posts" type="button">
            <i class="bi bi-check-circle-fill text-success me-2"></i> Active Posts
            <span class="badge bg-success-subtle text-success ms-2">
                {{ $groupedPosts->where('status', 1)->count() }}
            </span>
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link d-flex align-items-center px-4 py-2 rounded-pill shadow-sm fw-medium"
            id="inactive-tab" data-bs-toggle="tab" data-bs-target="#inactive-posts" type="button">
            <i class="bi bi-x-circle-fill text-danger me-2"></i> Inactive Posts
            <span class="badge bg-danger-subtle text-danger ms-2">
                {{ $groupedPosts->where('status', 0)->count() }}
            </span>
        </button>
    </li>
</ul>


    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Active Posts -->
        <div class="tab-pane fade show active" id="active-posts">
            @php $activePosts = $groupedPosts->filter(fn($p) => $p['status'] == 1); @endphp
            @forelse($activePosts as $post)
                @include('partials.post-card', ['post' => $post])
            @empty
                <div class="alert alert-info text-center rounded-3 shadow-sm my-4">
                    <i class="bi bi-info-circle-fill me-2"></i>No active posts available
                </div>
            @endforelse
        </div>

        <!-- Inactive Posts -->
        <div class="tab-pane fade" id="inactive-posts">
            @php $inactivePosts = $groupedPosts->filter(fn($p) => $p['status'] == 0); @endphp
            @forelse($inactivePosts as $post)
                @include('partials.post-card', ['post' => $post])
            @empty
                <div class="alert alert-info text-center rounded-3 shadow-sm my-4">
                    <i class="bi bi-info-circle-fill me-2"></i>No inactive posts available
                </div>
            @endforelse
        </div>
    </div>
@endif





    @endsection
    @section('scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script nonce="{{ $cspNonce }}">$(document).ready(function() {
    @if(session('success'))
    toastr.success("{{ session('success') }}");
    @endif

    // Clear filter button
    $('#clearFilterBtn').on('click', function() {
        window.location.href = "{{ route('socialwall.index') }}";
    });

    // Post status toggle
    $(document).on('change', '.feed-status-toggle', function() {
        let checkbox = $(this);
        let postId = checkbox.data('id');
        let status = checkbox.prop('checked') ? 1 : 0;
        let confirmChange = confirm("Are you sure you want to " + (status ? "activate" : "deactivate") + " this post?");
        if (!confirmChange) {
            checkbox.prop('checked', !status);
            return;
        }
        $.ajax({
            url: '/admin/socialwall/toggle-status',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: postId,
                status: status
            },
            success: function(response) {
                toastr.success(response.message);
            },
            error: function() {
                toastr.error('Failed to update status.');
                checkbox.prop('checked', !status);
            }
        });
    });

    // Comment status toggle
    $(document).on('change', '.comment-status-toggle', function() {
        let checkbox = $(this);
        let commentId = checkbox.data('id');
        let status = checkbox.prop('checked') ? 1 : 0;
        let confirmChange = confirm("Are you sure you want to " + (status ? "activate" : "deactivate") + " this comment?");
        if (!confirmChange) {
            checkbox.prop('checked', !status);
            return;
        }
        $.ajax({
            url: '/admin/socialwall/toggle-comment-status',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: commentId,
                status: status
            },
            success: function(response) {
                toastr.success(response.message);
            },
            error: function() {
                toastr.error('Failed to update comment status.');
                checkbox.prop('checked', !status);
            }
        });
    });
});
</script>

<script nonce="{{ $cspNonce }}">document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.read-toggle').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const postId = this.getAttribute('data-post-id');
            const shortContent = document.getElementById('short-' + postId);
            const fullContent = document.getElementById('full-' + postId);

            if (fullContent.classList.contains('d-none')) {
                shortContent.classList.add('d-none');
                fullContent.classList.remove('d-none');
                this.textContent = 'Read less';
            } else {
                shortContent.classList.remove('d-none');
                fullContent.classList.add('d-none');
                this.textContent = 'Read more';
            }
        });
    });
});
</script>
@endsection