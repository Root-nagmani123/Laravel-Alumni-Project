@extends('admin.layouts.master')

@section('title', 'City - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">Add City</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Add City
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
            <div class="card">
                <form action="{{ route('admin.location.city.store') }}" method="POST">
                    @csrf
                    <div>
                        <div class="card-body">
                            <h4 class="card-title">Add City</h4>
                            <small class="form-control-feedback">Please add City detail.</small>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Country</label><span class="required text-danger">*</span>
                                        <select name="country_id" id="country_id" class="form-control">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">State</label><span class="required text-danger">*</span>
                                        <select name="state_id" id="state_id" class="form-control">
                                            <option value="">Select State</option>
                                        </select>
                                        @error('state_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label><span class="required text-danger">*</span>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="mb-3 gap-2 float-end">
                                <button class="btn btn-primary" type="submit">
                                    Save
                                </button>
                                <a href="{{ route('admin.location.city') }}" class="btn btn-secondary">
                                    Back
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function() {
    // Setup AJAX to always send CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    $('#country_id').on('change', function() {
        var countryId = $(this).val();
        var stateSelect = $('#state_id');
        
        stateSelect.empty();
        stateSelect.append('<option value="">Select State</option>');
        
        if(countryId) {
            console.log('Fetching states for country:', countryId);
            $.ajax({
                url: "{{ route('admin.location.city.get-states') }}",
                type: 'POST',
                data: {
                    country_id: countryId
                },
                success: function(data) {
                    console.log('Received states data:', data);
                    if(data && data.length > 0) {
                        $.each(data, function(key, value) {
                            stateSelect.append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    } else {
                        console.log('No states found for country:', countryId);
                        stateSelect.append('<option value="">No states found</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error details:', {
                        status: status,
                        error: error,
                        response: xhr.responseText
                    });
                    stateSelect.append('<option value="">Error loading states</option>');
                }
            });
        }
    });

    // If there's an old country_id value, trigger the change event to load states
    var oldCountryId = "{{ old('country_id') }}";
    if(oldCountryId) {
        $('#country_id').trigger('change');
    }
});
</script>

@endsection
