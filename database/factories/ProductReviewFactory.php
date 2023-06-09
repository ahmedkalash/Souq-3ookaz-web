<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductReview>
 */
class ProductReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id' => Product::inRandomOrder()->first()->id,
            'user_id' => User::whereRole('customer')->inRandomOrder()->first()->id,
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->paragraph(5),
        ];
    }
}
