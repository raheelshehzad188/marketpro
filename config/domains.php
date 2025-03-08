<?php
return [
    'srs' => [
        'domain' => env('SRS_DOMAIN'),
        'shop_id' => 2, // Shop ID for visibility filtering
        'views' => [
            'home' => 'frontend.pages.home.srs',
            'product_listing' => 'frontend.pages.product_listing',
        ],
        'settings' => [
            'site_name' => 'SRS Site',
            'theme_color' => 'red',
        ],
    ],
    'mxe' => [
        'domain' => env('MXE_DOMAIN'),
        'shop_id' => 3, // Shop ID for visibility filtering
        'views' => [
            'home' => 'frontend.pages.home.mxe',
            'product_listing' => 'frontend.pages.product_listing',
        ],
        'settings' => [
            'site_name' => 'MXE Site',
            'theme_color' => 'black',
        ],
    ],
];
