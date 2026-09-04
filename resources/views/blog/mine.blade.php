@extends('components.layout')

@section('title', 'My posts - Robotics Corner')

@section('content')
    <section class="relative pt-32 pb-10 overflow-hidden">
        <div class="absolute inset-0 bg-grid opacity-30"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[340px] bg-cyan-500/[0.07] rounded-full blur-[150px]"></div>

        <div class="relative z-10 max-w-4xl mx-auto px-6 flex flex-col sm:flex-row sm:items-end justify-between gap-6">
            <div>
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-cyan-600 transition-colors mb-6">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i> Back to blog
                </a>
                <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight leading-[1.05]">My posts</h1>
                <p class="mt-4 text-slate-600">Everything you've submitted, and where it stands.</p>
            </div>
            <a href="{{ route('blog.create') }}" class="shrink-0 inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-slate-900 text-white font-bold hover:bg-slate-800 hover:-translate-y-0.5 transition-all duration-300 shadow-lg shadow-slate-900/10">
                <i class="fa-solid fa-feather text-cyan-400"></i> New post
            </a>
        </div>
    </section>

    <section class="relative z-10 max-w-4xl mx-auto px-6 pb-24">
        @if(session('success'))
            <div class="mb-8 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-800">
                <i class="fa-solid fa-circle-check text-emerald-500"></i> {{ session('success') }}
            </div>
        @endif

        @if($posts->count() > 0)
            <div class="space-y-4">
                @foreach($posts as $post)
                    @php
                        $badge = match ($post->status) {
                            'published' => ['bg-emerald-50 text-emerald-700 border-emerald-200', 'fa-solid fa-circle-check', 'Published'],
                            'pending' => ['bg-amber-50 text-amber-700 border-amber-200', 'fa-solid fa-hourglass-half', 'Pending review'],
                            'rejected' => ['bg-red-50 text-red-700 border-red-200', 'fa-solid fa-circle-xmark', 'Not accepted'],
                            default => ['bg-slate-100 text-slate-600 border-slate-200', 'fa-solid fa-pen', 'Draft'],
                        };
                    @endphp
                    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-5 md:p-6 hover:shadow-md transition-shadow">
                        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                            <div class="min-w-0">
                                <h2 class="text-lg font-bold text-slate-900 leading-snug mb-2">
                                    @if($post->status === 'published')
                                        <a href="{{ $post->url }}" class="hover:text-cyan-600 transition-colors">{{ $post->title }}</a>
                                    @else
                                        {{ $post->title }}
                                    @endif
                                </h2>
                                <p class="text-xs text-slate-400 font-medium">
                                    Submitted {{ $post->created_at->format('M d, Y') }}
                                    @if($post->published_at) &middot; Published {{ $post->formatted_date }} @endif
                                </p>
                                @if($post->status === 'rejected' && $post->rejection_reason)
                                    <p class="mt-3 text-sm text-red-600 bg-red-50 border border-red-100 rounded-xl px-4 py-2.5">
                                        <strong class="font-bold">Editor note:</strong> {{ $post->rejection_reason }}
                                    </p>
                                @endif
                            </div>
                            <span class="shrink-0 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border text-xs font-bold {{ $badge[0] }}">
                                <i class="{{ $badge[1] }} text-[10px]"></i> {{ $badge[2] }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($posts->hasPages())
                <div class="mt-10 flex justify-center">{{ $posts->links() }}</div>
            @endif
        @else
            <div class="text-center py-20 bg-white border border-dashed border-slate-300 rounded-3xl">
                <div class="w-16 h-16 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center mx-auto mb-5">
                    <i class="fa-solid fa-feather text-2xl text-cyan-600"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">You haven't written anything yet</h3>
                <p class="text-slate-500 max-w-sm mx-auto mb-6">Share a project or a lesson learned with the community.</p>
                <a href="{{ route('blog.create') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-slate-900 text-white font-bold hover:bg-slate-800 transition-colors">
                    Write your first post
                </a>
            </div>
        @endif
    </section>
@endsection
