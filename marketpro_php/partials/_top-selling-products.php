<?php
// Top Selling Products Data Array
$topSellingProducts = [
    'title' => 'Top Selling Products',
    'view_all_link' => 'shop.php',
    'featured_product' => [
        'title' => 'Polaroid Now+ Gen 2 - White',
        'discount' => '35',
        'image' => '../assets/images/thumbs/deal-img.png'
    ],
    'products' => [
        [
            'image' => '../assets/images/thumbs/product-two-img7.png',
            'rating' => '4.8',
            'reviews' => '17k',
            'title' => 'Taylor Farms Broccoli Florets Vegetables',
            'store' => 'Lucky Supermarket',
            'sold' => 18,
            'total' => 35,
            'old_price' => 28.99,
            'price' => 14.99,
            'badge' => ''
        ],
        [
            'image' => '../assets/images/thumbs/product-two-img8.png',
            'rating' => '4.8',
            'reviews' => '17k',
            'title' => 'Taylor Farms Broccoli Florets Vegetables',
            'store' => 'Lucky Supermarket',
            'sold' => 18,
            'total' => 35,
            'old_price' => 28.99,
            'price' => 14.99,
            'badge' => [
                'text' => 'Sale 50%',
                'class' => 'bg-danger-600'
            ]
        ],
        [
            'image' => '../assets/images/thumbs/product-two-img9.png',
            'rating' => '4.8',
            'reviews' => '17k',
            'title' => 'Taylor Farms Broccoli Florets Vegetables',
            'store' => 'Lucky Supermarket',
            'sold' => 18,
            'total' => 35,
            'old_price' => 28.99,
            'price' => 14.99,
            'badge' => ''
        ],
        [
            'image' => '../assets/images/thumbs/product-two-img10.png',
            'rating' => '4.8',
            'reviews' => '17k',
            'title' => 'Taylor Farms Broccoli Florets Vegetables',
            'store' => 'Lucky Supermarket',
            'sold' => 18,
            'total' => 35,
            'old_price' => 28.99,
            'price' => 14.99,
            'badge' => ''
        ],
        [
            'image' => '../assets/images/thumbs/product-two-img8.png',
            'rating' => '4.8',
            'reviews' => '17k',
            'title' => 'Taylor Farms Broccoli Florets Vegetables',
            'store' => 'Lucky Supermarket',
            'sold' => 18,
            'total' => 35,
            'old_price' => 28.99,
            'price' => 14.99,
            'badge' => [
                'text' => 'Best Sale',
                'class' => 'bg-main-600'
            ]
        ]
    ]
];
?>

<!-- ========================= Top Selling Products Start ================================ -->
<section class="top-selling-products pt-80 overflow-hidden">
    <div class="container container-lg">
        <div class="border border-gray-100 p-24 rounded-16">
            <div class="section-heading mb-24">
                <div class="flex-between flex-wrap gap-8">
                    <h6 class="mb-0 wow fadeInLeft"><?php echo $topSellingProducts['title']; ?></h6>
                    <div class="flex-align gap-16 wow fadeInRight">
                        <a href="<?php echo $topSellingProducts['view_all_link']; ?>" class="text-sm fw-semibold text-gray-700 hover-text-main-600 hover-text-decoration-underline">View All Products</a>
                        <div class="flex-align gap-8">
                            <button type="button" id="top-selling-prev" class="slick-prev slick-arrow flex-center rounded-circle border border-gray-100 hover-border-neutral-600 text-xl hover-bg-neutral-600 hover-text-white transition-1" >
                                <i class="ph ph-caret-left"></i>
                            </button>
                            <button type="button" id="top-selling-next" class="slick-next slick-arrow flex-center rounded-circle border border-gray-100 hover-border-neutral-600 text-xl hover-bg-neutral-600 hover-text-white transition-1" >
                                <i class="ph ph-caret-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-12">
                <div class="col-md-4" data-aos="zoom-in" data-aos-duration="800">
                    <div class="position-relative rounded-16 overflow-hidden p-28 z-1 text-center bg-main-100 h-100">
                        <div class="py-xl-4">
                            <h6 class="mb-8 fw-bold"><?php echo $topSellingProducts['featured_product']['title']; ?></h6>
                            <h6 class="mb-8 fw-bold">Get <span class="text-main-600"><?php echo $topSellingProducts['featured_product']['discount']; ?>%</span> off</h6>
                            <a href="cart.php" class="btn text-heading border-white bg-white py-16 px-24 flex-center d-inline-flex rounded-pill gap-8 fw-medium hover-bg-main-600 hover-bg-main-two-600 hover-border-main-two-600 hover-text-white mt-24" tabindex="0">
                                Shop Now <i class="ph ph-shopping-cart text-xl d-flex"></i> 
                            </a>
                        </div>
                        <div class="d-md-block d-none mt-36">
                            <img src="<?php echo $topSellingProducts['featured_product']['image']; ?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="top-selling-product-slider arrow-style-two">
                        <?php foreach($topSellingProducts['products'] as $index => $product): ?>
                        <div data-aos="fade-up" data-aos-duration="<?php echo (($index + 1) * 200); ?>">
                            <div class="product-card hover-card-shadows h-100 p-16 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
                                <a href="product-details-two.php" class="product-card__thumb flex-center rounded-8 position-relative">
                                    <?php if(!empty($product['badge'])): ?>
                                    <span class="product-card__badge <?php echo $product['badge']['class']; ?> px-8 py-4 text-sm text-white position-absolute inset-inline-start-0 inset-block-start-0"><?php echo $product['badge']['text']; ?></span>
                                    <?php endif; ?>
                                    <img src="<?php echo $product['image']; ?>" alt="" class="w-auto max-w-unset">
                                </a>
                                <div class="product-card__content mt-16">
                                    <div class="flex-align gap-6">
                                        <span class="text-xs fw-medium text-gray-500"><?php echo $product['rating']; ?></span>
                                        <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                        <span class="text-xs fw-medium text-gray-500">(<?php echo $product['reviews']; ?>)</span>
                                    </div>
                                    <h6 class="title text-lg fw-semibold mt-12 mb-8">
                                        <a href="product-details-two.php" class="link text-line-2" tabindex="0"><?php echo $product['title']; ?></a>
                                    </h6>
                                    <div class="flex-align gap-4">
                                        <span class="text-tertiary-600 text-md d-flex"><i class="ph-fill ph-storefront"></i></span>
                                        <span class="text-gray-500 text-xs">By <?php echo $product['store']; ?></span>
                                    </div>
                                    <div class="mt-8">
                                        <div class="progress w-100 bg-color-three rounded-pill h-4" role="progressbar" aria-label="Basic example" aria-valuenow="<?php echo ($product['sold']/$product['total'])*100; ?>" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-tertiary-600 rounded-pill" style="width: <?php echo ($product['sold']/$product['total'])*100; ?>%"></div>
                                        </div>
                                        <span class="text-gray-900 text-xs fw-medium mt-8">Sold: <?php echo $product['sold']; ?>/<?php echo $product['total']; ?></span>
                                    </div>

                                    <div class="product-card__price my-20">
                                        <span class="text-gray-400 text-md fw-semibold text-decoration-line-through">$<?php echo number_format($product['old_price'], 2); ?></span>
                                        <span class="text-heading text-md fw-semibold ">$<?php echo number_format($product['price'], 2); ?> <span class="text-gray-500 fw-normal">/Qty</span> </span>
                                    </div>
             
                                    <a href="cart.php" class="product-card__cart btn bg-gray-50 text-heading hover-bg-main-600 hover-text-white py-11 px-24 rounded-pill flex-center gap-8 fw-medium" tabindex="0">
                                        Add To Cart <i class="ph ph-shopping-cart"></i> 
                                    </a>
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
