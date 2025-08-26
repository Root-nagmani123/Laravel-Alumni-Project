@extends('admin.layouts.master')

@section('title', 'Recents Topics - Alumni | Lal Bahadur Shastri National Academy of Administration')
@section('content')
    <div class="container-fluid">

        <div class="container">



            <!-- -------------------------------------------- -->
            <!-- Welcome Card -->
            <!-- -------------------------------------------- -->
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center g-3 mb-4">
                        <!-- Title -->
                        <div class="col-lg-3 col-md-6">
                            <h4 class="card-title mb-0">Recent Topic List</h4>
                        </div>
                    </div>
                    <div class="dataTables_wrapper">
                        <div class="table-responsive-sm table-responsive-md table-responsive-lg">
                            <table
                                class="table table-striped table-bordered align-middle dataTable w-100 text-nowwrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">S.No.</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Member</th>
                                        <th scope="col">Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topics as $topic)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-break">{{ $topic->title }}</td>
                                            <td class="text-break">{{ $topic->description }}</td>
                                            <td class="text-break">{{ $topic->member ? $topic->member->name : '' }}</td>
                                            <td class="text-break">{{ $topic->created_date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
@endsection