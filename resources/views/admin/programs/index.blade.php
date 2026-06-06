@extends('admin.layout')

@section('title', 'Programs Management')
@section('page-title', 'Programs Management')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h3>All Programs</h3>
        <a href="{{ route('admin.programs.create') }}" class="btn btn-primary">Add New Program</a>
    </div>

    @if($programs->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Duration</th>
                    <th>Price</th>
                    <th>Courses</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($programs as $program)
                <tr>
                    <td>
                        <strong>{{ $program->title }}</strong>
                        <br>
                        <small style="color: #64748b;">{{ Str::limit($program->short_description, 50) }}</small>
                    </td>
                    <td>
                        <code style="background: #f1f5f9; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.8rem;">{{ $program->slug }}</code>
                    </td>
                    <td>{{ $program->duration }}</td>
                    <td>{{ $program->currency }} {{ number_format($program->price, 2) }}</td>
                    <td>
                        @if($program->courses->count() > 0)
                            <span style="background: #e0f2fe; color: #0369a1; padding: 0.25rem 0.5rem; border-radius: 12px; font-size: 0.8rem;">{{ $program->courses->count() }} courses</span>
                        @else
                            <span style="color: #64748b; font-style: italic;">No courses</span>
                        @endif
                    </td>
                    <td>
                        <span class="status-badge {{ $program->is_active ? 'status-approved' : 'status-pending' }}">
                            {{ $program->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('admin.programs.show', $program) }}" class="btn btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">View</a>
                            <a href="{{ route('admin.programs.edit', $program) }}" class="btn btn-primary" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">Edit</a>
                            <form method="POST" action="{{ route('admin.programs.destroy', $program) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this program?')">
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
            {{ $programs->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 3rem; color: #64748b;">
            <h4>No programs found</h4>
            <p>Get started by creating your first program.</p>
            <a href="{{ route('admin.programs.create') }}" class="btn btn-primary" style="margin-top: 1rem;">Create First Program</a>
        </div>
    @endif
</div>
@endsection
