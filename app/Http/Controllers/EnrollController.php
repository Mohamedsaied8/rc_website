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
        $selectedCohort = $request->get('cohort');
        
        $programs = Program::where('is_active', true)->with('cohorts')->orderBy('sort_order')->get();

        return view('enroll', compact('programs', 'selectedProgram', 'selectedCohort'));
    }

    public function store(Request $request)
    {
        // Debug: Log the request data
        \Log::info('Enrollment form submitted', $request->all());
        
        $validationRules = [
            'first_name' => 'required|string|max:255|min:2',
            'second_name' => 'required|string|max:255|min:2',
            'last_name' => 'required|string|max:255|min:2',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20|min:8',
            'country' => 'required|string|max:255|min:2',
            'city' => 'required|string|max:255|min:2',
            'education_level' => 'required|string|in:Undergraduate,Graduate,Postgraduate',
            'graduation_year' => 'required|string|max:4',
            'university' => 'required|string|max:255',
            'college' => 'required|string|max:255',
            'experience' => 'nullable|string|max:1000',
            'motivation' => 'nullable|string|max:1000',
            'program' => 'required|string|exists:programs,slug',
            'cohort_id' => 'required|exists:program_cohorts,id',
            'payment_method' => 'required|string|in:instapay,paymob_card,paymob_wallet',
        ];

        $request->validate($validationRules);

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
                'user_id' => auth()->id(),
                'first_name' => $request->first_name,
                'second_name' => $request->second_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country,
                'city' => $request->city,
                'education_level' => $request->education_level,
                'graduation_year' => $request->graduation_year,
                'university' => $request->university,
                'college' => $request->college,
                'experience' => $request->experience,
                'motivation' => $request->motivation,
                'selected_program' => $request->program,
                'program_cohort_id' => $request->cohort_id,
                'payment_method' => $request->payment_method,
                'status' => 'pending'
            ]);
            
            // Debug: Log successful creation
            \Log::info('Enrollment created successfully', ['id' => $enrollment->id]);
            
            if (in_array($request->payment_method, ['paymob_card', 'paymob_wallet'])) {
                // Return redirect to payment processor
                return redirect()->route('payment.process', ['enrollment' => $enrollment->id]);
            }
            
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