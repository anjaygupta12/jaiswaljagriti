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
                <h2>Welcome to Jaiswal Jagriti Family</h2>
            </div>
            <div class="category-grid">
                <a href="#" class="category-card">
                    <img src="{{ asset('assets/images/IMG-20250704-WA0010.webp') }}" alt="Matrimony">
                    <p>Matrimony →</p>
                </a>

                <a href="#" class="category-card">
                    <img src="{{ asset('assets/images/3688609.png') }}" alt="Jobs">
                    <p>Jobs & Careers →</p>
                </a>

                <a href="#" class="category-card">
                    <img src="{{ asset('assets/images/download.jpeg') }}" alt="Events">
                    <p>Events →</p>
                </a>

                <a href="#" class="category-card">
                    <img src="{{ asset('assets/images/Screenshot-2025-07-09-171638.png') }}" alt="Magazine">
                    <p>Magazine →</p>
                </a>

                <a href="#" class="category-card">
                    <img src="{{ asset('assets/images/Begin-Spiritual-Journey-with-a-Chardham-Yatra-from-Bangalore.webp') }}"
                        alt="Spiritual">
                    <p>Spiritual Yatra →</p>
                </a>

                <a href="#" class="category-card">
                    <img src="{{ asset('assets/images/images-removebg-preview.png') }}" alt="Education">
                    <p>Education →</p>
                </a>
            </div>

            <div class="info-row" style="margin-top: 60px;">
                <div class="info-text">
                    <h3 style="font-size: 28px; margin-bottom: 20px;">Fostering Culture & Unity</h3>
                    <p style="line-height: 1.6;">The <em>Jaiswal Jagriti Family</em> is a socially driven, culturally
                        rich community that has been continuously working towards the upliftment and unity of the
                        Jaiswal society. Founded on principles of awareness, progress, and collective identity, the
                        family operates through its flagship initiative, the <em>'Jaiswal Jagriti'</em>
                        magazine—launched in 1994—which serves as a voice for the community. Through regular
                        publications, cultural events, youth engagement, women empowerment, and social responsibility
                        programs, the Jaiswal Jagriti Family has emerged as a unifying force, connecting Jaiswals across
                        regions and generations with pride, purpose, and progress.</p>
                    <a href="#" class="btn-primary" style="margin-top: 24px; display: inline-block;">Know More <i
                            class="fas fa-arrow-right"></i></a>
                </div>
                <div class="info-img">
                    <img src="{{ asset('assets/images/sj4.jpg') }}" alt="Community Event">
                </div>
            </div>
        </div>
    </section>

    <!-- Amazon Advertisement Section -->
    <div class="container-custom amazon-ad">
        <a href="https://www.amazon.in/" target="_blank">
            <img src="{{ asset('assets/images/Screenshot-2025-07-09-165446.png') }}" alt="Amazon Advertisement"
                class="elementor-animation-shrink">
        </a>
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
                                            Jaiswal Jagriti Magazine
                                        </h3>

                                        <p class="text-muted">
                                            It was only natural that to give shape to our objectives,
                                            we needed a mouthpiece. Hence, in April 1994,
                                            the quarterly magazine titled
                                            <em>‘Jaiswal Jagriti’</em> was launched at a grand
                                            cultural event held in the National Museum in Delhi.
                                        </p>

                                        <p class="text-muted">
                                            Since then, this magazine has been published regularly
                                            and continues to gain popularity with social responsibility
                                            and awareness.
                                        </p>

                                        <a href="#" class="btn btn-primary rounded-pill px-4">
                                            Subscribe Now
                                        </a>

                                    </div>

                                </div>

                                <!-- Magazine Image -->
                                <div class="col-12 col-lg-6">

                                    <div class="magazine-image text-center">

                                        <img src="{{ asset('assets/images/Screenshot-2025-07-09-171638.png') }}"
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

                                <img src="{{ asset('assets/images/39912615.jpg') }}" alt="Advertisement"
                                    class="img-fluid rounded-4 shadow-sm">

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
    <section style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);">
        <div class="container-custom">
            <div class="section-title">
                <h2 style="color: white;">SPIRITUAL YATRA</h2>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
                <div class="card-mini">
                    <img src="{{ asset('assets/images/Govind-Dev-Ji-Temple-Jaipur-400x300.jpg') }}"
                        style="width:100%; border-radius: 12px; height: 180px; object-fit:cover;">
                    <h4 style="margin: 12px 0;">A Journey Govind Dev Ji, Jaipur</h4><a href="#">Read More →</a>
                </div>
                <div class="card-mini"><img src="{{ asset('assets/images/image-3-1024x768-1-e1755594836425-400x300') }}"
                        style="width:100%; border-radius: 12px; height: 180px; object-fit:cover;">
                    <h4>Sawariya Seth Nandir, Chittorgarh</h4><a href="#">Read More →</a>
                </div>
                <div class="card-mini">
                    <img src="{{ asset('assets/images/Untitled-design-33-400x300.png') }}"
                        style="width:100%; border-radius: 12px; height: 180px; object-fit:cover;">
                    <h4>A Journey To Ayodhya Ram Mandir</h4><a href="#">Read More →</a>
                </div>
                <div class="card-mini"><img
                        src="{{ asset('assets/images/14_11_2022-khatushyam-e1755594120876-400x300.jpg') }}"
                        style="width:100%; border-radius: 12px; height: 180px; object-fit:cover;">
                    <h4>Shree Khatu Shyam Mandir, Sikar</h4><a href="#">Read More →</a>
                </div>
            </div>
            <div style="text-align: center; margin-top: 40px;"><a href="#" class="btn-primary">Show More</a>
            </div>
        </div>
    </section>

    <!-- UPCOMING EVENTS -->
    <section>
        <div class="container-custom">
            <div class="section-title">
                <h2>UPCOMING EVENTS</h2>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 30px;">
                <div class="card-mini"><img
                        src="{{ asset('assets/images/b03dc7d5-16a5-42ac-a693-115b7676d08d-e1755596675672-400x300.jpg') }}"
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
            </div>
            <div style="text-align: center; margin-top: 40px;"><a href="#" class="btn-primary">Show More</a>
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
                    <div class="card-mini"><a href="#"><strong>UP Police SI Recruitment 2025</strong></a>
                        <div>Apply for 4543 Sub Inspector Posts</div>
                    </div>
                    <div class="card-mini"><a href="#"><strong>BSF HC RO / RM Recruitment 2025</strong></a>
                    </div>
                    <div class="card-mini"><a href="#"><strong>IBPS Clerk 15th Recruitment 2025</strong></a>
                    </div>
                    <div class="card-mini"><a href="#"><strong>SBI Clerk Recruitment 2025</strong></a></div>
                    <div class="card-mini"><a href="#"><strong>UKSSSC Various Post Apply Online</strong></a>
                    </div>
                    <a href="#" class="btn-outline" style="margin-top: 20px;">More Jobs →</a>
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
                <img src="{{ asset('assets/images/IMG-20250826-WA0008.jpg') }}" alt="Gallery">

                <img src="{{ asset('assets/images/IMG-20250826-WA0005.jpg') }}" alt="Gallery">

                <img src="{{ asset('assets/images/IMG-20250826-WA0004.jpg') }}" alt="Gallery">

                <img src="{{ asset('assets/images/IMG-20250826-WA0003.jpg') }}" alt="Gallery">

                <img src="{{ asset('assets/images/IMG-20250826-WA0007.jpg') }}" alt="Gallery">

                <img src="{{ asset('assets/images/IMG-20250826-WA0006.jpg') }}" alt="Gallery">
            </div>
            <div style="text-align: center; margin-top: 40px;"><a href="#" class="btn-primary">Show More</a>
            </div>
        </div>
    </section>

@endsection
