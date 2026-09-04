@php
    /** Segmented filter. Buttons, not links — filtering happens in the browser so
     *  the page never reloads and the scroll position never jumps. */
    $filterOptions = [
        ['key' => 'all', 'label' => 'All', 'icon' => 'fa-solid fa-layer-group', 'count' => $totalCount],
        ['key' => 'blog', 'label' => 'Blog', 'icon' => 'fa-solid fa-pen-nib', 'count' => $counts['blog'] ?? 0],
        ['key' => 'news', 'label' => 'News', 'icon' => 'fa-solid fa-bullhorn', 'count' => $counts['news'] ?? 0],
        ['key' => 'paper', 'label' => 'Papers', 'icon' => 'fa-solid fa-flask-vial', 'count' => $counts['paper'] ?? 0],
    ];
@endphp

<div class="inline-flex flex-wrap items-center gap-1 p-1 rounded-2xl bg-white border border-slate-200 shadow-sm">
    @foreach($filterOptions as $filter)
        <button type="button" @click="setType('{{ $filter['key'] }}')"
                :aria-pressed="type === '{{ $filter['key'] }}'"
                class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl transition-all duration-300 cursor-pointer"
                :class="type === '{{ $filter['key'] }}'
                    ? 'bg-slate-900 text-white shadow-md'
                    : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100'">
            <i class="{{ $filter['icon'] }} text-xs"
               :class="type === '{{ $filter['key'] }}' ? 'text-cyan-400' : 'text-slate-400'"></i>
            {{ $filter['label'] }}
            <span class="text-[11px] font-bold px-1.5 py-0.5 rounded-md"
                  :class="type === '{{ $filter['key'] }}' ? 'bg-white/15 text-slate-200' : 'bg-slate-100 text-slate-500'">{{ $filter['count'] }}</span>
        </button>
    @endforeach
</div>
