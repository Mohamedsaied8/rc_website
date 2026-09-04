@php $m = $contactMessage; @endphp
<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8"></head>
<body style="margin:0;background:#f1f5f9;font-family:Arial,Helvetica,sans-serif;color:#334155;">
    <div style="max-width:600px;margin:0 auto;padding:24px;">
        <div style="background:#fff;border-radius:16px;padding:28px;border:1px solid #e2e8f0;">
            <h2 style="margin:0 0 16px;color:#0f172a;">New Contact Message</h2>
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
                <tr><td style="padding:6px 0;color:#64748b;width:30%;">From</td><td style="padding:6px 0;">{{ $m->name }}</td></tr>
                <tr><td style="padding:6px 0;color:#64748b;">Email</td><td style="padding:6px 0;">{{ $m->email }}</td></tr>
                <tr><td style="padding:6px 0;color:#64748b;">Type</td><td style="padding:6px 0;">{{ $m->type }}</td></tr>
                <tr><td style="padding:6px 0;color:#64748b;">Subject</td><td style="padding:6px 0;">{{ $m->subject }}</td></tr>
            </table>
            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:16px;margin-top:16px;font-size:14px;line-height:1.7;white-space:pre-wrap;">{{ $m->message }}</div>
            <p style="margin-top:20px;">
                <a href="{{ url('/admin/messages/' . $m->id) }}" style="display:inline-block;background:#0f172a;color:#fff;text-decoration:none;padding:10px 20px;border-radius:10px;font-weight:bold;">View in Admin</a>
            </p>
        </div>
    </div>
</body>
</html>
