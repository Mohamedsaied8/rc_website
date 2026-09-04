<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class PaymobService
{
    protected $apiKey;
    protected $integrationIdCard;
    protected $integrationIdWallet;
    protected $iframeId;
    protected $baseUrl = 'https://accept.paymob.com/api';

    public function __construct()
    {
        $this->apiKey = config('services.paymob.api_key');
        $this->integrationIdCard = config('services.paymob.integration_id_card');
        $this->integrationIdWallet = config('services.paymob.integration_id_wallet');
        $this->iframeId = config('services.paymob.iframe_id');
    }

    /**
     * Get Authentication Token
     */
    public function getAuthenticationToken()
    {
        $response = Http::post("{$this->baseUrl}/auth/tokens", [
            'api_key' => $this->apiKey,
        ]);

        if ($response->successful()) {
            return $response->json()['token'];
        }

        throw new Exception('Failed to get Paymob authentication token.');
    }

    /**
     * Create Order
     */
    public function createOrder($authToken, $amountCents, $currency, $merchantOrderId)
    {
        $response = Http::post("{$this->baseUrl}/ecommerce/orders", [
            'auth_token' => $authToken,
            'delivery_needed' => 'false',
            'amount_cents' => $amountCents,
            'currency' => $currency,
            'merchant_order_id' => $merchantOrderId,
            'items' => [],
        ]);

        if ($response->successful()) {
            return $response->json()['id'];
        }

        throw new Exception('Failed to create Paymob order.');
    }

    /**
     * Get Payment Key
     */
    public function getPaymentKey($authToken, $orderId, $amountCents, $currency, $billingData, $integrationId)
    {
        $response = Http::post("{$this->baseUrl}/acceptance/payment_keys", [
            'auth_token' => $authToken,
            'amount_cents' => $amountCents,
            'expiration' => 3600,
            'order_id' => $orderId,
            'billing_data' => $billingData,
            'currency' => $currency,
            'integration_id' => $integrationId,
            'lock_order_when_paid' => 'false'
        ]);

        if ($response->successful()) {
            return $response->json()['token'];
        }

        throw new Exception('Failed to get Paymob payment key.');
    }

    /**
     * Generate Payment URL for Wallet
     */
    public function generateWalletUrl($paymentToken, $mobileNumber)
    {
        $response = Http::post("{$this->baseUrl}/acceptance/payments/pay", [
            'source' => [
                'identifier' => $mobileNumber,
                'subtype' => 'WALLET'
            ],
            'payment_token' => $paymentToken
        ]);

        if ($response->successful()) {
            return $response->json()['iframe_redirection_url']; // This might also be redirect_url depending on the API version
        }

        throw new Exception('Failed to generate Wallet payment URL.');
    }

    /**
     * Process full payment flow and return redirect URL or iframe URL
     */
    public function processPayment($enrollment, $type = 'card', $walletNumber = null)
    {
        $amountCents = $this->getEnrollmentAmount($enrollment) * 100;
        $currency = 'EGP';
        
        $billingData = [
            'first_name' => $enrollment->first_name ?: 'NA',
            'last_name' => $enrollment->last_name ?: 'NA',
            'email' => $enrollment->email ?: 'na@example.com',
            'phone_number' => $enrollment->phone ?: '+201234567890',
            'apartment' => 'NA',
            'floor' => 'NA',
            'street' => 'NA',
            'building' => 'NA',
            'shipping_method' => 'NA',
            'postal_code' => 'NA',
            'city' => $enrollment->city ?: 'NA',
            'country' => 'EG',
            'state' => 'NA'
        ];

        $authToken = $this->getAuthenticationToken();
        $orderId = $this->createOrder($authToken, $amountCents, $currency, 'ENR_' . $enrollment->id . '_' . time());

        // Persist the Paymob order id for later reconciliation with the webhook.
        if (\Illuminate\Support\Facades\Schema::hasColumn('enrollments', 'paymob_order_id')) {
            $enrollment->forceFill(['paymob_order_id' => $orderId])->save();
        }

        $integrationId = ($type === 'wallet') ? $this->integrationIdWallet : $this->integrationIdCard;
        
        $paymentKey = $this->getPaymentKey($authToken, $orderId, $amountCents, $currency, $billingData, $integrationId);

        if ($type === 'wallet') {
            return $this->generateWalletUrl($paymentKey, $walletNumber ?: $enrollment->phone);
        }

        // Return Card Iframe URL
        return "https://accept.paymob.com/api/acceptance/iframes/{$this->iframeId}?payment_token={$paymentKey}";
    }

    /**
     * Calculate amount based on cohort or program
     */
    public function getEnrollmentAmount($enrollment)
    {
        if ($enrollment->cohort) {
            return $enrollment->cohort->fees;
        }
        
        $program = \App\Models\Program::where('slug', $enrollment->selected_program)->first();
        return $program ? $program->price : 0;
    }

    /**
     * Verify HMAC from Paymob Callback
     */
    public function verifyHmac($requestData)
    {
        $hmacString = '';
        
        // The order of keys is STRICTLY defined by Paymob
        $keys = [
            'amount_cents',
            'created_at',
            'currency',
            'error_occured',
            'has_parent_transaction',
            'id',
            'integration_id',
            'is_3d_secure',
            'is_auth',
            'is_capture',
            'is_refunded',
            'is_standalone_payment',
            'is_voided',
            'order.id',
            'owner',
            'pending',
            'source_data.pan',
            'source_data.sub_type',
            'source_data.type',
            'success',
        ];

        foreach ($keys as $key) {
            if (strpos($key, '.') !== false) {
                $parts = explode('.', $key);
                $value = isset($requestData['obj'][$parts[0]][$parts[1]]) ? $requestData['obj'][$parts[0]][$parts[1]] : '';
            } else {
                $value = isset($requestData['obj'][$key]) ? $requestData['obj'][$key] : '';
            }
            
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }
            
            $hmacString .= $value;
        }

        $secret = config('services.paymob.hmac');
        $calculatedHmac = hash_hmac('sha512', $hmacString, $secret);

        $receivedHmac = $requestData['hmac'] ?? '';

        return hash_equals($calculatedHmac, $receivedHmac);
    }
}
