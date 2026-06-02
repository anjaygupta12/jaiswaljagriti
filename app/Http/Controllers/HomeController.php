<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Event;
use App\Models\JobListing;
use App\Models\JobCategory;
use App\Models\Setting;
use App\Models\WingMember;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class HomeController extends Controller
{

    public function index()
    {
        $plans = Plan::where('status', 1)->latest()->take(5)->get();
        $banners = \App\Models\Banner::where('is_active', true)->latest()->get();
        $magazines = \App\Models\Magazine::where('is_active', true)->latest()->take(10)->get();
        $events = \App\Models\Event::where('is_active', true)->latest()->take(4)->get();
        
        $homeAd = \App\Models\AdvertisementNormal::whereHas('type', function($q) {
            $q->where('name', '921 X 122');
        })->where('is_active', true)->inRandomOrder()->first();
        
        $sidebarAd = \App\Models\AdvertisementNormal::whereHas('type', function($q) {
            $q->where('name', '225 X 225');
        })->where('is_active', true)->inRandomOrder()->first();

        $settings = [
            'home_welcome_title'       => Setting::getVal('home_welcome_title', 'Welcome to Jaiswal Jagriti Family'),
            'home_welcome_info_title'  => Setting::getVal('home_welcome_info_title', 'Fostering Culture & Unity'),
            'home_welcome_info_text'   => Setting::getVal('home_welcome_info_text', '<p style="line-height: 1.6;">The <em>Jaiswal Jagriti Family</em> is a socially driven, culturally rich community that has been continuously working towards the upliftment and unity of the Jaiswal society. Founded on principles of awareness, progress, and collective identity, the family operates through its flagship initiative, the <em>\'Jaiswal Jagriti\'</em> magazine—launched in 1994—which serves as a voice for the community. Through regular publications, cultural events, youth engagement, women empowerment, and social responsibility programs, the Jaiswal Jagriti Family has emerged as a unifying force, connecting Jaiswals across regions and generations with pride, purpose, and progress.</p>'),
            'home_welcome_btn_text'    => Setting::getVal('home_welcome_btn_text', 'Know More'),
            'home_welcome_btn_link'    => Setting::getVal('home_welcome_btn_link', route('about')),
            'home_welcome_image'       => Setting::getVal('home_welcome_image', 'assets/images/sj4.jpg'),
            
            'home_magazine_title'      => Setting::getVal('home_magazine_title', 'Jaiswal Jagriti Magazine'),
            'home_magazine_info_text'  => Setting::getVal('home_magazine_info_text', '<p class="text-muted">It was only natural that to give shape to our objectives, we needed a mouthpiece. Hence, in April 1994, the quarterly magazine titled <em>‘Jaiswal Jagriti’</em> was launched at a grand cultural event held in the National Museum in Delhi.</p><p class="text-muted">Since then, this magazine has been published regularly and continues to gain popularity with social responsibility and awareness.</p>'),
            'home_magazine_btn_text'   => Setting::getVal('home_magazine_btn_text', 'Subscribe Now'),
            'home_magazine_btn_link'   => Setting::getVal('home_magazine_btn_link', '#'),
            'home_magazine_image'      => Setting::getVal('home_magazine_image', 'assets/images/Screenshot-2025-07-09-171638.png'),
        ];

        $defaultCategories = [
            1 => ['title' => 'Matrimony', 'image' => 'assets/images/IMG-20250704-WA0010.webp'],
            2 => ['title' => 'Jobs & Careers', 'image' => 'assets/images/3688609.png'],
            3 => ['title' => 'Events', 'image' => 'assets/images/download.jpeg'],
            4 => ['title' => 'Magazine', 'image' => 'assets/images/Screenshot-2025-07-09-171638.png'],
            5 => ['title' => 'Spiritual Yatra', 'image' => 'assets/images/Begin-Spiritual-Journey-with-a-Chardham-Yatra-from-Bangalore.webp'],
            6 => ['title' => 'Education', 'image' => 'assets/images/images-removebg-preview.png'],
        ];

        for ($i = 1; $i <= 6; $i++) {
            $settings["home_cat_{$i}_title"] = Setting::getVal("home_cat_{$i}_title", $defaultCategories[$i]['title']);
            $settings["home_cat_{$i}_link"]  = Setting::getVal("home_cat_{$i}_link", "#");
            $settings["home_cat_{$i}_image"] = Setting::getVal("home_cat_{$i}_image", $defaultCategories[$i]['image']);
        }

        $spiritualYatras = \App\Models\SpiritualYatra::where('status', true)->latest()->take(4)->get();
        $jobListings = \App\Models\JobListing::where('status', true)->latest()->take(5)->get();
        $galleryImages = \App\Models\Gallery::where('is_active', true)->orderBy('sort_order', 'asc')->latest()->take(8)->get();

        return view('home', compact('plans', 'banners', 'magazines', 'events', 'homeAd', 'sidebarAd', 'settings', 'spiritualYatras', 'jobListings', 'galleryImages'));
    }
    public function about()
    {
        $settings = [
            'about_banner'              => \App\Models\Setting::getVal('about_banner', 'assets/images/sj4.jpg'),
            'about_banner_title'        => \App\Models\Setting::getVal('about_banner_title', 'About Us'),
            'about_gallery_1_img1'      => \App\Models\Setting::getVal('about_gallery_1_img1', 'assets/images/sj10.jpg'),
            'about_gallery_1_img2'      => \App\Models\Setting::getVal('about_gallery_1_img2', 'assets/images/sj11.jpg'),
            'about_gallery_2_img1'      => \App\Models\Setting::getVal('about_gallery_2_img1', 'assets/images/sj4.jpg'),
            'about_gallery_2_img2'      => \App\Models\Setting::getVal('about_gallery_2_img2', 'assets/images/sj14.jpg'),
            'about_gallery_3_img1'      => \App\Models\Setting::getVal('about_gallery_3_img1', 'assets/images/J1.jpg'),
            'about_gallery_3_img2'      => \App\Models\Setting::getVal('about_gallery_3_img2', 'assets/images/J2.jpg'),
            'about_gallery_3_img3'      => \App\Models\Setting::getVal('about_gallery_3_img3', 'assets/images/JJ.jpg'),
            'about_hearts_title1'       => \App\Models\Setting::getVal('about_hearts_title1', 'Bringing Hearts Together'),
            'about_hearts_title2'       => \App\Models\Setting::getVal('about_hearts_title2', 'Where Matches Turn into Marriages'),
            'about_hearts_text'         => \App\Models\Setting::getVal('about_hearts_text', 'At Jaiswal Jagriti, we believe that finding your life partner should be a journey of trust, joy, and meaningful connections. Our platform is designed to blend traditional values with modern technology, making it easier than ever to meet someone who truly understands you. Whether you’re looking for a match within your community or exploring beyond boundaries, we provide a safe, genuine, and personalized experience to help you take the first step toward your happily ever after.'),
            'about_hearts_features'     => \App\Models\Setting::getVal('about_hearts_features', '<p><strong>Verified Profiles</strong> – We ensure authenticity through thorough checks.</p><p><strong>Advanced Search Filters</strong> – Find matches by age, education, city, caste, and more.</p><p><strong>Privacy & Security</strong> – Your personal details are kept safe and confidential.</p><p><strong>User-Friendly Interface</strong> – Easy navigation for a seamless experience.</p><p><strong>Matchmaking Expertise</strong> – Combining tradition and technology for better results.</p><p><strong>Dedicated Support</strong> – Our team is always ready to assist you.</p>'),
            'about_empowering_title'    => \App\Models\Setting::getVal('about_empowering_title', 'Empowering the Jaiswal Community'),
            'about_empowering_text'     => \App\Models\Setting::getVal('about_empowering_text', 'Jaiswal Jagriti is dedicated to uniting, uplifting, and empowering the Jaiswal community through knowledge, opportunities, and connections. From hosting cultural events that celebrate our rich heritage to offering career and business resources, matrimonial services, and informative publications, we serve as a bridge between tradition and progress. Our mission is to create a platform where every member of the community can grow, succeed, and contribute to a stronger, more connected future.'),
            'about_opportunities_title' => \App\Models\Setting::getVal('about_opportunities_title', 'One Platform, Many Opportunities'),
            'about_opportunities_text'  => \App\Models\Setting::getVal('about_opportunities_text', 'Jaiswal Jagriti brings together a wide range of services and initiatives under one roof, making it a true hub for the community. Whether it’s finding the right job, meeting your life partner, staying updated with our magazine, or participating in cultural and social events, we provide a single destination to explore, connect, and grow. Our platform is designed to open doors to new possibilities while keeping our community spirit alive.'),
        ];

        return view('about', compact('settings'));
    }
    public function job()
    {
        $featuredJobs = \App\Models\JobListing::where('status', true)->where('is_featured', true)->latest()->take(4)->get();
        $categories = \App\Models\JobCategory::where('status', true)->with(['listings' => function($q) {
            $q->where('status', true)->latest()->take(10);
        }])->get();

        return view('job', compact('featuredJobs', 'categories'));
    }

    public function jobDetail(JobListing $jobListing)
    {
        if (!$jobListing->status || !$jobListing->isInternal()) {
            abort(404);
        }

        $relatedJobs = JobListing::where('id', '!=', $jobListing->id)
            ->where('status', true)
            ->where('job_category_id', $jobListing->job_category_id)
            ->latest()
            ->take(5)
            ->get();

        return view('job_detail', compact('jobListing', 'relatedJobs'));
    }
    public function YouthWing()
    {
        $members = \App\Models\WingMember::where('type', 'youth-wing')->where('status', true)->orderBy('sort_order')->get();
        return view('Youth_wing', compact('members'));
    }
    
    public function ExecutiveBody()
    {
        $members = \App\Models\WingMember::where('type', 'executive-body')->where('status', true)->orderBy('sort_order')->get();
        return view('executive_body', compact('members'));
    }
    
    public function womensWing()
    {
        $members = \App\Models\WingMember::where('type', 'womens-wing')->where('status', true)->orderBy('sort_order')->get();
        return view('womens_wing', compact('members'));
    }
    public function upcommingEvents(Request $request)
    {
        $query = Event::where('is_active', true);
        
        if ($request->has('category')) {
            $query->whereHas('eventCategory', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $events = $query->latest()->get();
        $settings = [
            'events_banner'       => \App\Models\Setting::getVal('events_banner', 'assets/images/sj4.jpg'),
            'events_banner_title' => \App\Models\Setting::getVal('events_banner_title', 'Upcoming Events'),
        ];
        return view('upcomming_events', compact('events', 'settings'));
    }

    public function upcommingEventsDeatils(Event $event)
    {
        $event->increment('views');
        $related = Event::where('id', '!=', $event->id)->latest()->take(3)->get();
        $relatedMagazines = $event->relatedMagazines()->where('magazines.is_active', true)->get();
        if ($relatedMagazines->isEmpty()) {
            $relatedMagazines = \App\Models\Magazine::where('is_active', true)->latest()->take(6)->get();
        }

        return view('upcomming_events_details', compact('event', 'related', 'relatedMagazines'));
    }

    public function patrikaSubscription()
    {
        $plans = Plan::where('status', 1)->where('type', 'patrika')->latest()->get();
        $title = 'Patrika Subscriptions';

        $userSubscriptions = collect();
        $highestSubscribedPrice = 0;
        
        if (auth()->check()) {
            $subs = auth()->user()->subscriptions()
                ->whereHas('plan', function($q) {
                    $q->where('type', 'patrika');
                })
                ->whereIn('status', ['pending', 'approved'])
                ->with('plan')
                ->get();
                
            $userSubscriptions = $subs->keyBy('plan_id');
            $highestSubscribedPrice = $subs->max(function($sub) {
                return $sub->plan->price;
            }) ?? 0;
        }

        return view('subscriptions', compact('plans', 'userSubscriptions', 'title', 'highestSubscribedPrice'));
    }

    public function advertisementSubscription()
    {
        $plans = Plan::where('status', 1)->where('type', 'advertisement')->latest()->get();
        $title = 'Advertisement Subscriptions';

        $userSubscriptions = collect();
        $highestSubscribedPrice = 0;
        
        if (auth()->check()) {
            $subs = auth()->user()->subscriptions()
                ->whereHas('plan', function($q) {
                    $q->where('type', 'advertisement');
                })
                ->whereIn('status', ['pending', 'approved'])
                ->with('plan')
                ->get();
                
            $userSubscriptions = $subs->keyBy('plan_id');
            $highestSubscribedPrice = $subs->max(function($sub) {
                return $sub->plan->price;
            }) ?? 0;
        }

        return view('subscriptions', compact('plans', 'userSubscriptions', 'title', 'highestSubscribedPrice'));
    }

    public function gallery(\Illuminate\Http\Request $request)
    {
        $eventImages = \App\Models\EventImage::where('show_in_gallery', true)->whereHas('event', function($q) {
            $q->where('is_active', true);
        })->with('event')->latest()->get()->map(function($img) {
            return (object) [
                'type' => 'event',
                'image_path' => $img->image_path,
                'title' => $img->event->title ?? 'Event Photo',
                'category_name' => $img->event->eventCategory->name ?? 'Community Event',
                'category_slug' => $img->event->eventCategory->slug ?? 'uncategorized',
                'date' => \Carbon\Carbon::parse($img->event->event_date)->format('M d, Y'),
                'long_date' => \Carbon\Carbon::parse($img->event->event_date)->format('F d, Y'),
                'location' => $img->event->location ?? '',
                'description' => \Illuminate\Support\Str::limit($img->event->content ?? '', 150),
                'link' => $img->event ? route('events-details', $img->event->slug) : null,
                'created_at' => $img->created_at,
            ];
        });

        $galleryImages = \App\Models\Gallery::where('is_active', true)->latest()->get()->map(function($img) {
            return (object) [
                'type' => 'gallery',
                'image_path' => $img->image_path,
                'title' => $img->title,
                'category_name' => 'Gallery',
                'category_slug' => 'gallery',
                'date' => $img->created_at->format('M d, Y'),
                'long_date' => $img->created_at->format('F d, Y'),
                'location' => $img->location ?? '',
                'description' => $img->description ?? '',
                'link' => null,
                'created_at' => $img->created_at,
            ];
        });

        $allImages = $eventImages->concat($galleryImages)->sortByDesc('created_at')->values();

        $page = $request->get('page', 1);
        $perPage = 24;
        $images = new \Illuminate\Pagination\LengthAwarePaginator(
            $allImages->forPage($page, $perPage),
            $allImages->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('gallery', compact('images'));
    }

    public function contact()
    {
        $settings = [
            'contact_email'   => Setting::getVal('contact_email',   'info@jaiswaljagriti.org'),
            'contact_phone'   => Setting::getVal('contact_phone',   '+91 98765 43210'),
            'contact_address' => Setting::getVal('contact_address', 'Jaiswal Jagriti Family Office, India'),
            'contact_map_url' => Setting::getVal('contact_map_url', 'https://maps.google.com/maps?q=India&t=m&z=10&output=embed&iwloc=near'),
            'contact_banner'  => Setting::getVal('contact_banner',  'assets/images/sj4.jpg'),
            'contact_banner_title' => Setting::getVal('contact_banner_title', 'Contact Us'),
            'contact_banner_badge' => Setting::getVal('contact_banner_badge', 'Get In Touch'),
            'contact_banner_subtitle' => Setting::getVal('contact_banner_subtitle', "Connect with Jaiswal Jagriti Family. Have inquiries, suggestions, or feedback? We'd love to hear from you."),
        ];

        $executives = WingMember::where('type', 'executive')
            ->where('status', 1)
            ->orderBy('sort_order')
            ->get();

        return view('contact', compact('settings', 'executives'));
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'g-recaptcha-response' => 'required'
        ]);

        $recaptchaResponse = $request->input('g-recaptcha-response');
        $secretKey = env('RECAPTCHA_SECRET_KEY', '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe');

        if ($secretKey) {
            $response = \Illuminate\Support\Facades\Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $secretKey,
                'response' => $recaptchaResponse,
                'remoteip' => $request->ip()
            ]);

            if (!$response->json('success')) {
                return back()->withErrors(['g-recaptcha-response' => 'Captcha verification failed.'])->withInput();
            }
        }

        $toEmail = Setting::getVal('contact_email', 'info@jaiswaljagriti.org');

        try {
            Mail::to($toEmail)->send(new ContactMail(
                $request->name,
                $request->email,
                $request->subject,
                $request->message
            ));
        } catch (\Exception $e) {
            // Mail failure should not block the user
            \Log::error('Contact mail failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Your message has been sent successfully. We will get back to you soon!');
    }
}
