@extends('components.layout')

@section('title', 'Contact Us - Robotics Corner')

@php
    $contactEmail = \App\Models\SiteSetting::get('contact_email', 'info@roboticscorner.tech');
    $contactPhone = \App\Models\SiteSetting::get('contact_phone', '+20 111 115 9633');
    $contactAddress = \App\Models\SiteSetting::get('contact_address', 'Cairo, Egypt');
    $whatsappNumber = \App\Models\SiteSetting::get('whatsapp_number', '+0201111159633');
@endphp

@section('content')
    @include('components.page-hero', [
        'title' => 'Contact Us',
        'subtitle' => 'We\'re here to help you succeed in your technical journey'
    ])

    <section class="relative z-10 max-w-6xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Left Column: Form -->
            <div class="bg-white/[0.03] backdrop-blur-xl border border-white/[0.06] rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-6">Send us a Message</h2>
                
                @if(session('success'))
                    <div class="bg-emerald-400/20 text-emerald-400 px-4 py-3 rounded-xl mb-6 border border-emerald-400/30">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label for="name" class="text-sm font-medium text-slate-300 mb-1.5 block">Full Name</label>
                        <input type="text" id="name" name="name" required value="{{ old('name') }}"
                            class="w-full px-4 py-3 bg-white/[0.04] border @error('name') border-red-500/50 @else border-white/[0.08] @enderror rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-400/50 transition-colors"
                            placeholder="John Doe">
                        @error('name')
                            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="text-sm font-medium text-slate-300 mb-1.5 block">Email</label>
                        <input type="email" id="email" name="email" required value="{{ old('email') }}"
                            class="w-full px-4 py-3 bg-white/[0.04] border @error('email') border-red-500/50 @else border-white/[0.08] @enderror rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-400/50 transition-colors"
                            placeholder="john@example.com">
                        @error('email')
                            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="subject" class="text-sm font-medium text-slate-300 mb-1.5 block">Subject</label>
                        <input type="text" id="subject" name="subject" required value="{{ old('subject') }}"
                            class="w-full px-4 py-3 bg-white/[0.04] border @error('subject') border-red-500/50 @else border-white/[0.08] @enderror rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-400/50 transition-colors"
                            placeholder="How can we help?">
                        @error('subject')
                            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="message" class="text-sm font-medium text-slate-300 mb-1.5 block">Message</label>
                        <textarea id="message" name="message" rows="5" required
                            class="w-full px-4 py-3 bg-white/[0.04] border @error('message') border-red-500/50 @else border-white/[0.08] @enderror rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-cyan-400/50 transition-colors resize-y"
                            placeholder="Your message here...">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-cyan-400 to-emerald-400 text-gray-900 font-semibold rounded-xl hover:shadow-lg hover:shadow-cyan-400/20 transition-all duration-300">
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Right Column: Contact Info -->
            <div class="flex flex-col gap-4">
                <h2 class="text-2xl font-bold text-white mb-2">Get in Touch</h2>

                <div class="bg-white/[0.03] backdrop-blur-xl border border-white/[0.06] rounded-2xl p-6 text-center hover:border-cyan-400/20 transition-colors">
                    <div class="text-3xl mb-3">📱</div>
                    <h3 class="text-lg font-semibold text-white mb-1">WhatsApp</h3>
                    <p class="text-sm text-slate-400 mb-3">Quick support and inquiries</p>
                    <a href="https://wa.me/{{ str_replace(['+', ' '], '', $whatsappNumber) }}" target="_blank" rel="noopener noreferrer" class="text-cyan-400 font-semibold hover:underline">
                        {{ $contactPhone }}
                    </a>
                </div>

                <div class="bg-white/[0.03] backdrop-blur-xl border border-white/[0.06] rounded-2xl p-6 text-center hover:border-cyan-400/20 transition-colors">
                    <div class="text-3xl mb-3">📧</div>
                    <h3 class="text-lg font-semibold text-white mb-1">Email</h3>
                    <p class="text-sm text-slate-400 mb-3">Detailed inquiries and support</p>
                    <a href="mailto:{{ $contactEmail }}" class="text-cyan-400 font-semibold hover:underline">
                        {{ $contactEmail }}
                    </a>
                </div>

                <div class="bg-white/[0.03] backdrop-blur-xl border border-white/[0.06] rounded-2xl p-6 text-center hover:border-cyan-400/20 transition-colors">
                    <div class="text-3xl mb-3">📍</div>
                    <h3 class="text-lg font-semibold text-white mb-1">Location</h3>
                    <p class="text-sm text-slate-400 mb-3">Visit our training center</p>
                    <p class="text-slate-300 font-semibold mb-4">{{ $contactAddress }}</p>
                    <div class="rounded-lg overflow-hidden border border-white/[0.06]">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3453.9368!2d31.2357!3d30.0444!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzDCsDAyJzQwLjAiTiAzMcKwMTQnMDguNSJF!5e0!3m2!1sen!2seg!4v1703424752009!5m2!1sen!2seg" width="100%" height="150" style="border: 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Google Maps Location"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection