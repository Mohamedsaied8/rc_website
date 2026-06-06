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
    @include('partials.gtm-head')
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
    @include('partials.gtm-body')
    @include('components.header')

    <main id="main">
        @yield('content')
    </main>

    @include('components.footer')

    {{-- WhatsApp Floating Widget --}}
    <a href="https://wa.me/201111159633" target="_blank" rel="noopener noreferrer" class="whatsapp-float"
        aria-label="Chat on WhatsApp">
        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
            <path fill="currentColor"
                d="M16 0C7.164 0 0 7.164 0 16c0 2.829.737 5.484 2.028 7.785L0 32l8.382-2.003A15.927 15.927 0 0016 32c8.836 0 16-7.164 16-16S24.836 0 16 0zm0 29.467c-2.493 0-4.84-.679-6.847-1.86l-.491-.292-5.104 1.219 1.236-5.021-.32-.508A13.412 13.412 0 012.533 16c0-7.433 6.034-13.467 13.467-13.467S29.467 8.567 29.467 16 23.433 29.467 16 29.467z" />
            <path fill="currentColor"
                d="M23.401 19.188c-.384-.192-2.273-1.121-2.625-1.249-.352-.128-.608-.192-.864.192s-.992 1.249-1.216 1.505c-.224.256-.448.288-.832.096-.384-.192-1.621-.597-3.087-1.904-1.141-.965-1.912-2.157-2.136-2.541-.224-.384-.024-.592.168-.784.173-.173.384-.448.576-.672s.256-.384.384-.64c.128-.256.064-.48-.032-.672-.096-.192-.864-2.08-1.184-2.848-.312-.748-.628-.646-.864-.658-.224-.011-.48-.013-.736-.013s-.672.096-.992.48c-.32.384-1.216 1.121-1.216 2.737s1.216 3.177 1.408 3.433c.192.256 2.784 4.251 6.747 5.964.944.408 1.681.652 2.256.836.948.301 1.808.259 2.488.157.76-.113 2.273-.929 2.593-1.825.32-.896.32-1.664.224-1.825-.096-.173-.352-.277-.736-.469z" />
        </svg>
    </a>

    <style>
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 30px;
            right: 30px;
            background-color: #25D366;
            color: #FFF;
            border-radius: 50%;
            text-align: center;
            font-size: 30px;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .whatsapp-float:hover {
            background-color: #128C7E;
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.6);
        }

        .whatsapp-float svg {
            width: 32px;
            height: 32px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .whatsapp-float {
                width: 50px;
                height: 50px;
                bottom: 20px;
                right: 20px;
            }

            .whatsapp-float svg {
                width: 26px;
                height: 26px;
            }
        }

        /* Animation on page load */
        @keyframes whatsapp-pulse {
            0% {
                box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
            }

            50% {
                box-shadow: 0 4px 12px rgba(37, 211, 102, 0.7), 0 0 0 10px rgba(37, 211, 102, 0.2);
            }

            100% {
                box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
            }
        }

        .whatsapp-float {
            animation: whatsapp-pulse 2s infinite;
        }
    </style>

    @stack('scripts')
</body>

</html>