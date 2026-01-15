<?php
// ==================
// Page Variables
// ==================
$htmlClass = '';
$breadcrumbClass = 'bg-main-50';
$pageTitle = "Shop";
$pageText = "Vendor List";
$section_margin =  'mb-24';
$itemClass = 'bg-main-50';
$iconClass = 'bg-main-600';

// Vendors Data
$vendors = [
    [
        'logo' => 'assets/images/thumbs/vendor-logo1.png',
        'name' => 'Organic Market',
        'delivery_time' => 'Delivery by 6:15am',
        'offer' => '$5 off Snack & Candy',
        'aos_duration' => '200'
    ],
    [
        'logo' => 'assets/images/thumbs/vendor-logo2.png',
        'name' => 'Safeway',
        'delivery_time' => 'Delivery by 6:15am',
        'offer' => '$5 off Snack & Candy',
        'aos_duration' => '400'
    ],
    [
        'logo' => 'assets/images/thumbs/vendor-logo3.png',
        'name' => 'Food Max',
        'delivery_time' => 'Delivery by 6:15am',
        'offer' => '$5 off Snack & Candy',
        'aos_duration' => '600'
    ],
    [
        'logo' => 'assets/images/thumbs/vendor-logo4.png',
        'name' => 'HRmart',
        'delivery_time' => 'Delivery by 6:15am',
        'offer' => '$5 off Snack & Candy',
        'aos_duration' => '800'
    ],
    [
        'logo' => 'assets/images/thumbs/vendor-logo5.png',
        'name' => 'Lucky Supermarket',
        'delivery_time' => 'Delivery by 6:15am',
        'offer' => '$5 off Snack & Candy',
        'aos_duration' => '200'
    ],
    [
        'logo' => 'assets/images/thumbs/vendor-logo6.png',
        'name' => 'Arico Farmer',
        'delivery_time' => 'Delivery by 6:15am',
        'offer' => '$5 off Snack & Candy',
        'aos_duration' => '400'
    ],
    [
        'logo' => 'assets/images/thumbs/vendor-logo7.png',
        'name' => 'Farmer Market',
        'delivery_time' => 'Delivery by 6:15am',
        'offer' => '$5 off Snack & Candy',
        'aos_duration' => '600'
    ],
    [
        'logo' => 'assets/images/thumbs/vendor-logo8.png',
        'name' => 'Foodsco',
        'delivery_time' => 'Delivery by 6:15am',
        'offer' => '$5 off Snack & Candy',
        'aos_duration' => '800'
    ],
    [
        'logo' => 'assets/images/thumbs/vendor-logo1.png',
        'name' => 'Organic Market',
        'delivery_time' => 'Delivery by 6:15am',
        'offer' => '$5 off Snack & Candy',
        'aos_duration' => '200'
    ],
    [
        'logo' => 'assets/images/thumbs/vendor-logo2.png',
        'name' => 'Safeway',
        'delivery_time' => 'Delivery by 6:15am',
        'offer' => '$5 off Snack & Candy',
        'aos_duration' => '400'
    ],
    [
        'logo' => 'assets/images/thumbs/vendor-logo3.png',
        'name' => 'Food Max',
        'delivery_time' => 'Delivery by 6:15am',
        'offer' => '$5 off Snack & Candy',
        'aos_duration' => '600'
    ],
    [
        'logo' => 'assets/images/thumbs/vendor-logo4.png',
        'name' => 'HRmart',
        'delivery_time' => 'Delivery by 6:15am',
        'offer' => '$5 off Snack & Candy',
        'aos_duration' => '800'
    ],
];

// Vendor Product Images
$vendorProducts = [
    'assets/images/thumbs/vendor-img1.png',
    'assets/images/thumbs/vendor-img2.png',
    'assets/images/thumbs/vendor-img3.png',
    'assets/images/thumbs/vendor-img4.png',
    'assets/images/thumbs/vendor-img5.png'
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
        <div class="flex-between flex-wrap gap-8 mb-40">
            <span class="text-neutral-600 fw-medium px-40 py-12 rounded-pill border border-neutral-100">Showing 1-20 of 85 results</span>

            <div class="flex-align gap-16">
                <form action="#" class="search-form__wrapper position-relative d-block">
                    <input type="text" class="search-form__input common-input py-13 ps-16 pe-18 rounded-pill pe-44" placeholder="Search vendors by name or ID...">
                    <button type="submit" class="w-32 h-32 bg-main-600 rounded-circle flex-center text-xl text-white position-absolute top-50 translate-middle-y inset-inline-end-0 me-8"><i class="ph ph-magnifying-glass"></i></button>
                </form>
                <div class="flex-align gap-8">
                    <span class="text-gray-900 flex-shrink-0">Sort by:</span>
                    <select class="common-input form-select rounded-pill border border-gray-100 d-inline-block ps-20 pe-36 h-48 py-0 fw-medium">
                        <option value="1">Latest</option>
                        <option value="1">Old</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row gy-4 vendor-card-wrapper">
            <?php foreach($vendors as $vendor): ?>
            <div class="col-xxl-3 col-lg-4 col-sm-6" data-aos="zoom-in" data-aos-duration="<?php echo $vendor['aos_duration']; ?>">
                <div class="vendor-card text-center px-16 pb-24">
                    <div class="">
                        <img src="<?php echo $vendor['logo']; ?>" alt="" class="vendor-card__logo m-12">
                        <h6 class="title mt-32">
                            <a href="vendor-details.php" class=""><?php echo $vendor['name']; ?></a>
                        </h6>
                        <span class="text-heading text-sm d-block"><?php echo $vendor['delivery_time']; ?></span>
                        <a href="shop.php" class="bg-white text-neutral-600 hover-bg-main-600 hover-text-white rounded-pill py-6 px-16 text-12 mt-8"><?php echo $vendor['offer']; ?></a>
                    </div>
                    <div class="vendor-card__list mt-22 flex-center flex-wrap gap-8">
                        <?php foreach($vendorProducts as $product): ?>
                        <div class="vendor-card__item bg-white rounded-circle flex-center">
                            <img src="<?php echo $product; ?>" alt="">
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

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