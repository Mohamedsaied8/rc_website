@extends('admin.layout')

@section('title', 'Content')
@section('page-title', 'Blog, News & Papers')
@section('page-subtitle', 'Everything that appears on the public /blog page')

@section('page-actions')
    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">+ New Post</a>
@endsection

@section('content')
    @php
        $tabs = [
            ['label' => 'All', 'params' => [], 'active' => !$status && !$type],
            ['label' => 'Pending' . ($pendingCount ? ' (' . $pendingCount . ')' : ''), 'params' => ['status' => 'pending'], 'active' => $status === 'pending'],
            ['label' => 'Published', 'params' => ['status' => 'published'], 'active' => $status === 'published'],
            ['label' => 'Drafts', 'params' => ['status' => 'draft'], 'active' => $status === 'draft'],
            ['label' => 'Blog', 'params' => ['type' => 'blog'], 'active' => $type === 'blog'],
            ['label' => 'News', 'params' => ['type' => 'news'], 'active' => $type === 'news'],
            ['label' => 'Papers', 'params' => ['type' => 'paper'], 'active' => $type === 'paper'],
        ];
    @endphp

    @if($pendingCount > 0 && $status !== 'pending')
        <a href="{{ route('admin.blog.index', ['status' => 'pending']) }}"
           class="mb-6 flex items-center gap-3 rounded-xl border border-amber-500/25 bg-amber-500/10 px-5 py-4 text-amber-300 hover:bg-amber-500/15 transition-colors">
            <i class="fa-solid fa-hourglass-half"></i>
            <span class="font-semibold">{{ $pendingCount }} community {{ Str::plural('submission', $pendingCount) }} waiting for review</span>
            <i class="fa-solid fa-arrow-right ml-auto text-xs"></i>
        </a>
    @endif

    <div class="flex flex-wrap items-center gap-2 mb-6">
        @foreach($tabs as $tab)
            <a href="{{ route('admin.blog.index', $tab['params']) }}"
               class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ $tab['active'] ? 'bg-cyan-500/15 text-cyan-300 border border-cyan-500/30' : 'text-slate-400 border border-white/10 hover:bg-white/5 hover:text-white' }}">
                {{ $tab['label'] }}
            </a>
        @endforeach
    </div>

    @if($posts->count() > 0)
        <div class="space-y-3">
            @foreach($posts as $post)
                @php
                    $typeChip = match ($post->type) {
                        'news' => 'bg-amber-500/15 text-amber-300 border-amber-500/25',
                        'paper' => 'bg-violet-500/15 text-violet-300 border-violet-500/25',
                        default => 'bg-cyan-500/15 text-cyan-300 border-cyan-500/25',
                    };
                    $statusChip = match ($post->status) {
                        'published' => 'bg-emerald-500/15 text-emerald-300 border-emerald-500/25',
                        'pending' => 'bg-amber-500/15 text-amber-300 border-amber-500/25',
                        'rejected' => 'bg-red-500/15 text-red-300 border-red-500/25',
                        default => 'bg-white/5 text-slate-400 border-white/10',
                    };
                @endphp
                <div class="rounded-2xl border border-white/10 bg-white/[0.02] p-5 hover:bg-white/[0.04] transition-colors">
                    <div class="flex flex-col lg:flex-row lg:items-center gap-5">
                        <div class="w-full lg:w-28 h-24 lg:h-16 shrink-0 rounded-xl overflow-hidden border border-white/10 bg-slate-900 flex items-center justify-center">
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="" class="w-full h-full object-cover">
                            @else
                                <i class="{{ $post->type_icon }} text-slate-600"></i>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2 mb-2">
                                <span class="px-2 py-0.5 rounded-md border text-[10px] font-bold uppercase tracking-wider {{ $typeChip }}">{{ $post->type_label }}</span>
                                <span class="px-2 py-0.5 rounded-md border text-[10px] font-bold uppercase tracking-wider {{ $statusChip }}">{{ ucfirst($post->status) }}</span>
                                @if($post->featured)
                                    <span class="px-2 py-0.5 rounded-md border border-amber-500/25 bg-amber-500/10 text-amber-300 text-[10px] font-bold uppercase tracking-wider">
                                        <i class="fa-solid fa-star text-[9px]"></i> Featured
                                    </span>
                                @endif
                            </div>
                            <h3 class="text-white font-bold leading-snug truncate">{{ $post->title }}</h3>
                            <p class="mt-1 text-xs text-slate-500">
                                {{ $post->byline }}
                                @if($post->user_id)
                                    <span class="text-cyan-400/80">· community submission</span>
                                @endif
                                · {{ $post->formatted_date ?? 'not published' }}
                                @if($post->images->count()) · {{ $post->images->count() }} {{ Str::plural('image', $post->images->count()) }} @endif
                            </p>
                        </div>

                        <div class="flex flex-wrap items-center gap-2 shrink-0">
                            @if($post->status === 'pending')
                                <form method="POST" action="{{ route('admin.blog.approve', $post) }}">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-sm font-bold hover:bg-emerald-500/25 transition-colors">
                                        <i class="fa-solid fa-check"></i> Approve
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.blog.reject', $post) }}"
                                      onsubmit="this.rejection_reason.value = prompt('Reason for rejection (optional, shown to the author):') ?? ''">
                                    @csrf
                                    <input type="hidden" name="rejection_reason">
                                    <button type="submit" class="px-4 py-2 rounded-xl bg-red-500/10 border border-red-500/25 text-red-300 text-sm font-bold hover:bg-red-500/20 transition-colors">
                                        <i class="fa-solid fa-xmark"></i> Reject
                                    </button>
                                </form>
                            @endif

                            @if($post->status === 'published')
                                <a href="{{ route('blog.show', $post->slug) }}" target="_blank" title="View"
                                   class="w-9 h-9 rounded-xl border border-white/10 text-slate-400 hover:text-white hover:bg-white/10 flex items-center justify-center transition-colors">
                                    <i class="fa-solid fa-eye text-sm"></i>
                                </a>
                            @endif
                            <a href="{{ route('admin.blog.edit', $post) }}" title="Edit"
                               class="w-9 h-9 rounded-xl border border-white/10 text-slate-400 hover:text-cyan-300 hover:bg-cyan-500/10 flex items-center justify-center transition-colors">
                                <i class="fa-solid fa-pen text-sm"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.blog.destroy', $post) }}"
                                  onsubmit="return confirm('Delete this post? This cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Delete"
                                        class="w-9 h-9 rounded-xl border border-white/10 text-slate-400 hover:text-red-300 hover:bg-red-500/10 flex items-center justify-center transition-colors">
                                    <i class="fa-solid fa-trash text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">{{ $posts->links() }}</div>
    @else
        <div class="rounded-2xl border border-dashed border-white/10 py-20 text-center">
            <i class="fa-solid fa-newspaper text-3xl text-slate-600 mb-4"></i>
            <h3 class="text-white font-bold text-lg mb-2">Nothing here</h3>
            <p class="text-slate-500 mb-6">No content matches this filter.</p>
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">Create a post</a>
        </div>
    @endif
@endsection
