@extends('frontend.layouts.master')

@section('title', 'Product Listing')
@section('content')
    <div role="main" class="main">

        <section class="page-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="row">
                            <div class="col-md-12 align-self-center order-1">

                                <!-- Breadcrumb -->
                                <ul class="breadcrumb d-block appear-animation animated fadeIn appear-animation-visible">
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">Cross parts</a></li>
                                    <li><a href="#">Chassis</a></li>
                                    <li><a href="#">Brake pedals</a></li>
                                </ul>

                                <!-- Category Title -->
                                <h2 class="page-title">
                                    {{ $selectedFilters['Categories'][0]['name'] ?? 'All Products' }}
                                </h2>


                                <!-- Selected Filters -->
                                @if (!empty(array_filter($selectedFilters)))
                                    <div class="top-categories selected">
                                        <ul>
                                            @foreach ($selectedFilters as $filterType => $filters)
                                                @foreach ($filters as $filter)
                                                    <li>
                                                        <a href="{{ $filter['removeUrl'] }}" class="text-decoration-none">
                                                            {{ $filter['name'] }}
                                                            <i class="fas fa-times text-danger ms-1"></i>
                                                        </a>

                                                    </li>
                                                @endforeach
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif



                                <!-- Sidebar Filter -->
                                <div class="filters">
                                    <button class="btn btn-filter" type="button" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                                        Filter <i class="fa-solid fa-align-left"></i>
                                    </button>

                                    <!-- Filter Offcanvas -->
                                    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1"
                                        id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title font-weight-bold letter-space-2"
                                                id="offcanvasWithBothOptionsLabel">Filter</h5>
                                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body">
                                            <form method="GET" action="{{ route('products.listing') }}">
                                                <div class="accordion accordion-flush filter-items"
                                                    id="accordionFlushExample">

                                                    <!-- Categories Filter -->
                                                    @if ($categories->isNotEmpty())
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="flush-headingCategories">
                                                                <button class="accordion-button accbtn collapsed"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#flush-collapseCategories"
                                                                    aria-expanded="false"
                                                                    aria-controls="flush-collapseCategories">
                                                                    Categories
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapseCategories"
                                                                class="accordion-collapse collapse"
                                                                aria-labelledby="flush-headingCategories"
                                                                data-bs-parent="#accordionFlushExample">
                                                                <div class="accordion-body">
                                                                    <ul class="list-unstyled">
                                                                        @foreach ($categories as $category)
                                                                            <div class="list-group-item">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" name="category[]"
                                                                                        value="{{ $category->id }}"
                                                                                        class="custom-control-input"
                                                                                        id="category-{{ $category->id }}"
                                                                                        {{ in_array($category->id, request('category', [])) ? 'checked' : '' }}>
                                                                                    <label class="custom-control-label"
                                                                                        for="category-{{ $category->id }}">
                                                                                        {{ $category->name }}

                                                                                    </label>
                                                                                    <span
                                                                                        class="badge badge-primary badge-pill float-right">{{ $category->product_count }}</span>
                                                                                </div>
                                                                                @if ($category->childrenCategories->isNotEmpty())
                                                                                    <ul class="list-unstyled ms-3">
                                                                                        @foreach ($category->childrenCategories as $childCategory)
                                                                                            <li>
                                                                                                <div
                                                                                                    class="list-group-item">
                                                                                                    <div
                                                                                                        class="custom-control custom-checkbox">
                                                                                                        <input
                                                                                                            type="checkbox"
                                                                                                            name="category[]"
                                                                                                            value="{{ $childCategory->id }}"
                                                                                                            class="custom-control-input"
                                                                                                            id="category-{{ $childCategory->id }}"
                                                                                                            {{ in_array($childCategory->id, request('category', [])) ? 'checked' : '' }}>
                                                                                                        <label
                                                                                                            class="custom-control-label"
                                                                                                            for="category-{{ $childCategory->id }}">
                                                                                                            {{ $childCategory->name }}
                                                                                                        </label>
                                                                                                        <span
                                                                                                            class="badge badge-primary badge-pill float-right">{{ $childCategory->product_count }}</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                @endif
                                                                            </div>
                                                                        @endforeach

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif


                                                    <!-- Brands Filter -->
                                                    @if ($brands->isNotEmpty())
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="flush-headingBrands">
                                                                <button class="accordion-button accbtn collapsed"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#flush-collapseBrands"
                                                                    aria-expanded="false"
                                                                    aria-controls="flush-collapseBrands">
                                                                    Brands
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapseBrands"
                                                                class="accordion-collapse collapse"
                                                                aria-labelledby="flush-headingBrands"
                                                                data-bs-parent="#accordionFlushExample">
                                                                <div class="accordion-body">
                                                                    @foreach ($brands as $brand)
                                                                        <div class="list-group-item">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" name="brand[]"
                                                                                    value="{{ $brand->id }}"
                                                                                    class="custom-control-input"
                                                                                    id="brand-{{ $brand->id }}"
                                                                                    {{ in_array($brand->id, request('brand', [])) ? 'checked' : '' }}>
                                                                                <label class="custom-control-label"
                                                                                    for="brand-{{ $brand->id }}">
                                                                                    {{ $brand->name }}

                                                                                </label>
                                                                                <span
                                                                                    class="badge badge-primary badge-pill float-right">{{ $brand->product_count }}</span>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <!-- Manufacturers Filter -->
                                                    @if ($manufacturers->isNotEmpty())
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="flush-headingManufacturers">
                                                                <button class="accordion-button accbtn collapsed"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#flush-collapseManufacturers"
                                                                    aria-expanded="false"
                                                                    aria-controls="flush-collapseManufacturers">
                                                                    Manufacturers
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapseManufacturers"
                                                                class="accordion-collapse collapse"
                                                                aria-labelledby="flush-headingManufacturers"
                                                                data-bs-parent="#accordionFlushExample">
                                                                <div class="accordion-body">
                                                                    @foreach ($manufacturers as $manufacturer)
                                                                        <div class="list-group-item">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    name="manufacturer[]"
                                                                                    value="{{ $manufacturer->id }}"
                                                                                    class="custom-control-input"
                                                                                    id="manufacturer-{{ $manufacturer->id }}"
                                                                                    {{ in_array($manufacturer->id, request('manufacturer', [])) ? 'checked' : '' }}>
                                                                                <label class="custom-control-label"
                                                                                    for="manufacturer-{{ $manufacturer->id }}">
                                                                                    {{ $manufacturer->name }}

                                                                                </label>
                                                                                <span
                                                                                    class="badge badge-primary badge-pill float-right">
                                                                                    {{ $manufacturer->product_count }}</span>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <!-- Years Filter -->
                                                    @if ($years->isNotEmpty())
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="flush-headingYears">
                                                                <button class="accordion-button accbtn collapsed"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#flush-collapseYears"
                                                                    aria-expanded="false"
                                                                    aria-controls="flush-collapseYears">
                                                                    Years
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapseYears"
                                                                class="accordion-collapse collapse"
                                                                aria-labelledby="flush-headingYears"
                                                                data-bs-parent="#accordionFlushExample">
                                                                <div class="accordion-body">
                                                                    @foreach ($years as $year)
                                                                        <div class="list-group-item">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" name="year[]"
                                                                                    value="{{ $year->id }}"
                                                                                    class="custom-control-input"
                                                                                    id="year-{{ $year->id }}"
                                                                                    {{ in_array($year->id, request('year', [])) ? 'checked' : '' }}>
                                                                                <label class="custom-control-label"
                                                                                    for="year-{{ $year->id }}">
                                                                                    {{ $year->name }}

                                                                                </label>
                                                                                <span
                                                                                    class="badge badge-primary badge-pill float-right">
                                                                                    {{ $year->product_count }}</span>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                </div>

                                                <!-- Submit and Reset Buttons -->
                                                <div class="bottom-offcanv">
                                                    <button type="reset" class="btn-reset">Reset</button>
                                                    <button type="submit" class="btn-submit">Apply Filters</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12 sort-by">
                    <label>Sort by:</label>
                    <form method="GET" action="{{ route('products.listing') }}">
                        <select class="form-select select-type" name="sort" onchange="this.form.submit()">
                            <option value="low_price" {{ request('sort') == 'low_price' ? 'selected' : '' }}>Low Price
                            </option>
                            <option value="high_price" {{ request('sort') == 'high_price' ? 'selected' : '' }}>High Price
                            </option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z
                            </option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z to A
                            </option>
                        </select>
                    </form>
                </div>
                <div class="col-md-6 col-sm-12 products-count">
                    Showing {{ $products->count() }} of {{ $products->total() }} products
                </div>
            </div>
        </div>

        <!-- Products Listing -->
        <section class="product-listing">
            <div class="container">
                <div class="row products product-thumb-info-list">
                    @forelse($products as $product)
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="product mb-0">
                                <div class="product-thumb-info border-0 mb-3">
                                    <a href="{{ route('products.details', $product->id) }}">
                                        <div class="product-thumb-info-image">
                                            <img alt="{{ $product->name }}" class="img-fluid"
                                                src="{{ $product->knobby_thumbnail_img }}">
                                        </div>
                                    </a>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <h3 class="text-3-5 font-weight-medium text-transform-none text-center mb-0">
                                        <a href="{{ route('products.details', $product->id) }}"
                                            class="text-color-dark product-title">{{ $product->name }}</a>
                                    </h3>
                                </div>
                                <p class="price text-5 mb-3">
                                    <span class="sale text-color-dark font-weight-semi-bold">{{ $product->unit_price }}
                                        kr</span>
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p>No products found.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="row mt-5">
                    <div class="col no-padding">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
