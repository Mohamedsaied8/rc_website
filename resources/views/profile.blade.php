@extends('components.layout')

@section('title', 'My Account - Robotics Corner')

@push('styles')
    {{-- Sibling-product wordmark faces for the subscription panel. Scoped to this
         page: no other page renders these wordmarks. Sora is NOT requested here —
         it is Robotics Corner's own face and now loads site-wide in the layout. --}}
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@700&family=Unbounded:wght@700&family=Bricolage+Grotesque:opsz,wght@12..96,700&display=swap" rel="stylesheet">
@endpush

@php
    $statusStyles = [
        'pending'   => 'bg-amber-50 text-amber-700 border-amber-200',
        'paid'      => 'bg-emerald-50 text-emerald-700 border-emerald-200',
        'approved'  => 'bg-emerald-50 text-emerald-700 border-emerald-200',
        'completed' => 'bg-cyan-50 text-cyan-700 border-cyan-200',
        'active'    => 'bg-emerald-50 text-emerald-700 border-emerald-200',
        'failed'    => 'bg-red-50 text-red-700 border-red-200',
        'rejected'  => 'bg-red-50 text-red-700 border-red-200',
        'cancelled' => 'bg-slate-100 text-slate-500 border-slate-200',
    ];
    $methodLabels = [
        'instapay'      => 'InstaPay',
        'card'          => 'Card',
        'wallet'        => 'Mobile Wallet',
        // Legacy values, retained so historical enrollments still render.
        'paymob_card'   => 'Card',
        'paymob_wallet' => 'Mobile Wallet',
    ];
    $initials = collect(explode(' ', trim($user->name)))
        ->filter()->take(2)->map(fn ($p) => mb_strtoupper(mb_substr($p, 0, 1)))->implode('');

    $activeCount = collect($subs)->where('active', true)->count();
@endphp

@section('content')
<div class="min-h-screen pt-24 pb-16 bg-slate-50">
    <div class="max-w-5xl mx-auto px-6 lg:px-8">

        {{-- Account header --}}
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 sm:p-8 mb-10">
            <div class="flex flex-col sm:flex-row sm:items-center gap-6">
                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-cyan-400 to-emerald-400 flex items-center justify-center text-2xl font-bold text-gray-900 shrink-0">
                    {{ $initials ?: 'U' }}
                </div>
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">{{ $user->name }}</h1>
                    <div class="mt-2 flex flex-wrap gap-x-6 gap-y-1 text-sm text-slate-600">
                        <span class="inline-flex items-center gap-2"><i class="fa-solid fa-envelope text-slate-400"></i> {{ $user->email }}</span>
                        @if($user->phone)
                            <span class="inline-flex items-center gap-2"><i class="fa-solid fa-phone text-slate-400"></i> {{ $user->phone }}</span>
                        @endif
                        <span class="inline-flex items-center gap-2"><i class="fa-solid fa-calendar text-slate-400"></i> Member since {{ $user->created_at?->format('M j, Y') ?? 'N/A' }}</span>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-slate-600 bg-slate-100 border border-slate-200 rounded-lg hover:bg-slate-200 hover:text-slate-900 transition-colors">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Log out
                    </button>
                </form>
            </div>
        </div>

        {{-- ============================ SUBSCRIPTIONS ============================ --}}
        <div class="flex items-end justify-between mb-6">
            <div>
                <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">My Subscriptions</h2>
                <p class="mt-1 text-sm text-slate-500">Your access across the Robotics Corner ecosystem.</p>
            </div>
            <span class="hidden sm:inline-flex items-center gap-2 px-3 py-1.5 text-xs font-bold rounded-full bg-slate-100 text-slate-600 border border-slate-200">
                {{ $activeCount }} of 4 active
            </span>
        </div>

        <div class="space-y-6">

            {{-- ---------------------------------------------------------------
                 1. ROBOTICS CORNER — courses / training programs (local data)
            ---------------------------------------------------------------- --}}
            @php $c = $subs['courses']; @endphp
            <section class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="flex flex-wrap items-center justify-between gap-4 px-6 py-5 border-b border-slate-100 bg-gradient-to-r from-cyan-50/70 to-emerald-50/40">
                    <div class="flex items-center gap-3.5 min-w-0">
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-cyan-400 to-emerald-400 flex items-center justify-center text-gray-900 shrink-0">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <div class="min-w-0">
                            <div class="font-rc text-xl font-extrabold tracking-tight text-slate-900 leading-none">Robotics Corner</div>
                            <div class="mt-1.5 text-xs font-semibold uppercase tracking-wider text-cyan-700/70">Training &amp; Courses</div>
                        </div>
                    </div>
                    @if($c['active'])
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <i class="fa-solid fa-circle-check"></i> {{ count($c['items']) }} enrolled
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full bg-slate-100 text-slate-500 border border-slate-200">Not enrolled</span>
                    @endif
                </div>

                <div class="p-6">
                    @if(!$c['active'])
                        <div class="text-center py-6">
                            <p class="text-slate-600 font-medium">You're not enrolled in any program yet.</p>
                            <p class="mt-1 text-sm text-slate-500">Explore our training tracks in robotics, AI and embedded systems.</p>
                            <a href="{{ route('programs.index') }}" class="inline-flex items-center gap-2 mt-5 px-5 py-2.5 text-sm font-bold text-gray-900 bg-gradient-to-r from-cyan-400 to-emerald-400 rounded-lg hover:shadow-lg hover:shadow-cyan-400/25 transition-all">
                                Browse our courses <i class="fa-solid fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($c['items'] as $enrollment)
                                @php
                                    $status = $enrollment->status ?? 'pending';
                                    $statusLabel = match($status) {
                                        'pending' => 'Pending Review',
                                        'approved' => 'Approved',
                                        'rejected' => 'Refused',
                                        'completed' => 'Completed',
                                        default => ucfirst($status)
                                    };
                                    $badge = match($status) {
                                        'pending' => 'bg-amber-50 text-amber-700 border-amber-300',
                                        'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-300',
                                        'rejected' => 'bg-red-50 text-red-700 border-red-300',
                                        'completed' => 'bg-cyan-50 text-cyan-700 border-cyan-300',
                                        default => $statusStyles[$status] ?? 'bg-slate-100 text-slate-600 border-slate-200'
                                    };
                                    $isManual = in_array($enrollment->payment_method, ['instapay', 'manual_wallet']);
                                    $isGatewayPaid = in_array($enrollment->payment_method, ['card', 'wallet', 'paymob_card', 'paymob_wallet']);
                                    $canContinuePayment = $isGatewayPaid && in_array($enrollment->payment_status ?? 'unpaid', ['unpaid', 'failed']) && $status !== 'rejected';
                                    $manualPayment = $enrollment->latestManualPayment;
                                @endphp
                                <div class="border border-slate-200 rounded-xl p-5 bg-white shadow-xs">
                                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-center gap-2 flex-wrap">
                                                <h3 class="text-base font-bold text-slate-900">
                                                    {{ $programNames[$enrollment->selected_program] ?? $enrollment->selected_program ?? 'Program' }}
                                                </h3>
                                                @if($enrollment->amount)
                                                    <span class="text-xs font-semibold px-2 py-0.5 bg-slate-100 text-slate-700 rounded-md">
                                                        EGP {{ number_format($enrollment->amount) }}
                                                    </span>
                                                @endif
                                            </div>
                                            
                                            <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-1.5 text-sm text-slate-600">
                                                @if($enrollment->cohort)
                                                    <span><span class="text-slate-400">Cohort:</span> {{ $enrollment->cohort->group_name }}@if($enrollment->cohort->start_date) &middot; starts {{ $enrollment->cohort->start_date->format('M j, Y') }}@endif</span>
                                                @endif
                                                <span><span class="text-slate-400">Payment:</span> {{ $enrollment->payment_method === 'instapay' ? 'InstaPay / Mobile Wallet' : ($methodLabels[$enrollment->payment_method] ?? ($enrollment->payment_method ?? '—')) }}</span>
                                                <span><span class="text-slate-400">Submitted:</span> {{ $enrollment->created_at?->format('M j, Y') ?? '—' }}</span>
                                                @if($manualPayment && $manualPayment->reference_number)
                                                    <span><span class="text-slate-400">Ref:</span> <span class="font-mono text-xs font-semibold text-slate-800">{{ $manualPayment->reference_number }}</span></span>
                                                @endif
                                            </div>

                                            {{-- Contextual Status Explanations --}}
                                            @if($status === 'pending')
                                                <div class="mt-3.5 p-3 rounded-lg bg-amber-50/80 border border-amber-200 text-xs text-amber-900 flex items-start gap-2.5">
                                                    <i class="fa-solid fa-clock-rotate-left text-amber-600 mt-0.5 text-sm"></i>
                                                    <div>
                                                        <strong class="font-semibold block mb-0.5">Application & Payment Under Review</strong>
                                                        @if($isManual)
                                                            Your transfer receipt was submitted and is being verified by our admissions team. You will be notified upon confirmation.
                                                        @else
                                                            Your application is currently pending review.
                                                        @endif
                                                    </div>
                                                </div>
                                            @elseif($status === 'approved')
                                                <div class="mt-3.5 p-3 rounded-lg bg-emerald-50/80 border border-emerald-200 text-xs text-emerald-900 flex items-start gap-2.5">
                                                    <i class="fa-solid fa-circle-check text-emerald-600 mt-0.5 text-sm"></i>
                                                    <div>
                                                        <strong class="font-semibold block mb-0.5">Payment Verified & Enrollment Active</strong>
                                                        Your payment has been approved and your seat in this cohort is secured.
                                                    </div>
                                                </div>
                                            @elseif($status === 'rejected')
                                                <div class="mt-3.5 p-3.5 rounded-lg bg-red-50/90 border border-red-200 text-xs text-red-900 space-y-2">
                                                    <div class="flex items-start gap-2.5">
                                                        <i class="fa-solid fa-circle-xmark text-red-600 mt-0.5 text-sm"></i>
                                                        <div class="flex-1">
                                                            <strong class="font-semibold block mb-0.5">Payment / Application Refused</strong>
                                                            @if($enrollment->admin_notes)
                                                                <p class="text-red-800">Reason: {{ $enrollment->admin_notes }}</p>
                                                            @else
                                                                <p class="text-red-800">The uploaded proof could not be verified or the application was refused.</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="pt-1 flex flex-wrap items-center gap-2">
                                                        @php
                                                            $waRaw = \App\Models\SiteSetting::get('whatsapp_number', '+201156800621');
                                                            $waClean = preg_replace('/[^0-9]/', '', $waRaw) ?: '201156800621';
                                                        @endphp
                                                        <a href="https://wa.me/{{ $waClean }}?text={{ rawurlencode('Hello, my enrollment for ' . ($programNames[$enrollment->selected_program] ?? 'the course') . ' was refused. I would like to check details and re-verify.') }}" 
                                                           target="_blank" rel="noopener noreferrer"
                                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md bg-emerald-600 text-white font-bold hover:bg-emerald-700 transition-colors">
                                                            <i class="fa-brands fa-whatsapp text-xs"></i> Contact Support
                                                        </a>
                                                        <a href="{{ route('enroll', ['program' => $enrollment->selected_program, 'cohort' => $enrollment->program_cohort_id]) }}" 
                                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md bg-slate-900 text-white font-semibold hover:bg-slate-800 transition-colors">
                                                            <i class="fa-solid fa-rotate-right text-xs"></i> Re-submit Enrollment
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="flex flex-col items-start sm:items-end gap-3 shrink-0">
                                            <span class="inline-flex items-center px-3.5 py-1 text-xs font-bold uppercase tracking-wide rounded-full border {{ $badge }}">
                                                {{ $statusLabel }}
                                            </span>
                                            @if($canContinuePayment)
                                                <a href="{{ route('payment.process', $enrollment->id) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-900 bg-gradient-to-r from-cyan-400 to-emerald-400 rounded-lg hover:shadow-lg hover:shadow-cyan-400/20 transition-all">
                                                    <i class="fa-solid fa-credit-card"></i> Continue payment
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{ route('programs.index') }}" class="inline-flex items-center gap-1.5 mt-5 text-sm font-semibold text-cyan-600 hover:text-cyan-700">
                            Browse more programs <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    @endif
                </div>
            </section>

            {{-- ---------------------------------------------------------------
                 2. ROBOHUB — Premium plan (Supabase `premium_plans`)
            ---------------------------------------------------------------- --}}
            @php $r = $subs['robohub']; @endphp
            <section class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="flex flex-wrap items-center justify-between gap-4 px-6 py-5 border-b border-slate-100 bg-gradient-to-r from-teal-50/70 to-emerald-50/40">
                    <div class="flex items-center gap-3.5 min-w-0">
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-teal-500 to-emerald-500 flex items-center justify-center text-white shrink-0">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <div class="min-w-0">
                            <div class="font-robohub text-xl font-bold tracking-tight text-slate-900 leading-none">RoboHub</div>
                            <div class="mt-1.5 text-xs font-semibold uppercase tracking-wider text-teal-700/70">Freelance Marketplace</div>
                        </div>
                    </div>
                    @if($r['active'])
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <i class="fa-solid fa-crown"></i> {{ $r['plan'] }}
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full bg-slate-100 text-slate-500 border border-slate-200">Free plan</span>
                    @endif
                </div>

                <div class="p-6">
                    @if($r['active'])
                        <div class="flex flex-wrap items-center gap-x-10 gap-y-3 text-sm">
                            <div>
                                <div class="text-xs uppercase tracking-wider text-slate-400 font-semibold">Plan</div>
                                <div class="mt-1 font-bold text-slate-900">{{ $r['plan'] }}</div>
                            </div>
                            @if($r['meta']['active_until'])
                                <div>
                                    <div class="text-xs uppercase tracking-wider text-slate-400 font-semibold">Renews / expires</div>
                                    <div class="mt-1 font-bold text-slate-900">{{ $r['meta']['active_until']->format('M j, Y') }}</div>
                                </div>
                            @endif
                            @if($r['meta']['extra_bids'])
                                <div>
                                    <div class="text-xs uppercase tracking-wider text-slate-400 font-semibold">Extra bids</div>
                                    <div class="mt-1 font-bold text-slate-900">{{ $r['meta']['extra_bids'] }}</div>
                                </div>
                            @endif
                        </div>
                        <a href="{{ route('freelance') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 mt-5 text-sm font-semibold text-teal-600 hover:text-teal-700">
                            Go to RoboHub <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                        </a>
                    @else
                        <div class="text-center py-6">
                            @if($r['meta']['expired'])
                                <p class="text-slate-600 font-medium">Your RoboHub Premium has expired.</p>
                                <p class="mt-1 text-sm text-slate-500">Renew to get unlimited bids and priority placement on jobs.</p>
                            @else
                                <p class="text-slate-600 font-medium">You're on the free RoboHub plan.</p>
                                <p class="mt-1 text-sm text-slate-500">Go Premium for unlimited bids and priority placement on freelance jobs.</p>
                            @endif
                            <a href="{{ route('freelance') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 mt-5 px-5 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-teal-500 to-emerald-500 rounded-lg hover:shadow-lg hover:shadow-teal-500/25 transition-all">
                                Explore RoboHub Premium <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </section>

            {{-- ---------------------------------------------------------------
                 3. ROBOAGENT — Pro / Max (no backing table yet; see
                 SubscriptionService::roboagent — always renders "Free" for now)
            ---------------------------------------------------------------- --}}
            @php $a = $subs['roboagent']; @endphp
            <section class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="flex flex-wrap items-center justify-between gap-4 px-6 py-5 border-b border-slate-100 bg-gradient-to-r from-purple-50/70 to-fuchsia-50/40">
                    <div class="flex items-center gap-3.5 min-w-0">
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-purple-500 to-fuchsia-500 flex items-center justify-center text-white shrink-0">
                            <i class="fa-solid fa-robot"></i>
                        </div>
                        <div class="min-w-0">
                            <div class="font-roboagent text-lg font-bold tracking-tight text-slate-900 leading-none">RoboAgent</div>
                            <div class="mt-1.5 text-xs font-semibold uppercase tracking-wider text-purple-700/70">AI Robotics Agent</div>
                        </div>
                    </div>
                    @if($a['active'])
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-full bg-purple-50 text-purple-700 border border-purple-200">
                            <i class="fa-solid fa-crown"></i> {{ $a['plan'] }}
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full bg-slate-100 text-slate-500 border border-slate-200">Free plan</span>
                    @endif
                </div>

                <div class="p-6">
                    @if($a['active'])
                        <div class="flex flex-wrap items-center gap-x-10 gap-y-3 text-sm">
                            <div>
                                <div class="text-xs uppercase tracking-wider text-slate-400 font-semibold">Plan</div>
                                <div class="mt-1 font-bold text-slate-900">RoboAgent {{ $a['plan'] }}</div>
                            </div>
                            @if($a['meta']['active_until'])
                                <div>
                                    <div class="text-xs uppercase tracking-wider text-slate-400 font-semibold">Renews / expires</div>
                                    <div class="mt-1 font-bold text-slate-900">{{ $a['meta']['active_until']->format('M j, Y') }}</div>
                                </div>
                            @endif
                        </div>
                        <a href="/roboagent" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 mt-5 text-sm font-semibold text-purple-600 hover:text-purple-700">
                            Open RoboAgent <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                        </a>
                    @else
                        <div class="text-center py-6">
                            <p class="text-slate-600 font-medium">You're on the free RoboAgent plan.</p>
                            <p class="mt-1 text-sm text-slate-500">Upgrade to Pro or Max for higher limits and the autonomous control plane.</p>
                            <a href="/roboagent/pricing" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 mt-5 px-5 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-purple-500 to-fuchsia-500 rounded-lg hover:shadow-lg hover:shadow-purple-500/25 transition-all">
                                See Pro &amp; Max plans <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </section>

            {{-- ---------------------------------------------------------------
                 4. CONNECTEDLABS — robot bookings (Supabase `bookings`).
                 Pay-per-use, so "active" = has upcoming/in-progress robot time.
            ---------------------------------------------------------------- --}}
            @php $l = $subs['connectedlabs']; @endphp
            <section class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="flex flex-wrap items-center justify-between gap-4 px-6 py-5 border-b border-slate-100 bg-gradient-to-r from-cyan-50/70 to-teal-50/40">
                    <div class="flex items-center gap-3.5 min-w-0">
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-teal-600 to-emerald-500 flex items-center justify-center text-white shrink-0">
                            <i class="fa-solid fa-flask"></i>
                        </div>
                        <div class="min-w-0">
                            <div class="font-clabs text-xl font-bold tracking-tight leading-none">
                                <span class="text-slate-900">Connected</span><span class="text-teal-600">Labs</span>
                            </div>
                            <div class="mt-1.5 text-xs font-semibold uppercase tracking-wider text-teal-700/70">Remote Robot Lab</div>
                        </div>
                    </div>
                    @if($l['active'])
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <i class="fa-solid fa-circle-check"></i> {{ count($l['meta']['upcoming']) }} upcoming
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full bg-slate-100 text-slate-500 border border-slate-200">No bookings</span>
                    @endif
                </div>

                <div class="p-6">
                    @if(empty($l['items']))
                        <div class="text-center py-6">
                            <p class="text-slate-600 font-medium">You haven't booked any robot time yet.</p>
                            <p class="mt-1 text-sm text-slate-500">Reserve a real robot remotely and run your code on it from the browser.</p>
                            <a href="/connectedlabs" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 mt-5 px-5 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-teal-600 to-emerald-500 rounded-lg hover:shadow-lg hover:shadow-teal-500/25 transition-all">
                                Book a robot <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                            </a>
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach($l['items'] as $booking)
                                @php
                                    $bStatus = $booking['status'] ?? 'pending';
                                    $bBadge = $statusStyles[$bStatus] ?? 'bg-slate-100 text-slate-600 border-slate-200';
                                    $robotName = $booking['robot']['name'] ?? 'Robot';
                                    $start = !empty($booking['start_time']) ? \Illuminate\Support\Carbon::parse($booking['start_time']) : null;
                                @endphp
                                <div class="flex flex-wrap items-center justify-between gap-4 border border-slate-200 rounded-xl px-5 py-4">
                                    <div class="min-w-0">
                                        <div class="font-bold text-slate-900">{{ $robotName }}</div>
                                        <div class="mt-1 text-sm text-slate-600">
                                            @if($start)
                                                {{ $start->format('M j, Y · H:i') }}
                                            @endif
                                            @if(!empty($booking['hours']))
                                                <span class="text-slate-400">·</span> {{ $booking['hours'] }}h
                                            @endif
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-bold uppercase tracking-wide rounded-full border {{ $bBadge }}">
                                        {{ ucfirst($bStatus) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                        <a href="/connectedlabs" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 mt-5 text-sm font-semibold text-teal-600 hover:text-teal-700">
                            Manage bookings <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                        </a>
                    @endif
                </div>
            </section>

        </div>
    </div>
</div>
@endsection
