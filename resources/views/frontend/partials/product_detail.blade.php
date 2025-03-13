<div class="container">

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
                                    <div class="add-to-cart-btn" data-product-id="{{ $detailedProduct->id }}" data-addon-id="{{ $addon->id }}" data-type="addon">
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
                                <div class="add-to-cart-btn" data-product-id="{{ $detailedProduct->id }}" data-addon-id="0" data-type="simple">
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
