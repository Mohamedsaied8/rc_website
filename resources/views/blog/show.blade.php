@extends('components.layout')

@section('title', $post->title . ' - Robotics Corner')
@section('description', $post->excerpt ?? Str::limit(strip_tags($post->content), 160))

@section('content')
    @php
        $isNews = $post->type === 'news';
        // Full class strings — Tailwind can't compile an interpolated variant prefix.
        $accentLink = $isNews ? 'hover:text-amber-600' : 'hover:text-cyan-600';
        $accentChip = $isNews ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-cyan-50 text-cyan-700 border-cyan-200';
        $accentGlow = $isNews ? 'bg-amber-500/[0.07]' : 'bg-cyan-500/[0.07]';
    @endphp

    {{-- Reading progress --}}
    <div id="read-progress" class="scroll-progress" style="width: 0%"></div>

    {{-- ===== Header ===== --}}
    <section class="relative pt-32 pb-12 overflow-hidden">
        <div class="absolute inset-0 bg-grid opacity-30"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[700px] h-[380px] {{ $accentGlow }} rounded-full blur-[150px]"></div>

        <div class="relative z-10 max-w-3xl mx-auto px-6">
            <nav class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-8">
                <a href="{{ route('blog.index') }}" class="{{ $accentLink }} transition-colors">Blog</a>
                <i class="fa-solid fa-chevron-right text-[9px]"></i>
                <span class="text-slate-500">{{ $isNews ? 'News' : 'Article' }}</span>
            </nav>

            <span class="inline-flex items-center gap-2 px-3 py-1.5 mb-6 rounded-full border text-[11px] font-bold uppercase tracking-widest {{ $accentChip }}">
                <i class="{{ $post->type_icon }} text-[10px]"></i> {{ $post->type_label }}
            </span>

            <h1 class="text-4xl md:text-5xl lg:text-[3.5rem] font-extrabold text-slate-900 tracking-tight leading-[1.08] mb-7">
                {{ $post->title }}
            </h1>

            @if($post->excerpt)
                <p class="text-lg md:text-xl text-slate-600 leading-relaxed mb-9">{{ $post->excerpt }}</p>
            @endif

            <div class="flex flex-wrap items-center gap-x-5 gap-y-3 pb-8 border-b border-slate-200">
                <div class="flex items-center gap-3">
                    <span class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-400 to-emerald-400 p-[2px]">
                        <span class="w-full h-full rounded-full bg-white flex items-center justify-center text-sm font-bold text-slate-700">
                            {{ strtoupper(mb_substr($post->byline, 0, 1)) }}
                        </span>
                    </span>
                    <div>
                        <p class="text-sm font-bold text-slate-900 leading-tight">{{ $post->byline }}</p>
                        <p class="text-xs text-slate-500">{{ $post->user_id ? 'Community author' : 'Robotics Corner' }}</p>
                    </div>
                </div>
                <span class="hidden sm:block w-px h-8 bg-slate-200"></span>
                <div class="flex items-center gap-4 text-xs font-semibold uppercase tracking-wider text-slate-400">
                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-calendar"></i> {{ $post->formatted_date }}</span>
                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock"></i> {{ $post->reading_time }} min read</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== Body ===== --}}
    <article class="relative z-10 max-w-3xl mx-auto px-6 pb-16">
        @if($post->featured_image)
            <figure class="mb-12 -mx-6 md:mx-0">
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                     class="w-full h-auto object-cover md:rounded-2xl border-y md:border border-slate-200 shadow-lg shadow-slate-200/60">
            </figure>
        @endif

        <div class="article-body">
            {!! $post->body_html !!}
        </div>

        @if($post->tags)
            <div class="mt-12 flex flex-wrap items-center gap-2">
                <span class="text-xs font-bold uppercase tracking-widest text-slate-400 mr-1">Topics</span>
                @foreach($post->tags as $tag)
                    <span class="topic-pill">{{ $tag }}</span>
                @endforeach
            </div>
        @endif

        @if($post->images->count() > 0)
            <div class="mt-16 pt-12 border-t border-slate-200">
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight mb-8">Gallery</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    @foreach($post->images as $image)
                        <figure class="group relative rounded-2xl overflow-hidden border border-slate-200 bg-slate-50">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->caption }}" loading="lazy"
                                 class="w-full h-auto group-hover:scale-105 transition-transform duration-700">
                            @if($image->caption)
                                <figcaption class="absolute inset-x-0 bottom-0 bg-slate-900/85 backdrop-blur-sm px-4 py-3 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                    <p class="text-sm text-slate-200">{{ $image->caption }}</p>
                                </figcaption>
                            @endif
                        </figure>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Share + back --}}
        <div class="mt-14 pt-8 border-t border-slate-200 flex flex-wrap items-center justify-between gap-4">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-slate-900 transition-colors group">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> Back to blog
            </a>
            <div class="flex items-center gap-2">
                <span class="text-xs font-bold uppercase tracking-widest text-slate-400 mr-1">Share</span>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($post->url) }}" target="_blank" rel="noopener"
                   aria-label="Share on LinkedIn" class="w-9 h-9 rounded-lg border border-slate-200 flex items-center justify-center text-slate-500 hover:text-white hover:bg-[#0a66c2] hover:border-[#0a66c2] transition-all">
                    <i class="fa-brands fa-linkedin-in text-sm"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode($post->url) }}&text={{ urlencode($post->title) }}" target="_blank" rel="noopener"
                   aria-label="Share on X" class="w-9 h-9 rounded-lg border border-slate-200 flex items-center justify-center text-slate-500 hover:text-white hover:bg-slate-900 hover:border-slate-900 transition-all">
                    {{-- The CDN pins Font Awesome 6.4.0, which predates fa-x-twitter. --}}
                    <i class="fa-brands fa-twitter text-sm"></i>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($post->url) }}" target="_blank" rel="noopener"
                   aria-label="Share on Facebook" class="w-9 h-9 rounded-lg border border-slate-200 flex items-center justify-center text-slate-500 hover:text-white hover:bg-[#1877f2] hover:border-[#1877f2] transition-all">
                    <i class="fa-brands fa-facebook-f text-sm"></i>
                </a>
            </div>
        </div>
    </article>

    {{-- ===== Related ===== --}}
    @if($relatedPosts->count() > 0)
        <section class="relative z-10 bg-white border-t border-slate-200 py-16 md:py-20">
            <div class="max-w-6xl mx-auto px-6">
                <div class="flex items-end justify-between gap-4 mb-10">
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900 tracking-tight">Keep reading</h2>
                    <a href="{{ route('blog.index') }}" class="text-sm font-bold text-cyan-600 hover:text-cyan-700 whitespace-nowrap">View all &rarr;</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-7">
                    @foreach($relatedPosts as $relatedPost)
                        @include('components.blog-card', ['post' => $relatedPost])
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@push('scripts')
<script>
    // Reading progress bar across the article body.
    (function () {
        const bar = document.getElementById('read-progress');
        if (!bar) return;
        const update = () => {
            const max = document.documentElement.scrollHeight - window.innerHeight;
            bar.style.width = (max > 0 ? (window.scrollY / max) * 100 : 0) + '%';
        };
        update();
        window.addEventListener('scroll', update, { passive: true });
        window.addEventListener('resize', update);
    })();
</script>
@endpush
