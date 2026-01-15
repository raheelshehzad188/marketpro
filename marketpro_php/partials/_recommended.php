<!-- ========================= Top Selling Products Start ================================ -->
<?php
// Product data array
$featuredProduct = [
    'title' => 'Insta360 GO 3S Action Camera - White',
    'price' => '430',
    'discount' => '20'
];

$recommendedProducts = [
    [
        'image' => '../assets/images/thumbs/product-two-img1.png',
        'badge' => [
            'text' => 'Best Seller',
            'class' => 'bg-tertiary-600'
        ],
        'discount' => '19',
        'title' => 'Instax Mini 12 Instant Film Camera - Green',
        'rating' => 4.8,
        'reviews' => '12K',
        'original_price' => '28.99',
        'sale_price' => '14.99',
        'delivery_date' => 'Aug 02'
    ],
    [
        'image' => '../assets/images/thumbs/product-two-img2.png',
        'badge' => [
            'text' => 'New',
            'class' => 'bg-warning-600'
        ],
        'discount' => '19',
        'title' => 'Instax Mini 12 Instant Film Camera - Green',
        'rating' => 4.8,
        'reviews' => '12K',
        'original_price' => '28.99',
        'sale_price' => '14.99',
        'delivery_date' => 'Aug 02'
    ],
    [
        'image' => '../assets/images/thumbs/product-two-img3.png',
        'badge' => [
            'text' => 'Sale 50%',
            'class' => 'bg-danger-600'
        ],
        'discount' => '19',
        'title' => 'Instax Mini 12 Instant Film Camera - Green',
        'rating' => 4.8,
        'reviews' => '12K',
        'original_price' => '28.99',
        'sale_price' => '14.99',
        'delivery_date' => 'Aug 02'
    ],
    [
        'image' => '../assets/images/thumbs/product-two-img4.png',
        'badge' => [
            'text' => 'Sold',
            'class' => 'bg-success-600'
        ],
        'discount' => '19',
        'title' => 'Instax Mini 12 Instant Film Camera - Green',
        'rating' => 4.8,
        'reviews' => '12K',
        'original_price' => '28.99',
        'sale_price' => '14.99',
        'delivery_date' => 'Aug 02'
    ]
];
?>

<section class="recommended overflow-hidden pt-80">
    <div class="container container-lg">
        <div class="row g-12">
            <div class="col-xxl-4">
                <div class="position-relative rounded-16 bg-light-purple overflow-hidden p-28 z-1 text-center h-100" data-aos="zoom-in" data-aos-duration="800">
                    <img src="../assets/images/bg/recommended-bg.png" alt="" class="position-absolute inset-block-start-0 inset-inline-start-0 z-n1 w-100 h-100 cover-img">
                    <div class="py-xl-4 text-center">
                        <span class="h6 mb-20 text-white"><?php echo $featuredProduct['title']; ?></span>
                        <div class="flex-center gap-12 text-white">
                            <span class="">FROM</span>
                            <h4 class="mb-8 text-white">$<?php echo $featuredProduct['price']; ?></h4>
                            <span class="badge-style-two position-relative me-8 bg-success-600 text-white text-sm py-2 px-8 rounded-4"><?php echo $featuredProduct['discount']; ?>% off</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-8">
                <div class="border border-gray-100 p-24 rounded-16">
                    <div class="section-heading mb-24">
                        <div class="flex-between flex-wrap gap-8">
                            <h6 class="mb-0 wow fadeInLeft">Recommended For You</h6>
                            <div class="flex-align gap-16 wow fadeInRight">
                                <a href="shop.php" class="text-sm fw-medium text-gray-700 hover-text-main-600 hover-text-decoration-underline">View All</a>
                                <div class="flex-align gap-8">
                                    <button type="button" id="recommended-prev" class="slick-prev slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1">
                                        <i class="ph ph-caret-left"></i>
                                    </button>
                                    <button type="button" id="recommended-next" class="slick-next slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1">
                                        <i class="ph ph-caret-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="recommended-slider">
                        <?php foreach ($recommendedProducts as $index => $product): ?>
                        <div data-aos="fade-up" data-aos-duration="<?php echo (400 + ($index * 200)); ?>">
                            <div class="product-card h-100 p-16 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
                                <a href="product-details-two.php" class="product-card__thumb flex-center rounded-8 position-relative">
                                    <span class="product-card__badge <?php echo $product['badge']['class']; ?> px-8 py-4 text-sm text-white position-absolute inset-inline-start-0 inset-block-start-0"><?php echo $product['badge']['text']; ?></span>
                                    <img src="<?php echo $product['image']; ?>" alt="" class="w-auto max-w-unset">
                                </a>
                                <div class="product-card__content mt-16">
                                    <span class="text-main-600 bg-main-50 text-sm fw-medium py-4 px-8"><?php echo $product['discount']; ?>%OFF</span>
                                    <h6 class="title text-lg fw-semibold my-16">
                                        <a href="product-details-two.php" class="link text-line-2"><?php echo $product['title']; ?></a>
                                    </h6>
                                    <div class="flex-align gap-6">
                                        <div class="flex-align gap-2">
                                            <?php for($i = 0; $i < 5; $i++): ?>
                                            <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                            <?php endfor; ?>
                                        </div>
                                        <span class="text-xs fw-medium text-gray-500"><?php echo $product['rating']; ?></span>
                                        <span class="text-xs fw-medium text-gray-500">(<?php echo $product['reviews']; ?>)</span>
                                    </div>
        
                                    <span class="py-2 px-8 text-xs rounded-pill text-main-two-600 bg-main-two-50 mt-16">Fulfilled by Marketpro</span>
        
                                    <div class="product-card__price mt-16 mb-30">
                                        <span class="text-gray-400 text-md fw-semibold text-decoration-line-through">$<?php echo $product['original_price']; ?></span>
                                        <span class="text-heading text-md fw-semibold">$<?php echo $product['sale_price']; ?> <span class="text-gray-500 fw-normal">/Qty</span></span>
                                    </div>
                                    <span class="text-neutral-600">Delivered by <span class="text-main-600"><?php echo $product['delivery_date']; ?></span></span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================= Top Selling Products End ================================ -->
