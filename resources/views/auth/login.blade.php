@extends('components.layout')

@section('title', 'Sign In - Robotics Corner')

@section('content')
<div class="relative min-h-screen pt-28 pb-16 bg-slate-50 flex items-center justify-center overflow-hidden selection:bg-cyan-500/20">
    <!-- Ambient background effects (match site hero) -->
    <div class="absolute top-1/4 -left-32 w-[500px] h-[500px] bg-cyan-500/15 rounded-full blur-[128px] pointer-events-none" aria-hidden="true"></div>
    <div class="absolute bottom-1/4 -right-32 w-[400px] h-[400px] bg-emerald-500/10 rounded-full blur-[128px] pointer-events-none" aria-hidden="true"></div>

    <div class="relative z-10 w-full max-w-md px-6">

        <div class="mb-8 text-center">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">Welcome Back</h1>
            <p class="text-slate-500 text-sm">Sign in to your account to continue your enrollment.</p>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl shadow-xl shadow-slate-200/60 p-8">
            <form method="POST" action="{{ route('login.store') }}" id="rc-login-form">
                @csrf

                @if(session('status'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- JS (SSO) errors --}}
                <div id="rc-auth-error" class="hidden mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm"></div>

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

                <div class="space-y-5">
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 focus:bg-white transition-colors" placeholder="student@example.com">
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                            <a href="{{ route('password.request') }}" class="text-xs font-medium text-cyan-600 hover:text-cyan-700 transition-colors">Forgot password?</a>
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </span>
                            <input id="password" type="password" name="password" required class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 focus:bg-white transition-colors" placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-cyan-500 to-emerald-500 text-white font-bold rounded-xl shadow-lg shadow-cyan-500/25 hover:shadow-cyan-500/40 hover:-translate-y-0.5 transition-all flex justify-center items-center gap-2">
                        <span>Sign In</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-slate-500">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="font-medium text-cyan-600 hover:text-cyan-700 transition-colors">Create one</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
