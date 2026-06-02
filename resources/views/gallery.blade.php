@extends('layouts.app')

@section('title', 'Interactive Event Gallery')

@section('content')
<!-- Gallery Grid Section -->
<section class="gallery-grid-section" style="padding-top: 60px;">
    <div class="container">
        <!-- Category Filter Pills -->
        @php
            $uniqueCategories = [];
            foreach($images as $image) {
                $uniqueCategories[$image->category_slug] = $image->category_name;
            }
        @endphp
        
        @if(count($uniqueCategories) > 0)
        <div class="filter-pills-wrapper mb-5 text-center">
            <button class="filter-pill active" data-filter="all">
                All Memories
            </button>
            @foreach($uniqueCategories as $slug => $name)
                <button class="filter-pill" data-filter="{{ $slug }}">
                    {{ $name }}
                </button>
            @endforeach
        </div>
        @endif
        @if($images->count() > 0)
            <div class="modern-masonry-wrapper">
                <div class="modern-masonry">
                    @foreach($images as $index => $image)
                        <div class="masonry-item-card" data-category="{{ $image->category_slug }}">
                            <a href="javascript:void(0)" class="open-gallery-modal-modern" data-slide-to="{{ $index }}">
                                <div class="card-img-container">
                                    <img src="{{ asset($image->image_path) }}" alt="{{ $image->title }}" loading="lazy">
                                    <div class="card-hover-overlay">
                                        <div class="overlay-badge">
                                            <i class="fas fa-expand-arrows-alt"></i>
                                        </div>
                                        <div class="overlay-content">
                                            <span class="overlay-category">
                                                {{ $image->category_name }}
                                            </span>
                                            <h4 class="overlay-title">{{ $image->title }}</h4>
                                            <div class="overlay-meta">
                                                <span><i class="far fa-calendar-alt"></i> {{ $image->date }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Modern Pagination -->
            <div class="pagination-modern-wrap">
                {{ $images->links('pagination::bootstrap-4') }}
            </div>

            <!-- Sleek Glassmorphic Lightbox Modal -->
            <div class="modal fade modern-lightbox" id="galleryModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <button type="button" class="btn-close-modern" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                        
                        <div class="modal-body p-0">
                            <div id="galleryCarousel" class="carousel slide" data-bs-interval="false">
                                <div class="carousel-inner">
                                    @foreach($images as $index => $image)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-lg-8 text-center bg-black-dim">
                                                <img src="{{ asset($image->image_path) }}" class="lightbox-main-img" alt="Gallery Image">
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="lightbox-info-sidebar">
                                                    <span class="sidebar-tag">
                                                        {{ $image->category_name }}
                                                    </span>
                                                    <h3 class="sidebar-title">{{ $image->title }}</h3>
                                                    
                                                    <div class="sidebar-meta-list">
                                                        <div class="meta-item">
                                                            <i class="far fa-calendar-alt text-primary-gradient"></i>
                                                            <div>
                                                                <small>Date</small>
                                                                <p>{{ $image->long_date }}</p>
                                                            </div>
                                                        </div>
                                                        @if($image->location)
                                                        <div class="meta-item">
                                                            <i class="fas fa-map-marker-alt text-primary-gradient"></i>
                                                            <div>
                                                                <small>Location</small>
                                                                <p>{{ $image->location }}</p>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    
                                                    @if($image->description)
                                                    <div class="sidebar-description">
                                                        <small>About</small>
                                                        <p>{{ $image->description }}</p>
                                                    </div>
                                                    @endif
                                                    
                                                    @if($image->link)
                                                    <a href="{{ $image->link }}" class="btn-view-event">
                                                        View Details <i class="fas fa-arrow-right ml-2"></i>
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                
                                <!-- Floating Carousel Controls -->
                                <button class="carousel-btn prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button class="carousel-btn next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5 no-images-state">
                <div class="illustration-box mb-4">
                    <i class="fas fa-images fa-4x text-primary-gradient"></i>
                </div>
                <h3>No Memories Discovered Yet</h3>
                <p>Images uploaded in upcoming events will elegantly present themselves here.</p>
            </div>
        @endif
    </div>
</section>
@endsection

@push('css')
<style>
    /* Styling variables & core colors */
    :root {
        --primary-gradient: linear-gradient(135deg, #ff7e40 0%, #e36108 100%);
        --primary-color: #e36108;
        --dark-bg: #0f172a;
        --glass-bg: rgba(255, 255, 255, 0.7);
        --glass-border: rgba(255, 255, 255, 0.4);
        --glass-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.08);
    }

    /* Hero header with blur & smooth glows */
    .gallery-hero-section {
        position: relative;
        padding: 100px 0 80px 0;
        background: #f8fafc;
        overflow: hidden;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .hero-bg-glow {
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,126,64,0.15) 0%, rgba(227,97,8,0) 70%);
        top: -100px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1;
        pointer-events: none;
    }
    
    .badge-modern {
        background: rgba(227, 97, 8, 0.1);
        color: var(--primary-color);
        padding: 8px 16px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 2px;
        border-radius: 50px;
        display: inline-block;
    }
    
    .gallery-title-main {
        font-size: 48px;
        font-weight: 800;
        color: #1e293b;
        letter-spacing: -1px;
        margin-bottom: 20px;
    }
    
    .gallery-subtitle {
        font-size: 18px;
        color: #64748b;
        max-width: 650px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Filter pills */
    .filter-pills-wrapper {
        display: flex;
        justify-content: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    
    .filter-pill {
        border: 1px solid #cbd5e1;
        background: #fff;
        padding: 10px 24px;
        font-size: 14px;
        font-weight: 600;
        color: #475569;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    
    .filter-pill:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
        transform: translateY(-2px);
    }
    
    .filter-pill.active {
        background: var(--primary-gradient);
        border-color: transparent;
        color: #fff;
        box-shadow: 0 4px 14px rgba(227, 97, 8, 0.3);
    }

    /* Masonry grid with smooth scaling & CSS columns */
    .gallery-grid-section {
        padding: 80px 0;
        background: #f1f5f9;
    }
    
    .modern-masonry-wrapper {
        width: 100%;
    }

    .modern-masonry {
        column-count: 3;
        column-gap: 25px;
    }
    
    @media (max-width: 991px) {
        .modern-masonry {
            column-count: 2;
        }
    }
    
    @media (max-width: 575px) {
        .modern-masonry {
            column-count: 1;
        }
    }
    
    .masonry-item-card {
        break-inside: avoid;
        margin-bottom: 25px;
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(226, 232, 240, 0.8);
    }
    
    .masonry-item-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 36px rgba(15, 23, 42, 0.12);
        border-color: rgba(227, 97, 8, 0.2);
    }
    
    .card-img-container {
        position: relative;
        overflow: hidden;
        aspect-ratio: auto;
    }
    
    .card-img-container img {
        width: 100%;
        display: block;
        transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    
    .masonry-item-card:hover .card-img-container img {
        transform: scale(1.08);
    }

    /* Card overlay styling */
    .card-hover-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(180deg, rgba(15, 23, 42, 0) 40%, rgba(15, 23, 42, 0.85) 100%);
        opacity: 0;
        transition: all 0.4s ease;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 30px 24px;
    }
    
    .masonry-item-card:hover .card-hover-overlay {
        opacity: 1;
    }
    
    .overlay-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        transform: scale(0.8);
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    
    .masonry-item-card:hover .overlay-badge {
        transform: scale(1);
    }
    
    .overlay-category {
        color: #ff9d6e;
        font-size: 11px;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 1.5px;
        margin-bottom: 6px;
        display: block;
    }
    
    .overlay-title {
        color: #fff;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 8px;
        line-height: 1.3;
    }
    
    .overlay-meta {
        color: #cbd5e1;
        font-size: 13px;
    }

    /* Modern Pagination elements */
    .pagination-modern-wrap {
        margin-top: 50px;
        display: flex;
        justify-content: center;
    }
    
    .pagination-modern-wrap .page-item .page-link {
        border-radius: 8px;
        margin: 0 4px;
        font-weight: 600;
        color: #475569;
        border-color: #cbd5e1;
        padding: 10px 16px;
        transition: all 0.2s;
    }
    
    .pagination-modern-wrap .page-item.active .page-link {
        background: var(--primary-gradient);
        border-color: transparent;
        color: #fff;
        box-shadow: 0 4px 10px rgba(227, 97, 8, 0.25);
    }
    
    .pagination-modern-wrap .page-item:hover:not(.active) .page-link {
        color: var(--primary-color);
        border-color: var(--primary-color);
        background: rgba(227,97,8,0.04);
    }

    /* Advanced Lightbox Modal Styling */
    .modern-lightbox .modal-dialog {
        max-width: 90vw;
    }
    
    .modern-lightbox .modal-content {
        background: rgba(15, 23, 42, 0.85);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }
    
    .btn-close-modern {
        position: absolute;
        top: 25px;
        right: 25px;
        width: 44px;
        height: 44px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 50%;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        cursor: pointer;
        z-index: 1050;
        transition: all 0.3s;
    }
    
    .btn-close-modern:hover {
        background: #ef4444;
        border-color: transparent;
        transform: rotate(90deg);
    }
    
    .bg-black-dim {
        background: #090d16;
        min-height: 50vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px;
    }
    
    .lightbox-main-img {
        max-height: 75vh;
        max-width: 100%;
        object-fit: contain;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    
    .lightbox-info-sidebar {
        background: #fff;
        height: 100%;
        min-height: 100%;
        padding: 50px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    @media (max-width: 991px) {
        .lightbox-info-sidebar {
            padding: 35px 25px;
        }
    }
    
    .sidebar-tag {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 12px;
        display: inline-block;
    }
    
    .sidebar-title {
        font-size: 26px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.3;
        margin-bottom: 25px;
    }
    
    .sidebar-meta-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-bottom: 30px;
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
        padding: 20px 0;
    }
    
    .meta-item {
        display: flex;
        gap: 15px;
        align-items: center;
    }
    
    .meta-item i {
        font-size: 20px;
        width: 24px;
    }
    
    .text-primary-gradient {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .meta-item small {
        color: #94a3b8;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        display: block;
    }
    
    .meta-item p {
        margin: 0;
        font-weight: 600;
        color: #334155;
    }
    
    .sidebar-description small {
        color: #94a3b8;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        display: block;
        margin-bottom: 6px;
    }
    
    .sidebar-description p {
        color: #475569;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 30px;
    }
    
    .btn-view-event {
        background: var(--primary-gradient);
        color: #fff !important;
        text-align: center;
        padding: 14px 28px;
        font-weight: 700;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(227, 97, 8, 0.2);
    }
    
    .btn-view-event:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(227, 97, 8, 0.35);
    }

    /* Modal Navigation buttons */
    .carousel-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        cursor: pointer;
        transition: all 0.3s;
        z-index: 10;
    }
    
    .carousel-btn:hover {
        background: var(--primary-gradient);
        border-color: transparent;
        transform: translateY(-50%) scale(1.08);
    }
    
    .carousel-btn.prev {
        left: 20px;
    }
    
    .carousel-btn.next {
        right: 20px;
    }
    
    @media (max-width: 991px) {
        .carousel-btn {
            top: 25%;
        }
        .carousel-btn.prev {
            left: 10px;
        }
        .carousel-btn.next {
            right: 10px;
        }
    }

    /* No images empty state */
    .no-images-state {
        background: #fff;
        border-radius: 24px;
        padding: 80px 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }
    
    .illustration-box i {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endpush

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Modal & Carousel
        const galleryModalElement = document.getElementById('galleryModal');
        if(galleryModalElement) {
            const galleryModal = new bootstrap.Modal(galleryModalElement);
            const carouselElement = document.getElementById('galleryCarousel');
            const bsCarousel = new bootstrap.Carousel(carouselElement, {
                interval: false
            });

            // Handle Image Click to Open Specific Slide
            const openGalleryBtns = document.querySelectorAll('.open-gallery-modal-modern');
            openGalleryBtns.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const slideTo = parseInt(this.getAttribute('data-slide-to'));
                    bsCarousel.to(slideTo);
                    galleryModal.show();
                });
            });
        }

        // Animated Category Filtering Logic
        const filterBtns = document.querySelectorAll('.filter-pill');
        const masonryItems = document.querySelectorAll('.masonry-item-card');
        
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Toggle active button
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                const filterValue = this.getAttribute('data-filter');
                
                masonryItems.forEach(item => {
                    if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                        item.style.display = 'block';
                        // Trigger an entering fade-in animation
                        item.animate([
                            { opacity: 0, transform: 'scale(0.95) translateY(10px)' },
                            { opacity: 1, transform: 'scale(1) translateY(0)' }
                        ], {
                            duration: 350,
                            easing: 'cubic-bezier(0.16, 1, 0.3, 1)'
                        });
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endpush
