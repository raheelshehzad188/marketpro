@php
$tabProducts = [
    ['image' => 'product-img7.png', 'title' => 'C-500 Antioxidant Protect Dietary Supplement', 'store' => 'Lucky Supermarket', 'price' => '14.99', 'original_price' => '28.99', 'rating' => '4.8', 'reviews' => '17k', 'badge' => null, 'duration' => 200],
    ['image' => 'product-img8.png', 'title' => 'Marcel\'s Modern Pantry Almond Unsweetened', 'store' => 'Lucky Supermarket', 'price' => '14.99', 'original_price' => '28.99', 'rating' => '4.8', 'reviews' => '17k', 'badge' => ['text' => 'Sale 50%', 'class' => 'bg-danger-600'], 'duration' => 400],
    ['image' => 'product-img9.png', 'title' => 'O Organics Milk, Whole, Vitamin D', 'store' => 'Lucky Supermarket', 'price' => '14.99', 'original_price' => '28.99', 'rating' => '4.8', 'reviews' => '17k', 'badge' => ['text' => 'Sale 50%', 'class' => 'bg-danger-600'], 'duration' => 600],
    ['image' => 'product-img10.png', 'title' => 'Whole Grains and Seeds Organic Bread', 'store' => 'Lucky Supermarket', 'price' => '14.99', 'original_price' => '28.99', 'rating' => '4.8', 'reviews' => '17k', 'badge' => ['text' => 'Best Sale', 'class' => 'bg-info-600'], 'duration' => 800],
    ['image' => 'product-img11.png', 'title' => 'Lucerne Yogurt, Lowfat, Strawberry', 'store' => 'Lucky Supermarket', 'price' => '14.99', 'original_price' => '28.99', 'rating' => '4.8', 'reviews' => '17k', 'badge' => null, 'duration' => 1000],
    ['image' => 'product-img12.png', 'title' => 'Nature Valley Whole Grain Oats and Honey Protein', 'store' => 'Lucky Supermarket', 'price' => '14.99', 'original_price' => '28.99', 'rating' => '4.8', 'reviews' => '17k', 'badge' => ['text' => 'Sale 50%', 'class' => 'bg-danger-600'], 'duration' => 1200],
];
@endphp
@foreach($tabProducts as $product)
    <div class="col-xxl-2 col-lg-3 col-sm-4 col-6" data-aos="fade-up" data-aos-duration="{{ $product['duration'] }}">
        <div class="product-card h-100 p-12 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2 group-item">
            <button type="button" class="wishlist-btn-two">
                <i class="ph-bold ph-heart"></i>
            </button>
            @if($product['badge'])
            <span class="product-card__badge {{ $product['badge']['class'] }} px-8 py-4 text-sm text-white">{{ $product['badge']['text'] }}</span>
            @endif
            <a href="{{ route('products.listing') }}" class="product-card__thumb flex-center overflow-hidden">
                <img src="{{ static_asset('frontend/img/thumbs/' . $product['image']) }}" alt="">
            </a>
            <div class="product-card__content p-sm-2 w-100">
                <h6 class="title text-lg fw-semibold my-12">
                    <a href="{{ route('products.listing') }}" class="link text-line-2">{{ $product['title'] }}</a>
                </h6>   
                <div class="flex-align gap-4">
                    <span class="text-main-600 text-md d-flex"><i class="ph-fill ph-storefront"></i></span>
                    <span class="text-gray-500 text-xs">By {{ $product['store'] }}</span>
                </div>

                <div class="product-card__content mt-12">
                    <div class="product-card__price mb-8">
                        <span class="text-heading text-md fw-semibold">${{ $product['price'] }} <span class="text-gray-500 fw-normal">/Qty</span></span>
                        <span class="text-gray-400 text-md fw-semibold text-decoration-line-through">${{ $product['original_price'] }}</span>
                    </div>
                    <div class="flex-align gap-6">
                        <span class="text-xs fw-bold text-gray-600">{{ $product['rating'] }}</span>
                        <span class="text-15 fw-bold text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                        <span class="text-xs fw-bold text-gray-600">({{ $product['reviews'] }})</span>
                    </div>
                    <a href="{{ route('basket') }}" class="product-card__cart btn bg-main-50 text-main-600 hover-bg-main-600 hover-text-white py-11 px-24 rounded-pill flex-align gap-8 mt-24 w-100 justify-content-center">
                        Add To Cart <i class="ph ph-shopping-cart"></i> 
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach

