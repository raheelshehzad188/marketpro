<?php
// Similar Products Data Array
$similarProducts = [
    'title' => 'You Might Also Like',
    'all_products_link' => 'shop.php',
    'items' => [
        [
            'image' => '../assets/images/thumbs/product-img7.png',
            'title' => 'C-500 Antioxidant Protect Dietary Supplement',
            'store' => 'Lucky Supermarket',
            'price' => '14.99',
            'original_price' => '28.99',
            'rating' => '4.8',
            'reviews' => '17k',
            'badge' => null
        ],
        [
            'image' => '../assets/images/thumbs/product-img8.png',
            'title' => 'Marcel\'s Modern Pantry Almond Unsweetened',
            'store' => 'Lucky Supermarket',
            'price' => '14.99',
            'original_price' => '28.99',
            'rating' => '4.8',
            'reviews' => '17k',
            'badge' => [
                'text' => 'Sale 50%',
                'class' => 'bg-danger-600'
            ]
        ],
        [
            'image' => '../assets/images/thumbs/product-img9.png',
            'title' => 'O Organics Milk, Whole, Vitamin D',
            'store' => 'Lucky Supermarket',
            'price' => '14.99',
            'original_price' => '28.99',
            'rating' => '4.8',
            'reviews' => '17k',
            'badge' => [
                'text' => 'Sale 50%',
                'class' => 'bg-danger-600'
            ]
        ],
        [
            'image' => '../assets/images/thumbs/product-img10.png',
            'title' => 'Whole Grains and Seeds Organic Bread',
            'store' => 'Lucky Supermarket',
            'price' => '14.99',
            'original_price' => '28.99',
            'rating' => '4.8',
            'reviews' => '17k',
            'badge' => [
                'text' => 'Best Sale',
                'class' => 'bg-info-600'
            ]
        ],
        [
            'image' => '../assets/images/thumbs/product-img11.png',
            'title' => 'Lucerne Yogurt, Lowfat, Strawberry',
            'store' => 'Lucky Supermarket',
            'price' => '14.99',
            'original_price' => '28.99',
            'rating' => '4.8',
            'reviews' => '17k',
            'badge' => null
        ],
        [
            'image' => '../assets/images/thumbs/product-img12.png',
            'title' => 'Nature Valley Whole Grain Oats and Honey Protein',
            'store' => 'Lucky Supermarket',
            'price' => '14.99',
            'original_price' => '28.99',
            'rating' => '4.8',
            'reviews' => '17k',
            'badge' => [
                'text' => 'Sale 50%',
                'class' => 'bg-danger-600'
            ]
        ],
        [
            'image' => '../assets/images/thumbs/product-img10.png',
            'title' => 'Whole Grains and Seeds Organic Bread',
            'store' => 'Lucky Supermarket',
            'price' => '14.99',
            'original_price' => '28.99',
            'rating' => '4.8',
            'reviews' => '17k',
            'badge' => [
                'text' => 'Best Sale',
                'class' => 'bg-info-600'
            ]
        ]
    ]
];
?>

<!-- ========================== Similar Product Start ============================= -->
<section class="new-arrival pb-80">
    <div class="container container-lg">
        <div class="section-heading">
            <div class="flex-between flex-wrap gap-8">
                <h5 class="mb-0"><?php echo $similarProducts['title']; ?></h5>
                <div class="flex-align gap-16">
                    <a href="<?php echo $similarProducts['all_products_link']; ?>" class="text-sm fw-medium text-gray-700 hover-text-main-600 hover-text-decoration-underline">All Products</a>
                    <div class="flex-align gap-8">
                        <button type="button" id="new-arrival-prev" class="slick-prev slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1" >
                            <i class="ph ph-caret-left"></i>
                        </button>
                        <button type="button" id="new-arrival-next" class="slick-next slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1" >
                            <i class="ph ph-caret-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="new-arrival__slider arrow-style-two">
            <?php foreach($similarProducts['items'] as $product): ?>
            <div>
                <div class="product-card h-100 p-8 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
                    <?php if($product['badge']): ?>
                    <span class="product-card__badge <?php echo $product['badge']['class']; ?> px-8 py-4 text-sm text-white"><?php echo $product['badge']['text']; ?></span>
                    <?php endif; ?>
                    <a href="product-details.php" class="product-card__thumb flex-center overflow-hidden">
                        <img src="<?php echo $product['image']; ?>" alt="">
                    </a>
                    <div class="product-card__content p-sm-2 w-100">
                        <h6 class="title text-lg fw-semibold mt-12 mb-8">
                            <a href="product-details.php" class="link text-line-2"><?php echo $product['title']; ?></a>
                        </h6>   
                        <div class="flex-align gap-4">
                            <span class="text-main-600 text-md d-flex"><i class="ph-fill ph-storefront"></i></span>
                            <span class="text-gray-500 text-xs">By <?php echo $product['store']; ?></span>
                        </div>

                        <div class="product-card__content mt-12">
                            <div class="product-card__price mb-8">
                                <span class="text-heading text-md fw-semibold ">$<?php echo $product['price']; ?> <span class="text-gray-500 fw-normal">/Qty</span> </span>
                                <span class="text-gray-400 text-md fw-semibold text-decoration-line-through"> $<?php echo $product['original_price']; ?></span>
                            </div>
                            <div class="flex-align gap-6">
                                <span class="text-xs fw-bold text-gray-600"><?php echo $product['rating']; ?></span>
                                <span class="text-15 fw-bold text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                <span class="text-xs fw-bold text-gray-600">(<?php echo $product['reviews']; ?>)</span>
                            </div>
                             <a href="cart.php" class="product-card__cart btn bg-main-50 text-main-600 hover-bg-main-600 hover-text-white py-11 px-24 rounded-pill flex-align gap-8 mt-24 w-100 justify-content-center">
                                Add To Cart <i class="ph ph-shopping-cart"></i> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
 </section>
<!-- ========================== Similar Product End ============================= -->