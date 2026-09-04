@extends('admin.layout')

@section('title', 'Edit Setting')
@section('page-title', 'Edit Setting')
@section('page-subtitle', 'Modify configuration value for: ' . ucwords(str_replace('_', ' ', $setting->key)))

@section('content')
<div class="max-w-2xl">
    <div class="bg-white/[0.02] border border-white/10 rounded-2xl p-6 sm:p-8 shadow-xl">
        <form method="POST" action="{{ route('admin.settings.update', $setting) }}" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-2">
                <label for="key" class="block text-xs font-semibold uppercase tracking-wider text-slate-400">Setting Key</label>
                <input type="text" id="key" name="key" class="w-full bg-white/[0.03] border border-white/10 rounded-xl px-4 py-2.5 text-slate-400 font-mono text-sm cursor-not-allowed" value="{{ $setting->key }}" readonly>
                <p class="text-xs text-slate-500">System setting identifier cannot be changed.</p>
            </div>

            @if($setting->description)
            <div class="space-y-2">
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400">Description</label>
                <div class="bg-white/[0.02] border border-white/5 rounded-xl px-4 py-2.5 text-slate-300 text-sm">
                    {{ $setting->description }}
                </div>
            </div>
            @endif

            <div class="space-y-2">
                <label for="value" class="block text-xs font-semibold uppercase tracking-wider text-slate-200">Setting Value <span class="text-cyan-400">*</span></label>
                @if($setting->type === 'textarea')
                    <textarea id="value" name="value" class="w-full bg-white/[0.05] border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500" rows="4" required>{{ old('value', $setting->value) }}</textarea>
                @elseif($setting->type === 'url')
                    <input type="url" id="value" name="value" class="w-full bg-white/[0.05] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500" value="{{ old('value', $setting->value) }}" required>
                @elseif($setting->type === 'email')
                    <input type="email" id="value" name="value" class="w-full bg-white/[0.05] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500" value="{{ old('value', $setting->value) }}" required>
                @elseif($setting->type === 'phone')
                    <input type="tel" id="value" name="value" class="w-full bg-white/[0.05] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm font-mono focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500" value="{{ old('value', $setting->value) }}" required>
                @else
                    <input type="text" id="value" name="value" class="w-full bg-white/[0.05] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500" value="{{ old('value', $setting->value) }}" required>
                @endif
                @error('value')
                    <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-white/10">
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gradient-to-r from-cyan-500 to-teal-500 text-slate-950 font-bold hover:brightness-110 transition-all shadow-lg shadow-cyan-500/20 cursor-pointer">
                    <i class="fa-solid fa-check text-xs"></i>
                    <span>Save Changes</span>
                </button>
                <a href="{{ route('admin.settings.index') }}" class="px-5 py-2.5 rounded-xl bg-white/[0.05] border border-white/10 text-slate-300 hover:bg-white/[0.1] hover:text-white transition-all text-sm font-semibold">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
