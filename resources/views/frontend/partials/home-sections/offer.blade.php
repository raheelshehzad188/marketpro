<!-- =========================== Offer Section Start =============================== -->
@php
// Get offers from database
$offerImages = get_setting('home_offer_images') ? json_decode(get_setting('home_offer_images'), true) : [];
$offerTitles = get_setting('home_offer_titles') ? json_decode(get_setting('home_offer_titles'), true) : [];
$offerDelivery = get_setting('home_offer_delivery') ? json_decode(get_setting('home_offer_delivery'), true) : [];
$offerExpire = get_setting('home_offer_expire') ? json_decode(get_setting('home_offer_expire'), true) : [];
$offerLinks = get_setting('home_offer_links') ? json_decode(get_setting('home_offer_links'), true) : [];

$offers = [];
if (!empty($offerImages)) {
    foreach ($offerImages as $key => $image) {
        $offers[] = [
            "image" => $image,
            "title" => $offerTitles[$key] ?? "$5 off your first order",
            "delivery" => $offerDelivery[$key] ?? "Delivery by 6:15am",
            "expire" => $offerExpire[$key] ?? "Expire Aug 5",
            "link" => $offerLinks[$key] ?? route('products.listing'),
            "btn_class" => $key == 0 ? "bg-success-600 hover-text-white hover-bg-success-700 text-white" : "bg-white hover-text-white hover-bg-main-800 text-heading",
            "expire_class" => $key == 0 ? "text-xs text-heading" : "text-sm text-success-600"
        ];
    }
}

// Fallback to dummy data
if (empty($offers)) {
    $offers = [
        ["image" => "offer-bg-img1.png", "title" => "$5 off your first order", "delivery" => "Delivery by 6:15am", "expire" => "Expire Aug 5", "link" => route('products.listing'), "btn_class" => "bg-success-600 hover-text-white hover-bg-success-700 text-white", "expire_class" => "text-xs text-heading"],
        ["image" => "offer-bg-img2.png", "title" => "$5 off your first order", "delivery" => "Delivery by 6:15am", "expire" => "Expire Aug 5", "link" => route('products.listing'), "btn_class" => "bg-white hover-text-white hover-bg-main-800 text-heading", "expire_class" => "text-sm text-success-600"],
    ];
}
@endphp
<section class="offer pt-80">
    <div class="container container-lg">
        <div class="row gy-4">
            @foreach($offers as $index => $offer)
                <div class="col-sm-6" data-aos="zoom-in" data-aos-duration="{{ 600 + ($index * 200) }}">
                    <div class="offer-card position-relative rounded-16 overflow-hidden p-16 ps-56-px">
                        @if(strpos($offer['image'], 'http') === 0 || strpos($offer['image'], '/') === 0)
                            <img src="{{ $offer['image'] }}" alt="" class="position-absolute inset-block-start-0 inset-inline-start-0 z-n1 w-100 h-100">
                        @else
                            <img src="{{ uploaded_asset($offer['image']) ?: static_asset('frontend/img/bg/' . $offer['image']) }}" alt="" class="position-absolute inset-block-start-0 inset-inline-start-0 z-n1 w-100 h-100">
                        @endif
                        <div class="py-xl-4 {{ $index == 0 ? 'max-w-392 ms-auto' : 'max-w-392' }}">
                            <div class="offer-card__logo mb-16 w-80 h-80 flex-center bg-white rounded-circle">
                                <img src="{{ static_asset('frontend/img/thumbs/offer-logo.png') }}" alt=""> 
                            </div>
                            <h5 class="mb-8">{{ $offer['title'] }}</h5>
                            <div class="flex-align gap-8">
                                <span class="text-sm fw-medium text-heading">{{ $offer['delivery'] }}</span>
                                <span class="{{ $offer['expire_class'] }}">{{ $offer['expire'] }}</span>
                            </div>
                            <a href="{{ $offer['link'] }}" class="mt-16 btn {{ $offer['btn_class'] }} fw-medium d-inline-flex align-items-center rounded-pill gap-8" tabindex="0">
                                Shop Now
                                <span class="icon text-xl d-flex"><i class="ph ph-arrow-right"></i></span> 
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- =========================== Offer Section End =============================== -->

