<!-- ==================================== Banner Three Start =================================== -->
<section class="banner-three bg-img position-relative" data-background-image="../assets/images/shape/line-pattern.png">
    <img src="../assets/images/shape/star-shape.png" alt="Shape" class="animation star-shape animation-rotate">
    <img src="../assets/images/shape/star-shape.png" alt="Shape" class="animation star-shape style-two animation-rotate">
    <img src="../assets/images/shape/line-shape.png" alt="Shape" class="animation line-shape opacity-75 animation-rotate">

    <h1 class="display-200 text-white opacity-25 position-absolute inset-inline-end-0 inset-block-end-0 mb-0 line-height-73">Fashion</h1>

    <div class="flex-align">
        <button type="button" id="banner-three-prev" class="slick-prev slick-arrow flex-center rounded-circle border border-white hover-border-main-600 text-white text-2xl hover-bg-main-600 hover-text-white transition-1 position-absolute top-50 translate-middle-y inset-inline-start-0 ms-lg-5 ms-32">
            <i class="ph ph-caret-left"></i>
        </button>
        <button type="button" id="banner-three-next" class="slick-next slick-arrow flex-center rounded-circle border border-white hover-border-main-600 text-white text-2xl hover-bg-main-600 hover-text-white transition-1 position-absolute top-50 translate-middle-y inset-inline-end-0 me-lg-5 me-32">
            <i class="ph ph-caret-right"></i>
        </button>
    </div>

    <div class="container container-lg">
        <div class="banner-three-slider">
            <?php
            // Example array for banner data
            $banners = [
                ['image' => '../assets/images/thumbs/banner-three-img1.png', 'text' => 'UP TO 50% OFF', 'title' => 'New <span class="fw-normal text-main-two-600 font-heading-four">Style</span> Just For You.', 'description' => 'You appear ordinary if you dress simply. We are able to help you.'],
                ['image' => '../assets/images/thumbs/banner-three-img2.png', 'text' => 'UP TO 50% OFF', 'title' => 'New <span class="fw-normal text-main-two-600 font-heading-four">Style</span> Just For You.', 'description' => 'You appear ordinary if you dress simply. We are able to help you.'],
                ['image' => '../assets/images/thumbs/banner-three-img3.png', 'text' => 'UP TO 50% OFF', 'title' => 'New <span class="fw-normal text-main-two-600 font-heading-four">Style</span> Just For You.', 'description' => 'You appear ordinary if you dress simply. We are able to help you.']
            ];

            foreach ($banners as $banner) {
                echo '<div class="">
                            <div class="row align-items-center gy-4">
                                <div class="col-lg-6">
                                    <div class="span3">
                                        <span class="text-white mb-8 h6 animate-left-right animation-delay-08">' . $banner['text'] . '</span>
                                        <h1 class="text-white display-one animate-left-right animation-delay-1">' . $banner['title'] . '</h1>
                                        <p class="text-white max-w-472 text-2xl mb-24Up animate-left-right animation-delay-12">' . $banner['description'] . '</p>
                                        <a href="shop.php" class="btn btn-outline-white d-inline-flex align-items-center rounded-pill gap-8 mt-lg-4 mt-sm-1 animate-left-right animation-delay-15" tabindex="0">
                                            Shop Now<span class="icon text-xl d-flex"><i class="ph ph-shopping-cart-simple"></i>   </span> 
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex justify-content-center" data-tilt data-tilt-max="16" data-tilt-speed="500" data-tilt-perspective="5000" data-tilt-scale="1.06">
                                        <img src="' . $banner['image'] . '" alt="Thumb" class="animate-scale animation-delay-12">
                                    </div>
                                </div>  
                            </div>
                        </div>';
            }
            ?>
        </div>
    </div>
</section>
<!-- ==================================== Banner Three End =================================== -->