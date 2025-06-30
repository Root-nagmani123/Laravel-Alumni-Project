@extends('admin.layouts.master')

@section('title', 'Social Wall - Alumni | Lal Bahadur')

@section('content')

<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Edit Social Wall</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="index.html">
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
    <!-- start Vertical Steps Example -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Edit Social Wall</h4>
            <hr>
            <form action="{{ isset($post) ? route('socialwall.update', $post->id) : route('socialwall.index') }}" method="POST">

			<!--<form action="{{ route('socialwall.update', $post->id) }}" method="POST">-->
			

    @csrf
    @if(isset($post))
        @method('PUT')
    @endif
<input type="hidden" name="member_id" value="{{ $post->member->id ?? '' }}">
    <div class="row">
			   <div class="col-md-6">
			<div class="mb-3">
				<label class="form-label" for="memberName">Member Name:</label>
				<input type="text" class="form-control" id="memberName"
					   value="{{ $post->member->name ?? 'N/A' }}" >
			</div>
		</div>

		<!-- Member Email (readonly or hidden) -->
		<div class="col-md-6">
			<div class="mb-3">
				<label class="form-label" for="memberEmail">Member Email:</label>
				<input type="text" class="form-control" id="memberEmail"
					   value="{{ $post->member->email ?? 'N/A' }}">
			</div>
		</div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label" for="content">Content :</label>
                <input type="text" name="content" class="form-control" id="content"
                       value="{{ old('content', $post->content ?? '') }}">
            </div>
        </div>
    </div>

    <div class="mb-3 gap-3">
        <button class="btn btn-primary hstack gap-6 float-end" type="submit">
            <i class="material-icons menu-icon">send</i>
            {{ isset($post) ? 'Update' : 'Save' }}
        </button>
        <!--<a href="{{ route('socialwall.index') }}" class="btn btn-secondary hstack gap-6">
            <i class="material-icons menu-icon">arrow_back</i>
            Back
        </a>-->
		 <a href="{{ route('socialwall.index') }}" class="btn btn-secondary" style="float:right;margin-right:5px;">Back</a>
    </div>
</form> </div>
    </div>
    <!-- end Vertical Steps Example -->
</div>


@endsection