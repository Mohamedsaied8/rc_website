@extends('components.layout')

@section('title', $post->title . ' - Research | Robotics Corner')
@section('description', Str::limit(strip_tags($post->paper_abstract ?: ($post->excerpt ?: $post->content)), 160))

@section('content')
    @php
        // Every academic field is optional — the layout collapses gracefully when empty.
        $links = collect([
            $post->paper_pdf ? ['label' => 'Download PDF', 'href' => asset('storage/' . $post->paper_pdf), 'icon' => 'fa-solid fa-file-pdf', 'primary' => true] : null,
            $post->paper_url ? ['label' => 'Publisher page', 'href' => $post->paper_url, 'icon' => 'fa-solid fa-up-right-from-square', 'primary' => false] : null,
            $post->paper_doi ? ['label' => 'DOI', 'href' => Str::startsWith($post->paper_doi, 'http') ? $post->paper_doi : 'https://doi.org/' . $post->paper_doi, 'icon' => 'fa-solid fa-link', 'primary' => false] : null,
            $post->paper_code_url ? ['label' => 'Code', 'href' => $post->paper_code_url, 'icon' => 'fa-solid fa-code', 'primary' => false] : null,
        ])->filter()->values();

        $facts = collect([
            $post->paper_venue ? ['label' => 'Published in', 'value' => $post->paper_venue] : null,
            $post->paper_year ? ['label' => 'Year', 'value' => $post->paper_year] : null,
            $post->paper_doi ? ['label' => 'DOI', 'value' => $post->paper_doi] : null,
        ])->filter()->values();
    @endphp

    {{-- ===== Research hero ===== --}}
    <section class="research-band relative overflow-hidden">
        <div class="absolute inset-0 research-band-grid"></div>

        <div class="relative z-10 max-w-5xl mx-auto px-6 pt-32 pb-16 md:pb-20">
            <nav class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-9">
                <a href="{{ route('blog.index') }}" class="hover:text-violet-700 transition-colors">Blog</a>
                <i class="fa-solid fa-chevron-right text-[9px]"></i>
                <a href="{{ route('blog.index', ['type' => 'paper']) }}" class="hover:text-violet-700 transition-colors">Research</a>
            </nav>

            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-violet-50 border border-violet-200 paper-meta text-violet-700 mb-7">
                <i class="fa-solid fa-flask-vial text-[10px]"></i> Published paper
            </span>

            <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 tracking-tight leading-[1.1] max-w-4xl mb-8">
                {{ $post->title }}
            </h1>

            @if($post->paper_authors)
                <div class="flex flex-wrap items-center gap-2 mb-8">
                    @foreach(preg_split('/\s*[,;]\s*/', $post->paper_authors, -1, PREG_SPLIT_NO_EMPTY) as $author)
                        <span class="inline-flex items-center gap-2 pl-1.5 pr-3.5 py-1.5 rounded-full bg-white border border-slate-200 shadow-sm text-sm text-slate-700">
                            <span class="w-6 h-6 rounded-full bg-gradient-to-br from-violet-500 to-cyan-500 flex items-center justify-center text-[10px] font-bold text-white">
                                {{ strtoupper(mb_substr(trim($author), 0, 1)) }}
                            </span>
                            {{ trim($author) }}
                        </span>
                    @endforeach
                </div>
            @endif

            @if($facts->isNotEmpty())
                <div class="grid grid-cols-2 md:grid-cols-3 gap-px bg-slate-200 border border-slate-200 rounded-2xl overflow-hidden max-w-3xl mb-9 shadow-sm">
                    @foreach($facts as $fact)
                        <div class="bg-white px-5 py-4">
                            <p class="paper-meta text-slate-400 mb-1.5">{{ $fact['label'] }}</p>
                            <p class="text-sm font-semibold text-slate-900 break-words">{{ $fact['value'] }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            @if($links->isNotEmpty())
                <div class="flex flex-wrap gap-3">
                    @foreach($links as $link)
                        <a href="{{ $link['href'] }}" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-bold transition-all duration-300 hover:-translate-y-0.5 {{ $link['primary']
                                ? 'bg-gradient-to-r from-violet-600 to-cyan-600 text-white hover:shadow-[0_10px_28px_-8px_rgba(124,58,237,0.6)]'
                                : 'border border-slate-200 bg-white text-slate-700 shadow-sm hover:border-violet-300 hover:text-violet-700' }}">
                            <i class="{{ $link['icon'] }} text-xs"></i> {{ $link['label'] }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- ===== Abstract + body ===== --}}
    <section class="relative z-10 max-w-5xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-2 min-w-0">
                @if($post->paper_abstract)
                    <div class="relative rounded-3xl border border-slate-200 bg-white shadow-sm p-7 md:p-9 mb-12 overflow-hidden">
                        <span class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b from-violet-500 to-cyan-500"></span>
                        <h2 class="text-xs font-bold uppercase tracking-[0.2em] text-violet-700 mb-4">Abstract</h2>
                        <p class="text-[17px] text-slate-600 leading-[1.85] whitespace-pre-line">{{ $post->paper_abstract }}</p>
                    </div>
                @endif

                @if($post->featured_image)
                    <figure class="mb-12">
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                             class="w-full h-auto rounded-2xl border border-slate-200 shadow-lg shadow-slate-200/60">
                    </figure>
                @endif

                @if(trim(strip_tags($post->content ?? '')) !== '')
                    <div class="article-body">
                        {!! $post->body_html !!}
                    </div>
                @endif

                @if($post->images->count() > 0)
                    <div class="mt-14 pt-10 border-t border-slate-200">
                        <h2 class="text-2xl font-bold text-slate-900 tracking-tight mb-7">Figures</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            @foreach($post->images as $index => $image)
                                <figure class="rounded-2xl overflow-hidden border border-slate-200 bg-white">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->caption }}" loading="lazy" class="w-full h-auto">
                                    <figcaption class="px-4 py-3 text-xs text-slate-500 border-t border-slate-100">
                                        <span class="font-bold text-slate-700">Fig. {{ $index + 1 }}.</span>
                                        {{ $image->caption }}
                                    </figcaption>
                                </figure>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="lg:col-span-1 min-w-0">
                <div class="lg:sticky lg:top-28 space-y-5">
                    @if($post->paper_bibtex)
                        <div x-data="{ copied: false }" class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                            <div class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100">
                                <h3 class="text-xs font-bold uppercase tracking-widest text-slate-500">Cite this paper</h3>
                                <button type="button"
                                        @click="navigator.clipboard.writeText($refs.bib.textContent.trim()); copied = true; setTimeout(() => copied = false, 2000)"
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-bold text-violet-700 bg-violet-50 border border-violet-200 hover:bg-violet-100 transition-colors">
                                    <i class="fa-regular fa-copy text-[11px]" x-show="!copied"></i>
                                    <i class="fa-solid fa-check text-[11px]" x-show="copied" x-cloak></i>
                                    <span x-text="copied ? 'Copied' : 'Copy'"></span>
                                </button>
                            </div>
                            <pre x-ref="bib" class="px-5 py-4 text-[11px] leading-relaxed text-slate-600 overflow-x-auto font-mono whitespace-pre">{{ $post->paper_bibtex }}</pre>
                        </div>
                    @endif

                    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-5">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-slate-500 mb-4">Details</h3>
                        <dl class="space-y-3.5 text-sm">
                            @if($post->paper_venue)
                                <div><dt class="text-xs text-slate-400 mb-0.5">Venue</dt><dd class="font-semibold text-slate-800">{{ $post->paper_venue }}</dd></div>
                            @endif
                            @if($post->paper_year)
                                <div><dt class="text-xs text-slate-400 mb-0.5">Year</dt><dd class="font-semibold text-slate-800">{{ $post->paper_year }}</dd></div>
                            @endif
                            <div><dt class="text-xs text-slate-400 mb-0.5">Added</dt><dd class="font-semibold text-slate-800">{{ $post->formatted_date }}</dd></div>
                            @if($post->tags)
                                <div>
                                    <dt class="text-xs text-slate-400 mb-2">Topics</dt>
                                    <dd class="flex flex-wrap gap-1.5">
                                        @foreach($post->tags as $tag)<span class="topic-pill">{{ $tag }}</span>@endforeach
                                    </dd>
                                </div>
                            @endif
                        </dl>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-sm text-slate-600 leading-relaxed mb-4">
                            Interested in collaborating on research with our team?
                        </p>
                        <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-sm font-bold text-violet-700 hover:text-violet-800 transition-colors">
                            Get in touch <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
            </aside>
        </div>

        <div class="mt-16 pt-8 border-t border-slate-200">
            <a href="{{ route('blog.index', ['type' => 'paper']) }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-slate-900 transition-colors group">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> All publications
            </a>
        </div>
    </section>

    {{-- ===== Related ===== --}}
    @if($relatedPosts->count() > 0)
        <section class="relative z-10 bg-white border-t border-slate-200 py-16 md:py-20">
            <div class="max-w-6xl mx-auto px-6">
                <div class="flex items-end justify-between gap-4 mb-10">
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900 tracking-tight">More from the lab</h2>
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
