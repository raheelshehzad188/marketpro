@foreach ($categories as $category)
    @php
        $function = count($category->childrenCategories) ? 'loadCategories(' . $category->id . ')' : 'loadProducts(' . $category->id . ')';
    @endphp
    <div class="col-4 ml-auto mr-auto">
        <div class="card c-pointer mb-2" data-id="4" onclick="{{ $function }};">
            <div class="d-block shadow bg-no-repeat bg-cover bg-center card-img-top img-fit h-200px mw-100 mx-auto" style="background-image: url({{ uploaded_asset($category->icon) }})">

            </div>
            <div class="card-body p-2">
                <div class="text-truncate-2 text-center fw-600">{{ $category->name }}</div>
            </div>
        </div>
    </div>
@endforeach
