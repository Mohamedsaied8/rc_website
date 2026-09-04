@extends('components.layout')

@section('title', 'Enrollment Success - Robotics Corner')

@section('content')
<div class="min-h-screen pt-24 pb-16 flex items-center justify-center bg-[#0A0A0A] relative overflow-hidden">
    <!-- Confetti / Success Background -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-emerald-900/20 via-[#0A0A0A] to-[#0A0A0A] pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-500/[0.05] rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-xl w-full px-6 relative z-10 animate-fade-in-up">
        <div class="bg-white/[0.03] backdrop-blur-xl border border-white/[0.06] rounded-3xl p-10 text-center shadow-2xl shadow-emerald-500/10">
            
            <!-- Animated Success Icon -->
            <div class="w-24 h-24 mx-auto mb-8 relative">
                <div class="absolute inset-0 bg-emerald-500/20 rounded-full animate-ping opacity-75"></div>
                <div class="relative w-full h-full bg-gradient-to-br from-emerald-400 to-cyan-500 rounded-full flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>

            <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-[1.05] mb-6">Application Received!</h1>
            
            <p class="text-lg text-slate-300 font-medium leading-relaxed mb-8">
                Thank you for applying to Robotics Corner. Our team will review your application and reach out by email or WhatsApp with the next steps.
            </p>

            <div class="bg-white/[0.02] border border-white/[0.05] rounded-2xl p-6 mb-8 text-left">
                <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4 text-center">Next Steps</h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-white/5 flex items-center justify-center text-xs text-cyan-400 shrink-0 mt-0.5">1</span>
                        <p class="text-sm text-slate-300">Our admissions team will review your application within 24-48 hours.</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-white/5 flex items-center justify-center text-xs text-cyan-400 shrink-0 mt-0.5">2</span>
                        <p class="text-sm text-slate-300">You'll receive an email or WhatsApp message regarding your acceptance status.</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-white/5 flex items-center justify-center text-xs text-cyan-400 shrink-0 mt-0.5">3</span>
                        <p class="text-sm text-slate-300">Once accepted, you'll receive the final enrollment and payment instructions.</p>
                    </li>
                </ul>
            </div>

            <a href="{{ route('home') }}" class="inline-flex items-center justify-center w-full sm:w-auto px-8 py-3.5 text-sm font-semibold text-gray-900 bg-gradient-to-r from-cyan-400 to-emerald-400 rounded-xl hover:shadow-lg hover:shadow-cyan-400/20 transition-all duration-300">
                Return to Homepage
            </a>
        </div>
    </div>
</div>
@endsection