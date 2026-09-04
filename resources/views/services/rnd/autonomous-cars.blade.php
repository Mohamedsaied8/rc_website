@extends('components.layout')

@section('title', 'Autonomous Cars R&D - Robotics Corner')

@section('content')

    <!-- ===== SECTION 1: HERO ===== -->
    <section class="relative min-h-[90vh] flex items-center overflow-hidden pt-24 pb-16">
        <!-- Background layer -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_30%_20%,_var(--tw-gradient-stops))] from-white via-slate-50 to-slate-50"></div>
            <div class="absolute top-1/4 -left-32 w-[600px] h-[600px] bg-cyan-400/20 rounded-full blur-[160px] animate-pulse-glow"></div>
            <div class="absolute bottom-1/4 -right-32 w-[500px] h-[500px] bg-blue-500/15 rounded-full blur-[140px] animate-pulse-glow" style="animation-delay: 1.5s;"></div>
            <div class="absolute top-1/4 right-1/4 w-2 h-2 bg-cyan-400 rounded-full animate-ping"></div>
            <div class="absolute bottom-1/3 left-1/4 w-1.5 h-1.5 bg-blue-400 rounded-full animate-ping" style="animation-delay: 0.5s"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/80 border border-cyan-200 shadow-sm mb-8 animate-fade-in-up">
                <span class="w-2 h-2 rounded-full bg-cyan-500 animate-pulse"></span>
                <span class="text-xs font-bold text-cyan-700 tracking-wider uppercase">Autonomous Cars R&D</span>
            </div>

            <!-- Headline -->
            <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 tracking-tight leading-[1.05] mb-8 animate-fade-in-up" style="animation-delay: 100ms;">
                Autonomous Software<br/>
                That <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 to-blue-600">Knows Where It Is</span>,<br/>
                Where It's Going,<br/>
                and Why.
            </h1>

            <!-- Subheadline -->
            <p class="text-xl md:text-2xl text-slate-600 max-w-3xl mx-auto leading-relaxed font-medium mb-12 animate-fade-in-up" style="animation-delay: 200ms;">
                We don't build cars. We build the perception, localization, and decision-making software that makes any vehicle autonomous — on any hardware stack.
            </p>

            <!-- CTA buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in-up" style="animation-delay: 300ms;">
                <a href="#pipeline" class="group inline-flex items-center justify-center gap-3 px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold rounded-xl shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 hover:-translate-y-1 transition-all duration-300 w-full sm:w-auto">
                    Explore Our Pipeline <i class="fa-solid fa-arrow-down group-hover:translate-y-1 transition-transform"></i>
                </a>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-16 animate-fade-in-up" style="animation-delay: 400ms;">
                <div class="bg-white/60 backdrop-blur-sm border border-slate-200/60 rounded-2xl p-6 text-center hover:bg-white transition-colors">
                    <div class="text-2xl font-extrabold text-cyan-600 mb-1">Real-Time</div>
                    <div class="text-sm font-bold text-slate-600 uppercase tracking-wide">End-to-End Pipeline</div>
                </div>
                <div class="bg-white/60 backdrop-blur-sm border border-slate-200/60 rounded-2xl p-6 text-center hover:bg-white transition-colors">
                    <div class="text-2xl font-extrabold text-cyan-600 mb-1">Multi-Sensor</div>
                    <div class="text-sm font-bold text-slate-600 uppercase tracking-wide">Fusion Architecture</div>
                </div>
                <div class="bg-white/60 backdrop-blur-sm border border-slate-200/60 rounded-2xl p-6 text-center hover:bg-white transition-colors">
                    <div class="text-2xl font-extrabold text-cyan-600 mb-1">Adaptive</div>
                    <div class="text-sm font-bold text-slate-600 uppercase tracking-wide">Motion Planning</div>
                </div>
                <div class="bg-white/60 backdrop-blur-sm border border-slate-200/60 rounded-2xl p-6 text-center hover:bg-white transition-colors">
                    <div class="text-2xl font-extrabold text-cyan-600 mb-1">ROS2</div>
                    <div class="text-sm font-bold text-slate-600 uppercase tracking-wide">Native Runtime</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SECTION 2: WHAT WE BUILD (Capability Pillars) ===== -->
    <section class="py-24 bg-white border-y border-slate-200 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16 reveal-on-scroll">
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-5">
                    Core <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 to-blue-600">Capabilities</span>
                </h2>
                <p class="text-lg text-slate-600 leading-relaxed">
                    We specialize in the three fundamental pillars of autonomous navigation.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-white border border-slate-200 rounded-3xl p-8 hover:border-cyan-300 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group reveal-on-scroll" data-delay="100">
                    <div class="w-14 h-14 rounded-2xl bg-cyan-50 border border-cyan-100 flex items-center justify-center mb-6 group-hover:bg-cyan-100 transition-colors">
                        <i class="fa-solid fa-satellite-dish text-2xl text-cyan-600"></i>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-3">Perception & Sensor Fusion</h3>
                    <p class="text-slate-600 leading-relaxed mb-8">
                        We fuse LiDAR point clouds, camera frames, and radar vectors into a single coherent environmental model — in real time, on embedded compute.
                    </p>
                    <div class="pt-6 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-sm font-bold text-slate-400">01</span>
                        <i class="fa-solid fa-arrow-right text-cyan-500 opacity-0 group-hover:opacity-100 transition-opacity transform -translate-x-2 group-hover:translate-x-0"></i>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white border border-slate-200 rounded-3xl p-8 hover:border-blue-300 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group reveal-on-scroll" data-delay="200">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center mb-6 group-hover:bg-blue-100 transition-colors">
                        <i class="fa-solid fa-route text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-3">Localization & Mapping</h3>
                    <p class="text-slate-600 leading-relaxed mb-8">
                        EKF-SLAM pipelines, HD map integration, and multi-modal odometry that keeps the vehicle centered to centimeter precision at highway speed.
                    </p>
                    <div class="pt-6 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-sm font-bold text-slate-400">02</span>
                        <i class="fa-solid fa-arrow-right text-blue-500 opacity-0 group-hover:opacity-100 transition-opacity transform -translate-x-2 group-hover:translate-x-0"></i>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white border border-slate-200 rounded-3xl p-8 hover:border-indigo-300 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group reveal-on-scroll" data-delay="300">
                    <div class="w-14 h-14 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center mb-6 group-hover:bg-indigo-100 transition-colors">
                        <i class="fa-solid fa-brain text-2xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-3">Planning & Control</h3>
                    <p class="text-slate-600 leading-relaxed mb-8">
                        From global route planning to real-time MPC trajectory execution — we close the loop between "where am I" and "what do I do next."
                    </p>
                    <div class="pt-6 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-sm font-bold text-slate-400">03</span>
                        <i class="fa-solid fa-arrow-right text-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity transform -translate-x-2 group-hover:translate-x-0"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SECTION 4: TECH STACK (Dark Panel) ===== -->
    <section class="py-24 bg-slate-900 relative border-t border-slate-800">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-50"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16 reveal-on-scroll">
                <h2 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-5">
                    Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">Tech Stack</span>
                </h2>
                <p class="text-lg text-slate-400 leading-relaxed">
                    We build on proven frameworks and high-performance compute optimized for real-time safety-critical environments.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Stack 1 -->
                <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-6 hover:bg-slate-800 transition-colors reveal-on-scroll" data-delay="100">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400">
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white">Perception</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">OpenCV</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">PCL</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">Open3D</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">YOLO v8</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">TensorRT</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">DepthAI</span>
                    </div>
                </div>

                <!-- Stack 2 -->
                <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-6 hover:bg-slate-800 transition-colors reveal-on-scroll" data-delay="200">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400">
                            <i class="fa-solid fa-map-location-dot"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white">Localization & SLAM</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">RTAB-Map</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">Cartographer</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">AMCL</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">EKF</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">NavSat</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">HDMaps</span>
                    </div>
                </div>

                <!-- Stack 3 -->
                <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-6 hover:bg-slate-800 transition-colors reveal-on-scroll" data-delay="300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400">
                            <i class="fa-solid fa-route"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white">Planning</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">Nav2</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">MPC</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">A*</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">Hybrid A*</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">Frenet Planner</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">Behavior Trees</span>
                    </div>
                </div>

                <!-- Stack 4 -->
                <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-6 hover:bg-slate-800 transition-colors reveal-on-scroll" data-delay="400">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400">
                            <i class="fa-solid fa-microchip"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white">Middleware</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">ROS2 Humble</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">DDS</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">micro-ROS</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">CAN Bus</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">Autoware.Universe</span>
                    </div>
                </div>

                <!-- Stack 5 -->
                <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-6 hover:bg-slate-800 transition-colors reveal-on-scroll" data-delay="500">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400">
                            <i class="fa-solid fa-gauge-high"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white">Compute Targets</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">Jetson AGX Orin</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">Drive PX</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">Raspberry Pi CM4</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">x86_64 IPC</span>
                    </div>
                </div>

                <!-- Stack 6 -->
                <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-6 hover:bg-slate-800 transition-colors reveal-on-scroll" data-delay="600">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400">
                            <i class="fa-solid fa-vial"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white">Simulation & Validation</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">CARLA</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">Gazebo</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">LGSVL</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">RViz2</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">MCAP</span>
                        <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-700 text-xs font-mono text-slate-300">rosbag2</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    </section>

    <!-- ===== SECTION 6: OUR DEVELOPMENT PIPELINE ===== -->
    <section id="pipeline" class="py-24 bg-slate-50 border-t border-slate-200 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16 reveal-on-scroll">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-slate-200 shadow-sm mb-6">
                    <span class="text-xs font-bold text-cyan-700 uppercase tracking-wide">Methodology</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-5">
                    Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 to-blue-600">Development Pipeline</span>
                </h2>
            </div>

            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Left: Features -->
                <div class="space-y-8 reveal-on-scroll" data-delay="100">
                    <div class="flex gap-5">
                        <div class="w-12 h-12 rounded-xl bg-cyan-100 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-flask text-cyan-600 text-lg"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-slate-900 mb-2">Simulation-First Development</h4>
                            <p class="text-slate-600 leading-relaxed">Every module is validated in CARLA or Gazebo before it touches a vehicle. We don't debug on hardware.</p>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-shield-halved text-blue-600 text-lg"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-slate-900 mb-2">Safety-Critical Standards</h4>
                            <p class="text-slate-600 leading-relaxed">Code reviews structured around ISO 26262 awareness. Functional safety isn't a checklist — it's a design constraint from day one.</p>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-layer-group text-indigo-600 text-lg"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-slate-900 mb-2">Hardware-Agnostic Architecture</h4>
                            <p class="text-slate-600 leading-relaxed">We write to ROS2 abstractions. Swap the sensor vendor or compute platform without touching the algorithm layer.</p>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="w-12 h-12 rounded-xl bg-violet-100 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-chart-line text-violet-600 text-lg"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-slate-900 mb-2">Continuous Benchmarking</h4>
                            <p class="text-slate-600 leading-relaxed">Every PR runs perception accuracy, latency, and path quality benchmarks automatically. Regression is caught at commit time, not demo day.</p>
                        </div>
                    </div>
                </div>

                <!-- Right: Stepper -->
                <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-xl reveal-on-scroll" data-delay="300">
                    <div class="relative">
                        <!-- Connecting Line -->
                        <div class="absolute left-6 top-6 bottom-6 w-0.5 bg-gradient-to-b from-cyan-500 to-blue-600 opacity-30"></div>
                        
                        <div class="space-y-8 relative">
                            <!-- Step 1 -->
                            <div class="flex gap-6 relative">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-r from-cyan-500 to-cyan-600 text-white font-bold flex items-center justify-center shrink-0 relative z-10 shadow-md">1</div>
                                <div class="pt-2">
                                    <div class="text-xs font-bold text-cyan-600 uppercase tracking-wide mb-1">Phase 1</div>
                                    <h4 class="text-lg font-bold text-slate-900 mb-1">Perception Pipeline</h4>
                                    <p class="text-sm text-slate-500">Sensor driver → point cloud / image preprocessing → object detection & tracking</p>
                                </div>
                            </div>
                            <!-- Step 2 -->
                            <div class="flex gap-6 relative">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-r from-cyan-600 to-blue-500 text-white font-bold flex items-center justify-center shrink-0 relative z-10 shadow-md">2</div>
                                <div class="pt-2">
                                    <div class="text-xs font-bold text-blue-600 uppercase tracking-wide mb-1">Phase 2</div>
                                    <h4 class="text-lg font-bold text-slate-900 mb-1">Localization Stack</h4>
                                    <p class="text-sm text-slate-500">EKF-SLAM fusion → map building → real-time pose estimation</p>
                                </div>
                            </div>
                            <!-- Step 3 -->
                            <div class="flex gap-6 relative">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold flex items-center justify-center shrink-0 relative z-10 shadow-md">3</div>
                                <div class="pt-2">
                                    <div class="text-xs font-bold text-blue-600 uppercase tracking-wide mb-1">Phase 3</div>
                                    <h4 class="text-lg font-bold text-slate-900 mb-1">Planning Layer</h4>
                                    <p class="text-sm text-slate-500">Global route → local trajectory → behavior state machine</p>
                                </div>
                            </div>
                            <!-- Step 4 -->
                            <div class="flex gap-6 relative">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-r from-blue-600 to-indigo-500 text-white font-bold flex items-center justify-center shrink-0 relative z-10 shadow-md">4</div>
                                <div class="pt-2">
                                    <div class="text-xs font-bold text-indigo-600 uppercase tracking-wide mb-1">Phase 4</div>
                                    <h4 class="text-lg font-bold text-slate-900 mb-1">Control & Actuation</h4>
                                    <p class="text-sm text-slate-500">PID / MPC controller → CAN bus interface → actuator command</p>
                                </div>
                            </div>
                            <!-- Step 5 -->
                            <div class="flex gap-6 relative">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-r from-indigo-500 to-indigo-600 text-white font-bold flex items-center justify-center shrink-0 relative z-10 shadow-md">5</div>
                                <div class="pt-2">
                                    <div class="text-xs font-bold text-indigo-600 uppercase tracking-wide mb-1">Phase 5</div>
                                    <h4 class="text-lg font-bold text-slate-900 mb-1">Simulation Validation</h4>
                                    <p class="text-sm text-slate-500">Full-stack test in CARLA → edge case injection → performance report</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SECTION 7: WHO THIS IS FOR ===== -->
    <section class="py-24 bg-white border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16 reveal-on-scroll">
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-5">
                    Who We <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 to-blue-600">Partner With</span>
                </h2>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Card 1 -->
                <div class="bg-slate-50 border border-slate-200 rounded-[2rem] p-8 hover:bg-white hover:border-cyan-200 hover:shadow-xl hover:shadow-cyan-500/5 transition-all duration-300 reveal-on-scroll" data-delay="100">
                    <div class="w-14 h-14 bg-white border border-slate-200 rounded-2xl flex items-center justify-center mb-6 shadow-sm">
                        <i class="fa-solid fa-car text-2xl text-cyan-500"></i>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-4">Vehicle OEMs & Tier-1 Suppliers</h3>
                    <p class="text-slate-600 leading-relaxed mb-6">Need an autonomous software stack or specific perception/planning modules to integrate into an existing vehicle program.</p>
                    <div class="flex gap-2 flex-wrap">
                        <span class="px-3 py-1 bg-cyan-50 text-cyan-700 text-xs font-bold rounded-lg border border-cyan-200">Perception pipeline</span>
                        <span class="px-3 py-1 bg-cyan-50 text-cyan-700 text-xs font-bold rounded-lg border border-cyan-200">AUTOSAR integration</span>
                        <span class="px-3 py-1 bg-cyan-50 text-cyan-700 text-xs font-bold rounded-lg border border-cyan-200">Sensor calibration</span>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-slate-50 border border-slate-200 rounded-[2rem] p-8 hover:bg-white hover:border-blue-200 hover:shadow-xl hover:shadow-blue-500/5 transition-all duration-300 reveal-on-scroll" data-delay="200">
                    <div class="w-14 h-14 bg-white border border-slate-200 rounded-2xl flex items-center justify-center mb-6 shadow-sm">
                        <i class="fa-solid fa-truck text-2xl text-blue-500"></i>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-4">Logistics & Last-Mile Fleets</h3>
                    <p class="text-slate-600 leading-relaxed mb-6">Deploying AMRs or autonomous delivery vehicles where route predictability and fleet coordination are the hard problems.</p>
                    <div class="flex gap-2 flex-wrap">
                        <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-bold rounded-lg border border-blue-200">Fleet planning</span>
                        <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-bold rounded-lg border border-blue-200">SLAM nav</span>
                        <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-bold rounded-lg border border-blue-200">Route optimization</span>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-slate-50 border border-slate-200 rounded-[2rem] p-8 hover:bg-white hover:border-indigo-200 hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-300 reveal-on-scroll" data-delay="300">
                    <div class="w-14 h-14 bg-white border border-slate-200 rounded-2xl flex items-center justify-center mb-6 shadow-sm">
                        <i class="fa-solid fa-flask text-2xl text-indigo-500"></i>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-4">Autonomous Vehicle Startups</h3>
                    <p class="text-slate-600 leading-relaxed mb-6">Building a Level 2–4 system and need domain experts for a specific stack layer — not a generalist firm that "also does AI."</p>
                    <div class="flex gap-2 flex-wrap">
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold rounded-lg border border-indigo-200">Algorithm development</span>
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold rounded-lg border border-indigo-200">Simulation testing</span>
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold rounded-lg border border-indigo-200">Stack integration</span>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-slate-50 border border-slate-200 rounded-[2rem] p-8 hover:bg-white hover:border-violet-200 hover:shadow-xl hover:shadow-violet-500/5 transition-all duration-300 reveal-on-scroll" data-delay="400">
                    <div class="w-14 h-14 bg-white border border-slate-200 rounded-2xl flex items-center justify-center mb-6 shadow-sm">
                        <i class="fa-solid fa-university text-2xl text-violet-500"></i>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-4">Research & Academic Programs</h3>
                    <p class="text-slate-600 leading-relaxed mb-6">DARPA challenges, smart city pilots, and university AV programs needing ROS2 development support with rigorous documentation.</p>
                    <div class="flex gap-2 flex-wrap">
                        <span class="px-3 py-1 bg-violet-50 text-violet-700 text-xs font-bold rounded-lg border border-violet-200">ROS2 research stack</span>
                        <span class="px-3 py-1 bg-violet-50 text-violet-700 text-xs font-bold rounded-lg border border-violet-200">CARLA simulation</span>
                        <span class="px-3 py-1 bg-violet-50 text-violet-700 text-xs font-bold rounded-lg border border-violet-200">Dataset pipelines</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SECTION 8: TRUST SIGNALS ===== -->
    <section class="py-24 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-8 mb-16 reveal-on-scroll">
                <div class="text-center p-6">
                    <div class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 to-blue-600 mb-4">Real-Time</div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-2">Full-Stack Latency</h3>
                    <p class="text-slate-600">Perception → planning → control that runs in real time. Low latency isn't a benchmark target — it's a design principle baked into every layer.</p>
                </div>
                <div class="text-center p-6 border-t md:border-t-0 md:border-l border-slate-200">
                    <div class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-indigo-600 mb-4">ISO 26262</div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-2">Safety-Aware Engineering</h3>
                    <p class="text-slate-600">We don't certify. We design with functional safety in mind from architecture phase, so certification isn't a rewrite.</p>
                </div>
                <div class="text-center p-6 border-t md:border-t-0 md:border-l border-slate-200">
                    <div class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-violet-600 mb-4">Sim → Hardware</div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-2">No Surprises on Test Day</h3>
                    <p class="text-slate-600">Every algorithm ships with a simulation validation report. What works in CARLA works on the vehicle.</p>
                </div>
            </div>

            <div class="max-w-4xl mx-auto bg-white border border-slate-200 rounded-3xl p-10 md:p-12 shadow-xl reveal-on-scroll">
                <p class="text-xl text-slate-700 leading-relaxed font-medium text-center italic">
                    "We are not a general-purpose AI consultancy. Autonomous vehicle software fails in the gap between perception and planning, between simulation and hardware, between the demo and the edge case. We live in that gap. Every engineer on this team has shipped software that runs on a real vehicle, in real traffic, without a safety driver catching its mistakes."
                </p>
            </div>
        </div>
    </section>

    <!-- ===== SECTION 9: CTA ===== -->
    <section class="relative py-20 md:py-32 overflow-hidden bg-white reveal-on-scroll">
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-[900px] h-[900px] rounded-full" style="background: radial-gradient(circle, rgba(6,182,212,0.08) 0%, transparent 70%);"></div>
        </div>
        <div class="relative z-10 text-center max-w-4xl mx-auto px-6">
            <h2 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.1] mb-8">
                You know the destination.<br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 via-blue-500 to-indigo-600">We'll write the software</span><br/>
                that gets you there.
            </h2>
            <p class="text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed mb-10">
                One call with a senior autonomous systems engineer. No sales process — a direct technical scoping conversation about your vehicle program.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('contact') }}" class="group inline-flex items-center gap-3 px-10 py-5 bg-gradient-to-r from-cyan-500 to-blue-600 text-white text-lg font-bold rounded-xl shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 hover:-translate-y-1 transition-all duration-300">
                    Start a Technical Conversation <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="{{ route('services.index') }}" class="group inline-flex items-center gap-2 px-10 py-5 bg-white border-2 border-slate-200 text-slate-700 text-lg font-bold rounded-xl hover:border-cyan-300 hover:text-cyan-700 transition-all duration-300">
                    All R&D Services <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
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
    .reveal-on-scroll.revealed { opacity: 1; transform: translateY(0); }
    .reveal-on-scroll[data-delay="100"] { transition-delay: 0.1s; }
    .reveal-on-scroll[data-delay="200"] { transition-delay: 0.2s; }
    .reveal-on-scroll[data-delay="300"] { transition-delay: 0.3s; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Scroll Reveal
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
</script>
@endpush
