@extends('components.layout')

@section('title', 'Our Programs - Robotics Corner')

@section('content')
<div class="pt-24 pb-20 bg-slate-50 text-slate-800 font-sans selection:bg-cyan-500/30 overflow-hidden relative min-h-screen">
    <!-- Background Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-cyan-200/40 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-emerald-200/40 rounded-full blur-[120px]"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-12 text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-cyan-100 border border-cyan-200 text-cyan-700 text-sm font-semibold tracking-wide mb-4">
                <span class="w-2 h-2 rounded-full bg-cyan-500 animate-pulse"></span>
                PREMIUM TRAINING
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight leading-[1.1] mb-4">
                Master the Future of <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-emerald-600">Engineering</span>
            </h1>
            <p class="text-lg text-slate-600 font-medium leading-relaxed">
                Structured learning paths, expert-led cohorts, and real-world projects designed for career acceleration.
            </p>
        </div>

        <!-- Programs Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($programs as $program)
                <div class="group relative bg-white border border-slate-200 shadow-sm rounded-2xl flex flex-col hover:shadow-xl hover:-translate-y-1 hover:border-cyan-300 transition-all duration-300 overflow-hidden h-full">
                    
                    @if($program->video_url)
                        <div class="relative aspect-video bg-slate-100 overflow-hidden">
                            <iframe 
                                class="w-full h-full absolute inset-0"
                                src="{{ $program->video_url }}" 
                                title="{{ $program->title }}" 
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        </div>
                    @else
                        <div class="relative aspect-video bg-slate-100 flex items-center justify-center border-b border-slate-100">
                            <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    @endif
                    
                    <div class="p-6 flex flex-col flex-1">
                        <div class="flex justify-between items-start mb-3">
                            <h2 class="text-xl font-bold text-slate-900 group-hover:text-cyan-600 transition-colors duration-300 line-clamp-2">
                                {{ $program->title }}
                            </h2>
                        </div>
                        
                        <p class="text-sm text-slate-600 mb-4 line-clamp-3 flex-1">
                            {{ $program->short_description ?? Str::limit($program->description, 120) }}
                        </p>
                        
                        <div class="flex flex-wrap gap-1.5 mb-5">
                            @php
                                $topics = is_array($program->topics) ? $program->topics : json_decode($program->topics, true) ?? [];
                            @endphp
                            @foreach(array_slice($topics, 0, 3) as $topic)
                                <span class="px-2 py-1 text-[10px] font-semibold text-slate-600 bg-slate-100 rounded-md">
                                    {{ $topic }}
                                </span>
                            @endforeach
                            @if(count($topics) > 3)
                                <span class="px-2 py-1 text-[10px] font-semibold text-slate-400 bg-transparent border border-dashed border-slate-300 rounded-md">
                                    +{{ count($topics) - 3 }}
                                </span>
                            @endif
                        </div>
                        
                        <div class="flex items-center justify-between pt-4 border-t border-slate-100 mt-auto">
                            <div>
                                <p class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Investment</p>
                                <p class="text-sm font-bold text-slate-900">{{ $program->currency ?? 'EGP' }} {{ number_format($program->price) }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Duration</p>
                                <p class="text-sm font-semibold text-slate-700">{{ $program->duration }}</p>
                            </div>
                        </div>
                        
                        <a href="{{ route('programs.show', $program->slug) }}" class="mt-4 block w-full text-center px-4 py-2.5 text-sm font-bold text-white bg-slate-900 rounded-lg hover:bg-gradient-to-r hover:from-cyan-500 hover:to-emerald-500 transition-all shadow-sm">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
            
            @if($programs->isEmpty())
                <div class="col-span-full text-center py-16 bg-white border border-slate-200 rounded-2xl shadow-sm">
                    <svg class="w-16 h-16 mx-auto text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Check Back Soon</h3>
                    <p class="text-slate-500">We are currently updating our program catalog.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection