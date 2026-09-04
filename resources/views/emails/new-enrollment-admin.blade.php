@php $e = $enrollment; @endphp
<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8"></head>
<body style="margin:0;background:#f1f5f9;font-family:Arial,Helvetica,sans-serif;color:#334155;">
    <div style="max-width:600px;margin:0 auto;padding:24px;">
        <div style="background:#fff;border-radius:16px;padding:28px;border:1px solid #e2e8f0;">
            <h2 style="margin:0 0 16px;color:#0f172a;">New Enrollment #{{ $e->id }}</h2>
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
                <tr><td style="padding:6px 0;color:#64748b;width:40%;">Name</td><td style="padding:6px 0;">{{ $e->first_name }} {{ $e->second_name }} {{ $e->last_name }}</td></tr>
                <tr><td style="padding:6px 0;color:#64748b;">Email</td><td style="padding:6px 0;">{{ $e->email }}</td></tr>
                <tr><td style="padding:6px 0;color:#64748b;">Phone</td><td style="padding:6px 0;">{{ $e->phone }}</td></tr>
                <tr><td style="padding:6px 0;color:#64748b;">Program</td><td style="padding:6px 0;">{{ $e->selected_program }}</td></tr>
                <tr><td style="padding:6px 0;color:#64748b;">Cohort ID</td><td style="padding:6px 0;">{{ $e->program_cohort_id }}</td></tr>
                <tr><td style="padding:6px 0;color:#64748b;">Payment method</td><td style="padding:6px 0;">{{ $e->payment_method }}</td></tr>
                <tr><td style="padding:6px 0;color:#64748b;">Payment status</td><td style="padding:6px 0;">{{ $e->payment_status ?? 'unpaid' }}</td></tr>
                <tr><td style="padding:6px 0;color:#64748b;">Location</td><td style="padding:6px 0;">{{ $e->city }}, {{ $e->country }}</td></tr>
            </table>
            <p style="margin-top:20px;">
                <a href="{{ url('/admin/enrollments/' . $e->id) }}" style="display:inline-block;background:#0f172a;color:#fff;text-decoration:none;padding:10px 20px;border-radius:10px;font-weight:bold;">View in Admin</a>
            </p>
        </div>
    </div>
</body>
</html>
