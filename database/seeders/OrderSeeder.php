<?php

namespace Database\Seeders;

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

        // Get all users and shipping info records
        $users = User::all();
        $shippingInfos = ShippingInfo::all();

        // Loop through each user and create orders
        foreach ($users as $user) {

            $numOrders = 50;

            for ($i = 0; $i < $numOrders; $i++) {
                // Create a new order
                $order = new \App\Models\Order();
                $order->user_id = $user->id;
                $order->total_price = $faker->randomFloat(2, 10, 1000);
                $order->status = $faker->randomElement(['pending', 'processing', 'completed', 'cancelled']);

                // Get a random shipping info record
                $shippingInfo = $shippingInfos->random();

                // Associate the shipping info with the order
                $order->shipping_info()->associate($shippingInfo);

                // Save the order
                $order->save();
            }
        }
    }
}
