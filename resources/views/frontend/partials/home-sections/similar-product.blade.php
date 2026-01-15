@php
    $similarProducts = $similarProducts ?? collect([]);
    $title = $title ?? 'You Might Also Like';
@endphp
<!-- ========================== Similar Product Start ============================= -->
<section class="new-arrival pb-80">
    <div class="container container-lg">
        <div class="section-heading">
            <div class="flex-between flex-wrap gap-8">
                <h5 class="mb-0">{{ $title }}</h5>
                <div class="flex-align gap-16">
                    <a href="{{ route('products.listing') }}" class="text-sm fw-medium text-gray-700 hover-text-main-600 hover-text-decoration-underline">All Products</a>
                    <div class="flex-align gap-8">
                        <button type="button" id="similar-products-prev" class="slick-prev slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1">
                            <i class="ph ph-caret-left"></i>
                        </button>
                        <button type="button" id="similar-products-next" class="slick-next slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1">
                            <i class="ph ph-caret-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="new-arrival__slider arrow-style-two" id="similar-products-slider">
            @forelse($similarProducts as $index => $product)
                @php
                    $productData = [
                        'product' => $product,
                        'animation_duration' => 200 + ($index * 200),
                        'show_progress' => false
                    ];
                @endphp
                @include('frontend.partials.product-card', $productData)
            @empty
                <div class="col-12 text-center py-60">
                    <p class="text-gray-600">No similar products available.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
<!-- ========================== Similar Product End ============================= -->
