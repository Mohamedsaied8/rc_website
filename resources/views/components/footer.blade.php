<footer class="border-t border-white/10 bg-[#0A0A0A] relative z-20">
    <div class="mx-auto max-w-7xl px-6 py-16">
        <div class="grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Column 1 — Brand -->
            <div>
                <div class="mb-4 h-1 w-12 rounded-full bg-gradient-to-r from-cyan-400 to-emerald-400"></div>
                <h3 class="text-xl font-bold text-white">Robotics Corner</h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-400">
                    Empowering engineers with cutting-edge robotics and software
                    engineering skills.
                </p>

                <div class="mt-6 flex flex-wrap gap-2">
                    <a href="#" class="inline-flex items-center gap-1.5 rounded-full bg-white/5 px-3 py-1.5 text-xs text-slate-400 transition-colors hover:bg-white/10 hover:text-white"><span>📘</span>Facebook</a>
                    <a href="#" class="inline-flex items-center gap-1.5 rounded-full bg-white/5 px-3 py-1.5 text-xs text-slate-400 transition-colors hover:bg-white/10 hover:text-white"><span>🐦</span>Twitter</a>
                    <a href="#" class="inline-flex items-center gap-1.5 rounded-full bg-white/5 px-3 py-1.5 text-xs text-slate-400 transition-colors hover:bg-white/10 hover:text-white"><span>💼</span>LinkedIn</a>
                    <a href="#" class="inline-flex items-center gap-1.5 rounded-full bg-white/5 px-3 py-1.5 text-xs text-slate-400 transition-colors hover:bg-white/10 hover:text-white"><span>📺</span>YouTube</a>
                </div>
            </div>

            <!-- Column 2 — Programs -->
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-wider text-white">
                    Programs
                </h4>
                <ul class="mt-4 space-y-3">
                    <li><a href="{{ route('programs.show', 'software-engineering') }}" class="text-sm text-slate-400 transition-colors hover:text-cyan-400">Software Engineering</a></li>
                    <li><a href="{{ route('programs.show', 'robotics') }}" class="text-sm text-slate-400 transition-colors hover:text-cyan-400">Robotics for Professionals</a></li>
                    <li><a href="{{ route('programs.show', 'embedded-systems') }}" class="text-sm text-slate-400 transition-colors hover:text-cyan-400">Embedded Systems</a></li>
                </ul>
            </div>

            <!-- Column 3 — Contact -->
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-wider text-white">
                    Contact
                </h4>
                <ul class="mt-4 space-y-3">
                    <li class="text-sm text-slate-400"><span class="mr-2">📧</span>info@roboticscorner.tech</li>
                    <li class="text-sm text-slate-400"><span class="mr-2">📱</span>+20 111 115 9633</li>
                    <li class="text-sm text-slate-400"><span class="mr-2">📍</span>Cairo, Egypt</li>
                </ul>
            </div>
        </div>

        <div class="mt-12 flex flex-col items-center justify-between gap-4 border-t border-white/5 pt-8 sm:flex-row">
            <p class="text-xs text-slate-600">
                © {{ date('Y') }} Robotics Corner. All rights reserved.
            </p>
            <div class="flex items-center gap-3 text-xs text-slate-600">
                <a href="#" class="transition-colors hover:text-slate-400">Privacy Policy</a>
                <span>·</span>
                <a href="#" class="transition-colors hover:text-slate-400">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>