@extends('frontend.layouts.master')
@section('title', 'Shopping Cart')

@section('content')
<!-- ================================ Cart Section Start ================================ -->
<section class="cart py-80">
    <div class="container container-lg">
        <div class="row gy-4">
            <div class="col-xl-9 col-lg-8">
                <div class="cart-table border border-gray-100 rounded-8 px-40 py-48">
                    @if($cartItems->count() > 0)
                    <div class="overflow-x-auto scroll-sm scroll-sm-horizontal">
                        <table class="table style-three">
                            <thead>
                                <tr>
                                    <th class="h6 mb-0 text-lg fw-bold">Delete</th>
                                    <th class="h6 mb-0 text-lg fw-bold">Product Name</th>
                                    <th class="h6 mb-0 text-lg fw-bold">Price</th>
                                    <th class="h6 mb-0 text-lg fw-bold">Quantity</th>
                                    <th class="h6 mb-0 text-lg fw-bold">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                @php
                                    $productPrice = $item->product->unit_price ?? 0;
                                    $addonPrice = $item->addon->unit_price ?? 0;
                                    $itemPrice = $productPrice + $addonPrice;
                                    $itemSubtotal = $itemPrice * $item->quantity;
                                    
                                    // Dummy tags and reviews
                                    $dummyTags = [
                                        ['Organic', 'Fresh', 'Healthy'],
                                        ['Fresh', 'Natural', 'Premium'],
                                        ['Organic', 'Farm Fresh', 'Quality'],
                                        ['Premium', 'Fresh', 'Best'],
                                        ['Natural', 'Organic', 'Healthy']
                                    ];
                                    $tags = $dummyTags[array_rand($dummyTags)];
                                    
                                    $dummyReviews = [
                                        ['name' => 'John Doe', 'rating' => 5, 'comment' => 'Excellent quality product!', 'date' => '2 days ago'],
                                        ['name' => 'Sarah Smith', 'rating' => 4, 'comment' => 'Very fresh and good value.', 'date' => '5 days ago'],
                                        ['name' => 'Mike Johnson', 'rating' => 5, 'comment' => 'Highly recommended!', 'date' => '1 week ago']
                                    ];
                                    $reviews = array_slice($dummyReviews, 0, 2);
                                    $rating = 4.5 + (rand(0, 10) / 10);
                                    $totalReviews = rand(50, 200);
                                    
                                    $productImage = $item->product->source == 'knobby' 
                                        ? $item->product->knobby_thumbnail_img 
                                        : uploaded_asset($item->product->thumbnail_img);
                                @endphp
                                <tr data-cart-item-id="{{ $item->id }}">
                                    <td>
                                        <button type="button" class="btn-remove-c flex-align gap-12 hover-text-danger-600" 
                                                title="Remove Product" data-id="{{ $item->id }}">
                                            <i class="ph ph-x-circle text-2xl d-flex"></i>
                                            Remove
                                        </button>
                                    </td>
                                    <td>
                                        <div class="table-product d-flex align-items-center gap-24">
                                            <a href="#" class="table-product__thumb border border-gray-100 rounded-8 flex-center">
                                                <img src="{{ $productImage }}" alt="{{ $item->product->name }}" 
                                                     style="width: 90px; height: 90px; object-fit: cover;">
                                            </a>
                                            <div class="table-product__content text-start">
                                                <h6 class="title text-lg fw-semibold mb-8">
                                                    <a href="#" class="link text-line-2">{{ $item->product->name }}</a>
                                                </h6>
                                                @if($item->addon)
                                                <p class="text-sm text-gray-600 mb-8">Addon: {{ $item->addon->name }}</p>
                                                @endif
                                                
                                                <div class="d-flex flex-wrap gap-8 mb-12">
                                                    @foreach($tags as $tag)
                                                    <span class="badge bg-main-50 text-main-600 px-12 py-4 rounded-4 text-xs">{{ $tag }}</span>
                                                    @endforeach
                                                </div>
                                                
                                                <div class="flex-align gap-16 mb-8">
                                                    <div class="flex-align gap-6">
                                                        <span class="text-md fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                                        <span class="text-md fw-semibold text-gray-900">{{ number_format($rating, 1) }}</span>
                                                    </div>
                                                    <span class="text-sm fw-medium text-gray-200">|</span>
                                                    <span class="text-neutral-600 text-sm">{{ $totalReviews }} Reviews</span>
                                                </div>
                                                
                                                <div class="product-reviews mt-12">
                                                    <div class="text-xs text-gray-600 mb-8 fw-semibold">Recent Reviews:</div>
                                                    @foreach($reviews as $review)
                                                    <div class="review-item mb-8 pb-8 border-bottom border-gray-100">
                                                        <div class="flex-between align-items-start mb-4">
                                                            <span class="text-sm fw-semibold text-gray-900">{{ $review['name'] }}</span>
                                                            <div class="flex-align gap-4">
                                                                @for($i = 0; $i < 5; $i++)
                                                                <i class="ph {{ $i < $review['rating'] ? 'ph-fill' : '' }} ph-star text-warning-600 text-xs"></i>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                        <p class="text-xs text-gray-600 mb-4">{{ $review['comment'] }}</p>
                                                        <span class="text-xs text-gray-400">{{ $review['date'] }}</span>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-lg h6 mb-0 fw-semibold">${{ number_format($itemPrice, 2) }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex rounded-4 overflow-hidden">
                                            <button type="button" class="quantity__minus border border-end border-gray-100 flex-shrink-0 h-48 w-48 text-neutral-600 flex-center hover-bg-main-600 hover-text-white"
                                                    data-id="{{ $item->id }}" data-type="minus">
                                                <i class="ph ph-minus"></i>
                                            </button>
                                            <input type="number" class="quantity__input flex-grow-1 border border-gray-100 border-start-0 border-end-0 text-center w-32 px-4" 
                                                   value="{{ $item->quantity }}" min="1" id="qty_{{ $item->id }}" data-id="{{ $item->id }}">
                                            <button type="button" class="quantity__plus border border-end border-gray-100 flex-shrink-0 h-48 w-48 text-neutral-600 flex-center hover-bg-main-600 hover-text-white"
                                                    data-id="{{ $item->id }}" data-type="plus">
                                                <i class="ph ph-plus"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-lg h6 mb-0 fw-semibold item-subtotal-{{ $item->id }}">${{ number_format($itemSubtotal, 2) }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-80">
                        <i class="ph ph-shopping-cart text-6xl text-gray-300 mb-24 d-block"></i>
                        <h5 class="text-gray-900 mb-16">Your cart is empty</h5>
                        <p class="text-gray-600 mb-32">Add some products to your cart to continue shopping.</p>
                        <a href="{{ route('products.listing') }}" class="btn btn-main">Continue Shopping</a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-xl-3 col-lg-4">
                <div class="cart-sidebar border border-gray-100 rounded-8 px-24 py-40">
                    <h6 class="text-xl mb-32">Cart Totals</h6>
                    <div class="bg-color-three rounded-8 p-24">
                        <div class="mb-32 flex-between gap-8">
                            <span class="text-gray-900 font-heading-two">Subtotal</span>
                            <span class="text-gray-900 fw-semibold" id="cart-subtotal">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="mb-32 flex-between gap-8">
                            <span class="text-gray-900 font-heading-two">Estimated Delivery</span>
                            <span class="text-gray-900 fw-semibold">Free</span>
                        </div>
                        <div class="mb-0 flex-between gap-8">
                            <span class="text-gray-900 font-heading-two">Estimated Tax</span>
                            <span class="text-gray-900 fw-semibold" id="cart-tax">${{ number_format($subtotal * 0.04, 2) }}</span>
                        </div>
                    </div>
                    <div class="bg-color-three rounded-8 p-24 mt-24">
                        <div class="flex-between gap-8">
                            <span class="text-gray-900 text-xl fw-semibold">Total</span>
                            <span class="text-gray-900 text-xl fw-semibold" id="cart-total">${{ number_format($subtotal * 1.04, 2) }}</span>
                        </div>
                    </div>
                    <a href="{{ route('checkout') }}" class="btn btn-main mt-40 py-18 w-100 rounded-8">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ================================ Cart Section End ================================ -->
@endsection
@section('style')
<style>
    .table-product__thumb {
        width: 90px;
        height: 90px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .table-product__thumb img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }
    .review-item {
        font-size: 12px;
    }
    .quantity__input {
        max-width: 60px;
    }
</style>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const updateCartItem = (id, quantity) => {
        fetch('{{ route('cart.update', ':id') }}'.replace(':id', id), {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ quantity: quantity }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update mini cart
                if (typeof updateMiniCart === 'function') {
                    updateMiniCart();
                }
                
                // Reload page to show updated totals
                location.reload();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.error || 'Failed to update cart',
                });
            }
        })
        .catch(error => {
            console.error('Error updating cart:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Unable to update cart. Please try again.',
            });
        });
    };

    // Quantity buttons
    document.querySelectorAll('.quantity__minus, .quantity__plus').forEach(button => {
        button.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            const id = this.getAttribute('data-id');
            const qtyInput = document.getElementById(`qty_${id}`);
            let quantity = parseInt(qtyInput.value) || 1;

            if (type === 'minus' && quantity > 1) {
                quantity--;
            } else if (type === 'plus') {
                quantity++;
            }

            qtyInput.value = quantity;
            updateCartItem(id, quantity);
        });
    });

    // Quantity input change
    document.querySelectorAll('.quantity__input').forEach(input => {
        input.addEventListener('change', function() {
            const id = this.getAttribute('data-id');
            let quantity = parseInt(this.value) || 1;
            if (quantity < 1) {
                quantity = 1;
                this.value = 1;
            }
            updateCartItem(id, quantity);
        });
    });

    // Remove item
    document.addEventListener('click', function(event) {
        if (event.target.closest('.btn-remove-c')) {
            event.preventDefault();
            const removeButton = event.target.closest('.btn-remove-c');
            const cartItemId = removeButton.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to remove this item from cart?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Removing item from cart',
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        allowOutsideClick: false,
                    });

                    fetch('{{ route('cart.remove') }}', {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ id: cartItemId }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.close();
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Item Removed',
                                text: data.success,
                                timer: 1500,
                                showConfirmButton: false,
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
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
                            text: 'Unable to remove item. Please try again.',
                        });
                        console.error('Error:', error);
                    });
                }
            });
        }
    });
});
</script>
@endsection
