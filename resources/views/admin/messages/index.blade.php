@extends('admin.layout')

@section('title', 'Contact Messages')
@section('page-title', 'Messages & Inquiries')
@section('page-subtitle', 'Manage all messages received from the contact page and service inquiries.')

@section('content')
<div class="bg-white/[0.02] border border-white/10 rounded-2xl overflow-hidden shadow-xl mb-8">
    <div class="p-6 border-b border-white/10 flex justify-between items-center bg-white/[0.01]">
        <h3 class="text-lg font-bold text-white tracking-tight">Recent Messages</h3>
    </div>

    @if($messages->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead>
                    <tr class="bg-white/[0.02] text-xs uppercase tracking-wider text-slate-400 font-semibold border-b border-white/10">
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Sender</th>
                        <th class="px-6 py-4">Subject & Message</th>
                        <th class="px-6 py-4">Type</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($messages as $message)
                    <tr class="hover:bg-white/[0.02] transition-colors group {{ $message->is_read ? 'opacity-70' : '' }}">
                        <td class="px-6 py-4">
                            @if(!$message->is_read)
                                <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-pulse"></span> New
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-medium bg-slate-500/10 text-slate-400 border border-slate-500/20">
                                    Read
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <strong class="text-white font-medium block">{{ $message->name }}</strong>
                            <small class="text-slate-400 block mt-1">{{ $message->email }}</small>
                        </td>
                        <td class="px-6 py-4 max-w-xs truncate">
                            <span class="text-slate-200 font-semibold">{{ $message->subject }}</span>
                            <span class="text-slate-400 text-sm ml-2">- {{ Str::limit($message->message, 40) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-mono uppercase tracking-widest text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2 py-1 rounded">{{ $message->type }}</span>
                        </td>
                        <td class="px-6 py-4 text-slate-400 text-sm">
                            {{ $message->created_at->diffForHumans() }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('admin.messages.show', $message) }}" class="p-2 text-slate-400 hover:text-cyan-400 transition-colors" title="View Message">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-400 transition-colors" title="Delete">
                                        <i class="fa-regular fa-trash-can"></i>
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
            {{ $messages->links() }}
        </div>
    @else
        <div class="p-16 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/5 mb-4">
                <i class="fa-regular fa-envelope-open text-2xl text-slate-500"></i>
            </div>
            <h4 class="text-xl font-bold text-white mb-2">No messages yet</h4>
            <p class="text-slate-400 max-w-md mx-auto">When users send messages from the contact page or inquire about services, they will appear here.</p>
        </div>
    @endif
</div>
@endsection
