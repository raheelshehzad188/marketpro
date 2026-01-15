<?php
// Generate sample CSV file
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="products_sample.csv"');

$output = fopen('php://output', 'w');

// Add UTF-8 BOM for Excel compatibility
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// Header row
fputcsv($output, [
    'name',
    'price',
    'category',
    'brand',
    'slug',
    'image_url',
    'description',
    'tags',
    'rating',
    'reviews',
    'status'
]);

// Sample data rows
$sampleData = [
    [
        'Taylor Farms Broccoli Florets Vegetables',
        '125.00',
        'Vegetables',
        'Taylor Farms',
        'taylor-farms-broccoli-florets',
        'https://example.com/images/broccoli.jpg',
        'Fresh organic broccoli florets, perfect for healthy meals',
        'organic,fresh,vegetables',
        '4.8',
        '128',
        'active'
    ],
    [
        'Organic Carrots',
        '80.00',
        'Vegetables',
        'Fresh Farm',
        'organic-carrots',
        'https://example.com/images/carrots.jpg',
        'Fresh organic carrots, packed with nutrients',
        'organic,carrots,healthy',
        '4.5',
        '102',
        'active'
    ],
    [
        'Fresh Spinach',
        '95.00',
        'Vegetables',
        'Green Valley',
        'fresh-spinach',
        'https://example.com/images/spinach.jpg',
        'Fresh leafy spinach, perfect for salads',
        'fresh,spinach,greens',
        '4.7',
        '134',
        'active'
    ],
    [
        'Premium Olive Oil',
        '250.00',
        'Oils & Condiments',
        'Mediterranean',
        'premium-olive-oil',
        'https://example.com/images/olive-oil.jpg',
        'Extra virgin olive oil from Mediterranean region',
        'olive-oil,premium,cooking',
        '4.9',
        '89',
        'active'
    ],
    [
        'Organic Honey',
        '180.00',
        'Beverages',
        'Bee Natural',
        'organic-honey',
        'https://example.com/images/honey.jpg',
        'Pure organic honey, naturally sweet',
        'honey,organic,sweet',
        '4.6',
        '156',
        'active'
    ]
];

foreach ($sampleData as $row) {
    fputcsv($output, $row);
}

fclose($output);
exit;
?>
