<x-layout>
    <div class="min-h-screen bg-[#0A0A0A] pt-24 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(auth('admin')->check() && request('edit') == '1')
                <div class="prose prose-invert prose-cyan max-w-none cms-editable-page" data-page-slug="{{ $page->slug }}" contenteditable="true" style="min-height: 50vh; outline: 1px dashed rgba(34,211,238,0.5); padding: 1rem;">
                    {!! $page->custom_html ?: '<p>Start typing your content here...</p>' !!}
                </div>
            @else
                <div class="prose prose-invert prose-cyan max-w-none">
                    {!! $page->custom_html !!}
                </div>
            @endif
        </div>
    </div>
</x-layout>
