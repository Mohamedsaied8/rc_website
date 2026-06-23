@extends('components.layout')

@section('title', 'Hardware & Software Products - Robotics Corner')

@section('content')
    @include('components.page-hero', [
        'title' => cms('products.hero.title', 'Proprietary Products'),
        'subtitle' => cms('products.hero.subtitle', 'High-performance robotic platforms and intelligent software solutions engineered for industry.')
    ])

    <section class="relative z-10 max-w-7xl mx-auto px-6 py-16" x-data="quoteModal()">
        <!-- Product Grid -->
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- AMR -->
            <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden flex flex-col group hover:border-cyan-300 transition-all duration-500 shadow-sm hover:shadow-xl">
                <div class="h-64 relative flex items-center justify-center overflow-hidden border-b border-slate-100">
                    <img src="{{ cms('products.amr.img', asset('images/product_amr.png'), true) }}" data-cms-image="products.amr.img" alt="Autonomous Mobile Robots" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                </div>
                <div class="p-8 flex-grow flex flex-col">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="px-2.5 py-1 rounded-md bg-slate-50 border border-slate-200 text-xs font-bold text-cyan-600 tracking-wider uppercase">Hardware</span>
                        <span class="px-2.5 py-1 rounded-md bg-slate-50 border border-slate-200 text-xs font-bold text-slate-500 tracking-wider uppercase">V2.4</span>
                    </div>
                    <h3 class="text-3xl font-extrabold text-slate-900 mb-4">{{ cms('products.amr.title', 'Autonomous Mobile Robots (AMR)') }}</h3>
                    <p class="text-slate-600 leading-relaxed mb-8 flex-grow">
                        {{ cms('products.amr.desc', 'Intelligent mobile platforms built for dynamic industrial environments. Featuring advanced SLAM, dynamic obstacle avoidance, and seamless API integration for fleet management.') }}
                    </p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-3 text-sm font-semibold text-slate-600"><i class="fa-solid fa-check text-cyan-500"></i> 500kg Payload Capacity</li>
                        <li class="flex items-center gap-3 text-sm font-semibold text-slate-600"><i class="fa-solid fa-check text-cyan-500"></i> LiDAR & 3D Depth Vision</li>
                        <li class="flex items-center gap-3 text-sm font-semibold text-slate-600"><i class="fa-solid fa-check text-cyan-500"></i> 12-Hour Continuous Operation</li>
                    </ul>
                    <button @click="openModal('Autonomous Mobile Robot (AMR)')" class="w-full py-4 bg-gradient-to-r from-cyan-500 to-emerald-500 rounded-xl text-white font-bold hover:shadow-lg hover:shadow-cyan-500/30 transition-all duration-300 flex items-center justify-center gap-2">
                        Customize & Quote <i class="fa-solid fa-file-signature"></i>
                    </button>
                </div>
            </div>

            <!-- Manipulators -->
            <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden flex flex-col group hover:border-emerald-300 transition-all duration-500 shadow-sm hover:shadow-xl">
                <div class="h-64 relative flex items-center justify-center overflow-hidden border-b border-slate-100">
                    <img src="{{ cms('products.manipulator.img', asset('images/product_manipulator.png'), true) }}" data-cms-image="products.manipulator.img" alt="Autonomous Manipulators" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                </div>
                <div class="p-8 flex-grow flex flex-col">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="px-2.5 py-1 rounded-md bg-slate-50 border border-slate-200 text-xs font-bold text-emerald-600 tracking-wider uppercase">Hardware</span>
                        <span class="px-2.5 py-1 rounded-md bg-slate-50 border border-slate-200 text-xs font-bold text-slate-500 tracking-wider uppercase">6-Axis</span>
                    </div>
                    <h3 class="text-3xl font-extrabold text-slate-900 mb-4">{{ cms('products.manipulator.title', 'Autonomous Manipulators') }}</h3>
                    <p class="text-slate-600 leading-relaxed mb-8 flex-grow">
                        {{ cms('products.manipulator.desc', 'High-precision robotic arms equipped with computer vision and sub-millimeter force feedback for automated assembly, picking, packing, and complex manipulation tasks.') }}
                    </p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-3 text-sm font-semibold text-slate-600"><i class="fa-solid fa-check text-emerald-500"></i> ±0.05mm Repeatability</li>
                        <li class="flex items-center gap-3 text-sm font-semibold text-slate-600"><i class="fa-solid fa-check text-emerald-500"></i> Integrated AI Vision System</li>
                        <li class="flex items-center gap-3 text-sm font-semibold text-slate-600"><i class="fa-solid fa-check text-emerald-500"></i> Collaborative (Cobot) Options</li>
                    </ul>
                    <button @click="openModal('Autonomous Manipulator Arm')" class="w-full py-4 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl text-white font-bold hover:shadow-lg hover:shadow-emerald-500/30 transition-all duration-300 flex items-center justify-center gap-2">
                        Customize & Quote <i class="fa-solid fa-file-signature"></i>
                    </button>
                </div>
            </div>

            <!-- RoboAgent -->
            <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden flex flex-col group hover:border-purple-300 transition-all duration-500 shadow-sm hover:shadow-xl">
                <div class="h-64 relative flex items-center justify-center overflow-hidden border-b border-slate-100">
                    <img src="{{ cms('products.ide.img', asset('images/product_ide.png'), true) }}" data-cms-image="products.ide.img" alt="RoboAgent IDE" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                </div>
                <div class="p-8 flex-grow flex flex-col">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="px-2.5 py-1 rounded-md bg-slate-50 border border-slate-200 text-xs font-bold text-purple-600 tracking-wider uppercase">Software</span>
                        <span class="px-2.5 py-1 rounded-md bg-slate-50 border border-slate-200 text-xs font-bold text-slate-500 tracking-wider uppercase">Cloud/Local</span>
                    </div>
                    <h3 class="text-3xl font-extrabold text-slate-900 mb-4">{{ cms('products.ide.title', 'RoboAgent IDE') }}</h3>
                    <p class="text-slate-600 leading-relaxed mb-8 flex-grow">
                        {{ cms('products.ide.desc', 'Our proprietary Integrated Development Environment specifically tailored for robotics programming. Features native ROS2 integration, real-time physics simulation, and fleet monitoring.') }}
                    </p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-3 text-sm font-semibold text-slate-600"><i class="fa-solid fa-check text-purple-500"></i> Native ROS/ROS2 Support</li>
                        <li class="flex items-center gap-3 text-sm font-semibold text-slate-600"><i class="fa-solid fa-check text-purple-500"></i> 3D Physics Simulation Engine</li>
                        <li class="flex items-center gap-3 text-sm font-semibold text-slate-600"><i class="fa-solid fa-check text-purple-500"></i> Over-the-Air (OTA) Deployments</li>
                    </ul>
                    <a href="https://roboagentweb.vercel.app/" target="_blank" class="w-full py-4 bg-gradient-to-r from-purple-500 to-fuchsia-500 rounded-xl text-white font-bold hover:shadow-lg hover:shadow-purple-500/30 transition-all duration-300 flex items-center justify-center gap-2">
                        Visit RoboAgent Website <i class="fa-solid fa-globe"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Quote Modal -->
        <div x-show="isOpen" 
             style="display: none;"
             class="fixed inset-0 z-50 overflow-y-auto" 
             aria-labelledby="modal-title" 
             role="dialog" 
             aria-modal="true">
             
            <!-- Backdrop -->
            <div x-show="isOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" 
                 @click="closeModal()"></div>

            <!-- Modal Panel -->
            <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                <div x-show="isOpen"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative transform overflow-hidden rounded-2xl bg-white border border-slate-200 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                    
                    <div class="absolute top-0 right-0 pt-4 pr-4">
                        <button @click="closeModal()" type="button" class="rounded-lg bg-slate-50 p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors border border-slate-200">
                            <span class="sr-only">Close</span>
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <div class="p-8 sm:p-10">
                        <div class="mb-8">
                            <h3 class="text-2xl font-extrabold text-slate-900 mb-2" id="modal-title">Request a Quote</h3>
                            <p class="text-slate-600">Configure your requirements for <span x-text="selectedProduct" class="text-cyan-600 font-bold"></span>.</p>
                        </div>

                        <form class="space-y-6" action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="quote">
                            <input type="hidden" name="subject" x-bind:value="'Quote Request: ' + selectedProduct">
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Name</label>
                                    <input type="text" name="name" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors placeholder-slate-400">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Company Name (Optional)</label>
                                    <input type="text" name="company" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors placeholder-slate-400">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-1 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Work Email</label>
                                    <input type="email" name="email" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors placeholder-slate-400">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Project Constraints & Requirements</label>
                                <textarea name="message" rows="4" required placeholder="Please describe payload requirements, environment details, integration needs, or licensing volume..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors resize-none placeholder-slate-400"></textarea>
                            </div>

                            <div class="pt-4 flex items-center justify-end gap-4 border-t border-slate-100">
                                <button type="button" @click="closeModal()" class="px-6 py-3 rounded-xl font-bold text-slate-500 hover:bg-slate-50 transition-colors border border-slate-200">
                                    Cancel
                                </button>
                                <button type="submit" class="px-8 py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-emerald-500 text-white font-bold hover:shadow-lg hover:shadow-cyan-500/30 transition-all">
                                    Submit Request
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('quoteModal', () => ({
                isOpen: false,
                selectedProduct: '',
                
                openModal(productName) {
                    this.selectedProduct = productName;
                    this.isOpen = true;
                    document.body.style.overflow = 'hidden';
                },
                
                closeModal() {
                    this.isOpen = false;
                    document.body.style.overflow = '';
                    setTimeout(() => { this.selectedProduct = ''; }, 300);
                },

                submitForm() {
                    // Placeholder for actual submission logic
                    alert(`Quote request for ${this.selectedProduct} submitted successfully. Our enterprise team will contact you shortly.`);
                    this.closeModal();
                }
            }))
        })
    </script>
@endsection
