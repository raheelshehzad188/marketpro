<style>
    #wrap {
        width: 100%;
        height: 400px;
        margin: auto;
    }

    #inner {
        width: 100%;
        height: 100%;
        overflow: hidden;
        cursor: pointer;
    }
</style>
<section class="mb-4 pt-3 w-100" >
    <div class="container">
        <div class="row">
            <div class="col-12  mb-4">

            </div>



            <div class="col-12">

                @if (count($product_addons) > 0)
                    <table class="table">
                        <thead>
                            <tr>

                                <th scope="col">Art</th>
                                <th scope="col">Namn</th>
                                <th scope="col">Antal</th>
                                <th></th>
                                <th scope="col">Pris</th>
                                <th>I lager</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $product_addons_new = [];
                                $i = 0;
                                $sort_orders_exists = false;
                            @endphp
                            @foreach ($product_addons as $key => $product_addon)
                                <tr>

                                    @if (!empty($keyword))
                                        <td>{!! preg_replace(
                                            '/\w*?' . preg_quote($keyword) . '\w*/i',
                                            "<b style='color:#377dff;font-size:15px'>$0</b>",
                                            $product_addon->sku,
                                        ) !!}</td>
                                    @else
                                        <td>{{ $product_addon->sku }}</td>
                                    @endif

                                    <td>{{ $product_addon->name }}</td>
                                    <td>
                                        <div class="product-quantity d-flex align-items-center">
                                            <div class="row no-gutters align-items-center aiz-plus-minus mr-3"
                                                style="width: 130px;">
                                                <button class="btn col-auto btn-icon btn-sm btn-circle btn-light"
                                                    type="button" data-type="minus"
                                                    data-field="qty_0_{{ $product_addon->id }}" disabled="">
                                                    <i class="las la-minus"></i>
                                                </button>
                                                <input type="number" name="quantity"
                                                    class="col border-0 text-center flex-grow-1 fs-16 input-number"
                                                    placeholder="1" id="qty_0_{{ $product_addon->id }}" value="1"
                                                    min="1" max="200">
                                                <button class="btn  col-auto btn-icon btn-sm btn-circle btn-light"
                                                    type="button" data-type="plus"
                                                    data-field="qty_0_{{ $product_addon->id }}">
                                                    <i class="las la-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button"
                                            class="btn btn-soft-primary mr-2 btn-sm add-to-cart fw-600"
                                            onclick="addToCart(this,0,{{ $product_addon->id }},'addon')">
                                            <i
                                                class="las la-shopping-bag actBtn-bag0{{ $product_addon->id }}"></i>
                                            <i class="las la-spinner la-spin la-1x actBtn-loader0{{ $product_addon->id }}"
                                                style="display: none"></i>
                                        </button>
                                    </td>

                                    <td>
                                        <span class="fake_price_span"
                                            @if (Session::get('fake_price') == 'yes') style="display: block" @else style="display: none" @endif>{{ single_price($product_addon->fake_price) }}
                                        </span>
                                        <span class="real_price_span"
                                            @if (Session::get('fake_price') == 'yes') style="display: none" @else style="display: block" @endif>{{ single_price($product_addon->unit_price) }}
                                        </span>
                                    </td>

                                    <td>{{ $product_addon->qty }}</td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                {{-- <th scope="col">Nr</th> --}}
                                <th scope="col">Art</th>
                                <th scope="col">Namn</th>
                                <th scope="col">Antal</th>
                                <th></th>
                                <th scope="col">Pris</th>
                                <th>I lager</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                {{-- <th scope="row">1</th> --}}
                                <td>{{ $detailedProduct->sku }}</td>
                                <td>{{ $detailedProduct->name }}</td>
                                <td>
                                    <div class="product-quantity d-flex align-items-center">
                                        <div class="row no-gutters align-items-center aiz-plus-minus mr-3"
                                            style="width: 130px;">
                                            <button class="btn col-auto btn-icon btn-sm btn-circle btn-light"
                                                type="button" data-type="minus"
                                                data-field="qty_{{ $detailedProduct->id }}_0" disabled="">
                                                <i class="las la-minus"></i>
                                            </button>
                                            <input type="number" name="quantity"
                                                class="col border-0 text-center flex-grow-1 fs-16 input-number"
                                                placeholder="1" id="qty_{{ $detailedProduct->id }}_0"
                                                value="{{ $detailedProduct->min_qty }}" min="1"
                                                {{-- {{ $detailedProduct->min_qty }} --}} max="200"> {{-- {{ $detailedProduct->qty }} --}}
                                            <button class="btn  col-auto btn-icon btn-sm btn-circle btn-light"
                                                type="button" data-type="plus"
                                                data-field="qty_{{ $detailedProduct->id }}_0">
                                                <i class="las la-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-soft-primary mr-2 btn-sm add-to-cart fw-600"
                                        onclick="addToCart(this,{{ $detailedProduct->id }},0,'simple')">
                                        <i class="las la-spinner la-spin la-1x actBtn-loader{{ $detailedProduct->id }}0"
                                            style="display: none"></i>
                                        <i class="las la-shopping-bag actBtn-bag{{ $detailedProduct->id }}0"></i>
                                    </button>
                                </td>

                                <td>
                                    <span class="fake_price_span"
                                        @if (Session::get('fake_price') == 'yes') style="display: block" @else style="display: none" @endif>{{ single_price($detailedProduct->fake_price) }}
                                    </span>
                                    <span class="real_price_span"
                                        @if (Session::get('fake_price') == 'yes') style="display: none" @else style="display: block" @endif>{{ single_price($detailedProduct->unit_price) }}
                                    </span>
                                </td>

                                <td>{{ $detailedProduct->qty }}</td>
                            </tr>

                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>
</section>


<script>
    function initImage() {
        $('#image').apImageZoom({
            cssWrapperClass: 'custom-wrapper-class'
                // , autoCenter: false
                // , loadingAnimation: 'throbber'
                ,
            minZoom: false,
            maxZoom: false
            // , maxZoom: 1.0
            // , hammerPluginEnabled: false
            //, hardwareAcceleration: false
        });
    };
    $(document).ready(function() {

    });



    $('#zoom-in').click(function() {
        $('#image').apImageZoom('zoomIn');
    });
    $('#zoom-out').click(function() {
        $('#image').apImageZoom('zoomOut');
    });
    $('#reset').click(function() {
        $('#image').apImageZoom('reset');
    });

    initImage();
    AIZ.extra.plusMinus();
</script>
