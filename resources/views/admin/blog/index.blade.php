@extends('admin.layout')

@section('title', 'Blog Posts')
@section('page-title', 'Blog Posts')

@section('content')
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="margin: 0;">All Blog Posts</h3>
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">+ New Post</a>
        </div>

        @if($posts->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Published</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                <strong>{{ $post->title }}</strong>
                                @if($post->featured_image)
                                    <br><small style="color: #64748b;">📷 Has featured image</small>
                                @endif
                                @if($post->images->count() > 0)
                                    <br><small style="color: #64748b;">🖼️ {{ $post->images->count() }} additional images</small>
                                @endif
                            </td>
                            <td>{{ $post->author }}</td>
                            <td>
                                @if($post->status === 'published')
                                    <span class="status-badge status-approved">Published</span>
                                @else
                                    <span class="status-badge status-pending">Draft</span>
                                @endif
                            </td>
                            <td>{{ $post->formatted_date ?? 'Not published' }}</td>
                            <td>
                                <div style="display: flex; gap: 0.5rem;">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-secondary" target="_blank"
                                        title="View">👁️</a>
                                    <a href="{{ route('admin.blog.edit', $post) }}" class="btn btn-primary" title="Edit">✏️</a>
                                    <form method="POST" action="{{ route('admin.blog.destroy', $post) }}" style="display: inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Delete">🗑️</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top: 2rem;">
                {{ $posts->links() }}
            </div>
        @else
            <div style="text-align: center; padding: 3rem; color: #64748b;">
                <p style="font-size: 1.2rem; margin-bottom: 1rem;">📝 No blog posts yet</p>
                <p>Create your first blog post to get started!</p>
                <a href="{{ route('admin.blog.create') }}" class="btn btn-primary" style="margin-top: 1rem;">Create First
                    Post</a>
            </div>
        @endif
    </div>
@endsection