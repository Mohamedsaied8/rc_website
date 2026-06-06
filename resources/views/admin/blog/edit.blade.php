@extends('admin.layout')

@section('title', 'Edit Blog Post')
@section('page-title', 'Edit Blog Post')

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.blog.update', $post) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label" for="title">Title *</label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $post->title) }}"
                    required>
                @error('title')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="excerpt">Excerpt</label>
                <textarea id="excerpt" name="excerpt" class="form-textarea"
                    rows="3">{{ old('excerpt', $post->excerpt) }}</textarea>
                @error('excerpt')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="content">Content *</label>
                <textarea id="content" name="content" class="form-textarea" rows="15"
                    required>{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="author">Author</label>
                <input type="text" id="author" name="author" class="form-input" value="{{ old('author', $post->author) }}">
                @error('author')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="featured_image">Featured Image</label>
                @if($post->featured_image)
                    <div style="margin-bottom: 1rem;">
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Current featured image"
                            style="max-width: 300px; border-radius: 8px;">
                    </div>
                @endif
                <input type="file" id="featured_image" name="featured_image" class="form-input" accept="image/*">
                <small style="color: #64748b;">Upload a new image to replace the current one</small>
                @error('featured_image')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            @if($post->images->count() > 0)
                <div class="form-group">
                    <label class="form-label">Current Images</label>
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem;">
                        @foreach($post->images as $image)
                            <div style="border: 1px solid #d1d5db; border-radius: 8px; padding: 1rem;">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->caption }}"
                                    style="width: 100%; border-radius: 4px; margin-bottom: 0.5rem;">
                                @if($image->caption)
                                    <p style="font-size: 0.875rem; color: #64748b; margin-bottom: 0.5rem;">{{ $image->caption }}</p>
                                @endif
                                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                                    <input type="checkbox" name="remove_images[]" value="{{ $image->id }}">
                                    <span style="color: #dc2626; font-size: 0.875rem;">Remove this image</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="form-group">
                <label class="form-label">Add New Images</label>
                <div id="images-container">
                    <div class="image-upload-item" style="margin-bottom: 1rem;">
                        <input type="file" name="images[]" class="form-input" accept="image/*"
                            style="margin-bottom: 0.5rem;">
                        <input type="text" name="captions[]" class="form-input" placeholder="Image caption (optional)">
                    </div>
                </div>
                <button type="button" onclick="addImageField()" class="btn btn-secondary" style="margin-top: 0.5rem;">+ Add
                    Another Image</button>
            </div>

            <div class="form-group">
                <label class="form-label" for="status">Status *</label>
                <select id="status" name="status" class="form-input" required>
                    <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published
                    </option>
                </select>
                @error('status')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary">Update Post</button>
                <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        function addImageField() {
            const container = document.getElementById('images-container');
            const newItem = document.createElement('div');
            newItem.className = 'image-upload-item';
            newItem.style.marginBottom = '1rem';
            newItem.innerHTML = `
            <input type="file" name="images[]" class="form-input" accept="image/*" style="margin-bottom: 0.5rem;">
            <input type="text" name="captions[]" class="form-input" placeholder="Image caption (optional)">
            <button type="button" onclick="this.parentElement.remove()" class="btn btn-danger" style="margin-top: 0.5rem;">Remove</button>
        `;
            container.appendChild(newItem);
        }
    </script>
@endsection