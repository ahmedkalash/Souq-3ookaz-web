<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use App\Models\User;
use App\Models\ShippingInfo;
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 5; $i++) {
            \DB::transaction(function ()use ( $faker){
                // Create a new order
                $order = Order::factory()->for(ShippingInfo::factory())
                    ->has(OrderItems::factory(5))
                    ->create();

                $orderItems = OrderItems::whereOrderId($order->id)->get();
                $total_price = $orderItems->sum(function ($orderItem){
                    return $orderItem->count * $orderItem->unit_price;
                });

                $order->total_price = $total_price;
                $order->save();

            });

        }
    }
}
