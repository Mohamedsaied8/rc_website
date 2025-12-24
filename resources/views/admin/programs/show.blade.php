@extends('admin.layout')

@section('title', 'View Program')
@section('page-title', 'Program Details: ' . $program->title)

@section('content')
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
    <div class="card">
        <h3 style="margin-bottom: 1rem;">Program Information</h3>
        
        <div style="display: grid; gap: 1rem;">
            <div>
                <strong>Title:</strong>
                <p>{{ $program->title }}</p>
            </div>
            
            <div>
                <strong>Slug:</strong>
                <p><code style="background: #f1f5f9; padding: 0.25rem 0.5rem; border-radius: 4px;">{{ $program->slug }}</code></p>
            </div>
            
            <div>
                <strong>Short Description:</strong>
                <p>{{ $program->short_description }}</p>
            </div>
            
            <div>
                <strong>Full Description:</strong>
                <p style="white-space: pre-wrap;">{{ $program->description }}</p>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                <div>
                    <strong>Duration:</strong>
                    <p>{{ $program->duration }}</p>
                </div>
                <div>
                    <strong>Price:</strong>
                    <p>${{ number_format($program->price, 2) }}</p>
                </div>
                <div>
                    <strong>Sort Order:</strong>
                    <p>{{ $program->sort_order }}</p>
                </div>
            </div>
            
            @if($program->image)
            <div>
                <strong>Image URL:</strong>
                <p><a href="{{ $program->image }}" target="_blank" style="color: #2dd4bf;">{{ $program->image }}</a></p>
            </div>
            @endif
            
            @if($program->video_url)
            <div>
                <strong>Video URL:</strong>
                <p><a href="{{ $program->video_url }}" target="_blank" style="color: #2dd4bf;">{{ $program->video_url }}</a></p>
            </div>
            @endif
            
            <div>
                <strong>Status:</strong>
                <p>
                    <span class="status-badge {{ $program->is_active ? 'status-approved' : 'status-pending' }}">
                        {{ $program->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </p>
            </div>
        </div>
    </div>
    
    <div>
        <div class="card">
            <h3 style="margin-bottom: 1rem;">Topics</h3>
            @if($program->topics && count($program->topics) > 0)
                <ul style="list-style: none; padding: 0;">
                    @foreach($program->topics as $topic)
                    <li style="padding: 0.5rem 0; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; gap: 0.5rem;">
                        <span style="color: #2dd4bf;">✓</span>
                        {{ $topic }}
                    </li>
                    @endforeach
                </ul>
            @else
                <p style="color: #64748b; font-style: italic;">No topics defined</p>
            @endif
        </div>
        
        <div class="card">
            <h3 style="margin-bottom: 1rem;">Associated Courses</h3>
            @if($program->courses->count() > 0)
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    @foreach($program->courses as $course)
                    <div style="background: #f8fafc; padding: 0.75rem; border-radius: 8px; border-left: 4px solid #2dd4bf;">
                        <strong>{{ $course->title }}</strong>
                        <br>
                        <small style="color: #64748b;">{{ $course->short_description }}</small>
                    </div>
                    @endforeach
                </div>
            @else
                <p style="color: #64748b; font-style: italic;">No courses associated</p>
            @endif
        </div>
        
        <div class="card">
            <h3 style="margin-bottom: 1rem;">Actions</h3>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <a href="{{ route('admin.programs.edit', $program) }}" class="btn btn-primary">Edit Program</a>
                <a href="{{ route('programs.show', $program->slug) }}" target="_blank" class="btn btn-secondary">View on Site</a>
                <form method="POST" action="{{ route('admin.programs.destroy', $program) }}" onsubmit="return confirm('Are you sure you want to delete this program?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="width: 100%;">Delete Program</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div style="margin-top: 2rem;">
    <a href="{{ route('admin.programs.index') }}" class="btn btn-secondary">← Back to Programs</a>
</div>
@endsection
