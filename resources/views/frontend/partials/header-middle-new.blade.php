@php
    // Get categories for dropdown
    $categories = \App\Category::where('parent_id', 0)
        ->where('published', 1)
        ->orderBy('order_level', 'asc')
        ->orderBy('name', 'asc')
        ->get();
    
    // Get logo from settings
    $logo = get_setting('header_logo');
    $logoUrl = $logo ? uploaded_asset($logo) : static_asset('frontend/img/logo-default.png');
    $websiteName = get_setting('site_name', 'MarketPro');
@endphp

<!-- ======================= Middle Header Start ========================= -->
<header class="header-middle border-bottom border-gray-100">
    <div class="container container-lg">
        <nav class="header-inner flex-between gap-8">
            <!-- Logo Start -->
            <div class="logo">
                <a href="{{ url('/') }}" class="link">
                    <img src="{{ $logoUrl }}" alt="{{ $websiteName }}">
                </a>
            </div>
            <!-- Logo End  -->

            <!-- form location Start -->
            <form action="{{ route('products.listing') }}" method="GET" class="flex-align flex-wrap form-location-wrapper max-w-840 w-100">
                <div class="search-category select-style-one d-flex select-border-end-0 search-form d-sm-flex d-none text-heading-two text-sm w-100">
                    <select class="js-example-basic-single border border-neutral-40 border-end-0" name="category">
                        <option value="" selected>All categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
    
                    <div class="search-form__wrapper position-relative border-half-start flex-grow-1">
                        <input type="text" name="s" class="common-input border-neutral-40 py-18 ps-16 pe-76 rounded-0 rounded-end pe-44 placeholder-italic placeholder-text-sm border-start-0" placeholder="Search for products, categories or brands..." value="{{ request('s') }}">
                        <button type="submit" class="w-64 h-44 bg-main-600 hover-bg-main-800 rounded-4 flex-center text-xl text-white position-absolute top-50 translate-middle-y inset-inline-end-0 me-6"><i class="ph ph-magnifying-glass"></i></button>
                    </div>
                </div>
            </form>
            <!-- form location start -->
             
            <!-- Header Middle Right start -->
            <div class="header-right flex-align flex-shrink-0">
                @include('frontend.partials.header-infos-new')
            </div>
            <!-- Header Middle Right End  -->
        </nav>
    </div>
</header>
<!-- ======================= Middle Header End ========================= -->

