<?php
// Define the product data in an array
$products = [
    [
        'image' => '../assets/images/thumbs/trending-three-img1.png',
        'link' => 'product-details-two.php',
        'title' => 'Instax Mini 12 Instant Film Camera - Green',
        'old_price' => '$28.99',
        'new_price' => '$14.99',
        'rating' => 4.8,
        'reviews' => '12K',
        'fulfilled_by' => 'Marketpro',
        'discount' => '-29%',
        'tags' => ['HOT']
    ],
    [
        'image' => '../assets/images/thumbs/trending-three-img2.png',
        'link' => 'product-details-two.php',
        'title' => 'Velvet Blossom Dress',
        'old_price' => '$28.99',
        'new_price' => '$14.99',
        'rating' => 4.8,
        'reviews' => '12K',
        'fulfilled_by' => 'Marketpro',
        'discount' => '-29%',
        'tags' => ['HOT']
    ],
    [
        'image' => '../assets/images/thumbs/trending-three-img3.png',
        'link' => 'product-details-two.php',
        'title' => 'Midnight Noir Leather Jacket',
        'old_price' => '$28.99',
        'new_price' => '$14.99',
        'rating' => 4.8,
        'reviews' => '12K',
        'fulfilled_by' => 'Marketpro',
        'discount' => '-29%',
        'tags' => ['HOT']
    ]
];
?>
<div class="new-arrival-three-wrapper">
    <div class="row gy-4">
        <div class="col-xl-4">
            <div class="rounded-24 overflow-hidden border border-main-two-600 p-16 bg-color-three h-100" data-aos="zoom-in" data-aos-duration="800">
                <div class="bg-img w-100 h-100 min-h-485 rounded-24 overflow-hidden" data-background-image="../assets/images/thumbs/new-arrival-promo-img1.png">
                    <div class="py-32 pe-32 text-end">
                        <span class="text-uppercase fw-semibold text-neutral-600 text-md">Summer offer</span>
                        <h5 class="mb-0">Get 85% Off</h5>
                        <a href="shop.php" class="btn btn-black rounded-pill gap-8 mt-32 flex-align d-inline-flex" tabindex="0">
                            Shop Now
                            <span class="text-xl d-flex"><i class="ph ph-shopping-cart-simple"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="row gy-4">
                <?php
                // Loop through the products and display them
                foreach ($products as $index => $product) {
                    $animation_duration = 400 * ($index + 1); // Increase the animation duration for each product
                ?>
                    <div class="col-lg-4 col-sm-6" data-aos="fade-up" data-aos-duration="<?= $animation_duration ?>">
                        <div class="product-card h-100 p-16 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
                            <div class="product-card__thumb rounded-8 bg-gray-50 position-relative">
                                <a href="<?= $product['link'] ?>" class="w-100 h-100 flex-center">
                                    <img src="<?= $product['image'] ?>" alt="" class="w-auto max-w-unset">
                                </a>
                                <div class="position-absolute inset-block-start-0 inset-inline-start-0 mt-16 ms-16 z-1 d-flex flex-column gap-8">
                                    <span class="text-main-two-600 w-40 h-40 d-flex justify-content-center align-items-center bg-white rounded-circle shadow-sm text-xs fw-semibold"><?= $product['discount'] ?></span>
                                    <?php foreach ($product['tags'] as $tag) { ?>
                                        <span class="text-neutral-600 w-40 h-40 d-flex justify-content-center align-items-center bg-white rounded-circle shadow-sm text-xs fw-semibold"><?= $tag ?></span>
                                    <?php } ?>
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
                                    <a href="<?= $product['link'] ?>" class="link text-line-2" tabindex="0"><?= $product['title'] ?></a>
                                </h6>
                                <div class="flex-align gap-6">
                                    <div class="flex-align gap-8">
                                        <?php for ($i = 0; $i < 5; $i++) { ?>
                                            <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                        <?php } ?>
                                    </div>
                                    <span class="text-xs fw-medium text-gray-500"><?= $product['rating'] ?></span>
                                    <span class="text-xs fw-medium text-gray-500">(<?= $product['reviews'] ?>)</span>
                                </div>

                                <span class="py-2 px-8 text-xs rounded-pill text-main-two-600 bg-main-two-50 mt-16">Fulfilled by <?= $product['fulfilled_by'] ?></span>

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
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="mt-24">
        <div class="row gy-4">
            <div class="col-xl-8">
                <div class="row gy-4">
                    <?php
                    // Loop through the products and display them
                    foreach ($products as $index => $product) {
                        $animation_duration = 400 * ($index + 1); // Increase the animation duration for each product
                    ?>
                        <div class="col-lg-4 col-sm-6" data-aos="fade-up" data-aos-duration="<?= $animation_duration ?>">
                            <div class="product-card h-100 p-16 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
                                <div class="product-card__thumb rounded-8 bg-gray-50 position-relative">
                                    <a href="<?= $product['link'] ?>" class="w-100 h-100 flex-center">
                                        <img src="<?= $product['image'] ?>" alt="" class="w-auto max-w-unset">
                                    </a>
                                    <div class="position-absolute inset-block-start-0 inset-inline-start-0 mt-16 ms-16 z-1 d-flex flex-column gap-8">
                                        <span class="text-main-two-600 w-40 h-40 d-flex justify-content-center align-items-center bg-white rounded-circle shadow-sm text-xs fw-semibold"><?= $product['discount'] ?></span>
                                        <?php foreach ($product['tags'] as $tag) { ?>
                                            <span class="text-neutral-600 w-40 h-40 d-flex justify-content-center align-items-center bg-white rounded-circle shadow-sm text-xs fw-semibold"><?= $tag ?></span>
                                        <?php } ?>
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
                                        <a href="<?= $product['link'] ?>" class="link text-line-2" tabindex="0"><?= $product['title'] ?></a>
                                    </h6>
                                    <div class="flex-align gap-6">
                                        <div class="flex-align gap-8">
                                            <?php for ($i = 0; $i < 5; $i++) { ?>
                                                <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                            <?php } ?>
                                        </div>
                                        <span class="text-xs fw-medium text-gray-500"><?= $product['rating'] ?></span>
                                        <span class="text-xs fw-medium text-gray-500">(<?= $product['reviews'] ?>)</span>
                                    </div>

                                    <span class="py-2 px-8 text-xs rounded-pill text-main-two-600 bg-main-two-50 mt-16">Fulfilled by <?= $product['fulfilled_by'] ?></span>

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
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-xl-4" data-aos="zoom-in" data-aos-duration="800">
                <div class="rounded-24 overflow-hidden border border-main-two-600 p-16 bg-color-three h-100">
                    <div class="bg-img w-100 h-100 min-h-485 rounded-24 overflow-hidden" data-background-image="../assets/images/thumbs/new-arrival-promo-img2.png">
                        <div class="py-32 pe-32 text-end">
                            <span class="text-uppercase fw-semibold text-neutral-600 text-sm">Get extra discount on first order</span>
                            <h5 class="mb-0 text-white fw-medium">Spring Collection</h5>
                            <a href="shop.php" class="btn btn-black rounded-pill gap-8 mt-32 flex-align d-inline-flex" tabindex="0">
                                Shop Now
                                <span class="text-xl d-flex"><i class="ph ph-shopping-cart-simple"></i></span>
                            </a>
                        </div>
                        <div class="bg-neutral-600 rounded-circle p-lg-5 p-md-4 p--24 max-w-260 max-h-260 w-100 h-100 ms-auto">
                            <div class="bg-white bg-opacity-10 w-100 h-100 rounded-circle d-flex justify-content-center align-items-center">
                                <h3 class="text-white mb-0 fw-medium">45% <br> Off</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>