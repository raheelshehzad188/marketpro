<!-- ============================ Banner Section start =============================== -->
<?php
$banners = [
    [
        'price' => 250,
        'title' => 'Get The Sound You Love For Less',
        'image' => '../assets/images/thumbs/banner-two-img.png',
        'link' => 'shop.php'
    ],
    [
        'price' => 199,
        'title' => 'Experience Premium Quality Audio',
        'image' => '../assets/images/thumbs/banner-two-img.png',
        'link' => 'shop.php'
    ],
    [
        'price' => 149,
        'title' => 'Unbeatable Deals On Headphones',
        'image' => '../assets/images/thumbs/banner-two-img.png',
        'link' => 'shop.php'
    ]
];
$categories = [
    [
        'name' => 'Computers & Laptop',
        'icon' => 'category-icon1.png',
        'subcategories' => ['Samsung', 'Iphone', 'Vivo', 'Oppo', 'Itel', 'Realme']
    ],
    [
        'name' => 'Smartphones & Gadget',
        'icon' => 'category-icon2.png',
        'subcategories' => ['Samsung', 'Iphone', 'Vivo', 'Oppo', 'Itel', 'Realme']
    ],
    [
        'name' => 'Gaming & Television',
        'icon' => 'category-icon3.png',
        'subcategories' => ['Samsung', 'Iphone', 'Vivo', 'Oppo', 'Itel', 'Realme']
    ],
    [
        'name' => 'Office Equipment',
        'icon' => 'category-icon4.png',
        'subcategories' => ['Samsung', 'Iphone', 'Vivo', 'Oppo', 'Itel', 'Realme']
    ],
    [
        'name' => 'SmartWatches',
        'icon' => 'category-icon5.png',
        'subcategories' => ['Samsung', 'Iphone', 'Vivo', 'Oppo', 'Itel', 'Realme']
    ],
    [
        'name' => 'Headphone & Music',
        'icon' => 'category-icon6.png',
        'subcategories' => ['Samsung', 'Iphone', 'Vivo', 'Oppo', 'Itel', 'Realme']
    ],
    [
        'name' => 'Camera & Video',
        'icon' => 'category-icon7.png',
        'subcategories' => ['Samsung', 'Iphone', 'Vivo', 'Oppo', 'Itel', 'Realme']
    ],
    [
        'name' => 'Accessories & Gadget',
        'icon' => 'category-icon8.png',
        'subcategories' => ['Samsung', 'Iphone', 'Vivo', 'Oppo', 'Itel', 'Realme'],
        'is_new' => true,
        'bg_color' => 'bg-paste'
    ],
    [
        'name' => 'Vr Technology',
        'icon' => 'category-icon9.png',
        'subcategories' => ['Samsung', 'Iphone', 'Vivo', 'Oppo', 'Itel', 'Realme']
    ],
    [
        'name' => 'Studio Equipment',
        'icon' => 'category-icon10.png',
        'subcategories' => ['Samsung', 'Iphone', 'Vivo', 'Oppo', 'Itel', 'Realme']
    ],
    [
        'name' => 'Trending Products',
        'icon' => 'category-icon11.png',
        'subcategories' => ['Samsung', 'Iphone', 'Vivo', 'Oppo', 'Itel', 'Realme'],
        'is_new' => true,
        'bg_color' => 'bg-danger-600'
    ],
    [
        'name' => 'Top Offer Products',
        'icon' => 'category-icon12.png',
        'subcategories' => ['Samsung', 'Iphone', 'Vivo', 'Oppo', 'Itel', 'Realme']
    ]

];
?>
<div class="banner-two">
    <div class="container container-lg">
        <div class="banner-two-wrapper d-flex align-items-start">

            <div class="w-310 d-lg-block d-none flex-shrink-0">
                <div class="responsive-dropdown style-two common-dropdown nav-submenu p-0 submenus-submenu-wrapper shadow-none border border-neutral-50 position-relative border-top-0 rounded-0">
                    <button type="button" class="close-responsive-dropdown rounded-circle text-xl position-absolute inset-inline-end-0 inset-block-start-0 mt-4 me-8 d-lg-none d-flex"> <i class="ph ph-x"></i> </button>

                    <div class="logo px-16 d-lg-none d-block">
                        <a href="index.php" class="link">
                            <img src="../assets/images/logo/logo.png" alt="Logo">
                        </a>
                    </div>
                    <ul class="responsive-dropdown__list scroll-sm p-0 overflow-y-auto">
                        <?php foreach ($categories as $category): ?>
                            <li class="has-submenus-submenu border-bottom border-neutral-50">
                                <a href="javascript:void(0)" class="text-gray-500 text-15 py-14 px-16 flex-align gap-8 rounded-0 fw-semibold text-sm">
                                    <span class="d-flex align-items-center gap-16">
                                        <img src="../assets/images/icon/<?= $category['icon'] ?>" alt="Category Icon">
                                        <span><?= htmlspecialchars($category['name']) ?></span>
                                    </span>
                                    <?php if (!empty($category['is_new'])): ?>
                                        <span class="<?php echo $category['bg_color']; ?> text-white text-xs py-2 px-8 rounded-4 flex-shrink-0">New</span>
                                    <?php endif; ?>
                                    <span class="icon text-md d-flex ms-auto"><i class="ph ph-caret-right"></i></span>
                                </a>

                                <div class="submenus-submenu py-16">
                                    <h6 class="text-lg px-16 submenus-submenu__title"><?= htmlspecialchars($category['name']) ?></h6>
                                    <ul class="submenus-submenu__list max-h-300 overflow-y-auto scroll-sm">
                                        <?php foreach ($category['subcategories'] as $subcategory): ?>
                                            <li>
                                                <a href="shop.php"><?= htmlspecialchars($subcategory) ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="banner-item-two-wrapper rounded-24 overflow-hidden position-relative arrow-center flex-grow-1 mb-0 m-20">
                <img src="../assets/images/bg/banner-two-bg.png" alt="" class="banner-img position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 z-n1 object-fit-cover rounded-24">

                <div class="banner-item-two__slider">
                    <?php foreach ($banners as $banner): ?>
                        <div class="d-flex align-items-center justify-content-between py-84 px-72-px flex-wrap-reverse flex-sm-nowrap gap-32">
                            <div class="banner-item-two__content">
                                <span class="animate-left-right animation-delay-08 mb-8 text-md fw-semibold text-main-600">
                                    Starting at only <span class="text-danger-600">$<?php echo $banner['price']; ?></span>
                                </span>
                                <h2 class="banner-item-two__title animate-left-right animation-delay-1">
                                    <?php echo $banner['title']; ?>
                                </h2>
                                <a href="<?php echo $banner['link']; ?>" class="btn btn-main d-inline-flex align-items-center rounded-pill gap-8 mt-24 animate-left-right animation-delay-12">
                                    Shop Now<span class="icon text-xl d-flex"><i class="ph ph-shopping-cart-simple"></i></span>
                                </a>
                            </div>
                            <div class="banner-item-two__thumb">
                                <img src="<?php echo $banner['image']; ?>" alt="Thumb" class="animate-scale animation-delay-12">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================ Banner Section End =============================== -->