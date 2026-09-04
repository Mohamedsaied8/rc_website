@extends('components.layout')

@section('title', $program->title . ' - Robotics Corner')

@section('content')
<div class="min-h-screen bg-slate-50 text-slate-800 font-sans selection:bg-cyan-500/30 overflow-hidden relative">
    
    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 overflow-hidden text-center border-b border-slate-200 bg-white">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNlNTRlNWUiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDM0djIwaDJWMzRoLTJ6bS0xMC0xMGgyVDRoLTJ2MjB6bTEwIDEwaDJWMTRoLTJ2MjB6TTE2IDU0aDJWMzRoLTJ2MjB6TTE2IDI0aDJWNGgtMnYyMHoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-50 z-0"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[600px] bg-cyan-100/50 rounded-full blur-[150px] z-0"></div>

        <div class="relative z-10 max-w-5xl mx-auto px-6 lg:px-8">
            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.1] mb-6">
                {{ $program->title }}
            </h1>
            <p class="text-lg md:text-xl text-slate-600 max-w-3xl mx-auto mb-12 leading-relaxed">
                {{ $program->short_description ?? $program->description }}
            </p>
            
            @if($program->video_url)
            <div class="max-w-4xl mx-auto rounded-3xl overflow-hidden border border-slate-200 shadow-2xl bg-black aspect-video relative group">
                <div class="absolute -inset-4 bg-gradient-to-br from-cyan-400/20 to-emerald-400/20 rounded-[3rem] blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                <iframe 
                    class="w-full h-full absolute inset-0 rounded-2xl z-10"
                    src="{{ \App\Helpers\VideoHelper::getEmbedUrl($program->video_url) }}"
                    title="{{ $program->title }}" 
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
            </div>
            @endif
        </div>
    </section>

    <!-- Main Content -->
    <section class="relative z-10 max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Left Column: Details -->
            <div class="lg:col-span-2 space-y-12">
                
                <!-- Overview -->
                <div class="bg-white border border-slate-200 rounded-3xl p-8 lg:p-10 shadow-sm">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                        <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Program Overview
                    </h2>
                    <p class="text-slate-600 leading-relaxed text-lg mb-10">
                        {{ $program->description }}
                    </p>

                    <h3 class="text-xl font-semibold text-slate-900 mb-6 flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        What You'll Learn
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @php
                            $topics = is_array($program->topics) ? $program->topics : json_decode($program->topics, true) ?? [];
                        @endphp
                        @foreach($topics as $topic)
                            <div class="flex items-start gap-3 bg-slate-50 border border-slate-100 p-4 rounded-xl">
                                <span class="text-cyan-600 mt-0.5">✓</span>
                                <span class="text-slate-700">{{ $topic }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Cohorts Selection -->
                <div id="cohorts" class="scroll-mt-32">
                    <h2 class="text-3xl font-bold text-slate-900 mb-2">Pick Your Start Date</h2>
                    <p class="text-slate-500 mb-8">{{ $program->title }}: {{ $program->duration }}</p>

                    @if($program->cohorts && $program->cohorts->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($program->cohorts as $cohort)
                                <div class="bg-white border border-slate-200 shadow-sm rounded-2xl p-6 hover:border-cyan-400 hover:shadow-md transition-all duration-300 group flex flex-col h-full relative overflow-hidden">
                                    <div class="flex justify-between items-start mb-4 relative z-10">
                                        <div>
                                            @php
                                                $start = \Carbon\Carbon::parse($cohort->start_date)->startOfDay();
                                                $daysUntil = (int) now()->startOfDay()->diffInDays($start, false);
                                                $isPast = $daysUntil < 0;
                                                $startsLabel = $daysUntil === 0
                                                    ? 'Starts today'
                                                    : ($daysUntil === 1 ? 'Starts tomorrow' : 'Starts in '.$daysUntil.' days');
                                            @endphp
                                            @if(!$isPast)
                                                <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full mb-3 uppercase tracking-wide border border-emerald-200">
                                                    {{ $startsLabel }}
                                                </span>
                                            @endif
                                            <div class="flex items-center gap-2 text-sm font-semibold {{ strtolower($cohort->location) == 'online' ? 'text-emerald-600' : 'text-blue-600' }} uppercase tracking-wider mb-1">
                                                <span class="w-2 h-2 rounded-full {{ strtolower($cohort->location) == 'online' ? 'bg-emerald-500' : 'bg-blue-500' }} animate-pulse"></span>
                                                {{ $cohort->location }}
                                            </div>
                                        </div>
                                        <a href="{{ route('enroll', ['program' => $program->slug, 'cohort' => $cohort->id]) }}" class="text-sm font-bold text-cyan-600 group-hover:text-cyan-700 flex items-center gap-1 transition-colors">
                                            APPLY NOW <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                        </a>
                                    </div>
                                    
                                    <div class="space-y-3 relative z-10 flex-grow text-sm">
                                        <div class="flex justify-between border-b border-slate-100 pb-2">
                                            <span class="text-slate-500">Group Name:</span>
                                            <span class="text-slate-800 font-medium">{{ $cohort->group_name }}</span>
                                        </div>
                                        <div class="flex justify-between border-b border-slate-100 pb-2">
                                            <span class="text-slate-500">Start Date:</span>
                                            <span class="text-slate-800 font-medium">{{ \Carbon\Carbon::parse($cohort->start_date)->format('Y-m-d') }}</span>
                                        </div>
                                        <div class="flex justify-between border-b border-slate-100 pb-2">
                                            <span class="text-slate-500">Schedule:</span>
                                            <span class="text-slate-800 font-medium text-right max-w-[60%]">{{ $cohort->schedule }}</span>
                                        </div>
                                        <div class="flex justify-between pt-1">
                                            <span class="text-slate-500">Fees:</span>
                                            <span class="text-cyan-700 font-bold">EGP {{ number_format($cohort->fees) }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center shadow-sm">
                            <h4 class="text-xl font-bold text-slate-900 mb-2">No Upcoming Cohorts</h4>
                            <p class="text-slate-500 mb-6">We are currently planning the next start dates for this program.</p>
                            <a href="{{ route('contact') }}" class="inline-block px-6 py-3 bg-slate-100 border border-slate-200 text-slate-700 font-medium rounded-xl hover:bg-slate-200 transition-colors">Contact Us for Info</a>
                        </div>
                    @endif
                </div>

            </div>

            <!-- Right Column: Sidebar Facts -->
            <div class="lg:col-span-1">
                <div class="bg-white border border-slate-200 shadow-sm rounded-3xl p-8 sticky top-32">
                    <h3 class="text-xl font-bold text-slate-900 mb-8 border-b border-slate-100 pb-4">Program Facts</h3>
                    
                    <div class="space-y-6 mb-10">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-cyan-50 border border-cyan-100 flex items-center justify-center text-cyan-600 text-xl shrink-0">⏱️</div>
                            <div>
                                <p class="text-xs text-slate-500 uppercase tracking-wider mb-1 font-semibold">Duration</p>
                                <p class="text-base text-slate-900 font-medium">{{ $program->duration }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 text-xl shrink-0">💰</div>
                            <div>
                                <p class="text-xs text-slate-500 uppercase tracking-wider mb-1 font-semibold">Investment</p>
                                <p class="text-base text-slate-900 font-medium">{{ $program->currency ?? 'EGP' }} {{ number_format($program->price) }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-purple-50 border border-purple-100 flex items-center justify-center text-purple-600 text-xl shrink-0">🎓</div>
                            <div>
                                <p class="text-xs text-slate-500 uppercase tracking-wider mb-1 font-semibold">Format</p>
                                <p class="text-base text-slate-900 font-medium">Online & Onsite options</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 text-xl shrink-0">📜</div>
                            <div>
                                <p class="text-xs text-slate-500 uppercase tracking-wider mb-1 font-semibold">Certificate</p>
                                <p class="text-base text-slate-900 font-medium">Industry Recognized</p>
                            </div>
                        </div>
                    </div>

                    <a href="#cohorts" class="block w-full text-center px-6 py-4 font-bold text-white bg-slate-900 rounded-xl hover:bg-gradient-to-r hover:from-cyan-500 hover:to-emerald-500 transition-all duration-300 shadow-sm hover:shadow-md">
                        View Start Dates
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection