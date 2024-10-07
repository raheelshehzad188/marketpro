<style>
    #wrap {
        width: 100%;
        height: 300px;
        margin: auto;
    }

    #inner {
        width: 100%;
        height: 100%;
        overflow: hidden;
        cursor: pointer;
    }

    .aiz-pos-product-list.right {
        overflow: hidden;
        max-height: 100% !important;
        height: auto !important;
    }

    .addon-scroll {
        overflow-x: hidden;
        height: calc(100vh - 630px);
        overflow-y: scroll !important;
    }
</style>
<section class="mb-4 pt-3 w-100">
    <div class="container">
        <div class="row">
            <div class="col-12  mb-4">
                <div class="sticky-top z-3 row gutters-10">
                    @php
                        $photos = [];
                    @endphp

                    @if ($linked_product_addon)
                        {{-- If a ProductAddon and its associated product are found --}}
                        @php
                            $linkedProduct = $linked_product_addon->products->first();
                            $photos =
                                $linkedProduct && $linkedProduct->thumbnail_img
                                    ? explode(',', $linkedProduct->thumbnail_img)
                                    : [];
                        @endphp
                    @elseif ($detailedProduct)
                        {{-- If no ProductAddon is found, but a detailedProduct is --}}
                        @php
                            $photos =
                                $detailedProduct && $detailedProduct->thumbnail_img
                                    ? explode(',', $detailedProduct->thumbnail_img)
                                    : [];
                        @endphp
                    @endif

                    @if (!empty($photos))
                        <div class="col order-1 order-md-2">
                            <div style="text-align: center; width: 90%; padding: 0px 0; margin: 0 auto;">
                                <input type="button" value="Zoom +" id="zoom-in" class="btn btn-light btn-sm" />
                                <input type="button" value="Zoom -" id="zoom-out" class="btn btn-light btn-sm" />
                                <input type="button" value="Reset" id="reset" class="btn btn-light btn-sm" />
                            </div>
                            <div id="wrap">
                                <div class="text-center" id="inner">
                                    @foreach ($photos as $key => $photo)
                                        <img class="my-image h-300px" src="{{ uploaded_asset($photo) }}"
                                            draggable="false" id="image" style="display: none">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>



            <div class="col-12">
                <div class="table-responsive-container">
                    <div class="table-responsive"> <!-- Add this div -->
                        <div class="scroll-indicator d-lg-none">Scroll Right <i class="las la-arrow-right"></i></div>
                        @if ($linked_product_addon)
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
                                        $linkedProduct = $linked_product_addon->products->first();
                                    @endphp
                                    @if ($linkedProduct)
                                        <tr>
                                            <th scope="row">
                                                {{ $linkedProduct->pivot->sort_order ?? 'n/a' }}
                                            </th>
                                            @if (!empty($keyword))
                                                <td>{!! preg_replace(
                                                    '/\w*?' . preg_quote($keyword) . '\w*/i',
                                                    "<b style='color:#377dff;font-size:15px'>$0</b>",
                                                    $linked_product_addon->sku,
                                                ) !!}</td>
                                            @else
                                                <td>{{ $linked_product_addon->sku }}</td>
                                            @endif
                                            <td>{{ $linked_product_addon->name }}</td>
                                            <td>
                                                <div class="product-quantity d-flex align-items-center">
                                                    <div class="row no-gutters align-items-center aiz-plus-minus mr-3"
                                                        style="width: 130px;">
                                                        <button
                                                            class="btn col-auto btn-icon btn-sm btn-circle btn-light"
                                                            type="button" data-type="minus"
                                                            data-field="qty_0_{{ $linked_product_addon->id }}"
                                                            disabled="">
                                                            <i class="las la-minus"></i>
                                                        </button>
                                                        <input type="number" name="quantity"
                                                            class="col border-0 text-center flex-grow-1 fs-16 input-number"
                                                            placeholder="1" id="qty_0_{{ $linked_product_addon->id }}"
                                                            value="1" min="1" max="200">
                                                        <button
                                                            class="btn col-auto btn-icon btn-sm btn-circle btn-light"
                                                            type="button" data-type="plus"
                                                            data-field="qty_0_{{ $linked_product_addon->id }}">
                                                            <i class="las la-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-soft-primary mr-2 btn-sm add-to-cart fw-600"
                                                    onclick="addToCart(this,0,{{ $linked_product_addon->id }},'addon')">
                                                    <i
                                                        class="las la-shopping-bag actBtn-bag0{{ $linked_product_addon->id }}"></i>
                                                    <i class="las la-spinner la-spin la-1x actBtn-loader0{{ $linked_product_addon->id }}"
                                                        style="display: none"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <span class="fake_price_span"
                                                    @if (Session::get('fake_price') == 'yes') style="display: block" @else style="display: none" @endif>{{ single_price($linked_product_addon->fake_price) }}
                                                </span>
                                                <span class="real_price_span"
                                                    @if (Session::get('fake_price') == 'yes') style="display: none" @else style="display: block" @endif>{{ single_price($linked_product_addon->unit_price) }}
                                                </span>
                                            </td>
                                            <td>{{ $linked_product_addon->qty }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        @elseif ($unlinked_product_addon)
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
                                    <tr>
                                        @php
                                            $linkedProduct = $unlinked_product_addon->products->first();
                                        @endphp
                                        @if ($linkedProduct)
                                            <th scope="row">
                                                {{ $linkedProduct->pivot->sort_order ?? 'n/a' }}
                                            </th>
                                        @endif
                                        @if (!empty($keyword))
                                            <td>{!! preg_replace(
                                                '/\w*?' . preg_quote($keyword) . '\w*/i',
                                                "<b style='color:#377dff;font-size:15px'>$0</b>",
                                                $unlinked_product_addon->sku,
                                            ) !!}</td>
                                        @else
                                            <td>{{ $unlinked_product_addon->sku }}</td>
                                        @endif
                                        <td>{{ $unlinked_product_addon->name }}</td>
                                        <td>
                                            <div class="product-quantity d-flex align-items-center">
                                                <div class="row no-gutters align-items-center aiz-plus-minus mr-3"
                                                    style="width: 130px;">
                                                    <button class="btn col-auto btn-icon btn-sm btn-circle btn-light"
                                                        type="button" data-type="minus"
                                                        data-field="qty_0_{{ $unlinked_product_addon->id }}"
                                                        disabled="">
                                                        <i class="las la-minus"></i>
                                                    </button>
                                                    <input type="number" name="quantity"
                                                        class="col border-0 text-center flex-grow-1 fs-16 input-number"
                                                        placeholder="1" id="qty_0_{{ $unlinked_product_addon->id }}"
                                                        value="1" min="1" max="200">
                                                    <button class="btn col-auto btn-icon btn-sm btn-circle btn-light"
                                                        type="button" data-type="plus"
                                                        data-field="qty_0_{{ $unlinked_product_addon->id }}">
                                                        <i class="las la-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-soft-primary mr-2 btn-sm add-to-cart fw-600"
                                                onclick="addToCart(this,0,{{ $unlinked_product_addon->id }},'addon')">
                                                <i
                                                    class="las la-shopping-bag actBtn-bag0{{ $unlinked_product_addon->id }}"></i>
                                                <i class="las la-spinner la-spin la-1x actBtn-loader0{{ $unlinked_product_addon->id }}"
                                                    style="display: none"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <span class="fake_price_span"
                                                @if (Session::get('fake_price') == 'yes') style="display: block" @else style="display: none" @endif>{{ single_price($unlinked_product_addon->fake_price) }}
                                            </span>
                                            <span class="real_price_span"
                                                @if (Session::get('fake_price') == 'yes') style="display: none" @else style="display: block" @endif>{{ single_price($unlinked_product_addon->unit_price) }}
                                            </span>
                                        </td>
                                        <td>{{ $unlinked_product_addon->qty }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @elseif($detailedProduct)
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
                                            <button type="button"
                                                class="btn btn-soft-primary mr-2 btn-sm add-to-cart fw-600"
                                                onclick="addToCart(this,{{ $detailedProduct->id }},0,'simple')">
                                                <i class="las la-spinner la-spin la-1x actBtn-loader{{ $detailedProduct->id }}0"
                                                    style="display: none"></i>
                                                <i
                                                    class="las la-shopping-bag actBtn-bag{{ $detailedProduct->id }}0"></i>
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
                        @else
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Nothing found</td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                        <div class="fade-out-edge"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<script>
    function initImageZoom() {
        $('.my-image').each(function() {
            $(this).apImageZoom({
                cssWrapperClass: 'custom-wrapper-class',
                mouseWheelPluginEnabled: true,
                hammerPluginEnabled: true,
                dragEnabled: true
            });
        });
    }

    $(document).ready(function() {
        initImageZoom();

        $('#zoom-in').click(function() {
            $('.my-image').each(function() {
                $(this).apImageZoom('zoomIn');
            });
        });

        $('#zoom-out').click(function() {
            $('.my-image').each(function() {
                $(this).apImageZoom('zoomOut');
            });
        });

        $('#reset').click(function() {
            $('.my-image').each(function() {
                $(this).apImageZoom('reset');
            });
        });
    });
    AIZ.extra.plusMinus();


    document.addEventListener('DOMContentLoaded', function() {
        const tableContainer = document.querySelector('.table-responsive');
        const shadowContainer = document.querySelector('.table-responsive-container');

        function updateShadow() {
            if (tableContainer.scrollWidth > tableContainer.clientWidth &&
                tableContainer.scrollLeft < tableContainer.scrollWidth - tableContainer.clientWidth) {
                shadowContainer.classList.add('show-shadow');
            } else {
                shadowContainer.classList.remove('show-shadow');
            }
        }

        if (tableContainer) {
            tableContainer.addEventListener('scroll', updateShadow);
            updateShadow(); // Initial check on load
        }
    });
</script>
