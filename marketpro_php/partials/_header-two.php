<!-- ==================== Header Two Start Here ==================== -->
<header class="header bg-white  pt-24">
    <div class="container container-lg">
        <nav class="header-inner d-flex justify-content-between gap-16">
            <div class="d-flex w-100">

                <!-- Category Dropdown Start -->
                <div class="category-two h-100 <?php echo $categoryStable; ?> flex-shrink-0">
                    <button type="button" class="category__button flex-align gap-8 fw-medium bg-main-two-600 py-16 px-20 text-white h-100 md-rounded-top">
                        <span class="icon text-2xl d-md-flex d-none"><i class="ph ph-squares-four"></i></span>
                        <span class="d-lg-flex d-none">All</span> Categories
                        <span class="arrow-icon text-md d-flex ms-auto"><i class="ph ph-caret-down"></i></span>
                    </button>

                    <?php
                    $dropdownClass = "d-lg-none d-block";
                    include 'partials/_responsive-dropdown-two.php'
                    // , {
                    ?>
                </div>
                <div class="category <?php echo $categoryHover; ?> on-hover-item text-white flex-shrink-0 w-310">
                    <button type="button" class="category__button flex-align gap-8 fw-medium p-16 bg-main-600 text-white rounded-top h-100 w-100">
                        <span class="icon text-2xl d-md-flex d-none"><i class="ph ph-squares-four"></i></span>
                        <span class="d-sm-flex d-none">All</span> Categories
                        <span class="arrow-icon text-xl d-flex ms-auto"><i class="ph ph-caret-down"></i></span>
                    </button>

                    <div class="responsive-dropdown on-hover-dropdown common-dropdown nav-submenu p-0 submenus-submenu-wrapper">
                        <button type="button" class="close-responsive-dropdown rounded-circle text-xl position-absolute inset-inline-end-0 inset-block-start-0 mt-4 me-8 d-lg-none d-flex"> <i class="ph ph-x"></i> </button>
                        <div class="logo px-16 d-lg-none d-block">
                            <a href="index.php" class="link">
                                <img src="../assets/images/logo/logo.png" alt="Logo">
                            </a>
                        </div>
                        <ul class="scroll-sm p-0 py-8 w-300 max-h-400 overflow-y-auto">
                            <li class="has-submenus-submenu">
                                <a href="javascript:void(0)" class="text-gray-500 text-15 py-12 px-16 flex-align gap-8 rounded-0">
                                    <span class="text-xl d-flex"><i class="ph ph-carrot"></i></span>
                                    <span>Vegetables &amp; Fruit</span>
                                    <span class="icon text-md d-flex ms-auto"><i class="ph ph-caret-right"></i></span>
                                </a>

                                <div class="submenus-submenu py-16">
                                    <h6 class="text-lg px-16 submenus-submenu__title">Vegetables &amp; Fruit</h6>
                                    <ul class="submenus-submenu__list max-h-300 overflow-y-auto scroll-sm">
                                        <li>
                                            <a href="shop.php">Potato &amp; Tomato</a>
                                        </li>
                                        <li>
                                            <a href="shop.php">Cucumber &amp; Capsicum</a>
                                        </li>
                                        <li>
                                            <a href="shop.php">Leafy Vegetables</a>
                                        </li>
                                        <li>
                                            <a href="shop.php">Root Vegetables</a>
                                        </li>
                                        <li>
                                            <a href="shop.php">Beans &amp; Okra</a>
                                        </li>
                                        <li>
                                            <a href="shop.php">Cabbage &amp; Cauliflower</a>
                                        </li>
                                        <li>
                                            <a href="shop.php">Gourd &amp; Drumstick</a>
                                        </li>
                                        <li>
                                            <a href="shop.php">Specialty</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="has-submenus-submenu">
                                <a href="javascript:void(0)" class="text-gray-500 text-15 py-12 px-16 flex-align gap-8 rounded-0">
                                    <span class="text-xl d-flex"><i class="ph ph-brandy"></i></span>
                                    <span>Beverages</span>
                                    <span class="icon text-md d-flex ms-auto"><i class="ph ph-caret-right"></i></span>
                                </a>
                                <div class="submenus-submenu py-16">
                                    <h6 class="text-lg px-16 submenus-submenu__title">Beverages</h6>
                                    <ul class="submenus-submenu__list max-h-300 overflow-y-auto scroll-sm">
                                        <li>
                                            <a href="shop.php">Soda &amp; Cocktail Mix </a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Sports &amp; Energy Drinks</a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Non Alcoholic Drinks</a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Packaged Water </a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Spring Water</a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Flavoured Water </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="has-submenus-submenu">
                                <a href="javascript:void(0)" class="text-gray-500 text-15 py-12 px-16 flex-align gap-8 rounded-0">
                                    <span class="text-xl d-flex"><i class="ph ph-brandy"></i></span>
                                    <span>Meats &amp; Seafood</span>
                                    <span class="icon text-md d-flex ms-auto"><i class="ph ph-caret-right"></i></span>
                                </a>
                                <div class="submenus-submenu py-16">
                                    <h6 class="text-lg px-16 submenus-submenu__title">Meats &amp; Seafood</h6>
                                    <ul class="submenus-submenu__list max-h-300 overflow-y-auto scroll-sm">
                                        <li>
                                            <a href="shop.php"> Fresh Meat </a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Frozen Meat</a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Marinated Meat</a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Fresh &amp; Frozen Meat</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="has-submenus-submenu">
                                <a href="javascript:void(0)" class="text-gray-500 text-15 py-12 px-16 flex-align gap-8 rounded-0">
                                    <span class="text-xl d-flex"><i class="ph ph-brandy"></i></span>
                                    <span>Breakfast &amp; Dairy</span>
                                    <span class="icon text-md d-flex ms-auto"><i class="ph ph-caret-right"></i></span>
                                </a>
                                <div class="submenus-submenu py-16">
                                    <h6 class="text-lg px-16 submenus-submenu__title">Breakfast &amp; Dairy</h6>
                                    <ul class="submenus-submenu__list max-h-300 overflow-y-auto scroll-sm">
                                        <li>
                                            <a href="shop.php"> Oats &amp; Porridge</a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Kids Cereal</a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Muesli</a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Flakes</a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Granola &amp; Cereal Bars</a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Instant Noodles</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="has-submenus-submenu">
                                <a href="javascript:void(0)" class="text-gray-500 text-15 py-12 px-16 flex-align gap-8 rounded-0">
                                    <span class="text-xl d-flex"><i class="ph ph-brandy"></i></span>
                                    <span>Frozen Foods</span>
                                    <span class="icon text-md d-flex ms-auto"><i class="ph ph-caret-right"></i></span>
                                </a>
                                <div class="submenus-submenu py-16">
                                    <h6 class="text-lg px-16 submenus-submenu__title">Frozen Foods</h6>
                                    <ul class="submenus-submenu__list max-h-300 overflow-y-auto scroll-sm">
                                        <li>
                                            <a href="shop.php"> Instant Noodles </a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Hakka Noodles</a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Cup Noodles</a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Vermicelli</a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Instant Pasta</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="has-submenus-submenu">
                                <a href="javascript:void(0)" class="text-gray-500 text-15 py-12 px-16 flex-align gap-8 rounded-0">
                                    <span class="text-xl d-flex"><i class="ph ph-brandy"></i></span>
                                    <span>Biscuits &amp; Snacks</span>
                                    <span class="icon text-md d-flex ms-auto"><i class="ph ph-caret-right"></i></span>
                                </a>
                                <div class="submenus-submenu py-16">
                                    <h6 class="text-lg px-16 submenus-submenu__title">Biscuits &amp; Snacks</h6>
                                    <ul class="submenus-submenu__list max-h-300 overflow-y-auto scroll-sm">
                                        <li>
                                            <a href="shop.php"> Salted Biscuits </a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Marie, Health, Digestive</a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Cream Biscuits &amp; Wafers </a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Glucose &amp; Milk biscuits</a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Cookies</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="has-submenus-submenu">
                                <a href="javascript:void(0)" class="text-gray-500 text-15 py-12 px-16 flex-align gap-8 rounded-0">
                                    <span class="text-xl d-flex"><i class="ph ph-brandy"></i></span>
                                    <span>Grocery &amp; Staples</span>
                                    <span class="icon text-md d-flex ms-auto"><i class="ph ph-caret-right"></i></span>
                                </a>
                                <div class="submenus-submenu py-16">
                                    <h6 class="text-lg px-16 submenus-submenu__title">Grocery &amp; Staples</h6>
                                    <ul class="submenus-submenu__list max-h-300 overflow-y-auto scroll-sm">
                                        <li>
                                            <a href="shop.php"> Lemon, Ginger &amp; Garlic </a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Indian &amp; Exotic Herbs</a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Orangic Vegetables</a>
                                        </li>
                                        <li>
                                            <a href="shop.php">Orangic Fruits </a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Orangic Dry Fruits</a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Orangic Dals &amp; pulses</a>
                                        </li>
                                        <li>
                                            <a href="shop.php"> Orangic Millet &amp; Flours</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Category Dropdown End  -->

                <!-- Search Start  -->
                <form action="#" class="position-relative ms-20 max-w-870 w-100 d-md-block d-none">
                    <input type="text" class="form-control fw-medium placeholder-italic shadow-none bg-neutral-30 placeholder-fw-medium placeholder-light py-16 ps-30 pe-60 " placeholder="Search for products, categories or brands...">
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
                        <span class="w-18 h-18 flex-center rounded-circle bg-success-600 text-white text-xs position-absolute top-n6 end-n4">2</span>
                    </span>
                    <span class="text-md text-neutral-500 item-hover__text fw-medium d-none d-lg-flex">Compare</span>
                </a>
                <a href="cart.php" class="flex-align gap-6 item-hover">
                    <span class="text-2xl text-heading d-flex position-relative me-6 mt-6 item-hover__text">
                        <i class="ph-bold ph-shopping-cart"></i>
                        <span class="w-18 h-18 flex-center rounded-circle bg-success-600 text-white text-xs position-absolute top-n6 end-n4">2</span>
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