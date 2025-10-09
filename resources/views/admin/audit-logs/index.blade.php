@extends('admin.layouts.master')

@section('title', 'Audit Logs')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Audit Logs</h4>
                    <div class="card-tools">
                        <a href="{{ route('audit-logs.weekly-report') }}" class="btn btn-info btn-sm">
                            <i class="fas fa-chart-bar"></i> Weekly Report
                        </a>
                        <a href="{{ route('audit-logs.export') }}?{{ request()->getQueryString() }}" class="btn btn-success btn-sm">
                            <i class="fas fa-download"></i> Export CSV
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filters -->
                    <form method="GET" action="{{ route('audit-logs.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Action Type</label>
                                    <select name="action_type" class="form-control">
                                        <option value="">All Actions</option>
                                        @foreach($actionTypes as $type)
                                            <option value="{{ $type }}" {{ request('action_type') == $type ? 'selected' : '' }}>
                                                {{ ucfirst(str_replace('_', ' ', $type)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" value="{{ request('username') }}" placeholder="Enter username">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>IP Address</label>
                                    <select name="ip_address" class="form-control">
                                        <option value="">All IPs</option>
                                        @foreach($ipAddresses as $ip)
                                            <option value="{{ $ip }}" {{ request('ip_address') == $ip ? 'selected' : '' }}>
                                                {{ $ip }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select name="country" class="form-control">
                                        <option value="">All Countries</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country }}" {{ request('country') == $country ? 'selected' : '' }}>
                                                {{ $country }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Date From</label>
                                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Date To</label>
                                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i> Filter
                                    </button>
                                    <a href="{{ route('audit-logs.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Clear
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Audit Logs Table -->
                    <div class="table-responsive">
                        <table class="table audit-logs-table">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        <i class="fas fa-hashtag"></i> ID
                                    </th>
                                    <th>
                                        <i class="fas fa-clock"></i> Timestamp
                                    </th>
                                    <th>
                                        <i class="fas fa-globe"></i> IP Address
                                    </th>
                                    <th>
                                        <i class="fas fa-user"></i> Username
                                    </th>
                                    <th>
                                        <i class="fas fa-tasks"></i> Action
                                    </th>
                                    <th>
                                        <i class="fas fa-link"></i> URL
                                    </th>
                                    <th>
                                        <i class="fas fa-flag"></i> Country
                                    </th>
                                    <th class="text-center">
                                        <i class="fas fa-cogs"></i> Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($auditLogs as $log)
                                    <tr class="audit-row" data-log-id="{{ $log->id }}">
                                        <td class="text-center">
                                            <span class="log-id">{{ $log->id }}</span>
                                        </td>
                                        <td>
                                            <div class="timestamp-info">
                                                <div class="timestamp-main">{{ $log->timestamp->format('d-m-Y') }}</div>
                                                <div class="timestamp-sub">{{ $log->timestamp->format('H:i:s') }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="ip-badge" title="IP Address: {{ $log->ip_address }}">
                                                <i class="fas fa-network-wired"></i>
                                                {{ $log->ip_address }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($log->username)
                                                <span class="username-badge">
                                                    <i class="fas fa-user-circle"></i>
                                                    {{ $log->username }}
                                                </span>
                                            @else
                                                <span class="guest-badge">
                                                    <i class="fas fa-user-slash"></i>
                                                    Guest
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $actionConfig = match($log->action_type) {
                                                    'login_success' => ['class' => 'action-success', 'icon' => 'fa-check-circle'],
                                                    'login_failed' => ['class' => 'action-danger', 'icon' => 'fa-times-circle'],
                                                    'logout' => ['class' => 'action-warning', 'icon' => 'fa-sign-out-alt'],
                                                    'page_access' => ['class' => 'action-info', 'icon' => 'fa-eye'],
                                                    'api_call' => ['class' => 'action-secondary', 'icon' => 'fa-code'],
                                                    default => ['class' => 'action-default', 'icon' => 'fa-question-circle']
                                                };
                                            @endphp
                                            <span class="action-badge {{ $actionConfig['class'] }}">
                                                <i class="fas {{ $actionConfig['icon'] }}"></i>
                                                {{ ucfirst(str_replace('_', ' ', $log->action_type)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="url-info" title="{{ $log->url_accessed }}">
                                                <i class="fas fa-external-link-alt"></i>
                                                <span class="url-text">{{ Str::limit($log->url_accessed, 40) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if($log->country)
                                                <span class="country-badge">
                                                    <i class="fas fa-flag"></i>
                                                    {{ $log->country }}
                                                </span>
                                            @else
                                                <span class="no-country">
                                                    <i class="fas fa-question"></i>
                                                    Unknown
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('audit-logs.show', $log->id) }}" 
                                               class="btn btn-primary btn-sm" 
                                               title="View Details">
                                                <i class="fas fa-eye"></i>
                                                <span class="btn-text">View Details</span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center no-data">
                                            <div class="no-data-content">
                                                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">No audit logs found</h5>
                                                <p class="text-muted">Try adjusting your filters or check back later.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    @if($auditLogs->hasPages())
                        <div class="d-flex justify-content-center">
                            {{ $auditLogs->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Audit Logs Table Styling */
.audit-logs-table {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border: none;
}

.audit-logs-table thead {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.audit-logs-table thead th {
    border: none;
    padding: 20px 15px;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    vertical-align: middle;
}

.audit-logs-table thead th i {
    margin-right: 8px;
    opacity: 0.9;
}

.audit-logs-table tbody tr {
    transition: all 0.3s ease;
    border-bottom: 1px solid #f1f3f4;
}

.audit-logs-table tbody tr:hover {
    background: linear-gradient(90deg, #f8f9ff 0%, #e3f2fd 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.audit-logs-table tbody tr:nth-child(even) {
    background-color: #fafbfc;
}

.audit-logs-table tbody tr:nth-child(even):hover {
    background: linear-gradient(90deg, #f0f4ff 0%, #e1f5fe 100%);
}

.audit-logs-table tbody td {
    padding: 18px 15px;
    vertical-align: middle;
    border: none;
}

.audit-logs-table tbody td:last-child {
    text-align: center;
    min-width: 140px;
    background-color: #f8f9fa;
}

/* Log ID Styling */
.log-id {
    background: #e3f2fd;
    color: #1976d2;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
}

/* Timestamp Styling */
.timestamp-info {
    display: flex;
    flex-direction: column;
}

.timestamp-main {
    font-weight: 600;
    color: #2c3e50;
    font-size: 0.9rem;
}

.timestamp-sub {
    color: #7f8c8d;
    font-size: 0.8rem;
    margin-top: 2px;
}

/* IP Badge Styling */
.ip-badge {
    background: #e8f5e8;
    color: #2e7d32;
    padding: 8px 12px;
    border-radius: 8px;
    font-family: 'Courier New', monospace;
    font-size: 0.85rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: 1px solid #c8e6c9;
}

.ip-badge i {
    color: #4caf50;
}

/* Username Badge Styling */
.username-badge {
    background: #e3f2fd;
    color: #1565c0;
    padding: 8px 12px;
    border-radius: 8px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: 1px solid #bbdefb;
}

.username-badge i {
    color: #1976d2;
}

.guest-badge {
    background: #f3e5f5;
    color: #7b1fa2;
    padding: 8px 12px;
    border-radius: 8px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: 1px solid #e1bee7;
}

.guest-badge i {
    color: #9c27b0;
}

/* Action Badge Styling */
.action-badge {
    padding: 8px 12px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.action-success {
    background: #e8f5e8;
    color: #2e7d32;
    border-color: #c8e6c9;
}

.action-danger {
    background: #ffebee;
    color: #c62828;
    border-color: #ffcdd2;
}

.action-warning {
    background: #fff3e0;
    color: #ef6c00;
    border-color: #ffcc02;
}

.action-info {
    background: #e3f2fd;
    color: #1565c0;
    border-color: #bbdefb;
}

.action-secondary {
    background: #f3e5f5;
    color: #7b1fa2;
    border-color: #e1bee7;
}

.action-default {
    background: #f5f5f5;
    color: #616161;
    border-color: #e0e0e0;
}

/* URL Info Styling */
.url-info {
    display: flex;
    align-items: center;
    gap: 8px;
    max-width: 300px;
}

.url-info i {
    color: #7f8c8d;
    font-size: 0.8rem;
}

.url-text {
    color: #2c3e50;
    font-size: 0.85rem;
    font-family: 'Courier New', monospace;
    word-break: break-all;
}

/* Country Badge Styling */
.country-badge {
    background: #fff3e0;
    color: #ef6c00;
    padding: 6px 10px;
    border-radius: 6px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    border: 1px solid #ffcc02;
}

.country-badge i {
    color: #ff9800;
}

.no-country {
    color: #95a5a6;
    font-style: italic;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
}

/* View Button Styling */
.btn-view {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px 16px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    min-width: 120px;
    justify-content: center;
}

.btn-view:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    color: white;
    text-decoration: none;
    background: linear-gradient(135deg, #218838 0%, #1ea085 100%);
}

.btn-view:focus {
    box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.3);
    color: white;
    text-decoration: none;
}

.btn-view:visited {
    color: white;
    text-decoration: none;
}

.btn-text {
    font-weight: 600;
    font-size: 0.85rem;
}

/* No Data Styling */
.no-data {
    padding: 60px 20px;
}

.no-data-content {
    text-align: center;
}

.no-data-content i {
    opacity: 0.5;
}

/* Responsive Design */
@media (max-width: 768px) {
    .audit-logs-table {
        font-size: 0.85rem;
    }
    
    .audit-logs-table thead th {
        padding: 15px 10px;
        font-size: 0.8rem;
    }
    
    .audit-logs-table tbody td {
        padding: 15px 10px;
    }
    
    .url-info {
        max-width: 200px;
    }
    
    .btn-view {
        font-size: 0.8rem;
        padding: 8px 12px;
        min-width: 100px;
    }
    
    .btn-text {
        font-size: 0.8rem;
    }
}

@media (max-width: 576px) {
    .audit-logs-table thead th i {
        display: none;
    }
    
    .audit-logs-table thead th {
        font-size: 0.75rem;
        padding: 12px 8px;
    }
    
    .audit-logs-table tbody td {
        padding: 12px 8px;
    }
    
    .timestamp-info {
        font-size: 0.8rem;
    }
    
    .action-badge {
        font-size: 0.7rem;
        padding: 6px 8px;
    }
}

/* Loading Animation */
.audit-row {
    animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Filter Form Enhancement */
.card-body .form-group label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
}

.card-body .form-control {
    border-radius: 8px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.card-body .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

/* Card Header Enhancement */
.card-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-bottom: 2px solid #dee2e6;
}

.card-header .card-title {
    color: #2c3e50;
    font-weight: 700;
    margin: 0;
}

.card-tools .btn {
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.card-tools .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}
</style>
@endpush

@push('scripts')
<script>
    // Auto-refresh every 30 seconds for real-time monitoring
    @if(request('action_type') == 'login_failed' || request('action_type') == 'login_success')
        setInterval(function() {
            if (document.visibilityState === 'visible') {
                location.reload();
            }
        }, 30000);
    @endif

    // Date validation and dynamic min/max date setting
    document.addEventListener('DOMContentLoaded', function() {
        const dateFromInput = document.querySelector('input[name="date_from"]');
        const dateToInput = document.querySelector('input[name="date_to"]');
        const form = document.querySelector('form[method="GET"]');

        // Set initial max date for date_from (today)
        const today = new Date().toISOString().split('T')[0];
        if (dateFromInput) {
            dateFromInput.setAttribute('max', today);
        }

        function updateDateToConstraints() {
            const dateFrom = dateFromInput ? dateFromInput.value : '';
            const dateTo = dateToInput ? dateToInput.value : '';
            
            if (dateFrom && dateToInput) {
                // Set minimum date for date_to to be the date_from
                dateToInput.setAttribute('min', dateFrom);
                
                // If current date_to is before date_from, clear it
                if (dateTo && new Date(dateTo) < new Date(dateFrom)) {
                    dateToInput.value = '';
                }
            } else if (dateToInput) {
                // If no date_from, remove min constraint
                dateToInput.removeAttribute('min');
            }
        }

        function updateDateFromConstraints() {
            const dateTo = dateToInput ? dateToInput.value : '';
            
            if (dateTo && dateFromInput) {
                // Set maximum date for date_from to be the date_to
                dateFromInput.setAttribute('max', dateTo);
            } else if (dateFromInput) {
                // If no date_to, set max to today
                dateFromInput.setAttribute('max', today);
            }
        }

        // Event listeners
        if (dateFromInput) {
            dateFromInput.addEventListener('change', function() {
                updateDateToConstraints();
            });
        }

        if (dateToInput) {
            dateToInput.addEventListener('change', function() {
                updateDateFromConstraints();
            });
        }

        // Form validation
        if (form) {
            form.addEventListener('submit', function(e) {
                const dateFrom = dateFromInput ? new Date(dateFromInput.value) : null;
                const dateTo = dateToInput ? new Date(dateToInput.value) : null;
                
                if (dateFrom && dateTo && dateFrom > dateTo) {
                    e.preventDefault();
                    alert('Date From cannot be greater than Date To. Please select valid dates.');
                    return false;
                }
            });
        }

        // Initialize constraints
        updateDateToConstraints();
        updateDateFromConstraints();
    });

    // Row click functionality removed - only View Details button handles navigation

    // Add tooltip functionality
    $(document).ready(function() {
        $('[title]').tooltip();
    });
</script>
@endpush
