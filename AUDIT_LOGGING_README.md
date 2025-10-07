# Audit Logging System

This Laravel application now includes a comprehensive audit logging system that tracks all user activities, authentication attempts, and system access.

## Features

### 🔍 **Comprehensive Logging**
- **IP Address Tracking**: Records the IP address of every request
- **User Authentication**: Logs successful and failed login attempts
- **Session Management**: Tracks session IDs and user sessions
- **Request Details**: Records URL accessed, HTTP method, user agent, and referrer
- **Geolocation**: Automatically detects country from IP address
- **Process Tracking**: Records process ID for each request
- **Error Logging**: Captures error messages and response codes

### 🛡️ **Security Features**
- **Immutable Logs**: Log entries cannot be modified or deleted
- **Auto-incrementing IDs**: Gaps in log numbering indicate potential security incidents
- **No Password Storage**: Only usernames are logged, never passwords
- **Sensitive Data Filtering**: Automatically removes sensitive information from logs

### 📊 **Admin Dashboard**
- **Real-time Statistics**: View today's activity on the main dashboard
- **Advanced Filtering**: Filter logs by date, user, IP, action type, and country
- **Detailed Views**: Click any log entry to see complete details
- **Weekly Reports**: Generate comprehensive weekly activity reports
- **Export Functionality**: Export logs to CSV for external analysis

### 🔧 **Technical Implementation**

#### Database Table: `audit_logs`
```sql
- id (auto-increment primary key)
- ip_address (IPv6 compatible)
- timestamp
- username (no password)
- session_id
- referrer_url
- process_id
- url_accessed
- user_agent
- country
- action_type (login_success, login_failed, logout, page_access, api_call)
- request_data (JSON)
- http_method
- response_code
- error_message
- created_at, updated_at
```

#### Key Components:
1. **AuditLog Model** (`app/Models/AuditLog.php`)
2. **AuditService** (`app/Services/AuditService.php`)
3. **AuditLoggingMiddleware** (`app/Http/Middleware/AuditLoggingMiddleware.php`)
4. **AuditLogController** (`app/Http/Controllers/Admin/AuditLogController.php`)

## Installation & Setup

### 1. Run Migration
```bash
php artisan migrate
```

### 2. Middleware Registration
The audit logging middleware is automatically registered in `bootstrap/app.php` and will log all web requests.

### 3. Access Admin Interface
Navigate to: `https://alumni.lbsnaa.gov.in/admin/audit-logs`

## Usage

### Viewing Audit Logs
1. Go to **Admin Panel** → **Audit Logs**
2. Use filters to narrow down results:
   - **Action Type**: Filter by login attempts, page access, etc.
   - **Username**: Search for specific users
   - **IP Address**: Track specific IPs
   - **Date Range**: Filter by time period
   - **Country**: Filter by geographic location

### Weekly Reports
1. Go to **Admin Panel** → **Audit Logs** → **Weekly Report**
2. Select date range or use default (current week)
3. View comprehensive statistics including:
   - Total requests and unique users
   - Login attempt summaries
   - Daily activity breakdown
   - Top IP addresses by activity
   - Failed login attempts by IP

### Exporting Data
1. Apply desired filters
2. Click **Export CSV** button
3. Download will include all filtered data

### Dashboard Widgets
The main admin dashboard now shows:
- **Today's Requests**: Total requests made today
- **Successful Logins**: Successful authentication attempts today
- **Failed Logins**: Failed authentication attempts today
- **Unique IPs Today**: Number of unique IP addresses today

## Security Considerations

### Data Protection
- **No Password Storage**: Passwords are never logged
- **Sensitive Data Filtering**: Credit card numbers, tokens, and other sensitive data are automatically removed
- **IP Privacy**: IP addresses are logged for security but can be anonymized if needed

### Log Integrity
- **Immutable Records**: Log entries cannot be modified once created
- **Sequential Numbering**: Gaps in log IDs indicate potential tampering
- **Backup Recommendations**: Regular database backups are recommended

### Performance
- **Indexed Queries**: Database is optimized with proper indexes
- **Automatic Cleanup**: Use the cleanup command to remove old logs
- **Efficient Filtering**: Queries are optimized for large datasets

## Maintenance

### Cleanup Old Logs
```bash
# Remove logs older than 90 days (default)
php artisan audit:cleanup

# Remove logs older than 30 days
php artisan audit:cleanup --days=30
```

### Monitor Log Size
```sql
-- Check audit log table size
SELECT 
    table_name,
    ROUND(((data_length + index_length) / 1024 / 1024), 2) AS 'Size (MB)'
FROM information_schema.tables 
WHERE table_schema = 'your_database_name' 
AND table_name = 'audit_logs';
```

## Troubleshooting

### Common Issues

1. **High Database Growth**
   - Run the cleanup command regularly
   - Consider archiving old logs to external storage

2. **Performance Issues**
   - Check database indexes
   - Consider pagination for large result sets

3. **Missing Country Data**
   - Check internet connectivity for IP geolocation service
   - Verify firewall settings allow outbound HTTP requests

### Log Levels
- **INFO**: Normal operations (page access, successful logins)
- **WARNING**: Failed logins, suspicious activity
- **ERROR**: System errors, security violations

## API Endpoints

### Statistics API
```
GET /admin/audit-logs/api/statistics?start_date=2024-01-01&end_date=2024-01-31
```

### Failed Logins API
```
GET /admin/audit-logs/api/failed-logins?limit=20&start_date=2024-01-01
```

## Compliance

This audit logging system helps with:
- **Security Compliance**: Track all access and authentication attempts
- **Forensic Analysis**: Detailed logs for security investigations
- **User Activity Monitoring**: Track user behavior and system usage
- **Regulatory Requirements**: Meet audit requirements for sensitive applications

## Support

For technical support or questions about the audit logging system, contact the development team or refer to the Laravel documentation for middleware and model usage.
