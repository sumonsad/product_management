<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            Product::create([
                'product_id' => 'P' . str_pad($index, 4, '0', STR_PAD_LEFT),
                'name' => $faker->word,
                'description' => $faker->sentence,
                'price' => $faker->randomFloat(2, 5, 100),
                'stock' => $faker->numberBetween(10, 500),
                'image' => $faker->imageUrl(640, 480, 'products'),
            ]);
        }
    }
}
