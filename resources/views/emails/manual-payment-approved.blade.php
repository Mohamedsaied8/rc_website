@php $p = $manualPayment; $e = $p->enrollment; @endphp
<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head>
<body style="margin:0;background:#f1f5f9;font-family:Arial,Helvetica,sans-serif;color:#334155;">
    <div style="max-width:560px;margin:0 auto;padding:24px;">
        <div style="background:#0f172a;border-radius:16px 16px 0 0;padding:28px;text-align:center;">
            <h1 style="margin:0;color:#fff;font-size:22px;">Payment Confirmed</h1>
        </div>
        <div style="background:#fff;border-radius:0 0 16px 16px;padding:28px;">
            <p style="font-size:16px;">Hi {{ $e->first_name }},</p>
            <p style="font-size:15px;line-height:1.6;">
                Good news — we've verified your transfer and your payment
                @if($e->selected_program)for <strong>{{ $e->selected_program }}</strong>@endif is confirmed.
            </p>
            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:16px;margin:20px 0;">
                <p style="margin:0 0 8px;font-size:13px;color:#64748b;text-transform:uppercase;letter-spacing:.05em;font-weight:bold;">Payment details</p>
                <p style="margin:0;font-size:14px;line-height:1.7;">
                    Amount: <strong>{{ $p->currency }} {{ number_format((float) $p->amount, 2) }}</strong><br>
                    Reference: <strong>{{ $p->reference_number }}</strong><br>
                    Method: <strong>{{ $p->method === 'instapay' ? 'InstaPay' : 'Mobile Wallet' }}</strong>
                </p>
            </div>
            <p style="font-size:15px;line-height:1.6;">Your spot is secured. Our team will be in touch with the next steps for your program.</p>
            <p style="font-size:14px;color:#64748b;">If you have any questions, just reply to this email.</p>
            <p style="font-size:14px;">— The Robotics Corner Team</p>
        </div>
        <p style="text-align:center;color:#94a3b8;font-size:12px;margin-top:16px;">© {{ date('Y') }} Robotics Corner</p>
    </div>
</body>
</html>
