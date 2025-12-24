@extends('admin.layout')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-number">{{ $stats['total_enrollments'] }}</div>
        <div class="stat-label">Total Enrollments</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $stats['pending_enrollments'] }}</div>
        <div class="stat-label">Pending Enrollments</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $stats['approved_enrollments'] }}</div>
        <div class="stat-label">Approved Enrollments</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $stats['total_courses'] }}</div>
        <div class="stat-label">Total Courses</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $stats['total_programs'] }}</div>
        <div class="stat-label">Total Programs</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $stats['active_courses'] }}</div>
        <div class="stat-label">Active Courses</div>
    </div>
</div>

<div class="card">
    <h3 style="margin-bottom: 1rem; color: #1e293b;">Recent Enrollments</h3>
    @if($recent_enrollments->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Program</th>
                    <th>Course</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recent_enrollments as $enrollment)
                <tr>
                    <td>{{ $enrollment->first_name }} {{ $enrollment->last_name }}</td>
                    <td>{{ $enrollment->email }}</td>
                    <td>{{ $enrollment->selected_program }}</td>
                    <td>{{ $enrollment->selected_course }}</td>
                    <td>
                        <span class="status-badge status-{{ $enrollment->status }}">
                            {{ ucfirst($enrollment->status) }}
                        </span>
                    </td>
                    <td>{{ $enrollment->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.enrollments.show', $enrollment) }}" class="btn btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="color: #64748b; text-align: center; padding: 2rem;">No enrollments found.</p>
    @endif
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
    <div class="card">
        <h3 style="margin-bottom: 1rem; color: #1e293b;">Quick Actions</h3>
        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
            <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">Add New Course</a>
            <a href="{{ route('admin.programs.create') }}" class="btn btn-primary">Add New Program</a>
            <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary">View All Enrollments</a>
        </div>
    </div>

    <div class="card">
        <h3 style="margin-bottom: 1rem; color: #1e293b;">System Status</h3>
        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
            <div style="display: flex; justify-content: space-between;">
                <span>Database:</span>
                <span style="color: #10b981;">✓ Connected</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span>Admin Panel:</span>
                <span style="color: #10b981;">✓ Active</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span>Enrollment System:</span>
                <span style="color: #10b981;">✓ Working</span>
            </div>
        </div>
    </div>
</div>
@endsection
