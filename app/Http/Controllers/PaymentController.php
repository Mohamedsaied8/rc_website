<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Services\PaymobService;
use Exception;

class PaymentController extends Controller
{
    protected $paymobService;

    public function __construct(PaymobService $paymobService)
    {
        $this->paymobService = $paymobService;
    }

    /**
     * Initiate payment process
     */
    public function process(Request $request, Enrollment $enrollment)
    {
        // Ensure user is authorized to pay for this
        if ($enrollment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        if ($enrollment->status === 'paid') {
            return redirect()->route('enroll.success')->with('success', 'This enrollment is already paid.');
        }

        try {
            $type = ($enrollment->payment_method === 'paymob_wallet') ? 'wallet' : 'card';
            $url = $this->paymobService->processPayment($enrollment, $type);
            
            return redirect()->away($url);
        } catch (Exception $e) {
            \Log::error('Payment initiation failed: ' . $e->getMessage());
            return redirect()->route('enroll')->withErrors(['error' => 'Failed to initiate payment. Please try again.']);
        }
    }

    /**
     * Webhook callback for Paymob server-to-server notifications
     */
    public function callback(Request $request)
    {
        $data = $request->all();
        \Log::info('Paymob Callback Received', $data);

        // Verify HMAC
        if (!$this->paymobService->verifyHmac($data)) {
            \Log::warning('Paymob Callback HMAC validation failed.');
            return response()->json(['message' => 'Invalid HMAC'], 403);
        }

        $obj = $data['obj'] ?? [];
        $success = $obj['success'] ?? false;
        
        // Extract merchant order ID to find enrollment
        $merchantOrderId = $obj['order']['merchant_order_id'] ?? '';
        $parts = explode('_', $merchantOrderId);
        
        if (count($parts) >= 2 && $parts[0] === 'ENR') {
            $enrollmentId = $parts[1];
            $enrollment = Enrollment::find($enrollmentId);
            
            if ($enrollment) {
                if ($success) {
                    $enrollment->status = 'paid';
                    // We could also record the Paymob transaction ID here
                    $enrollment->save();
                    \Log::info("Enrollment {$enrollmentId} marked as paid.");
                } else {
                    $enrollment->status = 'failed';
                    $enrollment->save();
                    \Log::info("Enrollment {$enrollmentId} payment failed.");
                }
            }
        }

        return response()->json(['message' => 'Processed'], 200);
    }

    /**
     * User redirect callback after completing/failing payment in browser
     */
    public function returnUrl(Request $request)
    {
        // Paymob redirects back with URL parameters (success=true/false)
        $success = $request->query('success');
        
        if ($success === 'true') {
            return redirect()->route('enroll.success')->with('success', 'Payment successful! Your enrollment is confirmed.');
        } else {
            return redirect()->route('enroll')->withErrors(['error' => 'Payment failed or was cancelled. Please try again.']);
        }
    }
}
