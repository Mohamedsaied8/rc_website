@extends('components.layout')

@section('title', 'About Us - Robotics Corner')
@section('description', 'Learn about Robotics Corner, our mission, vision, and the team behind your technical education.')

@section('content')
    <section class="hero compact">
        <div class="container">
            <h1 class="section-title">About Robotics Corner</h1>
            <p class="section-subtitle">Empowering engineers with cutting-edge robotics and software engineering skills</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="about-content" style="max-width: 800px; margin: 0 auto;">
                <h2 style="margin-bottom: 1rem; color: #1e293b;">Our Mission</h2>
                <p style="color: #64748b; margin-bottom: 2rem; line-height: 1.7;">To bridge the gap between academic
                    learning and industry requirements by providing hands-on, project-based education in robotics, embedded
                    systems, and software engineering.</p>

                <h2 style="margin-bottom: 1rem; color: #1e293b;">Our Vision</h2>
                <p style="color: #64748b; margin-bottom: 2rem; line-height: 1.7;">To be the leading technical education
                    platform that transforms engineers into industry-ready professionals through innovative learning
                    methodologies and real-world project experience.</p>

                <h2 style="margin-bottom: 1rem; color: #1e293b;">Our Impact</h2>
                <p style="color: #64748b; margin-bottom: 2rem; line-height: 1.7;">Since our founding, we have trained over
                    500 professionals who are now working in top tech companies worldwide. Our graduates have a 95% job
                    placement rate and consistently receive high ratings from employers.</p>
            </div>
        </div>
    </section>

    <section class="section" style="background: #f8fafc;">
        <div class="container">
            <h2 class="section-title">Our Journey</h2>
            <div class="timeline" style="max-width: 800px; margin: 0 auto;">
                @foreach($milestones as $milestone)
                    <div class="timeline-item"
                        style="display: flex; gap: 2rem; margin-bottom: 2rem; padding: 1.5rem; background: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                        <div class="timeline-year" style="font-size: 2rem; font-weight: 800; color: #2dd4bf; min-width: 80px;">
                            {{ $milestone['year'] }}</div>
                        <div class="timeline-content">
                            <h3 style="color: #1e293b; margin-bottom: 0.5rem;">{{ $milestone['title'] }}</h3>
                            <p style="color: #64748b; line-height: 1.6;">{{ $milestone['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2 class="section-title">Meet Our Expert Instructors</h2>
            <div class="instructors-grid"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 3rem;">
                @foreach($instructors as $instructor)
                    <div class="instructor-card"
                        style="text-align: center; padding: 2rem; background: #fff; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: transform 0.3s ease;">
                        <div class="instructor-image" style="font-size: 4rem; margin-bottom: 1rem;">{{ $instructor['image'] }}
                        </div>
                        <h3 style="color: #1e293b; margin-bottom: 0.5rem;">{{ $instructor['name'] }}</h3>
                        <p style="color: #2dd4bf; font-weight: 600; margin-bottom: 0.5rem;">{{ $instructor['role'] }}</p>
                        <p style="color: #64748b; margin-bottom: 0.5rem;">{{ $instructor['expertise'] }}</p>
                        <p style="color: #64748b; font-size: 0.9rem;">{{ $instructor['experience'] }} experience</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <h2>Ready to Start Your Journey?</h2>
            <p>Join our community of successful engineers and advance your career with cutting-edge technology</p>
            <div class="cta-buttons">

                <a href="{{ route('enroll') }}" class="btn-secondary">Enroll Now</a>
                <a href="{{ route('contact') }}" class="btn-secondary">Contact Us</a>
            </div>
        </div>
    </section>

    <style>
        body.dark .about-content h2 {
            color: #e2e8f0 !important;
        }

        body.dark .about-content p {
            color: #94a3b8 !important;
        }

        body.dark .timeline-item {
            background: #0f172a !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2) !important;
        }

        body.dark .timeline-content h3 {
            color: #e2e8f0 !important;
        }

        body.dark .timeline-content p {
            color: #94a3b8 !important;
        }

        body.dark .instructor-card {
            background: #0f172a !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2) !important;
        }

        body.dark .instructor-card h3 {
            color: #e2e8f0 !important;
        }

        body.dark .instructor-card p {
            color: #94a3b8 !important;
        }

        @media (max-width: 768px) {
            .timeline-item {
                flex-direction: column !important;
                gap: 1rem !important;
            }

            .timeline-year {
                min-width: auto !important;
            }
        }
    </style>
@endsection