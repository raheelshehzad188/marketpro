<?php
$categories = [
    ['title' => 'Vegetables', 'image' => 'feature-img1.png', 'duration' => 400],
    ['title' => 'Fish & Meats', 'image' => 'feature-img2.png', 'duration' => 600],
    ['title' => 'Desserts', 'image' => 'feature-img3.png', 'duration' => 800],
    ['title' => 'Drinks & Juice', 'image' => 'feature-img4.png', 'duration' => 1000],
    ['title' => 'Animals Food', 'image' => 'feature-img5.png', 'duration' => 1200],
    ['title' => 'Fresh Fruits', 'image' => 'feature-img6.png', 'duration' => 1400],
    ['title' => 'Yummy Candy', 'image' => 'feature-img7.png', 'duration' => 1600],
    ['title' => 'Fish & Meats', 'image' => 'feature-img2.png', 'duration' => 1800],
    ['title' => 'Dairy & Eggs', 'image' => 'feature-img8.png', 'duration' => 2000],
    ['title' => 'Snacks', 'image' => 'feature-img9.png', 'duration' => 2200],
    ['title' => 'Frozen Foods', 'image' => 'feature-img10.png', 'duration' => 2400],
];
?>
<!-- ============================ Feature Section start =============================== -->
<div class="feature" id="featureSection">
    <div class="container container-lg">
        <div class="position-relative arrow-center gradient-shadow">
            <div class="flex-align">
                <button type="button" id="feature-item-wrapper-prev" class="slick-prev slick-arrow flex-center rounded-circle bg-white text-xl hover-bg-main-600 hover-text-white transition-1">
                    <i class="ph ph-caret-left"></i>
                </button>
                <button type="button" id="feature-item-wrapper-next" class="slick-next slick-arrow flex-center rounded-circle bg-white text-xl hover-bg-main-600 hover-text-white transition-1">
                    <i class="ph ph-caret-right"></i>
                </button>
            </div>
            <div class="feature-item-wrapper">
                <?php foreach ($categories as $category): ?>
                    <div class="feature-item text-center wow bounceIn" data-aos="fade-up" data-aos-duration="<?= $category['duration']; ?>">
                        <div class="feature-item__thumb rounded-circle">
                            <a href="shop.php" class="w-100 h-100 flex-center">
                                <img src="../assets/images/thumbs/<?= htmlspecialchars($category['image']); ?>" alt="<?= htmlspecialchars($category['title']); ?>">
                            </a>
                        </div>
                        <div class="feature-item__content mt-16">
                            <h6 class="text-lg mb-8">
                                <a href="shop.php" class="text-inherit"><?= htmlspecialchars($category['title']); ?></a>
                            </h6>
                            <span class="text-sm text-gray-400">125+ Products</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!-- ============================ Feature Section End =============================== -->