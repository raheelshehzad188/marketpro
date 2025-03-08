@if($categories->count() > 0)
    @foreach ($categories as $category)
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="product mb-0 card c-pointer" data-id="{{ $category->id }}">
                <div class="product-thumb-info border-0 mb-3">
                    <div class="product-thumb-info-image">
                        <img alt="{{ $category->name }}" class="img-fluid" src="{{ uploaded_asset($category->icon) }}">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div>
                        <h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0 text-center">
                            <a href="javascript:void(0)" class="text-color-dark text-color-hover-primary product-title">
                                {{ $category->name }}
                            </a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
