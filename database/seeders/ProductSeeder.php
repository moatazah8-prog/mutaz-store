<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Samsung S22 Ultra',
            'description' => 'هاتف سامسونج S22 Ultra سعة 256GB',
            'image' => 'products/s22-ultra.jpg',
            'category' => 'الهواتف',
            'price' => 345,
            'currency' => 'USD',
            'stock' => 5,
            'featured' => true,
        ]);

        Product::create([
            'name' => 'Samsung S24 Ultra',
            'description' => 'هاتف سامسونج S24 Ultra سعة 512GB',
            'image' => 'products/s24-ultra.jpg',
            'category' => 'الهواتف',
            'price' => 650,
            'currency' => 'USD',
            'stock' => 3,
            'featured' => true,
        ]);

        Product::create([
            'name' => 'سماعة لاسلكية',
            'description' => 'سماعة بلوتوث لاسلكية',
            'image' => 'products/headset.jpg',
            'category' => 'الإكسسوارات',
            'price' => 15000,
            'currency' => 'YER',
            'stock' => 10,
            'featured' => true,
        ]);

        Product::create([
            'name' => 'راوتر 4G',
            'description' => 'راوتر 4G للإنترنت',
            'image' => 'products/router.jpg',
            'category' => 'الراوتر والمودم',
            'price' => 35000,
            'currency' => 'YER',
            'stock' => 8,
            'featured' => true,
        ]);
    }
}
