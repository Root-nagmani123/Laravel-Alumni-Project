 @extends('layouts.app')

   @section('title', 'User Feed - Alumni | Lal Bahadur Shastri National Academy of Administration')

   @section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>{{ $pageName ?? 'Members List' }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.feed') }}">Home</a></li>
                <li class="breadcrumb-item">{{ $pageName ?? 'Members' }}</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <!-- Filters -->
                        <!-- Dropdown Filters -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="cadreFilter">Filter by Cadre:</label>
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
                                <div class="col-md-3">
                                    <label for="batchFilter">Filter by Batch:</label>
                                    <select id="batchFilter" class="form-control">
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
                            <table id="memberTable" class="table datatable">
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
    </section>

</main>
@section('scripts')
<script>
    $(document).ready(function () {
        var table = $('#memberTable').DataTable();

        // Cadre Filter
        $('#cadreFilter').on('change', function () {
            let val = $(this).val();
            table.column(4).search(val).draw();
        });

        // Batch Filter
        $('#batchFilter').on('change', function () {
            let val = $(this).val();
            table.column(5).search(val).draw();
        });
    });
</script>
@endsection

