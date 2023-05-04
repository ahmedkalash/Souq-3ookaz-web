<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
class ProductInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $faker = \Faker\Factory::create();
        for($i=0;$i<200;$i++){
        ProductInfo::create( [
            'product_id' => Product::inRandomOrder()->first()->id,
            'key' => $faker->word(),
            'value' => $faker->word(),
            ]);
         }
    }
}
