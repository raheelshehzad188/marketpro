<?php

return [
    'srs' => [
        'domain' => env('SRS_DOMAIN'),

        'views' => [
            'home' => 'frontend.pages.home.srs'
        ],
        'settings' => [
            'site_name' => 'SRS Site',
            'theme_color' => 'red',
        ],
    ],
    'mxe' => [
        'domain' => env('MXE_DOMAIN'),
        'views' => [
            'home' => 'frontend.pages.home.mxe'
        ],
        'settings' => [
            'site_name' => 'MXE Site',
            'theme_color' => 'black',
        ],
    ],
];
