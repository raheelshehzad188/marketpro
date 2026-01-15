<!-- ============================ Bottom Banners Section Start =============================== -->
@php
// Get bottom banners from database
$bottomBannerImages = get_setting('bottom_banner_images') ? json_decode(get_setting('bottom_banner_images'), true) : [];
$bottomBannerLinks = get_setting('bottom_banner_links') ? json_decode(get_setting('bottom_banner_links'), true) : [];

$bottomBanners = [];
if (!empty($bottomBannerImages)) {
    foreach ($bottomBannerImages as $key => $image) {
        $bottomBanners[] = [
            "image" => $image,
            "link" => $bottomBannerLinks[$key] ?? route('products.listing')
        ];
    }
}

// Fallback to dummy data if no banners in database
if (empty($bottomBanners)) {
    $bottomBanners = [
        [
            "image" => "promotional-banner-img1.png",
            "link" => route('products.listing')
        ],
        [
            "image" => "promotional-banner-img2.png",
            "link" => route('products.listing')
        ],
    ];
}
@endphp

@if(!empty($bottomBanners))
<section class="bottom-banners pt-80">
    <div class="container container-lg">
        <div class="row gy-4">
            @foreach($bottomBanners as $banner)
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="600">
                    <div class="bottom-banner-item position-relative rounded-16 overflow-hidden z-1 h-100">
                        <a href="{{ $banner['link'] }}" class="d-block w-100 h-100">
                            @if(strpos($banner['image'], 'http') === 0 || strpos($banner['image'], '/') === 0)
                                <img src="{{ $banner['image'] }}" alt="" class="w-100 h-100 object-fit-cover">
                            @else
                                <img src="{{ uploaded_asset($banner['image']) ?: static_asset('frontend/img/thumbs/' . $banner['image']) }}" alt="" class="w-100 h-100 object-fit-cover">
                            @endif
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- ============================ Bottom Banners Section End =============================== -->

