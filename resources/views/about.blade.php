@extends('components.layout')

@section('title', 'About Us - Robotics Corner')

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 overflow-hidden bg-slate-50">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-cyan-100 via-slate-50 to-slate-50"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-slate-200 bg-white shadow-sm mb-6">
                <span class="w-2 h-2 rounded-full bg-cyan-500 animate-pulse"></span>
                <span class="text-xs font-bold text-slate-600 tracking-wide uppercase">{{ cms('about.hero.badge', 'Who We Are') }}</span>
            </div>
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-slate-900 tracking-tight mb-6">
                {!! cms('about.hero.title', 'Architecting the <br/><span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-emerald-600">Digital Layer</span> of Robotics') !!}
            </h1>
            <p class="text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed">
                {{ cms('about.hero.subtitle', 'Robotics Corner is an independent third-party software provider and elite educational platform, dedicated to injecting unparalleled intelligence into the automation industry.') }}
            </p>
        </div>
    </section>

    <!-- The Vision (Emotional & Cinematic) -->
    <section class="relative py-32 overflow-hidden border-t border-slate-200 bg-white">
        <!-- Cinematic Background Effects -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMCwwLDAsMC4wMikiLz48L3N2Zz4=')]"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-[400px] bg-gradient-to-b from-cyan-200/50 to-transparent blur-[80px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-emerald-200/50 rounded-t-full blur-[100px] pointer-events-none"></div>
        
        <div class="max-w-5xl mx-auto px-6 relative z-10 text-center">
            
            <div class="inline-flex flex-col items-center mb-12">
                <span class="text-cyan-600 tracking-[0.2em] text-xs font-bold uppercase mb-4">{{ cms('about.vision.badge', 'Our Vision') }}</span>
                <div class="w-12 h-px bg-gradient-to-r from-transparent via-cyan-500 to-transparent"></div>
            </div>

            <!-- The Quote Icon -->
            <div class="relative w-16 h-16 mx-auto mb-8">
                <div class="absolute inset-0 bg-cyan-100 rounded-full blur-xl animate-pulse"></div>
                <i class="fa-solid fa-quote-left text-4xl text-cyan-500 relative z-10 opacity-80"></i>
            </div>

            <!-- Emotional Typography Hierarchy -->
            <div class="relative">
                <h2 class="text-3xl md:text-5xl font-light text-slate-800 leading-tight mb-8">
                    {!! cms('about.vision.statement_main', 'A world where humans are no longer bound by the limits of physical labor, but <span class="font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-emerald-600">elevated by the infinite possibilities</span> of intelligent automation.') !!}
                </h2>
                
                <p class="text-lg md:text-xl text-slate-600 leading-relaxed font-light max-w-3xl mx-auto">
                    {{ cms('about.vision.statement_sub', 'We envision a future where robotics breathes life into dead metal, acting as a seamless, silent partner in every industry. We are orchestrating the symphony between human ingenuity and machine precision, unlocking a new era of safety, creativity, and unprecedented human potential.') }}
                </p>
            </div>

            <!-- Unified Mission Execution Matrix -->
            <div class="grid grid-cols-1 relative z-10 w-full max-w-7xl mx-auto pt-16 mt-8">
                
                <!-- ROW 1: Execution Matrix Badge -->
                <div class="flex justify-center relative z-20 col-start-1 row-start-1 self-start">
                    <div class="bg-white px-8 py-3 rounded-full border border-cyan-200 shadow-md flex items-center gap-4">
                        <span class="w-2.5 h-2.5 rounded-full bg-cyan-500 animate-ping"></span>
                        <span class="text-sm text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-emerald-600 uppercase tracking-[0.3em] font-bold">{{ cms('about.vision.link_text', 'Execution Matrix') }}</span>
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-ping" style="animation-delay: 0.5s;"></span>
                    </div>
                </div>

                <!-- ROW 1 to ROW 3: The SVG Neural Path -->
                <div class="col-start-1 row-start-1 row-end-3 relative w-full h-full pointer-events-none z-0 hidden md:block pt-6">
                    <svg class="w-full h-full" viewBox="0 0 1000 1000" preserveAspectRatio="none">
                        <defs>
                            <linearGradient id="gradCenter" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#0891b2" stop-opacity="1" />
                                <stop offset="100%" stop-color="#059669" stop-opacity="0.8" />
                            </linearGradient>
                            <linearGradient id="gradLeft" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#0891b2" stop-opacity="1" />
                                <stop offset="100%" stop-color="#10b981" stop-opacity="0.8" />
                            </linearGradient>
                            <linearGradient id="gradRight" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#0891b2" stop-opacity="1" />
                                <stop offset="100%" stop-color="#2563eb" stop-opacity="0.8" />
                            </linearGradient>
                        </defs>

                        <!-- Glowing Track Lines -->
                        <path d="M500,0 L500.1,1000" fill="none" stroke="url(#gradCenter)" stroke-width="5" />
                        <path d="M500,0 C500,500 166,500 166,1000" fill="none" stroke="url(#gradLeft)" stroke-width="4" />
                        <path d="M500,0 C500,500 833,500 833,1000" fill="none" stroke="url(#gradRight)" stroke-width="4" />
                        
                        <!-- Animated Data Packets -->
                        <circle r="5" fill="#0891b2" filter="blur(1px)">
                            <animateMotion dur="2.5s" repeatCount="indefinite" path="M500,0 L500.1,1000" />
                        </circle>
                        <circle r="7" fill="#22d3ee" filter="blur(2px)" opacity="0.8">
                            <animateMotion dur="2.5s" repeatCount="indefinite" path="M500,0 L500.1,1000" />
                        </circle>

                        <circle r="5" fill="#10b981" filter="blur(1px)">
                            <animateMotion dur="3.5s" repeatCount="indefinite" path="M500,0 C500,500 166,500 166,1000" />
                        </circle>
                        <circle r="7" fill="#34d399" filter="blur(2px)" opacity="0.8">
                            <animateMotion dur="3.5s" repeatCount="indefinite" path="M500,0 C500,500 166,500 166,1000" />
                        </circle>

                        <circle r="5" fill="#2563eb" filter="blur(1px)">
                            <animateMotion dur="4s" repeatCount="indefinite" path="M500,0 C500,500 833,500 833,1000" />
                        </circle>
                        <circle r="7" fill="#60a5fa" filter="blur(2px)" opacity="0.8">
                            <animateMotion dur="4s" repeatCount="indefinite" path="M500,0 C500,500 833,500 833,1000" />
                        </circle>
                    </svg>
                    <!-- Ambient Core Glow directly behind the title -->
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[400px] h-full bg-cyan-200/20 blur-[60px] pointer-events-none"></div>
                </div>

                <!-- ROW 2: The Title Area -->
                <div class="text-center max-w-4xl mx-auto py-12 relative z-10 col-start-1 row-start-2 pointer-events-none">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-slate-200 bg-white shadow-sm mb-6 pointer-events-auto">
                        <i class="fa-solid fa-bullseye text-cyan-600"></i>
                        <span class="text-sm font-bold text-slate-600 tracking-wide uppercase">The Objective</span>
                    </div>
                    
                    <div class="bg-white/60 backdrop-blur-md border border-white shadow-xl rounded-3xl p-8 md:p-10 pointer-events-auto inline-block max-w-4xl">
                        <h2 class="text-5xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">
                            {!! cms('about.mission.title', 'Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-cyan-600">Mission Roadmap</span>') !!}
                        </h2>
                        <p class="text-xl text-slate-600 leading-relaxed max-w-3xl mx-auto">
                            {{ cms('about.mission.subtitle', 'To architect the missing digital layer of the robotics industry. We don\'t just build hardware; we inject intelligence into existing systems.') }}
                        </p>
                    </div>
                </div>

                <!-- ROW 3: The Cards Grid -->
                <div class="grid md:grid-cols-3 gap-12 relative z-10 col-start-1 row-start-3">
                    <!-- Phase 1 -->
                    <div class="bg-white border border-emerald-200 shadow-md rounded-[2.5rem] p-10 hover:-translate-y-4 hover:shadow-xl hover:shadow-emerald-500/10 transition-all duration-500 group relative text-center flex flex-col items-center">
                        <div class="absolute -top-6 left-1/2 -translate-x-1/2 w-14 h-14 bg-white border border-emerald-300 rounded-full flex items-center justify-center text-emerald-600 font-bold text-2xl shadow-sm group-hover:scale-125 transition-transform z-20">1</div>
                        <div class="w-24 h-24 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center justify-center mx-auto mt-4 mb-8 group-hover:rotate-6 transition-transform">
                            <i class="fa-solid fa-graduation-cap text-emerald-500 text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4">{{ cms('about.mission.phase1_title', 'Elite Education') }}</h3>
                        <p class="!text-center text-slate-600 leading-relaxed text-base">
                            {{ cms('about.mission.phase1_desc', 'Bridging the critical gap between academic theory and industry reality. We produce top-tier engineers ready to tackle complex challenges in embedded systems and ROS2.') }}
                        </p>
                    </div>

                    <!-- Phase 2 -->
                    <div class="bg-white border border-cyan-200 shadow-md rounded-[2.5rem] p-10 hover:-translate-y-4 hover:shadow-xl hover:shadow-cyan-500/10 transition-all duration-500 group relative text-center flex flex-col items-center">
                        <div class="absolute -top-6 left-1/2 -translate-x-1/2 w-14 h-14 bg-white border border-cyan-300 rounded-full flex items-center justify-center text-cyan-600 font-bold text-2xl shadow-sm group-hover:scale-125 transition-transform z-20">2</div>
                        <div class="w-24 h-24 bg-cyan-50 border border-cyan-100 rounded-2xl flex items-center justify-center mx-auto mt-4 mb-8 group-hover:rotate-6 transition-transform">
                            <i class="fa-solid fa-brain text-cyan-500 text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4">{{ cms('about.mission.phase2_title', 'Third-Party Intelligence') }}</h3>
                        <p class="!text-center text-slate-600 leading-relaxed text-base">
                            {{ cms('about.mission.phase2_desc', 'Providing process optimization, AI adaptation, and middleware solutions that free companies from manufacturer lock-in and dramatically increase efficiency.') }}
                        </p>
                    </div>

                    <!-- Phase 3 -->
                    <div class="bg-white border border-blue-200 shadow-md rounded-[2.5rem] p-10 hover:-translate-y-4 hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-500 group relative text-center flex flex-col items-center">
                        <div class="absolute -top-6 left-1/2 -translate-x-1/2 w-14 h-14 bg-white border border-blue-300 rounded-full flex items-center justify-center text-blue-600 font-bold text-2xl shadow-sm group-hover:scale-125 transition-transform z-20">3</div>
                        <div class="w-24 h-24 bg-blue-50 border border-blue-100 rounded-2xl flex items-center justify-center mx-auto mt-4 mb-8 group-hover:rotate-6 transition-transform">
                            <i class="fa-solid fa-network-wired text-blue-500 text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4">{{ cms('about.mission.phase3_title', 'Digital Orchestration') }}</h3>
                        <p class="!text-center text-slate-600 leading-relaxed text-base">
                            {{ cms('about.mission.phase3_desc', 'Deploying advanced simulation, multi-robot scheduling, and complex trajectory optimization algorithms to make any robotic system universally adaptive and highly coordinated.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Pillars (Training vs R&D) -->
    <section class="relative z-10 max-w-7xl mx-auto px-6 py-24 border-t border-slate-200 bg-slate-50 rounded-3xl mb-12 mt-12">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-5">
                {!! cms('about.pillars.title', 'Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-emerald-600">Core Pillars</span>') !!}
            </h2>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            
            <!-- Pillar 1: Training -->
            <div class="bg-white border border-slate-200 shadow-sm rounded-[2rem] p-10 hover:border-emerald-300 hover:shadow-lg transition-all duration-500 group relative overflow-hidden flex flex-col">
                <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/5 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/2 group-hover:bg-emerald-500/10 transition-colors"></div>
                
                <div class="w-16 h-16 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center mb-8 relative z-10 shadow-sm group-hover:-translate-y-1 transition-transform">
                    <i class="fa-solid fa-chalkboard-user text-emerald-500 text-2xl"></i>
                </div>
                
                <h3 class="text-3xl font-bold text-slate-900 mb-4 relative z-10">{{ cms('about.pillars.training_title', 'Engineering Training') }}</h3>
                <p class="text-slate-600 leading-relaxed mb-8 relative z-10 flex-grow">
                    {{ cms('about.pillars.training_desc', 'Our primary vision is to fill the critical gap between graduated students and job market demands. We offer rigorous, hands-on training programs designed by industry veterans to transform academic knowledge into deployable engineering expertise.') }}
                </p>
                
                <ul class="space-y-4 relative z-10">
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check mt-1.5 text-emerald-500 text-sm"></i>
                        <span class="text-slate-700">{{ cms('about.pillars.training_point1', 'Industry-aligned curricula in Embedded Systems & ROS2') }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check mt-1.5 text-emerald-500 text-sm"></i>
                        <span class="text-slate-700">{{ cms('about.pillars.training_point2', 'Project-based learning mimicking real corporate environments') }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check mt-1.5 text-emerald-500 text-sm"></i>
                        <span class="text-slate-700">{{ cms('about.pillars.training_point3', 'Direct pathways to elite automotive and robotics careers') }}</span>
                    </li>
                </ul>
            </div>

            <!-- Pillar 2: R&D & Software -->
            <div class="bg-white border border-slate-200 shadow-sm rounded-[2rem] p-10 hover:border-cyan-300 hover:shadow-lg transition-all duration-500 group relative overflow-hidden flex flex-col">
                <div class="absolute top-0 right-0 w-64 h-64 bg-cyan-500/5 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/2 group-hover:bg-cyan-500/10 transition-colors"></div>
                
                <div class="w-16 h-16 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center mb-8 relative z-10 shadow-sm group-hover:-translate-y-1 transition-transform">
                    <i class="fa-solid fa-microchip text-cyan-500 text-2xl"></i>
                </div>
                
                <h3 class="text-3xl font-bold text-slate-900 mb-4 relative z-10">{{ cms('about.pillars.rnd_title', 'Software & R&D') }}</h3>
                <p class="text-slate-600 leading-relaxed mb-8 relative z-10 flex-grow">
                    {{ cms('about.pillars.rnd_desc', 'We provide a complete digital layer around robotic systems. Our expertise spans programming interfaces, motion-planning algorithms, simulation tools, perception software, and independent middleware—making robots easier to program, control, and optimize.') }}
                </p>
                
                <ul class="space-y-4 relative z-10 grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check mt-1.5 text-cyan-500 text-sm"></i>
                        <span class="text-slate-700 text-sm">{{ cms('about.pillars.rnd_point1', 'Robotic Process Optimization') }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check mt-1.5 text-cyan-500 text-sm"></i>
                        <span class="text-slate-700 text-sm">{{ cms('about.pillars.rnd_point2', 'Trajectory & Path Planning') }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check mt-1.5 text-cyan-500 text-sm"></i>
                        <span class="text-slate-700 text-sm">{{ cms('about.pillars.rnd_point3', 'Simulation-Based Evaluation') }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check mt-1.5 text-cyan-500 text-sm"></i>
                        <span class="text-slate-700 text-sm">{{ cms('about.pillars.rnd_point4', 'AI-Based Environmental Adaptation') }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check mt-1.5 text-cyan-500 text-sm"></i>
                        <span class="text-slate-700 text-sm">{{ cms('about.pillars.rnd_point5', 'Independent System Middleware') }}</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check mt-1.5 text-cyan-500 text-sm"></i>
                        <span class="text-slate-700 text-sm">{{ cms('about.pillars.rnd_point6', 'Multi-Robot Coordination') }}</span>
                    </li>
                </ul>
            </div>

        </div>
    </section>

    <!-- Corporate History / Stats -->
    <section class="relative py-20 overflow-hidden border-y border-slate-200 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-emerald-600 mb-2">{{ cms('about.stats.1_val', '2020') }}</div>
                    <div class="text-sm text-slate-500 uppercase tracking-wider font-bold">{{ cms('about.stats.1_label', 'Founded') }}</div>
                </div>
                <div>
                    <div class="text-5xl font-extrabold text-slate-900 mb-2">{{ cms('about.stats.2_val', '15+') }}</div>
                    <div class="text-sm text-slate-500 uppercase tracking-wider font-bold">{{ cms('about.stats.2_label', 'Enterprise Partners') }}</div>
                </div>
                <div>
                    <div class="text-5xl font-extrabold text-slate-900 mb-2">{{ cms('about.stats.3_val', '500+') }}</div>
                    <div class="text-sm text-slate-500 uppercase tracking-wider font-bold">{{ cms('about.stats.3_label', 'Professionals Trained') }}</div>
                </div>
                <div>
                    <div class="text-5xl font-extrabold text-slate-900 mb-2">{{ cms('about.stats.4_val', '95%') }}</div>
                    <div class="text-sm text-slate-500 uppercase tracking-wider font-bold">{{ cms('about.stats.4_label', 'Job Placement Rate') }}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Leadership / Founder Spotlight -->
    <section class="relative py-24 overflow-hidden bg-slate-50">
        <div class="absolute left-0 top-1/4 w-[500px] h-[500px] bg-indigo-500/5 rounded-full blur-[120px]"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-slate-200 bg-white shadow-sm mb-6">
                    <span class="text-xs font-bold text-slate-600 tracking-wide uppercase">Leadership</span>
                </div>
                <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-5">
                    {!! cms('about.leadership.title', 'Founded by <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500">Experts</span>') !!}
                </h2>
                <p class="text-slate-600 text-lg mb-4">{{ cms('about.leadership.subtitle', 'Robotics Corner is built by a group of experts and scientists in fields like robotics, embedded systems, and AI.') }}</p>
            </div>

            <!-- Eng. Mohamed Saied Card -->
            <div class="bg-white border border-slate-200 rounded-[2.5rem] overflow-hidden shadow-xl relative">
                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-blue-500 via-cyan-500 to-emerald-500"></div>
                
                <div class="grid lg:grid-cols-[350px_1fr] gap-0">
                    
                    <!-- Left Sidebar (Profile) -->
                    <div class="p-10 border-b lg:border-b-0 lg:border-r border-slate-200 bg-slate-50 flex flex-col items-center text-center">
                        <div class="w-48 h-48 rounded-full border-4 border-slate-200 overflow-hidden mb-6 relative group shadow-sm">
                            <!-- Placeholder Image (Editable) -->
                            <img src="{{ cms('about.leadership.saied_img', asset('images/mohamed_saied.jpg'), true) }}" data-cms-image="about.leadership.saied_img" alt="Eng. Mohamed Saied" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-cyan-500/10 mix-blend-overlay group-hover:bg-transparent transition-colors"></div>
                        </div>
                        
                        <h3 class="text-2xl font-extrabold text-slate-900 mb-2">{{ cms('about.leadership.saied_name', 'Eng. Mohamed Saied') }}</h3>
                        <p class="text-cyan-700 font-bold text-sm mb-6">{{ cms('about.leadership.saied_role', 'One of the CTOs & Founders') }}</p>
                        
                        <div class="flex flex-wrap justify-center gap-2 mb-8">
                            <span class="px-3 py-1 bg-white border border-slate-200 shadow-sm rounded-lg text-xs font-bold text-slate-600">{{ cms('about.leadership.saied_tag1', 'Software Team Lead') }}</span>
                            <span class="px-3 py-1 bg-white border border-slate-200 shadow-sm rounded-lg text-xs font-bold text-slate-600">{{ cms('about.leadership.saied_tag2', 'Adaptive AUTOSAR') }}</span>
                            <span class="px-3 py-1 bg-white border border-slate-200 shadow-sm rounded-lg text-xs font-bold text-slate-600">{{ cms('about.leadership.saied_tag3', 'Consultant & Educator') }}</span>
                        </div>
                        
                        <a href="{{ cms('about.leadership.saied_linkedin', 'https://www.linkedin.com/in/mohamedsaied8/') }}" target="_blank" class="w-full py-3 px-6 bg-[#0077b5] border border-[#0077b5] hover:bg-[#0077b5]/90 text-white font-bold rounded-xl transition-colors flex items-center justify-center gap-2 group mb-10 shadow-md">
                            <i class="fa-brands fa-linkedin text-white text-xl group-hover:scale-110 transition-transform"></i>
                            Connect on LinkedIn
                        </a>

                        <div class="w-full text-left space-y-6">
                            <div>
                                <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">{{ cms('about.leadership.saied_quick_facts_title', 'Quick Facts') }}</h4>
                                <ul class="space-y-3">
                                    <li class="flex items-center gap-3 text-sm text-slate-700 font-medium">
                                        <div class="w-8 h-8 rounded-lg bg-emerald-50 border border-emerald-100 flex items-center justify-center shrink-0">
                                            <i class="fa-solid fa-clock text-emerald-500"></i>
                                        </div>
                                        <span>{{ cms('about.leadership.saied_fact1', '10+ Years Embedded Exp.') }}</span>
                                    </li>
                                    <li class="flex items-center gap-3 text-sm text-slate-700 font-medium">
                                        <div class="w-8 h-8 rounded-lg bg-cyan-50 border border-cyan-100 flex items-center justify-center shrink-0">
                                            <i class="fa-solid fa-car text-cyan-500"></i>
                                        </div>
                                        <span>{{ cms('about.leadership.saied_fact2', 'Autonomous Driving Expert') }}</span>
                                    </li>
                                    <li class="flex items-center gap-3 text-sm text-slate-700 font-medium">
                                        <div class="w-8 h-8 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0">
                                            <i class="fa-solid fa-chalkboard-user text-blue-500"></i>
                                        </div>
                                        <span>{{ cms('about.leadership.saied_fact3', 'Agile & Enterprise Educator') }}</span>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="h-px w-full bg-slate-200"></div>
                            
                            <div>
                                <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">{{ cms('about.leadership.saied_cert_title', 'Certifications') }}</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-3 py-1.5 bg-white shadow-sm border border-slate-200 rounded-lg text-xs font-bold text-slate-600 flex items-center gap-2">
                                        <i class="fa-solid fa-award text-yellow-500"></i> {{ cms('about.leadership.saied_cert1', 'IEEE Certified') }}
                                    </span>
                                    <span class="px-3 py-1.5 bg-white shadow-sm border border-slate-200 rounded-lg text-xs font-bold text-slate-600 flex items-center gap-2">
                                        <i class="fa-solid fa-award text-yellow-500"></i> {{ cms('about.leadership.saied_cert2', 'UT Austin Certified') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Content (Details) -->
                    <div class="p-10 lg:p-12">
                        
                        <div class="mb-10">
                            <h4 class="text-lg font-extrabold text-slate-900 flex items-center gap-2 mb-4">
                                <i class="fa-solid fa-bolt text-cyan-500"></i> {{ cms('about.leadership.saied_exec_title', 'Executive Summary') }}
                            </h4>
                            <p class="text-slate-600 leading-relaxed font-medium">
                                {{ cms('about.leadership.saied_exec_desc', 'With a rich vein of over a decade of experience in embedded software engineering, Mohamed specializes in bridging the gap between cutting-edge technology and tangible, industry-shaping products. His technical canvas is built on Adaptive AUTOSAR, Modern C++, and ROS2, with a specific focus on driving innovation in autonomous driving applications and smart IoT solutions.') }}
                            </p>
                            <p class="text-slate-600 leading-relaxed font-medium mt-4">
                                {{ cms('about.leadership.saied_exec_desc2', 'Beyond product development, he is deeply invested in elevating the engineering community. He actively consults organizations on Agile transformations and provides high-level training to embedded software professionals aiming for the next tier of their careers.') }}
                            </p>
                        </div>

                        <div class="mb-10">
                            <h4 class="text-lg font-extrabold text-slate-900 flex items-center gap-2 mb-4">
                                <i class="fa-solid fa-code text-emerald-500"></i> {{ cms('about.leadership.saied_comp_title', 'Core Competencies') }}
                            </h4>
                            <div class="grid sm:grid-cols-2 gap-4">
                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                                    <h5 class="text-slate-900 text-sm font-bold mb-2">{{ cms('about.leadership.saied_comp_tech', 'Technologies & Frameworks') }}</h5>
                                    <p class="text-slate-600 text-sm">{{ cms('about.leadership.saied_comp_tech_desc', 'Modern C++, Adaptive AUTOSAR, ROS2, AI Agents, RTOS, SOLID Principles') }}</p>
                                </div>
                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                                    <h5 class="text-slate-900 text-sm font-bold mb-2">{{ cms('about.leadership.saied_comp_dom', 'Engineering Domains') }}</h5>
                                    <p class="text-slate-600 text-sm">{{ cms('about.leadership.saied_comp_dom_desc', 'Autonomous Driving, Telecommunications (4G LTE), IoT Solutions, Control Algorithms, Image Processing') }}</p>
                                </div>
                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                                    <h5 class="text-slate-900 text-sm font-bold mb-2">{{ cms('about.leadership.saied_comp_lead', 'Leadership & Strategy') }}</h5>
                                    <p class="text-slate-600 text-sm">{{ cms('about.leadership.saied_comp_lead_desc', 'Agile Transformation, Technical Team Leadership, Educational Consulting') }}</p>
                                </div>
                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                                    <h5 class="text-slate-900 text-sm font-bold mb-2">{{ cms('about.leadership.saied_comp_hard', 'Hardware & Systems') }}</h5>
                                    <p class="text-slate-600 text-sm">{{ cms('about.leadership.saied_comp_hard_desc', 'Microcontroller Interfacing, Hardware Architecture, PCB Design') }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-lg font-extrabold text-slate-900 flex items-center gap-2 mb-4">
                                <i class="fa-solid fa-briefcase text-blue-500"></i> {{ cms('about.leadership.saied_exp_title', 'Professional Highlights') }}
                            </h4>
                            <div class="space-y-6 relative before:absolute before:inset-0 before:ml-2 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-200 before:to-transparent">
                                
                                <!-- Highlight 1 -->
                                <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                                    <div class="flex items-center justify-center w-4 h-4 rounded-full border border-slate-300 bg-white text-slate-500 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2">
                                        <div class="w-1.5 h-1.5 bg-cyan-500 rounded-full"></div>
                                    </div>
                                    <div class="w-[calc(100%-2rem)] md:w-[calc(50%-1.5rem)] bg-white border border-slate-200 p-4 rounded-xl ml-4 md:ml-0 shadow-sm hover:shadow-md transition-shadow">
                                        <h5 class="text-slate-900 font-extrabold text-sm">{{ cms('about.leadership.saied_exp1_title', 'Technical Leadership @ Robotics Corner') }}</h5>
                                        <p class="text-slate-600 text-xs mt-2 font-medium">{{ cms('about.leadership.saied_exp1_desc', 'Currently steering software initiatives as Technical Team Lead, focusing on modern C++, AI agents, and advanced robotics training programs.') }}</p>
                                    </div>
                                </div>

                                <!-- Highlight 2 -->
                                <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                                    <div class="flex items-center justify-center w-4 h-4 rounded-full border border-slate-300 bg-white text-slate-500 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2">
                                        <div class="w-1.5 h-1.5 bg-blue-500 rounded-full"></div>
                                    </div>
                                    <div class="w-[calc(100%-2rem)] md:w-[calc(50%-1.5rem)] bg-white border border-slate-200 p-4 rounded-xl ml-4 md:ml-0 shadow-sm hover:shadow-md transition-shadow">
                                        <h5 class="text-slate-900 font-extrabold text-sm">{{ cms('about.leadership.saied_exp2_title', 'Automotive Innovation @ Luxoft') }}</h5>
                                        <p class="text-slate-600 text-xs mt-2 font-medium">{{ cms('about.leadership.saied_exp2_desc', 'Played a pivotal role in the future of connected mobility by developing the nPDU tunneling component in BMW IPNext as an Adaptive AUTOSAR application.') }}</p>
                                    </div>
                                </div>

                                <!-- Highlight 3 -->
                                <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                                    <div class="flex items-center justify-center w-4 h-4 rounded-full border border-slate-300 bg-white text-slate-500 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2">
                                        <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></div>
                                    </div>
                                    <div class="w-[calc(100%-2rem)] md:w-[calc(50%-1.5rem)] bg-white border border-slate-200 p-4 rounded-xl ml-4 md:ml-0 shadow-sm hover:shadow-md transition-shadow">
                                        <h5 class="text-slate-900 font-extrabold text-sm">{{ cms('about.leadership.saied_exp3_title', 'IoT & Smart Technologies') }}</h5>
                                        <p class="text-slate-600 text-xs mt-2 font-medium">{{ cms('about.leadership.saied_exp3_desc', 'Enhanced and scaled complex IoT solutions during tenures at CrossWorkers and EL2LABS, driving reliable, connected smart devices.') }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
        </div>
    </section>

@endsection