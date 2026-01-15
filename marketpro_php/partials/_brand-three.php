<?php
$images = [
    'brand-three-img1.png',
    'brand-three-img2.png',
    'brand-three-img3.png',
    'brand-three-img4.png',
    'brand-three-img5.png',
    'brand-three-img6.png',
    'brand-three-img7.png',
    'brand-three-img8.png',
    'brand-three-img5.png'
];
?>
<!-- ================================ Brand Three Start ============================= -->
<div class="top-brand pb-80 overflow-hidden">
    <div class="container container-lg">
        <div class="border border-gray-100 p-24 rounded-16">
            <div class="section-heading mb-24">
                <div class="flex-between flex-wrap gap-8">
                    <h5 class="mb-0 text-uppercase">Top Brands</h5>
                    <div class="flex-align gap-8">
                        <button type="button" id="topBrand-prev" class="slick-prev slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-two-600 text-xl hover-bg-main-two-600 hover-text-white transition-1">
                            <i class="ph ph-caret-left"></i>
                        </button>
                        <button type="button" id="topBrand-next" class="slick-next slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-two-600 text-xl hover-bg-main-two-600 hover-text-white transition-1">
                            <i class="ph ph-caret-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="top-brand__slider">
                <?php foreach ($images as $image): ?>
                    <div class="wow bounceIn">
                        <img src="../assets/images/thumbs/<?php echo $image; ?>" alt="">
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>
<!-- ================================ Brand Three End ============================= -->