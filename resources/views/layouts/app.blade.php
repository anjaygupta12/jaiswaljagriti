<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jaiswal Jagriti Family | United for Progress</title>
    <meta name="description"
        content="Official platform for Jaiswal Jagriti Family - Magazine, Events, Matrimony, Jobs, Spiritual Yatra, and Community Upliftment.">
    <!-- Google Fonts + Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Rubik', sans-serif;
            background-color: #f2f2f2;
            color: #1F2937;
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        .container-custom {

            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
        }

        section {
            padding: 60px 0;
        }

        /* top bar */
        .top-bar {
            background: #1F2937;
            color: #fff;
            padding: 8px 0;
            font-size: 15px;
        }

        .flex-between {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .top-contact span {
            margin-right: 20px;
        }

        .top-contact i {
            margin-right: 6px;
            color: #F80136;
        }

        .marquee-text {
            font-weight: 500;
            letter-spacing: 0.3px;
            white-space: nowrap;
            overflow: hidden;
            animation: marquee 15s linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        /* header */
        .main-header {
            background: white;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            padding: 16px 0;
        }

        .logo-area img {
            max-height: 70px;
            width: auto;
        }

        .btn-primary {
            background: #F80136;
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary:hover {
            background: #c7002b;
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid #F80136;
            color: #F80136;
            padding: 8px 20px;
            border-radius: 40px;
            font-weight: 600;
            transition: 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline:hover {
            background: #F80136;
            color: white;
        }

     /* navbar */
.navbar {
    background: #fff;
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;
    position: sticky;
    top: 0;
    z-index: 100;
}

.btn-primary {
    color: #fff;
    background-color: #e36108!important;
    border-color: #db7b3a!important;
    /* border-radius: 40px!important; */
}
.btn-primary {
    border-radius: 0px!important;
}

.nav-links {
    display: flex;
    align-items: center;      /* vertically center items */
    justify-content: center;  /* optional: center horizontally */
    gap: 25px;
    list-style: none;
    flex-wrap: wrap;
    padding: 12px 0;
    margin: 0;
    min-height: 60px;         /* optional height */
}

.nav-links li {
    display: flex;
    align-items: center;      /* vertically center text inside li */
}

.nav-links a {
    text-decoration: none;
    font-weight: 500;
    color: #f4f9ff;
    transition: 0.2s;
    display: flex;
    align-items: center;
    height: 100%;
}

.nav-links a:hover,
.nav-links a.active {
    color: #000000;
}

        /* hero slider */
        .hero-slider {
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        .heroSwiper {
            width: 100%;
            height: 500px;
        }

        .swiper-slide {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        .swiper-slide::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.35);
        }

        /* section title */
        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title h2 {
            font-size: 32px;
            font-weight: 700;
            position: relative;
            display: inline-block;
        }

        .section-title h2:after {
            content: '';
            width: 80px;
            height: 3px;
            background: #F80136;
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
        }

        /* categories grid */
        .category-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 55px;
            margin-top: 20px;
        }

        .category-card {
            text-align: center;
            width: 110px;
            transition: transform 0.3s ease;
            text-decoration: none;
            color: #1F2937;
        }

        .category-card img {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid #eee;
            transition: transform 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-6px);
        }

        .category-card:hover img {
            transform: scale(1.08);
        }

        .category-card p {
            margin-top: 8px;
            font-weight: 500;
        }

        .info-row {
            display: flex;
            align-items: center;
            gap: 48px;
            flex-wrap: wrap;
        }

        .info-text {
            flex: 1;
        }

        .info-img {
            flex: 1;
        }

        .info-img img {
            width: 100%;
            border-radius: 20px;
        }

        /* Magazine Section - Original Style */
        .magazine-section {
            background: #F9FAFB;
        }

        .magazine-wrapper {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }

        .magazine-left {
            flex: 1;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .magazine-left img {
            width: 100%;
            border-radius: 20px 20px 0 0;
        }

        .magazine-left .content {
            padding: 24px;
        }

        .magazine-right {
            flex: 1;
        }

        /* News Ticker Box */
        .news-ticker-wrapper {
            background: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            height: 380px;
            overflow: hidden;
            position: relative;
        }

        .news-ticker {
            position: relative;
            animation: scrollUp 25s linear infinite;
        }

        .news-ticker-wrapper:hover .news-ticker {
            animation-play-state: paused;
        }

        @keyframes scrollUp {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-100%);
            }
        }

        .news-item {
            padding: 12px;
            border-bottom: 1px solid #E5E7EB;
            transition: background 0.3s ease;
        }

        .news-item:hover {
            background-color: #e0e0e0;
        }

        .news-item a {
            text-decoration: none;
            font-weight: 600;
            color: #1F2937;
            display: block;
        }

        .news-item a:hover {
            color: #F80136;
        }

        .news-meta {
            font-size: 12px;
            color: #777;
            margin-top: 4px;
        }

        /* Subscription Plans */
        .subscription-plans {
            background: white;
            border-radius: 20px;
            padding: 20px;
            margin-top: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .plan-item {
            padding: 12px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .plan-item:last-child {
            border-bottom: none;
        }

        .amazon-ad {
            margin: 20px 0;
            text-align: center;
        }

        .amazon-ad img {
            max-width: 100%;
            border-radius: 12px;
            transition: transform 0.3s ease;
        }

        .amazon-ad img:hover {
            transform: scale(1.02);
        }

        .testimonial-card {
            background: #FEF9F9;
            padding: 30px;
            border-radius: 28px;
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            align-items: center;
        }

        .testimonial-img img {
            border-radius: 24px;
            width: 100%;
            max-width: 300px;
        }

        .card-mini {
            background: white;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: 0.2s;
        }

        .card-mini:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .card-mini a {
            text-decoration: none;
            color: #1F2937;
            font-weight: 600;
        }

        .card-mini a:hover {
            color: #F80136;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .gallery-grid img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 20px;
            transition: 0.3s ease;
            cursor: pointer;
        }

        .gallery-grid img:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .footer {
            background: #111827;
            color: #9CA3AF;
            padding: 48px 0 24px;
        }

        .footer a {
            color: #D1D5DB;
            text-decoration: none;
            transition: 0.2s;
        }

        .footer a:hover {
            color: #F80136;
        }

        @media (max-width: 768px) {
            .nav-links {
                gap: 16px;
                justify-content: center;
            }

            .info-row {
                flex-direction: column;
            }

            .heroSwiper {
                height: 320px;
            }

            .magazine-wrapper {
                flex-direction: column;
            }

            .marquee-text {
                white-space: normal;
                animation: none;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .category-grid {
                gap: 25px;
            }

            .plan-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
        }
    </style>
    <!-- ALL CSS FILES -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/magnific-popup.min.css">

<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

<!-- Removed missing responsive.css -->

<link rel="stylesheet" href="{{ asset('assets/css/frontend.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/frontend.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/campaignDonorsBlockApp.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/base.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/variation_high_contrast.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/frontend_style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/woocommerce-layout.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/woocommerce-smallscreen.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/woocommerce.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/job-listings.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/frontend_62f4e5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/font-icon.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/give.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/foundation.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/header-footer-elementor.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/elementor-icons.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/post-5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/widget-image.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/widget-heading.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/e-animation-hang.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/widget-icon-list.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/post-3399.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/post-5496.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/subscription.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/chaty-front.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/widget-social-icons.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/brands.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/solid.css') }}">
<!-- Removed missing widget styles -->
<link rel="stylesheet" href="{{ asset('assets/css/frontend_4404d0.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/rtsb-fonts.css') }}">
<!-- Theme Style -->
<link rel="stylesheet" href="{{ asset('assets/css/quick-view.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/wishlist.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/compare.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/regular.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/solid.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/photoswipe.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/default-skin.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/general.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/roboto.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/robotoslab.css') }}">

<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:400,500,600,700,400&display=fallback">
    @stack('css')
</head>

<body>

    <!-- Top Bar -->
    @include('partials.top-bar')
    @include('partials.navigation')

@yield('content')
    <!-- Footer -->
    @include('partials.footer')
    <!-- ALL JS FILES -->

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // Initialize Swiper
        const swiper = new Swiper('.heroSwiper', {
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
        });


        // Active nav link
        const navLinks = document.querySelectorAll('.nav-links a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>

    @stack('js')
</body>

</html>
