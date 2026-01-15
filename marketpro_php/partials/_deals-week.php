<?php
$products = [
    [
        'image' => '../assets/images/thumbs/product-two-img1.png',
        'title' => 'Taylor Farms Broccoli Florets Vegetables',
        'price_old' => '$28.99',
        'price_new' => '$14.99',
        'sold' => '18/35',
        'rating' => 4.8,
        'badge' => '',
        'badge_text' => '',
        'sale_discount' => ''
    ],
    [
        'image' => '../assets/images/thumbs/product-two-img2.png',
        'title' => 'Taylor Farms Broccoli Florets Vegetables',
        'price_old' => '$28.99',
        'price_new' => '$14.99',
        'sold' => '18/35',
        'rating' => 4.8,
        'badge' => 'Best Sale',
        'badge_text' => 'Best Sale',
        'sale_discount' => ''
    ],
    [
        'image' => '../assets/images/thumbs/product-two-img3.png',
        'title' => 'Taylor Farms Broccoli Florets Vegetables',
        'price_old' => '$28.99',
        'price_new' => '$14.99',
        'sold' => '18/35',
        'rating' => 4.8,
        'badge' => '',
        'badge_text' => '',
        'sale_discount' => ''
    ],
    [
        'image' => '../assets/images/thumbs/product-two-img4.png',
        'title' => 'Taylor Farms Broccoli Florets Vegetables',
        'price_old' => '$28.99',
        'price_new' => '$14.99',
        'sold' => '18/35',
        'rating' => 4.8,
        'badge' => 'Sale 50%',
        'badge_text' => 'Sale 50%',
        'sale_discount' => '50%'
    ],
    [
        'image' => '../assets/images/thumbs/product-two-img5.png',
        'title' => 'Taylor Farms Broccoli Florets Vegetables',
        'price_old' => '$28.99',
        'price_new' => '$14.99',
        'sold' => '18/35',
        'rating' => 4.8,
        'badge' => '',
        'badge_text' => '',
        'sale_discount' => ''
    ],
    [
        'image' => '../assets/images/thumbs/product-two-img6.png',
        'title' => 'Taylor Farms Broccoli Florets Vegetables',
        'price_old' => '$28.99',
        'price_new' => '$14.99',
        'sold' => '18/35',
        'rating' => 4.8,
        'badge' => '',
        'badge_text' => '',
        'sale_discount' => ''
    ],
    [
        'image' => '../assets/images/thumbs/product-two-img6.png',
        'title' => 'Taylor Farms Broccoli Florets Vegetables',
        'price_old' => '$28.99',
        'price_new' => '$14.99',
        'sold' => '18/35',
        'rating' => 4.8,
        'badge' => '',
        'badge_text' => '',
        'sale_discount' => ''
    ]
];
?>
<!-- ========================= Deals Week Start ================================ -->
<section class="deals-weeek pt-80 overflow-hidden">
    <div class="container container-lg">
        <div class="border border-gray-100 p-24 rounded-16">
            <div class="section-heading mb-24">
                <div class="flex-between flex-wrap gap-8">
                    <h6 class="mb-0 wow fadeInLeft">Deal of The Week</h6>
                    <div class="flex-align gap-16 wow fadeInRight">
                        <a href="shop.php" class="text-sm fw-semibold text-main-600 hover-text-main-600 hover-text-decoration-underline">View All Deals</a>
                        <div class="flex-align gap-8">
                            <button type="button" id="deal-week-prev" class="slick-prev slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1">
                                <i class="ph ph-caret-left"></i>
                            </button>
                            <button type="button" id="deal-week-next" class="slick-next slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1">
                                <i class="ph ph-caret-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="deal-week-box rounded-16 overflow-hidden flex-between position-relative z-1 mb-24">
                <img src="../assets/images/bg/week-deal-bg.png" alt="" class="position-absolute inset-block-start-0 inset-block-start-0 w-100 h-100 z-n1 object-fit-cover">
                <div class="d-lg-block d-none ps-32 flex-shrink-0" data-aos="zoom-in">
                    <img src="../assets/images/thumbs/week-deal-img1.png" alt="">
                </div>
                <div class="deal-week-box__content px-sm-4 d-block w-100 text-center">
                    <h6 class="mb-20 wow bounceIn text-white">Apple AirPods Max, Over Ear Headphones</h6>
                    <div class="countdown mt-20" id="countdown4">
                        <ul class="countdown-list style-four flex-center flex-wrap">
                            <li class="countdown-list__item flex-align flex-column text-sm fw-medium text-white rounded-circle bg-white-12 border border-white-13 colon-white">
                                <span class="days"></span>Days
                            </li>
                            <li class="countdown-list__item flex-align flex-column text-sm fw-medium text-white rounded-circle bg-white-12 border border-white-13 colon-white">
                                <span class="hours"></span>Hour
                            </li>
                            <li class="countdown-list__item flex-align flex-column text-sm fw-medium text-white rounded-circle bg-white-12 border border-white-13 colon-white">
                                <span class="minutes"></span>Min
                            </li>
                            <li class="countdown-list__item flex-align flex-column text-sm fw-medium text-white rounded-circle bg-white-12 border border-white-13 colon-white">
                                <span class="seconds"></span>Sec
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="d-lg-block d-none flex-shrink-0 pe-xl-5" data-aos="zoom-in">
                    <div class="me-xxl-5">
                        <img src="../assets/images/thumbs/week-deal-img2.png" alt="">
                    </div>
                </div>
            </div>

            <div class="deals-week-slider arrow-style-two">
                <?php

                foreach ($products as $index => $product) {
                ?>
                    <div data-aos="fade-up" data-aos-duration="<?= ($index + 1) * 200 ?>">
                        <div class="product-card h-100 p-16 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
                            <a href="product-details-two.php" class="product-card__thumb flex-center rounded-8 position-relative">
                                <?php if ($product['badge']) { ?>
                                    <span class="product-card__badge <?= $product['badge'] === 'Sale 50%' ? 'bg-danger-600' : 'bg-success-600' ?> px-8 py-4 text-sm text-white position-absolute inset-inline-start-0 inset-block-start-0"><?= $product['badge_text'] ?></span>
                                <?php } ?>
                                <img src="<?= $product['image'] ?>" alt="" class="w-auto max-w-unset">
                            </a>
                            <div class="product-card__content mt-16">
                                <h6 class="title text-lg fw-semibold mt-12 mb-8">
                                    <a href="product-details-two.php" class="link text-line-2" tabindex="0"><?= $product['title'] ?></a>
                                </h6>
                                <div class="flex-align gap-6">
                                    <span class="text-xs fw-medium text-gray-500"><?= $product['rating'] ?></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-500">(17k)</span>
                                </div>
                                <div class="mt-8">
                                    <div class="progress w-100 bg-color-three rounded-pill h-4" role="progressbar" aria-label="Basic example" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar bg-tertiary-600 rounded-pill" style="width: 35%"></div>
                                    </div>
                                    <span class="text-gray-900 text-xs fw-medium mt-8">Sold: <?= $product['sold'] ?></span>
                                </div>

                                <div class="product-card__price my-20">
                                    <span class="text-gray-400 text-md fw-semibold text-decoration-line-through"><?= $product['price_old'] ?></span>
                                    <span class="text-heading text-md fw-semibold "><?= $product['price_new'] ?> <span class="text-gray-500 fw-normal">/Qty</span> </span>
                                </div>

                                <a href="cart.php" class="product-card__cart btn bg-gray-50 text-heading hover-bg-main-600 hover-text-white py-11 px-24 rounded-pill flex-center gap-8 fw-medium" tabindex="0">
                                    Add To Cart <i class="ph ph-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
<!-- ========================= Deals Week End ================================ -->