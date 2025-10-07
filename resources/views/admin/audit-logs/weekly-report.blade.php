@extends('admin.layouts.master')

@section('title', 'Audit Log Weekly Report')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Weekly Audit Report</h4>
                    <div class="card-tools">
                        <a href="{{ route('audit-logs.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to Logs
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Date Range Filter -->
                    <form method="GET" action="{{ route('audit-logs.weekly-report') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" name="start_date" class="form-control" value="{{ $startDate->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" name="end_date" class="form-control" value="{{ $endDate->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i> Generate Report
                                        </button>
                                        <a href="{{ route('audit-logs.weekly-report') }}" class="btn btn-secondary">
                                            <i class="fas fa-calendar-week"></i> This Week
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Summary Statistics -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ number_format($reportData['total_requests']) }}</h4>
                                            <p class="mb-0">Total Requests</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-globe fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ number_format($reportData['unique_ips']) }}</h4>
                                            <p class="mb-0">Unique IPs</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-network-wired fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ number_format($reportData['unique_users']) }}</h4>
                                            <p class="mb-0">Unique Users</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-users fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $reportData['period']['start'] }} to {{ $reportData['period']['end'] }}</h4>
                                            <p class="mb-0">Report Period</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-calendar fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Login Attempts Summary -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5>Login Attempts Summary</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Action Type</th>
                                            <th>Total Attempts</th>
                                            <th>Unique IPs</th>
                                            <th>Unique Users</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($reportData['summary'] as $summary)
                                            <tr>
                                                <td>
                                                    @php
                                                        $badgeClass = $summary->action_type == 'login_success' ? 'badge-success' : 'badge-danger';
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }}">
                                                        {{ ucfirst(str_replace('_', ' ', $summary->action_type)) }}
                                                    </span>
                                                </td>
                                                <td>{{ number_format($summary->total_attempts) }}</td>
                                                <td>{{ number_format($summary->unique_ips) }}</td>
                                                <td>{{ number_format($summary->unique_users) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">No login attempts in this period</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Daily Activity Chart -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5>Daily Activity</h5>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Action Type</th>
                                            <th>Count</th>
                                            <th>Unique IPs</th>
                                            <th>Unique Users</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($reportData['daily_activity'] as $activity)
                                            <tr>
                                                <td>{{ $activity->date }}</td>
                                                <td>
                                                    @php
                                                        $badgeClass = match($activity->action_type) {
                                                            'login_success' => 'badge-success',
                                                            'login_failed' => 'badge-danger',
                                                            'logout' => 'badge-warning',
                                                            'page_access' => 'badge-info',
                                                            'api_call' => 'badge-secondary',
                                                            default => 'badge-light'
                                                        };
                                                    @endphp
                                                    <span class="{{ $badgeClass }}">
                                                        {{ ucfirst(str_replace('_', ' ', $activity->action_type)) }}
                                                    </span>
                                                </td>
                                                <td>{{ number_format($activity->count) }}</td>
                                                <td>{{ number_format($activity->unique_ips) }}</td>
                                                <td>{{ number_format($activity->unique_users) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">No activity in this period</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Top IP Addresses -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Top IP Addresses by Activity</h5>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>IP Address</th>
                                            <th>Country</th>
                                            <th>Requests</th>
                                            <th>Users</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($reportData['top_ips'] as $ip)
                                            <tr>
                                                <td><code>{{ $ip->ip_address }}</code></td>
                                                <td>{{ $ip->country ?? 'Unknown' }}</td>
                                                <td>{{ number_format($ip->total_requests) }}</td>
                                                <td>{{ number_format($ip->unique_users) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">No data available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Failed Login Attempts -->
                        <div class="col-md-6">
                            <h5>Failed Login Attempts by IP</h5>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>IP Address</th>
                                            <th>Country</th>
                                            <th>Failed Attempts</th>
                                            <th>Usernames</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($reportData['failed_logins'] as $failed)
                                            <tr>
                                                <td><code>{{ $failed->ip_address }}</code></td>
                                                <td>{{ $failed->country ?? 'Unknown' }}</td>
                                                <td>
                                                    <span class="badge badge-danger">{{ number_format($failed->failed_attempts) }}</span>
                                                </td>
                                                <td>{{ number_format($failed->unique_usernames) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">No failed login attempts</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Export Options -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Export Options</h6>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('audit-logs.export') }}?date_from={{ $startDate->format('Y-m-d') }}&date_to={{ $endDate->format('Y-m-d') }}" 
                                       class="btn btn-success">
                                        <i class="fas fa-download"></i> Export Full Report (CSV)
                                    </a>
                                    <a href="{{ route('audit-logs.export') }}?action_type=login_failed&date_from={{ $startDate->format('Y-m-d') }}&date_to={{ $endDate->format('Y-m-d') }}" 
                                       class="btn btn-danger">
                                        <i class="fas fa-exclamation-triangle"></i> Export Failed Logins Only
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-refresh report every 5 minutes
    setInterval(function() {
        if (document.visibilityState === 'visible') {
            location.reload();
        }
    }, 300000); // 5 minutes
</script>
@endpush
