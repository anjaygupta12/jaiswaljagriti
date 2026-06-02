@extends('layouts.app')

@section('title', 'Jaiswal Jagriti Family | Womens Wing')

@section('content')

<style>
.elementor-element-7efada0{
    background-image: url("{{ asset(\App\Models\Setting::getVal('womens_wing_banner', 'assets/images/IMG-20250826-WA0008.jpg')) }}");
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
    min-height: 500px;
    position: relative;
    display: flex;
    align-items: center;
}

.elementor-element-7efada0 .elementor-background-overlay{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.45);
}

.elementor-element-7efada0 .elementor-container{
    position: relative;
    z-index: 2;
}

.elementor-heading-title{
    color: #fff;
    text-align: center;
    font-size: 48px;
    font-weight: 700;
    margin: 0;
}

@media(max-width:768px){
    .elementor-heading-title{
        font-size: 32px;
    }

    .elementor-element-7efada0{
        min-height: 350px;
    }
}
</style>

    <div data-elementor-type="wp-page" data-elementor-id="6865" class="elementor elementor-6865"
        data-elementor-post-type="page">
     <section
    class="elementor-section elementor-top-section elementor-element elementor-element-7efada0 elementor-section-full_width elementor-section-height-min-height elementor-section-height-default elementor-section-items-middle rt-parallax-bg-no"
    data-id="7efada0"
    data-element_type="section"
    data-e-type="section"
    data-settings='{"background_background":"classic"}'>

    <div class="elementor-background-overlay"></div>

    <div class="elementor-container elementor-column-gap-default">
        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-3638d32"
            data-id="3638d32"
            data-element_type="column"
            data-e-type="column">

            <div class="elementor-widget-wrap elementor-element-populated">
                <div class="elementor-element elementor-element-3475d2f elementor-widget elementor-widget-heading"
                    data-id="3475d2f"
                    data-element_type="widget"
                    data-e-type="widget"
                    data-widget_type="heading.default">

                    <div class="elementor-widget-container">
                        <h1 class="elementor-heading-title elementor-size-default">
                            {{ \App\Models\Setting::getVal('womens_wing_title', 'Women\'s Wing') }}
                        </h1>
                    </div>


        </div>
    </div>
</section>


        @include('partials.wing-styles')

        <section class="premium-wing-section">
            <div class="container mb-5 text-center">
                <h2 class="font-weight-bold" style="color: #e36108; font-size: 32px; margin-bottom: 0;">
                    महिला विंग (Women's Wing)
                </h2>
                <div style="width: 60px; height: 3px; background: #e36108; margin: 15px auto 20px; border-radius: 2px;"></div>
                
                <h4 class="font-weight-bold text-dark mb-3">Welcome To Jaiswal Jagriti</h4>
                <p class="text-muted mx-auto" style="max-width: 800px; font-size: 16px; line-height: 1.6;">
                    Our members are the heart of Jaiswal Jagriti, representing unity, talent, and progress. From professionals to entrepreneurs and cultural enthusiasts, each member contributes to the community’s growth while preserving our heritage. Together, we inspire, support, and create a stronger future.
                </p>
            </div>
            <div class="wing-grid-modern">
                @forelse($members as $member)
                    <div class="member-card-modern">
                        <div class="member-avatar-wrapper">
                            <div class="member-avatar-inner">
                                @if($member->image)
                                    <img src="{{ asset($member->image) }}" class="member-avatar-img" alt="{{ $member->name }}">
                                @else
                                    <div class="member-placeholder">
                                        <i class="fas fa-user fa-2x"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <h3 class="member-name-modern">{{ $member->name }}</h3>
                        
                        @if($member->designation)
                            <span class="member-badge-modern">{{ $member->designation }}</span>
                        @endif

                        @if($member->short_description)
                            <p class="member-short-desc">{{ Str::limit($member->short_description, 100) }}</p>
                        @endif

                        <div class="member-divider"></div>

                        <div class="member-contact-modern">
                            @if($member->phone)
                                <a href="tel:{{ str_replace([' ', '-', '/'], '', $member->phone) }}" class="contact-item-modern">
                                    <i class="fas fa-phone-alt"></i> {{ $member->phone }}
                                </a>
                            @endif
                            @if($member->email)
                                <a href="mailto:{{ $member->email }}" class="contact-item-modern">
                                    <i class="fas fa-envelope"></i> {{ $member->email }}
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5" style="grid-column: 1 / -1;">
                        <h4 class="text-muted">Coming Soon</h4>
                        <p class="text-muted">The wing directory is currently being updated by the administration.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>

@endsection
