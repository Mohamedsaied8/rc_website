@extends('admin.layout')

@section('title', 'Admin Login')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6 bg-[#0A0A0A] relative z-10 selection:bg-cyan-500/30">
    
    <div class="w-full max-w-md bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-3xl p-8 sm:p-10 shadow-2xl relative overflow-hidden">
        
        <!-- Glowing Orb -->
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-cyan-500/20 rounded-full blur-3xl z-[-1]"></div>
        <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-emerald-500/10 rounded-full blur-3xl z-[-1]"></div>

        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-cyan-400/20 to-emerald-400/10 border border-white/10 mb-6 shadow-[0_0_15px_rgba(34,211,238,0.15)]">
                <i class="fa-solid fa-user-shield text-2xl text-cyan-400"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Admin Portal</h1>
            <p class="text-slate-400 text-sm">Sign in to manage Robotics Corner</p>
        </div>

        <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-6">
            @csrf
            
            <div>
                <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full pl-11 pr-4 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors">
                </div>
                @error('email')
                    <p class="text-red-400 text-xs mt-2 flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                <div class="relative" x-data="{ show: false }">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input :type="show ? 'text' : 'password'" id="password" name="password" required
                        class="w-full pl-11 pr-12 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors">
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-500 hover:text-cyan-400 transition-colors">
                        <i class="fa-solid" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-400 text-xs mt-2 flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <button type="submit" class="w-full py-3.5 px-4 bg-gradient-to-r from-cyan-400 to-emerald-400 text-slate-900 font-bold rounded-xl hover:shadow-[0_0_20px_rgba(34,211,238,0.4)] hover:scale-[1.02] transition-all flex items-center justify-center gap-2 mt-4">
                <span>Sign In</span>
                <i class="fa-solid fa-arrow-right text-sm"></i>
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-white/10">
            <div class="p-4 rounded-xl bg-cyan-500/5 border border-cyan-500/10 text-center">
                <p class="text-xs text-slate-400 mb-2 uppercase tracking-wider font-semibold">Demo Access</p>
                <p class="text-sm font-mono text-cyan-400 mb-1">admin@roboticscorner.com</p>
                <p class="text-sm font-mono text-emerald-400">admin123</p>
            </div>
        </div>
        
    </div>
</div>
@endsection
