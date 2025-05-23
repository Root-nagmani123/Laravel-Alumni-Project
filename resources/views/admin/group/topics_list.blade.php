@extends('admin.layouts.master')

@section('title', 'Group - Alumni | Lal Bahadur')

@section('content')
<div class="container">
    <h2>Topics in: {{ $pageName }}</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Created Date</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($topics as $topic)
                <tr>
                    <td>{{ $topic->title }}</td>
                    <td>
                        <input type="checkbox"
                               class="status-toggle"
                               data-id="{{ $topic->id }}"
                               data-toggle="toggle"
                               data-on="Active"
                               data-off="Inactive"
                               data-onstyle="success"
                               data-offstyle="danger"
                               {{ $topic->status == 1 ? 'checked' : '' }}>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($topic->created_date)->timezone('Asia/Kolkata')->format('l, d M Y, h:i A') }}</td>
                    <td class="text-center">
                        <!-- Edit Button -->
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewTopicModal{{ $topic->id }}">
                            View/Edit
                        </button>

                        <!-- Delete Form -->
                        <form id="delete-form-{{ $topic->id }}"
                              action="{{ route('forums.topics.delete', $topic->id) }}"
                              method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                    class="btn btn-sm btn-danger delete-topic-btn"
                                    data-id="{{ $topic->id }}"
                                    data-status="{{ $topic->status }}">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Include Modal Here (as you've written above) -->

            @empty
                <tr>
                    <td colspan="5" class="text-center">No topics found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
@if(session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
@endif
@endsection
