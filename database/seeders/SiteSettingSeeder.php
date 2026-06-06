<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key' => 'contact_email',
                'value' => 'info@roboticscorner.com',
                'type' => 'email',
                'description' => 'Primary contact email address'
            ],
            [
                'key' => 'contact_phone',
                'value' => '+20 111 115 9633',
                'type' => 'phone',
                'description' => 'Primary contact phone number'
            ],
            [
                'key' => 'contact_address',
                'value' => 'Cairo, Egypt',
                'type' => 'text',
                'description' => 'Physical address'
            ],
            [
                'key' => 'whatsapp_number',
                'value' => '+0201111159633',
                'type' => 'phone',
                'description' => 'WhatsApp contact number'
            ],
            [
                'key' => 'facebook_url',
                'value' => 'https://facebook.com/roboticscorner',
                'type' => 'url',
                'description' => 'Facebook page URL'
            ],
            [
                'key' => 'twitter_url',
                'value' => 'https://twitter.com/roboticscorner',
                'type' => 'url',
                'description' => 'Twitter profile URL'
            ],
            [
                'key' => 'linkedin_url',
                'value' => 'https://linkedin.com/company/roboticscorner',
                'type' => 'url',
                'description' => 'LinkedIn company page URL'
            ],
            [
                'key' => 'youtube_url',
                'value' => 'https://youtube.com/@roboticscorner',
                'type' => 'url',
                'description' => 'YouTube channel URL'
            ]
        ];

        foreach ($settings as $setting) {
            SiteSetting::create($setting);
        }
    }
}