@php
    // Get categories for dropdown
    $dropdownCategories = \App\Category::where('parent_id', 0)
        ->where('published', 1)
        ->orderBy('order_level', 'asc')
        ->orderBy('name', 'asc')
        ->get();
    
    $phoneNumber = get_setting('contact_phone', '+(2) 871 382 023');
@endphp

<!-- ==================== Header Start Here ==================== -->
<header class="header bg-white border-bottom-0 box-shadow-3xl py-10 z-2">
    <div class="container container-lg">
        <nav class="header-inner d-flex justify-content-between gap-8">
            <div class="flex-align menu-category-wrapper position-relative">

                <!-- Category Dropdown Start -->
                <div class="">
                    <button type="button" class="category-button d-flex align-items-center gap-12 text-white bg-success-600 px-20 py-16 rounded-6 hover-bg-success-700 transition-2">
                        <span class="text-xl line-height-1"><i class="ph ph-squares-four"></i></span>
                        <span class="">Browse Categories</span>
                        <span class="line-height-1 icon transition-2"><i class="ph-bold ph-caret-down"></i></span>
                    </button>

                    <!-- Dropdown Start -->
                    <div class="category-dropdown border border-success-200 shadow bg-white p-16 rounded-16 w-100 max-w-472 position-absolute inset-block-start-100 inset-inline-start-0 z-99 transition-2">
                        <div class="d-grid grid-cols-3-repeat gap-4 max-h-350 overflow-y-auto">
                            @foreach ($dropdownCategories as $category)
                                <a href="{{ route('products.listing', ['category' => $category->slug]) }}" class="py-16 px-8 rounded-8 hover-bg-main-50 d-flex flex-column align-items-center text-center border border-white hover-border-main-100">
                                    <span>
                                        @if(!empty($category->icon))
                                            <img src="{{ uploaded_asset($category->icon) }}" alt="Icon" class="w-40" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
                                            <i class="ph ph-folder text-4xl text-main-600" style="display:none;"></i>
                                        @else
                                            <i class="ph ph-folder text-4xl text-main-600"></i>
                                        @endif
                                    </span>
                                    <span class="fw-semibold text-heading mt-16 text-sm">{{ $category->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <!-- Dropdown End -->

                </div>
                <!-- Category Dropdown End -->

                <!-- Menu Start  -->
                <div class="header-menu d-lg-block d-none">
                    @include('frontend.partials.nav-menu-new', ['class' => ''])
                </div>
                <!-- Menu End  -->
            </div>

            <div class="header-right flex-align gap-20">
                <a href="tel:{{ $phoneNumber }}" class="d-sm-flex align-items-center gap-16 d-none">
                    <span class="d-flex text-32">
                        <img src="{{ static_asset('frontend/img/icons/mobile.png') }}" alt="Mobile Icon">
                    </span>
                    <span class="">
                        <span class="d-block text-heading fw-medium">Need any Help! call Us</span>
                        <span class="d-block fw-bold text-main-600 hover-text-decoration-underline">{{ $phoneNumber }}</span>
                    </span>
                </a>
                <button type="button" class="toggle-mobileMenu d-lg-none ms-3n text-gray-800 text-4xl d-flex"> <i class="ph ph-list"></i> </button>
            </div>
        </nav>
    </div>
</header>
<!-- ==================== Header End Here ==================== -->

