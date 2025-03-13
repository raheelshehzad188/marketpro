@extends('frontend.layouts.master')
{{-- @section('meta_description', $blog->meta_description ?? '')
@section('meta_author', $blog->author ?? '') --}}
@section('title', 'Check Out')

@section('content')

    <div role="main" class="main shop pb-4">

        <div class="container">
            <div class="row margin-50">
                <div class="col-md-12 align-self-center order-1">
                    <ul class="breadcrumb d-block appear-animation animated fadeIn appear-animation-visible">
                        <li><a href="#">Home</a></li>
                        <li><a href="#"> Product</a></li>
                        <li><a href="#"> Cart</a></li>
                    </ul>
                    <h2 class="page-title">YOUR CART</h2>

                </div>
            </div>

            <div class="row pb-4 mb-5 margin-50">
                <div class="col-lg-8 mb-5 mb-lg-0 cart-con">
                    <form method="post" action="">
                        <div class="table-responsive">
                            <table class="shop_table cart">
                                <thead>
                                    <tr class="text-color-dark cart-top-row">
                                        <th class="product-thumbnail" width="15%">
                                            &nbsp;
                                        </th>
                                        <th class="product-name text-uppercase" width="30%">
                                            Product
                                        </th>
                                        <th class="product-price text-uppercase" width="15%">
                                            Price
                                        </th>
                                        <th class="product-quantity text-uppercase" width="20%">
                                            Quantity
                                        </th>
                                        <th class="product-subtotal text-uppercase text-end" width="20%">
                                            Subtotal
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        <tr class="cart_table_item">
                                            <td class="product-thumbnail">
                                                <div class="product-thumbnail-wrapper">
                                                    <a href="#" class="product-thumbnail-remove btn-remove-c"
                                                        title="Remove Product" data-id="{{ $item->id }}">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                    <a href="#" class="product-thumbnail-image"
                                                        title="{{ $item->product->name }}">
                                                        @if ($item->product->source == 'knobby')
                                                            <img width="90" height="90"
                                                                alt="{{ $item->product->name }}" class="img-fluid"
                                                                src="{{ $item->product->knobby_thumbnail_img }}">
                                                        @else
                                                            <img width="90" height="90"
                                                                alt="{{ $item->product->name }}" class="img-fluid"
                                                                src="{{ uploaded_asset($item->product->thumbnail_img) }}">
                                                        @endif
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="product-name">
                                                <a href="#"
                                                    class="font-weight-semi-bold text-color-dark text-color-hover-primary text-decoration-none">
                                                    {{ $item->product->name }}
                                                </a>
                                                @if ($item->addon)
                                                    <br><small>Addon: {{ $item->addon->name }}</small>
                                                @endif
                                            </td>
                                            <td class="product-price">
                                                <span class="amount font-weight-medium text-color-grey">
                                                    ${{ number_format($item->product->unit_price + ($item->addon->unit_price ?? 0), 2) }}
                                                </span>
                                            </td>
                                            <td class="product-quantity">
                                                <div class="quantity float-none m-0">
                                                    <input type="button"
                                                        class="minus text-color-hover-light bg-color-hover-primary border-color-hover-primary"
                                                        value="-" data-id="{{ $item->id }}" data-type="minus">
                                                    <input type="text" class="input-text qty text"
                                                        value="{{ $item->quantity }}" id="qty_{{ $item->id }}"
                                                        name="quantity" min="1" step="1"
                                                        data-id="{{ $item->id }}">
                                                    <input type="button"
                                                        class="plus text-color-hover-light bg-color-hover-primary border-color-hover-primary"
                                                        value="+" data-id="{{ $item->id }}" data-type="plus">
                                                </div>
                                            </td>
                                            <td class="product-subtotal text-end">
                                                <span class="amount text-color-dark font-weight-bold text-4">
                                                    ${{ number_format(($item->product->unit_price + ($item->addon->unit_price ?? 0)) * $item->quantity, 2) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td colspan="5">
                                            <div class="row justify-content-between mx-0">
                                                <div class="col-md-auto px-0 mb-3 mb-md-0">
                                                    <div class="d-flex align-items-center">
                                                        <input type="text"
                                                            class="form-control h-auto border-radius-5 line-height-1 py-3"
                                                            name="couponCode" placeholder="Coupon Code" />
                                                        <button type="submit"
                                                            class="btn btn-light btn-modern text-color-light bg-color-grey text-color-hover-light bg-color-hover-primary text-uppercase text-3 font-weight-bold border-0 border-radius-5 ws-nowrap btn-px-4 py-3 ms-2">Apply
                                                            Coupon</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 position-relative">
                    <div class="card" data-plugin-sticky
                        data-plugin-options="{'minWidth': 991, 'containerSelector': '.row', 'padding': {'top': 85}}">
                        <div class="card-body">
                            <h4 class="font-weight-bold text-uppercase text-4 mb-3 letter-space-1">Cart Totals</h4>
                            <table class="shop_table cart-totals mb-4">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <td class="border-top-0">
                                            <strong
                                                class="text-color-dark font-weight-bold text-uppercase letter-space-1">Subtotal</strong>
                                        </td>
                                        <td class="border-top-0 text-end">
                                            <strong><span
                                                    class="amount font-weight-medium">${{ number_format($subtotal, 2) }}</span></strong>
                                        </td>
                                    </tr>
                                    <tr class="total">
                                        <td>
                                            <strong
                                                class="text-color-dark font-weight-bold text-3-5 letter-space-1 text-uppercase">Total</strong>
                                        </td>
                                        <td class="text-end">
                                            <strong class="text-color-dark font-weight-bold"><span
                                                    class="amount text-color-dark text-5">${{ number_format($subtotal, 2) }}</span></strong>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                            <a href="{{ url('checkout'); }}"
                                class="btn btn-light w-100 btn-modern text-color-light bg-color-grey text-color-hover-light bg-color-hover-primary text-uppercase text-3 font-weight-bold border-0 border-radius-5 btn-px-4 py-3">Proceed
                                to Checkout <i class="fas fa-arrow-right ms-2"></i></a>


                        </div>
                    </div>
                </div>
            </div>

        </div>




    </div>
@endsection
@section('style')

@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const updateCartItem = (id, quantity) => {
                fetch('{{ route('cart.update', ':id') }}'.replace(':id', id), {
                        method: 'POST', // Use POST instead of PATCH
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            quantity: quantity
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                position: "top-end",
                                icon: 'success',
                                title: 'Updated Cart',
                                text: data.success,
                                timer: 1500,
                                showConfirmButton: false,
                            });

                            updateMiniCart(); // Update mini cart
                        }
                    })
                    .catch(error => console.error('Error updating cart:', error));
            };

            document.querySelectorAll('.minus, .plus').forEach(button => {
                button.addEventListener('click', function() {
                    const type = this.getAttribute('data-type');
                    const id = this.getAttribute('data-id');
                    const qtyInput = document.getElementById(`qty_${id}`);
                    let quantity = parseInt(qtyInput.value);

                    if (type === 'minus' && quantity > 1) quantity--;
                    if (type === 'plus') quantity++;

                    qtyInput.value = quantity;
                    updateCartItem(id, quantity); // Call the update function
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Attach click event listener to dynamically handle remove buttons
            document.addEventListener('click', function(event) {
                if (event.target.closest('.btn-remove-c')) {
                    event.preventDefault();

                    const removeButton = event.target.closest('.btn-remove-c');
                    const cartItemId = removeButton.getAttribute('data-id');

                    // Show loader with SweetAlert2
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Removing item from cart',
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        allowOutsideClick: false,
                    });

                    // Perform AJAX request to remove the item
                    fetch('{{ route('cart.remove') }}', {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                id: cartItemId,
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            Swal.close(); // Close the loader

                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Item Removed',
                                    text: data.success,
                                    timer: 2000,
                                    showConfirmButton: false,
                                });

                                // Refresh the mini cart
                                location.reload(); // Reload to reflect updated cart
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
                                text: 'Unable to remove item from cart. Please try again later.',
                            });
                            console.error('Error:', error);
                        });
                }
            });
        });
    </script>



@endsection
