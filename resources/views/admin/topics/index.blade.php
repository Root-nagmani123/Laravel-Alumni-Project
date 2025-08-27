@extends('admin.layouts.master')

@section('title', 'Recents Topics - Alumni | Lal Bahadur Shastri National Academy of Administration')
@section('content')
    <div class="container-fluid">
        
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center g-3 mb-4">
                    <!-- Title -->
                    <div class="col-lg-3 col-md-6">
                        <h4 class="card-title mb-0">Recent Activity List</h4>
                    </div>
                </div>
                
                    <div class="table-responsive-sm table-responsive-md table-responsive-lg">
                        <table
                            class="table table-striped table-bordered align-middle dataTable w-100 text-nowwrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">S.No.</th>
                                    <th scope="col">Module</th>
                                    <th scope="col">Activity</th>
                                    {{-- <th scope="col">Title</th> --}}
                                    <th scope="col">Description</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Created Time</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">IP Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topics as $topic)
                                    <tr>
                                        <td>{{ $loop->iteration + ($topics->currentPage() - 1) * $topics->perPage() }}</td>
                                        <td class="text-break">{{ $topic->module }}</td>
                                        <td class="text-break">{{ $topic->title }}</td>
                                        {{-- <td class="text-break">{{ $topic->activity }}</td> --}}
                                        <td class="text-break">{{ $topic->activity ?? 'N/A' }}</td>
                                        <td class="text-break">
                                            @if($topic->member_type == 2)
                                                {{ $topic->member ? $topic->member->name : '' }}
                                            @endif
                                            @if($topic->member_type == 1)
                                                {{ $topic->admin ? $topic->admin->name : '' }}
                                            @endif
                                        </td>
                                        <td class="text-break">{{ \Carbon\Carbon::parse($topic->created_at)->format('H:i A') }}</td>
                                        <td class="text-break">{{ \Carbon\Carbon::parse($topic->created_at)->format('d M Y') }}</td>
                                        <td class="text-break">{{ $topic->ip_address }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $topics->links() }}
                    </div>
                
            </div>
        </div>
    </div>
@endsection