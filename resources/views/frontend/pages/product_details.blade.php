@extends('frontend.layouts.master')

@section('title', 'Product Listing')
@section('content')
    <div role="main" class="main mb-4">
        <section class="page-header ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="row">
                            <div class="col-md-12 align-self-center order-1">
                                <ul class="breadcrumb d-block appear-animation animated fadeIn appear-animation-visible">
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    @foreach ($product->categories as $category)
                                        <li><a
                                                href="{{ route('products.listing', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                    <li>{{ $product->name }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <div class="container">

            @php
                $additionalAttributes = json_decode($product->additional_attributes, true) ?? [];
                $productAttributes = json_decode($product->attributes, true) ?? [];

                // For convenience, define helpers to return "N/A" if empty or null
                function displayValue($value)
                {
                    return !empty($value) ? $value : 'N/A';
                }

                $images = $product->knobby_images ? json_decode($product->knobby_images, true) : [];
                // Use a placeholder if no images
                if (empty($images) || !is_array($images) || count(array_filter($images)) === 0) {
                    $images = ['/path/to/placeholder.jpg'];
                }
            @endphp

            <div class="row">
                <div class="col-md-5 mb-5 mb-md-0">

                    <div class="thumb-gallery-wrapper">
                        <!-- Main Image Gallery -->
                        <div
                            class="thumb-gallery-detail owl-carousel owl-theme manual nav-inside nav-style-1 nav-dark mb-3">
                            @foreach ($images as $imageUrl)
                                @if ($imageUrl)
                                    <div>
                                        <img alt="{{ displayValue($product->name) }}" class="img-fluid"
                                            src="{{ $imageUrl }}">
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <!-- Thumbnail Gallery -->
                        <div class="thumb-gallery-thumbs owl-carousel owl-theme manual thumb-gallery-thumbs">
                            @foreach ($images as $imageUrl)
                                @if ($imageUrl)
                                    <div class="cur-pointer">
                                        <img alt="{{ displayValue($product->name) }}" class="img-fluid"
                                            src="{{ $imageUrl }}">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="col-md-7">
                    <div class="summary entry-summary position-relative">

                        <!-- Product Title -->
                        <h1 class="single-ptitle">{{ displayValue($product->name) }}</h1>

                        <!-- Price Section -->
                        @php
                            $retailPrice =
                                $product->unit_price > 0 ? number_format($product->unit_price, 2) . 'kr' : 'N/A';
                            $dealerPrice =
                                $product->fake_price > 0 ? number_format($product->fake_price, 2) . 'kr' : 'N/A';
                        @endphp

                        <p class="price-single">
                            <span class="sale text-color-dark">{{ $retailPrice }}</span>
                        </p>

                        <!-- Additional Info (EAN/UPC, Article No, Supplier SKU) -->
                        <div class="product-meta mb-3">
                            <ul class="list-unstyled">
                                <li><strong>Article No:</strong>
                                    {{ displayValue($additionalAttributes['Article No'] ?? null) }}</li>
                                <li><strong>Supplier SKU:</strong>
                                    {{ displayValue($additionalAttributes['Supplier SKU'] ?? null) }}</li>
                                <li><strong>EAN/UPC:</strong> {{ displayValue($additionalAttributes['EAN/UPC'] ?? null) }}
                                </li>
                            </ul>
                        </div>

                        <!-- Main Description -->
                        @if (!empty($product->description))
                            <p class="single-description">
                                {!! nl2br(e($product->description)) !!}
                            </p>
                        @else
                            <p class="single-description">N/A</p>
                        @endif

                        <!-- Short Webtext -->
                        @if (!empty($additionalAttributes['Short Webtext']))
                            <div class="short-webtext mt-4">
                                <h4 class="mb-3">More Information</h4>
                                <p>{!! $additionalAttributes['Short Webtext'] !!}</p>
                            </div>
                        @else
                            <!-- If you want to show N/A even when short webtext is missing, uncomment below:
                                        <div class="short-webtext mt-4">
                                            <h4 class="mb-3">More Information</h4>
                                            <p>N/A</p>
                                        </div>
                                        -->
                        @endif

                        <!-- Stock & Add to Cart -->
                        @php
                            $stock = $product->current_stock !== null ? $product->current_stock : 'N/A';
                        @endphp

                        <form class="cart mt-4">
                            @csrf
                            <div class="quantity quantity-lg">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="addon_id" value="{{ $addon->id ?? null }}">

                                <input type="button" class="minus" value="-">
                                <input type="number" class="input-text-single" name="quantity" title="Qty"
                                    value="1" min="1" step="1">
                                <input type="button" class="plus" value="+">

                                <button type="button" class="btn-adtocart">Add to cart</button>
                            </div>
                        </form>



                        <div class="mb-5"></div>

                        <!-- Accordion Sections -->
                        <div
                            class="accordion accordion-modern-status accordion-modern-status-borders accordion-modern-status-arrow">
                            <!-- Stock -->
                            <div class="card card-default">
                                <div class="card-header" id="collapse200HeadingOne">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-color-dark font-weight-medium text-uppercase"
                                            data-bs-toggle="collapse" data-bs-target="#collapse200One" aria-expanded="false"
                                            aria-controls="collapse200One">
                                            Store Stock
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse200One" class="collapse" aria-labelledby="collapse200HeadingOne">
                                    <div class="card-body pt-0 no-border">
                                        <p class="mb-0">Current stock: {{ $stock }} units</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Description -->
                            <div class="card card-default">
                                <div class="card-header" id="collapse200HeadingTwo">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-color-dark font-weight-medium text-uppercase"
                                            data-bs-toggle="collapse" data-bs-target="#collapse200Two" aria-expanded="false"
                                            aria-controls="collapse200Two">
                                            Product Description
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse200Two" class="collapse" aria-labelledby="collapse200HeadingTwo">
                                    <div class="card-body pt-0 no-border">
                                        <p class="mb-0">
                                            @if (!empty($product->description))
                                                {!! nl2br(e($product->description)) !!}
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Specifications -->
                            <div class="card card-default">
                                <div class="card-header" id="collapse200HeadingThree">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-color-dark font-weight-medium text-uppercase"
                                            data-bs-toggle="collapse" data-bs-target="#collapse200Three"
                                            aria-expanded="false" aria-controls="collapse200Three">
                                            Specification
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse200Three" class="collapse" aria-labelledby="collapse200HeadingThree">
                                    <div class="card-body pt-0 no-border">
                                        <ul>
                                            @foreach ($productAttributes as $key => $value)
                                                <li>{{ $key }}: {{ displayValue($value) }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>



    </div>



@endsection

@section('script')
    <!-- Examples -->
    <script src="{{ asset('frontend/js/examples/examples.gallery.js') }}"></script>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cartForms = document.querySelectorAll('.cart');

            cartForms.forEach(cartForm => {
                const minusButton = cartForm.querySelector('.minus');
                const plusButton = cartForm.querySelector('.plus');
                const inputField = cartForm.querySelector('.input-text-single');
                const addToCartButton = cartForm.querySelector('.btn-adtocart');

                // Increment/Decrement Quantity
                minusButton.addEventListener('click', () => {
                    let currentValue = parseInt(inputField.value) || 1;
                    if (currentValue > 1) {
                        inputField.value = currentValue - 1;
                    }
                });

                plusButton.addEventListener('click', () => {
                    let currentValue = parseInt(inputField.value) || 1;
                    inputField.value = currentValue + 1;
                });

                // Add to Cart via AJAX
                addToCartButton.addEventListener('click', () => {
                    const productId = cartForm.querySelector('[name="product_id"]').value;
                    const addonId = cartForm.querySelector('[name="addon_id"]').value;
                    const quantity = inputField.value;

                    // Show Loader
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Adding item to cart',
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        allowOutsideClick: false,
                    });

                    // AJAX Request
                    fetch('{{ route('cart.add') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                product_id: productId,
                                addon_id: addonId,
                                quantity: quantity,
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            Swal.close(); // Close the loader

                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Added to Cart',
                                    text: data.success,
                                    timer: 1000,
                                    showConfirmButton: false,
                                });

                                updateMiniCart(); // Update mini cart
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.error || 'Something went wrong!',
                                });
                            }
                        })
                        .catch(error => {
                            Swal.close();
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Unable to add item to cart. Please try again later.',
                            });
                            console.error('Error:', error);
                        });
                });
            });
        });
    </script>


@endsection
