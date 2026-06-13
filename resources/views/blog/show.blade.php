@extends('components.layout')

@section('title', $post->title . ' - Robotics Corner Blog')
@section('description', $post->excerpt ?? Str::limit(strip_tags($post->content), 160))

@section('content')
    <!-- Post Header/Hero -->
    <section class="relative pt-32 pb-16 overflow-hidden">
        <div class="absolute inset-0 z-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-cyan-900/20 via-[#0A0A0A] to-slate-50"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
            <div class="flex items-center justify-center gap-4 text-xs font-semibold uppercase tracking-widest text-slate-600 mb-6">
                <span class="flex items-center gap-1.5 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-full"><i class="fa-regular fa-calendar text-cyan-600"></i> {{ $post->formatted_date }}</span>
                <span class="flex items-center gap-1.5 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-full"><i class="fa-regular fa-clock text-emerald-600"></i> {{ $post->reading_time }} min read</span>
            </div>
            
            <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.05] mb-8">
                {{ $post->title }}
            </h1>
            
            <div class="flex items-center justify-center gap-3">
                <div class="w-10 h-10 rounded-full bg-cyan-100 border border-cyan-500/30 flex items-center justify-center">
                    <i class="fa-solid fa-user text-cyan-600 text-sm"></i>
                </div>
                <div class="text-left">
                    <p class="text-sm font-medium text-slate-900">{{ $post->author }}</p>
                    <p class="text-xs text-slate-600">Author</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="relative z-10 max-w-4xl mx-auto px-6 pb-24">
        <div class="bg-white border border-slate-200 shadow-sm rounded-3xl p-6 md:p-12 shadow-2xl">
            
            <!-- Featured Image -->
            @if($post->featured_image)
                <div class="mb-12 rounded-2xl overflow-hidden border border-slate-200 shadow-xl shadow-black/50">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-auto object-cover">
                </div>
            @endif

            <!-- Prose Content -->
            <div class="prose prose-invert prose-cyan max-w-none 
                        prose-headings:text-slate-900 prose-headings:font-bold prose-headings:tracking-tight
                        prose-h2:text-3xl prose-h2:mt-12 prose-h2:mb-6 prose-h2:border-b prose-h2:border-slate-200 prose-h2:pb-4
                        prose-h3:text-2xl prose-h3:mt-8 prose-h3:mb-4
                        prose-p:text-slate-500 prose-p:leading-relaxed prose-p:mb-6 prose-p:text-lg
                        prose-a:text-cyan-600 prose-a:no-underline hover:prose-a:underline
                        prose-strong:text-slate-900 prose-strong:font-semibold
                        prose-ul:list-disc prose-ul:text-slate-500 prose-ul:my-6 prose-ul:ml-6
                        prose-ol:list-decimal prose-ol:text-slate-500 prose-ol:my-6 prose-ol:ml-6
                        prose-li:mb-2
                        prose-blockquote:border-l-4 prose-blockquote:border-cyan-500 prose-blockquote:pl-6 prose-blockquote:italic prose-blockquote:text-slate-600 prose-blockquote:bg-white prose-blockquote:py-2 prose-blockquote:rounded-r-lg">
                {!! nl2br(e($post->content)) !!}
            </div>

            <!-- Additional Images Gallery -->
            @if($post->images->count() > 0)
                <div class="mt-16 pt-12 border-t border-slate-200">
                    <h3 class="text-2xl font-bold text-slate-900 mb-8">Gallery</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($post->images as $image)
                            <div class="group relative rounded-xl overflow-hidden border border-slate-200">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->caption }}" class="w-full h-auto transform group-hover:scale-105 transition-transform duration-500">
                                @if($image->caption)
                                    <div class="absolute inset-x-0 bottom-0 bg-slate-50/80 backdrop-blur-md p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                        <p class="text-sm text-slate-500">{{ $image->caption }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Footer Actions -->
            <div class="mt-16 pt-8 border-t border-slate-200 flex items-center justify-between">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-cyan-600 transition-colors group">
                    <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                    Back to Blog
                </a>
            </div>
        </div>
    </section>

    <!-- Related Posts -->
    @if($relatedPosts->count() > 0)
        <section class="relative z-10 bg-white border-t border-slate-200 py-12 md:py-24">
            <div class="max-w-6xl mx-auto px-6">
                <div class="flex items-center justify-between mb-12">
                    <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Related Articles</h2>
                    <a href="{{ route('blog.index') }}" class="text-sm font-semibold text-cyan-600 hover:text-cyan-500">View All</a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedPosts as $relatedPost)
                        <article class="bg-white shadow-sm border border-slate-200 rounded-2xl overflow-hidden hover:border-cyan-400/20 hover:-translate-y-1 transition-all duration-300 group">
                            @if($relatedPost->featured_image)
                                <div class="w-full h-40 overflow-hidden relative">
                                    <img src="{{ asset('storage/' . $relatedPost->featured_image) }}" alt="{{ $relatedPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    </div>
                            @endif

                            <div class="p-6">
                                <h3 class="text-lg font-bold text-slate-900 mb-4 group-hover:text-cyan-600 transition-colors line-clamp-2">
                                    <a href="{{ route('blog.show', $relatedPost->slug) }}" class="focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        {{ $relatedPost->title }}
                                    </a>
                                </h3>

                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-slate-500 text-xs font-semibold uppercase tracking-wider">{{ $relatedPost->formatted_date }}</span>
                                    <span class="text-cyan-600 font-medium group-hover:translate-x-1 transition-transform">Read &rarr;</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection