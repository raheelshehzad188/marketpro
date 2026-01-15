<?php
$products = [
    [
        'image' => 'product-img26.png',
        'title' => 'Taylor Farms Broccoli Florets Vegetables',
        'price' => 14.99,
        'original_price' => 28.99,
        'rating' => 4.8,
        'reviews' => '17k',
        'sold' => 18,
        'stock' => 35,
        'animation_duration' => 200,
    ],
    [
        'image' => 'product-img27.png',
        'title' => 'Taylor Farms Broccoli Florets Vegetables',
        'price' => 14.99,
        'original_price' => 28.99,
        'rating' => 4.8,
        'reviews' => '17k',
        'sold' => 18,
        'stock' => 35,
        'animation_duration' => 400,
    ],
    [
        'image' => 'product-img28.png',
        'title' => 'Taylor Farms Broccoli Florets Vegetables',
        'price' => 14.99,
        'original_price' => 28.99,
        'rating' => 4.8,
        'reviews' => '17k',
        'sold' => 18,
        'stock' => 35,
        'animation_duration' => 400,
    ],
    [
        'image' => 'product-img29.png',
        'title' => 'Taylor Farms Broccoli Florets Vegetables',
        'price' => 14.99,
        'original_price' => 28.99,
        'rating' => 4.8,
        'reviews' => '17k',
        'sold' => 18,
        'stock' => 35,
        'animation_duration' => 400,
    ],
    [
        'image' => 'product-img30.png',
        'title' => 'Taylor Farms Broccoli Florets Vegetables',
        'price' => 14.99,
        'original_price' => 28.99,
        'rating' => 4.8,
        'reviews' => '17k',
        'sold' => 18,
        'stock' => 35,
        'animation_duration' => 400,
    ],
    [
        'image' => 'product-img31.png',
        'title' => 'Taylor Farms Broccoli Florets Vegetables',
        'price' => 14.99,
        'original_price' => 28.99,
        'rating' => 4.8,
        'reviews' => '17k',
        'sold' => 18,
        'stock' => 35,
        'animation_duration' => 400,
    ],
    [
        'image' => 'product-img32.png',
        'title' => 'Taylor Farms Broccoli Florets Vegetables',
        'price' => 14.99,
        'original_price' => 28.99,
        'rating' => 4.8,
        'reviews' => '17k',
        'sold' => 18,
        'stock' => 35,
        'animation_duration' => 400,
    ],
    // Add more products as needed...
];
?>
<div class="product pt-60">
    <div class="container container-lg">
        <div class="section-heading">
            <div class="flex-between flex-wrap gap-8">
                <h5 class="mb-0 wow fadeInLeft">Flash Sales Today</h5>
                <div class="flex-align gap-16 wow fadeInRight">
                    <a href="shop.php" class="text-sm fw-medium text-gray-700 hover-text-main-600 hover-text-decoration-underline">View All Deals</a>
                    <div class="flex-align gap-8">
                        <button type="button" id="product-one-prev" class="slick-prev slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1">
                            <i class="ph ph-caret-left"></i>
                        </button>
                        <button type="button" id="product-one-next" class="slick-next slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1">
                            <i class="ph ph-caret-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-one-slider g-12">
            <?php
            foreach ($products as $product) {
                $percentage = ($product['sold'] / $product['stock']) * 100;
            ?>
                <div class="" data-aos="fade-up" data-aos-duration="<?= $product['animation_duration'] ?>">
                    <div class="product-card px-20 py-16 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
                        <a href="cart.php" class="product-card__cart btn bg-main-50 text-main-600 hover-bg-main-600 hover-text-white py-11 px-24 rounded-pill flex-align gap-8 position-absolute inset-block-start-0 inset-inline-end-0 me-16 mt-16">
                            Add <i class="ph ph-shopping-cart"></i>
                        </a>

                        <a href="product-details.php" class="product-card__thumb flex-center overflow-hidden">
                            <img src="../assets/images/thumbs/<?= $product['image'] ?>" alt="">
                        </a>

                        <div class="product-card__content mt-12">
                            <div class="product-card__price mb-8 d-flex align-items-center gap-8">
                                <span class="text-heading text-md fw-semibold ">$<?= number_format($product['price'], 2) ?> <span class="text-gray-500 fw-normal">/Qty</span> </span>
                                <span class="text-gray-400 text-md fw-semibold text-decoration-line-through"> $<?= number_format($product['original_price'], 2) ?></span>
                            </div>
                            <div class="flex-align gap-6">
                                <span class="text-xs fw-bold text-gray-600"><?= $product['rating'] ?></span>
                                <span class="text-15 fw-bold text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                <span class="text-xs fw-bold text-gray-600">(<?= $product['reviews'] ?>)</span>
                            </div>
                            <h6 class="title text-lg fw-semibold mt-12 mb-20">
                                <a href="product-details.php" class="link text-line-2"><?= $product['title'] ?></a>
                            </h6>
                            <div class="mt-12">
                                <div class="progress w-100 bg-color-three rounded-pill h-4" role="progressbar" aria-label="Basic example" aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-main-600 rounded-pill" style="width: <?= $percentage ?>%"></div>
                                </div>
                                <span class="text-gray-900 text-xs fw-medium mt-8">Sold: <?= $product['sold'] ?>/<?= $product['stock'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

    </div>
</div>