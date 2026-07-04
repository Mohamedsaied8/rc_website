@extends('admin.layout')

@section('title', 'Create Program')
@section('page-title', 'Create New Program')

@section('content')
<div class="bg-slate-900/60 backdrop-blur-xl border border-white/10 rounded-2xl p-6 md:p-8 shadow-xl">
    <form method="POST" action="{{ route('admin.programs.store') }}" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="title" class="block text-sm font-semibold text-slate-300">Program Title *</label>
                <input type="text" id="title" name="title" class="w-full bg-slate-950/80 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-cyan-400 focus:outline-none transition-all" value="{{ old('title') }}" required>
                @error('title')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="slug" class="block text-sm font-semibold text-slate-300">Slug *</label>
                <input type="text" id="slug" name="slug" class="w-full bg-slate-950/80 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-cyan-400 focus:outline-none transition-all" value="{{ old('slug') }}" required>
                @error('slug')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="space-y-2">
            <label for="short_description" class="block text-sm font-semibold text-slate-300">Short Description *</label>
            <textarea id="short_description" name="short_description" rows="3" class="w-full bg-slate-950/80 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-cyan-400 focus:outline-none transition-all" required>{{ old('short_description') }}</textarea>
            @error('short_description')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="space-y-2">
            <label for="description" class="block text-sm font-semibold text-slate-300">Full Description *</label>
            <textarea id="description" name="description" rows="5" class="w-full bg-slate-950/80 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-cyan-400 focus:outline-none transition-all" required>{{ old('description') }}</textarea>
            @error('description')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="space-y-2">
                <label for="duration" class="block text-sm font-semibold text-slate-300">Duration *</label>
                <input type="text" id="duration" name="duration" class="w-full bg-slate-950/80 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-cyan-400 focus:outline-none transition-all" value="{{ old('duration') }}" placeholder="e.g., 12 weeks" required>
                @error('duration')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="price" class="block text-sm font-semibold text-slate-300">Price *</label>
                <input type="number" id="price" name="price" class="w-full bg-slate-950/80 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-cyan-400 focus:outline-none transition-all" value="{{ old('price') }}" step="0.01" min="0" required>
                @error('price')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="currency" class="block text-sm font-semibold text-slate-300">Currency *</label>
                <select id="currency" name="currency" class="w-full bg-slate-950 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-cyan-400 focus:outline-none transition-all" required>
                    @foreach(\App\Helpers\CurrencyHelper::getCurrencies() as $code => $name)
                        <option value="{{ $code }}" {{ old('currency', 'USD') === $code ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
                @error('currency')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="sort_order" class="block text-sm font-semibold text-slate-300">Sort Order</label>
                <input type="number" id="sort_order" name="sort_order" class="w-full bg-slate-950/80 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-cyan-400 focus:outline-none transition-all" value="{{ old('sort_order', 0) }}" min="0">
                @error('sort_order')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="image" class="block text-sm font-semibold text-slate-300">Image URL</label>
                <input type="url" id="image" name="image" class="w-full bg-slate-950/80 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-cyan-400 focus:outline-none transition-all" value="{{ old('image') }}">
                @error('image')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="video_url" class="block text-sm font-semibold text-slate-300">Video URL</label>
                <input type="url" id="video_url" name="video_url" class="w-full bg-slate-950/80 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-cyan-400 focus:outline-none transition-all" value="{{ old('video_url') }}">
                @error('video_url')
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="space-y-3">
            <label class="block text-sm font-semibold text-slate-300">Topics *</label>
            <div id="topics-container" class="space-y-2">
                @foreach(old('topics', []) as $index => $topic)
                <div class="flex items-center gap-3">
                    <input type="text" name="topics[]" class="w-full bg-slate-950/80 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:border-cyan-400 focus:outline-none transition-all" value="{{ $topic }}" placeholder="Enter a topic" required>
                    <button type="button" onclick="removeTopic(this)" class="px-3 py-2.5 rounded-xl bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-500/20 transition-all">Remove</button>
                </div>
                @endforeach
                <div class="flex items-center gap-3">
                    <input type="text" name="topics[]" class="w-full bg-slate-950/80 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:border-cyan-400 focus:outline-none transition-all" placeholder="Enter a topic" required>
                    <button type="button" onclick="removeTopic(this)" class="px-3 py-2.5 rounded-xl bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-500/20 transition-all">Remove</button>
                </div>
            </div>
            <button type="button" onclick="addTopic()" class="px-4 py-2 rounded-xl bg-white/5 border border-white/10 text-slate-300 hover:bg-white/10 hover:text-white transition-all text-sm font-medium">+ Add Topic</button>
            @error('topics')
                <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <hr class="border-white/10 my-8">

        <!-- Program Cohorts Section -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white">Program Cohorts / Start Dates</h3>
                    <p class="text-xs text-slate-400">Add start dates and schedules for upcoming groups of this program.</p>
                </div>
                <button type="button" onclick="addCohort()" class="px-4 py-2 bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 rounded-xl hover:bg-cyan-500/20 font-semibold text-sm transition-all flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> Add Start Date / Cohort
                </button>
            </div>

            <div id="cohorts-container" class="space-y-4">
                @php
                    $cohorts = old('cohorts', []);
                @endphp
                
                @foreach($cohorts as $index => $cohort)
                <div class="cohort-item bg-slate-950/60 border border-white/10 rounded-xl p-5 relative space-y-4">
                    <button type="button" onclick="removeCohort(this)" class="absolute top-4 right-4 px-3 py-1 bg-red-500/10 text-red-400 border border-red-500/20 rounded-lg hover:bg-red-500/20 text-xs font-semibold transition-all">Remove</button>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pr-16">
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1">Group Name *</label>
                            <input type="text" name="cohorts[{{ $index }}][group_name]" class="w-full bg-slate-900 border border-white/10 rounded-xl px-3 py-2 text-white text-sm focus:border-cyan-400 outline-none" value="{{ $cohort['group_name'] ?? '' }}" placeholder="e.g. D110 Online" required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1">Start Date *</label>
                            <input type="date" name="cohorts[{{ $index }}][start_date]" class="w-full bg-slate-900 border border-white/10 rounded-xl px-3 py-2 text-white text-sm focus:border-cyan-400 outline-none" value="{{ $cohort['start_date'] ?? '' }}" required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1">Fees (EGP)</label>
                            <input type="number" name="cohorts[{{ $index }}][fees]" class="w-full bg-slate-900 border border-white/10 rounded-xl px-3 py-2 text-white text-sm focus:border-cyan-400 outline-none" value="{{ $cohort['fees'] ?? '' }}" step="0.01">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1">Schedule</label>
                            <input type="text" name="cohorts[{{ $index }}][schedule]" class="w-full bg-slate-900 border border-white/10 rounded-xl px-3 py-2 text-white text-sm focus:border-cyan-400 outline-none" value="{{ $cohort['schedule'] ?? '' }}" placeholder="e.g. Fri & Sat | 8 PM - 10 PM">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1">Location</label>
                            <select name="cohorts[{{ $index }}][location]" class="w-full bg-slate-900 border border-white/10 rounded-xl px-3 py-2 text-white text-sm focus:border-cyan-400 outline-none">
                                <option value="Online" {{ ($cohort['location'] ?? '') == 'Online' ? 'selected' : '' }}>Online</option>
                                <option value="Cairo" {{ ($cohort['location'] ?? '') == 'Cairo' ? 'selected' : '' }}>Cairo</option>
                                <option value="Alex" {{ ($cohort['location'] ?? '') == 'Alex' ? 'selected' : '' }}>Alexandria</option>
                                <option value="Nasr City" {{ ($cohort['location'] ?? '') == 'Nasr City' ? 'selected' : '' }}>Nasr City</option>
                            </select>
                        </div>
                        <div class="flex items-center gap-2 pb-2">
                            <input type="hidden" name="cohorts[{{ $index }}][is_active]" value="0">
                            <input type="checkbox" id="cohort_active_{{ $index }}" name="cohorts[{{ $index }}][is_active]" value="1" {{ (!isset($cohort['is_active']) || $cohort['is_active']) ? 'checked' : '' }} class="w-4 h-4 text-cyan-500 rounded bg-slate-900 border-white/10">
                            <label for="cohort_active_{{ $index }}" class="text-sm font-medium text-slate-300 cursor-pointer">Active Cohort</label>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <hr class="border-white/10 my-8">

        <div class="flex items-center gap-3">
            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-5 h-5 text-cyan-500 rounded bg-slate-950 border-white/10">
            <label for="is_active" class="text-sm font-semibold text-slate-200 cursor-pointer">Active Program (Visible on website)</label>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-cyan-400 to-emerald-400 text-slate-950 font-bold rounded-xl hover:shadow-[0_0_20px_rgba(34,211,238,0.4)] transition-all">Create Program</button>
            <a href="{{ route('admin.programs.index') }}" class="px-6 py-3 bg-white/5 border border-white/10 text-slate-300 font-semibold rounded-xl hover:bg-white/10 hover:text-white transition-all">Cancel</a>
        </div>
    </form>
</div>

<script>
function addTopic() {
    const container = document.getElementById('topics-container');
    const div = document.createElement('div');
    div.className = 'flex items-center gap-3';
    div.innerHTML = `
        <input type="text" name="topics[]" class="w-full bg-slate-950/80 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:border-cyan-400 focus:outline-none transition-all" placeholder="Enter a topic" required>
        <button type="button" onclick="removeTopic(this)" class="px-3 py-2.5 rounded-xl bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-500/20 transition-all">Remove</button>
    `;
    container.appendChild(div);
}

function removeTopic(button) {
    button.parentElement.remove();
}

let cohortIndex = {{ count(old('cohorts', [])) }};

function addCohort() {
    const container = document.getElementById('cohorts-container');
    const div = document.createElement('div');
    div.className = 'cohort-item bg-slate-950/60 border border-white/10 rounded-xl p-5 relative space-y-4';
    
    div.innerHTML = `
        <button type="button" onclick="removeCohort(this)" class="absolute top-4 right-4 px-3 py-1 bg-red-500/10 text-red-400 border border-red-500/20 rounded-lg hover:bg-red-500/20 text-xs font-semibold transition-all">Remove</button>
        
        <input type="hidden" name="cohorts[\${cohortIndex}][id]" value="">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pr-16">
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Group Name *</label>
                <input type="text" name="cohorts[\${cohortIndex}][group_name]" class="w-full bg-slate-900 border border-white/10 rounded-xl px-3 py-2 text-white text-sm focus:border-cyan-400 outline-none" placeholder="e.g. D110 Online" required>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Start Date *</label>
                <input type="date" name="cohorts[\${cohortIndex}][start_date]" class="w-full bg-slate-900 border border-white/10 rounded-xl px-3 py-2 text-white text-sm focus:border-cyan-400 outline-none" required>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Fees (EGP)</label>
                <input type="number" name="cohorts[\${cohortIndex}][fees]" class="w-full bg-slate-900 border border-white/10 rounded-xl px-3 py-2 text-white text-sm focus:border-cyan-400 outline-none" step="0.01">
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Schedule</label>
                <input type="text" name="cohorts[\${cohortIndex}][schedule]" class="w-full bg-slate-900 border border-white/10 rounded-xl px-3 py-2 text-white text-sm focus:border-cyan-400 outline-none" placeholder="e.g. Fri & Sat | 8 PM - 10 PM">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Location</label>
                <select name="cohorts[\${cohortIndex}][location]" class="w-full bg-slate-900 border border-white/10 rounded-xl px-3 py-2 text-white text-sm focus:border-cyan-400 outline-none">
                    <option value="Online">Online</option>
                    <option value="Cairo">Cairo</option>
                    <option value="Alex">Alexandria</option>
                    <option value="Nasr City">Nasr City</option>
                </select>
            </div>
            <div class="flex items-center gap-2 pb-2">
                <input type="hidden" name="cohorts[\${cohortIndex}][is_active]" value="0">
                <input type="checkbox" id="cohort_active_\${cohortIndex}" name="cohorts[\${cohortIndex}][is_active]" value="1" checked class="w-4 h-4 text-cyan-500 rounded bg-slate-900 border-white/10">
                <label for="cohort_active_\${cohortIndex}" class="text-sm font-medium text-slate-300 cursor-pointer">Active Cohort</label>
            </div>
        </div>
    `;
    container.appendChild(div);
    cohortIndex++;
}

function removeCohort(button) {
    button.closest('.cohort-item').remove();
}

// Auto-generate slug from title
document.getElementById('title').addEventListener('input', function() {
    const title = this.value;
    const slug = title.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim('-');
    document.getElementById('slug').value = slug;
});
</script>
@endsection
