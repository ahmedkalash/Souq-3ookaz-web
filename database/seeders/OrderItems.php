<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderItems extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Get all order and product ids from the database
        $orderIds = Order::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();

        foreach ($orderIds as $orderId){
            foreach (range(1, 5) as $index) {
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $faker->randomElement($productIds),
                    'unit_price' => $faker->randomFloat(2, 10, 100),
                    'count' => $faker->numberBetween(1, 10),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }


    }
}
