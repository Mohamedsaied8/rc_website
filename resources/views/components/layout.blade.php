@php
    $siteTitle = 'Robotics Corner';
    $siteTagline = 'Professional robotics and software engineering training programs';
    
    // Check for favicon files in public folder in order of preference
    $siteFavicon = '/images/favicon.ico'; // default
    if (file_exists(public_path('favicon.ico'))) {
        $siteFavicon = '/images/favicon.ico';
    } elseif (file_exists(public_path('favicon.png'))) {
        $siteFavicon = '/images/favicon.png';
    }
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $siteTitle)</title>
    <meta name="color-scheme" content="light dark">
    <meta name="description" content="@yield('description', $siteTagline)">
    <link rel="icon" type="image/x-icon" href="{{ $siteFavicon }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="relative bg-slate-50 min-h-screen overflow-x-hidden text-slate-600">
    @include('components.header')
    
    <main id="main" class="min-h-screen">
        @yield('content')
    </main>
    
    @include('components.footer')
    
    @stack('scripts')

    @if(auth('admin')->check() && request('edit') == '1')
        <div id="cms-save-panel" class="fixed bottom-6 right-6 z-[9999] bg-slate-900 border border-white/20 p-4 rounded-2xl shadow-2xl flex items-center gap-4">
            <span class="text-white font-bold text-sm">Visual Editor Active</span>
            <button id="cms-save-btn" class="px-6 py-2 bg-gradient-to-r from-cyan-400 to-emerald-400 text-slate-900 font-bold rounded-xl hover:shadow-[0_0_15px_rgba(34,211,238,0.4)] transition-all">Save Changes</button>
            <a href="?" class="text-slate-400 hover:text-white text-sm">Exit</a>
        </div>
        
        <script>
            // Pass CSRF token to JS
            window.csrfToken = '{{ csrf_token() }}';
        </script>
        <script src="{{ asset('js/inline-editor.js') }}"></script>
    @endif
</body>
</html>
