@extends('components.layout')

@section('title', 'Blog, News & Research - Robotics Corner')
@section('description', 'Engineering articles, company news and peer-reviewed research from Robotics Corner — robotics, autonomy, embedded systems and applied AI.')

@section('content')
{{--
    One Alpine root wraps the band, the filter and the feed. Every post is rendered
    server-side and shown/hidden in the browser, so switching tabs is instant: no
    navigation, no scroll jump, just a fade.
--}}
<div
    x-data="{
        type: 'all',
        counts: @js(['all' => $totalCount, 'blog' => $counts['blog'] ?? 0, 'news' => $counts['news'] ?? 0, 'paper' => $counts['paper'] ?? 0]),
        init() {
            const requested = new URLSearchParams(window.location.search).get('type');
            if (['blog', 'news', 'paper'].includes(requested)) this.type = requested;
        },
        setType(next) {
            if (this.type === next) return;

            // Showing/hiding the papers band changes the page height. If the reader has
            // already scrolled into the feed, pin the feed to the same spot on screen so
            // the content under the cursor doesn't jump.
            const feed = this.$refs.feed;
            const topBefore = feed.getBoundingClientRect().top;
            const shouldPin = topBefore <= 0;

            this.type = next;

            // Keep the URL shareable without navigating (no reload, no scroll jump).
            const url = next === 'all' ? window.location.pathname : window.location.pathname + '?type=' + next;
            window.history.replaceState(null, '', url);

            if (!shouldPin) return;
            const repin = () => {
                const delta = feed.getBoundingClientRect().top - topBefore;
                if (delta) window.scrollBy({ top: delta, behavior: 'instant' });
            };
            requestAnimationFrame(repin);
            // Again once the band's leave transition has finished collapsing its height.
            setTimeout(repin, 260);
        },
        // On 'all' the papers already have their own band above, so they're kept out
        // of the feed to avoid showing the same paper twice.
        shows(postType) {
            return this.type === 'all' ? postType !== 'paper' : postType === this.type;
        },
        get visibleCount() {
            return this.type === 'all' ? this.counts.blog + this.counts.news : this.counts[this.type];
        },
    }"
>

    {{-- ===== Hero ===== --}}
    <section class="relative pt-32 pb-14 overflow-hidden">
        <div class="absolute inset-0 bg-grid opacity-30"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[760px] h-[420px] bg-cyan-500/[0.07] rounded-full blur-[150px]"></div>

        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 mb-6 rounded-full bg-white border border-slate-200 shadow-sm text-xs font-bold uppercase tracking-widest text-slate-500">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                {{ $totalCount }} {{ Str::plural('publication', $totalCount) }} and counting
            </span>

            <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-slate-900 tracking-tight leading-[1.02] mb-6">
                Ideas from the <span class="text-gradient">Robotics Corner</span>
            </h1>
            <p class="text-lg md:text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed">
                Engineering write-ups from our community, announcements from the team, and the
                peer-reviewed research behind what we build.
            </p>

            <div class="mt-9 flex flex-wrap items-center justify-center gap-3">
                <a href="#feed" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-slate-900 text-white text-sm font-bold hover:bg-slate-800 hover:-translate-y-0.5 transition-all duration-300 shadow-lg shadow-slate-900/10">
                    <i class="fa-solid fa-book-open text-cyan-400"></i> Browse everything
                </a>
                @auth
                    <a href="{{ route('blog.create') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white border border-slate-200 text-sm font-bold text-slate-700 hover:border-cyan-300 hover:text-cyan-700 hover:-translate-y-0.5 transition-all duration-300 shadow-sm">
                        <i class="fa-solid fa-feather text-cyan-500"></i> Write a post
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white border border-slate-200 text-sm font-bold text-slate-700 hover:border-cyan-300 hover:text-cyan-700 hover:-translate-y-0.5 transition-all duration-300 shadow-sm">
                        <i class="fa-solid fa-feather text-cyan-500"></i> Sign in to write
                    </a>
                @endauth
            </div>
        </div>
    </section>

    {{-- ===== Research & Publications band ===== --}}
    @if($papers->isNotEmpty())
        @php $lead = $papers->first(); $rest = $papers->slice(1); @endphp
        <section
            class="research-band relative overflow-hidden"
            x-show="type === 'all'"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            <div class="absolute inset-0 research-band-grid"></div>

            <div class="relative z-10 max-w-6xl mx-auto px-6 py-20 md:py-24">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
                    <div>
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-violet-50 border border-violet-200 paper-meta text-violet-700 mb-5">
                            <i class="fa-solid fa-flask-vial text-[10px]"></i> Peer-reviewed
                        </span>
                        <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight leading-[1.05]">
                            Research &amp;
                            <span class="bg-gradient-to-r from-violet-600 to-cyan-600 bg-clip-text text-transparent">Publications</span>
                        </h2>
                        <p class="mt-4 text-slate-600 max-w-xl leading-relaxed">
                            Papers authored and co-authored by the Robotics Corner team, published at
                            conferences and in journals.
                        </p>
                    </div>
                    @if(($counts['paper'] ?? 0) > 1)
                        <button type="button" @click="setType('paper')"
                                class="shrink-0 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-slate-200 bg-white text-sm font-semibold text-slate-700 hover:border-violet-300 hover:text-violet-700 hover:-translate-y-0.5 shadow-sm transition-all cursor-pointer">
                            All papers <i class="fa-solid fa-arrow-right text-xs"></i>
                        </button>
                    @endif
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
                    {{-- Lead paper --}}
                    <a href="{{ $lead->url }}" class="paper-card paper-card-lead lg:col-span-3 rounded-3xl p-8 md:p-10 flex flex-col group">
                        <div class="flex flex-wrap items-center gap-2 paper-meta mb-6">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-violet-50 border border-violet-200 text-violet-700">
                                <i class="fa-solid fa-flask-vial text-[9px]"></i> Paper
                            </span>
                            @if($lead->paper_venue)<span class="px-2.5 py-1 rounded-md bg-slate-50 border border-slate-200 text-slate-600">{{ $lead->paper_venue }}</span>@endif
                            @if($lead->paper_year)<span class="px-2.5 py-1 rounded-md bg-slate-50 border border-slate-200 text-slate-500">{{ $lead->paper_year }}</span>@endif
                            @if($lead->paper_doi)<span class="px-2.5 py-1 rounded-md bg-slate-50 border border-slate-200 text-slate-400 truncate max-w-[15rem]">DOI {{ $lead->paper_doi }}</span>@endif
                        </div>

                        <h3 class="text-2xl md:text-[2rem] font-bold text-slate-900 leading-[1.2] tracking-tight mb-5 group-hover:text-violet-700 transition-colors">
                            {{ $lead->title }}
                        </h3>

                        @if($lead->paper_authors)
                            <p class="text-sm text-slate-500 mb-5">
                                <i class="fa-solid fa-user-group text-[11px] text-slate-400 mr-1.5"></i>{{ $lead->paper_authors }}
                            </p>
                        @endif

                        @if($lead->paper_abstract || $lead->excerpt)
                            <p class="text-[15px] text-slate-600 leading-relaxed line-clamp-4">
                                {{ Str::limit($lead->paper_abstract ?: $lead->excerpt, 340) }}
                            </p>
                        @endif

                        <div class="mt-auto pt-8 flex flex-wrap items-center gap-3">
                            <span class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-violet-600 to-cyan-600 text-white text-sm font-bold group-hover:shadow-[0_10px_28px_-8px_rgba(124,58,237,0.6)] transition-shadow">
                                Read the paper <i class="fa-solid fa-arrow-right text-xs"></i>
                            </span>
                            @if($lead->paper_pdf || $lead->paper_url)
                                <span class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500">
                                    <i class="fa-solid fa-file-pdf text-rose-400"></i> Full text available
                                </span>
                            @endif
                        </div>
                    </a>

                    {{-- Remaining papers --}}
                    <div class="lg:col-span-2 flex flex-col gap-6">
                        @forelse($rest as $paper)
                            @include('components.paper-card', ['post' => $paper])
                        @empty
                            <div class="paper-card rounded-3xl p-8 flex flex-col items-center justify-center text-center flex-1">
                                <i class="fa-solid fa-microscope text-3xl text-slate-300 mb-4"></i>
                                <p class="text-sm text-slate-500 leading-relaxed">More publications from the lab are on the way.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- ===== Feed ===== --}}
    <section id="feed" x-ref="feed" class="relative z-10 max-w-6xl mx-auto px-6 py-16 md:py-20 scroll-mt-24">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-5 mb-10">
            @include('blog._filters')

            <p class="text-sm text-slate-500">
                <span x-show="type === 'all'">Latest articles &amp; announcements</span>
                <span x-show="type === 'blog'" x-cloak>Written by our community</span>
                <span x-show="type === 'news'" x-cloak>Announcements from the team</span>
                <span x-show="type === 'paper'" x-cloak>Peer-reviewed publications</span>
            </p>
        </div>

        @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7 items-start">
                @foreach($posts as $post)
                    <div
                        x-show="shows('{{ $post->type }}')"
                        @if($post->type === 'paper') style="display: none" @endif
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-3"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                    >
                        @if($post->type === 'paper')
                            @include('components.paper-card', ['post' => $post])
                        @else
                            @include('components.blog-card', ['post' => $post])
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- Empty result for the active filter only --}}
            <div x-show="visibleCount === 0" x-cloak x-transition.opacity
                 class="text-center py-20 bg-white border border-dashed border-slate-300 rounded-3xl">
                <div class="w-16 h-16 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center mx-auto mb-5">
                    <i class="fa-solid fa-file-pen text-2xl text-cyan-600"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Nothing here yet</h3>
                <p class="text-slate-500 max-w-sm mx-auto">Nothing published under this filter — try another tab.</p>
            </div>
        @else
            <div class="text-center py-20 bg-white border border-dashed border-slate-300 rounded-3xl">
                <div class="w-16 h-16 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center mx-auto mb-5">
                    <i class="fa-solid fa-file-pen text-2xl text-cyan-600"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Nothing here yet</h3>
                <p class="text-slate-500 max-w-sm mx-auto">Check back soon for new articles, news and research.</p>
            </div>
        @endif
    </section>

    {{-- ===== Contribute CTA =====
         Extra top padding keeps this dark card clearly separated from the section
         above it rather than reading as one continuous block. --}}
    <section class="relative z-10 max-w-6xl mx-auto px-6 pt-6 pb-24 md:pt-12 md:pb-28">
        <div class="relative overflow-hidden rounded-3xl bg-slate-900 px-8 py-12 md:px-14 md:py-16">
            <div class="absolute -top-24 -right-16 w-80 h-80 bg-cyan-500/20 rounded-full blur-[110px]"></div>
            <div class="absolute -bottom-24 -left-16 w-80 h-80 bg-emerald-500/15 rounded-full blur-[110px]"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div class="max-w-xl">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight leading-tight mb-4">
                        Got something worth sharing?
                    </h2>
                    <p class="text-slate-400 leading-relaxed">
                        Members of the Robotics Corner community can publish here. Write up a project,
                        a tutorial or a lesson learned — our editors review every submission before it goes live.
                    </p>
                </div>
                <div class="shrink-0 flex flex-col sm:flex-row gap-3">
                    @auth
                        <a href="{{ route('blog.create') }}" class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl bg-gradient-to-r from-cyan-400 to-emerald-400 text-slate-900 font-bold hover:shadow-[0_0_28px_rgba(34,211,238,0.4)] hover:-translate-y-0.5 transition-all duration-300">
                            <i class="fa-solid fa-feather"></i> Write a post
                        </a>
                        <a href="{{ route('blog.mine') }}" class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl border border-white/15 text-slate-200 font-semibold hover:bg-white/10 transition-all duration-300">
                            My posts
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl bg-gradient-to-r from-cyan-400 to-emerald-400 text-slate-900 font-bold hover:shadow-[0_0_28px_rgba(34,211,238,0.4)] hover:-translate-y-0.5 transition-all duration-300">
                            <i class="fa-solid fa-right-to-bracket"></i> Sign in to write
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl border border-white/15 text-slate-200 font-semibold hover:bg-white/10 transition-all duration-300">
                            Create account
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
