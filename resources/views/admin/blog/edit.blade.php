@extends('admin.layout')

@section('title', 'Edit Post')
@section('page-title', 'Edit Content')
@section('page-subtitle', $post->title)

@section('page-actions')
    @if($post->status === 'published')
        <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="btn btn-secondary">
            <i class="fa-solid fa-eye"></i>&nbsp; View live
        </a>
    @endif
@endsection

@section('content')
    @if($post->status === 'pending')
        <div class="mb-6 rounded-xl border border-amber-500/25 bg-amber-500/10 px-5 py-4">
            <p class="text-amber-300 font-semibold mb-3">
                <i class="fa-solid fa-hourglass-half"></i>
                Community submission from {{ $post->user?->name ?? $post->author }} — awaiting review.
            </p>
            <div class="flex flex-wrap gap-2">
                <form method="POST" action="{{ route('admin.blog.approve', $post) }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-sm font-bold hover:bg-emerald-500/25 transition-colors">
                        <i class="fa-solid fa-check"></i> Approve &amp; publish
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
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.blog.update', $post) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.blog._form', ['post' => $post, 'submitLabel' => 'Save Changes'])
    </form>
@endsection
