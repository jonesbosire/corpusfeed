<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_name',        'value' => 'CorpusFeed',                    'type' => 'text',     'group' => 'general',  'label' => 'Site Name',            'help_text' => 'The name of your website'],
            ['key' => 'site_tagline',     'value' => 'Fresh From The Source',         'type' => 'text',     'group' => 'general',  'label' => 'Site Tagline',         'help_text' => 'Short description shown below site name'],
            ['key' => 'site_logo',        'value' => null,                            'type' => 'image',    'group' => 'general',  'label' => 'Site Logo',            'help_text' => 'Upload your site logo (SVG or PNG recommended)'],
            ['key' => 'site_favicon',     'value' => null,                            'type' => 'image',    'group' => 'general',  'label' => 'Favicon',              'help_text' => 'Small icon shown in browser tab (32x32 PNG)'],
            ['key' => 'google_analytics', 'value' => '',                              'type' => 'text',     'group' => 'general',  'label' => 'Google Analytics ID',  'help_text' => 'Your GA4 Measurement ID (e.g. G-XXXXXXXXXX)'],

            // Homepage
            ['key' => 'hero_title',       'value' => 'Fresh Organic Food Delivered',  'type' => 'text',     'group' => 'homepage', 'label' => 'Hero Banner Title',    'help_text' => 'Main headline on the homepage banner'],
            ['key' => 'hero_subtitle',    'value' => 'Connecting Kenyan farms to your table with fresh, healthy, organic produce.',  'type' => 'textarea', 'group' => 'homepage', 'label' => 'Hero Banner Subtitle', 'help_text' => 'Supporting text below the main headline'],
            ['key' => 'hero_background',  'value' => null,                            'type' => 'image',    'group' => 'homepage', 'label' => 'Hero Background Image','help_text' => 'Large background image for the hero banner'],
            ['key' => 'hero_btn_text',    'value' => 'Get Started',                   'type' => 'text',     'group' => 'homepage', 'label' => 'Hero Button Text',     'help_text' => 'Text on the main call-to-action button'],
            ['key' => 'about_title',      'value' => 'Who We Are',                    'type' => 'text',     'group' => 'homepage', 'label' => 'About Section Title',  'help_text' => 'Title for the About Us section on homepage'],
            ['key' => 'about_body',       'value' => 'CorpusFeed is a Nairobi-based agri-tech company connecting farmers directly with consumers. We source fresh, certified organic produce from verified farms across Kenya and deliver it to your doorstep.',  'type' => 'textarea', 'group' => 'homepage', 'label' => 'About Section Text',   'help_text' => 'Paragraph text in the About section'],
            ['key' => 'about_image',      'value' => null,                            'type' => 'image',    'group' => 'homepage', 'label' => 'About Section Image',  'help_text' => 'Image displayed in the About section'],
            ['key' => 'stat_clients',     'value' => '2500',                          'type' => 'number',   'group' => 'homepage', 'label' => 'Happy Clients Count',  'help_text' => 'Number shown in the statistics section'],
            ['key' => 'stat_farms',       'value' => '350',                           'type' => 'number',   'group' => 'homepage', 'label' => 'Partner Farms Count',  'help_text' => 'Number of partner farms'],
            ['key' => 'stat_years',       'value' => '12',                            'type' => 'number',   'group' => 'homepage', 'label' => 'Years of Experience',  'help_text' => 'Years the company has been operating'],
            ['key' => 'stat_deliveries',  'value' => '50000',                         'type' => 'number',   'group' => 'homepage', 'label' => 'Total Deliveries',     'help_text' => 'Total deliveries made to date'],
            ['key' => 'footer_desc',      'value' => 'We are committed to sustainable farming, nurturing healthy soil, and providing pure, organic produce straight from our farms to your table.',  'type' => 'textarea', 'group' => 'homepage', 'label' => 'Footer Description',   'help_text' => 'Short description shown in the website footer'],

            // Contact
            ['key' => 'contact_address',  'value' => 'Nairobi, Kenya',               'type' => 'text',     'group' => 'contact',  'label' => 'Office Address',       'help_text' => 'Your physical office or mailing address'],
            ['key' => 'contact_email',    'value' => 'info@corpusfeed.co.ke',         'type' => 'text',     'group' => 'contact',  'label' => 'Contact Email',        'help_text' => 'Public contact email address'],
            ['key' => 'contact_phone',    'value' => '+254 700 000 000',              'type' => 'text',     'group' => 'contact',  'label' => 'Phone Number',         'help_text' => 'Public contact phone number'],
            ['key' => 'contact_hours',    'value' => 'Mon–Fri: 8am–6pm EAT',         'type' => 'text',     'group' => 'contact',  'label' => 'Business Hours',       'help_text' => 'Business operating hours'],
            ['key' => 'admin_email',      'value' => 'admin@corpusfeed.co.ke',        'type' => 'text',     'group' => 'contact',  'label' => 'Admin Email',          'help_text' => 'Email that receives contact form notifications'],

            // Social
            ['key' => 'social_facebook',  'value' => '#',                             'type' => 'text',     'group' => 'social',   'label' => 'Facebook URL',         'help_text' => 'Full URL to your Facebook page'],
            ['key' => 'social_instagram', 'value' => '#',                             'type' => 'text',     'group' => 'social',   'label' => 'Instagram URL',        'help_text' => 'Full URL to your Instagram profile'],
            ['key' => 'social_twitter',   'value' => '#',                             'type' => 'text',     'group' => 'social',   'label' => 'X (Twitter) URL',      'help_text' => 'Full URL to your Twitter/X profile'],
            ['key' => 'social_linkedin',  'value' => '#',                             'type' => 'text',     'group' => 'social',   'label' => 'LinkedIn URL',         'help_text' => 'Full URL to your LinkedIn page'],
            ['key' => 'social_youtube',   'value' => '#',                             'type' => 'text',     'group' => 'social',   'label' => 'YouTube URL',          'help_text' => 'Full URL to your YouTube channel'],

            // SEO
            ['key' => 'meta_description', 'value' => 'CorpusFeed – Fresh organic produce delivered from Kenyan farms directly to your doorstep.',  'type' => 'textarea', 'group' => 'seo', 'label' => 'Default Meta Description', 'help_text' => 'Default description for search engines (150–160 characters)'],
            ['key' => 'meta_keywords',    'value' => 'organic food kenya, fresh produce nairobi, farm to table, corpusfeed',  'type' => 'text', 'group' => 'seo', 'label' => 'Default Meta Keywords', 'help_text' => 'Comma-separated keywords for SEO'],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
