@extends('components.layout')

@section('title', 'Contact Us - Robotics Corner')

@php
    $contactEmail = \App\Models\SiteSetting::get('contact_email', 'info@roboticscorner.tech');
    $contactPhone = \App\Models\SiteSetting::get('contact_phone', '+20 111 115 9633');
    $contactAddress = \App\Models\SiteSetting::get('contact_address', 'Cairo, Egypt');
    $whatsappNumber = \App\Models\SiteSetting::get('whatsapp_number', '+0201111159633');
@endphp

@section('content')
    <!-- Enhanced Hero for Contact -->
    <section class="relative pt-32 pb-16 overflow-hidden bg-slate-50">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-cyan-100 via-slate-50 to-slate-50"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[600px] bg-cyan-200/50 rounded-full blur-[120px] pointer-events-none"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6 animate-fade-in-up">
                {{ cms('contact.hero.title', 'Get in Touch') }}
            </h1>
            <p class="text-lg md:text-xl text-slate-600 max-w-2xl mx-auto animate-fade-in-up" style="animation-delay: 100ms;">
                {{ cms('contact.hero.subtitle', 'Whether you are interested in enterprise solutions or professional training, our team is ready to help.') }}
            </p>
        </div>
    </section>

    <section class="relative z-10 max-w-7xl mx-auto px-6 py-12 pb-32">
        <div class="grid lg:grid-cols-5 gap-8 lg:gap-12">
            
            <!-- Left Column: Contact Cards -->
            <div class="lg:col-span-2 space-y-6">
                <!-- HQ Card -->
                <div class="bg-white border border-slate-200 rounded-3xl p-8 hover:border-cyan-300 hover:shadow-lg transition-all duration-500 group relative overflow-hidden shadow-sm">
                    <div class="absolute -right-12 -top-12 w-32 h-32 bg-cyan-500/5 rounded-full blur-2xl group-hover:bg-cyan-500/10 transition-colors"></div>
                    <div class="w-14 h-14 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center mb-6">
                        <i class="fa-solid fa-building text-2xl text-cyan-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">{{ cms('contact.cards.hq_title', 'Headquarters') }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-4">{{ cms('contact.cards.hq_desc', 'Visit our R&D labs and training center. Appointment required.') }}</p>
                    <p class="text-slate-900 font-bold">{{ cms('contact.cards.hq_address', 'Maadi, Cairo, Egypt') }}</p>
                </div>

                <!-- Email Card -->
                <div class="bg-white border border-slate-200 rounded-3xl p-8 hover:border-emerald-300 hover:shadow-lg transition-all duration-500 group relative overflow-hidden shadow-sm">
                    <div class="absolute -right-12 -top-12 w-32 h-32 bg-emerald-500/5 rounded-full blur-2xl group-hover:bg-emerald-500/10 transition-colors"></div>
                    <div class="w-14 h-14 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center mb-6">
                        <i class="fa-solid fa-envelope text-2xl text-emerald-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">{{ cms('contact.cards.email_title', 'Email Us') }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-4">{{ cms('contact.cards.email_desc', 'For partnerships, career inquiries, or detailed technical support.') }}</p>
                    <a href="mailto:{{ $contactEmail }}" class="text-emerald-600 font-bold hover:text-emerald-700 transition-colors">{{ cms('contact.cards.email_val', $contactEmail) }}</a>
                </div>

                <!-- WhatsApp Card -->
                <div class="bg-white border border-slate-200 rounded-3xl p-8 hover:border-green-300 hover:shadow-lg transition-all duration-500 group relative overflow-hidden shadow-sm">
                    <div class="absolute -right-12 -top-12 w-32 h-32 bg-green-500/5 rounded-full blur-2xl group-hover:bg-green-500/10 transition-colors"></div>
                    <div class="w-14 h-14 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center mb-6">
                        <i class="fa-brands fa-whatsapp text-2xl text-green-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">{{ cms('contact.cards.whatsapp_title', 'WhatsApp Support') }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-4">{{ cms('contact.cards.whatsapp_desc', 'Fastest response time for enrollment queries and general questions.') }}</p>
                    <a href="https://wa.me/{{ str_replace(['+', ' '], '', $whatsappNumber) }}" target="_blank" rel="noopener noreferrer" class="text-green-600 font-bold hover:text-green-700 transition-colors">{{ $contactPhone }}</a>
                </div>
            </div>

            <!-- Right Column: Form -->
            <div class="lg:col-span-3">
                <div class="bg-white border border-slate-200 rounded-3xl p-8 md:p-12 shadow-xl relative overflow-hidden">
                    <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-cyan-400 via-emerald-400 to-cyan-400"></div>
                    
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-8">{{ cms('contact.form.title', 'Send a Message') }}</h2>
                    
                    @if(session('success'))
                        <div class="bg-emerald-50 text-emerald-700 px-6 py-4 rounded-2xl mb-8 border border-emerald-200 flex items-center gap-3">
                            <i class="fa-solid fa-circle-check text-xl"></i>
                            <span class="font-bold">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                        @csrf
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div class="space-y-2">
                                <label for="name" class="text-sm font-bold text-slate-700">Full Name <span class="text-cyan-500">*</span></label>
                                <input type="text" id="name" name="name" required value="{{ old('name') }}"
                                    class="w-full bg-slate-50 border @error('name') border-red-500 @else border-slate-200 @enderror rounded-xl px-5 py-4 text-slate-900 placeholder-slate-400 focus:outline-none focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10 transition-all">
                                @error('name')
                                    <p class="text-xs text-red-500 mt-1 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Email -->
                            <div class="space-y-2">
                                <label for="email" class="text-sm font-bold text-slate-700">Work Email <span class="text-cyan-500">*</span></label>
                                <input type="email" id="email" name="email" required value="{{ old('email') }}"
                                    class="w-full bg-slate-50 border @error('email') border-red-500 @else border-slate-200 @enderror rounded-xl px-5 py-4 text-slate-900 placeholder-slate-400 focus:outline-none focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10 transition-all">
                                @error('email')
                                    <p class="text-xs text-red-500 mt-1 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Department -->
                        <div class="space-y-2">
                            <label for="department" class="text-sm font-bold text-slate-700">Department <span class="text-cyan-500">*</span></label>
                            <div class="relative">
                                <select id="department" name="department" required
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-slate-900 appearance-none focus:outline-none focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10 transition-all cursor-pointer">
                                    <option value="" class="text-slate-500">Select the relevant department...</option>
                                    <option value="sales" class="bg-white text-slate-900">Enterprise Sales & Product Quotes</option>
                                    <option value="training" class="bg-white text-slate-900">Training & Education Admissions</option>
                                    <option value="support" class="bg-white text-slate-900">Technical Support</option>
                                    <option value="general" class="bg-white text-slate-900">General Inquiry</option>
                                </select>
                                <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-chevron-down text-sm"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Subject -->
                        <div class="space-y-2">
                            <label for="subject" class="text-sm font-bold text-slate-700">Subject <span class="text-cyan-500">*</span></label>
                            <input type="text" id="subject" name="subject" required value="{{ old('subject') }}"
                                class="w-full bg-slate-50 border @error('subject') border-red-500 @else border-slate-200 @enderror rounded-xl px-5 py-4 text-slate-900 placeholder-slate-400 focus:outline-none focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10 transition-all"
                                placeholder="How can we assist your enterprise?">
                            @error('subject')
                                <p class="text-xs text-red-500 mt-1 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div class="space-y-2">
                            <label for="message" class="text-sm font-bold text-slate-700">Message <span class="text-cyan-500">*</span></label>
                            <textarea id="message" name="message" rows="6" required
                                class="w-full bg-slate-50 border @error('message') border-red-500 @else border-slate-200 @enderror rounded-xl px-5 py-4 text-slate-900 placeholder-slate-400 focus:outline-none focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10 transition-all resize-none"
                                placeholder="Please provide details about your inquiry...">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-xs text-red-500 mt-1 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit" class="w-full group relative inline-flex items-center justify-center gap-3 px-8 py-4 bg-gradient-to-r from-cyan-500 to-emerald-500 rounded-xl text-white font-bold text-lg hover:shadow-lg hover:shadow-cyan-500/30 transition-all duration-300 overflow-hidden">
                                <span class="relative z-10">{{ cms('contact.form.button', 'Send Message') }}</span>
                                <i class="fa-solid fa-paper-plane relative z-10 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                                <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Google Maps Integration -->
        <div class="mt-12 rounded-3xl overflow-hidden border border-slate-200 shadow-md relative h-[300px] group">
            <div class="absolute inset-0 bg-white/20 group-hover:bg-transparent transition-colors duration-500 pointer-events-none z-10"></div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3456.702430467718!2d31.258525215112196!3d29.959146181913175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145847e30d1d2f61%3A0xcba20f18bdcff762!2sMaadi%2C%20Cairo%20Governorate%2C%20Egypt!5e0!3m2!1sen!2seg!4v1703424752009!5m2!1sen!2seg" class="absolute inset-0 w-full h-full filter grayscale-[0.5] contrast-100 opacity-90 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700" style="border: 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Google Maps Location"></iframe>
        </div>
    </section>
@endsection