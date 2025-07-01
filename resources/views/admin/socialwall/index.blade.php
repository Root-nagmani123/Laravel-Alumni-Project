@extends('admin.layouts.master')

@section('title', 'Social Wall - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Social Wall</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Social Wall
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
    <div class="datatables">
        <!-- start Zero Configuration -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Social Wall list</h4>
                        </div>
                        <div class="col-6">
                            <!--<div class="float-end gap-2">
                                <a href="{{-- route('socialwall.create') --}}" class="btn btn-primary">+ Add Members</a>
                            </div>-->

                        </div>
                    </div>
                   @php use Illuminate\Support\Str; @endphp

<div class="col-md-8 col-xl-6 middle-wrapper offset-md-3">
    @foreach($groupedPosts as $post)
    <div class="row"> 
        <div class="col-md-12 grid-margin">
            <div class="card rounded" id="feed-{{ $post['post_id'] }}">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="col-md-6 me-1">
                        @php
                            $profilePic = !empty($first->member_profile_pic) && file_exists(public_path('uploads/member/' . $first->member_profile_pic))
                                ? asset('uploads/member/' . $first->member_profile_pic)
                                : asset('feed_assets/images/avatar-7.png');
                        @endphp

                        <img class="img-xs img-fluid rounded-circle" src="{{ $profilePic }}" alt="Profile Picture">
        
                        </div> 
                            <div class="col-md-12">
                                <div class="ms-2">
                                    <p class="mb-0">By. {{ $post['member_name'] }}</p>
                                    <p class="tx-11 text-muted">{{ \Carbon\Carbon::parse($post['created_at'])->format('d-M-Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="delete-icon">
                            <a href="#" data-feed-id="{{ $post['post_id'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete this Feed" onclick="delete_feed_model({{ $post['post_id'] }})">
                               delete
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                        </div>
                    </div>
                </div> 

                <div class="card-body">
                    @if(!empty($post['content']))
                        <p class="mb-3 tx-14">{{ $post['content'] }}</p>
                    @endif

                    @if($post['media']->isNotEmpty())
                        <div class="row">
                            @foreach($post['media'] as $media)
                                <div class="col-md-4 mb-3">
                                    @if(Str::startsWith($media['file_type'], 'image'))
                                        <img src="{{ asset('storage/' . $media['file_path']) }}" class="img-fluid rounded" />
                                    @else
                                        <a href="{{ asset('storage/' . $media['file_path']) }}" target="_blank">View File</a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="card-footer"> 
                    <div class="d-flex post-actions">
                        <a href="#" id="Commentbox" class="d-flex align-items-center text-muted mr-4">
                            <i class="bi bi-arrow-right"></i>
                            <p class="d-none d-md-block ms-2 mb-1">Read more...</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

            </div>
        </div>
        <!-- end Zero Configuration -->
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
//Toastr message
    $(document).ready(function() {
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

    });

    $(document).ready(function () {
        // AJAX: Toggle member status
        $('.status-toggle').change(function () {
            let status = $(this).prop('checked') ? 1 : 0;
            let userId = $(this).data('id');

            $.ajax({
                url: '{{-- route("socialwall.toggleStatus") --}}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: userId,
                    status: status
                },
                success: function (response) {

                    toastr.success(response.message);
                },
                error: function () {
                    toastr.error('Failed to update status.');
                }
            });
        });
    });
    </script>


@endsection
