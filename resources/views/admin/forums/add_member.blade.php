@extends('admin.layouts.master')

@section('title', 'Member - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Add Member(s)</h4> <!--<buttton style="float:right;" class="btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal1"><i class="bi bi-info"></i>Bulk Add</buttton>-->

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

    <div class="row">
        <div class="col-12">
            <!-- start Person Info -->
            <div class="card">
                <form method="POST" action="{{ route('forums.save_members') }}" enctype="multipart/form-data" id="AddMemberForm">
                            @csrf

                            <div class="row mb-3">
                                <label for="forum_name" class="col-sm-2 col-form-label">Forum Name</label>
                                <div class="col-sm-10 pt-2">
                                    <strong><b>{{ $forumName }}</b></strong>
                                    <input type="hidden" name="forum_id" value="{{ $forumId }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="user_id" class="col-sm-2 col-form-label">Member Name<span class="required">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-control js-example-basic-multiple" name="user_id[]" multiple="multiple" >
                                             @foreach ($userData as $user)
                                                <option value="{{ $user->id }}" {{ in_array($user->id, $assignedUsers) ? 'selected' : '' }}>
                                                 {{ $user->name }}
                                                </option>
                                             @endforeach
                                        </select>
                                        @error('user_id')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
            </div>
            <!-- end Person Info -->
        </div>
    </div>
</div>


@endsection

