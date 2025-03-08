<header id="header"
    data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': false, 'stickyEnableOnMobile': false, 'stickyStartAt': 135, 'stickySetTop': '-135px', 'stickyChangeLogo': false}">
    <div>
        <div class="header-container container">
            <div class="header-row row">
                <div class="header-column col-md-3 col-sm-12 logo-header">
                    <div class="row">
                        <div class="header-logo">
                            <a href="{{ url('/') }}">
                                <img alt="Porto" width="248" height="49" data-sticky-width="82"
                                    data-sticky-height="40" data-sticky-top="84"
                                    src="{{ asset('frontend/img/logo-default.png') }}">
                            </a>
                        </div>
                    </div>
                </div>

                <div class="header-column col-md-6 col-sm-12 search-header">
                    <div class="header-row">
                        <form role="search" class="d-flex w-100" action="page-search-results.html" method="get">
                            <div class="simple-search input-group w-100">
                                <input class="form-control border-0" id="headerSearch" name="q" type="search"
                                    value="" placeholder="Search here . . .">
                                <button class="btn btn-light" type="submit">
                                    <i class="fa fa-search header-nav-top-icon"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="header-column justify-content-end col-md-3 col-sm-12">
                    <div class="header-row mobile-margin">
                        <ul class="header-extra-info d-flex align-items-center me-3">

                            <li>
                                <div class="header-extra-info-text">
                                    <i class="fa-regular fa-user text-3"></i>
                                    <a href="#">Log in</a> /
                                    <a href="#">Create account</a>
                                </div>
                            </li>
                        </ul>
                        <div class="header-nav-features">
                            <div class="header-nav-feature header-nav-features-cart header-nav-features-cart-big d-inline-flex"
                                data-sticky-header-style="{'minResolution': 991}"
                                data-sticky-header-style-active="{'top': '78px'}"
                                data-sticky-header-style-deactive="{'top': '0'}">
                                <a href="#" class="header-nav-features-toggle" aria-label="">
                                    <img src="{{ asset('frontend/img/icons/Shoppingcart.png') }}" height="18"
                                        alt="" class="header-nav-top-icon-img">
                                    <span class="cart-info">
                                        <span class="cart-qty">1</span>
                                    </span>
                                </a>
                                <div class="header-nav-features-dropdown" id="headerTopCartDropdown">
                                    <ol class="mini-products-list">
                                        <li class="item">
                                            <a href="#" title="Camera X1000" class="product-image">
                                                <img src="{{ asset('frontend/img/products/product-1.jpg') }}"
                                                    alt="Camera X1000">

                                                <div class="product-details">
                                                    <p class="product-name">
                                                        <a href="#">Camera X1000 </a>
                                                    </p>
                                                    <p class="qty-price">
                                                        1X <span class="price">$890</span>
                                                    </p>
                                                    <a href="#" title="Remove This Item" class="btn-remove"><i
                                                            class="fas fa-times"></i></a>
                                                </div>
                                        </li>
                                    </ol>
                                    <div class="totals">
                                        <span class="label">Total:</span>
                                        <span class="price-total"><span class="price">$890</span></span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-dark" href="{{ route('basket') }}">View Cart</a>
                                        <a class="btn btn-primary" href="{{ route('checkout') }}">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid">
            <div class="header-nav-bar bg-color-grey px-3 px-lg-0">
                <div class="header-row">
                    <div class="header-column">
                        <div class="header-row justify-content-end">
                            <div class="header-nav header-nav-links justify-content-center"
                                data-sticky-header-style="{'minResolution': 991}"
                                data-sticky-header-style-active="{'margin-left': '150px'}"
                                data-sticky-header-style-deactive="{'margin-left': '0'}">
                                <div
                                    class="header-nav-main header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-dropdown-arrow header-nav-main-effect-3 header-nav-main-sub-effect-1">
                                    <div class="model-selector mobile-none">
                                        <a href="#">The Model Selector</a>
                                    </div>


                                    <nav class="collapse">
                                        <ul class="nav nav-pills" id="mainNav">
                                            <li class="dropdown dropdown-mega model-selector-filter">
                                                <a class="dropdown-item dropdown-toggle bikeselect-dropdown"
                                                    href="elements.html">
                                                    <img alt="Porto" width="26" height="15"
                                                        src="{{ asset('frontend/img/scu-icon.png') }}"
                                                        class="bike-icon">
                                                    No Model
                                                    Selected
                                                    <div class="dropdown-icon"><img
                                                            src="{{ asset('frontend/img/srs-images/icons/angle.png') }}"
                                                            class="dropdown-angle">
                                                    </div>
                                                </a>
                                                <ul class="dropdown-menu ddown">
                                                    <li>
                                                        <div class="dropdown-mega-content">
                                                            <div class="row">

                                                                <div class="col-md-12">


                                                                    <div class="row">
                                                                        <h4 class="menu-subheading py-2">
                                                                            Find the right parts for your bike!
                                                                        </h4>

                                                                        <div class="col-md-3 col-sm-6">
                                                                            <select class="form-select py-2"
                                                                                aria-label="Default select example">
                                                                                <option selected>Select Brand
                                                                                </option>
                                                                                <option value="1">BMW</option>
                                                                                <option value="2">Honda</option>
                                                                                <option value="3">KTM</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-md-3 col-sm-6">
                                                                            <select class="form-select py-2"
                                                                                aria-label="Default select example">
                                                                                <option selected>Select Year
                                                                                </option>
                                                                                <option value="1">2021</option>
                                                                                <option value="2">2022</option>
                                                                                <option value="3">2023</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-md-3 col-sm-6">
                                                                            <select class="form-select py-2"
                                                                                aria-label="Default select example">
                                                                                <option selected>Select Model
                                                                                </option>
                                                                                <option value="1">CV100R
                                                                                </option>
                                                                                <option value="2">CV200R
                                                                                </option>
                                                                                <option value="3">CV300R
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-6">
                                                                            <button type="button"
                                                                                class="btn btn-light btn-modern text-color-light bg-color-grey text-color-hover-light bg-color-hover-primary text-uppercase text-3 font-weight-medium border-0 border-radius-1 btn-px-4 py-2 w-100">Select
                                                                                Model</button>

                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>



                                    <nav class="collapse">
                                        <ul class="nav nav-pills" id="mainNav">


                                            <li class="dropdown dropdown-mega">
                                                <a class="dropdown-item dropdown-toggle" href="#">
                                                    Cross Gear <div class="dropdown-icon"><img
                                                            src="{{ asset('frontend/img/srs-images/icons/angle.png') }}"
                                                            class="dropdown-angle">
                                                    </div>
                                                </a>
                                                <ul class="dropdown-menu">


                                                    <li>
                                                        <div class="dropdown-mega-content">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <span class="dropdown-mega-sub-title">MOTOCROSS
                                                                        CLOTHING</span>
                                                                    <ul class="dropdown-mega-sub-nav">
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Motocross shirts</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Motocross pants</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Cross gloves</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Vests & Jackets</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Rainwear</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Underwear</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Socks & Knee Socks</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Motocross pants</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Cross gloves</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Vests & Jackets</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Rainwear</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Underwear</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Socks & Knee Socks</a>
                                                                        </li>

                                                                    </ul>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <span
                                                                        class="dropdown-mega-sub-title">Helmets</span>
                                                                    <ul class="dropdown-mega-sub-nav">

                                                                        <li><a class="dropdown-item"
                                                                                href="#">Chest protection</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Back protection</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Headrests</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Kidney Belts</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">First layer</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Other Protections</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Spare Parts &
                                                                                AccessoriesKnee pads</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Elbow</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Safety vests</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Chest protection</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Back protection</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Headrests</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Kidney Belts</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">First layer</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Other Protections</a>
                                                                        </li>


                                                                    </ul>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <span
                                                                        class="dropdown-mega-sub-title">GLASSES</span>
                                                                    <ul class="dropdown-mega-sub-nav">

                                                                        <li><a class="dropdown-item"
                                                                                href="#">Vests & Jackets</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Rainwear</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Underwear</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Socks & Knee Socks</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Motocross shirts</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Motocross pants</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Cross gloves</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Vests & Jackets</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">RainwearVests &
                                                                                Jackets</a></li>


                                                                    </ul>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <span
                                                                        class="dropdown-mega-sub-title">PROTECTION</span>
                                                                    <ul class="dropdown-mega-sub-nav">
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Knee pads</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Elbow</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Safety vests</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Chest protection</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Back protection</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Headrests</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Kidney Belts</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">First layer</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Other Protections</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Spare Parts &
                                                                                Accessories</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Knee pads</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Elbow</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Safety vests</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Chest protection</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Back protection</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Headrests</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Kidney Belts</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">First layer</a></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Other Protections</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="#">Spare Parts &
                                                                                Accessories</a></li>

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>



                                            <li class="dropdown">
                                                <a class="dropdown-item" href="#">
                                                    Cross Parts <div class="dropdown-icon"></div>
                                                </a>
                                            </li>


                                            <li class="dropdown">
                                                <a class="dropdown-item" href="#">
                                                    Exploded view
                                                </a>
                                            </li>

                                            <li class="dropdown">
                                                <a class="dropdown-item" href="#">
                                                    outlet
                                                </a>
                                            </li>

                                            <li class="dropdown">
                                                <a class="dropdown-item" href="#">
                                                    vehicle

                                                </a>
                                            </li>

                                        </ul>
                                    </nav>
                                </div>
                                <button class="btn header-btn-collapse-nav" data-bs-toggle="collapse"
                                    data-bs-target=".header-nav-main nav">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
