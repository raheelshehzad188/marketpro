@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="h2 fs-16 mb-0">{{ translate('Order Details') }}</h1>
            @php
                $delivery_status = $order->delivery_status;
                $payment_status = $order->payment_status;
            @endphp
            <div class="col-md-3 ml-auto">

                <select class="form-control aiz-selectpicker" data-minimum-results-for-search="Infinity"
                    id="update_payment_status">
                    <option value="unpaid" @if ($payment_status == 'unpaid') selected @endif>{{ translate('Unpaid') }}
                    </option>
                    <option value="paid" @if ($payment_status == 'paid') selected @endif>{{ translate('Paid') }}
                    </option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <div class="row gutters-5">
                <div class="col text-center text-md-left">
                    @foreach ($order->orderDetails as $key => $orderDetail)
                        @if ($orderDetail->product_type == 2)
                            <address>
                                <strong class="text-main">{{ $order->user->name }}</strong><br>
                                {{ $order->user->email }}<br>
                                @if ($order->user->phone)
                                    {{ $order->user->phone }}<br>
                                @endif
                                {{ $orderDetail->address }},
                            </address>
                        @break
                    @endif
                @endforeach

            </div>
            <div class="col-md-4 ml-auto">
                <table>
                    <tbody>
                        <tr>
                            <td class="text-main text-bold">{{ translate('Order #') }}</td>
                            <td class="text-right text-info text-bold"> {{ $order->code }}</td>
                        </tr>

                        @if($order->order_reference)
                        <tr>
                            <td class="text-main text-bold">{{ translate('Order Reference') }}</td>
                            <td class="text-right text-info text-bold"> {{ $order->order_reference }}</td>
                        </tr>
                        @endif

                        <tr>
                            <td class="text-main text-bold">{{ translate('Order Date') }} </td>
                            <td class="text-right">{{ date('d-m-Y h:i A', $order->date) }}</td>
                        </tr>
                        <tr>
                            <td class="text-main text-bold">
                                {{ translate('Total amount') }}
                            </td>
                            <td class="text-right">
                                {{ single_price($order->grand_total) }}
                            </td>
                        </tr>

                        @if($order->payment_method || $order->payment_type)
                        <tr>
                            <td class="text-main text-bold">{{ translate('Payment Method') }}</td>
                            <td class="text-right">
                                @if($order->payment_method)
                                    @php
                                        $paymentMethods = [
                                            'cash-on-delivery' => 'Cash on Delivery',
                                            'paypal' => 'PayPal',
                                            'stripe' => 'Stripe',
                                            'invoice' => 'Invoice',
                                            'swish' => 'Swish'
                                        ];
                                        $displayMethod = $paymentMethods[$order->payment_method] ?? ucfirst(str_replace('-', ' ', $order->payment_method));
                                    @endphp
                                    <strong class="text-info">{{ $displayMethod }}</strong>
                                @elseif($order->payment_type)
                                    <strong class="text-info">{{ $order->payment_type }}</strong>
                                @endif
                            </td>
                        </tr>
                        @endif

                        @if($order->customer_type)
                        <tr>
                            <td class="text-main text-bold">{{ translate('Customer Type') }}</td>
                            <td class="text-right">{{ ucfirst($order->customer_type) }}</td>
                        </tr>
                        @endif

                        @if($order->personal_number)
                        <tr>
                            <td class="text-main text-bold">{{ translate('Personal Number') }}</td>
                            <td class="text-right">{{ $order->personal_number }}</td>
                        </tr>
                        @endif

                        @if($order->vat_number)
                        <tr>
                            <td class="text-main text-bold">{{ translate('VAT Number') }}</td>
                            <td class="text-right">{{ $order->vat_number }}</td>
                        </tr>
                        @endif

                        <tr>
                            <td class="text-main text-bold">
                                {{ translate('Comments') }}
                            </td>
                            <td class="text-right">
                                {{ $order->comments }}
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>



            <div class="row gutters-5">

            </div>

        </div>
        <div class="row">
            @foreach ($order->orderDetails as $key => $orderDetail)
                @if ($orderDetail->product_type == 2)
                    <div class="col-md-8 me-auto">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="text-main text-bold"><strong class="text-main">Build</strong></td>
                                    <td class="text-left text-bold"> {{ $orderDetail->about_project }}</td>
                                </tr>

                                <tr>
                                    <td class="text-main text-bold"><strong class="text-main">Includes</strong>
                                    </td>
                                    @php
                                        $included = json_decode($orderDetail->include, true);
                                    @endphp
                                    @if (!empty($included) && is_array($included))
                                        <td class="text-left">{{ implode(', ', $included) }}</td>
                                    @endif

                                </tr>
                                <tr>
                                    <td class="text-main text-bold">
                                        <strong class="text-main"> Comments:</strong>
                                    </td>
                                    <td class="text-left">
                                        {{ $orderDetail->comments }}
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                @break
            @endif
        @endforeach


    </div>
    <hr class="new-section-sm bord-no">
    <div class="row">
        <div class="col-lg-12 table-responsive">
            <table class="table table-bordered aiz-table invoice-summary">
                <thead>
                    <tr class="bg-trans-dark">
                        <th data-breakpoints="sm" class="min-col">#</th>

                        <th class="text-uppercase">{{ translate('Description') }}</th>
                        {{-- <th data-breakpoints="lg" class="text-uppercase">{{ translate('Delivery Type') }}</th> --}}
                        <th data-breakpoints="sm" class="min-col text-center text-uppercase">
                            {{ translate('Qty') }}
                        </th>
                        <th data-breakpoints="sm" class="min-col text-center text-uppercase">
                            {{ translate('Price') }}</th>
                        <th data-breakpoints="sm" class="min-col text-right text-uppercase">
                            {{ translate('Total') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderDetails as $key => $orderDetail)
                        <tr>
                            <td>{{ $key + 1 }}</td>

                            <td>
                                @if ($orderDetail->product_type == 'simple')
                                    {{ $orderDetail->product->sku }} -
                                    {{ strip_tags($orderDetail->product->name) }}
                                @else
                                {{ \App\ProductAddon::findOrFail($orderDetail->product_id)->sku }} -
                                    {{ \App\ProductAddon::findOrFail($orderDetail->product_id)->name }}
                                @endif
                            </td>

                            <td class="text-center">{{ $orderDetail->quantity }}</td>
                            <td class="text-center">
                                {{ single_price($orderDetail->price / $orderDetail->quantity) }}
                            </td>
                            <td class="text-center">{{ single_price($orderDetail->price) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="clearfix float-right">
        <table class="table">
            <tbody>
                <tr>
                    <td>
                        <strong class="text-muted">{{ translate('Sub Total') }} :</strong>
                    </td>
                    <td>
                        {{ single_price($order->orderDetails->sum('price')) }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong class="text-muted">{{ translate('Shipping') }} :</strong>
                    </td>
                    <td>
                        {{ single_price($order->shipping_cost) }} <small>({{ $order->shipping_method }}) </small>
                    </td>
                </tr>
                {{-- <tr>
                        <td>
                            <strong class="text-muted">{{ translate('Tax') }} :</strong>
                        </td>
                        <td>
                            {{ single_price($order->orderDetails->sum('tax')) }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <strong class="text-muted">{{ translate('Coupon') }} :</strong>
                        </td>
                        <td>
                            {{ single_price($order->coupon_discount) }}
                        </td>
                    </tr> --}}
                <tr>
                    <td>
                        <strong class="text-muted">{{ translate('TOTAL') }} :</strong>
                    </td>
                    <td class="text-muted h5">
                        {{ single_price($order->grand_total) }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="text-right no-print">
            <a href="{{ route('invoice.download', $order->id) }}" type="button" class="btn btn-icon btn-light"><i
                    class="las la-print"></i></a>
        </div>
    </div>

</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $('#assign_deliver_boy').on('change', function() {
        var order_id = {{ $order->id }};
        var delivery_boy = $('#assign_deliver_boy').val();
        $.post('{{ route('orders.delivery-boy-assign') }}', {
            _token: '{{ @csrf_token() }}',
            order_id: order_id,
            delivery_boy: delivery_boy
        }, function(data) {
            AIZ.plugins.notify('success', '{{ translate('Delivery boy has been assigned') }}');
        });
    });

    $('#update_delivery_status').on('change', function() {
        var order_id = {{ $order->id }};
        var status = $('#update_delivery_status').val();
        $.post('{{ route('orders.update_delivery_status') }}', {
            _token: '{{ @csrf_token() }}',
            order_id: order_id,
            status: status
        }, function(data) {
            AIZ.plugins.notify('success', '{{ translate('Delivery status has been updated') }}');
        });
    });

    $('#update_payment_status').on('change', function() {
        var order_id = {{ $order->id }};
        var status = $('#update_payment_status').val();
        $.post('{{ route('orders.update_payment_status') }}', {
            _token: '{{ @csrf_token() }}',
            order_id: order_id,
            status: status
        }, function(data) {
            AIZ.plugins.notify('success', '{{ translate('Payment status has been updated') }}');
        });
    });
</script>
@endsection
