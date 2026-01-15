@extends('frontend.layouts.marketpro-template')

@php
    $htmlClass = 'color-two font-exo header-style-two';
    $categoryStable = 'd-none';
    $categoryHover = 'd-block';
    $breadcrumbClass = 'bg-main-two-50';
    $pageTitle = 'Checkout';
    $pageText = 'Checkout';
    $section_margin = 'mb-24';
    $itemClass = 'bg-main-50';
    $iconClass = 'bg-main-600';
@endphp

@section('content')
<!-- ================================= Checkout Page Start ===================================== -->
<section class="checkout py-80">
    <div class="container container-lg">
        <div class="border border-gray-100 rounded-8 px-30 py-20 mb-40"> 
            <span class="">Have a coupon? <a href="{{ route('cart') ?? '#' }}" class="fw-semibold text-gray-900 hover-text-decoration-underline hover-text-main-600">Click here to enter your code</a> </span>
        </div>
        <form action="{{ route('checkout.placeOrder') }}" method="POST" id="checkout-form">
            @csrf
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="row gy-3 pe-xl-5">
                        <!-- Customer Type -->
                        <div class="col-12">
                            <label class="text-gray-900 fw-semibold mb-2 d-block">Customer Type <span class="text-danger">*</span></label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="customer_type" id="customer_type_private" value="private" required>
                                    <label class="form-check-label" for="customer_type_private">Private</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="customer_type" id="customer_type_company" value="company" required>
                                    <label class="form-check-label" for="customer_type_company">Company</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="common-input border-gray-100" name="firstName" placeholder="First Name" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="common-input border-gray-100" name="lastName" placeholder="Last Name" required>
                        </div>
                        <div class="col-12">
                            <input type="email" class="common-input border-gray-100" name="email" placeholder="Email Address" required>
                        </div>
                        <div class="col-12">
                            <input type="number" class="common-input border-gray-100" name="phone" placeholder="Phone" required>
                        </div>
                        <div class="col-12">
                            <input type="text" class="common-input border-gray-100" name="address1" placeholder="Address" required>
                        </div>
                        <div class="col-12">
                            <input type="text" class="common-input border-gray-100" name="city" placeholder="City" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="common-input border-gray-100" name="country" placeholder="Country" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="common-input border-gray-100" name="zip" placeholder="Post Code" required>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                <div class="checkout-sidebar">
                    <div class="bg-color-three rounded-8 p-24 text-center">
                        <span class="text-gray-900 text-xl fw-semibold">Your Orders</span>
                    </div>

                    <div class="border border-gray-100 rounded-8 px-24 py-40 mt-24">
                        <div class="mb-32 pb-32 border-bottom border-gray-100 flex-between gap-8">
                            <span class="text-gray-900 fw-medium text-xl font-heading-two">Product</span>
                            <span class="text-gray-900 fw-medium text-xl font-heading-two">Subtotal</span>
                        </div>

                        @if(isset($cartItems) && $cartItems->count() > 0)
                            @foreach($cartItems as $item)
                            <div class="flex-between gap-24 mb-32">
                                <div class="flex-align gap-12">
                                    <span class="text-gray-900 fw-normal text-md font-heading-two w-144">{{ $item->product->name ?? 'Product' }}</span>
                                    <span class="text-gray-900 fw-normal text-md font-heading-two"><i class="ph-bold ph-x"></i></span>
                                    <span class="text-gray-900 fw-semibold text-md font-heading-two">{{ $item->quantity }}</span>
                                </div>
                                <span class="text-gray-900 fw-bold text-md font-heading-two">
                                    {{ number_format(($item->product->unit_price ?? 0) * $item->quantity, 2) }} SEK
                                </span>
                            </div>
                            @endforeach
                        @else
                            <div class="mb-32">
                                <p class="text-gray-500">No items in cart</p>
                            </div>
                        @endif

                        <div class="border-top border-gray-100 pt-30 mt-30">
                            <div class="mb-32 flex-between gap-8">
                                <span class="text-gray-900 font-heading-two text-xl fw-semibold">Subtotal</span>
                                <span class="text-gray-900 font-heading-two text-md fw-bold">{{ number_format($subtotal ?? 0, 2) }} SEK</span>
                            </div>
                            <div class="mb-0 flex-between gap-8">
                                <span class="text-gray-900 font-heading-two text-xl fw-semibold">Total</span>
                                <span class="text-gray-900 font-heading-two text-md fw-bold">{{ number_format($subtotal ?? 0, 2) }} SEK</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-32">
                        <div class="payment-item">
                            <div class="form-check common-check common-radio py-16 mb-0">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment1" value="cash-on-delivery" checked>
                                <label class="form-check-label fw-semibold text-neutral-600" for="payment1">Cash on delivery</label>
                            </div>
                            <div class="payment-item__content px-16 py-24 rounded-8 bg-main-50 position-relative">   
                                <p class="text-gray-800">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                            </div>
                        </div>
                        @if(get_setting('paypal_payment') == 1)
                        <div class="payment-item">
                            <div class="form-check common-check common-radio py-16 mb-0">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment2" value="paypal">
                                <label class="form-check-label fw-semibold text-neutral-600" for="payment2">PayPal</label>
                            </div>
                            <div class="payment-item__content px-16 py-24 rounded-8 bg-main-50 position-relative">   
                                <p class="text-gray-800">Pay securely with PayPal.</p>
                            </div>
                        </div>
                        @endif
                        @if(get_setting('stripe_payment') == 1)
                        <div class="payment-item">
                            <div class="form-check common-check common-radio py-16 mb-0">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_stripe" value="stripe">
                                <label class="form-check-label fw-semibold text-neutral-600" for="payment_stripe">Stripe</label>
                            </div>
                            <div class="payment-item__content px-16 py-24 rounded-8 bg-main-50 position-relative">   
                                <p class="text-gray-800">Pay securely with Stripe.</p>
                            </div>
                        </div>
                        @endif
                        @if(\App\PaymentGateways\ManualInvoiceGateway::isEnabled())
                        <div class="payment-item">
                            <div class="form-check common-check common-radio py-16 mb-0">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment3" value="invoice">
                                <label class="form-check-label fw-semibold text-neutral-600" for="payment3">Invoice</label>
                            </div>
                            <div class="payment-item__content px-16 py-24 rounded-8 bg-main-50 position-relative">   
                                <p class="text-gray-800">Invoice payment option.</p>
                            </div>
                        </div>
                        @endif
                        @if(\App\PaymentGateways\ManualSwishGateway::isEnabled())
                        <div class="payment-item">
                            <div class="form-check common-check common-radio py-16 mb-0">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment4" value="swish">
                                <label class="form-check-label fw-semibold text-neutral-600" for="payment4">Swish</label>
                            </div>
                            <div class="payment-item__content px-16 py-24 rounded-8 bg-main-50 position-relative">   
                                <p class="text-gray-800">Pay with Swish.</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="mt-32 pt-32 border-top border-gray-100">
                        <p class="text-gray-500">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="#" class="text-main-600 text-decoration-underline"> privacy policy</a>.</p>
                    </div>

                    <!-- Terms & Conditions Checkbox -->
                    <div class="mt-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="accept_terms" name="accept_terms" value="1" required>
                            <label class="form-check-label text-gray-500" for="accept_terms">
                                I have read and agree to the <a href="{{ route('terms-and-conditions') }}" target="_blank" class="text-main-600 text-decoration-underline">Terms & Conditions</a> <span class="text-danger">*</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-main mt-40 py-18 w-100 rounded-8 mt-56">Place Order</button>
                    
                </div>
            </div>
        </form>
    </div>
</section>
<!-- ================================= Checkout Page End ===================================== -->
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to format validation errors into a list
        function formatErrors(errors) {
            let errorHtml = '<ul style="text-align:left; margin: 10px 0; padding-left: 20px;">';
            Object.keys(errors).forEach(field => {
                errors[field].forEach(errorMsg => {
                    errorHtml += `<li style="margin: 5px 0;">${errorMsg}</li>`;
                });
            });
            errorHtml += '</ul>';
            return errorHtml;
        }

        const checkoutForm = document.getElementById('checkout-form');
        const acceptTermsCheckbox = document.getElementById('accept_terms');
        
        if (checkoutForm) {
            checkoutForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validate Terms & Conditions checkbox
                if (!acceptTermsCheckbox || !acceptTermsCheckbox.checked) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terms & Conditions Required',
                        text: 'You must accept the Terms & Conditions to proceed with your order.',
                        confirmButtonText: 'OK'
                    });
                    if (acceptTermsCheckbox) {
                        acceptTermsCheckbox.focus();
                    }
                    return;
                }
                
                let checkoutData = new FormData(checkoutForm);

                // Show loading
                Swal.fire({
                    title: 'Placing Order...',
                    didOpen: () => Swal.showLoading(),
                    allowOutsideClick: false,
                });

                fetch('{{ route('checkout.placeOrder') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: checkoutData
                    })
                    .then(response => {
                        // Check if response is ok
                        if (!response.ok) {
                            return response.json().then(data => {
                                throw { status: response.status, data: data };
                            }).catch(err => {
                                // If JSON parsing fails, still throw with status
                                throw { status: response.status, data: { error: 'Validation failed' } };
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        Swal.close();
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Order Placed Successfully!',
                                text: 'Your order has been placed successfully!',
                                timer: 3000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = '{{ url('/order-success') }}/' + data.order_id;
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Order Error',
                                text: data.error || 'There was an error placing your order.'
                            });
                        }
                    })
                    .catch(error => {
                        Swal.close();
                        console.error('Checkout error:', error);
                        
                        // Handle validation errors
                        if (error.data && error.data.errors) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                html: formatErrors(error.data.errors),
                                confirmButtonText: 'OK'
                            });
                        } else if (error.data && error.data.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Order Error',
                                text: error.data.error
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Unable to process order. Please try again later.'
                            });
                        }
                    });
            });
        }
    });
</script>
@endsection
