@extends('components.layout')

@section('title', 'Blog - Robotics Corner')
@section('description', 'Read the latest articles and insights from Robotics Corner on robotics, embedded systems, and software engineering.')

@section('content')
    @include('components.page-hero', [
        'title' => 'Blog',
        'subtitle' => 'Insights, tutorials, and updates from the world of robotics and technology'
    ])

    <section class="relative z-10 max-w-6xl mx-auto px-6 py-16">
        @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $post)
                    <article class="bg-white shadow-sm border border-slate-200 rounded-2xl overflow-hidden hover:border-cyan-400/20 hover:-translate-y-1 transition-all duration-300 group">
                        @if($post->featured_image)
                            <div class="w-full h-48 overflow-hidden relative">
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-cyan-400/20 to-emerald-400/20 flex items-center justify-center">
                                <i class="fa-solid fa-newspaper text-4xl text-cyan-600/50"></i>
                            </div>
                        @endif
                        
                        <div class="p-6">
                            <div class="flex items-center gap-4 text-xs font-semibold uppercase tracking-widest text-slate-500 mb-3">
                                <span class="flex items-center gap-1.5"><i class="fa-regular fa-calendar text-cyan-600"></i> {{ $post->formatted_date }}</span>
                                <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock text-emerald-600"></i> {{ $post->reading_time }} min read</span>
                            </div>
                            
                            <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-cyan-600 transition-colors line-clamp-2">
                                <a href="{{ route('blog.show', $post->slug) }}" class="focus:outline-none">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                    {{ $post->title }}
                                </a>
                            </h3>
                            
                            @if($post->excerpt)
                                <p class="text-slate-600 text-sm leading-relaxed mb-6 line-clamp-3">
                                    {{ Str::limit($post->excerpt, 120) }}
                                </p>
                            @endif
                            
                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-white/5 text-sm">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-cyan-100 flex items-center justify-center">
                                        <i class="fa-solid fa-user text-cyan-600 text-[10px]"></i>
                                    </div>
                                    <span class="text-slate-500">{{ $post->author }}</span>
                                </div>
                                <span class="text-cyan-600 font-medium group-hover:translate-x-1 transition-transform">Read &rarr;</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                {{ $posts->links() }}
            </div>
        @else
            <div class="text-center py-24 bg-white border border-slate-200 rounded-2xl">
                <div class="w-16 h-16 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-file-pen text-2xl text-cyan-600"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">No blog posts yet</h3>
                <p class="text-slate-600">Check back soon for new articles and insights!</p>
            </div>
        @endif
    </section>
@endsection
