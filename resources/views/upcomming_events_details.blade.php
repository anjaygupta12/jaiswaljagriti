@extends('layouts.app')

@section('title', $event->title . ' | Upcoming Event')

@section('content')
<div id="primary" class="content-area normal">
    <div id="contentHolder">
        <div class="post-detail-style2">
            <div class="container">
                <div class="entry-thumbnail-area show-image">
                    @if($event->banner)
                        <img width="1600" height="1013" src="{{ asset($event->banner) }}" class="attachment-full size-full wp-post-image" alt="{{ $event->title }}" decoding="async">
                    @else
                        <img width="1600" height="1013" src="https://via.placeholder.com/1600x600?text={{ urlencode($event->title) }}" class="attachment-full size-full wp-post-image" alt="{{ $event->title }}" decoding="async">
                    @endif
                    
                    <div class="entry-header">
                        <span class="entry-categories style-1">
                            @if($event->eventCategory)
                                <a href="{{ route('events', ['category' => $event->eventCategory->slug]) }}">
                                    <span class="category-style" style="background:#111111">
                                        {{ $event->eventCategory->name }} 
                                        ({{ $event->eventCategory->events()->count() }})
                                    </span>
                                </a>
                            @else
                                <a href="#"><span class="category-style" style="background:#111111">Upcoming Event</span></a>
                            @endif
                        </span>
                        <h1 class="entry-title title-size-xl title-light-color">{{ $event->title }}</h1>
                        <ul class="entry-meta meta-light-color">
                            <li><i class="far fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}</li>
                            <li class="post-author"><i class="far fa-user"></i>by <a href="#" title="Posts by {{ $event->author }}" rel="author">{{ $event->author }}</a></li>
                            <li><i class="far fa-comments"></i><span class="comment-number">{{ $comments->count() }}</span> Comments</li>
                            <li><i class="fas fa-signal"></i><span class="meta-views meta-item"><span class="meta-views meta-item rising"><span class="view-number">{{ number_format($event->views) }}</span> Views</span></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <main id="main" class="site-main">
                        <div class="rt-sidebar-space">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="entry-content rt-single-content">
                                {!! nl2br(e($event->content)) !!}
                            </div>

                            <div class="entry-footer mt-4">
                                <div class="entry-footer-meta">
                                    <div class="post-share">
                                        <h4 class="meta-title">Share This Post:</h4>
                                        <div class="share-links">
                                            <a href="http://www.facebook.com/sharer.php?u={{ url()->current() }}" rel="external" target="_blank" class="facebook-f-share-button large-share-button"><span class="fab fa-facebook-f"></span> <span class="social-text">Facebook</span></a>
                                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($event->title) }}&url={{ url()->current() }}" rel="external" target="_blank" class="twitter-share-button large-share-button"><span class="fab fa-twitter"></span> <span class="social-text">Twitter</span></a>
                                            <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{ urlencode($event->title) }}" rel="external" target="_blank" class="linkedin-in-share-button"><span class="fab fa-linkedin-in"></span> <span class="screen-reader-text">LinkedIn</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Comments Section -->
                            <div id="comments" class="comments-area mt-5">
                                <h4 class="comments-title mb-4">{{ $comments->count() }} Comments</h4>
                                <ul class="comment-list list-unstyled">
                                    @foreach($comments as $comment)
                                    <li class="comment mb-4 border-bottom pb-3">
                                        <div class="comment-body d-flex">
                                            <div class="comment-avatar mr-3">
                                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                    <i class="fas fa-user text-muted"></i>
                                                </div>
                                            </div>
                                            <div class="comment-content">
                                                <h6 class="mb-1 font-weight-bold">{{ $comment->name }}</h6>
                                                <small class="text-muted d-block mb-2">{{ $comment->created_at->format('M d, Y') }}</small>
                                                <p class="mb-0">{{ $comment->content }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>

                                <div id="respond" class="comment-respond mt-5">
                                    <h4 id="reply-title" class="comment-reply-title mb-4">Leave a Reply</h4>
                                    <form action="{{ route('comments.store', ['type' => 'event', 'id' => $event->id]) }}" method="post" id="commentform" class="comment-form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <input name="name" type="text" class="form-control" placeholder="Name *" required>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input name="email" type="email" class="form-control" placeholder="Email *" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <textarea id="comment" name="content" required placeholder="Comment *" class="textarea form-control" rows="5"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input name="submit" type="submit" id="submit" class="btn btn-primary" value="Post Comment">
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="magazines-slider-container mt-5">
                                <div class="section-title d-flex justify-content-between align-items-center mb-4">
                                    <h3 class="related-title mb-0">Related Magazines
                                        <span class="titledot"></span>
                                        <span class="titleline"></span>
                                    </h3>				
                                    <div class="slider-nav-buttons">
                                        <div class="nav-btn prev-mag"><i class="fas fa-chevron-left"></i></div>
                                        <div class="nav-btn next-mag"><i class="fas fa-chevron-right"></i></div>
                                    </div>
                                </div>
                                <div class="swiper magazines-swiper">
                                    <div class="swiper-wrapper">
                                        @foreach($relatedMagazines as $mag)
                                        <div class="swiper-slide">
                                            <div class="blog-box h-100" style="margin-bottom: 0;">
                                                <div class="blog-img-holder">
                                                    <a href="{{ route('magazines.index') }}">
                                                        @if($mag->thumbnail)
                                                            <img src="{{ asset($mag->thumbnail) }}" class="img-responsive wp-post-image" alt="{{ $mag->title }}" decoding="async" style="width: 100%; height: 250px; object-fit: cover;">
                                                        @else
                                                            <img src="https://via.placeholder.com/540x400?text=Magazine" class="img-responsive wp-post-image" alt="{{ $mag->title }}" decoding="async" style="width: 100%; height: 250px; object-fit: cover;">
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="entry-content" style="padding: 15px;">	
                                                    <span class="entry-categories style-1 mb-2">
                                                        <a href="{{ route('magazines.index') }}"><span class="category-style">Magazine</span></a>
                                                    </span>
                                                    <ul class="entry-meta">	
                                                        <li class="post-date"><i class="far fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($mag->magazine_date)->format('F d, Y') }}</li>	
                                                    </ul>
                                                    <h3 class="entry-title title-size-md title-dark-color"><a href="{{ route('magazines.index') }}">{{ $mag->title }}</a></h3>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>

                <div class="col-xl-3 col-lg-4">
                    <aside class="sidebar-widget-area">
                        <div class="widget rt-category">
                            <div class="section-title"><h3 class="widgettitle">Categories</h3></div>
                            <div class="rt-category-widget box-style-2">
                                @php 
                                    $allCategories = \App\Models\EventCategory::where('status', true)->withCount('events')->get();
                                @endphp
                                @foreach($allCategories as $cat)
                                <div class="rt-item space">
                                    <a href="{{ route('events', ['category' => $cat->slug]) }}">
                                        <span class="rt-cat-name">{{ $cat->name }}</span>
                                        <span class="rt-cat-count">{{ $cat->events_count }}</span>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="widget rt-post-box mt-4">
                            <h3 class="widgettitle">Top Magazines</h3>
                            @php $topMagazines = \App\Models\Magazine::latest()->take(3)->get(); @endphp
                            @foreach($topMagazines as $mag)
                            <div class="rt-news-box-widget mb-3">
                                <div class="item-list d-flex">
                                    <div class="post-box-img mr-3">
                                        <a href="{{ route('magazines.index') }}">
                                            <img width="80" height="110" src="{{ asset($mag->thumbnail) }}" class="rounded shadow-sm" alt="{{ $mag->title }}" style="object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="post-content">
                                        <h6 class="entry-title mb-1" style="font-size: 14px;"><a href="{{ route('magazines.index') }}" class="text-dark">{{ $mag->title }}</a></h6>
                                        <small class="text-muted"><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($mag->magazine_date)->format('M Y') }}</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="widget xs_counter-widget mt-4">
                            <div class="section-title"><h3 class="widgettitle">Follow Us</h3></div>
                            <div class="xs_social_counter_widget ">
                                <ul class="xs_counter_url wslu-style-2 wslu-counter-line-shaped wslu-counter-fill-colored wslu-counter-space wslu-none wslu-theme-font-yes list-unstyled">
                                    <li class="xs-counter-li facebook mb-2">
                                        <a href="http://www.facebook.com/" target="_blank" class="d-flex align-items-center text-dark text-decoration-none">
                                            <div class="xs-social-icon mr-3">
                                                <span class="met-social met-social-facebook"><i class="fab fa-facebook-f"></i></span>
                                            </div>
                                            <div class="xs-social-follower mr-1">0</div>
                                            <div class="xs-social-follower-text">Fans</div>
                                        </a>
                                    </li>
                                    <li class="xs-counter-li twitter mb-2">
                                        <a href="http://twitter.com/" target="_blank" class="d-flex align-items-center text-dark text-decoration-none">
                                            <div class="xs-social-icon mr-3">
                                                <span class="met-social met-social-twitter"><i class="fab fa-twitter"></i></span>
                                            </div>
                                            <div class="xs-social-follower mr-1">0</div>
                                            <div class="xs-social-follower-text">Followers</div>
                                        </a>
                                    </li>
                                    <li class="xs-counter-li instagram mb-2">
                                        <a href="http://instagram.com/" target="_blank" class="d-flex align-items-center text-dark text-decoration-none">
                                            <div class="xs-social-icon mr-3">
                                                <span class="met-social met-social-instagram"><i class="fab fa-instagram"></i></span>
                                            </div>
                                            <div class="xs-social-follower mr-1">0</div>
                                            <div class="xs-social-follower-text">Followers</div>
                                        </a>
                                    </li>
                                    <li class="xs-counter-li youtube mb-2">
                                        <a href="https://youtube.com/" target="_blank" class="d-flex align-items-center text-dark text-decoration-none">
                                            <div class="xs-social-icon mr-3">
                                                <span class="met-social met-social-youtube"><i class="fab fa-youtube"></i></span>
                                            </div>
                                            <div class="xs-social-follower mr-1">0</div>
                                            <div class="xs-social-follower-text">Subscribers</div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .slider-nav-buttons {
        display: flex;
        gap: 10px;
    }
    .nav-btn {
        width: 35px;
        height: 35px;
        background: #f4f4f4;
        border-radius: 50%;
        color: #e36108;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
        cursor: pointer;
    }
    .nav-btn:hover {
        background: #e36108;
        color: #fff;
    }
    
    .magazines-swiper {
        overflow: hidden;
        padding-bottom: 30px;
    }
</style>
@endpush

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function initMagazineSlider() {
            if (typeof Swiper === 'undefined') {
                setTimeout(initMagazineSlider, 100);
                return;
            }
            
            const magSwiper = new Swiper('.magazines-swiper', {
                slidesPerView: 3,
                spaceBetween: 30,
                loop: document.querySelectorAll('.magazines-swiper .swiper-slide').length > 3,
                navigation: {
                    nextEl: '.next-mag',
                    prevEl: '.prev-mag',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    0: { slidesPerView: 1 },
                    768: { slidesPerView: 2 },
                    1200: { slidesPerView: 3 }
                }
            });
        }
        initMagazineSlider();
    });
</script>
@endpush
