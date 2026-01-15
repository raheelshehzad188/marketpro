<?php
$dropdownCategories = [
    ['title' => 'Vegetables', 'icon' => 'category-1.png'],
    ['title' => 'Milk & Cake', 'icon' => 'category-2.png'],
    ['title' => 'Grocery', 'icon' => 'category-3.png'],
    ['title' => 'Beauty', 'icon' => 'category-4.png'],
    ['title' => 'Wines & Drinks', 'icon' => 'category-5.png'],
    ['title' => 'Snacks', 'icon' => 'category-6.png'],
    ['title' => 'Juice', 'icon' => 'category-7.png'],
    ['title' => 'Fruits', 'icon' => 'category-8.png'],
    ['title' => 'Tea & Coffee', 'icon' => 'category-9.png']
];
?>
<!-- ==================== Header Start Here ==================== -->
<header class="header bg-white border-bottom-0 box-shadow-3xl py-10 z-2">
    <div class="container container-lg">
        <nav class="header-inner d-flex justify-content-between gap-8">
            <div class="flex-align menu-category-wrapper position-relative">

                <!-- Category Dropdown Start -->
                <div class="">
                    <button type="button" class="category-button d-flex align-items-center gap-12 text-white bg-success-600 px-20 py-16 rounded-6 hover-bg-success-700 transition-2">
                        <span class="text-xl line-height-1"><i class="ph ph-squares-four"></i></span>
                        <span class="">Browse Categories</span>
                        <span class="line-height-1 icon transition-2"><i class="ph-bold ph-caret-down"></i></span>
                    </button>

                    <!-- Dropdown Start -->
                    <div class="category-dropdown border border-success-200 shadow bg-white p-16 rounded-16 w-100 max-w-472 position-absolute inset-block-start-100 inset-inline-start-0 z-99 transition-2">
                        <div class="d-grid grid-cols-3-repeat gap-4 max-h-350    F overflow-y-auto">
                            <?php foreach ($dropdownCategories as $category): ?>
                                <a href="shop.php" class="py-16 px-8 rounded-8 hover-bg-main-50 d-flex flex-column align-items-center text-center border border-white hover-border-main-100">
                                    <span>
                                        <img src="../assets/images/icon/<?= htmlspecialchars($category['icon']) ?>" alt="Icon" class="w-40">
                                    </span>
                                    <span class="fw-semibold text-heading mt-16 text-sm"><?= htmlspecialchars($category['title']) ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- Dropdown End -->

                </div>
                <!-- Category Dropdown End -->

                <!-- Menu Start  -->
                <div class="header-menu d-lg-block d-none">
                    <?php
                    $class = '';
                    include 'partials/_nav-menu.php'
                    ?>
                </div>
                <!-- Menu End  -->
            </div>

            <div class="header-right flex-align gap-20">
                <a href="tel:+(2)871382023" class="d-sm-flex align-items-center gap-16 d-none">
                    <span class="d-flex text-32">
                        <img src="../assets/images/icon/mobile.png" alt="Mobile Icon">
                    </span>
                    <span class="">
                        <span class="d-block text-heading fw-medium">Need any Help! call Us</span>
                        <span class="d-block fw-bold text-main-600 hover-text-decoration-underline">+(2) 871 382 023</span>
                    </span>
                </a>
                <button type="button" class="toggle-mobileMenu d-lg-none ms-3n text-gray-800 text-4xl d-flex"> <i class="ph ph-list"></i> </button>
            </div>
        </nav>
    </div>
</header>