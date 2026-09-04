@php $e = $enrollment; @endphp
<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head>
<body style="margin:0;background:#f1f5f9;font-family:Arial,Helvetica,sans-serif;color:#334155;">
    <div style="max-width:560px;margin:0 auto;padding:24px;">
        <div style="background:#0f172a;border-radius:16px 16px 0 0;padding:28px;text-align:center;">
            <h1 style="margin:0;color:#fff;font-size:22px;">Application Received</h1>
        </div>
        <div style="background:#fff;border-radius:0 0 16px 16px;padding:28px;">
            <p style="font-size:16px;">Hi {{ $e->first_name }},</p>
            <p style="font-size:15px;line-height:1.6;">
                Thank you for applying to <strong>Robotics Corner</strong>. We've received your application
                @if($e->selected_program)for <strong>{{ $e->selected_program }}</strong>@endif and our team will review it shortly.
            </p>
            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:16px;margin:20px 0;">
                <p style="margin:0 0 8px;font-size:13px;color:#64748b;text-transform:uppercase;letter-spacing:.05em;font-weight:bold;">What happens next</p>
                <p style="margin:0;font-size:14px;line-height:1.7;">
                    1. Our admissions team reviews your application.<br>
                    2. You'll hear back by email or WhatsApp regarding your status.<br>
                    3. Once confirmed, you'll receive final enrollment details.
                </p>
            </div>
            <p style="font-size:14px;color:#64748b;">If you have any questions, just reply to this email.</p>
            <p style="font-size:14px;">— The Robotics Corner Team</p>
        </div>
        <p style="text-align:center;color:#94a3b8;font-size:12px;margin-top:16px;">© {{ date('Y') }} Robotics Corner</p>
    </div>
</body>
</html>
