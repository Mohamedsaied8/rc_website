@extends('components.layout')

@section('title', 'Robotics Software Outsourcing - Robotics Corner')

@section('content')

{{-- ===== SECTION 1: HERO ===== --}}
<section class="relative min-h-[90vh] flex items-center overflow-hidden pt-24 pb-16">

    {{-- Background layer --}}
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_30%_20%,_var(--tw-gradient-stops))] from-blue-200/40 via-slate-50 to-slate-50"></div>
        <div class="absolute top-1/4 -left-32 w-[600px] h-[600px] bg-blue-400/20 rounded-full blur-[160px] animate-pulse-glow"></div>
        <div class="absolute bottom-1/4 -right-32 w-[500px] h-[500px] bg-teal-500/15 rounded-full blur-[140px] animate-pulse-glow" style="animation-delay: 1.5s;"></div>
        <div class="absolute top-1/3 right-1/4 w-2 h-2 bg-blue-400 rounded-full animate-ping"></div>
        <div class="absolute bottom-1/3 left-1/4 w-1.5 h-1.5 bg-teal-400 rounded-full animate-ping" style="animation-delay: 0.5s"></div>
    </div>

    <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">

        {{-- Badge --}}
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/80 border border-blue-200 shadow-sm mb-8 animate-fade-in-up">
            <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
            <span class="text-xs font-bold text-blue-700 tracking-wider uppercase">Robotics Software Outsourcing</span>
        </div>

        {{-- Headline --}}
        <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 tracking-tight leading-[1.05] mb-8 animate-fade-in-up" style="animation-delay: 100ms;">
            Your Robotics Vision.
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-teal-500">Our Engineering Team.</span>
            <span class="block text-3xl md:text-4xl font-bold text-slate-700 mt-4">Dedicated Robotics Software Development</span>
        </h1>

        {{-- Subheadline --}}
        <p class="text-xl md:text-2xl text-slate-600 max-w-3xl mx-auto leading-relaxed font-medium mb-12 animate-fade-in-up" style="animation-delay: 200ms;">
            We don't consult from the sidelines. We <span class="text-blue-700 font-bold">embed as your dedicated robotics software unit</span> — writing code, shipping solutions, and scaling with your project.
        </p>

        {{-- CTA buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in-up" style="animation-delay: 300ms;">
            <a href="{{ route('contact') }}" class="group inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-blue-600 to-teal-500 text-white font-bold rounded-xl shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-1 transition-all duration-300">
                <span>Book a Scoping Call</span>
                <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
            <a href="#how-we-engage" class="group inline-flex items-center gap-2 px-8 py-4 bg-white border border-slate-300 text-slate-700 font-bold rounded-xl hover:bg-slate-50 hover:-translate-y-1 transition-all duration-300">
                <span>How We Engage</span>
                <i class="fa-solid fa-chevron-down text-sm group-hover:translate-y-0.5 transition-transform"></i>
            </a>
        </div>

        {{-- Floating stats --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-3xl mx-auto mt-20 animate-fade-in-up" style="animation-delay: 400ms;">
            <div class="text-center">
                <div class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-teal-500">&lt;5</div>
                <div class="text-xs text-slate-500 uppercase tracking-wider font-bold mt-1">Days to First PR</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-extrabold text-slate-900">3</div>
                <div class="text-xs text-slate-500 uppercase tracking-wider font-bold mt-1">Engagement Models</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-extrabold text-slate-900">100%</div>
                <div class="text-xs text-slate-500 uppercase tracking-wider font-bold mt-1">Robotics Specialist</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-extrabold text-slate-900">∞</div>
                <div class="text-xs text-slate-500 uppercase tracking-wider font-bold mt-1">Vendor Agnostic</div>
            </div>
        </div>

    </div>
</section>

{{-- ===== SECTION 2: ENGAGEMENT MODELS ===== --}}
<section id="how-we-engage" class="relative py-12 md:py-28 bg-white border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center max-w-3xl mx-auto mb-16 reveal-on-scroll">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-slate-200 shadow-sm mb-6">
                <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                <span class="text-xs font-bold text-blue-700 uppercase tracking-wide">Engagement Models</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-5">
                Choose <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-teal-500">How We Work Together</span>
            </h2>
            <p class="text-slate-600 text-lg">Three proven models for robotics software engagement — pick what fits your project stage and team structure.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">

            {{-- Card 1: Embedded Team --}}
            <div class="group relative bg-white border border-slate-200 rounded-[2rem] overflow-hidden hover:border-blue-300 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 reveal-on-scroll" data-delay="100">
                <div class="h-2 bg-gradient-to-r from-blue-500 to-teal-400"></div>
                <div class="p-8">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 border border-blue-200 flex items-center justify-center mb-6">
                        <i class="fa-solid fa-users text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-3 group-hover:text-blue-600 transition-colors">Embedded Team</h3>
                    <p class="text-slate-600 mb-6">Dedicated engineers join your project full-time, using your tools, your repo, your sprint cadence. You get a team that acts like it was hired — because it was.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-blue-50 border border-blue-200 rounded-full text-xs font-bold text-blue-700">Long-term integration</span>
                        <span class="px-3 py-1 bg-blue-50 border border-blue-200 rounded-full text-xs font-bold text-blue-700">Evolving scope</span>
                    </div>
                </div>
            </div>

            {{-- Card 2: Project Delivery --}}
            <div class="group relative bg-white border border-slate-200 rounded-[2rem] overflow-hidden hover:border-blue-300 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 reveal-on-scroll" data-delay="200">
                <div class="h-2 bg-gradient-to-r from-blue-500 to-teal-400"></div>
                <div class="p-8">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 border border-blue-200 flex items-center justify-center mb-6">
                        <i class="fa-solid fa-box-archive text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-3 group-hover:text-blue-600 transition-colors">Project Delivery</h3>
                    <p class="text-slate-600 mb-6">You hand us a defined scope. We architect, build, test, and deliver the working module end-to-end. No hand-holding required from your side.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-blue-50 border border-blue-200 rounded-full text-xs font-bold text-blue-700">Fixed-scope delivery</span>
                        <span class="px-3 py-1 bg-blue-50 border border-blue-200 rounded-full text-xs font-bold text-blue-700">Clear milestones</span>
                    </div>
                </div>
            </div>

            {{-- Card 3: On-Demand Expert --}}
            <div class="group relative bg-white border border-slate-200 rounded-[2rem] overflow-hidden hover:border-blue-300 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 reveal-on-scroll" data-delay="300">
                <div class="h-2 bg-gradient-to-r from-blue-500 to-teal-400"></div>
                <div class="p-8">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 border border-blue-200 flex items-center justify-center mb-6">
                        <i class="fa-solid fa-bolt text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-3 group-hover:text-blue-600 transition-colors">On-Demand Expert</h3>
                    <p class="text-slate-600 mb-6">Flexible hours for code reviews, architecture sessions, or specialist deep-dives when you need a specific skill without committing to a full engagement.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-blue-50 border border-blue-200 rounded-full text-xs font-bold text-blue-700">Architecture review</span>
                        <span class="px-3 py-1 bg-blue-50 border border-blue-200 rounded-full text-xs font-bold text-blue-700">Short engagements</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



{{-- ===== SECTION 4: TECH STACK COMPETENCY MATRIX ===== --}}
<section class="relative py-12 md:py-20 bg-slate-900 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center max-w-2xl mx-auto mb-12 reveal-on-scroll">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 mb-6">
                <span class="text-xs font-bold text-teal-400 uppercase tracking-wider">Engineering Stack</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-4">
                What We <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-teal-400">Code In</span>
            </h2>
            <p class="text-slate-400 text-lg">No generalist developers. Every engineer here lives in the robotics stack.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 reveal-on-scroll" data-delay="100">
                <div class="flex items-center gap-3 mb-4">
                    <i class="fa-solid fa-network-wired text-teal-400 text-lg"></i>
                    <span class="text-xs font-bold text-teal-400 uppercase tracking-widest">Middleware & Frameworks</span>
                </div>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">ROS2</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">ROS Noetic</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">MQTT</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">OPC-UA</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">DDS</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">micro-ROS</span>
                </div>
            </div>

            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 reveal-on-scroll" data-delay="200">
                <div class="flex items-center gap-3 mb-4">
                    <i class="fa-solid fa-code text-teal-400 text-lg"></i>
                    <span class="text-xs font-bold text-teal-400 uppercase tracking-widest">Languages</span>
                </div>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">Python 3.x</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">C++17</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">Bash</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">YAML</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">CMake</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">XML</span>
                </div>
            </div>

            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 reveal-on-scroll" data-delay="300">
                <div class="flex items-center gap-3 mb-4">
                    <i class="fa-solid fa-cube text-teal-400 text-lg"></i>
                    <span class="text-xs font-bold text-teal-400 uppercase tracking-widest">Simulation</span>
                </div>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">Gazebo Classic</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">Gazebo Ignition</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">Webots</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">RViz2</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">URDF/XACRO</span>
                </div>
            </div>

            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 reveal-on-scroll" data-delay="100">
                <div class="flex items-center gap-3 mb-4">
                    <i class="fa-solid fa-eye text-teal-400 text-lg"></i>
                    <span class="text-xs font-bold text-teal-400 uppercase tracking-widest">AI & Perception</span>
                </div>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">OpenCV</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">PyTorch</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">YOLO v8</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">TensorRT</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">PCL</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">Open3D</span>
                </div>
            </div>

            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 reveal-on-scroll" data-delay="200">
                <div class="flex items-center gap-3 mb-4">
                    <i class="fa-solid fa-gears text-teal-400 text-lg"></i>
                    <span class="text-xs font-bold text-teal-400 uppercase tracking-widest">DevOps & Delivery</span>
                </div>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">Docker</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">GitHub Actions</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">GitLab CI</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">pytest</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">Robot Framework</span>
                </div>
            </div>

            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 reveal-on-scroll" data-delay="300">
                <div class="flex items-center gap-3 mb-4">
                    <i class="fa-solid fa-robot text-teal-400 text-lg"></i>
                    <span class="text-xs font-bold text-teal-400 uppercase tracking-widest">Robot Vendors</span>
                </div>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">FANUC</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">KUKA</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">ABB</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">Universal Robots</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">Yaskawa</span>
                    <span class="px-3 py-1.5 bg-white/10 border border-white/10 rounded-lg text-sm font-semibold text-slate-200 hover:bg-white/20 transition-colors">Doosan</span>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ===== SECTION 5: CI/CD PIPELINE ANIMATOR ===== --}}
<section class="relative py-12 md:py-28 bg-white border-t border-slate-200">
    <div class="max-w-6xl mx-auto px-6">

        <div class="text-center max-w-3xl mx-auto mb-16 reveal-on-scroll">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-teal-50 border border-teal-200 shadow-sm mb-6">
                <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                <span class="text-xs font-bold text-teal-700 uppercase tracking-wide">Delivery Process</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-5">
                CI/CD Pipeline: From Commit to <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-teal-500">Robot Fleet</span>
            </h2>
            <p class="text-slate-600 text-lg">This is exactly how your software goes from a developer's machine to production hardware. No black boxes.</p>
        </div>

        <div class="bg-white border border-slate-200 rounded-3xl shadow-2xl overflow-hidden p-8 md:p-12 reveal-on-scroll" data-delay="200">

            {{-- Controls bar --}}
            <div class="hidden">
                <div class="flex items-center gap-3 mb-10">
                    <button id="trigger-build-btn" onclick="triggerBuild()" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-teal-500 text-white text-sm font-bold rounded-xl">Trigger Build</button>
                    <button id="toggle-success" onclick="setScenario('success')">Success</button>
                    <button id="toggle-fail" onclick="setScenario('fail')">Fail</button>
                </div>
            </div>
            
            <div class="flex justify-end mb-4 h-8">
                <span id="pipeline-status-badge" class="hidden inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold"></span>
            </div>

            {{-- Pipeline SVG --}}
            <div class="w-full overflow-x-auto">
                <svg id="pipeline-svg" viewBox="0 0 900 200" xmlns="http://www.w3.org/2000/svg" class="w-full min-w-[700px]">
                    {{-- Built entirely by JS --}}
                </svg>
            </div>

            {{-- Stage tooltip panel --}}
            <div id="stage-tooltip" class="hidden mt-6 p-5 bg-slate-50 border border-slate-200 rounded-2xl transition-all">
                <h4 id="tooltip-title" class="font-bold text-slate-900 mb-1"></h4>
                <p id="tooltip-body" class="text-slate-600 text-sm leading-relaxed"></p>
            </div>

        </div>
    </div>
</section>

{{-- ===== SECTION 6: HOW WE WORK ===== --}}
<section class="relative py-12 md:py-28 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center max-w-3xl mx-auto mb-16 reveal-on-scroll">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-slate-200 shadow-sm mb-6">
                <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                <span class="text-xs font-bold text-blue-700 uppercase tracking-wide">Our Process</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-5">
                How We <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-teal-500">Work</span>
            </h2>
            <p class="text-slate-600 text-lg">No surprise handoffs, no long silence, no junior engineers handed the real work. Here's what working with us actually looks like.</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-16 items-start">

            {{-- Left: How we work items --}}
            <div class="space-y-6 reveal-on-scroll">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-200 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-rocket text-blue-600"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 mb-1">Fast Onboarding</h4>
                        <p class="text-slate-600 text-sm">3–5 day codebase ramp-up. First pull request delivered within the first sprint — not the third.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-200 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-comments text-blue-600"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 mb-1">Daily Communication</h4>
                        <p class="text-slate-600 text-sm">Async standups on Slack or Discord. Weekly video sync. Sprint reviews every 2 weeks — always with working software to show.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-200 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-wrench text-blue-600"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 mb-1">Your Tools, Not Ours</h4>
                        <p class="text-slate-600 text-sm">We adapt to your stack — GitHub, GitLab, Jira, Notion, Linear. No migration, no disruption.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-200 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-globe text-blue-600"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 mb-1">MENA Timezone</h4>
                        <p class="text-slate-600 text-sm">Based in Egypt. Overlap-friendly with EU business hours (GMT+2) and Gulf-region clients.</p>
                    </div>
                </div>
            </div>

            {{-- Right: Vertical stepper --}}
            <div class="space-y-0 reveal-on-scroll" data-delay="200">

                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-600 to-teal-500 flex items-center justify-center text-white text-xs font-bold shrink-0">1</div>
                        <div class="w-0.5 flex-1 bg-gradient-to-b from-blue-300 to-teal-300 mt-2 mb-2 min-h-[32px]"></div>
                    </div>
                    <div class="pb-8">
                        <div class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">Day 1–3</div>
                        <h4 class="font-bold text-slate-900 mb-1">Access & environment setup</h4>
                        <p class="text-slate-500 text-sm">Repo access, Docker environment, architecture walkthrough with your lead engineer.</p>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-600 to-teal-500 flex items-center justify-center text-white text-xs font-bold shrink-0">2</div>
                        <div class="w-0.5 flex-1 bg-gradient-to-b from-blue-300 to-teal-300 mt-2 mb-2 min-h-[32px]"></div>
                    </div>
                    <div class="pb-8">
                        <div class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">Day 4–5</div>
                        <h4 class="font-bold text-slate-900 mb-1">Code review & architecture alignment</h4>
                        <p class="text-slate-500 text-sm">First PR reviewed. Stack conventions agreed. Backlog groomed together.</p>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-600 to-teal-500 flex items-center justify-center text-white text-xs font-bold shrink-0">3</div>
                        <div class="w-0.5 flex-1 bg-gradient-to-b from-blue-300 to-teal-300 mt-2 mb-2 min-h-[32px]"></div>
                    </div>
                    <div class="pb-8">
                        <div class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">Week 2</div>
                        <h4 class="font-bold text-slate-900 mb-1">First feature module delivered</h4>
                        <p class="text-slate-500 text-sm">A working, tested software module committed and demonstrated.</p>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-600 to-teal-500 flex items-center justify-center text-white text-xs font-bold shrink-0">4</div>
                    </div>
                    <div class="pb-4">
                        <div class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">Week 3+</div>
                        <h4 class="font-bold text-slate-900 mb-1">Full sprint velocity</h4>
                        <p class="text-slate-500 text-sm">Regular delivery rhythm. Demos every sprint. Continuous improvement.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- ===== SECTION 7: WHO WE'VE BUILT FOR ===== --}}
<section class="relative py-12 md:py-28 bg-white border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center max-w-3xl mx-auto mb-16 reveal-on-scroll">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-teal-50 border border-teal-200 shadow-sm mb-6">
                <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                <span class="text-xs font-bold text-teal-700 uppercase tracking-wide">Client Profiles</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-5">
                Who We <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-teal-500">Build For</span>
            </h2>
            <p class="text-slate-600 text-lg">Different teams. Same problem — not enough specialized robotics engineers. We fix that.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">

            <div class="group relative bg-white border border-slate-200 rounded-[2rem] overflow-hidden hover:border-blue-300 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 reveal-on-scroll" data-delay="100">
                <div class="h-1 bg-gradient-to-r from-blue-500 to-teal-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="p-8">
                    <div class="w-14 h-14 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center mb-6 group-hover:border-blue-200 group-hover:bg-blue-50 transition-all duration-300">
                        <i class="fa-solid fa-industry text-2xl text-slate-600 group-hover:text-blue-600 transition-colors duration-300"></i>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-2 group-hover:text-blue-700 transition-colors">Industrial Manufacturers</h3>
                    <p class="text-slate-600 mb-5">Need robotic arm software for welding, assembly, or pick-and-place lines — but don't have an in-house robotics engineering team.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs font-bold text-slate-500 mr-1">Common scope:</span>
                        <span class="px-2.5 py-1 bg-blue-50 border border-blue-100 rounded-full text-xs font-semibold text-blue-700">Arm trajectory planning</span>
                        <span class="px-2.5 py-1 bg-blue-50 border border-blue-100 rounded-full text-xs font-semibold text-blue-700">PLC integration</span>
                        <span class="px-2.5 py-1 bg-blue-50 border border-blue-100 rounded-full text-xs font-semibold text-blue-700">Gripper control</span>
                    </div>
                </div>
            </div>

            <div class="group relative bg-white border border-slate-200 rounded-[2rem] overflow-hidden hover:border-blue-300 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 reveal-on-scroll" data-delay="200">
                <div class="h-1 bg-gradient-to-r from-blue-500 to-teal-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="p-8">
                    <div class="w-14 h-14 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center mb-6 group-hover:border-blue-200 group-hover:bg-blue-50 transition-all duration-300">
                        <i class="fa-solid fa-warehouse text-2xl text-slate-600 group-hover:text-blue-600 transition-colors duration-300"></i>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-2 group-hover:text-blue-700 transition-colors">Logistics & Warehousing</h3>
                    <p class="text-slate-600 mb-5">AMR fleets that need SLAM navigation, fleet scheduling, and WMS integration to hit throughput targets.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs font-bold text-slate-500 mr-1">Common scope:</span>
                        <span class="px-2.5 py-1 bg-blue-50 border border-blue-100 rounded-full text-xs font-semibold text-blue-700">SLAM / Nav2</span>
                        <span class="px-2.5 py-1 bg-blue-50 border border-blue-100 rounded-full text-xs font-semibold text-blue-700">Fleet management</span>
                        <span class="px-2.5 py-1 bg-blue-50 border border-blue-100 rounded-full text-xs font-semibold text-blue-700">WMS API</span>
                    </div>
                </div>
            </div>

            <div class="group relative bg-white border border-slate-200 rounded-[2rem] overflow-hidden hover:border-blue-300 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 reveal-on-scroll" data-delay="300">
                <div class="h-1 bg-gradient-to-r from-blue-500 to-teal-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="p-8">
                    <div class="w-14 h-14 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center mb-6 group-hover:border-blue-200 group-hover:bg-blue-50 transition-all duration-300">
                        <i class="fa-solid fa-flask text-2xl text-slate-600 group-hover:text-blue-600 transition-colors duration-300"></i>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-2 group-hover:text-blue-700 transition-colors">Research Institutions</h3>
                    <p class="text-slate-600 mb-5">Universities and labs that need ROS2 project development support for defined study durations without building a permanent team.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs font-bold text-slate-500 mr-1">Common scope:</span>
                        <span class="px-2.5 py-1 bg-blue-50 border border-blue-100 rounded-full text-xs font-semibold text-blue-700">ROS2 simulation</span>
                        <span class="px-2.5 py-1 bg-blue-50 border border-blue-100 rounded-full text-xs font-semibold text-blue-700">Data logging</span>
                        <span class="px-2.5 py-1 bg-blue-50 border border-blue-100 rounded-full text-xs font-semibold text-blue-700">Custom drivers</span>
                    </div>
                </div>
            </div>

            <div class="group relative bg-white border border-slate-200 rounded-[2rem] overflow-hidden hover:border-blue-300 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 reveal-on-scroll" data-delay="400">
                <div class="h-1 bg-gradient-to-r from-blue-500 to-teal-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="p-8">
                    <div class="w-14 h-14 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center mb-6 group-hover:border-blue-200 group-hover:bg-blue-50 transition-all duration-300">
                        <i class="fa-solid fa-seedling text-2xl text-slate-600 group-hover:text-blue-600 transition-colors duration-300"></i>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-2 group-hover:text-blue-700 transition-colors">Robotics Startups</h3>
                    <p class="text-slate-600 mb-5">Early-stage companies that need senior engineering output and production-quality code without the overhead of full-time hiring.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs font-bold text-slate-500 mr-1">Common scope:</span>
                        <span class="px-2.5 py-1 bg-blue-50 border border-blue-100 rounded-full text-xs font-semibold text-blue-700">MVP development</span>
                        <span class="px-2.5 py-1 bg-blue-50 border border-blue-100 rounded-full text-xs font-semibold text-blue-700">Architecture review</span>
                        <span class="px-2.5 py-1 bg-blue-50 border border-blue-100 rounded-full text-xs font-semibold text-blue-700">CI/CD setup</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ===== SECTION 8: TRUST SIGNALS ===== --}}
<section class="relative py-12 md:py-20 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center max-w-3xl mx-auto mb-12 reveal-on-scroll">
            <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-4">
                Why Teams <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-teal-500">Choose Us</span>
            </h2>
            <p class="text-slate-600 text-lg">The specifics that separate robotics specialists from generic software vendors.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6 mb-10">

            <div class="bg-white border border-slate-200 rounded-2xl p-6 border-t-4 border-t-blue-500 reveal-on-scroll" data-delay="100">
                <div class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-teal-500 mb-3">&lt;5 days</div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">First PR, Fast</h3>
                <p class="text-slate-500 text-sm">Engineers who hit the ground running. Not a 3-week discovery phase before a single line of code.</p>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-6 border-t-4 border-t-teal-500 reveal-on-scroll" data-delay="200">
                <div class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-teal-500 mb-3">Senior only</div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">No Bait-and-Switch</h3>
                <p class="text-slate-500 text-sm">No juniors billed as seniors. Every engineer has shipped production robotics software — not just studied it.</p>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-6 border-t-4 border-t-blue-400 reveal-on-scroll" data-delay="300">
                <div class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-teal-500 mb-3">Per-sprint</div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Scale Without Lock-in</h3>
                <p class="text-slate-500 text-sm">Add a CV specialist for one phase, drop back to a core team after. No 12-month retainer required.</p>
            </div>

        </div>

        <div class="max-w-3xl mx-auto text-center reveal-on-scroll">
            <p class="text-slate-600 leading-relaxed">
                <span class="font-bold text-slate-900">We are not a body-shop.</span>
                Generic software outsourcing firms provide developers who happen to know some Python.
                We are a domain-specific robotics engineering group — every person here works exclusively
                in ROS2, motion planning, computer vision, and robot software systems.
                That specialization is the difference between a team that needs six months to ramp up
                and one that submits its first meaningful PR on day four.
            </p>
        </div>
    </div>
</section>

{{-- ===== SECTION 9: CTA ===== --}}
<section class="relative py-20 md:py-32 overflow-hidden bg-white reveal-on-scroll">
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-[900px] h-[900px] rounded-full"
             style="background: radial-gradient(circle, rgba(37,99,235,0.07) 0%, transparent 70%);"></div>
    </div>

    <div class="relative z-10 text-center max-w-4xl mx-auto px-6">
        <h2 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.1] mb-8">
            Tell us what you're building.<br/>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-blue-500 to-teal-500">We'll tell you exactly who you need.</span>
        </h2>
        <p class="text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed mb-10">
            No pitch decks. No salesperson. A direct scoping call with a senior engineer who can assess your project from day one.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('contact') }}"
               class="group inline-flex items-center gap-3 px-10 py-5 bg-gradient-to-r from-blue-600 to-teal-500 text-white text-lg font-bold rounded-xl shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-1 transition-all duration-300">
                Book a Scoping Call
                <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
            <a href="{{ route('services.index') }}"
               class="group inline-flex items-center gap-2 px-10 py-5 bg-white border-2 border-slate-200 text-slate-700 text-lg font-bold rounded-xl hover:border-blue-300 hover:text-blue-700 transition-all duration-300">
                All Services
                <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<style>
    .reveal-on-scroll {
        opacity: 0;
        transform: translateY(28px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }
    .reveal-on-scroll.revealed {
        opacity: 1;
        transform: translateY(0);
    }
    .reveal-on-scroll[data-delay="100"]  { transition-delay: 0.10s; }
    .reveal-on-scroll[data-delay="200"]  { transition-delay: 0.20s; }
    .reveal-on-scroll[data-delay="300"]  { transition-delay: 0.30s; }
    .reveal-on-scroll[data-delay="400"]  { transition-delay: 0.40s; }
    .reveal-on-scroll[data-delay="500"]  { transition-delay: 0.50s; }
    .reveal-on-scroll[data-delay="600"]  { transition-delay: 0.60s; }
</style>
<script>
// ===== SCROLL REVEAL =====
document.addEventListener('DOMContentLoaded', function () {
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



// ===== CI/CD PIPELINE ANIMATOR =====
const PIPELINE_STAGES = [
    { id: 'git',     label: 'Git Push',      x: 60,  tooltip_title: 'Git Push',                 tooltip_body: 'Developer pushes to a feature branch. A pull request triggers the pipeline automatically via GitHub Actions webhook.' },
    { id: 'ci',      label: 'CI Trigger',    x: 210, tooltip_title: 'GitHub Actions CI Trigger', tooltip_body: 'The GitHub Actions runner spins up a fresh Ubuntu container. Dependencies are restored from cache for fast builds.' },
    { id: 'docker',  label: 'Docker Build',  x: 360, tooltip_title: 'Docker Build',              tooltip_body: 'The ROS2 workspace is built inside a reproducible Docker image. The same image runs locally, in CI, and on the robot.' },
    { id: 'sim',     label: 'Gazebo Tests',  x: 510, tooltip_title: 'Gazebo Simulation Tests',   tooltip_body: 'Automated integration tests run in a headless Gazebo environment. Navigation, collision, and task-completion tests execute against the virtual robot.', is_fail_gate: true },
    { id: 'staging', label: 'Staging Robot', x: 660, tooltip_title: 'Staging Robot Deployment',  tooltip_body: 'The validated Docker image is deployed to a physical staging robot over SSH. A final smoke test runs on real hardware before fleet rollout.' },
    { id: 'fleet',   label: 'Fleet Deploy',  x: 810, tooltip_title: 'Fleet Deployment',          tooltip_body: 'The image is pushed to all production robots via a rolling update. Robots pull and restart their ROS2 nodes without stopping operations.' },
];

const NODE_COLORS = {
    idle:    { fill: '#f1f5f9', stroke: '#cbd5e1' },
    active:  { fill: '#eff6ff', stroke: '#3b82f6' },
    done:    { fill: '#f0fdfa', stroke: '#14b8a6' },
    failed:  { fill: '#fef2f2', stroke: '#ef4444' },
    skipped: { fill: '#f8fafc', stroke: '#e2e8f0' },
};
const NODE_R = 38;
const NODE_Y = 100;

let scenario = 'success';
let animTimer = null;

function buildPipelineSVG() {
    const svg = document.getElementById('pipeline-svg');
    if (!svg) return;
    svg.innerHTML = `<defs>
        <marker id="pipe-arrow" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="5" markerHeight="5" orient="auto-start-reverse">
            <path d="M2 1L8 5L2 9" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </marker>
    </defs>`;

    for (let i = 0; i < PIPELINE_STAGES.length - 1; i++) {
        const from = PIPELINE_STAGES[i], to = PIPELINE_STAGES[i + 1];
        const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
        line.setAttribute('id', `pipe-line-${i}`);
        line.setAttribute('x1', from.x + NODE_R); line.setAttribute('y1', NODE_Y);
        line.setAttribute('x2', to.x - NODE_R);   line.setAttribute('y2', NODE_Y);
        line.setAttribute('stroke', '#cbd5e1'); line.setAttribute('stroke-width', '2');
        line.setAttribute('marker-end', 'url(#pipe-arrow)');
        svg.appendChild(line);
    }

    const dot = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
    dot.setAttribute('id', 'pipeline-dot');
    dot.setAttribute('r', '6'); dot.setAttribute('cx', PIPELINE_STAGES[0].x);
    dot.setAttribute('cy', NODE_Y); dot.setAttribute('fill', '#3b82f6'); dot.setAttribute('opacity', '0');
    svg.appendChild(dot);

    PIPELINE_STAGES.forEach((stage, i) => {
        const g = document.createElementNS('http://www.w3.org/2000/svg', 'g');
        g.setAttribute('id', `node-${stage.id}`);
        g.style.cursor = 'pointer';
        g.onclick = () => showPipelineTooltip(stage);

        const circle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
        circle.setAttribute('cx', stage.x); circle.setAttribute('cy', NODE_Y);
        circle.setAttribute('r', NODE_R); circle.setAttribute('fill', NODE_COLORS.idle.fill);
        circle.setAttribute('stroke', NODE_COLORS.idle.stroke); circle.setAttribute('stroke-width', '2');
        g.appendChild(circle);

        const label = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        label.setAttribute('x', stage.x); label.setAttribute('y', NODE_Y + NODE_R + 20);
        label.setAttribute('text-anchor', 'middle'); label.setAttribute('font-family', 'system-ui, sans-serif');
        label.setAttribute('font-size', '11'); label.setAttribute('font-weight', '600');
        label.setAttribute('fill', '#64748b'); label.textContent = stage.label;
        g.appendChild(label);

        const num = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        num.setAttribute('x', stage.x); num.setAttribute('y', NODE_Y + 5);
        num.setAttribute('text-anchor', 'middle'); num.setAttribute('font-family', 'system-ui, sans-serif');
        num.setAttribute('font-size', '18'); num.setAttribute('fill', '#64748b'); num.textContent = i + 1;
        g.appendChild(num);

        svg.appendChild(g);
    });
}

function setNodeState(stageId, state) {
    const g = document.getElementById(`node-${stageId}`);
    if (!g) return;
    const circle = g.querySelector('circle');
    circle.setAttribute('fill',   NODE_COLORS[state].fill);
    circle.setAttribute('stroke', NODE_COLORS[state].stroke);
    circle.setAttribute('stroke-width', state === 'active' ? '3' : '2');
}

function showPipelineTooltip(stage) {
    const panel = document.getElementById('stage-tooltip');
    document.getElementById('tooltip-title').textContent = stage.tooltip_title;
    document.getElementById('tooltip-body').textContent  = stage.tooltip_body;
    panel.classList.remove('hidden');
}

function resetPipeline() {
    if (animTimer) clearTimeout(animTimer);
    PIPELINE_STAGES.forEach(s => setNodeState(s.id, 'idle'));
    const dot = document.getElementById('pipeline-dot');
    if (dot) dot.setAttribute('opacity', '0');
    document.getElementById('stage-tooltip').classList.add('hidden');
    const badge = document.getElementById('pipeline-status-badge');
    badge.classList.add('hidden');
}

function triggerBuild() {
    resetPipeline();
    const dot = document.getElementById('pipeline-dot');
    dot.setAttribute('cx', PIPELINE_STAGES[0].x);
    dot.setAttribute('fill', '#3b82f6');
    dot.setAttribute('opacity', '1');

    const failAtIndex = scenario === 'fail' ? 3 : -1;

    function stepTo(index) {
        if (index >= PIPELINE_STAGES.length) {
            dot.setAttribute('opacity', '0');
            showBuildStatus('success');
            return;
        }
        const stage = PIPELINE_STAGES[index];
        animateDot(dot, stage.x, 400, () => {
            if (index === failAtIndex) {
                setNodeState(stage.id, 'failed');
                dot.setAttribute('fill', '#ef4444');
                showBuildStatus('fail');
                for (let i = index + 1; i < PIPELINE_STAGES.length; i++) {
                    setNodeState(PIPELINE_STAGES[i].id, 'skipped');
                }
                animTimer = setTimeout(() => dot.setAttribute('opacity', '0'), 600);
                return;
            }
            setNodeState(stage.id, 'active');
            animTimer = setTimeout(() => {
                setNodeState(stage.id, 'done');
                animTimer = setTimeout(() => stepTo(index + 1), 200);
            }, 700);
        });
    }
    stepTo(0);
}

function animateDot(dot, targetX, duration, callback) {
    const startX = parseFloat(dot.getAttribute('cx'));
    const start  = performance.now();
    function frame(now) {
        const progress = Math.min((now - start) / duration, 1);
        const eased    = 1 - Math.pow(1 - progress, 3);
        dot.setAttribute('cx', startX + (targetX - startX) * eased);
        if (progress < 1) requestAnimationFrame(frame);
        else if (callback) callback();
    }
    requestAnimationFrame(frame);
}

function showBuildStatus(type) {
    const badge = document.getElementById('pipeline-status-badge');
    badge.classList.remove('hidden');
    if (type === 'success') {
        badge.className = 'inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-teal-100 text-teal-700 border border-teal-200';
        badge.innerHTML = '<i class="fa-solid fa-check"></i> Build passed — deploying to fleet';
    } else {
        badge.className = 'inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-red-100 text-red-700 border border-red-200';
        badge.innerHTML = '<i class="fa-solid fa-xmark"></i> Sim tests failed — rollback triggered';
    }
}

function setScenario(s) {
    scenario = s;
    const btnSuccess = document.getElementById('toggle-success');
    const btnFail    = document.getElementById('toggle-fail');
    if (s === 'success') {
        btnSuccess.className = 'px-3 py-1.5 rounded-lg text-xs font-bold bg-teal-600 text-white transition-all cursor-pointer';
        btnFail.className    = 'px-3 py-1.5 rounded-lg text-xs font-bold bg-white border border-slate-200 text-slate-600 hover:border-red-300 transition-all cursor-pointer';
    } else {
        btnFail.className    = 'px-3 py-1.5 rounded-lg text-xs font-bold bg-red-500 text-white transition-all cursor-pointer';
        btnSuccess.className = 'px-3 py-1.5 rounded-lg text-xs font-bold bg-white border border-slate-200 text-slate-600 hover:border-teal-300 transition-all cursor-pointer';
    }
    resetPipeline();
}

document.addEventListener('DOMContentLoaded', () => {
    buildPipelineSVG();
    
    // Auto-trigger the animation when it comes into view
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                setTimeout(() => triggerBuild(), 800); // Slight delay for better effect
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    const pipelineSection = document.getElementById('pipeline-svg');
    if(pipelineSection) {
        observer.observe(pipelineSection);
    }
});
</script>
@endpush
