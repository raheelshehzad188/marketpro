<?php
// ==================
// Page Variables
// ==================
$htmlClass = '';
$breadcrumbClass = 'bg-main-50';
$pageTitle = "Vendor List";
$pageText = "Vendor List";
$section_margin =  'mb-24';
$itemClass = 'bg-main-50';
$iconClass = 'bg-main-600';

// Product Categories
$productCategories = [
    ['name' => 'Mobile & Accessories', 'count' => 12],
    ['name' => 'Laptop', 'count' => 12],
    ['name' => 'Electronics', 'count' => 12],
    ['name' => 'Smart Watch', 'count' => 12],
    ['name' => 'Storage', 'count' => 12],
    ['name' => 'Portable Devices', 'count' => 12],
    ['name' => 'Action Camera', 'count' => 12],
    ['name' => 'Smart Gadget', 'count' => 12],
    ['name' => 'Monitor', 'count' => 12],
    ['name' => 'Smart TV', 'count' => 12],
    ['name' => 'Camera', 'count' => 12],
    ['name' => 'Monitor Stand', 'count' => 12],
    ['name' => 'Headphone', 'count' => 12]
];

// Vendor Info
$vendorInfo = [
    'logo' => 'assets/images/thumbs/vendor-logo2.png',
    'name' => 'Safeway',
    'address' => 'New Street, 520, New York',
    'since' => '2009',
    'description' => "It's easy and free to link or sign up for our loyalty program, and it only takes a few seconds.",
    'social_links' => [
        ['icon' => 'ph-fill ph-facebook-logo', 'url' => 'https://www.facebook.com'],
        ['icon' => 'ph-fill ph-twitter-logo', 'url' => 'https://www.twitter.com'],
        ['icon' => 'ph-fill ph-instagram-logo', 'url' => 'https://www.linkedin.com'],
        ['icon' => 'ph-fill ph-linkedin-logo', 'url' => 'https://www.pinterest.com']
    ]
];

// Products Data
$products = [
    [
        'image' => 'assets/images/thumbs/product-img7.png',
        'badge' => null,
        'badge_class' => null,
        'title' => 'C-500 Antioxidant Protect Dietary Supplement',
        'vendor' => 'Lucky Supermarket',
        'price' => '14.99',
        'original_price' => '28.99',
        'rating' => '4.8',
        'reviews' => '17k',
        'aos_duration' => '200'
    ],
    [
        'image' => 'assets/images/thumbs/product-img8.png',
        'badge' => 'Sale 50%',
        'badge_class' => 'bg-danger-600',
        'title' => "Marcel's Modern Pantry Almond Unsweetened",
        'vendor' => 'Lucky Supermarket',
        'price' => '14.99',
        'original_price' => '28.99',
        'rating' => '4.8',
        'reviews' => '17k',
        'aos_duration' => '400'
    ],
    [
        'image' => 'assets/images/thumbs/product-img9.png',
        'badge' => 'Sale 50%',
        'badge_class' => 'bg-danger-600',
        'title' => 'O Organics Milk, Whole, Vitamin D',
        'vendor' => 'Lucky Supermarket',
        'price' => '14.99',
        'original_price' => '28.99',
        'rating' => '4.8',
        'reviews' => '17k',
        'aos_duration' => '600'
    ],
    [
        'image' => 'assets/images/thumbs/product-img10.png',
        'badge' => 'Best Sale',
        'badge_class' => 'bg-info-600',
        'title' => 'Whole Grains and Seeds Organic Bread',
        'vendor' => 'Lucky Supermarket',
        'price' => '14.99',
        'original_price' => '28.99',
        'rating' => '4.8',
        'reviews' => '17k',
        'aos_duration' => '800'
    ],
    [
        'image' => 'assets/images/thumbs/product-img11.png',
        'badge' => null,
        'badge_class' => null,
        'title' => 'C-500 Antioxidant Protect Dietary Supplement',
        'vendor' => 'Lucky Supermarket',
        'price' => '14.99',
        'original_price' => '28.99',
        'rating' => '4.8',
        'reviews' => '17k',
        'aos_duration' => '200'
    ],
    [
        'image' => 'assets/images/thumbs/product-img12.png',
        'badge' => 'Sale 50%',
        'badge_class' => 'bg-danger-600',
        'title' => "Marcel's Modern Pantry Almond Unsweetened",
        'vendor' => 'Lucky Supermarket',
        'price' => '14.99',
        'original_price' => '28.99',
        'rating' => '4.8',
        'reviews' => '17k',
        'aos_duration' => '400'
    ],
    [
        'image' => 'assets/images/thumbs/product-img13.png',
        'badge' => 'Sale 50%',
        'badge_class' => 'bg-danger-600',
        'title' => 'O Organics Milk, Whole, Vitamin D',
        'vendor' => 'Lucky Supermarket',
        'price' => '14.99',
        'original_price' => '28.99',
        'rating' => '4.8',
        'reviews' => '17k',
        'aos_duration' => '600'
    ],
    [
        'image' => 'assets/images/thumbs/product-img14.png',
        'badge' => 'Best Sale',
        'badge_class' => 'bg-info-600',
        'title' => 'Whole Grains and Seeds Organic Bread',
        'vendor' => 'Lucky Supermarket',
        'price' => '14.99',
        'original_price' => '28.99',
        'rating' => '4.8',
        'reviews' => '17k',
        'aos_duration' => '800'
    ],
    [
        'image' => 'assets/images/thumbs/product-img15.png',
        'badge' => null,
        'badge_class' => null,
        'title' => 'C-500 Antioxidant Protect Dietary Supplement',
        'vendor' => 'Lucky Supermarket',
        'price' => '14.99',
        'original_price' => '28.99',
        'rating' => '4.8',
        'reviews' => '17k',
        'aos_duration' => '200'
    ],
    [
        'image' => 'assets/images/thumbs/product-img16.png',
        'badge' => 'Sale 50%',
        'badge_class' => 'bg-danger-600',
        'title' => "Marcel's Modern Pantry Almond Unsweetened",
        'vendor' => 'Lucky Supermarket',
        'price' => '14.99',
        'original_price' => '28.99',
        'rating' => '4.8',
        'reviews' => '17k',
        'aos_duration' => '400'
    ],
    [
        'image' => 'assets/images/thumbs/product-img17.png',
        'badge' => 'Sale 50%',
        'badge_class' => 'bg-danger-600',
        'title' => 'O Organics Milk, Whole, Vitamin D',
        'vendor' => 'Lucky Supermarket',
        'price' => '14.99',
        'original_price' => '28.99',
        'rating' => '4.8',
        'reviews' => '17k',
        'aos_duration' => '600'
    ],
    [
        'image' => 'assets/images/thumbs/product-img18.png',
        'badge' => 'Best Sale',
        'badge_class' => 'bg-info-600',
        'title' => 'Whole Grains and Seeds Organic Bread',
        'vendor' => 'Lucky Supermarket',
        'price' => '14.99',
        'original_price' => '28.99',
        'rating' => '4.8',
        'reviews' => '17k',
        'aos_duration' => '800'
    ],
    [
        'image' => 'assets/images/thumbs/product-img19.png',
        'badge' => null,
        'badge_class' => null,
        'title' => 'C-500 Antioxidant Protect Dietary Supplement',
        'vendor' => 'Lucky Supermarket',
        'price' => '14.99',
        'original_price' => '28.99',
        'rating' => '4.8',
        'reviews' => '17k',
        'aos_duration' => '200'
    ],
    [
        'image' => 'assets/images/thumbs/product-img5.png',
        'badge' => 'Sale 50%',
        'badge_class' => 'bg-danger-600',
        'title' => "Marcel's Modern Pantry Almond Unsweetened",
        'vendor' => 'Lucky Supermarket',
        'price' => '14.99',
        'original_price' => '28.99',
        'rating' => '4.8',
        'reviews' => '17k',
        'aos_duration' => '400'
    ],
    [
        'image' => 'assets/images/thumbs/product-img9.png',
        'badge' => 'Sale 50%',
        'badge_class' => 'bg-danger-600',
        'title' => 'O Organics Milk, Whole, Vitamin D',
        'vendor' => 'Lucky Supermarket',
        'price' => '14.99',
        'original_price' => '28.99',
        'rating' => '4.8',
        'reviews' => '17k',
        'aos_duration' => '600'
    ],
    [
        'image' => 'assets/images/thumbs/product-img15.png',
        'badge' => null,
        'badge_class' => null,
        'title' => 'C-500 Antioxidant Protect Dietary Supplement',
        'vendor' => 'Lucky Supermarket',
        'price' => '14.99',
        'original_price' => '28.99',
        'rating' => '4.8',
        'reviews' => '17k',
        'aos_duration' => '200'
    ],
    [
        'image' => 'assets/images/thumbs/product-img16.png',
        'badge' => 'Sale 50%',
        'badge_class' => 'bg-danger-600',
        'title' => "Marcel's Modern Pantry Almond Unsweetened",
        'vendor' => 'Lucky Supermarket',
        'price' => '14.99',
        'original_price' => '28.99',
        'rating' => '4.8',
        'reviews' => '17k',
        'aos_duration' => '400'
    ],
    [
        'image' => 'assets/images/thumbs/product-img17.png',
        'badge' => 'Sale 50%',
        'badge_class' => 'bg-danger-600',
        'title' => 'O Organics Milk, Whole, Vitamin D',
        'vendor' => 'Lucky Supermarket',
        'price' => '14.99',
        'original_price' => '28.99',
        'rating' => '4.8',
        'reviews' => '17k',
        'aos_duration' => '600'
    ],
    [
        'image' => 'assets/images/thumbs/product-img18.png',
        'badge' => 'Best Sale',
        'badge_class' => 'bg-info-600',
        'title' => 'Whole Grains and Seeds Organic Bread',
        'vendor' => 'Lucky Supermarket',
        'price' => '14.99',
        'original_price' => '28.99',
        'rating' => '4.8',
        'reviews' => '17k',
        'aos_duration' => '800'
    ],
    [
        'image' => 'assets/images/thumbs/product-img20.png',
        'badge' => 'New',
        'badge_class' => 'bg-warning-600',
        'title' => 'Whole Grains and Seeds Organic Bread',
        'vendor' => 'Lucky Supermarket',
        'price' => '14.99',
        'original_price' => '28.99',
        'rating' => '4.8',
        'reviews' => '17k',
        'aos_duration' => '800'
    ],
];

// ==================
// Include Partials
// ==================
include 'partials/_template-top.php';
include 'partials/_header-top.php';
include 'partials/_header-middle.php';
include 'partials/_header.php';
include 'partials/_breadcrumb-two.php';
?>

<!-- =================================== Vendors List section start ===================================== -->
<section class="vendors-list py-80">
    <div class="container container-lg">
        <div class="row gy-4">
            <div class="col-xxl-2 col-xl-3 col-lg-4">
                <div class="shop-sidebar">
                    <button type="button" class="shop-sidebar__close d-lg-none d-flex w-32 h-32 flex-center border border-gray-100 rounded-circle hover-bg-main-600 position-absolute inset-inline-end-0 me-10 mt-8 hover-text-white hover-border-main-600">
                        <i class="ph ph-x"></i>
                    </button>
                    <div class="d-flex flex-column gap-12 px-lg-0 px-16 py-lg-0 py-24">
                        <div class="vendor-card style-two text-center px-16 pb-24 bg-main-50">
                            <img src="<?php echo $vendorInfo['logo']; ?>" alt="" class="vendor-card__logo m-12">
                            <h6 class="title mt-32"><?php echo $vendorInfo['name']; ?></h6>
                            <span class="text-neutral-600 text-sm d-block fw-semibold"><?php echo $vendorInfo['address']; ?></span>
                            <span class="bg-white text-neutral-900 rounded-pill py-6 px-16 text-12 mt-8">Since <?php echo $vendorInfo['since']; ?></span>
                            <p class="text-neutral-600 my-24"><?php echo $vendorInfo['description']; ?></p>
                            <ul class="flex-center gap-8 flex-wrap">
                                <?php foreach($vendorInfo['social_links'] as $social): ?>
                                <li>
                                    <a href="<?php echo $social['url']; ?>" class="w-36 h-36 flex-center bg-white text-main-600 text-lg rounded-circle hover-bg-main-600 hover-text-white">
                                        <i class="<?php echo $social['icon']; ?>"></i>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <a href="contact.php" class="btn btn-main rounded-pill py-16 px-32 mt-28 w-100">Contact Seller</a>
                        </div>
                        <div class="border border-gray-50 rounded-8 p-24">
                            <h6 class="text-xl border-bottom border-gray-100 pb-24 mb-24">Product Category</h6>
                            <ul class="max-h-326 overflow-y-auto scroll-sm">
                                <?php foreach($productCategories as $index => $category): ?>
                                <li class="<?php echo $index === count($productCategories) - 1 ? 'mb-0' : 'mb-24'; ?>">
                                    <a href="product-details-two.php" class="text-gray-900 hover-text-main-600"><?php echo $category['name']; ?> (<?php echo $category['count']; ?>)</a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="border border-gray-50 rounded-8 p-24">
                            <h6 class="text-xl border-bottom border-gray-100 pb-24 mb-24">Filter by Price</h6>
                            <div class="custom--range">
                                <div id="slider-range"></div>
                                <div class="flex-between flex-wrap-reverse gap-8 mt-24 ">
                                    <button type="button" class="btn btn-main h-40 flex-align">Filter </button>
                                    <div class="custom--range__content flex-align gap-8">
                                        <span class="text-gray-500 text-md flex-shrink-0">Price:</span>
                                        <input type="text" class="custom--range__prices text-neutral-600 text-start text-md fw-medium" id="amount" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border border-gray-50 rounded-8 p-24">
                            <h6 class="text-xl border-bottom border-gray-100 pb-24 mb-24">Filter by Rating</h6>
                            <div class="flex-align gap-8 position-relative mb-20">
                                <label class="position-absolute w-100 h-100 cursor-pointer" for="rating5"> </label>
                                <div class="common-check common-radio mb-0">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="rating5">
                                </div>
                                <div class="flex-align gap-4">
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                </div>
                                <span class="text-gray-900 flex-shrink-0">124</span>
                            </div>
                            <div class="flex-align gap-8 position-relative mb-20">
                                <label class="position-absolute w-100 h-100 cursor-pointer" for="rating4"> </label>
                                <div class="common-check common-radio mb-0">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="rating4">
                                </div>
                                <div class="flex-align gap-4">
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-400 d-flex"><i class="ph-fill ph-star"></i></span>
                                </div>
                                <span class="text-gray-900 flex-shrink-0">52</span>
                            </div>
                            <div class="flex-align gap-8 position-relative mb-20">
                                <label class="position-absolute w-100 h-100 cursor-pointer" for="rating3"> </label>
                                <div class="common-check common-radio mb-0">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="rating3">
                                </div>
                                <div class="flex-align gap-4">
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-400 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-400 d-flex"><i class="ph-fill ph-star"></i></span>
                                </div>
                                <span class="text-gray-900 flex-shrink-0">12</span>
                            </div>
                            <div class="flex-align gap-8 position-relative mb-20">
                                <label class="position-absolute w-100 h-100 cursor-pointer" for="rating2"> </label>
                                <div class="common-check common-radio mb-0">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="rating2">
                                </div>
                                <div class="flex-align gap-4">
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-400 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-400 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-400 d-flex"><i class="ph-fill ph-star"></i></span>
                                </div>
                                <span class="text-gray-900 flex-shrink-0">5</span>
                            </div>
                            <div class="flex-align gap-8 position-relative mb-0">
                                <label class="position-absolute w-100 h-100 cursor-pointer" for="rating1"> </label>
                                <div class="common-check common-radio mb-0">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="rating1">
                                </div>
                                <div class="flex-align gap-4">
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-400 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-400 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-400 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-400 d-flex"><i class="ph-fill ph-star"></i></span>
                                </div>
                                <span class="text-gray-900 flex-shrink-0">2</span>
                            </div>
                        </div>
                        <div class="bg-main-50 rounded-8 p-16 text-center">
                            <span class="text-2xl text-neutral-600 mb-8">Fresh Vegetables</span>
                            <h5 class="text-32 text-main-600">Up to 25% Off</h5>
                            <div class="mt-52">
                                <img src="assets/images/thumbs/advertiser-img.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-10 col-xl-9 col-lg-8">
                <!-- Top Search -->
                <div class="flex-between flex-wrap gap-8 mb-40">
                    <form action="#" class="search-form__wrapper position-relative d-block">
                        <input type="text" class="search-form__input common-input py-13 ps-16 pe-18 rounded-pill pe-44" placeholder="Search vendors by name or ID...">
                        <button type="submit" class="w-32 h-32 bg-main-600 rounded-circle flex-center text-xl text-white position-absolute top-50 translate-middle-y inset-inline-end-0 me-8"><i class="ph ph-magnifying-glass"></i></button>
                    </form>
                    <div class="flex-align gap-16">
                        <span class="text-neutral-600 fw-medium px-40 py-12 rounded-pill border border-neutral-100 d-md-block d-none">Showing 1-20 of 85 results</span>
                        <div class="flex-align gap-8">
                            <span class="text-gray-900 flex-shrink-0">Sort by:</span>
                            <select class="common-input form-select rounded-pill border border-gray-100 d-inline-block ps-20 pe-36 h-48 py-0 fw-medium">
                                <option value="1">Latest</option>
                                <option value="1">Old</option>
                            </select>
                        </div>
                        <button type="button" class="w-44 h-44 d-lg-none d-flex flex-center border border-gray-100 rounded-6 text-2xl sidebar-btn">
                            <i class="ph-bold ph-funnel"></i>
                        </button>
                    </div>
                </div>
                <!-- Top Search End -->

                <!-- Products Start -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 g-12">
                    <?php foreach($products as $product): ?>
                    <div class="col" data-aos="fade-up" data-aos-duration="<?php echo $product['aos_duration']; ?>">
                        <div class="product-card h-100 p-8 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
                            <?php if($product['badge']): ?>
                            <span class="product-card__badge <?php echo $product['badge_class']; ?> px-8 py-4 text-sm text-white"><?php echo $product['badge']; ?></span>
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
                                    <span class="text-gray-500 text-xs">By <?php echo $product['vendor']; ?></span>
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
                <!-- Products End -->

                <!-- Pagination Start -->
                <ul class="pagination flex-center flex-wrap gap-16">
                    <li class="page-item">
                        <a class="page-link h-64 w-64 flex-center text-xxl rounded-circle fw-medium text-neutral-600 border border-gray-100" href="#">
                            <i class="ph-bold ph-arrow-left"></i>
                        </a>
                    </li>
                    <?php for($i = 1; $i <= 7; $i++): ?>
                    <li class="page-item <?php echo $i === 1 ? 'active' : ''; ?>">
                        <a class="page-link h-64 w-64 flex-center text-md rounded-circle fw-medium text-neutral-600 border border-gray-100" href="#"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></a>
                    </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link h-64 w-64 flex-center text-xxl rounded-circle fw-medium text-neutral-600 border border-gray-100" href="#">
                            <i class="ph-bold ph-arrow-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- Pagination End -->

            </div>
        </div>
    </div>
</section>
<!-- =================================== Vendors List section End ===================================== -->

<?php
include 'partials/_shipping.php';
include 'partials/_newsletter.php';
include 'partials/_footer.php';
include 'partials/_template-bottom.php';
?>

</body>

</html>