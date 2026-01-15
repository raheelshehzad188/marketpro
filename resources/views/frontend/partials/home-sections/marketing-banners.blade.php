<!-- ============================ Marketing Banners Section Start =============================== -->
@php
// Get marketing banners from database
$marketingImages = get_setting('marketing_banner_images') ? json_decode(get_setting('marketing_banner_images'), true) : [];
$marketingLabels = get_setting('marketing_banner_labels') ? json_decode(get_setting('marketing_banner_labels'), true) : [];
$marketingButtonText = get_setting('marketing_banner_button_text') ? json_decode(get_setting('marketing_banner_button_text'), true) : [];
$marketingButtonUrl = get_setting('marketing_banner_button_url') ? json_decode(get_setting('marketing_banner_button_url'), true) : [];
$marketingStartingPrice = get_setting('marketing_banner_starting_price') ? json_decode(get_setting('marketing_banner_starting_price'), true) : [];

$marketingBanners = [];
if (!empty($marketingImages)) {
    foreach ($marketingImages as $key => $image) {
        $marketingBanners[] = [
            "image" => $image,
            "label" => $marketingLabels[$key] ?? "",
            "button_text" => $marketingButtonText[$key] ?? "Shop Now",
            "button_url" => $marketingButtonUrl[$key] ?? route('products.listing'),
            "price" => $marketingStartingPrice[$key] ?? ""
        ];
    }
}

// Fallback to dummy data if no banners in database
if (empty($marketingBanners)) {
    $marketingBanners = [
        [
            "image" => "promotional-banner-img1.png",
            "label" => "Special Offer",
            "button_text" => "Shop Now",
            "button_url" => route('products.listing'),
            "price" => "$60.99"
        ],
        [
            "image" => "promotional-banner-img2.png",
            "label" => "New Arrivals",
            "button_text" => "Explore",
            "button_url" => route('products.listing'),
            "price" => "$45.99"
        ],
    ];
}
@endphp

<section class="marketing-banners pt-80">
    <div class="container container-lg">
        <div class="row gy-4">
            @foreach($marketingBanners as $banner)
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="600">
                    <div class="marketing-banner-item position-relative rounded-16 overflow-hidden z-1 h-100">
                        @if(strpos($banner['image'], 'http') === 0 || strpos($banner['image'], '/') === 0)
                            <img src="{{ $banner['image'] }}" alt="" class="position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 object-fit-cover z-n1">
                        @else
                            <img src="{{ uploaded_asset($banner['image']) ?: static_asset('frontend/img/thumbs/' . $banner['image']) }}" alt="" class="position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 object-fit-cover z-n1">
                        @endif
                        <div class="marketing-banner-item__content position-relative z-1 p-40">
                            @if(!empty($banner['label']))
                            <span class="fw-semibold text-success-600 text-capitalize mb-8 d-inline-block">{{ $banner['label'] }}</span>
                            @endif
                            <div class="d-flex align-items-center gap-16 flex-wrap">
                                <a href="{{ $banner['button_url'] }}" class="btn btn-main d-inline-flex align-items-center rounded-pill gap-8">
                                    {{ $banner['button_text'] }} <span class="icon text-xl d-flex"><i class="ph ph-arrow-right"></i></span>
                                </a>
                                @if(!empty($banner['price']))
                                <div class="d-flex align-items-end gap-8">
                                    <span class="text-heading fst-italic text-sm">Starting at</span>
                                    <h6 class="text-danger-600 mb-0">{{ $banner['price'] }}</h6>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ============================ Marketing Banners Section End =============================== -->

