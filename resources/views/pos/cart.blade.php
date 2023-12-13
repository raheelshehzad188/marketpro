@extends('backend.layouts.app')

@section('content')

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h6">{{ translate('Cart') }}</h5>
    </div>


    <div class="col-lg-10 mx-auto">
        {{-- <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <select name="user_id" class="form-control form-control-sm aiz-selectpicker pos-customer"
                            data-live-search="true" onchange="getShippingAddress()">
                            <option value="">{{ translate('Walk In Customer') }}</option>
                            @foreach (\App\Customer::all() as $key => $customer)
                                @if ($customer->user)
                                    <option value="{{ $customer->user->id }}"
                                        data-contact="{{ $customer->user->email }}">
                                        {{ $customer->user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="button" class="btn btn-icon btn-soft-dark ml-3" data-target="#new-customer"
                        data-toggle="modal">
                        <i class="las la-truck"></i>
                    </button>
                </div>
            </div>
        </div> --}}
        <div class="card mar-btm" id="cart-details">
            <div class="card-body">
                <table class="table aiz-table mb-0 mar-no" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="60%">{{ translate('Product') }}</th>
                            <th width="15%">{{ translate('QTY') }}</th>
                            <th>{{ translate('Price') }}</th>
                            <th>{{ translate('Subtotal') }}</th>
                            <th class="text-right">{{ translate('Remove') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $selected_shipping_id = $selected_shipping_cost = 0;
                            $subtotal = 0;
                            $tax = 0;
                            $shipping = 0;

                        @endphp
                        @if (\App\Models\Cart::where('user_id', Auth::user()->id)->first())
                            @php

                                $carts = unserialize(\App\Models\Cart::where('user_id', Auth::user()->id)->first()->cart_data);
                                $selected_shipping_id = @Session::get('shipping_id');
                                $selected_shipping_cost = @Session::get('shipping');
                                //     echo '<pre>';
                                // print_r($selected_shipping_cost);
                                // echo '</pre>';
                                //     exit();
                            @endphp
                            @forelse ($carts as $key => $cartItem)
                                @php
                                    $subtotal += $cartItem['price'] * $cartItem['quantity'];
                                    $tax += $cartItem['tax'] * $cartItem['quantity'];
                                    $shipping += $cartItem['shipping'] * $cartItem['quantity'];
                                    if (Session::get('shipping', 0) == 0) {
                                        $shipping = 0;
                                    }

                                    if ($cartItem['type'] == 'simple') {
                                        $product_name = \App\Product::find($cartItem['item_id'])->name;
                                        $article_number = \App\Product::find($cartItem['item_id'])->sku;
                                    } else {
                                        $product_name = \App\ProductAddon::find($cartItem['item_id'])->name;
                                        $article_number = \App\ProductAddon::find($cartItem['item_id'])->sku;
                                    }
                                @endphp
                                <tr>
                                    <td>
                                        <span class="media">
                                            <div class="media-body">
                                                {{ $article_number }} - {{ $product_name }}
                                            </div>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="">
                                            <input type="number" class="form-control text-center" placeholder="1"
                                                id="qty-{{ $key }}" value="{{ $cartItem['quantity'] }}"
                                                onchange="updateQuantity({{ $key }})" min="1">
                                        </div>
                                    </td>
                                    <td>{{ single_price($cartItem['price']) }}</td>
                                    <td>{{ single_price($cartItem['price'] * $cartItem['quantity']) }}
                                    </td>
                                    <td class="text-right">
                                        <button type="button" class="btn btn-circle btn-icon btn-sm btn-danger"
                                            onclick="removeFromCart({{ $key }})">
                                            <i class="las la-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <i class="las la-frown la-3x opacity-50"></i>
                                        <p>{{ translate('No Product Added') }}</p>
                                    </td>
                                </tr>
                            @endforelse
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="card-footer bord-top">
                <table class="table mb-0 mar-no" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="">{{ translate('Shipping') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shippings as $shipping_method)
                            <tr>
                                <td class="">
                                    <div class="radio radio-inline">
                                        <input type="radio" name="shipping"
                                            id="radioExample_2a{{ $shipping_method->id }}"
                                            value="{{ $shipping_method->id }}" onchange="setShipping()"
                                            {{ $shipping_method->id == $selected_shipping_id ? 'checked' : '' }}>
                                        <label
                                            for="radioExample_2a{{ $shipping_method->id }}">{{ $shipping_method->name }}
                                            ({{ single_price($shipping_method->cost) }})
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td class="">

                                <div class="form-group">
                                    <textarea class="form-control comments" name="comments" placeholder="Write comments for this order.."></textarea>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="card-footer bord-top">
                <table class="table mb-0 mar-no" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center">{{ translate('Sub Total') }}</th>
                            <th class="text-center">{{ translate('Total Tax') }}</th>
                            {{-- <th class="text-center">{{ translate('Total Shipping') }}</th>
                            <th class="text-center">{{ translate('Discount') }}</th> --}}
                            <th class="text-center">{{ translate('Total') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">{{ single_price($subtotal) }}</td>
                            <td class="text-center">{{ single_price($tax) }}</td>
                            {{-- <td class="text-center">{{ single_price($shipping) }}</td>
                            <td class="text-center">
                                {{ single_price(Session::get('pos_discount', 0)) }}</td> --}}
                            <td class="text-center">
                                {{ single_price($subtotal + $tax + $selected_shipping_cost - Session::get('pos_discount', 0)) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pos-footer mar-btm">
            <div class="d-flex justify-content-between">
                {{-- <div class="d-flex">
                    <div class="dropdown mr-3 dropup">
                        <button class="btn btn-outline-dark btn-styled dropdown-toggle" type="button"
                            data-toggle="dropdown">
                            {{ translate('Shipping') }}
                        </button>
                        <div class="dropdown-menu p-3 dropdown-menu-lg">
                            <div class="radio radio-inline">
                                <input type="radio" name="shipping" id="radioExample_2a" value="0" checked
                                    onchange="setShipping()">
                                <label for="radioExample_2a">{{ translate('Without Shipping Charge') }}</label>
                            </div>

                            <div class="radio radio-inline">
                                <input type="radio" name="shipping" id="radioExample_2b" value="1"
                                    onchange="setShipping()">
                                <label for="radioExample_2b">{{ translate('With Shipping Charge') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown dropup">
                        <button class="btn btn-outline-dark btn-styled dropdown-toggle" type="button"
                            data-toggle="dropdown">
                            {{ translate('Discount') }}
                        </button>
                        <div class="dropdown-menu p-3 dropdown-menu-lg">
                            <div class="input-group">
                                <input type="number" min="0" placeholder="Amount" name="discount"
                                    class="form-control" value="{{ Session::get('pos_discount', 0) }}" required
                                    onchange="setDiscount()">
                                <div class="input-group-append">
                                    <span class="input-group-text">{{ translate('Flat') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="ml-auto mb-4">
                    <button type="button" class="btn btn-primary" data-target="#order-confirm"
                        data-toggle="modal">{{ translate('Place Order') }}</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('modal')
    <!-- Address Modal -->
    <div id="new-customer" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header bord-btm">
                    <h4 class="modal-title h6">{{ translate('Shipping Address') }}</h4>
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="shipping_address">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-styled btn-base-3" data-dismiss="modal"
                        id="close-button">{{ translate('Close') }}</button>
                    <button type="button" class="btn btn-primary btn-styled btn-base-1"
                        data-dismiss="modal">{{ translate('Confirm') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- new address modal -->
    <div id="new-address-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header bord-btm">
                    <h4 class="modal-title h6">{{ translate('Shipping Address') }}</h4>
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form class="form-horizontal" action="{{ route('addresses.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="customer_id" id="set_customer_id" value="">
                        <div class="form-group">
                            <div class=" row">
                                <label class="col-sm-2 control-label" for="address">{{ translate('Address') }}</label>
                                <div class="col-sm-10">
                                    <textarea placeholder="{{ translate('Address') }}" id="address" name="address" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" row">
                                <label class="col-sm-2 control-label" for="email">{{ translate('Country') }}</label>
                                <div class="col-sm-10">
                                    <select name="country" id="country" class="form-control aiz-selectpicker" required
                                        data-placeholder="{{ translate('Select country') }}">
                                        @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" row">
                                <label class="col-sm-2 control-label" for="city">{{ translate('City') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" placeholder="{{ translate('City') }}" id="city"
                                        name="city" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" row">
                                <label class="col-sm-2 control-label"
                                    for="postal_code">{{ translate('Postal code') }}</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" placeholder="{{ translate('Postal code') }}"
                                        id="postal_code" name="postal_code" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" row">
                                <label class="col-sm-2 control-label" for="phone">{{ translate('Phone') }}</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" placeholder="{{ translate('Phone') }}"
                                        id="phone" name="phone" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-styled btn-base-3"
                            data-dismiss="modal">{{ translate('Close') }}</button>
                        <button type="submit"
                            class="btn btn-primary btn-styled btn-base-1">{{ translate('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="product-variation" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-lg">
            <div class="modal-content" id="variants">

            </div>
        </div>
    </div>

    <div id="order-confirm" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom">
            <div class="modal-content" id="variants">
                <div class="modal-header bord-btm">
                    <h4 class="modal-title h6">{{ translate('Order Confirmation') }}</h4>
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <p>{{ translate('Are you sure to confirm this order?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-styled btn-base-3"
                        data-dismiss="modal">{{ translate('Close') }}</button>
                    <button type="button" id="confirmOrderButton" onclick="submitOrder('cash')"
                        class="btn btn-styled btn-base-1 btn-primary">{{ translate('Comfirm Order') }}</button>
                </div>
            </div>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <style>
        th {
            border-top: 0px !important;
        }
    </style>
@endsection

@section('script')
    <script type="text/javascript">
        var ajax_loader =
            '<div class="text-center w-100"><div class="spinner-border" style="width: 3rem; height: 3rem;" role="status"><span class="sr-only">Loading...</span></div></div>'
        var products = null;
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function() {
            const $container = $('#container');
            const $productList = $('#product-list');


            $container.removeClass('mainnav-lg').addClass('mainnav-sm');

            $productList.on('click', '.product-card', function() {
                const id = $(this).data('id');
                $.get('{{ route('variants') }}', {
                    id
                }, data => {
                    if (data === 0) {
                        addToCart(id, null, 1);
                    } else {
                        $('#variants').html(data);
                        $('#product-variation').modal('show');
                    }
                }).fail(() => {
                    console.error('Error fetching variants');
                });
            });
        });

        function removeFromCart(key) {
            ajaxPost('{{ route('pos.removeFromCart') }}', {
                key
            }, () => location.reload());
        }

        function addVariantProductToCart(id) {
            const variant = $('input[name=variant]:checked').val();
            addToCart(id, variant, 1);
        }

        function updateQuantity(key) {
            const quantity = $('#qty-' + key).val();
            ajaxPost('{{ route('pos.updateQuantity') }}', {
                key,
                quantity
            }, () => location.reload());
        }

        function setDiscount() {
            const discount = $('input[name=discount]').val();
            ajaxPost('{{ route('pos.setDiscount') }}', {
                discount
            }, data => {
                $('#cart-details').html(data);
                $('#product-variation').modal('hide');
            });
        }

        function setShipping() {
            const shipping = $('input[name=shipping]:checked').val();
            ajaxPost('{{ route('pos.setShipping') }}', {
                shipping
            }, () => location.reload());
        }

        function getShippingAddress() {
            const id = $('select[name=user_id]').val();
            ajaxPost('{{ route('pos.getShippingAddress') }}', {
                id
            }, data => {
                $('#shipping_address').html(data);
            });
        }

        function add_new_address() {
            const customer_id = $('#customer_id').val();
            $('#set_customer_id').val(customer_id);
            $('#new-address-modal').modal('show');
            $("#close-button").click();
        }


        function ajaxPost(url, data, callback) {
            $.post(url, {
                    ...data,
                    _token: csrfToken
                })
                .done(callback)
                .fail(() => console.error('AJAX request failed'));
        }


        function submitOrder(payment_type) {
            // Disable the confirm order button to prevent multiple submissions
            $('#confirmOrderButton').prop('disabled', true);

            $.post('{{ route('pos.order_place') }}', {
                _token: '{{ csrf_token() }}',
                comments: $('.comments').val()
            }, function(data) {
                if (data > 0) {
                    // Create a template URL with a placeholder
                    var thankYouUrlTemplate = '{{ route('thanks', ['id' => '__PLACEHOLDER__']) }}';
                    // Replace the placeholder with the actual data (order ID)
                    var thankYouUrl = thankYouUrlTemplate.replace('__PLACEHOLDER__', data);

                    // Redirect to the thank you page on successful order submission
                    window.location.href = thankYouUrl;
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                    // Re-enable the confirm order button if there's an error
                    $('#confirmOrderButton').prop('disabled', false);
                }
            }).fail(function() {
                // Re-enable the confirm order button if the request fails
                $('#confirmOrderButton').prop('disabled', false);
                AIZ.plugins.notify('danger', '{{ translate('Request failed. Please try again.') }}');
            });
        }
    </script>
@endsection
