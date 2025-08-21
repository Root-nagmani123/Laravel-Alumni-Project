@extends('admin.layouts.master')

@section('title', 'Member - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Edit Members</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Edit Members
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
    <div class="row">
        <div class="col-12">
            <!-- start Person Info -->
            <div class="card">
                <form action="{{ route('members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <h4 class="card-title">Edit Member</h4>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Name<span class="required text-danger text-danger" >*</span></label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $member->name) }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">User Name</label>
                                    <input type="text" name="username" class="form-control"
                                        value="{{ old('username', $member->username) }}">
                                    @error('username')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Mobile<span class="required text-danger text-danger" >*</span></label>
                                    <input type="number" name="mobile" class="form-control"
                                        value="{{ old('mobile', $member->mobile) }}">
                                    @error('mobile')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Email<span class="required text-danger text-danger" >*</span></label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $member->email) }}">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Password (leave blank to keep current password)</label>
                                    <input type="password" name="password" class="form-control">
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                    @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Service<span class="required text-danger">*</span></label>
                                    <select name="service" id="service" class="form-control">
                                        <option value="">Select Service</option>
                                        @foreach($members as $m)
                                            @if($m->Service != '')
                                                <option value="{{ $m->Service }}" 
                                                    {{ old('service', $member->Service) == $m->Service ? 'selected' : '' }}>
                                                    {{ $m->Service }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('service')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Sector<span class="required text-danger">*</span></label>
                                    <select name="sector" id="sector" class="form-control">
                                        <option value="">Select Sector</option>
                                        @foreach($members as $m)
                                            @if(!empty($m->sector_list))
                                                @php $sector_list = explode(',', $m->sector_list); @endphp
                                                @foreach($sector_list as $sector)
                                                    <option value="{{ trim($sector) }}" 
                                                        {{ old('sector', $member->sector) == trim($sector) ? 'selected' : '' }}>
                                                        {{ trim($sector) }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('sector')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Cadre<span class="required text-danger">*</span></label>
                                    <select name="cader" class="form-control">
                                        <option value="">Select Cadre</option>
                                        @foreach($members as $m)
                                            @if(!empty($m->cader_list))
                                                @php $cader_list = explode(',', $m->cader_list); @endphp
                                                @foreach($cader_list as $cadre)
                                                    <option value="{{ trim($cadre) }}" 
                                                        {{ old('cader', $member->cader) == trim($cadre) ? 'selected' : '' }}>
                                                        {{ trim($cadre) }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('cader')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Batch<span class="required text-danger">*</span></label>
                                    <select name="batch" id="batch" class="form-control">
                                        <option value="">Select Batch</option>
                                        @foreach($members as $m)
                                            @if(!empty($m->batches))
                                                @php $batches = explode(',', $m->batches); @endphp
                                                @foreach($batches as $batch)
                                                    <option value="{{ trim($batch) }}" 
                                                        {{ old('batch', $member->batch) == trim($batch) ? 'selected' : '' }}>
                                                        {{ trim($batch) }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('batch')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Designation<span class="required text-danger text-danger" >*</span></label>
                                    <input type="text" name="designation" class="form-control"
                                        value="{{ old('designation', $member->designation) }}">
                                    @error('designation')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Profile Photo</label>
                                    <input type="file" name="profile_pic" id="profile_pic" class="form-control" accept="image/*">
                                    @error('profile_pic')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="mt-2">
                                    <img id="preview-image" src="{{ $member->profile_pic ? asset('storage/' . $member->profile_pic) : asset('feed_assets/images/avatar/07.jpg') }}" alt="Image Preview" class="img-fluid rounded "
                                        style="max-height: 200px;" />
                                </div>
                            </div>
                        </div>
                        <hr>
                    <div class="mb-3 gap-2 float-end">
                        <button class="btn btn-primary" type="submit">
                            Update
                        </button>
                        <a href="{{ route('members.index') }}" class="btn btn-secondary">
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
@push('scripts')
    <script>
        document.getElementById('profile_pic').addEventListener('change', function(event) {
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