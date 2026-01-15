<!-- ==================== Header Two Start Here ==================== -->
<header class="header bg-white pt-24">
    <div class="container container-lg">
        <nav class="header-inner d-flex justify-content-between gap-16">
            <div class="d-flex w-100">
                <!-- Category Dropdown Start -->
                <div class="category-two h-100 {{ $categoryStable ?? 'd-none' }} flex-shrink-0">
                    <button type="button" class="category__button flex-align gap-8 fw-medium bg-main-two-600 py-16 px-20 text-white h-100 md-rounded-top">
                        <span class="icon text-2xl d-md-flex d-none"><i class="ph ph-squares-four"></i></span>
                        <span class="d-lg-flex d-none">All</span> Categories
                        <span class="arrow-icon text-md d-flex ms-auto"><i class="ph ph-caret-down"></i></span>
                    </button>
                </div>
                <div class="category {{ $categoryHover ?? 'd-block' }} on-hover-item text-white flex-shrink-0 w-310">
                    <button type="button" class="category__button flex-align gap-8 fw-medium p-16 bg-main-600 text-white rounded-top h-100 w-100">
                        <span class="icon text-2xl d-md-flex d-none"><i class="ph ph-squares-four"></i></span>
                        <span class="d-sm-flex d-none">All</span> Categories
                        <span class="arrow-icon text-xl d-flex ms-auto"><i class="ph ph-caret-down"></i></span>
                    </button>
                </div>
                <!-- Category Dropdown End  -->

                <!-- Search Start  -->
                <form action="#" class="position-relative ms-20 max-w-870 w-100 d-md-block d-none">
                    <input type="text" class="form-control fw-medium placeholder-italic shadow-none bg-neutral-30 placeholder-fw-medium placeholder-light py-16 ps-30 pe-60" placeholder="Search for products, categories or brands...">
                    <button type="submit" class="position-absolute top-50 translate-middle-y text-main-600 end-0 me-36 text-xl line-height-1">
                        <i class="ph-bold ph-magnifying-glass"></i>
                    </button>
                </form>
                <!-- Search End  -->
            </div>

            <!-- Header Middle Right start -->
            <div class="d-flex align-items-center gap-20-px flex-shrink-0">
                <a href="javascript:void(0)" class="flex-align gap-6 item-hover">
                    <span class="text-2xl text-heading d-flex position-relative me-6 mt-6 item-hover__text">
                        <i class="ph-bold ph-recycle"></i>
                    </span>
                    <span class="text-md text-neutral-500 item-hover__text fw-medium d-none d-lg-flex">Compare</span>
                </a>
                <a href="{{ route('cart') ?? '#' }}" class="flex-align gap-6 item-hover">
                    <span class="text-2xl text-heading d-flex position-relative me-6 mt-6 item-hover__text">
                        <i class="ph-bold ph-shopping-cart"></i>
                    </span>
                    <span class="text-md text-neutral-500 item-hover__text fw-medium d-none d-lg-flex">Cart</span>
                </a>
                <a href="javascript:void(0)" class="d-flex align-content-around gap-10 fw-medium text-main-600 py-14 px-24 bg-main-50 rounded-pill line-height-1 hover-bg-main-600 hover-text-white">
                    <span class="d-sm-flex d-none line-height-1"><i class="ph-bold ph-user"></i></span>
                    Account
                </a>
            </div>
            <!-- Header Middle Right End  -->

        </nav>
    </div>
</header>
<!-- ==================== Header End Here ==================== -->
