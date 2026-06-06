@extends('admin.layout')

@section('title', 'Admin Dashboard')
@section('page-title', 'Overview')
@section('page-subtitle', 'Monitor your platform metrics and recent activities.')

@section('content')

<!-- Stat Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white/[0.03] border border-white/10 rounded-2xl p-6 relative overflow-hidden group hover:border-cyan-500/30 transition-colors">
        <div class="absolute top-0 right-0 w-24 h-24 bg-cyan-500/10 rounded-bl-[100px] -z-10 group-hover:bg-cyan-500/20 transition-colors"></div>
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-cyan-500/10 flex items-center justify-center text-cyan-400 text-xl border border-cyan-500/20">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>
        <div>
            <div class="text-3xl font-bold text-white mb-1">{{ $stats['total_enrollments'] }}</div>
            <div class="text-sm font-medium text-slate-400 uppercase tracking-wider">Total Enrollments</div>
        </div>
    </div>

    <div class="bg-white/[0.03] border border-white/10 rounded-2xl p-6 relative overflow-hidden group hover:border-amber-500/30 transition-colors">
        <div class="absolute top-0 right-0 w-24 h-24 bg-amber-500/10 rounded-bl-[100px] -z-10 group-hover:bg-amber-500/20 transition-colors"></div>
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-amber-500/10 flex items-center justify-center text-amber-400 text-xl border border-amber-500/20">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
        </div>
        <div>
            <div class="text-3xl font-bold text-white mb-1">{{ $stats['pending_enrollments'] }}</div>
            <div class="text-sm font-medium text-slate-400 uppercase tracking-wider">Pending Approvals</div>
        </div>
    </div>

    <div class="bg-white/[0.03] border border-white/10 rounded-2xl p-6 relative overflow-hidden group hover:border-emerald-500/30 transition-colors">
        <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500/10 rounded-bl-[100px] -z-10 group-hover:bg-emerald-500/20 transition-colors"></div>
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-400 text-xl border border-emerald-500/20">
                <i class="fa-solid fa-check-double"></i>
            </div>
        </div>
        <div>
            <div class="text-3xl font-bold text-white mb-1">{{ $stats['approved_enrollments'] }}</div>
            <div class="text-sm font-medium text-slate-400 uppercase tracking-wider">Approved Students</div>
        </div>
    </div>

    <div class="bg-white/[0.03] border border-white/10 rounded-2xl p-6 relative overflow-hidden group hover:border-blue-500/30 transition-colors">
        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500/10 rounded-bl-[100px] -z-10 group-hover:bg-blue-500/20 transition-colors"></div>
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-400 text-xl border border-blue-500/20">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
        </div>
        <div>
            <div class="text-3xl font-bold text-white mb-1">{{ $stats['total_programs'] }}</div>
            <div class="text-sm font-medium text-slate-400 uppercase tracking-wider">Active Programs</div>
        </div>
    </div>

    <div class="bg-white/[0.03] border border-white/10 rounded-2xl p-6 relative overflow-hidden group hover:border-purple-500/30 transition-colors">
        <div class="absolute top-0 right-0 w-24 h-24 bg-purple-500/10 rounded-bl-[100px] -z-10 group-hover:bg-purple-500/20 transition-colors"></div>
        <div class="flex items-start justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-purple-500/10 flex items-center justify-center text-purple-400 text-xl border border-purple-500/20">
                <i class="fa-solid fa-book-open"></i>
            </div>
        </div>
        <div>
            <div class="text-3xl font-bold text-white mb-1">{{ $stats['active_courses'] }} <span class="text-lg text-slate-500 font-normal">/ {{ $stats['total_courses'] }}</span></div>
            <div class="text-sm font-medium text-slate-400 uppercase tracking-wider">Active Courses</div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
    
    <!-- Recent Enrollments Table -->
    <div class="xl:col-span-2">
        <div class="bg-white/[0.02] border border-white/10 rounded-2xl overflow-hidden shadow-xl">
            <div class="p-6 border-b border-white/10 flex justify-between items-center">
                <h3 class="text-lg font-bold text-white tracking-tight">Recent Enrollments</h3>
                <a href="{{ route('admin.enrollments.index') }}" class="text-sm text-cyan-400 hover:text-cyan-300 font-medium transition-colors">View All &rarr;</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left whitespace-nowrap">
                    <thead>
                        <tr class="bg-white/[0.02] text-xs uppercase tracking-wider text-slate-400 font-semibold border-b border-white/10">
                            <th class="px-6 py-4">Applicant</th>
                            <th class="px-6 py-4">Program</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($recent_enrollments as $enrollment)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-xs font-bold text-slate-300">
                                            {{ substr($enrollment->first_name, 0, 1) }}{{ substr($enrollment->last_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-medium text-white text-sm">{{ $enrollment->first_name }} {{ $enrollment->last_name }}</p>
                                            <p class="text-xs text-slate-500">{{ $enrollment->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-slate-300">{{ $enrollment->selected_program }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                            'approved' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                            'rejected' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                            'completed' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                        ];
                                        $colorClass = $statusColors[$enrollment->status] ?? 'bg-slate-500/10 text-slate-400 border-slate-500/20';
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $colorClass }}">
                                        {{ ucfirst($enrollment->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-slate-400">{{ $enrollment->created_at->format('M d, Y') }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.enrollments.show', $enrollment) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white/5 text-slate-400 hover:bg-cyan-500/20 hover:text-cyan-400 transition-colors">
                                        <i class="fa-solid fa-chevron-right text-xs"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-slate-500 text-sm">
                                    No recent enrollments found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Right Sidebar Widgets -->
    <div class="space-y-8">
        
        <!-- Quick Actions -->
        <div class="bg-white/[0.02] border border-white/10 rounded-2xl p-6">
            <h3 class="text-lg font-bold text-white tracking-tight mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="{{ route('admin.programs.create') }}" class="flex items-center gap-3 w-full p-3 rounded-xl bg-gradient-to-r from-cyan-400/10 to-emerald-400/10 border border-cyan-500/20 text-cyan-400 hover:bg-cyan-500/20 transition-colors group">
                    <div class="w-8 h-8 rounded-lg bg-cyan-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-plus text-sm"></i>
                    </div>
                    <span class="font-medium">Create New Program</span>
                </a>
                
                <a href="{{ route('admin.courses.create') }}" class="flex items-center gap-3 w-full p-3 rounded-xl bg-white/[0.02] border border-white/10 text-slate-300 hover:bg-white/[0.06] transition-colors group">
                    <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-book-open text-sm"></i>
                    </div>
                    <span class="font-medium">Add New Course</span>
                </a>
            </div>
        </div>

        <!-- System Status -->
        <div class="bg-white/[0.02] border border-white/10 rounded-2xl p-6">
            <h3 class="text-lg font-bold text-white tracking-tight mb-4">System Health</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.8)]"></div>
                        <span class="text-sm font-medium text-slate-300">Database</span>
                    </div>
                    <span class="text-xs text-slate-500">Connected</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.8)]"></div>
                        <span class="text-sm font-medium text-slate-300">File Storage</span>
                    </div>
                    <span class="text-xs text-slate-500">Active</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.8)]"></div>
                        <span class="text-sm font-medium text-slate-300">Enrollment Portal</span>
                    </div>
                    <span class="text-xs text-slate-500">Live</span>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
