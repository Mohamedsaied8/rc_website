<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\ManualPayment;
use App\Models\Program;
use App\Models\ProgramCohort;
use App\Services\Payments\EnrollmentPricing;
use App\Services\PromoCodeService;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EnrollController extends Controller
{
    /** payment_method values that mean "manual transfer reviewed by an admin". */
    public const MANUAL_METHODS = ['manual_wallet', 'instapay'];

    public function __construct(
        private EnrollmentPricing $pricing,
        private PromoCodeService $promoCodes,
    ) {
    }

    public function index(Request $request)
    {
        $selectedProgram = $request->get('program');
        $selectedCohort = $request->get('cohort');

        $programs = Program::where('is_active', true)->with('cohorts')->orderBy('sort_order')->get();

        $manualDestinations = $this->manualDestinations();

        return view('enroll', compact('programs', 'selectedProgram', 'selectedCohort', 'manualDestinations'));
    }

    public function store(Request $request)
    {
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
            // 'card' goes through the gateway; manual_wallet/instapay are manual
            // transfers reviewed by an admin. Legacy 'wallet'/'paymob_*' are
            // still accepted so in-flight sessions and bookmarked forms don't
            // break during cutover.
            'payment_method' => 'required|string|in:card,manual_wallet,instapay,wallet,paymob_card,paymob_wallet',
            'payment_screenshot' => 'required_if:payment_method,instapay,manual_wallet|nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'reference_number' => 'required_if:payment_method,instapay,manual_wallet|nullable|string|max:100',
            'promo_code' => 'nullable|string|max:64',
        ];

        $request->validate($validationRules);

        // Normalise legacy gateway-branded values to the neutral method.
        $paymentMethod = match ($request->payment_method) {
            'paymob_card' => 'card',
            'paymob_wallet' => 'wallet',
            default => $request->payment_method,
        };

        // The cohort and the program were previously validated independently —
        // each merely had to exist. Since pricing prefers the cohort's fee, an
        // expensive program could be paired with a cheap cohort's id and be
        // charged the cheap price, and the webhook's amount check (which uses the
        // same pricing call) would confirm it as correct.
        if (! $this->pricing->cohortBelongsToProgram((int) $request->cohort_id, $request->program)) {
            return back()->withInput()->withErrors([
                'cohort_id' => 'The selected group does not belong to the selected program.',
            ]);
        }

        // A manual method whose destination isn't configured is hidden in the
        // UI — reject it here too so a crafted POST can't select it.
        if (in_array($paymentMethod, self::MANUAL_METHODS)
            && blank($this->manualDestinations()[$paymentMethod])) {
            return back()->withInput()->withErrors([
                'payment_method' => 'This payment method is currently unavailable.',
            ]);
        }

        // Invalid codes surface as a validation error — never silently drop
        // the discount and charge full price.
        $promo = null;
        if (filled($request->promo_code)) {
            $promo = $this->promoCodes->validateForUser($request->promo_code, auth()->user());
        }

        // Clear any previous step from session
        session()->forget('enrollment_current_step');

        // Manual methods require proof of payment up front.
        $screenshotPath = null;
        if ($request->hasFile('payment_screenshot')) {
            $screenshotPath = $request->file('payment_screenshot')->store('enrollment-screenshots', 'public');
        }

        // Create enrollment record
        try {
            $enrollment = DB::transaction(function () use ($request, $promo, $paymentMethod, $screenshotPath) {
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
                    'payment_method' => $paymentMethod,
                    'payment_status' => 'unpaid',
                    'payment_screenshot' => $screenshotPath,
                    'status' => 'pending'
                ]);

                // Base price first, discount second: original_amount must hold
                // the undiscounted figure.
                $base = $this->pricing->amountFor($enrollment);

                if ($promo) {
                    $this->promoCodes->redeem($promo, auth()->user(), $enrollment);
                    $enrollment->promo_code_id = $promo->id;
                    $enrollment->discount_percent = $promo->discount_percent;
                    $enrollment->original_amount = $base;
                }

                $enrollment->amount = $this->pricing->applyDiscount($base, $enrollment->discount_percent);
                $enrollment->currency = EnrollmentPricing::CURRENCY;
                $enrollment->save();

                if (in_array($enrollment->payment_method, self::MANUAL_METHODS)) {
                    ManualPayment::create([
                        'enrollment_id' => $enrollment->id,
                        'user_id' => auth()->id(),
                        'method' => $enrollment->payment_method,
                        'amount' => $enrollment->amount,
                        'currency' => $enrollment->currency,
                        'reference_number' => $request->reference_number,
                        'screenshot_path' => $screenshotPath,
                        'status' => 'pending',
                    ]);
                }

                return $enrollment;
            });

            $this->sendEnrollmentEmails($enrollment);

            if (in_array($enrollment->payment_method, ['card', 'wallet'])) {
                // Hand off to whichever gateway is configured.
                return redirect()->route('payment.process', ['enrollment' => $enrollment->id]);
            }

            return redirect()->route('enroll.success')
                ->with('manual_review', in_array($enrollment->payment_method, self::MANUAL_METHODS))
                ->with('success', 'Your enrollment has been submitted successfully! We will contact you soon.');

        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Enrollment creation failed: ' . $e->getMessage());

            return redirect()->route('enroll', ['step' => 5])
                        ->withErrors(['error' => 'There was an error submitting your enrollment. Please try again.'])
                        ->withInput();
        }
    }

    /**
     * AJAX price preview for a promo code. Validates only — no redemption is
     * created until the enrollment is actually submitted. The server-side
     * check in store() remains authoritative.
     */
    public function checkPromo(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:64',
            'program' => 'required|string|exists:programs,slug',
            'cohort_id' => 'nullable|integer',
        ]);

        try {
            if ($request->filled('cohort_id')
                && ! $this->pricing->cohortBelongsToProgram((int) $request->cohort_id, $request->program)) {
                throw ValidationException::withMessages(['promo_code' => 'Invalid program selection.']);
            }

            $promo = $this->promoCodes->validateForUser($request->code, auth()->user());
        } catch (ValidationException $e) {
            return response()->json([
                'valid' => false,
                'message' => collect($e->errors())->flatten()->first() ?? 'This promo code is not valid.',
            ]);
        }

        $cohort = $request->filled('cohort_id') ? ProgramCohort::find($request->cohort_id) : null;
        $program = Program::where('slug', $request->program)->first();
        $base = (float) ($cohort ? $cohort->fees : ($program->price ?? 0));

        return response()->json([
            'valid' => true,
            'code' => $promo->code,
            'discount_percent' => $promo->discount_percent,
            'original' => $this->pricing->format($base),
            'discounted' => $this->pricing->format($this->pricing->applyDiscount($base, $promo->discount_percent)),
            'currency' => EnrollmentPricing::CURRENCY,
        ]);
    }

    /**
     * Send the applicant confirmation + notify staff. Best-effort: mail failures
     * must never break the enrollment flow.
     */
    protected function sendEnrollmentEmails(Enrollment $enrollment): void
    {
        try {
            \Illuminate\Support\Facades\Mail::to($enrollment->email)
                ->send(new \App\Mail\EnrollmentReceived($enrollment));

            $adminEmail = config('services.admin.notification_email');
            if ($adminEmail) {
                \Illuminate\Support\Facades\Mail::to($adminEmail)
                    ->send(new \App\Mail\NewEnrollmentAdmin($enrollment));
            }
        } catch (\Throwable $e) {
            \Log::error('Enrollment email failed: ' . $e->getMessage());
        }
    }

    public function success()
    {
        return view('enroll.success');
    }

    /** Configured manual-transfer destinations, keyed by payment_method value. */
    private function manualDestinations(): array
    {
        return [
            'manual_wallet' => \App\Models\SiteSetting::get('mobile_wallet_number', config('services.manual_payment.wallet_number', '01156800621')),
            'instapay' => \App\Models\SiteSetting::get('instapay_number', config('services.manual_payment.instapay_address', '01156800621')),
        ];
    }
}
