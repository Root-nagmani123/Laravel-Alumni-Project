@extends('admin.layouts.master')

@section('title', 'forums - Alumni | Lal Bahadur')

@section('content')
<main id="main" class="main">

    {{-- Assign the page name --}}
    @php 
        $pageName = 'Members List'; 
    @endphp

    <div class="pagetitle">
        <h1>{{ $pageName }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item">{{ $pageName }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        @if(count($users) > 0)
                        <!-- Table with DataTable functionality -->
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                                <tr>
                                    <th scope="col" class="font-weight-bold">#</th>
                                    <th scope="col" class="font-weight-bold">Member Name</th>
                                    <th scope="col" class="font-weight-bold">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name ?? 'N/A' }}</td>
                                        <td>{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="alert alert-warning" role="alert">
                                No member is added to this forum.
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable for sorting, pagination, and search functionality
        $('.datatable').DataTable({
            "paging": true,
            "lengthChange": true, // Show "records per page"
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });
</script>
@endsection
@endsection

