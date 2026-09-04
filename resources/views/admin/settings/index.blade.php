@extends('admin.layout')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')
@section('page-subtitle', 'Manage global configuration, manual payment numbers, links, and downloads.')

@section('content')
<div x-data="{ activeTab: 'payment' }" class="space-y-6">
    
    <!-- Success Alert -->
    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm flex items-center gap-3">
            <i class="fa-solid fa-circle-check text-base"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Tabs Navigation -->
    <div class="flex items-center gap-2 border-b border-white/10 pb-4 overflow-x-auto">
        <button @click="activeTab = 'payment'" 
                :class="activeTab === 'payment' ? 'bg-gradient-to-r from-purple-500/20 to-indigo-500/20 text-purple-300 border-purple-500/40 shadow-sm' : 'bg-white/[0.02] text-slate-400 border-white/5 hover:bg-white/[0.05] hover:text-white'" 
                class="px-5 py-2.5 rounded-xl border font-semibold text-sm transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
            <i class="fa-solid fa-money-bill-transfer text-purple-400"></i> Payment &amp; Transfers
            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-purple-500/20 text-purple-300 border border-purple-500/30">New</span>
        </button>

        <button @click="activeTab = 'general'" 
                :class="activeTab === 'general' ? 'bg-cyan-500/20 text-cyan-400 border-cyan-500/30' : 'bg-white/[0.02] text-slate-400 border-white/5 hover:bg-white/[0.05] hover:text-white'" 
                class="px-5 py-2.5 rounded-xl border font-semibold text-sm transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
            <i class="fa-solid fa-gear"></i> General Settings
        </button>

        <button @click="activeTab = 'links'" 
                :class="activeTab === 'links' ? 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30' : 'bg-white/[0.02] text-slate-400 border-white/5 hover:bg-white/[0.05] hover:text-white'" 
                class="px-5 py-2.5 rounded-xl border font-semibold text-sm transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
            <i class="fa-solid fa-link"></i> Downloads &amp; Links
        </button>
    </div>

    @php
        $paymentKeys = ['instapay_number', 'mobile_wallet_number', 'whatsapp_number'];
        $paymentSettings = $settings->filter(fn($s) => in_array($s->key, $paymentKeys));
        $linkSettings = $settings->filter(fn($s) => str_contains($s->key, 'download_link'));
        $generalSettings = $settings->filter(fn($s) => !in_array($s->key, $paymentKeys) && !str_contains($s->key, 'download_link'));

        $instapayVal = \App\Models\SiteSetting::get('instapay_number', config('services.manual_payment.instapay_address', '01156800621'));
        $walletVal = \App\Models\SiteSetting::get('mobile_wallet_number', config('services.manual_payment.wallet_number', '01156800621'));
        $whatsappVal = \App\Models\SiteSetting::get('whatsapp_number', '+201156800621');
    @endphp

    <!-- 1. Payment & Transfers Tab -->
    <div x-show="activeTab === 'payment'" x-transition.opacity.duration.300ms class="space-y-6">
        
        <!-- Batch Update Quick Card -->
        <div class="bg-gradient-to-b from-white/[0.04] to-white/[0.01] border border-white/10 rounded-2xl p-6 sm:p-8 shadow-xl">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 mb-6 border-b border-white/10">
                <div>
                    <h3 class="text-lg font-bold text-white tracking-tight flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-lg bg-purple-500/20 text-purple-400 border border-purple-500/30 flex items-center justify-center text-sm">
                            <i class="fa-solid fa-wallet"></i>
                        </span>
                        Manual Payment Numbers &amp; Sales Channels
                    </h3>
                    <p class="text-xs text-slate-400 mt-1">
                        These numbers are dynamically displayed to students during course enrollment checkout when transferring via InstaPay or Mobile Wallets.
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.settings.update-batch') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- InstaPay Number / Address -->
                    <div class="bg-white/[0.02] border border-white/5 rounded-xl p-5 space-y-3">
                        <div class="flex items-center justify-between">
                            <label for="instapay_number" class="text-xs font-bold uppercase tracking-wider text-purple-300 flex items-center gap-2">
                                <i class="fa-solid fa-building-columns"></i> InstaPay Phone / Address
                            </label>
                            <span class="text-[11px] font-mono px-2 py-0.5 rounded bg-purple-500/10 text-purple-400 border border-purple-500/20">
                                key: instapay_number
                            </span>
                        </div>
                        <input type="text" 
                               id="instapay_number" 
                               name="instapay_number" 
                               value="{{ old('instapay_number', $instapayVal) }}"
                               placeholder="e.g. 01156800621 or username@instapay"
                               required
                               class="w-full bg-white/[0.05] border border-white/10 rounded-xl px-4 py-3 text-white font-mono text-sm focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-all">
                        <p class="text-xs text-slate-400">
                            Shown to students when choosing <strong class="text-slate-200">Pay with InstaPay</strong> on <code class="text-purple-300 font-mono">/enroll</code>.
                        </p>
                    </div>

                    <!-- Mobile Wallet / Vodafone Cash Number -->
                    <div class="bg-white/[0.02] border border-white/5 rounded-xl p-5 space-y-3">
                        <div class="flex items-center justify-between">
                            <label for="mobile_wallet_number" class="text-xs font-bold uppercase tracking-wider text-teal-300 flex items-center gap-2">
                                <i class="fa-solid fa-mobile-screen-button"></i> Mobile Wallet Number (Vodafone Cash / etc.)
                            </label>
                            <span class="text-[11px] font-mono px-2 py-0.5 rounded bg-teal-500/10 text-teal-400 border border-teal-500/20">
                                key: mobile_wallet_number
                            </span>
                        </div>
                        <input type="text" 
                               id="mobile_wallet_number" 
                               name="mobile_wallet_number" 
                               value="{{ old('mobile_wallet_number', $walletVal) }}"
                               placeholder="e.g. 01156800621"
                               required
                               class="w-full bg-white/[0.05] border border-white/10 rounded-xl px-4 py-3 text-white font-mono text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-all">
                        <p class="text-xs text-slate-400">
                            Shown to students when choosing <strong class="text-slate-200">Vodafone Cash / Mobile Wallet</strong> on <code class="text-teal-300 font-mono">/enroll</code>.
                        </p>
                    </div>

                    <!-- WhatsApp Number -->
                    <div class="bg-white/[0.02] border border-white/5 rounded-xl p-5 space-y-3 md:col-span-2">
                        <div class="flex items-center justify-between">
                            <label for="whatsapp_number" class="text-xs font-bold uppercase tracking-wider text-emerald-300 flex items-center gap-2">
                                <i class="fa-brands fa-whatsapp"></i> WhatsApp Sales &amp; Support Number
                            </label>
                            <span class="text-[11px] font-mono px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                key: whatsapp_number
                            </span>
                        </div>
                        <input type="text" 
                               id="whatsapp_number" 
                               name="whatsapp_number" 
                               value="{{ old('whatsapp_number', $whatsappVal) }}"
                               placeholder="e.g. +201156800621"
                               required
                               class="w-full bg-white/[0.05] border border-white/10 rounded-xl px-4 py-3 text-white font-mono text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                        <p class="text-xs text-slate-400">
                            Used for <strong class="text-slate-200">"Pay via Sales (WhatsApp)"</strong> button on <code class="text-emerald-300 font-mono">/enroll</code> and support links on student profiles.
                        </p>
                    </div>

                </div>

                <div class="flex items-center justify-between pt-4 border-t border-white/10">
                    <span class="text-xs text-slate-500">
                        Changes apply immediately across the entire platform.
                    </span>
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-bold hover:brightness-110 transition-all shadow-lg shadow-purple-500/20 cursor-pointer">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Save Payment Settings</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Student Checkout Preview -->
        <div class="bg-white/[0.02] border border-white/10 rounded-2xl p-6 shadow-xl">
            <h4 class="text-sm font-bold text-slate-300 mb-3 flex items-center gap-2">
                <i class="fa-solid fa-eye text-cyan-400"></i> Live Checkout Preview (What students see)
            </h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div class="bg-white/[0.03] border border-purple-500/20 p-4 rounded-xl space-y-1">
                    <span class="text-purple-400 font-bold block">InstaPay Transfer:</span>
                    <div class="font-mono text-white text-sm font-semibold bg-white/5 p-2 rounded border border-white/5">
                        {{ $instapayVal }}
                    </div>
                </div>
                <div class="bg-white/[0.03] border border-teal-500/20 p-4 rounded-xl space-y-1">
                    <span class="text-teal-400 font-bold block">Mobile Wallet / Vodafone Cash:</span>
                    <div class="font-mono text-white text-sm font-semibold bg-white/5 p-2 rounded border border-white/5">
                        {{ $walletVal }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- 2. General Settings Tab -->
    <div x-show="activeTab === 'general'" x-transition.opacity.duration.300ms style="display: none;" class="bg-white/[0.02] border border-white/10 rounded-2xl overflow-hidden shadow-xl">
        <div class="p-6 border-b border-white/10 flex justify-between items-center bg-white/[0.01]">
            <h3 class="text-lg font-bold text-white tracking-tight flex items-center gap-2">
                <i class="fa-solid fa-sliders text-cyan-400"></i> General Configuration
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead>
                    <tr class="bg-white/[0.02] text-xs uppercase tracking-wider text-slate-400 font-semibold border-b border-white/10">
                        <th class="px-6 py-4">Setting Name</th>
                        <th class="px-6 py-4">Current Value</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($generalSettings as $setting)
                    <tr class="hover:bg-white/[0.02] transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-bold text-white">{{ ucwords(str_replace('_', ' ', $setting->key)) }}</span>
                                @if($setting->description)
                                    <small class="text-slate-500 mt-0.5">{{ $setting->description }}</small>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($setting->type === 'url')
                                <a href="{{ $setting->value }}" target="_blank" class="text-cyan-400 hover:text-cyan-300 font-medium inline-flex items-center gap-1.5 transition-colors">
                                    <i class="fa-solid fa-link text-xs opacity-70"></i> {{ $setting->value }}
                                </a>
                            @elseif($setting->type === 'email')
                                <a href="mailto:{{ $setting->value }}" class="text-emerald-400 hover:text-emerald-300 font-medium inline-flex items-center gap-1.5 transition-colors">
                                    <i class="fa-regular fa-envelope text-xs opacity-70"></i> {{ $setting->value }}
                                </a>
                            @elseif($setting->type === 'phone')
                                <a href="tel:{{ $setting->value }}" class="text-emerald-400 hover:text-emerald-300 font-medium inline-flex items-center gap-1.5 transition-colors font-mono">
                                    <i class="fa-solid fa-phone text-xs opacity-70"></i> {{ $setting->value }}
                                </a>
                            @else
                                <span class="text-slate-300 bg-white/5 px-3 py-1.5 rounded-lg border border-white/5">{{ $setting->value }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.settings.edit', $setting) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/[0.05] border border-white/10 text-slate-300 hover:bg-cyan-500/20 hover:text-cyan-400 hover:border-cyan-500/30 transition-all shadow-sm">
                                <i class="fa-solid fa-pen text-xs"></i>
                                <span class="text-sm font-medium">Edit</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/[0.02] border border-white/5 mb-4">
                                <i class="fa-solid fa-gear text-2xl text-slate-500"></i>
                            </div>
                            <h4 class="text-lg font-bold text-white mb-2">No general settings found</h4>
                            <p class="text-slate-400 max-w-sm mx-auto">System configuration variables will appear here.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- 3. Downloads & Links Tab -->
    <div x-show="activeTab === 'links'" x-transition.opacity.duration.300ms style="display: none;" class="bg-white/[0.02] border border-white/10 rounded-2xl overflow-hidden shadow-xl">
        <div class="p-6 border-b border-white/10 flex justify-between items-center bg-white/[0.01]">
            <h3 class="text-lg font-bold text-white tracking-tight flex items-center gap-2">
                <i class="fa-solid fa-cloud-arrow-down text-emerald-400"></i> External Downloads &amp; Application Links
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead>
                    <tr class="bg-white/[0.02] text-xs uppercase tracking-wider text-slate-400 font-semibold border-b border-white/10">
                        <th class="px-6 py-4">Resource Name</th>
                        <th class="px-6 py-4">Target URL</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($linkSettings as $setting)
                    <tr class="hover:bg-white/[0.02] transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-bold text-white">{{ ucwords(str_replace('_', ' ', $setting->key)) }}</span>
                                @if($setting->description)
                                    <small class="text-slate-500 mt-0.5 whitespace-normal max-w-xs">{{ $setting->description }}</small>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ $setting->value }}" target="_blank" class="text-emerald-400 hover:text-emerald-300 font-medium inline-flex items-center gap-1.5 transition-colors whitespace-normal break-all max-w-md">
                                <i class="fa-solid fa-external-link-alt text-xs opacity-70"></i> {{ $setting->value }}
                            </a>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.settings.edit', $setting) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/[0.05] border border-white/10 text-slate-300 hover:bg-emerald-500/20 hover:text-emerald-400 hover:border-emerald-500/30 transition-all shadow-sm">
                                <i class="fa-solid fa-pen text-xs"></i>
                                <span class="text-sm font-medium">Update Link</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/[0.02] border border-white/5 mb-4">
                                <i class="fa-solid fa-link text-2xl text-slate-500"></i>
                            </div>
                            <h4 class="text-lg font-bold text-white mb-2">No links configured</h4>
                            <p class="text-slate-400 max-w-sm mx-auto">Download links and external URLs will appear here.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
