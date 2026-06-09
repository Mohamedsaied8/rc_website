@extends('components.layout')

@section('title', $serviceTitle . ' - Corporate Services')

@section('content')
    @include('components.page-hero', [
        'title' => $serviceTitle,
        'subtitle' => 'Specialized corporate solutions tailored to your enterprise requirements.'
    ])

    @if($serviceId === 'consultation')
        <!-- Consultation Content -->
        <section class="relative z-10 max-w-6xl mx-auto px-6 py-12 md:py-24">
            <div class="grid md:grid-cols-2 gap-8 md:gap-16 items-center mb-12 md:mb-24">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-6">Expert Engineering Guidance</h2>
                    <p class="text-slate-600 text-lg leading-relaxed mb-6">
                        Our Engineering Consultation division provides strategic technical guidance for enterprises navigating the complex landscape of robotics and autonomous systems. We do not just offer advice; we provide actionable architectural blueprints tailored to your specific operational needs.
                    </p>
                    <p class="text-slate-600 text-lg leading-relaxed mb-8">
                        From selecting the right sensor payload for an AMR fleet to designing highly reliable, low-latency communication bridges using modern frameworks like ROS2, our senior engineers help you mitigate technical debt, reduce risk, and accelerate your time-to-market.
                    </p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl text-white font-bold hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300">
                        Contact Our Architects
                    </a>
                </div>
                <div class="relative rounded-3xl overflow-hidden border border-slate-200 shadow-xl">
                    <img src="{{ asset('images/consultation_service.png') }}" alt="Engineering Consultation" class="w-full object-cover h-[500px]">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 via-transparent to-transparent"></div>
                </div>
            </div>

            <div class="bg-white border border-slate-200 shadow-sm rounded-3xl p-12 mb-12 text-center">
                <i class="fa-solid fa-network-wired text-4xl md:text-5xl text-blue-500 mb-6"></i>
                <h3 class="text-2xl font-extrabold text-slate-900 mb-4">Comprehensive System Audits</h3>
                <p class="text-slate-600 text-lg leading-relaxed max-w-3xl mx-auto">
                    We offer deep-dive reviews of your existing robotics stack. Whether you are dealing with latency issues in perception pipelines, struggling with determinism in control loops, or planning a massive fleet deployment, our team can identify bottlenecks and prescribe precise technical solutions.
                </p>
            </div>
            
            <div class="text-center">
                <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-blue-600 transition-colors group">
                    <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                    Back to All Services
                </a>
            </div>
        </section>
    @elseif($serviceId === 'rnd')
        <!-- R&D Overview -->
        <section class="relative z-10 max-w-6xl mx-auto px-6 py-12 md:py-24 text-center">
            <div class="mb-16">
                <h2 class="text-4xl font-extrabold text-slate-900 mb-6">Explore Our R&D Divisions</h2>
                <p class="text-slate-600 text-lg max-w-3xl mx-auto">
                    Our Research & Development group is organized into highly specialized departments focused on pushing the frontier of autonomous mobility and advanced robotics.
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8 mb-16">
                <a href="{{ route('services.department', ['service' => 'rnd', 'department' => 'autonomous-cars']) }}" class="group relative bg-white border border-slate-200 rounded-3xl overflow-hidden hover:border-cyan-300 hover:shadow-xl transition-all duration-300">
                    <img src="{{ asset('images/dept_rnd_cars.png') }}" alt="Autonomous Cars" class="w-full h-64 object-cover opacity-90 group-hover:opacity-100 transition-opacity duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-8 text-left">
                        <i class="fa-solid fa-car text-3xl text-cyan-400 mb-4 group-hover:scale-110 transition-transform"></i>
                        <h3 class="text-2xl font-bold text-white mb-2">Autonomous Cars</h3>
                        <p class="text-slate-200 text-sm">Next-generation sensor fusion and level-4 electric vehicle autonomy.</p>
                    </div>
                </a>
                
                <a href="{{ route('services.department', ['service' => 'rnd', 'department' => 'robotics']) }}" class="group relative bg-white border border-slate-200 rounded-3xl overflow-hidden hover:border-emerald-300 hover:shadow-xl transition-all duration-300">
                    <img src="{{ asset('images/dept_rnd_robotics.png') }}" alt="Intelligent Robotics" class="w-full h-64 object-cover opacity-90 group-hover:opacity-100 transition-opacity duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-8 text-left">
                        <i class="fa-solid fa-robot text-3xl text-emerald-400 mb-4 group-hover:scale-110 transition-transform"></i>
                        <h3 class="text-2xl font-bold text-white mb-2">Intelligent Robotics</h3>
                        <p class="text-slate-200 text-sm">Optimization solutions and software intelligence for flexible robotics.</p>
                    </div>
                </a>

                <a href="{{ route('services.department', ['service' => 'rnd', 'department' => 'automotive']) }}" class="group relative bg-white border border-slate-200 rounded-3xl overflow-hidden hover:border-purple-300 hover:shadow-xl transition-all duration-300">
                    <img src="{{ asset('images/dept_out_auto.png') }}" alt="Automotive Software" class="w-full h-64 object-cover opacity-90 group-hover:opacity-100 transition-opacity duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-8 text-left">
                        <i class="fa-solid fa-microchip text-3xl text-purple-400 mb-4 group-hover:scale-110 transition-transform"></i>
                        <h3 class="text-2xl font-bold text-white mb-2">Automotive Software</h3>
                        <p class="text-slate-200 text-sm">Cutting-edge automotive R&D, focusing on embedded innovation.</p>
                    </div>
                </a>
            </div>

            <div class="text-center">
                <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-cyan-600 transition-colors group">
                    <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                    Back to All Services
                </a>
            </div>
        </section>
    @elseif($serviceId === 'outsourcing')
        <!-- Outsourcing Overview -->
        <section class="relative z-10 max-w-6xl mx-auto px-6 py-12 md:py-24 text-center">
            <div class="mb-16">
                <h2 class="text-4xl font-extrabold text-slate-900 mb-6">Explore Our Outsourcing Divisions</h2>
                <p class="text-slate-600 text-lg max-w-3xl mx-auto">
                    Scale your development capacity instantly with our dedicated elite teams, specialized across the automotive and robotics sectors.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8 mb-16">
                <a href="{{ route('services.department', ['service' => 'outsourcing', 'department' => 'automotive']) }}" class="group relative bg-white border border-slate-200 rounded-3xl overflow-hidden hover:border-purple-300 hover:shadow-xl transition-all duration-300">
                    <img src="{{ asset('images/dept_out_auto.png') }}" alt="Automotive Software" class="w-full h-64 object-cover opacity-90 group-hover:opacity-100 transition-opacity duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-8 text-left">
                        <i class="fa-solid fa-car-side text-3xl text-purple-400 mb-4 group-hover:scale-110 transition-transform"></i>
                        <h3 class="text-2xl font-bold text-white mb-2">Automotive Software</h3>
                        <p class="text-slate-200 text-sm">Embedded C++, ISO 26262 compliance, and HIL testing protocols.</p>
                    </div>
                </a>
                
                <a href="{{ route('services.department', ['service' => 'outsourcing', 'department' => 'robotics']) }}" class="group relative bg-white border border-slate-200 rounded-3xl overflow-hidden hover:border-blue-300 hover:shadow-xl transition-all duration-300">
                    <img src="{{ asset('images/dept_out_robotics.png') }}" alt="Robotics Development" class="w-full h-64 object-cover opacity-90 group-hover:opacity-100 transition-opacity duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-8 text-left">
                        <i class="fa-solid fa-robot text-3xl text-blue-400 mb-4 group-hover:scale-110 transition-transform"></i>
                        <h3 class="text-2xl font-bold text-white mb-2">Robotics Development</h3>
                        <p class="text-slate-200 text-sm">Custom ROS nodes, simulation engineering, and hardware integration.</p>
                    </div>
                </a>
            </div>

            <div class="text-center">
                <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-purple-600 transition-colors group">
                    <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                    Back to All Services
                </a>
            </div>
        </section>
    @endif
@endsection
