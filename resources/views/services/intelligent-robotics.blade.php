@extends('components.layout')

@section('title', $departmentTitle . ' - Corporate Services')

@section('content')
    <!-- ===== SECTION 1: CINEMATIC HERO ===== -->
    <section class="relative min-h-[90vh] flex items-center overflow-hidden pt-24 pb-16">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_30%_20%,_var(--tw-gradient-stops))] from-cyan-200/40 via-slate-50 to-slate-50"></div>
            <div class="absolute top-1/4 -left-32 w-[600px] h-[600px] bg-cyan-400/20 rounded-full blur-[160px] animate-pulse-glow"></div>
            <div class="absolute bottom-1/4 -right-32 w-[500px] h-[500px] bg-blue-500/15 rounded-full blur-[140px] animate-pulse-glow" style="animation-delay: 1.5s;"></div>
            <div class="absolute top-1/3 right-1/4 w-2 h-2 bg-cyan-400 rounded-full animate-ping"></div>
            <div class="absolute bottom-1/3 left-1/4 w-1.5 h-1.5 bg-blue-400 rounded-full animate-ping" style="animation-delay: 0.5s"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/80 border border-cyan-200 shadow-sm mb-8 animate-fade-in-up">
                <span class="w-2 h-2 rounded-full bg-cyan-500 animate-pulse"></span>
                <span class="text-xs font-bold text-cyan-700 tracking-wider uppercase">Third-Party Software Intelligence</span>
            </div>

            <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 tracking-tight leading-[1.05] mb-8 animate-fade-in-up" style="animation-delay: 100ms;">
                Intelligent <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 via-blue-600 to-indigo-600">Robotics</span>
                <span class="block text-3xl md:text-4xl font-bold text-slate-700 mt-4">Software Intelligence &amp; Optimization Division</span>
            </h1>

            <p class="text-xl md:text-2xl text-slate-600 max-w-3xl mx-auto leading-relaxed font-medium mb-12 animate-fade-in-up" style="animation-delay: 200ms;">
                We don't manufacture robots. We develop the <span class="text-cyan-700 font-bold">missing software layer</span> that makes them flexible, efficient, adaptive, and intelligent.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in-up" style="animation-delay: 300ms;">
                <a href="{{ route('contact') }}" class="group inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold rounded-xl shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 hover:-translate-y-1 transition-all duration-300">
                    <span>Partner With Us</span>
                    <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="#capabilities" class="group inline-flex items-center gap-2 px-8 py-4 bg-white border border-slate-300 text-slate-700 font-bold rounded-xl hover:bg-slate-50 hover:-translate-y-1 transition-all duration-300">
                    <span>Explore Capabilities</span>
                    <i class="fa-solid fa-chevron-down text-sm group-hover:translate-y-0.5 transition-transform"></i>
                </a>
            </div>

            <!-- Floating Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-3xl mx-auto mt-20 animate-fade-in-up" style="animation-delay: 400ms;">
                <div class="text-center">
                    <div class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-blue-600">100%</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider font-bold mt-1">Software Focus</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-extrabold text-slate-900">6</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider font-bold mt-1">Core Capabilities</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-extrabold text-slate-900">∞</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider font-bold mt-1">Vendor Agnostic</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-extrabold text-slate-900">4</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wider font-bold mt-1">Pipeline Stages</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SECTION 2: THE MISSING SOFTWARE LAYER ===== -->
    <section class="relative z-10 bg-white border-y border-slate-200 py-12 md:py-28">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <div class="space-y-8 reveal-on-scroll">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-cyan-50 border border-cyan-200 text-xs font-bold text-cyan-700 uppercase tracking-wider">
                        <i class="fa-solid fa-brain text-cyan-500"></i> The Missing Software Layer
                    </div>
                    <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight leading-[1.15]">
                        We Architect the <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-blue-600">Digital Intelligence</span> of Robotics
                    </h2>
                    <p class="text-lg text-slate-600 leading-relaxed">
                        We position our Robotics Sector Department as a specialized provider of <strong class="text-slate-900">third-party software and optimization solutions</strong> for robotics applications. Our main focus is not to manufacture robot hardware, but to develop the software intelligence that allows robots to become more flexible, efficient, adaptive, and useful in real industrial, educational, and research environments.
                    </p>
                    <p class="text-lg text-slate-600 leading-relaxed">
                        We work as a <strong class="text-slate-900">software partner</strong> for companies that already own robotic systems, plan to integrate robots, or need customized software to improve the performance of their automation processes.
                    </p>
                    <div class="flex flex-wrap gap-6 pt-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-cyan-50 border border-cyan-200 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-check text-cyan-600"></i>
                            </div>
                            <span class="text-sm font-semibold text-slate-700">Vendor Agnostic</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-cyan-50 border border-cyan-200 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-check text-cyan-600"></i>
                            </div>
                            <span class="text-sm font-semibold text-slate-700">Production-Ready</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-cyan-50 border border-cyan-200 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-check text-cyan-600"></i>
                            </div>
                            <span class="text-sm font-semibold text-slate-700">Science-Backed</span>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Animated Architecture Visualization -->
                <div class="relative reveal-on-scroll" data-delay="200">
                    <div class="absolute -inset-4 bg-gradient-to-br from-cyan-500/10 via-blue-500/5 to-transparent rounded-3xl blur-2xl"></div>
                    <div class="relative bg-white border border-slate-200 rounded-3xl shadow-2xl overflow-hidden p-8">
                        <div class="text-center mb-6">
                            <span class="text-xs font-bold text-cyan-700 uppercase tracking-widest">Our Service Model</span>
                        </div>
                        <svg viewBox="-10 0 420 320" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                            <defs>
                                <linearGradient id="gCyan" x1="0" y1="0" x2="1" y2="1">
                                    <stop offset="0%" stop-color="#06b6d4"/>
                                    <stop offset="100%" stop-color="#0891b2"/>
                                </linearGradient>
                                <linearGradient id="gBlue" x1="0" y1="0" x2="1" y2="1">
                                    <stop offset="0%" stop-color="#3b82f6"/>
                                    <stop offset="100%" stop-color="#2563eb"/>
                                </linearGradient>
                                <linearGradient id="gEmerald" x1="0" y1="0" x2="1" y2="1">
                                    <stop offset="0%" stop-color="#10b981"/>
                                    <stop offset="100%" stop-color="#059669"/>
                                </linearGradient>
                                <filter id="glow">
                                    <feGaussianBlur stdDeviation="3" result="blur"/>
                                    <feMerge><feMergeNode in="blur"/><feMergeNode in="SourceGraphic"/></feMerge>
                                </filter>
                            </defs>

                            <!-- Background grid dots -->
                            <pattern id="dots" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                <circle cx="2" cy="2" r="1" fill="#e2e8f0"/>
                            </pattern>
                            <rect width="400" height="320" fill="url(#dots)" opacity="0.5"/>

                            <!-- Connection lines -->
                            <style>
                                @keyframes dataFlow {
                                    from { stroke-dashoffset: 24; }
                                    to { stroke-dashoffset: 0; }
                                }
                                .data-wire {
                                    stroke-dasharray: 6 6;
                                    animation: dataFlow 1.5s linear infinite;
                                    fill: none;
                                    stroke-linejoin: round;
                                }
                            </style>

                            <!-- Hardware to Middle Layer -->
                            <!-- Trunk Y = 78 -->
                            <path class="data-wire" d="M200 56 L200 78 L100 78 L100 100" stroke="#06b6d4" stroke-width="1.5" opacity="0.5"/>
                            <path class="data-wire" d="M200 56 L200 78 L250 78 L250 100" stroke="#3b82f6" stroke-width="1.5" opacity="0.5"/>
                            <path class="data-wire" d="M200 56 L200 78 L358 78 L358 100" stroke="#06b6d4" stroke-width="1.5" opacity="0.5"/>

                            <!-- Middle Layer to Applications -->
                            <!-- Trunk Y = 168 -->
                            <path class="data-wire" d="M100 136 L100 168 L50 168 L50 200" stroke="#06b6d4" stroke-width="1.5" opacity="0.5"/>
                            <path class="data-wire" d="M100 136 L100 168 L150 168 L150 200" stroke="#06b6d4" stroke-width="1.5" opacity="0.5"/>
                            
                            <path class="data-wire" d="M250 136 L250 168 L150 168 L150 200" stroke="#3b82f6" stroke-width="1.5" opacity="0.5"/>
                            <path class="data-wire" d="M250 136 L250 200" stroke="#3b82f6" stroke-width="1.5" opacity="0.5"/>
                            <path class="data-wire" d="M250 136 L250 168 L350 168 L350 200" stroke="#3b82f6" stroke-width="1.5" opacity="0.5"/>
                            
                            <path class="data-wire" d="M358 136 L358 168 L350 168 L350 200" stroke="#06b6d4" stroke-width="1.5" opacity="0.5"/>

                            <!-- Applications to Value -->
                            <!-- Trunk Y = 258 -->
                            <path class="data-wire" d="M50 236 L50 258 L200 258 L200 280" stroke="#10b981" stroke-width="1.5" opacity="0.5"/>
                            <path class="data-wire" d="M150 236 L150 258 L200 258 L200 280" stroke="#10b981" stroke-width="1.5" opacity="0.5"/>
                            <path class="data-wire" d="M250 236 L250 258 L200 258 L200 280" stroke="#10b981" stroke-width="1.5" opacity="0.5"/>
                            <path class="data-wire" d="M350 236 L350 258 L200 258 L200 280" stroke="#10b981" stroke-width="1.5" opacity="0.5"/>

                            <!-- Top: Client / Robot Hardware -->
                            <rect x="150" y="20" width="100" height="36" rx="10" fill="#f1f5f9" stroke="#94a3b8" stroke-width="1.5"/>
                            <text x="200" y="44" fill="#475569" font-family="system-ui,sans-serif" font-size="12" font-weight="bold" text-anchor="middle">Robot Hardware</text>

                            <!-- Middle Layer: Our Services -->
                            <rect x="40" y="100" width="120" height="36" rx="10" fill="#ecfeff" stroke="#06b6d4" stroke-width="1.5"/>
                            <text x="100" y="123" fill="#0e7490" font-family="system-ui,sans-serif" font-size="11" font-weight="bold" text-anchor="middle">Middleware</text>

                            <rect x="200" y="100" width="100" height="36" rx="10" fill="#eff6ff" stroke="#3b82f6" stroke-width="1.5"/>
                            <text x="250" y="123" fill="#1d4ed8" font-family="system-ui,sans-serif" font-size="11" font-weight="bold" text-anchor="middle">Optimization</text>

                            <rect x="340" y="100" width="36" height="36" rx="10" fill="#ecfeff" stroke="#06b6d4" stroke-width="1.5"/>
                            <text x="358" y="123" fill="#0e7490" font-family="system-ui,sans-serif" font-size="9" font-weight="bold" text-anchor="middle">AI</text>

                            <!-- Bottom Layer: Applications -->
                            <rect x="10" y="200" width="80" height="36" rx="10" fill="#f0fdfa" stroke="#10b981" stroke-width="1.5"/>
                            <text x="50" y="223" fill="#047857" font-family="system-ui,sans-serif" font-size="10" font-weight="bold" text-anchor="middle">Industrial</text>

                            <rect x="110" y="200" width="80" height="36" rx="10" fill="#f0fdfa" stroke="#10b981" stroke-width="1.5"/>
                            <text x="150" y="223" fill="#047857" font-family="system-ui,sans-serif" font-size="10" font-weight="bold" text-anchor="middle">Education</text>

                            <rect x="210" y="200" width="80" height="36" rx="10" fill="#f0fdfa" stroke="#10b981" stroke-width="1.5"/>
                            <text x="250" y="223" fill="#047857" font-family="system-ui,sans-serif" font-size="10" font-weight="bold" text-anchor="middle">Research</text>

                            <rect x="310" y="200" width="80" height="36" rx="10" fill="#f0fdfa" stroke="#10b981" stroke-width="1.5"/>
                            <text x="350" y="223" fill="#047857" font-family="system-ui,sans-serif" font-size="10" font-weight="bold" text-anchor="middle">Logistics</text>

                            <!-- Bottom: Value -->
                            <rect x="100" y="280" width="200" height="28" rx="14" fill="#ecfeff" stroke="#06b6d4" stroke-width="1"/>
                            <text x="200" y="299" fill="#0e7490" font-family="system-ui,sans-serif" font-size="10" font-weight="bold" text-anchor="middle">Intelligence • Flexibility • Efficiency</text>

                        </svg>
                        <div class="mt-6 text-center">
                            <p class="text-xs text-slate-400 italic">Hardware → Intelligence Layer → Application → Value</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SECTION 3: SERVICE CAPABILITIES GRID ===== -->
    <section id="capabilities" class="relative py-12 md:py-28 overflow-hidden bg-slate-50">
        <div class="absolute top-0 right-1/4 w-[600px] h-[600px] bg-cyan-500/5 rounded-full blur-[120px]"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16 reveal-on-scroll">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-slate-200 shadow-sm mb-6">
                    <span class="text-xs font-bold text-cyan-700 tracking-wide uppercase">Our Capabilities</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-5">
                    Complete Software <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-blue-600">Intelligence Stack</span>
                </h2>
                <p class="text-slate-600 text-lg">End-to-end software solutions that transform robotic systems from functional to fully optimized.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="group relative bg-white border border-slate-200 rounded-[2rem] overflow-hidden hover:border-cyan-300 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 cursor-pointer reveal-on-scroll" data-delay="100" onclick="openLightbox(1)">
                    <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="h-52 bg-gradient-to-br from-cyan-500/20 via-blue-500/10 to-slate-100 flex items-center justify-center relative overflow-hidden">
                        <i class="fa-solid fa-layer-group text-7xl text-cyan-600/40 group-hover:scale-110 group-hover:text-cyan-600/60 transition-all duration-700"></i>
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-white/10 backdrop-blur-sm">
                            <span class="flex items-center gap-2 px-4 py-2 bg-white/90 rounded-xl text-slate-900 text-sm font-bold shadow-lg">
                                <i class="fa-solid fa-expand"></i> Explore
                            </span>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex px-2 py-1 rounded-lg bg-white/80 border border-cyan-200 text-cyan-700 text-xs font-bold shadow-sm">01</span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-extrabold text-slate-900 mb-3 group-hover:text-cyan-600 transition-colors">Software Intelligence Layer</h3>
                        <p class="text-slate-600">Complete digital layer around robotic systems: programming interfaces, motion-planning algorithms, simulation tools, perception software, and middleware.</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="group relative bg-white border border-slate-200 rounded-[2rem] overflow-hidden hover:border-emerald-300 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 cursor-pointer reveal-on-scroll" data-delay="200" onclick="openLightbox(2)">
                    <div class="h-52 bg-gradient-to-br from-emerald-500/20 via-cyan-500/10 to-slate-100 flex items-center justify-center relative overflow-hidden">
                        <i class="fa-solid fa-chart-line text-7xl text-emerald-600/40 group-hover:scale-110 group-hover:text-emerald-600/60 transition-all duration-700"></i>
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-white/10 backdrop-blur-sm">
                            <span class="flex items-center gap-2 px-4 py-2 bg-white/90 rounded-xl text-slate-900 text-sm font-bold shadow-lg">
                                <i class="fa-solid fa-expand"></i> Explore
                            </span>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex px-2 py-1 rounded-lg bg-white/80 border border-emerald-200 text-emerald-700 text-xs font-bold shadow-sm">02</span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-extrabold text-slate-900 mb-3 group-hover:text-emerald-600 transition-colors">Process Optimization</h3>
                        <p class="text-slate-600">Analyze robotic workflows using mathematical optimization, data-driven modeling, and simulation-based evaluation to reduce cycle time and increase throughput.</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="group relative bg-white border border-slate-200 rounded-[2rem] overflow-hidden hover:border-blue-300 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 cursor-pointer reveal-on-scroll" data-delay="300" onclick="openLightbox(3)">
                    <div class="h-52 bg-gradient-to-br from-blue-500/20 via-indigo-500/10 to-slate-100 flex items-center justify-center relative overflow-hidden">
                        <i class="fa-solid fa-route text-7xl text-blue-600/40 group-hover:scale-110 group-hover:text-blue-600/60 transition-all duration-700"></i>
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-white/10 backdrop-blur-sm">
                            <span class="flex items-center gap-2 px-4 py-2 bg-white/90 rounded-xl text-slate-900 text-sm font-bold shadow-lg">
                                <i class="fa-solid fa-expand"></i> Explore
                            </span>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex px-2 py-1 rounded-lg bg-white/80 border border-blue-200 text-blue-700 text-xs font-bold shadow-sm">03</span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-extrabold text-slate-900 mb-3 group-hover:text-blue-600 transition-colors">Trajectory & Path Planning</h3>
                        <p class="text-slate-600">Optimized robot motions respecting joint limits, velocity constraints, collision avoidance, and workspace boundaries for smooth, efficient trajectories.</p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="group relative bg-white border border-slate-200 rounded-[2rem] overflow-hidden hover:border-teal-300 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 cursor-pointer reveal-on-scroll" data-delay="100" onclick="openLightbox(4)">
                    <div class="h-52 bg-gradient-to-br from-teal-500/20 via-cyan-500/10 to-slate-100 flex items-center justify-center relative overflow-hidden">
                        <i class="fa-solid fa-cubes text-7xl text-teal-600/40 group-hover:scale-110 group-hover:text-teal-600/60 transition-all duration-700"></i>
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-white/10 backdrop-blur-sm">
                            <span class="flex items-center gap-2 px-4 py-2 bg-white/90 rounded-xl text-slate-900 text-sm font-bold shadow-lg">
                                <i class="fa-solid fa-expand"></i> Explore
                            </span>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex px-2 py-1 rounded-lg bg-white/80 border border-teal-200 text-teal-700 text-xs font-bold shadow-sm">04</span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-extrabold text-slate-900 mb-3 group-hover:text-teal-600 transition-colors">Simulation & Digital Twin</h3>
                        <p class="text-slate-600">Virtual models of robots and workcells to test paths, layouts, and sequences before physical deployment — reducing commissioning time and risk.</p>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="group relative bg-white border border-slate-200 rounded-[2rem] overflow-hidden hover:border-purple-300 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 cursor-pointer reveal-on-scroll" data-delay="200" onclick="openLightbox(5)">
                    <div class="h-52 bg-gradient-to-br from-purple-500/20 via-pink-500/10 to-slate-100 flex items-center justify-center relative overflow-hidden">
                        <i class="fa-solid fa-brain text-7xl text-purple-600/40 group-hover:scale-110 group-hover:text-purple-600/60 transition-all duration-700"></i>
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-white/10 backdrop-blur-sm">
                            <span class="flex items-center gap-2 px-4 py-2 bg-white/90 rounded-xl text-slate-900 text-sm font-bold shadow-lg">
                                <i class="fa-solid fa-expand"></i> Explore
                            </span>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex px-2 py-1 rounded-lg bg-white/80 border border-purple-200 text-purple-700 text-xs font-bold shadow-sm">05</span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-extrabold text-slate-900 mb-3 group-hover:text-purple-600 transition-colors">AI Perception & Adaptation</h3>
                        <p class="text-slate-600">Computer vision, machine learning, and sensor feedback for adaptive behavior in dynamic environments — robots that see, reason, and adjust in real time.</p>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="group relative bg-white border border-slate-200 rounded-[2rem] overflow-hidden hover:border-amber-300 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 cursor-pointer reveal-on-scroll" data-delay="300" onclick="openLightbox(6)">
                    <div class="h-52 bg-gradient-to-br from-amber-500/20 via-orange-500/10 to-slate-100 flex items-center justify-center relative overflow-hidden">
                        <i class="fa-solid fa-network-wired text-7xl text-amber-600/40 group-hover:scale-110 group-hover:text-amber-600/60 transition-all duration-700"></i>
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-white/10 backdrop-blur-sm">
                            <span class="flex items-center gap-2 px-4 py-2 bg-white/90 rounded-xl text-slate-900 text-sm font-bold shadow-lg">
                                <i class="fa-solid fa-expand"></i> Explore
                            </span>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex px-2 py-1 rounded-lg bg-white/80 border border-amber-200 text-amber-700 text-xs font-bold shadow-sm">06</span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-extrabold text-slate-900 mb-3 group-hover:text-amber-600 transition-colors">Multi-Robot Orchestration</h3>
                        <p class="text-slate-600">Task assignment, scheduling, conflict avoidance, and coordination across multiple robots, conveyors, and human workers for maximum productivity.</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <p class="text-sm text-slate-400">Click any card to explore its full technical depth</p>
            </div>
        </div>
    </section>

    <!-- ===== SECTION 4: INTERACTIVE BLUEPRINT ===== -->
    <section class="relative py-12 md:py-28 bg-white border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16 reveal-on-scroll">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-cyan-50 border border-cyan-200 shadow-sm mb-6">
                    <span class="w-2 h-2 rounded-full bg-cyan-500 animate-pulse"></span>
                    <span class="text-xs font-bold text-cyan-700 uppercase tracking-wide">Interactive Blueprint</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-5">
                    Deep Technical <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-blue-600">Software Stack</span>
                </h2>
                <p class="text-slate-600 text-lg">A comprehensive examination of how we compile these engineering domains to deliver production-grade robotics intelligence.</p>
            </div>

            <div class="bg-white border border-slate-200 rounded-3xl shadow-2xl overflow-hidden reveal-on-scroll" data-delay="200">
                <div class="flex flex-col lg:flex-row">
                    <!-- Sidebar -->
                    <div class="w-full lg:w-[320px] shrink-0 bg-slate-50 border-b lg:border-b-0 lg:border-r border-slate-200 flex flex-row lg:flex-col overflow-x-auto lg:overflow-x-visible p-3 gap-2">
                        <button onclick="switchArch(1)" id="arch-btn-1" class="arch-btn group flex items-center lg:items-start gap-3 p-4 rounded-2xl text-left transition-all duration-300 shrink-0 bg-cyan-500/10 border border-cyan-500/20 shadow-[0_0_15px_rgba(6,182,212,0.15)]">
                            <span class="font-mono text-cyan-600 font-bold text-sm mt-0.5">01</span>
                            <div>
                                <h4 class="text-slate-900 font-bold text-sm">Digital Layer Architecture</h4>
                                <p class="text-slate-500 text-xs mt-0.5 hidden lg:block">Complete middleware stack</p>
                            </div>
                        </button>
                        <button onclick="switchArch(2)" id="arch-btn-2" class="arch-btn group flex items-center lg:items-start gap-3 p-4 rounded-2xl text-left transition-all duration-300 shrink-0 hover:bg-slate-100 border border-transparent">
                            <span class="font-mono text-slate-500 font-bold text-sm mt-0.5 group-hover:text-cyan-600 transition-colors">02</span>
                            <div>
                                <h4 class="text-slate-600 font-bold text-sm group-hover:text-slate-900 transition-colors">Optimization Engine</h4>
                                <p class="text-slate-400 text-xs mt-0.5 hidden lg:block">Math &amp; data-driven models</p>
                            </div>
                        </button>
                        <button onclick="switchArch(3)" id="arch-btn-3" class="arch-btn group flex items-center lg:items-start gap-3 p-4 rounded-2xl text-left transition-all duration-300 shrink-0 hover:bg-slate-100 border border-transparent">
                            <span class="font-mono text-slate-500 font-bold text-sm mt-0.5 group-hover:text-cyan-600 transition-colors">03</span>
                            <div>
                                <h4 class="text-slate-600 font-bold text-sm group-hover:text-slate-900 transition-colors">Trajectory Planning</h4>
                                <p class="text-slate-400 text-xs mt-0.5 hidden lg:block">Kinematics &amp; constraints</p>
                            </div>
                        </button>
                        <button onclick="switchArch(4)" id="arch-btn-4" class="arch-btn group flex items-center lg:items-start gap-3 p-4 rounded-2xl text-left transition-all duration-300 shrink-0 hover:bg-slate-100 border border-transparent">
                            <span class="font-mono text-slate-500 font-bold text-sm mt-0.5 group-hover:text-cyan-600 transition-colors">04</span>
                            <div>
                                <h4 class="text-slate-600 font-bold text-sm group-hover:text-slate-900 transition-colors">Simulation &amp; Digital Twin</h4>
                                <p class="text-slate-400 text-xs mt-0.5 hidden lg:block">Virtual commissioning</p>
                            </div>
                        </button>
                        <button onclick="switchArch(5)" id="arch-btn-5" class="arch-btn group flex items-center lg:items-start gap-3 p-4 rounded-2xl text-left transition-all duration-300 shrink-0 hover:bg-slate-100 border border-transparent">
                            <span class="font-mono text-slate-500 font-bold text-sm mt-0.5 group-hover:text-cyan-600 transition-colors">05</span>
                            <div>
                                <h4 class="text-slate-600 font-bold text-sm group-hover:text-slate-900 transition-colors">AI Adaptation Pipeline</h4>
                                <p class="text-slate-400 text-xs mt-0.5 hidden lg:block">Vision &amp; reinforcement learning</p>
                            </div>
                        </button>
                        <button onclick="switchArch(6)" id="arch-btn-6" class="arch-btn group flex items-center lg:items-start gap-3 p-4 rounded-2xl text-left transition-all duration-300 shrink-0 hover:bg-slate-100 border border-transparent">
                            <span class="font-mono text-slate-500 font-bold text-sm mt-0.5 group-hover:text-cyan-600 transition-colors">06</span>
                            <div>
                                <h4 class="text-slate-600 font-bold text-sm group-hover:text-slate-900 transition-colors">Orchestration Layer</h4>
                                <p class="text-slate-400 text-xs mt-0.5 hidden lg:block">Multi-robot coordination</p>
                            </div>
                        </button>
                    </div>

                    <!-- Content Area -->
                    <div class="flex-1 p-8 lg:p-12 min-h-[500px] relative">
                        <!-- Content 1 -->
                        <div id="arch-content-1" class="arch-content transition-all duration-500 opacity-100 translate-y-0">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-100 border border-cyan-200 text-cyan-800 text-xs font-bold mb-6">Middleware Platform</div>
                            <h3 class="text-3xl font-extrabold text-slate-900 mb-6">The Complete Digital Layer</h3>
                            <p class="text-slate-600 leading-relaxed mb-8">Robotics Corner provides a complete digital layer around robotic systems. This includes robot programming interfaces, motion-planning algorithms, simulation tools, perception software, optimization modules, monitoring dashboards, and integration with external systems such as sensors, cameras, databases, PLCs, cloud platforms, and enterprise software.</p>
                            <div class="grid md:grid-cols-3 gap-4">
                                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 h-full">
                                    <div class="w-10 h-10 rounded-xl bg-cyan-100 flex items-center justify-center mb-4">
                                        <i class="fa-solid fa-code text-cyan-600"></i>
                                    </div>
                                    <h4 class="font-bold text-slate-900 mb-2 text-sm">Programming SDKs</h4>
                                    <p class="text-slate-500 text-xs">Unified APIs abstracting vendor-specific robot languages into a single programming model.</p>
                                </div>
                                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 h-full">
                                    <div class="w-10 h-10 rounded-xl bg-cyan-100 flex items-center justify-center mb-4">
                                        <i class="fa-solid fa-plug text-cyan-600"></i>
                                    </div>
                                    <h4 class="font-bold text-slate-900 mb-2 text-sm">Integration Middleware</h4>
                                    <p class="text-slate-500 text-xs">Connect vision systems, databases, operator interfaces, and monitoring tools in one workflow.</p>
                                </div>
                                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 h-full">
                                    <div class="w-10 h-10 rounded-xl bg-cyan-100 flex items-center justify-center mb-4">
                                        <i class="fa-solid fa-cubes text-cyan-600"></i>
                                    </div>
                                    <h4 class="font-bold text-slate-900 mb-2 text-sm">Cross-Platform</h4>
                                    <p class="text-slate-500 text-xs">Standardized communication between different robot brands — eliminating vendor lock-in.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Content 2 -->
                        <div id="arch-content-2" class="arch-content transition-all duration-500 opacity-0 pointer-events-none translate-y-4" style="display:none;">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100 border border-emerald-200 text-emerald-800 text-xs font-bold mb-6">Performance Tuning</div>
                            <h3 class="text-3xl font-extrabold text-slate-900 mb-6">Robotic Process Optimization Engine</h3>
                            <p class="text-slate-600 leading-relaxed mb-8">Many robotic applications are technically functional but not fully optimized. A robot may complete a task with unnecessary motion, long cycle time, high energy consumption, or inefficient coordination. Our engine addresses these systematically.</p>
                            <div class="space-y-4">
                                <div class="flex items-start gap-4 p-5 bg-slate-50 rounded-2xl border border-slate-200">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-magnifying-glass-chart text-emerald-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 mb-1">Workflow Analysis</h4>
                                        <p class="text-slate-500 text-sm">Data-driven tools that identify bottlenecks, redundant motions, and inefficiencies in robotic workflows.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4 p-5 bg-slate-50 rounded-2xl border border-slate-200">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-square-root-variable text-emerald-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 mb-1">Mathematical Optimization</h4>
                                        <p class="text-slate-500 text-sm">Applied mathematical programming to reduce cycle time, energy consumption, and mechanical wear.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4 p-5 bg-slate-50 rounded-2xl border border-slate-200">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-flask text-emerald-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 mb-1">Simulation-Based Evaluation</h4>
                                        <p class="text-slate-500 text-sm">Evaluate multiple optimization strategies before deploying to production — zero risk.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content 3 -->
                        <div id="arch-content-3" class="arch-content transition-all duration-500 opacity-0 pointer-events-none translate-y-4" style="display:none;">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 border border-blue-200 text-blue-800 text-xs font-bold mb-6">Motion Quality</div>
                            <h3 class="text-3xl font-extrabold text-slate-900 mb-6">Trajectory & Path Planning Stack</h3>
                            <p class="text-slate-600 leading-relaxed mb-8">Trajectory quality strongly affects speed, smoothness, safety, energy use, and mechanical wear. Our algorithms generate optimized motions while considering all critical constraints.</p>
                            <div class="grid md:grid-cols-3 gap-4">
                                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 h-full">
                                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center mb-4">
                                        <i class="fa-solid fa-circle-nodes text-blue-600"></i>
                                    </div>
                                    <h4 class="font-bold text-slate-900 mb-2 text-sm">Inverse Kinematics</h4>
                                    <p class="text-slate-500 text-xs">Robust IK solvers handling singularities and multiple solution branches for all common robot types.</p>
                                </div>
                                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 h-full">
                                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center mb-4">
                                        <i class="fa-solid fa-vector-square text-blue-600"></i>
                                    </div>
                                    <h4 class="font-bold text-slate-900 mb-2 text-sm">Constraint Planning</h4>
                                    <p class="text-slate-500 text-xs">Joint limits, velocity, acceleration, collision, and workspace constraints — all simultaneously.</p>
                                </div>
                                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 h-full">
                                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center mb-4">
                                        <i class="fa-solid fa-bezier-curve text-blue-600"></i>
                                    </div>
                                    <h4 class="font-bold text-slate-900 mb-2 text-sm">Smooth Generation</h4>
                                    <p class="text-slate-500 text-xs">Jerk-limited spline interpolation for the most efficient and stable motion paths.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Content 4 -->
                        <div id="arch-content-4" class="arch-content transition-all duration-500 opacity-0 pointer-events-none translate-y-4" style="display:none;">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-100 border border-teal-200 text-teal-800 text-xs font-bold mb-6">Virtual Commissioning</div>
                            <h3 class="text-3xl font-extrabold text-slate-900 mb-6">Simulation &amp; Digital Twin</h3>
                            <p class="text-slate-600 leading-relaxed mb-8">Before deploying on real hardware, we build virtual models to test paths, layouts, sequences, gripper configurations, and process parameters — reducing commissioning time and deployment risk.</p>
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 flex items-start gap-4 h-full">
                                    <i class="fa-solid fa-cube text-teal-500 text-xl mt-1"></i>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm">Digital Twin Creation</h4>
                                        <p class="text-slate-500 text-xs mt-1">High-fidelity virtual replicas that mirror real-time behavior.</p>
                                    </div>
                                </div>
                                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 flex items-start gap-4 h-full">
                                    <i class="fa-solid fa-flask text-teal-500 text-xl mt-1"></i>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm">Virtual Commissioning</h4>
                                        <p class="text-slate-500 text-xs mt-1">Validate setups virtually before physical installation.</p>
                                    </div>
                                </div>
                                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 flex items-start gap-4 h-full">
                                    <i class="fa-solid fa-sliders text-teal-500 text-xl mt-1"></i>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm">Parameter Optimization</h4>
                                        <p class="text-slate-500 text-xs mt-1">Evaluate configurations virtually to find the optimal setup.</p>
                                    </div>
                                </div>
                                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 flex items-start gap-4 h-full">
                                    <i class="fa-solid fa-chart-simple text-teal-500 text-xl mt-1"></i>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm">What-If Analysis</h4>
                                        <p class="text-slate-500 text-xs mt-1">Test thousands of scenarios risk-free.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content 5 -->
                        <div id="arch-content-5" class="arch-content transition-all duration-500 opacity-0 pointer-events-none translate-y-4" style="display:none;">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-100 border border-purple-200 text-purple-800 text-xs font-bold mb-6">Cognitive Robotics</div>
                            <h3 class="text-3xl font-extrabold text-slate-900 mb-6">AI-Based Optimization &amp; Adaptation</h3>
                            <p class="text-slate-600 leading-relaxed mb-8">In dynamic environments where objects move, lighting varies, and human operators are present, fixed programming is insufficient. Our AI pipeline enables adaptive intelligent behavior.</p>
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="bg-gradient-to-br from-purple-50 to-white border border-purple-200 rounded-2xl p-5 h-full">
                                    <i class="fa-solid fa-eye text-2xl text-purple-500 mb-3"></i>
                                    <h4 class="font-bold text-slate-900 mb-1">Computer Vision</h4>
                                    <p class="text-slate-500 text-xs">Object detection, pose estimation, and scene understanding for environmental perception.</p>
                                </div>
                                <div class="bg-gradient-to-br from-purple-50 to-white border border-purple-200 rounded-2xl p-5 h-full">
                                    <i class="fa-solid fa-hand text-2xl text-purple-500 mb-3"></i>
                                    <h4 class="font-bold text-slate-900 mb-1">Adaptive Grasping</h4>
                                    <p class="text-slate-500 text-xs">ML-based grasp planning that adjusts dynamically to object geometry and position.</p>
                                </div>
                                <div class="bg-gradient-to-br from-purple-50 to-white border border-purple-200 rounded-2xl p-5 h-full">
                                    <i class="fa-solid fa-arrows-spin text-2xl text-purple-500 mb-3"></i>
                                    <h4 class="font-bold text-slate-900 mb-1">Reinforcement Learning</h4>
                                    <p class="text-slate-500 text-xs">Train policies in simulation, deploy to real systems for continuous improvement.</p>
                                </div>
                                <div class="bg-gradient-to-br from-purple-50 to-white border border-purple-200 rounded-2xl p-5 h-full">
                                    <i class="fa-solid fa-repeat text-2xl text-purple-500 mb-3"></i>
                                    <h4 class="font-bold text-slate-900 mb-1">Real-Time Adaptation</h4>
                                    <p class="text-slate-500 text-xs">Correct paths, forces, and speeds during execution using sensor feedback.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Content 6 -->
                        <div id="arch-content-6" class="arch-content transition-all duration-500 opacity-0 pointer-events-none translate-y-4" style="display:none;">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-100 border border-amber-200 text-amber-800 text-xs font-bold mb-6">System-Wide Coordination</div>
                            <h3 class="text-3xl font-extrabold text-slate-900 mb-6">Multi-Robot Orchestration Layer</h3>
                            <p class="text-slate-600 leading-relaxed mb-8">When multiple robots, conveyors, machines, and human workers share a workspace, the challenge is system-wide optimization. Our orchestration layer manages it all.</p>
                            <div class="space-y-4">
                                <div class="flex items-start gap-4 p-5 bg-amber-50 rounded-2xl border border-amber-200">
                                    <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-list-check text-amber-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900">Task Allocation</h4>
                                        <p class="text-slate-500 text-sm mt-1">Intelligent assignment based on capability, proximity, and workload — maximizing throughput.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4 p-5 bg-amber-50 rounded-2xl border border-amber-200">
                                    <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-shield-halved text-amber-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900">Conflict Resolution</h4>
                                        <p class="text-slate-500 text-sm mt-1">Dynamic deconfliction of paths and workspaces to prevent collisions and deadlocks.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4 p-5 bg-amber-50 rounded-2xl border border-amber-200">
                                    <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-warehouse text-amber-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900">Logistics &amp; Warehousing</h4>
                                        <p class="text-slate-500 text-sm mt-1">Specialized scheduling for high-throughput pick, sort, and material flow operations.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SECTION 5: ARCHITECTURE DIAGRAM ===== -->
    <section class="relative py-12 md:py-28 bg-slate-50 border-t border-slate-200 overflow-hidden">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[600px] bg-cyan-500/[0.03] rounded-full blur-[150px]"></div>

        <div class="relative z-10 max-w-6xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16 reveal-on-scroll">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-slate-200 shadow-sm mb-6">
                    <span class="text-xs font-bold text-cyan-700 uppercase tracking-wide">System Architecture</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-5">
                    Third-Party Robotics <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-blue-600">Software Stack</span>
                </h2>
                <p class="text-slate-600 text-lg">A layered architecture that sits between robot hardware and enterprise systems — providing intelligence, optimization, and seamless integration.</p>
            </div>

            <div class="bg-white border border-slate-200 rounded-3xl shadow-2xl overflow-hidden p-8 md:p-12 reveal-on-scroll" data-delay="200">
                <div class="w-full overflow-x-auto">
                    <svg viewBox="0 0 900 550" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full min-w-[700px]">
                        <defs>
                            <radialGradient id="archGlow" cx="50%" cy="50%" r="50%">
                                <stop offset="0%" stop-color="#06b6d4" stop-opacity="0.12"/>
                                <stop offset="100%" stop-color="#06b6d4" stop-opacity="0"/>
                            </radialGradient>
                            <filter id="archShadow">
                                <feDropShadow dx="0" dy="2" stdDeviation="3" flood-opacity="0.08"/>
                            </filter>
                        </defs>

                        <circle cx="450" cy="275" r="220" fill="url(#archGlow)"/>

                        <style>
                            @keyframes dataFlowArch {
                                from { stroke-dashoffset: 24; }
                                to { stroke-dashoffset: 0; }
                            }
                            .arch-wire {
                                stroke-dasharray: 6 6;
                                animation: dataFlowArch 1.5s linear infinite;
                                fill: none;
                                stroke-linejoin: round;
                            }
                        </style>

                        <!-- Layer 1: Hardware & Robot Systems to Vendors -->
                        <!-- Flowing down and splitting outward -->
                        <path class="arch-wire" d="M450 102 L450 125" stroke="#94a3b8" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M450 125 L110 125" stroke="#94a3b8" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M450 125 L710 125" stroke="#94a3b8" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M110 125 L110 150" stroke="#94a3b8" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M230 125 L230 150" stroke="#94a3b8" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M350 125 L350 150" stroke="#94a3b8" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M470 125 L470 150" stroke="#94a3b8" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M590 125 L590 150" stroke="#94a3b8" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M710 125 L710 150" stroke="#94a3b8" stroke-width="1.5" opacity="0.6"/>

                        <!-- Vendors to Layer 2: Middleware -->
                        <!-- Gather at Y=202 and feed into Middleware top -->
                        <path class="arch-wire" d="M110 184 L110 202 L350 202" stroke="#94a3b8" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M230 184 L230 202 L350 202" stroke="#94a3b8" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M350 184 L350 220" stroke="#94a3b8" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M470 184 L470 220" stroke="#94a3b8" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M590 184 L590 220" stroke="#94a3b8" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M710 184 L710 202 L590 202" stroke="#94a3b8" stroke-width="1.5" opacity="0.6"/>

                        <!-- Layer 2: Middleware to Layer 3: Core Services -->
                        <!-- Split from Middleware bottom at Y=274 to Y=307 and down to services -->
                        <path class="arch-wire" d="M450 274 L450 307" stroke="#06b6d4" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M450 307 L130 307" stroke="#06b6d4" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M450 307 L770 307" stroke="#06b6d4" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M130 307 L130 340" stroke="#06b6d4" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M290 307 L290 340" stroke="#06b6d4" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M450 307 L450 340" stroke="#06b6d4" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M610 307 L610 340" stroke="#06b6d4" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M770 307 L770 340" stroke="#06b6d4" stroke-width="1.5" opacity="0.6"/>

                        <!-- Layer 3: Core Services to Layer 4: Enterprise Integration Layer -->
                        <!-- Gather at Y=421 and feed into Enterprise Layer at top (Y=460) -->
                        <path class="arch-wire" d="M130 382 L130 421 L450 421" stroke="#6366f1" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M290 382 L290 421 L450 421" stroke="#6366f1" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M450 382 L450 460" stroke="#6366f1" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M610 382 L610 421 L450 421" stroke="#6366f1" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M770 382 L770 421 L450 421" stroke="#6366f1" stroke-width="1.5" opacity="0.6"/>
                        <path class="arch-wire" d="M450 421 L450 460" stroke="#6366f1" stroke-width="1.5" opacity="0.6"/>

                        <!-- Layer 1: Title -->
                        <text x="450" y="45" fill="#0f172a" font-family="system-ui,sans-serif" font-size="14" font-weight="800" text-anchor="middle" letter-spacing="3">ROBOTICS CORNER SOFTWARE STACK</text>

                        <!-- Hardware Layer -->
                        <rect x="320" y="60" width="260" height="42" rx="12" fill="#f1f5f9" stroke="#cbd5e1" stroke-width="1.5" filter="url(#archShadow)"/>
                        <text x="450" y="87" fill="#475569" font-family="system-ui,sans-serif" font-size="14" font-weight="bold" text-anchor="middle">Hardware &amp; Robot Systems</text>

                        <!-- Vendor row -->
                        <rect x="60" y="150" width="100" height="34" rx="8" fill="#f8fafc" stroke="#cbd5e1" stroke-width="1"/>
                        <text x="110" y="172" fill="#64748b" font-family="monospace,sans-serif" font-size="11" font-weight="bold" text-anchor="middle">FANUC</text>
                        <rect x="180" y="150" width="100" height="34" rx="8" fill="#f8fafc" stroke="#cbd5e1" stroke-width="1"/>
                        <text x="230" y="172" fill="#64748b" font-family="monospace,sans-serif" font-size="11" font-weight="bold" text-anchor="middle">KUKA</text>
                        <rect x="300" y="150" width="100" height="34" rx="8" fill="#f8fafc" stroke="#cbd5e1" stroke-width="1"/>
                        <text x="350" y="172" fill="#64748b" font-family="monospace,sans-serif" font-size="11" font-weight="bold" text-anchor="middle">ABB</text>
                        <rect x="420" y="150" width="100" height="34" rx="8" fill="#f8fafc" stroke="#cbd5e1" stroke-width="1"/>
                        <text x="470" y="172" fill="#64748b" font-family="monospace,sans-serif" font-size="11" font-weight="bold" text-anchor="middle">UR</text>
                        <rect x="540" y="150" width="100" height="34" rx="8" fill="#f8fafc" stroke="#cbd5e1" stroke-width="1"/>
                        <text x="590" y="172" fill="#64748b" font-family="monospace,sans-serif" font-size="11" font-weight="bold" text-anchor="middle">YASKAWA</text>
                        <rect x="660" y="150" width="100" height="34" rx="8" fill="#f8fafc" stroke="#cbd5e1" stroke-width="1"/>
                        <text x="710" y="172" fill="#64748b" font-family="monospace,sans-serif" font-size="11" font-weight="bold" text-anchor="middle">SIEMENS</text>

                        <!-- Middleware Layer -->
                        <rect x="250" y="220" width="400" height="54" rx="14" fill="#ecfeff" stroke="#06b6d4" stroke-width="2.5" filter="url(#archShadow)"/>
                        <text x="450" y="248" fill="#0e7490" font-family="system-ui,sans-serif" font-size="16" font-weight="bold" text-anchor="middle">Robotics Corner Middleware Platform</text>
                        <text x="450" y="264" fill="#0891b2" font-family="monospace,sans-serif" font-size="10" text-anchor="middle">Standardized Communication &amp; Hardware Abstraction Layer</text>

                        <!-- Core Services Row -->
                        <rect x="60" y="340" width="140" height="42" rx="10" fill="#f0fdfa" stroke="#10b981" stroke-width="1.5"/>
                        <text x="130" y="366" fill="#047857" font-family="system-ui,sans-serif" font-size="13" font-weight="bold" text-anchor="middle">Optimization</text>

                        <rect x="220" y="340" width="140" height="42" rx="10" fill="#ecfeff" stroke="#06b6d4" stroke-width="1.5"/>
                        <text x="290" y="366" fill="#0e7490" font-family="system-ui,sans-serif" font-size="13" font-weight="bold" text-anchor="middle">Motion Planning</text>

                        <rect x="380" y="340" width="140" height="42" rx="10" fill="#ecfeff" stroke="#0ea5e9" stroke-width="1.5"/>
                        <text x="450" y="366" fill="#0369a1" font-family="system-ui,sans-serif" font-size="13" font-weight="bold" text-anchor="middle">Perception AI</text>

                        <rect x="540" y="340" width="140" height="42" rx="10" fill="#f0fdfa" stroke="#10b981" stroke-width="1.5"/>
                        <text x="610" y="366" fill="#047857" font-family="system-ui,sans-serif" font-size="13" font-weight="bold" text-anchor="middle">Simulation</text>

                        <rect x="700" y="340" width="140" height="42" rx="10" fill="#ecfeff" stroke="#06b6d4" stroke-width="1.5"/>
                        <text x="770" y="366" fill="#0e7490" font-family="system-ui,sans-serif" font-size="13" font-weight="bold" text-anchor="middle">Orchestration</text>

                        <!-- Enterprise Layer -->
                        <rect x="250" y="460" width="400" height="54" rx="14" fill="#eef2ff" stroke="#6366f1" stroke-width="2" filter="url(#archShadow)"/>
                        <text x="450" y="488" fill="#4338ca" font-family="system-ui,sans-serif" font-size="16" font-weight="bold" text-anchor="middle">Enterprise Integration Layer</text>
                        <text x="450" y="504" fill="#6366f1" font-family="monospace,sans-serif" font-size="10" text-anchor="middle">Cloud · IoT · ERP · MES · SCADA · APIs</text>

                        <!-- Layer labels on left -->
                        <text x="10" y="85" fill="#94a3b8" font-family="monospace,sans-serif" font-size="9" text-anchor="start">LAYER 1</text>
                        <text x="10" y="170" fill="#94a3b8" font-family="monospace,sans-serif" font-size="9" text-anchor="start">VENDORS</text>
                        <text x="10" y="250" fill="#94a3b8" font-family="monospace,sans-serif" font-size="9" text-anchor="start">LAYER 2</text>
                        <text x="10" y="365" fill="#94a3b8" font-family="monospace,sans-serif" font-size="9" text-anchor="start">LAYER 3</text>
                        <text x="10" y="490" fill="#94a3b8" font-family="monospace,sans-serif" font-size="9" text-anchor="start">LAYER 4</text>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SECTION 6: COMPETENCY MATRIX ===== -->
    <section class="relative py-12 md:py-28 bg-white border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16 reveal-on-scroll">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-cyan-50 border border-cyan-200 shadow-sm mb-6">
                    <span class="text-xs font-bold text-cyan-700 uppercase tracking-wide">Expertise</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-5">
                    Engineering <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-blue-600">Competency Matrix</span>
                </h2>
                <p class="text-slate-600 text-lg">Traceable competencies spanning robotics, software engineering, control theory, and artificial intelligence.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-lg hover:border-cyan-300 transition-all duration-300 border-t-4 border-t-cyan-500 reveal-on-scroll" data-delay="100">
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-2.5 py-1 rounded-md bg-cyan-50 text-cyan-700 text-xs font-bold uppercase tracking-wider">Infrastructure</span>
                        <i class="fa-solid fa-code text-cyan-500 text-lg"></i>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-2">Robot Programming</h3>
                    <p class="text-slate-500 text-sm mb-4">Unified SDKs, vendor abstraction, RAPID, KRL, URScript</p>
                    <div class="flex gap-2">
                        <span class="px-3 py-1 bg-cyan-50 border border-cyan-200 rounded-lg text-xs font-bold text-cyan-700">L3</span>
                        <span class="px-3 py-1 bg-cyan-50 border border-cyan-200 rounded-lg text-xs font-bold text-cyan-700">L4</span>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-lg hover:border-cyan-300 transition-all duration-300 border-t-4 border-t-cyan-500 reveal-on-scroll" data-delay="200">
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-2.5 py-1 rounded-md bg-cyan-50 text-cyan-700 text-xs font-bold uppercase tracking-wider">Control</span>
                        <i class="fa-solid fa-sliders text-cyan-500 text-lg"></i>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-2">Motion Planning &amp; Control</h3>
                    <p class="text-slate-500 text-sm mb-4">IK, PK, trajectory optimization, MPC, feedback control</p>
                    <div class="flex gap-2">
                        <span class="px-3 py-1 bg-cyan-50 border border-cyan-200 rounded-lg text-xs font-bold text-cyan-700">L4</span>
                        <span class="px-3 py-1 bg-cyan-50 border border-cyan-200 rounded-lg text-xs font-bold text-cyan-700">L5</span>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-lg hover:border-cyan-300 transition-all duration-300 border-t-4 border-t-cyan-500 reveal-on-scroll" data-delay="300">
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-2.5 py-1 rounded-md bg-cyan-50 text-cyan-700 text-xs font-bold uppercase tracking-wider">Perception</span>
                        <i class="fa-solid fa-eye text-cyan-500 text-lg"></i>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-2">Computer Vision</h3>
                    <p class="text-slate-500 text-sm mb-4">OpenCV, YOLO, 3D point clouds, stereo depth, pose estimation</p>
                    <div class="flex gap-2">
                        <span class="px-3 py-1 bg-cyan-50 border border-cyan-200 rounded-lg text-xs font-bold text-cyan-700">L4</span>
                        <span class="px-3 py-1 bg-cyan-50 border border-cyan-200 rounded-lg text-xs font-bold text-cyan-700">L5</span>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-lg hover:border-cyan-300 transition-all duration-300 border-t-4 border-t-cyan-500 reveal-on-scroll" data-delay="400">
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-2.5 py-1 rounded-md bg-cyan-50 text-cyan-700 text-xs font-bold uppercase tracking-wider">Intelligence</span>
                        <i class="fa-solid fa-brain text-cyan-500 text-lg"></i>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-2">AI &amp; Machine Learning</h3>
                    <p class="text-slate-500 text-sm mb-4">PyTorch, RLlib, imitation learning, sim-to-real transfer</p>
                    <div class="flex gap-2">
                        <span class="px-3 py-1 bg-cyan-50 border border-cyan-200 rounded-lg text-xs font-bold text-cyan-700">L4</span>
                        <span class="px-3 py-1 bg-cyan-50 border border-cyan-200 rounded-lg text-xs font-bold text-cyan-700">L5</span>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-lg hover:border-cyan-300 transition-all duration-300 border-t-4 border-t-cyan-500 reveal-on-scroll" data-delay="500">
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-2.5 py-1 rounded-md bg-cyan-50 text-cyan-700 text-xs font-bold uppercase tracking-wider">Virtualization</span>
                        <i class="fa-solid fa-cube text-cyan-500 text-lg"></i>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-2">Simulation &amp; Digital Twin</h3>
                    <p class="text-slate-500 text-sm mb-4">Gazebo, Unity, Webots, FMU, virtual commissioning</p>
                    <div class="flex gap-2">
                        <span class="px-3 py-1 bg-cyan-50 border border-cyan-200 rounded-lg text-xs font-bold text-cyan-700">L4</span>
                        <span class="px-3 py-1 bg-cyan-50 border border-cyan-200 rounded-lg text-xs font-bold text-cyan-700">L5</span>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-lg hover:border-cyan-300 transition-all duration-300 border-t-4 border-t-cyan-500 reveal-on-scroll" data-delay="600">
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-2.5 py-1 rounded-md bg-cyan-50 text-cyan-700 text-xs font-bold uppercase tracking-wider">Integration</span>
                        <i class="fa-solid fa-plug text-cyan-500 text-lg"></i>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-2">System Integration</h3>
                    <p class="text-slate-500 text-sm mb-4">ROS/ROS2, OPC-UA, MQTT, PLCs, REST, cloud connectors</p>
                    <div class="flex gap-2">
                        <span class="px-3 py-1 bg-cyan-50 border border-cyan-200 rounded-lg text-xs font-bold text-cyan-700">L4</span>
                        <span class="px-3 py-1 bg-cyan-50 border border-cyan-200 rounded-lg text-xs font-bold text-cyan-700">L5</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SECTION 7: DEPLOYMENT PIPELINE ===== -->
    <section class="relative py-12 md:py-28 bg-slate-50 border-t border-slate-200 overflow-hidden">
        <div class="absolute left-0 top-1/4 w-[500px] h-[500px] bg-blue-500/5 rounded-full blur-[120px]"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16 reveal-on-scroll">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-slate-200 shadow-sm mb-6">
                    <span class="text-xs font-bold text-cyan-700 uppercase tracking-wide">Process</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-5">
                    From Simulation to <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-blue-600">Factory Floor</span>
                </h2>
                <p class="text-slate-600 text-lg">Our systematic approach delivers measurable improvements at every stage — from initial analysis through continuous monitoring.</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <div class="relative reveal-on-scroll">
                    <div class="absolute -inset-4 bg-gradient-to-br from-cyan-500/10 via-blue-500/5 to-transparent rounded-3xl blur-2xl"></div>
                    <div class="relative bg-white border border-slate-200 rounded-3xl shadow-xl overflow-hidden">
                        <div class="p-8 md:p-10">
                            <svg viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                                <defs>
                                    <linearGradient id="pipelineGrad" x1="0" y1="0" x2="1" y2="0">
                                        <stop offset="0%" stop-color="#06b6d4"/>
                                        <stop offset="50%" stop-color="#3b82f6"/>
                                        <stop offset="100%" stop-color="#10b981"/>
                                    </linearGradient>
                                </defs>

                                <style>
                                    @keyframes pipelineFlow {
                                        from { stroke-dashoffset: 20; }
                                        to { stroke-dashoffset: 0; }
                                    }
                                    .pipeline-wire {
                                        stroke-dasharray: 6 4;
                                        animation: pipelineFlow 1.5s linear infinite;
                                    }
                                </style>

                                <!-- Connecting background track -->
                                <line x1="40" y1="130" x2="360" y2="130" stroke="#e2e8f0" stroke-width="4" stroke-linecap="round"/>

                                <!-- Animated pipeline flow -->
                                <line class="pipeline-wire" x1="40" y1="130" x2="360" y2="130" stroke="url(#pipelineGrad)" stroke-width="4" stroke-linecap="round"/>

                                <!-- Stage 1 -->
                                <circle cx="60" cy="130" r="26" fill="#ecfeff" stroke="#06b6d4" stroke-width="2.5"/>
                                <text x="60" y="135" fill="#0e7490" font-family="system-ui,sans-serif" font-size="14" font-weight="bold" text-anchor="middle">1</text>
                                <text x="60" y="85" fill="#0e7490" font-family="system-ui,sans-serif" font-size="9" font-weight="bold" text-anchor="middle">ANALYSIS</text>

                                <!-- Stage 2 -->
                                <circle cx="160" cy="130" r="26" fill="#eff6ff" stroke="#3b82f6" stroke-width="2.5"/>
                                <text x="160" y="135" fill="#1d4ed8" font-family="system-ui,sans-serif" font-size="14" font-weight="bold" text-anchor="middle">2</text>
                                <text x="160" y="85" fill="#1d4ed8" font-family="system-ui,sans-serif" font-size="9" font-weight="bold" text-anchor="middle">SIMULATION</text>

                                <!-- Stage 3 -->
                                <circle cx="260" cy="130" r="26" fill="#f0fdfa" stroke="#10b981" stroke-width="2.5"/>
                                <text x="260" y="135" fill="#047857" font-family="system-ui,sans-serif" font-size="14" font-weight="bold" text-anchor="middle">3</text>
                                <text x="260" y="85" fill="#047857" font-family="system-ui,sans-serif" font-size="9" font-weight="bold" text-anchor="middle">OPTIMIZATION</text>

                                <!-- Stage 4 -->
                                <circle cx="360" cy="130" r="26" fill="#eef2ff" stroke="#6366f1" stroke-width="2.5"/>
                                <text x="360" y="135" fill="#4338ca" font-family="system-ui,sans-serif" font-size="14" font-weight="bold" text-anchor="middle">4</text>
                                <text x="360" y="85" fill="#4338ca" font-family="system-ui,sans-serif" font-size="9" font-weight="bold" text-anchor="middle">DEPLOY</text>

                                <!-- Feedback loop -->
                                <path class="pipeline-wire" d="M360 160 Q210 240 60 160" stroke="#6366f1" stroke-width="1.5" stroke-dasharray="4 4" fill="none" opacity="0.5"/>
                                <text x="210" y="235" fill="#6366f1" font-family="system-ui,sans-serif" font-size="8" font-weight="bold" text-anchor="middle" opacity="0.6">Continuous Improvement Loop</text>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="space-y-8 reveal-on-scroll" data-delay="200">
                    <div class="flex items-start gap-5 group cursor-pointer" onclick="document.getElementById('lightbox-msg')?.scrollIntoView({behavior:'smooth'})">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-500/20 to-blue-500/20 border border-cyan-500/30 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <span class="text-cyan-700 font-extrabold text-lg">1</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-xl font-bold text-slate-900 mb-2">Analysis &amp; Assessment</h4>
                            <p class="text-slate-600">Deep-dive into existing workflows, bottleneck identification, and KPI baseline establishment for measurable improvement targets.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-5 group">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500/20 to-indigo-500/20 border border-blue-500/30 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <span class="text-blue-700 font-extrabold text-lg">2</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-xl font-bold text-slate-900 mb-2">Simulation &amp; Modeling</h4>
                            <p class="text-slate-600">Digital twin creation, virtual environment setup, and comprehensive what-if scenario analysis to identify optimal configurations.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-5 group">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500/20 to-teal-500/20 border border-emerald-500/30 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <span class="text-emerald-700 font-extrabold text-lg">3</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-xl font-bold text-slate-900 mb-2">Optimization &amp; Calibration</h4>
                            <p class="text-slate-600">Mathematical optimization, trajectory refinement, parameter tuning, and AI-based adaptation for peak performance.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-5 group">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500/20 to-purple-500/20 border border-indigo-500/30 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <span class="text-indigo-700 font-extrabold text-lg">4</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-xl font-bold text-slate-900 mb-2">Deployment &amp; Monitoring</h4>
                            <p class="text-slate-600">Production deployment with real-time dashboards, continuous monitoring, and iterative improvement cycles for sustained excellence.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== LIGHTBOX MODAL ===== -->
    <div id="lightbox" class="fixed inset-0 z-[100] bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center opacity-0 transition-opacity duration-300 p-4">
        <button onclick="closeLightbox()" class="absolute top-6 right-6 w-12 h-12 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white transition-all z-[101]">
            <i class="fa-solid fa-xmark text-xl"></i>
        </button>
        <div id="lightbox-wrapper" class="relative w-full max-w-3xl max-h-[85vh] overflow-y-auto transform scale-95 transition-transform duration-300 bg-white rounded-3xl shadow-2xl">
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-cyan-500 via-blue-500 to-indigo-500 rounded-t-3xl"></div>
            <div id="lightbox-content" class="p-8 md:p-12">
            </div>
        </div>
    </div>

    <!-- ===== CTA SECTION ===== -->
    <section class="relative py-20 md:py-32 overflow-hidden bg-white reveal-on-scroll">
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-[900px] h-[900px] rounded-full" style="background: radial-gradient(circle, rgba(6,182,212,0.08) 0%, transparent 70%);"></div>
        </div>
        <div class="relative z-10 text-center max-w-4xl mx-auto px-6">
            <h2 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.1] mb-8">
                Ready to Unlock Your<br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 via-blue-600 to-indigo-600">Robotics Full Potential</span>?
            </h2>
            <p class="text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed mb-10">
                Whether you need a complete software intelligence layer, process optimization, or AI-powered adaptation — our team is ready to engineer the solution.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('contact') }}" class="group inline-flex items-center gap-3 px-10 py-5 bg-gradient-to-r from-cyan-500 to-blue-600 text-white text-lg font-bold rounded-xl shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 hover:-translate-y-1 transition-all duration-300">
                    Start the Conversation <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="{{ route('services.index') }}" class="group inline-flex items-center gap-2 px-10 py-5 bg-white border-2 border-slate-200 text-slate-700 text-lg font-bold rounded-xl hover:border-cyan-300 hover:text-cyan-700 transition-all duration-300">
                    All Services <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<style>
    /* ===== Scroll-Triggered Reveal Animations ===== */
    .reveal-on-scroll {
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .reveal-on-scroll.revealed {
        opacity: 1;
        transform: translateY(0);
    }
    .reveal-on-scroll[data-delay="100"] { transition-delay: 0.1s; }
    .reveal-on-scroll[data-delay="200"] { transition-delay: 0.2s; }
    .reveal-on-scroll[data-delay="300"] { transition-delay: 0.3s; }
    .reveal-on-scroll[data-delay="400"] { transition-delay: 0.4s; }
    .reveal-on-scroll[data-delay="500"] { transition-delay: 0.5s; }
</style>
<script>
    // ===== Scroll-Triggered Reveal =====
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -50px 0px' });

        document.querySelectorAll('.reveal-on-scroll').forEach(el => observer.observe(el));
    });

    // ===== Lightbox Content Data =====
    const lightboxData = {
        1: {
            title: 'Software Intelligence Layer',
            subtitle: 'Complete digital layer around robotic systems',
            icon: 'fa-layer-group',
            color: 'cyan',
            sections: [
                { heading: 'Programming Interfaces & SDKs', text: 'Standardized APIs and software development kits that abstract vendor-specific robot languages into a unified programming model. Our SDKs support major robot brands including FANUC, KUKA, ABB, Universal Robots, and Yaskawa — allowing your team to write once and deploy anywhere.' },
                { heading: 'Motion Planning & Control APIs', text: 'High-level motion planning libraries that handle inverse kinematics, trajectory generation, and collision avoidance under the hood. Engineers can focus on application logic rather than low-level robot control.' },
                { heading: 'Perception & Sensor Middleware', text: 'Integration middleware for cameras, LiDARs, force-torque sensors, and proximity sensors providing a unified data stream for sensor fusion and real-time decision making.' },
                { heading: 'Enterprise & Cloud Integration', text: 'Seamless connectivity with databases, PLCs, SCADA systems, MES platforms, and cloud services through OPC-UA, MQTT, and REST APIs.' }
            ]
        },
        2: {
            title: 'Process Optimization Engine',
            subtitle: 'Maximize throughput, minimize operational cost',
            icon: 'fa-chart-line', color: 'emerald',
            sections: [
                { heading: 'Workflow Analysis & Bottleneck Detection', text: 'Data-driven tools that record and analyze every aspect of the robotic workflow — identifying redundant motions, unnecessary waiting times, and suboptimal task sequences.' },
                { heading: 'Cycle Time Optimization', text: 'Using mathematical optimization and motion smoothing algorithms to reduce cycle times by 15% to 40% while maintaining or improving quality.' },
                { heading: 'Energy Consumption Reduction', text: 'Optimized trajectories and motion profiles that minimize energy usage without sacrificing throughput.' },
                { heading: 'Data-Driven Performance Modeling', text: 'Machine learning models that predict system performance under different conditions, enabling proactive optimization.' }
            ]
        },
        3: {
            title: 'Trajectory & Path Planning',
            subtitle: 'Smooth, efficient, and safe robot motions',
            icon: 'fa-route', color: 'blue',
            sections: [
                { heading: 'Inverse Kinematics Solvers', text: 'Robust IK solvers handling singularities, multiple solution branches, and joint limits for all common robot kinematic configurations.' },
                { heading: 'Constraint-Based Motion Planning', text: 'Multi-constraint optimization considering joint limits, velocity, acceleration, torque bounds, and collision constraints simultaneously.' },
                { heading: 'Collision Avoidance Algorithms', text: 'Real-time detection and avoidance using bounding volume hierarchies (BVH) and signed distance fields.' },
                { heading: 'Smooth Trajectory Generation', text: 'Time-optimal parameterization with jerk-limited profiling minimizing wear, vibration, and improving accuracy.' }
            ]
        },
        4: {
            title: 'Simulation & Digital Twin',
            subtitle: 'Virtual commissioning and risk-free testing',
            icon: 'fa-cubes', color: 'teal',
            sections: [
                { heading: 'Digital Twin Creation', text: 'High-fidelity virtual replicas accurately modeling kinematics, dynamics, sensors, and environmental interactions.' },
                { heading: 'Virtual Commissioning', text: 'Validate production setups in simulation before physical installation — eliminating costly trial-and-error.' },
                { heading: 'What-If Scenario Analysis', text: 'Test thousands of scenarios under varying conditions to understand system behavior comprehensively.' },
                { heading: 'Parameter Optimization', text: 'Systematically evaluate gripper configurations, tool orientations, and process parameters to find the optimal combination.' }
            ]
        },
        5: {
            title: 'AI Perception & Adaptation',
            subtitle: 'Intelligent robots for dynamic environments',
            icon: 'fa-brain', color: 'purple',
            sections: [
                { heading: 'Computer Vision & Object Detection', text: 'State-of-the-art vision models for object detection, classification, pose estimation, and dimensional inspection under varying conditions.' },
                { heading: 'Adaptive Grasping & Manipulation', text: 'ML-based grasp planning that adapts to object geometry, material properties, and environmental constraints in real-time.' },
                { heading: 'Reinforcement Learning', text: 'Train robotic policies through millions of simulated trials, then transfer learned behaviors to real systems.' },
                { heading: 'Real-Time Sensor Feedback', text: 'Closed-loop control that adjusts paths, forces, and speeds during execution based on real-world sensor input.' }
            ]
        },
        6: {
            title: 'Multi-Robot Orchestration',
            subtitle: 'System-wide coordination and optimization',
            icon: 'fa-network-wired', color: 'amber',
            sections: [
                { heading: 'Intelligent Task Allocation', text: 'Dynamic assignment optimizing for robot capabilities, location, tool availability, and workload to maximize throughput.' },
                { heading: 'Conflict Detection & Resolution', text: 'Real-time deconfliction preventing collisions, deadlocks, and resource starvation in shared environments.' },
                { heading: 'Logistics Automation', text: 'Specialized scheduling for high-throughput pick sequences, bin allocation, conveyor handoffs, and material flow.' },
                { heading: 'Human-Robot Collaboration', text: 'Safety-rated coordination enabling efficient human-robot collaboration with dynamic speed and distance management.' }
            ]
        }
    };

    // ===== Interactive Blueprint =====
    function switchArch(id) {
        const btns = document.querySelectorAll('.arch-btn');
        btns.forEach(btn => {
            btn.className = 'arch-btn group flex items-center lg:items-start gap-3 p-4 rounded-2xl text-left transition-all duration-300 shrink-0 hover:bg-slate-100 border border-transparent';
            const spans = btn.querySelectorAll('span');
            if (spans[0]) spans[0].className = 'font-mono text-slate-500 font-bold text-sm mt-0.5 group-hover:text-cyan-600 transition-colors';
            const h4 = btn.querySelector('h4');
            if (h4) h4.className = 'text-slate-600 font-bold text-sm group-hover:text-slate-900 transition-colors';
        });
        const active = document.getElementById('arch-btn-' + id);
        if (!active) return;
        active.className = 'arch-btn group flex items-center lg:items-start gap-3 p-4 rounded-2xl text-left transition-all duration-300 shrink-0 bg-cyan-500/10 border border-cyan-500/20 shadow-[0_0_15px_rgba(6,182,212,0.15)]';
        const spans = active.querySelectorAll('span');
        if (spans[0]) spans[0].className = 'font-mono text-cyan-600 font-bold text-sm mt-0.5';
        const h4 = active.querySelector('h4');
        if (h4) h4.className = 'text-slate-900 font-bold text-sm';

        const contents = document.querySelectorAll('.arch-content');
        contents.forEach(c => {
            c.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
            c.classList.remove('opacity-100', 'translate-y-0');
            c.style.display = 'none';
        });

        const activeContent = document.getElementById('arch-content-' + id);
        if (!activeContent) return;
        activeContent.style.display = '';
        activeContent.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-4');
        activeContent.classList.add('opacity-100', 'translate-y-0');
    }

    // ===== Lightbox =====
    function openLightbox(id) {
        const data = lightboxData[id];
        if (!data) return;

        const lightbox = document.getElementById('lightbox');
        const content = document.getElementById('lightbox-content');
        const wrapper = document.getElementById('lightbox-wrapper');

        let html = `
            <div class="text-center mb-10">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-${data.color}-500/20 to-slate-100 border border-${data.color}-200 flex items-center justify-center">
                    <i class="fa-solid ${data.icon} text-3xl text-${data.color}-600"></i>
                </div>
                <h3 class="text-3xl font-bold text-slate-900 mb-2">${data.title}</h3>
                <p class="text-slate-500 text-lg">${data.subtitle}</p>
            </div>
            <div class="space-y-5">
        `;

        data.sections.forEach((section, i) => {
            html += `
                <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="w-6 h-6 rounded-lg bg-${data.color}-100 flex items-center justify-center text-xs font-bold text-${data.color}-700 shrink-0">${i+1}</span>
                        <h4 class="text-lg font-bold text-slate-900">${section.heading}</h4>
                    </div>
                    <p class="text-slate-600 leading-relaxed ml-9">${section.text}</p>
                </div>
            `;
        });

        html += '</div>';

        content.innerHTML = html;
        lightbox.classList.remove('hidden');
        lightbox.style.display = 'flex';

        requestAnimationFrame(() => {
            lightbox.classList.remove('opacity-0');
            wrapper.classList.remove('scale-95');
            wrapper.classList.add('scale-100');
        });

        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        const wrapper = document.getElementById('lightbox-wrapper');

        lightbox.classList.add('opacity-0');
        wrapper.classList.remove('scale-100');
        wrapper.classList.add('scale-95');

        setTimeout(() => {
            lightbox.classList.add('hidden');
            lightbox.style.display = 'none';
            document.body.style.overflow = '';
        }, 300);
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const lb = document.getElementById('lightbox');
            if (!lb.classList.contains('hidden')) closeLightbox();
        }
    });

    document.getElementById('lightbox').addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
    });
</script>
@endpush
