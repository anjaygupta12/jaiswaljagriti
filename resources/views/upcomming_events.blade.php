@extends('layouts.app')

@section('title', 'Jaiswal Jagriti Family | Events')

@section('content')
    <style>
        .upcoming-events-section {
            background-image: url('{{ asset($settings['events_banner']) }}');
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 450px;
            position: relative;
            display: flex;
            align-items: center;
        }

        .upcoming-events-section .elementor-background-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
        }

        .upcoming-events-section .elementor-container {
            position: relative;
            z-index: 2;
        }

        .upcoming-events-section h1 {
            color: #fff;
            text-align: center;
            font-size: 50px;
            font-weight: 700;
        }
    </style>
    <div data-elementor-type="wp-page" data-elementor-id="6666" class="elementor elementor-6666"
        data-elementor-post-type="page">
        <section
            class="elementor-section elementor-top-section elementor-element elementor-element-8b416fa elementor-section-full_width elementor-section-height-min-height elementor-section-height-default elementor-section-items-middle rt-parallax-bg-no upcoming-events-section"
            data-id="8b416fa" data-element_type="section" data-e-type="section"
            data-settings='{"background_background":"classic"}'>

            <div class="elementor-background-overlay"></div>

            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-bdbabba"
                    data-id="bdbabba" data-element_type="column" data-e-type="column">

                    <div class="elementor-widget-wrap elementor-element-populated">

                        <div class="elementor-element elementor-element-2c2b843 elementor-widget elementor-widget-heading"
                            data-id="2c2b843" data-element_type="widget" data-e-type="widget"
                            data-widget_type="heading.default">

                            <div class="elementor-widget-container">
                                <h1 class="elementor-heading-title elementor-size-default" style="color: #fff; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                                    {{ $settings['events_banner_title'] }}
                                </h1>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section
            class="elementor-section elementor-top-section elementor-element elementor-element-e2f6abb elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no"
            data-id="e2f6abb" data-element_type="section" data-e-type="section">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-587d714"
                    data-id="587d714" data-element_type="column" data-e-type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-20549d3 elementor-widget elementor-widget-rtsb-post-grid"
                            data-id="20549d3" data-element_type="widget" data-e-type="widget"
                            data-widget_type="rtsb-post-grid.default">
                            <div class="elementor-widget-container">
                                <div id="rtsb-container-20549d3"
                                    class="rtsb-elementor-container rtsb-pos-r rtsb-post-grid rtsb-blog-post"
                                    data-layout="rtsb-post-grid-layout3" style="--rtsb-default-columns: 3">
                                    <div class="rtsb-row rtsb-content-loader rtsb-post-grid-layout3">
                                        @forelse($events as $event)
                                        <div class="rtsb-col-grid rtsb-post-grid">
                                            <div class="rtsb-post-grid-item rtsb-gw-img-zoom-out">
                                                <article>
                                                    <div class="rtsb-post-img rtsb-img-wrap">
                                                        <figure>
                                                            <a class="rtsb-img-link"
                                                                href="{{ route('events-details', $event->slug) }}"
                                                                aria-label="Image link for Post: {{ $event->title }}">
                                                                @if($event->thumbnail)
                                                                    <img decoding="async" width="400" height="300"
                                                                        class="img-responsive rtsb-product-image" alt="{{ $event->title }}"
                                                                        src="{{ asset($event->thumbnail) }}">
                                                                @else
                                                                    <img decoding="async" width="400" height="300"
                                                                        class="img-responsive rtsb-product-image" alt="{{ $event->title }}"
                                                                        src="https://via.placeholder.com/400x300?text=No+Image">
                                                                @endif
                                                            </a>
                                                        </figure>
                                                        <ul class="rtsb-post-taxonomy-list">
                                                            <li class="rtsb-tax-item category"><span
                                                                    class="category-links">
                                                                    @if($event->eventCategory)
                                                                        <a href="{{ route('events', ['category' => $event->eventCategory->slug]) }}" rel="category tag">
                                                                            {{ $event->eventCategory->name }}
                                                                        </a>
                                                                    @else
                                                                        <a href="#" rel="category tag">Upcoming Event</a>
                                                                    @endif
                                                                </span></li>
                                                        </ul>
                                                    </div>
                                                    <div class="rtsb-post-content">

                                                        <h3 class="rtsb-post-title limit-default">
                                                            <a class="rtsb-title-link"
                                                                href="{{ route('events-details', $event->slug) }}">{{ $event->title }}</a>
                                                        </h3>
                                                    </div>
                                                </article>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="col-12 text-center py-5">
                                            <h4 class="text-muted">No upcoming events found.</h4>
                                        </div>
                                        @endforelse
                                    </div><!-- .rtsb-row -->
                                </div><!-- .rtsb-container -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
