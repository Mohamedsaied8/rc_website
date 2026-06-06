@extends('admin.layout')

@section('title', 'Enrollment Details')
@section('page-title', 'Application Details')
@section('page-subtitle', $enrollment->first_name . ' ' . $enrollment->last_name . ' - ' . $enrollment->selected_program)

@section('page-actions')
    <a href="{{ route('admin.enrollments.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/[0.05] border border-white/10 text-slate-300 hover:bg-white/[0.1] hover:text-white transition-colors">
        <i class="fa-solid fa-arrow-left text-xs"></i>
        <span class="text-sm font-medium">Back to Enrollments</span>
    </a>
@endsection

@section('content')

<div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
    
    <!-- Left Column: Applicant Info & Responses -->
    <div class="xl:col-span-2 space-y-8">
        
        <!-- Personal Information -->
        <div class="bg-white/[0.02] border border-white/10 rounded-2xl overflow-hidden shadow-xl">
            <div class="p-6 border-b border-white/10 bg-white/[0.01]">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-400/20 to-emerald-400/10 border border-white/10 flex items-center justify-center text-xl font-bold text-cyan-400 shadow-[0_0_15px_rgba(34,211,238,0.15)]">
                        {{ substr($enrollment->first_name, 0, 1) }}{{ substr($enrollment->last_name, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">{{ $enrollment->first_name }} {{ $enrollment->last_name }}</h3>
                        <p class="text-sm text-slate-400 mt-1">Submitted {{ $enrollment->created_at->format('M d, Y \a\t h:i A') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Email Address</span>
                    <a href="mailto:{{ $enrollment->email }}" class="text-cyan-400 hover:text-cyan-300 font-medium inline-flex items-center gap-2"><i class="fa-solid fa-envelope"></i> {{ $enrollment->email }}</a>
                </div>
                <div>
                    <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Phone Number</span>
                    <a href="tel:{{ $enrollment->phone }}" class="text-emerald-400 hover:text-emerald-300 font-medium inline-flex items-center gap-2"><i class="fa-solid fa-phone"></i> {{ $enrollment->phone }}</a>
                </div>
                <div>
                    <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Location</span>
                    <p class="text-slate-300 inline-flex items-center gap-2"><i class="fa-solid fa-location-dot text-slate-500"></i> {{ $enrollment->city }}, {{ $enrollment->country }}</p>
                </div>
                <div>
                    <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Education Level</span>
                    <p class="text-slate-300 inline-flex items-center gap-2"><i class="fa-solid fa-graduation-cap text-slate-500"></i> {{ ucwords(str_replace('_', ' ', $enrollment->education_level)) }}</p>
                </div>
            </div>
        </div>

        <!-- Experience & Motivation -->
        <div class="bg-white/[0.02] border border-white/10 rounded-2xl overflow-hidden shadow-xl">
            <div class="p-6 border-b border-white/10 bg-white/[0.01]">
                <h3 class="text-lg font-bold text-white flex items-center gap-2"><i class="fa-solid fa-clipboard-user text-cyan-400"></i> Applicant Responses</h3>
            </div>
            
            <div class="p-6 space-y-6">
                <div>
                    <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Technical Experience</span>
                    <div class="p-4 rounded-xl bg-slate-900/50 border border-white/5 text-slate-300 text-sm leading-relaxed whitespace-pre-wrap">
                        {{ $enrollment->experience }}
                    </div>
                </div>
                
                <div>
                    <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Motivation to Join</span>
                    <div class="p-4 rounded-xl bg-slate-900/50 border border-white/5 text-slate-300 text-sm leading-relaxed whitespace-pre-wrap">
                        {{ $enrollment->motivation }}
                    </div>
                </div>

                @if($enrollment->additional_notes)
                <div>
                    <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Additional Notes</span>
                    <div class="p-4 rounded-xl bg-slate-900/50 border border-white/5 text-slate-300 text-sm leading-relaxed whitespace-pre-wrap">
                        {{ $enrollment->additional_notes }}
                    </div>
                </div>
                @endif
            </div>
        </div>
        
    </div>
    
    <!-- Right Column: Status & Logistics -->
    <div class="space-y-8">
        
        <!-- Application Status Form -->
        <div class="bg-white/[0.02] border border-cyan-500/20 rounded-2xl overflow-hidden shadow-[0_0_30px_rgba(34,211,238,0.05)]">
            <div class="p-6 border-b border-white/10 bg-cyan-500/5">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2"><i class="fa-solid fa-list-check text-cyan-400"></i> Review Decision</h3>
                    @php
                        $statusColors = [
                            'pending' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                            'approved' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                            'rejected' => 'bg-red-500/10 text-red-400 border-red-500/20',
                            'completed' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                        ];
                        $colorClass = $statusColors[$enrollment->status] ?? 'bg-slate-500/10 text-slate-400 border-slate-500/20';
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $colorClass }} shadow-lg uppercase tracking-wider">
                        {{ $enrollment->status }}
                    </span>
                </div>
            </div>
            
            <div class="p-6">
                <form method="POST" action="{{ route('admin.enrollments.update-status', $enrollment) }}" class="space-y-5">
                    @csrf
                    @method('PATCH')
                    
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-300 mb-2">Update Status</label>
                        <div class="relative">
                            <select id="status" name="status" required class="w-full pl-4 pr-10 py-3 bg-slate-900/80 border border-white/10 rounded-xl text-white appearance-none focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors">
                                <option value="pending" {{ $enrollment->status === 'pending' ? 'selected' : '' }}>Pending Review</option>
                                <option value="approved" {{ $enrollment->status === 'approved' ? 'selected' : '' }}>Approve Application</option>
                                <option value="rejected" {{ $enrollment->status === 'rejected' ? 'selected' : '' }}>Reject Application</option>
                                <option value="completed" {{ $enrollment->status === 'completed' ? 'selected' : '' }}>Mark as Completed</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label for="admin_notes" class="block text-sm font-medium text-slate-300 mb-2">Internal Admin Notes</label>
                        <textarea id="admin_notes" name="admin_notes" rows="3" placeholder="Add private notes (not visible to applicant)..." 
                            class="w-full p-4 bg-slate-900/80 border border-white/10 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors text-sm resize-y">{{ old('admin_notes', $enrollment->admin_notes) }}</textarea>
                    </div>
                    
                    <button type="submit" class="w-full py-3 px-4 bg-white text-slate-900 font-bold rounded-xl hover:bg-slate-200 transition-colors shadow-lg shadow-white/5 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i> Save Decision
                    </button>
                </form>
            </div>
            
            @if($enrollment->admin_notes)
            <div class="px-6 pb-6 pt-0">
                <div class="p-4 rounded-xl bg-amber-500/10 border border-amber-500/20 flex gap-3">
                    <i class="fa-solid fa-note-sticky text-amber-400 mt-0.5"></i>
                    <div>
                        <span class="block text-xs font-bold text-amber-400 uppercase tracking-wider mb-1">Saved Notes</span>
                        <p class="text-sm text-slate-300 whitespace-pre-wrap">{{ $enrollment->admin_notes }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Enrollment Logistics -->
        <div class="bg-white/[0.02] border border-white/10 rounded-2xl overflow-hidden shadow-xl">
            <div class="p-6 border-b border-white/10 bg-white/[0.01]">
                <h3 class="text-lg font-bold text-white flex items-center gap-2"><i class="fa-solid fa-compass text-cyan-400"></i> Logistics</h3>
            </div>
            
            <div class="p-6 space-y-5">
                <div>
                    <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Target Program</span>
                    <p class="text-white font-medium bg-white/5 px-3 py-2 rounded-lg border border-white/5 inline-block">{{ $enrollment->selected_program }}</p>
                </div>
                
                <div>
                    <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Schedule Preference</span>
                    <p class="text-slate-300 inline-flex items-center gap-2"><i class="fa-regular fa-calendar text-slate-500"></i> {{ ucwords($enrollment->preferred_schedule) }}</p>
                </div>
                
                <div class="pt-4 border-t border-white/10">
                    <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Payment Details</span>
                    
                    @if($enrollment->payment_method)
                        <div class="mb-4 inline-flex items-center gap-2 px-3 py-1.5 rounded-lg {{ $enrollment->payment_method === 'instapay' ? 'bg-purple-500/10 text-purple-400 border border-purple-500/20' : 'bg-slate-500/10 text-slate-300 border border-slate-500/20' }}">
                            <i class="fa-solid {{ $enrollment->payment_method === 'instapay' ? 'fa-building-columns' : 'fa-headset' }}"></i>
                            <span class="font-medium text-sm">{{ ucfirst(str_replace('_', ' ', $enrollment->payment_method)) }}</span>
                        </div>
                    @else
                        <p class="text-slate-500 text-sm mb-4">Not specified</p>
                    @endif
                    
                    @if($enrollment->payment_screenshot)
                        <div class="mt-2" x-data="{ imgModal: false }">
                            <span class="block text-xs font-semibold text-slate-400 mb-2">Transfer Receipt</span>
                            <div class="relative group rounded-xl overflow-hidden border border-white/10 bg-black aspect-video cursor-pointer" @click="imgModal = true">
                                <img src="{{ asset('storage/' . $enrollment->payment_screenshot) }}" alt="Receipt" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end justify-center pb-3">
                                    <span class="text-xs font-bold text-white bg-black/50 px-3 py-1 rounded-full backdrop-blur-sm"><i class="fa-solid fa-expand mr-1"></i> Expand</span>
                                </div>
                            </div>
                            
                            <!-- Image Modal -->
                            <template x-teleport="body">
                                <div x-show="imgModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/90 backdrop-blur-sm p-4" x-transition.opacity style="display: none;">
                                    <div class="relative max-w-4xl w-full h-full flex flex-col items-center justify-center">
                                        <button @click="imgModal = false" class="absolute top-4 right-4 w-12 h-12 bg-white/10 hover:bg-white/20 text-white rounded-full flex items-center justify-center transition-colors">
                                            <i class="fa-solid fa-xmark text-xl"></i>
                                        </button>
                                        <img src="{{ asset('storage/' . $enrollment->payment_screenshot) }}" alt="Receipt Full" class="max-w-full max-h-[85vh] object-contain rounded-lg border border-white/20 shadow-2xl">
                                        <a href="{{ asset('storage/' . $enrollment->payment_screenshot) }}" target="_blank" class="mt-4 px-6 py-2 bg-cyan-500/20 text-cyan-400 hover:bg-cyan-500/30 rounded-full text-sm font-medium transition-colors border border-cyan-500/30">
                                            Open in New Tab <i class="fa-solid fa-external-link-alt ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </template>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection
