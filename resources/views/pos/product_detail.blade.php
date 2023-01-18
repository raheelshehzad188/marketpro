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
<section class="mb-4 pt-3">
    <div class="container">
        <div class="row">
            <div class="col-12  mb-4">
                <div class="sticky-top z-3 row gutters-10">
                    @php
                        $photos = explode(',', $detailedProduct->thumbnail_img);
                    @endphp
                    <div class="col order-1 order-md-2">
                        <div style="text-align: center; width: 90%; padding: 10px 0; margin: 0 auto;">
                            <input type="button" value="Zoom +" id="zoom-in" class="btn btn-light btn-sm" />
                            <input type="button" value="Zoom -" id="zoom-out" class="btn btn-light btn-sm" />
                            <input type="button" value="Reset" id="reset" class="btn btn-light btn-sm" />
                        </div>
                        <div id="wrap">
                            <div class="text-center" id="inner">
                                @foreach ($photos as $key => $photo)
                                    <img class="my-image h-400px" src="{{ uploaded_asset($photo) }}" draggable="false"
                                        id="image" style="display: none">
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>
            </div>



            <div class="col-12">
                <div class="text-left">
                    <h1 class="mb-2 fs-20 fw-600">
                        {{ $detailedProduct->name }}
                    </h1>
                    <hr>
                </div>
                @if (count($detailedProduct->product_addons) > 0 &&
                    (empty($detailedProduct->unit_price) ||
                        $detailedProduct->unit_price == 0 ||
                        $detailedProduct->unit_price == '0.0' ||
                        $detailedProduct->unit_price == '0.00'))
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nr</th>
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
                                foreach ($detailedProduct->product_addons as $key => $product_addon) {
                                    $m_keys = DB::table('product_addon_pivot')
                                        ->where('product_addon_id', $product_addon->id)
                                        ->where('product_id', $detailedProduct->id)
                                        ->get();

                                    //check if sku exists
                                    if (!$m_keys->isEmpty() && !empty($product_addons_new)) {
                                        foreach ($product_addons_new as $product_addon_v) {
                                            if ($product_addon_v->sku == $product_addon->sku) {
                                                $sort_orders_exists = true;
                                                break;
                                            } else {
                                                $sort_orders_exists = false;
                                            }
                                        }
                                    }

                                    if (!$sort_orders_exists) {
                                        if (!$m_keys->isEmpty()) {
                                            foreach ($m_keys as $key => $value) {
                                                $m_key = $value->sort_order;
                                                $m_key = !empty($m_key) ? $m_key . '.' . $i : 'n/a_' . $i;
                                                $product_addons_new[$m_key] = $product_addon;
                                            }
                                        } else {
                                            $m_key = 'n/a_' . $i;
                                            $product_addons_new[$m_key] = $product_addon;
                                        }
                                    }

                                    $i++;
                                }
                                ksort($product_addons_new);
                            @endphp
                            @foreach ($product_addons_new as $key => $product_addon)
                                @php
                                    $key_ar = explode('.', $key);
                                    if (is_array($key_ar)) {
                                        $key = $key_ar[0];
                                    }

                                    $key_ar2 = explode('_', $key);
                                    if (is_array($key_ar2)) {
                                        $key = $key_ar2[0];
                                    }
                                @endphp
                                <tr>
                                    <th scope="row">
                                        {{ $key }}
                                    </th>
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
                                                    data-field="qty_{{ $detailedProduct->id . '_' . $product_addon->id }}"
                                                    disabled="">
                                                    <i class="las la-minus"></i>
                                                </button>
                                                <input type="number" name="quantity"
                                                    class="col border-0 text-center flex-grow-1 fs-16 input-number"
                                                    placeholder="1"
                                                    id="qty_{{ $detailedProduct->id . '_' . $product_addon->id }}"
                                                    value="{{ $detailedProduct->min_qty }}" min="1"
                                                    max="200">
                                                <button class="btn  col-auto btn-icon btn-sm btn-circle btn-light"
                                                    type="button" data-type="plus"
                                                    data-field="qty_{{ $detailedProduct->id . '_' . $product_addon->id }}">
                                                    <i class="las la-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button"
                                            class="btn btn-soft-primary mr-2 btn-sm add-to-cart fw-600"
                                            onclick="addToCart(this,{{ $detailedProduct->id }},{{ $product_addon->id }},'addon')">
                                            <i
                                                class="las la-shopping-bag actBtn-bag{{ $detailedProduct->id }}{{ $product_addon->id }}"></i>
                                            <i class="las la-spinner la-spin la-1x actBtn-loader{{ $detailedProduct->id }}{{ $product_addon->id }}"
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
