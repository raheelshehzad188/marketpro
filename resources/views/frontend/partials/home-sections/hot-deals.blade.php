@php
$products = [
    ['image' => 'product-img26.png', 'price' => '$14.99', 'original_price' => '$28.99', 'rating' => '4.8', 'reviews' => '(17k)', 'name' => 'Taylor Farms Broccoli Florets Vegetables', 'sold' => '18/35', 'duration' => '200'],
    ['image' => 'product-img27.png', 'price' => '$14.99', 'original_price' => '$28.99', 'rating' => '4.8', 'reviews' => '(17k)', 'name' => 'Taylor Farms Broccoli Florets Vegetables', 'sold' => '18/35', 'duration' => '400'],
    ['image' => 'product-img28.png', 'price' => '$14.99', 'original_price' => '$28.99', 'rating' => '4.8', 'reviews' => '(17k)', 'name' => 'Taylor Farms Broccoli Florets Vegetables', 'sold' => '18/35', 'duration' => '600'],
    ['image' => 'product-img29.png', 'price' => '$14.99', 'original_price' => '$28.99', 'rating' => '4.8', 'reviews' => '(17k)', 'name' => 'Taylor Farms Broccoli Florets Vegetables', 'sold' => '18/35', 'duration' => '800'],
    ['image' => 'product-img30.png', 'price' => '$14.99', 'original_price' => '$28.99', 'rating' => '4.8', 'reviews' => '(17k)', 'name' => 'Taylor Farms Broccoli Florets Vegetables', 'sold' => '18/35', 'duration' => '1000'],
    ['image' => 'product-img13.png', 'price' => '$14.99', 'original_price' => '$28.99', 'rating' => '4.8', 'reviews' => '(17k)', 'name' => 'Taylor Farms Broccoli Florets Vegetables', 'sold' => '18/35', 'duration' => '1200'],
];
@endphp
<!-- ========================= hot-deals Start ================================ -->
<section class="hot-deals pt-80 overflow-hidden">
    <div class="container container-lg">
        <div class="section-heading">
            <div class="flex-between flex-wrap gap-8">
                <h5 class="mb-0 wow fadeInLeft">Hot Deals Todays</h5>
                <div class="flex-align gap-16 wow fadeInRight">
                    <a href="{{ route('products.listing') }}" class="text-sm fw-medium text-gray-700 hover-text-main-600 hover-text-decoration-underline">View All Deals</a>
                    <div class="flex-align gap-8">
                        <button type="button" id="deals-prev" class="slick-prev slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1">
                            <i class="ph ph-caret-left"></i>
                        </button>
                        <button type="button" id="deals-next" class="slick-next slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1">
                            <i class="ph ph-caret-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-12">
            <div class="col-md-4" data-aos="zoom-in">
                <div class="hot-deals position-relative rounded-16 bg-main-600 overflow-hidden ps-40 pe-24 pt-80 pb-120 z-1">
                    <img src="{{ static_asset('frontend/img/shape/offer-shape.png') }}" alt="" class="position-absolute inset-block-start-0 inset-inline-start-0 z-n1 w-100 h-100 opacity-6">
                    <img src="{{ static_asset('frontend/img/thumbs/basket-img.png') }}" alt="Basket Thumb" class="position-absolute inset-inline-end-0 inset-block-end-0">
                    <span class="text-primary-600 bg-yellow text-heading py-4 px-12 rounded-4 text-sm fw-medium">Medical equipment</span>
                    <div class="">
                        <h5 class="text-white mb-8 mt-12">Deals of the day</h5>
                        <p class="fw-semibold text-success-600">Save up to 50% off on your first order</p>
                        <div class="countdown mt-24 mb-24" id="countdown4">
                            <ul class="countdown-list d-flex align-items-center flex-wrap">
                                <li class="countdown-list__item py-8 px-12 text-heading flex-align gap-4 text-sm fw-medium colon-white"><span class="days"></span> D</li>
                                <li class="countdown-list__item py-8 px-12 text-heading flex-align gap-4 text-sm fw-medium colon-white"><span class="hours"></span> H</li>
                                <li class="countdown-list__item py-8 px-12 text-heading flex-align gap-4 text-sm fw-medium colon-white"><span class="minutes"></span> M</li>
                                <li class="countdown-list__item py-8 px-12 text-heading flex-align gap-4 text-sm fw-medium colon-white"><span class="seconds"></span> S</li>
                            </ul>
                        </div>
                        <a href="{{ route('products.listing') }}" class="mt-16 btn bg-white hover-text-white hover-bg-main-800 text-main-600 fw-medium d-inline-flex align-items-center rounded-pill gap-8" tabindex="0">
                            Explore Shop
                            <span class="icon text-xl d-flex"><i class="ph-bold ph-shopping-cart"></i></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="hot-deals-slider arrow-style-two">
                    @foreach($products as $product)
                        <div data-aos="fade-up" data-aos-duration="{{ $product['duration'] }}">
                            <div class="product-card px-20 pt-16 pb-40 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
                                <a href="{{ route('basket') }}" class="product-card__cart btn bg-main-50 text-main-600 hover-bg-main-600 hover-text-white py-11 px-24 rounded-pill flex-align gap-8 position-absolute inset-block-start-0 inset-inline-end-0 me-16 mt-16">
                                    Add <i class="ph ph-shopping-cart"></i>
                                </a>
                                <a href="{{ route('products.listing') }}" class="product-card__thumb flex-center overflow-hidden">
                                    <img src="{{ static_asset('frontend/img/thumbs/' . $product['image']) }}" alt="">
                                </a>
                                <div class="product-card__content mt-12">
                                    <div class="product-card__price mb-8 d-flex align-items-center gap-8">
                                        <span class="text-heading text-md fw-semibold">{{ $product['price'] }} <span class="text-gray-500 fw-normal">/Qty</span></span>
                                        <span class="text-gray-400 text-md fw-semibold text-decoration-line-through">{{ $product['original_price'] }}</span>
                                    </div>
                                    <div class="flex-align gap-6">
                                        <span class="text-xs fw-bold text-gray-600">{{ $product['rating'] }}</span>
                                        <span class="text-15 fw-bold text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                        <span class="text-xs fw-bold text-gray-600">{{ $product['reviews'] }}</span>
                                    </div>
                                    <h6 class="title text-lg fw-semibold mt-12 mb-20">
                                        <a href="{{ route('products.listing') }}" class="link text-line-2">{{ $product['name'] }}</a>
                                    </h6>
                                    <div class="mt-12">
                                        <div class="progress w-100 bg-color-three rounded-pill h-4" role="progressbar" aria-label="Basic example" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-main-600 rounded-pill" style="width: 35%"></div>
                                        </div>
                                        <span class="text-gray-900 text-xs fw-medium mt-8">Sold: {{ $product['sold'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================= hot-deals End ================================ -->

