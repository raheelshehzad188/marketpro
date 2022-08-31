@if (count($products) > 0)
    @foreach ($products as $product)
        <div class="col-4 ml-auto mr-auto" onclick="loadProduct({{ $product->id }})">
            <div class="card c-pointer mb-2" data-id="4">
                <div class="d-block shadow bg-no-repeat bg-cover bg-center card-img-top img-fit h-200px mw-100 mx-auto"
                    style="background-image: url({{ uploaded_asset($product->thumbnail_img) }})">

                </div>
                <div class="card-body p-2">
                    <div class="text-truncate-2 text-center fw-600">{{ $product->name }}</div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-12 ml-auto mr-auto text-center">
        <div class="card c-pointer mb-2" data-id="4">
            <div class="card-body p-2">
                <div class="text-truncate-2 text-center fw-600">No Results Found</div>
            </div>
        </div>
    </div>
@endif
