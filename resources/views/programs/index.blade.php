@extends('components.layout')

@section('title', 'Programs - Robotics Corner')
@section('description', 'Explore our comprehensive programs in robotics, embedded systems, and software engineering.')

@section('content')
    <section class="hero compact">
        <div class="container">
            <h1 class="section-title">Our Programs</h1>
            <p class="section-subtitle">Structured learning paths designed for career advancement</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="programs-grid" style="display: grid; gap: 2rem; margin-top: 2rem;">
                @foreach($programs as $program)
                    <div class="program-card reveal"
                        style="background: #fff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 2rem; box-shadow: 0 8px 30px rgba(0,0,0,0.1); transition: all 0.3s ease; display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; align-items: center;">
                        <div class="program-content">
                            <h3 class="program-title"
                                style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: #1e293b;">
                                {{ $program['title'] }}</h3>
                            <p class="program-description" style="color: #64748b; margin-bottom: 1.5rem; line-height: 1.6;">
                                {{ $program['description'] }}</p>

                            <div class="course-list" style="margin-bottom: 1.5rem;">
                                <h4 style="margin-bottom: 0.5rem; color: #1e293b;">Includes Courses:</h4>
                                @foreach($program['courses'] as $course)
                                    <span class="course-link" style="display: block; color: #64748b; margin-bottom: 0.25rem;">→
                                        {{ $course['title'] }}</span>
                                @endforeach
                            </div>

                            <div style="margin-top: 0.5rem; display: flex; gap: 0.5rem;">
                                <a href="{{ route('enroll', ['program' => $program['id']]) }}" class="btn"
                                    style="display: inline-block; padding: 0.8rem 1.2rem; border-radius: 12px; font-weight: 700; background: #2dd4bf; color: #0b1220; text-decoration: none;">Enroll</a>
                                <a href="{{ route('programs.show', $program['id']) }}" class="btn"
                                    style="display: inline-block; padding: 0.8rem 1.2rem; border-radius: 12px; font-weight: 700; background: #0ea5e9; color: #fff; text-decoration: none;">Program
                                    Details</a>
                            </div>
                        </div>

                        {{-- START FIX: Check if video exists --}}
                        @if(!empty($program['video']))
                        <div class="program-video">
                            <iframe width="100%" height="250" style="border: 0; border-radius: 12px"
                                src="{{ $program['video'] }}" title="{{ $program['title'] }}"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                        @else
                        <div class="program-video" style="background: #f8fafc; border-radius: 12px; height: 250px; display: flex; align-items: center; justify-content: center;">
                            <span style="color: #94a3b8">No Preview Available</span>
                        </div>
                        @endif
                        {{-- END FIX --}}
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        @media (max-width: 768px) {
            .program-card {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
@endsection
