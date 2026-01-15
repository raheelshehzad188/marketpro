@php
// Get brands from database
$brandImages = get_setting('home_brand_images') ? json_decode(get_setting('home_brand_images'), true) : [];
$brandLinks = get_setting('home_brand_links') ? json_decode(get_setting('home_brand_links'), true) : [];

$brands = [];
if (!empty($brandImages)) {
    foreach ($brandImages as $key => $image) {
        $brands[] = [
            "image" => $image,
            "link" => $brandLinks[$key] ?? route('products.listing'),
            "duration" => 200 + ($key * 200)
        ];
    }
}

// Fallback to dummy data
if (empty($brands)) {
    $brands = [
        ['image' => 'brand-img1.png', 'link' => route('products.listing'), 'duration' => 200],
        ['image' => 'brand-img2.png', 'link' => route('products.listing'), 'duration' => 400],
        ['image' => 'brand-img3.png', 'link' => route('products.listing'), 'duration' => 600],
        ['image' => 'brand-img4.png', 'link' => route('products.listing'), 'duration' => 800],
        ['image' => 'brand-img5.png', 'link' => route('products.listing'), 'duration' => 1000],
        ['image' => 'brand-img6.png', 'link' => route('products.listing'), 'duration' => 1200],
        ['image' => 'brand-img7.png', 'link' => route('products.listing'), 'duration' => 1400],
        ['image' => 'brand-img8.png', 'link' => route('products.listing'), 'duration' => 1600],
    ];
}
@endphp
<!-- ============================== Brand Section Start =============================== -->
<div class="brand py-80 overflow-hidden">
    <div class="container container-lg">
        <div class="brand-inner p-24 rounded-16">
            <div class="section-heading">
                <div class="flex-between flex-wrap gap-8">
                    <h5 class="mb-0 wow fadeInLeft">Shop by Brands</h5>
                    <div class="flex-align gap-16 wow fadeInRight">
                        <a href="{{ route('products.listing') }}" class="text-sm fw-medium text-gray-700 hover-text-main-600 hover-text-decoration-underline">View All Deals</a>
                        <div class="flex-align gap-8">
                            <button type="button" id="brand-prev" class="slick-prev slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1">
                                <i class="ph ph-caret-left"></i>
                            </button>
                            <button type="button" id="brand-next" class="slick-next slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1">
                                <i class="ph ph-caret-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="brand-slider arrow-style-two">
                @foreach($brands as $brand)
                    <div class="brand-item" data-aos="zoom-in" data-aos-duration="{{ $brand['duration'] }}">
                        <a href="{{ $brand['link'] }}">
                            @if(strpos($brand['image'], 'http') === 0 || strpos($brand['image'], '/') === 0)
                                <img src="{{ $brand['image'] }}" alt="">
                            @else
                                <img src="{{ uploaded_asset($brand['image']) ?: static_asset('frontend/img/thumbs/' . $brand['image']) }}" alt="">
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- ============================== Brand Section End =============================== -->

