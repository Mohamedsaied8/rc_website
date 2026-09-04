@props(['post'])

{{-- Publication card. Used in the research band and in the filtered feed. --}}
<a href="{{ $post->url }}" class="paper-card rounded-3xl p-6 flex flex-col group">
    <div class="flex items-center gap-2 paper-meta text-slate-400 mb-3">
        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md bg-violet-50 border border-violet-200 text-violet-700">
            <i class="fa-solid fa-flask-vial text-[9px]"></i> Paper
        </span>
        @if($post->paper_venue)<span class="text-slate-500 truncate max-w-[9rem]">{{ $post->paper_venue }}</span>@endif
        @if($post->paper_year)<span class="text-slate-400">{{ $post->paper_year }}</span>@endif
    </div>

    <h3 class="text-base font-bold text-slate-900 leading-snug line-clamp-3 group-hover:text-violet-700 transition-colors">
        {{ $post->title }}
    </h3>

    @if($post->paper_authors)
        <p class="mt-2.5 text-xs text-slate-500 line-clamp-1">{{ $post->paper_authors }}</p>
    @endif

    @if($post->paper_abstract || $post->excerpt)
        <p class="mt-3 text-sm text-slate-500 leading-relaxed line-clamp-3">
            {{ Str::limit($post->paper_abstract ?: $post->excerpt, 160) }}
        </p>
    @endif

    <div class="mt-auto pt-5 flex items-center justify-between gap-3">
        <span class="text-xs font-bold text-violet-700 inline-flex items-center gap-1.5 group-hover:gap-2.5 transition-all">
            View paper <i class="fa-solid fa-arrow-right text-[10px]"></i>
        </span>
        @if($post->paper_pdf || $post->paper_url)
            <span class="paper-meta text-slate-400"><i class="fa-solid fa-file-pdf text-rose-400"></i> Full text</span>
        @endif
    </div>
</a>
