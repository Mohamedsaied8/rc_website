@extends('admin.layout')

@section('title', 'Create Course')
@section('page-title', 'Create New Course')

@section('content')
<div class="card">
    <form method="POST" action="{{ route('admin.courses.store') }}">
        @csrf
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
            <div class="form-group">
                <label for="title" class="form-label">Course Title *</label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title') }}" required>
                @error('title')
                    <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug" class="form-label">Slug *</label>
                <input type="text" id="slug" name="slug" class="form-input" value="{{ old('slug') }}" required>
                @error('slug')
                    <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="short_description" class="form-label">Short Description *</label>
            <textarea id="short_description" name="short_description" class="form-textarea" rows="3" required>{{ old('short_description') }}</textarea>
            @error('short_description')
                <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Full Description *</label>
            <textarea id="description" name="description" class="form-textarea" rows="5" required>{{ old('description') }}</textarea>
            @error('description')
                <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
            <div class="form-group">
                <label for="duration" class="form-label">Duration *</label>
                <input type="text" id="duration" name="duration" class="form-input" value="{{ old('duration') }}" placeholder="e.g., 12 weeks" required>
                @error('duration')
                    <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="price" class="form-label">Price *</label>
                <input type="number" id="price" name="price" class="form-input" value="{{ old('price') }}" step="0.01" min="0" required>
                @error('price')
                    <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="currency" class="form-label">Currency *</label>
                <select id="currency" name="currency" class="form-input" required>
                    @foreach(\App\Helpers\CurrencyHelper::getCurrencies() as $code => $name)
                        <option value="{{ $code }}" {{ old('currency', 'USD') === $code ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
                @error('currency')
                    <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="sort_order" class="form-label">Sort Order</label>
                <input type="number" id="sort_order" name="sort_order" class="form-input" value="{{ old('sort_order', 0) }}" min="0">
                @error('sort_order')
                    <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
            <div class="form-group">
                <label for="image" class="form-label">Image URL</label>
                <input type="url" id="image" name="image" class="form-input" value="{{ old('image') }}">
                @error('image')
                    <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="video_url" class="form-label">Video URL</label>
                <input type="url" id="video_url" name="video_url" class="form-input" value="{{ old('video_url') }}">
                @error('video_url')
                    <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Topics *</label>
            <div id="topics-container">
                <div style="display: flex; gap: 0.5rem; margin-bottom: 0.5rem;">
                    <input type="text" name="topics[]" class="form-input" placeholder="Enter a topic" required>
                    <button type="button" onclick="removeTopic(this)" class="btn btn-danger" style="padding: 0.5rem;">Remove</button>
                </div>
            </div>
            <button type="button" onclick="addTopic()" class="btn btn-secondary" style="margin-top: 0.5rem;">Add Topic</button>
            @error('topics')
                <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Associated Programs</label>
            @if($programs->count() > 0)
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 0.5rem;">
                    @foreach($programs as $program)
                    <label style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem; border: 1px solid #e2e8f0; border-radius: 8px; cursor: pointer;">
                        <input type="checkbox" name="programs[]" value="{{ $program->id }}" {{ in_array($program->id, old('programs', [])) ? 'checked' : '' }}>
                        <span>{{ $program->title }}</span>
                    </label>
                    @endforeach
                </div>
            @else
                <p style="color: #64748b; font-style: italic;">No programs available. Create a program first.</p>
            @endif
        </div>

        <div class="form-group">
            <label style="display: flex; align-items: center; gap: 0.5rem;">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                <span>Active Course</span>
            </label>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Create Course</button>
            <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
function addTopic() {
    const container = document.getElementById('topics-container');
    const div = document.createElement('div');
    div.style.display = 'flex';
    div.style.gap = '0.5rem';
    div.style.marginBottom = '0.5rem';
    div.innerHTML = `
        <input type="text" name="topics[]" class="form-input" placeholder="Enter a topic" required>
        <button type="button" onclick="removeTopic(this)" class="btn btn-danger" style="padding: 0.5rem;">Remove</button>
    `;
    container.appendChild(div);
}

function removeTopic(button) {
    button.parentElement.remove();
}

// Auto-generate slug from title
document.getElementById('title').addEventListener('input', function() {
    const title = this.value;
    const slug = title.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim('-');
    document.getElementById('slug').value = slug;
});
</script>
@endsection
