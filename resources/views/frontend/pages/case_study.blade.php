@extends('layouts.master')
@section('meta_description', $caseStudy->meta_description)
@section('meta_author', $caseStudy->client_name)
@section('title', $caseStudy->title_tag)

@section('content')
    <section class="mainContainer">


        @foreach ($caseStudy->sections as $section)

            @if ($section['type'] === 'hero_image')
                @if ($section['top_space'])
                    <section class="section_space"></section>
                @endif
                <section class="casestudies_hero_sec mt-4" data-aos="fade-up">
                    <div class="container d-grid">
                        <div class="casestudies_hero_bg bg-default float-start w-100 d-flex flex-wrap align-items-end"
                            style="background-image: url('{{ \Outerweb\ImageLibrary\Models\Image::find($section['hero_image'])?->getUrl() }}');">
                            <div class="casestudies_hero_des float-start w-100 text-center d-grid">
                                <h1 class="ft-size-40 ft-size-md-32 ft-size-mb-28 color-white fw-black text-capatalize">
                                    {{ $section['title'] }}</h1>
                                <h2 class="ft-size-16 fw-medium color-white">
                                    {{ $section['description'] ?? 'Lorem ipsum dolor sit amet consectetur adipiscing elit.' }}
                                </h2>
                            </div>
                        </div>
                        <div class="casestudies_hero_btm float-start w-100">
                            <ul class="d-flex flex-wrap align-items-center justify-content-center w-100">
                                <li>
                                    <a href="#"><i class="fa-solid fa-share-nodes"></i></a>
                                </li>
                                <li>{{ $caseStudy->created_at->format('F d, Y') }}</li>
                                <li>{{ $caseStudy->caseStudyCategory->name ?? 'Events' }}</li>
                            </ul>
                        </div>
                    </div>
                </section>
                @if ($section['bottom_space'])
                    <section class="section_space"></section>
                @endif
            @endif





            @if ($section['type'] === 'image_text')
                @if ($section['top_space'])
                    <section class="section_space"></section>
                @endif
                <!-- Image and Text Section Variants -->
                @if (!empty($section['top_image']))
                    <div class="casestudies_topImg">
                        <img src="{{ \Outerweb\ImageLibrary\Models\Image::find($section['top_image'])?->getUrl() }}"
                            class="w-100" alt="Top Image">
                    </div>
                @endif

                <section class="casestudies_imagetext_sec casestudies_sect__padding position-relative" data-aos="fade-up"
                    style="background-color: {{ $section['background_color'] ?? '#FFFFFF' }}; {{ !empty($section['has_shape']) ? 'position: relative;' : '' }}">
                    <div class="container">
                        <div class="row gap-5 gap-lg-0 {{ $section['reverse_layout'] ? 'flex-row-reverse' : '' }}">
                            <div class="col-lg-6">
                                <div class="casestudies_imagetextDes w-100 d-flex flex-column mx-auto mx-lg-0">
                                    <span style="color: {{ $section['background_color'] ? '#FFFFFF' : '#ee2a7b' }};"
                                        class="ft-size-12 fw-bold color-pink text-uppercase letter-spacing letter-spacing-35p d-block mb-2">
                                        {{ $section['kicker_title'] ?? 'THE BRIEF' }}
                                    </span>
                                    <h2 style="color: {{ $section['background_color'] ? '#FFFFFF' : '#272727' }};"
                                        class="ft-size-28 ft-size-md-24 ft-size-mb-22 fw-black mb-4">
                                        {{ $section['title_tag'] }}
                                    </h2>
                                    <div style="color: {{ $section['background_color'] ? '#FFFFFF' : '#000' }};"
                                        class="ft-size-18 ft-size-md-16">
                                        {!! $section['copy'] !!}
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div
                                    class="casestudies_imagetextImg float-lg-{{ $section['reverse_layout'] ? 'start' : 'end' }} w-100 mx-auto">
                                    <img src="{{ \Outerweb\ImageLibrary\Models\Image::find($section['image_or_video'])?->getUrl() ?: asset('frontend/images/cstudies_text_img_ph.jpg') }}"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                @if (!empty($section['bottom_image']))
                    <div class="casestudies_bottomImg">
                        <img src="{{ \Outerweb\ImageLibrary\Models\Image::find($section['bottom_image'])?->getUrl() }}"
                            class="w-100" alt="Bottom Image">
                    </div>
                @endif
                @if ($section['bottom_space'])
                    <section class="section_space"></section>
                @endif
            @endif





            @if ($section['type'] === 'text_section')
                @if ($section['top_space'])
                    <section class="section_space"></section>
                @endif
                <!-- Unified Text Section -->
                <section class="casestudies_text_sec casestudies_sect__padding" data-aos="fade-up"
                    style="background-color: {{ $section['background_color'] ?? '#FFFFFF' }};">
                    <div class="container">
                        <div class="casestudies_imagetextDes float-start w-100 mw-100
                         {{ $section['alignment'] === 'center' ? 'text-center' : ($section['alignment'] === 'right' ? 'text-end' : 'text-start') }} d-flex flex-column"
                            style="color: {{ $section['invert_text_color'] ? '#FFFFFF' : '#272727' }};">

                            <span style="color: {{ $section['invert_text_color'] ? '#FFFFFF' : '#ee2a7b' }};"
                                class="ft-size-12 fw-bold text-uppercase letter-spacing letter-spacing-35p d-block mb-2">
                                {{ $section['kicker_title'] ?? 'THE BRIEF' }}
                            </span>

                            <h2 class="ft-size-28 ft-size-md-24 ft-size-mb-22 fw-black mb-4"
                                style="color: {{ $section['invert_text_color'] ? '#FFFFFF' : '#272727' }};">
                                {{ $section['title_tag'] ?? 'Lorem ipsum dolor sit amet' }}
                            </h2>

                            <div class="ft-size-18 ft-size-md-16"
                                style="color: {{ $section['invert_text_color'] ? '#FFFFFF' : '#000' }};">
                                {!! $section['copy'] ?? '' !!}
                            </div>


                            @if (!empty($section['cta_button']))
                                <a href="{{ $section['cta_link'] ?? '#' }}" class="btn_primary mx-auto"
                                    style="color: {{ $section['invert_button_color'] ? '#FFFFFF' : '#272727' }};">
                                    {{ $section['cta_button'] ?? 'Call to action' }}
                                </a>
                            @endif
                        </div>
                    </div>
                </section>
                @if ($section['bottom_space'])
                    <section class="section_space"></section>
                @endif

                <!-- End of Unified Text Section -->
            @endif









            @if ($section['type'] === 'media_section')
                @if ($section['top_space'])
                    <section class="section_space"></section>
                @endif
                <!-- Media Section -->
                <section class="casestudies_media_sect casestudies_sect__padding" data-aos="fade-up"
                    style="background-color: {{ $section['background_color'] ?? '#FFFFFF' }};">
                    <div class="container text-center">
                        @if (!empty($section['is_video']) && !empty($section['media_url']))
                            @php
                                // Extract video ID from YouTube URL
                                if (
                                    preg_match(
                                        '/(youtu\.be\/|youtube\.com\/(watch\?v=|embed\/|v\/|.+\?v=))([^\&\?\/]+)/',
                                        $section['media_url'],
                                        $matches,
                                    )
                                ) {
                                    $videoId = $matches[3];
                                    $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                                } else {
                                    $embedUrl = '';
                                }
                            @endphp

                            @if (!empty($embedUrl))
                                <!-- YouTube Video Section -->
                                <iframe src="{{ $embedUrl }}" title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            @else
                                <p>Invalid YouTube URL</p>
                            @endif
                        @elseif (!empty($section['image_upload']))
                            <!-- Image Section -->
                            <img src="{{ \Outerweb\ImageLibrary\Models\Image::find($section['image_upload'])?->getUrl() }}"
                                alt="Media Image">
                        @else
                            <!-- Placeholder if no video or image -->
                            <img src="{{ asset('frontend/images/default_placeholder.png') }}" alt="Default Image">
                        @endif
                    </div>
                </section>
                <!-- End of Media Section -->
                @if ($section['bottom_space'])
                    <section class="section_space"></section>
                @endif
            @endif







            @if ($section['type'] === 'quote_section')
                @if ($section['top_space'])
                    <section class="section_space"></section>
                @endif
                <!-- Quote Section -->
                <section class="casestudies_quote_sect casestudies_sect__padding" data-aos="fade-up"
                    style="background-color: {{ $section['background_color'] ?? '#FFFFFF' }};">
                    <div class="container">
                        <div class="casestudies_quoteBx float-start w-100 position-relative text-center">
                            <span style="color: {{ $section['invert_text_color'] ? '#FFFFFF' : '#000' }};"
                                class="quote_comas">“</span>
                            <p style="color: {{ $section['invert_text_color'] ? '#FFFFFF' : '#000' }}"
                                class="ft-size-22 ft-size-md-18 fw-bold">
                                {{ $section['quote'] ?? 'Default quote text goes here.' }}
                            </p>
                            <h2 style="color: {{ $section['invert_text_color'] ? '#FFFFFF' : '#ee2a7b' }}"
                                class="ft-size-20 ft-size-md-16 fw-bold text-capatalize mb-2">
                                {{ $section['author'] ?? 'Anonymous' }}
                            </h2>
                            <h3 style="color: {{ $section['invert_text_color'] ? '#FFFFFF' : '#ee2a7b' }}"
                                class="ft-size-18 ft-size-md-14 fw-semibold">
                                {{ $section['author_subtext'] ?? 'Person position/Location/Job' }}
                            </h3>
                        </div>
                    </div>
                </section>
                @if ($section['bottom_space'])
                    <section class="section_space"></section>
                @endif
            @endif






            @if ($section['type'] === 'gallery_section')
                @if ($section['top_space'])
                    <section class="section_space"></section>
                @endif
                @if (!empty($section['layout']))
                    @if ($section['layout'] === 'slider')
                        <!-- Gallery Section - Slider -->
                        <section class="gallery_sect casestudies_sect__padding overflow-hidden" data-aos="fade-up"
                            style="background-color: {{ $section['background_color'] ?? '#FFFFFF' }};">
                            <div class="container">
                                <div class="galry_slider float-start w-100">
                                    <div class="swiper-wrapper">
                                        @foreach ($section['gallery_images'] as $image)
                                            <div class="swiper-slide">
                                                <div class="galery_slides float-start w-100">
                                                    <img src="{{ \Outerweb\ImageLibrary\Models\Image::find($image)?->getUrl() }}"
                                                        alt="Gallery Image" />
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiperbtns d-flex flex-wrap justify-content-center gap-3">
                                        <div class="swiperbtn swiper-button-prev"><i
                                                class="fa-solid fa-arrow-left color-black"></i></div>
                                        <div class="swiperbtn swiper-button-next"><i
                                                class="fa-solid fa-arrow-right color-black"></i></div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @elseif ($section['layout'] === 'grid')
                        <!-- Gallery Grid Section -->
                        <section class="gallery_sect casestudies_sect__padding"
                            style="background-color: {{ $section['background_color'] ?? '#FFFFFF' }};">
                            <div class="container">
                                <div class="csestudies_galery_grid float-start w-100">
                                    <div class="row">
                                        @foreach ($section['gallery_images'] as $image)
                                            <div class="col-lg-3 col-md-4 col-sm-6 csestudies_galeryCol"
                                                data-aos="fade-up">
                                                <div class="csestdiesgridBox float-start w-100">
                                                    <img class="w-100"
                                                        src="{{ \Outerweb\ImageLibrary\Models\Image::find($image)?->getUrl() }}"
                                                        alt="Gallery Grid Image" />
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
                @endif
                @if ($section['bottom_space'])
                    <section class="section_space"></section>
                @endif
            @endif





            @if ($section['type'] === 'results_section')
                @if ($section['top_space'])
                    <section class="section_space"></section>
                @endif
                <!-- Unified Results Section -->
                <section class="result_sect casestudies_sect__padding" data-aos="fade-up"
                    style="background: {{ $section['background_color'] ?? '#212121' }};">
                    <div class="container">
                        <!-- Title and Description -->
                        <div class="casestudies_imagetextDes float-start w-100 mw-100 text-center d-flex flex-column">
                            <span class="ft-size-12 fw-bold text-uppercase letter-spacing letter-spacing-35p d-block mb-2"
                                style="color: #ee2a7b;">
                                {{ $section['kicker_title'] ?? 'THE RESULTS' }}
                            </span>
                            <h2 class="ft-size-28 ft-size-md-25 ft-size-mb-22 fw-black" style="color: #fff;">
                                {{ $section['title_tag'] ?? 'Results Title' }}
                            </h2>
                            <div class="ft-size-18" style="color: #fff;">
                                {!! $section['copy'] ?? '' !!}
                            </div>

                        </div>

                        <div class="csestdies_resultRow float-start w-100">
                            <div
                                class="row {{ $section['template_option'] === 'template_1' ? 'gap-5 gap-lg-0' : 'gap-md-0 gap-3' }}">
                                @foreach ($section['elements'] as $element)
                                    @if ($section['template_option'] === 'template_1')
                                        <!-- Template 1 Layout -->
                                        <div
                                            class="{{ count($section['elements']) === 2 ? 'col-lg-6' : (count($section['elements']) === 3 ? 'col-lg-4' : 'col-lg-3') }}">
                                            <div class="csestdies_heading float-start w-100">
                                                <h3 class="ft-size-24 ft-size-lg-22 ft-size-mb-18 fw-bold d-inline-block  {{ $element['element_heading'] ?? 'invisible' }}"
                                                    style="background:#2F2F2F; color: #fff;">
                                                    {{ $element['element_heading'] ?? 'Default Heading' }}
                                                    @if (!empty($element['element_note']))
                                                        <small class="ft-size-14">{{ $element['element_note'] }}</small>
                                                    @endif
                                                </h3>
                                            </div>
                                            <div class="csestdies_resultBxGrid d-grid w-100">
                                                <div class="csestdies_resultBx w-100 d-grid">
                                                    <span><img src="{{ asset('frontend/images/top_arrow.png') }}"
                                                            alt=""></span>
                                                    <div class="csestdies_resultBxDes float-start w-100">
                                                        <h3 class="counter ft-size-54 ft-size-lg-38 ft-size-md-32 ft-size-mb-24 fw-bold"
                                                            style="color: #ee2a7b;">
                                                            {{ $element['element_value'] ?? 'Value' }}
                                                        </h3>
                                                        <p class="ft-size-16 ft-size-lg-14 ft-size-mb-12 fw-black"
                                                            style="color: #fff;">
                                                            {{ $element['element_title'] ?? 'Title' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($section['template_option'] === 'template_2')
                                        <!-- Template 2 Layout -->
                                        <div
                                            class="{{ count($section['elements']) === 2 ? 'col-md-6' : (count($section['elements']) === 3 ? 'col-md-4' : 'col-md-3') }} csestdies_result2Col">
                                            <div class="csestdies_result2Bx w-100 d-flex flex-wrap align-items-center justify-content-center flex-column text-center"
                                                style="border-color: #fff;">
                                                @if (!empty($element['element_value']))
                                                    <h3 class="counter ft-size-64 ft-size-md-40 ft-size-mb-30 fw-black"
                                                        style="color: #fff;">
                                                        {{ $element['element_value'] }}
                                                    </h3>
                                                @endif
                                                <h4 class="ft-size-24 ft-size-md-20 ft-size-mb-20 fw-black line-height-5"
                                                    style="color: #fff;">
                                                    {{ $element['element_title'] ?? 'Title' }}
                                                </h4>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </div>
                </section>
                @if ($section['bottom_space'])
                    <section class="section_space"></section>
                @endif
            @endif






            @if ($section['type'] === 'comment_slider_section')
                @if ($section['top_space'])
                    <section class="section_space"></section>
                @endif
                <!-- Comments Section -->
                <section class="casestudies_quote_sect casestudies_sect__padding" data-aos="fade-up"
                    style="background-color: {{ $section['background_color'] ?? '#FFFFFF' }};">
                    <div class="container">
                        <!-- Title and Subtitle -->
                        <div class="casestudies_imagetextDes float-start w-100 mw-100 text-center d-flex flex-column">
                            <span class="ft-size-12 fw-bold text-uppercase letter-spacing letter-spacing-35p d-block mb-2"
                                style="color: #ee2a7b;">
                                {{ $section['kicker_title'] ?? 'THE COMMENTS' }}
                            </span>
                            <h2 class="ft-size-28 ft-size-md-25 ft-size-mb-22 fw-black"
                                style="color: {{ $section['invert_text_color'] ? '#FFFFFF' : '#000000' }};">
                                {{ $section['title_tag'] ?? 'Comments Title' }}
                            </h2>
                        </div>

                        <!-- Swiper Slider for Comments -->
                        <div class="coments_slider float-start w-100 overflow-hidden position-relative">
                            <div class="swiper-wrapper">
                                @foreach ($section['comments'] as $comment)
                                    <div class="swiper-slide">
                                        <div class="casestudies_quoteBx float-start w-100 position-relative text-center">
                                            <span style="color: {{ $section['invert_text_color'] ? '#FFFFFF' : '#000' }};"
                                                class="quote_comas">“</span>
                                            <p style="color: {{ $section['invert_text_color'] ? '#FFFFFF' : '#000' }}"
                                                class="ft-size-22 ft-size-md-18 fw-bold">
                                                {{ $comment['quote'] ?? 'Default Quote' }}
                                            </p>
                                            <h2 style="color: #ee2a7b;"
                                                class="ft-size-20 ft-size-md-16 fw-bold text-capitalize mb-2">
                                                {{ $comment['author'] ?? 'Anonymous' }}
                                            </h2>
                                            <h3 style="color: #ee2a7b;" class="ft-size-18 ft-size-md-14 fw-semibold">
                                                {{ $comment['author_subtext'] ?? 'Position/Location' }}
                                            </h3>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination bottom-0"></div>
                        </div>
                    </div>
                </section>
            @endif
            @if ($section['bottom_space'])
                <section class="section_space"></section>
            @endif
        @endforeach


        <section class="ltsget_prjct_sec casestudies_sect__padding text-center position-relative" data-aos="fade-up">
            <span class="lineborder" style="background: #E0E0E0;"></span>
            <div class="container d-grid gap-5">
                <h2 class="ft-size-32 ft-size-md-30 ft-size-md-24 fw-black" style="color: #ee2a7b;">Let’s get your project
                    moving today</h2>
                <a class="btn_primary mx-auto" href="#">Start your project</a>
            </div>
        </section>



    </section>
@endsection
@section('style')
    <style>
        /* Common style for all container classes */
        .ft-size-18,
        .ft-size-md-16 {
            font-size: 18px;
            line-height: 1.5;
            /* Adjust as needed */
            margin: 0;
        }

        /* First container: applying color and specific font size */
        .ft-size-18.ft-size-md-16 p {

        }

        /* Second container: applying color and other specific styles for paragraphs */
        .ft-size-18 p {

            font-size: 18px;
        }

        /* Third container: dynamically applying color based on background */
        .ft-size-18.ft-size-md-16 p {
            color: {{ $section['background_color'] ? '#FFFFFF' : '#000' }};
            font-size: 16px;
        }

        /* Additional customization as needed */
        .ft-size-18.ft-size-md-16 p,
        .ft-size-18 p {
            margin-bottom: 1em;
            /* Ensuring spacing between paragraphs */
        }
    </style>
@endsection
@section('script')
    <script src="{{ asset('frontend/js/counterup.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js" type="text/javascript">
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery(function() {
                "use strict";
                var counterUp = window.counterUp["default"]; // import counterUp from "counterup2"
                var $counters = jQuery(".counter");
                /* Start counting, do this on DOM ready or with Waypoints. */
                $counters.each(function(ignore, counter) {
                    var waypoint = new Waypoint({
                        element: jQuery(this),
                        handler: function() {
                            counterUp(counter, {
                                duration: 2000,
                                delay: 16
                            });
                            this.destroy();
                        },
                        offset: 'bottom-in-view',
                    });
                });

            });
        });
    </script>
    <script>
        var swiper2 = new Swiper(".galry_slider", {
            slidesPerView: 2,
            initialSlide: 1,
            centeredSlides: true,
            //loop: true,
            grabCursor: false,
            //speed: 1000,
            /*autoplay: {
              delay: 6000,
              disableOnInteraction: false,
            },*/
            //freeMode: true,
            //watchSlidesVisibility: true,
            keyboard: {
                enabled: true,
            },
            breakpoints: {
                1440: {
                    spaceBetween: 30,
                },
                1200: {
                    spaceBetween: 30,
                    slidesPerView: 2,
                    initialSlide: 1,
                },
                575: {
                    slidesPerView: 2,
                    initialSlide: 1,
                    spaceBetween: 15,
                },
                320: {
                    slidesPerView: 1,
                    initialSlide: 1,
                    spaceBetween: 15,
                },
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        var swiper = new Swiper(".coments_slider", {
            slidesPerView: 1,
            //initialSlide: 1,
            centeredSlides: true,
            //loop: true,
            grabCursor: false,
            //speed: 1000,
            /*autoplay: {
              delay: 6000,
              disableOnInteraction: false,
            },*/
            //freeMode: true,
            //watchSlidesVisibility: true,
            keyboard: {
                enabled: true,
            },
            /*navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },*/
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
@endsection
