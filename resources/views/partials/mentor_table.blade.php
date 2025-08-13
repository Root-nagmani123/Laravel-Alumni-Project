@if($members->isEmpty())
<tr>
    <td colspan="8" class="text-center">No Members Found</td>
</tr>
@else
@foreach($members as $key => $member)
<tr>
    <td><input type="checkbox" name="selected_members[]" value="{{ $member->id }}" class="row-checkbox"></td>
    <td>{{ $key+1 }}</td>
    <td>{{ $member->name }}</td>
    <td>{{ $member->email }}</td>
    <td>{{ $member->Service }}</td>
    <td>{{ $member->batch }}</td>
    <td>{{ $member->cader }}</td>
    <td>{{ $member->sector }}</td>
</tr>
@endforeach
@endif
