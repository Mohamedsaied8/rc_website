<header
    x-data="{ mobileOpen: false, scrolled: false, scrollProgress: 0 }"
    @scroll.window="
        scrolled = window.scrollY > 20;
        let docHeight = document.documentElement.scrollHeight - window.innerHeight;
        scrollProgress = docHeight > 0 ? (window.scrollY / docHeight) * 100 : 0;
    "
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-500"
    :class="scrolled ? 'bg-[#0A0A0A]/80 backdrop-blur-2xl border-b border-white/[0.06] shadow-2xl shadow-black/20' : 'bg-transparent'"
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
                    <span class="text-white font-semibold text-lg tracking-tight hidden sm:block">
                        Robotics Corner
                    </span>
                @endif
            </a>

            <!-- Desktop Nav -->
            <div class="hidden md:flex items-center gap-1">
                <a href="{{ route('programs.index') }}" class="relative px-4 py-2 text-sm text-slate-400 hover:text-white transition-colors duration-300 rounded-lg hover:bg-white/[0.04]">
                    Programs
                </a>
                <a href="{{ route('about') }}" class="relative px-4 py-2 text-sm text-slate-400 hover:text-white transition-colors duration-300 rounded-lg hover:bg-white/[0.04]">
                    About Us
                </a>
                <a href="{{ route('contact') }}" class="relative px-4 py-2 text-sm text-slate-400 hover:text-white transition-colors duration-300 rounded-lg hover:bg-white/[0.04]">
                    Contact
                </a>
            </div>

            <!-- Desktop CTA + Mobile Toggle -->
            <div class="flex items-center gap-3">
                <a href="{{ route('enroll') }}" class="hidden md:inline-flex items-center px-5 py-2 text-sm font-semibold text-gray-900 bg-gradient-to-r from-cyan-400 to-emerald-400 rounded-lg hover:shadow-lg hover:shadow-cyan-400/20 transition-all duration-300 hover:-translate-y-0.5">
                    Enroll Now
                </a>
                <button
                    @click="mobileOpen = !mobileOpen"
                    class="md:hidden p-2 text-slate-400 hover:text-white transition-colors rounded-lg hover:bg-white/[0.06]"
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
        class="md:hidden overflow-hidden transition-all duration-500 ease-in-out"
        :class="mobileOpen ? 'max-h-80 opacity-100' : 'max-h-0 opacity-0'"
    >
        <div class="px-6 pb-6 pt-2 space-y-1 border-t border-white/[0.06] bg-[#0A0A0A]/95 backdrop-blur-2xl">
            <a href="{{ route('programs.index') }}" @click="mobileOpen = false" class="block px-4 py-3 text-sm text-slate-400 hover:text-white hover:bg-white/[0.04] rounded-lg transition-colors">Programs</a>
            <a href="{{ route('about') }}" @click="mobileOpen = false" class="block px-4 py-3 text-sm text-slate-400 hover:text-white hover:bg-white/[0.04] rounded-lg transition-colors">About Us</a>
            <a href="{{ route('contact') }}" @click="mobileOpen = false" class="block px-4 py-3 text-sm text-slate-400 hover:text-white hover:bg-white/[0.04] rounded-lg transition-colors">Contact</a>
            
            <a href="{{ route('enroll') }}" @click="mobileOpen = false" class="block w-full text-center mt-3 px-5 py-3 text-sm font-semibold text-gray-900 bg-gradient-to-r from-cyan-400 to-emerald-400 rounded-lg">
                Enroll Now
            </a>
        </div>
    </div>
</header>