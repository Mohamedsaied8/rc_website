@extends('components.layout')

@section('title', $post->title . ' - Robotics Corner Blog')
@section('description', $post->excerpt ?? Str::limit(strip_tags($post->content), 160))

@section('content')
    <article class="section">
        <div class="container" style="max-width: 800px;">
            <!-- Post Header -->
            <div style="margin-bottom: 2rem;">
                <h1 style="font-size: 2.5rem; color: #1e293b; margin-bottom: 1rem; line-height: 1.2;">{{ $post->title }}
                </h1>

                <div
                    style="display: flex; flex-wrap: wrap; gap: 1.5rem; color: #64748b; font-size: 0.9rem; margin-bottom: 1.5rem;">
                    <span>✍️ By {{ $post->author }}</span>
                    <span>📅 {{ $post->formatted_date }}</span>
                    <span>⏱️ {{ $post->reading_time }} min read</span>
                </div>
            </div>

            <!-- Featured Image -->
            @if($post->featured_image)
                <div style="margin-bottom: 2rem; border-radius: 12px; overflow: hidden;">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                        style="width: 100%; height: auto;">
                </div>
            @endif

            <!-- Post Content -->
            <div class="post-content" style="line-height: 1.8; color: #374151; font-size: 1.1rem;">
                {!! nl2br(e($post->content)) !!}
            </div>

            <!-- Additional Images -->
            @if($post->images->count() > 0)
                <div style="margin-top: 3rem;">
                    <h3 style="color: #1e293b; margin-bottom: 1.5rem;">Gallery</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                        @foreach($post->images as $image)
                            <div style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->caption }}"
                                    style="width: 100%; height: auto; display: block;">
                                @if($image->caption)
                                    <div style="padding: 0.75rem; background: #f8fafc; color: #64748b; font-size: 0.9rem;">
                                        {{ $image->caption }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Back to Blog -->
            <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid #e2e8f0;">
                <a href="{{ route('blog.index') }}" style="color: #2dd4bf; text-decoration: none; font-weight: 600;">
                    ← Back to Blog
                </a>
            </div>
        </div>
    </article>

    <!-- Related Posts -->
    @if($relatedPosts->count() > 0)
        <section class="section" style="background: #f8fafc;">
            <div class="container">
                <h2 class="section-title">Related Articles</h2>
                <div
                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; margin-top: 2rem;">
                    @foreach($relatedPosts as $relatedPost)
                        <article class="blog-card"
                            style="background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                            @if($relatedPost->featured_image)
                                <div style="width: 100%; height: 150px; overflow: hidden;">
                                    <img src="{{ asset('storage/' . $relatedPost->featured_image) }}" alt="{{ $relatedPost->title }}"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            @endif

                            <div style="padding: 1.5rem;">
                                <h3 style="color: #1e293b; margin-bottom: 0.75rem; font-size: 1.1rem;">
                                    <a href="{{ route('blog.show', $relatedPost->slug) }}"
                                        style="text-decoration: none; color: inherit;">
                                        {{ $relatedPost->title }}
                                    </a>
                                </h3>

                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; font-size: 0.875rem; color: #64748b;">
                                    <span>{{ $relatedPost->formatted_date }}</span>
                                    <a href="{{ route('blog.show', $relatedPost->slug) }}"
                                        style="color: #2dd4bf; text-decoration: none; font-weight: 600;">
                                        Read →
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <style>
        .post-content p {
            margin-bottom: 1.5rem;
        }

        .post-content h2 {
            font-size: 1.75rem;
            color: #1e293b;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .post-content h3 {
            font-size: 1.5rem;
            color: #1e293b;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }

        body.dark .post-content {
            color: #cbd5e1 !important;
        }

        body.dark .post-content h2,
        body.dark .post-content h3,
        body.dark h1 {
            color: #e2e8f0 !important;
        }

        body.dark .blog-card {
            background: #0f172a !important;
        }

        body.dark .blog-card h3 a {
            color: #e2e8f0 !important;
        }
    </style>
@endsection