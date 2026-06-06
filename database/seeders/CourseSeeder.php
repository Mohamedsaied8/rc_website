<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'slug' => 'swe',
                'title' => 'Software Engineering Program',
                'description' => 'A comprehensive program designed to transform you into a professional software engineer. Learn modern development practices, design patterns, and industry-standard tools used by top tech companies worldwide.',
                'short_description' => 'Master Linux fundamentals, Modern C++, OOP, Design Patterns, and DevOps practices.',
                'duration' => '12 weeks',
                'price' => 1200.00,
                'topics' => [
                    'Linux Fundamentals & Command Line',
                    'Modern C++ & Object-Oriented Programming',
                    'Design Patterns & Software Architecture',
                    'CI/CD & DevOps Practices',
                    'Version Control with Git',
                    'Testing & Quality Assurance',
                    'Database Design & Management',
                    'API Development & Integration'
                ],
                'video_url' => 'https://www.youtube.com/embed/LEm8_dZao0E',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'slug' => 'robotics',
                'title' => 'Robotics for Professionals',
                'description' => 'Advanced robotics program covering ROS2, SLAM, navigation, and simulation. Build real-world robotics projects and gain hands-on experience with cutting-edge robotic systems.',
                'short_description' => 'Advanced robotics with ROS2, SLAM, navigation, and simulation.',
                'duration' => '8 weeks',
                'price' => 1000.00,
                'topics' => [
                    'ROS2 Fundamentals',
                    'SLAM & Navigation Systems',
                    'Robot Simulation with Gazebo',
                    'Hardware Integration',
                    'Computer Vision for Robotics',
                    'Path Planning & Control',
                    'Multi-Robot Systems',
                    'Real-time Systems'
                ],
                'video_url' => 'https://www.youtube.com/embed/LEm8_dZao0E',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'slug' => 'embedded',
                'title' => 'Embedded C++ (Interfacing & RTOS) Diploma',
                'description' => 'Specialized program for embedded systems development using Modern C++. Learn microcontrollers, RTOS, hardware drivers, and embedded design patterns.',
                'short_description' => 'Microcontrollers, RTOS, drivers, and embedded patterns in Modern C++.',
                'duration' => '9 weeks',
                'price' => 900.00,
                'topics' => [
                    'Cortex-M Microcontrollers',
                    'FreeRTOS & Real-time Systems',
                    'Hardware Drivers Development',
                    'Embedded Design Patterns',
                    'Interrupt Handling & Timers',
                    'Communication Protocols (I2C, SPI, UART)',
                    'Memory Management',
                    'Power Optimization'
                ],
                'video_url' => 'https://www.youtube.com/embed/LEm8_dZao0E',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'slug' => 'leadership',
                'title' => 'Technical Leadership & Project Management',
                'description' => 'Develop leadership skills and project management expertise for technical teams. Learn agile methodologies, communication strategies, and team management techniques.',
                'short_description' => 'Leadership, communication, agile, and project management for engineers.',
                'duration' => '6 weeks',
                'price' => 800.00,
                'topics' => [
                    'Team Leadership & Management',
                    'Agile Methodologies (Scrum, Kanban)',
                    'Project Planning & Execution',
                    'Technical Communication',
                    'Code Review & Quality Standards',
                    'Stakeholder Management',
                    'Risk Assessment & Mitigation',
                    'Performance Management'
                ],
                'video_url' => 'https://www.youtube.com/embed/LEm8_dZao0E',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'slug' => 'python-fundamentals',
                'title' => 'Python Fundamentals for Robotics',
                'description' => 'Learn Python programming specifically tailored for robotics applications. Cover data structures, algorithms, and robotics-specific libraries.',
                'short_description' => 'Python programming for robotics applications and data science.',
                'duration' => '4 weeks',
                'price' => 400.00,
                'topics' => [
                    'Python Basics & Syntax',
                    'Data Structures & Algorithms',
                    'NumPy & Pandas for Data Science',
                    'Matplotlib for Visualization',
                    'Robotics Libraries (PyRobot, OpenCV)',
                    'Machine Learning Basics',
                    'API Development with Flask',
                    'Testing & Debugging'
                ],
                'video_url' => 'https://www.youtube.com/embed/LEm8_dZao0E',
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'slug' => 'ai-ml-robotics',
                'title' => 'AI & Machine Learning for Robotics',
                'description' => 'Advanced course covering artificial intelligence and machine learning techniques specifically for robotics applications.',
                'short_description' => 'AI and ML techniques for robotics and autonomous systems.',
                'duration' => '10 weeks',
                'price' => 1500.00,
                'topics' => [
                    'Machine Learning Fundamentals',
                    'Deep Learning with TensorFlow/PyTorch',
                    'Computer Vision & Image Processing',
                    'Natural Language Processing',
                    'Reinforcement Learning',
                    'Neural Networks for Robotics',
                    'Sensor Fusion & Perception',
                    'Autonomous Decision Making'
                ],
                'video_url' => 'https://www.youtube.com/embed/LEm8_dZao0E',
                'is_active' => true,
                'sort_order' => 6
            ]
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
