<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $milestones = [
            ['year' => '2020', 'title' => 'Founded', 'description' => 'Robotics Corner was established with a vision to bridge the gap between academic learning and industry requirements.'],
            ['year' => '2021', 'title' => 'First Cohort', 'description' => 'Graduated our first batch of 50 students with 95% job placement rate.'],
            ['year' => '2022', 'title' => 'Industry Partnerships', 'description' => 'Established partnerships with leading tech companies for internships and job placements.'],
            ['year' => '2023', 'title' => '500+ Graduates', 'description' => 'Celebrated training over 500 professionals now working in top tech companies.'],
            ['year' => '2024', 'title' => 'Expansion', 'description' => 'Launched advanced programs in AI, robotics, and embedded systems.']
        ];

        $instructors = [
            [
                'name' => 'Mohamed Saied',
                'role' => 'CTO & Lead Instructor',
                'expertise' => 'Software Engineering, System Architecture',
                'experience' => '15+ years',
                'image' => '👨‍💻'
            ],
            [
                'name' => 'Dr. Sarah Ahmed',
                'role' => 'Robotics Specialist',
                'expertise' => 'ROS2, Computer Vision, SLAM',
                'experience' => '12+ years',
                'image' => '👩‍🔬'
            ],
            [
                'name' => 'Ahmed Hassan',
                'role' => 'Embedded Systems Expert',
                'expertise' => 'Cortex-M, RTOS, Hardware Design',
                'experience' => '10+ years',
                'image' => '👨‍🔧'
            ]
        ];

        return view('about', compact('milestones', 'instructors'));
    }
}