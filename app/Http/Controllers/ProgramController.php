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
            ->get();
    
        return view('programs.index', compact('programs'));
    }

    public function show($id)
    {
        $program = Program::where('slug', $id)->where('is_active', true)->with('courses')->first();
        
        if (!$program) {
            abort(404);
        }

        return view('programs.show', compact('program'));
    }
}