@php
    /** @var \App\Models\BlogPost|null $post */
    $post = $post ?? null;
    $currentType = old('type', $post->type ?? 'blog');
    $tagsValue = old('tags', $post && $post->tags ? implode(', ', $post->tags) : '');
@endphp

<div x-data="{ type: '{{ $currentType }}' }" class="space-y-6">

    {{-- Content type picker --}}
    <div class="card">
        <label class="form-label">Content type</label>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mt-2">
            @foreach([
                ['value' => 'blog', 'icon' => 'fa-solid fa-pen-nib', 'label' => 'Blog post', 'hint' => 'An article or tutorial'],
                ['value' => 'news', 'icon' => 'fa-solid fa-bullhorn', 'label' => 'News', 'hint' => 'Company announcement'],
                ['value' => 'paper', 'icon' => 'fa-solid fa-flask-vial', 'label' => 'Published paper', 'hint' => 'Research output'],
            ] as $option)
                <label class="cursor-pointer rounded-2xl border p-4 transition-all block"
                       :class="type === '{{ $option['value'] }}' ? 'border-cyan-500/40 bg-cyan-500/10' : 'border-white/10 bg-white/[0.02] hover:bg-white/[0.05]'">
                    <input type="radio" name="type" value="{{ $option['value'] }}" x-model="type" class="sr-only">
                    <i class="{{ $option['icon'] }} mb-2 block"
                       :class="type === '{{ $option['value'] }}' ? 'text-cyan-300' : 'text-slate-500'"></i>
                    <span class="block font-bold text-white text-sm">{{ $option['label'] }}</span>
                    <span class="block text-xs text-slate-500 mt-0.5">{{ $option['hint'] }}</span>
                </label>
            @endforeach
        </div>
        @error('type')<p class="mt-2 text-sm text-red-400">{{ $message }}</p>@enderror
    </div>

    {{-- Core fields --}}
    <div class="card space-y-5">
        <div class="form-group">
            <label class="form-label" for="title">Title *</label>
            <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $post->title ?? '') }}" required>
            @error('title')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="excerpt">Summary</label>
            <textarea id="excerpt" name="excerpt" class="form-textarea" rows="2"
                      placeholder="Shown on the blog card and in search results.">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
            @error('excerpt')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="content">
                Body *
                <span class="text-slate-500 font-normal" x-show="type === 'paper'" x-cloak>— optional commentary shown under the abstract</span>
            </label>
            @include('components.markdown-editor', [
                'name' => 'content',
                'value' => old('content', $post->content ?? ''),
                'previewUrl' => route('admin.blog.preview'),
                'dark' => true,
                'required' => true,
                'rows' => 18,
                'placeholder' => 'Write the post here. Use the toolbar, or switch to Markdown.',
            ])
            @error('content')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="form-group">
                <label class="form-label" for="author">Author byline</label>
                <input type="text" id="author" name="author" class="form-input"
                       value="{{ old('author', $post->author ?? 'Robotics Corner') }}">
                @if($post && $post->user_id)
                    <small class="text-cyan-400">Community submission by {{ $post->user?->name }} — the account name is shown instead.</small>
                @endif
            </div>
            <div class="form-group">
                <label class="form-label" for="tags">Topics</label>
                <input type="text" id="tags" name="tags" class="form-input" value="{{ $tagsValue }}"
                       placeholder="ros2, slam, embedded">
                <small class="text-slate-500">Comma separated, up to 5.</small>
            </div>
        </div>
    </div>

    {{-- Paper metadata --}}
    <div class="card" x-show="type === 'paper'" x-cloak>
        <div class="flex items-center gap-3 mb-5 pb-4 border-b border-white/10">
            <span class="w-9 h-9 rounded-xl bg-violet-500/15 border border-violet-500/25 flex items-center justify-center">
                <i class="fa-solid fa-flask-vial text-violet-300 text-sm"></i>
            </span>
            <div>
                <h3 class="text-white font-bold m-0">Publication details</h3>
                <p class="text-xs text-slate-500 m-0">All optional — fill in whatever you have.</p>
            </div>
        </div>

        <div class="space-y-5">
            <div class="form-group">
                <label class="form-label" for="paper_authors">Authors</label>
                <input type="text" id="paper_authors" name="paper_authors" class="form-input"
                       value="{{ old('paper_authors', $post->paper_authors ?? '') }}"
                       placeholder="A. Hassan, M. Abdelrahman, S. Ali">
                <small class="text-slate-500">Comma separated — each becomes an author chip.</small>
            </div>

            <div class="form-group">
                <label class="form-label" for="paper_abstract">Abstract</label>
                <textarea id="paper_abstract" name="paper_abstract" class="form-textarea" rows="6">{{ old('paper_abstract', $post->paper_abstract ?? '') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="form-group">
                    <label class="form-label" for="paper_venue">Journal / conference</label>
                    <input type="text" id="paper_venue" name="paper_venue" class="form-input"
                           value="{{ old('paper_venue', $post->paper_venue ?? '') }}" placeholder="IEEE ICRA">
                </div>
                <div class="form-group">
                    <label class="form-label" for="paper_year">Year</label>
                    <input type="number" id="paper_year" name="paper_year" class="form-input" min="1950" max="2100"
                           value="{{ old('paper_year', $post->paper_year ?? '') }}" placeholder="2026">
                </div>
                <div class="form-group">
                    <label class="form-label" for="paper_doi">DOI</label>
                    <input type="text" id="paper_doi" name="paper_doi" class="form-input"
                           value="{{ old('paper_doi', $post->paper_doi ?? '') }}" placeholder="10.1109/ICRA.2026.123456">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="form-group">
                    <label class="form-label" for="paper_url">Publisher page URL</label>
                    <input type="url" id="paper_url" name="paper_url" class="form-input"
                           value="{{ old('paper_url', $post->paper_url ?? '') }}" placeholder="https://ieeexplore.ieee.org/…">
                </div>
                <div class="form-group">
                    <label class="form-label" for="paper_code_url">Code repository URL</label>
                    <input type="url" id="paper_code_url" name="paper_code_url" class="form-input"
                           value="{{ old('paper_code_url', $post->paper_code_url ?? '') }}" placeholder="https://github.com/…">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="paper_pdf">PDF</label>
                @if($post && $post->paper_pdf)
                    <p class="mb-2 text-sm text-emerald-400">
                        <i class="fa-solid fa-file-pdf"></i>
                        <a href="{{ asset('storage/' . $post->paper_pdf) }}" target="_blank" class="underline">Current PDF</a>
                        — uploading a new one replaces it.
                    </p>
                @endif
                <input type="file" id="paper_pdf" name="paper_pdf" class="form-input" accept="application/pdf">
                <small class="text-slate-500">Max 20MB.</small>
                @error('paper_pdf')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="paper_bibtex">BibTeX citation</label>
                <textarea id="paper_bibtex" name="paper_bibtex" class="form-textarea font-mono text-xs" rows="8"
                          placeholder="@article{key2026,&#10;  title   = {…},&#10;  author  = {…},&#10;  journal = {…},&#10;  year    = {2026}&#10;}">{{ old('paper_bibtex', $post->paper_bibtex ?? '') }}</textarea>
                <small class="text-slate-500">Visitors get a one-click copy button for this.</small>
            </div>
        </div>
    </div>

    {{-- Media --}}
    <div class="card space-y-5">
        <h3 class="text-white font-bold m-0">Media</h3>

        <div class="form-group">
            <label class="form-label" for="featured_image">Cover image</label>
            @if($post && $post->featured_image)
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt=""
                     class="mb-3 w-56 h-32 object-cover rounded-xl border border-white/10">
            @endif
            <input type="file" id="featured_image" name="featured_image" class="form-input" accept="image/*">
            <small class="text-slate-500">1200×630 recommended, max 5MB.</small>
            @error('featured_image')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
        </div>

        @if($post && $post->images->count() > 0)
            <div class="form-group">
                <label class="form-label">Existing images <span class="text-slate-500 font-normal">— tick to remove</span></label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @foreach($post->images as $image)
                        <label class="relative block rounded-xl overflow-hidden border border-white/10 cursor-pointer group">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="" class="w-full h-28 object-cover">
                            <span class="absolute inset-x-0 bottom-0 bg-slate-950/80 px-2 py-1.5 flex items-center gap-2 text-xs text-slate-300">
                                <input type="checkbox" name="remove_images[]" value="{{ $image->id }}"> Remove
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="form-group">
            <label class="form-label">
                Additional images
                <span class="text-slate-500 font-normal" x-show="type === 'paper'" x-cloak>— shown as numbered figures</span>
            </label>
            <div id="images-container" class="space-y-4">
                <div class="image-upload-item space-y-2">
                    <input type="file" name="images[]" class="form-input" accept="image/*">
                    <input type="text" name="captions[]" class="form-input" placeholder="Caption (optional)">
                </div>
            </div>
            <button type="button" onclick="addImageField()" class="btn btn-secondary mt-3">+ Add another image</button>
        </div>
    </div>

    {{-- Publishing --}}
    <div class="card space-y-5">
        <h3 class="text-white font-bold m-0">Publishing</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="form-group">
                <label class="form-label" for="status">Status *</label>
                <select id="status" name="status" class="form-input" required>
                    @foreach(['draft' => 'Draft', 'pending' => 'Pending review', 'published' => 'Published', 'rejected' => 'Rejected'] as $value => $label)
                        <option value="{{ $value }}" @selected(old('status', $post->status ?? 'draft') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('status')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Highlight</label>
                <label class="flex items-center gap-3 px-4 py-3 rounded-xl border border-white/10 bg-white/[0.02] cursor-pointer hover:bg-white/[0.05] transition-colors">
                    <input type="checkbox" name="featured" value="1" @checked(old('featured', $post->featured ?? false))>
                    <span class="text-sm text-slate-300">Feature this — pins it to the top of its section</span>
                </label>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap gap-3">
        <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
        <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</div>

<script>
    function addImageField() {
        const container = document.getElementById('images-container');
        const item = document.createElement('div');
        item.className = 'image-upload-item space-y-2';
        item.innerHTML = `
            <input type="file" name="images[]" class="form-input" accept="image/*">
            <input type="text" name="captions[]" class="form-input" placeholder="Caption (optional)">
            <button type="button" onclick="this.parentElement.remove()" class="btn btn-danger">Remove</button>
        `;
        container.appendChild(item);
    }
</script>
