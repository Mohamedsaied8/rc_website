@extends('admin.layout')

@section('title', 'Create Page')
@section('page-title', 'Create New Page')
@section('page-subtitle', 'Create a new custom page for the website.')

@section('page-actions')
    <a href="{{ route('admin.pages.index') }}" class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white transition-colors">
        <i class="fa-solid fa-arrow-left mr-2"></i> Back to Pages
    </a>
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white/[0.02] border border-white/10 rounded-2xl p-8">
        <form action="{{ route('admin.pages.store') }}" method="POST">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Page Title</label>
                    <input type="text" name="title" required value="{{ old('title') }}" 
                           class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-cyan-500/50 transition-colors"
                           placeholder="e.g. Careers">
                    @error('title') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">URL Slug</label>
                    <div class="flex items-center">
                        <span class="bg-white/5 border border-r-0 border-white/10 rounded-l-xl px-4 py-3 text-slate-400 font-mono text-sm">/</span>
                        <input type="text" name="slug" required value="{{ old('slug') }}" 
                               class="w-full bg-black/50 border border-white/10 rounded-r-xl px-4 py-3 text-white font-mono text-sm focus:outline-none focus:border-cyan-500/50 transition-colors"
                               placeholder="careers">
                    </div>
                    <p class="text-xs text-slate-500 mt-2">This will be the URL of the page. Use lowercase letters and hyphens only.</p>
                    @error('slug') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Internal Description (Optional)</label>
                    <textarea name="description" rows="3" 
                              class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-cyan-500/50 transition-colors"
                              placeholder="Brief description for admin panel only.">{{ old('description') }}</textarea>
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked
                           class="w-5 h-5 rounded bg-black/50 border-white/10 text-cyan-500 focus:ring-cyan-500/50">
                    <label for="is_active" class="text-sm font-medium text-slate-300 cursor-pointer">
                        Publish Immediately
                    </label>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-white/10 flex justify-end">
                <button type="submit" class="px-6 py-3 rounded-xl bg-gradient-to-r from-cyan-400 to-emerald-400 text-slate-900 font-bold hover:shadow-[0_0_20px_rgba(34,211,238,0.4)] transition-all">
                    Create Page
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
