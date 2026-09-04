<?php

namespace App\Http\Controllers;

use App\Services\SubscriptionService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the authenticated user's profile and their standing across all four
     * Robotics Corner products (courses, RoboHub, RoboAgent, ConnectedLabs).
     */
    public function show(Request $request, SubscriptionService $subscriptions)
    {
        $user = $request->user();

        // Uniform envelope per product — see SubscriptionService for where each
        // one's data actually lives. Only ever scoped to THIS user.
        $subs = $subscriptions->for($user);

        // Kept as top-level vars: the courses card is the one product whose data
        // is local, and the view renders full Enrollment models for it.
        $enrollments  = collect($subs['courses']['items']);
        $programNames = $subs['courses']['meta']['programNames'];

        return view('profile', compact('user', 'subs', 'enrollments', 'programNames'));
    }
}
