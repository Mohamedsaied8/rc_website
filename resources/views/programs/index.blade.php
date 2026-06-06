@extends('components.layout')

@section('title', 'Our Programs - Robotics Corner')

@section('content')
    @include('components.page-hero', [
        'title' => 'Our Programs',
        'subtitle' => 'Structured learning paths designed for career advancement'
    ])

    <section class="relative z-10 max-w-6xl mx-auto px-6 py-16">
        <div class="flex flex-col gap-8">
            @foreach($programs as $program)
                <div class="bg-white/[0.03] backdrop-blur-xl border border-white/[0.06] rounded-2xl p-8 hover:border-cyan-400/20 transition-all duration-500">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                        <!-- Left side content -->
                        <div>
                            <h2 class="text-2xl font-bold text-white mb-3">{{ $program->title }}</h2>
                            <p class="text-slate-400 leading-relaxed mb-4">
                                {{ $program->description }}
                            </p>
                            
                            <h3 class="text-xs font-semibold uppercase tracking-widest text-slate-500 mb-2">Included Topics:</h3>
                            <div class="flex flex-wrap gap-1.5 mb-5">
                                @php
                                    $topics = is_array($program->topics) ? $program->topics : json_decode($program->topics, true) ?? [];
                                @endphp
                                @foreach(array_slice($topics, 0, 4) as $topic)
                                    <span class="text-xs text-slate-400 bg-white/5 border border-white/10 px-2 py-1 rounded-md">{{ $topic }}</span>
                                @endforeach
                            </div>
                            
                            <div class="flex items-center gap-6 mt-5">
                                <div class="flex items-center gap-2 text-sm text-slate-400">
                                    <span class="text-cyan-400">💰</span> EGP {{ number_format($program->price) }}
                                </div>
                                <div class="flex items-center gap-2 text-sm text-slate-400">
                                    <span class="text-cyan-400">⏱️</span> {{ $program->duration }}
                                </div>
                            </div>
                            
                            <div class="flex flex-wrap gap-3 mt-6">
                                <a href="{{ route('enroll', ['program' => $program->slug]) }}" class="px-6 py-2.5 text-sm font-semibold text-gray-900 bg-gradient-to-r from-cyan-400 to-emerald-400 rounded-xl hover:shadow-lg hover:shadow-cyan-400/20 transition-all duration-300">
                                    Enroll
                                </a>
                                <a href="{{ route('programs.show', $program->slug) }}" class="px-6 py-2.5 text-sm font-semibold text-white border border-white/15 bg-white/[0.04] rounded-xl hover:border-white/25 transition-all duration-300">
                                    Program Details
                                </a>
                            </div>
                        </div>
                        
                        <!-- Right side video -->
                        <div class="rounded-xl overflow-hidden border border-white/[0.06]">
                            <iframe 
                                width="100%" 
                                height="250" 
                                style="border:0;" 
                                src="{{ $program->video_url ?? 'https://www.youtube.com/embed/LEm8_dZao0E' }}" 
                                title="{{ $program->title }}" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection