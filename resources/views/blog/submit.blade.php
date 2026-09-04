@extends('components.layout')

@section('title', 'Write a post - Robotics Corner')
@section('description', 'Share an engineering write-up, tutorial or project with the Robotics Corner community.')

@section('content')
    <section class="relative pt-32 pb-10 overflow-hidden">
        <div class="absolute inset-0 bg-grid opacity-30"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[340px] bg-cyan-500/[0.07] rounded-full blur-[150px]"></div>

        <div class="relative z-10 max-w-3xl mx-auto px-6">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-cyan-600 transition-colors mb-8">
                <i class="fa-solid fa-arrow-left text-[10px]"></i> Back to blog
            </a>
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight leading-[1.05] mb-5">
                Write a post
            </h1>
            <p class="text-lg text-slate-600 leading-relaxed">
                Share a project, a tutorial or something you figured out the hard way.
                An editor reviews every submission before it goes live.
            </p>
        </div>
    </section>

    <section class="relative z-10 max-w-3xl mx-auto px-6 pb-24">
        @if($errors->any())
            <div class="mb-8 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">
                <p class="flex items-center gap-2 text-sm font-bold text-red-700 mb-2">
                    <i class="fa-solid fa-circle-exclamation"></i> Please fix the following:
                </p>
                <ul class="list-disc list-inside space-y-1 text-sm text-red-600">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data"
              class="rounded-3xl border border-slate-200 bg-white shadow-sm p-6 md:p-10 space-y-8">
            @csrf

            <div>
                <label for="title" class="block text-sm font-bold text-slate-900 mb-2">Title <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required maxlength="255"
                       placeholder="e.g. Building a ROS 2 navigation stack on a $200 rover"
                       class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-cyan-400 focus:ring-4 focus:ring-cyan-100 outline-none transition-all">
            </div>

            <div>
                <label for="excerpt" class="block text-sm font-bold text-slate-900 mb-2">Summary</label>
                <textarea id="excerpt" name="excerpt" rows="2" maxlength="400"
                          placeholder="One or two sentences shown on the blog card."
                          class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-cyan-400 focus:ring-4 focus:ring-cyan-100 outline-none transition-all resize-y">{{ old('excerpt') }}</textarea>
                <p class="mt-2 text-xs text-slate-400">Leave blank and we'll use the opening of your post.</p>
            </div>

            <div>
                <label for="content" class="block text-sm font-bold text-slate-900 mb-2">Post <span class="text-red-500">*</span></label>
                @include('components.markdown-editor', [
                    'name' => 'content',
                    'value' => old('content'),
                    'previewUrl' => route('blog.preview'),
                    'dark' => false,
                    'required' => true,
                    'rows' => 18,
                    'placeholder' => 'Write your post here. Use the toolbar above, or switch to Markdown.',
                ])
                <p class="mt-2 text-xs text-slate-400">
                    Hit <strong class="font-semibold text-slate-500">Preview</strong> to see exactly how it will look on the site.
                    Raw HTML is stripped for safety.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="featured_image" class="block text-sm font-bold text-slate-900 mb-2">Cover image</label>
                    <input type="file" id="featured_image" name="featured_image" accept="image/*"
                           class="w-full text-sm text-slate-500 file:mr-4 file:px-4 file:py-2.5 file:rounded-lg file:border-0 file:bg-slate-900 file:text-white file:text-sm file:font-bold hover:file:bg-slate-800 file:cursor-pointer cursor-pointer">
                    <p class="mt-2 text-xs text-slate-400">1200×630 recommended, max 5MB.</p>
                </div>
                <div>
                    <label for="tags" class="block text-sm font-bold text-slate-900 mb-2">Topics</label>
                    <input type="text" id="tags" name="tags" value="{{ old('tags') }}" maxlength="255"
                           placeholder="ros2, slam, embedded"
                           class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-cyan-400 focus:ring-4 focus:ring-cyan-100 outline-none transition-all">
                    <p class="mt-2 text-xs text-slate-400">Comma separated, up to 5.</p>
                </div>
            </div>

            <div class="flex items-start gap-3 rounded-2xl bg-slate-50 border border-slate-200 px-5 py-4">
                <i class="fa-solid fa-circle-info text-cyan-500 mt-0.5"></i>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Your post is submitted as <strong class="text-slate-900">pending review</strong>. You'll see its
                    status on <a href="{{ route('blog.mine') }}" class="text-cyan-700 font-semibold hover:underline">My posts</a>,
                    and it appears on the blog once an editor approves it.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3 pt-2">
                <button type="submit" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl bg-gradient-to-r from-cyan-400 to-emerald-400 text-slate-900 font-bold hover:shadow-[0_0_28px_rgba(34,211,238,0.4)] hover:-translate-y-0.5 transition-all duration-300">
                    <i class="fa-solid fa-paper-plane"></i> Submit for review
                </button>
                <a href="{{ route('blog.index') }}" class="px-6 py-3.5 rounded-xl border border-slate-200 text-slate-600 font-semibold hover:bg-slate-50 transition-colors">Cancel</a>
            </div>
        </form>
    </section>
@endsection
