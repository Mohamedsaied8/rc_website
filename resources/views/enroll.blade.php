@extends('components.layout')

@section('title', 'Enroll Now - Robotics Corner')

@section('content')
<div class="min-h-screen pt-24 pb-16 bg-[#0A0A0A] text-slate-300 font-sans selection:bg-cyan-500/30"
    x-data="enrollForm()" 
    x-init="
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('program')) {
            form.selected_program = urlParams.get('program');
        }
    "
>
    <div class="max-w-4xl mx-auto px-6" x-ref="formContainer">
        
        <!-- Header -->
        <div class="mb-10 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">{{ cms('enroll.hero.title', 'Complete Your Enrollment') }}</h1>
            <p class="text-slate-400">{{ cms('enroll.hero.subtitle', 'Join our upcoming cohort and transform your engineering career.') }}</p>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                <div class="flex items-start gap-3 mb-2 font-bold">
                    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Please fix the following errors from the server:</span>
                </div>
                <ul class="list-disc list-inside ml-8 space-y-1">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white/[0.03] backdrop-blur-xl border border-white/[0.06] rounded-2xl shadow-2xl overflow-hidden">
            
            <!-- Progress Bar -->
            <div class="bg-white/[0.02] border-b border-white/[0.06] px-6 py-4 sm:px-8">
                <div class="flex items-center justify-between">
                    <template x-for="s in totalSteps">
                        <div class="flex flex-col items-center flex-1 relative">
                            <!-- Progress Line -->
                            <div x-show="s < totalSteps" class="absolute top-4 left-1/2 w-full h-[2px] bg-white/[0.06]">
                                <div class="h-full bg-gradient-to-r from-cyan-400 to-emerald-400 transition-all duration-500" :style="`width: ${step > s ? '100%' : '0%'}`"></div>
                            </div>
                            
                            <!-- Step Circle -->
                            <div 
                                class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-semibold relative z-10 transition-all duration-300"
                                :class="{
                                    'bg-gradient-to-r from-cyan-400 to-emerald-400 text-gray-900 shadow-[0_0_15px_rgba(34,211,238,0.4)]': step === s,
                                    'bg-white/10 text-white': step < s,
                                    'bg-emerald-500 text-white': step > s
                                }"
                            >
                                <span x-show="step <= s" x-text="s"></span>
                                <svg x-show="step > s" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            
                            <span class="text-[10px] sm:text-xs mt-2 font-medium transition-colors duration-300 text-center" 
                                  :class="step >= s ? 'text-cyan-400 block' : 'text-slate-500 hidden sm:block'"
                                  x-text="['Program', 'Personal', 'Background', 'Schedule', 'Payment'][s-1]">
                            </span>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-6 sm:p-8">
                <form id="enrollmentForm" action="{{ route('enroll.store') }}" method="POST" enctype="multipart/form-data" @submit.prevent="submitForm" @keydown.enter.prevent="handleEnter">
                    @csrf
                    
                    <!-- Global Error -->
                    <div x-show="errors.global" style="display: none;" class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm flex items-start gap-3">
                        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span x-text="errors.global"></span>
                    </div>

                    <!-- Step 1: Select Program -->
                    <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                        <h2 class="text-xl font-bold text-white mb-6">Choose Your Program</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @php
                                $programsList = \App\Models\Program::where('is_active', true)->orderBy('sort_order')->get();
                            @endphp
                            @foreach($programsList as $prog)
                                <label class="flex flex-col p-5 rounded-xl border cursor-pointer transition-all duration-200"
                                       :class="form.selected_program === '{{ $prog->slug }}' ? 'bg-cyan-500/10 border-cyan-500/50 shadow-[0_0_15px_rgba(34,211,238,0.15)]' : 'bg-white/[0.02] border-white/10 hover:border-white/20'">
                                    <div class="flex justify-between items-start mb-3">
                                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-cyan-400/10 to-emerald-400/5 flex items-center justify-center text-xl">💻</div>
                                        <input type="radio" name="selected_program" x-model="form.selected_program" value="{{ $prog->slug }}" class="w-4 h-4 text-cyan-500 bg-gray-800 border-gray-600 focus:ring-cyan-500">
                                    </div>
                                    <h3 class="font-bold text-white mb-1">{{ $prog->title }}</h3>
                                    <p class="text-xs text-slate-400 mb-3 flex-1">{{ Str::limit($prog->short_description ?? $prog->description, 80) }}</p>
                                    <div class="flex items-center justify-between mt-auto pt-3 border-t border-white/10">
                                        <span class="text-xs text-slate-500">{{ $prog->duration }}</span>
                                        <span class="text-sm font-semibold text-cyan-400">EGP {{ number_format($prog->price) }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        <p x-show="errors.selected_program" class="text-red-400 text-sm mt-3 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                            <span x-text="errors.selected_program"></span>
                        </p>
                    </div>

                    <!-- Step 2: Personal Details -->
                    <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                        <h2 class="text-xl font-bold text-white mb-6">Personal Details</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1.5">First Name</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg></span>
                                    <input type="text" name="first_name" x-model="form.first_name" @input="clearError('first_name')" :class="errors.first_name ? 'border-red-500/50' : 'border-white/10'" class="w-full pl-10 pr-4 py-3 bg-white/[0.04] border rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors" placeholder="John">
                                </div>
                                <p x-show="errors.first_name" x-text="errors.first_name" class="text-xs text-red-400 mt-1.5"></p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1.5">Last Name</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg></span>
                                    <input type="text" name="last_name" x-model="form.last_name" @input="clearError('last_name')" :class="errors.last_name ? 'border-red-500/50' : 'border-white/10'" class="w-full pl-10 pr-4 py-3 bg-white/[0.04] border rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors" placeholder="Doe">
                                </div>
                                <p x-show="errors.last_name" x-text="errors.last_name" class="text-xs text-red-400 mt-1.5"></p>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-slate-300 mb-1.5">Email Address</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg></span>
                                    <input type="email" name="email" x-model="form.email" @input="clearError('email')" :class="errors.email ? 'border-red-500/50' : 'border-white/10'" class="w-full pl-10 pr-4 py-3 bg-white/[0.04] border rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors" placeholder="john@example.com">
                                </div>
                                <p x-show="errors.email" x-text="errors.email" class="text-xs text-red-400 mt-1.5"></p>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-slate-300 mb-1.5">Phone Number (WhatsApp)</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg></span>
                                    <input type="tel" name="phone" x-model="form.phone" @input="clearError('phone')" :class="errors.phone ? 'border-red-500/50' : 'border-white/10'" class="w-full pl-10 pr-4 py-3 bg-white/[0.04] border rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors" placeholder="+20 123 456 7890">
                                </div>
                                <p x-show="errors.phone" x-text="errors.phone" class="text-xs text-red-400 mt-1.5"></p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1.5">Country</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></span>
                                    <select name="country" x-model="form.country" @change="clearError('country'); form.city = ''" :class="errors.country ? 'border-red-500/50' : 'border-white/10'" class="w-full pl-10 pr-4 py-3 bg-[#0f172a] border rounded-xl text-white focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors appearance-none">
                                        <option value="" disabled>Select your country</option>
                                        <template x-for="country in Object.keys(locations)" :key="country">
                                            <option :value="country" x-text="country"></option>
                                        </template>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                                <p x-show="errors.country" x-text="errors.country" class="text-xs text-red-400 mt-1.5"></p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1.5">City</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg></span>
                                    <select name="city" x-model="form.city" @change="clearError('city')" :disabled="!form.country" :class="errors.city ? 'border-red-500/50' : 'border-white/10'" class="w-full pl-10 pr-4 py-3 bg-[#0f172a] border rounded-xl text-white disabled:opacity-50 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors appearance-none">
                                        <option value="" disabled>Select your city</option>
                                        <template x-if="form.country">
                                            <template x-for="city in locations[form.country]" :key="city">
                                                <option :value="city" x-text="city"></option>
                                            </template>
                                        </template>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                                <p x-show="errors.city" x-text="errors.city" class="text-xs text-red-400 mt-1.5"></p>
                                
                                <!-- Custom City Input if "Other" is selected -->
                                <div x-show="form.city === 'Other'" class="mt-3 relative" x-transition>
                                    <input type="text" name="custom_city" x-model="form.custom_city" @input="clearError('city')" class="w-full px-4 py-3 bg-white/[0.04] border border-white/10 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors" placeholder="Enter your city name">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Academic/Technical Background -->
                    <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                        <h2 class="text-xl font-bold text-white mb-6">Technical Background</h2>
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1.5">Education Level</label>
                                <div class="relative">
                                    <select name="education_level" x-model="form.education_level" @change="clearError('education_level')" :class="errors.education_level ? 'border-red-500/50' : 'border-white/10'" class="w-full px-4 py-3 bg-[#0f172a] border rounded-xl text-white focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors appearance-none">
                                        <option value="" disabled>Select highest level of education</option>
                                        <option value="high_school">High School</option>
                                        <option value="bachelor">Bachelor's Degree</option>
                                        <option value="master">Master's Degree</option>
                                        <option value="phd">Ph.D.</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                                <p x-show="errors.education_level" x-text="errors.education_level" class="text-xs text-red-400 mt-1.5"></p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1.5">Technical Experience</label>
                                <textarea name="experience" x-model="form.experience" @input="clearError('experience')" rows="3" :class="errors.experience ? 'border-red-500/50' : 'border-white/10'" class="w-full px-4 py-3 bg-white/[0.04] border rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors" placeholder="Briefly describe your programming or engineering experience..."></textarea>
                                <p x-show="errors.experience" x-text="errors.experience" class="text-xs text-red-400 mt-1.5"></p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1.5">Motivation</label>
                                <textarea name="motivation" x-model="form.motivation" @input="clearError('motivation')" rows="3" :class="errors.motivation ? 'border-red-500/50' : 'border-white/10'" class="w-full px-4 py-3 bg-white/[0.04] border rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors" placeholder="Why do you want to join this program?"></textarea>
                                <p x-show="errors.motivation" x-text="errors.motivation" class="text-xs text-red-400 mt-1.5"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Schedule -->
                    <div x-show="step === 4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                        <h2 class="text-xl font-bold text-white mb-6">Preferred Schedule</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="flex flex-col p-5 rounded-xl border cursor-pointer transition-all duration-200"
                                   :class="form.preferred_schedule === 'weekdays' ? 'bg-cyan-500/10 border-cyan-500/50 shadow-[0_0_15px_rgba(34,211,238,0.1)]' : 'bg-white/[0.02] border-white/10 hover:border-white/20'">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="w-10 h-10 rounded-lg bg-cyan-500/20 text-cyan-400 flex items-center justify-center text-xl">🌅</div>
                                    <input type="radio" name="preferred_schedule" x-model="form.preferred_schedule" value="weekdays" class="w-4 h-4 text-cyan-500 bg-gray-800 border-gray-600 focus:ring-cyan-500">
                                </div>
                                <h3 class="font-bold text-white mb-1">Weekdays</h3>
                                <p class="text-xs text-slate-400">Standard working days</p>
                            </label>

                            <label class="flex flex-col p-5 rounded-xl border cursor-pointer transition-all duration-200"
                                   :class="form.preferred_schedule === 'evenings' ? 'bg-cyan-500/10 border-cyan-500/50 shadow-[0_0_15px_rgba(34,211,238,0.1)]' : 'bg-white/[0.02] border-white/10 hover:border-white/20'">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="w-10 h-10 rounded-lg bg-blue-500/20 text-blue-400 flex items-center justify-center text-xl">🌙</div>
                                    <input type="radio" name="preferred_schedule" x-model="form.preferred_schedule" value="evenings" class="w-4 h-4 text-cyan-500 bg-gray-800 border-gray-600 focus:ring-cyan-500">
                                </div>
                                <h3 class="font-bold text-white mb-1">Evenings</h3>
                                <p class="text-xs text-slate-400">After work hours (6 PM - 9 PM)</p>
                            </label>

                            <label class="flex flex-col p-5 rounded-xl border cursor-pointer transition-all duration-200"
                                   :class="form.preferred_schedule === 'weekends' ? 'bg-cyan-500/10 border-cyan-500/50 shadow-[0_0_15px_rgba(34,211,238,0.1)]' : 'bg-white/[0.02] border-white/10 hover:border-white/20'">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="w-10 h-10 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl">🚀</div>
                                    <input type="radio" name="preferred_schedule" x-model="form.preferred_schedule" value="weekends" class="w-4 h-4 text-cyan-500 bg-gray-800 border-gray-600 focus:ring-cyan-500">
                                </div>
                                <h3 class="font-bold text-white mb-1">Weekends</h3>
                                <p class="text-xs text-slate-400">Fridays & Saturdays</p>
                            </label>

                            <label class="flex flex-col p-5 rounded-xl border cursor-pointer transition-all duration-200"
                                   :class="form.preferred_schedule === 'flexible' ? 'bg-cyan-500/10 border-cyan-500/50 shadow-[0_0_15px_rgba(34,211,238,0.1)]' : 'bg-white/[0.02] border-white/10 hover:border-white/20'">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="w-10 h-10 rounded-lg bg-purple-500/20 text-purple-400 flex items-center justify-center text-xl">⏳</div>
                                    <input type="radio" name="preferred_schedule" x-model="form.preferred_schedule" value="flexible" class="w-4 h-4 text-cyan-500 bg-gray-800 border-gray-600 focus:ring-cyan-500">
                                </div>
                                <h3 class="font-bold text-white mb-1">Flexible</h3>
                                <p class="text-xs text-slate-400">Can adapt to cohort timing</p>
                            </label>
                        </div>
                        <p x-show="errors.preferred_schedule" class="text-red-400 text-sm mt-3 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                            <span x-text="errors.preferred_schedule"></span>
                        </p>
                    </div>

                    <!-- Step 5: Payment -->
                    <div x-show="step === 5" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                        <h2 class="text-xl font-bold text-white mb-6">Payment Method</h2>
                        <div class="space-y-4 mb-6">
                            <label class="flex items-center p-4 rounded-xl border cursor-pointer transition-all duration-200"
                                   :class="form.payment_method === 'instapay' ? 'bg-cyan-500/10 border-cyan-500/50 shadow-[0_0_15px_rgba(34,211,238,0.1)]' : 'bg-white/[0.02] border-white/10 hover:border-white/20'">
                                <input type="radio" name="payment_method" x-model="form.payment_method" value="instapay" class="w-4 h-4 text-cyan-500 bg-gray-800 border-gray-600 focus:ring-cyan-500">
                                <div class="ml-4 flex-1">
                                    <h3 class="font-bold text-white text-sm">InstaPay / Bank Transfer</h3>
                                    <p class="text-xs text-slate-400 mt-1">Upload transfer screenshot below.</p>
                                </div>
                            </label>
                            
                            <label class="flex items-center p-4 rounded-xl border cursor-pointer transition-all duration-200"
                                   :class="form.payment_method === 'contact_sales' ? 'bg-cyan-500/10 border-cyan-500/50 shadow-[0_0_15px_rgba(34,211,238,0.1)]' : 'bg-white/[0.02] border-white/10 hover:border-white/20'">
                                <input type="radio" name="payment_method" x-model="form.payment_method" value="contact_sales" class="w-4 h-4 text-cyan-500 bg-gray-800 border-gray-600 focus:ring-cyan-500">
                                <div class="ml-4">
                                    <h3 class="font-bold text-white text-sm">Contact Sales First</h3>
                                    <p class="text-xs text-slate-400 mt-1">Talk to our advisors before paying.</p>
                                </div>
                            </label>
                        </div>
                        <p x-show="errors.payment_method" class="text-red-400 text-sm mb-4 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                            <span x-text="errors.payment_method"></span>
                        </p>

                        <!-- InstaPay Screenshot Upload -->
                        <div x-show="form.payment_method === 'instapay'" x-transition class="mb-6">
                            <label class="block text-sm font-medium text-slate-300 mb-1.5">Payment Screenshot <span class="text-red-400">*</span></label>
                            <div class="relative flex items-center justify-center w-full">
                                <label for="payment_screenshot" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-xl cursor-pointer transition-colors" :class="errors.payment_screenshot ? 'border-red-500/50 bg-red-500/5 hover:bg-red-500/10' : 'border-white/20 bg-white/[0.02] hover:bg-white/[0.04]'">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                        <p class="mb-2 text-sm text-slate-400"><span class="font-semibold text-cyan-400">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-slate-500" x-text="fileName ? fileName : 'JPEG, PNG, JPG (MAX. 5MB)'"></p>
                                    </div>
                                    <input id="payment_screenshot" name="payment_screenshot" type="file" class="hidden" @change="handleFileUpload" accept="image/jpeg, image/png, image/jpg" />
                                </label>
                            </div>
                            <p x-show="errors.payment_screenshot" x-text="errors.payment_screenshot" class="text-xs text-red-400 mt-1.5"></p>
                        </div>

                        <!-- Summary Box -->
                        <div class="mt-6 bg-white/[0.02] rounded-xl p-5 border border-white/5 shadow-inner">
                            <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4 border-b border-white/5 pb-2">Enrollment Summary</h4>
                            <div class="flex flex-col gap-3">
                                <div class="flex justify-between text-sm text-slate-300">
                                    <span>Program:</span>
                                    <span class="font-medium text-white text-right" x-text="getSelectedProgramName()"></span>
                                </div>
                                <div class="flex justify-between text-sm text-slate-300">
                                    <span>Schedule:</span>
                                    <span class="font-medium text-white capitalize text-right" x-text="form.preferred_schedule || '-'"></span>
                                </div>
                                <div class="flex justify-between text-sm text-slate-300 pt-2 border-t border-white/5">
                                    <span>Total Investment:</span>
                                    <span class="font-bold text-cyan-400" x-text="getSelectedProgramPrice()"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="mt-10 flex justify-between pt-6 border-t border-white/[0.06]">
                        <button type="button" @click="prevStep" x-show="step > 1" class="px-6 py-2.5 rounded-xl border border-white/10 text-white font-medium hover:bg-white/[0.04] transition-colors">
                            Back
                        </button>
                        <div x-show="step === 1" class="flex-1"></div> <!-- Spacer -->

                        <button type="button" @click="nextStep" x-show="step < totalSteps" class="px-8 py-2.5 rounded-xl bg-white text-gray-900 font-semibold hover:bg-slate-200 transition-colors shadow-lg shadow-white/10">
                            Continue
                        </button>

                        <button type="submit" x-show="step === totalSteps" :disabled="isSubmitting" class="px-8 py-2.5 rounded-xl bg-gradient-to-r from-cyan-400 to-emerald-400 text-gray-900 font-bold hover:shadow-[0_0_20px_rgba(34,211,238,0.4)] transition-all flex items-center gap-2 disabled:opacity-70">
                            <span x-show="!isSubmitting">Complete Enrollment</span>
                            <span x-show="isSubmitting">Processing...</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function enrollForm() {
        return {
            step: 1,
            totalSteps: 5,
            isSubmitting: false,
            fileName: '',
            
            // Hardcoded location data for dependent dropdowns
            locations: {
                "Egypt": ["Cairo", "Alexandria", "Giza", "Mansoura", "Assiut", "Other"],
                "Saudi Arabia": ["Riyadh", "Jeddah", "Dammam", "Mecca", "Other"],
                "United Arab Emirates": ["Dubai", "Abu Dhabi", "Sharjah", "Other"],
                "Jordan": ["Amman", "Zarqa", "Irbid", "Other"],
                "Other": ["Other"]
            },

            programsData: {
                @php
                    $programsList = \App\Models\Program::where('is_active', true)->get();
                @endphp
                @foreach($programsList as $prog)
                    '{{ $prog->slug }}': { title: '{{ addslashes($prog->title) }}', price: 'EGP {{ number_format($prog->price) }}' },
                @endforeach
            },

            form: {
                selected_program: '',
                first_name: '',
                last_name: '',
                email: '',
                phone: '',
                country: '',
                city: '',
                custom_city: '',
                education_level: '',
                experience: '',
                motivation: '',
                preferred_schedule: '',
                payment_method: 'instapay',
                payment_screenshot: null
            },
            
            errors: {
                global: '',
                selected_program: '',
                first_name: '', last_name: '', email: '', phone: '', country: '', city: '',
                education_level: '', experience: '', motivation: '',
                preferred_schedule: '', payment_method: '', payment_screenshot: ''
            },

            clearError(field) {
                this.errors[field] = '';
                this.errors.global = '';
            },
            
            handleFileUpload(event) {
                this.clearError('payment_screenshot');
                const file = event.target.files[0];
                if (file) {
                    this.fileName = file.name;
                    this.form.payment_screenshot = file;
                } else {
                    this.fileName = '';
                    this.form.payment_screenshot = null;
                }
            },

            getSelectedProgramName() {
                if (!this.form.selected_program) return 'Not selected';
                return this.programsData[this.form.selected_program] ? this.programsData[this.form.selected_program].title : 'Unknown';
            },

            getSelectedProgramPrice() {
                if (!this.form.selected_program) return '-';
                return this.programsData[this.form.selected_program] ? this.programsData[this.form.selected_program].price : '-';
            },

            handleEnter(event) {
                // If it's a textarea, let Enter create a new line naturally
                if (event.target.tagName.toLowerCase() === 'textarea') {
                    return;
                }
                
                // If not on the last step, trigger nextStep instead of form submit
                if (this.step < this.totalSteps) {
                    this.nextStep();
                } else {
                    this.submitForm();
                }
            },

            validateStep() {
                let isValid = true;
                
                // Reset all errors for current step
                this.errors.global = '';
                
                if (this.step === 1) {
                    if (!this.form.selected_program) {
                        this.errors.selected_program = 'Please select a program to continue.';
                        isValid = false;
                    }
                }
                
                if (this.step === 2) {
                    if (!this.form.first_name.trim() || this.form.first_name.length < 2) {
                        this.errors.first_name = 'First name must be at least 2 characters.';
                        isValid = false;
                    }
                    if (!this.form.last_name.trim() || this.form.last_name.length < 2) {
                        this.errors.last_name = 'Last name must be at least 2 characters.';
                        isValid = false;
                    }
                    if (!this.form.email.trim() || !/^\S+@\S+\.\S+$/.test(this.form.email)) {
                        this.errors.email = 'Please enter a valid email address.';
                        isValid = false;
                    }
                    if (!this.form.phone.trim() || this.form.phone.length < 8) {
                        this.errors.phone = 'Please enter a valid phone number.';
                        isValid = false;
                    }
                    if (!this.form.country) {
                        this.errors.country = 'Please select your country.';
                        isValid = false;
                    }
                    if (!this.form.city) {
                        this.errors.city = 'Please select your city.';
                        isValid = false;
                    } else if (this.form.city === 'Other' && (!this.form.custom_city || this.form.custom_city.trim().length < 2)) {
                        this.errors.city = 'Please specify your city.';
                        isValid = false;
                    }
                }
                
                if (this.step === 3) {
                    if (!this.form.education_level) {
                        this.errors.education_level = 'Please select your education level.';
                        isValid = false;
                    }
                    if (!this.form.experience.trim() || this.form.experience.length < 10) {
                        this.errors.experience = 'Please provide at least 10 characters.';
                        isValid = false;
                    }
                    if (!this.form.motivation.trim() || this.form.motivation.length < 10) {
                        this.errors.motivation = 'Please provide at least 10 characters.';
                        isValid = false;
                    }
                }
                
                if (this.step === 4) {
                    if (!this.form.preferred_schedule) {
                        this.errors.preferred_schedule = 'Please select a preferred schedule.';
                        isValid = false;
                    }
                }
                
                if (this.step === 5) {
                    if (!this.form.payment_method) {
                        this.errors.payment_method = 'Please select a payment method.';
                        isValid = false;
                    }
                    if (this.form.payment_method === 'instapay' && !this.form.payment_screenshot) {
                        this.errors.payment_screenshot = 'Please upload a payment screenshot.';
                        isValid = false;
                    }
                }
                
                return isValid;
            },

            scrollToFormTop() {
                // Wait for Alpine DOM updates to finish before scrolling
                this.$nextTick(() => {
                    const yOffset = -100; // offset for fixed header
                    const element = this.$refs.formContainer;
                    const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;
                    window.scrollTo({top: y, behavior: 'smooth'});
                });
            },

            nextStep() {
                if (this.validateStep()) {
                    this.step++;
                    this.scrollToFormTop();
                } else {
                    // Optional: shake animation or general alert
                    this.errors.global = 'Please fix the highlighted errors before proceeding.';
                }
            },

            prevStep() {
                this.step--;
                this.scrollToFormTop();
                this.errors.global = '';
            },

            submitForm() {
                if (this.validateStep()) {
                    this.isSubmitting = true;
                    // If 'Other' city was selected, ensure the native select submits the custom value
                    // Since it's a select, native form submission will submit 'Other'. 
                    // To fix this, we can insert a hidden input right before submission.
                    if (this.form.city === 'Other') {
                        let cityInput = document.createElement('input');
                        cityInput.type = 'hidden';
                        cityInput.name = 'city';
                        cityInput.value = this.form.custom_city;
                        document.getElementById('enrollmentForm').appendChild(cityInput);
                        
                        // Disable the select so its 'Other' value isn't submitted
                        document.querySelector('select[name="city"]').disabled = true;
                    }
                    
                    document.getElementById('enrollmentForm').submit();
                } else {
                    this.errors.global = 'Please fix the highlighted errors before submitting.';
                }
            }
        }
    }
</script>
@endpush
