@extends('layouts.app')

@section('title', 'Jaiswal Jagriti Family | Contact Us')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<style>
    .contact-page-wrapper {
        font-family: 'Outfit', sans-serif;
        background-color: #fafbfc;
        color: #1e293b;
        padding-bottom: 80px;
    }

    /* ---- Header ---- */
    .premium-page-header {
        position: relative;
        background-image: url('{{ asset($settings["contact_banner"]) }}');
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        padding: 100px 0 150px;
        text-align: center;
        overflow: hidden;
    }
    .premium-page-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(15,23,42,.45) 0%, rgba(227,97,8,.35) 100%);
        z-index: 1;
    }
    .premium-page-header-content {
        position: relative;
        z-index: 2;
    }
    .badge-premium {
        background: rgba(255,255,255,.25);
        backdrop-filter: blur(2px);
        color: #fff;
        padding: 6px 16px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        display: inline-block;
        margin-bottom: 15px;
        border: 1px solid rgba(255,255,255,.35);
    }
    .premium-page-header h1 {
        font-size: 52px;
        font-weight: 800;
        color: #fff;
        letter-spacing: -1px;
        margin-bottom: 12px;
        text-shadow: 0 4px 10px rgba(0,0,0,.2);
    }
    .premium-page-header p {
        font-size: 18px;
        color: rgba(255,255,255,.9);
        max-width: 600px;
        margin: 0 auto;
    }

    /* ---- Floating container ---- */
    .floating-cards-container {
        margin-top: -80px;
        position: relative;
        z-index: 10;
    }

    /* ---- Map ---- */
    .map-card-wrapper {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(15,23,42,.08);
        border: 1px solid rgba(15,23,42,.04);
        padding: 12px;
        overflow: hidden;
        margin-bottom: 50px;
        transition: transform .3s ease, box-shadow .3s ease;
    }
    .map-card-wrapper:hover { transform: translateY(-4px); box-shadow: 0 28px 50px rgba(15,23,42,.12); }
    .map-card-wrapper iframe { width:100%; height:460px; border:none; border-radius:16px; display:block; }

    /* ---- Contact info strip ---- */
    .contact-info-strip {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        background: #fff;
        border-radius: 20px;
        padding: 30px 35px;
        box-shadow: 0 10px 25px rgba(15,23,42,.06);
        border: 1px solid #f1f5f9;
        margin-bottom: 50px;
        align-items: center;
        justify-content: space-around;
    }
    .info-item {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 200px;
    }
    .info-icon {
        width: 46px; height: 46px;
        background: #fff4ed;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        color: #e36108;
        font-size: 18px;
        flex-shrink: 0;
    }
    .info-text label { display:block; font-size:11px; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:#94a3b8; margin-bottom:3px; }
    .info-text a, .info-text span { font-size:15px; font-weight:600; color:#1e293b; text-decoration:none; }
    .info-text a:hover { color:#e36108; }

    /* ---- Section title ---- */
    .modern-section-title { text-align:center; margin-bottom:45px; }
    .modern-section-title .badge-sub { color:#e36108; font-size:13px; font-weight:700; letter-spacing:2px; text-transform:uppercase; display:block; margin-bottom:10px; }
    .modern-section-title h2 { font-size:36px; font-weight:800; color:#0f172a; letter-spacing:-.5px; margin:0; }
    .modern-section-title p { font-size:16px; color:#64748b; max-width:680px; margin:14px auto 0; line-height:1.7; }

    /* ---- Executive card container ---- */
    .executive-card-container {
        background: #fff;
        border-radius: 28px;
        padding: 50px 40px;
        box-shadow: 0 15px 35px rgba(15,23,42,.05);
        border: 1px solid #f1f5f9;
        margin-bottom: 50px;
    }

    /* ---- Team grid ---- */
    .team-grid-modern {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
        margin-top: 35px;
    }
    @media(max-width:991px){ .team-grid-modern{ grid-template-columns: repeat(2,1fr); } }
    @media(max-width:600px) { .team-grid-modern{ grid-template-columns: 1fr; } }

    /* ---- Team card ---- */
    .team-card-modern {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,.05);
        transition: all .4s cubic-bezier(.16,1,.3,1);
        display: flex; flex-direction: column;
        text-align: center; padding: 30px 22px;
        height: 100%;
    }
    .team-card-modern:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(15,23,42,.1);
        border-color: rgba(227,97,8,.2);
    }
    .team-image-wrapper {
        width: 130px; height: 130px;
        margin: 0 auto 18px;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid #fff4ed;
        box-shadow: 0 4px 10px rgba(227,97,8,.12);
        transition: transform .4s ease;
    }
    .team-card-modern:hover .team-image-wrapper { transform: scale(1.06); }
    .team-image-wrapper img { width:100%; height:100%; object-fit:cover; object-position:center; }
    .team-placeholder { width:100%; height:100%; background:#f1f5f9; display:flex; align-items:center; justify-content:center; color:#94a3b8; }
    .team-card-modern h3 { font-size:19px; font-weight:700; color:#0f172a; margin-bottom:6px; }
    .team-designation-badge {
        display:inline-block; background:#fff4ed; color:#e36108;
        font-size:12px; font-weight:600; padding:4px 14px;
        border-radius:30px; margin-bottom:18px;
    }
    .team-contact-info { border-top:1px solid #f1f5f9; padding-top:18px; margin-top:auto; display:flex; flex-direction:column; gap:10px; }
    .team-info-link { display:flex; align-items:center; justify-content:center; gap:9px; color:#475569; text-decoration:none; font-size:13px; transition:color .2s; }
    .team-info-link i { color:#e36108; font-size:13px; width:18px; }
    .team-info-link:hover { color:#e36108; text-decoration:none; }

    /* ---- Contact form ---- */
    .contact-form-section {
        background: #fff;
        border-radius: 28px;
        padding: 50px;
        box-shadow: 0 20px 40px rgba(15,23,42,.06);
        border: 1px solid #f1f5f9;
        max-width: 900px;
        margin: 0 auto;
    }
    @media(max-width:576px){ .contact-form-section{ padding:28px 18px; } }

    .form-floating-custom { position:relative; margin-bottom:24px; }
    .form-floating-custom label { display:block; font-size:13px; font-weight:600; color:#475569; margin-bottom:7px; }
    .form-floating-custom input,
    .form-floating-custom textarea {
        width:100%; background:#f8fafc; border:2px solid #e2e8f0;
        border-radius:12px; padding:13px 17px; font-size:15px;
        color:#0f172a; font-weight:500;
        transition: all .3s cubic-bezier(.16,1,.3,1);
    }
    .form-floating-custom input:focus,
    .form-floating-custom textarea:focus {
        background:#fff; border-color:#e36108; outline:none;
        box-shadow: 0 0 0 4px rgba(227,97,8,.12);
    }
    .btn-submit-premium {
        background: linear-gradient(135deg,#e36108,#f97316) !important;
        border:none !important; color:#fff !important;
        padding:15px 40px !important; border-radius:14px !important;
        font-weight:700; font-size:16px; letter-spacing:.5px;
        transition: all .3s cubic-bezier(.16,1,.3,1);
        cursor:pointer; width:100%; display:flex; align-items:center; justify-content:center; gap:10px;
        box-shadow: 0 10px 20px rgba(227,97,8,.2);
    }
    .btn-submit-premium:hover { transform:translateY(-3px); box-shadow:0 15px 30px rgba(227,97,8,.35); }
    .btn-submit-premium:active { transform:translateY(-1px); }
</style>

<div class="contact-page-wrapper">

    {{-- ===== HEADER ===== --}}
    <header class="premium-page-header">
        <div class="premium-page-header-content container-custom">
            @if(!empty($settings['contact_banner_badge']))
            <span class="badge-premium">{{ $settings['contact_banner_badge'] }}</span>
            @else
            <span class="badge-premium">Get In Touch</span>
            @endif
            @if(!empty($settings['contact_banner_title']))
            <h1>{{ $settings['contact_banner_title'] }}</h1>
            @else
            <h1>Contact Us</h1>
            @endif
            @if(!empty($settings['contact_banner_subtitle']))
            <p>{{ $settings['contact_banner_subtitle'] }}</p>
            @else
            <p>Connect with Jaiswal Jagriti Family. Have inquiries, suggestions, or feedback? We'd love to hear from you.</p>
            @endif
        </div>
    </header>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="floating-cards-container container-custom">

        {{-- Google Map --}}
        <div class="map-card-wrapper">
            <iframe loading="lazy"
                    src="{{ $settings['contact_map_url'] }}"
                    title="Jaiswal Jagriti Location"
                    aria-label="Jaiswal Jagriti Location">
            </iframe>
        </div>

        {{-- Contact Info Strip --}}
        <div class="contact-info-strip">
            <div class="info-item">
                <div class="info-icon"><i class="fas fa-phone-alt"></i></div>
                <div class="info-text">
                    <label>Phone</label>
                    <a href="tel:{{ preg_replace('/\s+/', '', $settings['contact_phone']) }}">
                        {{ $settings['contact_phone'] }}
                    </a>
                </div>
            </div>
            <div class="info-item">
                <div class="info-icon"><i class="fas fa-envelope"></i></div>
                <div class="info-text">
                    <label>Email</label>
                    <a href="mailto:{{ $settings['contact_email'] }}">{{ $settings['contact_email'] }}</a>
                </div>
            </div>
            <div class="info-item">
                <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div class="info-text">
                    <label>Address</label>
                    <span style="white-space:pre-line;font-size:14px;">{{ $settings['contact_address'] }}</span>
                </div>
            </div>
        </div>

        {{-- ===== EXECUTIVE BODY ===== --}}
        <div class="executive-card-container">
            <div class="modern-section-title">
                <span class="badge-sub">National Executive Body (2025–2028)</span>
                <h2>About Jaiswal Jagriti</h2>
                <p>जायसवाल जागृति (भारत) की नई राष्ट्रीय कार्यकारिणी के अध्यक्ष, महासचिव और कोषाध्यक्ष के पदों के लिए आयोजित चुनाव के बाद वार्षिक आम सभा (एजीबीएम) की हुई बैठक के बाद निम्नलिखित निर्वाचित कार्यकारिणी का गठन किया गया है:-</p>
            </div>

            <div class="team-grid-modern">
                @forelse($executives as $member)
                    <article class="team-card-modern">
                        <div class="team-image-wrapper">
                            @if($member->image)
                                <img src="{{ asset($member->image) }}" alt="{{ $member->name }}">
                            @else
                                <div class="team-placeholder">
                                    <i class="fas fa-user fa-2x"></i>
                                </div>
                            @endif
                        </div>
                        <h3>{{ $member->name }}</h3>
                                @if($member->designation)
                                    <span class="team-designation-badge">{{ $member->designation }}</span>
                                @endif

                                @if($member->short_description)
                                    <p class="text-muted small px-2 mt-2 mb-0" style="line-height: 1.4;">{{ Str::limit($member->short_description, 80) }}</p>
                                @endif
                                
                                <div class="team-contact-info mt-3">
                            @if($member->phone)
                                <a href="tel:{{ preg_replace('/[\s\-\/]/', '', $member->phone) }}" class="team-info-link">
                                    <i class="fas fa-phone"></i>
                                    <span>{{ $member->phone }}</span>
                                </a>
                            @endif
                            @if($member->email)
                                <a href="mailto:{{ $member->email }}" class="team-info-link">
                                    <i class="fas fa-envelope"></i>
                                    <span>{{ $member->email }}</span>
                                </a>
                            @endif
                        </div>
                    </article>
                @empty
                    <div style="grid-column:1/-1; text-align:center; padding:40px 0; color:#94a3b8;">
                        <i class="fas fa-users fa-3x mb-3" style="display:block;"></i>
                        <p class="mb-0">Executive body members are being updated. Please check back soon.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ===== CONTACT FORM ===== --}}
        <section class="contact-form-section">
            <div class="modern-section-title mb-4">
                <span class="badge-sub">Write to Us</span>
                <h2>Send Us a Message</h2>
                <p>Send your queries or comments directly to our team. We'll respond as soon as possible.</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert"
                     style="border-radius:12px;font-weight:500;">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert"
                     style="border-radius:12px;font-weight:500;">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating-custom">
                            <label for="name">Your Name <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name"
                                   value="{{ old('name') }}" placeholder="e.g. Manoj Jaiswal" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating-custom">
                            <label for="email">Email Address <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email"
                                   value="{{ old('email') }}" placeholder="e.g. name@domain.com" required>
                        </div>
                    </div>
                </div>
                <div class="form-floating-custom">
                    <label for="subject">Subject <span class="text-danger">*</span></label>
                    <input type="text" id="subject" name="subject"
                           value="{{ old('subject', request('subject')) }}" placeholder="What is this regarding?" required>
                </div>
                <div class="form-floating-custom">
                    <label for="message">Message <span class="text-danger">*</span></label>
                    <textarea id="message" name="message" rows="6"
                              placeholder="Type your message here..." required>{{ old('message') }}</textarea>
                </div>

                <div class="form-floating-custom text-center d-flex justify-content-center mb-4">
                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI') }}"></div>
                </div>

                <button type="submit" class="btn-submit-premium">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>
            </form>
        </section>

    </main>
</div>
@endsection
