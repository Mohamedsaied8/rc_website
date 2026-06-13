@extends('components.layout')

@section('title', $departmentTitle . ' - Corporate Services')

@section('content')
    @include('components.page-hero', [
        'title' => 'Automotive Software Engineering',
        'subtitle' => 'Elite outsourcing for SDV architectures, AUTOSAR, and safety-critical mobility.'
    ])

    <!-- Cinematic Intro -->
    <section class="relative z-10 max-w-7xl mx-auto px-6 py-12 md:py-24">
        <div class="grid lg:grid-cols-2 gap-8 md:gap-16 items-center mb-12 md:mb-24">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-500/10 border border-purple-500/20 text-purple-400 text-sm font-semibold mb-6">
                    <i class="fa-solid fa-microchip"></i> Architecture-Driven Excellence
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-8">Software-Defined Vehicle Mastery</h2>
                <p class="text-slate-600 text-lg leading-relaxed mb-6">
                    We provide dedicated teams of elite software engineers to automotive giants. We scale your development capacity instantly without compromising code quality.
                </p>
                <p class="text-slate-600 text-lg leading-relaxed mb-8">
                    From embedded C++ development for ECU firmware to cloud-connected fleet management systems, our offshore teams integrate seamlessly with your internal development pipelines. We specialize in AUTOSAR-compliant architecture design and ISO 26262 functional safety compliance.
                </p>
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-purple-500 to-purple-400 rounded-xl text-white font-bold hover:scale-105 transition-transform duration-300 shadow-lg shadow-purple-500/30">
                    Engage Our Team
                </a>
            </div>
            <div class="relative rounded-3xl overflow-hidden border border-slate-200 shadow-2xl">
                <img src="{{ asset('images/dept_out_auto.png') }}" alt="Automotive Outsourcing" class="w-full object-cover h-[500px]">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-50 via-transparent to-transparent"></div>
            </div>
        </div>
    </section>

    <!-- Engineering Process Grid -->
    <section class="relative z-10 bg-white border-y border-slate-200 py-12 md:py-24">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-xs font-semibold text-purple-400 uppercase tracking-wider mb-2 block">How We Work</span>
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-4">Engineering Process & Quality</h2>
                <p class="text-slate-600 text-lg max-w-2xl mx-auto">A structured and disciplined engineering process designed for complex embedded systems where safety and maintainability are critical.</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden hover:border-purple-500/30 transition-colors group shadow-lg">
                    <div class="p-6 pb-0 cursor-pointer" onclick="openLightbox('{{ asset('images/w2.png') }}')">
                        <div class="relative overflow-hidden rounded-2xl mb-6 group/img">
                            <img src="{{ asset('images/w2.png') }}" alt="Interconnected Services" class="w-full transition-transform duration-500 group-hover/img:scale-105">
                            <div class="absolute inset-0 bg-white/40 opacity-0 group-hover/img:opacity-100 flex items-center justify-center transition-opacity duration-300 backdrop-blur-sm">
                                <i class="fa-solid fa-expand text-slate-900 text-3xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 pt-2 text-center">
                        <h4 class="text-xl font-extrabold text-slate-900 mb-3">Interconnected Services</h4>
                        <p class="text-slate-600 text-lg leading-relaxed">Technical consulting, product development, managed outsourcing, and architecture refactoring work together seamlessly.</p>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden hover:border-purple-500/30 transition-colors group shadow-lg">
                    <div class="p-6 pb-0 cursor-pointer" onclick="openLightbox('{{ asset('images/w3.png') }}')">
                        <div class="relative overflow-hidden rounded-2xl mb-6 group/img">
                            <img src="{{ asset('images/w3.png') }}" alt="SAFe for Automotive" class="w-full transition-transform duration-500 group-hover/img:scale-105">
                            <div class="absolute inset-0 bg-white/40 opacity-0 group-hover/img:opacity-100 flex items-center justify-center transition-opacity duration-300 backdrop-blur-sm">
                                <i class="fa-solid fa-expand text-slate-900 text-3xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 pt-2 text-center">
                        <h4 class="text-xl font-extrabold text-slate-900 mb-3">SAFe for Automotive</h4>
                        <p class="text-slate-600 text-lg leading-relaxed">Multi-level planning and execution with safety compliance at every stage of development.</p>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden hover:border-purple-500/30 transition-colors group shadow-lg">
                    <div class="p-6 pb-0 cursor-pointer" onclick="openLightbox('{{ asset('images/w5.png') }}')">
                        <div class="relative overflow-hidden rounded-2xl mb-6 group/img">
                            <img src="{{ asset('images/w5.png') }}" alt="CI/CD Pipeline" class="w-full transition-transform duration-500 group-hover/img:scale-105">
                            <div class="absolute inset-0 bg-white/40 opacity-0 group-hover/img:opacity-100 flex items-center justify-center transition-opacity duration-300 backdrop-blur-sm">
                                <i class="fa-solid fa-expand text-slate-900 text-3xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 pt-2 text-center">
                        <h4 class="text-xl font-extrabold text-slate-900 mb-3">CI/CD Pipeline</h4>
                        <p class="text-slate-600 text-lg leading-relaxed">DevOps with hardware-in-the-loop testing ensuring continuous integration and quality validation.</p>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden hover:border-purple-500/30 transition-colors group shadow-lg">
                    <div class="p-6 pb-0 cursor-pointer" onclick="openLightbox('{{ asset('images/w4.png') }}')">
                        <div class="relative overflow-hidden rounded-2xl mb-6 group/img">
                            <img src="{{ asset('images/w4.png') }}" alt="Safety-Critical Sprints" class="w-full transition-transform duration-500 group-hover/img:scale-105">
                            <div class="absolute inset-0 bg-white/40 opacity-0 group-hover/img:opacity-100 flex items-center justify-center transition-opacity duration-300 backdrop-blur-sm">
                                <i class="fa-solid fa-expand text-slate-900 text-3xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 pt-2 text-center">
                        <h4 class="text-xl font-extrabold text-slate-900 mb-3">Safety-Critical Sprints</h4>
                        <p class="text-slate-600 text-lg leading-relaxed">2-week sprints adapted for ISO 26262 & ASPICE compliance with rigorous checkpoints.</p>
                    </div>
                </div>
                <!-- Card 5 -->
                <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden hover:border-purple-500/30 transition-colors group shadow-lg">
                    <div class="p-6 pb-0 cursor-pointer" onclick="openLightbox('{{ asset('images/w6.png') }}')">
                        <div class="relative overflow-hidden rounded-2xl mb-6 group/img">
                            <img src="{{ asset('images/w6.png') }}" alt="Agile Transformation" class="w-full transition-transform duration-500 group-hover/img:scale-105">
                            <div class="absolute inset-0 bg-white/40 opacity-0 group-hover/img:opacity-100 flex items-center justify-center transition-opacity duration-300 backdrop-blur-sm">
                                <i class="fa-solid fa-expand text-slate-900 text-3xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 pt-2 text-center">
                        <h4 class="text-xl font-extrabold text-slate-900 mb-3">Agile Transformation</h4>
                        <p class="text-slate-600 text-lg leading-relaxed">Shifting from traditional to agile thinking with adaptive planning and iterative cycles.</p>
                    </div>
                </div>
                <!-- Card 6 -->
                <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden hover:border-purple-500/30 transition-colors group shadow-lg">
                    <div class="p-6 pb-0 cursor-pointer" onclick="openLightbox('{{ asset('images/w1.png') }}')">
                        <div class="relative overflow-hidden rounded-2xl mb-6 group/img">
                            <img src="{{ asset('images/w1.png') }}" alt="Architecture-First" class="w-full transition-transform duration-500 group-hover/img:scale-105">
                            <div class="absolute inset-0 bg-white/40 opacity-0 group-hover/img:opacity-100 flex items-center justify-center transition-opacity duration-300 backdrop-blur-sm">
                                <i class="fa-solid fa-expand text-slate-900 text-3xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 pt-2 text-center">
                        <h4 class="text-xl font-extrabold text-slate-900 mb-3">Architecture-First</h4>
                        <p class="text-slate-600 text-lg leading-relaxed">Connected layers from requirements through deployment with continuous iteration.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Deep Technical Architectural Overview - INTERACTIVE BLUEPRINT -->
    <section class="relative z-10 py-12 md:py-24 bg-gradient-to-b from-transparent to-purple-900/10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-xs font-semibold text-purple-400 uppercase tracking-wider mb-2 block">Interactive Blueprint</span>
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-6">Deep Technical <span class="text-purple-400">Architectural Overview</span></h2>
                <p class="text-slate-600 text-lg leading-relaxed max-w-2xl mx-auto">A comprehensive examination of how we compile these engineering domains to realize safety-certified, adaptive vehicle dynamics.</p>
            </div>

            <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-2xl flex flex-col md:flex-row min-h-[500px]">
                <!-- Interactive Sidebar -->
                <div class="w-full md:w-1/3 bg-white border-r border-slate-200 flex flex-col p-4 gap-2">
                    <button onclick="switchArch(1)" id="arch-btn-1" class="arch-btn group flex items-start gap-4 p-5 rounded-2xl text-left transition-all duration-300 bg-purple-500/10 border border-purple-500/20 shadow-[0_0_15px_rgba(168,85,247,0.15)]">
                        <span class="font-mono text-purple-400 font-bold mt-1">01</span>
                        <div>
                            <h4 class="text-slate-900 font-bold mb-1 group-hover:text-purple-400 transition-colors">Zonal E/E Architectures</h4>
                            <p class="text-slate-600 text-xs line-clamp-2">The centralization shift away from legacy decentralized ECUs.</p>
                        </div>
                    </button>

                    <button onclick="switchArch(2)" id="arch-btn-2" class="arch-btn group flex items-start gap-4 p-5 rounded-2xl text-left transition-all duration-300 hover:bg-slate-50 border border-transparent hover:border-slate-200">
                        <span class="font-mono text-slate-500 font-bold mt-1 group-hover:text-purple-400 transition-colors">02</span>
                        <div>
                            <h4 class="text-slate-600 font-bold mb-1 group-hover:text-slate-900 transition-colors">Service-Oriented Middleware</h4>
                            <p class="text-slate-500 text-xs line-clamp-2">Adaptive AUTOSAR, ara::com, and SOME/IP networking.</p>
                        </div>
                    </button>

                    <button onclick="switchArch(3)" id="arch-btn-3" class="arch-btn group flex items-start gap-4 p-5 rounded-2xl text-left transition-all duration-300 hover:bg-slate-50 border border-transparent hover:border-slate-200">
                        <span class="font-mono text-slate-500 font-bold mt-1 group-hover:text-purple-400 transition-colors">03</span>
                        <div>
                            <h4 class="text-slate-600 font-bold mb-1 group-hover:text-slate-900 transition-colors">Real-Time OS</h4>
                            <p class="text-slate-500 text-xs line-clamp-2">QNX Neutrino, Type 1 Hypervisors, and mixed criticality.</p>
                        </div>
                    </button>

                    <button onclick="switchArch(4)" id="arch-btn-4" class="arch-btn group flex items-start gap-4 p-5 rounded-2xl text-left transition-all duration-300 hover:bg-slate-50 border border-transparent hover:border-slate-200">
                        <span class="font-mono text-slate-500 font-bold mt-1 group-hover:text-purple-400 transition-colors">04</span>
                        <div>
                            <h4 class="text-slate-600 font-bold mb-1 group-hover:text-slate-900 transition-colors">AI Acceleration</h4>
                            <p class="text-slate-500 text-xs line-clamp-2">CUDA Kernels, TensorRT, and embedded GPU parallel processing.</p>
                        </div>
                    </button>
                </div>

                <!-- Dynamic Content Area -->
                <div class="w-full md:w-2/3 p-10 md:p-14 relative bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-purple-900/10 via-transparent to-transparent">
                    
                    <!-- Content 1 -->
                    <div id="arch-content-1" class="arch-content transition-all duration-500 opacity-100 transform translate-y-0 relative z-10">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-500/10 border border-purple-500/20 text-purple-400 text-xs font-semibold mb-6">
                            Architecture Shift
                        </div>
                        <h3 class="text-3xl font-extrabold text-slate-900 mb-6">The Centralization Shift: Zonal E/E</h3>
                        <p class="text-slate-600 text-lg leading-relaxed mb-6">Traditional vehicle engineering represents a decentralized mesh where each functional request involves isolated physical components. Introducing next-generation safety requirements, autonomous driving vision models, and continuous over-the-air updates renders this design obsolete due to harness complexity, bandwidth bottlenecks, and physical space constraints.</p>
                        <p class="text-slate-600 text-lg leading-relaxed">To overcome this, we design and support zonal E/E platforms. Zonal controllers act as high-speed data hubs, collecting raw sensor inputs (CAN, LIN, SPI) from their respective physical zones and converting them to Ethernet packets. These packets are routed via SOME/IP or DDS to a centralized High-Performance Compute (HPC) platform, containing the core processing elements required to make localized decisions in microseconds.</p>
                    </div>

                    <!-- Content 2 -->
                    <div id="arch-content-2" class="arch-content absolute inset-0 p-10 md:p-14 transition-all duration-500 opacity-0 pointer-events-none transform translate-y-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-500/10 border border-purple-500/20 text-purple-400 text-xs font-semibold mb-6">
                            Software Decoupling
                        </div>
                        <h3 class="text-3xl font-extrabold text-slate-900 mb-6">Service-Oriented Middleware</h3>
                        <p class="text-slate-600 text-lg leading-relaxed mb-8">In a Software-Defined Vehicle, applications are decoupled from the hardware layer through service-oriented middleware. Adaptive AUTOSAR provides the standard runtime environment (ara) for these applications. Instead of hardcoding signal routing via CAN matrices, application modules register as dynamic services exposing standardized APIs.</p>
                        
                        <div class="grid gap-6">
                            <div class="bg-white border border-slate-200 rounded-2xl p-6">
                                <h4 class="text-purple-400 font-bold mb-2 font-mono">ara::com</h4>
                                <p class="text-slate-600 text-sm">Manages service registration, subscription, and method invocation, abstracting whether communication is local (IPC) or remote (Ethernet).</p>
                            </div>
                            <div class="bg-white border border-slate-200 rounded-2xl p-6">
                                <h4 class="text-purple-400 font-bold mb-2 font-mono">SOME/IP & SOME/IP-SD</h4>
                                <p class="text-slate-600 text-sm">Establishes high-performance serialization over IP networks allowing controllers to detect new service instances dynamically at runtime.</p>
                            </div>
                            <div class="bg-white border border-slate-200 rounded-2xl p-6">
                                <h4 class="text-purple-400 font-bold mb-2 font-mono">ARXML Manifests</h4>
                                <p class="text-slate-600 text-sm">Defines strict resource constraints, scheduler properties, and networking mappings, allowing safe incremental updates.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Content 3 -->
                    <div id="arch-content-3" class="arch-content absolute inset-0 p-10 md:p-14 transition-all duration-500 opacity-0 pointer-events-none transform translate-y-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-500/10 border border-purple-500/20 text-purple-400 text-xs font-semibold mb-6">
                            Safety & Isolation
                        </div>
                        <h3 class="text-3xl font-extrabold text-slate-900 mb-6">Real-Time OS & Mixed Criticality</h3>
                        <p class="text-slate-600 text-lg leading-relaxed mb-8">Running high-performance autonomous perception alongside safety-critical vehicle dynamics controls requires a robust real-time operating system that guarantees freedom from interference. We utilize QNX Neutrino RTOS and Type 1 hypervisors to handle these mixed-criticality requirements:</p>
                        
                        <div class="space-y-6 relative before:absolute before:inset-y-0 before:left-4 before:w-px before:bg-white/[0.1]">
                            <div class="flex items-start gap-4 relative">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full border-2 flex items-center justify-center mt-0.5 z-10 relative" style="background-color: #ffffff; border-color: #a855f7;">
                                    <div class="w-2 h-2 rounded-full" style="background-color: #a855f7;"></div>
                                </div>
                                <div>
                                    <h4 class="text-slate-900 font-bold mb-2 text-xl">Microkernel Architecture</h4>
                                    <p class="text-slate-600 text-lg">QNX runs system drivers, filesystems, and network stacks in user space, ensuring that a driver crash cannot bring down the core kernel.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 relative">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full border-2 flex items-center justify-center mt-0.5 z-10 relative" style="background-color: #ffffff; border-color: #a855f7;">
                                    <div class="w-2 h-2 rounded-full" style="background-color: #a855f7;"></div>
                                </div>
                                <div>
                                    <h4 class="text-slate-900 font-bold mb-2 text-xl">Hypervisor Partitioning</h4>
                                    <p class="text-slate-600 text-lg">We run isolated virtual machines on a single SoC. Safety-critical tasks run in an ASIL-D QNX partition, while non-safety-critical interfaces (AAOS) run in parallel, fully isolated.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content 4 -->
                    <div id="arch-content-4" class="arch-content absolute inset-0 p-10 md:p-14 transition-all duration-500 opacity-0 pointer-events-none transform translate-y-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-500/10 border border-purple-500/20 text-purple-400 text-xs font-semibold mb-6">
                            Parallel Performance
                        </div>
                        <h3 class="text-3xl font-extrabold text-slate-900 mb-6">AI Acceleration (CUDA)</h3>
                        <p class="text-slate-600 text-lg leading-relaxed mb-8">AI-Defined Vehicles (AIDV) demand parallel processing to handle multi-camera perception, LiDAR point cloud processing, and local NLP. We optimize these intensive math routines for embedded GPUs:</p>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="bg-gradient-to-br from-purple-500/10 to-transparent border border-purple-500/20 rounded-2xl p-6">
                                <i class="fa-solid fa-microchip text-2xl text-purple-400 mb-4"></i>
                                <h4 class="text-slate-900 font-bold mb-2">CUDA Kernels</h4>
                                <p class="text-slate-600 text-sm">Custom kernels handle image preprocessing, format conversion, and coordinate transformations in parallel, freeing CPU overhead.</p>
                            </div>
                            <div class="bg-gradient-to-br from-purple-500/10 to-transparent border border-purple-500/20 rounded-2xl p-6">
                                <i class="fa-solid fa-layer-group text-2xl text-purple-400 mb-4"></i>
                                <h4 class="text-slate-900 font-bold mb-2">TensorRT Optimization</h4>
                                <p class="text-slate-600 text-sm">Deep learning perception networks are optimized for runtime execution using INT8/FP16 quantization and kernel auto-tuning.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 z-[100] bg-white/90 backdrop-blur-md hidden flex-col items-center justify-center opacity-0 transition-opacity duration-300">
        <button onclick="closeLightbox()" class="absolute top-6 right-6 w-12 h-12 flex items-center justify-center rounded-full bg-white/10 border border-white/10 text-slate-900 hover:bg-white/20 hover:scale-110 hover:shadow-[0_0_20px_rgba(46,196,182,0.25)] transition-all z-[101]">
            <i class="fa-solid fa-xmark text-xl"></i>
        </button>
        <div id="lightbox-wrapper" class="flex items-center justify-center transform scale-95 transition-transform duration-300">
            <img id="lightbox-img" src="" alt="Process Expanded" class="block max-w-[90vw] max-h-[85vh] rounded-2xl border border-teal-400/30 shadow-[0_8px_60px_rgba(0,0,0,0.5),0_0_40px_rgba(46,196,182,0.15)] bg-white">
        </div>
    </div>

    @push('scripts')
    <script>
        // Interactive Blueprint Logic
        function switchArch(id) {
            // Reset all buttons
            document.querySelectorAll('.arch-btn').forEach(btn => {
                btn.className = 'arch-btn group flex items-start gap-4 p-5 rounded-2xl text-left transition-all duration-300 hover:bg-slate-50 border border-transparent hover:border-slate-200';
                btn.querySelector('span').className = 'font-mono text-slate-500 font-bold mt-1 group-hover:text-purple-400 transition-colors';
                btn.querySelector('h4').className = 'text-slate-600 font-bold mb-1 group-hover:text-slate-900 transition-colors';
            });

            // Activate clicked button
            const activeBtn = document.getElementById('arch-btn-' + id);
            activeBtn.className = 'arch-btn group flex items-start gap-4 p-5 rounded-2xl text-left transition-all duration-300 bg-purple-500/10 border border-purple-500/20 shadow-[0_0_15px_rgba(168,85,247,0.15)]';
            activeBtn.querySelector('span').className = 'font-mono text-purple-400 font-bold mt-1';
            activeBtn.querySelector('h4').className = 'text-slate-900 font-bold mb-1';

            // Hide all content blocks
            document.querySelectorAll('.arch-content').forEach(content => {
                content.classList.remove('opacity-100', 'translate-y-0', 'relative', 'z-10');
                content.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4', 'absolute', 'inset-0');
            });

            // Show active content block
            const activeContent = document.getElementById('arch-content-' + id);
            activeContent.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-4', 'absolute', 'inset-0');
            activeContent.classList.add('opacity-100', 'translate-y-0', 'relative', 'z-10');
        }

        // Lightbox Logic
        function openLightbox(src) {
            const lightbox = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');
            const wrapper = document.getElementById('lightbox-wrapper');
            
            img.src = src;
            lightbox.classList.remove('hidden');
            lightbox.style.display = 'flex';
            
            // Trigger reflow
            void lightbox.offsetWidth;
            
            lightbox.classList.remove('opacity-0');
            wrapper.classList.remove('scale-95');
            wrapper.classList.add('scale-100');
            
            // Prevent scrolling on body
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            const wrapper = document.getElementById('lightbox-wrapper');
            
            lightbox.classList.add('opacity-0');
            wrapper.classList.remove('scale-100');
            wrapper.classList.add('scale-95');
            
            setTimeout(() => {
                lightbox.classList.add('hidden');
                lightbox.style.display = 'none';
                document.body.style.overflow = '';
            }, 300);
        }

        // Close lightbox on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('lightbox').classList.contains('hidden')) {
                closeLightbox();
            }
        });

        // Close lightbox on click outside image
        document.getElementById('lightbox').addEventListener('click', function(e) {
            if (e.target === this || e.target.closest('#lightbox-wrapper') === null || e.target === document.getElementById('lightbox-wrapper')) {
                closeLightbox();
            }
        });
    </script>
    @endpush

    <!-- SDV Architecture Showcase -->
    <section class="relative z-10 max-w-5xl mx-auto px-6 py-12 md:py-24">
        <div class="bg-white border border-purple-500/20 rounded-3xl p-10 shadow-[0_0_50px_rgba(168,85,247,0.05)] overflow-hidden">
            <div class="text-center mb-12">
                <span class="text-xs font-semibold text-purple-400 uppercase tracking-wider mb-2 block">System Architecture</span>
                <h3 class="text-3xl font-extrabold text-slate-900 mb-4">Next-Generation Zonal E/E Layout</h3>
                <p class="text-slate-600 text-lg max-w-2xl mx-auto">Transition from decentralized ECUs to zonal hubs communicating with a high-performance Central Compute unit via SOME/IP over automotive Ethernet.</p>
            </div>
            
            <div class="w-full overflow-x-auto">
                <svg class="w-full" viewBox="0 0 800 450" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Background Glow -->
                    <circle cx="400" cy="225" r="150" fill="url(#radialGlow)" opacity="0.15"/>
                    
                    <!-- Connectors -->
                    <path d="M180 120 L400 225" stroke="#a855f7" stroke-width="2" stroke-dasharray="6 4" opacity="0.6"/>
                    <path d="M180 330 L400 225" stroke="#a855f7" stroke-width="2" stroke-dasharray="6 4" opacity="0.6"/>
                    <path d="M620 120 L400 225" stroke="#a855f7" stroke-width="2" stroke-dasharray="6 4" opacity="0.6"/>
                    <path d="M620 330 L400 225" stroke="#a855f7" stroke-width="2" stroke-dasharray="6 4" opacity="0.6"/>
                    
                    <path d="M100 120 L180 120" stroke="#6b21a8" stroke-width="1.5" opacity="0.7"/>
                    <path d="M100 330 L180 330" stroke="#6b21a8" stroke-width="1.5" opacity="0.7"/>
                    <path d="M700 120 L620 120" stroke="#6b21a8" stroke-width="1.5" opacity="0.7"/>
                    <path d="M700 330 L620 330" stroke="#6b21a8" stroke-width="1.5" opacity="0.7"/>

                    <!-- Central Compute Platform -->
                    <rect x="300" y="175" width="200" height="100" rx="12" fill="#f3e8ff" stroke="#a855f7" stroke-width="3"/>
                    <text x="400" y="215" fill="#4c1d95" font-family="system-ui, sans-serif" font-size="16" font-weight="bold" text-anchor="middle">Central Compute</text>
                    <text x="400" y="235" fill="#7e22ce" font-family="monospace" font-size="11" text-anchor="middle">QNX RTOS / AGL</text>
                    <text x="400" y="250" fill="#475569" font-family="monospace" font-size="10" text-anchor="middle">Adaptive AUTOSAR &amp; CUDA</text>

                    <!-- Zonal Nodes -->
                    <!-- Front Left Zone -->
                    <rect x="110" y="85" width="140" height="70" rx="8" fill="#f8fafc" stroke="#6b21a8" stroke-width="2"/>
                    <text x="180" y="115" fill="#0f172a" font-family="system-ui, sans-serif" font-size="12" font-weight="bold" text-anchor="middle">Front Left Zone</text>
                    <text x="180" y="135" fill="#475569" font-family="monospace" font-size="9" text-anchor="middle">Classic AUTOSAR</text>

                    <!-- Rear Left Zone -->
                    <rect x="110" y="295" width="140" height="70" rx="8" fill="#f8fafc" stroke="#6b21a8" stroke-width="2"/>
                    <text x="180" y="325" fill="#0f172a" font-family="system-ui, sans-serif" font-size="12" font-weight="bold" text-anchor="middle">Rear Left Zone</text>
                    <text x="180" y="345" fill="#475569" font-family="monospace" font-size="9" text-anchor="middle">Classic AUTOSAR</text>

                    <!-- Front Right Zone -->
                    <rect x="550" y="85" width="140" height="70" rx="8" fill="#f8fafc" stroke="#6b21a8" stroke-width="2"/>
                    <text x="620" y="115" fill="#0f172a" font-family="system-ui, sans-serif" font-size="12" font-weight="bold" text-anchor="middle">Front Right Zone</text>
                    <text x="620" y="135" fill="#475569" font-family="monospace" font-size="9" text-anchor="middle">Classic AUTOSAR</text>

                    <!-- Rear Right Zone -->
                    <rect x="550" y="295" width="140" height="70" rx="8" fill="#f8fafc" stroke="#6b21a8" stroke-width="2"/>
                    <text x="620" y="325" fill="#0f172a" font-family="system-ui, sans-serif" font-size="12" font-weight="bold" text-anchor="middle">Rear Right Zone</text>
                    <text x="620" y="345" fill="#475569" font-family="monospace" font-size="9" text-anchor="middle">Classic AUTOSAR</text>

                    <!-- Sensors & Actuators peripheral nodes -->
                    <circle cx="60" cy="120" r="20" fill="#f1f5f9" stroke="#a855f7" stroke-width="1.5"/>
                    <text x="60" y="124" fill="#7e22ce" font-family="system-ui, sans-serif" font-size="10" font-weight="bold" text-anchor="middle">CAM</text>

                    <circle cx="60" cy="330" r="20" fill="#f1f5f9" stroke="#a855f7" stroke-width="1.5"/>
                    <text x="60" y="334" fill="#7e22ce" font-family="system-ui, sans-serif" font-size="10" font-weight="bold" text-anchor="middle">RADAR</text>

                    <circle cx="740" cy="120" r="20" fill="#f1f5f9" stroke="#a855f7" stroke-width="1.5"/>
                    <text x="740" y="124" fill="#7e22ce" font-family="system-ui, sans-serif" font-size="10" font-weight="bold" text-anchor="middle">HUD</text>

                    <circle cx="740" cy="330" r="20" fill="#f1f5f9" stroke="#a855f7" stroke-width="1.5"/>
                    <text x="740" y="334" fill="#7e22ce" font-family="system-ui, sans-serif" font-size="10" font-weight="bold" text-anchor="middle">ACT</text>

                    <!-- Definitions -->
                    <defs>
                    <radialGradient id="radialGlow" cx="50%" cy="50%" r="50%">
                        <stop offset="0%" stop-color="#a855f7" stop-opacity="1"/>
                        <stop offset="100%" stop-color="#a855f7" stop-opacity="0"/>
                    </radialGradient>
                    </defs>
                </svg>
            </div>
        </div>
    </section>

    <!-- AIDV / Autonomous Showcase -->
    <section class="relative z-10 max-w-7xl mx-auto px-6 py-12 md:py-24 border-t border-slate-200">
        <div class="grid lg:grid-cols-2 gap-8 md:gap-16 items-center">
            <div class="order-2 lg:order-1 relative rounded-3xl overflow-hidden border border-slate-200 shadow-2xl">
                <!-- Using one of the generated images for the autonomous part -->
                <img src="{{ asset('images/dept_rnd_cars.png') }}" alt="AI-Defined Vehicles" class="w-full object-cover h-[500px]">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-50 via-transparent to-transparent"></div>
            </div>
            <div class="order-1 lg:order-2">
                <span class="text-xs font-semibold text-purple-400 uppercase tracking-wider mb-2 block">Autonomous Intelligence</span>
                <h3 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-6">AI-Defined Vehicles (AIDV)</h3>
                <p class="text-slate-600 text-lg leading-relaxed mb-8">
                    AI represents the intelligent cognitive layer of the vehicle. We provide elite AI engineers who embed neural network perception pipelines, high-performance sensor fusion, and natural language interfaces directly into the vehicle's runtime environment.
                </p>
                
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-lg bg-purple-500/10 border border-purple-500/20 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-brain text-xl text-purple-400"></i>
                        </div>
                        <div>
                            <h4 class="text-slate-900 font-bold mb-1">Heterogeneous Compute</h4>
                            <p class="text-slate-600 text-sm">CUDA-accelerated sensor processing pipelines executing on high-performance automotive GPUs (NVIDIA Orin).</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-lg bg-purple-500/10 border border-purple-500/20 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-eye text-xl text-purple-400"></i>
                        </div>
                        <div>
                            <h4 class="text-slate-900 font-bold mb-1">3D Computer Vision Perception</h4>
                            <p class="text-slate-600 text-sm">LiDAR-Camera sensor fusion models optimized via TensorRT for ultra-low latency inference.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-lg bg-purple-500/10 border border-purple-500/20 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-comment-dots text-xl text-purple-400"></i>
                        </div>
                        <div>
                            <h4 class="text-slate-900 font-bold mb-1">Local Cabin AI & NLP</h4>
                            <p class="text-slate-600 text-sm">Deployment of local Small Language Models (SLMs) for low-latency in-cabin offline voice assistants.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Elite Developer Skill Matrix -->
    <section class="relative z-10 py-12 md:py-24 border-t border-slate-200 bg-gradient-to-b from-transparent to-slate-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-6">Comprehensive Engineering Matrix</h2>
                <p class="text-slate-600 text-lg max-w-3xl mx-auto">Traceable competencies spanning SDV Infrastructure and Autonomous Intelligence (AIDV).</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Adaptive AUTOSAR -->
                <div class="bg-white border border-slate-200 backdrop-blur-xl rounded-2xl p-8 hover:bg-slate-50 transition-colors border-t-2 border-t-purple-500/30">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-2.5 py-1 rounded-md bg-purple-500/10 text-purple-400 text-xs font-bold uppercase tracking-wider">Infrastructure</span>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-3">Adaptive AUTOSAR</h3>
                    <p class="text-slate-600 text-sm mb-6">Vector DaVinci, ARXML Manifests, ara::com, ara::exec</p>
                    <div class="space-y-3">
                        <div class="flex gap-4 items-start">
                            <span class="text-purple-400 text-sm font-bold w-6">L3</span>
                            <p class="text-slate-600 text-sm">Implements custom service designs; manages state transitions.</p>
                        </div>
                        <div class="flex gap-4 items-start">
                            <span class="text-purple-400 text-sm font-bold w-6">L4</span>
                            <p class="text-slate-600 text-sm">Optimizes stack configurations; troubleshoots platform startup.</p>
                        </div>
                    </div>
                </div>

                <!-- IPC & SOME/IP -->
                <div class="bg-white border border-slate-200 backdrop-blur-xl rounded-2xl p-8 hover:bg-slate-50 transition-colors border-t-2 border-t-purple-500/30">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-2.5 py-1 rounded-md bg-purple-500/10 text-purple-400 text-xs font-bold uppercase tracking-wider">Infrastructure</span>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-3">IPC & SOME/IP</h3>
                    <p class="text-slate-600 text-sm mb-6">SOME/IP-SD, POSIX Shared Memory, Domain Sockets, vsomeip</p>
                    <div class="space-y-3">
                        <div class="flex gap-4 items-start">
                            <span class="text-purple-400 text-sm font-bold w-6">L3</span>
                            <p class="text-slate-600 text-sm">Customizes serialization rules; manages zero-copy allocations.</p>
                        </div>
                        <div class="flex gap-4 items-start">
                            <span class="text-purple-400 text-sm font-bold w-6">L5</span>
                            <p class="text-slate-600 text-sm">Architects global vehicle network messaging protocols.</p>
                        </div>
                    </div>
                </div>

                <!-- Algorithms -->
                <div class="bg-white border border-slate-200 backdrop-blur-xl rounded-2xl p-8 hover:bg-slate-50 transition-colors border-t-2 border-t-purple-500/30">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-2.5 py-1 rounded-md bg-purple-500/10 text-purple-400 text-xs font-bold uppercase tracking-wider">Intelligence</span>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-3">Autonomous Algorithms</h3>
                    <p class="text-slate-600 text-sm mb-6">Kalman Filters, A*, Hybrid A*, MPC, Optimization</p>
                    <div class="space-y-3">
                        <div class="flex gap-4 items-start">
                            <span class="text-purple-400 text-sm font-bold w-6">L4</span>
                            <p class="text-slate-600 text-sm">Optimizes complex multi-sensor fusion algorithms.</p>
                        </div>
                        <div class="flex gap-4 items-start">
                            <span class="text-purple-400 text-sm font-bold w-6">L5</span>
                            <p class="text-slate-600 text-sm">Sets algorithmic research vectors; designs safety-critical fallback trajectories.</p>
                        </div>
                    </div>
                </div>

                <!-- Computer Vision & NLP -->
                <div class="bg-white border border-slate-200 backdrop-blur-xl rounded-2xl p-8 hover:bg-slate-50 transition-colors border-t-2 border-t-purple-500/30">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-2.5 py-1 rounded-md bg-purple-500/10 text-purple-400 text-xs font-bold uppercase tracking-wider">Intelligence</span>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-3">Vision & NLP</h3>
                    <p class="text-slate-600 text-sm mb-6">PyTorch, YOLO, Transformer Architectures, SLMs</p>
                    <div class="space-y-3">
                        <div class="flex gap-4 items-start">
                            <span class="text-purple-400 text-sm font-bold w-6">L4</span>
                            <p class="text-slate-600 text-sm">Runs quantitative compression models (INT8) for SoCs.</p>
                        </div>
                        <div class="flex gap-4 items-start">
                            <span class="text-purple-400 text-sm font-bold w-6">L5</span>
                            <p class="text-slate-600 text-sm">Directs multimodal VLA AI research; designs safety-assured deep learning architectures.</p>
                        </div>
                    </div>
                </div>

                <!-- Parallel Processing -->
                <div class="bg-white border border-slate-200 backdrop-blur-xl rounded-2xl p-8 hover:bg-slate-50 transition-colors border-t-2 border-t-purple-500/30">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-2.5 py-1 rounded-md bg-purple-500/10 text-purple-400 text-xs font-bold uppercase tracking-wider">Intelligence</span>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-3">Parallel Compute (CUDA)</h3>
                    <p class="text-slate-600 text-sm mb-6">CUDA Toolkit, NVIDIA TensorRT, Thrust, cuDNN</p>
                    <div class="space-y-3">
                        <div class="flex gap-4 items-start">
                            <span class="text-purple-400 text-sm font-bold w-6">L4</span>
                            <p class="text-slate-600 text-sm">Writes high-performance kernels for tensor operators.</p>
                        </div>
                        <div class="flex gap-4 items-start">
                            <span class="text-purple-400 text-sm font-bold w-6">L5</span>
                            <p class="text-slate-600 text-sm">Architects global GPU scheduler mechanisms.</p>
                        </div>
                    </div>
                </div>

                <!-- POSIX-Based OSes -->
                <div class="bg-white border border-slate-200 backdrop-blur-xl rounded-2xl p-8 hover:bg-slate-50 transition-colors border-t-2 border-t-purple-500/30">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-2.5 py-1 rounded-md bg-purple-500/10 text-purple-400 text-xs font-bold uppercase tracking-wider">Infrastructure</span>
                    </div>
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-3">POSIX OSes (QNX)</h3>
                    <p class="text-slate-600 text-sm mb-6">QNX Neutrino RTOS, Automotive Grade Linux, Hypervisors</p>
                    <div class="space-y-3">
                        <div class="flex gap-4 items-start">
                            <span class="text-purple-400 text-sm font-bold w-6">L4</span>
                            <p class="text-slate-600 text-sm">Configures hypervisors; tunes real-time scheduling priorities.</p>
                        </div>
                        <div class="flex gap-4 items-start">
                            <span class="text-purple-400 text-sm font-bold w-6">L5</span>
                            <p class="text-slate-600 text-sm">Architects complete OS layout for critical SoCs (ASIL-D).</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="text-center mt-24">
            <a href="{{ route('services.show', $serviceId) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-purple-400 transition-colors group">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                Back to {{ strtoupper($serviceId) }} Overview
            </a>
        </div>
    </section>
@endsection
