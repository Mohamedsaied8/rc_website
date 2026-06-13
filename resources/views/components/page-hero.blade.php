@props(['title', 'subtitle' => null])

<section class="relative pt-32 pb-16 overflow-hidden">
    <!-- Background effects -->
    <div class="absolute inset-0 bg-grid opacity-30"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[400px] bg-cyan-500/[0.05] rounded-full blur-[150px]"></div>

    <div class="relative z-10 max-w-4xl mx-auto px-6 lg:px-8 text-center">
        <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.05] mb-6">
            {!! $title !!}
        </h1>
        @if($subtitle)
            <p class="text-xl md:text-2xl text-slate-600 font-medium max-w-2xl mx-auto leading-relaxed">
                {{ $subtitle }}
            </p>
        @endif
    </div>
</section>
