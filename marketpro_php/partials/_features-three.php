<?php
$features = [
    [
        'image' => '../assets/images/thumbs/features-three-img1.png',
        'title' => "Men's Fashion",
        'count' => 180,
        'bg_class' => 'bg-yellow-light'
    ],
    [
        'image' => '../assets/images/thumbs/features-three-img2.png',
        'title' => "Women's Fashion",
        'count' => 220,
        'bg_class' => 'bg-danger-light'
    ],
    [
        'image' => '../assets/images/thumbs/features-three-img3.png',
        'title' => "Kid’s Fashion",
        'count' => 205,
        'bg_class' => 'bg-purple-light'
    ],
    [
        'image' => '../assets/images/thumbs/features-three-img4.png',
        'title' => "Fashion Glass",
        'count' => 68,
        'bg_class' => 'bg-danger-light'
    ],
    [
        'image' => '../assets/images/thumbs/features-three-img5.png',
        'title' => "Shoes Collection",
        'count' => 190,
        'bg_class' => 'bg-warning-light'
    ],
    [
        'image' => '../assets/images/thumbs/features-three-img6.png',
        'title' => "Bag Collection",
        'count' => 128,
        'bg_class' => 'bg-success-light'
    ],
    [
        'image' => '../assets/images/thumbs/features-three-img3.png',
        'title' => "Men's Fashion",
        'count' => 180,
        'bg_class' => '' // no background class
    ]
];
?>
<!-- ============================ Feature Three Section start =============================== -->
<div class="feature feature-three mt-0 py-120 overflow-hidden" id="featureSection">
    <div class="container container-lg">
        <div class="section-heading text-center">
            <h5 class="mb-0 wow bounceIn text-uppercase">Popular Categories</h5>
        </div>
        <div class="position-relative arrow-center">
            <div class="flex-align">
                <button type="button" id="feature-item-wrapper-prev" class="slick-prev slick-arrow flex-center rounded-circle bg-white text-xl hover-bg-main-600 hover-text-white transition-1">
                    <i class="ph ph-caret-left"></i>
                </button>
                <button type="button" id="feature-item-wrapper-next" class="slick-next slick-arrow flex-center rounded-circle bg-white text-xl hover-bg-main-600 hover-text-white transition-1">
                    <i class="ph ph-caret-right"></i>
                </button>
            </div>
            <div class="feature-three-item-wrapper">
                <?php foreach ($features as $feature): ?>
                    <div class="feature-item text-center" data-aos="zoom-in" data-aos-duration="800">
                        <div class="feature-item__thumb <?= $feature['bg_class'] ?> max-w-260 max-h-260 rounded-circle w-100 h-100">
                            <a href="shop.php" class="w-100 h-100 flex-center">
                                <img src="<?= $feature['image'] ?>" alt="">
                            </a>
                        </div>
                        <div class="feature-item__content mt-20">
                            <h6 class="text-lg mb-8">
                                <a href="shop.php" class="text-inherit"><?= htmlspecialchars($feature['title']) ?></a>
                            </h6>
                            <span class="text-sm text-gray-900"><?= $feature['count'] ?> Items</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!-- ============================ Feature Three Section End =============================== -->