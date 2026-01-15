<?php
$vendors = [
    [
        'logo' => '../assets/images/thumbs/vendor-logo1.png',
        'name' => 'Organic Market',
        'delivery_time' => '6:15am',
        'offer' => '$5 off Snack & Candy',
        'animation_duration' => '200'
    ],
    [
        'logo' => '../assets/images/thumbs/vendor-logo2.png',
        'name' => 'Safeway',
        'delivery_time' => '6:15am',
        'offer' => '$5 off Snack & Candy',
        'animation_duration' => '400'
    ],
    [
        'logo' => '../assets/images/thumbs/vendor-logo3.png',
        'name' => 'Food Max',
        'delivery_time' => '6:15am',
        'offer' => '$5 off Snack & Candy',
        'animation_duration' => '600'
    ],
    [
        'logo' => '../assets/images/thumbs/vendor-logo4.png',
        'name' => 'HRmart',
        'delivery_time' => '6:15am',
        'offer' => '$5 off Snack & Candy',
        'animation_duration' => '800'
    ],
    [
        'logo' => '../assets/images/thumbs/vendor-logo5.png',
        'name' => 'Lucky Supermarket',
        'delivery_time' => '6:15am',
        'offer' => '$5 off Snack & Candy',
        'animation_duration' => '200'
    ],
    [
        'logo' => '../assets/images/thumbs/vendor-logo6.png',
        'name' => 'Arico Farmer',
        'delivery_time' => '6:15am',
        'offer' => '$5 off Snack & Candy',
        'animation_duration' => '400'
    ],
    [
        'logo' => '../assets/images/thumbs/vendor-logo7.png',
        'name' => 'Farmer Market',
        'delivery_time' => '6:15am',
        'offer' => '$5 off Snack & Candy',
        'animation_duration' => '600'
    ],
    [
        'logo' => '../assets/images/thumbs/vendor-logo8.png',
        'name' => 'Foodsco',
        'delivery_time' => '6:15am',
        'offer' => '$5 off Snack & Candy',
        'animation_duration' => '800'
    ]
];

$vendorItems = [
    '../assets/images/thumbs/vendor-img1.png',
    '../assets/images/thumbs/vendor-img2.png',
    '../assets/images/thumbs/vendor-img3.png',
    '../assets/images/thumbs/vendor-img4.png',
    '../assets/images/thumbs/vendor-img5.png'
];
?>
<!-- ============================== Top Vendors Section Start ================================= -->
<section class="top-vendors py-80">
    <div class="container container-lg">
        <div class="section-heading">
            <div class="flex-between flex-wrap gap-8">
                <h5 class="mb-0">Weekly Top Vendors</h5>
                <a href="shop.php" class="text-sm fw-medium text-gray-700 hover-text-main-600 hover-text-decoration-underline">All Vendors</a>
            </div>
        </div>

        <div class="row gy-4 vendor-card-wrapper">
            <?php foreach($vendors as $vendor): ?>
            <div class="col-xxl-3 col-lg-4 col-sm-6" data-aos="zoom-in" data-aos-duration="<?php echo $vendor['animation_duration']; ?>">
                <div class="vendor-card text-center px-16 pb-24">
                    <div class="">
                        <img src="<?php echo $vendor['logo']; ?>" alt="" class="vendor-card__logo m-12">
                        <h6 class="title mt-32"><?php echo $vendor['name']; ?></h6>
                        <span class="text-heading text-sm d-block">Delivery by <?php echo $vendor['delivery_time']; ?></span>
                        <a href="shop.php" class="btn btn-main-two rounded-pill py-6 px-16 text-12 mt-8"><?php echo $vendor['offer']; ?></a>
                    </div>
                    <div class="vendor-card__list mt-22 flex-center flex-wrap gap-8">
                        <?php foreach($vendorItems as $item): ?>
                        <div class="vendor-card__item bg-white rounded-circle flex-center">
                            <img src="<?php echo $item; ?>" alt="">
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- ============================== Top Vendors Section End ================================= -->