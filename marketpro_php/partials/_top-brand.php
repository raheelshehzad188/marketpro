<?php
// Top Brands Data Array
$topBrands = [
    'title' => 'Top Brands',
    'brands' => [
        [
            'image' => '../assets/images/thumbs/top-brand-img1.png',
            'alt' => 'Brand 1'
        ],
        [
            'image' => '../assets/images/thumbs/top-brand-img2.png',
            'alt' => 'Brand 2'
        ],
        [
            'image' => '../assets/images/thumbs/top-brand-img3.png',
            'alt' => 'Brand 3'
        ],
        [
            'image' => '../assets/images/thumbs/top-brand-img4.png',
            'alt' => 'Brand 4'
        ],
        [
            'image' => '../assets/images/thumbs/top-brand-img5.png',
            'alt' => 'Brand 5'
        ],
        [
            'image' => '../assets/images/thumbs/top-brand-img6.png',
            'alt' => 'Brand 6'
        ],
        [
            'image' => '../assets/images/thumbs/top-brand-img7.png',
            'alt' => 'Brand 7'
        ],
        [
            'image' => '../assets/images/thumbs/top-brand-img8.png',
            'alt' => 'Brand 8'
        ],
        [
            'image' => '../assets/images/thumbs/top-brand-img5.png',
            'alt' => 'Brand 9'
        ]
    ]
];
?>

<!-- ============================== Top Brand Section Start ==================================== -->
<div class="top-brand py-80">
    <div class="container container-lg">
        <div class="border border-gray-50 p-24 rounded-16">
            <div class="section-heading mb-24">
                <div class="flex-between flex-wrap gap-8">
                    <h6 class="mb-0"><?php echo $topBrands['title']; ?></h6>
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
                <?php foreach($topBrands['brands'] as $brand): ?>
                <div class="wow bounceIn">
                    <div class="top-brand__item flex-center rounded-8 my-4 hover-border-main-600 transition-1 px-8 box-shadow-7xl">
                        <img src="<?php echo $brand['image']; ?>" alt="<?php echo $brand['alt']; ?>">
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
        </div>
    </div>
</div>
<!-- ============================== Top Brand Section End ==================================== -->