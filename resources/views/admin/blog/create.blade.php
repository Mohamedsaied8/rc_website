@extends('admin.layout')

@section('title', 'Create Blog Post')
@section('page-title', 'Create New Blog Post')

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label" for="title">Title *</label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title') }}" required>
                @error('title')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="excerpt">Excerpt</label>
                <textarea id="excerpt" name="excerpt" class="form-textarea" rows="3"
                    placeholder="Brief summary of the post...">{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="content">Content *</label>
                <textarea id="content" name="content" class="form-textarea" rows="15"
                    required>{{ old('content') }}</textarea>
                @error('content')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="author">Author</label>
                <input type="text" id="author" name="author" class="form-input"
                    value="{{ old('author', 'Robotics Corner') }}">
                @error('author')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="featured_image">Featured Image</label>
                <input type="file" id="featured_image" name="featured_image" class="form-input" accept="image/*">
                <small style="color: #64748b;">Recommended size: 1200x630px (Max 5MB)</small>
                @error('featured_image')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Additional Images</label>
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
                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                </select>
                @error('status')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary">Create Post</button>
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