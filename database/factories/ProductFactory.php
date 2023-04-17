<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;

    public function definition()
    {


        return [
            'name_en' => $this->faker->sentence(2),
            'name_ar' => $this->faker->sentence(2),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'stock' => $this->faker->numberBetween(0, 100),
            'description' => $this->faker->paragraph,
            'brand' => $this->faker->word,
            'status' => $this->faker->randomElement(['available', 'not available']),
            'slug'=>$this->faker->slug()
        ];
    }



}
