@extends('components.layout')

@section('title', $serviceTitle . ' - Corporate Services')

@section('content')
    @if($serviceId !== 'consultation')
        @include('components.page-hero', [
            'title' => $serviceTitle,
            'subtitle' => 'Specialized corporate solutions tailored to your enterprise requirements.'
        ])
    @endif

    @if($serviceId === 'consultation')

        <!-- ===== SECTION 1: HERO ===== -->
        <section class="relative pt-32 pb-20 md:pt-48 md:pb-32 overflow-hidden bg-white">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-slate-100 via-white to-white"></div>
            <!-- Blobs -->
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-blue-100/50 blur-3xl animate-pulse-glow"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-slate-100/50 blur-3xl animate-pulse-glow" style="animation-delay: 2s;"></div>
            
            <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-600 text-sm font-bold mb-6 reveal-on-scroll">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-ping"></span>
                    Engineering Consultation
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 tracking-tight mb-8 reveal-on-scroll">
                    Architectural clarity for <br/> <span class="bg-gradient-to-r from-slate-700 to-blue-600 bg-clip-text text-transparent">autonomous systems.</span>
                </h1>
                <p class="text-xl text-slate-600 max-w-3xl mx-auto mb-10 reveal-on-scroll">
                    We provide strategic technical guidance for enterprises navigating the complex landscape of robotics. Stop guessing on sensor payloads, ROS2 latency, and fleet management architectures.
                </p>
            </div>
        </section>

        <!-- ===== SECTION 2: 3 CONSULTATION FORMATS ===== -->
        <section class="py-24 bg-white border-y border-slate-200 relative z-10">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16 reveal-on-scroll">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Flexible Engagement Models</h2>
                    <p class="text-slate-600 text-lg">We adapt to where you are in your development lifecycle.</p>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Format 1 -->
                    <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-lg hover:shadow-xl transition-shadow reveal-on-scroll">
                        <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-2xl mb-6">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Feasibility Study</h3>
                        <p class="text-slate-600 text-sm mb-4">Validate your concept before burning capital. We assess hardware requirements, compute constraints, and algorithmic viability.</p>
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Duration: 3-5 Days</div>
                    </div>
                    <!-- Format 2 -->
                    <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-lg hover:shadow-xl transition-shadow reveal-on-scroll" style="animation-delay: 100ms;">
                        <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-2xl mb-6">
                            <i class="fa-solid fa-network-wired"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">System Audit</h3>
                        <p class="text-slate-600 text-sm mb-4">Deep dive into your existing codebase. We identify latency bottlenecks, structural flaws, and reliability risks in your stack.</p>
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Duration: 1-2 Weeks</div>
                    </div>
                    <!-- Format 3 -->
                    <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-lg hover:shadow-xl transition-shadow reveal-on-scroll" style="animation-delay: 200ms;">
                        <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-2xl mb-6">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Architectural Design</h3>
                        <p class="text-slate-600 text-sm mb-4">A complete blueprint for your system. Data flows, sensor fusion strategies, middleware selection, and deployment pipelines.</p>
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Duration: 2-4 Weeks</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== SECTION 3: VISUAL 1 (Static Roadmap Grid) ===== -->
        <section class="py-24 bg-slate-50 border-t border-slate-200 relative z-10 overflow-hidden" id="roadmap-section">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16 reveal-on-scroll">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">The Consultation Roadmap</h2>
                    <p class="text-slate-600 text-lg">How a typical enterprise engagement unfolds.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 reveal-on-scroll">
                    <!-- Phase 1 -->
                    <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-lg flex flex-col justify-between hover:shadow-xl transition-shadow duration-300">
                        <div>
                            <div class="flex justify-between items-center mb-6">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-slate-700 to-blue-600 text-white flex items-center justify-center font-bold text-lg shadow-md shadow-blue-500/20">
                                    1
                                </div>
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded-full border border-slate-200">3-5 Days</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-4">Feasibility Study</h3>
                            <ul class="space-y-3 mb-6">
                                <li class="flex items-start gap-2.5 text-slate-600 text-sm"><i class="fa-solid fa-check text-blue-600 mt-1 shrink-0"></i> <span>Stakeholder technical interviews</span></li>
                                <li class="flex items-start gap-2.5 text-slate-600 text-sm"><i class="fa-solid fa-check text-blue-600 mt-1 shrink-0"></i> <span>Existing codebase & architecture review</span></li>
                                <li class="flex items-start gap-2.5 text-slate-600 text-sm"><i class="fa-solid fa-check text-blue-600 mt-1 shrink-0"></i> <span>Hardware constraint mapping</span></li>
                            </ul>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 mt-auto">
                            <p class="text-slate-500 text-xs italic mb-1.5">"What are the immediate blockers?"</p>
                            <p class="text-slate-500 text-xs italic">"Are we hardware-limited or software-limited?"</p>
                        </div>
                    </div>

                    <!-- Phase 2 -->
                    <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-lg flex flex-col justify-between hover:shadow-xl transition-shadow duration-300">
                        <div>
                            <div class="flex justify-between items-center mb-6">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-slate-700 to-blue-600 text-white flex items-center justify-center font-bold text-lg shadow-md shadow-blue-500/20">
                                    2
                                </div>
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded-full border border-slate-200">1-2 Weeks</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-4">Proof of Concept</h3>
                            <ul class="space-y-3 mb-6">
                                <li class="flex items-start gap-2.5 text-slate-600 text-sm"><i class="fa-solid fa-check text-blue-600 mt-1 shrink-0"></i> <span>ROS2/Middleware latency profiling</span></li>
                                <li class="flex items-start gap-2.5 text-slate-600 text-sm"><i class="fa-solid fa-check text-blue-600 mt-1 shrink-0"></i> <span>Sensor fusion pipeline validation</span></li>
                                <li class="flex items-start gap-2.5 text-slate-600 text-sm"><i class="fa-solid fa-check text-blue-600 mt-1 shrink-0"></i> <span>CI/CD & deployment testing protocols</span></li>
                            </ul>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 mt-auto">
                            <p class="text-slate-500 text-xs italic mb-1.5">"Why is the control loop missing its deadlines?"</p>
                            <p class="text-slate-500 text-xs italic">"Is our EKF tuning mathematically sound?"</p>
                        </div>
                    </div>

                    <!-- Phase 3 -->
                    <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-lg flex flex-col justify-between hover:shadow-xl transition-shadow duration-300">
                        <div>
                            <div class="flex justify-between items-center mb-6">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-slate-700 to-blue-600 text-white flex items-center justify-center font-bold text-lg shadow-md shadow-blue-500/20">
                                    3
                                </div>
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded-full border border-slate-200">1-2 Weeks</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-4">Architectural Design</h3>
                            <ul class="space-y-3 mb-6">
                                <li class="flex items-start gap-2.5 text-slate-600 text-sm"><i class="fa-solid fa-check text-blue-600 mt-1 shrink-0"></i> <span>Proposed architecture specs & diagrams</span></li>
                                <li class="flex items-start gap-2.5 text-slate-600 text-sm"><i class="fa-solid fa-check text-blue-600 mt-1 shrink-0"></i> <span>Refactoring roadmap for existing systems</span></li>
                                <li class="flex items-start gap-2.5 text-slate-600 text-sm"><i class="fa-solid fa-check text-blue-600 mt-1 shrink-0"></i> <span>Library & dependency recommendations</span></li>
                            </ul>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 mt-auto">
                            <p class="text-slate-500 text-xs italic mb-1.5">"What is the exact path to scalable deployment?"</p>
                            <p class="text-slate-500 text-xs italic">"How do we rebuild this without downtime?"</p>
                        </div>
                    </div>

                    <!-- Phase 4 -->
                    <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-lg flex flex-col justify-between hover:shadow-xl transition-shadow duration-300">
                        <div>
                            <div class="flex justify-between items-center mb-6">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-slate-700 to-blue-600 text-white flex items-center justify-center font-bold text-lg shadow-md shadow-blue-500/20">
                                    4
                                </div>
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded-full border border-slate-200">Ongoing</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-4">Integration Review</h3>
                            <ul class="space-y-3 mb-6">
                                <li class="flex items-start gap-2.5 text-slate-600 text-sm"><i class="fa-solid fa-check text-blue-600 mt-1 shrink-0"></i> <span>Pull request reviews on critical modules</span></li>
                                <li class="flex items-start gap-2.5 text-slate-600 text-sm"><i class="fa-solid fa-check text-blue-600 mt-1 shrink-0"></i> <span>Weekly pair-programming & unblocking</span></li>
                                <li class="flex items-start gap-2.5 text-slate-600 text-sm"><i class="fa-solid fa-check text-blue-600 mt-1 shrink-0"></i> <span>Final acceptance testing guidance</span></li>
                            </ul>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 mt-auto">
                            <p class="text-slate-500 text-xs italic">"Is the internal team implementing the blueprint correctly?"</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== SECTION 4: WHAT WE ASSESS (Dark Panel) ===== -->
        <section class="py-24 bg-slate-900 relative z-10">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16 reveal-on-scroll">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">What We Assess</h2>
                    <p class="text-slate-400 text-lg max-w-2xl mx-auto">We look at the complete software lifecycle of an autonomous system.</p>
                </div>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 reveal-on-scroll">
                        <i class="fa-solid fa-microchip text-blue-400 text-2xl mb-4"></i>
                        <h4 class="text-white font-bold mb-2">Compute & Hardware</h4>
                        <p class="text-slate-400 text-sm">RTOS constraints, GPU acceleration availability, and memory bottlenecks.</p>
                    </div>
                    <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 reveal-on-scroll" style="animation-delay: 100ms;">
                        <i class="fa-solid fa-network-wired text-blue-400 text-2xl mb-4"></i>
                        <h4 class="text-white font-bold mb-2">Middleware (ROS/DDS)</h4>
                        <p class="text-slate-400 text-sm">QoS profiles, zero-copy transport tuning, and network partition resilience.</p>
                    </div>
                    <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 reveal-on-scroll" style="animation-delay: 200ms;">
                        <i class="fa-solid fa-eye text-blue-400 text-2xl mb-4"></i>
                        <h4 class="text-white font-bold mb-2">Perception Pipelines</h4>
                        <p class="text-slate-400 text-sm">Camera/LiDAR fusion accuracy, point cloud processing speed, and inference latency.</p>
                    </div>
                    <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 reveal-on-scroll">
                        <i class="fa-solid fa-route text-blue-400 text-2xl mb-4"></i>
                        <h4 class="text-white font-bold mb-2">Navigation & Control</h4>
                        <p class="text-slate-400 text-sm">Local trajectory planners, dynamic obstacle avoidance, and PID/MPC stability.</p>
                    </div>
                    <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 reveal-on-scroll" style="animation-delay: 100ms;">
                        <i class="fa-solid fa-vial-circle-check text-blue-400 text-2xl mb-4"></i>
                        <h4 class="text-white font-bold mb-2">Simulation & Testing</h4>
                        <p class="text-slate-400 text-sm">Gazebo/Isaac Sim fidelity, automated regression testing, and CI/CD pipelines.</p>
                    </div>
                    <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 reveal-on-scroll" style="animation-delay: 200ms;">
                        <i class="fa-solid fa-server text-blue-400 text-2xl mb-4"></i>
                        <h4 class="text-white font-bold mb-2">Fleet Management</h4>
                        <p class="text-slate-400 text-sm">Multi-agent coordination, task allocation algorithms, and cloud telemetry links.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== SECTION 5: VISUAL 2 (Static Client Results Grid) ===== -->
        <section class="py-24 bg-white border-t border-slate-200 relative z-10" id="results-section">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16 reveal-on-scroll">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Proven Business Impact</h2>
                    <p class="text-slate-600 text-lg max-w-2xl mx-auto">Concrete outcomes from our architectural interventions.</p>
                </div>

                <!-- Grid Container -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 reveal-on-scroll">
                    
                    <!-- Card 1 -->
                    <div class="bg-white border border-slate-200 rounded-[2rem] shadow-xl p-8 flex flex-col justify-between hover:shadow-2xl transition-shadow duration-300">
                        <div>
                            <div class="flex items-center gap-3 mb-6">
                                <span class="bg-slate-100 text-slate-600 text-xs font-bold uppercase px-3 py-1 rounded-full border border-slate-200">Automotive Assembly</span>
                                <i class="fa-solid fa-industry text-slate-400"></i>
                            </div>
                            <div class="mb-8">
                                <div class="text-5xl font-extrabold bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent mb-2">
                                    34%
                                </div>
                                <p class="text-slate-700 text-lg font-bold">reduction in manual cycle time after implementation</p>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-start gap-3 text-slate-600 text-sm"><i class="fa-solid fa-angle-right text-blue-500 mt-1 shrink-0"></i> Localization stack was causing 800ms latency spikes under vibration</li>
                                <li class="flex items-start gap-3 text-slate-600 text-sm"><i class="fa-solid fa-angle-right text-blue-500 mt-1 shrink-0"></i> EKF tuning had never been validated against real floor conditions</li>
                                <li class="flex items-start gap-3 text-slate-600 text-sm"><i class="fa-solid fa-angle-right text-blue-500 mt-1 shrink-0"></i> Switching from camera-only to LiDAR-camera fusion eliminated 91% of miss-picks</li>
                            </ul>
                        </div>
                        <div class="mt-8 pt-4 border-t border-slate-100">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Consultation Type: System Audit</span>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white border border-slate-200 rounded-[2rem] shadow-xl p-8 flex flex-col justify-between hover:shadow-2xl transition-shadow duration-300">
                        <div>
                            <div class="flex items-center gap-3 mb-6">
                                <span class="bg-slate-100 text-slate-600 text-xs font-bold uppercase px-3 py-1 rounded-full border border-slate-200">Logistics & Warehousing</span>
                                <i class="fa-solid fa-boxes-stacked text-slate-400"></i>
                            </div>
                            <div class="mb-8">
                                <div class="text-5xl font-extrabold bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent mb-2">
                                    6 months
                                </div>
                                <p class="text-slate-700 text-lg font-bold">of rework avoided by catching a critical architecture flaw early</p>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-start gap-3 text-slate-600 text-sm"><i class="fa-solid fa-angle-right text-blue-500 mt-1 shrink-0"></i> Fleet coordination layer had no collision arbitration for >12 simultaneous robots</li>
                                <li class="flex items-start gap-3 text-slate-600 text-sm"><i class="fa-solid fa-angle-right text-blue-500 mt-1 shrink-0"></i> WMS integration was tightly coupled - one API change would ground the fleet</li>
                                <li class="flex items-start gap-3 text-slate-600 text-sm"><i class="fa-solid fa-angle-right text-blue-500 mt-1 shrink-0"></i> Proposed hardware was undersized for the planned route density</li>
                            </ul>
                        </div>
                        <div class="mt-8 pt-4 border-t border-slate-100">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Consultation Type: Feasibility Study</span>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white border border-slate-200 rounded-[2rem] shadow-xl p-8 flex flex-col justify-between hover:shadow-2xl transition-shadow duration-300">
                        <div>
                            <div class="flex items-center gap-3 mb-6">
                                <span class="bg-slate-100 text-slate-600 text-xs font-bold uppercase px-3 py-1 rounded-full border border-slate-200">Industrial Manufacturing Startup</span>
                                <i class="fa-solid fa-rocket text-slate-400"></i>
                            </div>
                            <div class="mb-8">
                                <div class="text-5xl font-extrabold bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent mb-2">
                                    3x faster
                                </div>
                                <p class="text-slate-700 text-lg font-bold">time-to-deployment vs. their original estimate</p>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-start gap-3 text-slate-600 text-sm"><i class="fa-solid fa-angle-right text-blue-500 mt-1 shrink-0"></i> URDF model had incorrect inertia tensors causing sim-to-real gap</li>
                                <li class="flex items-start gap-3 text-slate-600 text-sm"><i class="fa-solid fa-angle-right text-blue-500 mt-1 shrink-0"></i> CI pipeline had no hardware-in-the-loop tests - bugs were found on deployment day</li>
                                <li class="flex items-start gap-3 text-slate-600 text-sm"><i class="fa-solid fa-angle-right text-blue-500 mt-1 shrink-0"></i> Switching to micro-ROS reduced embedded footprint by 60%</li>
                            </ul>
                        </div>
                        <div class="mt-8 pt-4 border-t border-slate-100">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Consultation Type: Architectural Design</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== SECTION 6: HOW IT WORKS ===== -->
        <section class="py-24 bg-slate-50 border-t border-slate-200 relative z-10">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-12 reveal-on-scroll">How a Consultation Engagement Works</h2>
                <div class="grid md:grid-cols-4 gap-8 mb-16">
                    <div class="reveal-on-scroll">
                        <i class="fa-solid fa-shield-halved text-blue-600 text-3xl mb-4"></i>
                        <h4 class="font-bold text-slate-900 mb-2">NDA First</h4>
                        <p class="text-slate-600 text-sm">Your intellectual property is secured before we ever look at a line of code.</p>
                    </div>
                    <div class="reveal-on-scroll" style="animation-delay: 100ms;">
                        <i class="fa-solid fa-user-tie text-blue-600 text-3xl mb-4"></i>
                        <h4 class="font-bold text-slate-900 mb-2">Senior Engineers Only</h4>
                        <p class="text-slate-600 text-sm">No juniors. You interface directly with architects who have deployed autonomous fleets.</p>
                    </div>
                    <div class="reveal-on-scroll" style="animation-delay: 200ms;">
                        <i class="fa-solid fa-file-contract text-blue-600 text-3xl mb-4"></i>
                        <h4 class="font-bold text-slate-900 mb-2">Fixed-Price Deliverables</h4>
                        <p class="text-slate-600 text-sm">Clear scopes of work. You pay for actionable blueprints, not billable hours.</p>
                    </div>
                    <div class="reveal-on-scroll" style="animation-delay: 300ms;">
                        <i class="fa-solid fa-handshake-angle text-blue-600 text-3xl mb-4"></i>
                        <h4 class="font-bold text-slate-900 mb-2">Vendor Agnostic</h4>
                        <p class="text-slate-600 text-sm">We recommend the best sensors and tools for your use-case, free from hardware biases.</p>
                    </div>
                </div>
                <!-- 5 Step Stepper -->
                <div class="reveal-on-scroll bg-white border border-slate-200 rounded-2xl p-8 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">1</div>
                        <span class="font-bold text-slate-700 text-sm">Discovery Call</span>
                    </div>
                    <i class="fa-solid fa-chevron-right text-slate-300 hidden md:block"></i>
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">2</div>
                        <span class="font-bold text-slate-700 text-sm">NDA & Data Access</span>
                    </div>
                    <i class="fa-solid fa-chevron-right text-slate-300 hidden md:block"></i>
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">3</div>
                        <span class="font-bold text-slate-700 text-sm">Technical Audit</span>
                    </div>
                    <i class="fa-solid fa-chevron-right text-slate-300 hidden md:block"></i>
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">4</div>
                        <span class="font-bold text-slate-700 text-sm">Blueprint Delivery</span>
                    </div>
                    <i class="fa-solid fa-chevron-right text-slate-300 hidden md:block"></i>
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">5</div>
                        <span class="font-bold text-slate-700 text-sm">Implementation</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== SECTION 7: WHO HIRES US ===== -->
        <section class="py-24 bg-white border-t border-slate-200 relative z-10">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16 reveal-on-scroll">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Who Hires Us For Consultation</h2>
                    <p class="text-slate-600 text-lg">We serve a wide spectrum of the autonomous industry.</p>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 flex items-start gap-4 reveal-on-scroll">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shrink-0 border border-slate-200 shadow-sm"><i class="fa-solid fa-industry text-blue-600"></i></div>
                        <div>
                            <h4 class="font-bold text-slate-900 mb-1">OEMs & Tier-1 Suppliers</h4>
                            <p class="text-slate-600 text-sm">Seeking to modernize legacy software stacks and transition to modular, ROS2-based architectures.</p>
                        </div>
                    </div>
                    <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 flex items-start gap-4 reveal-on-scroll" style="animation-delay: 100ms;">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shrink-0 border border-slate-200 shadow-sm"><i class="fa-solid fa-seedling text-blue-600"></i></div>
                        <div>
                            <h4 class="font-bold text-slate-900 mb-1">Agtech & Off-Highway Startups</h4>
                            <p class="text-slate-600 text-sm">Needing rapid proof-of-concept validation for harsh environment navigation and perception.</p>
                        </div>
                    </div>
                    <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 flex items-start gap-4 reveal-on-scroll">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shrink-0 border border-slate-200 shadow-sm"><i class="fa-solid fa-boxes-packing text-blue-600"></i></div>
                        <div>
                            <h4 class="font-bold text-slate-900 mb-1">Warehouse Automation Firms</h4>
                            <p class="text-slate-600 text-sm">Requiring scalable fleet management topologies and deterministic path-planning audits.</p>
                        </div>
                    </div>
                    <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 flex items-start gap-4 reveal-on-scroll" style="animation-delay: 100ms;">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shrink-0 border border-slate-200 shadow-sm"><i class="fa-solid fa-money-bill-trend-up text-blue-600"></i></div>
                        <div>
                            <h4 class="font-bold text-slate-900 mb-1">Venture Capital & PE</h4>
                            <p class="text-slate-600 text-sm">Conducting deep technical due diligence on robotics acquisitions to assess technical debt.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== SECTION 8: TRUST SIGNALS ===== -->
        <section class="py-24 bg-slate-50 border-t border-slate-200 relative z-10" id="trust-section">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid md:grid-cols-2 gap-16 items-center">
                    <div class="reveal-on-scroll">
                        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-6">Trust Signals</h2>
                        <p class="text-slate-600 text-lg mb-6 leading-relaxed">
                            There is a profound difference between academic robotics and production-grade autonomy. Many consultancies excel at the former; very few have survived the latter.
                        </p>
                        <p class="text-slate-600 text-lg leading-relaxed font-bold">
                            We bring battle-tested experience from deploying autonomous systems in unstructured, real-world environments. We know what fails when the hardware shakes, when the network drops, and when the sensors are blinded. We build architectures designed to survive reality.
                        </p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-md reveal-on-scroll">
                            <div class="text-4xl font-extrabold text-blue-600 mb-2"><span class="trust-stat" data-target="50">0</span>+</div>
                            <div class="text-slate-600 font-bold text-sm uppercase tracking-wide">Systems Audited</div>
                        </div>
                        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-md reveal-on-scroll" style="animation-delay: 100ms;">
                            <div class="text-4xl font-extrabold text-blue-600 mb-2"><span class="trust-stat" data-target="12">0</span></div>
                            <div class="text-slate-600 font-bold text-sm uppercase tracking-wide">Production Deployments</div>
                        </div>
                        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-md sm:col-span-2 reveal-on-scroll" style="animation-delay: 200ms;">
                            <div class="text-4xl font-extrabold text-blue-600 mb-2"><span class="trust-stat" data-target="100">0</span>%</div>
                            <div class="text-slate-600 font-bold text-sm uppercase tracking-wide">Focus on Autonomous Mobility</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== SECTION 9: CTA ===== -->
        <section class="py-24 bg-white relative z-10 text-center border-t border-slate-200">
            <div class="max-w-3xl mx-auto px-6 reveal-on-scroll">
                <h2 class="text-4xl font-extrabold text-slate-900 mb-6">Ready to de-risk your roadmap?</h2>
                <p class="text-slate-600 text-xl mb-10">Schedule a confidential discovery call with a senior architect.</p>
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-slate-900 rounded-xl text-white font-bold text-lg hover:bg-slate-800 hover:shadow-xl transition-all duration-300">
                    Talk to an Architect <i class="fa-solid fa-arrow-right"></i>
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