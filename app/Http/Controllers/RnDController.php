<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RnDController extends Controller
{
    public function autonomousCars()
    {
        return view('services.rnd.autonomous-cars');
    }
}
