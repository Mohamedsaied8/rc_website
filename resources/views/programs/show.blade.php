@extends('components.layout')

@section('title', $program->title . ' - Robotics Corner')

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-32 pb-24 overflow-hidden text-center">
        <div class="absolute inset-0 bg-grid opacity-30"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[600px] bg-cyan-500/[0.05] rounded-full blur-[150px]"></div>

        <div class="relative z-10 max-w-4xl mx-auto px-6 lg:px-8">
            <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.05] mb-6">
                {{ $program->title }}
            </h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto mb-8">
                {{ $program->short_description ?? $program->description }}
            </p>
            
            @if($program->video_url)
            <div class="max-w-3xl mx-auto rounded-2xl overflow-hidden border border-slate-200 shadow-2xl h-[400px]">
                <iframe 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    src="{{ $program->video_url }}" 
                    title="{{ $program->title }}" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
            </div>
            @endif
        </div>
    </section>

    <!-- Main Content -->
    <section class="relative z-10 max-w-6xl mx-auto px-6 pb-24">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Details -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white shadow-sm border border-slate-200 rounded-2xl p-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-4">Overview</h2>
                    <p class="text-slate-600 leading-relaxed mb-8">
                        {{ $program->description }}
                    </p>

                    <h3 class="text-xl font-semibold text-slate-900 mb-4">What You'll Learn</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @php
                            $topics = is_array($program->topics) ? $program->topics : json_decode($program->topics, true) ?? [];
                        @endphp
                        @foreach($topics as $topic)
                            <div class="flex items-start gap-3">
                                <span class="text-cyan-600 mt-0.5">✓</span>
                                <span class="text-slate-500">{{ $topic }}</span>
                            </div>
                        @endforeach
                    </div>

                    @if(isset($program->courses) && $program->courses->count() > 0)
                        <h3 class="text-xl font-semibold text-slate-900 mt-10 mb-4">Included Courses</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($program->courses as $course)
                                <div class="bg-white/[0.04] border border-slate-200 rounded-xl p-5 hover:border-cyan-400/20 transition-all duration-300">
                                    <h4 class="text-slate-900 font-semibold mb-2">{{ $course->title }}</h4>
                                    <p class="text-sm text-slate-600 mb-4 line-clamp-2">{{ $course->short_description ?? $course->description }}</p>
                                    
                                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-slate-200">
                                        <div class="text-xs text-slate-500">
                                            <span>⏱️</span> {{ $course->duration }}
                                        </div>
                                        <div class="text-xs font-semibold text-cyan-600">
                                            EGP {{ number_format($course->price) }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Column: Sidebar Facts -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow-sm border border-slate-200 rounded-2xl p-8 sticky top-28">
                    <h3 class="text-xl font-semibold text-slate-900 mb-6">Program Facts</h3>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center text-cyan-600">⏱️</div>
                            <div>
                                <p class="text-xs text-slate-500 font-medium">Duration</p>
                                <p class="text-sm text-slate-900 font-semibold">{{ $program->duration }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center text-emerald-600">💰</div>
                            <div>
                                <p class="text-xs text-slate-500 font-medium">Investment</p>
                                <p class="text-sm text-slate-900 font-semibold">EGP {{ number_format($program->price) }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center text-purple-600">🎓</div>
                            <div>
                                <p class="text-xs text-slate-500 font-medium">Format</p>
                                <p class="text-sm text-slate-900 font-semibold">Online & Onsite options</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center text-blue-600">📜</div>
                            <div>
                                <p class="text-xs text-slate-500 font-medium">Certificate</p>
                                <p class="text-sm text-slate-900 font-semibold">Industry Recognized</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('enroll', ['program' => $program->slug]) }}" class="block w-full text-center px-6 py-4 font-semibold text-gray-900 bg-gradient-to-r from-cyan-400 to-emerald-400 rounded-xl hover:shadow-lg hover:shadow-cyan-400/20 transition-all duration-300 hover:-translate-y-0.5">
                        Enroll in Program
                    </a>
                    <p class="text-xs text-center text-slate-500 mt-4">Next cohort starts soon. Limited seats available.</p>
                </div>
            </div>
        </div>
    </section>
@endsection