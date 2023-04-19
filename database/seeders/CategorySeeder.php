<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Category::create([
                'name_en' => 'Vegetables & Fruit',
                'name_ar' => 'خضروات و فاكهة',
                'slug' => 'Vegetables-Fruit',
                'parent_id' => null,
                'icon_url' =>  "https://themes.pixelstrap.com/fastkart/assets/svg/1/vegetable.svg",
                'created_at' => now(),
                'updated_at' => now()
            ]);
             Category::create([
                'name_en' => 'Beverages',
                'name_ar' =>  'مشربات',
                'slug' => 'Beverages',
                'parent_id' => null,
                'icon_url' =>  "https://themes.pixelstrap.com/fastkart/assets/svg/1/cup.svg",
                'created_at' => now(),
                'updated_at' => now()
            ]);
              Category::create([
                'name_en' => 'Meats & Seafoodt',
                'name_ar' => 'لحوم',
                'slug' => 'Meats-Seafood',
                'parent_id' => null,
                'icon_url' =>  "https://themes.pixelstrap.com/fastkart/assets/svg/1/meats.svg",
                'created_at' => now(),
                'updated_at' => now()
            ]);
              Category::create([
                'name_en' => 'Breakfast & Dairy',
                'name_ar' => 'الفطور',
                'slug' => 'Breakfast-Dairy',
                'parent_id' => null,
                'icon_url' =>  "https://themes.pixelstrap.com/fastkart/assets/svg/1/breakfast.svg",
                'created_at' => now(),
                'updated_at' => now()
            ]);


    }
}
