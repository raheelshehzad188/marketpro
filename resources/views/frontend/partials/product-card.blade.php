{{-- Reusable Product Card Component --}}
@php
    // Check if product is an object or array
    $isObject = is_object($product);
    
    // Extract product data
    $productId = $isObject ? ($product->id ?? null) : ($product['id'] ?? null);
    $productName = $isObject ? ($product->name ?? 'Product Name') : ($product['title'] ?? $product['name'] ?? 'Product Name');
    $productImage = $isObject 
        ? (isset($product->thumbnail_img) ? uploaded_asset($product->thumbnail_img) : '')
        : (isset($product['image']) ? static_asset('frontend/img/thumbs/' . $product['image']) : '');
    $productPrice = $isObject ? ($product->unit_price ?? 0) : ($product['price'] ?? 0);
    $originalPrice = $isObject ? ($product->fake_price ?? null) : ($product['original_price'] ?? null);
    $productSlug = $isObject ? ($product->slug ?? null) : ($product['slug'] ?? null);
    $productLink = $isObject && isset($product->slug) 
        ? route('products.details', $product->slug) 
        : ($product['link'] ?? route('products.listing'));
    $sold = $isObject ? 0 : ($product['sold'] ?? 0);
    $stock = $isObject ? ($product->current_stock ?? ($product->qty ?? 0)) : ($product['stock'] ?? 0);
    $rating = $isObject ? 0 : ($product['rating'] ?? 0);
    $reviews = $isObject ? '0' : ($product['reviews'] ?? '0');
    $animationDuration = isset($product['animation_duration']) ? $product['animation_duration'] : 200;
    $showProgress = isset($product['show_progress']) ? $product['show_progress'] : true;
    
    // Calculate percentage for progress bar
    $percentage = ($stock > 0 && ($sold + $stock) > 0) ? (($sold / ($sold + $stock)) * 100) : 0;
@endphp

<div data-aos="fade-up" data-aos-duration="{{ $animationDuration }}">
    <div class="product-card px-20 py-16 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
        <a href="{{ route('basket') }}" class="product-card__cart btn bg-main-50 text-main-600 hover-bg-main-600 hover-text-white py-11 px-24 rounded-pill flex-align gap-8 position-absolute inset-block-start-0 inset-inline-end-0 me-16 mt-16">
            Add <i class="ph ph-shopping-cart"></i>
        </a>

        <a href="{{ $productLink }}" class="product-card__thumb flex-center overflow-hidden">
            <img src="{{ $productImage }}" alt="{{ $productName }}">
        </a>

        <div class="product-card__content mt-12">
            <div class="product-card__price mb-8 d-flex align-items-center gap-8">
                <span class="text-heading text-md fw-semibold">{{ single_price($productPrice) }} <span class="text-gray-500 fw-normal">/Qty</span></span>
                @if($originalPrice && $originalPrice > $productPrice)
                    <span class="text-gray-400 text-md fw-semibold text-decoration-line-through">{{ single_price($originalPrice) }}</span>
                @endif
            </div>
            @if($rating > 0)
                <div class="flex-align gap-6">
                    <span class="text-xs fw-bold text-gray-600">{{ number_format($rating, 1) }}</span>
                    <span class="text-15 fw-bold text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                    <span class="text-xs fw-bold text-gray-600">({{ $reviews }})</span>
                </div>
            @endif
            <h6 class="title text-lg fw-semibold mt-12 mb-20">
                <a href="{{ $productLink }}" class="link text-line-2">{{ $productName }}</a>
            </h6>
            @if($showProgress && $stock > 0)
                <div class="mt-12">
                    <div class="progress w-100 bg-color-three rounded-pill h-4" role="progressbar" aria-label="Basic example" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-main-600 rounded-pill" style="width: {{ $percentage }}%"></div>
                    </div>
                    <span class="text-gray-900 text-xs fw-medium mt-8">Sold: {{ $sold }}/{{ $sold + $stock }}</span>
                </div>
            @endif
        </div>
    </div>
</div>
