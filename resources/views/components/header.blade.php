@php
    $siteTitle = 'Robotics Corner';

    // Check for logo files in public/images in order of preference
    $siteLogo = '/images/logo.png'; // default
    if (file_exists(public_path('images/logo.png'))) {
        $siteLogo = '/images/logo.png';
    } elseif (file_exists(public_path('images/logo.jpg'))) {
        $siteLogo = '/images/logo.jpg';
    } elseif (file_exists(public_path('images/logo.svg'))) {
        $siteLogo = '/images/logo.svg';
    }
@endphp

<header class="header">
    <nav class="nav">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ $siteLogo }}" alt="{{ $siteTitle }}" class="logo-img"
                style="height: 40px; margin-right: 10px;">
            <!-- {{ $siteTitle }} -->
        </a>
        <ul class="nav-links" id="nav-links">
            <li><a href="{{ route('programs.index') }}">Programs</a></li>

            <li><a href="{{ route('about') }}">About Us</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
        <div class="nav-actions">
            <a href="{{ route('enroll') }}" class="btn-primary">Enroll Now</a>
            <button class="theme-toggle" aria-label="Toggle theme">🌙</button>
            <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Toggle menu">☰</button>
        </div>
    </nav>
</header>

<!-- Skip Link for Accessibility -->
<a href="#main" class="skip-link">Skip to main content</a>

<!-- Scroll Progress Bar -->
<div class="scroll-progress"></div>

<!-- Back to Top Button -->
<button class="back-to-top" aria-label="Back to top">↑</button>