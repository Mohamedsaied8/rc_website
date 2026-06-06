@php
    $programs = \App\Models\Program::where('is_active', true)->orderBy('sort_order')->limit(3)->get();

    $contactEmail = \App\Models\SiteSetting::get('contact_email', 'info@roboticscorner.tech');
    $contactPhone = \App\Models\SiteSetting::get('contact_phone', '+20 111 115 9633');
    $contactAddress = \App\Models\SiteSetting::get('contact_address', 'Cairo, Egypt');
    $facebookUrl = \App\Models\SiteSetting::get('facebook_url', 'https://facebook.com/roboticscorner');
    $twitterUrl = \App\Models\SiteSetting::get('twitter_url', 'https://twitter.com/roboticscorner');
    $linkedinUrl = \App\Models\SiteSetting::get('linkedin_url', 'https://linkedin.com/company/roboticscorner');
    $youtubeUrl = \App\Models\SiteSetting::get('youtube_url', 'https://youtube.com/@roboticscorner9870');
    $siteTitle = \App\Models\SiteSetting::get('site_title', 'Robotics Corner');
    $siteTagline = \App\Models\SiteSetting::get('site_tagline', 'Empowering engineers with cutting-edge robotics and software engineering skills.');
@endphp

<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>{{ $siteTitle }}</h3>
                <p>{{ $siteTagline }}</p>
                <div class="social-links">
                    <a href="{{ $facebookUrl }}" aria-label="Facebook" target="_blank">📘</a>
                    <a href="{{ $twitterUrl }}" aria-label="Twitter" target="_blank">🐦</a>
                    <a href="{{ $linkedinUrl }}" aria-label="LinkedIn" target="_blank">💼</a>
                    <a href="{{ $youtubeUrl }}" aria-label="YouTube" target="_blank">📺</a>
                </div>
            </div>

            <div class="footer-section">
                <h4>Programs</h4>
                <ul>
                    @foreach($programs as $program)
                        <li><a href="{{ route('programs.show', $program->slug) }}">{{ $program->title }}</a></li>
                    @endforeach
                </ul>
            </div>



            <div class="footer-section">
                <h4>Contact</h4>
                <div class="contact-info">
                    <p>📧 {{ $contactEmail }}</p>
                    <p>📱 {{ $contactPhone }}</p>
                    <p>📍 {{ $contactAddress }}</p>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Robotics Corner. All rights reserved.</p>
            <div class="footer-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>