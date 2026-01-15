<?php
// Menu data structure
$menuItems = [
    [
        'title' => 'Cell Phone',
        'icon' => 'ph-caret-right',
        'brands' => ['Samsung', 'Iphone', 'Vivo', 'Oppo', 'Itel', 'Realme']
    ],
    [
        'title' => 'Wear',
        'icon' => 'ph-caret-right',
        'brands' => ['Samsung', 'Iphone', 'Vivo', 'Oppo', 'Itel', 'Realme']
    ],
    [
        'title' => 'Computer',
        'icon' => 'ph-caret-right',
        'brands' => ['Samsung', 'Iphone', 'Vivo', 'Oppo', 'Itel', 'Realme']
    ],
    [
        'title' => 'Headphone',
        'icon' => 'ph-caret-right',
        'brands' => ['Samsung', 'Iphone', 'Vivo', 'Oppo', 'Itel', 'Realme']
    ],
    [
        'title' => 'Smart Screen',
        'icon' => 'ph-caret-right',
        'brands' => ['Samsung', 'Iphone', 'Vivo', 'Oppo', 'Itel', 'Realme']
    ],
    [
        'title' => 'Smart Home',
        'icon' => 'ph-caret-right',
        'brands' => ['Samsung', 'Iphone', 'Vivo', 'Oppo', 'Itel', 'Realme']
    ],
    [
        'title' => 'Digital Accessories',
        'icon' => 'ph-caret-right',
        'brands' => ['Samsung', 'Iphone', 'Vivo', 'Oppo', 'Itel', 'Realme']
    ],
    [
        'title' => 'Value Added Services',
        'icon' => 'ph-caret-right',
        'brands' => ['Samsung', 'Iphone', 'Vivo', 'Oppo', 'Itel', 'Realme']
    ]
];
?>

<div class="responsive-dropdown common-dropdown <?php echo $dropdownClass; ?> nav-submenu p-0 submenus-submenu-wrapper shadow-none border border-gray-100">
    <button type="button" class="close-responsive-dropdown rounded-circle text-xl position-absolute inset-inline-end-0 inset-block-start-0 mt-4 me-8 d-lg-none d-flex"> <i class="ph ph-x"></i> </button>

    <div class="logo px-16 d-lg-none d-block">
        <a href="index.php" class="link">
            <img src="../assets/images/logo/logo.png" alt="Logo">
        </a>
    </div>

    <ul class="scroll-sm p-0 py-8 overflow-y-auto">
        <?php foreach ($menuItems as $item): ?>
        <li class="has-submenus-submenu">
            <a href="javascript:void(0)" class="text-gray-500 text-15 py-12 px-16 flex-align gap-8 rounded-0">
                <span><?php echo $item['title']; ?></span>
                <span class="icon text-md d-flex ms-auto"><i class="ph <?php echo $item['icon']; ?>"></i></span>
            </a>

            <div class="submenus-submenu py-16">
                <h6 class="text-lg px-16 submenus-submenu__title"><?php echo $item['title']; ?></h6>
                <ul class="submenus-submenu__list max-h-300 overflow-y-auto scroll-sm">
                    <?php foreach ($item['brands'] as $brand): ?>
                    <li>
                        <a href="shop.php"><?php echo $brand; ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</div>