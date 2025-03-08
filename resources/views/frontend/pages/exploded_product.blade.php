@extends('frontend.layouts.master')
@section('title', 'Home')
@section('content')
    <div role="main" class="main shop pb-4">

        <div class="container">
            <div class="row margin-50">
                <div class="col-md-12 align-self-center order-1">
                    <ul class="breadcrumb d-block">
                        <li><a href="javascript:void(0)" onclick="loadCategories(0)">Home</a></li>
                        <!-- You can append dynamic breadcrumbs here if needed -->
                        <li><a href="javascript:void(0)" onclick="loadCategoriesOrProducts({{ $detailedProduct->categories->first()->id ?? 0 }})">Products</a></li>
                        <li>{{ $detailedProduct->name }}</li>
                    </ul>

                    <div class="filters">
                        <button class="btn btn-filter" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"> Filter <i
                                class="fa-solid fa-align-left"></i></button>


                        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1"
                            id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title font-weight-bold letter-space-2"
                                    id="offcanvasWithBothOptionsLabel">Filter</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div id="tree"></div>

                                <div class="bottom-offcanv">
                                    <div class="filter-result">403 products - 2 active filters</div>
                                    <div class="filter-rest"><button class="btn-reset">Rest</button></div>
                                    <div class="filter-submmit">
                                        <button class="btn-submit">Use & close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!-- Image Zoom Code Start -->
            <div class="img-container">
                <img id="image" src="{{ uploaded_asset(explode(',', $detailedProduct->thumbnail_img)[0]) }}"
                    alt="Zoomable Image">
                <div class="buttons-container">
                    <button id="zoom-in" class="btn-zoom">Zoom +</button>
                    <button id="zoom-out" class="btn-zoom">Zoom -</button>
                    <button id="reset" class="btn-zoom">Reset</button>
                </div>
            </div>
            <!-- Image Zoom Code end -->

            <div class="row padding-10">
                <div class="heading-single03">{{ $detailedProduct->name }}</div>
                <div class="table-responsive">
                    <table class="table table03">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nr.</th>
                                <th>Art</th>
                                <th>Namn</th>
                                <th>Antal</th>
                                <th></th>
                                <th>pris</th>
                                <th>Lager</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($detailedProduct->product_addons) > 0 && (empty($detailedProduct->unit_price) || $detailedProduct->unit_price == 0))
                                @foreach($detailedProduct->product_addons as $addon)
                                    <tr>
                                        <td>{{ $addon->pivot->sort_order ?? 'n/a' }}</td>
                                        <td>{{ $addon->sku }}</td>
                                        <td>{{ $addon->name }}</td>
                                        <td>
                                            <div class="quantity03">
                                                <input type="button" class="btnplusminus" value="-" data-type="minus" data-field="qty_{{ $detailedProduct->id }}_{{ $addon->id }}">
                                                <input type="text" class="input-text03" title="Qty" value="1" min="1" step="1" id="qty_{{ $detailedProduct->id }}_{{ $addon->id }}">
                                                <input type="button" class="btnplusminus" value="+" data-type="plus" data-field="qty_{{ $detailedProduct->id }}_{{ $addon->id }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="add-to-cart-btn" onclick="addToCart(this, {{ $detailedProduct->id }}, {{ $addon->id }}, 'addon')">
                                                <i class="fa-solid fa-cart-shopping"></i>
                                            </div>
                                        </td>
                                        <td>{{ single_price($addon->unit_price) }}</td>
                                        <td>{{ $addon->qty }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>1</td>
                                    <td>{{ $detailedProduct->sku }}</td>
                                    <td>{{ $detailedProduct->name }}</td>
                                    <td>
                                        <div class="quantity03">
                                            <input type="button" class="btnplusminus" value="-" data-type="minus" data-field="qty_{{ $detailedProduct->id }}_0">
                                            <input type="text" class="input-text03" title="Qty" value="1" min="1" step="1" id="qty_{{ $detailedProduct->id }}_0">
                                            <input type="button" class="btnplusminus" value="+" data-type="plus" data-field="qty_{{ $detailedProduct->id }}_0">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="add-to-cart-btn" onclick="addToCart(this, {{ $detailedProduct->id }}, 0, 'simple')">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </div>
                                    </td>
                                    <td>{{ single_price($detailedProduct->unit_price) }}</td>
                                    <td>{{ $detailedProduct->qty }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    // Zoom and drag logic is handled by initProductDetailScripts() in main page script
    // Add-to-cart handled by addToCart() defined in the main page script
</script>
@endsection
