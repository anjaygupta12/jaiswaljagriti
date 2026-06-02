@extends('layouts.app')

@section('title', 'Jaiswal Jagriti Family | Home')

@section('content')
    <!-- Hero Slider -->
    <div class="hero-slider">
        <div class="swiper heroSwiper">
            <div class="swiper-wrapper">
                @forelse($banners as $banner)
                    <div class="swiper-slide" style="background-image: url('{{ asset($banner->image_path) }}');"></div>
                @empty
                    <div class="swiper-slide"
                        style="background-image: url('{{ asset('assets/images/IMG-20250826-WA0008.jpg') }}');"></div>
                    <div class="swiper-slide"
                        style="background-image: url('{{ asset('assets/images/IMG-20250826-WA0005.jpg') }}');"></div>
                    <div class="swiper-slide"
                        style="background-image: url('{{ asset('assets/images/IMG-20250826-WA0003.jpg') }}');"></div>
                    <div class="swiper-slide"
                        style="background-image: url('{{ asset('assets/images/IMG-20250826-WA0001.jpg') }}');"></div>
                @endforelse
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- Welcome Section -->
    <section>
        <div class="container-custom">
            <div class="section-title">
                <h2>{{ $settings['home_welcome_title'] ?? 'Welcome to Jaiswal Jagriti Family' }}</h2>
            </div>
            <div class="category-grid">
                @for($i = 1; $i <= 6; $i++)
                    @if(!empty($settings["home_cat_{$i}_title"]))
                        <a href="{{ $settings["home_cat_{$i}_link"] }}" class="category-card">
                            @if(!empty($settings["home_cat_{$i}_image"]))
                                <img src="{{ asset($settings["home_cat_{$i}_image"]) }}" alt="{{ $settings["home_cat_{$i}_title"] }}">
                            @endif
                            <p>{!! $settings["home_cat_{$i}_title"] !!} →</p>
                        </a>
                    @endif
                @endfor
            </div>

            <div class="info-row" style="margin-top: 60px;">
                <div class="info-text">
                    <h3 style="font-size: 28px; margin-bottom: 20px;">{{ $settings['home_welcome_info_title'] ?? 'Fostering Culture & Unity' }}</h3>
                    {!! $settings['home_welcome_info_text'] ?? '<p>Default text.</p>' !!}
                    <a href="{{ $settings['home_welcome_btn_link'] ?? '#' }}" class="btn-primary" style="margin-top: 24px; display: inline-block;">
                        {{ $settings['home_welcome_btn_text'] ?? 'Know More' }} <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <div class="info-img">
                    <img src="{{ asset($settings['home_welcome_image'] ?? 'assets/images/sj4.jpg') }}" alt="Community Event">
                </div>
            </div>
        </div>
    </section>

    <!-- Advertisement Section -->
    <div class="container-custom amazon-ad">
        @if(isset($homeAd) && $homeAd)
            <a href="{{ $homeAd->link ?? '#' }}" target="_blank">
                <img src="{{ asset($homeAd->image_path) }}" alt="Advertisement"
                    class="elementor-animation-shrink" style="width: 100%; max-width: 921px; height: auto; display: block; margin: 0 auto;">
            </a>
        @else
            <a href="https://www.amazon.in/" target="_blank">
                <img src="{{ asset('assets/images/Screenshot-2025-07-09-165446.png') }}" alt="Amazon Advertisement"
                    class="elementor-animation-shrink" style="display: block; margin: 0 auto;">
            </a>
        @endif
    </div>

    <!-- Magazine Section with Ticker & Subscription -->
    <section class="magazine-section py-5">
        <div class="container">

            <div class="row g-4 align-items-stretch">

                <!-- Left Content -->
                <div class="col-12 col-lg-9">

                    <div class="card border-0 shadow-sm h-100 rounded-4">

                        <div class="card-body p-4">

                            <!-- Top Content Row -->
                            <div class="row align-items-center g-4 mb-5">

                                <!-- Text Content -->
                                <div class="col-12 col-lg-6">

                                    <div class="magazine-text">

                                        <h3 class="fw-bold mb-3">
                                            {{ $settings['home_magazine_title'] }}
                                        </h3>

                                        {!! $settings['home_magazine_info_text'] !!}

                                        @if(!empty($settings['home_magazine_btn_text']))
                                        <a href="{{ $settings['home_magazine_btn_link'] }}" class="btn btn-primary rounded-pill px-4 mt-3">
                                            {{ $settings['home_magazine_btn_text'] }}
                                        </a>
                                        @endif

                                    </div>

                                </div>

                                <!-- Magazine Image -->
                                <div class="col-12 col-lg-6">

                                    <div class="magazine-image text-center">

                                        <img src="{{ asset($settings['home_magazine_image']) }}"
                                            alt="Magazine Cover" class="img-fluid rounded-4 shadow-sm">

                                    </div>

                                </div>

                            </div>

                            <!-- Subscription Plans -->
                            <div class="subscription-plans">

                                <h4 class="fw-bold mb-4">
                                    Subscription Plans
                                </h4>

                                @forelse($plans as $plan)
                                    <!-- Plan Item -->
                                    <div
                                        class="plan-item d-flex justify-content-between align-items-center border rounded-3 p-3 mb-3 flex-wrap gap-3">

                                        <div>
                                            <h6 class="mb-1">{{ $plan->name }}</h6>
                                            <small
                                                class="text-muted">{{ Str::limit($plan->description, 40) ?: ucfirst($plan->type) . ' Plan' }}</small>
                                        </div>

                                        <div class="text-lg-end">
                                            <strong class="d-block">₹{{ number_format($plan->price, 0) }} /
                                                {{ ucfirst($plan->billing_cycle) }}</strong>

                                            <a href="{{ route($plan->type === 'patrika' ? 'patrika-subscription' : 'advertisement-subscription') }}"
                                                class="btn btn-outline-primary btn-sm mt-2">
                                                Select
                                            </a>
                                        </div>

                                    </div>
                                @empty
                                    <div class="text-muted py-3">No active subscription plans available.</div>
                                @endforelse

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Right Sidebar -->
                <div class="col-12 col-lg-3">

                    <div class="card border-0 shadow-sm h-100 rounded-4">

                        <div class="card-body p-4 pb-0">
                            <!-- Magazines Section -->
                            <h3 class="section-title mb-4">
                                Magazines
                            </h3>
                            <div class="news-ticker-wrapper mb-2">
                                <div class="news-ticker">
                                    @forelse($magazines as $mag)
                                        <div class="news-item border-bottom pb-3 mb-3">
                                            <a href="{{ route('magazines.show', $mag->slug) }}" target="_blank" class="fw-semibold text-decoration-none d-block text-dark">
                                                {{ $mag->title }}
                                            </a>
                                            <small class="text-muted">
                                                Magazine · {{ $mag->magazine_date ? \Carbon\Carbon::parse($mag->magazine_date)->format('M Y') : ($mag->isFree() ? 'Free' : 'Premium') }}
                                            </small>
                                        </div>
                                    @empty
                                        <div class="text-center py-3">
                                            <p class="text-muted small mb-0">No magazines available.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="text-center mb-4">
                                <a href="{{ route('magazines.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-4">View All</a>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <!-- Latest Magazines -->
                            <h3 class="section-title mb-4">
                                E-Book
                            </h3>
                            <div class="news-ticker-wrapper mb-4">


                                <div class="news-ticker">

                                    <div class="news-item border-bottom pb-3 mb-3">

                                        <a href="#" class="fw-semibold text-decoration-none d-block">
                                            Jaiswal-Jagriti-Apr-Sept-2024
                                        </a>

                                        <small class="text-muted">
                                            Magazine · Apr-Sept-2024
                                        </small>

                                    </div>

                                    <div class="news-item border-bottom pb-3 mb-3">

                                        <a href="#" class="fw-semibold text-decoration-none d-block">
                                            Jaiswal-Jagriti-Oct-March-2024
                                        </a>

                                        <small class="text-muted">
                                            Magazine · Oct-March-2024
                                        </small>

                                    </div>

                                    <div class="news-item border-bottom pb-3 mb-3">

                                        <a href="#" class="fw-semibold text-decoration-none d-block">
                                            Jaiswal-Jagriti-July-Sept-2023
                                        </a>

                                        <small class="text-muted">
                                            Magazine · July-Sept-2023
                                        </small>

                                    </div>

                                    <div class="news-item border-bottom pb-3 mb-3">

                                        <a href="#" class="fw-semibold text-decoration-none d-block">
                                            Jaiswal-Jagriti-Apr-June-2023
                                        </a>

                                        <small class="text-muted">
                                            Magazine · Apr-June-2023
                                        </small>

                                    </div>

                                    <div class="news-item border-bottom pb-3 mb-3">

                                        <a href="#" class="fw-semibold text-decoration-none d-block">
                                            Jaiswal-Jagriti-Oct-March-2023
                                        </a>

                                        <small class="text-muted">
                                            Magazine · Oct-March-2023
                                        </small>

                                    </div>

                                    <div class="news-item">

                                        <a href="#" class="fw-semibold text-decoration-none d-block">
                                            Jaiswal-Jagriti-Jul-Sep-2022
                                        </a>

                                        <small class="text-muted">
                                            Magazine · Jul-Sep-2022
                                        </small>

                                    </div>

                                </div>

                            </div>

                            <!-- Advertisement -->
                            <div class="amazon-ad text-center">
                                @if(isset($sidebarAd) && $sidebarAd)
                                    <a href="{{ $sidebarAd->link ?? '#' }}" target="_blank">
                                        <img src="{{ asset($sidebarAd->image_path) }}" alt="Advertisement"
                                            class="img-fluid rounded-4 shadow-sm" style="width: 100%; max-width: 225px; height: auto;">
                                    </a>
                                @else
                                    <img src="{{ asset('assets/images/39912615.jpg') }}" alt="Advertisement"
                                        class="img-fluid rounded-4 shadow-sm">
                                @endif
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- Matrimony Section -->
    <section>
        <div class="container-custom">
            <div class="section-title">
                <h2>Matrimony</h2>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-img" style="flex:1"><img
                        src="{{ asset('assets/images/IMG-20250704-WA0010.webp') }}" alt="Couple"></div>
                <div style="flex:1">
                    <i class="fas fa-quote-left" style="font-size: 40px; color:#F80136; opacity:0.4;"></i>
                    <p style="font-style:italic; font-size: 18px; margin-top: 10px;">"Soumya Sankar and Arjun Madhu, a
                        happy-go-lucky couple connected with each other through Jaiswal Matrimony. A match made in
                        heaven!"</p>
                    <h4 style="margin-top: 15px;">- Soumya Sankar & Arjun Madhu</h4>
                    <a href="#" class="btn-primary" style="margin-top: 20px; display: inline-block;">Find your
                        life partner →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Spiritual Yatra -->
    <section style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); padding: 60px 0;">
        <div class="container-custom">
            <div class="section-title">
                <h2 style="color: black;">SPIRITUAL YATRA</h2>
            </div>
            
            @if($spiritualYatras->count() > 0)
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
                    @foreach($spiritualYatras as $yatra)
                        <div class="card-mini" style="background:#fff; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.05); padding-bottom:15px; overflow:hidden;">
                            <img src="{{ $yatra->thumbnail ? asset($yatra->thumbnail) : asset('assets/images/placeholder.jpg') }}"
                                style="width:100%; height: 180px; object-fit:cover;" alt="{{ $yatra->title }}">
                            <div style="padding: 15px;">
                                <h4 style="margin: 0 0 10px 0; color:#333;">{{ $yatra->title }}</h4>
                                <a href="{{ route('spiritual-yatras.show', $yatra->slug) }}" style="color:#f80136; font-weight:bold; text-decoration:none;">Read More →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div style="text-align: center; margin-top: 40px;">
                    <a href="{{ route('spiritual-yatras.index') }}" class="btn-primary">Show More</a>
                </div>
            @else
                <div class="text-center py-5">
                    <p style="color: rgba(255,255,255,0.7);">No spiritual yatras found at the moment.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- UPCOMING EVENTS -->
    <section>
        <div class="container-custom">
            <div class="section-title">
                <h2>UPCOMING EVENTS</h2>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 30px;">
                @forelse($events as $event)
                <div class="card-mini">
                    <img src="{{ $event->thumbnail ? asset($event->thumbnail) : asset('assets/images/placeholder.jpg') }}"
                        style="width:100%; border-radius: 12px; height: 180px; object-fit:cover;" alt="{{ $event->title }}">
                    <h4>{{ $event->title }}</h4>
                    <a href="{{ route('events-details', $event->slug) }}">Read More</a>
                </div>
                @empty
                <div class="card-mini">
                    <img src="{{ asset('assets/images/b03dc7d5-16a5-42ac-a693-115b7676d08d-e1755596675672-400x300.jpg') }}"
                        style="width:100%; border-radius: 12px; height: 180px; object-fit:cover;">
                    <h4>Anand Samaroh</h4><a href="#">Read More</a>
                </div>
                <div class="card-mini"><img src="{{ asset('assets/images/Screenshot_1-400x300.png') }}"
                        style="width:100%; border-radius: 12px; height: 180px; object-fit:cover;">
                    <h4>सृजन सर्व समाज सामूहिक विवाह सम्मेलन</h4><a href="#">Read More</a>
                </div>
                <div class="card-mini">
                    <img src="{{ asset('assets/images/dikshant-24-400x300.jpg') }}"
                        style="width:100%; border-radius: 12px; height: 180px; object-fit:cover;">
                    <h4>Dikshant Samaroh Celebration 2024</h4>
                    <a href="#">Read More</a>
                </div>

                <div class="card-mini">
                    <img src="{{ asset('assets/images/banner-3-400x300.png') }}"
                        style="width:100%; border-radius: 12px; height: 180px; object-fit:cover;">
                    <h4>Rajat Jayanti Samaroh 2016</h4>
                    <a href="#">Read More</a>
                </div>
                @endforelse
            </div>
            <div style="text-align: center; margin-top: 40px;"><a href="{{ route('events') }}" class="btn-primary">Show More</a>
            </div>
        </div>
    </section>

    <!-- Jobs & Education -->
    <section>
        <div class="container-custom">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
                <div>
                    <div class="section-title" style="margin-bottom: 20px;">
                        <h2>JOBS</h2>
                    </div>
                    @forelse($jobListings as $job)
                        <div class="card-mini">
                            <a href="{{ $job->link_type === 'internal' ? route('job.show', $job->id) : $job->link }}" @if($job->link_type === 'external') target="_blank" @endif>
                                <strong>{{ $job->title }}</strong>
                            </a>
                            @if($job->description)
                                <div>{{ Str::limit(strip_tags($job->description), 60) }}</div>
                            @endif
                        </div>
                    @empty
                        <div class="card-mini text-muted">No jobs available at the moment.</div>
                    @endforelse
                    <a href="{{ route('job') }}" class="btn-outline" style="margin-top: 20px;">More Jobs →</a>
                </div>
                <div>
                    <div class="section-title" style="margin-bottom: 20px;">
                        <h2>Education</h2>
                    </div>
                    <div class="card-mini"><a href="#">Official NCERT</a></div>
                    <div class="card-mini"><a href="#">E-Pathshala</a></div>
                    <div class="card-mini"><a href="#">DIKSHA Portal</a></div>
                    <div class="card-mini"><a href="#">CBSE Academic</a></div>
                    <div class="card-mini"><a href="#">NTA (National Testing Agency)</a></div>
                    <div class="card-mini"><a href="#">SWAYAM</a></div>
                    <a href="#" class="btn-outline" style="margin-top: 20px;">Explore Resources →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section>
        <div class="container-custom">
            <div class="section-title">
                <h2>Gallery</h2>
            </div>
            <div class="gallery-grid">
                @forelse($galleryImages as $image)
                    <img src="{{ asset($image->image_path) }}" alt="{{ $image->title ?? 'Gallery Image' }}">
                @empty
                    <p class="text-muted text-center w-100" style="grid-column: 1 / -1; padding: 20px;">No gallery images found.</p>
                @endforelse
            </div>
            <div style="text-align: center; margin-top: 40px;"><a href="{{ route('gallery') }}" class="btn-primary">Show More</a>
            </div>
        </div>
    </section>

@endsection
