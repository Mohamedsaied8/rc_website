<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'payments' => [
        // Gateway used for NEW checkouts.
        'default' => env('PAYMENT_GATEWAY', 'kashier'),

        // Gateways still allowed to deliver webhooks. Keep 'paymob' here until
        // legacy callbacks have drained, then remove it.
        'active' => array_filter(explode(',', env('PAYMENT_GATEWAYS_ACTIVE', 'kashier,paymob'))),

        // Provider name shown to customers at checkout.
        'display_name' => env('PAYMENT_DISPLAY_NAME', 'Kashier'),
    ],

    'kashier' => [
        // MID — identifies the merchant, not a secret.
        'merchant_id' => env('KASHIER_MERCHANT_ID'),

        // HMAC key for the order hash AND for verifying webhook/redirect
        // signatures. SECRET — server only, never expose to the browser.
        'payment_api_key' => env('KASHIER_PAYMENT_API_KEY'),

        // Raw value of the Authorization header on REST calls (refunds).
        // SECRET — and a different key from the one above; do not mix them up.
        'secret_key' => env('KASHIER_SECRET_KEY'),

        // 'test' or 'live'. Must match the key pair in use.
        'mode' => env('KASHIER_MODE', 'test'),

        // Left blank deliberately: the published docs give three conflicting
        // refund endpoints. Refunds stay disabled until Kashier support
        // confirms the canonical one. See KashierService::refund().
        'refund_endpoint' => env('KASHIER_REFUND_ENDPOINT'),
    ],

    // Legacy — retained for the cutover window so in-flight Paymob callbacks
    // still resolve. Remove once that traffic has drained.
    'paymob' => [
        'api_key' => env('PAYMOB_API_KEY'),
        'integration_id_card' => env('PAYMOB_INTEGRATION_ID_CARD'),
        'integration_id_wallet' => env('PAYMOB_INTEGRATION_ID_WALLET'),
        'iframe_id' => env('PAYMOB_IFRAME_ID'),
        'hmac' => env('PAYMOB_HMAC'),
    ],

    // Destinations shown for manual transfers. A blank value hides that
    // method at checkout AND rejects it server-side.
    'manual_payment' => [
        'wallet_number' => env('MANUAL_WALLET_NUMBER', '01156800621'),
        'instapay_address' => env('MANUAL_INSTAPAY_ADDRESS', '01156800621'),
    ],

    'admin' => [
        // Recipient for enrollment / contact notification emails.
        'notification_email' => env('MAIL_ADMIN_ADDRESS', env('MAIL_FROM_ADDRESS')),
    ],

];
