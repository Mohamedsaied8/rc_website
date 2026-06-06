<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Course;
use App\Helpers\VideoHelper;
use App\Helpers\CurrencyHelper;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::where('is_active', true)
            ->with('courses')
            ->orderBy('sort_order')
            ->get()
            ->map(function ($program) {
                return [
                    'id' => $program->slug,
                    'title' => $program->title,
                    'description' => $program->short_description,
                    // START FIX: Use VideoHelper
                    'video' => VideoHelper::getEmbedUrl($program->video_url),
                    // END FIX
                    'courses' => $program->courses->map(function ($course) {
                        return [
                            'id' => $course->slug,
                            'title' => $course->title,
                            'description' => $course->short_description,
                            'duration' => $course->duration,
                            'price' => CurrencyHelper::format($course->price, $course->currency ?? 'USD')
                        ];
                    })->toArray()
                ];
            });
    
        return view('programs.index', compact('programs'));
    }

    public function show($id)
    {
        $program = Program::where('slug', $id)->where('is_active', true)->with('courses')->first();
        
        if (!$program) {
            abort(404);
        }

        $associatedCourses = $program->courses->map(function ($course) {
            return [
                'id' => $course->slug,
                'title' => $course->title,
                'description' => $course->short_description,
                'duration' => $course->duration,
                'price' => CurrencyHelper::format($course->price, $course->currency ?? 'USD')
            ];
        });

        $programData = [
            'id' => $program->slug,
            'title' => $program->title,
            'description' => $program->short_description,
            'video' => VideoHelper::getEmbedUrl($program->video_url),
            'overview' => $program->description,
            'topics' => $program->topics ?? [],
            'facts' => [
                'Duration: ' . $program->duration,
                'Price: ' . CurrencyHelper::format($program->price, $program->currency ?? 'USD'),
                'Format: Online/Onsite',
                'Certificate included'
            ],
            'courses' => $associatedCourses->toArray()
        ];

        return view('programs.show', ['program' => $programData]);
    }
}