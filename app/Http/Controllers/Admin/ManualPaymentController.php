<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\ManualPayment;
use App\Services\PromoCodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ManualPaymentController extends Controller
{
    public function __construct(private PromoCodeService $promoCodes)
    {
    }

    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');

        $query = ManualPayment::with(['enrollment.cohort'])->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $payments = $query->paginate(15)->appends($request->query());

        return view('admin.manual-payments.index', compact('payments', 'status'));
    }

    /**
     * Approving a transfer is the manual twin of the webhook's applyEvent():
     * same forceFill, same guard against double-marking, inside a transaction
     * with the enrollment row locked.
     */
    public function approve(ManualPayment $manualPayment)
    {
        try {
            DB::transaction(function () use ($manualPayment) {
                $enrollment = Enrollment::whereKey($manualPayment->enrollment_id)->lockForUpdate()->firstOrFail();
                $manualPayment = ManualPayment::whereKey($manualPayment->id)->lockForUpdate()->firstOrFail();

                if ($manualPayment->status !== 'pending') {
                    throw new \RuntimeException('This payment has already been reviewed.');
                }

                if ($enrollment->payment_status !== 'unpaid') {
                    throw new \RuntimeException('This enrollment is not awaiting payment (status: ' . $enrollment->payment_status . ').');
                }

                $enrollment->forceFill([
                    'payment_status' => 'paid',
                    'gateway' => 'manual',
                    'gateway_order_id' => 'MANUAL-' . $manualPayment->id,
                    'gateway_transaction_id' => 'MANUAL-' . $manualPayment->id,
                    'amount' => $manualPayment->amount,
                    'currency' => $manualPayment->currency,
                    'paid_at' => now(),
                ])->save();

                $manualPayment->forceFill([
                    'status' => 'approved',
                    'reviewed_by' => auth('admin')->id(),
                    'reviewed_at' => now(),
                ])->save();

                $this->promoCodes->completeFor($enrollment);
            });
        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }

        $this->notify($manualPayment, new \App\Mail\ManualPaymentApproved($manualPayment->fresh('enrollment')));

        return back()->with('success', 'Payment approved — the enrollment is now marked paid.');
    }

    public function reject(Request $request, ManualPayment $manualPayment)
    {
        $request->validate([
            'reject_reason' => 'required|string|max:1000',
        ]);

        if ($manualPayment->status !== 'pending') {
            return back()->with('error', 'This payment has already been reviewed.');
        }

        $manualPayment->forceFill([
            'status' => 'rejected',
            'reject_reason' => $request->reject_reason,
            'reviewed_by' => auth('admin')->id(),
            'reviewed_at' => now(),
        ])->save();

        $this->notify($manualPayment, new \App\Mail\ManualPaymentRejected($manualPayment->fresh('enrollment')));

        return back()->with('success', 'Payment rejected. The applicant can resubmit from their profile.');
    }

    /** Best-effort: mail failures must never break the review flow. */
    private function notify(ManualPayment $manualPayment, \Illuminate\Mail\Mailable $mailable): void
    {
        try {
            $email = $manualPayment->enrollment?->email;
            if ($email) {
                Mail::to($email)->send($mailable);
            }
        } catch (\Throwable $e) {
            Log::error('Manual payment email failed: ' . $e->getMessage());
        }
    }
}
