<?php
$footerMenus = [
    'Information' => [
        'Become a Vendor' => 'shop.php',
        'Affiliate Program' => 'shop.php',
        'Privacy Policy' => 'shop.php',
        'Our Suppliers' => 'shop.php',
        'Extended Plan' => 'shop.php',
        'Community' => 'shop.php',
    ],
    'Customer Support' => [
        'Help Center' => 'shop.php',
        'Contact Us' => 'contact.php',
        'Report Abuse' => 'shop.php',
        'Submit and Dispute' => 'shop.php',
        'Policies & Rules' => 'shop.php',
        'Online Shopping' => 'shop.php',
    ],
    'My Account' => [
        'My Account' => 'shop.php',
        'Order History' => 'shop.php',
        'Shoping Cart' => 'shop.php',
        'Compare' => 'shop.php',
        'Help Ticket' => 'shop.php',
        'Wishlist' => 'shop.php',
    ],
    'Daily Groceries' => [
        'Dairy & Eggs' => 'shop.php',
        'Meat & Seafood' => 'shop.php',
        'Breakfast Food' => 'shop.php',
        'Household Supplies' => 'shop.php',
        'Bread & Bakery' => 'shop.php',
        'Pantry Staples' => 'shop.php',
    ]
];
?>
<!-- ==================== Footer Start Here ==================== -->
<footer class="footer py-120">
    <div class="container container-lg">
        <div class="footer-item-wrapper d-flex align-items-start flex-wrap">
            <div class="footer-item" data-aos="fade-up" data-aos-duration="200">
                <div class="max-w-340">
                    <div class="footer-item__logo">
                        <a href="index.php"> <img src="../assets/images/logo/logo.png" alt=""></a>
                    </div>
                    <p class="mb-28 text-heading">We're Grocery Shop, an innovative team of food supliers.</p>

                    <div class="d-flex flex-column gap-8">
                        <p class="text-heading fw-medium">2972 Westheimer Rd. Santa Ana, Illinois 85486</p>
                        <a href="mailto:support@example.com" class="text-heading fw-medium hover-text-main-600">support@example.com</a>
                        <a href="tel:+(406)555-0120" class="text-heading fw-medium hover-text-main-600">+ (406) 555-0120</a>
                    </div>
                </div>
            </div>

            <?php
            $duration = 400;
            foreach ($footerMenus as $title => $links): ?>
                <div class="footer-item" data-aos="fade-up" data-aos-duration="<?= $duration ?>">
                    <h6 class="footer-item__title"><?= $title ?></h6>
                    <ul class="footer-menu">
                        <?php
                        $lastKey = array_key_last($links);
                        foreach ($links as $text => $url):
                            $isLast = ($text === $lastKey);
                        ?>
                            <li class="<?= !$isLast ? 'mb-16' : '' ?>">
                                <a href="<?= $url ?>" class="text-heading hover-text-main-600"><?= $text ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php
                $duration += 200;
            endforeach;
            ?>

            <div class="footer-item" data-aos="fade-up" data-aos-duration="1200">
                <h6 class="">Shop on The Go</h6>
                <p class="mb-16">MarketPro App is available. Get it now</p>
                <div class="my-32">
                    <div class="flex-align gap-8">
                        <div class="bg-white rounded-10 p-1 box-shadow-5xl">
                            <img src="../assets/images/thumbs/qr-code.png" alt="QR Code">
                        </div>
                        <div class="d-flex flex-column gap-16">
                            <a href="https://www.apple.com/app-store" class="py-14 px-32 d-flex justify-content-center align-items-center gap-8 fw-medium text-heading text-sm hover-bg-main-600 hover-text-white box-shadow-6xl rounded-6">
                                <i class="ph-fill ph-apple-logo"></i>
                                Google play
                            </a>
                            <a href="https://www.apple.com/app-store" class="py-14 px-32 d-flex justify-content-center align-items-center gap-8 fw-medium text-heading text-sm hover-bg-main-600 hover-text-white box-shadow-6xl rounded-6">
                                <img src="../assets/images/icon/google-play.svg" alt="Play Store">
                                Google play
                            </a>
                        </div>
                    </div>
                    <div class="mt-24">
                        <img src="../assets/images/thumbs/method.png" alt="Method ">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- bottom Footer -->
<div class="bottom-footer py-8">
    <div class="container container-lg">
        <div class="bottom-footer__inner flex-between flex-wrap gap-16 py-16 border-top border-neutral-50">
            <p class="bottom-footer__text text-heading wow fadeInLeft fw-medium">Copyright &copy; <span class="text-success-600 fw-semibold">2025</span> Ui-drops All Rights Reserved </p>
            <div class="flex-align gap-8 flex-wrap wow fadeInRight">
                <ul class="flex-align gap-16">
                    <li>
                        <a href="https://www.facebook.com" class="w-44 h-44 flex-center bg-white shadow-sm text-main-600 text-xl rounded-circle hover-bg-main-600 hover-text-white">
                            <i class="ph-fill ph-facebook-logo"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.twitter.com" class="w-44 h-44 flex-center bg-white shadow-sm text-main-600 text-xl rounded-circle hover-bg-main-600 hover-text-white">
                            <i class="ph-fill ph-twitter-logo"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com" class="w-44 h-44 flex-center bg-white shadow-sm text-main-600 text-xl rounded-circle hover-bg-main-600 hover-text-white">
                            <i class="ph-fill ph-instagram-logo"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.pinterest.com" class="w-44 h-44 flex-center bg-white shadow-sm text-main-600 text-xl rounded-circle hover-bg-main-600 hover-text-white">
                            <i class="ph-fill ph-linkedin-logo"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- ==================== Footer End Here ==================== -->