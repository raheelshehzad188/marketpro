@extends('frontend.layouts.master')
{{-- @section('meta_description', $blog->meta_description ?? '')
@section('meta_author', $blog->author ?? '') --}}
@section('title', 'Home')

@section('content')
    <div role="main" class="main">

        <div class="owl-carousel home-slider owl-carousel-light owl-theme manual dots-inside dots-horizontal-center show-dots-hover show-dots-xs nav-style-1 nav-inside nav-inside-plus nav-dark nav-lg nav-font-size-lg show-nav-hover mb-0"
            data-plugin-options="{'autoplayTimeout': 7000}" data-dynamic-height="['390px','390px','300px','390px','150px']"
            style="height: 490px;">

            <div class="owl-stage-outer">
                <div class="owl-stage">

                    <!-- Dynamic Carousel Slides -->
                    @if (get_setting('hero_slider_images') != null)
                        @foreach (json_decode(get_setting('hero_slider_images'), true) as $key => $imageId)
                            <div class="owl-item position-relative">
                                <a href="{{ json_decode(get_setting('hero_slider_links'), true)[$key] ?? '#' }}">
                                    <div class="background-image-wrapper position-absolute top-0 left-0 right-0 bottom-0"Â
                                        data-appear-animation="kenBurnsToRight"
                                        style="
                                    background-image: url('{{ uploaded_asset($imageId) }}');
                                    background-size: cover;
                                    background-position: center !important;
                                    background-repeat: no-repeat;">
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <!-- Default Slide -->
                        <div class="owl-item position-relative">
                            <div class="background-image-wrapper position-absolute top-0 left-0 right-0 bottom-0"
                                data-appear-animation="kenBurnsToRight"
                                style="
                            background-image: url('{{ asset('frontend/img/srs-images/slider.png') }}');
                            background-size: cover;
                            background-position: center !important;
                            background-repeat: no-repeat;">
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Navigation Controls -->
                <div class="owl-nav">
                    <button type="button" role="presentation" class="owl-prev" aria-label="Previous"></button>
                    <button type="button" role="presentation" class="owl-next" aria-label="Next"></button>
                </div>
            </div>
        </div>



        <!-- Home top bar Start-->
        <section class="topbar-section">
            <div class="container-fluid no-padding">
                <div class="container">
                    <div class="row text-center text-md-start no-padding">
                        <div class="col-sm-6 col-md-3 text-center topbarmain">
                            <div class="icons-align">
                                <img src="{{ asset('frontend/img/srs-images/icons/free-shipping.png') }}"
                                    class="free-shipping">
                                <p>FREE SHIPPING</p>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-3 text-center topbarmain">
                            <div class="icons-align">
                                <img src="{{ asset('frontend/img/srs-images/icons/return.png') }}" class="free-shipping">
                                <p>FREE RETURNS</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 text-center topbarmain">
                            <div class="icons-align">
                                <img src="{{ asset('frontend/img/srs-images/icons/card.png') }}" class="free-shipping">
                                <p>SECURE PAYMENTS</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 text-center topbarmain">
                            <div class="icons-align">
                                <img src="{{ asset('frontend/img/srs-images/icons/customer.png') }}" class="free-shipping">
                                <p>CUSTOMER CARE</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Home top bar close-->



        <!-- Home Banner Start -->
        <section class="banner-section hide-mobile">
            <div class="container">
                <div class="row text-center text-md-start">
                    @if (get_setting('advert_banner_image') != null)
                        @foreach (json_decode(get_setting('advert_banner_image'), true) as $key => $imageId)
                            <a href="{{ json_decode(get_setting('advert_banner_link'), true)[$key] ?? '#' }}">
                                <img src="{{ uploaded_asset($imageId) }}" class="img-fluid" alt="Advert Banner">
                            </a>
                        @endforeach
                    @else
                        <!-- Default Placeholder Banner -->
                        <img src="{{ asset('frontend/img/srs-images/banner.png') }}" class="img-fluid"
                            alt="Responsive image">
                    @endif
                </div>
            </div>
        </section>
        <!-- Home Banner Close -->



        <!-- Home Category Start -->
        <section class="categorie-section">
            <div class="container">
                <div class="row text-md-start">
                    @if (get_setting('top_category_images') != null)
                        @foreach (json_decode(get_setting('top_category_images'), true) as $key => $imageId)
                            <div
                                class="col-sm-12 col-md-4 category-main anim-hover-translate-top-10px transition-3ms d-inline-block">
                                <img src="{{ uploaded_asset($imageId) }}" class="img-fluid" alt="Category Image">
                                <div class="category-inner">
                                    <a href="{{ json_decode(get_setting('top_category_links'), true)[$key] ?? '#' }}">
                                        {{ json_decode(get_setting('top_category_names'), true)[$key] ?? 'Category' }}
                                    </a>
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Default Categories -->
                        <div
                            class="col-sm-12 col-md-4 category-main anim-hover-translate-top-10px transition-3ms d-inline-block">
                            <img src="{{ asset('frontend/img/srs-images/category1.png') }}" class="img-fluid"
                                alt="Default Category Image">
                            <div class="category-inner">
                                <a href="#">Default Category 1</a> <i class="fa-solid fa-arrow-right-long"></i>
                            </div>
                        </div>
                        <div
                            class="col-sm-12 col-md-4 category-main anim-hover-translate-top-10px transition-3ms d-inline-block">
                            <img src="{{ asset('frontend/img/srs-images/category2.png') }}" class="img-fluid"
                                alt="Default Category Image">
                            <div class="category-inner">
                                <a href="#">Default Category 2</a> <i class="fa-solid fa-arrow-right-long"></i>
                            </div>
                        </div>
                        <div
                            class="col-sm-12 col-md-4 category-main anim-hover-translate-top-10px transition-3ms d-inline-block">
                            <img src="{{ asset('frontend/img/srs-images/category3.png') }}" class="img-fluid"
                                alt="Default Category Image">
                            <div class="category-inner">
                                <a href="#">Default Category 3</a> <i class="fa-solid fa-arrow-right-long"></i>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <!-- Home Category Close -->


        <!-- Home Category Second Start -->
        <section class="categorie-second-section">
            <div class="container">
                <div class="row text-md-start inner-row-category">
                    @if (get_setting('additional_category_images') != null)
                        @foreach (json_decode(get_setting('additional_category_images'), true) as $key => $imageId)
                            <div
                                class="col-sm-12 col-md-3 category-main-inner anim-hover-translate-top-10px transition-3ms d-inline-block mb-4">
                                <img src="{{ uploaded_asset($imageId) }}" class="img-fluid"
                                    alt="Additional Category Image">
                                <div class="category-inner">
                                    <a
                                        href="{{ json_decode(get_setting('additional_category_links'), true)[$key] ?? '#' }}">
                                        {{ json_decode(get_setting('additional_category_names'), true)[$key] ?? 'Category' }}
                                    </a>
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Default Categories -->
                        @foreach (range(1, 8) as $i)
                            <div
                                class="col-sm-12 col-md-3 category-main-inner anim-hover-translate-top-10px transition-3ms d-inline-block mb-4">
                                <img src="{{ asset('frontend/img/srs-images/cat-inner-' . $i . '.png') }}"
                                    class="img-fluid" alt="Default Category Image">
                                <div class="category-inner">
                                    <a href="#">Default Category {{ $i }}</a>
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
        <!-- Home Category Second Close -->


        <!-- Home Products Start-->
        <section class="product-section">
            <div class="container">
                <h1 class="product-heading">Featured products</h1>
                <div class="masonry-loader masonry-loader-loaded">
                    <div class="row products product-thumb-info-list" data-plugin-masonry=""
                        data-plugin-options="{'layoutMode': 'fitRows'}">
                        @foreach (range(1, 8) as $i)
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="product mb-0">
                                    <div class="product-thumb-info border-0 mb-3">
                                        <a href="shop-product-sidebar-left.html">
                                            <div class="product-thumb-info-image">
                                                <img src="{{ asset('frontend/img/srs-images/product' . $i . '.png') }}"
                                                    alt="" class="img-fluid">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <div>
                                            <h3
                                                class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0 text-center">
                                                <a href="shop-product-sidebar-right.html"
                                                    class="text-color-dark text-color-hover-primary product-title">Product
                                                    {{ $i }}</a>
                                            </h3>
                                        </div>
                                    </div>
                                    <div title="Rated 5 out of 5">
                                        <input type="text" class="d-none" value="5" title=""
                                            data-plugin-star-rating=""
                                            data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
                                    </div>
                                    <p class="price text-5 mb-3">
                                        <span class="sale text-color-dark font-weight-semi-bold">25,50kr</span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- Home Products Close-->

        <!-- Home Banner Start -->
        <section class="banner-section2">
            <div class="container">
                <div class="row text-center text-md-start">
                    @if (get_setting('bottom_banner_images') != null)
                        @foreach (json_decode(get_setting('bottom_banner_images'), true) as $key => $imageId)
                            <div class="col no-padding no-margin">
                                <a href="{{ json_decode(get_setting('bottom_banner_links'), true)[$key] ?? '#' }}">
                                    <img src="{{ uploaded_asset($imageId) }}" class="img-full"
                                        alt="Bottom Banner Image">
                                </a>
                            </div>
                        @endforeach
                    @else
                        <!-- Default Static Banners -->
                        <div class="col no-padding no-margin">
                            <img src="{{ asset('frontend/img/srs-images/left-img.png') }}" class="img-full"
                                alt="Default Left Banner">
                        </div>
                        <div class="col no-padding no-margin">
                            <img src="{{ asset('frontend/img/srs-images/right-img.png') }}" class="img-full"
                                alt="Default Right Banner">
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <!-- Home Banner Close -->




        @include('frontend.partials.instagram')


    </div>
@endsection
@section('script')
@endsection
