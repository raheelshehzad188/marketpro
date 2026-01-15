<?php
$trending = [
    'title' => 'Trending Products',
    'products' => [
        [
            'image' => '../assets/images/thumbs/trending-three-img1.png',
            'title' => 'Instax Mini 12 Instant Film Camera - Green',
            'discount' => '-29%',
            'hot' => 'HOT',
            'rating' => 4.8,
            'reviews' => '12K',
            'old_price' => 28.99,
            'price' => 14.99,
            'countdown_id' => 'countdown12'
        ],
        [
            'image' => '../assets/images/thumbs/trending-three-img2.png',
            'title' => 'Midnight Noir Leather Jacket',
            'discount' => '-29%',
            'hot' => 'HOT',
            'rating' => 4.8,
            'reviews' => '12K',
            'old_price' => 28.99,
            'price' => 14.99,
            'countdown_id' => 'countdown13'
        ],
        [
            'image' => '../assets/images/thumbs/trending-three-img3.png',
            'title' => 'Urban Rebel Combat Boots',
            'discount' => '-29%',
            'hot' => 'HOT',
            'rating' => 4.8,
            'reviews' => '12K',
            'old_price' => 28.99,
            'price' => 14.99,
            'countdown_id' => 'countdown14'
        ],
        [
            'image' => '../assets/images/thumbs/trending-three-img4.png',
            'title' => 'Velvet Blossom Dress',
            'discount' => '-29%',
            'hot' => 'HOT',
            'rating' => 4.8,
            'reviews' => '12K',
            'old_price' => 28.99,
            'price' => 14.99,
            'countdown_id' => 'countdown15'
        ]
    ]
];
?>
<!-- ========================= Trending Products Start ================================ -->
<section class="trending-products-three py-120 overflow-hidden">
    <div class="container container-lg">
        <div class="section-heading mb-24">
            <div class="flex-between flex-wrap gap-8">
                <h5 class="mb-0 text-uppercase"><?php echo $trending['title']; ?></h5>
                <ul class="nav common-tab style-two nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pills-sale-tab" data-bs-toggle="pill" data-bs-target="#pills-sale" type="button" role="tab" aria-controls="pills-sale" aria-selected="true">On Sale</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-featured-tab" data-bs-toggle="pill" data-bs-target="#pills-featured" type="button" role="tab" aria-controls="pills-featured" aria-selected="false">Featured Products</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-rated-tab" data-bs-toggle="pill" data-bs-target="#pills-rated" type="button" role="tab" aria-controls="pills-rated" aria-selected="false">Best Rated</button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <?php 
            $tabs = ['sale', 'featured', 'rated'];
            foreach($tabs as $index => $tab): 
                $isActive = $index === 0;
            ?>
            <div class="tab-pane fade <?php echo $isActive ? 'show active' : ''; ?>" id="pills-<?php echo $tab; ?>" role="tabpanel" aria-labelledby="pills-<?php echo $tab; ?>-tab" tabindex="0">
                <div class="row g-12">
                    <?php foreach($trending['products'] as $key => $product): ?>
                    <div class="col-xl-3 col-lg-4 col-sm-6" data-aos="fade-up" data-aos-duration="<?php echo (($key + 1) * 200); ?>">
                        <div class="product-card h-100 p-16 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
                            <div class="product-card__thumb rounded-8 bg-gray-50 position-relative">
                                <a href="product-details-two.php" class="w-100 h-100 flex-center">
                                    <img src="<?php echo $product['image']; ?>" alt="" class="w-auto max-w-unset">
                                </a>
                                <div class="position-absolute inset-block-start-0 inset-inline-start-0 mt-16 ms-16 z-1 d-flex flex-column gap-8">
                                    <span class="text-main-two-600 w-40 h-40 d-flex justify-content-center align-items-center bg-white rounded-circle shadow-sm text-xs fw-semibold"><?php echo $product['discount']; ?></span>
                                    <span class="text-neutral-600 w-40 h-40 d-flex justify-content-center align-items-center bg-white rounded-circle shadow-sm text-xs fw-semibold"><?php echo $product['hot']; ?></span>
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

                                <div class="countdown position-absolute start-50 inset-block-end-0 mb-20 translate-middle-x w-100" id="<?php echo $product['countdown_id']; ?>">
                                    <ul class="countdown-list style-four flex-center flex-wrap gap-8">
                                        <li class="countdown-list__item flex-align flex-column text-sm fw-medium text-white rounded-lg bg-neutral-600">
                                            <span class="days text-2xl text-main-two-600 fw-medium"></span>Days
                                        </li>
                                        <li class="countdown-list__item flex-align flex-column text-sm fw-medium text-white rounded-lg bg-neutral-600">
                                            <span class="hours text-2xl text-main-two-600 fw-medium"></span>Hour
                                        </li>
                                        <li class="countdown-list__item flex-align flex-column text-sm fw-medium text-white rounded-lg bg-neutral-600">
                                            <span class="minutes text-2xl text-main-two-600 fw-medium"></span>Min
                                        </li>
                                        <li class="countdown-list__item flex-align flex-column text-sm fw-medium text-white rounded-lg bg-neutral-600">
                                            <span class="seconds text-2xl text-main-two-600 fw-medium"></span>Sec
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-card__content mt-16 w-100">
                                <h6 class="title text-lg fw-semibold my-16">
                                    <a href="product-details-two.php" class="link text-line-2" tabindex="0"><?php echo $product['title']; ?></a>
                                </h6>
                                <div class="flex-align gap-6">
                                    <div class="flex-align gap-8">
                                        <?php for($i = 0; $i < 5; $i++): ?>
                                        <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="text-xs fw-medium text-gray-500"><?php echo $product['rating']; ?></span>
                                    <span class="text-xs fw-medium text-gray-500">(<?php echo $product['reviews']; ?>)</span>
                                </div>

                                <span class="py-2 px-8 text-xs rounded-pill text-main-two-600 bg-main-two-50 mt-16">Fulfilled by Marketpro</span>

                                <div class="product-card__price mt-16 mb-30">
                                    <span class="text-gray-400 text-md fw-semibold text-decoration-line-through">$<?php echo number_format($product['old_price'], 2); ?></span>
                                    <span class="text-heading text-md fw-semibold ">$<?php echo number_format($product['price'], 2); ?> <span class="text-gray-500 fw-normal">/Qty</span> </span>
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
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- ========================= Trending Products End ================================ -->