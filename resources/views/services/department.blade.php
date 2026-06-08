@extends('components.layout')

@section('title', $departmentTitle . ' - Corporate Services')

@php
    $imagePath = '';
    $description1 = '';
    $description2 = '';
    $features = [];
    $btnClass = '';
    $iconClass = '';
    $borderClass = '';
    $textHoverClass = '';

    if ($serviceId === 'rnd') {
        if ($departmentId === 'autonomous-cars') {
            $imagePath = 'dept_rnd_cars.png';
            $description1 = "Our Autonomous Cars R&D division pushes the envelope of electric vehicle autonomy. We partner with tier-1 manufacturers to develop proprietary sensor fusion algorithms and self-driving stacks that exceed level 4 autonomy requirements.";
            $description2 = "From perception pipelines running on edge accelerators to full-scale path planning and control loops, our engineers deliver highly deterministic systems ready for the road.";
            $features = [
                ['title' => 'Sensor Fusion', 'desc' => 'Integrating LiDAR, Radar, and visual data for 360-degree environmental awareness.', 'icon' => 'fa-eye'],
                ['title' => 'Path Planning', 'desc' => 'Advanced routing algorithms ensuring safe and optimal trajectories in complex urban environments.', 'icon' => 'fa-route'],
                ['title' => 'Deterministic Control', 'desc' => 'Low-latency actuation and steering systems powered by deterministic real-time operating systems.', 'icon' => 'fa-microchip']
            ];
            $btnClass = 'from-cyan-500 to-cyan-600 shadow-cyan-500/30';
            $iconClass = 'text-cyan-500';
            $borderClass = 'border-t-cyan-500';
            $textHoverClass = 'hover:text-cyan-600';
        } else if ($departmentId === 'robotics') {
            $imagePath = 'dept_rnd_robotics.png';
            $departmentTitle = 'Intelligent Robotics';
            $description1 = "Robotics Corner positions its Robotics Sector Department as a specialized provider of third-party software and optimization solutions for robotics applications. The main focus is not to manufacture robot hardware, but to develop the software intelligence that allows robots to become more flexible, efficient, adaptive, and useful in real industrial, educational, and research environments.";
            $description2 = "The scientific strength of this service comes from combining robotics, software engineering, control theory, artificial intelligence, and mathematical optimization. We develop software that assigns tasks, schedules operations, avoids conflicts, reduces waiting time, and improves the overall productivity of the system.";
            $features = [
                ['title' => 'Software Intelligence', 'desc' => 'Developing the missing software layer that makes robots more useful, flexible, and efficient.', 'icon' => 'fa-brain'],
                ['title' => 'Optimization', 'desc' => 'Applying concepts like trajectory optimization, feedback control, and constraint-based planning.', 'icon' => 'fa-chart-line'],
                ['title' => 'Advanced Tech', 'desc' => 'Leveraging computer vision, sensor fusion, machine learning, and digital twin simulation.', 'icon' => 'fa-microchip']
            ];
            $btnClass = 'from-emerald-500 to-emerald-600 shadow-emerald-500/30';
            $iconClass = 'text-emerald-500';
            $borderClass = 'border-t-emerald-500';
            $textHoverClass = 'hover:text-emerald-600';
        } else if ($departmentId === 'automotive') {
            $imagePath = 'dept_out_auto.png';
            $departmentTitle = 'Automotive Software R&D';
            $description1 = "Our Automotive Software R&D division focuses on inventing the future of in-vehicle intelligence and next-generation mobility platforms. We work on cutting-edge research to build the software architectures that define tomorrow's smart vehicles.";
            $description2 = "From advanced driver-assistance systems (ADAS) to connected car telemetry and embedded cybersecurity, our R&D engineers develop the core intellectual property that automotive giants rely on for innovation.";
            $features = [
                ['title' => 'Next-Gen ADAS', 'desc' => 'Researching and prototyping the next wave of driver assistance algorithms.', 'icon' => 'fa-car-burst'],
                ['title' => 'V2X Communication', 'desc' => 'Developing Vehicle-to-Everything connectivity protocols for smart cities.', 'icon' => 'fa-satellite-dish'],
                ['title' => 'Embedded Security', 'desc' => 'Creating robust cybersecurity frameworks for critical automotive systems.', 'icon' => 'fa-shield-halved']
            ];
            $btnClass = 'from-purple-500 to-purple-600 shadow-purple-500/30';
            $iconClass = 'text-purple-500';
            $borderClass = 'border-t-purple-500';
            $textHoverClass = 'hover:text-purple-600';
        }
    } else if ($serviceId === 'outsourcing') {
        if ($departmentId === 'automotive') {
            $imagePath = 'dept_out_auto.png';
            $description1 = "Our Automotive Outsourcing division provides dedicated teams of elite software engineers to automotive giants. We scale your development capacity instantly without compromising code quality.";
            $description2 = "From embedded C++ development for ECU firmware to cloud-connected fleet management systems, our offshore teams integrate seamlessly with your internal development pipelines.";
            $features = [
                ['title' => 'Embedded Systems', 'desc' => 'Low-level firmware development adhering to MISRA C++ and ISO 26262 standards.', 'icon' => 'fa-microchip'],
                ['title' => 'Fleet Management', 'desc' => 'Scalable backend architectures for telemetry ingestion and OTA updates.', 'icon' => 'fa-cloud'],
                ['title' => 'QA & Testing', 'desc' => 'Rigorous automated hardware-in-the-loop (HIL) testing protocols.', 'icon' => 'fa-vial-circle-check']
            ];
            $btnClass = 'from-purple-500 to-purple-600 shadow-purple-500/30';
            $iconClass = 'text-purple-500';
            $borderClass = 'border-t-purple-500';
            $textHoverClass = 'hover:text-purple-600';
        } else if ($departmentId === 'robotics') {
            $imagePath = 'dept_out_robotics.png';
            $departmentTitle = 'Robotics Development';
            $description1 = "Our Robotics Development outsourcing service accelerates your robotics startups by providing world-class developers. We serve as a specialized provider of third-party software and optimization solutions, acting as the missing software layer for your robotic systems.";
            $description2 = "We bring scientific strength combining software engineering, control theory, and artificial intelligence to your team. We handle the heavy lifting of developing flexible, adaptive software intelligence so you can focus on core hardware and business operations.";
            $features = [
                ['title' => 'Custom Software', 'desc' => 'Providing the software intelligence needed for real industrial and research applications.', 'icon' => 'fa-laptop-code'],
                ['title' => 'Algorithm Integration', 'desc' => 'Integrating kinematics, machine learning, and reinforcement learning into your stack.', 'icon' => 'fa-gears'],
                ['title' => 'Dedicated Teams', 'desc' => 'Elite engineers acting as an extension of your company to add optimization capabilities.', 'icon' => 'fa-users']
            ];
            $btnClass = 'from-blue-500 to-blue-600 shadow-blue-500/30';
            $iconClass = 'text-blue-500';
            $borderClass = 'border-t-blue-500';
            $textHoverClass = 'hover:text-blue-600';
        }
    }
@endphp

@section('content')
    @include('components.page-hero', [
        'title' => $departmentTitle,
        'subtitle' => 'Deep-dive into our specialized engineering capabilities.'
    ])

    <section class="relative z-10 max-w-7xl mx-auto px-6 py-24">
        <div class="grid lg:grid-cols-2 gap-16 items-center mb-24">
            <div>
                <h2 class="text-4xl font-extrabold text-slate-900 mb-8">{{ $departmentTitle }}</h2>
                <p class="text-slate-600 text-xl leading-relaxed mb-6">
                    {{ $description1 }}
                </p>
                <p class="text-slate-600 text-lg leading-relaxed mb-8">
                    {{ $description2 }}
                </p>
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r {{ $btnClass }} rounded-xl text-white font-bold shadow-lg hover:scale-105 transition-transform duration-300">
                    Engage Our Team
                </a>
            </div>
            <div class="relative rounded-3xl overflow-hidden border border-slate-200 shadow-xl">
                <img src="{{ asset('images/' . $imagePath) }}" alt="{{ $departmentTitle }}" class="w-full object-cover h-[500px]">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent"></div>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-8 mb-24">
            @foreach($features as $feature)
                <div class="bg-white border border-slate-200 shadow-sm rounded-2xl p-8 hover:shadow-lg hover:border-slate-300 transition-all duration-300 border-t-4 {{ $borderClass }}">
                    <i class="fa-solid {{ $feature['icon'] }} text-4xl {{ $iconClass }} mb-6"></i>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-4">{{ $feature['title'] }}</h3>
                    <p class="text-slate-600 leading-relaxed">{{ $feature['desc'] }}</p>
                </div>
            @endforeach
        </div>
        
        <div class="text-center">
            <a href="{{ route('services.show', $serviceId) }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 {{ $textHoverClass }} transition-colors group">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                Back to {{ strtoupper($serviceId) }} Overview
            </a>
        </div>
    </section>
@endsection
