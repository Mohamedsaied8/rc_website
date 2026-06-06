@extends('components.layout')

@section('title', 'About Us - Robotics Corner')

@section('content')
    @include('components.page-hero', [
        'title' => 'About Robotics Corner',
        'subtitle' => 'Empowering engineers with cutting-edge robotics and software engineering skills'
    ])

    <section class="relative z-10 max-w-3xl mx-auto px-6 py-16">
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-white mb-3">Our Mission</h2>
            <p class="text-slate-400 leading-relaxed">
                To bridge the gap between academic learning and industry requirements by providing hands-on, project-based education in robotics, embedded systems, and software engineering.
            </p>
        </div>
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-white mb-3">Our Vision</h2>
            <p class="text-slate-400 leading-relaxed">
                To be the leading technical education platform that transforms engineers into industry-ready professionals through innovative learning methodologies and real-world project experience.
            </p>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-white mb-3">Our Impact</h2>
            <p class="text-slate-400 leading-relaxed">
                Since our founding, we have trained over 500 professionals who are now working in top tech companies worldwide. Our graduates have a 95% job placement rate and consistently receive high ratings from employers.
            </p>
        </div>
    </section>

    <section class="relative z-10 bg-white/[0.02] py-16 border-y border-white/[0.06]">
        <div class="max-w-4xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-white text-center mb-12">Our Journey</h2>
            <div class="space-y-6">
                @foreach($milestones ?? [
                    ['year' => '2020', 'title' => 'Founded', 'description' => 'Robotics Corner was established with a vision to bridge the gap between academic learning and industry requirements.'],
                    ['year' => '2021', 'title' => 'First Cohort', 'description' => 'Graduated our first batch of 50 students with 95% job placement rate.'],
                    ['year' => '2022', 'title' => 'Industry Partnerships', 'description' => 'Established partnerships with leading tech companies for internships and job placements.'],
                    ['year' => '2023', 'title' => '500+ Graduates', 'description' => 'Celebrated training over 500 professionals now working in top tech companies.'],
                    ['year' => '2024', 'title' => 'Expansion', 'description' => 'Launched advanced programs in AI, robotics, and embedded systems.']
                ] as $item)
                    <div class="bg-white/[0.03] border border-white/[0.06] backdrop-blur-xl rounded-2xl p-6 flex flex-col sm:flex-row gap-6 hover:border-cyan-400/20 transition-all duration-300">
                        <div class="text-3xl font-extrabold text-gradient min-w-[80px]">
                            {{ $item['year'] }}
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-1">{{ $item['title'] }}</h3>
                            <p class="text-sm text-slate-400 leading-relaxed">{{ $item['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="relative z-10 py-16 max-w-5xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-white text-center mb-12">Meet Our Expert Instructors</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($instructors ?? [
                ['name' => 'Mohamed Saied', 'role' => 'CTO & Lead Instructor', 'expertise' => 'Software Engineering & System Architecture', 'experience' => '15+ years experience', 'image' => '👨‍💻'],
                ['name' => 'Dr. Sarah Ahmed', 'role' => 'Robotics Specialist', 'expertise' => 'ROS2 & Computer Vision & SLAM', 'experience' => '12+ years experience', 'image' => '👩‍🔬'],
                ['name' => 'Ahmed Hassan', 'role' => 'Embedded Systems Expert', 'expertise' => 'Cortex-M & RTOS & Hardware Design', 'experience' => '10+ years experience', 'image' => '👨‍🔧']
            ] as $instructor)
                <div class="bg-white/[0.03] border border-white/[0.06] backdrop-blur-xl rounded-2xl p-8 text-center hover:border-cyan-400/20 transition-all duration-500">
                    <div class="text-5xl mb-4">{{ $instructor['image'] }}</div>
                    <h3 class="text-lg font-semibold text-white">{{ $instructor['name'] }}</h3>
                    <p class="text-sm text-cyan-400 font-medium mt-1">{{ $instructor['role'] }}</p>
                    <p class="text-sm text-slate-400 mt-3">{{ $instructor['expertise'] }}</p>
                    <p class="text-xs text-slate-500 mt-2">{{ $instructor['experience'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="relative z-10 py-16 text-center px-6">
        <h2 class="text-3xl font-bold text-white mb-4">Ready to Start Your Journey?</h2>
        <p class="text-slate-400 mb-8 max-w-2xl mx-auto">
            Join our community of successful engineers and advance your career with cutting-edge technology
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('enroll') }}" class="px-8 py-3 bg-gradient-to-r from-cyan-400 to-emerald-400 text-gray-900 font-semibold rounded-xl hover:shadow-lg hover:shadow-cyan-400/20 transition-all duration-300 w-full sm:w-auto">
                Enroll Now
            </a>
            <a href="{{ route('contact') }}" class="px-8 py-3 border border-white/15 bg-white/[0.04] text-white font-semibold rounded-xl hover:border-white/25 hover:bg-white/[0.08] transition-all duration-300 w-full sm:w-auto">
                Contact Us
            </a>
        </div>
    </section>
@endsection