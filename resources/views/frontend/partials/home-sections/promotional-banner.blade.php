<!-- ======================== promotional banner Start ============================== -->
@php
// Get promotional banners from database
$promoImages = get_setting('home_promotional_images') ? json_decode(get_setting('home_promotional_images'), true) : [];
$promoTitles = get_setting('home_promotional_titles') ? json_decode(get_setting('home_promotional_titles'), true) : [];
$promoPrices = get_setting('home_promotional_prices') ? json_decode(get_setting('home_promotional_prices'), true) : [];
$promoLinks = get_setting('home_promotional_links') ? json_decode(get_setting('home_promotional_links'), true) : [];

$promotionalBanners = [];
if (!empty($promoImages)) {
    foreach ($promoImages as $key => $image) {
        $promotionalBanners[] = [
            "image" => $image,
            "title" => $promoTitles[$key] ?? "Everyday Fresh Meat",
            "price" => $promoPrices[$key] ?? "$60.99",
            "link" => $promoLinks[$key] ?? route('products.listing')
        ];
    }
}

// Fallback to dummy data
if (empty($promotionalBanners)) {
    $promotionalBanners = [
        ["image" => "promotional-banner-img1.png", "title" => "Everyday Fresh Meat", "price" => "$60.99", "link" => route('products.listing')],
        ["image" => "promotional-banner-img2.png", "title" => "Daily Fresh Vegetables", "price" => "$60.99", "link" => route('products.listing')],
        ["image" => "promotional-banner-img3.png", "title" => "Everyday Fresh Milk", "price" => "$60.99", "link" => route('products.listing')],
        ["image" => "promotional-banner-img4.png", "title" => "Everyday Fresh Fruits", "price" => "", "link" => route('products.listing')],
    ];
}
@endphp
<section class="promotional-banner pt-80">
    <div class="container container-lg">
        <div class="row gy-4">
            @foreach($promotionalBanners as $index => $banner)
                <div class="col-xl-3 col-sm-6 col-xs-6 wow bounceIn" data-aos="fade-up" data-aos-duration="{{ 400 + ($index * 200) }}">
                    <div class="promotional-banner-item position-relative rounded-24 overflow-hidden z-1 py-52 ps-40 pe-24 h-100">
                        @if(strpos($banner['image'], 'http') === 0 || strpos($banner['image'], '/') === 0)
                            <img src="{{ $banner['image'] }}" alt="" class="position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 object-fit-cover z-n1">
                        @else
                            <img src="{{ uploaded_asset($banner['image']) ?: static_asset('frontend/img/thumbs/' . $banner['image']) }}" alt="" class="position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 object-fit-cover z-n1">
                        @endif
                        <div class="promotional-banner-item__content">
                            <h6 class="promotional-banner-item__title text-2xl max-w-184">{{ $banner['title'] }}</h6>
                            @if(!empty($banner['price']))
                            <div class="d-flex align-items-end gap-8">
                                <span class="text-heading fst-italic text-sm">Starting at</span>
                                <h6 class="text-danger-600 mb-0 text-xl">{{ $banner['price'] }}</h6>
                            </div>
                            @endif
                            <a href="{{ $banner['link'] }}" class="btn btn-main d-inline-flex align-items-center rounded-pill gap-8 mt-24">
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
<!-- ======================== promotional banner End ============================== -->

