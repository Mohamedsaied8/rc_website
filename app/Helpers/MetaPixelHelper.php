<?php

namespace App\Helpers;

class MetaPixelHelper
{
    /**
     * Track a custom event
     *
     * @param string $eventName
     * @param array $parameters
     * @return string
     */
    public static function trackEvent($eventName, $parameters = [])
    {
        $pixelId = config('meta-pixel.pixel_id');
        $enabled = config('meta-pixel.enabled');
        $debugMode = config('meta-pixel.debug_mode');

        if (!$enabled || !$pixelId) {
            return '';
        }

        $jsCode = "fbq('track', '{$eventName}'";
        
        if (!empty($parameters)) {
            $jsCode .= ", " . json_encode($parameters);
        }
        
        $jsCode .= ");";

        if ($debugMode) {
            $jsCode .= " console.log('Meta Pixel: {$eventName} event tracked', " . json_encode($parameters) . ");";
        }

        return $jsCode;
    }

    /**
     * Track course view
     *
     * @param string $courseId
     * @param string $courseName
     * @param float $value
     * @return string
     */
    public static function trackCourseView($courseId, $courseName, $value = null)
    {
        $parameters = [
            'content_type' => 'course',
            'content_ids' => [$courseId],
            'content_name' => $courseName,
            'content_category' => 'education'
        ];

        if ($value !== null) {
            $parameters['value'] = $value;
            $parameters['currency'] = 'USD';
        }

        return self::trackEvent('ViewContent', $parameters);
    }

    /**
     * Track program view
     *
     * @param string $programId
     * @param string $programName
     * @param float $value
     * @return string
     */
    public static function trackProgramView($programId, $programName, $value = null)
    {
        $parameters = [
            'content_type' => 'program',
            'content_ids' => [$programId],
            'content_name' => $programName,
            'content_category' => 'education'
        ];

        if ($value !== null) {
            $parameters['value'] = $value;
            $parameters['currency'] = 'USD';
        }

        return self::trackEvent('ViewContent', $parameters);
    }

    /**
     * Track enrollment start
     *
     * @param string $programId
     * @param string $programName
     * @param float $value
     * @return string
     */
    public static function trackEnrollmentStart($programId, $programName, $value = null)
    {
        $parameters = [
            'content_type' => 'program',
            'content_ids' => [$programId],
            'content_name' => $programName,
            'content_category' => 'education'
        ];

        if ($value !== null) {
            $parameters['value'] = $value;
            $parameters['currency'] = 'USD';
        }

        return self::trackEvent('InitiateCheckout', $parameters);
    }

    /**
     * Track enrollment completion
     *
     * @param string $programId
     * @param string $programName
     * @param float $value
     * @return string
     */
    public static function trackEnrollmentComplete($programId, $programName, $value = null)
    {
        $parameters = [
            'content_type' => 'program',
            'content_ids' => [$programId],
            'content_name' => $programName,
            'content_category' => 'education'
        ];

        if ($value !== null) {
            $parameters['value'] = $value;
            $parameters['currency'] = 'USD';
        }

        return self::trackEvent('CompleteRegistration', $parameters);
    }

    /**
     * Track lead generation
     *
     * @param string $contentName
     * @param string $contentCategory
     * @param float $value
     * @return string
     */
    public static function trackLead($contentName, $contentCategory = 'lead_generation', $value = null)
    {
        $parameters = [
            'content_name' => $contentName,
            'content_category' => $contentCategory
        ];

        if ($value !== null) {
            $parameters['value'] = $value;
            $parameters['currency'] = 'USD';
        }

        return self::trackEvent('Lead', $parameters);
    }

    /**
     * Track contact form submission
     *
     * @return string
     */
    public static function trackContactForm()
    {
        return self::trackLead('Contact Form Submission', 'lead_generation');
    }

    /**
     * Track video play
     *
     * @param string $videoTitle
     * @param string $videoCategory
     * @return string
     */
    public static function trackVideoPlay($videoTitle, $videoCategory = 'education')
    {
        return self::trackEvent('ViewContent', [
            'content_type' => 'video',
            'content_name' => $videoTitle,
            'content_category' => $videoCategory
        ]);
    }

    /**
     * Get the pixel ID
     *
     * @return string|null
     */
    public static function getPixelId()
    {
        return config('meta-pixel.pixel_id');
    }

    /**
     * Check if Meta Pixel is enabled
     *
     * @return bool
     */
    public static function isEnabled()
    {
        return config('meta-pixel.enabled') && !empty(self::getPixelId());
    }
}


