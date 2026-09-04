@php
    $navUser = auth()->user();
    $navInitials = $navUser
        ? collect(explode(' ', trim($navUser->name)))->filter()->take(2)->map(fn ($p) => mb_strtoupper(mb_substr($p, 0, 1)))->implode('')
        : '';
@endphp
<header
    x-data="{ mobileOpen: false, scrolled: false, scrollProgress: 0 }"
    @scroll.window="
        scrolled = window.scrollY > 20;
        let docHeight = document.documentElement.scrollHeight - window.innerHeight;
        scrollProgress = docHeight > 0 ? (window.scrollY / docHeight) * 100 : 0;
    "
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-500"
    :class="scrolled ? 'bg-white/80 backdrop-blur-2xl border-b border-slate-200 shadow-xl shadow-slate-200/50' : 'bg-transparent'"
>
    <!-- Scroll Progress Bar -->
    <div
        class="scroll-progress h-1 bg-gradient-to-r from-cyan-400 to-emerald-400 fixed top-0 left-0 z-50 transition-all duration-100"
        :style="`width: ${scrollProgress}%`"
    ></div>

    <nav class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-18 py-4">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ asset('images/logo.png') }}" alt="Robotics Corner" class="h-9 object-contain group-hover:scale-105 transition-transform duration-300">
                @else
                    <div class="relative w-9 h-9 rounded-lg bg-gradient-to-br from-cyan-400 to-emerald-400 flex items-center justify-center font-bold text-gray-900 text-sm tracking-tight transition-transform duration-300 group-hover:scale-110">
                        RC
                        <div class="absolute inset-0 rounded-lg bg-gradient-to-br from-cyan-400 to-emerald-400 opacity-0 blur-xl group-hover:opacity-40 transition-opacity duration-500"></div>
                    </div>
                    <span class="font-display text-slate-900 font-bold text-xl tracking-tight hidden sm:block">
                        {{ cms('global.header.site_name', 'Robotics Corner') }}
                    </span>
                @endif
            </a>

            <!-- Desktop Nav -->
            <div class="hidden md:flex items-center gap-1 p-1 bg-white/60 border border-slate-200 rounded-xl backdrop-blur-md shadow-sm">
                <a href="{{ route('home') }}" class="relative px-4 py-2 text-sm font-semibold transition-all duration-300 rounded-lg {{ request()->routeIs('home') ? 'text-cyan-700 bg-cyan-50 border border-cyan-100' : 'text-slate-600 hover:text-cyan-600 hover:bg-slate-100' }}">
                    {{ cms('global.header.nav_home', 'Home') }}
                </a>
                <a href="{{ route('services.index') }}" class="relative px-4 py-2 text-sm font-semibold transition-all duration-300 rounded-lg {{ request()->routeIs('services.*') ? 'text-cyan-700 bg-cyan-50 border border-cyan-100' : 'text-slate-600 hover:text-cyan-600 hover:bg-slate-100' }}">
                    {{ cms('global.header.nav_services', 'Services') }}
                </a>
                <a href="{{ route('products.index') }}" class="relative px-4 py-2 text-sm font-semibold transition-all duration-300 rounded-lg {{ request()->routeIs('products.*') ? 'text-cyan-700 bg-cyan-50 border border-cyan-100' : 'text-slate-600 hover:text-cyan-600 hover:bg-slate-100' }}">
                    {{ cms('global.header.nav_products', 'Products') }}
                </a>
                <a href="{{ route('blog.index') }}" class="relative px-4 py-2 text-sm font-semibold transition-all duration-300 rounded-lg {{ request()->routeIs('blog.*') ? 'text-cyan-700 bg-cyan-50 border border-cyan-100' : 'text-slate-600 hover:text-cyan-600 hover:bg-slate-100' }}">
                    {{ cms('global.header.nav_blog', 'Blog') }}
                </a>
                <a href="{{ route('about') }}" class="relative px-4 py-2 text-sm font-semibold transition-all duration-300 rounded-lg {{ request()->routeIs('about') ? 'text-cyan-700 bg-cyan-50 border border-cyan-100' : 'text-slate-600 hover:text-cyan-600 hover:bg-slate-100' }}">
                    {{ cms('global.header.nav_about', 'About') }}
                </a>
                <a href="{{ route('contact') }}" class="relative px-4 py-2 text-sm font-semibold transition-all duration-300 rounded-lg {{ request()->routeIs('contact') ? 'text-cyan-700 bg-cyan-50 border border-cyan-100' : 'text-slate-600 hover:text-cyan-600 hover:bg-slate-100' }}">
                    {{ cms('global.header.nav_contact', 'Contact') }}
                </a>
            </div>

            <!-- Desktop CTA + Mobile Toggle -->
            <div class="flex items-center gap-2 lg:gap-3 flex-nowrap">
                <a href="{{ route('freelance') }}" target="_blank" rel="noopener noreferrer" aria-label="Get your freelance job" title="Get your freelance job" class="inline-flex items-center gap-2 px-2.5 py-2 lg:px-4 whitespace-nowrap shrink-0 text-sm font-bold text-white bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg shadow-md shadow-purple-500/20 hover:shadow-lg hover:shadow-purple-500/30 hover:-translate-y-0.5 transition-all duration-300 group">
                    <i class="fa-solid fa-bolt text-pink-200 group-hover:animate-pulse"></i>
                    <span class="hidden 2xl:inline">{{ cms('global.header.btn_freelance', 'Get your freelance job') }}</span>
                    <span class="hidden lg:inline 2xl:hidden">Freelance</span>
                </a>
                <a href="/connectedlabs" target="_blank" rel="noopener noreferrer" aria-label="Connected Labs" title="Connected Labs" class="inline-flex items-center gap-2 px-2.5 py-2 lg:px-4 whitespace-nowrap shrink-0 text-sm font-bold text-cyan-700 bg-cyan-50 border border-cyan-200 rounded-lg hover:bg-cyan-100 hover:-translate-y-0.5 transition-all duration-300 group">
                    <i class="fa-solid fa-flask text-cyan-500 group-hover:rotate-12 transition-transform"></i> <span class="hidden xl:inline">{{ cms('global.header.btn_connected_labs', 'Connected Labs') }}</span>
                </a>
                {{-- Authentication state (desktop) --}}
                @auth
                    <div x-data="{ accountOpen: false }" class="relative hidden md:block shrink-0">
                        <button
                            @click="accountOpen = !accountOpen"
                            @click.outside="accountOpen = false"
                            class="flex items-center gap-2 pl-1.5 pr-2.5 py-1.5 rounded-lg border border-slate-200 bg-white/60 hover:bg-slate-100 transition-colors"
                        >
                            <span class="w-7 h-7 rounded-md bg-gradient-to-br from-cyan-400 to-emerald-400 flex items-center justify-center text-xs font-bold text-gray-900">{{ $navInitials ?: 'U' }}</span>
                            <span class="text-sm font-semibold text-slate-700 max-w-[7rem] truncate">{{ $navUser->name }}</span>
                            <svg class="w-4 h-4 text-slate-400 transition-transform" :class="accountOpen && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div
                            x-show="accountOpen" x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="absolute right-0 mt-2 w-56 bg-white border border-slate-200 rounded-xl shadow-xl shadow-slate-200/60 py-1.5 z-50"
                        >
                            <div class="px-4 py-2.5 border-b border-slate-100">
                                <p class="text-sm font-semibold text-slate-900 truncate">{{ $navUser->name }}</p>
                                <p class="text-xs text-slate-500 truncate">{{ $navUser->email }}</p>
                            </div>
                            <a href="{{ route('profile') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors">
                                <i class="fa-solid fa-user text-slate-400 w-4 text-center"></i> My Account
                            </a>
                            <a href="{{ route('blog.create') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors">
                                <i class="fa-solid fa-feather text-slate-400 w-4 text-center"></i> Write a post
                            </a>
                            <a href="{{ route('blog.mine') }}" class="flex items-center gap-2.5 px-4 py-2.5 mb-1 pb-2.5 border-b border-slate-100 text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors">
                                <i class="fa-solid fa-list-check text-slate-400 w-4 text-center"></i> My posts
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 transition-colors">
                                    <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center"></i> Log out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="hidden md:inline-flex items-center gap-2 shrink-0 whitespace-nowrap px-4 py-2 text-sm font-bold text-slate-700 bg-white/60 border border-slate-200 rounded-lg hover:bg-slate-100 hover:-translate-y-0.5 transition-all duration-300">
                        <i class="fa-solid fa-right-to-bracket text-cyan-500"></i> Sign In
                    </a>
                @endauth

                <button
                    @click="mobileOpen = !mobileOpen"
                    class="md:hidden p-2 text-slate-600 hover:text-slate-900 transition-colors rounded-lg hover:bg-slate-100"
                    aria-label="Toggle menu"
                >
                    <svg x-show="!mobileOpen" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
                    <svg x-show="mobileOpen" x-cloak xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div
        class="md:hidden overflow-hidden transition-all duration-500 ease-in-out shadow-lg"
        :class="mobileOpen ? 'max-h-[600px] opacity-100' : 'max-h-0 opacity-0'"
    >
        <div class="px-6 pb-6 pt-2 space-y-1 border-t border-slate-200 bg-white/95 backdrop-blur-2xl">
            <a href="{{ route('home') }}" @click="mobileOpen = false" class="block px-4 py-3 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('home') ? 'text-cyan-700 bg-cyan-50 border border-cyan-100' : 'text-slate-600 hover:text-cyan-600 hover:bg-slate-100' }}">{{ cms('global.header.nav_home', 'Home') }}</a>
            <a href="{{ route('services.index') }}" @click="mobileOpen = false" class="block px-4 py-3 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('services.*') ? 'text-cyan-700 bg-cyan-50 border border-cyan-100' : 'text-slate-600 hover:text-cyan-600 hover:bg-slate-100' }}">{{ cms('global.header.nav_services', 'Services') }}</a>
            <a href="{{ route('products.index') }}" @click="mobileOpen = false" class="block px-4 py-3 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('products.*') ? 'text-cyan-700 bg-cyan-50 border border-cyan-100' : 'text-slate-600 hover:text-cyan-600 hover:bg-slate-100' }}">{{ cms('global.header.nav_products', 'Products') }}</a>
            <a href="{{ route('blog.index') }}" @click="mobileOpen = false" class="block px-4 py-3 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('blog.*') ? 'text-cyan-700 bg-cyan-50 border border-cyan-100' : 'text-slate-600 hover:text-cyan-600 hover:bg-slate-100' }}">{{ cms('global.header.nav_blog', 'Blog') }}</a>
            <a href="{{ route('about') }}" @click="mobileOpen = false" class="block px-4 py-3 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('about') ? 'text-cyan-700 bg-cyan-50 border border-cyan-100' : 'text-slate-600 hover:text-cyan-600 hover:bg-slate-100' }}">{{ cms('global.header.nav_about', 'About') }}</a>
            <a href="{{ route('contact') }}" @click="mobileOpen = false" class="block px-4 py-3 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('contact') ? 'text-cyan-700 bg-cyan-50 border border-cyan-100' : 'text-slate-600 hover:text-cyan-600 hover:bg-slate-100' }}">{{ cms('global.header.nav_contact', 'Contact') }}</a>
            
            <div class="h-px bg-slate-200 my-4"></div>
            
            <a href="{{ route('freelance') }}" target="_blank" @click="mobileOpen = false" class="flex items-center justify-center gap-2 w-full px-4 py-3 text-sm font-bold text-white bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg shadow-md">{{ cms('global.header.btn_freelance', 'Get your freelance job') }} <i class="fa-solid fa-bolt text-pink-200"></i></a>
            <a href="/connectedlabs" target="_blank" rel="noopener noreferrer" @click="mobileOpen = false" class="flex items-center justify-center gap-2 w-full mt-3 px-4 py-3 text-sm font-bold text-cyan-700 bg-cyan-50 border border-cyan-200 rounded-lg"><i class="fa-solid fa-flask text-cyan-500"></i> {{ cms('global.header.btn_connected_labs', 'Connected Labs') }}</a>

            {{-- Authentication state (mobile) --}}
            <div class="h-px bg-slate-200 my-4"></div>
            @auth
                <a href="{{ route('profile') }}" @click="mobileOpen = false" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-slate-50 border border-slate-200">
                    <span class="w-9 h-9 rounded-md bg-gradient-to-br from-cyan-400 to-emerald-400 flex items-center justify-center text-sm font-bold text-gray-900">{{ $navInitials ?: 'U' }}</span>
                    <span class="flex flex-col min-w-0">
                        <span class="text-sm font-semibold text-slate-900 truncate">{{ $navUser->name }}</span>
                        <span class="text-xs text-slate-500">My Account</span>
                    </span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="flex items-center justify-center gap-2 w-full px-4 py-3 text-sm font-bold text-red-600 bg-red-50 border border-red-100 rounded-lg">
                        Log out <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" @click="mobileOpen = false" class="flex items-center justify-center gap-2 w-full px-4 py-3 text-sm font-bold text-slate-700 bg-white border border-slate-200 rounded-lg">
                    <i class="fa-solid fa-right-to-bracket text-cyan-500"></i> Sign In
                </a>
            @endauth
        </div>
    </div>
</header>