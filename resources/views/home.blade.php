@extends('components.layout')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[70vh] md:min-h-screen flex items-center overflow-hidden pt-24 pb-16 md:pb-12">
        <!-- Ambient Background Effects -->
        <div class="absolute inset-0 bg-slate-50"></div>
        <div class="absolute top-1/4 -left-32 w-[500px] h-[500px] bg-cyan-500/20 rounded-full blur-[128px] animate-pulse-glow"></div>
        <div class="absolute bottom-1/4 -right-32 w-[400px] h-[400px] bg-emerald-500/15 rounded-full blur-[128px] animate-pulse-glow" style="animation-delay: 1.5s;"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 w-full text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white border border-slate-200 shadow-sm mb-8 animate-fade-in-up" style="animation-delay: 100ms;">
                <span class="w-2 h-2 rounded-full bg-cyan-500 animate-pulse-glow"></span>
                <span class="text-xs font-bold text-cyan-700 tracking-wider uppercase">{{ cms('home.hero.badge', 'Leading Robotics Innovation') }}</span>
            </div>

            <!-- Headline -->
            <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 tracking-tight leading-[1.05] mb-8 animate-fade-in-up" style="animation-delay: 200ms;">
                {!! cms('home.hero.title', 'Empowering the Future with <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-emerald-600">Robotics Products</span> & Corporate Services') !!}
            </h1>

            <!-- Description -->
            <p class="text-xl md:text-2xl text-slate-600 max-w-3xl mx-auto mb-12 leading-relaxed font-medium animate-fade-in-up" style="animation-delay: 300ms;">
                {{ cms('home.hero.description', 'From autonomous industrial solutions to cutting-edge software products. We build the infrastructure of tomorrow, today.') }}
            </p>

            <style>
                .dash-anim {
                    stroke-dasharray: 1000;
                    stroke-dashoffset: 1000;
                    animation: dash 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
                }
                @keyframes dash {
                    to { stroke-dashoffset: 0; }
                }
            </style>
            
            <!-- CTA Interactive Hub -->
            <div x-data="{ activeHub: null }" class="animate-fade-in-up stagger-3 relative w-full max-w-5xl mx-auto min-h-[160px] flex items-start justify-center mt-12 mb-8">
                <!-- Center Main Buttons -->
                <div class="flex flex-col sm:flex-row items-center gap-6 relative z-20">
                    
                    <!-- Products Trigger -->
                    <div class="relative" @mouseenter="activeHub = 'products'" @mouseleave="activeHub = null">
                        <a href="{{ route('products.index') }}" class="group inline-flex items-center gap-2 px-8 py-4 text-sm font-bold text-white bg-gradient-to-r from-cyan-500 to-emerald-500 rounded-xl shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 transition-all duration-300 hover:-translate-y-1 relative z-20">
                            {{ cms('home.hero.btn_products', 'Explore Our Products') }}
                            <i class="fa-solid fa-microchip transition-transform duration-300 group-hover:rotate-12"></i>
                        </a>
                        
                        <!-- Products Sub-menu -->
                        <div x-show="activeHub === 'products'" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-4"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-4"
                             class="hidden md:flex absolute left-1/2 -translate-x-1/2 top-full mt-12 flex-wrap justify-center gap-4 w-[800px] z-10 pointer-events-auto"
                             style="display: none;">
                            
                            <!-- SVG Wires for Products -->
                            <svg class="hidden md:block absolute bottom-full left-0 w-full h-[48px] -z-10" viewBox="0 0 800 48" preserveAspectRatio="none">
                                <path d="M400,0 C400,24 210,24 210,48" fill="none" stroke="url(#cyanGrad)" stroke-width="2" class="dash-anim" />
                                <path d="M400,0 C400,24 450,24 450,48" fill="none" stroke="url(#cyanGrad)" stroke-width="2" class="dash-anim" style="animation-delay: 0.1s" />
                                <path d="M400,0 C400,24 640,24 640,48" fill="none" stroke="url(#cyanGrad)" stroke-width="2" class="dash-anim" style="animation-delay: 0.2s" />
                                <defs>
                                    <linearGradient id="cyanGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" stop-color="#0891b2" stop-opacity="0" />
                                        <stop offset="100%" stop-color="#059669" />
                                    </linearGradient>
                                </defs>
                            </svg>

                            <a href="{{ route('products.index') }}#amr" class="bg-white/95 backdrop-blur-md border border-slate-200 shadow-lg px-5 py-3 rounded-lg text-sm font-bold text-slate-700 hover:text-cyan-700 hover:border-cyan-300 hover:bg-cyan-50 transition-all whitespace-nowrap translate-y-[-5px] hover:-translate-y-2">
                                {{ cms('home.hero.link_amr', 'Autonomous mobile robot') }}
                            </a>
                            <a href="{{ route('products.index') }}#manipulator" class="bg-white/95 backdrop-blur-md border border-slate-200 shadow-lg px-5 py-3 rounded-lg text-sm font-bold text-slate-700 hover:text-cyan-700 hover:border-cyan-300 hover:bg-cyan-50 transition-all whitespace-nowrap translate-y-[5px] hover:translate-y-[2px]">
                                {{ cms('home.hero.link_manipulator', 'Autonomous manipulator robot') }}
                            </a>
                            <a href="{{ route('products.index') }}#roboagent" class="bg-white/95 backdrop-blur-md border border-slate-200 shadow-lg px-5 py-3 rounded-lg text-sm font-bold text-slate-700 hover:text-cyan-700 hover:border-cyan-300 hover:bg-cyan-50 transition-all whitespace-nowrap translate-y-[-5px] hover:-translate-y-2">
                                {{ cms('home.hero.link_roboagent', 'RoboAgent IDE') }}
                            </a>
                        </div>
                    </div>

                    <!-- Services Trigger -->
                    <div class="relative" @mouseenter="activeHub = 'services'" @mouseleave="activeHub = null">
                        <a href="{{ route('services.index') }}" class="group inline-flex items-center gap-2 px-8 py-4 text-sm font-bold text-slate-700 border border-slate-300 bg-white rounded-xl shadow-sm hover:border-blue-400 hover:bg-blue-50 transition-all duration-300 hover:-translate-y-1 relative z-20">
                            <i class="fa-solid fa-briefcase text-blue-500 transition-transform duration-300 group-hover:scale-110"></i>
                            {{ cms('home.hero.btn_services', 'View Corporate Services') }}
                        </a>
                        
                        <!-- Services Sub-menu -->
                        <div x-show="activeHub === 'services'" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-4"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-4"
                             class="hidden md:flex absolute left-1/2 -translate-x-1/2 top-full mt-12 flex-wrap justify-center gap-3 w-[800px] z-10 pointer-events-auto"
                             style="display: none;">
                            
                            <!-- SVG Wires for Services -->
                            <svg class="hidden md:block absolute bottom-full left-0 w-full h-[48px] -z-10" viewBox="0 0 800 48" preserveAspectRatio="none">
                                <path d="M400,0 C400,24 180,24 180,48" fill="none" stroke="url(#blueGrad)" stroke-width="2" class="dash-anim" />
                                <path d="M400,0 C400,24 270,24 270,48" fill="none" stroke="url(#blueGrad)" stroke-width="2" class="dash-anim" style="animation-delay: 0.1s" />
                                <path d="M400,0 C400,24 380,24 380,48" fill="none" stroke="url(#blueGrad)" stroke-width="2" class="dash-anim" style="animation-delay: 0.2s" />
                                <path d="M400,0 C400,24 550,24 550,48" fill="none" stroke="url(#blueGrad)" stroke-width="2" class="dash-anim" style="animation-delay: 0.3s" />
                                <defs>
                                    <linearGradient id="blueGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" stop-color="#2563eb" stop-opacity="0" />
                                        <stop offset="100%" stop-color="#7c3aed" />
                                    </linearGradient>
                                </defs>
                            </svg>

                            <a href="{{ route('services.show', 'rnd') }}" class="bg-white/95 backdrop-blur-md border border-slate-200 shadow-lg px-5 py-3 rounded-lg text-sm font-bold text-slate-700 hover:text-blue-700 hover:border-blue-300 hover:bg-blue-50 transition-all whitespace-nowrap translate-y-[-5px] hover:-translate-y-2">
                                {{ cms('home.hero.link_rnd', 'R&D') }}
                            </a>
                            <a href="{{ route('services.show', 'consultation') }}" class="bg-white/95 backdrop-blur-md border border-slate-200 shadow-lg px-5 py-3 rounded-lg text-sm font-bold text-slate-700 hover:text-indigo-700 hover:border-indigo-300 hover:bg-indigo-50 transition-all whitespace-nowrap translate-y-[5px] hover:translate-y-[2px]">
                                {{ cms('home.hero.link_consultation', 'Engineering Consultation') }}
                            </a>
                            <a href="{{ route('programs.index') }}" class="bg-white/95 backdrop-blur-md border border-slate-200 shadow-lg px-5 py-3 rounded-lg text-sm font-bold text-slate-700 hover:text-emerald-700 hover:border-emerald-300 hover:bg-emerald-50 transition-all whitespace-nowrap translate-y-[-5px] hover:-translate-y-2">
                                {{ cms('home.hero.link_training', 'Training') }}
                            </a>
                            <a href="{{ route('services.show', 'outsourcing') }}" class="bg-white/95 backdrop-blur-md border border-slate-200 shadow-lg px-5 py-3 rounded-lg text-sm font-bold text-slate-700 hover:text-purple-700 hover:border-purple-300 hover:bg-purple-50 transition-all whitespace-nowrap translate-y-[5px] hover:translate-y-[2px]">
                                {{ cms('home.hero.link_outsourcing', 'Outsourcing') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Overview -->
    <section class="relative py-12 md:py-24 overflow-hidden border-t border-slate-200 bg-white">
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-slate-200 bg-slate-50 mb-6">
                    <span class="text-xs font-bold text-slate-500 tracking-wide uppercase">Core Divisions</span>
                </div>
                <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-5">
                    {!! cms('home.services.title', 'Enterprise <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500">Services</span>') !!}
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- R&D -->
                <div class="relative bg-white border border-slate-200 shadow-md hover:shadow-2xl hover:border-cyan-300 rounded-[2rem] overflow-hidden transition-all duration-500 hover:-translate-y-2 group flex flex-col">
                    <a href="{{ route('services.show', 'rnd') }}" class="absolute inset-0 z-20"><span class="sr-only">Research & Development</span></a>
                    <div class="h-48 overflow-hidden bg-slate-100">
                        <img src="{{ cms('home.services.rnd_img', asset('images/rnd_service.png'), true) }}" data-cms-image="home.services.rnd_img" alt="R&D" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-8 flex flex-col flex-grow relative z-10 bg-white">
                        <h3 class="text-xl font-extrabold text-slate-900 mb-3 group-hover:text-cyan-600 transition-colors">{{ cms('home.services.rnd_title', 'Research & Development') }}</h3>
                        <p class="!text-left text-slate-600 text-sm leading-relaxed flex-grow mb-8">{{ cms('home.services.rnd_desc', 'Pioneering intelligent robotics solutions, from autonomous driving to advanced software platforms.') }}</p>
                        <div class="mt-auto inline-flex items-center gap-2 text-sm font-bold text-cyan-600 group-hover:text-cyan-700 transition-colors">
                            {{ cms('home.services.rnd_link', 'Discover R&D') }} <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </div>
                </div>

                <!-- Consultation -->
                <div class="relative bg-white border border-slate-200 shadow-md hover:shadow-2xl hover:border-blue-300 rounded-[2rem] overflow-hidden transition-all duration-500 hover:-translate-y-2 group flex flex-col">
                    <a href="{{ route('services.index') }}" class="absolute inset-0 z-20"><span class="sr-only">Engineering Consultation</span></a>
                    <div class="h-48 overflow-hidden bg-slate-100">
                        <img src="{{ cms('home.services.consultation_img', asset('images/consultation_service.png'), true) }}" data-cms-image="home.services.consultation_img" alt="Consultation" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-8 flex flex-col flex-grow relative z-10 bg-white">
                        <h3 class="text-xl font-extrabold text-slate-900 mb-3 group-hover:text-blue-600 transition-colors">{{ cms('home.services.consultation_title', 'Engineering Consultation') }}</h3>
                        <p class="!text-left text-slate-600 text-sm leading-relaxed flex-grow mb-8">{{ cms('home.services.consultation_desc', 'Expert guidance on system architecture, embedded systems, and robotic deployments.') }}</p>
                        <div class="mt-auto inline-flex items-center gap-2 text-sm font-bold text-blue-600 group-hover:text-blue-700 transition-colors">
                            {{ cms('home.services.consultation_link', 'Learn more') }} <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </div>
                </div>

                <!-- Training -->
                <div class="relative bg-white border border-slate-200 shadow-md hover:shadow-2xl hover:border-emerald-300 rounded-[2rem] overflow-hidden transition-all duration-500 hover:-translate-y-2 group flex flex-col">
                    <a href="{{ route('programs.index') }}" class="absolute inset-0 z-20"><span class="sr-only">Professional Training</span></a>
                    <div class="h-48 overflow-hidden bg-slate-100">
                        <img src="{{ cms('home.services.training_img', asset('images/training_service.png'), true) }}" data-cms-image="home.services.training_img" alt="Training" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-8 flex flex-col flex-grow relative z-10 bg-white">
                        <h3 class="text-xl font-extrabold text-slate-900 mb-3 group-hover:text-emerald-600 transition-colors">{{ cms('home.services.training_title', 'Corporate Training') }}</h3>
                        <p class="!text-left text-slate-600 text-sm leading-relaxed flex-grow mb-8">{{ cms('home.services.training_desc', 'Industry-leading educational programs bridging the gap between academia and real-world tech.') }}</p>
                        <div class="mt-auto inline-flex items-center gap-2 text-sm font-bold text-emerald-600 group-hover:text-emerald-700 transition-colors">
                            {{ cms('home.services.training_link', 'View programs') }} <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </div>
                </div>

                <!-- Outsourcing -->
                <div class="relative bg-white border border-slate-200 shadow-md hover:shadow-2xl hover:border-purple-300 rounded-[2rem] overflow-hidden transition-all duration-500 hover:-translate-y-2 group flex flex-col">
                    <a href="{{ route('services.index') }}" class="absolute inset-0 z-20"><span class="sr-only">Outsourcing</span></a>
                    <div class="h-48 overflow-hidden bg-slate-100">
                        <img src="{{ cms('home.services.outsourcing_img', asset('images/outsourcing_service.png'), true) }}" data-cms-image="home.services.outsourcing_img" alt="Outsourcing" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-8 flex flex-col flex-grow relative z-10 bg-white">
                        <h3 class="text-xl font-extrabold text-slate-900 mb-3 group-hover:text-purple-600 transition-colors">{{ cms('home.services.outsourcing_title', 'Outsourcing') }}</h3>
                        <p class="!text-left text-slate-600 text-sm leading-relaxed flex-grow mb-8">{{ cms('home.services.outsourcing_desc', 'Dedicated teams of elite engineers ready to accelerate your project development cycle.') }}</p>
                        <div class="mt-auto inline-flex items-center gap-2 text-sm font-bold text-purple-600 group-hover:text-purple-700 transition-colors">
                            {{ cms('home.services.outsourcing_link', 'Learn more') }} <i class="fa-solid fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </div>
                </div></div>
        </div>
    </section>

    <!-- Flagship Products -->
    <section class="relative py-12 md:py-24 overflow-hidden border-t border-slate-200 bg-slate-50">
        <div class="absolute top-0 right-1/4 w-[600px] h-[300px] bg-emerald-500/10 rounded-full blur-[120px]"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-slate-200 bg-white shadow-sm mb-6">
                    <span class="text-xs font-bold text-slate-500 tracking-wide uppercase">Hardware & Software</span>
                </div>
                <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-5">
                    {!! cms('home.products.title', 'Flagship <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-cyan-500">Products</span>') !!}
                </h2>
                <p class="text-slate-600">{{ cms('home.products.subtitle', 'Proprietary solutions engineered for maximum reliability, autonomy, and performance.') }}</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- AMR -->
                <div class="relative bg-white border border-slate-200 shadow-md rounded-3xl overflow-hidden group hover:border-cyan-300 transition-all duration-500">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ cms('home.products.amr_img', asset('images/product_amr.png'), true) }}" data-cms-image="home.products.amr_img" alt="AMR" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-8 z-20">
                        <h3 class="text-2xl font-bold text-slate-900 mb-2">{{ cms('home.products.amr_title', 'Autonomous Mobile Robots (AMR)') }}</h3>
                        <p class="!text-left text-slate-600 mb-6 line-clamp-3">{{ cms('home.products.amr_desc', 'Intelligent mobile platforms built for dynamic industrial environments. Featuring advanced SLAM, obstacle avoidance, and fleet management integration.') }}</p>
                        <a href="{{ route('products.index') }}" class="relative z-30 inline-flex items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-cyan-50 border border-slate-200 hover:border-cyan-200 rounded-xl text-cyan-700 text-sm font-bold transition-colors">
                            {!! cms('home.products.amr_link', 'Product Specs <i class="fa-solid fa-arrow-right text-xs"></i>') !!}
                        </a>
                    </div>
                </div>

                <!-- Manipulators -->
                <div class="relative bg-white border border-slate-200 shadow-md rounded-3xl overflow-hidden group hover:border-emerald-300 transition-all duration-500">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ cms('home.products.manipulator_img', asset('images/product_manipulator.png'), true) }}" data-cms-image="home.products.manipulator_img" alt="Manipulators" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-8 z-20">
                        <h3 class="text-2xl font-bold text-slate-900 mb-2">{{ cms('home.products.manipulator_title', 'Autonomous Manipulators') }}</h3>
                        <p class="!text-left text-slate-600 mb-6 line-clamp-3">{{ cms('home.products.manipulator_desc', 'High-precision robotic arms equipped with computer vision and force feedback for automated assembly, picking, and complex manipulation tasks.') }}</p>
                        <a href="{{ route('products.index') }}" class="relative z-30 inline-flex items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-emerald-50 border border-slate-200 hover:border-emerald-200 rounded-xl text-emerald-700 text-sm font-bold transition-colors">
                            {!! cms('home.products.manipulator_link', 'Product Specs <i class="fa-solid fa-arrow-right text-xs"></i>') !!}
                        </a>
                    </div>
                </div>

                <!-- RoboAgent IDE -->
                <div class="relative bg-white border border-slate-200 shadow-md rounded-3xl overflow-hidden group hover:border-purple-300 transition-all duration-500">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ cms('home.products.ide_img', asset('images/product_ide.png'), true) }}" data-cms-image="home.products.ide_img" alt="RoboAgent IDE" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-8 z-20">
                        <h3 class="text-2xl font-bold text-slate-900 mb-2">{{ cms('home.products.ide_title', 'RoboAgent IDE') }}</h3>
                        <p class="!text-left text-slate-600 mb-6 line-clamp-3">{{ cms('home.products.ide_desc', 'Our proprietary Integrated Development Environment specifically tailored for robotics programming, ROS2 integration, and simulation.') }}</p>
                        <a href="{{ route('products.index') }}" class="relative z-30 inline-flex items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-purple-50 border border-slate-200 hover:border-purple-200 rounded-xl text-purple-700 text-sm font-bold transition-colors">
                            {!! cms('home.products.ide_link', 'Product Specs <i class="fa-solid fa-arrow-right text-xs"></i>') !!}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-16 md:py-32 overflow-hidden border-t border-slate-200 bg-white">
        <div class="pointer-events-none absolute inset-0" aria-hidden="true">
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-[900px] h-[900px] rounded-full" style="background: radial-gradient(circle, rgba(34,211,238,0.1) 0%, transparent 70%);"></div>
        </div>

        <div class="relative z-10 text-center">
            <h2 class="text-4xl md:text-5xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-8">
                {!! cms('home.cta.title', 'Ready to Accelerate Your <br/><span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-emerald-600">Robotics Journey</span>?') !!}
            </h2>
            <p class="text-lg md:text-xl text-slate-600 mb-8 md:mb-12 max-w-2xl mx-auto leading-relaxed px-4">
                {{ cms('home.cta.description', 'Whether you need enterprise engineering solutions, proprietary hardware, or elite training, Robotics Corner is your partner in innovation.') }}
            </p>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3 md:px-8 md:py-4 bg-gradient-to-r from-cyan-500 to-emerald-500 text-white text-base md:text-lg font-bold rounded-xl shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 transition-all duration-300 hover:-translate-y-1">
                {{ cms('home.cta.button', 'Contact Our Team') }} <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </section>
@endsection