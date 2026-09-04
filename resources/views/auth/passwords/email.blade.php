@extends('components.layout')

@section('title', 'Reset Password - Robotics Corner')

@section('content')
<div class="relative min-h-screen pt-28 pb-16 bg-slate-50 flex items-center justify-center overflow-hidden selection:bg-cyan-500/20">
    <div class="absolute top-1/4 -left-32 w-[500px] h-[500px] bg-cyan-500/15 rounded-full blur-[128px] pointer-events-none" aria-hidden="true"></div>
    <div class="absolute bottom-1/4 -right-32 w-[400px] h-[400px] bg-emerald-500/10 rounded-full blur-[128px] pointer-events-none" aria-hidden="true"></div>

    <div class="relative z-10 w-full max-w-md px-6">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">Forgot your password?</h1>
            <p class="text-slate-500 text-sm">Enter your email and we'll send you a reset link.</p>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl shadow-xl shadow-slate-200/60 p-8">
            @if(session('status'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <div id="rc-auth-error" class="hidden mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm"></div>
            <div id="rc-auth-success" class="hidden mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm">
                If an account exists for that email, a password reset link is on its way.
            </div>

            {{-- Server-side (legacy) validation errors --}}
            @if($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" id="rc-forgot-form">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 focus:bg-white transition-colors" placeholder="student@example.com">
                </div>
                <div class="mt-8">
                    <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-cyan-500 to-emerald-500 text-white font-bold rounded-xl shadow-lg shadow-cyan-500/25 hover:shadow-cyan-500/40 hover:-translate-y-0.5 transition-all">
                        Send Reset Link
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-sm font-medium text-cyan-600 hover:text-cyan-700 transition-colors">Back to sign in</a>
            </div>
        </div>
    </div>
</div>
@endsection
