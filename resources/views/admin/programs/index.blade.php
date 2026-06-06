@extends('admin.layout')

@section('title', 'Programs Management')
@section('page-title', 'Programs')
@section('page-subtitle', 'Manage your comprehensive training programs.')

@section('page-actions')
    <a href="{{ route('admin.programs.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-cyan-400 to-emerald-400 text-slate-900 font-bold hover:shadow-[0_0_20px_rgba(34,211,238,0.4)] hover:scale-[1.02] transition-all">
        <i class="fa-solid fa-plus text-xs"></i>
        <span>Add New Program</span>
    </a>
@endsection

@section('content')
<div class="bg-white/[0.02] border border-white/10 rounded-2xl overflow-hidden shadow-xl mb-8">
    <div class="p-6 border-b border-white/10 flex justify-between items-center bg-white/[0.01]">
        <h3 class="text-lg font-bold text-white tracking-tight">All Programs</h3>
    </div>

    @if($programs->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead>
                    <tr class="bg-white/[0.02] text-xs uppercase tracking-wider text-slate-400 font-semibold border-b border-white/10">
                        <th class="px-6 py-4">Title & Description</th>
                        <th class="px-6 py-4">Slug</th>
                        <th class="px-6 py-4">Duration & Price</th>
                        <th class="px-6 py-4">Courses Included</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($programs as $program)
                    <tr class="hover:bg-white/[0.02] transition-colors group">
                        <td class="px-6 py-4">
                            <strong class="text-white font-medium block">{{ $program->title }}</strong>
                            <small class="text-slate-500 block mt-1">{{ Str::limit($program->short_description, 50) }}</small>
                        </td>
                        <td class="px-6 py-4">
                            <code class="bg-slate-900 border border-white/10 text-cyan-400 px-2 py-1 rounded-md text-xs">{{ $program->slug }}</code>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-slate-300 text-sm"><i class="fa-regular fa-clock text-slate-500 mr-1"></i> {{ $program->duration }}</div>
                            <div class="text-emerald-400 text-sm font-semibold mt-1">{{ $program->currency }} {{ number_format($program->price, 2) }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($program->courses->count() > 0)
                                <span class="bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 px-2.5 py-1 rounded-lg text-xs font-medium">{{ $program->courses->count() }} courses</span>
                            @else
                                <span class="text-slate-500 text-xs italic">No courses</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($program->is_active)
                                <span class="px-3 py-1 rounded-full text-xs font-semibold border bg-emerald-500/10 text-emerald-400 border-emerald-500/20 shadow-[0_0_10px_rgba(16,185,129,0.1)]">Active</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-semibold border bg-slate-500/10 text-slate-400 border-slate-500/20">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.programs.show', $program) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white/5 text-slate-400 hover:bg-cyan-500/20 hover:text-cyan-400 transition-colors" title="View">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </a>
                                <a href="{{ route('admin.programs.edit', $program) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white/5 text-slate-400 hover:bg-emerald-500/20 hover:text-emerald-400 transition-colors" title="Edit">
                                    <i class="fa-solid fa-pen text-xs"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.programs.destroy', $program) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this program?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white/5 text-slate-400 hover:bg-red-500/20 hover:text-red-400 transition-colors" title="Delete">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-white/10">
            {{ $programs->links() }}
        </div>
    @else
        <div class="text-center py-16 px-6">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/[0.02] border border-white/5 mb-4">
                <i class="fa-solid fa-graduation-cap text-2xl text-slate-500"></i>
            </div>
            <h4 class="text-lg font-bold text-white mb-2">No programs found</h4>
            <p class="text-slate-400 max-w-sm mx-auto mb-6">Get started by creating your first educational program.</p>
            <a href="{{ route('admin.programs.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-white/10 text-white font-medium hover:bg-white/20 transition-colors">
                <i class="fa-solid fa-plus"></i> Create First Program
            </a>
        </div>
    @endif
</div>
@endsection
