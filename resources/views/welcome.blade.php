<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Jaiswal Jagriti Family | United for Progress</title>
    <meta name="description" content="Official platform for Jaiswal Jagriti Family - Magazine, Events, Matrimony, Jobs, Spiritual Yatra, and Community Upliftment.">
    <meta name="theme-color" content="#F80136">
    <!-- Google Fonts + Base Reset -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <!-- Font Awesome 6 (free) -->
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
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #1F2937;
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        /* custom container */
        .container-custom {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
        }

        section {
            padding: 60px 0;
        }

        /* header */
        .top-bar {
            background: #1F2937;
            color: #fff;
            padding: 8px 0;
            font-size: 14px;
        }

        .top-bar .flex-between {
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
        }

        .main-header {
            background: white;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
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
        }

        .nav-links {
            display: flex;
            gap: 28px;
            list-style: none;
            flex-wrap: wrap;
        }

        .nav-links a {
            text-decoration: none;
            font-weight: 500;
            color: #1F2937;
            transition: 0.2s;
        }

        .nav-links a:hover, .nav-links a.active {
            color: #F80136;
        }

        /* hero slider */
        .hero-slider {
            width: 100%;
            overflow: hidden;
        }

        .swiper-slide {
            height: 500px;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            background-color: #2d2d2d;
        }

        /* category grid */
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
            width: 70px;
            height: 3px;
            background: #F80136;
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
        }

        .category-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 40px;
            margin-top: 20px;
        }

        .category-card {
            text-align: center;
            width: 110px;
            transition: transform 0.2s;
        }

        .category-card img {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            border: 2px solid #fff;
        }

        .category-card:hover {
            transform: translateY(-6px);
        }

        /* info dual column */
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

        /* Magazine section */
        .magazine-section {
            background: #F9FAFB;
        }

        .magazine-grid {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
            align-items: center;
        }

        .magazine-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0,0,0,0.05);
            transition: 0.2s;
        }

        .ticker-box {
            background: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            max-height: 380px;
            overflow-y: auto;
        }

        .ticker-item {
            border-bottom: 1px solid #E5E7EB;
            padding: 12px 0;
        }

        .ticker-item a {
            text-decoration: none;
            font-weight: 600;
            color: #1F2937;
        }

        .ticker-item a:hover {
            color: #F80136;
        }

        /* testimonials */
        .testimonial-slider {
            background: #FEF2F2;
        }

        /* job/edu cards */
        .card-mini {
            background: white;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: 0.2s;
        }

        .card-mini:hover {
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        .footer {
            background: #111827;
            color: #9CA3AF;
            padding: 48px 0 24px;
        }

        .footer a {
            color: #D1D5DB;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .nav-links {
                gap: 16px;
                justify-content: center;
            }
            .info-row {
                flex-direction: column;
            }
            .swiper-slide {
                height: 320px;
            }
        }
    </style>
</head>
<body>

<!-- Top Bar -->
<div class="top-bar">
    <div class="container-custom">
        <div class="flex-between" style="display: flex; justify-content: space-between; align-items: center;">
            <div class="top-contact">
                <span><i class="fas fa-phone-alt"></i> +91 98681 05658</span>
                <span><i class="fas fa-envelope"></i> jaiswaljagrity@gmail.com</span>
            </div>
            <div class="marquee-text">
                <i class="fas fa-hand-peace"></i> Together for Progress, Together for Jaiswal Society
            </div>
        </div>
    </div>
</div>

<!-- Main Header -->
<div class="main-header">
    <div class="container-custom" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
        <div class="logo-area">
            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 300 70'%3E%3Crect width='300' height='70' fill='%23F80136' rx='10'/%3E%3Ctext x='15' y='45' fill='white' font-size='26' font-weight='bold' font-family='Inter'%3EJaiswal Jagriti%3C/text%3E%3C/svg%3E" alt="Jaiswal Jagriti Logo" style="max-height: 70px;">
        </div>
        <div style="display: flex; gap: 15px;">
            <a href="#" class="btn-primary"><i class="fas fa-user-plus"></i> Member Login</a>
            <a href="#" class="btn-primary" style="background: #0F172A;"><i class="fas fa-donate"></i> Donate Now</a>
        </div>
    </div>
</div>

<!-- Navigation -->
<div class="navbar">
    <div class="container-custom">
        <ul class="nav-links">
            <li><a href="#" class="active">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Matrimony</a></li>
            <li><a href="#">Jobs & Careers</a></li>
            <li><a href="#">Youth Wing</a></li>
            <li><a href="#">Executive Body</a></li>
            <li><a href="#">Events</a></li>
            <li><a href="#">Magazine</a></li>
            <li><a href="#">Gallery</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </div>
</div>

<!-- Hero Swiper -->
<div class="hero-slider">
    <div class="swiper heroSwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide" style="background-image: linear-gradient(0deg, rgba(0,0,0,0.5), rgba(0,0,0,0.2)), url('https://picsum.photos/id/104/1600/500'); background-size: cover;"></div>
            <div class="swiper-slide" style="background-image: linear-gradient(0deg, rgba(0,0,0,0.5), rgba(0,0,0,0.2)), url('https://picsum.photos/id/30/1600/500');"></div>
            <div class="swiper-slide" style="background-image: linear-gradient(0deg, rgba(0,0,0,0.5), rgba(0,0,0,0.2)), url('https://picsum.photos/id/26/1600/500');"></div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>

<!-- Welcome + Category Quick Access -->
<section>
    <div class="container-custom">
        <div class="section-title">
            <h2>Welcome to Jaiswal Jagriti Family</h2>
        </div>
        <div class="category-grid">
            <div class="category-card"><a href="#"><img src="https://picsum.photos/id/20/110/110" alt="Matrimony"><p>Matrimony</p></a></div>
            <div class="category-card"><a href="#"><img src="https://picsum.photos/id/21/110/110" alt="Jobs"><p>Jobs & Careers</p></a></div>
            <div class="category-card"><a href="#"><img src="https://picsum.photos/id/22/110/110" alt="Events"><p>Events</p></a></div>
            <div class="category-card"><a href="#"><img src="https://picsum.photos/id/23/110/110" alt="Magazine"><p>Magazine</p></a></div>
            <div class="category-card"><a href="#"><img src="https://picsum.photos/id/24/110/110" alt="Spiritual"><p>Spiritual Yatra</p></a></div>
            <div class="category-card"><a href="#"><img src="https://picsum.photos/id/25/110/110" alt="Education"><p>Education</p></a></div>
        </div>

        <div class="info-row" style="margin-top: 60px;">
            <div class="info-text">
                <h3 style="font-size: 28px; margin-bottom: 20px;">A Legacy of Unity & Progress</h3>
                <p style="line-height: 1.6;">The Jaiswal Jagriti Family is a socially driven, culturally rich community working towards the upliftment and unity of the Jaiswal society. Founded in 1994, the flagship 'Jaiswal Jagriti' magazine has been a powerful voice for awareness, progress, and collective identity. Through cultural fests, women empowerment, youth leadership, and spiritual yatras, we connect Jaiswals across generations with pride and purpose.</p>
                <a href="#" class="btn-primary" style="margin-top: 24px; display: inline-block;">Know More <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="info-img">
                <img src="https://picsum.photos/id/101/600/400" alt="Community Event">
            </div>
        </div>
    </div>
</section>

<!-- Magazine & Subscription Section -->
<section class="magazine-section">
    <div class="container-custom">
        <div class="section-title"><h2>Jaiswal Jagriti Magazine</h2></div>
        <div class="magazine-grid">
            <div class="magazine-card" style="flex:1;">
                <img src="https://picsum.photos/id/12/400/500" alt="Magazine Cover" style="width:100%; border-radius: 16px 16px 0 0;">
                <div style="padding: 20px;">
                    <h4>April - Sept 2024 Edition</h4>
                    <p>Continuing our legacy of awareness & social responsibility.</p>
                    <a href="#" class="btn-primary" style="margin-top: 12px;">Subscribe Now</a>
                </div>
            </div>
            <div style="flex: 1;">
                <div class="ticker-box">
                    <h4><i class="fas fa-newspaper"></i> Recent Magazines</h4>
                    <div class="ticker-item"><a href="#">📘 Jaiswal Jagriti Apr-Sept 2024</a><div class="news-meta" style="font-size:12px; color:#6B7280;">Magazine</div></div>
                    <div class="ticker-item"><a href="#">📘 Jaiswal Jagriti Oct-March 2024</a></div>
                    <div class="ticker-item"><a href="#">📘 Jaiswal Jagriti July-Sept 2023</a></div>
                    <div class="ticker-item"><a href="#">📘 Jaiswal Jagriti Apr-June 2023</a></div>
                    <div class="ticker-item"><a href="#">📘 25th Silver Jubilee Special</a></div>
                </div>
                <div style="margin-top: 30px;">
                    <h4>Subscription Plans</h4>
                    <div style="background: white; border-radius: 20px; padding: 16px; margin-top: 15px;">
                        <p><strong>📖 Annual Magazine</strong> – ₹999/year</p>
                        <p><strong>🌟 3 Years Plan</strong> – ₹9,999</p>
                        <p><strong>🏆 Lifetime (7 Years)</strong> – ₹99,999</p>
                        <p><strong>📢 Advertisement Subscription</strong> – ₹1,200 + ₹100/month</p>
                        <a href="#" class="btn-outline" style="margin-top: 15px; display: inline-block;">Select Plan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- matrimony testimonial snippet -->
<section>
    <div class="container-custom">
        <div class="section-title"><h2>Matrimony - Find Your Life Partner</h2></div>
        <div style="display: flex; flex-wrap: wrap; gap: 30px; align-items: center; background: #FEF9F9; padding: 30px; border-radius: 28px;">
            <div style="flex:1"><img src="https://picsum.photos/id/60/400/300" style="border-radius: 24px; width:100%;"></div>
            <div style="flex:1"><i class="fas fa-quote-left" style="font-size: 40px; color:#F80136; opacity:0.4;"></i><p style="font-style:italic; font-size: 18px;">"Millions have found their life partner at Jaiswal Jagriti matrimony! Soumya & Arjun connected through our platform and built a beautiful journey together."</p><h4 style="margin-top: 15px;">- Soumya Sankar & Arjun Madhu</h4><a href="#" class="btn-primary" style="margin-top: 20px; display: inline-block;">Find your partner →</a></div>
        </div>
    </div>
</section>

<!-- Spiritual Yatra & Upcoming Events combined grid -->
<section>
    <div class="container-custom">
        <div class="section-title"><h2>Spiritual Yatra & Events</h2></div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
            <div class="card-mini"><img src="https://picsum.photos/id/33/280/180" style="width:100%; border-radius: 12px;"><h4 style="margin: 12px 0;">Ayodhya Ram Mandir Yatra</h4><p>Spiritual journey to Ram Janmabhoomi</p><a href="#">Read More →</a></div>
            <div class="card-mini"><img src="https://picsum.photos/id/34/280/180" style="width:100%; border-radius: 12px;"><h4>Khatu Shyam Mandir, Rajasthan</h4><p>Divine experience at Shree Khatu Shyam Ji</p><a href="#">Read More →</a></div>
            <div class="card-mini"><img src="https://picsum.photos/id/35/280/180" style="width:100%; border-radius: 12px;"><h4>Anand Samaroh 2025</h4><p>Grand celebration & cultural fest</p><a href="#">More Details</a></div>
            <div class="card-mini"><img src="https://picsum.photos/id/36/280/180" style="width:100%; border-radius: 12px;"><h4>Dikshant Samaroh 2024</h4><p>Felicitating young achievers</p><a href="#">Register Now</a></div>
        </div>
        <div style="text-align: center; margin-top: 40px;"><a href="#" class="btn-primary">View All Events</a></div>
    </div>
</section>

<!-- Jobs & Education double section -->
<section style="background: #F3F4F6;">
    <div class="container-custom">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
            <div>
                <div class="section-title" style="margin-bottom: 20px;"><h2>🔥 Job Openings</h2></div>
                <div class="card-mini"><a href="#"><strong>UP Police SI Recruitment 2025</strong></a><div>Apply for 4543 Sub Inspector Posts</div></div>
                <div class="card-mini"><a href="#"><strong>BSF HC RO / RM Recruitment 2025</strong></a></div>
                <div class="card-mini"><a href="#"><strong>IBPS Clerk 15th Recruitment 2025</strong></a></div>
                <div class="card-mini"><a href="#"><strong>SBI Clerk 2025</strong></a></div>
                <a href="#" class="btn-outline" style="margin-top: 20px;">More Jobs →</a>
            </div>
            <div>
                <div class="section-title" style="margin-bottom: 20px;"><h2>📚 Education Portals</h2></div>
                <div class="card-mini"><a href="#">Official NCERT</a></div>
                <div class="card-mini"><a href="#">E-Pathshala (e-learning)</a></div>
                <div class="card-mini"><a href="#">DIKSHA Platform</a></div>
                <div class="card-mini"><a href="#">CBSE Academic</a></div>
                <div class="card-mini"><a href="#">NTA (National Testing Agency)</a></div>
                <a href="#" class="btn-outline" style="margin-top: 20px;">Explore Resources →</a>
            </div>
        </div>
    </div>
</section>

<!-- Gallery preview -->
<section>
    <div class="container-custom">
        <div class="section-title"><h2>Moments Gallery</h2></div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px;">
            <img src="https://picsum.photos/id/29/400/300" style="border-radius: 20px; width:100%; height: 220px; object-fit:cover;">
            <img src="https://picsum.photos/id/43/400/300" style="border-radius: 20px; width:100%; height: 220px; object-fit:cover;">
            <img src="https://picsum.photos/id/58/400/300" style="border-radius: 20px; width:100%; height: 220px; object-fit:cover;">
            <img src="https://picsum.photos/id/55/400/300" style="border-radius: 20px; width:100%; height: 220px; object-fit:cover;">
        </div>
        <div style="text-align: center; margin-top: 40px;"><a href="#" class="btn-primary">Show More</a></div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container-custom">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 40px;">
            <div><h4 style="color:white;">Jaiswal Jagriti</h4><p>Uniting the community since 1994, fostering culture, careers, and social harmony.</p></div>
            <div><h4 style="color:white;">Quick Links</h4><ul style="list-style:none; line-height: 2;"><li><a href="#">Home</a></li><li><a href="#">About</a></li><li><a href="#">Matrimony</a></li><li><a href="#">Job Listings</a></li><li><a href="#">Events</a></li></ul></div>
            <div><h4 style="color:white;">Get in Touch</h4><p><i class="fas fa-map-marker-alt"></i> Delhi, India</p><p><i class="fas fa-phone"></i> +91 9868105658</p><p><i class="fas fa-envelope"></i> jaiswaljagrity@gmail.com</p></div>
            <div><h4 style="color:white;">Follow Us</h4><div style="display: flex; gap: 20px;"><i class="fab fa-facebook-f fa-lg"></i><i class="fab fa-instagram fa-lg"></i><i class="fab fa-youtube fa-lg"></i><i class="fab fa-twitter fa-lg"></i></div></div>
        </div>
        <hr style="margin: 30px 0; border-color:#374151;">
        <p style="text-align: center;">© 2025 Jaiswal Jagriti Family. All rights reserved. | Together for Progress</p>
    </div>
</footer>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper('.heroSwiper', {
        loop: true,
        autoplay: { delay: 4000, disableOnInteraction: false },
        pagination: { el: '.swiper-pagination', clickable: true },
        navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
    });
    // smooth scroll for all anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
        });
    });
</script>
</body>
</html>
