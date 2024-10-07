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
            @if ($allRelatedProducts->isNotEmpty())


                <div class="col-3">
                    <div class="related-products">
                        <button class="scroll-btn scroll-up"><i class="las la-angle-up"></i></button>
                        <div class="related-products-list">
                            @foreach ($allRelatedProducts as $relatedProduct)
                                @php
                                    // Explode the thumbnail images and use the first one
                                    $imageIds = explode(',', $relatedProduct->thumbnail_img);
                                    $firstImageId = $imageIds[0];
                                @endphp

                                <div class="related-product-item border text-center">
                                    @if (!empty($relatedProduct->addonSKU))
                                        <a href="javascript:void(0)"
                                            onclick="filterProductsKeyword('{{ $relatedProduct->addonSKU }}')">
                                            <img class="img-fluid" src="{{ uploaded_asset($firstImageId) }}"
                                                alt="Related Product">
                                        </a>
                                        <span class="text-primary fw-500 p-1">{{ $relatedProduct->name }} </span>
                                    @else
                                        <a href="javascript:void(0)" onclick="loadProduct({{ $relatedProduct->id }})">
                                            <img class="img-fluid" src="{{ uploaded_asset($firstImageId) }}"
                                                alt="Related Product">
                                        </a>
                                        <span class="text-primary fw-500 p-1">{{ $relatedProduct->name }} </span>
                                    @endisset

                            </div>
                        @endforeach
                    </div>
                    <button class="scroll-btn scroll-down"><i class="las la-angle-down"></i></button>
                </div>
            </div>
        @endif
        <div class="   mb-4 {{ $allRelatedProducts->isNotEmpty() ? 'col-9' : 'col-12' }}">
            <div class="sticky-top z-3 row gutters-10">
                @php
                    $photos = explode(',', $detailedProduct->thumbnail_img);
                @endphp
                <div class="col order-1 order-md-2">
                    <div style="text-align: center; width: 90%; padding: 0px 0; margin: 0 auto;">
                        <input type="button" value="Zoom +" id="zoom-in" class="btn btn-light btn-sm" />
                        <input type="button" value="Zoom -" id="zoom-out" class="btn btn-light btn-sm" />
                        <input type="button" value="Reset" id="reset" class="btn btn-light btn-sm" />
                    </div>
                    <div id="wrap">
                        <div class="text-center" id="inner">
                            @foreach ($photos as $key => $photo)
                                <img class="my-image h-300px" src="{{ uploaded_asset($photo) }}" draggable="false"
                                    id="image" style="display: none">
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>
        </div>



        <div class="col-12 addon-scroll">
            <div class="text-left">
                <h1 class="mb-2 fs-20 fw-600">
                    {{ $detailedProduct->name }}
                </h1>
                <hr>
            </div>
            <div class="table-responsive-container">
                <div class="table-responsive"> <!-- Add this div -->
                    <div class="scroll-indicator d-lg-none">Scroll Right <i class="las la-arrow-right"></i></div>
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

                                @foreach ($detailedProduct->product_addons as $key => $product_addon)

                                    <tr>
                                        <th scope="row">
                                            {{ $product_addon->pivot->sort_order ?? 'n/a' }}
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
                                                    <button
                                                        class="btn col-auto btn-icon btn-sm btn-circle btn-light"
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
                                                    <button
                                                        class="btn  col-auto btn-icon btn-sm btn-circle btn-light"
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

        $('.scroll-up').click(function() {
            $('.related-products-list').animate({
                scrollTop: '-=100'
            }, 300);
        });

        $('.scroll-down').click(function() {
            $('.related-products-list').animate({
                scrollTop: '+=100'
            }, 300);
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
