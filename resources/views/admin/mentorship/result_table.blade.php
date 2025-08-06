<div class="card">
    <div class="card-body">
        <h5>{{ ucfirst($role) }} List</h5>

        @if($results->isEmpty())
            <p>No {{ $role == 'mentor' ? 'mentees' : 'mentors' }} found for this member.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Cadre</th>
                        <th>Batch</th>
                        <th>Sector</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->cadre }}</td>
                            <td>{{ $item->batch }}</td>
                            <td>{{ $item->sector }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
