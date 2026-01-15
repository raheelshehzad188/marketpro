<!-- ========================= Trending Products Start ================================ -->
<section class="trending-productss pt-80 overflow-hidden">
    <div class="container container-lg">
        <div class="border border-gray-100 p-24 rounded-16">
            <div class="section-heading mb-24">
                <div class="flex-between flex-wrap gap-8">
                    <h6 class="mb-0 wow fadeInLeft">Trending Products</h6>
                    <ul class="nav common-tab style-two nav-pills wow fadeInRight" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link fw-medium text-sm hover-border-main-600 active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">All</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link fw-medium text-sm hover-border-main-600" id="pills-mobile-tab" data-bs-toggle="pill" data-bs-target="#pills-mobile" type="button" role="tab" aria-controls="pills-mobile" aria-selected="false">Mobile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link fw-medium text-sm hover-border-main-600" id="pills-headphone-tab" data-bs-toggle="pill" data-bs-target="#pills-headphone" type="button" role="tab" aria-controls="pills-headphone" aria-selected="false">Headphone</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link fw-medium text-sm hover-border-main-600" id="pills-usb-tab" data-bs-toggle="pill" data-bs-target="#pills-usb" type="button" role="tab" aria-controls="pills-usb" aria-selected="false">USB</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link fw-medium text-sm hover-border-main-600" id="pills-camera-tab" data-bs-toggle="pill" data-bs-target="#pills-camera" type="button" role="tab" aria-controls="pills-camera" aria-selected="false">Camera</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link fw-medium text-sm hover-border-main-600" id="pills-laptop-tab" data-bs-toggle="pill" data-bs-target="#pills-laptop" type="button" role="tab" aria-controls="pills-laptop" aria-selected="false">Laptop</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link fw-medium text-sm hover-border-main-600" id="pills-accessories-tab" data-bs-toggle="pill" data-bs-target="#pills-accessories" type="button" role="tab" aria-controls="pills-accessories" aria-selected="false">Accessories</button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="rounded-16 overflow-hidden flex-between position-relative mb-24">
                <img src="../assets/images/bg/trending-products-bg-gradient.png" alt="" class="banner-img position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 z-n1 object-fit-cover rounded-24">

                <img src="../assets/images/thumbs/trending-products-img1.png" alt="" class="d-xl-block d-none ps-xxl-5 ps-md-4" data-aos="zoom-in" data-aos-duration="800">
                <div class="trending-products-box__content px-4 d-block w-100 text-center py-72 wow bounceIn">
                    <h5 class="mb-0 trending-products-box__title text-white fw-semibold">Laptop Pro 20% off All Time On Order Now $980</h5>
                </div>
                <img src="../assets/images/thumbs/trending-products-img2.png" alt="" class="d-xl-block d-none pe-xxl-5 me-xxl-5 pe-md-4" data-aos="zoom-in" data-aos-duration="800">
            </div>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab" tabindex="0">
                    <?php include 'partials/_trending-tabs-product.php'; ?>
                </div>
                <div class="tab-pane fade" id="pills-mobile" role="tabpanel" aria-labelledby="pills-mobile-tab" tabindex="0">
                    <?php include 'partials/_trending-tabs-product.php'; ?>
                </div>
                <div class="tab-pane fade" id="pills-headphone" role="tabpanel" aria-labelledby="pills-headphone-tab" tabindex="0">
                    <?php include 'partials/_trending-tabs-product.php'; ?>
                </div>
                <div class="tab-pane fade" id="pills-usb" role="tabpanel" aria-labelledby="pills-usb-tab" tabindex="0">
                    <?php include 'partials/_trending-tabs-product.php'; ?>
                </div>
                <div class="tab-pane fade" id="pills-camera" role="tabpanel" aria-labelledby="pills-camera-tab" tabindex="0">
                    <?php include 'partials/_trending-tabs-product.php'; ?>
                </div>
                <div class="tab-pane fade" id="pills-laptop" role="tabpanel" aria-labelledby="pills-laptop-tab" tabindex="0">
                    <?php include 'partials/_trending-tabs-product.php'; ?>
                </div>
                <div class="tab-pane fade" id="pills-accessories" role="tabpanel" aria-labelledby="pills-accessories-tab" tabindex="0">
                    <?php include 'partials/_trending-tabs-product.php'; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================= Trending Products End ================================ -->
