@extends('admin.layout')

@section('title', 'Edit Setting')
@section('page-title', 'Edit Setting: ' . ucwords(str_replace('_', ' ', $setting->key)))

@section('content')
<div class="card">
    <form method="POST" action="{{ route('admin.settings.update', $setting) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="key" class="form-label">Setting Key</label>
            <input type="text" id="key" name="key" class="form-input" value="{{ $setting->key }}" readonly style="background: #f9fafb;">
            <small style="color: #6b7280; font-size: 0.875rem;">Setting key cannot be changed</small>
        </div>

        <div class="form-group">
            <label for="type" class="form-label">Type</label>
            <input type="text" id="type" name="type" class="form-input" value="{{ $setting->type }}" readonly style="background: #f9fafb;">
            <small style="color: #6b7280; font-size: 0.875rem;">Setting type cannot be changed</small>
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <input type="text" id="description" name="description" class="form-input" value="{{ $setting->description }}" readonly style="background: #f9fafb;">
            <small style="color: #6b7280; font-size: 0.875rem;">Description cannot be changed</small>
        </div>

        <div class="form-group">
            <label for="value" class="form-label">Value *</label>
            @if($setting->type === 'textarea')
                <textarea id="value" name="value" class="form-textarea" rows="4" required>{{ old('value', $setting->value) }}</textarea>
            @elseif($setting->type === 'url')
                <input type="url" id="value" name="value" class="form-input" value="{{ old('value', $setting->value) }}" required>
            @elseif($setting->type === 'email')
                <input type="email" id="value" name="value" class="form-input" value="{{ old('value', $setting->value) }}" required>
            @elseif($setting->type === 'phone')
                <input type="tel" id="value" name="value" class="form-input" value="{{ old('value', $setting->value) }}" required>
            @else
                <input type="text" id="value" name="value" class="form-input" value="{{ old('value', $setting->value) }}" required>
            @endif
            @error('value')
                <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn-primary">Update Setting</button>
            <a href="{{ route('admin.settings.index') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
