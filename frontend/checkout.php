<?php include 'top.php' ?>


<div class="body">
    <?php include 'header.php' ?>

    <div role="main" class="main shop pb-4">

        <div class="container">



            <div class="row margin-50">
                <div class="col-md-12 align-self-center order-1">
                    <ul class="breadcrumb d-block appear-animation animated fadeIn appear-animation-visible">
                        <li><a href="#">Home</a></li>
                        <li><a href="#"> Product</a></li>
                        <li><a href="#"> Checkout</a></li>
                    </ul>
                    <h2 class="page-title"> CHECKOUT</h2>

                </div>
            </div>



            <div class="row">
                <div class="col">
                    <p class="mb-2 font-weight-medium">Returning customer? <a href="#" class="text-color-dark text-color-hover-primary text-decoration-none font-weight-bold" data-bs-toggle="collapse" data-bs-target=".login-form-wrapper">Login</a></p>
                </div>
            </div>

            <div class="row login-form-wrapper collapse mb-5">
                <div class="col">
                    <div class="card border-width-3 border-radius-0 border-color-hover-dark">
                        <div class="card-body">
                            <form action="/" id="frmSignIn" method="post">
                                <div class="row">
                                    <div class="form-group col">
                                        <label class="form-label text-color-dark text-3">Email address <span class="text-color-danger">*</span></label>
                                        <input type="text" value="" class="form-control form-control-lg text-4" required="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label class="form-label text-color-dark text-3">Password <span class="text-color-danger">*</span></label>
                                        <input type="password" value="" class="form-control form-control-lg text-4" required="">
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="form-group col-md-auto">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="rememberme">
                                            <label class="form-label custom-control-label cur-pointer text-2" for="rememberme">Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-auto">
                                        <a class="text-decoration-none text-color-dark text-color-hover-primary font-weight-semibold text-2" href="#">Forgot Password?</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <button type="submit" class="btn btn-light w-100 btn-modern text-color-light bg-color-grey bg-color-hover-primary text-uppercase text-3 font-weight-bold border-0 border-radius-5  btn-px-4 py-3 ms-2" data-loading-text="Loading...">Login</button>
                                        <div class="divider">
                                            <span class="bg-light px-4 position-absolute left-50pct top-50pct transform3dxy-n50">or</span>
                                        </div>
                                        <a href="#" class="btn btn-light w-100 btn-modern text-color-light bg-color-grey bg-color-hover-primary text-uppercase text-3 font-weight-bold border-0 border-radius-5  btn-px-4 py-3 ms-2" data-loading-text="Loading..."><i class="fab fa-facebook text-5 me-2"></i> Login With Facebook</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <p class="font-weight-medium">Have a coupon? <a href="#" class="text-color-dark text-color-hover-primary text-decoration-none font-weight-bold" data-bs-toggle="collapse" data-bs-target=".coupon-form-wrapper">Enter your code</a></p>
                </div>
            </div>

            <div class="row coupon-form-wrapper collapse mb-5">
                <div class="col">
                    <div class="card border-width-3 border-radius-0 border-color-hover-dark">
                        <div class="card-body">
                            <form role="form" method="post" action="">
                                <div class="d-flex align-items-center">
                                    <input type="text" class="form-control h-auto border-radius-0 line-height-1 py-3" name="couponCode" placeholder="Coupon Code" required="">
                                    <button type="submit" class="btn btn-light btn-modern text-color-light bg-color-grey text-color-hover-primary text-3 font-weight-bold border-0 border-radius-5 ws-nowrap btn-px-4 py-3 ms-2">Apply Coupon</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <form role="form" class="needs-validation" method="post" action="" novalidate="novalidate">
                <div class="row">
                    <div class="col-lg-7 mb-4 mb-lg-0">

                        <h2 class="text-color-dark font-weight-bold text-5-5 mb-3 text-uppercase letter-space-2">Billing Details</h2>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control h-auto py-2 text-uppercase" name="firstName" value="" required="" placeholder="First Name">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control h-auto py-2 text-uppercase" name="lastName" value="" required="" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <input type="email" class="form-control h-auto py-2 text-uppercase" name="email" value="" required="" placeholder="Email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control h-auto py-2 text-uppercase" name="city" value="" required="" placeholder="City">
                            </div>
                            <div class="form-group col-md-6">
                                <div class="custom-select-1">
                                    <select class="form-select form-control h-auto py-2 text-uppercase" name="country" required="" placeholder="Country">
                                        <option value="usa">United States</option>
                                        <option value="spa">Spain</option>
                                        <option value="fra">France</option>
                                        <option value="uk">United Kingdon</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control h-auto py-2 text-uppercase" name="zip" value="" required="" placeholder="Post Code">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="number" class="form-control h-auto py-2 text-uppercase" name="phone" value="" required="" placeholder="Mobile">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <input type="text" class="form-control h-auto py-2 text-uppercase" name="address1" value="" placeholder="House number or flat number" required="">
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col">
                                <div class="custom-checkbox-1">
                                    <input id="createAccount" type="checkbox" name="createAccount" value="1">
                                    <label for="createAccount" class=" font-weight-bold text-color-dark">Create an account ?</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <div class="custom-checkbox-1" data-bs-toggle="collapse" data-bs-target=".shipping-field-wrapper">
                                    <input id="shipAddress" type="checkbox" name="shipAddress" value="1">
                                    <label for="shipAddress" class=" font-weight-bold text-color-dark">Shop to a different address ?</label>
                                </div>
                            </div>
                        </div>
                        <!-- Ship to a differente address fields -->
                        <div class="shipping-field-wrapper collapse">



                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control h-auto py-2 text-uppercase" name="firstName" value="" required="" placeholder="First Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control h-auto py-2 text-uppercase" name="lastName" value="" required="" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <input type="email" class="form-control h-auto py-2 text-uppercase" name="email" value="" required="" placeholder="Email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control h-auto py-2 text-uppercase" name="city" value="" required="" placeholder="City">
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="custom-select-1">
                                        <select class="form-select form-control h-auto py-2 text-uppercase" name="country" required="" placeholder="Country">
                                            <option value="usa">United States</option>
                                            <option value="spa">Spain</option>
                                            <option value="fra">France</option>
                                            <option value="uk">United Kingdon</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control h-auto py-2 text-uppercase" name="zip" value="" required="" placeholder="Post Code">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="number" class="form-control h-auto py-2 text-uppercase" name="phone" value="" required="" placeholder="Mobile">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <input type="text" class="form-control h-auto py-2 text-uppercase" name="address1" value="" placeholder="House number or flat number" required="">
                                </div>
                            </div>



                            <!-- End of Ship to a differente address fields -->
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label class="form-label  font-weight-bold text-color-dark">Order Notes</label>
                                <textarea class="form-control h-auto py-2" name="orderNotes" rows="5" placeholder="Notes about you orderm e.g. special notes for delivery"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-5 position-relative">
                        <div class="pin-wrapper" style="height:900.667px;">
                            <div class="card border-width-3 border-radius-0 border-color-hover-dark" data-plugin-sticky="" data-plugin-options="{'minWidth': 991, 'containerSelector': '.row', 'padding': {'top': 85}}" style="width: 451px;">
                                <div class="card-body">
                                    <h4 class="font-weight-bold text-uppercase text-4 mb-3 letter-space-1">Your Order</h4>
                                    <table class="shop_table cart-totals mb-3">
                                        <tbody>
                                            <tr>
                                                <td colspan="2" class="border-top-0">
                                                    <strong class="text-color-dark text-uppercase font-weight-bold letter-space-1">Product</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong class="d-block text-color-dark line-height-1 font-weight-semibold">Black Porto Smartwatch <span class="product-qty">x1</span></strong>
                                                    <span class="text-1">COLOR BLACK</span>
                                                </td>
                                                <td class="text-end align-top">
                                                    <span class="amount font-weight-medium text-color-grey">$15</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-top-0 pt-0">
                                                    <strong class="d-block text-color-dark line-height-1 font-weight-semibold">Black Porto Smartwatch <span class="product-qty">x1</span></strong>
                                                    <span class="text-1">COLOR BLACK</span>
                                                </td>
                                                <td class="border-top-0 text-end align-top pt-0">
                                                    <span class="amount font-weight-medium text-color-grey">$15</span>
                                                </td>
                                            </tr>
                                            <tr class="cart-subtotal">
                                                <td class="border-top-0">
                                                    <strong class="text-color-dark text-uppercase font-weight-bold letter-space-1">Subtotal</strong>
                                                </td>
                                                <td class="border-top-0 text-end">
                                                    <strong><span class="amount font-weight-medium">$431</span></strong>
                                                </td>
                                            </tr>
                                            <tr class="shipping">
                                                <td colspan="2">
                                                    <strong class="d-block text-color-dark mb-2 text-uppercase font-weight-bold letter-space-1">Shipping</strong>

                                                    <div class="d-flex flex-column">
                                                        <label class="d-flex align-items-center text-color-grey mb-0" for="shipping_method1">
                                                            <input id="shipping_method1" type="radio" class="me-2" name="shipping_method" value="free" checked="">
                                                            Free Shipping
                                                        </label>
                                                        <label class="d-flex align-items-center text-color-grey mb-0" for="shipping_method2">
                                                            <input id="shipping_method2" type="radio" class="me-2" name="shipping_method" value="local-pickup">
                                                            Local Pickup
                                                        </label>
                                                        <label class="d-flex align-items-center text-color-grey mb-0" for="shipping_method3">
                                                            <input id="shipping_method3" type="radio" class="me-2" name="shipping_method" value="flat-rate">
                                                            Flat Rate: $5.00
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="total">
                                                <td>
                                                    <strong class="text-color-dark text-3-5 text-uppercase font-weight-bold letter-space-1">Total</strong>
                                                </td>
                                                <td class="text-end">
                                                    <strong class="text-color-dark"><span class="amount text-color-dark text-5 font-weight-bold">$431</span></strong>
                                                </td>
                                            </tr>
                                            <tr class="payment-methods">
                                                <td colspan="2">
                                                    <strong class="d-block text-color-dark mb-2 text-uppercase font-weight-bold letter-space-1">Payment Methods</strong>

                                                    <div class="d-flex flex-column">
                                                        <label class="d-flex align-items-center text-color-grey mb-0" for="payment_method1">
                                                            <input id="payment_method1" type="radio" class="me-2" name="payment_method" value="cash-on-delivery" checked="">
                                                            Cash On Delivery
                                                        </label>
                                                        <label class="d-flex align-items-center text-color-grey mb-0" for="payment_method2">
                                                            <input id="payment_method2" type="radio" class="me-2" name="payment_method" value="paypal">
                                                            PayPal
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="font-weight-medium text-2">
                                                    Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-light w-100 btn-modern text-color-light bg-color-grey bg-color-hover-primary text-uppercase text-3 font-weight-bold border-0 border-radius-5 ws-nowrap btn-px-4 py-3 ms-2">Place Order <i class="fas fa-arrow-right ms-2"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="margin-50">
    <?php include 'footer.php' ?>
</div>
</div>
<?php include 'bottom.php' ?>