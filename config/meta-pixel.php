<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Meta Pixel Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Meta Pixel (Facebook Pixel) tracking
    |
    */

    'pixel_id' => env('META_PIXEL_ID', null),
    
    'enabled' => env('META_PIXEL_ENABLED', true),
    
    'debug_mode' => env('META_PIXEL_DEBUG', false),
    
    /*
    |--------------------------------------------------------------------------
    | Auto Events
    |--------------------------------------------------------------------------
    |
    | Enable automatic tracking of common events
    |
    */
    
    'auto_events' => [
        'page_view' => true,
        'view_content' => true,
        'add_to_cart' => false,
        'purchase' => false,
        'lead' => true,
        'complete_registration' => true,
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Custom Events
    |--------------------------------------------------------------------------
    |
    | Define custom events for your application
    |
    */
    
    'custom_events' => [
        'course_view' => 'ViewContent',
        'program_view' => 'ViewContent',
        'enrollment_start' => 'InitiateCheckout',
        'enrollment_complete' => 'CompleteRegistration',
        'contact_form_submit' => 'Lead',
        'video_play' => 'ViewContent',
    ],
];


