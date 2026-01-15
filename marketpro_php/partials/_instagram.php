<?php
// Array of Instagram images
$instagramImages = [
    "../assets/images/thumbs/instagram-img1.png",
    "../assets/images/thumbs/instagram-img2.png",
    "../assets/images/thumbs/instagram-img3.png",
    "../assets/images/thumbs/instagram-img4.png",
    "../assets/images/thumbs/instagram-img2.png"
];
?>

<!-- ================================ Instagram section start ===================================== -->
<section class="instagram py-120 overflow-hidden">
    <div class="container container-lg">
        <div class="section-heading">
            <div class="flex-between flex-wrap gap-8">
                <div class="">
                    <h5 class="mb-0 text-uppercase">Instagram</h5>
                    <p class="text-gray-500">Get inspired by Carina fans from all around the world</p>
                </div>
                <div class="flex-align gap-16">
                    <a href="shop.php" class="text-sm fw-semibold text-gray-700 hover-text-main-600 hover-text-decoration-underline">View All</a>
                    <div class="flex-align gap-8">
                        <button type="button" id="instagram-prev" class="slick-prev slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1">
                            <i class="ph ph-caret-left"></i>
                        </button>
                        <button type="button" id="instagram-next" class="slick-next slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1">
                            <i class="ph ph-caret-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="instagram-slider">
            <?php foreach ($instagramImages as $index => $image): ?>
                <div data-aos="fade-up" data-aos-duration="<?php echo 400 + ($index * 200); ?>">
                    <div class="instagram-item rounded-24 overflow-hidden position-relative">
                        <img src="<?php echo $image; ?>" alt="">
                        <a href="https://www.instagram.com" class="w-72 h-72 bg-black bg-opacity-50 text-white text-32 position-absolute top-50 start-50 translate-middle flex-center rounded-circle hover-bg-main-two-600 hover-text-white">
                            <i class="ph ph-instagram-logo"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- ================================ Instagram section end ===================================== -->