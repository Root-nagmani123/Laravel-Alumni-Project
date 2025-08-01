@extends('layouts.app')

@section('title', 'Directory - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')


<main class="main-content">
    <div class="container">
        <div class="pagetitle" style="margin-top:7rem !important;">
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
                                 <div class="col-md-4">
                                    <label for="serviceFilter" class="form-label">Filter by Service:</label>
                                    <select id="serviceFilter" class="form-select">
                                         <option value="">All</option>
                                         @php
                                         $services = $members->pluck('service')->unique()->filter();
                                         @endphp
                                         @foreach ($services as $service)
                                         <option value="{{ $service }}">{{ $service }}</option>
                                         @endforeach
                                     </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="cadreFilter" class="form-label">Filter by Cadre:</label>
                                    <select id="cadreFilter" class="form-select">
                                         <option value="">All</option>
                                         @php
                                         $cadres = $members->pluck('cader')->unique()->filter();
                                         @endphp
                                         @foreach ($cadres as $cadre)
                                         <option value="{{ $cadre }}">{{ $cadre }}</option>
                                         @endforeach
                                     </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="batchFilter" class="form-label">Filter by Batch:</label>
                                    <select id="batchFilter" name="batch" class="form-select">">
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
                               <table id="memberTable" class="table table-striped table-bordered dt-bootstrap5">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email Id</th>
                                            <th>Service</th>
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
                                                <td>{{ $row->service }}</td>
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

<!-- Filter Logic -->
<script>
    $(document).ready(function () {
        var table = $('#memberTable').DataTable();

        // Filter by Service
        $('#serviceFilter').on('change', function () {
            table.column(3).search(this.value).draw(); // 3 = Service column index
        });

        // Filter by Cadre
        $('#cadreFilter').on('change', function () {
            table.column(4).search(this.value).draw(); // 4 = Cadre column index
        });

        // Filter by Batch
        $('#batchFilter').on('change', function () {
            table.column(5).search(this.value).draw(); // 5 = Batch column index
        });
    });
</script>

@endsection
