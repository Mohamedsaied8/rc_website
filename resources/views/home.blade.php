@extends('components.layout')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center overflow-hidden pt-24 pb-12">
        <!-- Ambient Background Effects -->
        <div class="absolute inset-0 bg-grid"></div>
        <div class="absolute top-1/4 -left-32 w-[500px] h-[500px] bg-cyan-500/[0.07] rounded-full blur-[128px] animate-pulse-glow"></div>
        <div class="absolute bottom-1/4 -right-32 w-[400px] h-[400px] bg-emerald-500/[0.05] rounded-full blur-[128px] animate-pulse-glow" style="animation-delay: 1.5s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[600px] bg-cyan-500/[0.03] rounded-full blur-[200px]"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 w-full">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Left: Copy Block -->
                <div class="space-y-8">
                    <!-- Eyebrow Badge -->
                    <div class="animate-fade-in-up inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-white/10 bg-white/[0.03] backdrop-blur-sm">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="text-xs font-medium text-slate-400 tracking-wide uppercase">Now Enrolling — Cohort {{ date('Y') }}</span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="animate-fade-in-up stagger-1 text-5xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight leading-[1.05]">
                        <span class="text-white">Master </span>
                        <span class="text-gradient">Robotics</span>
                        <span class="text-white"> & </span>
                        <br class="hidden sm:block" />
                        <span class="text-gradient">Software Engineering</span>
                    </h1>

                    <!-- Description -->
                    <p class="animate-fade-in-up stagger-2 text-lg sm:text-xl text-slate-400 leading-relaxed max-w-xl">
                        Industry-standard technical education that prepares you for real-world challenges in top tech companies. Learn from experts, build real projects, advance your career.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="animate-fade-in-up stagger-3 flex flex-wrap gap-4">
                        <a href="{{ route('enroll') }}" class="group inline-flex items-center gap-2 px-8 py-4 text-sm font-semibold text-gray-900 bg-gradient-to-r from-cyan-400 to-emerald-400 rounded-xl hover:shadow-2xl hover:shadow-cyan-400/25 transition-all duration-300 hover:-translate-y-0.5">
                            Enroll Now
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </a>
                        <a href="https://youtube.com/shorts/IK9WlW2RYN0?si=hSH5lVHEBznNBSIB" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center gap-2 px-8 py-4 text-sm font-semibold text-white border border-white/15 bg-white/[0.04] backdrop-blur-sm rounded-xl hover:border-white/25 hover:bg-white/[0.07] transition-all duration-300">
                            <svg class="w-4 h-4 text-cyan-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="6 3 20 12 6 21 6 3"/></svg>
                            Watch Demo
                        </a>
                    </div>

                    <!-- Stats Bento Grid -->
                    <div class="animate-fade-in-up stagger-4 grid grid-cols-2 sm:grid-cols-4 gap-3 pt-4">
                        <div class="group relative bg-white/[0.03] backdrop-blur-xl border border-white/[0.06] rounded-xl p-4 hover:border-cyan-400/20 transition-all duration-500">
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-br from-cyan-400/[0.04] to-emerald-400/[0.02] opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-2xl font-bold text-white tracking-tight">500+</span>
                                </div>
                                <span class="text-xs text-slate-500 font-medium">Students Trained</span>
                            </div>
                        </div>
                        <div class="group relative bg-white/[0.03] backdrop-blur-xl border border-white/[0.06] rounded-xl p-4 hover:border-cyan-400/20 transition-all duration-500">
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-br from-cyan-400/[0.04] to-emerald-400/[0.02] opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-2xl font-bold text-white tracking-tight">50+</span>
                                </div>
                                <span class="text-xs text-slate-500 font-medium">Industry Projects</span>
                            </div>
                        </div>
                        <div class="group relative bg-white/[0.03] backdrop-blur-xl border border-white/[0.06] rounded-xl p-4 hover:border-cyan-400/20 transition-all duration-500">
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-br from-cyan-400/[0.04] to-emerald-400/[0.02] opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-2xl font-bold text-white tracking-tight">95%</span>
                                </div>
                                <span class="text-xs text-slate-500 font-medium">Job Placement Rate</span>
                            </div>
                        </div>
                        <div class="group relative bg-white/[0.03] backdrop-blur-xl border border-white/[0.06] rounded-xl p-4 hover:border-cyan-400/20 transition-all duration-500">
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-br from-cyan-400/[0.04] to-emerald-400/[0.02] opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-2xl font-bold text-white tracking-tight">4.9</span>
                                </div>
                                <span class="text-xs text-slate-500 font-medium">Average Rating</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Video Mockup -->
                <div class="animate-fade-in-up stagger-3 relative">
                    <div class="absolute -inset-4 bg-gradient-to-br from-cyan-400/10 via-transparent to-emerald-400/10 rounded-3xl blur-2xl opacity-60"></div>

                    <div class="relative bg-white/[0.02] backdrop-blur-2xl border border-white/[0.08] shadow-2xl rounded-2xl overflow-hidden animate-float" style="animation-duration: 8s;">
                        <div class="flex items-center gap-2 px-4 py-3 border-b border-white/[0.06]">
                            <div class="w-2.5 h-2.5 rounded-full bg-red-400/80"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-yellow-400/80"></div>
                            <div class="w-2.5 h-2.5 rounded-full bg-green-400/80"></div>
                            <span class="ml-3 text-[10px] text-slate-600 font-mono">roboticscorner.tech</span>
                        </div>

                        <div class="aspect-video">
                            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/LEm8_dZao0E?si=uB2COdKa0DSROvYl" title="Robotics Corner - Vision & Mission" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="border-0"></iframe>
                        </div>
                    </div>

                    <div class="absolute -bottom-6 -right-6 w-24 h-24 border border-white/[0.06] rounded-2xl rotate-12 hidden lg:block"></div>
                    <div class="absolute -top-4 -left-4 w-16 h-16 border border-cyan-400/10 rounded-xl -rotate-6 hidden lg:block"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Courses Section -->
    <section id="courses" class="relative py-24 overflow-hidden">
        <div class="absolute inset-0 bg-grid opacity-40"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-cyan-500/[0.03] rounded-full blur-[120px]"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-white/10 bg-white/[0.03] backdrop-blur-sm mb-6">
                    <span class="text-xs font-medium text-slate-400 tracking-wide uppercase">Explore Our Curriculum</span>
                </div>
                <h2 class="text-4xl sm:text-5xl font-bold text-white tracking-tight mb-5">
                    Professional Training <span class="text-gradient">Programs</span>
                </h2>
                <p class="text-lg text-slate-400 leading-relaxed">
                    Comprehensive courses designed with industry experts to bridge the gap between academic learning and professional requirements.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @php
                    $courses = [
                        ['title' => 'Software Engineering Program', 'description' => 'Master Linux fundamentals, Modern C++, OOP, Design Patterns, and DevOps practices.', 'duration' => '12 weeks', 'price' => 1200, 'badge' => 'Professional', 'topics' => ['Linux Fundamentals', 'Modern C++', 'Design Patterns', 'CI/CD & DevOps'], 'slug' => 'software-engineering'],
                        ['title' => 'Robotics for Professionals', 'description' => 'Advanced robotics with ROS2, SLAM, navigation, and simulation.', 'duration' => '8 weeks', 'price' => 1000, 'badge' => 'Professional', 'topics' => ['ROS2', 'SLAM & Navigation', 'Gazebo Simulation', 'Path Planning'], 'slug' => 'robotics'],
                        ['title' => 'Embedded C++ Diploma', 'description' => 'Microcontrollers, RTOS, drivers, and embedded patterns in Modern C++.', 'duration' => '9 weeks', 'price' => 900, 'badge' => 'Professional', 'topics' => ['Cortex-M', 'FreeRTOS', 'I2C/SPI/UART', 'Embedded Patterns'], 'slug' => 'embedded-systems'],
                        ['title' => 'Technical Leadership', 'description' => 'Leadership, communication, agile, and project management for engineers.', 'duration' => '6 weeks', 'price' => 800, 'badge' => 'Professional', 'topics' => ['Agile & Scrum', 'Team Leadership', 'Project Planning', 'Risk Assessment'], 'slug' => 'technical-leadership'],
                        ['title' => 'Python Fundamentals', 'description' => 'Python programming for robotics applications and data science.', 'duration' => '4 weeks', 'price' => 400, 'badge' => 'Professional', 'topics' => ['Python Basics', 'NumPy & Pandas', 'OpenCV', 'Flask APIs'], 'slug' => 'python'],
                        ['title' => 'AI & Machine Learning', 'description' => 'AI and ML techniques for robotics and autonomous systems.', 'duration' => '10 weeks', 'price' => 1500, 'badge' => 'Professional', 'topics' => ['TensorFlow/PyTorch', 'Computer Vision', 'Reinforcement Learning', 'Sensor Fusion'], 'slug' => 'ai'],
                    ];
                @endphp

                @foreach($courses as $index => $course)
                    <div class="animate-fade-in-up stagger-{{ $index + 1 }}">
                        @include('components.course-card', $course)
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('programs.index') }}" class="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-white border border-white/15 bg-white/[0.04] backdrop-blur-sm rounded-xl hover:border-white/25 hover:bg-white/[0.07] transition-all duration-300">
                    View All Programs
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="relative py-24 overflow-hidden border-t border-white/[0.06]">
        <div class="absolute inset-0 bg-white/[0.02]"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl font-bold text-white tracking-tight mb-5">Why Choose <span class="text-gradient">Robotics Corner</span>?</h2>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white/[0.03] backdrop-blur-xl border border-white/[0.06] rounded-2xl p-8 text-center hover:border-cyan-400/20 transition-all">
                    <div class="text-4xl mb-4">🎓</div>
                    <h3 class="text-xl font-bold text-white mb-3">Industry Experts</h3>
                    <p class="text-slate-400">Learn directly from professionals working in top tech companies who bring real-world experience to the classroom.</p>
                </div>
                <div class="bg-white/[0.03] backdrop-blur-xl border border-white/[0.06] rounded-2xl p-8 text-center hover:border-cyan-400/20 transition-all">
                    <div class="text-4xl mb-4">💻</div>
                    <h3 class="text-xl font-bold text-white mb-3">Hands-on Projects</h3>
                    <p class="text-slate-400">Build a portfolio of real-world projects that demonstrate your skills to potential employers.</p>
                </div>
                <div class="bg-white/[0.03] backdrop-blur-xl border border-white/[0.06] rounded-2xl p-8 text-center hover:border-cyan-400/20 transition-all">
                    <div class="text-4xl mb-4">🚀</div>
                    <h3 class="text-xl font-bold text-white mb-3">Career Support</h3>
                    <p class="text-slate-400">Get assistance with resume building, interview preparation, and job placement through our partner network.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-32 overflow-hidden">
        <div class="pointer-events-none absolute inset-0" aria-hidden="true">
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-[900px] h-[900px] rounded-full" style="background: radial-gradient(circle, rgba(34,211,238,0.18) 0%, transparent 70%);"></div>
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-[1100px] h-[1100px] rounded-full" style="background: radial-gradient(circle, rgba(52,211,153,0.12) 0%, transparent 65%);"></div>
        </div>

        <div class="relative z-10 mx-auto max-w-3xl px-6 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-white/10 bg-white/[0.03] backdrop-blur-sm mb-8">
                <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                <span class="text-xs font-medium text-slate-400 tracking-wide uppercase">Start Your Journey</span>
            </div>

            <h2 class="text-4xl font-bold text-white sm:text-5xl lg:text-6xl leading-tight tracking-tight">
                Ready to Transform Your <span class="text-gradient">Career</span>?
            </h2>

            <p class="mt-6 text-lg text-slate-400 leading-relaxed">
                Join thousands of professionals who have advanced their careers with our industry-leading technical education programs.
            </p>

            <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('programs.index') }}" class="rounded-xl bg-gradient-to-r from-cyan-400 to-emerald-400 px-8 py-4 font-semibold text-gray-900 shadow-lg shadow-cyan-500/20 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-cyan-400/30 active:scale-[0.98]">
                    Explore Programs
                </a>
                <a href="https://wa.me/201111159633" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2.5 rounded-xl border border-white/20 bg-white/5 px-8 py-4 font-semibold text-white backdrop-blur-md transition-all duration-300 hover:scale-105 hover:bg-white/10 hover:border-white/30 active:scale-[0.98]">
                    <svg class="h-5 w-5 fill-current text-green-400" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Chat with Us
                </a>
            </div>

            <p class="mt-8 text-sm text-slate-500 flex items-center justify-center gap-2">
                <span class="text-emerald-400">✓</span>
                Get instant answers to your questions via WhatsApp
            </p>
        </div>
    </section>
@endsection