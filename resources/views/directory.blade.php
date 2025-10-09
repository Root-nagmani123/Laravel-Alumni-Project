@extends('layouts.app')

@section('title', 'Directory - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<div class="container">
        <div class="pagetitle" style="margin-top:5rem !important;">
            <div class="row">
                <div class="col-6">
                    <h5>{{ $pageName ?? 'Members List' }}</h5>
                </div>
                <div class="col-6">
                    <nav aria-label="breadcrumb" class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('user.feed') }}">Home</a></li>
                            <li class="breadcrumb-item">{{ $pageName ?? 'Members' }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section" style="padding-top: 0 !important; padding-bottom: 0 !important;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4 rounded">
                        <div class="card-body">

                            <!-- Filters -->
                            <div class="row mb-3">
                                <div class="col-3">
                                    <label for="serviceFilter" class="form-label">Filter by Service:</label>
                                    <select id="serviceFilter" class="form-select">
                                        <option value="">All</option>
                                        @php
                                        $services = $members->pluck('Service')->unique()->filter()->sort();
                                        @endphp
                                        @foreach ($services as $Service)
                                        <option value="{{ $Service }}">{{ $Service }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label for="batchFilter" class="form-label">Filter by Batch:</label>
                                    <select id="batchFilter" name="batch" class="form-select">
                                        <option value="">All</option>
                                        @php
                                        $batches = $members->pluck('batch')
                                        ->filter(function($value) {
                                        return !is_null($value) && $value !== '' && $value != 0;
                                        })
                                        ->unique()
                                        ->sort(); // Sort numerically (ascending)
                                        @endphp
                                        @foreach ($batches as $batch)
                                        <option value="{{ $batch }}">{{ $batch }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-3">
                                    <label for="cadreFilter" class="form-label">Filter by Cadre:</label>
                                    <select id="cadreFilter" class="form-select">
                                        <option value="">All</option>
                                        @php
                                        $cadres = $members->pluck('cader')
                                        ->filter(fn($value) => !is_null($value) && trim($value) !== '')
                                        ->unique()
                                        ->sort();
                                        @endphp
                                        @foreach ($cadres as $cadre)
                                        <option value="{{ $cadre }}">{{ $cadre }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-3">
                                    <label for="sectorFilter" class="form-label">Filter by Sector:</label>
                                    <select id="sectorFilter" name="sector" class="form-select">
                                        <option value="">All</option>
                                        @php
                                            use Illuminate\Support\Str;

                                            $sectors = $members->pluck('sector')
                                                ->map(function($value) {
                                                    return Str::of($value)->trim(); // trim spaces
                                                })
                                                ->filter(function($value) {
                                                    return !is_null($value) 
                                                        && $value !== '' 
                                                        && strtoupper($value) !== 'NA' 
                                                        && $value != '0';
                                                })
                                                ->unique()
                                                ->sort(); // Sort alphabetically
                                            @endphp

                                        @foreach ($sectors as $sector)
                                        @if (Str::of($sector)->isNotEmpty() && Str::of($sector)->upper() !== 'NA' && $sector != '0')
                                        <option value="{{ $sector }}">{{ $sector }}</option>
                                        @endif
                                        @endforeach
                                    </select>

                                </div>                                
                            </div>

                            <!-- Member Table -->
                            <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                                <table id="memberTable" class="table table-striped dt-bootstrap5 dt-responsive nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email Id</th>
                                            <th>Service</th>
                                            <th>Batch</th>
                                            <th>Cadre</th>
                                            <th>Sector</th>
                                        </tr>
                                    </thead>
                                    <tbody style="max-height: 600px; overflow-y: auto;">
                                        @foreach($members as $index => $row)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->Service }}</td>
                                            <td>{{ $row->batch }}</td>
                                            <td>{{ $row->cader }}</td>
                                            <td>{{ $row->sector }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
<!-- jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Bootstrap Bundle (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous">
</script>

<!-- Filter Logic -->
<script>
$(document).ready(function() {
    var table = $('#memberTable').DataTable();

    // Filter by Service
    $('#serviceFilter').on('change', function() {
        table.column(3).search(this.value).draw(); // 3 = Service column index
    });
    $('#sectorFilter').on('change', function() {
        table.column(6).search(this.value).draw(); // 4 = Sector column index
    });

    // Filter by Cadre
    $('#cadreFilter').on('change', function() {
        table.column(5).search(this.value).draw(); // 5 = Cadre column index
    });

    // Filter by Batch
    $('#batchFilter').on('change', function() {
        table.column(4).search(this.value).draw(); // 6 = Batch column index
    });
});
</script>

@endsection