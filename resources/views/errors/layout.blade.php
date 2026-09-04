<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('message', 'Error') · Robotics Corner</title>
    <meta name="robots" content="noindex">
    {{-- Was referencing Inter without ever loading it. display=swap keeps the page
         readable if fonts.googleapis.com is unreachable during an outage. --}}
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@800&family=Inter+Tight:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Inter Tight',ui-sans-serif,-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;background:#f8fafc;color:#334155;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:1.5rem}
        .wrap{max-width:34rem;text-align:center}
        .code{font-family:'Sora',ui-sans-serif,system-ui,sans-serif;font-size:7rem;line-height:1;font-weight:800;letter-spacing:-.03em;background:linear-gradient(90deg,#06b6d4,#2563eb);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:.5rem}
        h1{font-family:'Sora',ui-sans-serif,system-ui,sans-serif;font-size:2rem;font-weight:800;letter-spacing:-.02em;color:#0f172a;margin-bottom:1rem}
        p{font-size:1.05rem;color:#64748b;margin-bottom:2.25rem;line-height:1.6}
        .actions{display:flex;flex-wrap:wrap;gap:1rem;justify-content:center}
        a{display:inline-flex;align-items:center;gap:.5rem;padding:.9rem 1.75rem;font-weight:700;border-radius:.75rem;text-decoration:none;transition:all .2s}
        .primary{background:#0f172a;color:#fff}
        .primary:hover{background:#1e293b}
        .secondary{background:#fff;color:#334155;border:1px solid #e2e8f0}
        .secondary:hover{border-color:#67e8f9;color:#0e7490}
    </style>
</head>
<body>
    <div class="wrap">
        <div class="code">{{ $code ?? '' }}</div>
        <h1>@yield('message', 'Something went wrong')</h1>
        <p>@yield('detail', 'The page you are looking for could not be found or is unavailable.')</p>
        <div class="actions">
            <a class="primary" href="{{ url('/') }}">Back to Home</a>
            <a class="secondary" href="{{ url('/contact') }}">Contact Us</a>
        </div>
    </div>
</body>
</html>
