<!-- ======================= Middle Header Two Start ========================= -->
<header class="header-middle border-bottom border-neutral-40 py-4">
    <div class="container container-lg">
        <nav class="header-inner flex-between gap-8">
            <!-- Logo Start -->
            <div class="logo">
                <a href="{{ route('home') }}" class="link">
                    <img src="{{ asset('marketpro_php/assets/images/logo/logo-two.png') }}" alt="Logo">
                </a>
            </div>
            <!-- Logo End  -->

            <!-- Menu Start  -->
            <div class="header-menu d-lg-block d-none">
                <!-- Navigation menu can be added here -->
            </div>
            <!-- Menu End  -->

            <!-- Middle Header Right start -->
            <div class="header-right flex-align">
                <!-- Dropdown Select Start -->
                <ul class="header-top__right style-two style-three flex-align flex-wrap">
                    <li class="on-hover-item border-right-item border-right-item-sm-space has-submenu arrow-white">
                        <a href="javascript:void(0)" class="selected-text selected-text text-neutral-500 fw-semibold text-sm py-8 text-sm py-8">Eng</a>
                    </li>
                    <li class="on-hover-item border-right-item border-right-item-sm-space has-submenu arrow-white">
                        <a href="javascript:void(0)" class="selected-text selected-text text-neutral-500 fw-semibold text-sm py-8 text-sm py-8">USD</a>
                    </li>
                    <li class="d-sm-flex d-none">
                        <a href="javascript:void(0)" class="selected-text selected-text text-neutral-500 fw-semibold text-sm py-8 text-sm py-8 hover-text-heading">Order Tracking</a>
                    </li>
                </ul>
                <!-- Dropdown Select End -->
                <button type="button" class="toggle-mobileMenu d-lg-none ms-3n text-gray-800 text-4xl d-flex"> <i class="ph ph-list"></i> </button>
            </div>
            <!-- Middle Header Right End  -->

        </nav>
    </div>
</header>
<!-- ======================= Middle Header Two End ========================= -->
