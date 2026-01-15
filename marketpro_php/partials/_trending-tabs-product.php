<?php
$trendingTabProducts = [
    [
        'image' => '../assets/images/thumbs/product-two-img1.png',
        'title' => 'Instax Mini 12 Instant Film Camera - Green',
        'discount' => '19%OFF',
        'rating' => '4.8',
        'reviews' => '12K',
        'old_price' => 28.99,
        'price' => 14.99,
        'delivery_date' => 'Aug 02',
        'badge' => ''
    ],
    [
        'image' => '../assets/images/thumbs/product-two-img2.png',
        'title' => 'Instax Mini 12 Instant Film Camera - Green',
        'discount' => '19%OFF',
        'rating' => '4.8',
        'reviews' => '12K',
        'old_price' => 28.99,
        'price' => 14.99,
        'delivery_date' => 'Aug 02',
        'badge' => [
            'text' => 'New',
            'class' => 'bg-warning-600'
        ]
    ],
    [
        'image' => '../assets/images/thumbs/product-two-img3.png',
        'title' => 'Instax Mini 12 Instant Film Camera - Green',
        'discount' => '19%OFF',
        'rating' => '4.8',
        'reviews' => '12K',
        'old_price' => 28.99,
        'price' => 14.99,
        'delivery_date' => 'Aug 02',
        'badge' => ''
    ],
    [
        'image' => '../assets/images/thumbs/product-two-img4.png',
        'title' => 'Instax Mini 12 Instant Film Camera - Green',
        'discount' => '19%OFF',
        'rating' => '4.8',
        'reviews' => '12K',
        'old_price' => 28.99,
        'price' => 14.99,
        'delivery_date' => 'Aug 02',
        'badge' => [
            'text' => 'Sold',
            'class' => 'bg-success-600'
        ]
    ],
    [
        'image' => '../assets/images/thumbs/product-two-img5.png',
        'title' => 'Instax Mini 12 Instant Film Camera - Green',
        'discount' => '19%OFF',
        'rating' => '4.8',
        'reviews' => '12K',
        'old_price' => 28.99,
        'price' => 14.99,
        'delivery_date' => 'Aug 02',
        'badge' => ''
    ],
    [
        'image' => '../assets/images/thumbs/product-two-img6.png',
        'title' => 'Instax Mini 12 Instant Film Camera - Green',
        'discount' => '19%OFF',
        'rating' => '4.8',
        'reviews' => '12K',
        'old_price' => 28.99,
        'price' => 14.99,
        'delivery_date' => 'Aug 02',
        'badge' => ''
    ]
];
?>

<div class="row g-12">
    <?php foreach($trendingTabProducts as $index => $product): ?>
    <div class="col-xxl-2 col-xl-3 col-lg-4 col-sm-6" data-aos="fade-up" data-aos-duration="<?php echo (($index + 1) * 200); ?>">
        <div class="product-card h-100 p-16 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
            <a href="product-details-two.php" class="product-card__thumb flex-center rounded-8 bg-gray-50 position-relative">
                <?php if(!empty($product['badge'])): ?>
                <span class="product-card__badge <?php echo $product['badge']['class']; ?> px-8 py-4 text-sm text-white position-absolute inset-inline-start-0 inset-block-start-0"><?php echo $product['badge']['text']; ?></span>
                <?php endif; ?>
                <img src="<?php echo $product['image']; ?>" alt="" class="w-auto max-w-unset">
            </a>
            <div class="product-card__content mt-16">
                <span class="text-success-600 bg-success-50 text-sm fw-medium py-4 px-8"><?php echo $product['discount']; ?></span>
                <h6 class="title text-lg fw-semibold my-16">
                    <a href="product-details-two.php" class="link text-line-2" tabindex="0"><?php echo $product['title']; ?></a>
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

                <span class="py-2 px-8 text-xs rounded-pill text-main-two-600 bg-main-two-50 mt-16 fw-normal">Fulfilled by Marketpro</span>

                <div class="product-card__price mt-16 mb-30">
                    <span class="text-gray-400 text-md fw-semibold text-decoration-line-through">$<?php echo number_format($product['old_price'], 2); ?></span>
                    <span class="text-heading text-md fw-semibold ">$<?php echo number_format($product['price'], 2); ?> <span class="text-gray-500 fw-normal">/Qty</span> </span>
                </div>
                <span class="text-neutral-600 text-xs fw-medium">Delivered by <span class="text-main-600"><?php echo $product['delivery_date']; ?></span></span>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>