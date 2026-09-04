@extends('components.layout')

@section('title', 'Contact Us - Robotics Corner')
@section('description', 'Get in touch with Robotics Corner. Reach us by email, phone, or WhatsApp for training, R&D, consultation, and outsourcing enquiries.')

@php
    $contactEmail = \App\Models\SiteSetting::get('contact_email', 'info@roboticscorner.tech');
    $contactPhone = \App\Models\SiteSetting::get('contact_phone', '+20 115 680 0621');
    $contactAddress = \App\Models\SiteSetting::get('contact_address', 'Cairo, Egypt');
    $whatsappNumber = \App\Models\SiteSetting::get('whatsapp_number', '+201156800621');
@endphp

@section('content')
    <div class="relative w-full h-full min-h-[calc(100vh-4.5rem)] lg:min-h-0 lg:h-full flex flex-col lg:flex-row items-stretch overflow-hidden bg-slate-50">
        <!-- Sleek Tech Radial Background (Brand colors) -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-cyan-50/50 via-slate-50 to-slate-50"></div>
            <div class="absolute top-1/2 left-1/4 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-cyan-200/20 rounded-full blur-[100px] pointer-events-none"></div>
            <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-emerald-200/10 rounded-full blur-[80px] pointer-events-none"></div>
        </div>

        <!-- Inner content wrapper -->
        <div class="relative z-10 max-w-7xl mx-auto w-full h-full px-6 lg:px-8 py-6 flex flex-col lg:grid lg:grid-cols-12 gap-6 items-stretch overflow-y-auto lg:overflow-hidden">
            
            <!-- Left Column: Title & Info Tiles & Map -->
            <div class="lg:col-span-5 flex flex-col justify-between gap-4 h-full">
                <!-- Branding Header -->
                <div class="space-y-2">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight leading-[1.05] animate-fade-in-up">
                        {{ cms('contact.hero.title', 'Get in Touch') }}
                    </h1>
                    <p class="text-sm lg:text-base text-slate-600 animate-fade-in-up leading-relaxed" style="animation-delay: 100ms;">
                        {{ cms('contact.hero.subtitle', 'Whether you are interested in enterprise solutions or professional training, our team is ready to help.') }}
                    </p>
                </div>

                <!-- Stack of Info Cards (Vertical on lg, grid on sm) -->
                <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-1 gap-3 flex-shrink-0">
                    <!-- HQ Card -->
                    <div class="bg-white/70 backdrop-blur-md border border-slate-200/60 rounded-2xl p-4 hover:border-cyan-300 hover:shadow-md transition-all duration-300 flex items-center gap-4 group relative overflow-hidden">
                        <div class="absolute -right-6 -top-6 w-16 h-16 bg-cyan-500/5 rounded-full blur-xl group-hover:bg-cyan-500/10 transition-colors"></div>
                        <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-building text-base text-cyan-500"></i>
                        </div>
                        <div class="min-w-0">
                            <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">{{ cms('contact.cards.hq_title', 'Headquarters') }}</h3>
                            <p class="text-[11px] text-slate-500 leading-tight mb-0.5 truncate">{{ cms('contact.cards.hq_desc', 'Visit our R&D labs.') }}</p>
                            <p class="text-xs font-bold text-slate-800 truncate">{{ cms('contact.cards.hq_address', 'Maadi, Cairo, Egypt') }}</p>
                        </div>
                    </div>

                    <!-- Email Card -->
                    <div class="bg-white/70 backdrop-blur-md border border-slate-200/60 rounded-2xl p-4 hover:border-emerald-300 hover:shadow-md transition-all duration-300 flex items-center gap-4 group relative overflow-hidden">
                        <div class="absolute -right-6 -top-6 w-16 h-16 bg-emerald-500/5 rounded-full blur-xl group-hover:bg-emerald-500/10 transition-colors"></div>
                        <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-envelope text-base text-emerald-500"></i>
                        </div>
                        <div class="min-w-0">
                            <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">{{ cms('contact.cards.email_title', 'Email Us') }}</h3>
                            <p class="text-[11px] text-slate-500 leading-tight mb-0.5 truncate">{{ cms('contact.cards.email_desc', 'For partnerships & support.') }}</p>
                            <a href="mailto:{{ $contactEmail }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition-colors block truncate">{{ cms('contact.cards.email_val', $contactEmail) }}</a>
                        </div>
                    </div>

                    <!-- WhatsApp Card -->
                    <div class="bg-white/70 backdrop-blur-md border border-slate-200/60 rounded-2xl p-4 hover:border-green-300 hover:shadow-md transition-all duration-300 flex items-center gap-4 group relative overflow-hidden">
                        <div class="absolute -right-6 -top-6 w-16 h-16 bg-green-500/5 rounded-full blur-xl group-hover:bg-green-500/10 transition-colors"></div>
                        <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0">
                            <i class="fa-brands fa-whatsapp text-base text-green-500"></i>
                        </div>
                        <div class="min-w-0">
                            <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">{{ cms('contact.cards.whatsapp_title', 'WhatsApp Support') }}</h3>
                            <p class="text-[11px] text-slate-500 leading-tight mb-0.5 truncate">{{ cms('contact.cards.whatsapp_desc', 'Fastest response time.') }}</p>
                            <a href="https://wa.me/{{ str_replace(['+', ' '], '', $whatsappNumber) }}" target="_blank" rel="noopener noreferrer" class="text-xs font-bold text-green-600 hover:text-green-700 transition-colors block truncate">{{ $contactPhone }}</a>
                        </div>
                    </div>
                </div>

                <!-- Google Maps Card -->
                <div class="relative rounded-2xl overflow-hidden border border-slate-200 shadow-sm grow min-h-[160px] lg:h-full group flex-1">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3456.702430467718!2d31.258525215112196!3d29.959146181913175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145847e30d1d2f61%3A0xcba20f18bdcff762!2sMaadi%2C%20Cairo%20Governorate%2C%20Egypt!5e0!3m2!1sen!2seg!4v1703424752009!5m2!1sen!2seg" class="absolute inset-0 w-full h-full filter grayscale-[0.3] contrast-100 opacity-90 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700" style="border: 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Google Maps Location"></iframe>
                </div>
            </div>

            <!-- Right Column: Form Container -->
            <div class="lg:col-span-7 h-full flex flex-col">
                <div class="bg-white border border-slate-200/80 rounded-3xl p-6 lg:p-8 shadow-md relative overflow-hidden flex flex-col justify-between h-full bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-white via-white to-slate-50/50">
                    <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-cyan-400 via-emerald-400 to-cyan-400"></div>
                    
                    <div class="flex flex-col h-full justify-between">
                        <div>
                            <h2 class="text-2xl font-extrabold text-slate-900 mb-1">{{ cms('contact.form.title', 'Send a Message') }}</h2>
                            <p class="text-xs text-slate-500 mb-6">Drop us a line and our experts will get back to you within 24 hours.</p>
                            
                            @if(session('success'))
                                <div class="bg-emerald-50 text-emerald-700 px-4 py-2.5 rounded-xl mb-4 border border-emerald-200 flex items-center gap-2 text-sm">
                                    <i class="fa-solid fa-circle-check text-base"></i>
                                    <span class="font-bold">{{ session('success') }}</span>
                                </div>
                            @endif
                        </div>

                        <form method="POST" action="{{ route('contact.store') }}" class="flex-1 flex flex-col justify-between gap-4">
                            @csrf
                            
                            <div class="grid md:grid-cols-2 gap-4">
                                <!-- Name -->
                                <div class="space-y-1">
                                    <label for="name" class="text-xs font-bold text-slate-700">Full Name <span class="text-cyan-500">*</span></label>
                                    <input type="text" id="name" name="name" required value="{{ old('name') }}"
                                        class="w-full bg-slate-50 border @error('name') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10 transition-all">
                                    @error('name')
                                        <p class="text-[11px] text-red-500 mt-0.5 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Email -->
                                <div class="space-y-1">
                                    <label for="email" class="text-xs font-bold text-slate-700">Work Email <span class="text-cyan-500">*</span></label>
                                    <input type="email" id="email" name="email" required value="{{ old('email') }}"
                                        class="w-full bg-slate-50 border @error('email') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10 transition-all">
                                    @error('email')
                                        <p class="text-[11px] text-red-500 mt-0.5 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Department -->
                            <div class="space-y-1">
                                <label for="department" class="text-xs font-bold text-slate-700">Department <span class="text-cyan-500">*</span></label>
                                <div class="relative">
                                    <select id="department" name="department" required
                                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-900 appearance-none focus:outline-none focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10 transition-all cursor-pointer">
                                        <option value="" class="text-slate-500">Select the relevant department...</option>
                                        <option value="sales" class="bg-white text-slate-900">Enterprise Sales & Product Quotes</option>
                                        <option value="training" class="bg-white text-slate-900">Training & Education Admissions</option>
                                        <option value="support" class="bg-white text-slate-900">Technical Support</option>
                                        <option value="general" class="bg-white text-slate-900">General Inquiry</option>
                                    </select>
                                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                        <i class="fa-solid fa-chevron-down text-xs"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Subject -->
                            <div class="space-y-1">
                                <label for="subject" class="text-xs font-bold text-slate-700">Subject <span class="text-cyan-500">*</span></label>
                                <input type="text" id="subject" name="subject" required value="{{ old('subject') }}"
                                    class="w-full bg-slate-50 border @error('subject') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10 transition-all"
                                    placeholder="How can we assist your enterprise?">
                                @error('subject')
                                    <p class="text-[11px] text-red-500 mt-0.5 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Message -->
                            <div class="space-y-1 flex-1 flex flex-col">
                                <label for="message" class="text-xs font-bold text-slate-700">Message <span class="text-cyan-500">*</span></label>
                                <textarea id="message" name="message" required
                                    class="w-full flex-1 bg-slate-50 border @error('message') border-red-500 @else border-slate-200 @enderror rounded-xl px-4 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10 transition-all resize-none min-h-[80px]"
                                    placeholder="Please provide details about your inquiry...">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-[11px] text-red-500 mt-0.5 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-2">
                                <button type="submit" class="w-full group relative inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-cyan-500 to-emerald-500 rounded-xl text-white font-bold text-base hover:shadow-md hover:shadow-cyan-500/20 transition-all duration-300 overflow-hidden">
                                    <span class="relative z-10">{{ cms('contact.form.button', 'Send Message') }}</span>
                                    <i class="fa-solid fa-paper-plane relative z-10 text-sm group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                                    <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('styles')
<style>
    main#main {
        margin-top: 4.5rem !important;
    }
    /* Prevent scrolling only on large screens */
    @media (min-width: 1024px) {
        body {
            overflow: hidden !important;
            height: 100vh !important;
        }
        main#main {
            min-height: 0 !important;
            height: calc(100vh - 4.5rem) !important;
        }
        footer {
            display: none !important;
        }
    }
</style>
@endpush