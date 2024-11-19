<?php

return [
    'srs' => [
        'domain' => env('SRS_DOMAIN'),
        'view' => 'frontend.site1.index',
        'settings' => [
            'site_name' => 'SRS Site',
            'theme_color' => 'red',
        ],
    ],
    'mxe' => [
        'domain' => env('MXE_DOMAIN'),
        'view' => 'frontend.site2.index',
        'settings' => [
            'site_name' => 'MXE Site',
            'theme_color' => 'black',
        ],
    ],
];
