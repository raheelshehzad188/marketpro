<?php
// Product Data Arrays
$shortProducts = [
    'featured' => [
        'title' => 'Featured Products',
        'duration' => '600',
        'items' => [
            [
                'image' => '../assets/images/thumbs/short-product-img1.png',
                'rating' => '4.8',
                'reviews' => '17k',
                'title' => 'Taylor Farms Broccoli Florets Vegetables',
                'price' => '1500.00',
                'original_price' => '1500.00'
            ],
            [
                'image' => '../assets/images/thumbs/short-product-img2.png',
                'rating' => '4.8',
                'reviews' => '17k',
                'title' => 'Taylor Farms Broccoli Florets Vegetables',
                'price' => '1500.00',
                'original_price' => '1500.00'
            ],
            [
                'image' => '../assets/images/thumbs/short-product-img3.png',
                'rating' => '4.8',
                'reviews' => '17k',
                'title' => 'Taylor Farms Broccoli Florets Vegetables',
                'price' => '1500.00',
                'original_price' => '1500.00'
            ],
            [
                'image' => '../assets/images/thumbs/short-product-img4.png',
                'rating' => '4.8',
                'reviews' => '17k',
                'title' => 'Taylor Farms Broccoli Florets Vegetables',
                'price' => '1500.00',
                'original_price' => '1500.00'
            ]
        ]
    ],
    'top_selling' => [
        'title' => 'Top Selling Products',
        'duration' => '700',
        'items' => [
            [
                'image' => '../assets/images/thumbs/short-product-img5.png',
                'rating' => '4.8',
                'reviews' => '17k',
                'title' => 'Taylor Farms Broccoli Florets Vegetables',
                'price' => '1500.00',
                'original_price' => '1500.00'
            ],
            [
                'image' => '../assets/images/thumbs/short-product-img6.png',
                'rating' => '4.8',
                'reviews' => '17k',
                'title' => 'Taylor Farms Broccoli Florets Vegetables',
                'price' => '1500.00',
                'original_price' => '1500.00'
            ],
            [
                'image' => '../assets/images/thumbs/short-product-img7.png',
                'rating' => '4.8',
                'reviews' => '17k',
                'title' => 'Taylor Farms Broccoli Florets Vegetables',
                'price' => '1500.00',
                'original_price' => '1500.00'
            ],
            [
                'image' => '../assets/images/thumbs/short-product-img8.png',
                'rating' => '4.8',
                'reviews' => '17k',
                'title' => 'Taylor Farms Broccoli Florets Vegetables',
                'price' => '1500.00',
                'original_price' => '1500.00'
            ]
        ]
    ],
    'on_sale' => [
        'title' => 'On-sale Products',
        'duration' => '800',
        'items' => [
            [
                'image' => '../assets/images/thumbs/short-product-img9.png',
                'rating' => '4.8',
                'reviews' => '17k',
                'title' => 'Taylor Farms Broccoli Florets Vegetables',
                'price' => '1500.00',
                'original_price' => '1500.00'
            ],
            [
                'image' => '../assets/images/thumbs/short-product-img4.png',
                'rating' => '4.8',
                'reviews' => '17k',
                'title' => 'Taylor Farms Broccoli Florets Vegetables',
                'price' => '1500.00',
                'original_price' => '1500.00'
            ],
            [
                'image' => '../assets/images/thumbs/short-product-img7.png',
                'rating' => '4.8',
                'reviews' => '17k',
                'title' => 'Taylor Farms Broccoli Florets Vegetables',
                'price' => '1500.00',
                'original_price' => '1500.00'
            ],
            [
                'image' => '../assets/images/thumbs/short-product-img4.png',
                'rating' => '4.8',
                'reviews' => '17k',
                'title' => 'Taylor Farms Broccoli Florets Vegetables',
                'price' => '1500.00',
                'original_price' => '1500.00'
            ]
        ]
    ],
    'deal_of_week' => [
        'duration' => '900',
        'image' => '../assets/images/thumbs/product-img32.png',
        'rating' => 3,
        'reviews' => '3',
        'price' => '60.99',
        'original_price' => '79.99',
        'title' => 'Perfectly Packed Meat Combos for Delicious and Flavorful Meals Every Day',
        'progress' => 35,
        'available' => '60.99'
    ]
];

// Helper function to render product item
function renderProductItem($product) {
    ?>
    <div class="flex-align gap-16">
        <div class="w-90 h-90 rounded-12 border border-gray-100 flex-shrink-0">
            <a href="product-details.php" class="link"><img src="<?php echo $product['image']; ?>" alt=""></a>
        </div>
        <div class="product-card__content mt-12">
            <div class="flex-align gap-6">
                <span class="text-xs fw-bold text-gray-500"><?php echo $product['rating']; ?></span>
                <span class="text-15 fw-bold text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                <span class="text-xs fw-bold text-gray-500">(<?php echo $product['reviews']; ?>)</span>
            </div>
            <h6 class="title text-lg fw-semibold mt-8 mb-8">
                <a href="product-details.php" class="link text-line-1"><?php echo $product['title']; ?></a>
            </h6>
            <div class="product-card__price flex-align gap-8">
                <span class="text-heading text-md fw-semibold d-block">$<?php echo $product['price']; ?></span>
                <span class="text-gray-400 text-md fw-semibold d-block">$<?php echo $product['original_price']; ?></span>
            </div>
        </div>
    </div>
    <?php
}
?>

<!-- ========================== Short Product Section Start ============================== -->
<div class="short-product pt-110">
    <div class="container container-lg">
        <div class="row gy-4">
            <?php foreach(['featured', 'top_selling', 'on_sale'] as $section): ?>
            <div class="col-xxl-3 col-lg-4 col-sm-6" data-aos="fade-up" data-aos-duration="<?php echo $shortProducts[$section]['duration']; ?>">
                <div class="p-16 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
                    <div class="p-16 bg-main-50 rounded-16 mb-32">
                        <h6 class="underlined-line position-relative mb-0 pb-16 d-inline-block"><?php echo $shortProducts[$section]['title']; ?></h6>
                    </div>
                    <div class="short-product-list arrow-style-two max-h-unset">
                        <div class="d-flex flex-column gap-44">
                            <?php foreach($shortProducts[$section]['items'] as $product): ?>
                                <?php renderProductItem($product); ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="d-flex flex-column gap-44">
                            <?php foreach($shortProducts[$section]['items'] as $product): ?>
                                <?php renderProductItem($product); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            
            <!-- Deal of the Week -->
            <div class="col-xxl-3 col-lg-4 col-sm-6" data-aos="fade-up" data-aos-duration="<?php echo $shortProducts['deal_of_week']['duration']; ?>">
                <div class="product-card h-100 p-24 pt-32 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2 group-item pt-32">
                    <button type="button" class="wishlist-btn-two">
                        <i class="ph-bold ph-heart"></i>
                    </button>

                    <div class="">
                        <h6 class="position-relative mb-0 pb-12 d-inline-block">Deals of the week</h6>
                        <div class="countdown mb-10" id="countdown26">
                            <ul class="countdown-list flex-align flex-wrap">
                                <li class="countdown-list__item colon-red py-8 px-12 flex-align gap-4 text-sm fw-medium box-shadow-4xl rounded-5 bg-main-600 text-white">
                                    <span class="days"></span> D
                                </li>
                                <li class="countdown-list__item colon-red py-8 px-12 flex-align gap-4 text-sm fw-medium box-shadow-4xl rounded-5 bg-main-600 text-white">
                                    <span class="hours"></span> H
                                </li>
                                <li class="countdown-list__item colon-red py-8 px-12 flex-align gap-4 text-sm fw-medium box-shadow-4xl rounded-5 bg-main-600 text-white">
                                    <span class="minutes"></span> M
                                </li>
                                <li class="countdown-list__item colon-red py-8 px-12 flex-align gap-4 text-sm fw-medium box-shadow-4xl rounded-5 bg-main-600 text-white">
                                    <span class="seconds"></span> S
                                </li>
                            </ul>
                        </div>
                        <p class="text-neutral-300 fw-medium text-sm">Don't miss this opportunity at a special</p>
                    </div>
                    
                    <a href="product-details.php" class="product-card__thumb flex-center overflow-hidden">
                        <img src="<?php echo $shortProducts['deal_of_week']['image']; ?>" alt="">
                    </a>
                    <div class="product-card__content w-100">
                        <div class="flex-align gap-4">
                            <div class="flex-align gap-2 me-4">
                                <?php for($i = 0; $i < 5; $i++): ?>
                                <span class="text-12 fw-medium <?php echo $i < $shortProducts['deal_of_week']['rating'] ? 'text-warning-600' : 'text-gray-400'; ?> d-flex">
                                    <i class="ph-fill ph-star"></i>
                                </span>
                                <?php endfor; ?>
                            </div>
                            <span class="text-xs fw-medium text-heading">(<?php echo $shortProducts['deal_of_week']['reviews']; ?>)</span>
                        </div>
                        <div class="d-flex align-items-center gap-12 mt-6">
                            <h6 class="text-danger-600 mb-0 text-lg">$<?php echo $shortProducts['deal_of_week']['price']; ?></h6>
                            <h6 class="text-neutral-300 fw-medium mb-0 text-lg">$<?php echo $shortProducts['deal_of_week']['original_price']; ?></h6>
                        </div>
                        
                        <h6 class="title text-md fw-semibold mt-10 mb-0">
                            <a href="product-details.php" class="link text-line-2 fw-bold"><?php echo $shortProducts['deal_of_week']['title']; ?></a>
                        </h6>   
                        <p class="text-gray-500 text-sm mt-12 pb-12 border-bottom border-neutral-100 mb-8">This product is about to run out</p>
        
                        <div class="progress w-100 bg-gray-100 rounded-pill h-8" role="progressbar" aria-label="Basic example" aria-valuenow="<?php echo $shortProducts['deal_of_week']['progress']; ?>" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-success-600 rounded-pill" style="width: <?php echo $shortProducts['deal_of_week']['progress']; ?>%"></div>
                        </div>
                        <div class="d-flex align-items-center gap-6 mt-6">
                            <span class="text-sm text-gray-500">available only:</span>
                            <h6 class="text-danger-600 mb-0 text-md fw-semibold">$<?php echo $shortProducts['deal_of_week']['available']; ?></h6>
                        </div>
                        <a href="cart.php" class="product-card__cart btn bg-success-600 text-white hover-bg-success-700 hover-text-white py-11 px-24 rounded-pill flex-align gap-8 mt-16 w-100 justify-content-center">
                            Add To Cart <i class="ph ph-shopping-cart"></i> 
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ========================== Short Product Section End ============================== -->



