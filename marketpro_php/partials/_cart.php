<!-- ================================ Cart Section Start ================================ -->
<section class="cart py-80">
    <div class="container container-lg">
        <div class="row gy-4">
            <div class="col-xl-9 col-lg-8">
                <div class="cart-table border border-gray-100 rounded-8 px-40 py-48">
                    <!-- Loading State -->
                    <div id="cart-loading" class="text-center py-40">
                        <div class="spinner-border text-main-600" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-16 text-gray-600">Loading cart...</p>
                    </div>
                    
                    <!-- Empty Cart State -->
                    <div id="cart-empty" class="text-center py-80 d-none">
                        <i class="ph ph-shopping-cart text-6xl text-gray-300 mb-24 d-block"></i>
                        <h5 class="text-gray-900 mb-16">Your cart is empty</h5>
                        <p class="text-gray-600 mb-32">Add some products to your cart to continue shopping.</p>
                        <a href="shop.php" class="btn btn-main">Continue Shopping</a>
                    </div>
                    
                    <!-- Cart Items Table -->
                    <div id="cart-items-wrapper" class="d-none">
                        <div class="overflow-x-auto scroll-sm scroll-sm-horizontal">
                            <table class="table style-three">
                                <thead>
                                    <tr>
                                        <th class="h6 mb-0 text-lg fw-bold">Delete</th>
                                        <th class="h6 mb-0 text-lg fw-bold">Product Name</th>
                                        <th class="h6 mb-0 text-lg fw-bold">Price</th>
                                        <th class="h6 mb-0 text-lg fw-bold">Quantity</th>
                                        <th class="h6 mb-0 text-lg fw-bold">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id="cart-items-tbody">
                                    <!-- Cart items will be loaded dynamically via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4">
                <div class="cart-sidebar border border-gray-100 rounded-8 px-24 py-40">
                    <h6 class="text-xl mb-32">Cart Totals</h6>
                    <div class="bg-color-three rounded-8 p-24">
                        <div class="mb-32 flex-between gap-8">
                            <span class="text-gray-900 font-heading-two">Subtotal</span>
                            <span class="text-gray-900 fw-semibold" id="cart-subtotal">$0.00</span>
                        </div>
                        <div class="mb-32 flex-between gap-8">
                            <span class="text-gray-900 font-heading-two">Estimated Delivery</span>
                            <span class="text-gray-900 fw-semibold" id="cart-shipping">Free</span>
                        </div>
                        <div class="mb-0 flex-between gap-8">
                            <span class="text-gray-900 font-heading-two">Estimated Tax</span>
                            <span class="text-gray-900 fw-semibold" id="cart-tax">$0.00</span>
                        </div>
                    </div>
                    <div class="bg-color-three rounded-8 p-24 mt-24">
                        <div class="flex-between gap-8">
                            <span class="text-gray-900 text-xl fw-semibold">Total</span>
                            <span class="text-gray-900 text-xl fw-semibold" id="cart-total">$0.00</span>
                        </div>
                    </div>
                    <a href="checkout.php" class="btn btn-main mt-40 py-18 w-100 rounded-8" id="checkout-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ================================ Cart Section End ================================ -->