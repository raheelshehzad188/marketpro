@extends('frontend.layouts.master')
@section('title', 'Check Out')

@section('content')
    <div role="main" class="main shop pb-4">
        <div class="container">
            <!-- Breadcrumb & Page Title -->
            <div class="row margin-50">
                <div class="col-md-12 align-self-center order-1">
                    <ul class="breadcrumb d-block appear-animation animated fadeIn appear-animation-visible">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="#">Product</a></li>
                        <li><a href="#">Checkout</a></li>
                    </ul>
                    <h2 class="page-title">CHECKOUT</h2>
                </div>
            </div>

            @guest
                <!-- Guest: Show Login Option -->
                <div class="row">
                    <div class="col">
                        <p class="mb-2 font-weight-medium">
                            Returning customer?
                            <a href="#"
                                class="text-color-dark text-color-hover-primary text-decoration-none font-weight-bold"
                                data-bs-toggle="collapse" data-bs-target=".login-form-wrapper">Login</a>
                        </p>
                    </div>
                </div>
                <!-- Login Form (Collapse) -->
                <div class="row login-form-wrapper collapse mb-5">
                    <div class="col">
                        <div class="card border-width-3 border-radius-0 border-color-hover-dark">
                            <div class="card-body">
                                <form action="{{ route('login') }}" id="frmSignIn" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col">
                                            <label class="form-label text-color-dark text-3">Email address <span
                                                    class="text-color-danger">*</span></label>
                                            <input type="email" name="email" class="form-control form-control-lg text-4"
                                                required="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label class="form-label text-color-dark text-3">Password <span
                                                    class="text-color-danger">*</span></label>
                                            <input type="password" name="password" class="form-control form-control-lg text-4"
                                                required="">
                                        </div>
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="form-group col-md-auto">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="rememberme"
                                                    name="remember">
                                                <label class="form-label custom-control-label cur-pointer text-2"
                                                    for="rememberme">Remember Me</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-auto">
                                            <a class="text-decoration-none text-color-dark text-color-hover-primary font-weight-semibold text-2"
                                                href="#">Forgot Password?</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <button type="submit"
                                                class="btn btn-light w-100 btn-modern text-color-light bg-color-grey bg-color-hover-primary text-uppercase text-3 font-weight-bold border-0 border-radius-5 btn-px-4 py-3 ms-2"
                                                data-loading-text="Loading...">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endguest

            <!-- Coupon Form -->
            <div class="row">
                <div class="col">
                    <p class="font-weight-medium">
                        Have a coupon?
                        <a href="#"
                            class="text-color-dark text-color-hover-primary text-decoration-none font-weight-bold"
                            data-bs-toggle="collapse" data-bs-target=".coupon-form-wrapper">Enter your code</a>
                    </p>
                </div>
            </div>
            <div class="row coupon-form-wrapper collapse mb-5">
                <div class="col">
                    <div class="card border-width-3 border-radius-0 border-color-hover-dark">
                        <div class="card-body">
                            <form role="form" method="post" action="">
                                @csrf
                                <div class="d-flex align-items-center">
                                    <input type="text" class="form-control h-auto border-radius-0 line-height-1 py-3"
                                        name="couponCode" placeholder="Coupon Code" required="">
                                    <button type="submit"
                                        class="btn btn-light btn-modern text-color-light bg-color-grey text-color-hover-primary text-3 font-weight-bold border-0 border-radius-5 ws-nowrap btn-px-4 py-3 ms-2">Apply
                                        Coupon</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Checkout Form -->
            <form id="checkout-form" role="form" class="needs-validation" method="post" action=""
                novalidate="novalidate">
                @csrf
                <div class="row">
                    <!-- Billing Details Section -->
                    <div class="col-lg-7 mb-4 mb-lg-0">
                        <h2 class="text-color-dark font-weight-bold text-5-5 mb-3 text-uppercase letter-space-2">Billing
                            Details</h2>
                        
                        <!-- Customer Type Dropdown -->
                        <div class="row">
                            <div class="form-group col">
                                <label class="form-label text-color-dark text-3">Customer Type <span class="text-color-danger">*</span></label>
                                <div class="custom-select-1">
                                    <select class="form-select form-control h-auto py-2 text-uppercase" name="customer_type" id="customer_type" required="">
                                        <option value="">Select Customer Type</option>
                                        <option value="private">Private</option>
                                        <option value="company">Company</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Personal Number Field (shown when private is selected) -->
                        <div class="row" id="personal_number_field" style="display: none;">
                            <div class="form-group col">
                                <input type="text" class="form-control h-auto py-2 text-uppercase" name="personal_number"
                                    id="personal_number" placeholder="Personal Number">
                            </div>
                        </div>
                        
                        <!-- VAT Number Field (shown when company is selected) -->
                        <div class="row" id="vat_number_field" style="display: none;">
                            <div class="form-group col">
                                <input type="text" class="form-control h-auto py-2 text-uppercase" name="vat_number"
                                    id="vat_number" placeholder="VAT Number">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control h-auto py-2 text-uppercase" name="firstName"
                                    placeholder="First Name" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control h-auto py-2 text-uppercase" name="lastName"
                                    placeholder="Last Name" required="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <input type="email" class="form-control h-auto py-2 text-uppercase" name="email"
                                    placeholder="Email" required="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control h-auto py-2 text-uppercase" name="city"
                                    placeholder="City" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <div class="custom-select-1">
                                    <select class="form-select form-control h-auto py-2 text-uppercase" name="country"
                                        required="">
                                        <option value="usa">United States</option>
                                        <option value="spa">Spain</option>
                                        <option value="fra">France</option>
                                        <option value="uk">United Kingdom</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control h-auto py-2 text-uppercase" name="zip"
                                    placeholder="Post Code" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="number" class="form-control h-auto py-2 text-uppercase" name="phone"
                                    placeholder="Mobile" required="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <input type="text" class="form-control h-auto py-2 text-uppercase" name="address1"
                                    placeholder="House number or flat number" required="">
                            </div>
                        </div>
                        @guest
                            <!-- Only for Guest Users -->
                            <div class="row">
                                <div class="form-group col">
                                    <div class="custom-checkbox-1">
                                        <input id="createAccount" type="checkbox" name="createAccount" value="1">
                                        <label for="createAccount" class="font-weight-bold text-color-dark">Create an
                                            account?</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="password-field" style="display:none;">
                                <div class="form-group col-md-6">
                                    <input type="password" class="form-control h-auto py-2" name="password"
                                        placeholder="Password">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="password" class="form-control h-auto py-2" name="password_confirmation"
                                        placeholder="Confirm Password">
                                </div>
                            </div>
                        @endguest

                        <!-- Shipping Details Toggle -->
                        <div class="row">
                            <div class="form-group col">
                                <div class="custom-checkbox-1" data-bs-toggle="collapse"
                                    data-bs-target=".shipping-field-wrapper">
                                    <input id="shipAddress" type="checkbox" name="shipAddress" value="1">
                                    <label for="shipAddress" class="font-weight-bold text-color-dark">Ship to a different
                                        address?</label>
                                </div>
                            </div>
                        </div>
                        <!-- Shipping Details Section (Hidden by default) -->
                        <div class="shipping-field-wrapper collapse">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control h-auto py-2 text-uppercase"
                                        name="shipping_firstName" placeholder="Shipping First Name" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control h-auto py-2 text-uppercase"
                                        name="shipping_lastName" placeholder="Shipping Last Name" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <input type="email" class="form-control h-auto py-2 text-uppercase"
                                        name="shipping_email" placeholder="Shipping Email" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control h-auto py-2 text-uppercase"
                                        name="shipping_city" placeholder="Shipping City" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="custom-select-1">
                                        <select class="form-select form-control h-auto py-2 text-uppercase"
                                            name="shipping_country" required="">
                                            <option value="usa">United States</option>
                                            <option value="spa">Spain</option>
                                            <option value="fra">France</option>
                                            <option value="uk">United Kingdom</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control h-auto py-2 text-uppercase"
                                        name="shipping_zip" placeholder="Shipping Post Code" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="number" class="form-control h-auto py-2 text-uppercase"
                                        name="shipping_phone" placeholder="Shipping Mobile" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <input type="text" class="form-control h-auto py-2 text-uppercase"
                                        name="shipping_address1" placeholder="Shipping Address" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label class="form-label font-weight-bold text-color-dark">Order Notes</label>
                                <textarea class="form-control h-auto py-2" name="orderNotes" rows="5"
                                    placeholder="Notes about your order e.g. special notes for delivery"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Order Summary Section -->
                    <div class="col-lg-5 position-relative">
                        <div class="pin-wrapper" style="height:900.667px;">
                            <div class="card border-width-3 border-radius-0 border-color-hover-dark" data-plugin-sticky
                                data-plugin-options="{'minWidth': 991, 'containerSelector': '.row', 'padding': {'top': 0}}">
                                <div class="card-body">
                                    <h4 class="font-weight-bold text-uppercase text-4 mb-3 letter-space-1">Your Order</h4>
                                    <table class="shop_table cart-totals mb-3">
                                        <tbody>
                                            <tr>
                                                <td colspan="2" class="border-top-0">
                                                    <strong
                                                        class="text-color-dark text-uppercase font-weight-bold letter-space-1">Product</strong>
                                                </td>
                                            </tr>
                                            @foreach ($cartItems as $item)
                                            <tr>
                                                <td>
                                                    <strong
                                                        class="d-block text-color-dark line-height-1 font-weight-semibold">
                                                        {{ $item->product->name }} <span class="product-qty">x{{ $item->quantity }}</span>
                                                    </strong>
                                                </td>
                                                <td class="text-end align-top">
                                                    <span class="amount font-weight-medium text-color-grey">{{ number_format($item->quantity*($item->product->unit_price + ($item->addon->unit_price ?? 0)), 0) }} SEK</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr class="cart-subtotal">
                                                <td class="border-top-0">
                                                    <strong
                                                        class="text-color-dark text-uppercase font-weight-bold letter-space-1">Subtotal</strong>
                                                </td>
                                                <td class="border-top-0 text-end">
                                                    <strong><span class="amount font-weight-medium">{{ number_format($subtotal, 0) }} SEK</span></strong>
                                                </td>
                                            </tr>
                                            <tr class="shipping">
                                                <td colspan="2">
                                                    <strong
                                                        class="d-block text-color-dark mb-2 text-uppercase font-weight-bold letter-space-1">Shipping</strong>
                                                    @php
                                                        $freeShippingThreshold = get_free_shipping_threshold();
                                                        $isFreeShippingEligible = $subtotal >= $freeShippingThreshold;
                                                        $shippingCost = calculate_shipping_cost($subtotal, 'flat-rate');
                                                    @endphp
                                                    
                                                    @if($isFreeShippingEligible)
                                                        <div class="alert alert-success mb-2 p-2" style="font-size: 0.9rem;">
                                                            <strong>🎉 Free Shipping Applied!</strong> Your order qualifies for free shipping.
                                                        </div>
                                                        <input type="hidden" name="shipping_method" value="free" id="shipping_method_hidden">
                                                        <div class="d-flex flex-column">
                                                            <label class="d-flex align-items-center text-color-grey mb-0">
                                                                <input type="radio" class="me-2" checked disabled>
                                                                <span class="text-success font-weight-bold">Free Shipping</span>
                                                            </label>
                                                        </div>
                                                    @else
                                                        <div class="mb-2" style="font-size: 0.85rem; color: #666;">
                                                            <span>Spend <strong>{{ number_format($freeShippingThreshold - $subtotal, 0) }} SEK</strong> more for free shipping!</span>
                                                        </div>
                                                    <div class="d-flex flex-column">
                                                        <label class="d-flex align-items-center text-color-grey mb-0"
                                                            for="shipping_method2">
                                                                <input id="shipping_method2" type="radio" class="me-2 shipping-method-radio"
                                                                    name="shipping_method" value="local-pickup" checked="">
                                                                Local Pickup - Free
                                                        </label>
                                                        <label class="d-flex align-items-center text-color-grey mb-0"
                                                            for="shipping_method3">
                                                                <input id="shipping_method3" type="radio" class="me-2 shipping-method-radio"
                                                                name="shipping_method" value="flat-rate">
                                                                Flat Rate: <span id="flat_rate_amount">{{ number_format($shippingCost, 0) }} SEK</span>
                                                        </label>
                                                    </div>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr class="shipping-cost-row" style="display: none;">
                                                <td>
                                                    <strong class="text-color-dark text-uppercase font-weight-bold">Shipping Cost</strong>
                                                </td>
                                                <td class="text-end">
                                                    <strong><span class="amount font-weight-medium" id="shipping_cost_display">0 SEK</span></strong>
                                                </td>
                                            </tr>
                                            <tr class="total">
                                                <td>
                                                    <strong
                                                        class="text-color-dark text-3-5 text-uppercase font-weight-bold letter-space-1">Total</strong>
                                                </td>
                                                <td class="text-end">
                                                    <strong class="text-color-dark">
                                                        <span
                                                            class="amount text-color-dark text-5 font-weight-bold" id="grand_total_display">{{ number_format($subtotal, 2) }} SEK</span>
                                                    </strong>
                                                </td>
                                            </tr>
                                            <tr class="payment-methods">
                                                <td colspan="2">
                                                    <strong
                                                        class="d-block text-color-dark mb-2 text-uppercase font-weight-bold letter-space-1">Payment
                                                        Methods</strong>
                                                    <div class="d-flex flex-column">
                                                        <label class="d-flex align-items-center text-color-grey mb-0"
                                                            for="payment_method1">
                                                            <input id="payment_method1" type="radio" class="me-2"
                                                                name="payment_method" value="cash-on-delivery"
                                                                checked="">
                                                            Cash On Delivery
                                                        </label>
                                                        @if(get_setting('paypal_payment') == 1)
                                                        <label class="d-flex align-items-center text-color-grey mb-0"
                                                            for="payment_method2">
                                                            <input id="payment_method2" type="radio" class="me-2"
                                                                name="payment_method" value="paypal">
                                                            PayPal
                                                        </label>
                                                        @endif
                                                        @if(get_setting('stripe_payment') == 1)
                                                        <label class="d-flex align-items-center text-color-grey mb-0"
                                                            for="payment_method_stripe">
                                                            <input id="payment_method_stripe" type="radio" class="me-2"
                                                                name="payment_method" value="stripe">
                                                            Stripe
                                                        </label>
                                                        @endif
                                                        @if(\App\PaymentGateways\ManualInvoiceGateway::isEnabled())
                                                        <label class="d-flex align-items-center text-color-grey mb-0"
                                                            for="payment_method3">
                                                            <input id="payment_method3" type="radio" class="me-2"
                                                                name="payment_method" value="invoice">
                                                            Invoice
                                                        </label>
                                                        @endif
                                                        @if(\App\PaymentGateways\ManualSwishGateway::isEnabled())
                                                        <label class="d-flex align-items-center text-color-grey mb-0"
                                                            for="payment_method4">
                                                            <input id="payment_method4" type="radio" class="me-2"
                                                                name="payment_method" value="swish">
                                                            Swish
                                                        </label>
                                                        @endif
                                                    </div>
                                                    
                                                    <!-- Invoice Info Box -->
                                                    <div id="invoice_info_box" class="mt-3 p-3 bg-light border-radius-0" style="display: none;">
                                                        <p class="mb-0 text-2"><strong>Invoice Payment:</strong> Your order will be processed and an invoice will be sent to your email address. Please ensure you have provided the required information based on your customer type.</p>
                                                    </div>
                                                    
                                                    <!-- Swish Info Box -->
                                                    <div id="swish_info_box" class="mt-3 p-3 bg-light border-radius-0" style="display: none;">
                                                        <p class="mb-0 text-2"><strong>Swish Payment:</strong> Click the button below to view Swish payment instructions.</p>
                                                        <button type="button" class="btn btn-light btn-modern text-color-light bg-color-grey bg-color-hover-primary text-uppercase text-2 font-weight-bold border-0 border-radius-5 btn-px-3 py-2 mt-2" id="show_swish_popup_btn">
                                                            View Swish Instructions
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="font-weight-medium text-2">
                                                    Your personal data will be used to process your order, support your
                                                    experience throughout this website, and for other purposes described in
                                                    our privacy policy.
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                    <!-- Terms & Conditions Checkbox -->
                                    <div class="row mt-3 mb-3">
                                        <div class="col">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="accept_terms" name="accept_terms" value="1" required>
                                                <label class="form-label custom-control-label cur-pointer text-2" for="accept_terms">
                                                    I have read and agree to the 
                                                    <a href="{{ route('terms-and-conditions') }}" target="_blank" class="text-color-primary text-decoration-underline font-weight-bold">
                                                        Terms & Conditions
                                                    </a>
                                                    <span class="text-color-danger">*</span>
                                                </label>
                                            </div>
                                            <div id="terms_error" class="text-danger text-2 mt-1" style="display: none;">
                                                <small>You must accept the Terms & Conditions to proceed.</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="submit"
                                        class="btn btn-light w-100 btn-modern text-color-light bg-color-grey bg-color-hover-primary text-uppercase text-3 font-weight-bold border-0 border-radius-5 ws-nowrap btn-px-4 py-3 ms-2">
                                        Place Order <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Swish Payment Popup Modal -->
    <div class="modal fade" id="swishPaymentModal" tabindex="-1" aria-labelledby="swishPaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="swishPaymentModalLabel">Swish Payment Instructions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <strong class="text-color-dark">Swish Number:</strong>
                        <p class="mb-0" id="swish_number_display">{{ \App\PaymentGateways\ManualSwishGateway::getSwishNumber() }}</p>
                    </div>
                        <div class="mb-3">
                            <strong class="text-color-dark">Amount:</strong>
                            <p class="mb-0" id="swish_amount_display">{{ number_format($subtotal, 0) }} SEK</p>
                        </div>
                    <div class="mb-3">
                        <strong class="text-color-dark">Message to write:</strong>
                        <p class="mb-0" id="swish_order_reference_display">{{ $nextOrderReference ?? 'Order #XYZ' }}</p>
                    </div>
                    <div class="alert alert-warning mb-3">
                        <strong class="text-color-dark">Important:</strong> Please write the order number in your Swish message. Otherwise we cannot match the payment.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-modern text-color-light bg-color-grey bg-color-hover-primary text-uppercase text-2 font-weight-bold border-0 border-radius-5 btn-px-4 py-2" id="swish_payment_sent_btn">
                        I have sent the payment
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <!-- Add custom styles if needed -->
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Free Shipping Configuration
            const FREE_SHIPPING_THRESHOLD = {{ get_free_shipping_threshold() }};
            const FLAT_RATE_SHIPPING = 50; // SEK
            const subtotal = {{ $subtotal }};
            const isFreeShippingEligible = subtotal >= FREE_SHIPPING_THRESHOLD;
            
            // Shipping calculation function
            function calculateShipping(method) {
                if (isFreeShippingEligible) {
                    return 0;
                }
                if (method === 'local-pickup') {
                    return 0;
                }
                if (method === 'flat-rate') {
                    return FLAT_RATE_SHIPPING;
                }
                return FLAT_RATE_SHIPPING; // Default
            }
            
            // Update totals function
            function updateTotals() {
                const selectedShippingMethod = document.querySelector('input[name="shipping_method"]:checked')?.value || 'flat-rate';
                const shippingCost = calculateShipping(selectedShippingMethod);
                const grandTotal = subtotal + shippingCost;
                
                // Update shipping cost display
                const shippingCostDisplay = document.getElementById('shipping_cost_display');
                const shippingCostRow = document.querySelector('.shipping-cost-row');
                const grandTotalDisplay = document.getElementById('grand_total_display');
                
                if (shippingCostDisplay) {
                    shippingCostDisplay.textContent = shippingCost > 0 ? shippingCost.toFixed(0) + ' SEK' : 'Free';
                }
                
                if (shippingCostRow) {
                    if (shippingCost > 0 && !isFreeShippingEligible) {
                        shippingCostRow.style.display = '';
                    } else {
                        shippingCostRow.style.display = 'none';
                    }
                }
                
                if (grandTotalDisplay) {
                    grandTotalDisplay.textContent = grandTotal.toFixed(2) + ' SEK';
                }
            }
            
            // Initialize totals on page load
            updateTotals();
            
            // Listen for shipping method changes
            const shippingMethodRadios = document.querySelectorAll('.shipping-method-radio, input[name="shipping_method"]');
            shippingMethodRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    updateTotals();
                });
            });
            
            // Toggle password fields when "Create an account" is checked
            const createAccountCheckbox = document.getElementById('createAccount');
            if (createAccountCheckbox) {
                createAccountCheckbox.addEventListener('change', function() {
                    document.getElementById('password-field').style.display = this.checked ? 'flex' :
                        'none';
                });
            }

            // Customer Type Change Handler
            const customerTypeSelect = document.getElementById('customer_type');
            const personalNumberField = document.getElementById('personal_number_field');
            const vatNumberField = document.getElementById('vat_number_field');
            const personalNumberInput = document.getElementById('personal_number');
            const vatNumberInput = document.getElementById('vat_number');

            if (customerTypeSelect) {
                customerTypeSelect.addEventListener('change', function() {
                    const selectedType = this.value;
                    const paymentMethod = document.querySelector('input[name="payment_method"]:checked')?.value;
                    
                    // Hide both fields first
                    personalNumberField.style.display = 'none';
                    vatNumberField.style.display = 'none';
                    personalNumberInput.removeAttribute('required');
                    vatNumberInput.removeAttribute('required');
                    
                    // Show appropriate field based on customer type and payment method
                    if (paymentMethod !== 'swish') {
                        if (selectedType === 'private') {
                            personalNumberField.style.display = 'block';
                            if (paymentMethod === 'invoice') {
                                personalNumberInput.setAttribute('required', 'required');
                            }
                        } else if (selectedType === 'company') {
                            vatNumberField.style.display = 'block';
                            if (paymentMethod === 'invoice') {
                                vatNumberInput.setAttribute('required', 'required');
                            }
                        }
                    }
                });
            }

            // Payment Method Change Handler
            const paymentMethodRadios = document.querySelectorAll('input[name="payment_method"]');
            const invoiceInfoBox = document.getElementById('invoice_info_box');
            const swishInfoBox = document.getElementById('swish_info_box');
            const placeOrderBtn = document.querySelector('button[type="submit"]');
            let swishPaymentConfirmed = false;

            paymentMethodRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    const selectedMethod = this.value;
                    const customerType = customerTypeSelect?.value;
                    
                    // Hide all info boxes
                    invoiceInfoBox.style.display = 'none';
                    swishInfoBox.style.display = 'none';
                    swishPaymentConfirmed = false;
                    
                    // Reset required attributes
                    personalNumberInput.removeAttribute('required');
                    vatNumberInput.removeAttribute('required');
                    
                    // Show/hide customer type fields based on payment method
                    if (selectedMethod === 'swish') {
                        // Hide customer type fields for Swish
                        personalNumberField.style.display = 'none';
                        vatNumberField.style.display = 'none';
                        swishInfoBox.style.display = 'block';
                        placeOrderBtn.disabled = true;
                    } else if (selectedMethod === 'invoice') {
                        // Show invoice info box
                        invoiceInfoBox.style.display = 'block';
                        placeOrderBtn.disabled = false;
                        
                        // Show appropriate field based on customer type
                        if (customerType === 'private') {
                            personalNumberField.style.display = 'block';
                            personalNumberInput.setAttribute('required', 'required');
                        } else if (customerType === 'company') {
                            vatNumberField.style.display = 'block';
                            vatNumberInput.setAttribute('required', 'required');
                        }
                    } else {
                        // For other payment methods, show fields based on customer type
                        placeOrderBtn.disabled = false;
                        if (customerType === 'private') {
                            personalNumberField.style.display = 'block';
                        } else if (customerType === 'company') {
                            vatNumberField.style.display = 'block';
                        }
                    }
                });
            });

            // Swish Popup Handler
            const showSwishPopupBtn = document.getElementById('show_swish_popup_btn');
            const swishPaymentModal = new bootstrap.Modal(document.getElementById('swishPaymentModal'));
            const swishPaymentSentBtn = document.getElementById('swish_payment_sent_btn');
            const swishOrderReferenceDisplay = document.getElementById('swish_order_reference_display');
            const swishAmountDisplay = document.getElementById('swish_amount_display');

            // Order reference from backend
            const orderReference = '{{ $nextOrderReference ?? "Order #XYZ" }}';
            
            if (showSwishPopupBtn) {
                showSwishPopupBtn.addEventListener('click', function() {
                    // Update amount dynamically
                    const subtotal = {{ $subtotal }};
                    swishAmountDisplay.textContent = subtotal.toFixed(0) + ' SEK';
                    
                    // Update Swish number from backend
                    const swishNumber = '{{ \App\PaymentGateways\ManualSwishGateway::getSwishNumber() }}';
                    document.getElementById('swish_number_display').textContent = swishNumber;
                    
                    // Update order reference
                    swishOrderReferenceDisplay.textContent = orderReference;
                    
                    // Show modal
                    swishPaymentModal.show();
                });
            }

            if (swishPaymentSentBtn) {
                swishPaymentSentBtn.addEventListener('click', function() {
                    swishPaymentModal.hide();
                    swishPaymentConfirmed = true;
                    placeOrderBtn.disabled = false;
                });
            }

            // Function to format validation errors into a list
            function formatErrors(errors) {
                let errorHtml = '<ul style="text-align:left;">';
                Object.keys(errors).forEach(field => {
                    errors[field].forEach(errorMsg => {
                        errorHtml += `<li>${errorMsg}</li>`;
                    });
                });
                errorHtml += '</ul>';
                return errorHtml;
            }

            // AJAX Login Submission (for guest users)
            const loginForm = document.getElementById('frmSignIn');
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    let loginData = new FormData(loginForm);

                    Swal.fire({
                        title: 'Logging in...',
                        didOpen: () => Swal.showLoading(),
                        allowOutsideClick: false,
                    });

                    fetch('{{ route('customer.login') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: loginData
                        })
                        .then(response => response.json())
                        .then(data => {
                            Swal.close();
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Login Successful',
                                    text: data.success,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload(); // Refresh to update UI & cart
                                });
                            } else if (data.errors) {
                                let errorHtml = '<ul>';
                                Object.keys(data.errors).forEach(key => {
                                    data.errors[key].forEach(msg => {
                                        errorHtml += `<li>${msg}</li>`;
                                    });
                                });
                                errorHtml += '</ul>';

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Login Failed',
                                    html: errorHtml
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Login Failed',
                                    text: data.error || 'Invalid credentials'
                                });
                            }
                        })
                        .catch(error => {
                            Swal.close();
                            console.error('Login error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Login failed. Please try again.'
                            });
                        });
                });
            }
            // AJAX Checkout Submission
            const checkoutForm = document.getElementById('checkout-form');
            const acceptTermsCheckbox = document.getElementById('accept_terms');
            const termsErrorDiv = document.getElementById('terms_error');
            
            if (checkoutForm) {
                checkoutForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Validate Terms & Conditions checkbox
                    if (!acceptTermsCheckbox || !acceptTermsCheckbox.checked) {
                        termsErrorDiv.style.display = 'block';
                        acceptTermsCheckbox.focus();
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Terms & Conditions Required',
                            text: 'You must accept the Terms & Conditions to proceed with your order.',
                            confirmButtonText: 'OK'
                        });
                        return;
                    } else {
                        termsErrorDiv.style.display = 'none';
                    }
                    
                    let checkoutData = new FormData(checkoutForm);

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
                        .then(response => response.json())
                        .then(data => {
                            Swal.close();
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Order Placed',
                                    text: 'Your order has been placed successfully!',
                                    timer: 3000,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.href = '{{ url('/order-success') }}/' + data
                                        .order_id;
                                });
                            } else if (data.errors) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Order Error',
                                    html: formatErrors(data
                                        .errors) // Display all errors in a list
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
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Unable to process order. Please try again later.'
                            });
                        });
                });
            }
        });
    </script>
@endsection
