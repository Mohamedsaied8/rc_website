@php
    $siteTitle = 'Robotics Corner';
    $siteTagline = 'Professional robotics and software engineering training programs';

    // Favicon: prefer a real file in public/, else fall back to the shipped one.
    $siteFavicon = '/images/favicon.ico';
    if (file_exists(public_path('favicon.ico'))) {
        $siteFavicon = '/favicon.ico';
    } elseif (file_exists(public_path('favicon.png'))) {
        $siteFavicon = '/favicon.png';
    }

    $metaTitle = trim($__env->yieldContent('title', $siteTitle));
    $metaDescription = trim($__env->yieldContent('description', $siteTagline));
    $ogImage = asset(file_exists(public_path('images/og-image.png')) ? 'images/og-image.png' : 'images/logo.png');
    $canonical = url()->current();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Flag JS as available before paint so scroll-reveal content is hidden only when it can actually be revealed (no-JS users see everything). --}}
    <script>document.documentElement.classList.add('js');</script>

    {{-- Google Tag Manager --}}
    @include('partials.gtm-head')

    <title>@yield('title', $siteTitle)</title>
    <meta name="color-scheme" content="light dark">
    <meta name="description" content="{{ $metaDescription }}">
    <link rel="canonical" href="{{ $canonical }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteTitle }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $ogImage }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    <link rel="icon" type="image/x-icon" href="{{ $siteFavicon }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Inter+Tight:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="relative bg-slate-50 min-h-screen overflow-x-hidden text-slate-600">
    {{-- Google Tag Manager (noscript) --}}
    @include('partials.gtm-body')

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
