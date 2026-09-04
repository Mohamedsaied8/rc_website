<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Robotics Corner</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Fonts (kept in step with components/layout.blade.php) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Inter+Tight:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Vite (Tailwind + Alpine) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="relative bg-[#0A0A0A] min-h-screen text-slate-300 font-sans selection:bg-cyan-500/30 overflow-x-hidden">
    
    <!-- Background Accents -->
    <div class="fixed inset-0 z-[-1] bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-slate-900 via-[#0A0A0A] to-[#0A0A0A]"></div>
    <div class="fixed inset-0 z-[-1] bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wMykiLz48L3N2Zz4=')] opacity-50 mask-image-gradient-b"></div>

    @if(!request()->routeIs('admin.login'))
    <div x-data="{ sidebarOpen: false }" class="flex min-h-screen">
        
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-black/80 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false" style="display: none;"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-950/80 backdrop-blur-2xl border-r border-white/10 transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-auto lg:flex lg:w-64 lg:flex-col">
            
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between px-6 py-5 border-b border-white/10">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    @if(file_exists(public_path('images/logo.png')))
                        <img src="{{ asset('images/logo.png') }}" alt="Robotics Corner Logo" class="h-8 object-contain">
                    @else
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-cyan-400 to-emerald-400 flex items-center justify-center text-gray-900 font-bold text-lg">RC</div>
                        <span class="text-white font-bold text-lg tracking-tight">Admin<span class="text-cyan-400">Panel</span></span>
                    @endif
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Sidebar Navigation -->
            <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1">
                @php
                    // Community blog submissions awaiting review — surfaced as a badge so an
                    // admin sees the queue without opening the page.
                    $blogPendingCount = \App\Models\BlogPost::pending()->count();

                    $navItems = [
                        ['route' => 'admin.dashboard', 'icon' => 'fa-solid fa-chart-line', 'label' => 'Dashboard', 'pattern' => 'admin.dashboard'],
                        ['route' => 'admin.pages.index', 'icon' => 'fa-solid fa-file-lines', 'label' => 'Pages', 'pattern' => 'admin.pages.*'],
                        ['route' => 'admin.courses.index', 'icon' => 'fa-solid fa-book', 'label' => 'Courses', 'pattern' => 'admin.courses.*'],
                        ['route' => 'admin.programs.index', 'icon' => 'fa-solid fa-graduation-cap', 'label' => 'Programs', 'pattern' => 'admin.programs.*'],
                        ['route' => 'admin.enrollments.index', 'icon' => 'fa-solid fa-user-graduate', 'label' => 'Enrollments', 'pattern' => 'admin.enrollments.*'],
                        ['route' => 'admin.messages.index', 'icon' => 'fa-solid fa-envelope', 'label' => 'Messages', 'pattern' => 'admin.messages.*'],
                        ['route' => 'admin.blog.index', 'icon' => 'fa-solid fa-newspaper', 'label' => 'Blog', 'pattern' => 'admin.blog.*'],
                        ['route' => 'admin.settings.index', 'icon' => 'fa-solid fa-gear', 'label' => 'Settings', 'pattern' => 'admin.settings.*'],
                        ['route' => 'admin.file-manager.index', 'icon' => 'fa-solid fa-folder-open', 'label' => 'File Manager', 'pattern' => 'admin.file-manager.*'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs($item['pattern']) ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/20' : 'text-slate-400 hover:bg-white/[0.04] hover:text-white' }}">
                        <i class="{{ $item['icon'] }} w-5 text-center transition-transform group-hover:scale-110"></i>
                        <span class="font-medium">{{ $item['label'] }}</span>
                        @if($item['label'] === 'Blog' && $blogPendingCount > 0)
                            <span class="ml-auto min-w-[1.25rem] h-5 px-1.5 rounded-full bg-amber-500/20 border border-amber-500/30 text-amber-300 text-[11px] font-bold flex items-center justify-center">{{ $blogPendingCount }}</span>
                        @endif
                    </a>
                @endforeach
            </div>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-white/10">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-white/[0.04] hover:text-white transition-all duration-200 group mb-2">
                    <i class="fa-solid fa-globe w-5 text-center transition-transform group-hover:scale-110"></i>
                    <span class="font-medium">View Live Site</span>
                </a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-all duration-200 group">
                        <i class="fa-solid fa-sign-out-alt w-5 text-center transition-transform group-hover:scale-110"></i>
                        <span class="font-medium">Sign Out</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            
            <!-- Topbar -->
            <header class="sticky top-0 z-10 bg-slate-950/50 backdrop-blur-xl border-b border-white/10 px-6 py-4 flex items-center justify-between lg:justify-end shadow-sm">
                <button @click="sidebarOpen = true" class="lg:hidden text-slate-300 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                
                <div class="flex items-center gap-4">
                    <div class="hidden md:flex flex-col text-right mr-2">
                        <span class="text-sm font-semibold text-white">{{ Auth::guard('admin')->user()->name ?? 'Administrator' }}</span>
                        <span class="text-xs text-cyan-400">System Admin</span>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-cyan-400 to-emerald-400 p-[2px]">
                        <div class="w-full h-full rounded-full bg-slate-900 flex items-center justify-center">
                            <i class="fa-solid fa-user text-cyan-400"></i>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-6 md:p-8">
                
                <!-- Page Header -->
                <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-white tracking-tight">@yield('page-title', 'Dashboard')</h2>
                        @hasSection('page-subtitle')
                            <p class="text-slate-400 mt-1 text-sm">@yield('page-subtitle')</p>
                        @endif
                    </div>
                    <div>
                        @yield('page-actions')
                    </div>
                </div>

                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center gap-3">
                        <i class="fa-solid fa-circle-check text-xl"></i>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 flex items-center gap-3">
                        <i class="fa-solid fa-circle-exclamation text-xl"></i>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Content Slot -->
                @yield('content')
                
            </main>
        </div>
    </div>
    @else
        <!-- Render full screen content for Auth pages -->
        @yield('content')
    @endif

    @stack('scripts')
</body>
</html>
