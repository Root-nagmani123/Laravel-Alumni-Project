@extends('layouts.app')

@section('title', 'Directory - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<main class="main-content">
    <div class="container">
        <div class="pagetitle">
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

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4 rounded p-3">
                        <div class="card-body">

                            <!-- Filters -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="cadreFilter" class="form-label">Filter by Cadre:</label>
                                    <select id="cadreFilter" class="form-control">
                                         <option value="">All</option>
                                         @php
                                         $cadres = $members->pluck('cader')->unique()->filter();
                                         @endphp
                                         @foreach ($cadres as $cadre)
                                         <option value="{{ $cadre }}">{{ $cadre }}</option>
                                         @endforeach
                                     </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="batchFilter" class="form-label">Filter by Batch:</label>
                                    <select id="batchFilter" name="batch" class="form-control">
                                        <option value="">All</option>
                                        @php
                                            $batches = $members->pluck('batch')->unique()->filter(function($value) {
                                                return !is_null($value) && $value !== '' && $value != 0;
                                            });
                                        @endphp
                                        @foreach ($batches as $batch)
                                            <option value="{{ $batch }}">{{ $batch }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Member Table -->
                            <div class="table-responsive">
                                <table id="memberTable" class="table datatable table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email Id</th>
                                            <th>Mobile No.</th>
                                            <th>Cadre</th>
                                            <th>Batch</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($members as $index => $row)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->email }}</td>
                                                <td>{{ $row->mobile }}</td>
                                                <td>{{ $row->cader }}</td>
                                                <td>{{ $row->batch }}</td>
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
</main>
@endsection

@section('scripts')
<!-- jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Bootstrap Bundle (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>

<!-- Filter Logic -->
<script>
    $(document).ready(function () {
        var table = $('#memberTable').DataTable();

        $('#cadreFilter').on('change', function () {
            table.column(4).search(this.value).draw();
        });

        $('#batchFilter').on('change', function () {
            table.column(5).search(this.value).draw();
        });
    });
</script>
@endsection
