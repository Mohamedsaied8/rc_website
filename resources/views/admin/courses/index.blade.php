@extends('admin.layout')

@section('title', 'Courses Management')
@section('page-title', 'Courses Management')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h3>All Courses</h3>
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">Add New Course</a>
    </div>

    @if($courses->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Duration</th>
                    <th>Price</th>
                    <th>Programs</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td>
                        <strong>{{ $course->title }}</strong>
                        <br>
                        <small style="color: #64748b;">{{ Str::limit($course->short_description, 50) }}</small>
                    </td>
                    <td>
                        <code style="background: #f1f5f9; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.8rem;">{{ $course->slug }}</code>
                    </td>
                    <td>{{ $course->duration }}</td>
                    <td>{{$course->currency}} {{ number_format($course->price, 2) }}</td>
                    <td>
                        @if($course->programs->count() > 0)
                            @foreach($course->programs as $program)
                                <span style="background: #e0f2fe; color: #0369a1; padding: 0.25rem 0.5rem; border-radius: 12px; font-size: 0.8rem; margin-right: 0.25rem; display: inline-block; margin-bottom: 0.25rem;">{{ $program->title }}</span>
                            @endforeach
                        @else
                            <span style="color: #64748b; font-style: italic;">No programs</span>
                        @endif
                    </td>
                    <td>
                        <span class="status-badge {{ $course->is_active ? 'status-approved' : 'status-pending' }}">
                            {{ $course->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('admin.courses.show', $course) }}" class="btn btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">View</a>
                            <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-primary" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">Edit</a>
                            <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this course?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 1.5rem;">
            {{ $courses->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 3rem; color: #64748b;">
            <h4>No courses found</h4>
            <p>Get started by creating your first course.</p>
            <a href="{{ route('admin.courses.create') }}" class="btn btn-primary" style="margin-top: 1rem;">Create First Course</a>
        </div>
    @endif
</div>
@endsection
