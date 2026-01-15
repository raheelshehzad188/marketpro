<?php
$shippingFeatures = [
    [
        'icon' => 'ph-car-profile',
        'title' => 'Free Shipping',
        'description' => 'Free shipping all over the US',
        'duration' => 400
    ],
    [
        'icon' => 'ph-hand-heart',
        'title' => '100% Satisfaction',
        'description' => 'Free shipping all over the US',
        'duration' => 600
    ],
    [
        'icon' => 'ph-credit-card',
        'title' => 'Secure Payments',
        'description' => 'Free shipping all over the US',
        'duration' => 800
    ],
    [
        'icon' => 'ph-chats',
        'title' => '24/7 Support',
        'description' => 'Free shipping all over the US',
        'duration' => 1000
    ],

];
$footerMenus = [
    'Shopping' => [
        'Careers',
        'About Machine',
        'Investor Relations',
        'Machine Devices',
        'Customer Reviews',
        'Privacy Policy',
        'Contact Us'
    ],
    'Information' => [
        'Pricing',
        'Reviews',
        'Affiliate program',
        'Referral program',
        'Roadmap',
        'Wall of fame',
        'System status',
        'Sitemap'
    ],
    'Company' => [
        'Apple',
        'Camera & Photo',
        'Cell Phones',
        'Computers & Accessories',
        'Headphones',
        'Smartwatches',
        'Sports & Outdoors',
        'Television & Video'
    ],
    'Resource' => [
        'Careers for Blown',
        'About Blown',
        'Investor Relations',
        'Blown Devices',
        'Customer reviews',
        'Social Responsibility',
        'Store Locations'
    ]
];
?>
<!-- =============================== Newsletter-two Section Start ============================ -->
<div class="newsletter-two bg-black-light pb-72 pt-76 overflow-hidden" data-aos="fade-up" data-aos-duration="600">
    <div class="container container-lg">
        <div class="flex-between gap-20 flex-wrap">
            <div class="flex-align gap-22">
                <h4 class="text-white mb-12 fw-medium">Join Our Newsletter, Get <span class="text-main-600">10% Off</span> </h4>
            </div>
            <form action="#" class="newsletter-two__form w-50">
                <div class="d-flex gap-16">
                    <input type="email" class="common-input rounded-8 flex-grow-1 py-14 placeholder-text-16 bg-white-06 border border-neutral-600 focus-border-main-600 hover-border-main-600 text-white" placeholder="Enter your email address">
                    <button type="submit" class="btn btn-main-two flex-shrink-0 rounded-8 py-24 px-44"> Subscribe Now </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- =============================== Newsletter-two Section End ============================ -->

<!-- =============================== Shipping Section Start ============================ -->
<section class="shipping bg-black-light">
    <div class="container container-lg">
        <div class="row gy-4">
            <?php foreach ($shippingFeatures as $feature): ?>
                <div class="col-xxl-3 col-sm-6 aos-init aos-animate" data-aos="zoom-in" data-aos-duration="<?= $feature['duration'] ?>">
                    <div class="shipping-item flex-align gap-16 rounded-16 border border-white-13 border-dashed hover-bg-main-700 transition-2">
                        <span class="w-56 h-56 flex-center rounded-circle bg-main-two-600 text-white text-32 flex-shrink-0">
                            <i class="ph-fill <?= $feature['icon'] ?>"></i>
                        </span>
                        <div>
                            <h6 class="mb-0 text-xl fw-semibold text-white"><?= $feature['title'] ?></h6>
                            <span class="text-sm text-neutral-300 d-block mt-10"><?= $feature['description'] ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- =============================== Shipping Section End ============================ -->


<!-- ==================== Footer Two Start Here ==================== -->
<footer class="footer py-80 overflow-hidden bg-black-light">
    <div class="container container-lg">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-5 gy-5">

            <div class="col">
                <div class="footer-item max-w-275" data-aos="fade-up" data-aos-duration="400">
                    <div class="footer-item__logo mb-40">
                        <a href="index.php"> <img src="../assets/images/logo/logo-white.png" alt=""></a>
                    </div>
                    <div class="flex-align gap-16 mb-20">
                        <span class="text-main-two-600 text-xl flex-shrink-0"><i class="ph-bold ph-phone-call"></i></span>
                        <a href="tel:+00123456789" class="text-md text-white fw-medium hover-text-main-600">+00 123 456 789</a>
                    </div>
                    <div class="flex-align gap-16 mb-20">
                        <span class="text-main-two-600 text-xl flex-shrink-0"><i class="ph-bold ph-chat-circle-text"></i></span>
                        <a href="mailto:support24@marketpro.com" class="text-md text-white fw-medium hover-text-main-600">support24@marketpro.com</a>
                    </div>
                    <div class="flex-align gap-16 mb-20">
                        <span class="text-main-two-600 text-xl flex-shrink-0"><i class="ph-bold ph-map-pin-area"></i></span>
                        <span class="text-md text-white fw-medium ">789 Inner Lane, California, USA</span>
                    </div>
                    <div class="d-flex gap-12 mt-24">
                        <a href="https://www.apple.com/app-store" class="py-14 px-8 rounded-8 d-flex justify-content-center align-items-center gap-8 fw-normal text-white text-xs bg-black hover-bg-white hover-text-heading box-shadow-6xl flex-grow-1">
                            <i class="ph-fill ph-apple-logo"></i>
                            App Store
                        </a>
                        <a href="https://www.apple.com/app-store" class="py-14 px-8 rounded-8 d-flex justify-content-center align-items-center gap-8 fw-normal text-white text-xs bg-black hover-bg-white hover-text-heading box-shadow-6xl flex-grow-1">
                            <img src="../assets/images/icon/google-play.svg" alt="Play Store">
                            Google play
                        </a>
                    </div>
                </div>
            </div>

            <?php foreach ($footerMenus as $title => $items): ?>
                <div class="col">
                    <div class="footer-item" data-aos="fade-up">
                        <h6 class="footer-item__title text-white fw-semibold mb-24"><?= $title ?></h6>
                        <ul class="footer-menu d-flex flex-column gap-20">
                            <?php foreach ($items as $item): ?>
                                <li>
                                    <a href="javascript:void(0)" class="text-neutral-200 hover-text-white hover-text-decoration-underline"><?= $item ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</footer>

<!-- bottom Footer -->
<div class="bottom-footer bg-black-light">
    <div class="container container-lg">
        <div class="bottom-footer__inner flex-between flex-wrap gap-16 border-top border-gray-800 py-24">
            <p class="text-white fw-normal wow fadeInLeft">Full Copyright &copy; Design By <a href="index.php" class="text-main-600 hover-text-white hover-text-decoration-underline">MarketPro</a> - 2025</p>
            <select class="form-control form-select rounded-10 w-auto border border-white ps-18 text-heading fw-medium">
                <option value="English (US)">English (US)</option>
                <option value="Bangla">Bangla</option>
                <option value="Urdhu">Urdhu</option>
                <option value="Spenish">Spenish</option>
                <option value="Arabic">Arabic</option>
            </select>
            <div class="flex-align gap-8 flex-wrap wow fadeInRight">
                <img src="../assets/images/thumbs/payment-method-two.png" alt="Payment Method">
            </div>
        </div>
    </div>
</div>
<!-- ==================== Footer Two End Here ==================== -->