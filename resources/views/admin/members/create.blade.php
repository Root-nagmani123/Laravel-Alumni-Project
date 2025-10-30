@extends('admin.layouts.master')

@section('title', 'Member - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Add Members</h4>
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
                                    Member List
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
                
                <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div>
                        <div class="card-body">
                            <h4 class="card-title">Add Members</h4>
                            <small class="form-control-feedback">Please add Member detail.</small>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name<span class="required text-danger text-danger" >*</span></label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('name') }}">
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">UserName (LDAP)</label>
                                        <input type="text" name="username" id="username" class="form-control"
                                            value="{{ old('username') }}">
                                        @error('username')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Mobile<span class="required text-danger text-danger" >*</span></label>
                                        <input type="number" name="mobile" id="mobile" class="form-control"
                                            value="{{ old('mobile') }}">
                                             @error('mobile')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email<span class="required text-danger text-danger" >*</span></label>
                                        <input type="text" name="email" id="email" class="form-control"
                                            value="{{ old('email') }}">
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                               
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Service<span class="required text-danger text-danger" >*</span></label>
                                       
                                            <select name="service" id="service-mentee" class="form-control Service"
                                        data-id="mentee">
                                        @if($members->isEmpty())
                                        <option disabled>No Services Available</option>
                                        @else
                                         <option value="">Select Service</option>
                                        @foreach($members as $member)
                                        @if($member->Service != '')
                                        <option value="{{ $member->Service }}">{{ $member->Service }}</option>
                                        @endif
                                        @endforeach
                                        @endif
                                    </select>
                                              @error('service')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                 
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Cadre<span class="required text-danger text-danger" >*</span></label>
                                      
                                            <select name="cader" class="form-control " >
                                        @if($members->isEmpty())
                                        <option disabled>No Cadres Available</option>
                                        @else
                                        <option value="">Select Cadre</option>
                                        @foreach($members as $member)
                                        @if(!empty($member->cader_list))
                                        @php $cader_list = explode(',', $member->cader_list); @endphp
                                        @foreach($cader_list as $cadre)
                                        <option value="{{ trim($cadre) }}">{{ trim($cadre) }}</option>
                                        @endforeach
                                        @endif
                                        @endforeach
                                        @endif
                                    </select>
                                              @error('cader')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                              
                               <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Batch <span class="required text-danger">*</span></label>
                                        <select name="batch" id="batch" class="form-control batch">
                                            @if($members->isEmpty())
                                                <option disabled>No Batch Available</option>
                                            @else
                                                <option value="">Select Batch</option>
                                                @php
                                                    $allBatches = [];

                                                    foreach ($members as $member) {
                                                        if (!empty($member->batches)) {
                                                            $allBatches = array_merge($allBatches, explode(',', $member->batches));
                                                        }
                                                    }

                                                    $allBatches = array_map('trim', $allBatches); // trim spaces
                                                    $allBatches = array_filter($allBatches); // remove empty values
                                                    $allBatches = array_unique($allBatches); // remove duplicates

                                                    $currentYear = date('Y');
                                                    if (!in_array($currentYear, $allBatches)) {
                                                        $allBatches[] = $currentYear;
                                                    }

                                                    sort($allBatches, SORT_NUMERIC); // ascending order
                                                @endphp

                                                @foreach($allBatches as $batch)
                                                    <option value="{{ $batch }}">{{ $batch }}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        @error('batch')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                  <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Designation<span class="required text-danger text-danger" >*</span></label>
                                        <input type="text" name="designation" id="designation" class="form-control"
                                            value="{{ old('designation') }}">
                                             @error('designation')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Profile Photo <span class="required text-danger">*</span></label>
                                    <input type="file" name="profile_pic" id="profile_pic" class="form-control" accept="image/*">
                                    @error('profile_pic')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="mt-2">
                                    <img id="preview-image" src="#" alt="Image Preview" class="img-fluid rounded d-none"
                                        style="max-height: 200px;" />
                                </div>
                            </div>
                            <hr>
                            <div class="mb-3 gap-2 float-end">
                                <button class="btn btn-primary" type="submit">
                                    Save
                                </button>
                                <a href="{{ route('members.index') }}" class="btn btn-secondary">
                                    Back
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end Person Info -->
        </div>
    </div>
</div>


@endsection

<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Bulk Add Members</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" method="post"
                    action="{{-- route('members.bulk_upload_members') --}}" id="bulk-upload-form" class="uploader">
                    <div class="boxmodal footimpt">


                        <div class="form-group mt-2">
                            <label for="file-upload" class="form-label">Upload Excel/CSV File:*</label>
                            <input id="file-upload" type="file" name="file" accept=".xls,.xlsx,.csv" required text-danger />
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <button type="button" class="btn btn-secondary col-md-6" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary col-md-6">Upload</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>


@push('scripts')
    <script nonce="{{ $cspNonce }}">        document.getElementById('profile_pic').addEventListener('change', function(event) {
            const preview = document.getElementById('preview-image');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.classList.add('d-none');
            }
        });
    </script>
@endpush