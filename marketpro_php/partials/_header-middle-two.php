<!-- ======================= Middle Header Two Start ========================= -->
<header class="header-middle border-bottom border-neutral-40 py-4">
    <div class="container container-lg">
        <nav class="header-inner flex-between gap-8">
            <!-- Logo Start -->
            <div class="logo">
                <a href="index.php" class="link">
                    <img src="../assets/images/logo/logo-two.png" alt="Logo">
                </a>
            </div>
            <!-- Logo End  -->

            <!-- Menu Start  -->
            <div class="header-menu d-lg-block d-none">
                <?php
                $class = '';
                 include 'partials/_nav-menu.php';
                ?>
            </div>
            <!-- Menu End  -->

            <!-- Middle Header Right start -->
            <div class="header-right flex-align">
                <!-- Dropdown Select Start -->
                <ul class="header-top__right style-two style-three flex-align flex-wrap">
                    <li class="on-hover-item border-right-item border-right-item-sm-space has-submenu arrow-white">
                        <a href="javascript:void(0)" class="selected-text selected-text text-neutral-500 fw-semibold text-sm py-8 text-sm py-8">Eng</a>
                        <ul class="selectable-text-list on-hover-dropdown common-dropdown common-dropdown--sm max-h-200 scroll-sm px-0 py-8">
                            <li>
                                <a href="javascript:void(0)" class="hover-bg-gray-100 text-gray-500 text-xs py-6 px-16 flex-align gap-8 rounded-0">
                                    <img src="../assets/images/thumbs/flag1.png" alt="" class="w-16 h-12 rounded-4 border border-gray-100">
                                    English
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="hover-bg-gray-100 text-gray-500 text-xs py-6 px-16 flex-align gap-8 rounded-0">
                                    <img src="../assets/images/thumbs/flag2.png" alt="" class="w-16 h-12 rounded-4 border border-gray-100">
                                    Japan
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="hover-bg-gray-100 text-gray-500 text-xs py-6 px-16 flex-align gap-8 rounded-0">
                                    <img src="../assets/images/thumbs/flag3.png" alt="" class="w-16 h-12 rounded-4 border border-gray-100">
                                    French
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="hover-bg-gray-100 text-gray-500 text-xs py-6 px-16 flex-align gap-8 rounded-0">
                                    <img src="../assets/images/thumbs/flag4.png" alt="" class="w-16 h-12 rounded-4 border border-gray-100">
                                    Germany
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="hover-bg-gray-100 text-gray-500 text-xs py-6 px-16 flex-align gap-8 rounded-0">
                                    <img src="../assets/images/thumbs/flag6.png" alt="" class="w-16 h-12 rounded-4 border border-gray-100">
                                    Bangladesh
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="hover-bg-gray-100 text-gray-500 text-xs py-6 px-16 flex-align gap-8 rounded-0">
                                    <img src="../assets/images/thumbs/flag5.png" alt="" class="w-16 h-12 rounded-4 border border-gray-100">
                                    South Korea
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="on-hover-item border-right-item border-right-item-sm-space has-submenu arrow-white">
                        <a href="javascript:void(0)" class="selected-text selected-text text-neutral-500 fw-semibold text-sm py-8 text-sm py-8">USD</a>
                        <ul class="selectable-text-list on-hover-dropdown common-dropdown common-dropdown--sm max-h-200 scroll-sm px-0 py-8">
                            <li>
                                <a href="javascript:void(0)" class="hover-bg-gray-100 text-gray-500 text-xs py-6 px-16 flex-align gap-8 rounded-0">
                                    <img src="../assets/images/thumbs/flag1.png" alt="" class="w-16 h-12 rounded-4 border border-gray-100">
                                    USD
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="hover-bg-gray-100 text-gray-500 text-xs py-6 px-16 flex-align gap-8 rounded-0">
                                    <img src="../assets/images/thumbs/flag2.png" alt="" class="w-16 h-12 rounded-4 border border-gray-100">
                                    Yen
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="hover-bg-gray-100 text-gray-500 text-xs py-6 px-16 flex-align gap-8 rounded-0">
                                    <img src="../assets/images/thumbs/flag3.png" alt="" class="w-16 h-12 rounded-4 border border-gray-100">
                                    Franc
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="hover-bg-gray-100 text-gray-500 text-xs py-6 px-16 flex-align gap-8 rounded-0">
                                    <img src="../assets/images/thumbs/flag4.png" alt="" class="w-16 h-12 rounded-4 border border-gray-100">
                                    EURO
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="hover-bg-gray-100 text-gray-500 text-xs py-6 px-16 flex-align gap-8 rounded-0">
                                    <img src="../assets/images/thumbs/flag6.png" alt="" class="w-16 h-12 rounded-4 border border-gray-100">
                                    BDT
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="hover-bg-gray-100 text-gray-500 text-xs py-6 px-16 flex-align gap-8 rounded-0">
                                    <img src="../assets/images/thumbs/flag5.png" alt="" class="w-16 h-12 rounded-4 border border-gray-100">
                                    WON
                                </a>
                            </li>
                        </ul>
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