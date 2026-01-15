<!-- ============================ Banner Section start =============================== -->
@php
// Get Hero Slider data from database (priority)
$heroImages = get_setting('hero_slider_images') ? json_decode(get_setting('hero_slider_images'), true) : [];
$heroTopHeading = get_setting('hero_slider_top_heading') ? json_decode(get_setting('hero_slider_top_heading'), true) : [];
$heroMainHeading = get_setting('hero_slider_main_heading') ? json_decode(get_setting('hero_slider_main_heading'), true) : [];
$heroButtonText = get_setting('hero_slider_button_text') ? json_decode(get_setting('hero_slider_button_text'), true) : [];
$heroButtonLink = get_setting('hero_slider_button_link') ? json_decode(get_setting('hero_slider_button_link'), true) : [];
$heroStartingPrice = get_setting('hero_slider_starting_price') ? json_decode(get_setting('hero_slider_starting_price'), true) : [];

$banners = [];
if (!empty($heroImages)) {
    foreach ($heroImages as $key => $image) {
        $banners[] = [
            "top_heading" => $heroTopHeading[$key] ?? "Save up to 50% off on your first order",
            "main_heading" => $heroMainHeading[$key] ?? "Daily Grocery Order and Get <span class='text-main-600'>Express</span> Delivery",
            "img" => $image,
            "button_text" => $heroButtonText[$key] ?? "Explore Shop",
            "button_link" => $heroButtonLink[$key] ?? route('products.listing'),
            "price" => $heroStartingPrice[$key] ?? "$60.99"
        ];
    }
}

// Fallback to home_banner data if hero_slider is empty
if (empty($banners)) {
    $bannerImages = get_setting('home_banner_images') ? json_decode(get_setting('home_banner_images'), true) : [];
    $bannerTitles = get_setting('home_banner_titles') ? json_decode(get_setting('home_banner_titles'), true) : [];
    $bannerSubtitles = get_setting('home_banner_subtitles') ? json_decode(get_setting('home_banner_subtitles'), true) : [];
    $bannerPrices = get_setting('home_banner_prices') ? json_decode(get_setting('home_banner_prices'), true) : [];
    $bannerLinks = get_setting('home_banner_links') ? json_decode(get_setting('home_banner_links'), true) : [];
    
    if (!empty($bannerImages)) {
        foreach ($bannerImages as $key => $image) {
            $banners[] = [
                "top_heading" => $bannerSubtitles[$key] ?? "Save up to 50% off on your first order",
                "main_heading" => $bannerTitles[$key] ?? "Daily Grocery Order and Get <span class='text-main-600'>Express</span> Delivery",
                "img" => $image,
                "button_text" => "Explore Shop",
                "button_link" => $bannerLinks[$key] ?? route('products.listing'),
                "price" => $bannerPrices[$key] ?? "$60.99"
            ];
        }
    }
}

// Fallback to dummy data if no banners in database
if (empty($banners)) {
    $banners = [
        [
            "top_heading" => "Save up to 50% off on your first order",
            "main_heading" => "Daily Grocery Order and Get <span class='text-main-600'>Express</span> Delivery",
            "img" => "banner-img3.png",
            "button_text" => "Explore Shop",
            "button_link" => route('products.listing'),
            "price" => "$60.99"
        ],
        [
            "top_heading" => "Save up to 50% off on your first order",
            "main_heading" => "Daily Grocery Order and Get <span class='text-main-600'>Express</span> Delivery",
            "img" => "banner-img1.png",
            "button_text" => "Explore Shop",
            "button_link" => route('products.listing'),
            "price" => "$60.99"
        ]
    ];
}
@endphp

<div class="banner">
    <div class="container container-lg">
        <div class="banner-item rounded-24 overflow-hidden position-relative arrow-center">
            <a href="#featureSection" class="scroll-down w-84 h-84 text-center flex-center bg-main-600 rounded-circle border border-5 text-white border-white position-absolute start-50 translate-middle-x bottom-0 hover-bg-main-800">
                <span class="icon line-height-0"><i class="ph ph-caret-double-down"></i></span>
            </a>
            <img src="{{ static_asset('frontend/img/bg/banner-bg.png') }}" alt="" class="banner-img position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 z-n1 object-fit-cover rounded-24">

            <div class="flex-align">
                <button type="button" id="banner-prev" class="slick-prev slick-arrow flex-center rounded-circle box-shadow-4xl bg-white text-xl hover-bg-main-600 hover-text-white transition-1">
                    <i class="ph ph-caret-left"></i>
                </button>
                <button type="button" id="banner-next" class="slick-next slick-arrow flex-center rounded-circle box-shadow-4xl bg-white text-xl hover-bg-main-600 hover-text-white transition-1">
                    <i class="ph ph-caret-right"></i>
                </button>
            </div>

            <div class="banner-slider">
                @foreach($banners as $banner)
                    <div class="banner-slider__item">
                        <div class="banner-slider__inner flex-between position-relative">
                            <div class="banner-item__content">
                                <span class="fw-semibold text-success-600 text-capitalize mb-8 animate-left-right animation-delay-08">{!! $banner['top_heading'] !!}</span>
                                <h2 class="banner-item__title max-w-700 mb-30 animate-left-right animation-delay-1">{!! $banner['main_heading'] !!}</h2>
                                <div class="d-flex align-items-center gap-16 animate-left-right animation-delay-12">
                                    <a href="{{ $banner['button_link'] }}" class="btn btn-main d-inline-flex align-items-center rounded-pill gap-8">
                                        {{ $banner['button_text'] }} <span class="icon text-xl d-flex"><i class="ph ph-shopping-cart-simple"></i></span>
                                    </a>
                                    @if(!empty($banner['price']))
                                    <div class="d-flex align-items-end gap-8">
                                        <span class="text-heading fst-italic text-sm">Starting at</span>
                                        <h6 class="text-danger-600 mb-0">{{ $banner['price'] }}</h6>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="banner-item__thumb animate-scale animation-delay-12">
                                @if(strpos($banner['img'], 'http') === 0 || strpos($banner['img'], '/') === 0)
                                    <img src="{{ $banner['img'] }}" alt="">
                                @else
                                    <img src="{{ uploaded_asset($banner['img']) ?: static_asset('frontend/img/thumbs/' . $banner['img']) }}" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- ============================ Banner Section End =============================== -->

