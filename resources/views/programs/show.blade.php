@extends('components.layout')

@section('title', $program['title'] . ' - Robotics Corner')
@section('description', $program['description'])

@section('content')
    <section class="hero">
        <div class="container">
            <h1 class="section-title">{{ $program['title'] }}</h1>
            <p class="section-subtitle">{{ $program['description'] }}</p>
            <div style="margin-top: 1rem; max-width: 800px;">
                <iframe width="100%" height="400" style="border: 0; border-radius: 12px" src="{{ $program['video'] }}"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
        </div>
    </section>

    <div class="container" style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; padding: 2rem;">
        <main class="panel"
            style="background: #fff; border: 1px solid #e2e8f0; border-radius: 18px; box-shadow: 0 6px 18px rgba(0,0,0,0.06); padding: 1.5rem;">
            <h2 style="margin-bottom: 0.5rem">Overview</h2>
            <p class="subtitle" style="color: #64748b; margin-bottom: 1.5rem;">{{ $program['overview'] }}</p>

            @if(!empty($program['topics']))
                <h3 style="margin: 1rem 0 0.5rem">What You'll Learn</h3>
                <div class="topics-list" style="margin-bottom: 1.5rem;">
                    @foreach($program['topics'] as $topic)
                        <div style="display: flex; align-items: center; margin-bottom: 0.5rem; color: #374151;">
                            <span style="color: #2dd4bf; margin-right: 0.5rem;">✓</span>
                            <span>{{ $topic }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <h3 style="margin: 1rem 0 0.5rem">Included Courses</h3>
            <div class="grid"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1rem;">
                @foreach($program['courses'] as $course)
                    <div class="course-card"
                        style="border: 1px solid #e2e8f0; border-radius: 14px; padding: 1rem; background: #fff;">
                        <strong style="color: #1e293b;">{{ $course['title'] }}</strong>
                        <div class="subtitle" style="color: #64748b; margin: 0.5rem 0;">{{ $course['description'] }}</div>
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; margin: 0.5rem 0; font-size: 0.9rem; color: #64748b;">
                            <span>⏱️ {{ $course['duration'] ?? 'N/A' }}</span>
                            <span>💰 {{ $course['price'] ?? 'N/A' }}</span>
                        </div>
                        <div style="margin-top: 0.5rem; display: flex; gap: 0.5rem;">

                            <a class="btn" href="{{ route('enroll', ['program' => $program['id']]) }}"
                                style="display: inline-block; padding: 0.5rem 1rem; border-radius: 8px; font-weight: 600; background: #0ea5e9; color: #fff; text-decoration: none; font-size: 0.9rem;">Enroll
                                in Program</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>

        <aside class="panel"
            style="background: #fff; border: 1px solid #e2e8f0; border-radius: 18px; box-shadow: 0 6px 18px rgba(0,0,0,0.06); padding: 1.5rem;">
            <h3>Program Facts</h3>
            <div class="list" style="display: grid; gap: 0.5rem; color: #475569;">
                @foreach($program['facts'] as $fact)
                    <div>• {{ $fact }}</div>
                @endforeach
            </div>
            <a href="{{ route('enroll', ['program' => $program['id']]) }}" class="btn"
                style="display: inline-block; margin-top: 1rem; padding: 0.8rem 1.2rem; border-radius: 12px; font-weight: 700; background: #2dd4bf; color: #0b1220; text-decoration: none;">Enroll
                in this Program</a>
        </aside>
    </div>

    <style>
        @media (max-width: 1000px) {
            .container {
                grid-template-columns: 1fr !important;
            }
        }

        body.dark .panel {
            background: #0f172a !important;
            border-color: #1f2937 !important;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35) !important;
        }

        body.dark .list {
            color: #94a3b8 !important;
        }

        body.dark .subtitle {
            color: #94a3b8 !important;
        }

        body.dark .course-card {
            background: #0b1220 !important;
            border-color: #1f2937 !important;
        }

        body.dark .course-card strong {
            color: #e2e8f0 !important;
        }
    </style>
@endsection