@extends('admin.layout')

@section('title', 'Enrollments Management')
@section('page-title', 'Enrollments Management')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h3>All Enrollments</h3>
        <div style="display: flex; gap: 1rem; align-items: center;">
            <form method="GET" style="display: flex; gap: 0.5rem; align-items: center;">
                <input type="text" name="search" placeholder="Search by name or email..." class="form-input" value="{{ request('search') }}" style="width: 250px;">
                <select name="status" class="form-input" style="width: 150px;">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                <button type="submit" class="btn btn-secondary">Filter</button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary">Clear</a>
                @endif
            </form>
        </div>
    </div>

    @if($enrollments->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Program</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enrollments as $enrollment)
                <tr>
                    <td>
                        <strong>{{ $enrollment->first_name }} {{ $enrollment->last_name }}</strong>
                        <br>
                        <small style="color: #64748b;">{{ $enrollment->country }}, {{ $enrollment->city }}</small>
                    </td>
                    <td>
                        <a href="mailto:{{ $enrollment->email }}" style="color: #2dd4bf;">{{ $enrollment->email }}</a>
                    </td>
                    <td>
                        <a href="tel:{{ $enrollment->phone }}" style="color: #2dd4bf;">{{ $enrollment->phone }}</a>
                    </td>
                    <td>{{ $enrollment->selected_program }}</td>
                    <td>
                        @if($enrollment->payment_method)
                            <span class="badge badge-{{ $enrollment->payment_method === 'instapay' ? 'primary' : 'secondary' }}">
                                {{ ucfirst(str_replace('_', ' ', $enrollment->payment_method)) }}
                            </span>
                        @else
                            <span style="color: #64748b;">Not specified</span>
                        @endif
                    </td>
                    <td>
                        <span class="status-badge status-{{ $enrollment->status }}">
                            {{ ucfirst($enrollment->status) }}
                        </span>
                    </td>
                    <td>{{ $enrollment->created_at->format('M d, Y') }}</td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('admin.enrollments.show', $enrollment) }}" class="btn btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">View</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 1.5rem;">
            {{ $enrollments->appends(request()->query())->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 3rem; color: #64748b;">
            <h4>No enrollments found</h4>
            <p>No enrollments match your current filters.</p>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary" style="margin-top: 1rem;">Clear Filters</a>
            @endif
        </div>
    @endif
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
    <div class="card">
        <h3 style="margin-bottom: 1rem; color: #1e293b;">Quick Stats</h3>
        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
            <div style="display: flex; justify-content: space-between;">
                <span>Total:</span>
                <strong>{{ $enrollments->total() }}</strong>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span>Pending:</span>
                <span style="color: #f59e0b;">{{ $enrollments->where('status', 'pending')->count() }}</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span>Approved:</span>
                <span style="color: #10b981;">{{ $enrollments->where('status', 'approved')->count() }}</span>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <span>Rejected:</span>
                <span style="color: #ef4444;">{{ $enrollments->where('status', 'rejected')->count() }}</span>
            </div>
        </div>
    </div>

    <div class="card">
        <h3 style="margin-bottom: 1rem; color: #1e293b;">Recent Activity</h3>
        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
            @foreach($enrollments->take(5) as $enrollment)
            <div style="padding: 0.5rem; background: #f8fafc; border-radius: 6px; font-size: 0.9rem;">
                <strong>{{ $enrollment->first_name }} {{ $enrollment->last_name }}</strong>
                <br>
                <small style="color: #64748b;">{{ $enrollment->created_at->diffForHumans() }}</small>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
