<?php

namespace Database\Factories;

use App\Http\Repositories\Web\Customer\CategoryRepository;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $faker_ar = FakerFactory::create('ar_JO');
        $poster =(new ImageFactory())->create();
        $categories = Category::all();
        $categoryRepository = new \App\Http\Repositories\Web\Admin\CategoryRepository();
        $leafCategories_id = $categoryRepository->allNonLeafCategories()->toArray();
        $name = $this->faker->unique($categories->pluck('name_en')->toArray(),100000)->word();
        return [
            'name_en' => $name,
            'name_ar' => $faker_ar->unique($categories->pluck('name_ar')->toArray(), 100000)->word(),
            'slug' => Str::slug($name),
            'icon_url' => $this->faker->imageUrl(200, 200, 'abstract'),
            'parent_id' => $this->faker->randomElement($leafCategories_id) ?? null,
            'poster_id' => $poster->id??null,
        ];

    }
}
