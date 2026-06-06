@extends('admin.layout')

@section('title', 'View Course')
@section('page-title', 'Course Details: ' . $course->title)

@section('content')
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
        <div class="card">
            <h3 style="margin-bottom: 1rem;">Course Information</h3>

            <div style="display: grid; gap: 1rem;">
                <div>
                    <strong>Title:</strong>
                    <p>{{ $course->title }}</p>
                </div>

                <div>
                    <strong>Slug:</strong>
                    <p><code
                            style="background: #f1f5f9; padding: 0.25rem 0.5rem; border-radius: 4px;">{{ $course->slug }}</code>
                    </p>
                </div>

                <div>
                    <strong>Short Description:</strong>
                    <p>{{ $course->short_description }}</p>
                </div>

                <div>
                    <strong>Full Description:</strong>
                    <p style="white-space: pre-wrap;">{{ $course->description }}</p>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                    <div>
                        <strong>Duration:</strong>
                        <p>{{ $course->duration }}</p>
                    </div>
                    <div>
                        <strong>Price:</strong>
                        <p>${{ number_format($course->price, 2) }}</p>
                    </div>
                    <div>
                        <strong>Sort Order:</strong>
                        <p>{{ $course->sort_order }}</p>
                    </div>
                </div>

                @if($course->image)
                    <div>
                        <strong>Image URL:</strong>
                        <p><a href="{{ $course->image }}" target="_blank" style="color: #2dd4bf;">{{ $course->image }}</a></p>
                    </div>
                @endif

                @if($course->video_url)
                    <div>
                        <strong>Video URL:</strong>
                        <p><a href="{{ $course->video_url }}" target="_blank"
                                style="color: #2dd4bf;">{{ $course->video_url }}</a></p>
                    </div>
                @endif

                <div>
                    <strong>Status:</strong>
                    <p>
                        <span class="status-badge {{ $course->is_active ? 'status-approved' : 'status-pending' }}">
                            {{ $course->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div>
            <div class="card">
                <h3 style="margin-bottom: 1rem;">Topics</h3>
                @if($course->topics && count($course->topics) > 0)
                    <ul style="list-style: none; padding: 0;">
                        @foreach($course->topics as $topic)
                            <li
                                style="padding: 0.5rem 0; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; gap: 0.5rem;">
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
                <h3 style="margin-bottom: 1rem;">Associated Programs</h3>
                @if($course->programs->count() > 0)
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        @foreach($course->programs as $program)
                            <div style="background: #f8fafc; padding: 0.75rem; border-radius: 8px; border-left: 4px solid #2dd4bf;">
                                <strong>{{ $program->title }}</strong>
                                <br>
                                <small style="color: #64748b;">{{ $program->short_description }}</small>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="color: #64748b; font-style: italic;">No programs associated</p>
                @endif
            </div>

            <div class="card">
                <h3 style="margin-bottom: 1rem;">Actions</h3>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-primary">Edit Course</a>

                    <form method="POST" action="{{ route('admin.courses.destroy', $course) }}"
                        onsubmit="return confirm('Are you sure you want to delete this course?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="width: 100%;">Delete Course</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top: 2rem;">
        <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">← Back to Courses</a>
    </div>
@endsection