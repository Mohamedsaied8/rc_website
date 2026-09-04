@php
    /**
     * Markdown editor with a Basic/Markdown mode switch and a server-rendered preview.
     *
     * Props:
     *   name        textarea name        value      initial content
     *   previewUrl  POST endpoint        dark       admin (dark) vs public (light) chrome
     *   titleField / excerptField        ids read into the preview header
     */
    $name = $name ?? 'content';
    $value = $value ?? '';
    $rows = $rows ?? 16;
    $dark = $dark ?? false;
    $required = $required ?? false;
    $titleField = $titleField ?? 'title';
    $excerptField = $excerptField ?? 'excerpt';
    $placeholder = $placeholder ?? 'Write your post here…';

    // Toolbar: the "basic" writing options — headings, normal text, emphasis, lists.
    $tools = [
        ['action' => "setBlock('# ')",   'label' => 'H1', 'title' => 'Heading 1', 'text' => true],
        ['action' => "setBlock('## ')",  'label' => 'H2', 'title' => 'Heading 2', 'text' => true],
        ['action' => "setBlock('### ')", 'label' => 'H3', 'title' => 'Heading 3', 'text' => true],
        ['action' => "setBlock('')",     'label' => 'Normal text', 'title' => 'Normal text', 'text' => true],
        ['divider' => true],
        ['action' => "wrap('**', 'bold text')", 'icon' => 'fa-solid fa-bold', 'title' => 'Bold'],
        ['action' => "wrap('*', 'italic text')", 'icon' => 'fa-solid fa-italic', 'title' => 'Italic'],
        ['action' => "wrap('`', 'code')", 'icon' => 'fa-solid fa-code', 'title' => 'Inline code'],
        ['divider' => true],
        ['action' => "setBlock('- ')", 'icon' => 'fa-solid fa-list-ul', 'title' => 'Bullet list'],
        ['action' => "setBlock('1. ')", 'icon' => 'fa-solid fa-list-ol', 'title' => 'Numbered list'],
        ['action' => "setBlock('> ')", 'icon' => 'fa-solid fa-quote-left', 'title' => 'Quote'],
        ['action' => 'insertLink()', 'icon' => 'fa-solid fa-link', 'title' => 'Link'],
    ];

    // Chrome differs between the dark admin and the light public form; the preview
    // pane itself is always light, because that's what the website looks like.
    $c = $dark
        ? [
            'shell' => 'border-white/10 bg-white/[0.02]',
            'bar' => 'border-white/10',
            'tab' => 'text-slate-400 hover:text-white hover:bg-white/5',
            'tabOn' => 'bg-cyan-500/15 text-cyan-300 border border-cyan-500/30',
            'seg' => 'bg-white/[0.04] border-white/10',
            'segOn' => 'bg-white text-slate-900',
            'segOff' => 'text-slate-400 hover:text-white',
            'tool' => 'text-slate-400 hover:text-white hover:bg-white/10',
            'divider' => 'bg-white/10',
            'area' => 'bg-slate-950/40 text-slate-100 placeholder:text-slate-600 border-white/10 focus:border-cyan-500/50',
            'foot' => 'text-slate-500 border-white/10',
        ]
        : [
            'shell' => 'border-slate-200 bg-white',
            'bar' => 'border-slate-200',
            'tab' => 'text-slate-500 hover:text-slate-900 hover:bg-slate-100',
            'tabOn' => 'bg-slate-900 text-white',
            'seg' => 'bg-slate-100 border-slate-200',
            'segOn' => 'bg-white text-slate-900 shadow-sm',
            'segOff' => 'text-slate-500 hover:text-slate-900',
            'tool' => 'text-slate-500 hover:text-slate-900 hover:bg-slate-100',
            'divider' => 'bg-slate-200',
            'area' => 'bg-slate-50 text-slate-900 placeholder:text-slate-400 border-slate-200 focus:border-cyan-400 focus:bg-white',
            'foot' => 'text-slate-400 border-slate-100',
        ];
@endphp

<div
    x-data="markdownEditor({
        value: @js($value),
        previewUrl: @js($previewUrl),
        csrf: @js(csrf_token()),
        titleField: @js($titleField),
        excerptField: @js($excerptField),
    })"
    class="rounded-2xl border overflow-hidden {{ $c['shell'] }}"
>
    {{-- Write / Preview tabs + mode switch --}}
    <div class="flex flex-wrap items-center justify-between gap-3 px-3 py-2.5 border-b {{ $c['bar'] }}">
        <div class="flex items-center gap-1">
            <button type="button" @click="tab = 'write'"
                    class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg text-sm font-bold transition-colors cursor-pointer"
                    :class="tab === 'write' ? '{{ $c['tabOn'] }}' : '{{ $c['tab'] }}'">
                <i class="fa-solid fa-pen text-xs"></i> Write
            </button>
            <button type="button" @click="showPreview()"
                    class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg text-sm font-bold transition-colors cursor-pointer"
                    :class="tab === 'preview' ? '{{ $c['tabOn'] }}' : '{{ $c['tab'] }}'">
                <i class="fa-solid fa-eye text-xs"></i> Preview
            </button>
        </div>

        <div class="inline-flex items-center gap-1 p-1 rounded-lg border {{ $c['seg'] }}" x-show="tab === 'write'">
            <button type="button" @click="setMode('basic')"
                    class="px-3 py-1.5 rounded-md text-xs font-bold transition-colors cursor-pointer"
                    :class="mode === 'basic' ? '{{ $c['segOn'] }}' : '{{ $c['segOff'] }}'">Basic</button>
            <button type="button" @click="setMode('markdown')"
                    class="px-3 py-1.5 rounded-md text-xs font-bold transition-colors cursor-pointer"
                    :class="mode === 'markdown' ? '{{ $c['segOn'] }}' : '{{ $c['segOff'] }}'">Markdown</button>
        </div>
    </div>

    {{-- Formatting toolbar (basic mode only) --}}
    <div class="flex flex-wrap items-center gap-1 px-3 py-2 border-b {{ $c['bar'] }}"
         x-show="tab === 'write' && mode === 'basic'" x-cloak>
        @foreach($tools as $tool)
            @if($tool['divider'] ?? false)
                <span class="w-px h-5 mx-1 {{ $c['divider'] }}"></span>
            @else
                {{-- mousedown.prevent keeps focus in the textarea: without it the button
                     steals focus and the caret snaps back to the start of the field. --}}
                <button type="button" @mousedown.prevent @click="{{ $tool['action'] }}"
                        title="{{ $tool['title'] }}" aria-label="{{ $tool['title'] }}"
                        class="h-8 {{ ($tool['text'] ?? false) ? 'px-2.5' : 'w-8' }} inline-flex items-center justify-center rounded-lg text-xs font-bold transition-colors cursor-pointer {{ $c['tool'] }}">
                    @if($tool['text'] ?? false)
                        {{ $tool['label'] }}
                    @else
                        <i class="{{ $tool['icon'] }}"></i>
                    @endif
                </button>
            @endif
        @endforeach
    </div>

    {{-- Write --}}
    <div x-show="tab === 'write'">
        <textarea
            id="{{ $name }}" name="{{ $name }}" rows="{{ $rows }}" x-ref="input" x-model="content"
            @if($required) required @endif
            placeholder="{{ $placeholder }}"
            class="w-full px-4 py-4 border-0 border-t-0 outline-none resize-y font-mono text-sm leading-relaxed focus:ring-0 {{ $c['area'] }}"
        >{{ $value }}</textarea>
    </div>

    {{-- Preview: always rendered on a light surface with the site's own article
         styles, so this is genuinely what the published page will look like. --}}
    <div x-show="tab === 'preview'" x-cloak class="bg-slate-50 p-4 md:p-6 min-h-[20rem]">
        <div class="max-w-3xl mx-auto rounded-2xl bg-white border border-slate-200 shadow-sm px-6 py-8 md:px-10 md:py-10">
            <template x-if="loading">
                <div class="py-16 text-center text-slate-400">
                    <i class="fa-solid fa-circle-notch fa-spin text-2xl mb-3"></i>
                    <p class="text-sm font-medium">Rendering preview…</p>
                </div>
            </template>

            <template x-if="error">
                <div class="py-10 text-center">
                    <i class="fa-solid fa-triangle-exclamation text-2xl text-amber-500 mb-3"></i>
                    <p class="text-sm font-medium text-slate-600" x-text="error"></p>
                </div>
            </template>

            <template x-if="!loading && !error">
                <div>
                    <template x-if="previewTitle">
                        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-[1.1] mb-4"
                            x-text="previewTitle"></h1>
                    </template>
                    <template x-if="previewExcerpt">
                        <p class="text-lg text-slate-600 leading-relaxed mb-6" x-text="previewExcerpt"></p>
                    </template>

                    <div class="flex items-center gap-4 pb-6 mb-8 border-b border-slate-200 text-xs font-semibold uppercase tracking-wider text-slate-400">
                        <span><i class="fa-regular fa-clock"></i> <span x-text="readingTime"></span> min read</span>
                        <span><i class="fa-regular fa-file-lines"></i> <span x-text="wordCount"></span> words</span>
                    </div>

                    {{-- Server-sanitised HTML: raw tags are stripped before it gets here. --}}
                    <div class="article-body" x-html="previewHtml"></div>
                </div>
            </template>
        </div>
    </div>

    {{-- Footer hint --}}
    <div class="flex flex-wrap items-center justify-between gap-2 px-4 py-2.5 border-t text-xs {{ $c['foot'] }}">
        <span x-show="mode === 'basic'">Use the buttons above — they write the markdown for you.</span>
        <span x-show="mode === 'markdown'" x-cloak>Markdown: <code>## heading</code>, <code>**bold**</code>, <code>- list</code>, <code>[link](url)</code>.</span>
        <span><span x-text="wordCount"></span> words · <span x-text="readingTime"></span> min read</span>
    </div>
</div>
