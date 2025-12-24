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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    @include('components.header')
    
    <main id="main">
        @yield('content')
    </main>
    
    @include('components.footer')
    
    @stack('scripts')
</body>
</html>
