<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // ──────────────────────────────────────────────
    // Magazine Settings (top-level Settings menu)
    // ──────────────────────────────────────────────

    public function index()
    {
        $settings = [
            'magazine_old_from_date' => Setting::getVal('magazine_old_from_date', ''),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'magazine_old_from_date' => 'nullable|date',
        ]);

        Setting::setVal('magazine_old_from_date', $request->magazine_old_from_date);

        return redirect()->back()->with('success', 'Magazine settings updated successfully.');
    }

    // ──────────────────────────────────────────────
    // Contact Page (CMS > Contact Page menu)
    // ──────────────────────────────────────────────

    public function contactIndex()
    {
        $settings = [
            'contact_email'        => Setting::getVal('contact_email', 'info@jaiswaljagriti.org'),
            'contact_phone'        => Setting::getVal('contact_phone', '+91 98765 43210'),
            'contact_address'      => Setting::getVal('contact_address', "Jaiswal Jagriti Family Office,\nSector 5, Mansarovar, Jaipur,\nRajasthan, India - 302020"),
            'contact_map_url'      => Setting::getVal('contact_map_url', 'https://maps.google.com/maps?q=London%20Eye%2C%20London%2C%20United%20Kingdom&t=m&z=10&output=embed&iwloc=near'),
            'contact_banner'       => Setting::getVal('contact_banner', 'assets/images/sj4.jpg'),
            'contact_banner_title' => Setting::getVal('contact_banner_title', 'Contact Us'),
            'contact_banner_badge' => Setting::getVal('contact_banner_badge', 'Get In Touch'),
            'contact_banner_subtitle' => Setting::getVal('contact_banner_subtitle', "Connect with Jaiswal Jagriti Family. Have inquiries, suggestions, or feedback? We'd love to hear from you."),
        ];

        return view('admin.settings.contact', compact('settings'));
    }

    public function contactUpdate(Request $request)
    {
        $request->validate([
            'contact_email'        => 'required|email|max:255',
            'contact_phone'        => 'required|string|max:50',
            'contact_address'      => 'required|string',
            'contact_map_url'      => 'required|string',
            'contact_banner'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'contact_banner_title' => 'nullable|string|max:255',
            'contact_banner_badge' => 'nullable|string|max:255',
            'contact_banner_subtitle' => 'nullable|string',
        ]);

        Setting::setVal('contact_email',        $request->contact_email);
        Setting::setVal('contact_phone',        $request->contact_phone);
        Setting::setVal('contact_address',      $request->contact_address);
        Setting::setVal('contact_map_url',      $request->contact_map_url);
        
        if ($request->has('contact_banner_title')) {
            Setting::setVal('contact_banner_title', $request->contact_banner_title);
        }
        if ($request->has('contact_banner_badge')) {
            Setting::setVal('contact_banner_badge', $request->contact_banner_badge);
        }
        if ($request->has('contact_banner_subtitle')) {
            Setting::setVal('contact_banner_subtitle', $request->contact_banner_subtitle);
        }

        if ($request->hasFile('contact_banner') && $request->file('contact_banner')->isValid()) {
            $file      = $request->file('contact_banner');
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename  = 'contact_banner_' . time() . '_' . uniqid() . '.' . $extension;
            $file->move(public_path('settings'), $filename);

            // Delete old banner if it lives in the settings directory
            $oldBanner = Setting::getVal('contact_banner');
            if ($oldBanner && strpos($oldBanner, 'settings/') === 0 && file_exists(public_path($oldBanner))) {
                unlink(public_path($oldBanner));
            }

            Setting::setVal('contact_banner', 'settings/' . $filename);
        }

        return redirect()->back()->with('success', 'Contact Page settings updated successfully.');
    }

    // ──────────────────────────────────────────────
    // About Page (CMS > About Page menu)
    // ──────────────────────────────────────────────

    public function aboutIndex()
    {
        $settings = [
            'about_banner'              => Setting::getVal('about_banner', 'assets/images/sj4.jpg'),
            'about_banner_title'        => Setting::getVal('about_banner_title', 'About Us'),
            'about_gallery_1_img1'      => Setting::getVal('about_gallery_1_img1', 'assets/images/sj10.jpg'),
            'about_gallery_1_img2'      => Setting::getVal('about_gallery_1_img2', 'assets/images/sj11.jpg'),
            'about_gallery_2_img1'      => Setting::getVal('about_gallery_2_img1', 'assets/images/sj4.jpg'),
            'about_gallery_2_img2'      => Setting::getVal('about_gallery_2_img2', 'assets/images/sj14.jpg'),
            'about_gallery_3_img1'      => Setting::getVal('about_gallery_3_img1', 'assets/images/J1.jpg'),
            'about_gallery_3_img2'      => Setting::getVal('about_gallery_3_img2', 'assets/images/J2.jpg'),
            'about_gallery_3_img3'      => Setting::getVal('about_gallery_3_img3', 'assets/images/JJ.jpg'),
            'about_hearts_title1'       => Setting::getVal('about_hearts_title1', 'Bringing Hearts Together'),
            'about_hearts_title2'       => Setting::getVal('about_hearts_title2', 'Where Matches Turn into Marriages'),
            'about_hearts_text'         => Setting::getVal('about_hearts_text', 'At Jaiswal Jagriti, we believe that finding your life partner should be a journey of trust, joy, and meaningful connections. Our platform is designed to blend traditional values with modern technology, making it easier than ever to meet someone who truly understands you. Whether you’re looking for a match within your community or exploring beyond boundaries, we provide a safe, genuine, and personalized experience to help you take the first step toward your happily ever after.'),
            'about_hearts_features'     => Setting::getVal('about_hearts_features', '<p><strong>Verified Profiles</strong> – We ensure authenticity through thorough checks.</p><p><strong>Advanced Search Filters</strong> – Find matches by age, education, city, caste, and more.</p><p><strong>Privacy & Security</strong> – Your personal details are kept safe and confidential.</p><p><strong>User-Friendly Interface</strong> – Easy navigation for a seamless experience.</p><p><strong>Matchmaking Expertise</strong> – Combining tradition and technology for better results.</p><p><strong>Dedicated Support</strong> – Our team is always ready to assist you.</p>'),
            'about_empowering_title'    => Setting::getVal('about_empowering_title', 'Empowering the Jaiswal Community'),
            'about_empowering_text'     => Setting::getVal('about_empowering_text', 'Jaiswal Jagriti is dedicated to uniting, uplifting, and empowering the Jaiswal community through knowledge, opportunities, and connections. From hosting cultural events that celebrate our rich heritage to offering career and business resources, matrimonial services, and informative publications, we serve as a bridge between tradition and progress. Our mission is to create a platform where every member of the community can grow, succeed, and contribute to a stronger, more connected future.'),
            'about_opportunities_title' => Setting::getVal('about_opportunities_title', 'One Platform, Many Opportunities'),
            'about_opportunities_text'  => Setting::getVal('about_opportunities_text', 'Jaiswal Jagriti brings together a wide range of services and initiatives under one roof, making it a true hub for the community. Whether it’s finding the right job, meeting your life partner, staying updated with our magazine, or participating in cultural and social events, we provide a single destination to explore, connect, and grow. Our platform is designed to open doors to new possibilities while keeping our community spirit alive.'),
        ];

        return view('admin.settings.about', compact('settings'));
    }

    public function aboutUpdate(Request $request)
    {
        $request->validate([
            'about_banner'              => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'about_banner_title'        => 'nullable|string|max:255',
            'about_gallery_1_img1'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'about_gallery_1_img2'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'about_gallery_2_img1'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'about_gallery_2_img2'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'about_gallery_3_img1'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'about_gallery_3_img2'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'about_gallery_3_img3'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'about_hearts_title1'       => 'nullable|string|max:255',
            'about_hearts_title2'       => 'nullable|string|max:255',
            'about_hearts_text'         => 'nullable|string',
            'about_hearts_features'     => 'nullable|string',
            'about_empowering_title'    => 'nullable|string|max:255',
            'about_empowering_text'     => 'nullable|string',
            'about_opportunities_title' => 'nullable|string|max:255',
            'about_opportunities_text'  => 'nullable|string',
        ]);

        $textFields = [
            'about_banner_title', 'about_hearts_title1', 'about_hearts_title2', 'about_hearts_text', 'about_hearts_features',
            'about_empowering_title', 'about_empowering_text', 'about_opportunities_title', 'about_opportunities_text'
        ];

        foreach ($textFields as $field) {
            if ($request->has($field)) {
                Setting::setVal($field, $request->$field);
            }
        }

        $imageFields = [
            'about_banner', 'about_gallery_1_img1', 'about_gallery_1_img2', 
            'about_gallery_2_img1', 'about_gallery_2_img2', 
            'about_gallery_3_img1', 'about_gallery_3_img2', 'about_gallery_3_img3'
        ];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field) && $request->file($field)->isValid()) {
                $file      = $request->file($field);
                $extension = $file->getClientOriginalExtension() ?: 'jpg';
                $filename  = $field . '_' . time() . '_' . uniqid() . '.' . $extension;
                $file->move(public_path('settings'), $filename);

                $oldImage = Setting::getVal($field);
                if ($oldImage && strpos($oldImage, 'settings/') === 0 && file_exists(public_path($oldImage))) {
                    @unlink(public_path($oldImage));
                }

                Setting::setVal($field, 'settings/' . $filename);
            }
        }

        return redirect()->back()->with('success', 'About Page settings updated successfully.');
    }

    // ──────────────────────────────────────────────
    // Events Banner
    // ──────────────────────────────────────────────

    public function eventsBannerIndex()
    {
        $settings = [
            'events_banner'       => Setting::getVal('events_banner', 'assets/images/sj4.jpg'),
            'events_banner_title' => Setting::getVal('events_banner_title', 'Upcoming Events'),
        ];

        return view('admin.settings.events_banner', compact('settings'));
    }

    public function eventsBannerUpdate(Request $request)
    {
        $request->validate([
            'events_banner'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'events_banner_title' => 'nullable|string|max:255',
        ]);

        if ($request->has('events_banner_title')) {
            Setting::setVal('events_banner_title', $request->events_banner_title);
        }

        if ($request->hasFile('events_banner') && $request->file('events_banner')->isValid()) {
            $file      = $request->file('events_banner');
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename  = 'events_banner_' . time() . '_' . uniqid() . '.' . $extension;
            $file->move(public_path('settings'), $filename);

            $oldBanner = Setting::getVal('events_banner');
            if ($oldBanner && strpos($oldBanner, 'settings/') === 0 && file_exists(public_path($oldBanner))) {
                @unlink(public_path($oldBanner));
            }

            Setting::setVal('events_banner', 'settings/' . $filename);
        }

        return redirect()->back()->with('success', 'Events Banner settings updated successfully.');
    }

    // ──────────────────────────────────────────────
    // Home Welcome Section
    // ──────────────────────────────────────────────

    public function homeWelcomeIndex()
    {
        $settings = [
            'home_welcome_title'       => Setting::getVal('home_welcome_title', 'Welcome to Jaiswal Jagriti Family'),
            'home_welcome_info_title'  => Setting::getVal('home_welcome_info_title', 'Fostering Culture & Unity'),
            'home_welcome_info_text'   => Setting::getVal('home_welcome_info_text', '<p style="line-height: 1.6;">The <em>Jaiswal Jagriti Family</em> is a socially driven, culturally rich community that has been continuously working towards the upliftment and unity of the Jaiswal society. Founded on principles of awareness, progress, and collective identity, the family operates through its flagship initiative, the <em>\'Jaiswal Jagriti\'</em> magazine—launched in 1994—which serves as a voice for the community. Through regular publications, cultural events, youth engagement, women empowerment, and social responsibility programs, the Jaiswal Jagriti Family has emerged as a unifying force, connecting Jaiswals across regions and generations with pride, purpose, and progress.</p>'),
            'home_welcome_btn_text'    => Setting::getVal('home_welcome_btn_text', 'Know More'),
            'home_welcome_btn_link'    => Setting::getVal('home_welcome_btn_link', route('about')),
            'home_welcome_image'       => Setting::getVal('home_welcome_image', 'assets/images/sj4.jpg'),
        ];

        $defaultCategories = [
            1 => ['title' => 'Matrimony', 'image' => 'assets/images/IMG-20250704-WA0010.webp'],
            2 => ['title' => 'Jobs & Careers', 'image' => 'assets/images/3688609.png'],
            3 => ['title' => 'Events', 'image' => 'assets/images/download.jpeg'],
            4 => ['title' => 'Magazine', 'image' => 'assets/images/Screenshot-2025-07-09-171638.png'],
            5 => ['title' => 'Spiritual Yatra', 'image' => 'assets/images/Begin-Spiritual-Journey-with-a-Chardham-Yatra-from-Bangalore.webp'],
            6 => ['title' => 'Education', 'image' => 'assets/images/images-removebg-preview.png'],
        ];

        // Categories 1 to 6
        for ($i = 1; $i <= 6; $i++) {
            $settings["home_cat_{$i}_title"] = Setting::getVal("home_cat_{$i}_title", $defaultCategories[$i]['title']);
            $settings["home_cat_{$i}_link"]  = Setting::getVal("home_cat_{$i}_link", "#");
            $settings["home_cat_{$i}_image"] = Setting::getVal("home_cat_{$i}_image", $defaultCategories[$i]['image']);
        }

        return view('admin.settings.home_welcome', compact('settings'));
    }

    public function homeWelcomeUpdate(Request $request)
    {
        $rules = [
            'home_welcome_title'       => 'nullable|string|max:255',
            'home_welcome_info_title'  => 'nullable|string|max:255',
            'home_welcome_info_text'   => 'nullable|string',
            'home_welcome_btn_text'    => 'nullable|string|max:255',
            'home_welcome_btn_link'    => 'nullable|string|max:255',
            'home_welcome_image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ];

        for ($i = 1; $i <= 6; $i++) {
            $rules["home_cat_{$i}_title"] = 'nullable|string|max:255';
            $rules["home_cat_{$i}_link"]  = 'nullable|string|max:255';
            $rules["home_cat_{$i}_image"] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096';
        }

        $request->validate($rules);

        $fields = [
            'home_welcome_title', 'home_welcome_info_title', 'home_welcome_info_text',
            'home_welcome_btn_text', 'home_welcome_btn_link'
        ];
        
        for ($i = 1; $i <= 6; $i++) {
            $fields[] = "home_cat_{$i}_title";
            $fields[] = "home_cat_{$i}_link";
        }

        foreach ($fields as $field) {
            if ($request->has($field)) {
                Setting::setVal($field, $request->$field);
            }
        }

        $imageFields = ['home_welcome_image'];
        for ($i = 1; $i <= 6; $i++) {
            $imageFields[] = "home_cat_{$i}_image";
        }

        foreach ($imageFields as $imgField) {
            if ($request->hasFile($imgField) && $request->file($imgField)->isValid()) {
                $file      = $request->file($imgField);
                $extension = $file->getClientOriginalExtension() ?: 'jpg';
                $filename  = $imgField . '_' . time() . '_' . uniqid() . '.' . $extension;
                $file->move(public_path('settings'), $filename);

                $oldImage = Setting::getVal($imgField);
                if ($oldImage && strpos($oldImage, 'settings/') === 0 && file_exists(public_path($oldImage))) {
                    @unlink(public_path($oldImage));
                }

                Setting::setVal($imgField, 'settings/' . $filename);
            }
        }

        return redirect()->back()->with('success', 'Home Welcome Section settings updated successfully.');
    }
    public function homeMagazineIndex()
    {
        $settings = [
            'home_magazine_title'       => Setting::getVal('home_magazine_title', 'Jaiswal Jagriti Magazine'),
            'home_magazine_info_text'   => Setting::getVal('home_magazine_info_text', '<p class="text-muted">It was only natural that to give shape to our objectives, we needed a mouthpiece. Hence, in April 1994, the quarterly magazine titled <em>‘Jaiswal Jagriti’</em> was launched at a grand cultural event held in the National Museum in Delhi.</p><p class="text-muted">Since then, this magazine has been published regularly and continues to gain popularity with social responsibility and awareness.</p>'),
            'home_magazine_btn_text'    => Setting::getVal('home_magazine_btn_text', 'Subscribe Now'),
            'home_magazine_btn_link'    => Setting::getVal('home_magazine_btn_link', '#'),
            'home_magazine_image'       => Setting::getVal('home_magazine_image', 'assets/images/Screenshot-2025-07-09-171638.png'),
        ];

        return view('admin.settings.home_magazine', compact('settings'));
    }

    public function homeMagazineUpdate(Request $request)
    {
        $fields = [
            'home_magazine_title',
            'home_magazine_info_text',
            'home_magazine_btn_text',
            'home_magazine_btn_link'
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                Setting::setVal($field, $request->$field);
            }
        }

        $imgField = 'home_magazine_image';
        if ($request->hasFile($imgField) && $request->file($imgField)->isValid()) {
            $file      = $request->file($imgField);
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename  = $imgField . '_' . time() . '_' . uniqid() . '.' . $extension;
            $file->move(public_path('settings'), $filename);

            $oldImage = Setting::getVal($imgField);
            if ($oldImage && strpos($oldImage, 'settings/') === 0 && file_exists(public_path($oldImage))) {
                @unlink(public_path($oldImage));
            }

            Setting::setVal($imgField, 'settings/' . $filename);
        }

        return redirect()->back()->with('success', 'Home Magazine section updated successfully.');
    }

    // ──────────────────────────────────────────────
    // Footer Settings
    // ──────────────────────────────────────────────

    public function footerIndex()
    {
        $settings = [
            'footer_about_title'      => Setting::getVal('footer_about_title', 'Jaiswal Jagriti'),
            'footer_about_text'       => Setting::getVal('footer_about_text', 'Uniting the community since 1994, fostering culture, careers, and social harmony.'),
            'footer_address'          => Setting::getVal('footer_address', 'Delhi, India'),
            'footer_phone'            => Setting::getVal('footer_phone', '+91 9868105658'),
            'footer_email'            => Setting::getVal('footer_email', 'jaiswaljagrity@gmail.com'),
            'footer_facebook'         => Setting::getVal('footer_facebook', '#'),
            'footer_instagram'        => Setting::getVal('footer_instagram', '#'),
            'footer_youtube'          => Setting::getVal('footer_youtube', '#'),
            'footer_twitter'          => Setting::getVal('footer_twitter', '#'),
            'footer_copyright'        => Setting::getVal('footer_copyright', '© 2025 Jaiswal Jagriti Family. All rights reserved. | Together for Progress'),
        ];

        return view('admin.settings.footer', compact('settings'));
    }

    public function footerUpdate(Request $request)
    {
        $fields = [
            'footer_about_title', 'footer_about_text', 'footer_address', 'footer_phone',
            'footer_email', 'footer_facebook', 'footer_instagram', 'footer_youtube', 'footer_twitter', 'footer_copyright'
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                Setting::setVal($field, $request->$field);
            }
        }

        return redirect()->back()->with('success', 'Footer settings updated successfully.');
    }
}
