<?php
// Example array of product data
$products = [
    [
        'img' => '../assets/images/thumbs/trending-three-img7.png',
        'name' => 'Instax Mini 12 Instant Film Camera - Green',
        'old_price' => '$28.99',
        'new_price' => '$14.99',
        'rating' => 4.8,
        'reviews' => '12K',
        'discount' => '-29%',
        'tag' => 'HOT'
    ],
    [
        'img' => '../assets/images/thumbs/trending-three-img3.png',
        'name' => 'Instax Mini 12 Instant Film Camera - Blue',
        'old_price' => '$28.99',
        'new_price' => '$18.99',
        'rating' => 4.7,
        'reviews' => '10K',
        'discount' => '-15%',
        'tag' => 'HOT'
    ],
    [
        'img' => '../assets/images/thumbs/trending-three-img8.png',
        'name' => 'Instax Mini 12 Instant Film Camera - Blue',
        'old_price' => '$28.99',
        'new_price' => '$18.99',
        'rating' => 4.7,
        'reviews' => '10K',
        'discount' => '-15%',
        'tag' => 'HOT'
    ],
    [
        'img' => '../assets/images/thumbs/trending-three-img9.png',
        'name' => 'Instax Mini 12 Instant Film Camera - Blue',
        'old_price' => '$28.99',
        'new_price' => '$18.99',
        'rating' => 4.7,
        'reviews' => '10K',
        'discount' => '-15%',
        'tag' => 'HOT'
    ],
    [
        'img' => '../assets/images/thumbs/trending-three-img10.png',
        'name' => 'Instax Mini 12 Instant Film Camera - Blue',
        'old_price' => '$28.99',
        'new_price' => '$18.99',
        'rating' => 4.7,
        'reviews' => '10K',
        'discount' => '-15%',
        'tag' => 'HOT'
    ],
    [
        'img' => '../assets/images/thumbs/trending-three-img3.png',
        'name' => 'Instax Mini 12 Instant Film Camera - Blue',
        'old_price' => '$28.99',
        'new_price' => '$18.99',
        'rating' => 4.7,
        'reviews' => '10K',
        'discount' => '-15%',
        'tag' => 'HOT'
    ],
    [
        'img' => '../assets/images/thumbs/trending-three-img5.png',
        'name' => 'Instax Mini 12 Instant Film Camera - Blue',
        'old_price' => '$28.99',
        'new_price' => '$18.99',
        'rating' => 4.7,
        'reviews' => '10K',
        'discount' => '-15%',
        'tag' => 'HOT'
    ],
    [
        'img' => '../assets/images/thumbs/trending-three-img6.png',
        'name' => 'Instax Mini 12 Instant Film Camera - Blue',
        'old_price' => '$28.99',
        'new_price' => '$18.99',
        'rating' => 4.7,
        'reviews' => '10K',
        'discount' => '-15%',
        'tag' => 'HOT'
    ],
    // Add more products here
];?>
<!-- ============================= Popular Products Three start ============================ -->
<section class="popular-products-three pb-120 overflow-hidden">
    <div class="container container-lg">
        <div class="section-heading mb-24">
            <h5 class="mb-0 text-uppercase wow fadeInLeft">Popular Products</h5>
        </div>
        <div class="row gy-4">
            <?php
            foreach ($products as $index => $product):
                $aosDuration = (400 * ($index + 1)); // Dynamic data-aos-duration
            ?>
                <div class="col-xxl-3 col-xl-4 col-sm-6" data-aos="fade-up" data-aos-duration="<?= $aosDuration ?>">
                    <div class="product-card h-100 p-16 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
                        <div class="product-card__thumb rounded-8 bg-gray-50 position-relative">
                            <a href="product-details-two.php" class="w-100 h-100 flex-center">
                                <img src="<?= $product['img'] ?>" alt="" class="w-auto max-w-unset">
                            </a>
                            <div class="position-absolute inset-block-start-0 inset-inline-start-0 mt-16 ms-16 z-1 d-flex flex-column gap-8">
                                <span class="text-main-two-600 w-40 h-40 d-flex justify-content-center align-items-center bg-white rounded-circle shadow-sm text-xs fw-semibold"><?= $product['discount'] ?></span>
                                <span class="text-neutral-600 w-40 h-40 d-flex justify-content-center align-items-center bg-white rounded-circle shadow-sm text-xs fw-semibold"><?= $product['tag'] ?></span>
                            </div>

                            <div class="bg-white p-2 rounded-pill z-1 position-absolute inset-inline-end-0 inset-block-start-0 me-16 mt-16 shadow-sm">
                                <button type="button" class="expand-btn w-40 h-40 text-md d-flex justify-content-center align-items-center rounded-circle hover-bg-main-two-600 hover-text-white">
                                    <i class="ph ph-plus"></i>
                                </button>
                                <div class="expand-icons gap-20 my-20">
                                    <button type="button" class="text-neutral-600 text-xl flex-center hover-text-main-two-600 wishlist-btn">
                                        <i class="ph ph-heart"></i>
                                    </button>
                                    <button type="button" class="text-neutral-600 text-xl flex-center hover-text-main-two-600">
                                        <i class="ph ph-eye"></i>
                                    </button>
                                    <button type="button" class="text-neutral-600 text-xl flex-center hover-text-main-two-600">
                                        <i class="ph ph-shuffle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="product-card__content mt-16 w-100">
                            <h6 class="title text-lg fw-semibold my-16">
                                <a href="product-details-two.php" class="link text-line-2" tabindex="0"><?= $product['name'] ?></a>
                            </h6>
                            <div class="flex-align gap-6">
                                <div class="flex-align gap-8">
                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                        <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <?php endfor; ?>
                                </div>
                                <span class="text-xs fw-medium text-gray-500"><?= $product['rating'] ?></span>
                                <span class="text-xs fw-medium text-gray-500">(<?= $product['reviews'] ?>)</span>
                            </div>

                            <span class="py-2 px-8 text-xs rounded-pill text-main-two-600 bg-main-two-50 mt-16">Fulfilled by Marketpro</span>

                            <div class="product-card__price mt-16 mb-30">
                                <span class="text-gray-400 text-md fw-semibold text-decoration-line-through"><?= $product['old_price'] ?></span>
                                <span class="text-heading text-md fw-semibold "><?= $product['new_price'] ?> <span class="text-gray-500 fw-normal">/Qty</span> </span>
                            </div>
                            <a href="cart.php" class="product-card__cart btn bg-gray-50 text-heading hover-bg-main-600 hover-text-white py-11 px-24 rounded-8 flex-center gap-8 fw-medium" tabindex="0">
                                Add To Cart <i class="ph ph-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- ============================= Popular Products Three End ============================ -->