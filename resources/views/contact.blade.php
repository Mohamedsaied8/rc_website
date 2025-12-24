@php
    $contactEmail = \App\Models\SiteSetting::get('contact_email', 'info@roboticscorner.com');
    $contactPhone = \App\Models\SiteSetting::get('contact_phone', '+20 111 115 9633');
    $contactAddress = \App\Models\SiteSetting::get('contact_address', 'Cairo, Egypt');
    $whatsappNumber = \App\Models\SiteSetting::get('whatsapp_number', '+0201111159633');
@endphp

@extends('components.layout')

@section('title', 'Contact Us - Robotics Corner')
@section('description', 'Get in touch with Robotics Corner for course inquiries, enrollment, or support.')

@section('content')
<section class="hero compact">
    <div class="container">
        <h1 class="section-title">Contact Us</h1>
        <p class="section-subtitle">We're here to help you succeed in your technical journey</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: start;">
            <div class="contact-form" style="background: #fff; padding: 2rem; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                <h2 style="margin-bottom: 1.5rem; color: #1e293b;">Send us a Message</h2>
                
                @if(session('success'))
                <div style="background: #d1fae5; color: #065f46; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    {{ session('success') }}
                </div>
                @endif
                
                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    <div style="margin-bottom: 1.5rem;">
                        <label for="name" style="display: block; margin-bottom: 0.5rem; color: #374151; font-weight: 600;">Full Name</label>
                        <input type="text" id="name" name="name" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" value="{{ old('name') }}">
                        @error('name')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label for="email" style="display: block; margin-bottom: 0.5rem; color: #374151; font-weight: 600;">Email</label>
                        <input type="email" id="email" name="email" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" value="{{ old('email') }}">
                        @error('email')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label for="subject" style="display: block; margin-bottom: 0.5rem; color: #374151; font-weight: 600;">Subject</label>
                        <input type="text" id="subject" name="subject" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" value="{{ old('subject') }}">
                        @error('subject')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <label for="message" style="display: block; margin-bottom: 0.5rem; color: #374151; font-weight: 600;">Message</label>
                        <textarea id="message" name="message" rows="5" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; resize: vertical;">{{ old('message') }}</textarea>
                        @error('message')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn-primary" style="width: 100%; padding: 0.75rem; border: none; border-radius: 8px; font-size: 1rem; font-weight: 600; cursor: pointer;">Send Message</button>
                </form>
            </div>
            
            <div class="contact-info">
                <h2 style="margin-bottom: 1.5rem; color: #1e293b;">Get in Touch</h2>
                
                <div class="contact-cards" style="display: grid; gap: 1.5rem;">
                    <div class="contact-card" style="background: #fff; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); text-align: center;">
                        <div style="font-size: 2rem; margin-bottom: 1rem;">📱</div>
                        <h3 style="color: #1e293b; margin-bottom: 0.5rem;">WhatsApp</h3>
                        <p style="color: #64748b; margin-bottom: 1rem;">Quick support and inquiries</p>
                        <a href="https://wa.me/{{ str_replace(['+', ' '], '', $whatsappNumber) }}" target="_blank" rel="noopener" style="color: #2dd4bf; text-decoration: none; font-weight: 600;">{{ $contactPhone }}</a>
                    </div>
                    
                    <div class="contact-card" style="background: #fff; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); text-align: center;">
                        <div style="font-size: 2rem; margin-bottom: 1rem;">📧</div>
                        <h3 style="color: #1e293b; margin-bottom: 0.5rem;">Email</h3>
                        <p style="color: #64748b; margin-bottom: 1rem;">Detailed inquiries and support</p>
                        <a href="mailto:{{ $contactEmail }}" style="color: #2dd4bf; text-decoration: none; font-weight: 600;">{{ $contactEmail }}</a>
                    </div>
                    
                    <div class="contact-card" style="background: #fff; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); text-align: center;">
                        <div style="font-size: 2rem; margin-bottom: 1rem;">📍</div>
                        <h3 style="color: #1e293b; margin-bottom: 0.5rem;">Location</h3>
                        <p style="color: #64748b; margin-bottom: 1rem;">Visit our training center</p>
                        <p style="color: #64748b; font-weight: 600;">{{ $contactAddress }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
@media (max-width: 768px) {
    .container > div {
        grid-template-columns: 1fr !important;
        gap: 2rem !important;
    }
}

body.dark .contact-form {
    background: #0f172a !important;
    box-shadow: 0 4px 20px rgba(0,0,0,0.2) !important;
}

body.dark .contact-form h2 {
    color: #e2e8f0 !important;
}

body.dark .contact-form label {
    color: #cbd5e1 !important;
}

body.dark .contact-form input,
body.dark .contact-form textarea {
    background: #1e293b !important;
    border-color: #334155 !important;
    color: #e2e8f0 !important;
}

body.dark .contact-card {
    background: #0f172a !important;
    box-shadow: 0 4px 20px rgba(0,0,0,0.2) !important;
}

body.dark .contact-card h3 {
    color: #e2e8f0 !important;
}

body.dark .contact-card p {
    color: #94a3b8 !important;
}

body.dark .contact-info h2 {
    color: #e2e8f0 !important;
}
</style>
@endsection
