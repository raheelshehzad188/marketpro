@extends('frontend.layouts.app')

@section('content')


    <section class="pt-5 bg-6">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="row aiz-steps arrow-divider">
                        <div class="col">
                            <div class="text-center">
                                <span class="step"></span>
                                <h3 class="fs-16 ff-bold fw-600 d-none d-lg-block text-dark">Share Info</h3>
                            </div>
                        </div>

                        <div class="col">
                            <div class="text-center">
                                <span class="step"></span>
                                <h3 class="fs-16 ff-bold fw-600 d-none d-lg-block text-dark">Select a Package</h3>
                            </div>
                        </div>
                        <div class="col active">
                            <div class="text-center">
                                <span class="step active"></span>
                                <h3 class="fs-16 ff-bold fw-600 d-none d-lg-block text-dark">Start Saving Water</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="step-form bg-6 pt-sm-5 pt-3  pb-sm-5 pb-3">
        <div class="container">
            <form action="{{ route('payment.package_checkout') }}" class="form-default" role="form" method="POST"
                id="checkout-form">
                @csrf
                <input type="hidden" name="owner_id" value="{{ $carts[0]['owner_id'] }}">
                <div class="row">
                    <div class="col-lg-7 mx-auto mb-4">
                        <div class="row">
                            <div class="col mx-auto">
                                <div class="fs-32 fw-500 mb-2">Order Summary</div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table order-summary">
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($carts as $key => $cartItem)
                                        @php
                                            $product = \App\Product::find($cartItem['product_id']);
                                            $product_stock = $product->stocks->where('variant', $cartItem['variation'])->first();
                                            $total = $total + ($cartItem['price'] + $cartItem['tax']) * $cartItem['quantity'];
                                            $product_name_with_choice = strip_tags($product->getTranslation('name'));
                                            if ($cartItem['variation'] != null) {
                                                $product_name_with_choice = strip_tags($product->getTranslation('name')) . ' - ' . preg_replace('/(?<!\ )[A-Z]/', ' $0', $cartItem['variation']);
                                            }
                                            $product_addons = [];
                                            if ($cartItem['addons'] != null) {
                                                $addons = json_decode($cartItem['addons']);
                                                if (!empty($addons)) {
                                                    $product_addons = \App\ProductAddon::whereIn('id', $addons)->get();
                                                }
                                            }
                                        @endphp
                                        <tr class="cart_item">
                                            <td class="product-name fs-20 fw-500 border-0 align-middle">
                                                {{ $product_name_with_choice }}
                                                <span class="product-quantity d-block fs-16">
                                                    {{ $product->sub_title }}
                                                </span>
                                            </td>
                                            <td class="product-total text-end border-0 align-middle">
                                                <span
                                                    class="fs-20 fw-500">{{ single_price(($cartItem['price'] + $cartItem['tax']) * $cartItem['quantity']) }}</span>
                                            </td>
                                        </tr>
                                        @if (!empty($product_addons))
                                            @foreach ($product_addons as $p_addon)
                                                @php
                                                    $total = $total + $p_addon['unit_price'];
                                                @endphp
                                                <tr class="cart_item">
                                                    <td class="product-name fs-20 fw-500 border-0 align-middle">
                                                        {!! $p_addon['name'] !!}

                                                    </td>
                                                    <td class="product-total text-end border-0 align-middle">
                                                        <span
                                                            class="fs-20 fw-500">{{ single_price($p_addon['unit_price']) }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach



                                    <tr class="cart_item">
                                        <td class="product-name fs-20 fw-500 border-0 align-middle">

                                        </td>
                                        <td class="product-total text-end border-0 align-middle">

                                        </td>
                                    </tr>
                                </tbody>

                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th class="border-0 fs-20 ff-bold"></th>
                                        <td class="text-end border-0">
                                            <span class="fw-600 fs-20 ff-bold"></span>
                                        </td>
                                    </tr>
                                    <tr class="cart-subtotal">

                                        <th class="border-0 fs-20 ff-bold">Total</th>
                                        <td class="text-end border-0">
                                            <span class="fw-600 fs-20 ff-bold">{{ single_price($total) }}</span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>






                        </div>


                        {{-- <div class="row">
                            <div class="col mx-auto">
                                <div class="fs-32 fw-500 mt-4 mb-3">Billing Details</div>
                            </div>
                        </div> --}}

                        {{-- <div class="row">
                            <div class="col-6  mx-auto mb-4">
                                <input placeholder="First Name" class="form-control border-0 fs-22" type="text" name="">
                            </div>
                            <div class="col-6  mx-auto mb-4">
                                <input placeholder="Last Name" class="form-control border-0 fs-22" type="text" name="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6  mx-auto mb-4">
                                <input placeholder="Card Number" class="form-control border-0 fs-22" type="text"
                                    name="">
                            </div>
                            <div class="col-6  mx-auto mb-4">
                                <div class="row">
                                    <div class="col-6">
                                        <input placeholder="MM/YY" class="form-control border-0 fs-22" type="text"
                                            name="">
                                    </div>

                                    <div class="col-6">
                                        <input placeholder="CVC" class="form-control border-0 fs-22" type="text"
                                            name="">
                                    </div>
                                </div>

                            </div>
                        </div> --}}

                    </div>
                </div>




                <div class="row">
                    <div class="col-md-8 text-center mx-auto">
                        <button type="button" id="nextBtn"
                            class="btn btn-primary btn-rounded fs-18 fw-500 ff-bold text-uppercase px-5"
                            onclick="submitOrder(this)">CONFIRM
                            & PAY</button>
                    </div>

                    <div class="col-md-8 text-center mx-auto mt-4">
                        <div class="fs-16 fw-500">
                            <i class="las la-lock"></i>All transactions are secure and encrypted.
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>
@endsection

@section('script')
    <script>
        function submitOrder(el) {
            $(el).prop('disabled', true);
            $('#checkout-form').submit();
        }
    </script>
@endsection
