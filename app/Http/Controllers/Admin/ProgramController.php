<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Course;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::with('courses')->paginate(10);
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        $courses = Course::where('is_active', true)->get();
        return view('admin.programs.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:programs,slug',
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
            'courses' => 'nullable|array',
            'courses.*' => 'exists:courses,id'
        ]);

        $program = Program::create([
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

        // Attach courses if provided
        if ($request->has('courses')) {
            $program->courses()->sync($request->courses);
        }

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program created successfully.');
    }

    public function show(Program $program)
    {
        $program->load('courses');
        return view('admin.programs.show', compact('program'));
    }

    public function edit(Program $program)
    {
        $courses = Course::where('is_active', true)->get();
        $program->load('courses');
        return view('admin.programs.edit', compact('program', 'courses'));
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:programs,slug,' . $program->id,
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
            'courses' => 'nullable|array',
            'courses.*' => 'exists:courses,id'
        ]);

        $program->update([
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

        // Sync courses
        if ($request->has('courses')) {
            $program->courses()->sync($request->courses);
        } else {
            $program->courses()->detach();
        }

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program updated successfully.');
    }

    public function destroy(Program $program)
    {
        $program->courses()->detach();
        $program->delete();

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program deleted successfully.');
    }
}
