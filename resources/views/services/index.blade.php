@extends('components.layout')

@section('title', 'Interconnected Services - Robotics Corner')
@section('description', 'Robotics Corner services: R&D for autonomous systems and robotics, engineering consultation, and dedicated software outsourcing teams.')

@section('content')
    @include('components.page-hero', [
        'title' => cms('services.hero.title', 'Enterprise Services'),
        'subtitle' => cms('services.hero.subtitle', 'Comprehensive solutions spanning research, engineering, and elite technical training.')
    ])

    <section class="relative z-10 max-w-7xl mx-auto px-6 py-10 pb-20">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            
            <!-- Service 1: R&D -->
            <div class="relative bg-white border border-slate-200 shadow-sm hover:border-cyan-300 hover:shadow-lg hover:shadow-cyan-500/10 rounded-[2rem] overflow-hidden transition-all duration-500 group flex flex-col">
                <div class="h-56 overflow-hidden">
                    <div class="absolute inset-0 bg-cyan-900/10 mix-blend-multiply z-10 group-hover:opacity-0 transition-opacity duration-500"></div>
                    <img src="{{ cms('services.rnd.img', asset('images/rnd_service.png'), true) }}" data-cms-image="services.rnd.img" alt="R&D" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                </div>
                
                <div class="p-8 pt-0 flex flex-col flex-grow">
                    <div class="w-16 h-16 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center -mt-8 mb-6 relative z-20 shadow-md group-hover:-translate-y-2 transition-transform duration-500">
                        <i class="fa-solid fa-flask text-cyan-500 text-2xl"></i>
                    </div>
                    
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-3 group-hover:text-cyan-600 transition-colors">{{ cms('services.rnd.title', 'Product Development & R&D') }}</h3>
                    
                    <p class="text-slate-600 text-base leading-relaxed mb-8 flex-grow">
                        {{ cms('services.rnd.desc', 'Pushing boundaries in autonomous systems, AI integration, and next-generation robotics by developing proprietary hardware and software stacks from scratch.') }}
                    </p>
                    
                    <a href="{{ route('services.show', 'rnd') }}" class="before:absolute before:inset-0 before:z-10 inline-flex items-center gap-2 text-cyan-600 hover:text-cyan-700 font-bold group/link mt-auto">
                        Explore Division <i class="fa-solid fa-arrow-right transform group-hover/link:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Service 2: Consulting -->
            <div class="relative bg-white border border-slate-200 shadow-sm hover:border-blue-300 hover:shadow-lg hover:shadow-blue-500/10 rounded-[2rem] overflow-hidden transition-all duration-500 group flex flex-col">
                <div class="h-56 overflow-hidden">
                    <div class="absolute inset-0 bg-blue-900/10 mix-blend-multiply z-10 group-hover:opacity-0 transition-opacity duration-500"></div>
                    <img src="{{ cms('services.consulting.img', asset('images/consultation_service.png'), true) }}" data-cms-image="services.consulting.img" alt="Consulting" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                </div>
                
                <div class="p-8 pt-0 flex flex-col flex-grow">
                    <div class="w-16 h-16 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center -mt-8 mb-6 relative z-20 shadow-md group-hover:-translate-y-2 transition-transform duration-500">
                        <i class="fa-solid fa-comments text-blue-500 text-2xl"></i>
                    </div>
                    
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-3 group-hover:text-blue-600 transition-colors">{{ cms('services.consulting.title', 'Technical Architecture Consulting') }}</h3>
                    
                    <p class="text-slate-600 text-base leading-relaxed mb-8 flex-grow">
                        {{ cms('services.consulting.desc', 'Expert guidance on complex system architecture, embedded systems design, ROS2 migrations, and large-scale robotic deployments to help you make the right technical decisions.') }}
                    </p>
                    
                    <a href="{{ route('services.show', 'consultation') }}" class="before:absolute before:inset-0 before:z-10 inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-bold group/link mt-auto">
                        Request Consultation <i class="fa-solid fa-arrow-right transform group-hover/link:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Service 3: Outsourcing -->
            <div class="relative bg-white border border-slate-200 shadow-sm hover:border-purple-300 hover:shadow-lg hover:shadow-purple-500/10 rounded-[2rem] overflow-hidden transition-all duration-500 group flex flex-col">
                <div class="h-56 overflow-hidden">
                    <div class="absolute inset-0 bg-purple-900/10 mix-blend-multiply z-10 group-hover:opacity-0 transition-opacity duration-500"></div>
                    <img src="{{ cms('services.outsourcing.img', asset('images/outsourcing_service.png'), true) }}" data-cms-image="services.outsourcing.img" alt="Outsourcing" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                </div>
                
                <div class="p-8 pt-0 flex flex-col flex-grow">
                    <div class="w-16 h-16 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center -mt-8 mb-6 relative z-20 shadow-md group-hover:-translate-y-2 transition-transform duration-500">
                        <i class="fa-solid fa-users-gear text-purple-500 text-2xl"></i>
                    </div>
                    
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-3 group-hover:text-purple-600 transition-colors">{{ cms('services.outsourcing.title', 'Managed Engineering Outsourcing') }}</h3>
                    
                    <p class="text-slate-600 text-base leading-relaxed mb-8 flex-grow">
                        {{ cms('services.outsourcing.desc', 'Scale your development capacity instantly with our dedicated teams of elite robotics and automotive engineers, accelerating your project lifecycle with guaranteed quality.') }}
                    </p>
                    
                    <a href="{{ route('services.show', 'outsourcing') }}" class="before:absolute before:inset-0 before:z-10 inline-flex items-center gap-2 text-purple-600 hover:text-purple-700 font-bold group/link mt-auto">
                        Explore Division <i class="fa-solid fa-arrow-right transform group-hover/link:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Service 4: Training -->
            <div class="relative bg-white border border-slate-200 shadow-sm hover:border-emerald-300 hover:shadow-lg hover:shadow-emerald-500/10 rounded-[2rem] overflow-hidden transition-all duration-500 group flex flex-col">
                <div class="h-56 overflow-hidden">
                    <div class="absolute inset-0 bg-emerald-900/10 mix-blend-multiply z-10 group-hover:opacity-0 transition-opacity duration-500"></div>
                    <img src="{{ cms('services.training.img', asset('images/training_service.png'), true) }}" data-cms-image="services.training.img" alt="Training" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                </div>
                
                <div class="p-8 pt-0 flex flex-col flex-grow">
                    <div class="w-16 h-16 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center -mt-8 mb-6 relative z-20 shadow-md group-hover:-translate-y-2 transition-transform duration-500">
                        <i class="fa-solid fa-graduation-cap text-emerald-500 text-2xl"></i>
                    </div>
                    
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-3 group-hover:text-emerald-600 transition-colors">{{ cms('services.training.title', 'Corporate Engineering Enablement') }}</h3>
                    
                    <p class="text-slate-600 text-base leading-relaxed mb-8 flex-grow">
                        {{ cms('services.training.desc', 'Industry-leading educational programs designed to bridge the gap between academic theory and real-world engineering, upskilling enterprise teams for modern systems.') }}
                    </p>
                    
                    <a href="{{ route('programs.index') }}" class="before:absolute before:inset-0 before:z-10 inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 font-bold group/link mt-auto">
                        View Training Programs <i class="fa-solid fa-arrow-right transform group-hover/link:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

        </div>
    </section>
@endsection
