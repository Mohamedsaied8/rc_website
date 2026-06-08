@extends('admin.layout')

@section('title', 'Pages Management')
@section('page-title', 'Pages & Content')
@section('page-subtitle', 'Manage website pages and their dynamic content blocks.')

@section('page-actions')
    <a href="{{ route('admin.pages.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-cyan-400 to-emerald-400 text-slate-900 font-bold hover:shadow-[0_0_20px_rgba(34,211,238,0.4)] hover:scale-[1.02] transition-all">
        <i class="fa-solid fa-plus text-xs"></i>
        <span>Create New Page</span>
    </a>
@endsection

@section('content')
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($pages as $page)
        <div class="bg-white/[0.02] border border-white/10 rounded-2xl overflow-hidden shadow-xl hover:border-cyan-500/30 transition-all flex flex-col group">
            <div class="p-6 border-b border-white/10 flex justify-between items-start">
                <div>
                    <h3 class="text-xl font-bold text-white tracking-tight mb-1">{{ $page->title }}</h3>
                    <div class="flex items-center gap-2 text-sm text-slate-400">
                        <code class="bg-black/50 px-2 py-0.5 rounded text-cyan-400">/{{ $page->slug === 'home' ? '' : $page->slug }}</code>
                    </div>
                </div>
                <div>
                    @if($page->is_active)
                        <span class="px-2.5 py-1 rounded-md bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-semibold">Active</span>
                    @else
                        <span class="px-2.5 py-1 rounded-md bg-slate-500/10 text-slate-400 border border-slate-500/20 text-xs font-semibold">Draft</span>
                    @endif
                </div>
            </div>
            
            <div class="p-6 flex-grow">
                <p class="text-slate-400 text-sm mb-4">{{ $page->description ?: 'No description provided.' }}</p>
                <div class="flex items-center gap-4 text-sm font-medium text-slate-500">
                    <span><i class="fa-solid fa-layer-group mr-1.5"></i> {{ $page->sections_count }} Sections</span>
                    @if($page->is_custom)
                        <span class="text-purple-400"><i class="fa-solid fa-code mr-1.5"></i> Custom HTML</span>
                    @else
                        <span class="text-blue-400"><i class="fa-solid fa-lock mr-1.5"></i> System Page</span>
                    @endif
                </div>
            </div>

            <div class="p-4 border-t border-white/10 flex justify-between items-center bg-black/20">
                <div class="flex gap-2">
                    @if($page->is_custom)
                        <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" onsubmit="return confirm('Are you sure you want to delete this custom page?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-slate-500 hover:text-red-400 transition-colors" title="Delete">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    @endif
                </div>
                <a href="{{ route('admin.pages.edit', $page) }}" class="inline-flex items-center justify-center gap-2 px-5 py-2 text-sm font-bold bg-white/5 hover:bg-white/10 text-white rounded-lg transition-colors border border-white/10 group-hover:border-cyan-500/50">
                    <i class="fa-solid fa-pen-to-square"></i> Edit Content
                </a>
            </div>
        </div>
    @endforeach
</div>
@endsection
