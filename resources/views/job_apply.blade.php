@extends('layouts.app')

@section('title', 'Apply for ' . $jobListing->title)

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<style>
    .apply-page-wrapper {
        font-family: 'Outfit', sans-serif;
        background-color: #fafbfc;
        color: #1e293b;
        padding-bottom: 80px;
    }

    /* ---- Header ---- */
    .premium-page-header {
        position: relative;
        background-color: #0f172a;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        padding: 100px 0 100px;
        text-align: center;
        overflow: hidden;
    }
    .premium-page-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(15,23,42,.85) 0%, rgba(227,97,8,.75) 100%);
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
        font-size: 42px;
        font-weight: 800;
        color: #fff;
        letter-spacing: -1px;
        margin-bottom: 12px;
        text-shadow: 0 4px 10px rgba(0,0,0,.2);
    }

    /* ---- Application form ---- */
    .apply-form-section {
        background: #fff;
        border-radius: 28px;
        padding: 50px;
        box-shadow: 0 20px 40px rgba(15,23,42,.06);
        border: 1px solid #f1f5f9;
        max-width: 800px;
        margin: -50px auto 0;
        position: relative;
        z-index: 10;
    }
    @media(max-width:576px){ .apply-form-section{ padding:28px 18px; margin-top: -30px; } }

    .form-floating-custom { position:relative; margin-bottom:24px; }
    .form-floating-custom label { display:block; font-size:13px; font-weight:600; color:#475569; margin-bottom:7px; }
    .form-floating-custom input,
    .form-floating-custom input[type="file"] {
        width:100%; background:#f8fafc; border:2px solid #e2e8f0;
        border-radius:12px; padding:13px 17px; font-size:15px;
        color:#0f172a; font-weight:500;
        transition: all .3s cubic-bezier(.16,1,.3,1);
    }
    .form-floating-custom input:focus {
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

<div class="apply-page-wrapper">

    {{-- ===== HEADER ===== --}}
    <header class="premium-page-header">
        <div class="premium-page-header-content container-custom">
            <span class="badge-premium">Job Application</span>
            <h1>{{ $jobListing->title }}</h1>
        </div>
    </header>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="container-custom">
        <section class="apply-form-section">
            <h3 class="mb-4 text-center">Submit Your Application</h3>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="border-radius:12px;font-weight:500;">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius:12px;font-weight:500;">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('job.apply.store', $jobListing) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating-custom">
                            <label for="email">Email Address <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" placeholder="e.g. name@domain.com" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating-custom">
                            <label for="phone">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="e.g. 9876543210" required>
                        </div>
                    </div>
                </div>

                <div class="form-floating-custom">
                    <label for="resume">Upload Resume (PDF, DOC, DOCX) <span class="text-danger">*</span></label>
                    <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" required>
                </div>

                <div class="form-floating-custom text-center d-flex justify-content-center">
                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI') }}"></div>
                </div>

                <button type="submit" class="btn-submit-premium mt-3">
                    <i class="fas fa-paper-plane"></i> Submit Application
                </button>
            </form>
        </section>
    </main>
</div>
@endsection
