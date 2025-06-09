@extends('admin.layouts.master')

@section('title', 'Member - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Add Member(s)</h4>
                    <!--<buttton style="float:right;" class="btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal1"><i class="bi bi-info"></i>Bulk Add</buttton>-->

                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Forum
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
    <div class="row">
        <div class="col-12">
            <!-- start Person Info -->
            <div class="card">
                <form method="POST" action="{{ route('save_members') }}" enctype="multipart/form-data"
                    id="AddMemberForm">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">Add Members</h4>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Forum Name</label>
                                    <input type="text" name="forum_name" class="form-control" value="{{ $forumName }}"
                                        readonly>
                                    <input type="hidden" name="forum_id" value="{{ $forumId }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Member Name (Multiple Members)*</label>
                                    <select name="user_id[]" class="form-select" multiple>
                                        @foreach($userData as $user)
                                        <option value="{{ $user->id }}"
                                            {{ in_array($user->id, $assignedUsers) ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3 gap-2 float-end">
                            <button class="btn btn-primary" type="submit">
                                Save
                            </button>
                            <a href="{{ route('forums.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end Person Info -->
        </div>
    </div>
</div>


@endsection
