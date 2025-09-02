@php
    $years = [];
    $cadres = [];
    $years = App\Models\Member::where('service', 'IAS')
        ->whereNotNull('batch')
        ->where('batch', '!=', 'NA')
        ->distinct()
        ->pluck('batch');
    $cadres = App\Models\Member::query();
    $cadres = $cadres->whereNotNull('cader')
                ->where('cader', '!=', 'NA')
                ->distinct()
                ->orderBy('cader')
                ->pluck('cader');
@endphp
{{-- <form action="{{ route('user.group.store') }}" method="POST" enctype="multipart/form-data"> --}}
    <form id="groupForm1">
        @csrf
        <input type="hidden" name="group_id" value="{{ $group->id }}">

            <!-- Header -->
            <div class="modal-header bg-danger text-white ">
                <h5 class="modal-title text-white" id="groupModalLabel">Add Members to Group : <span
                        class="text-primary">{{ $group->name }}</span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <div class="row g-3">



                    <!-- Service -->
                    <div class="col-md-6">
                        <label class="form-label">Service</label>
                        <select class="form-select service" name="service" id="service" data-id="new_group_create">
                            <option selected disabled>Select Service</option>
                            @if(isset($members) && !$members->isEmpty())
                                @foreach($members as $member)
                                    @if(!empty($member->Service))
                                        <option value="{{ $member->Service }}">{{ $member->Service }}</option>
                                    @endif
                                @endforeach
                            @else
                                <option disabled>No Services Available</option>
                            @endif
                        </select>
                    </div>

                    <!-- Year / Batch -->
                    <div class="col-md-6">
                        <label class="form-label">Year / Batch</label>
                        <select class="form-select year-select" name="year[]" multiple="multiple">
                            <!-- Options populated dynamically via AJAX -->
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Cadre -->
                    <div class="col-md-6">
                        <label class="form-label">Cadre</label>
                        <select class="form-select cadre select2" name="cadre[]" multiple="multiple"
                            data-id="new_group_create">
                            <!-- Options populated dynamically via AJAX -->
                            @foreach($cadres as $cadre)
                                <option value="{{ $cadre }}">{{ $cadre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dual List Members -->
                    <div class="col-12">
                                <label class="form-label">Select Group Members <span
                                        class="text-danger">*</span></label>
                                <div class="row">
                                    <!-- Available Members -->
                                    <div class="col-md-6">
                                        <input type="text" id="searchAll" class="form-control mb-2"
                                            placeholder="Search members...">
                                        <div id="availableMembers" class="border rounded p-2"
                                            style="min-height:220px; max-height:300px; overflow-y:auto;">
                                            <!-- Available members (checkbox list) will load dynamically -->
                                        </div>
                                    </div>
                                    <!-- Selected Members -->
                                    <div class="col-md-6">
                                        <input type="text" id="searchSelected" class="form-control mb-2"
                                            placeholder="Search selected...">
                                        <div id="selectedMembers" class="border rounded p-2"
                                            style="min-height:220px; max-height:300px; overflow-y:auto;">
                                            <!-- Selected members (checkbox list) will load dynamically -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Update Group</button>
            </div>
    </form>