<?php
function get_products()
{
    return [
        'iphone' => [
            'id' => 'iphone',
            'name' => 'iPhone 15',
            'base_price' => 79900,
            'description' => 'A fast and smooth phone for daily use, photos, and apps.',
            'colors' => ['Black', 'Blue', 'Pink', 'Yellow'],
            'storage_options' => [
                ['storage' => '128GB', 'ram' => '6GB', 'price' => 79900],
                ['storage' => '256GB', 'ram' => '6GB', 'price' => 89900],
                ['storage' => '512GB', 'ram' => '6GB', 'price' => 109900]
            ],
            'image' => 'assets/images/iphone.jpg'
        ],
        'ipad' => [
            'id' => 'ipad',
            'name' => 'iPad Air',
            'base_price' => 59900,
            'description' => 'A light tablet for study, notes, and entertainment.',
            'colors' => ['Space Gray', 'Blue', 'Starlight'],
            'storage_options' => [
                ['storage' => '64GB', 'ram' => '8GB', 'price' => 59900],
                ['storage' => '256GB', 'ram' => '8GB', 'price' => 74900]
            ],
            'image' => 'assets/images/ipad.jpg'
        ],
        'macbook' => [
            'id' => 'macbook',
            'name' => 'MacBook Air M3',
            'base_price' => 109900,
            'description' => 'A simple and powerful laptop for coding and classes.',
            'colors' => ['Midnight', 'Silver', 'Starlight'],
            'storage_options' => [
                ['storage' => '256GB SSD', 'ram' => '8GB', 'price' => 109900],
                ['storage' => '512GB SSD', 'ram' => '8GB', 'price' => 129900],
                ['storage' => '512GB SSD', 'ram' => '16GB', 'price' => 149900]
            ],
            'image' => 'assets/images/macbook.jpg'
        ],
        'airpods' => [
            'id' => 'airpods',
            'name' => 'AirPods Pro',
            'base_price' => 24900,
            'description' => 'Wireless earbuds with good sound and noise cancellation.',
            'colors' => ['White'],
            'storage_options' => [
                ['storage' => 'Charging Case', 'ram' => 'N/A', 'price' => 24900]
            ],
            'image' => 'assets/images/airpods.jpg'
        ]
    ];
}

function get_product($id)
{
    $products = get_products();
    return $products[$id] ?? null;
}
