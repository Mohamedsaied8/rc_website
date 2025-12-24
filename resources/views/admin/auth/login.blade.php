@extends('admin.layout')

@section('title', 'Admin Login')

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h1>🤖 Admin Login</h1>
            <p>Robotics Corner Admin Panel</p>
        </div>

        <form method="POST" action="{{ route('admin.login.store') }}">
            @csrf
            
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-input" required>
                @error('password')
                    <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">
                Login to Admin Panel
            </button>
        </form>

        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e2e8f0; text-align: center; color: #64748b; font-size: 0.875rem;">
            <p><strong>Demo Credentials:</strong></p>
            <p>Email: admin@roboticscorner.com</p>
            <p>Password: admin123</p>
        </div>
    </div>
</div>
@endsection
