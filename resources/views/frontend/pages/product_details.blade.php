@extends('frontend.layouts.master')

@section('title', $product->name ?? 'Product Details')

@section('content')

            @php
                $additionalAttributes = json_decode($product->additional_attributes, true) ?? [];
                $productAttributes = json_decode($product->attributes, true) ?? [];

    // Get product images
    $images = [];
    if ($product->knobby_images) {
        $images = json_decode($product->knobby_images, true);
    }
    if (empty($images) && $product->thumbnail_img) {
        $images = [$product->thumbnail_img];
    }
    if (empty($images)) {
        $images = [static_asset('frontend/img/thumbs/product-img1.png')];
    }
    
    // Build breadcrumb items
    $breadcrumbItems = [];
    if ($product->categories->count() > 0) {
        $firstCategory = $product->categories->first();
        $breadcrumbItems[] = [
            'label' => $firstCategory->name,
            'url' => route('products.listing', ['category' => $firstCategory->id])
        ];
    }
    $breadcrumbItems[] = [
        'label' => $product->name,
        'url' => null
    ];
    
    $stock = $product->current_stock ?? 0;
    $sold = 0; // You can calculate this from orders if needed
    $stockPercentage = ($stock > 0 && ($sold + $stock) > 0) ? (($sold / ($sold + $stock)) * 100) : 0;
            @endphp

@include('frontend.partials.breadcrumb', ['breadcrumbTitle' => 'Product Details', 'breadcrumbItems' => $breadcrumbItems])

<section class="product-details py-80">
    <div class="container container-lg">
        <div class="row gy-4">
            <div class="col-lg-9">
                <div class="row gy-4">
                    {{-- Product Images --}}
                    <div class="col-xl-6">
                        <div class="product-details__left">
                            <div class="product-details__thumb-slider border border-gray-100 rounded-16">
                                @foreach($images as $image)
                                    <div>
                                        <div class="product-details__thumb flex-center h-100">
                                            <img src="{{ strpos($image, 'http') === 0 ? $image : uploaded_asset($image) }}" alt="{{ $product->name }}">
                                        </div>
                                    </div>
                            @endforeach
                        </div>

                            <div class="mt-24">
                                <div class="product-details__images-slider">
                                    @foreach($images as $image)
                                        <div>
                                            <div class="max-w-120 max-h-120 h-100 flex-center border border-gray-100 rounded-16 p-8">
                                                <img src="{{ strpos($image, 'http') === 0 ? $image : uploaded_asset($image) }}" alt="{{ $product->name }}">
                                            </div>
                                    </div>
                            @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Product Content --}}
                    <div class="col-xl-6">
                        <div class="product-details__content">
                            <h5 class="mb-12">{{ $product->name }}</h5>
                            <div class="flex-align flex-wrap gap-12">
                                <div class="flex-align gap-12 flex-wrap">
                                    <div class="flex-align gap-8">
                                        @for($i = 0; $i < 5; $i++)
                                            <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                        @endfor
                                    </div>
                                    <span class="text-sm fw-medium text-neutral-600">4.7 Star Rating</span>
                                    <span class="text-sm fw-medium text-gray-500">(21,671)</span>
                                </div>
                                <span class="text-sm fw-medium text-gray-500">|</span>
                                <span class="text-gray-900">
                                    <span class="text-gray-400">SKU:</span>
                                    {{ $product->sku ?? $additionalAttributes['Article No'] ?? 'N/A' }}
                                </span>
                </div>

                            <span class="mt-32 pt-32 text-gray-700 border-top border-gray-100 d-block"></span>
                            
                            @if($product->description)
                                <p class="text-gray-700">{{ Str::limit(strip_tags($product->description), 150) }}</p>
                            @endif
                            
                            <div class="mt-32 flex-align flex-wrap gap-32">
                                <div class="flex-align gap-8">
                                    <h4 class="mb-0">{{ single_price($product->unit_price) }}</h4>
                                    @if($product->fake_price && $product->fake_price > $product->unit_price)
                                        <span class="text-md text-gray-500 text-decoration-line-through">{{ single_price($product->fake_price) }}</span>
                                    @endif
                                </div>
                                <button type="button" class="btn btn-main rounded-pill whatsapp-order-btn" data-product-id="{{ $product->id }}">
                                    Order on What'sApp
                                </button>
                            </div>
                            
                            <span class="mt-32 pt-32 text-gray-700 border-top border-gray-100 d-block"></span>

                            {{-- Special Offer Countdown --}}
                            <div class="flex-align flex-wrap gap-16 bg-color-one rounded-8 py-16 px-24">
                                <div class="flex-align gap-16">
                                    <span class="text-main-600 text-sm">Special Offer:</span>
                                </div>
                                <div class="countdown" id="countdown-product">
                                    <ul class="countdown-list flex-align flex-wrap">
                                        <li class="countdown-list__item text-heading flex-align gap-4 text-xs fw-medium w-28 h-28 rounded-4 border border-main-600 p-0 flex-center"><span class="days"></span></li>
                                        <li class="countdown-list__item text-heading flex-align gap-4 text-xs fw-medium w-28 h-28 rounded-4 border border-main-600 p-0 flex-center"><span class="hours"></span></li>
                                        <li class="countdown-list__item text-heading flex-align gap-4 text-xs fw-medium w-28 h-28 rounded-4 border border-main-600 p-0 flex-center"><span class="minutes"></span></li>
                                        <li class="countdown-list__item text-heading flex-align gap-4 text-xs fw-medium w-28 h-28 rounded-4 border border-main-600 p-0 flex-center"><span class="seconds"></span></li>
                            </ul>
                        </div>
                                <span class="text-gray-900 text-xs">Remains until the end of the offer</span>
                            </div>

                            {{-- Stock Progress --}}
                            @if($stock > 0)
                                <div class="mb-24">
                                    <div class="mt-32 flex-align gap-12 mb-16">
                                        <span class="w-32 h-32 bg-white flex-center rounded-circle text-main-600 box-shadow-xl"><i class="ph-fill ph-lightning"></i></span>
                                        <h6 class="text-md mb-0 fw-bold text-gray-900">Products are almost sold out</h6>
                                    </div>
                                    <div class="progress w-100 bg-gray-100 rounded-pill h-8" role="progressbar" aria-label="Basic example" aria-valuenow="{{ $stockPercentage }}" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar bg-main-two-600 rounded-pill" style="width: {{ $stockPercentage }}%"></div>
                                    </div>
                                    <span class="text-sm text-gray-700 mt-8">Available only: {{ $stock }}</span>
                                        </div>
                        @endif

                            {{-- Quantity and Add to Cart --}}
                            <span class="text-gray-900 d-block mb-8">Quantity:</span>
                            <div class="flex-between gap-16 flex-wrap">
                                <div class="flex-align flex-wrap gap-16">
                                    <div class="border border-gray-100 rounded-pill py-9 px-16 flex-align">
                                        <button type="button" class="quantity__minus p-4 text-gray-700 hover-text-main-600 flex-center"><i class="ph ph-minus"></i></button>
                                        <input type="number" id="product-quantity" class="quantity__input border-0 text-center w-32" value="1" min="1">
                                        <button type="button" class="quantity__plus p-4 text-gray-700 hover-text-main-600 flex-center"><i class="ph ph-plus"></i></button>
                                    </div>
                                    <button type="button" class="btn btn-main rounded-pill flex-align d-inline-flex gap-8 px-48 mt-16 add-to-cart-btn" data-product-id="{{ $product->id }}">
                                        <i class="ph ph-shopping-cart"></i> Add To Cart
                                    </button>
                                </div>
                                
                                <div class="flex-align gap-12">
                                    <a href="#" class="w-52 h-52 bg-main-50 text-main-600 text-xl hover-bg-main-600 hover-text-white flex-center rounded-circle">
                                        <i class="ph ph-heart"></i>
                                    </a>
                                    <a href="#" class="w-52 h-52 bg-main-50 text-main-600 text-xl hover-bg-main-600 hover-text-white flex-center rounded-circle">
                                        <i class="ph ph-shuffle"></i>
                                    </a>
                                    <a href="#" class="w-52 h-52 bg-main-50 text-main-600 text-xl hover-bg-main-600 hover-text-white flex-center rounded-circle">
                                        <i class="ph ph-share-network"></i>
                                    </a>
                                </div>
                                    </div>
                            
                            <span class="mt-32 pt-32 text-gray-700 border-top border-gray-100 d-block"></span>

                            {{-- Coupon Section --}}
                            <div class="flex-between gap-16 p-12 border border-main-two-600 border-dashed rounded-8 mb-16">
                                <div class="flex-align gap-12">
                                    <button type="button" class="w-18 h-18 flex-center border border-gray-900 text-xs rounded-circle hover-bg-gray-100">
                                        <i class="ph ph-plus"></i>
                                    </button>
                                    <span class="text-gray-900 fw-medium text-xs">Mfr. coupon. $3.00 off 5</span>
                                </div>
                                <a href="{{ route('basket') }}" class="text-xs fw-semibold text-main-two-600 text-decoration-underline hover-text-main-two-700">View Details</a>
                            </div>

                            @if(!empty($additionalAttributes['Short Webtext']))
                                <ul class="list-inside ms-12">
                                    <li class="text-gray-900 text-sm mb-8">{{ $additionalAttributes['Short Webtext'] }}</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-3">
                <div class="product-details__sidebar border border-gray-100 rounded-16 overflow-hidden">
                    <div class="p-24">
                        <div class="flex-between bg-main-600 rounded-pill p-8">
                            <div class="flex-align gap-8">
                                <span class="w-44 h-44 bg-white rounded-circle flex-center text-2xl"><i class="ph ph-storefront"></i></span>
                                <span class="text-white">by {{ get_setting('site_name', 'Marketpro') }}</span>
                            </div>
                            <a href="{{ route('products.listing') }}" class="btn btn-white rounded-pill text-uppercase">View Store</a>
                        </div>
                    </div>
                    <div class="p-24 bg-color-one d-flex align-items-start gap-24 border-bottom border-gray-100">
                        <span class="w-44 h-44 bg-white text-main-600 rounded-circle flex-center text-2xl flex-shrink-0">
                            <i class="ph-fill ph-truck"></i>
                        </span>
                        <div class="">
                            <h6 class="text-sm mb-8">Fast Delivery</h6>
                            <p class="text-gray-700">Lightning-fast shipping, guaranteed.</p>
                        </div>
                    </div>
                    <div class="p-24 bg-color-one d-flex align-items-start gap-24 border-bottom border-gray-100">
                        <span class="w-44 h-44 bg-white text-main-600 rounded-circle flex-center text-2xl flex-shrink-0">
                            <i class="ph-fill ph-arrow-u-up-left"></i>
                        </span>
                        <div class="">
                            <h6 class="text-sm mb-8">Free 90-day returns</h6>
                            <p class="text-gray-700">Shop risk-free with easy returns.</p>
                        </div>
                    </div>
                    <div class="p-24 bg-color-one d-flex align-items-start gap-24 border-bottom border-gray-100">
                        <span class="w-44 h-44 bg-white text-main-600 rounded-circle flex-center text-2xl flex-shrink-0">
                            <i class="ph-fill ph-check-circle"></i>
                        </span>
                        <div class="">
                            <h6 class="text-sm mb-8">Pickup available at Shop location</h6>
                            <p class="text-gray-700">Usually ready in 24 hours</p>
                        </div>
                    </div>
                    <div class="p-24 bg-color-one d-flex align-items-start gap-24 border-bottom border-gray-100">
                        <span class="w-44 h-44 bg-white text-main-600 rounded-circle flex-center text-2xl flex-shrink-0">
                            <i class="ph-fill ph-credit-card"></i>
                        </span>
                        <div class="">
                            <h6 class="text-sm mb-8">Payment</h6>
                            <p class="text-gray-700">Payment upon receipt of goods, Payment by card in the department, Google Pay, Online card.</p>
                        </div>
                    </div>
                    <div class="p-24 bg-color-one d-flex align-items-start gap-24 border-bottom border-gray-100">
                        <span class="w-44 h-44 bg-white text-main-600 rounded-circle flex-center text-2xl flex-shrink-0">
                            <i class="ph-fill ph-check-circle"></i>
                        </span>
                        <div class="">
                            <h6 class="text-sm mb-8">Warranty</h6>
                            <p class="text-gray-700">The Consumer Protection Act does not provide for the return of this product of proper quality.</p>
                        </div>
                    </div>
                    <div class="p-24 bg-color-one d-flex align-items-start gap-24 border-bottom border-gray-100">
                        <span class="w-44 h-44 bg-white text-main-600 rounded-circle flex-center text-2xl flex-shrink-0">
                            <i class="ph-fill ph-package"></i>
                        </span>
                        <div class="">
                            <h6 class="text-sm mb-8">Packaging</h6>
                            <p class="text-gray-700">Research & development value proposition graphical user interface investor.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Product Description Tabs --}}
        <div class="pt-80">
            <div class="product-dContent border rounded-24">
                <div class="product-dContent__header border-bottom border-gray-100 flex-between flex-wrap gap-16">
                    <ul class="nav common-tab nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-reviews-tab" data-bs-toggle="pill" data-bs-target="#pills-reviews" type="button" role="tab" aria-controls="pills-reviews" aria-selected="false">Reviews</button>
                        </li>
                    </ul>
                    <a href="#" class="btn bg-color-one rounded-16 flex-align gap-8 text-main-600 hover-bg-main-600 hover-text-white">
                        <img src="{{ static_asset('frontend/img/icons/satisfaction-icon.png') }}" alt="">
                        100% Satisfaction Guaranteed
                    </a>
                </div>
                <div class="product-dContent__box">
                    <div class="tab-content" id="pills-tabContent">
                        {{-- Description Tab --}}
                        <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab" tabindex="0">
                            <div class="mb-40">
                                <h6 class="mb-24">Product Description</h6>
                                @if($product->description)
                                    <p>{!! nl2br(e($product->description)) !!}</p>
                                @else
                                    <p>No description available.</p>
                                @endif
                                
                                @if(!empty($additionalAttributes['Short Webtext']))
                                    <p class="mt-24">{!! $additionalAttributes['Short Webtext'] !!}</p>
                                @endif
                            </div>
                            
                            @if(!empty($productAttributes))
                                <div class="mb-40">
                                    <h6 class="mb-24">Product Specifications</h6>
                                    <ul class="mt-32">
                                        @foreach($productAttributes as $key => $value)
                                            <li class="text-gray-400 mb-14 flex-align gap-14">
                                                <span class="w-20 h-20 bg-main-50 text-main-600 text-xs flex-center rounded-circle">
                                                    <i class="ph ph-check"></i>
                                                </span>
                                                <span class="text-heading fw-medium">
                                                    {{ $key }}:
                                                    <span class="text-gray-500">{{ $value ?? 'N/A' }}</span>
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            @if(!empty($additionalAttributes))
                                <div class="mb-0">
                                    <h6 class="mb-24">More Details</h6>
                                    <ul class="mt-32">
                                        @foreach($additionalAttributes as $key => $value)
                                            @if(!in_array($key, ['Short Webtext', 'Article No', 'Supplier SKU', 'EAN/UPC']))
                                                <li class="text-gray-400 mb-14 flex-align gap-14">
                                                    <span class="w-20 h-20 bg-main-50 text-main-600 text-xs flex-center rounded-circle">
                                                        <i class="ph ph-check"></i>
                                                    </span>
                                                    <span class="text-gray-500">{{ $key }}: {{ $value ?? 'N/A' }}</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        
                        {{-- Reviews Tab --}}
                        <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab" tabindex="0">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <h6 class="mb-24">Product Reviews</h6>
                                    <div class="d-flex align-items-start gap-24 pb-44 border-bottom border-gray-100 mb-44">
                                        <div class="flex-grow-1">
                                            <p class="text-gray-700">No reviews yet. Be the first to review this product.</p>
                                        </div>
                                    </div>

                                    <div class="mt-56">
                                        <div class="">
                                            <h6 class="mb-24">Write a Review</h6>
                                            <span class="text-heading mb-8">What is it like to Product?</span>
                                            <div class="flex-align gap-8">
                                                @for($i = 0; $i < 5; $i++)
                                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="mt-32">
                                            <form action="#">
                                                <div class="mb-32">
                                                    <label for="title" class="text-neutral-600 mb-8">Review Title</label>
                                                    <input type="text" class="common-input rounded-8" id="title" placeholder="Great Products">
                                                </div>
                                                <div class="mb-32">
                                                    <label for="desc" class="text-neutral-600 mb-8">Review Content</label>
                                                    <textarea class="common-input rounded-8" id="desc" rows="5" placeholder="Write your review here..."></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-main rounded-pill mt-48">Submit Review</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="ms-xxl-5">
                                        <h6 class="mb-24">Customers Feedback</h6>
                                        <div class="d-flex flex-wrap gap-44">
                                            <div class="border border-gray-100 rounded-8 px-40 py-52 flex-center flex-column flex-shrink-0 text-center">
                                                <h2 class="mb-6 text-main-600">4.8</h2>
                                                <div class="flex-center gap-8">
                                                    @for($i = 0; $i < 5; $i++)
                                                        <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                                    @endfor
                                                </div>
                                                <span class="mt-16 text-gray-500">Average Product Rating</span>
                            </div>
                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if(isset($similarProducts) && $similarProducts->count() > 0)
    @include('frontend.partials.home-sections.similar-product', ['similarProducts' => $similarProducts, 'title' => 'You Might Also Like'])
@endif

@include('frontend.partials.home-sections.shipping')

@endsection

@section('script')
<script>
    window.addEventListener('load', function() {
        var quantityInput = document.getElementById('product-quantity');
        var productId = {{ $product->id }};
        var whatsappNumber = '{{ get_setting('whatsapp_number', '+1234567890') }}';
        
        // Quantity increment/decrement
        document.querySelectorAll('.quantity__plus').forEach(function(btn) {
            btn.addEventListener('click', function() {
                if (quantityInput) {
                    quantityInput.value = parseInt(quantityInput.value) + 1;
                }
            });
        });
        
        document.querySelectorAll('.quantity__minus').forEach(function(btn) {
            btn.addEventListener('click', function() {
                if (quantityInput && parseInt(quantityInput.value) > 1) {
                    quantityInput.value = parseInt(quantityInput.value) - 1;
                }
            });
        });
        
        // Add to Cart via AJAX
        document.querySelectorAll('.add-to-cart-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var btnElement = this;
                var originalText = btnElement.innerHTML;
                var quantity = quantityInput ? parseInt(quantityInput.value) : 1;
                
                // Disable button and show loading
                btnElement.disabled = true;
                btnElement.innerHTML = '<i class="ph ph-spinner ph-spin"></i> Adding...';
                
                // Show loader
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Adding item to cart',
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        allowOutsideClick: false,
                    });
                }
                
                fetch('{{ route('cart.add') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: quantity,
                        addon_id: null
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    btnElement.disabled = false;
                    btnElement.innerHTML = originalText;
                    
                    if (typeof Swal !== 'undefined') {
                        Swal.close();
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Added to Cart',
                                text: data.success,
                                timer: 1500,
                                showConfirmButton: false,
                            });
                            
                            // Update mini cart if function exists
                            if (typeof updateMiniCart === 'function') {
                                updateMiniCart();
                            } else {
                                // Try to fetch and update mini cart
                                fetch('{{ route('cart.mini-cart') }}')
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.html && document.querySelector('.mini-cart-container')) {
                                            document.querySelector('.mini-cart-container').innerHTML = data.html;
                                        }
                                    });
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.error || 'Something went wrong!',
                            });
                        }
                    }
                })
                .catch(error => {
                    btnElement.disabled = false;
                    btnElement.innerHTML = originalText;
                    
                    if (typeof Swal !== 'undefined') {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Unable to add item to cart. Please try again later.',
                        });
                    }
                    console.error('Error:', error);
                });
            });
        });
        
        // Order on WhatsApp via AJAX
        document.querySelectorAll('.whatsapp-order-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var btnElement = this;
                var originalText = btnElement.innerHTML;
                var quantity = quantityInput ? parseInt(quantityInput.value) : 1;
                
                // Disable button and show loading
                btnElement.disabled = true;
                btnElement.innerHTML = '<i class="ph ph-spinner ph-spin"></i> Processing...';
                
                // Show loader
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Adding item to cart',
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        allowOutsideClick: false,
                    });
                }
                
                // First add to cart
                fetch('{{ route('cart.add') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: quantity,
                        addon_id: null
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    btnElement.disabled = false;
                    btnElement.innerHTML = originalText;
                    
                    if (typeof Swal !== 'undefined') {
                        Swal.close();
                    }
                    
                    if (data.success) {
                        // Get product details for WhatsApp message
                        var productName = '{{ addslashes($product->name) }}';
                        var productPrice = '{{ $product->unit_price }}';
                        var message = encodeURIComponent('Hi! I would like to order:\n\n' + 
                            'Product: ' + productName + '\n' +
                            'Quantity: ' + quantity + '\n' +
                            'Price: ' + productPrice + ' SEK\n\n' +
                            'Please confirm my order.');
                        
                        // Open WhatsApp
                        var whatsappUrl = 'https://wa.me/' + whatsappNumber.replace(/[^0-9]/g, '') + '?text=' + message;
                        window.open(whatsappUrl, '_blank');
                        
                        // Update mini cart
                        if (typeof updateMiniCart === 'function') {
                            updateMiniCart();
                        } else {
                            fetch('{{ route('cart.mini-cart') }}')
                                .then(response => response.json())
                                .then(data => {
                                    if (data.html && document.querySelector('.mini-cart-container')) {
                                        document.querySelector('.mini-cart-container').innerHTML = data.html;
                                    }
                                });
                        }
                    } else {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.error || 'Unable to add item to cart.',
                            });
                        }
                    }
                })
                .catch(error => {
                    btnElement.disabled = false;
                    btnElement.innerHTML = originalText;
                    
                    if (typeof Swal !== 'undefined') {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Unable to process order. Please try again later.',
                        });
                    }
                    console.error('Error:', error);
                });
            });
        });
        
        // Product image slider
        if (typeof jQuery !== 'undefined' && typeof jQuery.fn.slick !== 'undefined') {
            jQuery('.product-details__thumb-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.product-details__images-slider'
            });
            
            jQuery('.product-details__images-slider').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: '.product-details__thumb-slider',
                dots: false,
                arrows: false,
                focusOnSelect: true,
                responsive: [
                    { breakpoint: 768, settings: { slidesToShow: 3 } },
                    { breakpoint: 576, settings: { slidesToShow: 2 } }
                ]
            });
            
            // Similar products slider
            if (jQuery('#similar-products-slider').length) {
                jQuery('#similar-products-slider').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    arrows: true,
                    prevArrow: jQuery('#similar-products-prev'),
                    nextArrow: jQuery('#similar-products-next'),
                    dots: false,
                    responsive: [
                        { breakpoint: 1200, settings: { slidesToShow: 3 } },
                        { breakpoint: 992, settings: { slidesToShow: 2 } },
                        { breakpoint: 576, settings: { slidesToShow: 1 } }
                    ]
                });
            }
        }
        
        // Countdown timer
        if (typeof jQuery !== 'undefined' && typeof jQuery.fn.countdown !== 'undefined') {
            var targetDate = new Date();
            targetDate.setDate(targetDate.getDate() + 35);
            jQuery('#countdown-product').countdown(targetDate, function(event) {
                jQuery(this).find('.days').text(event.strftime('%D'));
                jQuery(this).find('.hours').text(event.strftime('%H'));
                jQuery(this).find('.minutes').text(event.strftime('%M'));
                jQuery(this).find('.seconds').text(event.strftime('%S'));
            });
        }
    });
</script>
@endsection
