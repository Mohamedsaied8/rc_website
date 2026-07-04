@extends('admin.layout')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')
@section('page-subtitle', 'Manage global configuration, links, and downloads.')

@section('content')
<div x-data="{ activeTab: 'general' }" class="space-y-6">
    
    <!-- Tabs Navigation -->
    <div class="flex items-center gap-2 border-b border-white/10 pb-4">
        <button @click="activeTab = 'general'" :class="activeTab === 'general' ? 'bg-cyan-500/20 text-cyan-400 border-cyan-500/30' : 'bg-white/[0.02] text-slate-400 border-white/5 hover:bg-white/[0.05] hover:text-white'" class="px-5 py-2.5 rounded-xl border font-semibold text-sm transition-all flex items-center gap-2">
            <i class="fa-solid fa-gear"></i> General Settings
        </button>
        <button @click="activeTab = 'links'" :class="activeTab === 'links' ? 'bg-cyan-500/20 text-cyan-400 border-cyan-500/30' : 'bg-white/[0.02] text-slate-400 border-white/5 hover:bg-white/[0.05] hover:text-white'" class="px-5 py-2.5 rounded-xl border font-semibold text-sm transition-all flex items-center gap-2">
            <i class="fa-solid fa-link"></i> Downloads & Links
        </button>
    </div>

    @php
        $generalSettings = $settings->filter(fn($s) => !str_contains($s->key, 'download_link'));
        $linkSettings = $settings->filter(fn($s) => str_contains($s->key, 'download_link'));
    @endphp

    <!-- General Settings Tab -->
    <div x-show="activeTab === 'general'" x-transition.opacity.duration.300ms class="bg-white/[0.02] border border-white/10 rounded-2xl overflow-hidden shadow-xl">
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
                                <a href="tel:{{ $setting->value }}" class="text-emerald-400 hover:text-emerald-300 font-medium inline-flex items-center gap-1.5 transition-colors">
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
                            <h4 class="text-lg font-bold text-white mb-2">No settings found</h4>
                            <p class="text-slate-400 max-w-sm mx-auto">System configuration variables will appear here.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Downloads & Links Tab -->
    <div x-show="activeTab === 'links'" x-transition.opacity.duration.300ms style="display: none;" class="bg-white/[0.02] border border-white/10 rounded-2xl overflow-hidden shadow-xl">
        <div class="p-6 border-b border-white/10 flex justify-between items-center bg-white/[0.01]">
            <h3 class="text-lg font-bold text-white tracking-tight flex items-center gap-2">
                <i class="fa-solid fa-cloud-arrow-down text-emerald-400"></i> External Downloads & Application Links
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
