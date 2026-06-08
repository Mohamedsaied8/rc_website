@extends('admin.layout')

@section('title', 'View Message')
@section('page-title', 'Message Details')
@section('page-subtitle', 'Viewing inquiry from ' . $message->name)

@section('page-actions')
    <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/5 border border-white/10 text-white hover:bg-white/10 transition-colors">
        <i class="fa-solid fa-arrow-left text-xs"></i>
        <span>Back to Messages</span>
    </a>
@endsection

@section('content')
<div class="grid md:grid-cols-3 gap-8">
    <div class="md:col-span-2">
        <div class="bg-white/[0.02] border border-white/10 rounded-2xl p-8 shadow-xl">
            <div class="flex items-start justify-between mb-8 pb-6 border-b border-white/10">
                <div>
                    <h3 class="text-2xl font-bold text-white mb-2">{{ $message->subject ?: 'No Subject' }}</h3>
                    <div class="flex items-center gap-3 text-sm text-slate-400">
                        <span><i class="fa-regular fa-calendar mr-1"></i> {{ $message->created_at->format('F j, Y - g:i A') }}</span>
                        <span class="w-1 h-1 rounded-full bg-slate-600"></span>
                        <span class="uppercase tracking-wider font-mono text-xs text-emerald-400">{{ $message->type }}</span>
                    </div>
                </div>
            </div>
            
            <div class="prose prose-invert prose-slate max-w-none">
                <p class="text-slate-300 leading-relaxed whitespace-pre-line">{{ $message->message }}</p>
            </div>
        </div>
    </div>
    
    <div class="md:col-span-1 space-y-6">
        <div class="bg-white/[0.02] border border-white/10 rounded-2xl p-6 shadow-xl">
            <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-6">Sender Details</h4>
            
            <div class="space-y-4">
                <div>
                    <span class="block text-xs text-slate-500 mb-1">Name</span>
                    <strong class="text-white">{{ $message->name }}</strong>
                </div>
                <div>
                    <span class="block text-xs text-slate-500 mb-1">Email</span>
                    <a href="mailto:{{ $message->email }}" class="text-cyan-400 hover:text-cyan-300 transition-colors">{{ $message->email }}</a>
                </div>
            </div>
            
            <div class="mt-8 pt-6 border-t border-white/10">
                <a href="mailto:{{ $message->email }}?subject=Re: {{ urlencode($message->subject) }}" class="flex items-center justify-center gap-2 w-full py-3 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded-xl hover:bg-blue-500/20 transition-colors font-medium">
                    <i class="fa-solid fa-reply"></i> Reply via Email
                </a>
            </div>
        </div>
        
        <div class="bg-white/[0.02] border border-white/10 rounded-2xl p-6 shadow-xl">
            <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-6">Actions</h4>
            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this message?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="flex items-center justify-center gap-2 w-full py-3 bg-red-500/10 text-red-400 border border-red-500/20 rounded-xl hover:bg-red-500/20 transition-colors font-medium">
                    <i class="fa-solid fa-trash-can"></i> Delete Message
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
