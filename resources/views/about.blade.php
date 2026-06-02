@extends('layouts.app')

@section('title', 'Jaiswal Jagriti Family | About')

@section('content')
    <style>
        .elementor-element-2c2230e {
            position: relative;
            min-height: 400px;
            overflow: hidden;
        }

        .elementor-element-2c2230e .elementor-background-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset($settings['about_banner']) }}');
            background-position: top center;
            background-repeat: no-repeat;
            background-size: cover;
            opacity: 0.73;
            z-index: 1;
        }

        .elementor-element-2c2230e .elementor-container {
            position: relative;
            z-index: 2;
        }
    </style>

    <section
        class="elementor-section elementor-top-section elementor-element elementor-element-2c2230e elementor-section-height-min-height elementor-section-boxed elementor-section-height-default elementor-section-items-middle rt-parallax-bg-no"
        data-id="2c2230e" data-element_type="section" data-e-type="section">

        <div class="elementor-background-overlay"></div>

        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-a001ed3"
                data-id="a001ed3" data-element_type="column" data-e-type="column">

                <div class="elementor-widget-wrap">
                    @if(!empty($settings['about_banner_title']))
                    <div class="elementor-element elementor-widget elementor-widget-heading text-center" style="margin-top: 150px;">
                        <div class="elementor-widget-container">
                            <h2 class="elementor-heading-title elementor-size-default" style="color: #fff; font-size: 48px; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                                {{ $settings['about_banner_title'] }}
                            </h2>
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </section>
    <section
        class="elementor-section elementor-top-section elementor-element elementor-element-6ede1f5 elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no"
        data-id="6ede1f5" data-element_type="section" data-e-type="section">
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-79bcdc0"
                data-id="79bcdc0" data-element_type="column" data-e-type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <section
                        class="elementor-section elementor-inner-section elementor-element elementor-element-2eb2b54 elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no"
                        data-id="2eb2b54" data-element_type="section" data-e-type="section">
                        <div class="elementor-container elementor-column-gap-default">
                            <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-d161e95"
                                data-id="d161e95" data-element_type="column" data-e-type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-element-7db8fa7 elementor-widget elementor-widget-image"
                                        data-id="7db8fa7" data-element_type="widget" data-e-type="widget"
                                        data-widget_type="image.default">
                                        <div class="elementor-widget-container">
                                            <img decoding="async" width="1024" height="573"
                                                src="{{ asset($settings['about_gallery_1_img1']) }}"
                                                class="attachment-large size-large wp-image-5841" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-9c4ddbf"
                                data-id="9c4ddbf" data-element_type="column" data-e-type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-element-da0d5b2 elementor-widget elementor-widget-image"
                                        data-id="da0d5b2" data-element_type="widget" data-e-type="widget"
                                        data-widget_type="image.default">
                                        <div class="elementor-widget-container">
                                            <img decoding="async" width="1024" height="465"
                                                src="{{ asset($settings['about_gallery_1_img2']) }}"
                                                class="attachment-large size-large wp-image-5843" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section
                        class="elementor-section elementor-inner-section elementor-element elementor-element-72620a5 elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no"
                        data-id="72620a5" data-element_type="section" data-e-type="section">
                        <div class="elementor-container elementor-column-gap-default">
                            <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-536f1f8"
                                data-id="536f1f8" data-element_type="column" data-e-type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-element-d0dfe1b elementor-widget elementor-widget-image"
                                        data-id="d0dfe1b" data-element_type="widget" data-e-type="widget"
                                        data-widget_type="image.default">
                                        <div class="elementor-widget-container">
                                            <img loading="lazy" decoding="async" width="960" height="540"
                                                src="{{ asset($settings['about_gallery_2_img1']) }}"
                                                class="attachment-large size-large wp-image-5842" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-154eeca"
                                data-id="154eeca" data-element_type="column" data-e-type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-element-8985de6 elementor-widget elementor-widget-image"
                                        data-id="8985de6" data-element_type="widget" data-e-type="widget"
                                        data-widget_type="image.default">
                                        <div class="elementor-widget-container">
                                            <img loading="lazy" decoding="async" width="1024" height="562"
                                                src="{{ asset($settings['about_gallery_2_img2']) }}"
                                                class="attachment-large size-large wp-image-5844" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-58ae68e"
                data-id="58ae68e" data-element_type="column" data-e-type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-element elementor-element-4d47848 elementor-widget elementor-widget-heading"
                        data-id="4d47848" data-element_type="widget" data-e-type="widget"
                        data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h2 class="elementor-heading-title elementor-size-default">{{ $settings['about_hearts_title1'] }}</h2>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-2d2c75b elementor-widget elementor-widget-heading"
                        data-id="2d2c75b" data-element_type="widget" data-e-type="widget"
                        data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h2 class="elementor-heading-title elementor-size-default">{{ $settings['about_hearts_title2'] }}
                            </h2>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-5f972d0 elementor-widget elementor-widget-text-editor"
                        data-id="5f972d0" data-element_type="widget" data-e-type="widget"
                        data-widget_type="text-editor.default">
                        <div class="elementor-widget-container">
                            <p>{{ $settings['about_hearts_text'] }}</p>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-eca00f0 elementor-widget elementor-widget-text-editor"
                        data-id="eca00f0" data-element_type="widget" data-e-type="widget"
                        data-widget_type="text-editor.default">
                        <div class="elementor-widget-container">
                            {!! $settings['about_hearts_features'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section
        class="elementor-section elementor-top-section elementor-element elementor-element-af37dc6 elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no"
        data-id="af37dc6" data-element_type="section" data-e-type="section">
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-cfeac95"
                data-id="cfeac95" data-element_type="column" data-e-type="column"
                data-settings='{"background_background":"classic"}'>
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-element elementor-element-4cea97c elementor-widget elementor-widget-heading"
                        data-id="4cea97c" data-element_type="widget" data-e-type="widget"
                        data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h3 class="elementor-heading-title elementor-size-default">
                                <h2 class="elementor-heading-title elementor-size-default elementor-inline-editing pen"
                                    data-elementor-setting-key="title" data-pen-placeholder="Type Here...">
                                    {{ $settings['about_empowering_title'] }}</h2>
                            </h3>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-44182bc elementor-widget elementor-widget-text-editor"
                        data-id="44182bc" data-element_type="widget" data-e-type="widget"
                        data-widget_type="text-editor.default">
                        <div class="elementor-widget-container">
                            <p>{{ $settings['about_empowering_text'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-9db573c"
                data-id="9db573c" data-element_type="column" data-e-type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-element elementor-element-9c54155 elementor-widget elementor-widget-heading"
                        data-id="9c54155" data-element_type="widget" data-e-type="widget"
                        data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h2 class="elementor-heading-title elementor-size-default">
                                <h2 class="elementor-heading-title elementor-size-default elementor-inline-editing pen"
                                    data-elementor-setting-key="title" data-pen-placeholder="Type Here...">{{ $settings['about_opportunities_title'] }}</h2>
                            </h2>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-c6c754a elementor-widget elementor-widget-text-editor"
                        data-id="c6c754a" data-element_type="widget" data-e-type="widget"
                        data-widget_type="text-editor.default">
                        <div class="elementor-widget-container">
                            <p>{{ $settings['about_opportunities_text'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section
        class="elementor-section elementor-top-section elementor-element elementor-element-a2577a8 elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no"
        data-id="a2577a8" data-element_type="section" data-e-type="section">
        <div class="elementor-container elementor-column-gap-extended">
            <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-67da7ad"
                data-id="67da7ad" data-element_type="column" data-e-type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-element elementor-element-45000a3 elementor-widget elementor-widget-image"
                        data-id="45000a3" data-element_type="widget" data-e-type="widget"
                        data-widget_type="image.default">
                        <div class="elementor-widget-container">
                            <img loading="lazy" decoding="async" width="819" height="1024"
                                src="{{ asset($settings['about_gallery_3_img1']) }}"
                                class="elementor-animation-hang attachment-large size-large wp-image-5858" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-84ceef7"
                data-id="84ceef7" data-element_type="column" data-e-type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-element elementor-element-ae770d2 elementor-widget elementor-widget-image"
                        data-id="ae770d2" data-element_type="widget" data-e-type="widget"
                        data-widget_type="image.default">
                        <div class="elementor-widget-container">
                            <img loading="lazy" decoding="async" width="803" height="1024"
                                src="{{ asset($settings['about_gallery_3_img2']) }}"
                                class="elementor-animation-hang attachment-large size-large wp-image-5859" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-ab037f0"
                data-id="ab037f0" data-element_type="column" data-e-type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-element elementor-element-d43ab35 elementor-widget elementor-widget-image"
                        data-id="d43ab35" data-element_type="widget" data-e-type="widget"
                        data-widget_type="image.default">
                        <div class="elementor-widget-container">
                            <img loading="lazy" decoding="async" width="806" height="1024"
                                src="{{ asset($settings['about_gallery_3_img3']) }}"
                                class="elementor-animation-hang attachment-large size-large wp-image-5860" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection
