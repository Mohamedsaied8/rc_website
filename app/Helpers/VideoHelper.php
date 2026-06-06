<?php

namespace App\Helpers;

class VideoHelper
{
    /**
     * Convert YouTube URL to embed URL
     */
    public static function getEmbedUrl($url)
    {
        if (empty($url)) {
            return null;
        }

        // If it's already an embed URL, return as is
        if (strpos($url, 'youtube.com/embed') !== false) {
            return $url;
        }

        // Extract video ID from various YouTube URL formats
        $videoId = self::extractVideoId($url);
        
        if ($videoId) {
            return "https://www.youtube.com/embed/{$videoId}";
        }

        return $url; // Return original URL if we can't convert it
    }

    /**
     * Extract video ID from YouTube URL
     */
    private static function extractVideoId($url)
    {
        $patterns = [
            '/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([a-zA-Z0-9_-]{11})/',
            '/youtube\.com\/watch\?.*v=([a-zA-Z0-9_-]{11})/',
            '/youtu\.be\/([a-zA-Z0-9_-]{11})/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }

    /**
     * Check if URL is a valid YouTube URL
     */
    public static function isYouTubeUrl($url)
    {
        return strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false;
    }
}
