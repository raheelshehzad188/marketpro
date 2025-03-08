<?php include 'top.php' ?>

<body data-plugin-page-transition>

    <div class="body">
        <?php include 'header.php' ?>
        <div role="main" class="main shop pb-4">

            <div class="container">
                <div class="row margin-50">
                    <div class="col-md-12 align-self-center order-1">
                        <ul class="breadcrumb d-block appear-animation animated fadeIn appear-animation-visible">
                            <li><a href="#">Home</a></li>
                            <li><a href="#"> Product</a></li>
                            <li><a href="#"> Cart</a></li>
                        </ul>
                        <h2 class="page-title">YOUR CART</h2>

                    </div>
                </div>

                <div class="row pb-4 mb-5 margin-50">
                    <div class="col-lg-8 mb-5 mb-lg-0 cart-con">
                        <form method="post" action="">
                            <div class="table-responsive">
                                <table class="shop_table cart">
                                    <thead>
                                        <tr class="text-color-dark cart-top-row">
                                            <th class="product-thumbnail" width="15%">
                                                &nbsp;
                                            </th>
                                            <th class="product-name text-uppercase" width="30%">
                                                Product
                                            </th>
                                            <th class="product-price text-uppercase" width="15%">
                                                Price
                                            </th>
                                            <th class="product-quantity text-uppercase" width="20%">
                                                Quantity
                                            </th>
                                            <th class="product-subtotal text-uppercase text-end" width="20%">
                                                Subtotal
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr class="cart_table_item">
                                            <td class="product-thumbnail">
                                                <div class="product-thumbnail-wrapper">
                                                    <a href="#" class="product-thumbnail-remove" title="Remove Product">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                    <a href="shop-product-sidebar-right.html" class="product-thumbnail-image" title="Photo Camera">
                                                        <img width="90" height="90" alt="" class="img-fluid" src="img/products/product-grey-1.jpg">
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="product-name">
                                                <a href="shop-product-sidebar-right.html" class="font-weight-semi-bold text-color-dark text-color-hover-primary text-decoration-none">Photo Camera</a>
                                            </td>
                                            <td class="product-price">
                                                <span class="amount font-weight-medium text-color-grey">$59</span>
                                            </td>
                                            <td class="product-quantity">
                                                <div class="quantity float-none m-0">
                                                    <input type="button" class="minus text-color-hover-light bg-color-hover-primary border-color-hover-primary" value="-">
                                                    <input type="text" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                                    <input type="button" class="plus text-color-hover-light bg-color-hover-primary border-color-hover-primary" value="+">
                                                </div>
                                            </td>
                                            <td class="product-subtotal text-end">
                                                <span class="amount text-color-dark font-weight-bold text-4">$59</span>
                                            </td>
                                        </tr>

                                        <tr class="cart_table_item">
                                            <td class="product-thumbnail">
                                                <div class="product-thumbnail-wrapper">
                                                    <a href="#" class="product-thumbnail-remove" title="Remove Product">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                    <a href="shop-product-sidebar-right.html" class="product-thumbnail-image" title="Porto Headphone">
                                                        <img width="90" height="90" alt="" class="img-fluid" src="img/products/product-grey-7.jpg">
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="product-name">
                                                <a href="shop-product-sidebar-right.html" class="font-weight-semi-bold text-color-dark text-color-hover-primary text-decoration-none">Porto Headphone</a>
                                            </td>
                                            <td class="product-price">
                                                <span class="amount font-weight-medium text-color-grey">$99</span>
                                            </td>
                                            <td class="product-quantity">
                                                <div class="quantity float-none m-0">
                                                    <input type="button" class="minus text-color-hover-light bg-color-hover-primary border-color-hover-primary" value="-">
                                                    <input type="text" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                                    <input type="button" class="plus text-color-hover-light bg-color-hover-primary border-color-hover-primary" value="+">
                                                </div>
                                            </td>
                                            <td class="product-subtotal text-end">
                                                <span class="amount text-color-dark font-weight-bold text-4">$99</span>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td colspan="5">
                                                <div class="row justify-content-between mx-0">
                                                    <div class="col-md-auto px-0 mb-3 mb-md-0">
                                                        <div class="d-flex align-items-center">
                                                            <input type="text" class="form-control h-auto border-radius-5 line-height-1 py-3" name="couponCode" placeholder="Coupon Code" />
                                                            <button type="submit" class="btn btn-light btn-modern text-color-light bg-color-grey text-color-hover-light bg-color-hover-primary text-uppercase text-3 font-weight-bold border-0 border-radius-5 ws-nowrap btn-px-4 py-3 ms-2">Apply Coupon</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-auto px-0">
                                                        <button type="submit" class="btn btn-light btn-modern text-color-light bg-color-grey text-color-hover-light bg-color-hover-primary text-uppercase text-3 font-weight-bold border-0 border-radius-5 btn-px-4 py-3">Update Cart</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 position-relative">
                        <div class="card" data-plugin-sticky data-plugin-options="{'minWidth': 991, 'containerSelector': '.row', 'padding': {'top': 85}}">
                            <div class="card-body">
                                <h4 class="font-weight-bold text-uppercase text-4 mb-3 letter-space-1">Cart Totals</h4>
                                <table class="shop_table cart-totals mb-4">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <td class="border-top-0">
                                                <strong class="text-color-dark font-weight-bold text-uppercase letter-space-1">Subtotal</strong>
                                            </td>
                                            <td class="border-top-0 text-end">
                                                <strong><span class="amount font-weight-medium">$431</span></strong>
                                            </td>
                                        </tr>
                                        <tr class="shipping">
                                            <td colspan="2">
                                                <strong class="d-block text-color-dark mb-2 font-weight-bold text-uppercase letter-space-1">Shipping</strong>

                                                <div class="d-flex flex-column">
                                                    <label class="d-flex align-items-center text-color-grey mb-0" for="shipping_method1">
                                                        <input id="shipping_method1" type="radio" class="me-2" name="shipping_method" value="free" checked />
                                                        Free Shipping
                                                    </label>
                                                    <label class="d-flex align-items-center text-color-grey mb-0" for="shipping_method2">
                                                        <input id="shipping_method2" type="radio" class="me-2" name="shipping_method" value="local-pickup" />
                                                        Local Pickup
                                                    </label>
                                                    <label class="d-flex align-items-center text-color-grey mb-0" for="shipping_method3">
                                                        <input id="shipping_method3" type="radio" class="me-2" name="shipping_method" value="flat-rate" />
                                                        Flat Rate: $5.00
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="total">
                                            <td>
                                                <strong class="text-color-dark font-weight-bold text-3-5 letter-space-1 text-uppercase">Total</strong>
                                            </td>
                                            <td class="text-end">
                                                <strong class="text-color-dark font-weight-bold"><span class="amount text-color-dark text-5">$431</span></strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="shop-checkout.html" class="btn btn-light w-100 btn-modern text-color-light bg-color-grey text-color-hover-light bg-color-hover-primary text-uppercase text-3 font-weight-bold border-0 border-radius-5 btn-px-4 py-3">Proceed to Checkout <i class="fas fa-arrow-right ms-2"></i></a>


                            </div>
                        </div>
                    </div>
                </div>

            </div>



            <?php include 'widgets/instagram.php' ?>


        </div>

        <?php include 'footer.php' ?>
    </div>

    <!-- Vendor -->
    <?php include 'bottom.php' ?>

</body>

</html>