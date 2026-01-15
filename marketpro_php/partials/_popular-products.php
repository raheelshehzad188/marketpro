<?php
$products = [
    [
        'image' => '../assets/images/thumbs/popular-img1.png',
        'name' => 'Headphone & Earphone',
        'categories' => ['Wired Headphones', 'Over-Ear Headphone', 'Sports Headphone', 'Earbud Headphone'],
        'product_link' => 'product-details.php',
        'shop_link' => 'shop.php',
    ],
    [
        'image' => '../assets/images/thumbs/popular-img2.png',
        'name' => 'TV & Smart Home',
        'categories' => ['Wired Headphones', 'Over-Ear Headphone', 'Sports Headphone', 'Earbud Headphone'],
        'product_link' => 'product-details.php',
        'shop_link' => 'shop.php',
    ],
    [
        'image' => '../assets/images/thumbs/popular-img3.png',
        'name' => 'Video Games',
        'categories' => ['Wired Headphones', 'Over-Ear Headphone', 'Sports Headphone', 'Earbud Headphone'],
        'product_link' => 'product-details.php',
        'shop_link' => 'shop.php',
    ],
    [
        'image' => '../assets/images/thumbs/popular-img4.png',
        'name' => 'Computer & Tablets',
        'categories' => ['Wired Headphones', 'Over-Ear Headphone', 'Sports Headphone', 'Earbud Headphone'],
        'product_link' => 'product-details.php',
        'shop_link' => 'shop.php',
    ],
    [
        'image' => '../assets/images/thumbs/popular-img5.png',
        'name' => 'Car & Gps',
        'categories' => ['Wired Headphones', 'Over-Ear Headphone', 'Sports Headphone', 'Earbud Headphone'],
        'product_link' => 'product-details.php',
        'shop_link' => 'shop.php',
    ],
    [
        'image' => '../assets/images/thumbs/popular-img6.png',
        'name' => 'Camera & Video',
        'categories' => ['Wired Headphones', 'Over-Ear Headphone', 'Sports Headphone', 'Earbud Headphone'],
        'product_link' => 'product-details.php',
        'shop_link' => 'shop.php',
    ],
    [
        'image' => '../assets/images/thumbs/popular-img7.png',
        'name' => 'Kitchen Appliance',
        'categories' => ['Wired Headphones', 'Over-Ear Headphone', 'Sports Headphone', 'Earbud Headphone'],
        'product_link' => 'product-details.php',
        'shop_link' => 'shop.php',
    ],
    [
        'image' => '../assets/images/thumbs/popular-img8.png',
        'name' => 'Phone & Accessories',
        'categories' => ['Wired Headphones', 'Over-Ear Headphone', 'Sports Headphone', 'Earbud Headphone'],
        'product_link' => 'product-details.php',
        'shop_link' => 'shop.php',
    ],
    // Add more products here...
];
?>
<!-- ========================= Popular Products Start ================================ -->
<section class="popular-products mb-80 overflow-hidden">
    <div class="container container-lg">
        <div class="row gy-4">
            <?php
            foreach ($products as $product) {
            ?>
                <div class="col-xxl-3 col-xl-4 col-sm-6 col-xs-6 wow bounceIn">
                    <div class="product-card h-100 d-flex gap-16 p-16 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
                        <a href="<?= $product['product_link'] ?>" class="product-card__thumb flex-center h-unset rounded-8 bg-gray-50 position-relative w-unset flex-shrink-0 p-24" tabindex="0">
                            <img src="<?= $product['image'] ?>" alt="" class="w-auto max-w-unset">
                        </a>
                        <div class="product-card__content flex-grow-1">
                            <h6 class="title text-lg fw-semibold mb-12">
                                <a href="<?= $product['product_link'] ?>" class="link text-line-2" tabindex="0"><?= $product['name'] ?></a>
                            </h6>
                            <?php foreach ($product['categories'] as $category) { ?>
                                <span class="text-gray-600 text-sm mb-4"><?= $category ?></span>
                            <?php } ?>
                            <a href="<?= $product['shop_link'] ?>" class="text-tertiary-600 flex-align gap-8 mt-24">
                                All Categories
                                <i class="ph ph-arrow-right d-flex"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<!-- ========================= Popular Products End ================================ -->