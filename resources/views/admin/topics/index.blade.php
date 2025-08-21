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
                        {{ $dataTable->table(['class' => 'table table-striped table-bordered']) }}
                    </div>
                </div>

        
            </div>
        </div>
@endsection

    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush