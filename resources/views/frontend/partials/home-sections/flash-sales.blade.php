<!-- ========================= flash sales Start ================================ -->
@php
// Get featured products
$featuredProducts = isset($featuredProducts) ? $featuredProducts : collect([]);
@endphp
<div class="product pt-60">
    <div class="container container-lg">
        <div class="section-heading">
            <div class="flex-between flex-wrap gap-8">
                <h5 class="mb-0 wow fadeInLeft">Flash Sales Today</h5>
                <div class="flex-align gap-16 wow fadeInRight">
                    <a href="{{ route('products.listing') }}" class="text-sm fw-medium text-gray-700 hover-text-main-600 hover-text-decoration-underline">View All Deals</a>
                    <div class="flex-align gap-8">
                        <button type="button" id="flash-sales-prev" class="slick-prev slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1">
                            <i class="ph ph-caret-left"></i>
                        </button>
                        <button type="button" id="flash-sales-next" class="slick-next slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1">
                            <i class="ph ph-caret-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-one-slider g-12" id="flash-sales-slider">
            @forelse($featuredProducts as $index => $product)
                @php
                    $productData = [
                        'product' => $product,
                        'animation_duration' => 200 + ($index * 200),
                        'show_progress' => true
                    ];
                @endphp
                @include('frontend.partials.product-card', $productData)
            @empty
                <div class="col-12 text-center py-60">
                    <p class="text-gray-600">No featured products available.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
<!-- ========================= flash sales End ================================ -->

