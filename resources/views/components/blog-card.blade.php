@props(['post'])

@php
    // Each content type gets its own accent so the feed is scannable at a glance.
    // Every variant is written out in full so Tailwind's source scanner sees the
    // literal class names — interpolating a prefix onto a colour would not compile.
    $accent = match ($post->type) {
        'news' => [
            'ring' => 'hover:border-amber-300',
            'chip' => 'bg-amber-50 text-amber-700 border-amber-200',
            'icon' => 'text-amber-500',
            'link' => 'text-amber-600',
            'title' => 'group-hover:text-amber-600',
            'grad' => 'from-amber-400/20 to-orange-400/20',
        ],
        'paper' => [
            'ring' => 'hover:border-violet-300',
            'chip' => 'bg-violet-50 text-violet-700 border-violet-200',
            'icon' => 'text-violet-500',
            'link' => 'text-violet-600',
            'title' => 'group-hover:text-violet-600',
            'grad' => 'from-violet-400/20 to-indigo-400/20',
        ],
        default => [
            'ring' => 'hover:border-cyan-300',
            'chip' => 'bg-cyan-50 text-cyan-700 border-cyan-200',
            'icon' => 'text-cyan-500',
            'link' => 'text-cyan-600',
            'title' => 'group-hover:text-cyan-600',
            'grad' => 'from-cyan-400/20 to-emerald-400/20',
        ],
    };
@endphp

<article class="group relative flex flex-col bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-slate-200/70 hover:-translate-y-1.5 transition-all duration-300 {{ $accent['ring'] }}">
    <div class="relative w-full h-44 overflow-hidden shrink-0">
        @if($post->featured_image)
            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" loading="lazy"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
        @else
            <div class="w-full h-full bg-gradient-to-br {{ $accent['grad'] }} flex items-center justify-center">
                <i class="{{ $post->type_icon }} text-4xl {{ $accent['icon'] }} opacity-60"></i>
            </div>
        @endif

        <span class="absolute top-3 left-3 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full border text-[11px] font-bold uppercase tracking-wider backdrop-blur-sm {{ $accent['chip'] }}">
            <i class="{{ $post->type_icon }} text-[10px]"></i> {{ $post->type_label }}
        </span>

        @if($post->featured)
            <span class="absolute top-3 right-3 inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-slate-900/80 text-amber-300 text-[11px] font-bold backdrop-blur-sm">
                <i class="fa-solid fa-star text-[9px]"></i> Featured
            </span>
        @endif
    </div>

    <div class="flex flex-col flex-1 p-6">
        <div class="flex items-center gap-3 text-[11px] font-semibold uppercase tracking-widest text-slate-400 mb-3">
            <span class="flex items-center gap-1.5"><i class="fa-regular fa-calendar"></i> {{ $post->formatted_date }}</span>
            <span class="w-1 h-1 rounded-full bg-slate-300"></span>
            <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock"></i> {{ $post->reading_time }} min</span>
        </div>

        <h3 class="text-lg font-bold text-slate-900 leading-snug mb-3 line-clamp-2 {{ $accent['title'] }} transition-colors">
            <a href="{{ $post->url }}" class="focus:outline-none focus-visible:underline">
                <span class="absolute inset-0" aria-hidden="true"></span>
                {{ $post->title }}
            </a>
        </h3>

        @if($post->excerpt)
            <p class="text-sm text-slate-500 leading-relaxed line-clamp-3 mb-5">{{ $post->excerpt }}</p>
        @endif

        @if($post->tags)
            <div class="flex flex-wrap gap-1.5 mb-5">
                @foreach(array_slice($post->tags, 0, 3) as $tag)
                    <span class="topic-pill">{{ $tag }}</span>
                @endforeach
            </div>
        @endif

        <div class="flex items-center justify-between gap-3 mt-auto pt-4 border-t border-slate-100">
            <div class="flex items-center gap-2 min-w-0">
                <span class="w-6 h-6 shrink-0 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-[10px] font-bold text-slate-500">
                    {{ strtoupper(mb_substr($post->byline, 0, 1)) }}
                </span>
                <span class="text-xs font-medium text-slate-500 truncate">{{ $post->byline }}</span>
            </div>
            <span class="text-xs font-bold {{ $accent['link'] }} whitespace-nowrap group-hover:translate-x-0.5 transition-transform">
                Read <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </span>
        </div>
    </div>
</article>
