@extends('components.layout')

@section('title', 'Create Account - Robotics Corner')

@section('content')
<div class="min-h-screen pt-24 pb-16 bg-[#0A0A0A] text-slate-300 font-sans flex items-center justify-center selection:bg-cyan-500/30">
    <div class="w-full max-w-md px-6">
        
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-extrabold text-white tracking-tight mb-2">Create an Account</h1>
            <p class="text-slate-400 text-sm">Join us to enroll in programs and track your progress.</p>
        </div>

        <div class="bg-white/[0.03] backdrop-blur-xl border border-white/[0.06] rounded-2xl shadow-2xl p-8">
            <form method="POST" action="{{ route('register.store') }}">
                @csrf

                @if($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-300 mb-1.5">Full Name</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </span>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full pl-10 pr-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors" placeholder="John Doe">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-300 mb-1.5">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full pl-10 pr-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors" placeholder="student@example.com">
                        </div>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-slate-300 mb-1.5">Phone Number</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </span>
                            <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required class="w-full pl-10 pr-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors" placeholder="+20 123 456 7890">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-300 mb-1.5">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </span>
                            <input id="password" type="password" name="password" required class="w-full pl-10 pr-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors" placeholder="••••••••">
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-1.5">Confirm Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </span>
                            <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full pl-10 pr-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors" placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-cyan-500 to-emerald-500 text-gray-900 font-bold rounded-xl hover:shadow-[0_0_20px_rgba(34,211,238,0.4)] transition-all flex justify-center items-center gap-2">
                        <span>Create Account</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>
            
            <div class="mt-6 text-center">
                <p class="text-sm text-slate-400">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="font-medium text-cyan-400 hover:text-cyan-300 transition-colors">Sign In</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
