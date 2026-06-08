<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CmsPage;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Home Page
        $home = CmsPage::create([
            'title' => 'Home',
            'slug' => 'home',
            'description' => 'The main landing page of the website.',
            'is_custom' => false,
        ]);

        $homeHero = $home->sections()->create([
            'name' => 'Hero Section',
            'slug' => 'hero',
        ]);
        
        $homeHero->blocks()->createMany([
            ['key' => 'badge', 'type' => 'text', 'label' => 'Badge Text', 'value' => 'Leading Robotics Innovation'],
            ['key' => 'title', 'type' => 'html', 'label' => 'Main Title', 'value' => 'Empowering the Future with <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-emerald-400">Robotics Products</span> & Corporate Services'],
            ['key' => 'description', 'type' => 'textarea', 'label' => 'Description', 'value' => 'From autonomous industrial solutions to cutting-edge software products. We build the infrastructure of tomorrow, today.'],
            ['key' => 'video_url', 'type' => 'url', 'label' => 'Background Video URL', 'value' => 'https://www.youtube.com/embed/H01fD1E5i08?autoplay=1&mute=1&controls=0&loop=1&playlist=H01fD1E5i08'],
        ]);

        $homeServices = $home->sections()->create([
            'name' => 'Services Overview',
            'slug' => 'services',
        ]);

        $homeServices->blocks()->createMany([
            ['key' => 'badge', 'type' => 'text', 'label' => 'Section Badge', 'value' => 'Core Divisions'],
            ['key' => 'title', 'type' => 'text', 'label' => 'Section Title', 'value' => 'Enterprise Services'],
            ['key' => 'rnd_image', 'type' => 'image', 'label' => 'R&D Image', 'value' => 'images/rnd_service.png'],
            ['key' => 'rnd_title', 'type' => 'text', 'label' => 'R&D Title', 'value' => 'Research & Development'],
            ['key' => 'training_image', 'type' => 'image', 'label' => 'Training Image', 'value' => 'images/training_service.png'],
            ['key' => 'training_title', 'type' => 'text', 'label' => 'Training Title', 'value' => 'Corporate Training'],
        ]);

        // 2. About Page
        $about = CmsPage::create([
            'title' => 'About Us',
            'slug' => 'about',
            'description' => 'Information about the company, mission, and team.',
            'is_custom' => false,
        ]);

        $aboutHero = $about->sections()->create([
            'name' => 'Hero Section',
            'slug' => 'hero',
        ]);

        $aboutHero->blocks()->createMany([
            ['key' => 'title', 'type' => 'text', 'label' => 'Title', 'value' => 'About Robotics Corner'],
            ['key' => 'subtitle', 'type' => 'textarea', 'label' => 'Subtitle', 'value' => 'Pioneering the future of robotics education and enterprise solutions in the MENA region.'],
        ]);
        
        $aboutContent = $about->sections()->create([
            'name' => 'Mission & Vision',
            'slug' => 'content',
        ]);
        
        $aboutContent->blocks()->createMany([
            ['key' => 'mission_text', 'type' => 'textarea', 'label' => 'Mission Text', 'value' => 'To accelerate the adoption of advanced robotics and AI technologies by providing world-class education, innovative R&D, and bespoke enterprise solutions.'],
            ['key' => 'vision_text', 'type' => 'textarea', 'label' => 'Vision Text', 'value' => 'To be the leading hub for robotics innovation, bridging the gap between academic research and industry application globally.'],
        ]);

        // 3. Contact Page
        $contact = CmsPage::create(['title' => 'Contact Us', 'slug' => 'contact', 'description' => 'Contact page.', 'is_custom' => false]);
        $contactHero = $contact->sections()->create(['name' => 'Hero Section', 'slug' => 'hero']);
        $contactHero->blocks()->createMany([
            ['key' => 'title', 'type' => 'text', 'label' => 'Title', 'value' => 'Get in Touch'],
            ['key' => 'subtitle', 'type' => 'textarea', 'label' => 'Subtitle', 'value' => 'Whether you are interested in enterprise solutions or professional training, our team is ready to help.'],
        ]);

        // 4. Global Site Content
        $global = CmsPage::create(['title' => 'Global Content', 'slug' => 'global', 'description' => 'Header, Footer, and other global elements.', 'is_custom' => false]);
        $header = $global->sections()->create(['name' => 'Header', 'slug' => 'header']);
        $header->blocks()->createMany([
            ['key' => 'site_name', 'type' => 'text', 'label' => 'Site Name', 'value' => 'Robotics Corner'],
            ['key' => 'cta_text', 'type' => 'text', 'label' => 'CTA Button Text', 'value' => 'Enroll Now'],
        ]);

        $footer = $global->sections()->create(['name' => 'Footer', 'slug' => 'footer']);
        $footer->blocks()->createMany([
            ['key' => 'description', 'type' => 'textarea', 'label' => 'Footer Description', 'value' => 'Empowering engineers and enterprises with cutting-edge robotics solutions and education.'],
            ['key' => 'linkedin_url', 'type' => 'url', 'label' => 'LinkedIn URL', 'value' => '#'],
            ['key' => 'github_url', 'type' => 'url', 'label' => 'GitHub URL', 'value' => '#'],
            ['key' => 'twitter_url', 'type' => 'url', 'label' => 'Twitter URL', 'value' => '#'],
        ]);
        // 5. Products Page
        $products = CmsPage::create(['title' => 'Products', 'slug' => 'products', 'description' => 'Products listing page.', 'is_custom' => false]);
        $productsHero = $products->sections()->create(['name' => 'Hero Section', 'slug' => 'hero']);
        $productsHero->blocks()->createMany([
            ['key' => 'title', 'type' => 'text', 'label' => 'Title', 'value' => 'Flagship Products'],
            ['key' => 'subtitle', 'type' => 'textarea', 'label' => 'Subtitle', 'value' => 'Proprietary hardware and software solutions engineered for maximum reliability, autonomy, and performance.'],
        ]);

        // 6. Services Page
        $services = CmsPage::create(['title' => 'Services', 'slug' => 'services', 'description' => 'Services listing page.', 'is_custom' => false]);
        $servicesHero = $services->sections()->create(['name' => 'Hero Section', 'slug' => 'hero']);
        $servicesHero->blocks()->createMany([
            ['key' => 'title', 'type' => 'text', 'label' => 'Title', 'value' => 'Enterprise Services'],
            ['key' => 'subtitle', 'type' => 'textarea', 'label' => 'Subtitle', 'value' => 'Comprehensive solutions spanning research, engineering, and elite technical training.'],
        ]);
    }
}
