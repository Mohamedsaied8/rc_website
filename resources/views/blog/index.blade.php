@extends('components.layout')

@section('title', 'Blog - Robotics Corner')
@section('description', 'Read the latest articles and insights from Robotics Corner on robotics, embedded systems, and software engineering.')

@section('content')
<section class="hero compact">
    <div class="container">
        <h1 class="section-title">Blog</h1>
        <p class="section-subtitle">Insights, tutorials, and updates from the world of robotics and technology</p>
    </div>
</section>

<section class="section">
    <div class="container">
        @if($posts->count() > 0)
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem;">
                @foreach($posts as $post)
                    <article class="blog-card" style="background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: transform 0.3s ease;">
                        @if($post->featured_image)
                            <div style="width: 100%; height: 200px; overflow: hidden;">
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        @else
                            <div style="width: 100%; height: 200px; background: linear-gradient(135deg, #2dd4bf 0%, #0891b2 100%);"></div>
                        @endif
                        
                        <div style="padding: 1.5rem;">
                            <div style="display: flex; gap: 1rem; margin-bottom: 1rem; font-size: 0.875rem; color: #64748b;">
                                <span>📅 {{ $post->formatted_date }}</span>
                                <span>⏱️ {{ $post->reading_time }} min read</span>
                            </div>
                            
                            <h3 style="color: #1e293b; margin-bottom: 0.75rem; font-size: 1.25rem;">
                                <a href="{{ route('blog.show', $post->slug) }}" style="text-decoration: none; color: inherit;">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            
                            @if($post->excerpt)
                                <p style="color: #64748b; margin-bottom: 1rem; line-height: 1.6;">
                                    {{ Str::limit($post->excerpt, 120) }}
                                </p>
                            @endif
                            
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="color: #64748b; font-size: 0.875rem;">By {{ $post->author }}</span>
                                <a href="{{ route('blog.show', $post->slug) }}" class="btn-small btn-solid" style="padding: 0.5rem 1rem; background: #2dd4bf; color: white; text-decoration: none; border-radius: 8px; font-weight: 600;">
                                    Read More →
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div style="margin-top: 3rem; display: flex; justify-content: center;">
                {{ $posts->links() }}
            </div>
        @else
            <div style="text-align: center; padding: 4rem 2rem; color: #64748b;">
                <p style="font-size: 1.5rem; margin-bottom: 1rem;">📝 No blog posts yet</p>
                <p>Check back soon for new articles and insights!</p>
            </div>
        @endif
    </div>
</section>

<style>
    .blog-card:hover {
        transform: translateY(-4px);
    }
    
    .blog-card h3 a:hover {
        color: #2dd4bf;
    }
    
    body.dark .blog-card {
        background: #0f172a !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3) !important;
    }
    
    body.dark .blog-card h3,
    body.dark .blog-card h3 a {
        color: #e2e8f0 !important;
    }
    
    body.dark .blog-card p,
    body.dark .blog-card span {
        color: #94a3b8 !important;
    }
</style>
@endsection
