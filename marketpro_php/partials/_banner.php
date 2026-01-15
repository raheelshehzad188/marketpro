<!-- ============================ Banner Section start =============================== -->
<?php
$banners = [
    [
        "title" => "Daily Grocery Order and Get <span class='text-main-600'>Express</span> Delivery",
        "subtitle" => "Save up to 50% off on your first order",
        "img" => "../assets/images/thumbs/banner-img3.png",
        "price" => "$60.99"
    ],
    [
        "title" => "Daily Grocery Order and Get <span class='text-main-600'>Express</span> Delivery",
        "subtitle" => "Save up to 50% off on your first order",
        "img" => "../assets/images/thumbs/banner-img1.png",
        "price" => "$60.99"
    ]
];
?>

<div class="banner">
    <div class="container container-lg">
        <div class="banner-item rounded-24 overflow-hidden position-relative arrow-center">
            <a href="#featureSection" class="scroll-down w-84 h-84 text-center flex-center bg-main-600 rounded-circle border border-5 text-white border-white position-absolute start-50 translate-middle-x bottom-0 hover-bg-main-800">
                <span class="icon line-height-0"><i class="ph ph-caret-double-down"></i></span>
            </a>
            <img src="../assets/images/bg/banner-bg.png" alt="" class="banner-img position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 z-n1 object-fit-cover rounded-24">

            <div class="flex-align">
                <button type="button" id="banner-prev" class="slick-prev slick-arrow flex-center rounded-circle box-shadow-4xl bg-white text-xl hover-bg-main-600 hover-text-white transition-1">
                    <i class="ph ph-caret-left"></i>
                </button>
                <button type="button" id="banner-next" class="slick-next slick-arrow flex-center rounded-circle box-shadow-4xl bg-white text-xl hover-bg-main-600 hover-text-white transition-1">
                    <i class="ph ph-caret-right"></i>
                </button>
            </div>

            <div class="banner-slider">
                <?php foreach ($banners as $banner): ?>
                    <div class="banner-slider__item">
                        <div class="banner-slider__inner flex-between position-relative">
                            <div class="banner-item__content">
                                <span class="fw-semibold text-success-600 text-capitalize mb-8 animate-left-right animation-delay-08"><?= $banner['subtitle'] ?></span>
                                <h2 class="banner-item__title max-w-700 mb-30 animate-left-right animation-delay-1"><?= $banner['title'] ?></h2>
                                <div class="d-flex align-items-center gap-16 animate-left-right animation-delay-12">
                                    <a href="shop.php" class="btn btn-main d-inline-flex align-items-center rounded-pill gap-8">
                                        Explore Shop <span class="icon text-xl d-flex"><i class="ph ph-shopping-cart-simple"></i></span>
                                    </a>
                                    <div class="d-flex align-items-end gap-8">
                                        <span class="text-heading fst-italic text-sm">Starting at</span>
                                        <h6 class="text-danger-600 mb-0"><?= $banner['price'] ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="banner-item__thumb animate-scale animation-delay-12">
                                <img src="<?= $banner['img'] ?>" alt="">
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- ============================ Banner Section End =============================== -->