<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Helpers\VideoHelper;
use App\Helpers\CurrencyHelper;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(function ($course) {
                return [
                    'id' => $course->slug,
                    'title' => $course->title,
                    'description' => $course->short_description,
                    'duration' => $course->duration,
                    'price' => CurrencyHelper::format($course->price, $course->currency ?? 'USD'),
                    'topics' => $course->topics,
                    'video' => $course->video_url//VideoHelper::getEmbedUrl($course->video_url)
                ];
            });

        return view('courses.index', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::where('slug', $id)->where('is_active', true)->with('programs')->first();
        
        if (!$course) {
            abort(404);
        }

        // Get the first associated program (courses can be in multiple programs)
        $associatedProgram = $course->programs->first();

        // Transform the course data to match the expected format
        $courseData = [
            'id' => $course->slug,
            'title' => $course->title,
            'description' => $course->short_description,
            'duration' => $course->duration,
            'price' => CurrencyHelper::format($course->price, $course->currency ?? 'USD'),
            'overview' => $course->description,
            'what_youll_learn' => $course->topics,
            'projects' => [
                'Build real-world projects',
                'Apply industry best practices',
                'Create a professional portfolio',
                'Work with cutting-edge technologies'
            ],
            'highlights' => [
                'Hands-on learning experience',
                'Industry expert guidance',
                'Real-world project applications',
                'Career advancement support'
            ],
            'video' => VideoHelper::getEmbedUrl($course->video_url),
            'associated_program' => $associatedProgram ? [
                'slug' => $associatedProgram->slug,
                'title' => $associatedProgram->title
            ] : null
        ];

        return view('courses.show', ['course' => $courseData]);
    }
}