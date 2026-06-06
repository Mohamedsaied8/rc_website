<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\Program;

class EnrollController extends Controller
{
    public function index(Request $request)
    {
        $selectedProgram = $request->get('program');
        $currentStep = $request->get('step', 1); // Get step from URL parameter
        
        // Get programs from database with their courses
        $programs = Program::where('is_active', true)->with('courses')->get();

        return view('enroll', compact('programs', 'selectedProgram', 'currentStep'));
    }

    public function store(Request $request)
    {
        // Debug: Log the request data
        \Log::info('Enrollment form submitted', $request->all());
        
        $validationRules = [
            'first_name' => 'required|string|max:255|min:2',
            'last_name' => 'required|string|max:255|min:2',
            'email' => 'required|email|max:255|unique:enrollments,email',
            'phone' => 'required|string|max:20|min:10|regex:/^[\+]?[1-9][\d]{0,15}$/',
            'country' => 'required|string|max:255|min:2',
            'city' => 'required|string|max:255|min:2',
            'education_level' => 'required|string|in:high_school,bachelor,master,phd,other',
            'experience' => 'required|string|min:10|max:1000',
            'motivation' => 'required|string|min:10|max:1000',
            'selected_program' => 'required|string|max:255',
            'preferred_schedule' => 'required|string|in:weekdays,evenings,weekends,flexible',
            'payment_method' => 'required|string|in:instapay,contact_sales',
            'additional_notes' => 'nullable|string|max:1000'
        ];

        // Add file upload validation only for instapay payment method
        if ($request->payment_method === 'instapay') {
            $validationRules['payment_screenshot'] = 'required|image|mimes:jpeg,png,jpg|max:5120'; // 5MB max
        }

        $request->validate($validationRules, [
            'first_name.required' => 'First name is required.',
            'first_name.min' => 'First name must be at least 2 characters.',
            'last_name.required' => 'Last name is required.',
            'last_name.min' => 'Last name must be at least 2 characters.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address has already been used for enrollment.',
            'phone.required' => 'Phone number is required.',
            'phone.min' => 'Phone number must be at least 10 digits.',
            'phone.regex' => 'Please enter a valid phone number.',
            'country.required' => 'Country is required.',
            'country.min' => 'Country name must be at least 2 characters.',
            'city.required' => 'City is required.',
            'city.min' => 'City name must be at least 2 characters.',
            'education_level.required' => 'Education level is required.',
            'education_level.in' => 'Please select a valid education level.',
            'experience.required' => 'Technical experience is required.',
            'experience.min' => 'Please provide at least 10 characters describing your experience.',
            'motivation.required' => 'Motivation is required.',
            'motivation.min' => 'Please provide at least 10 characters describing your motivation.',
            'selected_program.required' => 'Please select a program.',
            'preferred_schedule.required' => 'Please select your preferred schedule.',
            'preferred_schedule.in' => 'Please select a valid schedule option.',
            'payment_method.required' => 'Please select a payment method.',
            'payment_method.in' => 'Please select a valid payment method.',
            'additional_notes.max' => 'Additional notes cannot exceed 1000 characters.'
        ]);

        // Debug: Log validation passed
        \Log::info('Validation passed, creating enrollment record');
        
        // Clear any previous step from session
        session()->forget('enrollment_current_step');

        // Handle file upload if payment method is instapay
        $screenshotPath = null;
        if ($request->hasFile('payment_screenshot')) {
            $screenshotPath = $request->file('payment_screenshot')->store('enrollment-screenshots', 'public');
        }

        // Create enrollment record
        try {
            $enrollment = Enrollment::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'city' => $request->city,
            'education_level' => $request->education_level,
            'experience' => $request->experience,
            'motivation' => $request->motivation,
            'selected_program' => $request->selected_program,
            'preferred_schedule' => $request->preferred_schedule,
            'payment_method' => $request->payment_method,
            'payment_screenshot' => $screenshotPath,
            'additional_notes' => $request->additional_notes,
            'status' => 'pending'
            ]);
            
            // Debug: Log successful creation
            \Log::info('Enrollment created successfully', ['id' => $enrollment->id]);
            
            \Log::info('Redirecting to success page');
            return redirect()->route('enroll.success')
                ->with('success', 'Your enrollment has been submitted successfully! We will contact you soon.');
                
        } catch (\Exception $e) {
            // Debug: Log error
            \Log::error('Enrollment creation failed', ['error' => $e->getMessage()]);
            
            return redirect()->route('enroll', ['step' => 5])
                        ->withErrors(['error' => 'There was an error submitting your enrollment. Please try again.'])
                        ->withInput();
        }
    }

    public function success()
    {
        return view('enroll.success');
    }
}