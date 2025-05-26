@extends('admin.layouts.master')

@section('title', 'RSVP  Events - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">RSVP  Events</h4>
                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    RSVP  Events
                                </span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
    <div class="datatables">
        <!-- start Zero Configuration -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">RSVP Events list</h4>
                        </div>
                        <div class="col-6">
                            <!--<div class="float-end gap-2">
                                <a href="{{ route('events.create') }}" class="btn btn-primary">+ Add Events</a>
                            </div>-->

                        </div>
                    </div>
                    <hr>
                    <div id="zero_config_wrapper" class="dataTables_wrapper">


                        <table id="zero_config"
                            class="table table-striped table-bordered text-nowrap align-middle dataTable"
                            aria-describedby="zero_config_info">
                            <thead>
                                <!-- start row -->
                                <tr>
									   <th>User</th>
										<th>Event</th>
										<th>RSVP Date</th>
										<th>Status</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>
							   @foreach ($rsvps as $rsvp)
								<tr class="odd">
									 <td>{{ $rsvp->user->name ?? 'N/A' }}</td>
									<td>{{ $rsvp->event->title ?? 'N/A' }}</td>
									<td>{{ $rsvp->responded_at }}</td>
									<td>
										<div class="form-check form-switch d-inline-block">
											<input class="form-check-input status-toggle" type="checkbox" role="switch"
												   data-table="rsvp" data-column="active_inactive" data-id="{{ $rsvp->id }}"
												   {{ $rsvp->status == 1 ? 'checked' : '' }}>
										</div>
									</td>


								</tr>
							@endforeach
						</tbody>
                        </table>
                        {{-- $event->links() --}}



                    </div>
                </div>
            </div>
        </div>
        <!-- end Zero Configuration -->
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
//Toastr message
    $(document).ready(function() {
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

    });

    $(document).ready(function () {
        // AJAX: Toggle Events status
        $('.status-toggle').change(function () {
            let status = $(this).prop('checked') ? 1 : 0;
            let rsvpId = $(this).data('id');

            $.ajax({
                url: '{{ route("events.rsvptoggleStatus") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: rsvpId,
                    status: status
                },
                success: function (response) {

                    toastr.success(response.message);
                },
                error: function () {
                    toastr.error('Failed to update status.');
                }
            });
        });
    });
    </script>


@endsection
