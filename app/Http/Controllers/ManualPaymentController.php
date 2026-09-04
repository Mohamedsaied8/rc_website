<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\ManualPayment;
use Illuminate\Http\Request;

/**
 * Resubmission of proof-of-payment after an admin rejected the previous one.
 * Every attempt is a NEW manual_payments row — history is never overwritten.
 */
class ManualPaymentController extends Controller
{
    public function store(Request $request, Enrollment $enrollment)
    {
        // user_id is nullable on old rows — a null owner must never match.
        if ($enrollment->user_id === null || $enrollment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        if ($enrollment->payment_status !== 'unpaid') {
            return redirect()->route('profile')
                ->with('error', 'This enrollment does not need a payment submission.');
        }

        // Allowed only after a rejection, or when a manual-method enrollment
        // somehow has no submission yet. A pending row means one is already
        // under review.
        $latest = $enrollment->latestManualPayment;
        $isManualMethod = in_array($enrollment->payment_method, EnrollController::MANUAL_METHODS);

        if ($latest ? $latest->status !== 'rejected' : ! $isManualMethod) {
            return redirect()->route('profile')
                ->with('error', 'A payment submission is already under review for this enrollment.');
        }

        $request->validate([
            'method' => 'required|string|in:manual_wallet,instapay',
            'reference_number' => 'required|string|max:100',
            'payment_screenshot' => 'required|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $screenshotPath = $request->file('payment_screenshot')->store('enrollment-screenshots', 'public');

        ManualPayment::create([
            'enrollment_id' => $enrollment->id,
            'user_id' => auth()->id(),
            'method' => $request->method,
            'amount' => $enrollment->amount ?? app(\App\Services\Payments\EnrollmentPricing::class)->amountFor($enrollment),
            'currency' => $enrollment->currency ?? \App\Services\Payments\EnrollmentPricing::CURRENCY,
            'reference_number' => $request->reference_number,
            'screenshot_path' => $screenshotPath,
            'status' => 'pending',
        ]);

        // Keep the enrollment's own receipt column pointing at the latest proof.
        $enrollment->forceFill([
            'payment_method' => $request->method,
            'payment_screenshot' => $screenshotPath,
        ])->save();

        return redirect()->route('profile')
            ->with('success', 'Your payment proof has been submitted and is under review.');
    }
}
