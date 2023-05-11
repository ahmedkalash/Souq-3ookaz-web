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
       ProductInfo::factory(5)
           ->create();
    }
}
