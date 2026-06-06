<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Program;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('programs')->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $programs = Program::where('is_active', true)->get();
        return view('admin.courses.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:courses,slug',
            'description' => 'required|string',
            'short_description' => 'required|string|max:500',
            'duration' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string|in:USD,EGP',
            'topics' => 'required|array',
            'topics.*' => 'string|max:255',
            'image' => 'nullable|string|max:255',
            'video_url' => 'nullable|url',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
            'programs' => 'nullable|array',
            'programs.*' => 'exists:programs,id'
        ]);

        $course = Course::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'duration' => $request->duration,
            'price' => $request->price,
            'currency' => $request->currency,
            'topics' => $request->topics,
            'image' => $request->image,
            'video_url' => $request->video_url,
            'is_active' => $request->has('is_active'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        // Attach programs if provided
        if ($request->has('programs')) {
            $course->programs()->sync($request->programs);
        }

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course created successfully.');
    }

    public function show(Course $course)
    {
        $course->load('programs');
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $programs = Program::where('is_active', true)->get();
        $course->load('programs');
        return view('admin.courses.edit', compact('course', 'programs'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:courses,slug,' . $course->id,
            'description' => 'required|string',
            'short_description' => 'required|string|max:500',
            'duration' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string|in:USD,EGP',
            'topics' => 'required|array',
            'topics.*' => 'string|max:255',
            'image' => 'nullable|string|max:255',
            'video_url' => 'nullable|url',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
            'programs' => 'nullable|array',
            'programs.*' => 'exists:programs,id'
        ]);

        $course->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'duration' => $request->duration,
            'price' => $request->price,
            'currency' => $request->currency,
            'topics' => $request->topics,
            'image' => $request->image,
            'video_url' => $request->video_url,
            'is_active' => $request->has('is_active'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        // Sync programs
        if ($request->has('programs')) {
            $course->programs()->sync($request->programs);
        } else {
            $course->programs()->detach();
        }

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->programs()->detach();
        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}
