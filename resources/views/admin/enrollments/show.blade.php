@extends('admin.layout')

@section('title', 'Enrollment Details')
@section('page-title', 'Enrollment Details')

@section('content')
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
    <div class="card">
        <h3 style="margin-bottom: 1rem;">Personal Information</h3>
        
        <div style="display: grid; gap: 1rem;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div>
                    <strong>First Name:</strong>
                    <p>{{ $enrollment->first_name }}</p>
                </div>
                <div>
                    <strong>Last Name:</strong>
                    <p>{{ $enrollment->last_name }}</p>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div>
                    <strong>Email:</strong>
                    <p><a href="mailto:{{ $enrollment->email }}" style="color: #2dd4bf;">{{ $enrollment->email }}</a></p>
                </div>
                <div>
                    <strong>Phone:</strong>
                    <p><a href="tel:{{ $enrollment->phone }}" style="color: #2dd4bf;">{{ $enrollment->phone }}</a></p>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div>
                    <strong>Country:</strong>
                    <p>{{ $enrollment->country }}</p>
                </div>
                <div>
                    <strong>City:</strong>
                    <p>{{ $enrollment->city }}</p>
                </div>
            </div>
            
            <div>
                <strong>Education Level:</strong>
                <p>{{ $enrollment->education_level }}</p>
            </div>
        </div>
    </div>
    
    <div>
        <div class="card">
            <h3 style="margin-bottom: 1rem;">Enrollment Details</h3>
            <div style="display: grid; gap: 1rem;">
                <div>
                    <strong>Program:</strong>
                    <p>{{ $enrollment->selected_program }}</p>
                </div>
                <div>
                    <strong>Payment Method:</strong>
                    <p>
                        @if($enrollment->payment_method)
                            <span class="badge badge-{{ $enrollment->payment_method === 'instapay' ? 'primary' : 'secondary' }}">
                                {{ ucfirst(str_replace('_', ' ', $enrollment->payment_method)) }}
                            </span>
                        @else
                            <span style="color: #64748b;">Not specified</span>
                        @endif
                    </p>
                </div>
                @if($enrollment->payment_screenshot)
                <div>
                    <strong>Payment Screenshot:</strong>
                    <div style="margin-top: 0.5rem;">
                        <img src="{{ asset('storage/' . $enrollment->payment_screenshot) }}" 
                             alt="Payment Screenshot" 
                             style="max-width: 100%; max-height: 300px; border-radius: 8px; border: 1px solid #e2e8f0; cursor: pointer;"
                             onclick="window.open(this.src, '_blank')"
                             title="Click to view full size">
                        <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #64748b;">
                            <a href="{{ asset('storage/' . $enrollment->payment_screenshot) }}" target="_blank" style="color: #2dd4bf; text-decoration: none;">
                                View Full Size →
                            </a>
                        </p>
                    </div>
                </div>
                @endif
                <div>
                    <strong>Preferred Schedule:</strong>
                    <p>{{ $enrollment->preferred_schedule }}</p>
                </div>
                <div>
                    <strong>Status:</strong>
                    <p>
                        <span class="status-badge status-{{ $enrollment->status }}">
                            {{ ucfirst($enrollment->status) }}
                        </span>
                    </p>
                </div>
                <div>
                    <strong>Enrolled:</strong>
                    <p>{{ $enrollment->created_at->format('M d, Y \a\t g:i A') }}</p>
                </div>
            </div>
        </div>
        
        <div class="card">
            <h3 style="margin-bottom: 1rem;">Update Status</h3>
            <form method="POST" action="{{ route('admin.enrollments.update-status', $enrollment) }}">
                @csrf
                @method('PATCH')
                
                <div class="form-group">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-input" required>
                        <option value="pending" {{ $enrollment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $enrollment->status === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ $enrollment->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="completed" {{ $enrollment->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="admin_notes" class="form-label">Admin Notes</label>
                    <textarea id="admin_notes" name="admin_notes" class="form-textarea" rows="3" placeholder="Add notes about this enrollment...">{{ old('admin_notes', $enrollment->admin_notes) }}</textarea>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">Update Status</button>
            </form>
        </div>
    </div>
</div>

<div class="card" style="margin-top: 2rem;">
    <h3 style="margin-bottom: 1rem;">Experience & Motivation</h3>
    
    <div style="display: grid; gap: 1.5rem;">
        <div>
            <strong>Experience:</strong>
            <p style="white-space: pre-wrap; background: #f8fafc; padding: 1rem; border-radius: 8px; margin-top: 0.5rem;">{{ $enrollment->experience }}</p>
        </div>
        
        <div>
            <strong>Motivation:</strong>
            <p style="white-space: pre-wrap; background: #f8fafc; padding: 1rem; border-radius: 8px; margin-top: 0.5rem;">{{ $enrollment->motivation }}</p>
        </div>
        
        @if($enrollment->additional_notes)
        <div>
            <strong>Additional Notes:</strong>
            <p style="white-space: pre-wrap; background: #f8fafc; padding: 1rem; border-radius: 8px; margin-top: 0.5rem;">{{ $enrollment->additional_notes }}</p>
        </div>
        @endif
    </div>
</div>

@if($enrollment->admin_notes)
<div class="card" style="margin-top: 2rem;">
    <h3 style="margin-bottom: 1rem;">Admin Notes</h3>
    <p style="white-space: pre-wrap; background: #fef3c7; padding: 1rem; border-radius: 8px; border-left: 4px solid #f59e0b;">{{ $enrollment->admin_notes }}</p>
</div>
@endif

<div style="margin-top: 2rem;">
    <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary">← Back to Enrollments</a>
</div>
@endsection
