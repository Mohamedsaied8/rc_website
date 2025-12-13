<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Program;
use App\Helpers\VideoHelper;
use App\Helpers\CurrencyHelper;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            ['number' => '500+', 'label' => 'Students Trained'],
            ['number' => '50+', 'label' => 'Industry Projects'],
            ['number' => '95%', 'label' => 'Job Placement Rate'],
            ['number' => '4.9', 'label' => 'Average Rating']
        ];

        // Fetch courses from database
        $courses = Course::where('is_active', true)
            ->orderBy('sort_order')
            ->limit(4)
            ->get()
            ->map(function ($course) {
                return [
                    'id' => $course->slug,
                    'title' => $course->title,
                    'description' => $course->short_description,
                    'duration' => $course->duration,
                    'price' => CurrencyHelper::format($course->price, $course->currency ?? 'USD'),
                    'topics' => $course->topics,
                    'video' => VideoHelper::getEmbedUrl($course->video_url)
                ];
            });

        $features = [
            [
                'icon' => '🎯',
                'title' => 'Industry-Focused Curriculum',
                'description' => 'Learn skills directly applicable to real-world robotics and software engineering challenges.'
            ],
            [
                'icon' => '👨‍🏫',
                'title' => 'Expert Instructors',
                'description' => 'Learn from industry professionals with years of experience in robotics and software development.'
            ],
            [
                'icon' => '🛠️',
                'title' => 'Hands-On Projects',
                'description' => 'Build real projects and gain practical experience with cutting-edge technologies.'
            ],
            [
                'icon' => '🚀',
                'title' => 'Career Support',
                'description' => 'Get help with job placement, resume building, and interview preparation.'
            ]
        ];

        return view('home', compact('stats', 'courses', 'features'));
    }
}