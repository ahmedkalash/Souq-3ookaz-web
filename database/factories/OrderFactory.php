<?php

namespace Database\Factories;

use App\Models\OrderItems;
use App\Models\ShippingInfo;
use App\Models\User;
use Database\Seeders\OrderItemsSeeder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // do not forget to update the total_price
        return [
            'user_id'=>User::whereRole('customer')->inRandomOrder()->first(),
            'total_price'=>0,
            'shipping_info_id'=>ShippingInfo::inRandomOrder()->first(),
            'status'=>$this->faker->randomElement(['pending', 'processing', 'completed', 'cancelled']),
        ];
    }
}
