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
                'experience' => '10+ years',
                'image' => '/images/team/mohamed-saied.png',
                'linkedin' => 'https://www.linkedin.com/in/mohamedsaied8/'
            ],
            [
                'name' => 'Aya Ashraf',
                'role' => 'Instructor',
                'expertise' => 'Robotics & Autonomous Systems',
                'experience' => '5+ years',
                'image' => '👩‍💻',
                'linkedin' => 'https://www.linkedin.com/in/aya-ashraf-7aab62223/'
            ],
            [
                'name' => 'Youssef Hindawi',
                'role' => 'Instructor',
                'expertise' => 'Robotics & Autonomous Systems',
                'experience' => '5+ years',
                'image' => '👩‍💻',
                'linkedin' => ''
            ],
            [
                'name' => 'Abdelrahman Mourad',
                'role' => 'Instructor',
                'expertise' => 'Embedded Systems',
                'experience' => '5+ years',
                'image' => '👩‍💻',
                'linkedin' => ''
            ],
            [
                'name' => 'Hesham Elsayed',
                'role' => 'Instructor',
                'expertise' => 'Embedded Systems',
                'experience' => '3+ years',
                'image' => '👩‍💻',
                'linkedin' => ''
            ],
            [
                'name' => 'Hady Ayman',
                'role' => 'Instructor',
                'expertise' => 'Embedded Systems',
                'experience' => '2+ years',
                'image' => '👩‍💻',
                'linkedin' => ''
            ],
            [
                'name' => 'Salma Nasser',
                'role' => 'Instructor',
                'expertise' => 'AI & Machine Learning',
                'experience' => '2+ years',
                'image' => '👩‍💻',
                'linkedin' => ''
            ]
        ];

        return view('about', compact('milestones', 'instructors'));
    }
}