@extends('frontend.layouts.app')

@section('content')

    {{-- Categories , Sliders . Today's deal --}}
    @if (get_setting('home_slider_images') != null)
        @foreach (json_decode(get_setting('home_slider_images'), true) as $key => $value)
            <div class="d-block  home-banner-area   bg-no-repeat  bg-cover bg-center lazyload"
                style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                data-bg="{{ uploaded_asset(json_decode(get_setting('home_slider_images'), true)[$key]) }}">
                <div class="container-fluid ps-0 pe-0">
                    <div class="row position-relative">
                        <div class="col-md-12 text-white text-shadow fw-800">
                            <div class="container">
                                <div class="hero-content">
                                    <h2 class="intro-title lh-1-4">
                                        {{ json_decode(get_setting('home_slider_title'), true)[$key] }}</h2>
                                    {{-- <h3 class="h4 text-nocaps mb-4 mt-4 d-md-block d-none">Water Efficient Gardens is an online
                                    landscape design business that excels in
                                    low water and native plant garden designs.</h3> --}}
                                    <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}"
                                        class="bg-2 text-white fs-18 py-2 px-4 fw-800 border-round mt-2 mt-sm-4 d-inline-block hover-green">START
                                        MY PROJECT</a>
                                </div>

                            </div>
                            <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                data-src="{{ static_asset('assets/img/hero-image.jpg') }}"
                                class="w-100 lazyload invisible">


                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <section class="brand-logos bg-white text-center pt-sm-5 pt-3">
        <div class="container">
            <div class="row  align-items-center">
                @if (get_setting('home_top_logo') != null)
                    @foreach (json_decode(get_setting('home_top_logo'), true) as $key => $value)
                        <div class="col-md-3 col-6">
                            <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                data-src="{{ uploaded_asset(json_decode(get_setting('home_top_logo'), true)[$key]) }}"
                                class="img-fluid lazyload">
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>


    <section class="top-image-boxes bg-white pt-sm-5 pt-3  pb-sm-5 pb-3">
        <div class="container">
            <div class="row  align-items-center">
                @if (get_setting('home_top_images') != null)
                    @foreach (json_decode(get_setting('home_top_images'), true) as $key => $value)
                        <div class="col-lg-3 col-sm-6 mt-3">
                            <a href="" class="d-block shadow bg-no-repeat bg-cover bg-center lazyload"
                                style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                data-bg="{{ uploaded_asset(json_decode(get_setting('home_top_images'), true)[$key]) }}">
                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ static_asset('assets/img/image1.jpg') }}"
                                    class="img-fluid invisible lazyload">
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    @if (get_setting('home_matric_image') != null)
        @foreach (json_decode(get_setting('home_matric_image'), true) as $key => $value)
            <section class="parallex home bg-no-repeat h-250px bg-cover bg-center lazyload"
                style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                data-bg="{{ uploaded_asset(json_decode(get_setting('home_matric_image'), true)[$key]) }}">
                <div class="inner-lay py-5">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-7 col-md-6 left">
                                <div class="row">
                                    <div class="col-12 counters">
                                        <span
                                            class="ff-ultra color-3 counter">{{ json_decode(get_setting('home_matric_one'), true)[$key] }}</span>
                                        <span class="ff-bold color-3">sq ft</span>
                                    </div>
                                    <div class="col-12 counters">
                                        <span
                                            class="ff-ultra color-4 counter">{{ json_decode(get_setting('home_matric_two'), true)[$key] }}</span>
                                        <span class="ff-bold color-4">gal</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6 right">
                                <div class="title text-white fw-600 text-end">
                                    {{ json_decode(get_setting('home_matric_title'), true)[$key] }}</div>
                                <div class="p text-white fs-18 text-end">
                                    {{ json_decode(get_setting('home_matric_detail'), true)[$key] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    @endif

    <section class="calculator py-sm-5 py-3">
        <div class="container space-1 space-1--lg">
            <div class="row justify-content-lg-between align-items-lg-center">
                <div class="col-lg-3 mb-9 mb-lg-0 mb-5">
                    <div class="fs-20 fw-600">Calculate How Much You Can Save</div>
                    <div class="fs-15 mt-3 mb-3">
                        Enter information from your water bill to find out how much water and money you can save.
                    </div>
                    <div class="form-group row g-0">
                        <div class="col-3">
                            <input type="number" onkeyup="drawChart()" class="form-control" name="lawnSize" value="1000"
                                id="lawnsizegraphvalue">
                        </div>
                        <label for="inputEmail3" class="col-9 col-form-label"> Square Feet of Your Lawn</label>
                    </div>
                    <div class="form-group row g-0">
                        <div class="col-3">
                            <input type="number" onkeyup="drawChart()" class="form-control" name="days" value="58"
                                id="daysgraphvalue">
                        </div>
                        <label for="inputEmail3" class="col-9 col-form-label">Days of Cycle In Your Last Water
                            Bill</label>
                    </div>

                    <div class="form-group row g-0">
                        <div class="col-3">
                            <input type="number" onkeyup="drawChart()" class="form-control" name="houseCCF" value="20"
                                id="houseccfgraphvalue">
                        </div>
                        <label for="inputEmail3" class="col-9 col-form-label"> CCF (Centum Cubit Feet) In Your Last
                            Water Bill</label>
                    </div>

                    <div class="form-group row g-0">
                        <div class="col-3">
                            <input type="number" onkeyup="drawChart()" class="form-control" name="billAmount" value="120"
                                id="billamountgraphvalue">
                        </div>
                        <label for="inputEmail3" class="col-9 col-form-label"> $ Amount Charged In Your Last Water
                            Bill</label>
                    </div>

                    <a href="{{route('water_savings')}}"
                        class="fs-16 fw-600 mt-3 fm-bold text-decoration-underline w-100 text-center d-block">Learn
                        More</a>
                </div>

                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="chart_div" class="w-100"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="chart_div3" class="w-100"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div id="chart_div2" class="w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="quiz-section bg-white text-center py-sm-5 py-3 bg-3">
        <div class="container">
            <div class="row  align-items-center">

                <div class="col-lg-9 text-end order-lg-1 order-2">
                    <div class="row">
                        <div class="col-md-4 mx-auto col-sm-6 mb-3 position-relative">
                            <a href="<?= route('style_quiz') ?>" class="d-block shadow bg-no-repeat  bg-cover bg-center lazyload"
                                style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                data-bg="{{ static_asset('assets/img/quiz1.jpg') }}">
                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ static_asset('assets/img/quiz1.jpg') }}"
                                    class="img-fluid invisible lazyload">
                                <div class="ribbon">
                                    <div class="ribbon-content">
                                        <p><b>RAIN GARDEN</b></p>
                                    </div>
                                </div>

                            </a>
                        </div>
                        <div class="col-md-4 mx-auto col-sm-6 mb-3 position-relative">
                            <a href="<?= route('style_quiz') ?>" class="d-block shadow bg-no-repeat bg-cover bg-center lazyload"
                                style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                data-bg="{{ static_asset('assets/img/quiz2.jpg') }}">
                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ static_asset('assets/img/quiz1.jpg') }}"
                                    class="img-fluid invisible lazyload">
                                <div class="ribbon">
                                    <div class="ribbon-content">
                                        <p><b>RAIN GARDEN</b></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mx-auto col-sm-6 mb-3 position-relative">
                            <a href="<?= route('style_quiz') ?>" class="d-block shadow bg-no-repeat bg-cover bg-center lazyload"
                                style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                data-bg="{{ static_asset('assets/img/quiz3.jpg') }}">
                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ static_asset('assets/img/quiz1.jpg') }}"
                                    class="img-fluid invisible lazyload">
                                <div class="ribbon">
                                    <div class="ribbon-content">
                                        <p><b>Pollinator Garden</b></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 left text-end order-lg-2 order-1 pb-4 pb-lg-0">
                    <div class="title-tip fs-18">STYLE QUIZ</div>
                    <div class="title fs-28 fs-500">Find the garden
                        style that’s
                        right for you.</div>
                    <a href="<?= route('style_quiz') ?>"
                        class="btn btn-primary bg-1 text-white border-none fs-18 btn-rounded fw-600 mt-3 hover-blue">TAKE
                        THE QUIZ</a>
                </div>
            </div>
        </div>
    </section>

    <section class="how-to bg-white text-center py-3 py-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading fs-32 pb-sm-5 pb-3 px-5">How Online Landscaping Works</div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 col-sm-6 mx-auto mb-3">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/how1.jpg') }}" class="img-fluid lazyload">
                    <div class="title ff-bold fs-18 py-3">1. Tell Us What You Like</div>
                    <div class="p fs-18">Finish the garden style quiz.</div>
                </div>
                <div class="col-md-4 col-sm-6 mx-auto mb-3">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/how2.jpg') }}" class="img-fluid lazyload">
                    <div class="title ff-bold fs-18 py-3">2. Show Us Your Space</div>
                    <div class="p fs-18">Take some photos and measurements of your yard, and tell us what you
                        want in the design.</div>
                </div>
                <div class="col-md-4 col-sm-6 mx-auto mb-3">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/how3.jpg') }}" class="img-fluid lazyload">
                    <div class="title ff-bold fs-18 py-3">3. Receive Your Design</div>
                    <div class="p fs-18">We will work with you to develop concepts, choose the one you like, and
                        create the final design. </div>
                </div>

            </div>
        </div>
    </section>

    <section class="benefits bg-4 text-center py-sm-5 py-3">
        <div class="container">
            <div class="row">
                <div class="col-10 mx-auto">
                    <div class="section-heading fs-32 mb-3">
                        Benefits of Water Efficient Gardens
                    </div>
                    <div class="section-overview fs-20 mb-5">
                        We’re so passionate about the difference we’re making. Join in today to have
                        your own water efficient garden!
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-2 col-md-4 mb-5 order-lg-1">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/save-water-icon1.png') }}" class="img-fluid lazyload">
                    <div class="title ff-bold fs-18 lh-1-2 mt-4 mb-3">Save Water</div>
                    <div class="p fs-18 lh-1-2">Finish the garden style quiz.</div>
                </div>
                <div class="col-lg-2 col-md-4 mb-5 order-lg-2">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/save-water-icon2.png') }}" class="img-fluid lazyload">
                    <div class="title ff-bold fs-18 lh-1-2 mt-4 mb-3">Low Maintenance</div>
                    <div class="p fs-18 lh-1-2">No more mowing the grass!</div>
                </div>
                <div class="col-lg-3 col-md-6 mb-5 order-lg-3 order-4">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/save-water-icon3.png') }}" class="img-fluid lazyload">
                    <div class="title ff-bold fs-18 lh-1-2 mt-4 mb-3">Combat Climate Change</div>
                    <div class="p fs-18 lh-1-2">Native & drought tolerant plants can absorb carbon dioxide and improve the structure of soil, which in turn will store more carbon.</div>
                </div>
                <div class="col-lg-2 col-md-4 mx-auto mb-5 order-lg-4">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/save-water-icon4.png') }}" class="img-fluid lazyload">
                    <div class="title ff-bold fs-18 lh-1-2 mt-4 mb-3">Curb Appeal</div>
                    <div class="p fs-18 lh-1-2">Boosts the value of
                        your property.</div>
                </div>
                <div class="col-lg-3 col-md-6 mx-auto mb-5 order-lg-5">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/save-water-icon5.png') }}" class="img-fluid lazyload">
                    <div class="title ff-bold fs-18 lh-1-2 mt-4 mb-3">Create a Habitat for Wildlife</div>
                    <div class="p fs-18 lh-1-2">Flowers provide food to
                        pollinators, and gardens
                        provide them a shelter.</div>
                </div>

            </div>
        </div>
    </section>


    <section class="blog-section bg-white text-center py-3 my-lg-4 my-2 py-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 left text-start">
                    <div class="title-tip fs-18">PORTFOLIO</div>
                    <div class="title fs-28 fw-500 mt-3 mb-3">A Few
                        Gardens We’ve
                        Designed</div>
                    <a href="{{ route('portfolio') }}"
                        class="btn btn-primary bg-2 text-white border-none fs-18 btn-rounded fw-600 mt-lg-3 mt-0 mb-lg-0 mb-4 text-uppercase">View
                        more</a>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        @foreach ($featured_portfolio as $row)
                            <div class="col-sm-6 mb-3">
                                <a href="{{ route('portfolio_detail', $row['slug']) }}">
                                    <div class="d-block shadow bg-no-repeat bg-cover bg-center lazyload"
                                        style="background-image: url('{{ uploaded_asset($row->feature_image) }}');"
                                        data-bg="{{ static_asset('assets/img/blog1.png') }}">
                                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                            data-src="{{ static_asset('assets/img/blog1.png') }}"
                                            class="img-fluid invisible lazyload">
                                    </div>
                                    <div class="title text-dark ff-bold fs-18 py-3 text-start lh-1-2">{{ $row->title }}
                                    </div>
                                    <div class="p text-dark text-start fs-18 lh-1-2 mb-3">{{ $row->short_description }}
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="testimonial bg-3 pt-5">
        <div class="container ">
            <div class="row">
                <div class="col-10 mx-auto">
                    <div class="section-heading text-center fs-32 mb-4">
                        Real Customer Stories
                    </div>
                </div>
            </div>
            <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height" data-arrows="true" data-dots="false"
                data-autoplay="false">
                @foreach ($featured_testimonial as $key => $testimonial)
                    @if (json_decode($testimonial->images, true) != null)
                        @php
                            $images = json_decode($testimonial->images, true);
                        @endphp
                        @if (isset($images['img'][0]) && isset($images['img'][1]))
                            <div class="carousel-box">
                                <div class="row align-items-lg-center">
                                    <div class="col-md-6">
                                        <div class="w-100 bg-no-repeat bg-cover bg-center lazyload mb-2"
                                            style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                            data-bg="{{ uploaded_asset($images['img'][0]) }}">
                                            <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                class="img-fluid lazyload invisible"
                                                data-src="{{ static_asset('assets/img/testihome.jpg') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="w-100 bg-no-repeat bg-cover bg-center lazyload mb-2"
                                            style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                            data-bg="{{ uploaded_asset($images['img'][1]) }}">
                                            <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                class="img-fluid lazyload invisible"
                                                data-src="{{ static_asset('assets/img/testihome.jpg') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row controls my-4">
                                    <div class="col-12 text-center">
                                        <a href="javascript:void(0)" onclick="click_left()" class=" fs-24 text-dark me-2">
                                            <i class="las la-angle-left" onclick="click_left()"></i></a>
                                        <span class="ff-bold fs-18">Story {{ $key + 1 }} of
                                            {{ count($featured_testimonial) }}</span>
                                        <a href="javascript:void(0)" onclick="click_right()"
                                            class="fs-24 text-dark ms-2"><i class="las la-angle-right"
                                                onclick="click_right()"></i></a>
                                    </div>
                                </div>

                                <div class="row align-items-lg-center">

                                    <div class="col-md-10 text-center mx-auto">

                                        <div class="detail fs-18 mb-4 ps-4">
                                            ”{{ $testimonial->reviews }}”
                                        </div>
                                        <div class="auther row align-items-center  justify-content-center mb-5">
                                            <div class="col-md-auto">
                                                <div class="img bg-no-repeat bg-cover bg-center lazyload h-70px w-70px"
                                                    style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                                    data-bg="{{ uploaded_asset($testimonial->logo) }}"></div>
                                            </div>
                                            <div class="col-md-auto">
                                                <div class="row align-items-center w-200px text-start">
                                                    <div class="col-12 ff-bold fs-18 ">
                                                        {{ $testimonial->name }}
                                                    </div>
                                                    <div class="col-12 fs-18">
                                                        {{ $testimonial->position }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>

        </div>
    </section>

    {{-- <section class="testimonial">
        <div class="container-fluid bg-3">
            <div class="row align-items-lg-center">
                <div class="col-md-7 bg-no-repeat bg-cover bg-center lazyload"
                    style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                    data-bg="{{ static_asset('assets/img/review.jpg') }}">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}" class="img-fluid lazyload invisible"
                        data-src="{{ static_asset('assets/img/review.jpg') }}">
                </div>
                <div class="col-md-5 text-start">
                    <div class="title fs-32 py-4 ps-4">Don’t Take Our
                        Word For It</div>
                    <div class="review_star py-2 ps-4">
                        <i class="las la-star fs-28 color-2 py-3"></i>
                        <i class="las la-star fs-28 color-2 py-3"></i>
                        <i class="las la-star fs-28 color-2 py-3"></i>
                        <i class="las la-star fs-28 color-2 py-3"></i>
                        <i class="las la-star fs-28 color-2 py-3"></i>
                    </div>
                    <div class="detail fs-18 mb-4 ps-4">
                        ”Really want to thank Water Efficient Garden
                        for designing my new rain garden with
                        drought tolerant plants. They did a wonderful job on my yard. I am not depressed like I used
                        to be when I looked out the window with all the weeds, and I have been getting approval from
                        all my neighbors!”
                    </div>
                    <div class="auther row align-items-center pb-4 ps-4">
                        <div class="col-md-auto">
                            <div class="img bg-no-repeat bg-cover bg-center lazyload h-70px w-70px"
                                style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                data-bg="{{ static_asset('assets/img/review_author.png') }}"></div>
                        </div>
                        <div class="col-md-auto">
                            <div class="row align-items-center">
                                <div class="col-12 ff-bold fs-18">
                                    Debbie L.
                                </div>
                                <div class="col-12 fs-18">
                                    West San Jose, CA
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}


    <section class="partner-logos bg-4 text-center py-5">
        <div class="container">
            <div class="row">
                <div class="col-10 mx-auto">
                    <div class="section-heading fs-32 mb-5">
                        We are Proud Members and Partners of:
                    </div>
                </div>
            </div>
            <div class="row  align-items-center">
                @if (get_setting('home_bottom_logo') != null)
                    @foreach (json_decode(get_setting('home_bottom_logo'), true) as $key => $value)
                        <div class="col-md-3 col-sm-4 col-6 mx-auto mb-4">
                            <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                data-src="{{ uploaded_asset(json_decode(get_setting('home_bottom_logo'), true)[$key]) }}"
                                class="img-fluid lazyload">
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section class="insta-feed bg-white text-center pt-5">
        <div class="container-fluid px-0">
            <div class="row">
                <div class="col-10 mx-auto">
                    <div class="section-heading fs-32 mb-3">
                        Follow Us on Social!
                    </div>
                    <div class="section-social fs-32 mb-5">
                        <a href=""><i class="lab la-instagram me-4"></i></a>
                        <a href=""><i class="lab la-twitter me-4"></i></a>
                        <a href=""><i class="lab la-facebook-f me-4"></i></a>
                        <a href=""><i class="lab la-pinterest"></i></a>
                    </div>
                </div>
            </div>
            <div class="row  align-items-center g-0">
                <div class="col-lg-3 col-sm-6">
                    <a href="" class="d-block  bg-no-repeat bg-cover bg-center lazyload"
                        style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                        data-bg="{{ static_asset('assets/img/insta1.jpg') }}">
                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                            data-src="{{ static_asset('assets/img/insta4.jpg') }}" class="img-fluid invisible lazyload">
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="" class="d-block  bg-no-repeat  bg-cover bg-center lazyload"
                        style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                        data-bg="{{ static_asset('assets/img/insta2.jpg') }}">
                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                            data-src="{{ static_asset('assets/img/insta4.jpg') }}" class="img-fluid invisible lazyload">
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="" class="d-block  bg-no-repeat  bg-cover bg-center lazyload"
                        style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                        data-bg="{{ static_asset('assets/img/insta3.jpg') }}">
                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                            data-src="{{ static_asset('assets/img/insta4.jpg') }}" class="img-fluid invisible lazyload">
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="" class="d-block  bg-no-repeat  bg-cover bg-center lazyload"
                        style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                        data-bg="{{ static_asset('assets/img/insta4.jpg') }}">
                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                            data-src="{{ static_asset('assets/img/insta4.jpg') }}" class="img-fluid invisible lazyload">
                    </a>
                </div>

            </div>
        </div>
    </section>

    <style>
        /* .testimonial .slick-prev,
        .testimonial .slick-next {
            visibility: hidden !important;
        } */

    </style>
@endsection

@section('script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="{{ static_asset('assets/js/jquery.countup.min.js') }}"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        var lawnSize = 1000;
        var days = 58;
        var houseCCF = 20;
        var billAmount = 120
        var ccfGallon = houseCCF * 748;
        var lawn = lawnSize / 1000 * 623 * days / 7;
        var nonlawn = ccfGallon - lawn;
        var garden = (lawnSize / 1000 * 623 * days / 7) - (50 * days)
        var gardenAmount = (nonlawn + garden) * (billAmount / ccfGallon)


        google.load("visualization", "1", {
            packages: ["corechart"]
        });
        google.setOnLoadCallback(drawChart);

        function drawChart() {

            lawnSize = document.getElementById('lawnsizegraphvalue').value * 1;
            days = document.getElementById('daysgraphvalue').value * 1;
            houseCCF = document.getElementById('houseccfgraphvalue').value * 1;
            billAmount = document.getElementById('billamountgraphvalue').value * 1;
            ccfGallon = houseCCF * 748;
            lawn = lawnSize / 1000 * 623 * days / 7;
            nonlawn = ccfGallon - lawn;
            garden = ((623 / 7) - 50) * lawnSize * days / 1000
            gardenAmount = (nonlawn + garden) * (billAmount / ccfGallon)



            var data = google.visualization.arrayToDataTable([
                ['Type', 'Gallons', {
                    role: "style"
                }],
                ['Lawn', lawn, '#627378'],
                ['Water Efficient Garden', garden, '#1d9bcf'],
            ]);

            var data2 = google.visualization.arrayToDataTable([
                ['Type', 'Non-Garden/Lawn', 'Garden/Lawn', {
                    role: 'annotation'
                }],
                ['Indoor + Lawn', nonlawn, lawn, ''],
                ['Indoor + Water Efficient Garden', nonlawn, garden, '']
            ]);

            var data3 = google.visualization.arrayToDataTable([
                ['Type', '$Amount', {
                    role: 'style'
                }],
                ['Lawn', billAmount, '#627378'],
                ['Water Efficient Garden', gardenAmount, '#8dc54f']
            ]);

            var options = {
                title: 'Est. Water Use for Landscaping',
                titleTextStyle: {
                    color: 'black',
                    fontName: 'GothamBold',
                    fontSize: '17',
                },
                'legend': 'left',
                'chartArea': {
                    width: '70%'
                }
            };

            var options2 = {
                title: 'Est. Total Water Use for the Household',
                titleTextStyle: {
                    color: 'black',
                    fontName: 'GothamBold',
                    fontSize: '17',
                },
                isStacked: true,
                'chartArea': {
                    width: '70%'
                },
                series: {
                    0: {
                        color: '#bcc3c5'
                    },
                    1: {
                        color: '#1d9bcf'
                    },
                }
            };

            var options3 = {
                title: 'Est. $ Amount Charged',
                titleTextStyle: {
                    color: 'black',
                    fontName: 'GothamBold',
                    fontSize: '17',
                },
                'legend': 'left',
                'chartArea': {
                    width: '70%'
                }
            };

            var chartContainer1 = document.getElementById('chart_div');
            var chart = new google.visualization.BarChart(chartContainer1);
            google.visualization.events.addListener(chart, 'ready', function() {
                var labels = chartContainer1.getElementsByTagName('text');
                for (var i = 0; i < labels.length; i++) {
                    // determine if label should be bold
                    labels[i].setAttribute('font-family', 'Gotham');
                    labels[i].setAttribute('font-weight', '600');
                }
            });
            chart.draw(data, options);
            var chartContainer2 = document.getElementById('chart_div2');
            var chart2 = new google.visualization.BarChart(chartContainer2);
            google.visualization.events.addListener(chart2, 'ready', function() {
                var labels = chartContainer2.getElementsByTagName('text');
                for (var i = 0; i < labels.length; i++) {
                    // determine if label should be bold
                    labels[i].setAttribute('font-family', 'Gotham');
                    labels[i].setAttribute('font-weight', '600');
                }
            });
            chart2.draw(data2, options2);
            var chartContainer3 = document.getElementById('chart_div3');
            var chart3 = new google.visualization.BarChart(chartContainer3);
            google.visualization.events.addListener(chart3, 'ready', function() {
                var labels = chartContainer3.getElementsByTagName('text');
                for (var i = 0; i < labels.length; i++) {
                    // determine if label should be bold
                    labels[i].setAttribute('font-family', 'Gotham');
                    labels[i].setAttribute('font-weight', '600');
                }
            });
            chart3.draw(data3, options3);
        }

        $('.counter').countUp();
    </script>
    <script>
        function click_left() {
            $('.slick-prev').click();
        }

        function click_right() {
            $('.slick-next').click();
        }
    </script>
@endsection
