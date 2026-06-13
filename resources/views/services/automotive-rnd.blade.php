@extends('components.layout')

@section('title', $departmentTitle . ' - Corporate Services')

@section('content')

<!-- SECTION 1: The "Lab" Hero Section -->
@include('components.page-hero', [
    'title' => 'Automotive <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 via-blue-600 to-indigo-600">Software R&D</span>',
    'subtitle' => 'Engineering the proprietary middleware, AI acceleration, and telemetry systems powering autonomous mobility.'
])

<!-- SECTION 2: The Research Vectors (Staggered Layout) -->
<div id="research-vectors" class="bg-slate-50 py-24 relative border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-6">
        
        <!-- Vector 1: Middleware -->
        <div class="flex flex-col md:flex-row items-center gap-12 py-12 relative">
            <div class="md:w-1/2 md:sticky md:top-32 self-start">
                <span class="text-cyan-600 font-mono text-xl mb-4 block">01</span>
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-6">Middleware & Adaptive AUTOSAR</h2>
                <p class="text-lg text-slate-600 mb-6 leading-relaxed">
                    We focus on custom implementations that decouple complex automotive software from underlying hardware constraints. Experience how our middleware standardizes chaotic hardware signals into clean, deterministic data streams for high-level autonomous functions.
                </p>
                <div class="h-1 w-20 bg-cyan-600 rounded-full mb-6"></div>
                <button onclick="toggleMiddleware()" id="btn-middleware" class="bg-cyan-50 hover:bg-cyan-100 text-cyan-700 border border-cyan-200 px-6 py-3 rounded-xl font-bold transition-colors flex items-center shadow-sm">
                    <i class="fa-solid fa-power-off mr-3"></i> Enable Middleware Layer
                </button>
            </div>
            <div class="md:w-1/2 flex justify-center p-8 bg-white rounded-3xl border border-slate-200 shadow-xl relative overflow-hidden h-[300px]">
                <!-- Background Grid -->
                <div class="absolute inset-0" style="background-image: linear-gradient(rgba(0,0,0,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(0,0,0,0.03) 1px, transparent 1px); background-size: 20px 20px;"></div>
                
                <svg viewBox="0 0 400 300" class="w-full h-full relative z-10" id="svg-middleware">
                    <!-- Hardware Nodes (Bottom) -->
                    <rect x="40" y="240" width="60" height="40" rx="5" fill="#f1f5f9" stroke="#94a3b8" stroke-width="2"/>
                    <text x="70" y="265" font-size="10" font-family="monospace" text-anchor="middle" fill="#64748b">LIDAR</text>
                    
                    <rect x="170" y="240" width="60" height="40" rx="5" fill="#f1f5f9" stroke="#94a3b8" stroke-width="2"/>
                    <text x="200" y="265" font-size="10" font-family="monospace" text-anchor="middle" fill="#64748b">RADAR</text>
                    
                    <rect x="300" y="240" width="60" height="40" rx="5" fill="#f1f5f9" stroke="#94a3b8" stroke-width="2"/>
                    <text x="330" y="265" font-size="10" font-family="monospace" text-anchor="middle" fill="#64748b">CAMERA</text>

                    <!-- App Nodes (Top) -->
                    <rect x="100" y="20" width="80" height="40" rx="5" fill="#f0f9ff" stroke="#0ea5e9" stroke-width="2"/>
                    <text x="140" y="45" font-size="10" font-family="monospace" text-anchor="middle" fill="#0ea5e9">PERCEPTION</text>
                    
                    <rect x="220" y="20" width="80" height="40" rx="5" fill="#f0f9ff" stroke="#0ea5e9" stroke-width="2"/>
                    <text x="260" y="45" font-size="10" font-family="monospace" text-anchor="middle" fill="#0ea5e9">PLANNING</text>

                    <!-- Messy Connections (Visible when OFF) -->
                    <g id="connections-messy" class="transition-opacity duration-500">
                        <path d="M70 240 L140 60" stroke="#ef4444" stroke-width="2" stroke-dasharray="4 4" class="animate-[dash_5s_linear_infinite]"/>
                        <path d="M70 240 L260 60" stroke="#ef4444" stroke-width="2" stroke-dasharray="4 4" class="animate-[dash_5s_linear_infinite]"/>
                        <path d="M200 240 L140 60" stroke="#ef4444" stroke-width="2" stroke-dasharray="4 4" class="animate-[dash_5s_linear_infinite]"/>
                        <path d="M200 240 L260 60" stroke="#ef4444" stroke-width="2" stroke-dasharray="4 4" class="animate-[dash_5s_linear_infinite]"/>
                        <path d="M330 240 L140 60" stroke="#ef4444" stroke-width="2" stroke-dasharray="4 4" class="animate-[dash_5s_linear_infinite]"/>
                        <path d="M330 240 L260 60" stroke="#ef4444" stroke-width="2" stroke-dasharray="4 4" class="animate-[dash_5s_linear_infinite]"/>
                    </g>

                    <!-- Middleware Layer (Visible when ON) -->
                    <g id="layer-middleware" class="opacity-0 transition-opacity duration-500">
                        <rect x="30" y="120" width="340" height="60" rx="10" fill="#ecfeff" stroke="#06b6d4" stroke-width="3"/>
                        <text x="200" y="155" font-size="16" font-weight="bold" font-family="sans-serif" text-anchor="middle" fill="#0891b2">ADAPTIVE AUTOSAR LAYER</text>
                        
                        <!-- Clean Orthogonal Connections -->
                        <path d="M70 240 V180 M200 240 V180 M330 240 V180" stroke="#10b981" stroke-width="3" stroke-dasharray="6 6" class="animate-[dash_5s_linear_infinite]"/>
                        <path d="M140 120 V60 M260 120 V60" stroke="#10b981" stroke-width="3" stroke-dasharray="6 6" class="animate-[dash_5s_linear_infinite]"/>
                    </g>
                </svg>
            </div>
        </div>

        <!-- Vector 2: RTOS -->
        <div class="flex flex-col md:flex-row-reverse items-center gap-12 py-12 relative mt-12 md:mt-24">
            <div class="md:w-1/2 md:sticky md:top-32 self-start">
                <span class="text-blue-600 font-mono text-xl mb-4 block">02</span>
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-6">RTOS & Mixed Criticality</h2>
                <p class="text-lg text-slate-600 mb-6 leading-relaxed">
                    Safety is paramount. Our hypervisor architectures provide strict ASIL-D safety isolation. When non-critical systems fail (like the Infotainment OS), the mission-critical systems (like Braking) remain 100% isolated and operational. Test the partitioning below.
                </p>
                <div class="h-1 w-20 bg-blue-600 rounded-full mb-6"></div>
                <button onclick="crashInfotainment()" id="btn-crash" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-6 py-3 rounded-xl font-bold transition-colors flex items-center shadow-sm">
                    <i class="fa-solid fa-triangle-exclamation mr-3"></i> Simulate Infotainment Crash
                </button>
            </div>
            <div class="md:w-1/2 flex justify-center p-8 bg-white rounded-3xl border border-slate-200 shadow-xl relative overflow-hidden h-[300px]">
                <div class="absolute inset-0" style="background-image: linear-gradient(rgba(0,0,0,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(0,0,0,0.03) 1px, transparent 1px); background-size: 20px 20px;"></div>
                
                <svg viewBox="0 0 400 300" class="w-full h-full relative z-10">
                    <!-- Base Hypervisor Layer -->
                    <rect x="40" y="200" width="320" height="50" rx="10" fill="#f8fafc" stroke="#64748b" stroke-width="2"/>
                    <text x="200" y="230" font-size="14" font-weight="bold" font-family="monospace" text-anchor="middle" fill="#475569">QNX HYPERVISOR (TYPE-1)</text>

                    <!-- Infotainment VM -->
                    <rect id="vm-info-box" x="50" y="50" width="130" height="130" rx="10" fill="#f0fdfa" stroke="#14b8a6" stroke-width="2" class="transition-colors duration-300"/>
                    <text id="vm-info-title" x="115" y="80" font-size="12" font-weight="bold" font-family="sans-serif" text-anchor="middle" fill="#0f766e">Infotainment OS</text>
                    <g id="gear-info" style="transform-origin: 115px 125px;" class="animate-[spin_4s_linear_infinite]">
                        <circle cx="115" cy="125" r="20" fill="none" stroke="#14b8a6" stroke-width="6" stroke-dasharray="10 5"/>
                    </g>
                    <text id="vm-info-status" x="115" y="129" font-size="10" font-weight="bold" text-anchor="middle" fill="#0f766e">OK</text>
                    <path d="M115 180 V200" stroke="#64748b" stroke-width="3"/>

                    <!-- ASIL-D VM -->
                    <rect x="220" y="50" width="130" height="130" rx="10" fill="#eff6ff" stroke="#3b82f6" stroke-width="2"/>
                    <text x="285" y="80" font-size="12" font-weight="bold" font-family="sans-serif" text-anchor="middle" fill="#1d4ed8">ASIL-D Braking</text>
                    <g style="transform-origin: 285px 125px;" class="animate-[spin_2s_linear_infinite]">
                        <circle cx="285" cy="125" r="20" fill="none" stroke="#3b82f6" stroke-width="6" stroke-dasharray="10 5"/>
                    </g>
                    <text x="285" y="129" font-size="10" font-weight="bold" text-anchor="middle" fill="#1d4ed8">OK</text>
                    <path d="M285 180 V200" stroke="#64748b" stroke-width="3"/>

                    <!-- Partition Line -->
                    <path d="M200 40 V190" stroke="#94a3b8" stroke-width="2" stroke-dasharray="5 5"/>
                    <text x="200" y="30" font-size="10" text-anchor="middle" fill="#64748b">HARDWARE ISOLATION</text>
                </svg>
            </div>
        </div>

        <!-- Vector 3: OTA Updates -->
        <div class="flex flex-col md:flex-row items-center gap-12 py-12 relative mt-12 md:mt-24">
            <div class="md:w-1/2 md:sticky md:top-32 self-start">
                <span class="text-indigo-600 font-mono text-xl mb-4 block">03</span>
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-6">V2X & Telemetry</h2>
                <p class="text-lg text-slate-600 mb-6 leading-relaxed">
                    The autonomous vehicle does not exist in isolation. Our V2X (Vehicle-to-Everything) R&D pioneers secure, delta-based Over-The-Air (OTA) update infrastructure. See how updates are pushed to a global fleet simultaneously via a distributed cloud network.
                </p>
                <div class="h-1 w-20 bg-indigo-600 rounded-full mb-6"></div>
                <button onclick="deployOTAUpdate()" id="btn-ota" class="bg-indigo-50 hover:bg-indigo-100 text-indigo-700 border border-indigo-200 px-6 py-3 rounded-xl font-bold transition-colors flex items-center shadow-sm">
                    <i class="fa-solid fa-cloud-arrow-down mr-3"></i> Deploy OTA Fleet Update
                </button>
            </div>
            <div class="md:w-1/2 flex justify-center p-8 bg-white rounded-3xl border border-slate-200 shadow-xl relative overflow-hidden h-[300px]">
                <div class="absolute inset-0" style="background-image: linear-gradient(rgba(0,0,0,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(0,0,0,0.03) 1px, transparent 1px); background-size: 20px 20px;"></div>
                
                <svg viewBox="0 0 400 300" class="w-full h-full relative z-10">
                    <!-- Central Cloud -->
                    <circle cx="200" cy="150" r="40" fill="#e0e7ff" stroke="#6366f1" stroke-width="3"/>
                    <text x="200" y="155" font-size="12" font-weight="bold" text-anchor="middle" fill="#4f46e5">CLOUD</text>
                    
                    <!-- Pulsing Waves (Hidden by default) -->
                    <circle id="ota-wave-1" cx="200" cy="150" r="40" fill="none" stroke="#818cf8" stroke-width="4" class="opacity-0 transition-all duration-1000"/>
                    <circle id="ota-wave-2" cx="200" cy="150" r="40" fill="none" stroke="#818cf8" stroke-width="4" class="opacity-0 transition-all duration-1000"/>

                    <!-- Vehicle Nodes -->
                    <!-- Car 1 Top Left -->
                    <g class="ota-car" transform="translate(60, 60)">
                        <rect x="-20" y="-15" width="40" height="30" rx="5" fill="#f1f5f9" stroke="#94a3b8" stroke-width="2" class="transition-colors duration-500"/>
                        <circle cx="0" cy="0" r="4" fill="#94a3b8" class="transition-colors duration-500"/>
                    </g>
                    <!-- Car 2 Top Right -->
                    <g class="ota-car" transform="translate(340, 60)">
                        <rect x="-20" y="-15" width="40" height="30" rx="5" fill="#f1f5f9" stroke="#94a3b8" stroke-width="2" class="transition-colors duration-500"/>
                        <circle cx="0" cy="0" r="4" fill="#94a3b8" class="transition-colors duration-500"/>
                    </g>
                    <!-- Car 3 Bottom Left -->
                    <g class="ota-car" transform="translate(60, 240)">
                        <rect x="-20" y="-15" width="40" height="30" rx="5" fill="#f1f5f9" stroke="#94a3b8" stroke-width="2" class="transition-colors duration-500"/>
                        <circle cx="0" cy="0" r="4" fill="#94a3b8" class="transition-colors duration-500"/>
                    </g>
                    <!-- Car 4 Bottom Right -->
                    <g class="ota-car" transform="translate(340, 240)">
                        <rect x="-20" y="-15" width="40" height="30" rx="5" fill="#f1f5f9" stroke="#94a3b8" stroke-width="2" class="transition-colors duration-500"/>
                        <circle cx="0" cy="0" r="4" fill="#94a3b8" class="transition-colors duration-500"/>
                    </g>
                </svg>
            </div>
        </div>

    </div>
</div>

<!-- SECTION 3: Interactive Masterpiece 1 - The In-Vehicle Stack (Clean Flat Layout) -->
<div class="bg-white py-24 border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-4">In-Vehicle Software Stack</h2>
            <p class="text-slate-600 text-lg max-w-2xl mx-auto">Interactive architecture model. Click on the layers below to explore the specific technologies and research focuses for each level of the software-defined vehicle.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-12 items-center">
            
            <!-- Flat Stack Diagram -->
            <div class="w-full lg:w-1/2 flex flex-col gap-4">
                
                <!-- Top Layer -->
                <div id="layer-top" class="cursor-pointer group bg-white border-2 border-slate-200 hover:border-cyan-500 rounded-2xl p-6 transition-all duration-300 shadow-sm hover:shadow-md flex items-center justify-between" onclick="showLayerInfo('top')">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-cyan-100 text-cyan-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-cloud text-xl"></i>
                        </div>
                        <div>
                            <span class="text-xs font-mono font-bold text-cyan-600 uppercase tracking-wider block mb-1">Top Layer</span>
                            <h3 class="text-xl font-bold text-slate-900">Cloud APIs & AI Models</h3>
                        </div>
                    </div>
                    <i class="fa-solid fa-chevron-right text-slate-300 group-hover:text-cyan-500 transition-colors"></i>
                </div>

                <!-- Mid Layer -->
                <div id="layer-mid" class="cursor-pointer group bg-white border-2 border-slate-200 hover:border-blue-500 rounded-2xl p-6 transition-all duration-300 shadow-sm hover:shadow-md flex items-center justify-between" onclick="showLayerInfo('mid')">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-layer-group text-xl"></i>
                        </div>
                        <div>
                            <span class="text-xs font-mono font-bold text-blue-600 uppercase tracking-wider block mb-1">Mid Layer</span>
                            <h3 class="text-xl font-bold text-slate-900">Adaptive AUTOSAR & ROS2</h3>
                        </div>
                    </div>
                    <i class="fa-solid fa-chevron-right text-slate-300 group-hover:text-blue-500 transition-colors"></i>
                </div>

                <!-- Base Layer -->
                <div id="layer-base" class="cursor-pointer group bg-white border-2 border-slate-200 hover:border-indigo-500 rounded-2xl p-6 transition-all duration-300 shadow-sm hover:shadow-md flex items-center justify-between" onclick="showLayerInfo('base')">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-microchip text-xl"></i>
                        </div>
                        <div>
                            <span class="text-xs font-mono font-bold text-indigo-600 uppercase tracking-wider block mb-1">Base Layer</span>
                            <h3 class="text-xl font-bold text-slate-900">RTOS & Hypervisor</h3>
                        </div>
                    </div>
                    <i class="fa-solid fa-chevron-right text-slate-300 group-hover:text-indigo-500 transition-colors"></i>
                </div>
            </div>

            <!-- Info Panel -->
            <div class="w-full lg:w-1/2">
                <div id="stack-info-panel" class="bg-slate-50 border border-slate-200 rounded-3xl p-8 min-h-[350px] shadow-lg relative overflow-hidden">
                    <!-- Default State -->
                    <div id="info-default" class="absolute inset-0 p-8 flex flex-col justify-center transition-opacity duration-300 text-center">
                        <div class="w-20 h-20 mx-auto bg-slate-200 rounded-full flex items-center justify-center mb-6">
                            <i class="fa-solid fa-hand-pointer text-3xl text-slate-400"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-2">Select a Layer</h3>
                        <p class="text-slate-500">Click on any layer on the left to view our research initiatives and technology implementations for that specific domain.</p>
                    </div>

                    <!-- Top Layer Info -->
                    <div id="info-top" class="absolute inset-0 p-8 flex flex-col justify-center opacity-0 pointer-events-none transition-opacity duration-300 bg-cyan-50/50">
                        <span class="text-cyan-700 font-mono text-sm mb-3 border border-cyan-200 px-3 py-1 rounded-full w-max bg-cyan-100/50">TOP LAYER</span>
                        <h3 class="text-3xl font-extrabold text-slate-900 mb-4">Cloud APIs & AI Models</h3>
                        <p class="text-slate-600 mb-6 leading-relaxed">The pinnacle of the stack handles heavy compute tasks offloaded from the vehicle. We focus on federated learning pipelines, high-throughput telemetry ingestion, and global fleet orchestration via custom REST/gRPC interfaces.</p>
                        <ul class="text-slate-700 space-y-3 font-medium">
                            <li class="flex items-center"><i class="fa-solid fa-check-circle text-cyan-500 mr-3"></i> Distributed Edge-Cloud SLAM</li>
                            <li class="flex items-center"><i class="fa-solid fa-check-circle text-cyan-500 mr-3"></i> Over-The-Air (OTA) Campaign Management</li>
                        </ul>
                    </div>

                    <!-- Mid Layer Info -->
                    <div id="info-mid" class="absolute inset-0 p-8 flex flex-col justify-center opacity-0 pointer-events-none transition-opacity duration-300 bg-blue-50/50">
                        <span class="text-blue-700 font-mono text-sm mb-3 border border-blue-200 px-3 py-1 rounded-full w-max bg-blue-100/50">MID LAYER</span>
                        <h3 class="text-3xl font-extrabold text-slate-900 mb-4">Adaptive AUTOSAR & ROS2</h3>
                        <p class="text-slate-600 mb-6 leading-relaxed">The service-oriented architecture (SOA) layer. Here we implement POSIX-compliant operating systems to run dynamic, high-performance computing applications necessary for autonomous driving, utilizing standard protocols like SOME/IP.</p>
                        <ul class="text-slate-700 space-y-3 font-medium">
                            <li class="flex items-center"><i class="fa-solid fa-check-circle text-blue-500 mr-3"></i> SOME/IP & DDS Middleware Bridges</li>
                            <li class="flex items-center"><i class="fa-solid fa-check-circle text-blue-500 mr-3"></i> Execution Management & Health Monitoring</li>
                        </ul>
                    </div>

                    <!-- Base Layer Info -->
                    <div id="info-base" class="absolute inset-0 p-8 flex flex-col justify-center opacity-0 pointer-events-none transition-opacity duration-300 bg-indigo-50/50">
                        <span class="text-indigo-700 font-mono text-sm mb-3 border border-indigo-200 px-3 py-1 rounded-full w-max bg-indigo-100/50">BASE LAYER</span>
                        <h3 class="text-3xl font-extrabold text-slate-900 mb-4">RTOS & Hypervisor</h3>
                        <p class="text-slate-600 mb-6 leading-relaxed">The bedrock of vehicle safety. We architect Type-1 hypervisor solutions to provide hardware-level isolation (spatial and temporal) between critical driving functions (ASIL-D) and general-purpose OS environments.</p>
                        <ul class="text-slate-700 space-y-3 font-medium">
                            <li class="flex items-center"><i class="fa-solid fa-check-circle text-indigo-500 mr-3"></i> QNX Neutrino Microkernel Optimization</li>
                            <li class="flex items-center"><i class="fa-solid fa-check-circle text-indigo-500 mr-3"></i> Hardware Virtualization (IOMMU/SMMU)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SECTION 4: Interactive Masterpiece 2 - Telemetry Security Sandbox -->
<div class="bg-slate-50 py-24 border-b border-slate-200 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="mb-12 md:w-2/3">
            <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-4">Telemetry Security Sandbox</h2>
            <p class="text-slate-600 text-lg">Experience our proprietary deep-packet inspection routing in action. As vehicles stream thousands of CAN-bus and Ethernet packets per second to the cloud, our edge filter acts as an impenetrable gateway. Inject a malicious packet to see the ASIL-D certified security filter isolate threats in real-time.</p>
        </div>

        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-xl flex flex-col lg:flex-row gap-8">
            
            <!-- SVG Sandbox -->
            <div class="w-full lg:w-2/3 h-[400px] bg-slate-100 rounded-xl border border-slate-200 relative overflow-hidden flex items-center justify-center shadow-inner">
                <!-- Grid background -->
                <div class="absolute inset-0" style="background-image: linear-gradient(rgba(0,0,0,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(0,0,0,0.03) 1px, transparent 1px); background-size: 20px 20px;"></div>
                
                <svg viewBox="0 0 800 400" class="w-full h-full relative z-10" id="telemetry-svg">
                    <!-- Lines -->
                    <path d="M 150 200 L 400 200" stroke="#cbd5e1" stroke-width="6" stroke-dasharray="12 12" class="animate-[dash_20s_linear_infinite]" />
                    <path d="M 400 200 L 650 200" stroke="#cbd5e1" stroke-width="6" stroke-dasharray="12 12" class="animate-[dash_20s_linear_infinite]" />
                    <path d="M 400 200 L 400 350" stroke="#cbd5e1" stroke-width="6" stroke-dasharray="12 12" class="animate-[dash_20s_linear_infinite]" />
                    
                    <!-- Vehicle Node -->
                    <rect x="50" y="150" width="100" height="100" rx="15" fill="#ffffff" stroke="#94a3b8" stroke-width="3"/>
                    <text x="100" y="205" fill="#475569" font-size="16" font-family="monospace" text-anchor="middle" font-weight="bold">VEHICLE</text>
                    
                    <!-- Cloud Node -->
                    <rect x="650" y="150" width="100" height="100" rx="50" fill="#ffffff" stroke="#0ea5e9" stroke-width="3"/>
                    <text x="700" y="205" fill="#0ea5e9" font-size="16" font-family="monospace" text-anchor="middle" font-weight="bold">CLOUD</text>

                    <!-- Quarantine Node -->
                    <rect x="350" y="300" width="100" height="60" rx="10" fill="#fef2f2" stroke="#ef4444" stroke-width="2" stroke-dasharray="4 4"/>
                    <text x="400" y="335" fill="#ef4444" font-size="12" font-family="monospace" text-anchor="middle" font-weight="bold">QUARANTINE</text>

                    <!-- Security Filter Node -->
                    <polygon points="400,140 450,200 400,260 350,200" fill="#f0fdf4" stroke="#10b981" stroke-width="3" id="security-filter-shield"/>
                    <text x="400" y="205" fill="#10b981" font-size="28" text-anchor="middle">🛡️</text>
                </svg>

                <div class="absolute top-4 left-4 z-50">
                    <button onclick="injectMaliciousPacket()" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-4 py-2 rounded-lg font-mono text-sm uppercase tracking-wider font-bold shadow-sm transition-colors cursor-pointer">
                        <i class="fa-solid fa-bug mr-2"></i> Inject Malicious Packet
                    </button>
                </div>
            </div>

            <!-- Terminal Window -->
            <div class="w-full lg:w-1/3 h-[400px] bg-slate-900 rounded-xl border border-slate-800 flex flex-col overflow-hidden font-mono text-xs shadow-xl">
                <div class="bg-slate-950 px-4 py-2 flex items-center gap-2 border-b border-slate-800">
                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                    <span class="ml-2 text-slate-400 font-bold">sec-filter-log.sh</span>
                </div>
                <div class="p-4 overflow-y-auto flex-1 text-green-400 space-y-1" id="terminal-logs">
                    <div>[sys] Intrusion Detection System Active</div>
                    <div>[sys] Awaiting traffic...</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SECTION 5: Call to Action -->
<div class="bg-white py-24 border-t border-slate-100">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.1] mb-8">
            Ready to Unlock Your <span class="bg-clip-text text-transparent bg-gradient-to-r from-cyan-600 to-indigo-600">Automotive Full Potential</span>?
        </h2>
        
        <p class="text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed mb-10">
            Whether you need a custom hyper-optimized middleware stack, high-performance RTOS partition setup, or AI-powered edge telemetry systems — our engineers are ready to build the architecture.
        </p>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/contact" class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-bold rounded-xl transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                Start the Conversation <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="/services" class="w-full sm:w-auto px-8 py-4 border border-slate-200 hover:border-slate-300 text-slate-700 hover:text-slate-900 font-semibold rounded-xl bg-white hover:bg-slate-50 transition-all flex items-center justify-center gap-2">
                All Services <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<style>
    @keyframes dash {
        to { stroke-dashoffset: -1000; }
    }
</style>

<script>
    // --- Interactive Masterpiece 1: Flat Stack ---
    function showLayerInfo(layer) {
        // Hide all info panels
        document.getElementById('info-default').classList.add('opacity-0', 'pointer-events-none');
        ['top', 'mid', 'base'].forEach(l => {
            const panel = document.getElementById('info-' + l);
            panel.classList.add('opacity-0', 'pointer-events-none');
            // Reset borders
            const btn = document.getElementById('layer-' + l);
            btn.classList.remove('border-cyan-500', 'border-blue-500', 'border-indigo-500', 'ring-2', 'ring-offset-2');
            btn.classList.add('border-slate-200');
        });

        // Show selected panel
        const selectedPanel = document.getElementById('info-' + layer);
        selectedPanel.classList.remove('opacity-0', 'pointer-events-none');
        
        // Highlight active button
        const activeBtn = document.getElementById('layer-' + layer);
        activeBtn.classList.remove('border-slate-200');
        if(layer === 'top') {
            activeBtn.classList.add('border-cyan-500', 'ring-2', 'ring-cyan-500/20', 'ring-offset-2');
        } else if (layer === 'mid') {
            activeBtn.classList.add('border-blue-500', 'ring-2', 'ring-blue-500/20', 'ring-offset-2');
        } else if (layer === 'base') {
            activeBtn.classList.add('border-indigo-500', 'ring-2', 'ring-indigo-500/20', 'ring-offset-2');
        }
    }

    // --- Interactive Masterpiece 2: Telemetry Sandbox ---
    document.addEventListener('DOMContentLoaded', function() {
        const svg = document.getElementById('telemetry-svg');
        const terminal = document.getElementById('terminal-logs');
        const shield = document.getElementById('security-filter-shield');

        let packetCount = 0;

        // Generate normal traffic
        setInterval(() => {
            if(document.visibilityState === 'visible') {
                createPacket(false);
            }
        }, 800);

        function createPacket(isMalicious) {
            packetCount++;
            const id = 'packet-' + packetCount;
            
            // Create circle
            const circle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
            circle.setAttribute('id', id);
            circle.setAttribute('r', '6');
            circle.setAttribute('fill', isMalicious ? '#ef4444' : '#10b981'); // red or green
            circle.setAttribute('cx', '150');
            circle.setAttribute('cy', '200');
            
            // Add glow if malicious
            if(isMalicious) {
                circle.setAttribute('filter', 'drop-shadow(0 0 4px rgba(239, 68, 68, 0.5))');
            }

            svg.appendChild(circle);

            if(!isMalicious) {
                // Normal path: Vehicle -> Filter -> Cloud
                animatePacket(circle, isMalicious);
            } else {
                // Malicious path: Vehicle -> Filter -> Quarantine
                animatePacket(circle, isMalicious);
                logTerminal(`<span class="text-red-400">[WARN] Anomaly detected on CAN interface.</span>`);
            }
        }

        function animatePacket(circle, isMalicious) {
            let start = performance.now();
            const duration1 = 1500; // Vehicle to Filter
            
            function step(timestamp) {
                let progress = (timestamp - start) / duration1;
                if(progress > 1) progress = 1;
                
                // X goes from 150 to 400
                let currentX = 150 + (250 * progress);
                circle.setAttribute('cx', currentX);
                
                if(progress < 1) {
                    requestAnimationFrame(step);
                } else {
                    // Reached filter
                    if(isMalicious) {
                        // Flash shield
                        shield.setAttribute('stroke', '#ef4444');
                        shield.setAttribute('fill', '#fef2f2');
                        setTimeout(() => {
                            shield.setAttribute('stroke', '#10b981');
                            shield.setAttribute('fill', '#f0fdf4');
                        }, 300);
                        
                        logTerminal(`<span class="text-red-500 font-bold">[ALERT] Dropping Malicious Packet!</span>`);
                        logTerminal(`<span class="text-yellow-400">[INFO] Threat Neutralized & Quarantined.</span>`);
                        
                        // Route to quarantine
                        let start2 = performance.now();
                        function step2(ts) {
                            let p = (ts - start2) / 500;
                            if(p > 1) p = 1;
                            let cy = 200 + (100 * p);
                            circle.setAttribute('cy', cy);
                            if(p < 1) requestAnimationFrame(step2);
                            else setTimeout(() => circle.remove(), 500);
                        }
                        requestAnimationFrame(step2);

                    } else {
                        // Continue to cloud
                        let start3 = performance.now();
                        function step3(ts) {
                            let p = (ts - start3) / 1500;
                            if(p > 1) p = 1;
                            let cx = 400 + (250 * p);
                            circle.setAttribute('cx', cx);
                            if(p < 1) requestAnimationFrame(step3);
                            else circle.remove();
                        }
                        requestAnimationFrame(step3);
                    }
                }
            }
            requestAnimationFrame(step);
        }

        window.injectMaliciousPacket = function() {
            createPacket(true);
        }

        function logTerminal(msg) {
            const time = new Date().toISOString().split('T')[1].substr(0, 12);
            const div = document.createElement('div');
            div.innerHTML = `<span class="text-slate-500">[${time}]</span> ${msg}`;
            terminal.appendChild(div);
            terminal.scrollTop = terminal.scrollHeight;
        }
    });

    // --- Vector 1: Middleware ---
    let middlewareOn = false;
    window.toggleMiddleware = function() {
        middlewareOn = !middlewareOn;
        const btn = document.getElementById('btn-middleware');
        const messy = document.getElementById('connections-messy');
        const clean = document.getElementById('layer-middleware');
        
        if(middlewareOn) {
            btn.innerHTML = '<i class="fa-solid fa-power-off mr-3"></i> Disable Middleware Layer';
            btn.classList.replace('bg-cyan-50', 'bg-cyan-600');
            btn.classList.replace('text-cyan-700', 'text-white');
            messy.classList.add('opacity-0');
            clean.classList.remove('opacity-0');
        } else {
            btn.innerHTML = '<i class="fa-solid fa-power-off mr-3"></i> Enable Middleware Layer';
            btn.classList.replace('bg-cyan-600', 'bg-cyan-50');
            btn.classList.replace('text-white', 'text-cyan-700');
            messy.classList.remove('opacity-0');
            clean.classList.add('opacity-0');
        }
    }

    // --- Vector 2: RTOS Isolation ---
    let infoCrashed = false;
    window.crashInfotainment = function() {
        if(infoCrashed) return; // already crashed
        infoCrashed = true;
        
        const btn = document.getElementById('btn-crash');
        const box = document.getElementById('vm-info-box');
        const title = document.getElementById('vm-info-title');
        const status = document.getElementById('vm-info-status');
        const gear = document.getElementById('gear-info');
        
        btn.innerHTML = '<i class="fa-solid fa-skull mr-3"></i> Infotainment Offline';
        btn.classList.add('opacity-50', 'cursor-not-allowed');
        
        box.setAttribute('fill', '#fef2f2');
        box.setAttribute('stroke', '#ef4444');
        title.setAttribute('fill', '#ef4444');
        status.setAttribute('fill', '#ef4444');
        status.textContent = 'CRASHED';
        
        // Stop spinning
        gear.classList.remove('animate-[spin_4s_linear_infinite]');
        gear.querySelector('circle').setAttribute('stroke', '#ef4444');
    }

    // --- Vector 3: OTA Updates ---
    window.deployOTAUpdate = function() {
        const btn = document.getElementById('btn-ota');
        const w1 = document.getElementById('ota-wave-1');
        const w2 = document.getElementById('ota-wave-2');
        const cars = document.querySelectorAll('.ota-car');
        
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-3"></i> Deploying...';
        btn.disabled = true;
        
        // Animate waves
        w1.classList.remove('opacity-0');
        w1.style.transform = 'scale(1.5)';
        setTimeout(() => {
            w2.classList.remove('opacity-0');
            w2.style.transform = 'scale(1.5)';
        }, 300);
        
        setTimeout(() => {
            cars.forEach(car => {
                car.querySelector('rect').setAttribute('fill', '#f0fdf4');
                car.querySelector('rect').setAttribute('stroke', '#10b981');
                car.querySelector('circle').setAttribute('fill', '#10b981');
            });
            
            btn.innerHTML = '<i class="fa-solid fa-check mr-3"></i> Fleet Updated 100%';
            btn.classList.replace('bg-indigo-50', 'bg-green-50');
            btn.classList.replace('text-indigo-700', 'text-green-700');
            btn.classList.replace('border-indigo-200', 'border-green-200');
            
            // Reset waves
            w1.classList.add('opacity-0');
            w2.classList.add('opacity-0');
        }, 800);
    }
</script>
@endsection
