@php
$products = [
    ['image' => 'best-sell1.png', 'price' => '$28.99', 'sale_price' => '$14.99', 'title' => 'Taylor Farms Broccoli Florets Vegetables', 'store' => 'Lucky Supermarket', 'sold' => '18/35', 'id' => 6, 'duration' => 200],
    ['image' => 'best-sell2.png', 'price' => '$28.99', 'sale_price' => '$14.99', 'title' => 'Taylor Farms Broccoli Florets Vegetables', 'store' => 'Lucky Supermarket', 'sold' => '18/35', 'id' => 7, 'duration' => 400],
    ['image' => 'best-sell3.png', 'price' => '$28.99', 'sale_price' => '$14.99', 'title' => 'Taylor Farms Broccoli Florets Vegetables', 'store' => 'Lucky Supermarket', 'sold' => '18/35', 'id' => 6, 'duration' => 600],
    ['image' => 'best-sell4.png', 'price' => '$28.99', 'sale_price' => '$14.99', 'title' => 'Taylor Farms Broccoli Florets Vegetables', 'store' => 'Lucky Supermarket', 'sold' => '18/35', 'id' => 7, 'duration' => 800],
];
@endphp
<!-- ========================= best sells Start ================================ -->
<section class="best sells pb-80">
    <div class="container container-lg">
        <div class="section-heading">
            <div class="flex-between flex-wrap gap-8">
                <h5 class="mb-0 wow fadeInLeft">Daily Best Sells</h5>
            </div>
        </div>

        <div class="row g-12">
            <div class="col-xxl-8">
                <div class="row gy-4">
                    @foreach($products as $index => $product)
                        <div class="col-md-6" data-aos="fade-up" data-aos-duration="{{ $product['duration'] }}">
                            <div class="product-card style-two h-100 p-8 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2 flex-align gap-16">
                                <div class="">
                                    <span class="product-card__badge bg-danger-600 px-8 py-4 text-sm text-white">Sale 50%</span>
                                    <a href="{{ route('products.listing') }}" class="product-card__thumb flex-center overflow-hidden">
                                        <img src="{{ static_asset('frontend/img/thumbs/' . $product['image']) }}" alt="">
                                    </a>
                                    <div class="countdown" id="countdown{{ $index + 10 }}">
                                        <ul class="countdown-list style-three flex-align flex-wrap">
                                            <li class="countdown-list__item text-heading flex-align gap-4 text-sm fw-medium"><span class="days"></span>Days</li>
                                            <li class="countdown-list__item text-heading flex-align gap-4 text-sm fw-medium"><span class="hours"></span>Hours</li>
                                            <li class="countdown-list__item text-heading flex-align gap-4 text-sm fw-medium"><span class="minutes"></span>Min</li>
                                            <li class="countdown-list__item text-heading flex-align gap-4 text-sm fw-medium"><span class="seconds"></span>Sec</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-card__content">
                                    <div class="product-card__price mb-16">
                                        <span class="text-gray-400 text-md fw-semibold text-decoration-line-through">{{ $product['price'] }}</span>
                                        <span class="text-heading text-md fw-semibold">{{ $product['sale_price'] }} <span class="text-gray-500 fw-normal">/Qty</span></span>
                                    </div>
                                    <div class="flex-align gap-6">
                                        <span class="text-xs fw-bold text-gray-600">4.8</span>
                                        <span class="text-15 fw-bold text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                        <span class="text-xs fw-bold text-gray-600">(17k)</span>
                                    </div>
                                    <h6 class="title text-lg fw-semibold mt-12 mb-8">
                                        <a href="{{ route('products.listing') }}" class="link text-line-2">{{ $product['title'] }}</a>
                                    </h6>
                                    <div class="flex-align gap-4">
                                        <span class="text-main-600 text-md d-flex"><i class="ph-fill ph-storefront"></i></span>
                                        <span class="text-gray-500 text-xs">By {{ $product['store'] }}</span>
                                    </div>
                                    <div class="mt-12">
                                        <div class="progress w-100 bg-color-three rounded-pill h-4" role="progressbar" aria-label="Basic example" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-main-600 rounded-pill" style="width: 35%"></div>
                                        </div>
                                        <span class="text-gray-900 text-xs fw-medium mt-8">Sold: {{ $product['sold'] }}</span>
                                    </div>
                                    <a href="{{ route('basket') }}" class="product-card__cart btn bg-main-50 text-main-600 hover-bg-main-600 hover-text-white py-11 px-24 rounded-pill flex-align gap-8 mt-24 w-100 justify-content-center">
                                        Add To Cart <i class="ph ph-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-xxl-4" data-aos="zoom-in" data-aos-duration="600">
                <div class="position-relative rounded-16 bg-light-purple overflow-hidden p-28 z-1 h-100">
                    <div class="">
                        <img src="{{ static_asset('frontend/img/bg/special-snacks.png') }}" alt="" class="position-absolute inset-block-start-0 inset-inline-start-0 z-n1 w-100 h-100 cover-img">
                    </div>
                    <div class="py-xl-4">
                        <div class="offer-card__logo mb-16 w-80 h-80 flex-center bg-white rounded-circle">
                            <img src="{{ static_asset('frontend/img/thumbs/offer-logo.png') }}" alt="">
                        </div>
                        <h5 class="mb-8">$5 off your first order</h5>
                        <div class="flex-align gap-8">
                            <span class="text-sm fw-medium text-heading">Delivery by 6:15am</span>
                            <span class="text-xs text-heading">Expire Aug 5</span>
                        </div>
                        <a href="{{ route('products.listing') }}" class="mt-16 btn bg-success-600 hover-text-white hover-bg-success-700 text-white fw-medium d-inline-flex align-items-center rounded-pill gap-8" tabindex="0">
                            Shop Now
                            <span class="icon text-xl d-flex"><i class="ph ph-arrow-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================= best sells End ================================ -->

