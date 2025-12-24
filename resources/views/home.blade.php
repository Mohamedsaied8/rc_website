@extends('components.layout')

@section('title', 'Robotics Corner - Premier Technical Education Platform')
@section('description', 'Premier technical education in robotics, embedded systems, and software engineering. Learn from experts and build real projects.')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Master <span class="highlight">Robotics</span> & <span class="highlight">Software Engineering</span>
                    </h1>
                    <p class="hero-description">Industry-standard technical education that prepares you for real-world
                        challenges in top tech companies. Learn from experts, build real projects, advance your career.</p>
                    <div class="hero-buttons">
                        <a href="{{ route('enroll') }}" class="btn-primary">Enroll Now →</a>
                        <a href="https://youtube.com/shorts/IK9WlW2RYN0?si=hSH5lVHEBznNBSIB" class="btn-secondary"
                            target="_blank">▶ Watch Demo</a>
                    </div>
                    <div class="hero-stats">
                        @foreach($stats as $stat)
                            <div class="stat-item">
                                <div class="stat-number">{{ $stat['number'] }}</div>
                                <div class="stat-label">{{ $stat['label'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div id="hero-video" class="hero-video">
                    <div class="video-content" style="width:100%;height:100%;padding:0">
                        <iframe width="100%" height="315" style="min-height:315px;border:0;border-radius:12px"
                            src="https://www.youtube.com/embed/LEm8_dZao0E?si=uB2COdKa0DSROvYl"
                            title="Robotics Corner - Vision & Mission"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Courses Section -->
    <section id="courses" class="courses-section">
        <div class="courses-container">
            <div class="section-header">
                <h2 class="section-title">Professional Training Programs</h2>
                <p class="section-subtitle">Comprehensive courses designed with industry experts to bridge the gap between
                    academic learning and professional requirements.</p>
            </div>
            <div class="courses-grid">
                @foreach($courses as $course)
                    <div class="course-card reveal">
                        <div class="course-header">
                            <div class="course-icon">💻</div>
                            <span class="course-badge">Professional</span>
                        </div>
                        <h3 class="course-title">{{ $course['title'] }}</h3>
                        <p class="course-description">{{ $course['description'] }}</p>
                        <div class="course-meta">
                            <div class="meta-item">
                                <span>⏱</span>
                                <span>{{ $course['duration'] }}</span>
                            </div>
                            <div class="meta-item">
                                <span>🌐</span>
                                <span>Online/Onsite</span>
                            </div>
                            <div class="meta-item">
                                <span>👥</span>
                                <span>400+ enrolled</span>
                            </div>
                            <div class="meta-item">
                                <span>⭐</span>
                                <span>4.9/5 rating</span>
                            </div>
                        </div>
                        <div class="course-topics">
                            <h4>Key Topics:</h4>
                            <div class="topics-grid">
                                @foreach(array_slice($course['topics'], 0, 4) as $topic)
                                    <div class="topic-item">{{ $topic }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="course-footer">
                            <div>
                                <div class="course-price">{{ $course['price'] }}</div>
                                <div class="course-enrollment">400+ enrolled</div>
                            </div>
                            <div class="course-buttons">

                                <a href="{{ route('enroll', ['course' => $course['id']]) }}"
                                    class="btn-small btn-solid">Enroll</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="features-container">
            <div class="section-header">
                <h2 class="section-title">Why Choose Robotics Corner?</h2>
                <p class="section-subtitle">We combine industry expertise with cutting-edge curriculum to deliver education
                    that makes a real difference in your career.</p>
            </div>
            <div class="features-grid">
                @foreach($features as $feature)
                    <div class="feature-item reveal">
                        <div class="feature-icon">{{ $feature['icon'] }}</div>
                        <h3 class="feature-title">{{ $feature['title'] }}</h3>
                        <p class="feature-description">{{ $feature['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="enroll" class="cta-section">
        <div class="cta-container">
            <h2 class="cta-title">Ready to Transform Your Career?</h2>
            <p class="cta-subtitle">Join thousands of professionals who have advanced their careers with our
                industry-leading technical education programs.</p>
            <div class="cta-buttons">

                <a href="{{ route('enroll') }}" class="btn-secondary">Enroll Now</a>
                <a href="https://wa.me/201111159633" target="_blank" rel="noopener" class="btn-secondary">💬 Chat with
                    Us</a>
            </div>
            <div class="whatsapp-note">
                <span>✅</span>
                <span>Get instant answers to your questions via WhatsApp</span>
            </div>
        </div>
    </section>
@endsection