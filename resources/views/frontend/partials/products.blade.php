@if($products->count() > 0)
    @foreach ($products as $product)
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="product mb-0 card c-pointer" data-id="{{ $product->id }}">
                <div class="product-thumb-info border-0 mb-3">
                    <div class="product-thumb-info-image">
                        <img alt="{{ $product->name }}" class="img-fluid" src="{{ uploaded_asset($product->thumbnail_img) }}">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div>
                        <h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0 text-center">
                            <a href="javascript:void(0)" class="text-color-dark text-color-hover-primary product-title">
                                {{ $product->name }}
                            </a>
                        </h3>
                    </div>
                </div>
                <p class="price text-5 mb-3 text-center">
                    <span class="sale text-color-dark font-weight-semi-bold">{{ single_price($product->unit_price) }}</span>
                </p>
            </div>
        </div>
    @endforeach
@else
    <div class="col-12 text-center">
        <h3>No Products Found</h3>
    </div>
@endif
