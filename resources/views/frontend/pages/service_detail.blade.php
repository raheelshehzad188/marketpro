@extends('layouts.master')

@section('meta_description', $service->meta_description ?? '')
@section('meta_author', $service->author ?? '')
@section('title', $service->title)

@section('content')
    @if ($service->active_builder)

        {{-- New builder design --}}
        <section class="mainContainer">
            @foreach ($service->sections as $section)
                @if ($section['type'] === 'hero_image')
                    @if ($section['just_image'])
                        <section class="about_bnt" data-aos-duration="800" data-aos="fade-down">
                            <img class="w-100"
                                src="{{ \Outerweb\ImageLibrary\Models\Image::find($section['hero_image'])?->getUrl() }}"
                                alt="{{ $service->title }}">
                        </section>
                    @else
                        <section class="CollabSection clientSection--new bg-pink" data-aos-duration="800" data-aos="fade-down">
                            <div class="container">
                                <div class="Collabwrap Collabwrap--width text-center">
                                    <h1 class="text-white">{{ $section['title'] }}</h1>
                                    <h2 class="text-white px-0">{!! nl2br(e($section['sub_title'])) !!}</h2>
                                    <div class="seprator bg-white"></div>
                                    <p class="text-white"> {{ $section['description'] }}</p>
                                    <span class="white_down_arrow">
                                        <img src="{{ url('frontend') }}/images/white_down_arrow.png" alt="">
                                    </span>
                                </div>
                            </div>
                        </section>
                    @endif
                @endif


                @if ($section['type'] === 'image_text')
                    <section class="services_section" data-aos-duration="800" data-aos="fade-up">
                        <div class="colchesterRow" data-aos="fade-up">
                            <div class="container containerWidth">
                                <div class="row  {{ $section['reverse_layout'] ? 'flex-row-reverse' : '' }}">
                                    <div class="col-md-5">
                                        <div class="colchesterImg colchesterImg--lft float-start">
                                            <img src="{{ \Outerweb\ImageLibrary\Models\Image::find($section['image_or_video'])?->getUrl() }}"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="colchesterDes">
                                            <h2 class="heading">
                                                @if ($section['kicker_title'])
                                                    <small>{{ $section['kicker_title'] }}</small>
                                                @endif

                                                {{ $section['title_tag'] }}
                                            </h2>
                                            {!! $section['copy'] !!}

                                            @if ($section['is_cta'])
                                                <div class="float-start w-100">
                                                    <a href="{{ $section['cta_link'] }}"
                                                        class="btn btn--icon btn--icon-right bubble-btn bubble-btn--width2 ft-size-18 ft-size-mb-16 justify-content-center color-pink border-pink color-white-hover text-transform-none m-0">
                                                        <span class="bubble-btn__inner">
                                                            <span class="bubble-btn__bubbles">
                                                                <span class="bubble-btn__bubble bg-pink"></span>
                                                                <span class="bubble-btn__bubble bg-pink"></span>
                                                                <span class="bubble-btn__bubble bg-pink"></span>
                                                                <span class="bubble-btn__bubble bg-pink"></span>
                                                            </span>
                                                        </span> {{ $section['cta_button_title'] }} </i>
                                                    </a>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif

                @if ($section['type'] === 'client_section')
                    <section class="services_section pt-0" data-aos-duration="800" data-aos="fade-up">

                        <div class="ourwork_sec float-start w-100">
                            <div class="container">
                                <h2 class="ft-size-32 ft-size-md-30 ft-size-md-24 color-black2 fw-black text-center"
                                    data-aos-duration="800" data-aos="fade-up">Our work</h2>

                                <div class="ourwork_grid d-flex flex-wrap justify-content-center" data-aos-duration="800"
                                    data-aos="fade-up">
                                    <div class="latest_prjct_listBx ourwork_Box d-flex flex-wrap justify-content-center position-relative overflow-hidden"
                                        style="background: linear-gradient(180deg, #F65274 0%, #E6017F 100%);">
                                        <a class="prjct_link position-absolute top-0 start-0 w-100 h-100"
                                            href="#"></a>
                                        <img class="img-object-cover img-position-top w-100 align-self-end transition-all"
                                            src="{{ url('frontend') }}/images/our_work_img01.png" alt="">
                                        <div class="latest_prjct_listBxCntnt d-grid position-absolute top-0 start-0 w-100">
                                            <h3 class="ft-size-20 color-white fw-bold transform-capitalize">Evo Supplies
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="latest_prjct_listBx ourwork_Box d-flex flex-wrap justify-content-center position-relative overflow-hidden"
                                        style="background: linear-gradient(180deg, #B84BDE 0%, #6D5AE2 100%);">
                                        <a class="prjct_link position-absolute top-0 start-0 w-100 h-100"
                                            href="#"></a>
                                        <img class="img-object-cover img-position-top w-100 align-self-end transition-all"
                                            src="{{ url('frontend') }}/images/our_work_img02.png" alt="">
                                        <div class="latest_prjct_listBxCntnt d-grid position-absolute top-0 start-0 w-100">
                                            <h3 class="ft-size-20 color-white fw-bold transform-capitalize">Origin Legal
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="latest_prjct_listBx ourwork_Box d-flex flex-wrap justify-content-center position-relative overflow-hidden"
                                        style="background: linear-gradient(266.2deg, #FFDA15 1.27%, #EFAC00 97.4%);">
                                        <a class="prjct_link position-absolute top-0 start-0 w-100 h-100"
                                            href="#"></a>
                                        <img class="img-object-cover img-position-top w-100 align-self-end transition-all"
                                            src="{{ url('frontend') }}/images/our_work_img03.png" alt="">
                                        <div class="latest_prjct_listBxCntnt d-grid position-absolute top-0 start-0 w-100">
                                            <h3 class="ft-size-20 color-white fw-bold transform-capitalize">Poplar Nurseries
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif



                @if ($section['type'] == 'results_section')
                    <section class="seo_results_sect bg-black2" data-aos-duration="800" data-aos="fade-up">
                        <div class="container small-container">
                            <div class="seo_resultsTop float-start w-100">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="seo_resultsLft float-start w-100">
                                            <h2 class="ft-size-22 color-white fw-black">
                                                {{ $section['kicker_title'] }}
                                            </h2>
                                            <p>{{ $section['copy'] }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="seo_resultsRgt float-start w-100">
                                            <div class="csestdies_resultBx w-100 d-grid align-items-start">
                                                <span><img src="{{ url('frontend') }}/images/arrows_group.png"
                                                        alt=""></span>
                                                <div class="csestdies_resultBxDes float-start w-100">
                                                    <h3
                                                        class="counter ft-size-86 ft-size-lg-70 ft-size-md-50 ft-size-mb-24 line-height-1 color-pink fw-bold mb-2">
                                                        {{ $section['elements'][0]['element_value'] ?? 'N/A' }}
                                                    </h3>
                                                    <p class="ft-size-16 ft-size-lg-14 ft-size-mb-12 color-white fw-black">
                                                        {{ $section['elements'][0]['element_title'] ?? 'Description' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="seo_resultsLstng float-start w-100 d-flex flex-wrap justify-content-between">
                                @foreach (array_slice($section['elements'], 1) as $element)
                                    <div class="csestdies_resultBx w-100 d-grid">
                                        <span><img src="{{ url('frontend') }}/images/top_arrow02.png"
                                                alt=""></span>
                                        <div class="csestdies_resultBxDes float-start w-100">
                                            <h3
                                                class="counter ft-size-54 ft-size-lg-38 ft-size-md-32 ft-size-mb-24 color-pink fw-bold">
                                                {{ $element['element_value'] }}
                                            </h3>
                                            <p class="ft-size-16 ft-size-lg-14 ft-size-mb-12 color-white fw-black">
                                                {{ $element['element_title'] }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @if ($section['is_cta'])
                                <div class="float-start w-100 text-center">
                                    <a href="{{ $section['cta_link'] }}"
                                        class="btn btn--icon btn--icon-right bubble-btn bubble-btn--width ft-size-18 ft-size-mb-16 justify-content-center color-white border-white color-black-hover text-transform-none m-0">
                                        <span class="bubble-btn__inner">
                                            <span class="bubble-btn__bubbles">
                                                <span class="bubble-btn__bubble bg-white"></span>
                                                <span class="bubble-btn__bubble bg-white"></span>
                                                <span class="bubble-btn__bubble bg-white"></span>
                                                <span class="bubble-btn__bubble bg-white"></span>
                                            </span>
                                        </span> {{ $section['cta_button_title'] }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </section>
                @endif


                @if ($section['type'] == 'faq_section')
                    <section class="faq_sect">
                        <div class="container">
                            <h2 class="ft-size-32 ft-size-md-30 ft-size-md-24 color-black2 fw-black text-center"
                                data-aos-duration="800" data-aos="fade-up">
                                {{ $section['kicker_title'] ?? 'Frequently Asked Questions' }}
                            </h2>
                            <div class="accordion float-start w-100" id="accordionExample" data-aos-duration="800"
                                data-aos="fade-up">
                                @foreach ($section['faqs'] as $index => $faq)
                                    <div class="accordion-item">
                                        <div class="accordion-header" id="heading{{ $index }}">
                                            <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $index }}"
                                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                                aria-controls="collapse{{ $index }}">
                                                {{ $faq['question_title'] }}
                                            </button>
                                        </div>
                                        <div id="collapse{{ $index }}"
                                            class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                            aria-labelledby="heading{{ $index }}"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                {{ $faq['answer_value'] }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif
            @endforeach


            @if ($section['type'] == 'end_of_journey_cta')
                <section class="ltsget_prjct_sec casestudies_sect__padding text-center position-relative"
                    data-aos="fade-up">
                    <span class="lineborder bg-pink"></span>
                    <div class="container d-grid gap-5">
                        <h2 class="ft-size-32 ft-size-md-30 ft-size-md-24 color-pink fw-black">Let’s get your project
                            moving today</h2>

                        @if ($section['cta_type'] === 'button')
                            <a class="btn_primary mx-auto" href="{{ $section['cta_link'] ?? '#' }}">
                                {{ $section['cta_button_title'] ?? 'Start your project' }}
                            </a>
                        @elseif ($section['cta_type'] === 'form')
                            <form action="{{ $section['cta_link'] ?? '#' }}" method="post" class="mx-auto">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name"
                                        required>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Your Email"
                                        required>
                                </div>
                                <button type="submit" class="btn_primary">
                                    {{ $section['cta_button_title'] ?? 'Submit' }}
                                </button>
                            </form>
                        @endif
                    </div>
                </section>
            @endif

        </section>
    @else
        <section class="mainContainer">
            @if ($children)
                <section class="about_bnt" data-aos-duration="800" data-aos="fade-down">
                    <img class="w-100" src="{{ $service->getFirstMediaUrl('banners') }}" alt="{{ $service->title }}">
                </section>
            @endif
            <section class="cretve_mrktn_sec pt-6 pb-5" data-aos="fade-up">
                <div class="container">
                    <div class="cretve_mrktn_Wrap d-grid m-auto text-center">
                        <h1
                            class="ft-size-50 ft-size-md-38 color-black2 fw-black letter-spacing-p4 m-auto position-relative">
                            {{ $service->title }}</h1>
                        <div class="ft-size-25 ft-size-md-22 line-height-5 color-pink fw-bold m-auto letter-spacing-2">
                            {{ $service->sub_title }}</div>
                        <p class="ft-size-18 ft-size-md-16 color-grey line-height-5 letter-spacing-p75 m-auto">
                            {!! nl2br(e($service->h1_description)) !!}
                        </p>

                    </div>
                </div>
            </section>

            {{-- Our work section --}}
            <section class="our_wrk_sect pt-5 pb-4" data-aos="fade-up">
                <div class="container">
                    <h3
                        class="ft-size-48 ft-size-mb-30 fw-black color-black2 line-height-1 letter-spacing-min-1p2 text-capitalize text-center mb-5">
                        Our Work</h3>
                    <div class="row m-0">
                        <div class="col-12 col-md-4 p-0">
                            <div class="project_galleryBx float-start w-100 position-relative overflow-hidden">
                                <a class="position-absolute top-0 start-0 w-100 h-100" href="#"></a>
                                <img class="w-100 transition-all" src="{{ url('frontend') }}/images/work_img01.png">
                                <div class="project_galleryBx_des position-absolute top-0 start-0 w-100">
                                    <span
                                        class="ft-size-20 ft-size-md-16 color-white fw-bold mb-1 d-block letter-spacing-1">Client</span>
                                    <h4
                                        class="ft-size-20 ft-size-md-16 color-white fw-bold letter-spacing-1 text-capitalize">
                                        Poplar Nurseries</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 p-0">
                            <div class="project_galleryBx float-start w-100 position-relative overflow-hidden">
                                <a class="position-absolute top-0 start-0 w-100 h-100" href="#"></a>
                                <img class="w-100 transition-all" src="{{ url('frontend') }}/images/work_img02.png">
                                <div class="project_galleryBx_des position-absolute top-0 start-0 w-100">
                                    <span
                                        class="ft-size-20 ft-size-md-16 color-white fw-bold mb-1 d-block letter-spacing-1">Client</span>
                                    <h4
                                        class="ft-size-20 ft-size-md-16 color-white fw-bold letter-spacing-1 text-capitalize">
                                        Essex Primary Care Careers – Digital</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 p-0">
                            <div class="project_galleryBx float-start w-100 position-relative overflow-hidden">
                                <a class="position-absolute top-0 start-0 w-100 h-100" href="#"></a>
                                <img class="w-100 transition-all" src="{{ url('frontend') }}/images/work_img03.png">
                                <div class="project_galleryBx_des position-absolute top-0 start-0 w-100">
                                    <span
                                        class="ft-size-20 ft-size-md-16 color-white fw-bold mb-1 d-block letter-spacing-1">Client</span>
                                    <h4
                                        class="ft-size-20 ft-size-md-16 color-white fw-bold letter-spacing-1 text-capitalize">
                                        Clarke Infinity</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="digital_mrktn_sec pt-4 pb-5">
                <div class="container">
                    <div class="digital_mrktn_top float-start w-100 d-grid gap-4 mb-5 text-center" data-aos="fade-up">
                        <h2
                            class="ft-size-50 ft-size-md-38 color-black2 fw-black letter-spacing-p4 m-auto position-relative pb-4">
                            {{ $service->title_h2 }}
                        </h2>
                        <p class="ft-size-18 ft-size-md-16 color-grey line-height-5 letter-spacing-p75">
                            {!! nl2br(e($service->h2_description)) !!}
                        </p>
                    </div>

                    {{-- Sub Services --}}
                    @if ($children)
                        <div class="digital_mrktn_list">
                            <div class="row">
                                @foreach ($children as $child)
                                    <div class="col-12 col-md-6 col-lg-4 mb-4" data-aos-delay="100" data-aos="fade-up">
                                        <div
                                            class="digital_mrktnBx float-start w-100 d-flex flex-wrap align-items-start align-content-start h-100">
                                            <div class="digital_mrktn_img float-start w-100">
                                                <a
                                                    href="{{ route('service.detail', ['parent' => $service->url_title, 'child' => $child->url_title]) }}">
                                                    <img class="w-100" src="{{ $child->getFirstMediaUrl('banners') }}"
                                                        alt="{{ $child->name }}">
                                                </a>
                                            </div>
                                            <div
                                                class="digital_mrktnBx_des float-start w-100 d-flex flex-wrap align-content-start gap-2">
                                                <h3>
                                                    <a class="ft-size-20 color-black2 fw-bold text-capitalize text-decoration-none d-flex flex-wrap align-items-center gap-2"
                                                        href="{{ route('service.detail', ['parent' => $service->url_title, 'child' => $child->url_title]) }}">
                                                        {{ $child->name }} <i class="fas fa-arrow-right"></i>
                                                    </a>
                                                </h3>
                                                <p class="ft-size-18 color-grey letter-spacing-p63">
                                                    {{ $child->card_description }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif


                </div>
            </section>
        </section>
    @endif

@endsection
@section('style')

@endsection
@section('script')
    <script src="{{ asset('frontend/js/counterup.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js" type="text/javascript">
    </script>
    <script type="text/javascript">
        /* =================================================================
                                                                                                                                        COUNTERS
                                                                                                                                        ================================================================= */

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


@endsection
