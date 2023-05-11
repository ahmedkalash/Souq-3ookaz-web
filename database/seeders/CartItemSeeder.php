<?php

namespace Database\Seeders;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::whereRole('customer')->get('id');
        foreach ($users as $user){
            $products = Product::inRandomOrder()->limit(3)->get('id');
            foreach ($products as $product){
                CartItem::factory()->create([
                    'user_id'=>$user->id,
                    'product_id'=>$product->id
                ]);
            }

        }
    }
}
