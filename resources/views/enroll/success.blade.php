@extends('components.layout')

@section('title', 'Enrollment Successful - Robotics Corner')
@section('description', 'Your enrollment has been successfully submitted.')

@section('content')
    <section class="hero">
        <div class="container">
            <div style="text-align: center; max-width: 600px; margin: 0 auto;">
                <div style="font-size: 4rem; margin-bottom: 1rem;">🎉</div>
                <h1 class="title">Enrollment Successful!</h1>
                <p class="subtitle">Thank you for enrolling in our program. We'll be in touch soon with next steps.</p>

                @if(session('success'))
                    <div
                        style="background: #d1fae5; color: #065f46; padding: 1rem; border-radius: 8px; margin-top: 1rem; border: 1px solid #a7f3d0;">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div style="max-width: 800px; margin: 0 auto; text-align: center;">
                <div style="background: #f0fdfa; padding: 2rem; border-radius: 16px; margin-bottom: 2rem;">
                    <h2 style="color: #065f46; margin-bottom: 1rem;">What's Next?</h2>
                    <div style="display: grid; gap: 1rem; text-align: left;">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div
                                style="background: #2dd4bf; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                1</div>
                            <p style="color: #374151; margin: 0;">You'll receive a confirmation email within 24 hours</p>
                        </div>
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div
                                style="background: #2dd4bf; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                2</div>
                            <p style="color: #374151; margin: 0;">Our team will contact you to schedule your orientation</p>
                        </div>
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div
                                style="background: #2dd4bf; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                3</div>
                            <p style="color: #374151; margin: 0;">Access to course materials will be provided before the
                                start date</p>
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">

                    <a href="{{ route('contact') }}" class="btn-secondary">Contact Support</a>
                    <a href="{{ route('home') }}" class="btn-secondary">Back to Home</a>
                </div>
            </div>
        </div>
    </section>

    <style>
        body.dark .hero h1 {
            color: #e2e8f0 !important;
        }

        body.dark .hero p {
            color: #94a3b8 !important;
        }

        body.dark .section>div>div:first-child {
            background: #0f172a !important;
        }

        body.dark .section h2 {
            color: #e2e8f0 !important;
        }

        body.dark .section p {
            color: #cbd5e1 !important;
        }
    </style>
@endsection