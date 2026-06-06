@props(['title', 'description', 'duration', 'price', 'topics', 'badge', 'slug' => null])

<div class="group relative bg-white/[0.03] backdrop-blur-xl border border-white/[0.06] rounded-2xl overflow-hidden hover:border-cyan-400/20 transition-all duration-500">
    <!-- Hover glow effect -->
    <div class="absolute inset-0 bg-gradient-to-br from-cyan-400/[0.03] to-emerald-400/[0.02] opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>

    <div class="relative p-6 sm:p-7 flex flex-col h-full">
        <!-- Header: Icon + Badge -->
        <div class="flex items-center justify-between mb-5">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-400/15 to-emerald-400/10 flex items-center justify-center">
                <span class="text-lg">💻</span>
            </div>
            <span class="text-[10px] font-semibold uppercase tracking-widest text-cyan-400 bg-cyan-400/10 px-3 py-1 rounded-full border border-cyan-400/20">
                {{ $badge }}
            </span>
        </div>

        <!-- Title -->
        <h3 class="text-lg font-bold text-white mb-2 tracking-tight leading-snug group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-cyan-400 group-hover:to-emerald-400 transition-all duration-300">
            {{ $title }}
        </h3>

        <!-- Description -->
        <p class="text-sm text-slate-400 leading-relaxed mb-5 flex-grow">
            {{ $description }}
        </p>

        <!-- Meta Row -->
        <div class="grid grid-cols-2 gap-2 mb-5">
            <div class="flex items-center gap-1.5 text-xs text-slate-500">
                <span>⏱️</span>
                <span>{{ $duration }}</span>
            </div>
            <div class="flex items-center gap-1.5 text-xs text-slate-500">
                <span>🌐</span>
                <span>Online/Onsite</span>
            </div>
            <div class="flex items-center gap-1.5 text-xs text-slate-500">
                <span>👥</span>
                <span>400+ enrolled</span>
            </div>
            <div class="flex items-center gap-1.5 text-xs text-slate-500">
                <span>⭐</span>
                <span>4.9/5 rating</span>
            </div>
        </div>

        <!-- Topics -->
        <div class="mb-6">
            <h4 class="text-[10px] font-semibold uppercase tracking-widest text-slate-500 mb-2.5">Key Topics</h4>
            <div class="flex flex-wrap gap-1.5">
                @foreach(array_slice($topics, 0, 4) as $topic)
                    <span class="text-xs text-slate-400 bg-white/5 border border-white/10 px-2 py-1 rounded-md">{{ $topic }}</span>
                @endforeach
            </div>
        </div>

        <!-- Footer: Price + Enroll -->
        <div class="flex items-end justify-between pt-4 border-t border-white/[0.06]">
            <div>
                <div class="text-xl font-bold text-white tracking-tight">{{ is_numeric($price) ? 'EGP ' . number_format($price) : $price }}</div>
                <div class="text-[10px] text-slate-600 mt-0.5">400+ enrolled</div>
            </div>
            <a href="{{ route('enroll', $slug ? ['program' => $slug] : []) }}" class="inline-flex items-center px-5 py-2 text-xs font-semibold text-gray-900 bg-gradient-to-r from-cyan-400 to-emerald-400 rounded-lg hover:shadow-lg hover:shadow-cyan-400/20 transition-all duration-300 hover:-translate-y-0.5">
                Enroll
            </a>
        </div>
    </div>
</div>
