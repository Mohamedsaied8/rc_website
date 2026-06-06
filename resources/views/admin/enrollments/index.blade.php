@extends('admin.layout')

@section('title', 'Enrollments Management')
@section('page-title', 'Enrollments')
@section('page-subtitle', 'Manage and review student applications.')

@section('page-actions')
    <!-- Filter form can go here if needed, but we'll put it above the table for better layout -->
@endsection

@section('content')

<!-- Filters and Search -->
<div class="bg-white/[0.02] border border-white/10 rounded-2xl p-4 sm:p-6 mb-8 shadow-xl">
    <form method="GET" class="flex flex-col sm:flex-row gap-4 items-center justify-between">
        <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-4 flex-1">
            <div class="relative w-full sm:w-96">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500">
                    <i class="fa-solid fa-search"></i>
                </div>
                <input type="text" name="search" placeholder="Search by name or email..." value="{{ request('search') }}"
                    class="w-full pl-11 pr-4 py-2.5 bg-slate-900/50 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors">
            </div>
            
            <div class="relative w-full sm:w-48">
                <select name="status" class="w-full pl-4 pr-10 py-2.5 bg-slate-900/50 border border-white/10 rounded-xl text-white appearance-none focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                    <i class="fa-solid fa-chevron-down text-xs"></i>
                </div>
            </div>
            
            <button type="submit" class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-white/[0.05] border border-white/10 text-white font-medium hover:bg-white/[0.1] transition-colors">
                Filter
            </button>
            
            @if(request('search') || request('status'))
                <a href="{{ route('admin.enrollments.index') }}" class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 font-medium hover:bg-red-500/20 transition-colors text-center">
                    Clear
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Enrollments Table -->
<div class="bg-white/[0.02] border border-white/10 rounded-2xl overflow-hidden shadow-xl mb-8">
    @if($enrollments->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead>
                    <tr class="bg-white/[0.02] text-xs uppercase tracking-wider text-slate-400 font-semibold border-b border-white/10">
                        <th class="px-6 py-4">Applicant Info</th>
                        <th class="px-6 py-4">Program</th>
                        <th class="px-6 py-4">Payment</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Applied On</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($enrollments as $enrollment)
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-400/20 to-emerald-400/10 border border-white/10 flex items-center justify-center text-sm font-bold text-cyan-400 shadow-[0_0_10px_rgba(34,211,238,0.1)]">
                                        {{ substr($enrollment->first_name, 0, 1) }}{{ substr($enrollment->last_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-white">{{ $enrollment->first_name }} {{ $enrollment->last_name }}</p>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            <a href="mailto:{{ $enrollment->email }}" class="text-xs text-slate-400 hover:text-cyan-400 transition-colors"><i class="fa-solid fa-envelope mr-1"></i>{{ $enrollment->email }}</a>
                                            <span class="text-slate-600">&bull;</span>
                                            <span class="text-xs text-slate-500"><i class="fa-solid fa-location-dot mr-1"></i>{{ $enrollment->country }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-slate-300">{{ $enrollment->selected_program }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($enrollment->payment_method)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-medium {{ $enrollment->payment_method === 'instapay' ? 'bg-purple-500/10 text-purple-400 border border-purple-500/20' : 'bg-slate-500/10 text-slate-400 border border-slate-500/20' }}">
                                        <i class="fa-solid {{ $enrollment->payment_method === 'instapay' ? 'fa-building-columns' : 'fa-headset' }}"></i>
                                        {{ ucfirst(str_replace('_', ' ', $enrollment->payment_method)) }}
                                    </span>
                                @else
                                    <span class="text-xs text-slate-500">Not specified</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-amber-500/10 text-amber-400 border-amber-500/20 shadow-[0_0_10px_rgba(245,158,11,0.1)]',
                                        'approved' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20 shadow-[0_0_10px_rgba(16,185,129,0.1)]',
                                        'rejected' => 'bg-red-500/10 text-red-400 border-red-500/20 shadow-[0_0_10px_rgba(239,68,68,0.1)]',
                                        'completed' => 'bg-blue-500/10 text-blue-400 border-blue-500/20 shadow-[0_0_10px_rgba(59,130,246,0.1)]',
                                    ];
                                    $colorClass = $statusColors[$enrollment->status] ?? 'bg-slate-500/10 text-slate-400 border-slate-500/20';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $colorClass }}">
                                    {{ ucfirst($enrollment->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-slate-400">{{ $enrollment->created_at->format('M d, Y') }}</span>
                                <div class="text-xs text-slate-600 mt-0.5">{{ $enrollment->created_at->format('h:i A') }}</div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.enrollments.show', $enrollment) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/[0.05] border border-white/10 text-slate-300 hover:bg-cyan-500/20 hover:text-cyan-400 hover:border-cyan-500/30 transition-all">
                                    <span class="text-sm font-medium">Review</span>
                                    <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-white/10">
            <!-- Custom pagination styling can be applied here or via Laravel's pagination views -->
            {{ $enrollments->appends(request()->query())->links() }}
        </div>
    @else
        <div class="text-center py-16 px-6">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/[0.02] border border-white/5 mb-4">
                <i class="fa-solid fa-folder-open text-2xl text-slate-500"></i>
            </div>
            <h4 class="text-lg font-bold text-white mb-2">No enrollments found</h4>
            <p class="text-slate-400 max-w-sm mx-auto mb-6">We couldn't find any enrollments matching your current filters. Try adjusting your search criteria.</p>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.enrollments.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-white/10 text-white font-medium hover:bg-white/20 transition-colors">
                    <i class="fa-solid fa-xmark"></i> Clear Filters
                </a>
            @endif
        </div>
    @endif
</div>

@endsection
