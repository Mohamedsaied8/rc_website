<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\Program;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_enrollments' => Enrollment::count(),
            'pending_enrollments' => Enrollment::pending()->count(),
            'approved_enrollments' => Enrollment::approved()->count(),
            'total_courses' => Course::count(),
            'total_programs' => Program::count(),
            'active_courses' => Course::where('is_active', true)->count(),
            'active_programs' => Program::where('is_active', true)->count(),
        ];

        $recent_enrollments = Enrollment::with([])
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_enrollments'));
    }
}
