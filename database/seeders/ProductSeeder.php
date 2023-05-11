<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductInfo;
use App\Models\ProductReview;
use App\Models\User;
use Database\Factories\ImageFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers =User::whereRole('customer')->get();
        $products = Product::factory(200)
            ->has(ProductInfo::factory(20),'info')
            ->has(Image::factory(5),Product::IMAGES)
        ->  create();
        foreach ($customers as $customer){
            foreach ($products as $product){
                ProductReview::factory([
                    'product_id' => $product->id,
                    'user_id' => $customer->id,
                ])->create();
            }
        }
        $this->updateAverageRating();
    }
    public function updateAverageRating(){
        $ids = Product::all('id')->pluck('id');
        foreach ($ids as $id){
            Product::whereId($id)
                ->update([
                    'average_rating' => ProductReview::whereProductId($id)->avg('rating')??0
                ]);
        }
    }
}
