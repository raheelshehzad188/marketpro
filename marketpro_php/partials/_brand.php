<?php
$images = [
    'brand-img1.png' => 200,
    'brand-img2.png' => 400,
    'brand-img3.png' => 600,
    'brand-img4.png' => 800,
    'brand-img5.png' => 1000,
    'brand-img6.png' => 1200,
    'brand-img7.png' => 1400,
    'brand-img8.png' => 1600,
    'brand-img3.png' => 1800  // Repeated image
];
?>
<!-- ============================== Brand Section Start =============================== -->
<div class="brand py-80 overflow-hidden">
    <div class="container container-lg">
        <div class="brand-inner p-24 rounded-16">
            <div class="section-heading">
                <div class="flex-between flex-wrap gap-8">
                    <h5 class="mb-0 wow fadeInLeft">Shop by Brands</h5>
                    <div class="flex-align gap-16 wow fadeInRight">
                        <a href="shop.php" class="text-sm fw-medium text-gray-700 hover-text-main-600 hover-text-decoration-underline">View All Deals</a>
                        <div class="flex-align gap-8">
                            <button type="button" id="brand-prev" class="slick-prev slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1">
                                <i class="ph ph-caret-left"></i>
                            </button>
                            <button type="button" id="brand-next" class="slick-next slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1">
                                <i class="ph ph-caret-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="brand-slider arrow-style-two">
                <?php foreach ($images as $image => $duration): ?>
                    <div class="brand-item" data-aos="zoom-in" data-aos-duration="<?php echo $duration; ?>">
                        <img src="../assets/images/thumbs/<?php echo $image; ?>" alt="">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!-- ============================== Brand Section End =============================== -->