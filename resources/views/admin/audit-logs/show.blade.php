@extends('admin.layouts.master')

@section('title', 'Audit Log Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Audit Log Details - ID: {{ $auditLog->id }}</h4>
                    <div class="card-tools">
                        <a href="{{ route('audit-logs.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Basic Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Log ID:</th>
                                    <td>{{ $auditLog->id }}</td>
                                </tr>
                                <tr>
                                    <th>Timestamp:</th>
                                    <td>{{ $auditLog->timestamp->format('d-m-Y H:i:s') }} ({{ $auditLog->timestamp->diffForHumans() }})</td>
                                </tr>
                                <tr>
                                    <th>Action Type:</th>
                                    <td>
                                        @php
                                            $actionConfig = match($auditLog->action_type) {
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
                                            {{ ucfirst(str_replace('_', ' ', $auditLog->action_type)) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Username:</th>
                                    <td>
                                        @if($auditLog->username)
                                            <span class="username-badge">
                                                <i class="fas fa-user-circle"></i>
                                                {{ $auditLog->username }}
                                            </span>
                                        @else
                                            <span class="guest-badge">
                                                <i class="fas fa-user-slash"></i>
                                                Guest/Anonymous
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>IP Address:</th>
                                    <td>
                                        <span class="ip-badge" title="IP Address: {{ $auditLog->ip_address }}">
                                            <i class="fas fa-network-wired"></i>
                                            {{ $auditLog->ip_address }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Country:</th>
                                    <td>
                                        @if($auditLog->country)
                                            <span class="country-badge">
                                                <i class="fas fa-flag"></i>
                                                {{ $auditLog->country }}
                                            </span>
                                        @else
                                            <span class="no-country">
                                                <i class="fas fa-question"></i>
                                                Unknown
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Technical Details</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Session ID:</th>
                                    <td>
                                        @if($auditLog->session_id)
                                            <code>{{ $auditLog->session_id }}</code>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Process ID:</th>
                                    <td>{{ $auditLog->process_id ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>HTTP Method:</th>
                                    <td>
                                        @if($auditLog->http_method)
                                            <span class="method-badge">
                                                <i class="fas fa-code"></i>
                                                {{ $auditLog->http_method }}
                                            </span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Referrer URL:</th>
                                    <td>
                                        @if($auditLog->referrer_url)
                                            <a href="{{ $auditLog->referrer_url }}" target="_blank" class="text-break">
                                                {{ Str::limit($auditLog->referrer_url, 50) }}
                                            </a>
                                        @else
                                            <span class="text-muted">Direct Access</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>User Agent:</th>
                                    <td>
                                        @if($auditLog->username)
                                            @php
                                                $userAgent = $auditLog->user_agent;
                                                $browserInfo = [];
                                                
                                                // Browser detection
                                                if (strpos($userAgent, 'Chrome') !== false && strpos($userAgent, 'Edg') === false) {
                                                    $browserInfo[] = 'Chrome';
                                                } elseif (strpos($userAgent, 'Firefox') !== false) {
                                                    $browserInfo[] = 'Firefox';
                                                } elseif (strpos($userAgent, 'Safari') !== false && strpos($userAgent, 'Chrome') === false) {
                                                    $browserInfo[] = 'Safari';
                                                } elseif (strpos($userAgent, 'Edg') !== false) {
                                                    $browserInfo[] = 'Edge';
                                                } elseif (strpos($userAgent, 'Opera') !== false || strpos($userAgent, 'OPR') !== false) {
                                                    $browserInfo[] = 'Opera';
                                                } else {
                                                    $browserInfo[] = 'Unknown Browser';
                                                }
                                                
                                                // Device type detection
                                                if (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Android') !== false || strpos($userAgent, 'iPhone') !== false) {
                                                    $browserInfo[] = 'Mobile';
                                                } elseif (strpos($userAgent, 'Tablet') !== false || strpos($userAgent, 'iPad') !== false) {
                                                    $browserInfo[] = 'Tablet';
                                                } else {
                                                    $browserInfo[] = 'Desktop';
                                                }
                                            @endphp
                                            
                                            <div class="device-info">
                                                @foreach($browserInfo as $info)
                                                    <span class="device-badge">{{ $info }}</span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-muted">Guest/Anonymous</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>URL Accessed</h5>
                            <div class="alert alert-light">
                                <code>{{ $auditLog->url_accessed }}</code>
                            </div>
                        </div>
                    </div>

                    @if($auditLog->error_message)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Error Message</h5>
                            <div class="alert alert-danger">
                                <code>{{ $auditLog->error_message }}</code>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($auditLog->request_data && count($auditLog->request_data) > 0)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5><i class="fas fa-database"></i> Request Data</h5>
                            <div class="request-data-container">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered request-data-table">
                                        <thead>
                                            <tr>
                                                <th width="30%">Parameter</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($auditLog->request_data as $key => $value)
                                            <tr>
                                                <td>
                                                    <strong>{{ $key }}</strong>
                                                </td>
                                                <td>
                                                    @if(is_array($value) || is_object($value))
                                                        <div class="nested-data">
                                                            <button type="button" class="btn btn-sm btn-outline-secondary toggle-nested" data-target="nested-{{ $loop->index }}">
                                                                <i class="fas fa-chevron-down"></i> View Details
                                                            </button>
                                                            <div class="nested-content" id="nested-{{ $loop->index }}" style="display: none;">
                                                                <pre class="nested-json"><code>{{ json_encode($value, JSON_PRETTY_PRINT) }}</code></pre>
                                                            </div>
                                                        </div>
                                                    @elseif(is_bool($value))
                                                        <span class="badge {{ $value ? 'badge-success' : 'badge-danger' }}">
                                                            {{ $value ? 'True' : 'False' }}
                                                        </span>
                                                    @elseif(is_null($value))
                                                        <span class="text-muted">NULL</span>
                                                    @else
                                                        <code>{{ $value }}</code>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="alert alert-info">
                                <h6><i class="fas fa-info-circle"></i> Security Note</h6>
                                <p class="mb-0">
                                    This audit log entry is immutable and cannot be modified or deleted to maintain security integrity. 
                                    Any gaps in log numbering indicate potential security incidents.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Badge Styling for Show Page */
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

.method-badge {
    background: #f3e5f5;
    color: #7b1fa2;
    padding: 6px 10px;
    border-radius: 6px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    border: 1px solid #e1bee7;
    font-family: 'Courier New', monospace;
}

.method-badge i {
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

/* Table Styling */
.table th {
    background-color: #f8f9fa;
    font-weight: 600;
    color: #495057;
    border-top: none;
}

.table td {
    vertical-align: middle;
}

/* Card Styling */
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

/* Alert Styling */
.alert-light {
    background-color: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 8px;
}

.alert-light code {
    color: #495057;
    background-color: #e9ecef;
    padding: 2px 6px;
    border-radius: 4px;
}

.alert-danger code {
    color: #721c24;
    background-color: #f8d7da;
    padding: 2px 6px;
    border-radius: 4px;
}

.alert-info {
    border-radius: 8px;
    border-left: 4px solid #17a2b8;
}

/* Request Data Styling */
.request-data-container {
    background-color: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 15px;
    margin-top: 10px;
}

.request-data-table {
    margin-bottom: 0;
    background-color: #fff;
    border-radius: 6px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.request-data-table th {
    background-color: #667eea;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
    border: none;
    padding: 12px 15px;
}

.request-data-table td {
    padding: 12px 15px;
    vertical-align: top;
    border-bottom: 1px solid #f1f3f4;
}

.request-data-table tbody tr:hover {
    background-color: #f8f9fa;
}

.request-data-table tbody tr:last-child td {
    border-bottom: none;
}

/* Nested Data Styling */
.nested-data {
    position: relative;
}

.toggle-nested {
    font-size: 0.75rem;
    padding: 4px 8px;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.toggle-nested:hover {
    background-color: #6c757d;
    color: #fff;
    transform: translateY(-1px);
}

.toggle-nested i {
    transition: transform 0.3s ease;
}

.toggle-nested.active i {
    transform: rotate(180deg);
}

.nested-content {
    margin-top: 10px;
    background-color: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 6px;
    padding: 10px;
}

.nested-json {
    background-color: #2d3748;
    color: #e2e8f0;
    padding: 10px;
    border-radius: 4px;
    font-family: 'Courier New', monospace;
    font-size: 0.8rem;
    line-height: 1.4;
    overflow-x: auto;
    margin: 0;
    border: 1px solid #4a5568;
}

.nested-json code {
    background: none;
    color: inherit;
    padding: 0;
    border-radius: 0;
    font-family: inherit;
    font-size: inherit;
}

/* Badge Styling for Values */
.badge-success {
    background-color: #28a745;
    color: #fff;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 600;
}

.badge-danger {
    background-color: #dc3545;
    color: #fff;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 600;
}

/* Code Styling for Values */
.request-data-table code {
    background-color: #e9ecef;
    color: #495057;
    padding: 2px 6px;
    border-radius: 3px;
    font-family: 'Courier New', monospace;
    font-size: 0.85rem;
    word-break: break-all;
}

/* Responsive Table */
.table-responsive {
    border-radius: 6px;
    overflow: hidden;
}

/* Device Info Styling */
.device-info {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    align-items: center;
}

.device-badge {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    box-shadow: 0 2px 4px rgba(102, 126, 234, 0.3);
    transition: all 0.3s ease;
}

.device-badge:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(102, 126, 234, 0.4);
}

/* Section Headers */
h5 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 15px;
    padding-bottom: 8px;
    border-bottom: 2px solid #e9ecef;
}

h5 i {
    margin-right: 8px;
    color: #667eea;
}

/* Enhanced Table Styling */
.table th {
    background-color: #f8f9fa;
    font-weight: 600;
    color: #495057;
    border-top: none;
    border-bottom: 2px solid #dee2e6;
    padding: 12px 15px;
}

.table td {
    vertical-align: middle;
    padding: 12px 15px;
    border-bottom: 1px solid #f1f3f4;
}

/* URL Accessed Styling */
.alert-light {
    background-color: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    border-left: 4px solid #17a2b8;
}

.alert-light code {
    color: #495057;
    background-color: #e9ecef;
    padding: 4px 8px;
    border-radius: 4px;
    font-family: 'Courier New', monospace;
    font-size: 0.9rem;
    word-break: break-all;
}

/* Error Message Styling */
.alert-danger {
    border-radius: 8px;
    border-left: 4px solid #dc3545;
}

.alert-danger code {
    color: #721c24;
    background-color: #f8d7da;
    padding: 4px 8px;
    border-radius: 4px;
    font-family: 'Courier New', monospace;
    font-size: 0.9rem;
}

/* Security Note Styling */
.alert-info {
    border-radius: 8px;
    border-left: 4px solid #17a2b8;
    background-color: #d1ecf1;
    border-color: #bee5eb;
}

.alert-info h6 {
    color: #0c5460;
    font-weight: 600;
    margin-bottom: 8px;
}

.alert-info p {
    color: #0c5460;
    margin-bottom: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .table th, .table td {
        padding: 8px;
        font-size: 0.9rem;
    }
    
    .ip-badge, .username-badge, .guest-badge, .country-badge, .method-badge {
        font-size: 0.8rem;
        padding: 6px 8px;
    }
    
    .request-data-code {
        font-size: 0.8rem;
        padding: 10px;
    }
    
    h5 {
        font-size: 1.1rem;
    }
    
    .device-badge {
        font-size: 0.7rem;
        padding: 3px 8px;
    }
    
    .device-info {
        gap: 4px;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle nested data functionality
    const toggleButtons = document.querySelectorAll('.toggle-nested');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const targetElement = document.getElementById(targetId);
            const icon = this.querySelector('i');
            
            if (targetElement.style.display === 'none' || targetElement.style.display === '') {
                targetElement.style.display = 'block';
                this.classList.add('active');
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
                this.innerHTML = '<i class="fas fa-chevron-up"></i> Hide Details';
            } else {
                targetElement.style.display = 'none';
                this.classList.remove('active');
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
                this.innerHTML = '<i class="fas fa-chevron-down"></i> View Details';
            }
        });
    });
});
</script>
@endpush
