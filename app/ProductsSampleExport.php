<?php

namespace App;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsSampleExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            [
                'Sample Product 1',
                'SKU001',
                '150.00',
                'https://example.com/images/product1.jpg',
                'Electronics',
                'Brand A',
                'This is a sample product description. You can add detailed information about the product here.'
            ],
            [
                'Sample Product 2',
                'SKU002',
                '250.00',
                'https://example.com/images/product2.jpg',
                'Clothing',
                'Brand B',
                'Another sample product with different category and brand.'
            ],
            [
                'Sample Product 3',
                'SKU003',
                '99.99',
                'https://example.com/images/product3.jpg',
                'Home & Garden',
                'Brand C',
                'Sample product description for home and garden category.'
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'name',
            'sku',
            'price',
            'image_url',
            'category',
            'brand',
            'description'
        ];
    }
}
